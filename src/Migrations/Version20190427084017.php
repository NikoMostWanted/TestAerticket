<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Ramsey\Uuid\Uuid;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190427084017 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }

    private function addToTransporterTable() : void
    {
        $now = (new \DateTime())->format('Y-m-d H:i:s');
        $uuid = (string) Uuid::uuid4();

        $this->addSql('INSERT INTO airport (iata, `name`, created_at, updated_at, uuid) VALUES (?, ?, ?, ?, ?);',
            [$iata, $name, $now, $now, $uuid]);
    }
}
