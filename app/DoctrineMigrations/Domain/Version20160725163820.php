<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160725163820 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE AppAdvert');
        $this->addSql('DROP TABLE AppNotification');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE AppAdvert (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(25) NOT NULL, image_id INT NOT NULL, url VARCHAR(255) NOT NULL, device VARCHAR(15) NOT NULL, expiration_date DATE NOT NULL, status VARCHAR(1) NOT NULL, entered DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE AppNotification (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(25) NOT NULL, description VARCHAR(200) NOT NULL, expiration_date DATE NOT NULL, status VARCHAR(1) NOT NULL, entered DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }
}
