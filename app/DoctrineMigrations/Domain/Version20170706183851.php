<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170706183851 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ListingCategory DROP FOREIGN KEY FK_1C89DF3B3DA5256D');
        $this->addSql('ALTER TABLE ListingCategory ADD CONSTRAINT FK_1C89DF3B3DA5256D FOREIGN KEY (image_id) REFERENCES Image (id) ON DELETE SET NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ListingCategory DROP FOREIGN KEY FK_1C89DF3B3DA5256D');
        $this->addSql('ALTER TABLE ListingCategory ADD CONSTRAINT FK_1C89DF3B3DA5256D FOREIGN KEY (image_id) REFERENCES Image (id)');
    }
}
