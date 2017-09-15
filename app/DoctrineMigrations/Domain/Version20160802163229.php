<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160802163229 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        /* Custom SQL */
        $this->addSql('UPDATE Article SET cat_1_id = NULL WHERE cat_1_id = 0;');
        $this->addSql('UPDATE Article SET cat_2_id = NULL WHERE cat_2_id = 0;');
        $this->addSql('UPDATE Article SET cat_3_id = NULL WHERE cat_3_id = 0;');
        $this->addSql('UPDATE Article SET cat_4_id = NULL WHERE cat_4_id = 0;');
        $this->addSql('UPDATE Article SET cat_5_id = NULL WHERE cat_5_id = 0;');

        $this->addSql('ALTER TABLE Article DROP FOREIGN KEY FK_CD8737FA47E963C0');
        $this->addSql('ALTER TABLE Article DROP FOREIGN KEY FK_CD8737FA62823C1C');
        $this->addSql('ALTER TABLE Article DROP FOREIGN KEY FK_CD8737FADA3E5B79');
        $this->addSql('ALTER TABLE Article DROP FOREIGN KEY FK_CD8737FAEDE0AB4B');
        $this->addSql('ALTER TABLE Article DROP FOREIGN KEY FK_CD8737FAFF5504A5');
        $this->addSql('ALTER TABLE Article ADD CONSTRAINT FK_CD8737FA47E963C0 FOREIGN KEY (cat_3_id) REFERENCES ArticleCategory (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Article ADD CONSTRAINT FK_CD8737FA62823C1C FOREIGN KEY (cat_5_id) REFERENCES ArticleCategory (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Article ADD CONSTRAINT FK_CD8737FADA3E5B79 FOREIGN KEY (cat_4_id) REFERENCES ArticleCategory (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Article ADD CONSTRAINT FK_CD8737FAEDE0AB4B FOREIGN KEY (cat_1_id) REFERENCES ArticleCategory (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Article ADD CONSTRAINT FK_CD8737FAFF5504A5 FOREIGN KEY (cat_2_id) REFERENCES ArticleCategory (id) ON DELETE SET NULL');

        /* Custom SQL */
        $this->addSql('UPDATE Classified SET cat_1_id = NULL WHERE cat_1_id = 0;');
        $this->addSql('UPDATE Classified SET cat_2_id = NULL WHERE cat_2_id = 0;');
        $this->addSql('UPDATE Classified SET cat_3_id = NULL WHERE cat_3_id = 0;');
        $this->addSql('UPDATE Classified SET cat_4_id = NULL WHERE cat_4_id = 0;');
        $this->addSql('UPDATE Classified SET cat_5_id = NULL WHERE cat_5_id = 0;');

        $this->addSql('ALTER TABLE Classified DROP FOREIGN KEY FK_FF1BC47647E963C0');
        $this->addSql('ALTER TABLE Classified DROP FOREIGN KEY FK_FF1BC47662823C1C');
        $this->addSql('ALTER TABLE Classified DROP FOREIGN KEY FK_FF1BC476DA3E5B79');
        $this->addSql('ALTER TABLE Classified DROP FOREIGN KEY FK_FF1BC476EDE0AB4B');
        $this->addSql('ALTER TABLE Classified DROP FOREIGN KEY FK_FF1BC476FF5504A5');
        $this->addSql('ALTER TABLE Classified ADD CONSTRAINT FK_FF1BC47647E963C0 FOREIGN KEY (cat_3_id) REFERENCES ClassifiedCategory (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Classified ADD CONSTRAINT FK_FF1BC47662823C1C FOREIGN KEY (cat_5_id) REFERENCES ClassifiedCategory (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Classified ADD CONSTRAINT FK_FF1BC476DA3E5B79 FOREIGN KEY (cat_4_id) REFERENCES ClassifiedCategory (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Classified ADD CONSTRAINT FK_FF1BC476EDE0AB4B FOREIGN KEY (cat_1_id) REFERENCES ClassifiedCategory (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Classified ADD CONSTRAINT FK_FF1BC476FF5504A5 FOREIGN KEY (cat_2_id) REFERENCES ClassifiedCategory (id) ON DELETE SET NULL');

        /* Custom SQL */
        $this->addSql('UPDATE Event SET cat_1_id = NULL WHERE cat_1_id = 0;');
        $this->addSql('UPDATE Event SET cat_2_id = NULL WHERE cat_2_id = 0;');
        $this->addSql('UPDATE Event SET cat_3_id = NULL WHERE cat_3_id = 0;');
        $this->addSql('UPDATE Event SET cat_4_id = NULL WHERE cat_4_id = 0;');
        $this->addSql('UPDATE Event SET cat_5_id = NULL WHERE cat_5_id = 0;');

        $this->addSql('ALTER TABLE Event DROP FOREIGN KEY FK_FA6F25A347E963C0');
        $this->addSql('ALTER TABLE Event DROP FOREIGN KEY FK_FA6F25A362823C1C');
        $this->addSql('ALTER TABLE Event DROP FOREIGN KEY FK_FA6F25A3DA3E5B79');
        $this->addSql('ALTER TABLE Event DROP FOREIGN KEY FK_FA6F25A3EDE0AB4B');
        $this->addSql('ALTER TABLE Event DROP FOREIGN KEY FK_FA6F25A3FF5504A5');
        $this->addSql('ALTER TABLE Event ADD CONSTRAINT FK_FA6F25A347E963C0 FOREIGN KEY (cat_3_id) REFERENCES EventCategory (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Event ADD CONSTRAINT FK_FA6F25A362823C1C FOREIGN KEY (cat_5_id) REFERENCES EventCategory (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Event ADD CONSTRAINT FK_FA6F25A3DA3E5B79 FOREIGN KEY (cat_4_id) REFERENCES EventCategory (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Event ADD CONSTRAINT FK_FA6F25A3EDE0AB4B FOREIGN KEY (cat_1_id) REFERENCES EventCategory (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE Event ADD CONSTRAINT FK_FA6F25A3FF5504A5 FOREIGN KEY (cat_2_id) REFERENCES EventCategory (id) ON DELETE SET NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Article DROP FOREIGN KEY FK_CD8737FAEDE0AB4B');
        $this->addSql('ALTER TABLE Article DROP FOREIGN KEY FK_CD8737FAFF5504A5');
        $this->addSql('ALTER TABLE Article DROP FOREIGN KEY FK_CD8737FA47E963C0');
        $this->addSql('ALTER TABLE Article DROP FOREIGN KEY FK_CD8737FADA3E5B79');
        $this->addSql('ALTER TABLE Article DROP FOREIGN KEY FK_CD8737FA62823C1C');
        $this->addSql('ALTER TABLE Article ADD CONSTRAINT FK_CD8737FAEDE0AB4B FOREIGN KEY (cat_1_id) REFERENCES ArticleCategory (id)');
        $this->addSql('ALTER TABLE Article ADD CONSTRAINT FK_CD8737FAFF5504A5 FOREIGN KEY (cat_2_id) REFERENCES ArticleCategory (id)');
        $this->addSql('ALTER TABLE Article ADD CONSTRAINT FK_CD8737FA47E963C0 FOREIGN KEY (cat_3_id) REFERENCES ArticleCategory (id)');
        $this->addSql('ALTER TABLE Article ADD CONSTRAINT FK_CD8737FADA3E5B79 FOREIGN KEY (cat_4_id) REFERENCES ArticleCategory (id)');
        $this->addSql('ALTER TABLE Article ADD CONSTRAINT FK_CD8737FA62823C1C FOREIGN KEY (cat_5_id) REFERENCES ArticleCategory (id)');
        $this->addSql('ALTER TABLE Classified DROP FOREIGN KEY FK_FF1BC476EDE0AB4B');
        $this->addSql('ALTER TABLE Classified DROP FOREIGN KEY FK_FF1BC476FF5504A5');
        $this->addSql('ALTER TABLE Classified DROP FOREIGN KEY FK_FF1BC47647E963C0');
        $this->addSql('ALTER TABLE Classified DROP FOREIGN KEY FK_FF1BC476DA3E5B79');
        $this->addSql('ALTER TABLE Classified DROP FOREIGN KEY FK_FF1BC47662823C1C');
        $this->addSql('ALTER TABLE Classified ADD CONSTRAINT FK_FF1BC476EDE0AB4B FOREIGN KEY (cat_1_id) REFERENCES ClassifiedCategory (id)');
        $this->addSql('ALTER TABLE Classified ADD CONSTRAINT FK_FF1BC476FF5504A5 FOREIGN KEY (cat_2_id) REFERENCES ClassifiedCategory (id)');
        $this->addSql('ALTER TABLE Classified ADD CONSTRAINT FK_FF1BC47647E963C0 FOREIGN KEY (cat_3_id) REFERENCES ClassifiedCategory (id)');
        $this->addSql('ALTER TABLE Classified ADD CONSTRAINT FK_FF1BC476DA3E5B79 FOREIGN KEY (cat_4_id) REFERENCES ClassifiedCategory (id)');
        $this->addSql('ALTER TABLE Classified ADD CONSTRAINT FK_FF1BC47662823C1C FOREIGN KEY (cat_5_id) REFERENCES ClassifiedCategory (id)');
        $this->addSql('ALTER TABLE Event DROP FOREIGN KEY FK_FA6F25A3EDE0AB4B');
        $this->addSql('ALTER TABLE Event DROP FOREIGN KEY FK_FA6F25A3FF5504A5');
        $this->addSql('ALTER TABLE Event DROP FOREIGN KEY FK_FA6F25A347E963C0');
        $this->addSql('ALTER TABLE Event DROP FOREIGN KEY FK_FA6F25A3DA3E5B79');
        $this->addSql('ALTER TABLE Event DROP FOREIGN KEY FK_FA6F25A362823C1C');
        $this->addSql('ALTER TABLE Event ADD CONSTRAINT FK_FA6F25A3EDE0AB4B FOREIGN KEY (cat_1_id) REFERENCES EventCategory (id)');
        $this->addSql('ALTER TABLE Event ADD CONSTRAINT FK_FA6F25A3FF5504A5 FOREIGN KEY (cat_2_id) REFERENCES EventCategory (id)');
        $this->addSql('ALTER TABLE Event ADD CONSTRAINT FK_FA6F25A347E963C0 FOREIGN KEY (cat_3_id) REFERENCES EventCategory (id)');
        $this->addSql('ALTER TABLE Event ADD CONSTRAINT FK_FA6F25A3DA3E5B79 FOREIGN KEY (cat_4_id) REFERENCES EventCategory (id)');
        $this->addSql('ALTER TABLE Event ADD CONSTRAINT FK_FA6F25A362823C1C FOREIGN KEY (cat_5_id) REFERENCES EventCategory (id)');
    }
}
