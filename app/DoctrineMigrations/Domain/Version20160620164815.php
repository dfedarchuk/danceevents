<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160620164815 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Timeline CHANGE new new VARCHAR(1) DEFAULT \'y\' NOT NULL');
        $this->addSql('ALTER TABLE Gallery_Image CHANGE image_caption image_caption VARCHAR(255) DEFAULT NULL, CHANGE thumb_caption thumb_caption VARCHAR(255) DEFAULT NULL, CHANGE `order` `order` INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Gallery_Temp CHANGE image_caption image_caption VARCHAR(255) DEFAULT NULL, CHANGE thumb_caption thumb_caption VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE Article ADD CONSTRAINT FK_CD8737FA3DA5256D FOREIGN KEY (image_id) REFERENCES Image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CD8737FA3DA5256D ON Article (image_id)');
        // Custom SQL
        $this->addSql('UPDATE Classified SET image_id = NULL WHERE image_id = 0');

        $this->addSql('ALTER TABLE Classified ADD CONSTRAINT FK_FF1BC4763DA5256D FOREIGN KEY (image_id) REFERENCES Image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FF1BC4763DA5256D ON Classified (image_id)');
        $this->addSql('DROP INDEX promotion_id ON Listing');
        $this->addSql('DROP INDEX Listing_Promotion ON Listing');
        $this->addSql('ALTER TABLE Listing DROP promotion_id');
        $this->addSql('CREATE INDEX Listing_Promotion ON Listing (level, account_id, title, id)');
        $this->addSql('ALTER TABLE ListingLevel ADD deals INT DEFAULT 0 NOT NULL, DROP has_promotion');
        $this->addSql('ALTER TABLE Listing_FeaturedTemp CHANGE random_number random_number BIGINT NOT NULL');
        $this->addSql('ALTER TABLE Promotion_Redeem ADD CONSTRAINT FK_72024BBA139DF194 FOREIGN KEY (promotion_id) REFERENCES Promotion (id)');
        $this->addSql('CREATE INDEX IDX_72024BBA139DF194 ON Promotion_Redeem (promotion_id)');
        $this->addSql('ALTER TABLE Promotion DROP INDEX UNIQ_43ECFF72D4619D1A, ADD INDEX IDX_43ECFF72D4619D1A (listing_id)');
        $this->addSql('ALTER TABLE Promotion CHANGE random_number random_number BIGINT DEFAULT \'0\' NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Article DROP FOREIGN KEY FK_CD8737FA3DA5256D');
        $this->addSql('DROP INDEX UNIQ_CD8737FA3DA5256D ON Article');
        $this->addSql('ALTER TABLE Classified DROP FOREIGN KEY FK_FF1BC4763DA5256D');
        // Custom SQL
        $this->addSql('UPDATE Classified SET image_id = 0 WHERE image_id = NULL');

        $this->addSql('DROP INDEX UNIQ_FF1BC4763DA5256D ON Classified');
        $this->addSql('ALTER TABLE Gallery_Image CHANGE image_caption image_caption VARCHAR(255) NOT NULL, CHANGE thumb_caption thumb_caption VARCHAR(255) NOT NULL, CHANGE `order` `order` INT NOT NULL');
        $this->addSql('ALTER TABLE Gallery_Temp CHANGE image_caption image_caption VARCHAR(255) NOT NULL, CHANGE thumb_caption thumb_caption VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX Listing_Promotion ON Listing');
        $this->addSql('ALTER TABLE Listing ADD promotion_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX promotion_id ON Listing (promotion_id)');
        $this->addSql('CREATE INDEX Listing_Promotion ON Listing (level, promotion_id, account_id, title, id)');
        $this->addSql('ALTER TABLE ListingLevel ADD has_promotion VARCHAR(1) NOT NULL, DROP deals');
        $this->addSql('ALTER TABLE Listing_FeaturedTemp CHANGE random_number random_number BIGINT NOT NULL');
        $this->addSql('ALTER TABLE Promotion DROP INDEX IDX_43ECFF72D4619D1A, ADD UNIQUE INDEX UNIQ_43ECFF72D4619D1A (listing_id)');
        $this->addSql('ALTER TABLE Promotion CHANGE random_number random_number BIGINT NOT NULL');
        $this->addSql('ALTER TABLE Promotion_Redeem DROP FOREIGN KEY FK_72024BBA139DF194');
        $this->addSql('DROP INDEX IDX_72024BBA139DF194 ON Promotion_Redeem');
        $this->addSql('ALTER TABLE Timeline CHANGE new new VARCHAR(1) NOT NULL');
    }
}
