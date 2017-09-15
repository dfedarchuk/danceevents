<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160922104406 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Widget ADD content LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE Page_Widget CHANGE content content LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE Page CHANGE sitemap sitemap TINYINT(1) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B438191EF47645AE ON Page (url)');
        $this->addSql('ALTER TABLE Page_Widget CHANGE `order` `order` INT NOT NULL');
        $this->addSql('ALTER TABLE Widget ADD `type` VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Page CHANGE sitemap sitemap INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Page_Widget CHANGE content content VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE Widget DROP content');
        $this->addSql('DROP INDEX UNIQ_B438191EF47645AE ON Page');
        $this->addSql('ALTER TABLE Page_Widget CHANGE `order` `order` VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE Widget DROP `type`');

    }
}
