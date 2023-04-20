<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230420135419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sollicitatie (id INT AUTO_INCREMENT NOT NULL, vacature_id INT DEFAULT NULL, user_id INT DEFAULT NULL, uitgenodigd TINYINT(1) NOT NULL, INDEX IDX_9577817D6FB89BA0 (vacature_id), INDEX IDX_9577817DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sollicitatie ADD CONSTRAINT FK_9577817D6FB89BA0 FOREIGN KEY (vacature_id) REFERENCES vacature (id)');
        $this->addSql('ALTER TABLE sollicitatie ADD CONSTRAINT FK_9577817DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sollicitatie DROP FOREIGN KEY FK_9577817D6FB89BA0');
        $this->addSql('ALTER TABLE sollicitatie DROP FOREIGN KEY FK_9577817DA76ED395');
        $this->addSql('DROP TABLE sollicitatie');
    }
}
