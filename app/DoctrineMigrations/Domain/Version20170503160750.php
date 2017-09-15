<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170503160750 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE Classified_LocationCounter');
        $this->addSql('DROP TABLE Event_LocationCounter');
        $this->addSql('DROP TABLE Listing_LocationCounter');
        $this->addSql('DROP TABLE Promotion_LocationCounter');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Classified_LocationCounter (id INT AUTO_INCREMENT NOT NULL, location_level INT NOT NULL, location_id INT NOT NULL, count INT NOT NULL, title VARCHAR(255) NOT NULL, full_friendly_url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Event_LocationCounter (id INT AUTO_INCREMENT NOT NULL, location_level INT NOT NULL, location_id INT NOT NULL, count INT NOT NULL, title VARCHAR(255) NOT NULL, full_friendly_url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Listing_LocationCounter (id INT AUTO_INCREMENT NOT NULL, location_level INT NOT NULL, location_id INT NOT NULL, count INT NOT NULL, title VARCHAR(255) NOT NULL, full_friendly_url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Promotion_LocationCounter (id INT AUTO_INCREMENT NOT NULL, location_level INT NOT NULL, location_id INT NOT NULL, count INT NOT NULL, title VARCHAR(255) NOT NULL, full_friendly_url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }
}
