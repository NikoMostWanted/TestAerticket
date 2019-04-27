<?php
declare(strict_types=1);

namespace App\Entity\AirTransport;

use App\Core\Traits\Entity\TCreatedAtModel;
use App\Core\Traits\Entity\TUpdatedAtModel;
use App\Core\Traits\Entity\TUuidModel;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Flight
 * @package App\Entity\AirTransport
 *
 */
class Flight
{
    use TUuidModel;
    use TCreatedAtModel;
    use TUpdatedAtModel;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=255, nullable=false)
     */
    private $number;

    /**
     * @var Airport
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\AirTransport\Airport")
     * @ORM\JoinColumn(name="departure_airport_id, referencedColumnName="id", nullable=false)
     */
    private $departureAirport;

    /**
     * @var Airport
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\AirTransport\Airport")
     * @ORM\JoinColumn(name="arrival_airport_id, referencedColumnName="id", nullable=false)
     */
    private $arrivalAirport;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="departure_date_time", type="datetime", nullable=false)
     */
    private $departureDateTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arrival_date_time", type="datetime", nullable=false)
     */
    private $arrivalDateTime;


    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer", nullable=false)
     */
    private $duration;
}