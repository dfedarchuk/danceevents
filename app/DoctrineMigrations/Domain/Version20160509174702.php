<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160509174702 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Listing_Category DROP FOREIGN KEY FK_E796290BEDE28F8');
        $this->addSql('ALTER TABLE Listing_Category ADD CONSTRAINT FK_E796290BEDE28F8 FOREIGN KEY (category_root_id) REFERENCES ListingCategory (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Listing_Category DROP FOREIGN KEY FK_E796290BEDE28F8');
        $this->addSql('ALTER TABLE Listing_Category ADD CONSTRAINT FK_E796290BEDE28F8 FOREIGN KEY (category_root_id) REFERENCES Listing_Category (id) ON DELETE CASCADE');
    }
}
