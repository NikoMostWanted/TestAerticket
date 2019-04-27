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
 * Class Airport
 * @package App\Entity\AirTransport
 * @ORM\Entity
 */
class Airport
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
     * @ORM\Column(name="iata", type="string", length=3, nullable=false)
     * @Groups({EGroups::LIST})
     */
    private $iata;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Groups({EGroups::LIST})
     */
    private $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getIata(): string
    {
        return $this->iata;
    }

    public function setIata(string $iata): self
    {
        $this->iata = $iata;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}