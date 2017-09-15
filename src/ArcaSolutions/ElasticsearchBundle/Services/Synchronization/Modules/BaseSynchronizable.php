<?php

namespace ArcaSolutions\ElasticsearchBundle\Services\Synchronization\Modules;

use ArcaSolutions\CoreBundle\Services\Utility;
use ArcaSolutions\ElasticsearchBundle\Services\Synchronization\Synchronization;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class BaseSynchronizable
{
    /**
     * @var string[]
     */
    protected $upsertStash = [];
    /**
     * @var string[]
     */
    protected $deleteStash = [];
    /**
     * @var string[]
     */
    protected $viewUpdateStash = [];
    /**
     * @var string[]
     */
    protected $averageReviewUpdateStash = [];
    /**
     * @var string[]
     */
    protected $idFormat = "%d";

    /**
     * The filename and path to the Query associated to this module
     * @var string
     */
    protected $SQLQueryFile = null;
    /**
     * The condition to limit this query. Usually follows the format: "WHERE id IN ( $s )"
     * @var string
     */
    protected $SQLConditional = null;
    /**
     * The name of the service associated to the BaseConfiguration of this module
     * @var string
     */
    protected $configurationService = null;
    /**
     * The id of the Database where data about this module should be fetched from.
     * Refer to the constants in the Synchronization class for more information
     * @var int
     */
    protected $databaseType = Synchronization::DATABASE_DOMAIN;

    const DOCUMENT_UPSERT = 1;
    const ID_UPSERT = 2;

    /**
     * Stores a numeric representation of the format in which data is stored inside uspertStash
     * @var int
     */
    protected $upsertFormat = self::ID_UPSERT;

    const DELETE_ID_PREFORMATTED = 1;
    const DELETE_ID_RAW = 2;

    /**
     * Stores a numeric representation of the format in which data is stored inside deleteStash
     * @var int
     */
    protected $deleteFormat = self::DELETE_ID_RAW;

    /**
     * @var ContainerInterface
     */
    protected $container;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->container->get('elasticsearch.synchronization')->addItem($this);
    }

    /**
     * Returns the filename of the SQL update query associated with this module
     * @return string|null
     */
    public function getSQLQueryFile()
    {
        return $this->SQLQueryFile;
    }

    /**
     * Returns the SQL conditional to be appended to the SQL Query
     * @return string|null
     */
    public function getSQLConditional()
    {
        return $this->SQLConditional;
    }

    /**
     * Returns the service id of the BaseConfiguration associated with this module
     * @return null
     */
    public function getConfigurationService()
    {
        return $this->configurationService;
    }

    /**
     * Returns the type of database needed for this synchronization.
     *
     * @return int
     */
    public function getDatabaseType()
    {
        return $this->databaseType;
    }

    /**
     * Gets all items in the total update queue.
     * @return \string[]
     */
    public function getUpsertStash()
    {
        return array_keys($this->upsertStash);
    }

    /**
     * Inserts an item Id in the update queue. This function will update the item information in Elasticsearch
     * @param $ids
     */
    public function addUpsert($ids)
    {
        if ($ids and $ids = (array)$ids) {
            foreach ($ids as $id) {

                if (!array_key_exists($id, $this->deleteStash)) {
                    $this->upsertStash[$id] = $id;
                }

                /* Some places are brilliantly adding the same item multiple times for update. When this happens after
                an exclusion, the item is re-added and shows up even when it shouldn't. So I'm removing this for now.
                Deletion is final */
//                unset($this->deleteStash[$id]);
                unset($this->viewUpdateStash[$id]);
                unset($this->averageReviewUpdateStash[$id]);
            }

            if (count($this->upsertStash) > Synchronization::BULK_THRESHOLD) {
                $this->container->get('elasticsearch.synchronization')->synchronize();
            }
        }
    }

    /**
     * Gets all items in the death row.
     * @return array
     */
    public function getDeleteStash()
    {
        return array_keys($this->deleteStash);
    }

    /**
     * Inserts an item Id in the delete queue. This function will remove the item from Elasticsearch
     * @param $ids
     */
    public function addDelete($ids)
    {
        if ($ids and $ids = (array)$ids) {
            foreach ($ids as $id) {
                if ($this->deleteFormat == static::DELETE_ID_RAW) {
                    $id = $this->normalizeId($id);
                }

                $this->deleteStash[$id] = $id;

                unset($this->upsertStash[$id]);
                unset($this->viewUpdateStash[$id]);
                unset($this->averageReviewUpdateStash[$id]);
            }

            if (count($this->deleteStash) > Synchronization::BULK_THRESHOLD) {
                $this->container->get('elasticsearch.synchronization')->synchronize();
            }
        }
    }

    /**
     * Gets all items which need to have their view count updated.
     * @return array
     */
    public function getViewUpdateStash()
    {
        return array_keys($this->viewUpdateStash);
    }

    /**
     * Inserts an item Id in the update queue. This function will update the item's view count in Elasticsearch
     * @param $ids
     */
    public function addViewUpdate($ids)
    {
        if ($ids and $ids = (array)$ids) {
            foreach ($ids as $id) {
                $id = $this->normalizeId($id);

                if (empty($this->upsertStash[$id]) and empty($this->deleteStash[$id])) {
                    $this->viewUpdateStash[$id] = $id;
                }
            }

            if (count($this->viewUpdateStash) > Synchronization::BULK_THRESHOLD) {
                $this->container->get('elasticsearch.synchronization')->synchronize();
            }
        }
    }

    /**
     * Gets all items which need to have their average review updated.
     * @return array
     */
    public function getAverageReviewUpdateStash()
    {
        return $this->averageReviewUpdateStash;
    }

    /**
     * Inserts an item Id in the update queue. This function will update the item's Average Review in Elasticsearch
     * @param $id
     * @param $value
     */
    public function addAverageReviewUpdate($id, $value)
    {
        if ($id = $this->normalizeId($id)) {

            if (empty($this->upsertStash[$id]) and empty($this->deleteStash[$id])) {
                $this->averageReviewUpdateStash[$id] = $value;
            }

            if (count($this->averageReviewUpdateStash) > Synchronization::BULK_THRESHOLD) {
                $this->container->get('elasticsearch.synchronization')->synchronize();
            }
        }
    }

    /**
     * Returns an integer representation of the format in which data is stored inside the update stash
     * @return int
     */
    public function getUpsertFormat()
    {
        return $this->upsertFormat;
    }

    /**
     * Returns an integer representation of the format in which ids are stored inside the delete stash
     * @return int
     */
    public function getDeleteFormat()
    {
        return $this->deleteFormat;
    }

    /**
     * Empties the upsert stash
     */
    public function clearUpsertStash()
    {
        $this->upsertStash = [];
    }

    /**
     * Empties the delete stash
     */
    public function clearDeleteStash()
    {
        $this->deleteStash = [];
    }

    /**
     * Empties the view update stash
     */
    public function clearViewUpdateStash()
    {
        $this->viewUpdateStash = [];
    }


    /**
     * Empties the average review update stash
     */
    public function clearAverageReviewUpdateStash()
    {
        $this->averageReviewUpdateStash = [];
    }

    /**
     * Creates an array with the same structure as the elasticsearch type mapping on the index, in order to index
     * information properly
     * @param $infoArray
     * @return mixed
     */
    public function extractFromResult($infoArray)
    {
        $jsonObject = [];

        foreach ($infoArray as $key => $value) {
            $output = null;

            Utility::assignArrayByPath($output, $key, $value, ".");
            $jsonObject = array_merge_recursive($output, $jsonObject);
        }

        return $jsonObject;
    }

    /**
     * Transforms a numeric id into a string which represents the id format in the elasticsearch database
     * @param $id
     * @return string
     */
    public function normalizeId($id)
    {
        return sprintf($this->idFormat, (int)$id);
    }
}
