<?php
declare(strict_types=1);

namespace App\Form\RequestFilter;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class SearchRequestFilter
 *
 * @package App\Form\RequestFilter
 */
class SearchRequestFilter
{
    /**
     * @var string|null
     * @Assert\NotBlank()
     */
    public $departureAirport;
    
    /**
     * @Assert\NotBlank()
     * @var string|null
     */
    public $arrivalAirport;
    
    /**
     * @Assert\NotBlank()
     * @Assert\DateTime()
     * @var \DateTime
     */
    public $departureDate;
}