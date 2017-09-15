<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160513095648 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Account CHANGE lastlogin lastlogin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE Contact CHANGE importID importID INT DEFAULT 0 NOT NULL, CHANGE importID_event importID_event INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE Account CHANGE foreignaccount_redirect foreignaccount_redirect VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE Account CHANGE foreignaccount_auth foreignaccount_auth LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE Account CHANGE facebook_firstname facebook_firstname VARCHAR(100) DEFAULT NULL, CHANGE facebook_lastname facebook_lastname VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE Account CHANGE faillogin_count faillogin_count INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE Account CHANGE faillogin_datetime faillogin_datetime DATETIME DEFAULT \'0000-00-00 00:00:00\' NOT NULL');
        $this->addSql('ALTER TABLE Account CHANGE importID importID INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE Account CHANGE domain_importID domain_importID INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Account CHANGE importID_event importID_event INT DEFAULT 0 NOT NULL, CHANGE domain_importID_event domain_importID_event INT DEFAULT NULL, CHANGE is_sponsor is_sponsor VARCHAR(1) DEFAULT \'n\' NOT NULL, CHANGE has_profile has_profile VARCHAR(1) DEFAULT \'y\' NOT NULL, CHANGE publish_contact publish_contact VARCHAR(1) DEFAULT \'n\' NOT NULL, CHANGE notify_traffic_listing notify_traffic_listing VARCHAR(1) DEFAULT NULL, CHANGE complementary_info complementary_info VARCHAR(255) DEFAULT NULL, CHANGE active active VARCHAR(1) DEFAULT \'n\' NOT NULL, CHANGE newsletter newsletter VARCHAR(1) DEFAULT \'n\' NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Account CHANGE lastlogin lastlogin DATETIME NOT NULL');
        $this->addSql('ALTER TABLE Contact CHANGE importID importID INT NOT NULL, CHANGE importID_event importID_event INT NOT NULL');
        $this->addSql('ALTER TABLE Account CHANGE foreignaccount_redirect foreignaccount_redirect VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE Account CHANGE foreignaccount_auth foreignaccount_auth LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE Account CHANGE facebook_firstname facebook_firstname VARCHAR(100) NOT NULL, CHANGE facebook_lastname facebook_lastname VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE Account CHANGE faillogin_count faillogin_count INT NOT NULL');
        $this->addSql('ALTER TABLE Account CHANGE faillogin_datetime faillogin_datetime DATETIME NOT NULL');
        $this->addSql('ALTER TABLE Account CHANGE importID importID INT NOT NULL');
        $this->addSql('ALTER TABLE Account CHANGE domain_importID domain_importID INT NOT NULL');
        $this->addSql('ALTER TABLE Account CHANGE importID_event importID_event INT NOT NULL, CHANGE domain_importID_event domain_importID_event INT NOT NULL, CHANGE is_sponsor is_sponsor VARCHAR(1) NOT NULL, CHANGE has_profile has_profile VARCHAR(1) NOT NULL, CHANGE publish_contact publish_contact VARCHAR(1) NOT NULL, CHANGE notify_traffic_listing notify_traffic_listing VARCHAR(1) NOT NULL, CHANGE complementary_info complementary_info VARCHAR(255) NOT NULL, CHANGE active active VARCHAR(1) NOT NULL, CHANGE newsletter newsletter VARCHAR(1) NOT NULL');
    }
}
