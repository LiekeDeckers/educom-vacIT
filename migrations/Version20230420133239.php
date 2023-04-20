<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230420133239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD logo_id INT DEFAULT NULL, ADD voornaam VARCHAR(20) NOT NULL, ADD achternaam VARCHAR(20) NOT NULL, ADD geboortedatum DATE NOT NULL, ADD telefoonnummer VARCHAR(20) NOT NULL, ADD adress VARCHAR(20) NOT NULL, ADD postcode VARCHAR(20) NOT NULL, ADD woonplaats VARCHAR(20) NOT NULL, ADD motivatie VARCHAR(200) NOT NULL, ADD cv VARCHAR(50) NOT NULL, ADD profielfoto VARCHAR(100) NOT NULL, ADD bedrijf VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F98F144A FOREIGN KEY (logo_id) REFERENCES logo (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649F98F144A ON user (logo_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F98F144A');
        $this->addSql('DROP INDEX IDX_8D93D649F98F144A ON user');
        $this->addSql('ALTER TABLE user DROP logo_id, DROP voornaam, DROP achternaam, DROP geboortedatum, DROP telefoonnummer, DROP adress, DROP postcode, DROP woonplaats, DROP motivatie, DROP cv, DROP profielfoto, DROP bedrijf');
    }
}
