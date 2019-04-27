<?php
declare(strict_types=1);

namespace App\Controller;

use App\Form\RequestFilter\SearchRequestFilter;
use App\Form\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SearchController
 *
 * @package App\Controller
 */
final class SearchController extends AController
{
    /**
     * @Route("base-search", methods={GET})
     *
     * @param Request $request
     * @return Response
     * @throws \App\Core\Exception\EFormWrongRequest
     */
    public function baseSearchAction(Request $request): Response
    {
        /** @var SearchRequestFilter $searchRequest */
        $searchRequest = $this->validateRequestData(SearchType::class, $request->query->all())->getData();

        return $this->response(['ok']);
    }
}