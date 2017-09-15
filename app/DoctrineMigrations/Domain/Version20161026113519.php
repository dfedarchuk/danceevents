<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161026113519 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('SET FOREIGN_KEY_CHECKS=0');
            $this->addSql('ALTER TABLE Slider DROP FOREIGN KEY FK_C86B15313DA5256D');
            $this->addSql('ALTER TABLE Slider CHANGE image_id image_id INT DEFAULT NULL');
            $this->addSql('ALTER TABLE Slider ADD CONSTRAINT FK_C86B15313DA5256D FOREIGN KEY (image_id) REFERENCES Image (id) ON DELETE SET NULL');
        $this->addSql('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('SET FOREIGN_KEY_CHECKS=0');
            $this->addSql('ALTER TABLE Slider DROP FOREIGN KEY FK_C86B15313DA5256D');
            $this->addSql('ALTER TABLE Slider CHANGE image_id image_id INT NOT NULL');
            $this->addSql('ALTER TABLE Slider ADD CONSTRAINT FK_C86B15313DA5256D FOREIGN KEY (image_id) REFERENCES Image (id)');
        $this->addSql('SET FOREIGN_KEY_CHECKS=1');
    }
}
