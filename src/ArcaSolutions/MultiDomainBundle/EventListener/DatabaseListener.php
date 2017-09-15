<?php

namespace ArcaSolutions\MultiDomainBundle\EventListener;


use ArcaSolutions\MultiDomainBundle\Services\Settings;
use Doctrine\DBAL\Connection;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class DatabaseListener
 *
 * @package ArcaSolutions\MultiDomainBundle\EventListener
 */
class DatabaseListener
{
    /**
     * @var Settings
     */
    private $multidomain;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * DatabaseListener constructor.
     *
     * @param Settings $multidomain
     * @param Connection $connection
     * @param TranslatorInterface $translator
     * @param Logger $logger
     */
    public function __construct(
        Settings $multidomain,
        Connection $connection,
        TranslatorInterface $translator,
        Logger $logger
    ) {
        $this->multidomain = $multidomain;
        $this->connection = $connection;
        $this->translator = $translator;
        $this->logger = $logger;
    }

    /**
     * Kernel Request Event
     *
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        $domain_locale = $this->multidomain->getLocale();
        $this->translator->setLocale($domain_locale);
        $request->setLocale($request->getPreferredLanguage([$domain_locale]));

        $connection = $this->connection;
        $params = $this->connection->getParams();
        $dbname = $this->multidomain->getDatabase();

        if ($dbname != $params['dbname']) {
            $params['dbname'] = $dbname;
            if ($connection->isConnected()) {
                $connection->close();
            }

            $connection->__construct($params, $connection->getDriver(), $connection->getConfiguration(),
                $connection->getEventManager());

            try {
                $connection->connect();
            } catch (\Exception $e) {
                $this->logger->error('Error changing the database name');
            }
        }
    }
}
