<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Exception\EFormWrongRequest;
use App\Core\Exception\ExceptionFactory;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AController
 *
 * @package App\Controller
 */
class AController extends AbstractFOSRestController
{
    /**
     * @param $data
     * @param array|string|null $groups
     * @param array $headers
     * @param int $statusCode
     *
     * @return Response
     */
    public function response($data, $groups = null, array $headers = [], int $statusCode = 200): Response
    {
        if (\is_string($groups)) {
            $groups = [$groups];
        }
        $view = $this->view($data, $statusCode, $headers);

        if($groups && \count($groups)){
            $context = new Context();
            $context->setGroups($groups);
            $view->setContext($context);
        }

        return $this->handleView($view);
    }

    /**
     * @param string $formClass
     * @param array $data
     * @param null $object
     *
     * @return Form
     * @throws EFormWrongRequest
     */
    protected function validateRequestData(string $formClass, array $data, $object = null): Form
    {
        /** @var Form $form */
        $form = $this->createForm($formClass, $object);
        $form->submit($data);
        if (!$form->isValid()) {
            throw ExceptionFactory::createEWrongRequestData($form);
        }

        return $form;
    }
}