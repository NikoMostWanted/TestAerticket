<?php
declare(strict_types=1);

namespace App\Entity\AirTransport;

use App\Core\Traits\Entity\TCreatedAtModel;
use App\Core\Traits\Entity\TUpdatedAtModel;
use App\Core\Traits\Entity\TUuidModel;
use App\Core\Extra\EGroups;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Flight
 * @package App\Entity\AirTransport
 * @ORM\Entity(repositoryClass="App\Repository\AirTransport\FlightRepository")
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
     * @Groups({EGroups::LIST})
     */
    private $number;

    /**
     * @var Airport
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\AirTransport\Airport")
     * @ORM\JoinColumn(name="departure_airport_id", referencedColumnName="id", nullable=false)
     * @Groups({EGroups::LIST})
     */
    private $departureAirport;

    /**
     * @var Airport
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\AirTransport\Airport")
     * @ORM\JoinColumn(name="arrival_airport_id", referencedColumnName="id", nullable=false)
     * @Groups({EGroups::LIST})
     */
    private $arrivalAirport;

    /**
     * @var Transporter
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\AirTransport\Transporter")
     * @ORM\JoinColumn(name="transporter_id", referencedColumnName="id", nullable=false)
     * @Groups({EGroups::LIST})
     */
    private $transporter;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="departure_date_time", type="datetime", nullable=false)
     * @Groups({EGroups::LIST})
     */
    private $departureDateTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arrival_date_time", type="datetime", nullable=false)
     * @Groups({EGroups::LIST})
     */
    private $arrivalDateTime;


    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer", nullable=false)
     * @Groups({EGroups::LIST})
     */
    private $duration;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return Flight
     */
    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDepartureDateTime(): \DateTimeInterface
    {
        return $this->departureDateTime;
    }

    /**
     * @param \DateTimeInterface $departureDateTime
     * @return Flight
     */
    public function setDepartureDateTime(\DateTimeInterface $departureDateTime): self
    {
        $this->departureDateTime = $departureDateTime;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getArrivalDateTime(): \DateTimeInterface
    {
        return $this->arrivalDateTime;
    }

    /**
     * @param \DateTimeInterface $arrivalDateTime
     * @return Flight
     */
    public function setArrivalDateTime(\DateTimeInterface $arrivalDateTime): self
    {
        $this->arrivalDateTime = $arrivalDateTime;

        return $this;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     * @return Flight
     */
    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return Airport
     */
    public function getDepartureAirport(): Airport
    {
        return $this->departureAirport;
    }

    /**
     * @param Airport $departureAirport
     * @return Flight
     */
    public function setDepartureAirport(Airport $departureAirport): self
    {
        $this->departureAirport = $departureAirport;

        return $this;
    }

    /**
     * @return Transporter
     */
    public function getTransporter(): Transporter
    {
        return $this->transporter;
    }

    /**
     * @param Transporter $transporter
     * @return Flight
     */
    public function setTransporter(Transporter $transporter): self
    {
        $this->transporter = $transporter;

        return $this;
    }

    /**
     * @return Airport
     */
    public function getArrivalAirport(): Airport
    {
        return $this->arrivalAirport;
    }

    /**
     * @param Airport $arrivalAirport
     * @return Flight
     */
    public function setArrivalAirport(Airport $arrivalAirport): self
    {
        $this->arrivalAirport = $arrivalAirport;

        return $this;
    }
}