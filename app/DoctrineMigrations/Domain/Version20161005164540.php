<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161005164540 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Page_Widget ADD theme_id INT NOT NULL');
        $this->addSql('ALTER TABLE Page_Widget ADD CONSTRAINT FK_6B1F622F59027487 FOREIGN KEY (theme_id) REFERENCES Theme (id)');
        $this->addSql('CREATE INDEX IDX_6B1F622F59027487 ON Page_Widget (theme_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Page_Widget DROP FOREIGN KEY FK_6B1F622F59027487');
        $this->addSql('DROP INDEX IDX_6B1F622F59027487 ON Page_Widget');
        $this->addSql('ALTER TABLE Page_Widget DROP theme_id');
    }
}
