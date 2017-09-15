<?php
namespace ArcaSolutions\EventBundle\Services;

use ArcaSolutions\EventBundle\Search\EventConfiguration;
use Elastica\Aggregation\Terms;
use Elastica\Client;
use Elastica\Query\BoolQuery;
use Elastica\Query\Exists;
use Elastica\Query\Range;
use Elastica\Query\Script;
use Elastica\QueryBuilder;
use Elastica\Search;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class EventApi
 *
 * This class is an interface between API edirectory and symfony
 *
 * @package ArcaSolutions\EventBundle\Services
 */
class EventApi
{
    const MONTHS_NUMBER = 12;

    /**
     * @var ContainerInterface
     */
    private $container;

    private $searchSettings;

    /**
     * @param ContainerInterface $containerInterface
     */
    public function __construct(ContainerInterface $containerInterface, $searchSettings)
    {
        $this->container = $containerInterface;
        $this->searchSettings = $searchSettings;
    }

    /**
     * Returns an array with next events from today
     *
     * @param int $year
     * @param     $limit
     *
     * @return array
     */
    public function getDaysWithEventsInAnYear($year = null, $limit)
    {

        $begin = new \DateTime();

        // Parameters to be used in ES query
        $start = $begin->format("Y-m-d");
        $end = $begin->add(new \DateInterval("P2Y"))->format("Y-m-d");

        $scriptParams = [
            "field" => "recurrent_date",
            "start" => $start,
            "end" => $end
        ];


        // Aggregation
        $termsAgg = new Terms("doc_count");
        $termsAgg->setSize($limit);
        $termsAgg->setOrder("_term", "asc");
        $termsAgg->setScript(new \Elastica\Script\Script("occurrencesBetween", $scriptParams, "native"));


        // Creates query filter
        $builder = new QueryBuilder();
        $query = new BoolQuery();
        $query->addShould(
            $builder->query()->bool()
                ->addMustNot(new Exists("recurrent_date.rrule"))
                ->addMust(new Range("recurrent_date.start_date", ["gte" => $start]))
        );
        $query->addShould(
            $builder->query()->bool()
                ->addMust(new Exists("recurrent_date.rrule"))
                ->addFilter(new Script(new \Elastica\Script\Script("hasAnyOccurrenceBetween", $scriptParams, "native")))
        );


        // Creates query to be sent to elasticsearch
        $finalQuery = new \Elastica\Query();
        $finalQuery->setQuery($query);
        $finalQuery->addAggregation($termsAgg);

        $client = new Client($this->searchSettings["elasticsearch"]);
        $search = new Search($client);

        $indexName = $this->container->get("search.engine")->getElasticIndexName();
        $search->addIndex($indexName);

        $search->addType(EventConfiguration::$elasticType);
        $buckets = $search->search($finalQuery)->getAggregation("doc_count");

        $dates = [];
        foreach ($buckets["buckets"] as $bucket) {
            $dates[] = new \DateTime($bucket["key"]);
        }

        return $dates;

    }
}
