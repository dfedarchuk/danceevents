<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160523092234 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Account DROP INDEX username, ADD UNIQUE INDEX UNIQ_B28B6F38F85E0677 (username)');
        $this->addSql('DROP INDEX lastlogin ON Account');
        $this->addSql('ALTER TABLE Account CHANGE facebook_username facebook_username VARCHAR(100) DEFAULT NULL, CHANGE foreignaccount foreignaccount VARCHAR(1) DEFAULT NULL, CHANGE foreignaccount_done foreignaccount_done VARCHAR(1) DEFAULT NULL, CHANGE faillogin_datetime faillogin_datetime DATETIME DEFAULT NULL, CHANGE notify_traffic_listing notify_traffic_listing VARCHAR(1) DEFAULT \'n\'');
        $this->addSql('DROP INDEX entered ON Account_Activation');
        $this->addSql('ALTER TABLE Contact CHANGE account_id account_id INT NOT NULL, CHANGE company company VARCHAR(50) DEFAULT NULL, CHANGE address address VARCHAR(50) DEFAULT NULL, CHANGE city city VARCHAR(50) DEFAULT NULL, CHANGE state state VARCHAR(50) DEFAULT NULL, CHANGE zip zip VARCHAR(15) DEFAULT NULL, CHANGE country country VARCHAR(50) DEFAULT NULL, CHANGE phone phone VARCHAR(255) DEFAULT NULL, CHANGE fax fax VARCHAR(255) DEFAULT NULL, CHANGE url url VARCHAR(50) DEFAULT NULL, CHANGE importID importID INT DEFAULT 0, CHANGE importID_event importID_event INT DEFAULT 0');
        $this->addSql('ALTER TABLE Control_Cron CHANGE type type VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE Profile CHANGE account_id account_id INT NOT NULL, CHANGE image_id image_id INT DEFAULT NULL, CHANGE facebook_image facebook_image VARCHAR(255) DEFAULT NULL, CHANGE facebook_image_height facebook_image_height INT DEFAULT NULL, CHANGE facebook_image_width facebook_image_width INT DEFAULT NULL, CHANGE entered entered DATETIME DEFAULT NULL, CHANGE updated updated DATETIME DEFAULT NULL, CHANGE facebook_uid facebook_uid VARCHAR(250) DEFAULT NULL, CHANGE fb_post fb_post SMALLINT DEFAULT NULL, CHANGE tw_post tw_post SMALLINT DEFAULT NULL, CHANGE usefacebooklocation usefacebooklocation SMALLINT DEFAULT NULL, CHANGE tw_oauth_token tw_oauth_token VARCHAR(250) DEFAULT NULL, CHANGE location location VARCHAR(250) DEFAULT NULL, CHANGE tw_oauth_token_secret tw_oauth_token_secret VARCHAR(250) DEFAULT NULL, CHANGE tw_screen_name tw_screen_name VARCHAR(250) DEFAULT NULL, CHANGE profile_complete profile_complete VARCHAR(1) DEFAULT \'n\' NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Contact CHANGE account_id account_id INT AUTO_INCREMENT NOT NULL, CHANGE company company VARCHAR(50) NOT NULL, CHANGE address address VARCHAR(50) NOT NULL, CHANGE city city VARCHAR(50) NOT NULL, CHANGE state state VARCHAR(50) NOT NULL, CHANGE zip zip VARCHAR(15) NOT NULL, CHANGE country country VARCHAR(50) NOT NULL, CHANGE phone phone VARCHAR(255) NOT NULL, CHANGE fax fax VARCHAR(255) NOT NULL, CHANGE url url VARCHAR(50) NOT NULL, CHANGE importID importID INT DEFAULT 0 NOT NULL, CHANGE importID_event importID_event INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE Control_Cron CHANGE type type VARCHAR(50) DEFAULT \'\' NOT NULL');
        $this->addSql('ALTER TABLE Profile CHANGE account_id account_id INT AUTO_INCREMENT NOT NULL, CHANGE image_id image_id INT NOT NULL, CHANGE facebook_image facebook_image VARCHAR(255) NOT NULL, CHANGE facebook_image_height facebook_image_height INT NOT NULL, CHANGE facebook_image_width facebook_image_width INT NOT NULL, CHANGE entered entered DATETIME NOT NULL, CHANGE updated updated DATETIME NOT NULL, CHANGE facebook_uid facebook_uid VARCHAR(250) NOT NULL, CHANGE fb_post fb_post SMALLINT NOT NULL, CHANGE tw_post tw_post SMALLINT NOT NULL, CHANGE usefacebooklocation usefacebooklocation SMALLINT NOT NULL, CHANGE tw_oauth_token tw_oauth_token VARCHAR(250) NOT NULL, CHANGE location location VARCHAR(250) NOT NULL, CHANGE tw_oauth_token_secret tw_oauth_token_secret VARCHAR(250) NOT NULL, CHANGE tw_screen_name tw_screen_name VARCHAR(250) NOT NULL, CHANGE profile_complete profile_complete VARCHAR(1) NOT NULL');
        $this->addSql('ALTER TABLE Account DROP INDEX UNIQ_B28B6F38F85E0677, ADD INDEX username (username)');
        $this->addSql('ALTER TABLE Account CHANGE facebook_username facebook_username VARCHAR(100) NOT NULL, CHANGE foreignaccount foreignaccount VARCHAR(1) NOT NULL, CHANGE foreignaccount_done foreignaccount_done VARCHAR(1) NOT NULL, CHANGE faillogin_datetime faillogin_datetime DATETIME DEFAULT \'0000-00-00 00:00:00\' NOT NULL, CHANGE notify_traffic_listing notify_traffic_listing VARCHAR(1) DEFAULT NULL');
        $this->addSql('CREATE INDEX lastlogin ON Account (lastlogin)');
        $this->addSql('CREATE INDEX entered ON Account_Activation (entered)');
    }
}
