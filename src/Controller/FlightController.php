<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Extra\EGroups;
use App\Form\SearchFlightType;
use App\Repository\AirTransport\FlightRepository;
use Swagger\Annotations as SWG;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     *          name="filters[departureAirport]",
     *          in="query",
     *          type="string",
     *          required=true,
     *          default="departureAirport"
     *     ),
     *     @SWG\Parameter(
     *          name="filters[arrivalAirport]",
     *          in="query",
     *          type="string",
     *          required=true,
     *          default="arrivalAirport"
     *     ),
     *     @SWG\Parameter(
     *          name="filters[departureDate]",
     *          in="query",
     *          type="string",
     *          format="date",
     *          required=true,
     *          default="departureDate"
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
     *     @SWG\Parameter(
     *          name="order[departureDateTime]",
     *          in="query",
     *          type="string",
     *          required=false,
     *          default="DESC",
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
     * @param FlightRepository $flightRepository
     * @return Response
     * @throws \Exception
     */
    public function getCollection(Request $request, FlightRepository $flightRepository): Response
    {
        /** @var Form $form */
        $form = $this->validateRequestData(SearchFlightType::class, $request->query->all());
        if (!$form->isValid()) {
            return $this->response($form);
        }

        $collection = $this->getCollectionByFilters($form->getData(), $flightRepository);

        return $this->response($collection, EGroups::LIST);

    }
}