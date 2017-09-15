<?php

namespace ArcaSolutions\CoreBundle\Services;


use ArcaSolutions\ApiBundle\Form\Type\SocialType;
use ArcaSolutions\CoreBundle\Entity\Account;
use ArcaSolutions\CoreBundle\Entity\AccountActivation;
use ArcaSolutions\CoreBundle\Entity\AccountDomain;
use ArcaSolutions\CoreBundle\Entity\Contact;
use ArcaSolutions\CoreBundle\Entity\Profile;
use ArcaSolutions\CoreBundle\Exception\InvalidFormException;
use ArcaSolutions\CoreBundle\Inflector;
use ArcaSolutions\WebBundle\Entity\Accountprofilecontact;
use ArcaSolutions\WebBundle\Form\Type\AccountType;
use ArcaSolutions\WebBundle\Form\Type\LoginType;
use ArcaSolutions\WebBundle\Services\EmailNotificationService;
use ArcaSolutions\MultiDomainBundle\Services\Settings as MultiDomain;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityNotFoundException;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Templating\Helper\AssetsHelper;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Exception\ProviderNotFoundException;
use Symfony\Component\Translation\TranslatorInterface;
use ArcaSolutions\CoreBundle\Mailer\Mailer;

class AccountHandler
{
    const PASSWORD_MIN_LEN = 4;
    const PASSWORD_MAX_LEN = 50;
    const PUBLIC_PROFILE_API = 'y';
    const FACEBOOK_API = 'https://graph.facebook.com/me';
    const GOOGLE_API = 'https://www.googleapis.com/oauth2/v3/tokeninfo';

    /**
     * @var ObjectManager
     */
    protected $omMain;

    /**
     * @var ObjectManager
     */
    protected $omDomain;

    /**
     * @var FormFactoryInterface
     */
    protected $formFactory;

    /**
     * @var EmailNotificationService
     */
    protected $emailNotification;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @var array
     */
    protected $providers = [
        'facebook' => 01,
        'google'   => 02,
    ];

    /**
     * @var string
     */
    private $memberAlias;
    /**
     * @var \Twig_Environment
     */
    private $twig_Environment;
    /**
     * @var Request
     */
    private $request;

    /**
     * @var MultiDomain
     */
    private $multiDomain;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Settings
     */
    private $settings;

    /**
     * AccountHandler constructor.
     *
     * @param ObjectManager $omMain
     * @param ObjectManager $omDomain
     * @param FormFactoryInterface $formFactory
     * @param EmailNotificationService $emailNotification
     * @param TranslatorInterface $translator
     * @param $memberAlias
     * @param AssetsHelper $assetsHelper
     * @param \Twig_Environment $twig_Environment
     * @param MultiDomain $multiDomain
     */
    public function __construct(
        ObjectManager $omMain,
        ObjectManager $omDomain,
        FormFactoryInterface $formFactory,
        EmailNotificationService $emailNotification,
        TranslatorInterface $translator,
        $memberAlias,
        AssetsHelper $assetsHelper,
        \Twig_Environment $twig_Environment,
        MultiDomain $multiDomain,
        \Swift_Mailer $mailer,
        Settings $settings
    ) {
        $this->omMain = $omMain;
        $this->omDomain = $omDomain;
        $this->formFactory = $formFactory;
        $this->emailNotification = $emailNotification;
        $this->translator = $translator;
        $this->memberAlias = $memberAlias;
        $this->assetsHelper = $assetsHelper;
        $this->twig_Environment = $twig_Environment;
        $this->multiDomain = $multiDomain;
        $this->mailer = $mailer;
        $this->settings = $settings;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function post(Request $request)
    {
        $this->request = $request;

        return $this->proccessForm($request->request->all(), 'POST');
    }

    public function login($parameters)
    {
        if ($parameters instanceof Request) {
            $this->request = $parameters;
            $parameters = $parameters->request->all();
        }

        return $this->proccessLoginForm($parameters);
    }

    public function loginSocial($parameters)
    {
        if ($parameters instanceof Request) {
            $this->request = $parameters;
            $parameters = $parameters->request->all();
        }

        /* Checking provider */
        if (!array_key_exists($parameters['provider'], $this->providers)) {
            throw new ProviderNotFoundException('Provider '.$parameters['provider'].' not found');
        }

        return $this->proccessLoginSocialForm($parameters);
    }

    public function proccessForm(array $parameters, $method = 'PUT')
    {
        $form = $this->formFactory->create(new AccountType(), null, ['method' => $method]);
        $form->submit($parameters, 'PATCH' !== $method);

        if ($form->isValid()) {
            $data = $form->getData();
            $data['publish_contact'] = self::PUBLIC_PROFILE_API;
            $data['friendlyUrl'] = $this->friendlyUrlGenerator($data['firstname'].' '.$data['lastname']);

            /* Saves Account */
            $accounts = $this->saveAccount($data);
            list($account, $contact, $activate) = $accounts;

            /* Send Mail Notification */
            $this->sendUserNotification($account, $contact, $activate, $data);

            return $account;
        }

        throw new InvalidFormException('Invalid submitted data', $form);
    }

    public function forgotPassword(Request $request)
    {
        $account = $this->omMain->getRepository("CoreBundle:Account")->findOneBy(['username' => $request->get('username')]);

        if ($account) {
            $contact = $this->omMain->getRepository("CoreBundle:Contact")->findOneBy(['accountId' => $account->getId()]);

            $uniqueKey = md5(uniqid(rand(), true));
            try {

                if ($forgotPassword = $this->omMain->getRepository("CoreBundle:ForgotPassword")->addForgotPassword($account->getId(),
                    $uniqueKey, 'members')
                ) {
                    /* create the forgot password link */
                    $link = $request->getSchemeAndHttpHost()."/".($account->getIsSponsor() == "y" ? $this->memberAlias : 'profile')."/login.php?key=".$uniqueKey;

                    /* sitemgr replay email */
                    $from_sitemgr = explode(',',
                        $this->omDomain->getRepository('WebBundle:Setting')->getSetting('sitemgr_email'));

                    /* getting notification object */
                    $notification = $this->emailNotification->getEmailMessage(EmailNotificationService::FORGOTTEN_PASSWORD);

                    $notification->setFrom($from_sitemgr[0], $this->multiDomain->getTitle());
                    $notification->setTo($contact->getEmail());

                    /* replacing placeholders of the email template */
                    $notification->setPlaceholder('ACCOUNT_NAME',
                        $contact->getFirstName().' '.$contact->getLastName());
                    $notification->setPlaceholder('ACCOUNT_USERNAME', $account->getUsername());
                    $notification->setPlaceholder('KEY_ACCOUNT', $link);

                    $notification->sendEmail();

                    return ['data' => $forgotPassword];
                }
            } catch (\Exception $e) {
                throw $e;
            }
        }

        throw new EntityNotFoundException();
    }

    private function proccessLoginForm(array $parameters)
    {
        $form = $this->formFactory->create(new LoginType(), null, ['method' => 'POST']);
        $form->submit($parameters, true);

        if ($form->isValid()) {
            $data = $form->getData();
            $account = $this->omMain->getRepository("CoreBundle:Account")->findOneBy(['username' => $data['username']]);

            if (null !== $account and $account->getPassword() === md5($data['password'])) {
                return $this->getAccount($account);
            }

            throw new UnauthorizedHttpException('', 'Login Failed');
        }

        throw new InvalidFormException('Invalid submitted data', $form);
    }

    private function proccessLoginSocialForm(array $parameters)
    {
        $form = $this->formFactory->create(new SocialType(), null, ['method' => 'POST']);
        $form->submit($parameters, true);

        if ($form->isValid()) {
            $data = $form->getData();

            /* Switch the provider */
            switch ($data['provider']) {
                case "google":
                    $data = $this->loginGoogle($data['token']);
                    break;
                case "facebook":
                    $data = $this->loginFacebook($data['token']);
                    break;
            }

            /* Creating a new account */
            if (!$data instanceof Account) {
                $accounts = $this->saveAccount($data);
                list($account, $contact, $activate, $profile) = $accounts;

                /* Send Mail Notification */
                $this->sendUserNotification($account, $contact, $activate, $data);

                /* Send Mail Notification to sitemgr */
            }

            !isset($account) and $account = $data;

            return $this->getAccount($account);
        }

        throw new InvalidFormException('Invalid submitted data', $form);
    }

    private function friendlyUrlGenerator($string)
    {
        /* Generate a new friendly_title */
        $friendlyUrl = Inflector::friendly_title($string, '-', true);

        /* Checking if friendly url is being used */
        if ($this->omMain->getRepository('CoreBundle:Profile')->findBy(['friendlyUrl' => $friendlyUrl])) {
            return $this->friendlyUrlGenerator($friendlyUrl.uniqid());
        }

        return $friendlyUrl;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    private function saveAccount($data)
    {
        if (!isset($data['username'])) {
            $data['username'] = $data['email'];
        }

        $account = new Account();
        $account->setUsername($data['username']);
        $account->setPassword(md5($data['password']));
        $account->setPublishContact($data['publish_contact']);

        if (isset($data['provider'])) {
            if ($data['provider'] == $this->providers['facebook']) {
                $account->setFacebookUsername($data['username']);
            }

            $account->setForeignaccount('y');
        }

        $this->omMain->persist($account);
        $this->omMain->flush($account);

        /* Saves Contact */
        $contact = $this->saveContact($account, $data);

        /* Saves Profile */
        $profile = $this->saveProfile($account, $contact, $data);

        /* Saves Activation */
        $activate = 0;
        if (!isset($data['provider'])) {
            $activate = $this->saveAccountActivation($account);
        }

        /* Saves AccountProfileContact */
        $profileContact = $this->saveAccountProfileContact($account, $contact, $data);

        /* Saves Account Domain */
        $this->saveAccountDomain($account->getId());

        return [$account, $contact, $activate, $profile, $profileContact];
    }

    /**
     * @param Account $account
     * @param array $data
     *
     * @return Contact
     */
    private function saveContact(Account $account, $data)
    {
        $contact = new Contact();
        $contact->setAccountId($account->getId());
        $contact->setEmail($data['email']);
        $contact->setFirstName($data['firstname']);
        $contact->setLastName($data['lastname']);

        $this->omMain->persist($contact);
        $this->omMain->flush($contact);

        return $contact;
    }

    /**
     * @param Account $account
     * @param Contact $contact
     * @param array $data
     * @return Profile
     */
    private function saveProfile(Account $account, Contact $contact, $data)
    {
        $nickname = $contact->getFirstName()." ".$contact->getLastName();
        $profile = new Profile();
        $profile->setAccountId($account->getId());
        $profile->setAccount($account);
        $profile->setNickname($nickname);
        $profile->setFriendlyUrl($data['friendlyUrl']);

        if (isset($data['provider'])) {
            $profile->setFacebookImage($data['image']['url']);
            $profile->setFacebookUid($data['id']);
        }

        $this->omMain->persist($profile);
        $this->omMain->flush($profile);

        return $profile;
    }

    /**
     * @param Account $account
     * @return AccountActivation
     */
    private function saveAccountActivation($account)
    {
        $uniqueKey = md5(random_bytes(10));
        $activate = new AccountActivation();
        $activate->setAccountId($account->getId());
        $activate->setUniqueKey($uniqueKey);

        $this->omMain->persist($activate);
        $this->omMain->flush($activate);

        return $activate;
    }

    /**
     * @param Account $account
     * @param Contact $contact
     *
     * @return Accountprofilecontact
     */
    private function saveAccountProfileContact($account, $contact, $data)
    {
        $profile = new Accountprofilecontact();
        $profile->setAccountId($account->getId());
        $profile->setUsername($account->getUsername());
        $profile->setFirstName($contact->getFirstName());
        $profile->setLastName($contact->getLastName());
        $profile->setHasProfile($account->getHasProfile());
        $profile->setNickname($contact->getFirstName().' '.$contact->getLastName());
        $profile->setFriendlyUrl($data['friendlyUrl']);

        if (isset($data['provider'])) {
            $profile->setFacebookImage($data['image']['url']);
        } elseif (isset($data['imageId'])) {
            $profile->setImageId($data['imageId']);
        }

        $this->omDomain->persist($profile);
        $this->omDomain->flush($profile);

        return $profile;
    }

    /**
     * @param int $accountId
     */
    private function saveAccountDomain($accountId)
    {
        $accDomain = new AccountDomain();
        $accDomain->setAccountId($accountId);
        $accDomain->setDomainId($this->multiDomain->getId());

        $this->omMain->persist($accDomain);
        $this->omMain->flush($accDomain);
    }

    private function loginGoogle($token)
    {
        /* Getting user info */
        $client = new Client();
        $request = $client->get(self::GOOGLE_API, [
            'query' => [
                'id_token' => $token,
            ],
        ]);

        /* Decode the facebook content */
        $content = json_decode($request->getBody()->getContents(), true);

        $username = mb_strtolower('google::'.$content['email']);

        /* Checking if user is registered or not */
        /* @var Profile $profile */
        if ($account = $this->omMain->getRepository('CoreBundle:Account')->findOneBy(['username' => $username])) {
            return $account;
        }

        $data = [
            'id'              => $content['sub'],
            'email'           => $content['email'],
            'password'        => '',
            'firstname'       => $content['given_name'],
            'lastname'        => $content['family_name'],
            'username'        => $username,
            'image'           => ['url' => $content['picture'], 'height' => 96, 'width' => 96],
            'publish_contact' => 'n',
            'friendlyUrl'     => $this->friendlyUrlGenerator($content['given_name'].' '.$content['family_name']),
            'provider'        => $this->providers['google'],
        ];

        return $data;
    }

    private function loginFacebook($token)
    {
        /* Getting user info */
        $client = new Client();
        $request = $client->get(self::FACEBOOK_API, [
            'query' => [
                'access_token' => $token,
                'fields'       => 'first_name,last_name,email,birthday,picture.height(320)',
            ],
        ]);

        /* Decode the facebook content */
        $content = json_decode($request->getBody()->getContents(), true);

        /* Checking if user is registered or not */
        /* @var Profile $profile */
        if ($profile = $this->omMain->getRepository('CoreBundle:Profile')->findOneBy(['facebookUid' => $content['id']])) {
            return $profile->getAccount();
        }

        $username = mb_strtolower('facebook::'.preg_replace('/[^0-9a-zA-Z]/i', '',
                    $content['first_name'].$content['last_name'])).'_'.$content['id'];
        $data = [
            'id'              => $content['id'],
            'email'           => $content['email'],
            'password'        => '',
            'firstname'       => $content['first_name'],
            'lastname'        => $content['last_name'],
            'username'        => $username,
            'image'           => $content['picture']['data'],
            'publish_contact' => 'n',
            'friendlyUrl'     => $this->friendlyUrlGenerator($content['first_name'].' '.$content['last_name']),
            'provider'        => $this->providers['facebook'],
        ];

        return $data;
    }

    /**
     * @param Account $account
     * @param Contact $contact
     * @param AccountActivation $activate
     * @param array $data
     */
    private function sendUserNotification($account, $contact, $activate, $data)
    {
        try {
            /* getting notification object */
            $notification = $this->emailNotification->getEmailMessage(EmailNotificationService::VISITOR_ACCOUNT_CREATE);

            /* making login information */
            $info = $this->translator->trans('E-mail').": ".$account->getUsername().(strpos($notification->getMessage(), "<br />") !== false ? "<br />" : PHP_EOL);
            $info .= $this->translator->trans('Password').": ".$data['password'];

            $activeUrl = '';
            if ($activate instanceof AccountActivation) {
                $activeUrl = $this->request->getSchemeAndHttpHost().'/'.$this->memberAlias.'/login.php?activation_key='.$activate->getUniqueKey();
            } elseif (isset($data['provider'])) {
                $activeUrl = $this->translator->trans('Once you have created your account using a foreign system, it was activated automatically. Please disregard this message.');
            }

            $from_sitemgr = explode(',', $this->omDomain
                ->getRepository('WebBundle:Setting')
                ->getSetting('sitemgr_email'));

            /* replacing placeholders */
            $notification->setFrom($from_sitemgr[0], $this->multiDomain->getTitle());
            $notification->setTo($contact->getEmail());
            $notification->setPlaceholder('ACCOUNT_LOGIN_INFORMATION', $info);
            $notification->setPlaceholder('LINK_ACTIVATE_ACCOUNT', $activeUrl);
            $notification->setPlaceholder('ACCOUNT_NAME', $contact->getFirstName().' '.$contact->getLastName());

            /* sending message */
            $notification->sendEmail($errors);

            /* Sitemgr Notification */

            /* Sitemgr Emails to Send to */
            $sitemgrMail = explode(',', $this->omDomain
                ->getRepository('WebBundle:Setting')
                ->getSetting('sitemgr_account_email'));

            /* Making body information */
            $accountViewLink = $account->getIsSponsor() == "y" ? "sponsor/sponsor" : "visitor/visitor";
            $accountViewLink = $this->request->getSchemeAndHttpHost().'/sitemgr/account/'.$accountViewLink.'.php?id='.$account->getId();

            $body = $this->translator->trans('Site Manager').",<br/><br/>";
            $body .= $this->translator->trans('A new account was created in')." ".$this->multiDomain->getTitle().".<br />";
            $body .= $this->translator->trans('Please review the account information below').":<br /><br />";
            $body .= "<b>".$this->translator->trans('E-mail').": </b>".$account->getUsername()."<br />";
            $body .= "<b>".$this->translator->trans('First Name').": </b>".$contact->getFirstName()."<br />";
            $body .= "<b>".$this->translator->trans('Last Name').": </b>".$contact->getLastName()."<br />";
            $body .= "<b>".$this->translator->trans('Company').": </b>".$contact->getCompany()."<br />";
            $body .= "<b>".$this->translator->trans('Address').": </b>".$contact->getAddress()."<br />";
            $body .= "<b>".$this->translator->trans('City').": </b>".$contact->getCity()."<br />";
            $body .= "<b>".$this->translator->trans('State').": </b>".$contact->getState()."<br />";
            $body .= "<b>".$this->translator->trans('Zipcode').": </b>".$contact->getZip()."<br />";
            $body .= "<b>".$this->translator->trans('Phone').": </b>".$contact->getPhone()."<br />";
            $body .= "<b>".$this->translator->trans('Fax').": </b>".$contact->getFax()."<br />";
            $body .= "<b>".$this->translator->trans('Website').": </b>".$contact->getUrl()."<br />";
            $body .= "<a href=\"".$accountViewLink."\" target=\"_blank\">".$accountViewLink."</a><br /><br />";
            $body .= $this->multiDomain->getTitle();

            $test= Mailer::getSitemgrHtmlBody($body);

            /* sending message */
            Mailer::newMail($this->mailer, $this->settings)
                ->setSubject('['.$this->multiDomain->getTitle().'] '.$this->translator->trans('New Account'))
                ->setFrom($from_sitemgr[0], $this->multiDomain->getTitle())
                ->setTo($sitemgrMail)
                ->setBody(Mailer::getSitemgrHtmlBody($body), 'text/html', 'utf-8')
                ->send();

        } catch (\Exception $exception) {
            // Do Nothing here
        }
    }

    /**
     * @param Account $account
     * @return array
     * @throws \Twig_Error_Runtime
     */
    private function getAccount(Account $account)
    {
        $contact = $this->omMain->getRepository("CoreBundle:Contact")->find($account->getId());

        /* Checking if the account profile exist */
        if (!$profile = $this->omDomain->getRepository("WebBundle:Accountprofilecontact")->find($account->getId())) {
            /* Creates a new account profile */
            $mainProfile = $this->omMain->getRepository('CoreBundle:Profile')->findOneBy(['accountId' => $account->getId()]);
            $data = [
                'friendlyUrl' => $mainProfile->getFriendlyUrl(),
                'image'       => [
                    'url'    => $mainProfile->getFacebookImage(),
                ],
            ];

            if ($mainProfile->getFacebookImage()) {
                $data['provider'] = true;
            } else {
                $data['imageId'] = $mainProfile->getImageId();
            }

            $profile = $this->saveAccountProfileContact($account, $contact, $data);
            $this->saveAccountDomain($account->getId());
        }

        /* Image Url */
        $image = $this->request->getSchemeAndHttpHost().$this->assetsHelper->getUrl('assets/images/user-image.png');

        if (null != $profile->getImageId()) {
            $image = $this->twig_Environment->getExtension('image_extension')->getProfileImage($profile);
            $image = $this->request->getSchemeAndHttpHost().$this->assetsHelper->getUrl($image, 'profile_images');
        } elseif (null != $profile->getFacebookImage()) {
            $image = $profile->getFacebookImage();
        }

        $data = [
            'id'        => $account->getId(),
            'firstname' => $contact->getFirstName(),
            'lastname'  => $contact->getLastName(),
            'email'     => $contact->getEmail(),
            'image'     => $image,
        ];

        return ['data' => $data];
    }
}
