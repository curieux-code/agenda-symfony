<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190416230904 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('CREATE TABLE ticketing (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, website VARCHAR(255) NOT NULL, embed VARCHAR(255) DEFAULT NULL, setting SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, ticketing_id INT NOT NULL, url VARCHAR(255) NOT NULL, price NUMERIC(5, 2) DEFAULT NULL, INDEX IDX_97A0ADA371F7E88B (event_id), INDEX IDX_97A0ADA325C26A92 (ticketing_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE videostore (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, website VARCHAR(255) NOT NULL, embed VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA371F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA325C26A92 FOREIGN KEY (ticketing_id) REFERENCES ticketing (id)');
        $this->addSql('ALTER TABLE video ADD videostore_id INT NOT NULL');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C2137A0C1 FOREIGN KEY (videostore_id) REFERENCES videostore (id)');
        $this->addSql('CREATE INDEX IDX_7CC7DA2C2137A0C1 ON video (videostore_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA325C26A92');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C2137A0C1');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE ticketing');
        $this->addSql('DROP TABLE videostore');
        $this->addSql('DROP INDEX IDX_7CC7DA2C2137A0C1 ON video');
        $this->addSql('ALTER TABLE video DROP videostore_id');
    }
}
