<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161213171535 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX random_number ON Banner');
        $this->addSql('ALTER TABLE Banner DROP random_number');
        $this->addSql('DROP INDEX random_number ON Article');
        $this->addSql('ALTER TABLE Article DROP random_number');
        $this->addSql('DROP INDEX random_number ON Classified');
        $this->addSql('ALTER TABLE Classified DROP random_number');
        $this->addSql('DROP INDEX random_number ON Event');
        $this->addSql('ALTER TABLE Event DROP random_number');
        $this->addSql('DROP INDEX random_number ON Listing');
        $this->addSql('ALTER TABLE Listing DROP random_number');
        $this->addSql('DROP INDEX random_number ON Promotion');
        $this->addSql('ALTER TABLE Promotion DROP random_number');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Article ADD random_number BIGINT DEFAULT \'0\' NOT NULL');
        $this->addSql('CREATE INDEX random_number ON Article (random_number)');
        $this->addSql('ALTER TABLE Banner ADD random_number BIGINT DEFAULT \'0\' NOT NULL');
        $this->addSql('CREATE INDEX random_number ON Banner (random_number)');
        $this->addSql('ALTER TABLE Classified ADD random_number BIGINT DEFAULT \'0\' NOT NULL');
        $this->addSql('CREATE INDEX random_number ON Classified (random_number)');
        $this->addSql('ALTER TABLE Event ADD random_number BIGINT DEFAULT \'0\' NOT NULL');
        $this->addSql('CREATE INDEX random_number ON Event (random_number)');
        $this->addSql('ALTER TABLE Listing ADD random_number BIGINT DEFAULT \'0\' NOT NULL');
        $this->addSql('CREATE INDEX random_number ON Listing (random_number)');
        $this->addSql('ALTER TABLE Promotion ADD random_number BIGINT DEFAULT \'0\' NOT NULL');
        $this->addSql('CREATE INDEX random_number ON Promotion (random_number)');
    }
}
