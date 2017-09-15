<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170110161813 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Claim CHANGE old_level old_level INT NOT NULL, CHANGE new_level new_level INT NOT NULL');
        $this->addSql('ALTER TABLE Invoice_Listing CHANGE level level INT DEFAULT NULL, CHANGE categories categories INT NOT NULL');
        $this->addSql('ALTER TABLE Banner CHANGE target_window target_window INT DEFAULT \'1\' NOT NULL, CHANGE type type INT DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE Payment_Banner_Log CHANGE level level INT DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE Invoice_Banner CHANGE level level INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Invoice_Article CHANGE level level INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Invoice_Classified CHANGE level level INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Invoice_Event CHANGE level level INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Promotion CHANGE listing_level listing_level INT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Banner CHANGE target_window target_window TINYINT(1) DEFAULT \'1\' NOT NULL, CHANGE type type TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE Claim CHANGE old_level old_level TINYINT(1) NOT NULL, CHANGE new_level new_level TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE Invoice_Article CHANGE level level TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE Invoice_Banner CHANGE level level TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE Invoice_Classified CHANGE level level TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE Invoice_Event CHANGE level level TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE Invoice_Listing CHANGE level level TINYINT(1) DEFAULT NULL, CHANGE categories categories TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE Payment_Banner_Log CHANGE level level TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE Promotion CHANGE listing_level listing_level TINYINT(1) NOT NULL');
    }
}
