<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161206105441 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE BannerLevel DROP content');
        $this->addSql('ALTER TABLE ArticleLevel DROP content');
        $this->addSql('ALTER TABLE ClassifiedLevel DROP content');
        $this->addSql('ALTER TABLE EventLevel DROP content');
        $this->addSql('ALTER TABLE ListingLevel DROP content');
        $this->addSql('ALTER TABLE Page CHANGE sitemap sitemap TINYINT(1) DEFAULT \'0\' NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ArticleLevel ADD content LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE BannerLevel ADD content LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE ClassifiedLevel ADD content LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE EventLevel ADD content LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE ListingLevel ADD content LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE Page CHANGE sitemap sitemap INT DEFAULT NULL');
    }
}
