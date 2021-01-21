<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210121195521 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE upload_logo DROP FOREIGN KEY FK_600A1D6A71179CD6');
        $this->addSql('DROP INDEX IDX_600A1D6A71179CD6 ON upload_logo');
        $this->addSql('ALTER TABLE upload_logo ADD user_id INT NOT NULL, ADD name VARCHAR(255) DEFAULT NULL, DROP name_id');
        $this->addSql('ALTER TABLE upload_logo ADD CONSTRAINT FK_600A1D6AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_600A1D6AA76ED395 ON upload_logo (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE upload_logo DROP FOREIGN KEY FK_600A1D6AA76ED395');
        $this->addSql('DROP INDEX IDX_600A1D6AA76ED395 ON upload_logo');
        $this->addSql('ALTER TABLE upload_logo ADD name_id INT DEFAULT NULL, DROP user_id, DROP name');
        $this->addSql('ALTER TABLE upload_logo ADD CONSTRAINT FK_600A1D6A71179CD6 FOREIGN KEY (name_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_600A1D6A71179CD6 ON upload_logo (name_id)');
    }
}
