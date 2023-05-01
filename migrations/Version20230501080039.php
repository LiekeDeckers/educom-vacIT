<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230501080039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP roles, CHANGE voornaam voornaam VARCHAR(20) DEFAULT NULL, CHANGE achternaam achternaam VARCHAR(20) DEFAULT NULL, CHANGE geboortedatum geboortedatum DATE DEFAULT NULL, CHANGE telefoonnummer telefoonnummer VARCHAR(20) DEFAULT NULL, CHANGE adress adress VARCHAR(20) DEFAULT NULL, CHANGE postcode postcode VARCHAR(20) DEFAULT NULL, CHANGE woonplaats woonplaats VARCHAR(20) DEFAULT NULL, CHANGE motivatie motivatie VARCHAR(200) DEFAULT NULL, CHANGE cv cv VARCHAR(50) DEFAULT NULL, CHANGE profielfoto profielfoto VARCHAR(100) DEFAULT NULL, CHANGE bedrijf bedrijf VARCHAR(20) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', CHANGE voornaam voornaam VARCHAR(20) NOT NULL, CHANGE achternaam achternaam VARCHAR(20) NOT NULL, CHANGE geboortedatum geboortedatum DATE NOT NULL, CHANGE telefoonnummer telefoonnummer VARCHAR(20) NOT NULL, CHANGE adress adress VARCHAR(20) NOT NULL, CHANGE postcode postcode VARCHAR(20) NOT NULL, CHANGE woonplaats woonplaats VARCHAR(20) NOT NULL, CHANGE motivatie motivatie VARCHAR(200) NOT NULL, CHANGE cv cv VARCHAR(50) NOT NULL, CHANGE profielfoto profielfoto VARCHAR(100) NOT NULL, CHANGE bedrijf bedrijf VARCHAR(20) NOT NULL');
    }
}
