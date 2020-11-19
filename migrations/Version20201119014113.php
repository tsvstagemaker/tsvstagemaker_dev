<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201119014113 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Modify champs at not null';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matchs CHANGE start_at start_at VARCHAR(255) NOT NULL, CHANGE club_name club_name VARCHAR(255) NOT NULL, CHANGE country_id country_id VARCHAR(255) NOT NULL, CHANGE squad_count squad_count INT NOT NULL, CHANGE matchid matchid INT NOT NULL');
        $this->addSql('ALTER TABLE stages CHANGE StartOn StartOn VARCHAR(10) DEFAULT \'00\' NOT NULL, CHANGE showall showall INT DEFAULT 0 NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matchs CHANGE start_at start_at VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE club_name club_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE country_id country_id VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE squad_count squad_count INT DEFAULT NULL, CHANGE matchid matchid INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stages CHANGE StartOn StartOn VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'00\' COLLATE `utf8mb4_unicode_ci`, CHANGE showall showall INT DEFAULT NULL');
    }
}
