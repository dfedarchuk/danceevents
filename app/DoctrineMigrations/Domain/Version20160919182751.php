<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160919182751 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE Listing_Summary');
        $this->addSql('ALTER TABLE ArticleCategory DROP count_sub');
        $this->addSql('ALTER TABLE ClassifiedCategory DROP count_sub');
        $this->addSql('ALTER TABLE EventCategory DROP count_sub');
        $this->addSql('ALTER TABLE ListingCategory DROP count_sub');
        $this->addSql('ALTER TABLE Listing DROP INDEX `idx_fulltextsearch_keyword`, ADD FULLTEXT `fulltextsearch_keyword` (`fulltextsearch_keyword`(3))');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Listing_Summary (id INT AUTO_INCREMENT NOT NULL, account_id INT NOT NULL, location_1 INT NOT NULL, location_1_title VARCHAR(255) NOT NULL, location_1_abbreviation VARCHAR(100) NOT NULL, location_1_friendly_url VARCHAR(255) NOT NULL, location_2 INT NOT NULL, location_2_title VARCHAR(255) NOT NULL, location_2_abbreviation VARCHAR(100) NOT NULL, location_2_friendly_url VARCHAR(255) NOT NULL, location_3 INT NOT NULL, location_3_title VARCHAR(255) NOT NULL, location_3_abbreviation VARCHAR(100) NOT NULL, location_3_friendly_url VARCHAR(255) NOT NULL, location_4 INT NOT NULL, location_4_title VARCHAR(255) NOT NULL, location_4_abbreviation VARCHAR(100) NOT NULL, location_4_friendly_url VARCHAR(255) NOT NULL, location_5 INT NOT NULL, location_5_title VARCHAR(255) NOT NULL, location_5_abbreviation VARCHAR(100) NOT NULL, location_5_friendly_url VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, image_id INT NOT NULL, friendly_url VARCHAR(255) NOT NULL, email VARCHAR(50) NOT NULL, show_email VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, display_url VARCHAR(255) NOT NULL, address VARCHAR(50) NOT NULL, address2 VARCHAR(50) NOT NULL, zip_code VARCHAR(10) NOT NULL, latitude VARCHAR(50) NOT NULL, longitude VARCHAR(50) NOT NULL, maptuning VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) NOT NULL, fax VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, attachment_file VARCHAR(255) NOT NULL, attachment_caption VARCHAR(255) NOT NULL, status VARCHAR(1) NOT NULL, renewal_date DATE NOT NULL, level INT NOT NULL, random_number BIGINT DEFAULT \'0\' NOT NULL, claim_disable VARCHAR(1) NOT NULL, locations LONGTEXT NOT NULL, keywords LONGTEXT NOT NULL, seo_keywords VARCHAR(255) NOT NULL, fulltextsearch_keyword LONGTEXT NOT NULL, fulltextsearch_where LONGTEXT NOT NULL, custom_checkbox0 VARCHAR(1) NOT NULL, custom_checkbox1 VARCHAR(1) NOT NULL, custom_checkbox2 VARCHAR(1) NOT NULL, custom_checkbox3 VARCHAR(1) NOT NULL, custom_checkbox4 VARCHAR(1) NOT NULL, custom_checkbox5 VARCHAR(1) NOT NULL, custom_checkbox6 VARCHAR(1) NOT NULL, custom_checkbox7 VARCHAR(1) NOT NULL, custom_checkbox8 VARCHAR(1) NOT NULL, custom_checkbox9 VARCHAR(1) NOT NULL, custom_dropdown0 VARCHAR(255) NOT NULL, custom_dropdown1 VARCHAR(255) NOT NULL, custom_dropdown2 VARCHAR(255) NOT NULL, custom_dropdown3 VARCHAR(255) NOT NULL, custom_dropdown4 VARCHAR(255) NOT NULL, custom_dropdown5 VARCHAR(255) NOT NULL, custom_dropdown6 VARCHAR(255) NOT NULL, custom_dropdown7 VARCHAR(255) NOT NULL, custom_dropdown8 VARCHAR(255) NOT NULL, custom_dropdown9 VARCHAR(255) NOT NULL, custom_text0 VARCHAR(255) NOT NULL, custom_text1 VARCHAR(255) NOT NULL, custom_text2 VARCHAR(255) NOT NULL, custom_text3 VARCHAR(255) NOT NULL, custom_text4 VARCHAR(255) NOT NULL, custom_text5 VARCHAR(255) NOT NULL, custom_text6 VARCHAR(255) NOT NULL, custom_text7 VARCHAR(255) NOT NULL, custom_text8 VARCHAR(255) NOT NULL, custom_text9 VARCHAR(255) NOT NULL, custom_short_desc0 VARCHAR(255) NOT NULL, custom_short_desc1 VARCHAR(255) NOT NULL, custom_short_desc2 VARCHAR(255) NOT NULL, custom_short_desc3 VARCHAR(255) NOT NULL, custom_short_desc4 VARCHAR(255) NOT NULL, custom_short_desc5 VARCHAR(255) NOT NULL, custom_short_desc6 VARCHAR(255) NOT NULL, custom_short_desc7 VARCHAR(255) NOT NULL, custom_short_desc8 VARCHAR(255) NOT NULL, custom_short_desc9 VARCHAR(255) NOT NULL, custom_long_desc0 LONGTEXT NOT NULL, custom_long_desc1 LONGTEXT NOT NULL, custom_long_desc2 LONGTEXT NOT NULL, custom_long_desc3 LONGTEXT NOT NULL, custom_long_desc4 LONGTEXT NOT NULL, custom_long_desc5 LONGTEXT NOT NULL, custom_long_desc6 LONGTEXT NOT NULL, custom_long_desc7 LONGTEXT NOT NULL, custom_long_desc8 LONGTEXT NOT NULL, custom_long_desc9 LONGTEXT NOT NULL, number_views INT NOT NULL, avg_review INT NOT NULL, price INT DEFAULT NULL, promotion_start_date DATE NOT NULL, promotion_end_date DATE NOT NULL, thumb_id INT NOT NULL, thumb_type VARCHAR(255) NOT NULL, thumb_width SMALLINT NOT NULL, thumb_height SMALLINT NOT NULL, listingtemplate_id INT NOT NULL, template_layout_id INT NOT NULL, template_cat_id VARCHAR(255) NOT NULL, template_title VARCHAR(255) NOT NULL, template_status VARCHAR(255) NOT NULL, template_price NUMERIC(10, 2) NOT NULL, updated DATETIME NOT NULL, entered DATETIME NOT NULL, promotion_id INT DEFAULT NULL, backlink VARCHAR(1) NOT NULL, clicktocall_number VARCHAR(15) DEFAULT NULL, clicktocall_extension INT DEFAULT NULL, INDEX title (title), INDEX title_keywords_seokeywords (status, title), INDEX id_status (id, status), INDEX clicktocall_number (clicktocall_number), INDEX Listing_Promotion (level, promotion_id, account_id, title, id), INDEX rating_filter (level, status, avg_review), INDEX price_filter (level, status, price), FULLTEXT INDEX fulltextsearch_keyword (fulltextsearch_keyword), FULLTEXT INDEX fulltextsearch_where (fulltextsearch_where), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ArticleCategory ADD count_sub INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE ClassifiedCategory ADD count_sub INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE EventCategory ADD count_sub INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE ListingCategory ADD count_sub INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE Listing DROP INDEX `fulltextsearch_keyword`, ADD KEY `idx_fulltextsearch_keyword` (`fulltextsearch_keyword`(3))');
    }
}
