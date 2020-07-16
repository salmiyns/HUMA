<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200623141456 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE tuteurr (id INT NOT NULL, etudiant_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2F3657D5DDEAB1A3 ON tuteurr (etudiant_id)');
        $this->addSql('CREATE TABLE seance (id INT NOT NULL, realisation_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description TEXT NOT NULL, temps DATE NOT NULL, duree VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DF7DFD0EB685E551 ON seance (realisation_id)');
        $this->addSql('CREATE TABLE inscription (id INT NOT NULL, tutore_id INT NOT NULL, realisation_id INT NOT NULL, date_inscrption DATE NOT NULL, statut INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5E90F6D65899F888 ON inscription (tutore_id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6B685E551 ON inscription (realisation_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, date_of_birth DATE DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, sexe VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, about TEXT DEFAULT NULL, is_active BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, activated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, is_verified BOOLEAN NOT NULL, activation_token VARCHAR(255) DEFAULT NULL, reset_token VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE cours (id INT NOT NULL, proposition_id INT NOT NULL, nom_cours VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, objectif TEXT DEFAULT NULL, tag VARCHAR(255) DEFAULT NULL, competences_req TEXT DEFAULT NULL, niveau VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, date_creation DATE NOT NULL, dernier_modification DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FDCA8C9CDB96F9E ON cours (proposition_id)');
        $this->addSql('CREATE TABLE tutoree (id INT NOT NULL, etudiant_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C394A065DDEAB1A3 ON tutoree (etudiant_id)');
        $this->addSql('CREATE TABLE etudiant (id INT NOT NULL, id_user_id INT DEFAULT NULL, matricule VARCHAR(255) DEFAULT NULL, filiere VARCHAR(255) DEFAULT NULL, niveau VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_717E22E312B2DC9C ON etudiant (matricule)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_717E22E379F37AE5 ON etudiant (id_user_id)');
        $this->addSql('CREATE TABLE demande (id INT NOT NULL, tutore_id INT NOT NULL, cours_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2694D7A55899F888 ON demande (tutore_id)');
        $this->addSql('CREATE INDEX IDX_2694D7A57ECF78B0 ON demande (cours_id)');
        $this->addSql('CREATE TABLE tuteur (id INT NOT NULL, id_etudiant_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_56412268C5F87C54 ON tuteur (id_etudiant_id)');
        $this->addSql('CREATE TABLE tutore (id INT NOT NULL, etudiant_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9744B4BEDDEAB1A3 ON tutore (etudiant_id)');
        $this->addSql('CREATE TABLE proposition (id INT NOT NULL, tuteur_id INT DEFAULT NULL, tuteurr_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, date_creation DATE NOT NULL, date_modification DATE NOT NULL, statut VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C7CDC35386EC68D8 ON proposition (tuteur_id)');
        $this->addSql('CREATE INDEX IDX_C7CDC353D7436CCE ON proposition (tuteurr_id)');
        $this->addSql('CREATE TABLE enseignant (id INT NOT NULL, id_user_id INT DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, departement VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, date_embauche DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81A72FA179F37AE5 ON enseignant (id_user_id)');
        $this->addSql('CREATE TABLE realisation (id INT NOT NULL, cours_id INT NOT NULL, tuteur_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, desicription TEXT DEFAULT NULL, date_creation DATE NOT NULL, date_modification DATE NOT NULL, date_fin DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EAA5610E7ECF78B0 ON realisation (cours_id)');
        $this->addSql('CREATE INDEX IDX_EAA5610E86EC68D8 ON realisation (tuteur_id)');
        $this->addSql('ALTER TABLE tuteurr ADD CONSTRAINT FK_2F3657D5DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0EB685E551 FOREIGN KEY (realisation_id) REFERENCES realisation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D65899F888 FOREIGN KEY (tutore_id) REFERENCES tutore (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6B685E551 FOREIGN KEY (realisation_id) REFERENCES realisation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CDB96F9E FOREIGN KEY (proposition_id) REFERENCES proposition (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tutoree ADD CONSTRAINT FK_C394A065DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E379F37AE5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A55899F888 FOREIGN KEY (tutore_id) REFERENCES tutore (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A57ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tuteur ADD CONSTRAINT FK_56412268C5F87C54 FOREIGN KEY (id_etudiant_id) REFERENCES etudiant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tutore ADD CONSTRAINT FK_9744B4BEDDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE proposition ADD CONSTRAINT FK_C7CDC35386EC68D8 FOREIGN KEY (tuteur_id) REFERENCES tuteur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE proposition ADD CONSTRAINT FK_C7CDC353D7436CCE FOREIGN KEY (tuteurr_id) REFERENCES tuteurr (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA179F37AE5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE realisation ADD CONSTRAINT FK_EAA5610E7ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE realisation ADD CONSTRAINT FK_EAA5610E86EC68D8 FOREIGN KEY (tuteur_id) REFERENCES tuteurr (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE proposition DROP CONSTRAINT FK_C7CDC353D7436CCE');
        $this->addSql('ALTER TABLE realisation DROP CONSTRAINT FK_EAA5610E86EC68D8');
        $this->addSql('ALTER TABLE etudiant DROP CONSTRAINT FK_717E22E379F37AE5');
        $this->addSql('ALTER TABLE enseignant DROP CONSTRAINT FK_81A72FA179F37AE5');
        $this->addSql('ALTER TABLE demande DROP CONSTRAINT FK_2694D7A57ECF78B0');
        $this->addSql('ALTER TABLE realisation DROP CONSTRAINT FK_EAA5610E7ECF78B0');
        $this->addSql('ALTER TABLE tuteurr DROP CONSTRAINT FK_2F3657D5DDEAB1A3');
        $this->addSql('ALTER TABLE tutoree DROP CONSTRAINT FK_C394A065DDEAB1A3');
        $this->addSql('ALTER TABLE tuteur DROP CONSTRAINT FK_56412268C5F87C54');
        $this->addSql('ALTER TABLE tutore DROP CONSTRAINT FK_9744B4BEDDEAB1A3');
        $this->addSql('ALTER TABLE proposition DROP CONSTRAINT FK_C7CDC35386EC68D8');
        $this->addSql('ALTER TABLE inscription DROP CONSTRAINT FK_5E90F6D65899F888');
        $this->addSql('ALTER TABLE demande DROP CONSTRAINT FK_2694D7A55899F888');
        $this->addSql('ALTER TABLE cours DROP CONSTRAINT FK_FDCA8C9CDB96F9E');
        $this->addSql('ALTER TABLE seance DROP CONSTRAINT FK_DF7DFD0EB685E551');
        $this->addSql('ALTER TABLE inscription DROP CONSTRAINT FK_5E90F6D6B685E551');
        $this->addSql('DROP TABLE tuteurr');
        $this->addSql('DROP TABLE seance');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE tutoree');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE demande');
        $this->addSql('DROP TABLE tuteur');
        $this->addSql('DROP TABLE tutore');
        $this->addSql('DROP TABLE proposition');
        $this->addSql('DROP TABLE enseignant');
        $this->addSql('DROP TABLE realisation');
    }
}
