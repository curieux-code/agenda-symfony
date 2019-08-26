<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190417100152 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE placetype (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, plural VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE placetype_place (placetype_id INT NOT NULL, place_id INT NOT NULL, INDEX IDX_4316FC5A9EB16C79 (placetype_id), INDEX IDX_4316FC5ADA6A219 (place_id), PRIMARY KEY(placetype_id, place_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE placetype_place ADD CONSTRAINT FK_4316FC5A9EB16C79 FOREIGN KEY (placetype_id) REFERENCES placetype (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE placetype_place ADD CONSTRAINT FK_4316FC5ADA6A219 FOREIGN KEY (place_id) REFERENCES place (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE placetype_place DROP FOREIGN KEY FK_4316FC5A9EB16C79');
        $this->addSql('DROP TABLE placetype');
        $this->addSql('DROP TABLE placetype_place');
    }
}
