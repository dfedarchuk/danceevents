<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160603120126 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Classified ADD listing_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Classified ADD CONSTRAINT FK_FF1BC476D4619D1A FOREIGN KEY (listing_id) REFERENCES Listing (id)');
        $this->addSql('CREATE INDEX IDX_FF1BC476D4619D1A ON Classified (listing_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Classified DROP FOREIGN KEY FK_FF1BC476D4619D1A');
        $this->addSql('DROP INDEX IDX_FF1BC476D4619D1A ON Classified');
        $this->addSql('ALTER TABLE Classified DROP listing_id');
    }
}
