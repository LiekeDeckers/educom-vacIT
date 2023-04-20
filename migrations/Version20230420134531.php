<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230420134531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vacature (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, logo_id INT DEFAULT NULL, titel VARCHAR(50) NOT NULL, datum DATE NOT NULL, niveau VARCHAR(20) NOT NULL, plaats VARCHAR(20) NOT NULL, omschrijving VARCHAR(200) NOT NULL, INDEX IDX_9E5830F5A76ED395 (user_id), INDEX IDX_9E5830F5F98F144A (logo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vacature ADD CONSTRAINT FK_9E5830F5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vacature ADD CONSTRAINT FK_9E5830F5F98F144A FOREIGN KEY (logo_id) REFERENCES logo (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vacature DROP FOREIGN KEY FK_9E5830F5A76ED395');
        $this->addSql('ALTER TABLE vacature DROP FOREIGN KEY FK_9E5830F5F98F144A');
        $this->addSql('DROP TABLE vacature');
    }
}
