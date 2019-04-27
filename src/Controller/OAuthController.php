<?php
declare(strict_types=1);

namespace App\Controller;

use OAuth2\OAuth2;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

/**
 * @Route("/oauth")
 *
 * @SWG\Tag(name="OAuth")
 */
class OAuthController extends AController
{
    /**
     * @Route("/token", methods={"POST"})
     *
     * @SWG\Post(summary="Get authorization token",
     *     @SWG\Response(
     *          response=200,
     *          description="OK"
     *     ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          type="string",
     *          required=true,
     *          @SWG\Definition(
     *              required={"client_id", "client_secret", "grant_type"},
     *              @SWG\Property(property="client_id", example="~", type="string", description="OAuth client id"),
     *              @SWG\Property(property="client_secret", example="~", type="string", description="OAuth client secret"),
     *              @SWG\Property(property="grant_type", format="password", example="password", type="string", description="Grant type"),
     *              @SWG\Property(property="username", example="~", type="string", description="User email"),
     *              @SWG\Property(property="password", example="~", type="string", description="User password")
     *          )
     *      )
     * )
     *
     * @param OAuth2 $server
     * @param Request $request
     *
     * @return Response
     * @throws \OAuth2\OAuth2ServerException
     */
    public function token(OAuth2 $server, Request $request)
    {
        return $server->grantAccessToken($request);
    }
}