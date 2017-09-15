<?php
/**
 * Created by PhpStorm.
 * User: betorcs
 * Date: 21/11/16
 * Time: 13:58
 */

namespace ArcaSolutions\SearchBundle\Entity\ScriptFields;


use ArcaSolutions\SearchBundle\Events\SearchEvent;
use ArcaSolutions\SearchBundle\Services\ParameterHandler;
use Elastica\Script\Script;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class NextOccurrenceScriptField implements EventSubscriberInterface
{

    /**
     * @var Container
     */
    protected $container;

    function __construct($container)
    {
        $this->container = $container;
    }

    public static function getSubscribedEvents()
    {
        return [
            'search.global' => 'registerItem'
        ];
    }

    public function registerItem(SearchEvent $searchEvent, $eventName)
    {
        $params = ["field" => "recurrent_date"];
        $parameterInfo = $this->container->get("search.parameters");
        if ($startDate = $parameterInfo->getStartDate()) {
            $startDate->setTime(0, 0, 0);
            $params["from"] = $startDate->format("Y-m-d");
        }
        $searchEvent->addElasticaScriptField("nextOccur", new Script("nextOccurrence", $params, "native"));
    }

}