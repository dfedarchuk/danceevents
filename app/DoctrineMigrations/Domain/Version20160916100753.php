<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160916100753 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Theme (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Widget (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, twig_file VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Page_Widget (id INT AUTO_INCREMENT NOT NULL, page_id INT NOT NULL, widget_id INT NOT NULL, content VARCHAR(255) DEFAULT NULL, `order` VARCHAR(255) NOT NULL, INDEX IDX_6B1F622FC4663E4 (page_id), INDEX IDX_6B1F622FFBE885E2 (widget_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Page (id INT AUTO_INCREMENT NOT NULL, pagetype_id INT NOT NULL, title VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, meta_description VARCHAR(255) DEFAULT NULL, meta_key VARCHAR(255) DEFAULT NULL, sitemap TINYINT(1) DEFAULT NULL, custom_tag VARCHAR(255) DEFAULT NULL, INDEX IDX_B438191E53A99D0E (pagetype_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE PageType (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Widget_Theme (id INT AUTO_INCREMENT NOT NULL, widget_id INT NOT NULL, theme_id INT NOT NULL, INDEX IDX_15C34AE2FBE885E2 (widget_id), INDEX IDX_15C34AE259027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Widget_PageType (id INT AUTO_INCREMENT NOT NULL, widget_id INT NOT NULL, pagetype_id INT NOT NULL, INDEX IDX_30E66895FBE885E2 (widget_id), INDEX IDX_30E6689553A99D0E (pagetype_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Page_Widget ADD CONSTRAINT FK_6B1F622FC4663E4 FOREIGN KEY (page_id) REFERENCES Page (id)');
        $this->addSql('ALTER TABLE Page_Widget ADD CONSTRAINT FK_6B1F622FFBE885E2 FOREIGN KEY (widget_id) REFERENCES Widget (id)');
        $this->addSql('ALTER TABLE Page ADD CONSTRAINT FK_B438191E53A99D0E FOREIGN KEY (pagetype_id) REFERENCES PageType (id)');
        $this->addSql('ALTER TABLE Widget_Theme ADD CONSTRAINT FK_15C34AE2FBE885E2 FOREIGN KEY (widget_id) REFERENCES Widget (id)');
        $this->addSql('ALTER TABLE Widget_Theme ADD CONSTRAINT FK_15C34AE259027487 FOREIGN KEY (theme_id) REFERENCES Theme (id)');
        $this->addSql('ALTER TABLE Widget_PageType ADD CONSTRAINT FK_30E66895FBE885E2 FOREIGN KEY (widget_id) REFERENCES Widget (id)');
        $this->addSql('ALTER TABLE Widget_PageType ADD CONSTRAINT FK_30E6689553A99D0E FOREIGN KEY (pagetype_id) REFERENCES PageType (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Widget_Theme DROP FOREIGN KEY FK_15C34AE259027487');
        $this->addSql('ALTER TABLE Page_Widget DROP FOREIGN KEY FK_6B1F622FFBE885E2');
        $this->addSql('ALTER TABLE Widget_Theme DROP FOREIGN KEY FK_15C34AE2FBE885E2');
        $this->addSql('ALTER TABLE Widget_PageType DROP FOREIGN KEY FK_30E66895FBE885E2');
        $this->addSql('ALTER TABLE Page_Widget DROP FOREIGN KEY FK_6B1F622FC4663E4');
        $this->addSql('ALTER TABLE Page DROP FOREIGN KEY FK_B438191E53A99D0E');
        $this->addSql('ALTER TABLE Widget_PageType DROP FOREIGN KEY FK_30E6689553A99D0E');
        $this->addSql('DROP TABLE Theme');
        $this->addSql('DROP TABLE Widget');
        $this->addSql('DROP TABLE Page_Widget');
        $this->addSql('DROP TABLE Page');
        $this->addSql('DROP TABLE PageType');
        $this->addSql('DROP TABLE Widget_Theme');
        $this->addSql('DROP TABLE Widget_PageType');
    }
}
