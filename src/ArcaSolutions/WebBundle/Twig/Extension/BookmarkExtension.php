<?php
namespace ArcaSolutions\WebBundle\Twig\Extension;

use ArcaSolutions\ArticleBundle\Entity\Article;
use ArcaSolutions\ClassifiedBundle\Entity\Classified;
use ArcaSolutions\EventBundle\Entity\Event;
use ArcaSolutions\ListingBundle\Entity\Listing;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class BookmarkExtension extends \Twig_Extension
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $containerInterface
     */
    public function __construct(ContainerInterface $containerInterface)
    {
        $this->container = $containerInterface;
    }

    /**
     * Returns extension function's names
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('bookmarkLink', [$this, 'bookmarkLink'], [
                'needs_environment' => true,
                'is_safe'           => ['html']
            ]),
            new \Twig_SimpleFunction('bookmarkButton', [$this, 'bookmarkButton'], [
                'needs_environment' => true,
                'is_safe'           => ['html']
            ]),
            new \Twig_SimpleFunction('bookmark', [$this, 'bookmark'], [
                'needs_environment' => true,
                'is_safe'           => ['html']
            ]),

        ];
    }

    /**
     * @param \Twig_Environment $twig_Environment
     * @param null              $item
     *
     * @param string            $module
     *
     * @return string
     * @throws \Exception
     */
    public function bookmarkLink(\Twig_Environment $twig_Environment, $item = null, $module = '')
    {
        return $this->bookmark($twig_Environment, $item, $module, 'link');
    }

    /**
     * @param \Twig_Environment                $twig_Environment
     * @param Event|Listing|Classified|Article $item
     * @param string                           $module
     * @param string                           $type
     *
     * @return string
     * @throws \Exception
     */
    public function bookmark(\Twig_Environment $twig_Environment, $item = null, $module = '', $type = 'link')
    {
        if (is_null($item)) {
            throw new \Exception('You must pass a item to the function');
        }

        $js = '::js/bookmark/bookmark.js.twig';
        if (!$this->container->get('javascripthandler')->getJSBlock($js)) {
            $this->container->get('javascripthandler')->addJSExternalFile('assets/js/lib/js.cookie.js')
                ->addJSBlock($js);
        }

        $marked = $this->container->get('user.bookmark.service')->checkItem($item, $module);

        return $twig_Environment->render('::blocks/bookmark/' . $type . '.html.twig', [
            'id'     => $item->getId(),
            'marked' => $marked,
            'module' => $module
        ]);
    }

    /**
     * @param \Twig_Environment $twig_Environment
     * @param null              $item
     *
     * @param string            $module
     *
     * @return string
     * @throws \Exception
     */
    public function bookmarkButton(\Twig_Environment $twig_Environment, $item = null, $module = '')
    {
        return $this->bookmark($twig_Environment, $item, $module, 'button');
    }

    /**
     * Returns extension name
     */
    public function getName()
    {
        return 'bookmark_extension';
    }
}
