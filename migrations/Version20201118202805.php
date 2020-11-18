<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201118202805 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create match table and add relation users';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE matches (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, firearmtype VARCHAR(255) NOT NULL, matchlevel INT NOT NULL, start_at DATETIME NOT NULL, match_director VARCHAR(255) DEFAULT NULL, range_master VARCHAR(255) DEFAULT NULL, stats_director VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, club_name VARCHAR(255) DEFAULT NULL, country_id VARCHAR(255) DEFAULT NULL, squad_count INT DEFAULT NULL, matchid INT DEFAULT NULL, INDEX IDX_62615BAA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE matches ADD CONSTRAINT FK_62615BAA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE users CHANGE email email VARCHAR(180) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE matches');
        $this->addSql('ALTER TABLE users CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
