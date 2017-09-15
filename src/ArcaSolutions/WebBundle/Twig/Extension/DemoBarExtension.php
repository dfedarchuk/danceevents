<?php

namespace ArcaSolutions\WebBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class DemoBarExtension extends \Twig_Extension
{
    /**
     * ContainerInterface
     * @var object
     */
    protected $container;

    /**
     * @param $container ,
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('demobar',[$this,'demobar'],[
                'needs_environment' => true,
                'is_safe' => ['html']
            ]),
        ];
    }

    public function demobar(\Twig_Environment $twig)
    {
        $variables = array();

        $variables['live_chat_key'] = 1359902;

        $request = Request::createFromGlobals();
        $variables['is_sitemgr']
            = strpos($request->getUri(), 'sitemgr') === true ? : false;

        /*
         * sets urls for portuguese and changes phone namber
         */
        if ($this->container->get('request')->getLocale() == 'pt_BR') {
            $variables['live_chat_key'] = 4990041;
            $variables['default_url'] = 'http://www.demodirectory.com.br';
            $variables['realestate_url']
                = 'http://guiadeimobiliaria.demodirectory.com.br/';
            $variables['diningguide_url']
                = 'http://guiaderestaurante.demodirectory.com.br/';
            $variables['contractors_url']
                = 'http://contractors.demodirectory.com';
            $variables['phone_number'] = '14 3226 1898';

            $variables['order_url'] = 'https://www.edirectory.com.br/pedidos/';
            $variables['guided_demo_url']
                = 'http://www.edirectory.com/online-directory-software-trial/';
            $variables['iphone_android_url']
                = 'http://www.edirectory.com.br/recursos-diretorios-online/edirectory-mobile/';
            $variables['custom_theme_url']
                = 'http://www.edirectory.com.br/recursos-diretorios-online/temas-do-edirectory/';
        } else {
            $variables['default_url'] = 'http://www.demodirectory.com';
            $variables['realestate_url']
                = 'http://realestate.demodirectory.com/';
            $variables['diningguide_url']
                = 'http://diningguide.demodirectory.com/';
            $variables['contractors_url']
                = 'http://contractors.demodirectory.com';
            $variables['phone_number'] = '1-800-630-4694';

            $variables['order_url'] = 'https://www.edirectory.com/orders/';
            $variables['guided_demo_url']
                = 'http://www.edirectory.com/online-directory-software-trial/';
            $variables['iphone_android_url']
                = 'http://www.edirectory.com/mobile/';
            $variables['custom_theme_url']
                = 'http://www.edirectory.com/online-directory-software-features/directory-software-graphical-templates/';
        }

        return $twig->render('::blocks/demobar.html.twig', $variables);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'demobar';
    }
}
