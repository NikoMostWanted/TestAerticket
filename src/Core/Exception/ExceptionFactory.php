<?php
declare(strict_types=1);

namespace App\Core\Exception;

use Symfony\Component\Form\Form;

/**
 * Class ExceptionFactory
 *
 * @package App\Core\Exception
 */
class ExceptionFactory
{
    /**
     * @param Form $form
     * @param int|null $status
     *
     * @return EFormWrongRequest
     */
    public static function createEWrongRequestData(Form $form, int $status = null): EFormWrongRequest
    {
        return new EFormWrongRequest($form, $status);
    }
}