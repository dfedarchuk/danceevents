<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170502204046 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX active_article ON ArticleCategory');
        $this->addSql('ALTER TABLE ArticleCategory DROP active_article');
        $this->addSql('DROP INDEX active_classified ON ClassifiedCategory');
        $this->addSql('ALTER TABLE ClassifiedCategory DROP active_classified');
        $this->addSql('DROP INDEX active_event ON EventCategory');
        $this->addSql('ALTER TABLE EventCategory DROP active_event');
        $this->addSql('DROP INDEX active_listing ON ListingCategory');
        $this->addSql('DROP INDEX category_id_2 ON ListingCategory');
        $this->addSql('ALTER TABLE ListingCategory DROP active_listing');
        $this->addSql('DROP INDEX active_post ON BlogCategory');
        $this->addSql('ALTER TABLE BlogCategory DROP active_post');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ArticleCategory ADD active_article INT NOT NULL');
        $this->addSql('CREATE INDEX active_article ON ArticleCategory (active_article)');
        $this->addSql('ALTER TABLE BlogCategory ADD active_post INT NOT NULL');
        $this->addSql('CREATE INDEX active_post ON BlogCategory (active_post)');
        $this->addSql('ALTER TABLE ClassifiedCategory ADD active_classified INT NOT NULL');
        $this->addSql('CREATE INDEX active_classified ON ClassifiedCategory (active_classified)');
        $this->addSql('ALTER TABLE EventCategory ADD active_event INT NOT NULL');
        $this->addSql('CREATE INDEX active_event ON EventCategory (active_event)');
        $this->addSql('ALTER TABLE ListingCategory ADD active_listing INT NOT NULL');
        $this->addSql('CREATE INDEX active_listing ON ListingCategory (active_listing)');
        $this->addSql('CREATE INDEX category_id_2 ON ListingCategory (category_id, active_listing)');
    }
}
