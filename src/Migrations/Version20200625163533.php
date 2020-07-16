<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200625163533 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE inscription DROP CONSTRAINT FK_5E90F6D65899F888');
        $this->addSql('ALTER TABLE inscription ALTER tutore_id DROP NOT NULL');
        $this->addSql('ALTER TABLE inscription ALTER realisation_id DROP NOT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D65899F888 FOREIGN KEY (tutore_id) REFERENCES tutoree (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE inscription DROP CONSTRAINT fk_5e90f6d65899f888');
        $this->addSql('ALTER TABLE inscription ALTER realisation_id SET NOT NULL');
        $this->addSql('ALTER TABLE inscription ALTER tutore_id SET NOT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT fk_5e90f6d65899f888 FOREIGN KEY (tutore_id) REFERENCES tutore (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
