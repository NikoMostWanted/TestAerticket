<?php
declare(strict_types=1);

namespace App\Controller;

use App\Form\RequestFilter\SearchRequestFilter;
use App\Form\SearchType;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

/**
 * Class FlightController
 *
 * @package App\Controller
 *
 * @Route("flight")
 * @SWG\Tag(name="Flight")
 */

final class FlightController extends AController
{
    /**
     * @Route("", methods={"GET"})
     *
     * @SWG\Get(summary="Get flight collection",
     *     @SWG\Response(
     *          response=200,
     *          description="OK"
     *     ),
     *     @SWG\Parameter(
     *          name="filter[name]",
     *          in="query",
     *          type="string",
     *          required=false
     *     ),
     *     @SWG\Parameter(
     *          name="pagination[limit]",
     *          in="query",
     *          type="string",
     *          required=false
     *     ),
     *     @SWG\Parameter(
     *          name="pagination[page]",
     *          in="query",
     *          type="string",
     *          required=false
     *     ),
     *      @SWG\Parameter(
     *          name="order[name]",
     *          in="query",
     *          type="string",
     *          required=false,
     *          enum={0:"ASC", 1:"DESC"},
     *      ),
     *     @SWG\Parameter(
     *          name="Authorization",
     *          in="header",
     *          type="string",
     *          required=false,
     *          description="OAuth2 token"
     *     )
     * )
     *
     * @param Request $request
     * @return Response
     * @throws \App\Core\Exception\EFormWrongRequest
     */
    public function getCollection(Request $request): Response
    {
        /** @var SearchRequestFilter $searchRequest */
        $searchRequest = $this->validateRequestData(SearchType::class, $request->query->all())->getData();

        return $this->response(['ok']);
    }
}