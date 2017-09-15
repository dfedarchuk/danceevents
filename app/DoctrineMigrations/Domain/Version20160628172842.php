<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160628172842 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE CheckIn');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE CheckIn (id INT AUTO_INCREMENT NOT NULL, member_id INT DEFAULT NULL, item_id INT NOT NULL, item_type VARCHAR(10) NOT NULL, added DATETIME NOT NULL, ip VARCHAR(20) DEFAULT NULL, quick_tip LONGTEXT DEFAULT NULL, checkin_name VARCHAR(255) DEFAULT NULL, INDEX listing_id (item_id), INDEX IDX_BB5A01AF7597D3FE (member_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE CheckIn ADD CONSTRAINT FK_BB5A01AF7597D3FE FOREIGN KEY (member_id) REFERENCES AccountProfileContact (account_id) ON DELETE CASCADE');
    }
}
