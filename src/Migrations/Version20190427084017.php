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
        $this->addToTransporterTable('W6', 'WizzAir');
        $this->addToTransporterTable('PS', 'UkraineInternational');
        $this->addToTransporterTable('KG', 'KazahInternational');
        $this->addToTransporterTable('RS', 'RussiaInternational');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }

    private function addToTransporterTable(string $code, string $name) : void
    {
        $now = (new \DateTime())->format('Y-m-d H:i:s');
        $uuid = (string) Uuid::uuid4();

        $this->addSql('INSERT INTO transporter (code, `name`, created_at, updated_at, uuid) VALUES (?, ?, ?, ?, ?);',
            [$code, $name, $now, $now, $uuid]);
    }
}
