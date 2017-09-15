<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161209103305 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Banner CHANGE target_window target_window TINYINT(1) DEFAULT \'1\' NOT NULL, CHANGE type type TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE show_type show_type TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE Payment_Banner_Log CHANGE level level TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('DROP INDEX UNIQ_B438191EF47645AE ON Page');
        $this->addSql('ALTER TABLE Page CHANGE url url VARCHAR(255) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Banner CHANGE target_window target_window TINYINT(1) NOT NULL, CHANGE type type TINYINT(1) NOT NULL, CHANGE show_type show_type TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE Page CHANGE url url VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B438191EF47645AE ON Page (url)');
        $this->addSql('ALTER TABLE Payment_Banner_Log CHANGE level level TINYINT(1) NOT NULL');
    }
}
