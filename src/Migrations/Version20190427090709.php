<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Ramsey\Uuid\Uuid;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190427090709 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addToFlightTable('34535', 400, $this->findAirportByIATA('IAA'), $this->findAirportByIATA('IAB'), $this->findTransporterByCode('W6'), '2019-04-20 00:00:00', '2019-04-21 00:00:00');
        $this->addToFlightTable('34537', 500, $this->findAirportByIATA('IAB'), $this->findAirportByIATA('IAD'), $this->findTransporterByCode('PS'), '2019-04-20 00:00:00', '2019-04-21 00:00:00');
        $this->addToFlightTable('34539', 200, $this->findAirportByIATA('IAO'), $this->findAirportByIATA('IAN'), $this->findTransporterByCode('KG'), '2019-04-20 00:00:00', '2019-04-21 00:00:00');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }

    private function addToFlightTable(
        string $number,
        int $duration,
        int $departureAirportId,
        int $arrivalAirportId,
        int $transporterId,
        string $departureDateTime,
        string $arrivalDateTime) : void
    {
        $now = (new \DateTime())->format('Y-m-d H:i:s');
        $uuid = (string) Uuid::uuid4();

        $this->addSql('INSERT INTO flight (number, duration, departure_airport_id, arrival_airport_id, transporter_id, departure_date_time, arrival_date_time, created_at, updated_at, uuid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);',
            [$number, $duration, $departureAirportId, $arrivalAirportId, $transporterId, $departureDateTime, $arrivalDateTime, $now, $now, $uuid]);
    }

    private function findAirportByIATA(string $iata): int
    {
        $result = $this->connection->executeQuery('SELECT id FROM airport WHERE iata = ?', [
            $iata
        ])->fetch();

        return (int)$result['id'];
    }

    private function findTransporterByCode(string $code): int
    {
        $result = $this->connection->executeQuery('SELECT id FROM transporter WHERE code = ?', [
            $code
        ])->fetch();

        return (int)$result['id'];
    }
}
