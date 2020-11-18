<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201118203801 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add relation btween matchs and stages';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stages ADD matchs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stages ADD CONSTRAINT FK_2FA26A645C0ED822 FOREIGN KEY (matchs_id) REFERENCES matches (id)');
        $this->addSql('CREATE INDEX IDX_2FA26A645C0ED822 ON stages (matchs_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stages DROP FOREIGN KEY FK_2FA26A645C0ED822');
        $this->addSql('DROP INDEX IDX_2FA26A645C0ED822 ON stages');
        $this->addSql('ALTER TABLE stages DROP matchs_id');
    }
}
