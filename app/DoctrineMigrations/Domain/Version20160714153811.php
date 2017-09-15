<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160714153811 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ListingTemplate CHANGE layout_id layout_id INT DEFAULT 0 NOT NULL, CHANGE status status VARCHAR(255) DEFAULT \'enabled\' NOT NULL, CHANGE price price NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL, CHANGE cat_id cat_id VARCHAR(255) DEFAULT NULL, CHANGE editable editable VARCHAR(1) DEFAULT \'y\' NOT NULL');
        $this->addSql('ALTER TABLE Listing_FeaturedTemp CHANGE random_number random_number BIGINT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ListingTemplate CHANGE layout_id layout_id INT NOT NULL, CHANGE status status VARCHAR(255) NOT NULL, CHANGE price price NUMERIC(10, 2) NOT NULL, CHANGE cat_id cat_id VARCHAR(255) NOT NULL, CHANGE editable editable VARCHAR(1) NOT NULL');
        $this->addSql('ALTER TABLE Listing_FeaturedTemp CHANGE random_number random_number BIGINT NOT NULL');
    }
}
