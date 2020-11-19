<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201118234732 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Recreate all tables';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE matchs (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, firearmtype VARCHAR(255) NOT NULL, matchlevel INT NOT NULL, start_at DATETIME NOT NULL, match_director VARCHAR(255) DEFAULT NULL, range_master VARCHAR(255) DEFAULT NULL, stats_director VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, club_name VARCHAR(255) DEFAULT NULL, country_id VARCHAR(255) DEFAULT NULL, squad_count INT DEFAULT NULL, matchid INT DEFAULT NULL, INDEX IDX_6B1E6041A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stages (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, matchs_id_id INT DEFAULT NULL, stagename VARCHAR(255) NOT NULL, stagenumber INT NOT NULL, firearm_id INT DEFAULT NULL, course_id INT DEFAULT NULL, scoring_id INT DEFAULT NULL, trgt_type_id INT DEFAULT NULL, ics_stage_id INT DEFAULT NULL, trgt_paper INT DEFAULT NULL, trgt_popper INT DEFAULT NULL, trgt_plates INT DEFAULT NULL, trgt_vanish INT DEFAULT NULL, trgt_penlty INT DEFAULT NULL, min_rounds INT DEFAULT NULL, report_on INT DEFAULT NULL, max_points INT DEFAULT NULL, start_pos LONGTEXT DEFAULT NULL, StartOn VARCHAR(10) DEFAULT \'00\', string_cnt INT DEFAULT NULL, descriptn LONGTEXT DEFAULT NULL, bobber INT DEFAULT NULL, showall INT DEFAULT NULL, location INT DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, filename VARCHAR(255) DEFAULT NULL, fileurl VARCHAR(255) DEFAULT NULL, filenameimg VARCHAR(255) DEFAULT NULL, fileurlimg VARCHAR(255) DEFAULT NULL, datastage LONGTEXT DEFAULT NULL, INDEX IDX_2FA26A64A76ED395 (user_id), INDEX IDX_2FA26A645C0ED822 (matchs_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, division VARCHAR(255) NOT NULL, club VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E6041A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE stages ADD CONSTRAINT FK_2FA26A64A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE stages ADD CONSTRAINT FK_2FA26A645C0ED822 FOREIGN KEY (matchs_id_id) REFERENCES matchs (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stages DROP FOREIGN KEY FK_2FA26A645C0ED822');
        $this->addSql('ALTER TABLE matchs DROP FOREIGN KEY FK_6B1E6041A76ED395');
        $this->addSql('ALTER TABLE stages DROP FOREIGN KEY FK_2FA26A64A76ED395');
        $this->addSql('DROP TABLE matchs');
        $this->addSql('DROP TABLE stages');
        $this->addSql('DROP TABLE users');
    }
}
