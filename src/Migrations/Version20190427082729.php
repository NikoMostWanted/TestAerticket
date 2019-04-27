<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Ramsey\Uuid\Uuid;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190427082729 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addToAirportTable('IAA', 'Igarka Airport');
        $this->addToAirportTable('IAB', 'McConnell Air Force Base');
        $this->addToAirportTable('IAD', 'Washington Dulles International Airport');
        $this->addToAirportTable('IAG', 'Niagara Falls International Airport');
        $this->addToAirportTable('IAH', 'George Bush Intercontinental Airport');
        $this->addToAirportTable('IAM', 'In Amenas Airport');
        $this->addToAirportTable('IAN', 'Bob Baker Memorial Airport');
        $this->addToAirportTable('IAO', 'Sayak Airport');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }

    private function addToAirportTable(string $iata, string $name) : void
    {
        $now = (new \DateTime())->format('Y-m-d H:i:s');
        $uuid = (string) Uuid::uuid4();

        $this->addSql('INSERT INTO airport (iata, `name`, created_at, updated_at, uuid) VALUES (?, ?, ?, ?, ?);',
            [$iata, $name, $now, $now, $uuid]);
    }
}
