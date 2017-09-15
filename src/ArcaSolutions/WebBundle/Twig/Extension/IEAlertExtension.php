<?php

namespace ArcaSolutions\WebBundle\Twig\Extension;

use Symfony\Component\HttpFoundation\Request;

class IEAlertExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('alertIEOlderThan', [$this, 'alertIEOlderThan'], [
                'needs_environment' => true,
                'is_safe' => ['html']
            ])
        ];
    }

    /**
     * Twig extension that show a warning message about IE version
     *
     * @param \Twig_Environment $twig
     * @param int $version
     *
     * @return string
     */
    public function alertIEOlderThan(\Twig_Environment $twig, $version = 9)
    {
        $request = Request::createFromGlobals();

        $version_string = implode('|', range(6, $version));
        $match = preg_match('/(MSIE) ?(' . $version_string . ')/i', $request->headers->get('user-agent'));

        if ($match > 0) {
            return $twig->render('::blocks/iealert.html.twig');
        }

        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'iealert';
    }
}
