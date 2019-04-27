<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Exception\EFormWrongRequest;
use App\Core\Exception\ExceptionFactory;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Form\Form;

/**
 * Class AController
 *
 * @package App\Controller
 */
class AController extends AbstractFOSRestController
{
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
        if ($form->isValid()) {
            throw ExceptionFactory::createEWrongRequestData($form);
        }

        return $form;
    }
}