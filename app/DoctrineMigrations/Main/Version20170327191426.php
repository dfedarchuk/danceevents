<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170327191426 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Profile ADD CONSTRAINT FK_4EEA93939B6B5FBA FOREIGN KEY (account_id) REFERENCES Account (id)');
        $this->addSql('ALTER TABLE Location_1 ADD latitude VARCHAR(50) DEFAULT NULL, ADD longitude VARCHAR(50) DEFAULT NULL, ADD radius INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Location_2 ADD latitude VARCHAR(50) DEFAULT NULL, ADD longitude VARCHAR(50) DEFAULT NULL, ADD radius INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Location_3 ADD latitude VARCHAR(50) DEFAULT NULL, ADD longitude VARCHAR(50) DEFAULT NULL, ADD radius INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Location_5 ADD latitude VARCHAR(50) DEFAULT NULL, ADD longitude VARCHAR(50) DEFAULT NULL, ADD radius INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Location_4 ADD latitude VARCHAR(50) DEFAULT NULL, ADD longitude VARCHAR(50) DEFAULT NULL, ADD radius INT DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Location_1 DROP latitude, DROP longitude, DROP radius');
        $this->addSql('ALTER TABLE Location_2 DROP latitude, DROP longitude, DROP radius');
        $this->addSql('ALTER TABLE Location_3 DROP latitude, DROP longitude, DROP radius');
        $this->addSql('ALTER TABLE Location_4 DROP latitude, DROP longitude, DROP radius');
        $this->addSql('ALTER TABLE Location_5 DROP latitude, DROP longitude, DROP radius');
        $this->addSql('ALTER TABLE Profile DROP FOREIGN KEY FK_4EEA93939B6B5FBA');
    }
}
