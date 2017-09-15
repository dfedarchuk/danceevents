<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160418173847 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE AccountProfileContact ENGINE=InnoDB');
        $this->addSql('ALTER TABLE AppAdvert ENGINE=InnoDB');
        $this->addSql('ALTER TABLE AppCustomPages ENGINE=InnoDB');
        $this->addSql('ALTER TABLE AppNotification ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Article ENGINE=InnoDB');
        $this->addSql('ALTER TABLE ArticleCategory ENGINE=InnoDB');
        $this->addSql('ALTER TABLE ArticleLevel ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Banner ENGINE=InnoDB');
        $this->addSql('ALTER TABLE BannerLevel ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Blog_Category ENGINE=InnoDB');
        $this->addSql('ALTER TABLE BlogCategory ENGINE=InnoDB');
        $this->addSql('ALTER TABLE CheckIn ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Claim ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Classified ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Classified_LocationCounter ENGINE=InnoDB');
        $this->addSql('ALTER TABLE ClassifiedCategory ENGINE=InnoDB');
        $this->addSql('ALTER TABLE ClassifiedLevel ENGINE=InnoDB');
        $this->addSql('ALTER TABLE ClassifiedLevel_Field ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Comments ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Content ENGINE=InnoDB');
        $this->addSql('ALTER TABLE CustomInvoice ENGINE=InnoDB');
        $this->addSql('ALTER TABLE CustomInvoice_Items ENGINE=InnoDB');
        $this->addSql('ALTER TABLE CustomText ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Discount_Code ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Editor_Choice ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Email_Notification ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Email_Notification_Default ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Event ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Event_LocationCounter ENGINE=InnoDB');
        $this->addSql('ALTER TABLE EventCategory ENGINE=InnoDB');
        $this->addSql('ALTER TABLE EventLevel ENGINE=InnoDB');
        $this->addSql('ALTER TABLE EventLevel_Field ENGINE=InnoDB');
        $this->addSql('ALTER TABLE FAQ ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Gallery ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Gallery_Image ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Gallery_Item ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Gallery_Temp ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Image ENGINE=InnoDB');
        $this->addSql('ALTER TABLE ImportLog ENGINE=InnoDB');
        $this->addSql('ALTER TABLE ImportTemporary ENGINE=InnoDB');
        $this->addSql('ALTER TABLE ImportTemporary_Event ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Invoice ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Invoice_Article ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Invoice_Banner ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Invoice_Classified ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Invoice_CustomInvoice ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Invoice_Event ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Invoice_Listing ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Invoice_Package ENGINE=InnoDB');
        $this->addSql('ALTER TABLE ItemStatistic ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Lang ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Leads ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Listing ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Listing_Category ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Listing_Choice ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Listing_FeaturedTemp ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Listing_LocationCounter ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Listing_Summary ENGINE=InnoDB');
        $this->addSql('ALTER TABLE ListingCategory ENGINE=InnoDB');
        $this->addSql('ALTER TABLE ListingLevel ENGINE=InnoDB');
        $this->addSql('ALTER TABLE ListingLevel_Field ENGINE=InnoDB');
        $this->addSql('ALTER TABLE ListingTemplate ENGINE=InnoDB');
        $this->addSql('ALTER TABLE ListingTemplate_Field ENGINE=InnoDB');
        $this->addSql('ALTER TABLE MailApp_Subscribers ENGINE=InnoDB');
        $this->addSql('ALTER TABLE MailAppList ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Payment_Article_Log ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Payment_Banner_Log ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Payment_Classified_Log ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Payment_CustomInvoice_Log ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Payment_Event_Log ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Payment_Listing_Log ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Payment_Log ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Payment_Package_Log ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Post ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Promotion ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Promotion_LocationCounter ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Promotion_Redeem ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Quicklist ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Article ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Article_Daily ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Article_Monthly ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Banner ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Banner_Daily ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Banner_Monthly ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Classified ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Classified_Daily ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Classified_Monthly ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Event ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Event_Daily ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Event_Monthly ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Listing ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Listing_Daily ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Listing_Monthly ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Login ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Post ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Post_Daily ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Post_Monthly ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Promotion ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Promotion_Daily ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Promotion_Monthly ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Statistic ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Report_Statistic_Daily ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Review ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Setting ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Setting_Google ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Setting_Location ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Setting_Navigation ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Setting_Payment ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Setting_Search_Tag ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Setting_Social_Network ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Slider ENGINE=InnoDB');
        $this->addSql('ALTER TABLE Timeline ENGINE=InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE AccountProfileContact ENGINE=MyISAM');
        $this->addSql('ALTER TABLE AppAdvert ENGINE=MyISAM');
        $this->addSql('ALTER TABLE AppCustomPages ENGINE=MyISAM');
        $this->addSql('ALTER TABLE AppNotification ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Article ENGINE=MyISAM');
        $this->addSql('ALTER TABLE ArticleCategory ENGINE=MyISAM');
        $this->addSql('ALTER TABLE ArticleLevel ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Banner ENGINE=MyISAM');
        $this->addSql('ALTER TABLE BannerLevel ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Blog_Category ENGINE=MyISAM');
        $this->addSql('ALTER TABLE BlogCategory ENGINE=MyISAM');
        $this->addSql('ALTER TABLE CheckIn ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Claim ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Classified ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Classified_LocationCounter ENGINE=MyISAM');
        $this->addSql('ALTER TABLE ClassifiedCategory ENGINE=MyISAM');
        $this->addSql('ALTER TABLE ClassifiedLevel ENGINE=MyISAM');
        $this->addSql('ALTER TABLE ClassifiedLevel_Field ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Comments ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Content ENGINE=MyISAM');
        $this->addSql('ALTER TABLE CustomInvoice ENGINE=MyISAM');
        $this->addSql('ALTER TABLE CustomInvoice_Items ENGINE=MyISAM');
        $this->addSql('ALTER TABLE CustomText ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Discount_Code ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Editor_Choice ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Email_Notification ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Email_Notification_Default ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Event ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Event_LocationCounter ENGINE=MyISAM');
        $this->addSql('ALTER TABLE EventCategory ENGINE=MyISAM');
        $this->addSql('ALTER TABLE EventLevel ENGINE=MyISAM');
        $this->addSql('ALTER TABLE EventLevel_Field ENGINE=MyISAM');
        $this->addSql('ALTER TABLE FAQ ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Gallery ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Gallery_Image ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Gallery_Item ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Gallery_Temp ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Image ENGINE=MyISAM');
        $this->addSql('ALTER TABLE ImportLog ENGINE=MyISAM');
        $this->addSql('ALTER TABLE ImportTemporary ENGINE=MyISAM');
        $this->addSql('ALTER TABLE ImportTemporary_Event ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Invoice ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Invoice_Article ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Invoice_Banner ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Invoice_Classified ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Invoice_CustomInvoice ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Invoice_Event ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Invoice_Listing ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Invoice_Package ENGINE=MyISAM');
        $this->addSql('ALTER TABLE ItemStatistic ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Lang ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Leads ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Listing ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Listing_Category ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Listing_Choice ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Listing_FeaturedTemp ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Listing_LocationCounter ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Listing_Summary ENGINE=MyISAM');
        $this->addSql('ALTER TABLE ListingCategory ENGINE=MyISAM');
        $this->addSql('ALTER TABLE ListingLevel ENGINE=MyISAM');
        $this->addSql('ALTER TABLE ListingLevel_Field ENGINE=MyISAM');
        $this->addSql('ALTER TABLE ListingTemplate ENGINE=MyISAM');
        $this->addSql('ALTER TABLE ListingTemplate_Field ENGINE=MyISAM');
        $this->addSql('ALTER TABLE MailApp_Subscribers ENGINE=MyISAM');
        $this->addSql('ALTER TABLE MailAppList ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Payment_Article_Log ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Payment_Banner_Log ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Payment_Classified_Log ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Payment_CustomInvoice_Log ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Payment_Event_Log ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Payment_Listing_Log ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Payment_Log ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Payment_Package_Log ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Post ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Promotion ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Promotion_LocationCounter ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Promotion_Redeem ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Quicklist ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Article ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Article_Daily ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Article_Monthly ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Banner ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Banner_Daily ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Banner_Monthly ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Classified ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Classified_Daily ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Classified_Monthly ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Event ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Event_Daily ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Event_Monthly ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Listing ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Listing_Daily ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Listing_Monthly ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Login ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Post ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Post_Daily ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Post_Monthly ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Promotion ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Promotion_Daily ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Promotion_Monthly ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Statistic ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Report_Statistic_Daily ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Review ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Setting ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Setting_Google ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Setting_Location ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Setting_Navigation ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Setting_Payment ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Setting_Search_Tag ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Setting_Social_Network ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Slider ENGINE=MyISAM');
        $this->addSql('ALTER TABLE Timeline ENGINE=MyISAM');
    }
}
