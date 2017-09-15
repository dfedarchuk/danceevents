<?php

namespace ArcaSolutions\WebBundle\Controller;

use ArcaSolutions\SearchBundle\Services\ParameterHandler;
use ArcaSolutions\WebBundle\Entity\Quicklist;
use ArcaSolutions\WebBundle\Services\TimelineHandler;
use ArcaSolutions\WysiwygBundle\Services\Wysiwyg;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $searchEngine = $this->get('search.engine');
        $JSHandler = $this->get("javascripthandler");

        $JSHandler->addTwigParameter('geolocationCookieName', $searchEngine->getGeoLocationCookieName());

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::HOME_PAGE);

        return $this->render('::base.html.twig', [
            'pageId'          => $page->getId(),
            'pageTitle'       => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords'    => $page->getMetaKey(),
            'customTag'       => $page->getCustomTag(),
        ]);
    }

    /**
     * Newsletter action
     *
     * Used to save news visitors
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function newsletterAction(Request $request)
    {
        // getting POST data
        $data = [
            'name'  => $request->get('name', ''),
            'email' => $request->get('email', ''),
        ];

        /* sets validators */
        $validator = Validation::createValidator();
        $constraint = new Assert\Collection([
            'email' => [
                new Assert\Email(),
                new Assert\NotBlank(),
            ],
            'name'  => [
                new Assert\NotBlank(),
            ],
        ]);
        $validation = $validator->validate($data, $constraint);

        if (count($validation) == 0) {

            // calling service
            $subscription = $this->get('subscription.mailer.service');
            $subscription->setAction('addSubscriber');
            $subscription->setSubscriberName($data['name']);
            $subscription->setSubscriberEmail($data['email']);
            $subscription->setSubscriberType('visitor');
            $subscription->sendSubscription();

            /* Creates sitemanager timeline entry */
            $this->container->get("timelinehandler")->add(
                0,
                TimelineHandler::ITEMTYPE_NEWSLETTER,
                TimelineHandler::ACTION_NEW
            );

            return JsonResponse::create([
                'success' => true,
                'message' => $this->get('translator')->trans('Check your e-mail to complete your subscription.'),
            ]);
        }

        $error = [];
        $error['success'] = false;
        for ($i = 0; $i < count($validation); $i++) {
            // getting field name
            preg_match('/[a-zA-Z]+/', $validation->get($i)->getPropertyPath(), $key);
            $key = current($key);

            // creating array of errors
            $error['errors'][] = [
                'field'   => $key,
                'message' => /** @Ignore */
                    $this->get('translator')->trans($validation->get($i)->getMessage(), [], 'validators'),
            ];
        }

        return JsonResponse::create($error);
    }

    /**
     * FAQ page
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function faqAction(Request $request)
    {
        $keyword = $request->query->get('keyword', '');

        if (empty($keyword)) {
            $faq = $this->get('doctrine')->getRepository('WebBundle:Faq')->findByFrontend('y');
        } else {
            $faq = $this->get('doctrine')->getRepository('WebBundle:Faq')->searchKeyword($keyword);
        }

        $this->get('javascripthandler')->addJSExternalFile('assets/js/pages/faq.js');

        $this->get('wysiwyg.service')->setModule('');

        $twig = $this->container->get("twig");

        $twig->addGlobal('questions', $faq);
        $twig->addGlobal('keyword', $keyword);

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::FAQ_PAGE);

        return $this->render('::base.html.twig', [
            'pageId'          => $page->getId(),
            'pageTitle'       => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords'    => $page->getMetaKey(),
            'customTag'       => $page->getCustomTag(),
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function termsAction()
    {
        $this->get('wysiwyg.service')->setModule('');

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::TERMS_OF_SERVICE_PAGE);

        return $this->render('::base.html.twig', [
            'pageId'          => $page->getId(),
            'pageTitle'       => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords'    => $page->getMetaKey(),
            'customTag'       => $page->getCustomTag(),
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function privacyAction()
    {
        $this->get('wysiwyg.service')->setModule('');

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::PRIVACY_POLICY_PAGE);

        return $this->render('::base.html.twig', [
            'pageId'          => $page->getId(),
            'pageTitle'       => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords'    => $page->getMetaKey(),
            'customTag'       => $page->getCustomTag(),
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function sitemapAction()
    {
        $repository = $this->get('search.repository.category');

        $sitemapContent = [
            'home'     => [
                'routing' => 'web_homepage',
                'title'   => $this->get('translator')->trans('Home'),
            ],
            'listings' => [
                'routing' => 'listing_homepage',
                'title'   => $this->get('translator')->trans('listings'),
                'child'   => [
                    'categories' => $repository->findCategoriesWithItens('listing'),

                    'routing'    => ParameterHandler::MODULE_LISTING,
                ],
            ],
        ];

        if ($this->container->get('modules')->isModuleAvailable('event')) {
            $sitemapContent['events'] = [
                'routing' => 'event_homepage',
                'title'   => $this->get('translator')->trans('events'),
                'child'   => [
                    'categories' => $repository->findCategoriesWithItens('event'),
                    'routing'    => ParameterHandler::MODULE_EVENT,
                ],
            ];
        }

        if ($this->container->get('modules')->isModuleAvailable('classified')) {
            $sitemapContent['classifieds'] = [
                'routing' => 'classified_homepage',
                'title'   => $this->get('translator')->trans('classifieds'),
                'child'   => [
                    'categories' => $repository->findCategoriesWithItens('classified'),
                    'routing'    => ParameterHandler::MODULE_CLASSIFIED,
                ],
            ];
        }

        if ($this->container->get('modules')->isModuleAvailable('article')) {
            $sitemapContent['articles'] = [
                'routing' => 'article_homepage',
                'title'   => $this->get('translator')->trans('articles'),
                'child'   => [
                    'categories' => $repository->findCategoriesWithItens('article'),
                    'routing'    => ParameterHandler::MODULE_ARTICLE,
                ],
            ];
        }

        if ($this->container->get('modules')->isModuleAvailable('promotion')) {
            $sitemapContent['deals'] = [
                'routing' => 'deal_homepage',
                'title'   => $this->get('translator')->trans('deals'),
                'child'   => [
                    'categories' => $repository->findCategoriesWithItens('deal'),
                    'routing'    => ParameterHandler::MODULE_DEAL,
                ],
            ];
        }

        if ($this->container->get('modules')->isModuleAvailable('blog')) {
            $sitemapContent['blog'] = [
                'routing' => 'blog_homepage',
                'title'   => $this->get('translator')->trans('Blog'),
                'child'   => [
                    'categories' => $repository->findCategoriesWithItens('blog'),
                    'routing'    => ParameterHandler::MODULE_BLOG,
                ],
            ];
        }

        $sitemapContentExtra = [
            'advertise' => [
                'routing' => '/'.$this->getParameter('alias_advertise_url_divisor'),
                'title'   => $this->get('translator')->trans('Advertise'),
            ],
            'faq'       => [
                'routing' => 'web_faq',
                'title'   => $this->get('translator')->trans('Faq'),
            ],
            'contactus' => [
                'routing' => 'web_contactus',
                'title'   => $this->get('translator')->trans('Contact Us'),
            ],
            'terms'     => [
                'routing' => 'web_terms',
                'title'   => $this->get('translator')->trans('Terms and Conditions'),
            ],
            'privacy'   => [
                'routing' => 'web_privacy',
                'title'   => $this->get('translator')->trans('Privacy Policy'),
            ],
        ];

        $sitemapContent = array_merge($sitemapContent, $sitemapContentExtra);

        $this->get('wysiwyg.service')->setModule('');

        $twig = $this->container->get("twig");

        $twig->addGlobal('contentType', Wysiwyg::SITEMAP_PAGE);
        $twig->addGlobal('contentSitemap', $sitemapContent);

        $page = $this->container->get('doctrine')
            ->getRepository('WysiwygBundle:Page')
            ->getPageByType(Wysiwyg::SITEMAP_PAGE);

        return $this->render('::base.html.twig', [
            'pageId'          => $page->getId(),
            'pageTitle'       => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords'    => $page->getMetaKey(),
            'customTag'       => $page->getCustomTag(),
        ]);
    }

    /**
     * Bookmark action, saves a item in a bookmark's list
     * Used in ajax
     *
     * @param Request $request
     * @param int $id
     * @param string $module This is being validated in the routing rules
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function bookmarkAction(Request $request, $id, $module = '')
    {
        /* gets user Id using profile credentials */
        $userId = $request->getSession()->get('SESS_ACCOUNT_ID');

        if (is_null($userId)) {
            /* shows login form */
            return JsonResponse::create([
                'status' => 'login',
                'url'    => '/profile/login.php?userperm=1&bookmark_remember='.$id,
            ]);
        }

        /* search if item was marked before */
        $item = $this->get('doctrine')->getRepository('WebBundle:Quicklist')->findOneBy([
            'accountId' => $userId,
            'itemId'    => $id,
            'itemType'  => $module,
        ]);

        try {
            $em = $this->get('doctrine')->getManager();

            /* it's a new record */
            if (is_null($item)) {
                $item = new Quicklist();
                $item->setAccountId($userId)
                    ->setItemId($id)
                    ->setItemType($module);

                $em->persist($item);
                $status = 'pinned';
            } else {
                /* delete a record */
                $em->remove($item);

                $status = 'unpinned';
            }

            $em->flush();
        } catch (\Exception $e) {
            $status = 'fail';
        }

        return JsonResponse::create([
            'status' => $status,
        ]);
    }
}
