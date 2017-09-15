<?php

namespace ArcaSolutions\WebBundle\Controller;

use ArcaSolutions\CoreBundle\Mailer\Mailer;
use ArcaSolutions\WebBundle\Form\Builder\EnquireBuilder;
use ArcaSolutions\WebBundle\Form\Type\EnquireType;
use ArcaSolutions\WebBundle\Services\LeadHandler;
use ArcaSolutions\WysiwygBundle\Services\Wysiwyg;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactusController extends Controller
{
    public function indexAction(Request $request)
    {
        /* Creates a new form */
        $form = $this->createForm(new EnquireType());

        /* Adds a captcha if not exist user logged */
        if (null === $request->getSession()->get('SESS_ACCOUNT_ID')) {
            $form->add('captcha', 'edirectory_captcha', []);
        }

        $folderCustomFields = $this->get('kernel')->getRootDir().'/../web/';
        $folderCustomFields .= $this->get('multi_domain.information')->getPath().'editor/lead/';

        /* Loads the custom fields */
        $customForm = new EnquireBuilder();
        $customForm->setFolder($folderCustomFields);
        $customForm->setFile('save.json');
        $customForm->setTranslator($this->container->get('translator'));
        $customForm->generate($form);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /* Send Mail for Admins */
            $sendTo = explode(',', $this->getDoctrine()
                ->getRepository('WebBundle:Setting')
                ->getSetting('sitemgr_contactus_email'));

            $translator = $this->get('translator');
            $name = $form->get('firstname')->getData().' '.$form->get('lastname')->getData();
            $subject = '['.$this->get('multi_domain.information')->getTitle().'] '.$translator->trans('New Inquire');
            $message = $customForm->serialize($form);

            Mailer::newMail($this->get('mailer'), $this->get('settings'))
                ->setSubject($subject.' - '.$form->get('subject')->getData())
                ->setFrom($form->get('email')->getData(), $name)
                ->setTo($sendTo)
                ->setReplyTo($form->get('email')->getData(), $name)
                ->setBody($this->renderView('::mailer/contactus.html.twig', [
                    'firstname' => $form->get('firstname')->getData(),
                    'lastname'  => $form->get('lastname')->getData(),
                    'email'     => $form->get('email')->getData(),
                    'phone'     => $form->get('phone')->getData(),
                    'message'   => $form->get('message')->getData(),
                ]), 'text/html')
                ->send();

            /* Creates a lead */
            $this->get("leadhandler")->add(
                LeadHandler::ITEMTYPE_GENERAL,
                0,
                $form->get('firstname')->getData(),
                $form->get('lastname')->getData(),
                $form->get('email')->getData(),
                $form->get('phone')->getData(),
                $form->get('subject')->getData(),
                $message
            );

            $translator = $this->get('translator');

            $this->addFlash('notice', [
                'alert'   => 'success',
                'title'   => $translator->trans('Success!'),
                'message' => $translator->trans('Thank you, we will be in touch shortly.'),
            ]);

            return $this->redirectToRoute('web_contactus');
        }

        /* Get twig */
        $twig = $this->container->get("twig");

        /* Settings Map */
        if ($this->container->get('settings')->getSettingGoogle('maps_status') == 'on'
            and $this->container->get('settings')->getDomainSetting('contact_latitude')
            and $this->container->get('settings')->getDomainSetting('contact_longitude')
        ) {
            /* New map defined */
            $map = $this->get('ivory_google_map.map');
            $map->setApiKey($this->container->get('settings')->getSettingGoogle('maps_key'));
            $map->setStylesheetOptions([
                'width'  => '98%',
                'height' => '240px',
            ]);

            $map->setCenter($this->container->get('settings')->getDomainSetting('contact_latitude'),
                $this->container->get('settings')->getDomainSetting('contact_longitude'));

            $map->setMapOption('zoom', 15);

            $marker = $this->get('ivory_google_map.marker');
            $marker->setPosition($this->container->get('settings')->getDomainSetting('contact_latitude'),
                $this->container->get('settings')->getDomainSetting('contact_longitude'), true);
            $marker->setOptions([
                'clickable' => false,
                'flat'      => true,
            ]);

            $map->addMarker($marker);

            $twig->addGlobal('map', $map);
        }

        $this->get('wysiwyg.service')->setModule('');

        $contact = [
            'company' => $this->container->get('settings')->getDomainSetting('contact_company'),
            'address' => $this->container->get('settings')->getDomainSetting('contact_address'),
            'zipcode' => $this->container->get('settings')->getDomainSetting('contact_zipcode'),
            'country' => $this->container->get('settings')->getDomainSetting('contact_country'),
            'state'   => $this->container->get('settings')->getDomainSetting('contact_state'),
            'city'    => $this->container->get('settings')->getDomainSetting('contact_city'),
            'phone'   => $this->container->get('settings')->getDomainSetting('contact_phone'),
            'fax'     => $this->container->get('settings')->getDomainSetting('contact_fax'),
            'email'   => $this->container->get('settings')->getDomainSetting('contact_email'),
            'mapzoom' => $this->container->get('settings')->getDomainSetting('contact_mapzoom')
        ];

        $twig->addGlobal('form', $form->createView());
        $twig->addGlobal('contact', $contact);

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::CONTACT_US_PAGE);

        return $this->render('::base.html.twig', [
            'pageId'          => $page->getId(),
            'pageTitle' => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords' => $page->getMetaKey(),
            'customTag' => $page->getCustomTag()
        ]);
    }
}
