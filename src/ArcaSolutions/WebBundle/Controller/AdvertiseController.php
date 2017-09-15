<?php

namespace ArcaSolutions\WebBundle\Controller;


use ArcaSolutions\WysiwygBundle\Services\Wysiwyg;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdvertiseController extends Controller
{
    /**
     * Advertise Home Page
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        /* Sets the modules and active tab */
        $modulesObj = $this->get('modules');
        $activeTab = 'listing';
        $modules = ['listing'];

        foreach ($modulesObj->getAvailableModulesLevel() as $module => $available) {
            if ($available && !in_array($module, ['listing', 'promotion', 'blog'])) {
                if ($request->query->get($module)) {
                    $activeTab = $request->query->get($module);
                }

                $modules[] = $module;
            }
        }

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::ADVERTISE_PAGE);

        $twig = $this->container->get('twig');
        $twig->addGlobal('modules', $modules);
        $twig->addGlobal('activeTab', $activeTab);

        return $this->render('::base.html.twig', [
            'pageId'          => $page->getId(),
            'pageTitle'       => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords'    => $page->getMetaKey(),
            'customTag'       => $page->getCustomTag(),
        ]);
    }
}
