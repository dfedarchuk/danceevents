<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170711123315 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ArticleCategory DROP FOREIGN KEY FK_EE65E0C33DA5256D');
        $this->addSql('ALTER TABLE ArticleCategory ADD CONSTRAINT FK_EE65E0C33DA5256D FOREIGN KEY (image_id) REFERENCES Image (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE ClassifiedCategory DROP FOREIGN KEY FK_E226DCC3DA5256D');
        $this->addSql('ALTER TABLE ClassifiedCategory ADD CONSTRAINT FK_E226DCC3DA5256D FOREIGN KEY (image_id) REFERENCES Image (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE EventCategory DROP FOREIGN KEY FK_BD5B78B03DA5256D');
        $this->addSql('ALTER TABLE EventCategory ADD CONSTRAINT FK_BD5B78B03DA5256D FOREIGN KEY (image_id) REFERENCES Image (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE BlogCategory DROP FOREIGN KEY FK_7FB5FC913DA5256D');
        $this->addSql('ALTER TABLE BlogCategory ADD CONSTRAINT FK_7FB5FC913DA5256D FOREIGN KEY (image_id) REFERENCES Image (id) ON DELETE SET NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ArticleCategory DROP FOREIGN KEY FK_EE65E0C33DA5256D');
        $this->addSql('ALTER TABLE ArticleCategory ADD CONSTRAINT FK_EE65E0C33DA5256D FOREIGN KEY (image_id) REFERENCES Image (id)');
        $this->addSql('ALTER TABLE BlogCategory DROP FOREIGN KEY FK_7FB5FC913DA5256D');
        $this->addSql('ALTER TABLE BlogCategory ADD CONSTRAINT FK_7FB5FC913DA5256D FOREIGN KEY (image_id) REFERENCES Image (id)');
        $this->addSql('ALTER TABLE ClassifiedCategory DROP FOREIGN KEY FK_E226DCC3DA5256D');
        $this->addSql('ALTER TABLE ClassifiedCategory ADD CONSTRAINT FK_E226DCC3DA5256D FOREIGN KEY (image_id) REFERENCES Image (id)');
        $this->addSql('ALTER TABLE EventCategory DROP FOREIGN KEY FK_BD5B78B03DA5256D');
        $this->addSql('ALTER TABLE EventCategory ADD CONSTRAINT FK_BD5B78B03DA5256D FOREIGN KEY (image_id) REFERENCES Image (id)');
    }
}
