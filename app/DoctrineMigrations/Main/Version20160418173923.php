<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160418173923 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        /* That piece of sql was not generate by doctrine:diff.
           It was me, fixing eDirectory database, because doctrine migrations was not running with current database
           It does not have a down() version, because it always should have been like that
        */
        $this->addSql('ALTER TABLE Account_Activation ADD PRIMARY KEY ( account_id , unique_key )');
        $this->addSql('ALTER TABLE Control_Cron ADD PRIMARY KEY ( domain_id , type ) ;');
        $this->addSql('ALTER TABLE Forgot_Password ADD PRIMARY KEY ( account_id , unique_key ) ;');
        $this->addSql('ALTER TABLE SQL_Log ADD id INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ;');
        /* *************************************** */

        $this->addSql('ALTER TABLE Control_Import_Listing CHANGE domain_id domain_id INT AUTO_INCREMENT NOT NULL, CHANGE scheduled scheduled VARCHAR(1) NOT NULL, CHANGE running running VARCHAR(1) NOT NULL, CHANGE status status VARCHAR(2) NOT NULL, CHANGE last_run_date last_run_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE Setting CHANGE name name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE RobotsFilter CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE value value VARCHAR(15) DEFAULT NULL');
        $this->addSql('ALTER TABLE Location_5 CHANGE location_4 location_4 INT NOT NULL, CHANGE location_3 location_3 INT NOT NULL, CHANGE location_2 location_2 INT NOT NULL, CHANGE location_1 location_1 INT NOT NULL');
        $this->addSql('ALTER TABLE Location_2 CHANGE location_1 location_1 INT NOT NULL');
        $this->addSql('ALTER TABLE Control_Export_MailApp CHANGE domain_id domain_id INT AUTO_INCREMENT NOT NULL, CHANGE scheduled scheduled VARCHAR(1) NOT NULL, CHANGE running running VARCHAR(1) NOT NULL, CHANGE last_run_date last_run_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE Location_3 CHANGE location_2 location_2 INT NOT NULL, CHANGE location_1 location_1 INT NOT NULL');
        $this->addSql('ALTER TABLE SMAccount CHANGE updated updated DATETIME NOT NULL, CHANGE entered entered DATETIME NOT NULL, CHANGE faillogin_count faillogin_count INT NOT NULL, CHANGE faillogin_datetime faillogin_datetime DATETIME NOT NULL, CHANGE active active VARCHAR(1) NOT NULL');
        $this->addSql('ALTER TABLE Image CHANGE type type VARCHAR(255) NOT NULL, CHANGE width width SMALLINT NOT NULL, CHANGE height height SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE Forgot_Password CHANGE account_id account_id INT NOT NULL, CHANGE entered entered DATE NOT NULL');
        $this->addSql('ALTER TABLE Control_Export_Event CHANGE id id INT NOT NULL, CHANGE domain_id domain_id INT NOT NULL, CHANGE type type VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE Control_Cron CHANGE type type VARCHAR(50) NOT NULL, CHANGE running running VARCHAR(1) NOT NULL, CHANGE last_run_date last_run_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE Location_4 CHANGE location_3 location_3 INT NOT NULL, CHANGE location_2 location_2 INT NOT NULL, CHANGE location_1 location_1 INT NOT NULL');
        $this->addSql('ALTER TABLE Control_Export_Listing CHANGE id id INT NOT NULL, CHANGE domain_id domain_id INT NOT NULL, CHANGE type type VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE Cron_Log CHANGE finished finished VARCHAR(1) NOT NULL');
        $this->addSql('ALTER TABLE Account CHANGE updated updated DATETIME NOT NULL, CHANGE entered entered DATETIME NOT NULL, CHANGE agree_tou agree_tou VARCHAR(1) DEFAULT NULL, CHANGE lastlogin lastlogin DATETIME NOT NULL, CHANGE foreignaccount foreignaccount VARCHAR(1) NOT NULL, CHANGE foreignaccount_done foreignaccount_done VARCHAR(1) NOT NULL, CHANGE faillogin_count faillogin_count INT NOT NULL, CHANGE faillogin_datetime faillogin_datetime DATETIME NOT NULL, CHANGE importID importID INT NOT NULL, CHANGE importID_event importID_event INT NOT NULL, CHANGE is_sponsor is_sponsor VARCHAR(1) NOT NULL, CHANGE has_profile has_profile VARCHAR(1) NOT NULL, CHANGE publish_contact publish_contact VARCHAR(1) NOT NULL, CHANGE notify_traffic_listing notify_traffic_listing VARCHAR(1) NOT NULL, CHANGE active active VARCHAR(1) NOT NULL, CHANGE newsletter newsletter VARCHAR(1) NOT NULL');
        $this->addSql('ALTER TABLE Profile CHANGE account_id account_id INT AUTO_INCREMENT NOT NULL, CHANGE friendly_url friendly_url VARCHAR(255) NOT NULL, CHANGE profile_complete profile_complete VARCHAR(1) NOT NULL');
        $this->addSql('ALTER TABLE Contact CHANGE account_id account_id INT AUTO_INCREMENT NOT NULL, CHANGE updated updated DATETIME NOT NULL, CHANGE entered entered DATETIME NOT NULL, CHANGE importID importID INT NOT NULL, CHANGE importID_event importID_event INT NOT NULL');
        $this->addSql('ALTER TABLE Control_Import_Event CHANGE domain_id domain_id INT AUTO_INCREMENT NOT NULL, CHANGE scheduled scheduled VARCHAR(1) NOT NULL, CHANGE running running VARCHAR(1) NOT NULL, CHANGE status status VARCHAR(2) NOT NULL, CHANGE last_run_date last_run_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE Account_Activation CHANGE account_id account_id INT NOT NULL, CHANGE entered entered DATE NOT NULL');
        $this->addSql('ALTER TABLE Domain CHANGE name name VARCHAR(250) NOT NULL, CHANGE status status VARCHAR(1) NOT NULL, CHANGE activation_status activation_status VARCHAR(1) NOT NULL, CHANGE created created DATE NOT NULL, CHANGE deleted_date deleted_date DATE NOT NULL, CHANGE article_feature article_feature VARCHAR(3) NOT NULL, CHANGE banner_feature banner_feature VARCHAR(3) NOT NULL, CHANGE classified_feature classified_feature VARCHAR(3) NOT NULL, CHANGE event_feature event_feature VARCHAR(3) NOT NULL');
        $this->addSql('ALTER TABLE Registration CHANGE date_time date_time DATETIME NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        /* That piece of sql was not generate by doctrine:diff.
           It was me, fixing eDirectory database, because doctrine migrations was not running with current database
           It does not have a down() version, because it always should have been like that
        */
        $this->addSql('ALTER TABLE Account_Activation DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE Control_Cron DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE Forgot_Password DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE SQL_Log MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE SQL_Log DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE SQL_Log DROP id');
        /* *************************************** */

        $this->addSql('ALTER TABLE Account CHANGE updated updated DATETIME DEFAULT \'0000-00-00 00:00:00\' NOT NULL, CHANGE entered entered DATETIME DEFAULT \'0000-00-00 00:00:00\' NOT NULL, CHANGE agree_tou agree_tou CHAR(1) DEFAULT NULL, CHANGE lastlogin lastlogin DATETIME DEFAULT \'0000-00-00 00:00:00\' NOT NULL, CHANGE foreignaccount foreignaccount CHAR(1) DEFAULT \'n\' NOT NULL, CHANGE foreignaccount_done foreignaccount_done CHAR(1) DEFAULT \'n\' NOT NULL, CHANGE faillogin_count faillogin_count INT DEFAULT 0 NOT NULL, CHANGE faillogin_datetime faillogin_datetime DATETIME DEFAULT \'0000-00-00 00:00:00\' NOT NULL, CHANGE importID importID INT DEFAULT 0 NOT NULL, CHANGE importID_event importID_event INT DEFAULT 0 NOT NULL, CHANGE is_sponsor is_sponsor CHAR(1) DEFAULT \'n\' NOT NULL, CHANGE has_profile has_profile CHAR(1) DEFAULT \'y\' NOT NULL, CHANGE publish_contact publish_contact CHAR(1) DEFAULT \'n\' NOT NULL, CHANGE notify_traffic_listing notify_traffic_listing CHAR(1) NOT NULL, CHANGE active active CHAR(1) DEFAULT \'n\' NOT NULL, CHANGE newsletter newsletter CHAR(1) DEFAULT \'n\' NOT NULL');
        $this->addSql('ALTER TABLE Account_Activation CHANGE account_id account_id INT DEFAULT 0 NOT NULL, CHANGE entered entered DATE DEFAULT \'0000-00-00\' NOT NULL');
        $this->addSql('ALTER TABLE Contact CHANGE account_id account_id INT DEFAULT 0 NOT NULL, CHANGE updated updated DATETIME DEFAULT \'0000-00-00 00:00:00\' NOT NULL, CHANGE entered entered DATETIME DEFAULT \'0000-00-00 00:00:00\' NOT NULL, CHANGE importID importID INT DEFAULT 0 NOT NULL, CHANGE importID_event importID_event INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE Control_Cron CHANGE running running CHAR(1) DEFAULT \'N\' NOT NULL, CHANGE last_run_date last_run_date DATETIME DEFAULT \'0000-00-00 00:00:00\' NOT NULL, CHANGE type type VARCHAR(50) DEFAULT \'\' NOT NULL');
        $this->addSql('ALTER TABLE Control_Export_Event CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE domain_id domain_id INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE Control_Export_Listing CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE domain_id domain_id INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE Control_Export_MailApp CHANGE domain_id domain_id INT NOT NULL, CHANGE scheduled scheduled CHAR(1) DEFAULT \'N\' NOT NULL, CHANGE running running CHAR(1) DEFAULT \'N\' NOT NULL, CHANGE last_run_date last_run_date DATETIME DEFAULT \'0000-00-00 00:00:00\' NOT NULL');
        $this->addSql('ALTER TABLE Control_Import_Event CHANGE domain_id domain_id INT NOT NULL, CHANGE scheduled scheduled CHAR(1) DEFAULT \'N\' NOT NULL, CHANGE running running CHAR(1) DEFAULT \'N\' NOT NULL, CHANGE status status CHAR(2) NOT NULL, CHANGE last_run_date last_run_date DATETIME DEFAULT \'0000-00-00 00:00:00\' NOT NULL');
        $this->addSql('ALTER TABLE Control_Import_Listing CHANGE domain_id domain_id INT NOT NULL, CHANGE scheduled scheduled CHAR(1) DEFAULT \'N\' NOT NULL, CHANGE running running CHAR(1) DEFAULT \'N\' NOT NULL, CHANGE status status CHAR(2) NOT NULL, CHANGE last_run_date last_run_date DATETIME DEFAULT \'0000-00-00 00:00:00\' NOT NULL');
        $this->addSql('ALTER TABLE Cron_Log CHANGE finished finished CHAR(1) DEFAULT \'n\' NOT NULL');
        $this->addSql('ALTER TABLE Domain CHANGE name name VARCHAR(100) NOT NULL, CHANGE status status CHAR(1) DEFAULT \'P\' NOT NULL COMMENT \'A - Active, D - Deleted, P - Pending\', CHANGE activation_status activation_status CHAR(1) DEFAULT \'P\' NOT NULL COMMENT \'A - Active, P - Pending\', CHANGE created created DATE DEFAULT \'0000-00-00\' NOT NULL, CHANGE deleted_date deleted_date DATE DEFAULT \'0000-00-00\' NOT NULL, CHANGE article_feature article_feature VARCHAR(3) DEFAULT \'off\' NOT NULL, CHANGE banner_feature banner_feature VARCHAR(3) DEFAULT \'off\' NOT NULL, CHANGE classified_feature classified_feature VARCHAR(3) DEFAULT \'off\' NOT NULL, CHANGE event_feature event_feature VARCHAR(3) DEFAULT \'off\' NOT NULL');
        $this->addSql('ALTER TABLE Forgot_Password CHANGE account_id account_id INT DEFAULT 0 NOT NULL, CHANGE entered entered DATE DEFAULT \'0000-00-00\' NOT NULL');
        $this->addSql('ALTER TABLE Image CHANGE type type VARCHAR(255) DEFAULT \'JPG\' NOT NULL, CHANGE width width SMALLINT DEFAULT \'0\' NOT NULL, CHANGE height height SMALLINT DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE Location_2 CHANGE location_1 location_1 INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE Location_3 CHANGE location_2 location_2 INT DEFAULT 0 NOT NULL, CHANGE location_1 location_1 INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE Location_4 CHANGE location_3 location_3 INT DEFAULT 0 NOT NULL, CHANGE location_2 location_2 INT DEFAULT 0 NOT NULL, CHANGE location_1 location_1 INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE Location_5 CHANGE location_4 location_4 INT DEFAULT 0 NOT NULL, CHANGE location_3 location_3 INT DEFAULT 0 NOT NULL, CHANGE location_2 location_2 INT DEFAULT 0 NOT NULL, CHANGE location_1 location_1 INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE Profile CHANGE account_id account_id INT NOT NULL, CHANGE friendly_url friendly_url VARCHAR(255) DEFAULT \'MD5(account_id)\' NOT NULL, CHANGE profile_complete profile_complete CHAR(1) DEFAULT \'n\' NOT NULL');
        $this->addSql('ALTER TABLE Registration CHANGE date_time date_time DATETIME DEFAULT \'0000-00-00 00:00:00\' NOT NULL');
        $this->addSql('ALTER TABLE RobotsFilter CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE value value CHAR(15) DEFAULT NULL');
        $this->addSql('ALTER TABLE SMAccount CHANGE updated updated DATETIME DEFAULT \'0000-00-00 00:00:00\' NOT NULL, CHANGE entered entered DATETIME DEFAULT \'0000-00-00 00:00:00\' NOT NULL, CHANGE faillogin_count faillogin_count INT DEFAULT 0 NOT NULL, CHANGE faillogin_datetime faillogin_datetime DATETIME DEFAULT \'0000-00-00 00:00:00\' NOT NULL, CHANGE active active VARCHAR(1) DEFAULT \'y\' NOT NULL');
        $this->addSql('ALTER TABLE Setting CHANGE name name VARCHAR(255) NOT NULL');
    }
}
