<?php

namespace App\Controller;
use ApiPlatform\Core\Annotation\ApiResource;
use Artprima\QueryFilterBundle\QueryFilter\Config\BaseConfig;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
use Artprima\QueryFilterBundle\Request\Request;
use Artprima\QueryFilterBundle\QueryFilter\QueryFilter;
use Artprima\QueryFilterBundle\Response\Response;
use App\Repository\ModelSpecificationRepository;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @ApiResource()
 * Class deviceMetricController
 * @package App\Controller
 */
class deviceMetricController extends AbstractController
{
    //...

    /**
     * @Route("/api/device")
     * @param HttpRequest $request
     * @param ModelSpecificationRepository $repository
     */
    public function deviceMetric(HttpRequest $request, ModelSpecificationRepository $repository)
    {
        // set up the config
        $config = new BaseConfig();
        $config->setSearchAllowedCols(['d.model','d.ram','d.model_location','d.hdd_value','d.hdd_unit','d.hdd_type']);
        $config->setAllowedLimits([10, 25, 50, 100]);
        $config->setDefaultLimit(10);
        $config->setSortCols(['d.id'], ['d.id' => 'asc']);
        $config->setRequest(new Request($request));

        // Throws an UnexpectedValueException when invalid filter column, sort column or sort type is specified
        $config->setStrictColumns(true);

        // here we provide a repository callback that will be used internally in the QueryFilter
        // The signature of the method must be as follows: function functionName(QueryFilterArgs $args): QueryResult;
        $config->setRepositoryCallback([$repository, 'findByOrderBy']);

        // Response must implement Artprima\QueryFilterBundle\Response\ResponseInterface
        $queryFilter = new QueryFilter(Response::class);
        /** @var Response $data the type of the variable is defined by the class in the first argument of QueryFilter's constructor */
        $response = $queryFilter->getData($config);
        $data = $response->getData();
        $meta = $response->getMeta();

        return $this->json(['data'=>$data,'meta'=>$meta]);
    }

}