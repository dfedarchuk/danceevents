<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160722160734 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Location_1 ADD page_title VARCHAR(255) DEFAULT NULL, CHANGE abbreviation abbreviation VARCHAR(100) NOT NULL, CHANGE seo_description seo_description VARCHAR(255) NOT NULL, CHANGE seo_keywords seo_keywords VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE Location_2 ADD page_title VARCHAR(255) DEFAULT NULL, CHANGE abbreviation abbreviation VARCHAR(100) NOT NULL, CHANGE seo_description seo_description VARCHAR(255) NOT NULL, CHANGE seo_keywords seo_keywords VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE Location_3 ADD page_title VARCHAR(255) DEFAULT NULL, CHANGE abbreviation abbreviation VARCHAR(100) NOT NULL, CHANGE seo_description seo_description VARCHAR(255) NOT NULL, CHANGE seo_keywords seo_keywords VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE Location_4 ADD page_title VARCHAR(255) DEFAULT NULL, CHANGE abbreviation abbreviation VARCHAR(100) NOT NULL, CHANGE seo_description seo_description VARCHAR(255) NOT NULL, CHANGE seo_keywords seo_keywords VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE Location_5 ADD page_title VARCHAR(255) DEFAULT NULL, CHANGE abbreviation abbreviation VARCHAR(100) NOT NULL, CHANGE seo_description seo_description VARCHAR(255) NOT NULL, CHANGE seo_keywords seo_keywords VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Location_1 DROP page_title, CHANGE abbreviation abbreviation VARCHAR(100) DEFAULT NULL, CHANGE seo_description seo_description VARCHAR(255) DEFAULT NULL, CHANGE seo_keywords seo_keywords VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE Location_2 DROP page_title, CHANGE abbreviation abbreviation VARCHAR(100) DEFAULT NULL, CHANGE seo_description seo_description VARCHAR(255) DEFAULT NULL, CHANGE seo_keywords seo_keywords VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE Location_3 DROP page_title, CHANGE abbreviation abbreviation VARCHAR(100) DEFAULT NULL, CHANGE seo_description seo_description VARCHAR(255) DEFAULT NULL, CHANGE seo_keywords seo_keywords VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE Location_4 DROP page_title, CHANGE abbreviation abbreviation VARCHAR(100) DEFAULT NULL, CHANGE seo_description seo_description VARCHAR(255) DEFAULT NULL, CHANGE seo_keywords seo_keywords VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE Location_5 DROP page_title, CHANGE abbreviation abbreviation VARCHAR(100) DEFAULT NULL, CHANGE seo_description seo_description VARCHAR(255) DEFAULT NULL, CHANGE seo_keywords seo_keywords VARCHAR(255) DEFAULT NULL');
    }
}
