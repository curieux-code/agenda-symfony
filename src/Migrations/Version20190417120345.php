<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190417120345 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE borough_reduction (borough_id INT NOT NULL, reduction_id INT NOT NULL, INDEX IDX_A3F92C4531A6AC4E (borough_id), INDEX IDX_A3F92C45C03CB092 (reduction_id), PRIMARY KEY(borough_id, reduction_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE borough_reduction ADD CONSTRAINT FK_A3F92C4531A6AC4E FOREIGN KEY (borough_id) REFERENCES borough (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE borough_reduction ADD CONSTRAINT FK_A3F92C45C03CB092 FOREIGN KEY (reduction_id) REFERENCES reduction (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE borough_reduction');
    }
}
