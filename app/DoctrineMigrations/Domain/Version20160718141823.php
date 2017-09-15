<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160718141823 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Invoice_Package ADD renewal_period VARCHAR(1) DEFAULT \'M\' NOT NULL');
        $this->addSql('ALTER TABLE Payment_Log CHANGE system_type system_type VARCHAR(255) DEFAULT NULL, CHANGE recurring recurring VARCHAR(1) DEFAULT \'n\' NOT NULL COMMENT \'y/n\', CHANGE notes notes LONGTEXT DEFAULT NULL, CHANGE return_fields return_fields LONGTEXT DEFAULT NULL, CHANGE hidden hidden VARCHAR(1) DEFAULT \'n\' NOT NULL COMMENT \'y/n\'');
        $this->addSql('ALTER TABLE Invoice_Listing ADD renewal_period VARCHAR(1) DEFAULT \'M\' NOT NULL');
        $this->addSql('ALTER TABLE BannerLevel ADD price_yearly NUMERIC(10, 2) DEFAULT NULL, ADD trial INT DEFAULT NULL, CHANGE price price NUMERIC(10, 2) DEFAULT NULL COMMENT \'monthly\', CHANGE popular popular VARCHAR(1) DEFAULT \'n\' NOT NULL, CHANGE content content LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE Invoice_Banner ADD renewal_period VARCHAR(1) DEFAULT \'M\' NOT NULL');
        $this->addSql('ALTER TABLE ArticleLevel ADD price_yearly NUMERIC(10, 2) DEFAULT NULL, ADD trial INT DEFAULT NULL, CHANGE price price NUMERIC(10, 2) DEFAULT NULL COMMENT \'monthly\', CHANGE content content LONGTEXT DEFAULT NULL, CHANGE featured featured VARCHAR(1) DEFAULT \'n\' NOT NULL');
        $this->addSql('ALTER TABLE Invoice_Article ADD renewal_period VARCHAR(1) DEFAULT \'M\' NOT NULL');
        $this->addSql('ALTER TABLE ClassifiedLevel ADD price_yearly NUMERIC(10, 2) DEFAULT NULL, ADD trial INT DEFAULT NULL, CHANGE price price NUMERIC(10, 2) DEFAULT NULL COMMENT \'monthly\', CHANGE popular popular VARCHAR(1) DEFAULT \'n\' NOT NULL, CHANGE featured featured VARCHAR(1) DEFAULT \'n\' NOT NULL, CHANGE content content LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE Invoice_Classified ADD renewal_period VARCHAR(1) DEFAULT \'M\' NOT NULL');
        $this->addSql('ALTER TABLE EventLevel ADD price_yearly NUMERIC(10, 2) DEFAULT NULL, ADD trial INT DEFAULT NULL, CHANGE price price NUMERIC(10, 2) DEFAULT NULL COMMENT \'monthly\', CHANGE popular popular VARCHAR(1) DEFAULT \'n\' NOT NULL, CHANGE featured featured VARCHAR(1) DEFAULT \'n\' NOT NULL, CHANGE content content LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE Invoice_Event ADD renewal_period VARCHAR(1) DEFAULT \'M\' NOT NULL');
        $this->addSql('ALTER TABLE ListingLevel ADD price_yearly NUMERIC(10, 2) DEFAULT NULL, ADD trial INT DEFAULT NULL, CHANGE price price NUMERIC(10, 2) DEFAULT NULL COMMENT \'monthly\', CHANGE popular popular VARCHAR(1) DEFAULT \'n\' NOT NULL, CHANGE featured featured VARCHAR(1) DEFAULT \'n\' NOT NULL, CHANGE content content LONGTEXT DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ArticleLevel DROP price_yearly, DROP trial, CHANGE price price NUMERIC(10, 2) NOT NULL, CHANGE content content LONGTEXT NOT NULL, CHANGE featured featured VARCHAR(1) NOT NULL');
        $this->addSql('ALTER TABLE BannerLevel DROP price_yearly, DROP trial, CHANGE price price NUMERIC(10, 2) NOT NULL, CHANGE popular popular VARCHAR(1) NOT NULL, CHANGE content content LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE ClassifiedLevel DROP price_yearly, DROP trial, CHANGE price price NUMERIC(10, 2) NOT NULL, CHANGE popular popular VARCHAR(1) NOT NULL, CHANGE featured featured VARCHAR(1) NOT NULL, CHANGE content content LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE EventLevel DROP price_yearly, DROP trial, CHANGE price price NUMERIC(10, 2) NOT NULL, CHANGE popular popular VARCHAR(1) NOT NULL, CHANGE featured featured VARCHAR(1) NOT NULL, CHANGE content content LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE Invoice_Article DROP renewal_period');
        $this->addSql('ALTER TABLE Invoice_Banner DROP renewal_period');
        $this->addSql('ALTER TABLE Invoice_Classified DROP renewal_period');
        $this->addSql('ALTER TABLE Invoice_Event DROP renewal_period');
        $this->addSql('ALTER TABLE Invoice_Listing DROP renewal_period');
        $this->addSql('ALTER TABLE Invoice_Package DROP renewal_period');
        $this->addSql('ALTER TABLE ListingLevel DROP price_yearly, DROP trial, CHANGE price price NUMERIC(10, 2) NOT NULL, CHANGE popular popular VARCHAR(1) NOT NULL, CHANGE featured featured VARCHAR(1) NOT NULL, CHANGE content content LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE Payment_Log CHANGE system_type system_type VARCHAR(255) NOT NULL, CHANGE recurring recurring VARCHAR(1) NOT NULL, CHANGE notes notes LONGTEXT NOT NULL, CHANGE return_fields return_fields LONGTEXT NOT NULL, CHANGE hidden hidden VARCHAR(1) NOT NULL');
    }
}
