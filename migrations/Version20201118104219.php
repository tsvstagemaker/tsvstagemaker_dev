<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201118104219 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create stages table';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stages (id INT AUTO_INCREMENT NOT NULL, stagename VARCHAR(255) NOT NULL, stagenumber INT NOT NULL, firearm_id INT DEFAULT NULL, course_id INT DEFAULT NULL, scoring_id INT DEFAULT NULL, trgt_type_id INT DEFAULT NULL, ics_stage_id INT DEFAULT NULL, trgt_paper INT DEFAULT NULL, trgt_popper INT DEFAULT NULL, trgt_plates INT DEFAULT NULL, trgt_vanish INT DEFAULT NULL, trgt_penlty INT DEFAULT NULL, min_rounds INT DEFAULT NULL, report_on INT DEFAULT NULL, max_points INT DEFAULT NULL, start_pos LONGTEXT DEFAULT NULL, StartOn VARCHAR(10) DEFAULT \'00\', string_cnt INT DEFAULT NULL, descriptn LONGTEXT DEFAULT NULL, bobber INT DEFAULT NULL, showall INT DEFAULT NULL, location INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, filename VARCHAR(255) DEFAULT NULL, fileurl VARCHAR(255) DEFAULT NULL, filenameimg VARCHAR(255) DEFAULT NULL, fileurlimg VARCHAR(255) DEFAULT NULL, datastage LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE stage');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stage (id INT AUTO_INCREMENT NOT NULL, stagename VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, stagenumber INT NOT NULL, firearm_id INT DEFAULT NULL, course_id INT DEFAULT NULL, scoring_id INT DEFAULT NULL, trgt_type_id INT DEFAULT NULL, ics_stage_id INT DEFAULT NULL, trgt_paper INT DEFAULT NULL, trgt_popper INT DEFAULT NULL, trgt_plates INT DEFAULT NULL, trgt_vanish INT DEFAULT NULL, trgt_penlty INT DEFAULT NULL, min_rounds INT DEFAULT NULL, report_on INT DEFAULT NULL, max_points INT DEFAULT NULL, start_pos LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, StartOn VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'00\' COLLATE `utf8mb4_unicode_ci`, string_cnt INT DEFAULT NULL, descriptn LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, bobber INT DEFAULT NULL, showall INT DEFAULT NULL, location INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, filename VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, fileurl VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, filenameimg VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, fileurlimg VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, datastage LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE stages');
    }
}
