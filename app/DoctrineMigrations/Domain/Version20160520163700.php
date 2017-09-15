<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160520163700 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('SET FOREIGN_KEY_CHECKS=0');

        $this->addSql('DROP INDEX image_id ON AccountProfileContact');
        $this->addSql('ALTER TABLE AccountProfileContact CHANGE nickname nickname VARCHAR(100) DEFAULT NULL, CHANGE friendly_url friendly_url VARCHAR(255) DEFAULT NULL, CHANGE image_id image_id INT DEFAULT NULL, CHANGE facebook_image facebook_image VARCHAR(255) DEFAULT NULL, CHANGE facebook_image_height facebook_image_height INT DEFAULT NULL, CHANGE facebook_image_width facebook_image_width INT DEFAULT NULL, CHANGE has_profile has_profile VARCHAR(1) DEFAULT \'y\' NOT NULL');
        $this->addSql('ALTER TABLE CheckIn DROP FOREIGN KEY FK_BB5A01AF7597D3FE');
        $this->addSql('ALTER TABLE CheckIn CHANGE member_id member_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE CheckIn ADD CONSTRAINT FK_BB5A01AF7597D3FE FOREIGN KEY (member_id) REFERENCES AccountProfileContact (account_id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Review DROP FOREIGN KEY FK_7EEF84F07597D3FE');
        $this->addSql('ALTER TABLE Review ADD CONSTRAINT FK_7EEF84F07597D3FE FOREIGN KEY (member_id) REFERENCES AccountProfileContact (account_id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Article DROP FOREIGN KEY FK_CD8737FA9B6B5FBA');
        $this->addSql('ALTER TABLE Article CHANGE account_id account_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Article ADD CONSTRAINT FK_CD8737FA9B6B5FBA FOREIGN KEY (account_id) REFERENCES AccountProfileContact (account_id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Listing DROP FOREIGN KEY FK_4BD71489B6B5FBA');
        $this->addSql('ALTER TABLE Listing CHANGE account_id account_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Listing ADD CONSTRAINT FK_4BD71489B6B5FBA FOREIGN KEY (account_id) REFERENCES AccountProfileContact (account_id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Comments DROP FOREIGN KEY FK_A6E8F47C7597D3FE');
        $this->addSql('ALTER TABLE Comments CHANGE member_id member_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Comments ADD CONSTRAINT FK_A6E8F47C7597D3FE FOREIGN KEY (member_id) REFERENCES AccountProfileContact (account_id) ON DELETE CASCADE');

        $this->addSql('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('SET FOREIGN_KEY_CHECKS=0');

        $this->addSql('ALTER TABLE AccountProfileContact CHANGE nickname nickname VARCHAR(100) NOT NULL, CHANGE friendly_url friendly_url VARCHAR(255) NOT NULL, CHANGE image_id image_id INT NOT NULL, CHANGE facebook_image facebook_image VARCHAR(255) NOT NULL, CHANGE facebook_image_height facebook_image_height INT NOT NULL, CHANGE facebook_image_width facebook_image_width INT NOT NULL, CHANGE has_profile has_profile VARCHAR(1) NOT NULL');
        $this->addSql('CREATE INDEX image_id ON AccountProfileContact (image_id, has_profile)');
        $this->addSql('ALTER TABLE Article DROP FOREIGN KEY FK_CD8737FA9B6B5FBA');
        $this->addSql('ALTER TABLE Article CHANGE account_id account_id INT NOT NULL');
        $this->addSql('ALTER TABLE Article ADD CONSTRAINT FK_CD8737FA9B6B5FBA FOREIGN KEY (account_id) REFERENCES AccountProfileContact (account_id)');
        $this->addSql('ALTER TABLE CheckIn DROP FOREIGN KEY FK_BB5A01AF7597D3FE');
        $this->addSql('ALTER TABLE CheckIn CHANGE member_id member_id INT NOT NULL');
        $this->addSql('ALTER TABLE CheckIn ADD CONSTRAINT FK_BB5A01AF7597D3FE FOREIGN KEY (member_id) REFERENCES AccountProfileContact (account_id)');
        $this->addSql('ALTER TABLE Comments DROP FOREIGN KEY FK_A6E8F47C7597D3FE');
        $this->addSql('ALTER TABLE Comments CHANGE member_id member_id INT NOT NULL');
        $this->addSql('ALTER TABLE Comments ADD CONSTRAINT FK_A6E8F47C7597D3FE FOREIGN KEY (member_id) REFERENCES AccountProfileContact (account_id)');
        $this->addSql('ALTER TABLE Listing DROP FOREIGN KEY FK_4BD71489B6B5FBA');
        $this->addSql('ALTER TABLE Listing CHANGE account_id account_id INT NOT NULL');
        $this->addSql('ALTER TABLE Listing ADD CONSTRAINT FK_4BD71489B6B5FBA FOREIGN KEY (account_id) REFERENCES AccountProfileContact (account_id)');
        $this->addSql('ALTER TABLE Review DROP FOREIGN KEY FK_7EEF84F07597D3FE');
        $this->addSql('ALTER TABLE Review ADD CONSTRAINT FK_7EEF84F07597D3FE FOREIGN KEY (member_id) REFERENCES AccountProfileContact (account_id)');

        $this->addSql('SET FOREIGN_KEY_CHECKS=1');
    }
}
