<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160613112817 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Listing_Summary CHANGE maptuning maptuning VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE Listing CHANGE show_email show_email VARCHAR(255) DEFAULT \'y\' NOT NULL, CHANGE maptuning maptuning VARCHAR(255) DEFAULT NULL, CHANGE zip5 zip5 VARCHAR(10) DEFAULT NULL, CHANGE maptuning_date maptuning_date DATETIME DEFAULT NULL, CHANGE level level INT DEFAULT NULL, CHANGE suspended_sitemgr suspended_sitemgr VARCHAR(1) DEFAULT \'n\' NOT NULL, CHANGE random_number random_number BIGINT DEFAULT \'0\' NOT NULL, CHANGE reminder reminder INT DEFAULT 0 NOT NULL, CHANGE video_url video_url VARCHAR(255) DEFAULT NULL, CHANGE importID importID INT DEFAULT NULL, CHANGE claim_disable claim_disable VARCHAR(1) DEFAULT \'n\' NOT NULL, CHANGE number_views number_views INT DEFAULT 0 NOT NULL, CHANGE avg_review avg_review INT DEFAULT 0 NOT NULL, CHANGE backlink backlink VARCHAR(1) DEFAULT \'n\' NOT NULL, CHANGE last_traffic_sent last_traffic_sent DATE DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Listing CHANGE show_email show_email VARCHAR(255) NOT NULL, CHANGE maptuning maptuning VARCHAR(255) NOT NULL, CHANGE zip5 zip5 VARCHAR(10) NOT NULL, CHANGE maptuning_date maptuning_date DATETIME NOT NULL, CHANGE level level INT NOT NULL, CHANGE suspended_sitemgr suspended_sitemgr VARCHAR(1) NOT NULL, CHANGE random_number random_number BIGINT NOT NULL, CHANGE reminder reminder INT NOT NULL, CHANGE video_url video_url VARCHAR(255) NOT NULL, CHANGE importID importID INT NOT NULL, CHANGE claim_disable claim_disable VARCHAR(1) NOT NULL, CHANGE number_views number_views INT NOT NULL, CHANGE avg_review avg_review INT NOT NULL, CHANGE backlink backlink VARCHAR(1) NOT NULL, CHANGE last_traffic_sent last_traffic_sent DATE NOT NULL');
        $this->addSql('ALTER TABLE Listing_Summary CHANGE maptuning maptuning VARCHAR(255) NOT NULL');
    }
}
