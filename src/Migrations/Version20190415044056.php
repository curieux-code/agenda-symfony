<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190415044056 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE postcode (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, code VARCHAR(10) NOT NULL, INDEX IDX_6339A4118BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prices (id INT AUTO_INCREMENT NOT NULL, reduction_id INT NOT NULL, event_id INT NOT NULL, price NUMERIC(5, 2) NOT NULL, INDEX IDX_E4CB6D59C03CB092 (reduction_id), INDEX IDX_E4CB6D5971F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reduction (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, slug VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rubric_category (rubric_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_6ED79A4DA29EC0FC (rubric_id), INDEX IDX_6ED79A4D12469DE2 (category_id), PRIMARY KEY(rubric_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE postcode ADD CONSTRAINT FK_6339A4118BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE prices ADD CONSTRAINT FK_E4CB6D59C03CB092 FOREIGN KEY (reduction_id) REFERENCES reduction (id)');
        $this->addSql('ALTER TABLE prices ADD CONSTRAINT FK_E4CB6D5971F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE rubric_category ADD CONSTRAINT FK_6ED79A4DA29EC0FC FOREIGN KEY (rubric_id) REFERENCES rubric (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rubric_category ADD CONSTRAINT FK_6ED79A4D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event ADD city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA78BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA78BAC62AF ON event (city_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE prices DROP FOREIGN KEY FK_E4CB6D59C03CB092');
        $this->addSql('DROP TABLE postcode');
        $this->addSql('DROP TABLE prices');
        $this->addSql('DROP TABLE reduction');
        $this->addSql('DROP TABLE rubric_category');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA78BAC62AF');
        $this->addSql('DROP INDEX IDX_3BAE0AA78BAC62AF ON event');
        $this->addSql('ALTER TABLE event DROP city_id');
    }
}
