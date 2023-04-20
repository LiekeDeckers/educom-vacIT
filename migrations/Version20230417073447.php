<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230417073447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artiest (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(50) NOT NULL, genre VARCHAR(50) NOT NULL, omschrijving VARCHAR(100) NOT NULL, afbeelding_url VARCHAR(100) NOT NULL, website VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE optreden (id INT AUTO_INCREMENT NOT NULL, poppodium_id INT NOT NULL, artiest_id INT NOT NULL, voorprogramma_id INT NOT NULL, omschrijving VARCHAR(100) NOT NULL, datum DATE NOT NULL, prijs INT NOT NULL, ticket_url VARCHAR(100) NOT NULL, afbeelding_url VARCHAR(100) NOT NULL, INDEX IDX_6286F65DA2EEBB18 (poppodium_id), INDEX IDX_6286F65DAED85528 (artiest_id), INDEX IDX_6286F65DE017CE10 (voorprogramma_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poppodium (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(50) NOT NULL, adres VARCHAR(50) NOT NULL, postcode VARCHAR(50) NOT NULL, woonplaats VARCHAR(50) NOT NULL, telefoonnummer VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, website VARCHAR(100) NOT NULL, logo_url VARCHAR(100) NOT NULL, afbeelding_url VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE optreden ADD CONSTRAINT FK_6286F65DA2EEBB18 FOREIGN KEY (poppodium_id) REFERENCES poppodium (id)');
        $this->addSql('ALTER TABLE optreden ADD CONSTRAINT FK_6286F65DAED85528 FOREIGN KEY (artiest_id) REFERENCES artiest (id)');
        $this->addSql('ALTER TABLE optreden ADD CONSTRAINT FK_6286F65DE017CE10 FOREIGN KEY (voorprogramma_id) REFERENCES artiest (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE optreden DROP FOREIGN KEY FK_6286F65DA2EEBB18');
        $this->addSql('ALTER TABLE optreden DROP FOREIGN KEY FK_6286F65DAED85528');
        $this->addSql('ALTER TABLE optreden DROP FOREIGN KEY FK_6286F65DE017CE10');
        $this->addSql('DROP TABLE artiest');
        $this->addSql('DROP TABLE optreden');
        $this->addSql('DROP TABLE poppodium');
        $this->addSql('DROP TABLE user');
    }
}
