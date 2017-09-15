<?php

namespace ArcaSolutions\EventBundle\Controller;


use ArcaSolutions\EventBundle\Search\EventConfiguration;
use Elastica\Aggregation\Terms;
use Elastica\Client;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Exists;
use Elastica\Query\Range;
use Elastica\QueryBuilder;
use Elastica\Script\Script as Script;
use Elastica\Query\Script as QueryScript;
use Elastica\Search;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CalendarController
 *
 * @package ArcaSolutions\EventBundle\Controller
 */
class CalendarController extends Controller
{
    /**
     * Get all dates that have an event
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function eventsAction(Request $request)
    {
        /* Creates date */
        $startDate = \DateTime::createFromFormat('U', ($request->get('from') / 1000))->format("Y-m-d");
        $endDate = \DateTime::createFromFormat('U', ($request->get('to') / 1000))->format("Y-m-d");

        $scriptParams = [
            "field" => "recurrent_date",
            "start" => $startDate,
            "end"   => $endDate,
        ];

        // Aggregation
        $termsAgg = new Terms("doc_count");
        $termsAgg->setSize(0);
        $termsAgg->setOrder("_term", "asc");
        $termsAgg->setScript(new Script("occurrencesBetween", $scriptParams, "native"));


        // Creates query filter
        $builder = new QueryBuilder();
        $query = new BoolQuery();
        $query->addShould(
            $builder->query()->bool()
                ->addMustNot(new Exists("recurrent_date.rrule"))
                ->addMust(new Range("recurrent_date.start_date", ["gte" => $startDate]))
        );
        $query->addShould(
            $builder->query()->bool()
                ->addMust(new Exists("recurrent_date.rrule"))
                ->addFilter(new QueryScript(new Script("hasAnyOccurrenceBetween", $scriptParams, "native")))
        );

        // Creates query to be sent to elasticsearch
        $finalQuery = new Query();
        $finalQuery->setQuery($query);
        $finalQuery->addAggregation($termsAgg);

        $esConfig = $this->getParameter('search.config');
        $client = new Client($esConfig['elasticsearch']);
        $search = new Search($client);

        $indexName = $this->container->get("search.engine")->getElasticIndexName();
        $search->addIndex($indexName);

        $search->addType(EventConfiguration::$elasticType);
        $buckets = $search->search($finalQuery)->getAggregation('doc_count');

        $dates = [];
        foreach ($buckets["buckets"] as $bucket) {
            $eventDate = new \DateTime($bucket["key"]);
            $dates[] = [
                'id'    => count($dates),
                'start' => $eventDate->getTimestamp().'000',
                'url'   => $this->generateUrl('global_search_2',
                    [
                        'a0' => $this->getParameter('alias_event_module'),
                        'a1' => $eventDate->format($this->container->get("filter.date")->getUrlDateFormat()),
                    ]),
            ];
        }

        return JsonResponse::create(['success' => 1, 'result' => $dates]);
    }
}
