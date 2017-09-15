<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170123165856 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE Content');
        $this->addSql('ALTER TABLE Banner CHANGE target_window target_window INT NOT NULL, CHANGE type type INT NOT NULL');
        $this->addSql('ALTER TABLE Payment_Banner_Log CHANGE level level INT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Content (id INT AUTO_INCREMENT NOT NULL, updated DATETIME NOT NULL, type VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, keywords LONGTEXT NOT NULL, url VARCHAR(255) NOT NULL, section VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, sitemap INT NOT NULL, INDEX section (section), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Banner CHANGE target_window target_window INT DEFAULT 1 NOT NULL, CHANGE type type INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE Payment_Banner_Log CHANGE level level INT DEFAULT 0 NOT NULL');
    }
}
