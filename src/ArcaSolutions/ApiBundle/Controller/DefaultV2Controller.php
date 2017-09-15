<?php


namespace ArcaSolutions\ApiBundle\Controller;

use ArcaSolutions\ClassifiedBundle\Entity\Classified;
use ArcaSolutions\ApiBundle\Documents\ConfigDocument;
use ArcaSolutions\CoreBundle\Kernel\Kernel;
use ArcaSolutions\SearchBundle\Exceptions\NotFoundException;
use Elastica\Suggest;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Util\Codes;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

class DefaultV2Controller extends DefaultController
{
    /**
     * @ApiDoc(
     *     description="Deprecated Resource. Substituted by suggest/what."
     * )
     *
     * @param Request $request
     * @return array|void
     * @throws NotFoundException
     */
    public function getSuggestAction(Request $request)
    {
        throw new NotFoundException();
    }

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="Get elasticsearch suggestions for the given keyword.",
     *     method="GET",
     *     statusCodes={
     *       Codes::HTTP_OK = "Returned Suggestions",
     *     },
     *     output={
     *       "class"="\ArcaSolutions\ApiBundle\Entity\Suggest",
     *       "groups"={"Suggest"},
     *       "parsers"={"Nelmio\ApiDocBundle\Parser\JmsMetadataParser"}
     *     },
     *     parameters={
     *       {"name" = "q", "dataType" = "string", "required" = false, "description" = "Keyword to search for suggestions", "format" = "([\w]+\s)+"},
     *     }
     * )
     *
     * @param Request $request
     * @return array
     * @View(serializerGroups={"Suggest"})
     */
    public function getSuggestWhatAction(Request $request)
    {
        $data = [];

        if ($keyword = $request->get("q")) {
            $suggestionName = "search";

            $searchEngine = $this->get("search.engine");

            $elasticaClient = $searchEngine->getElasticaClient();
            $indexName = $this->get("search.engine")->getElasticIndexName();
            $elasticaIndex = $elasticaClient->getIndex($indexName);

            $suggest = new Suggest();
            $suggestion = new Suggest\Completion($suggestionName, "suggest.what");
            $suggestion->setText($keyword);

            $suggest->addSuggestion($suggestion);

            $result = $elasticaIndex->search($suggest);

            if ($matches = $result->getSuggests()) {
                foreach ($matches[$suggestionName] as $match) {
                    foreach ($match['options'] as $option) {
                        $data[] = new \ArcaSolutions\ApiBundle\Entity\Suggest($option);
                    }
                }
            }
        }

        return ["data" => $data];
    }

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="Get elasticsearch location suggestions for the given keyword.",
     *     method="GET",
     *     statusCodes={
     *       Codes::HTTP_OK = "Returned Location Suggestions",
     *     },
     *     output={
     *       "class"="\ArcaSolutions\ApiBundle\Entity\Suggest",
     *       "groups"={"Suggest"},
     *       "parsers"={"Nelmio\ApiDocBundle\Parser\JmsMetadataParser"}
     *     },
     *     parameters={
     *       {"name" = "q", "dataType" = "string", "required" = false, "description" = "Keyword to search for location suggestions", "format" = "([\w]+\s)+"},
     *     }
     * )
     *
     * @param Request $request
     * @return array
     * @View(serializerGroups={"Suggest"})
     */
    public function getSuggestWhereAction(Request $request)
    {
        $data = [];

        if ($where = $request->get("q")) {
            $suggestionName = "search";

            $searchEngine = $this->get("search.engine");

            $elasticaClient = $searchEngine->getElasticaClient();
            $indexName = $this->get("search.engine")->getElasticIndexName();
            $elasticaIndex = $elasticaClient->getIndex($indexName);

            $suggest = new Suggest();
            $suggestion = new Suggest\Completion($suggestionName, "suggest.where");
            $suggestion->setText($where);

            $suggest->addSuggestion($suggestion);

            $result = $elasticaIndex->search($suggest);

            if ($matches = $result->getSuggests()) {
                foreach ($matches[$suggestionName] as $match) {
                    foreach ($match['options'] as $option) {
                        $data[] = new \ArcaSolutions\ApiBundle\Entity\Suggest($option);
                    }
                }
            }
        }

        return ["data" => $data];
    }

    /**
     * Return the general configuration of app
     *
     * @ApiDoc(
     *     resource = true,
     *     description = "Return the General Configuration of the App",
     *     statusCodes = {
     *       200 = "Returned when successful",
     *       500 = "Colors Unselected|Internal Server Error"
     *     }
     * )
     *
     * @View(serializerGroups={"generalConfigs"})
     * @param Request $request
     * @return array
     */
    public function getConfigAction(Request $request)
    {
        $return = parent::getConfigAction($request);

        $configDocument = new ConfigDocument(
            $request,
            $this->get('settings'),
            $this->get('translator'),
            $this->getDoctrine(),
            $this->get('templating.helper.assets'),
            $this->get('modules')
        );

        $newItens = [
            'previewer' => $configDocument->getPreviewer(),
            'version'   => Kernel::API_VERSION,
        ];

        return array_merge($return, $newItens);
    }

    /**
     * @ApiDoc(
     *     resource= true,
     *     description = "Get classified detail",
     *     method = "GET",
     *     statusCodes = {
     *       Codes::HTTP_OK = "Return the Classified detail",
     *       Codes::HTTP_NOT_FOUND = "Classified not found",
     *     },
     *     output={
     *       "class"="\ArcaSolutions\ClassifiedBundle\Entity\Classified",
     *       "groups"={"classifiedDetail"},
     *       "parsers"={"Nelmio\ApiDocBundle\Parser\JmsMetadataParser"}
     *     },
     *     parameters={
     *       {"name" = "account_id", "dataType" = "integer", "required" = false, "description" = "Account id of user", "format" = "\d+"},
     *     },
     *     requirements={
     *       {"name" = "classified", "dataType" = "integer", "description" = "Classified id", "requirement" = "\d+"},
     *     }
     * )
     * @param Classified $classified
     * @return array
     * @throws \Exception*
     * @View(serializerGroups={"classifiedDetail", "classifiedDetailV2"})
     * @ParamConverter("classified", class="ClassifiedBundle:Classified")
     */
    public function getClassifiedAction(Classified $classified)
    {
        return parent::getClassifiedAction($classified);
    }


}
