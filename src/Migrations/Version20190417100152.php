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

        $this->addSql('CREATE TABLE placekind (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, plural VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE placekind_place (placekind_id INT NOT NULL, place_id INT NOT NULL, INDEX IDX_4316FC5A9EB16C79 (placekind_id), INDEX IDX_4316FC5ADA6A219 (place_id), PRIMARY KEY(placekind_id, place_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE placekind_place ADD CONSTRAINT FK_4316FC5A9EB16C79 FOREIGN KEY (placekind_id) REFERENCES placekind (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE placekind_place ADD CONSTRAINT FK_4316FC5ADA6A219 FOREIGN KEY (place_id) REFERENCES place (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE placekind_place DROP FOREIGN KEY FK_4316FC5A9EB16C79');
        $this->addSql('DROP TABLE placekind');
        $this->addSql('DROP TABLE placekind_place');
    }
}
