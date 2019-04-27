<?php
declare(strict_types=1);

namespace App\Repository\AirTransport;

use App\Core\Abstracts\ARepository;
use App\Entity\AirTransport\Flight;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class FlightRepository
 *
 * @package App\Repository\AirTransport
 *
 * @method Flight|null findOneByEmail(string $email)
 * @method Flight|null find($id, $lockMode = null, $lockVersion = null)
 * @method Flight|null findOneBy(array $criteria, array $orderBy = null)
 * @method Flight[]    findAll()
 * @method Flight[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlightRepository extends ARepository
{
    public const ALIAS = 'flight';

    /**
     * UserRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Flight::class);
    }

    public function applyFilters(iterable $filters, QueryBuilder $qb, string $alias, string $className) : void
    {
        $qb->join($alias . '.departureAirport', 'departureAirport')
            ->join($alias . '.arrivalAirport', 'arrivalAirport');

        $this->eq($qb, 'departureAirport.iata', $filters['departureAirport']);
        $this->eq($qb, 'arrivalAirport.iata', $filters['arrivalAirport']);
        $this->lte($qb, $alias . '.departureDateTime', $filters['departureDate']);
        $this->gte($qb, $alias . '.arrivalDateTime', $filters['departureDate']);
    }


}