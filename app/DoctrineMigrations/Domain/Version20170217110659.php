<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170217110659 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX legacy_id ON BlogCategory');
        $this->addSql('ALTER TABLE BlogCategory DROP legacy_id');
        $this->addSql('DROP INDEX legacy_id ON Comments');
        $this->addSql('ALTER TABLE Comments DROP legacy_id');
        $this->addSql('DROP INDEX legacy_id ON Post');
        $this->addSql('ALTER TABLE Post DROP legacy_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE BlogCategory ADD legacy_id VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX legacy_id ON BlogCategory (legacy_id)');
        $this->addSql('ALTER TABLE Comments ADD legacy_id VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX legacy_id ON Comments (legacy_id)');
        $this->addSql('ALTER TABLE Post ADD legacy_id VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX legacy_id ON Post (legacy_id)');
    }
}
