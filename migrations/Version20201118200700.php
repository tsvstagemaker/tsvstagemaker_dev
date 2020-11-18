<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201118200700 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add relation beween users and stages';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stages ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE stages ADD CONSTRAINT FK_2FA26A64A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_2FA26A64A76ED395 ON stages (user_id)');
        $this->addSql('ALTER TABLE users CHANGE email email VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stages DROP FOREIGN KEY FK_2FA26A64A76ED395');
        $this->addSql('DROP INDEX IDX_2FA26A64A76ED395 ON stages');
        $this->addSql('ALTER TABLE stages DROP user_id');
        $this->addSql('ALTER TABLE users CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
