<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160721165236 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ArticleCategory CHANGE featured featured VARCHAR(1) DEFAULT \'n\' NOT NULL, CHANGE count_sub count_sub INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE ClassifiedCategory CHANGE featured featured VARCHAR(1) DEFAULT \'n\' NOT NULL, CHANGE count_sub count_sub INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE EventCategory CHANGE count_sub count_sub INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE ListingCategory CHANGE category_id category_id INT DEFAULT NULL, CHANGE count_sub count_sub INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE BlogCategory CHANGE root_id root_id INT DEFAULT NULL, CHANGE `left` `left` INT DEFAULT NULL, CHANGE `right` `right` INT DEFAULT NULL, CHANGE featured featured VARCHAR(1) DEFAULT \'n\' NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ArticleCategory CHANGE featured featured VARCHAR(1) NOT NULL, CHANGE count_sub count_sub INT NOT NULL');
        $this->addSql('ALTER TABLE BlogCategory CHANGE root_id root_id INT NOT NULL, CHANGE `left` `left` INT NOT NULL, CHANGE `right` `right` INT NOT NULL, CHANGE featured featured VARCHAR(1) NOT NULL');
        $this->addSql('ALTER TABLE ClassifiedCategory CHANGE featured featured VARCHAR(1) NOT NULL, CHANGE count_sub count_sub INT NOT NULL');
        $this->addSql('ALTER TABLE EventCategory CHANGE count_sub count_sub INT NOT NULL');
        $this->addSql('ALTER TABLE ListingCategory CHANGE category_id category_id INT NOT NULL, CHANGE count_sub count_sub INT NOT NULL');
    }
}
