<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190410220853 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE borough (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, resident VARCHAR(255) DEFAULT NULL, chief_town VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE city ADD borough_id INT NOT NULL');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B023431A6AC4E FOREIGN KEY (borough_id) REFERENCES borough (id)');
        $this->addSql('CREATE INDEX IDX_2D5B023431A6AC4E ON city (borough_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B023431A6AC4E');
        $this->addSql('DROP TABLE borough');
        $this->addSql('DROP INDEX IDX_2D5B023431A6AC4E ON city');
        $this->addSql('ALTER TABLE city DROP borough_id');
    }
}
