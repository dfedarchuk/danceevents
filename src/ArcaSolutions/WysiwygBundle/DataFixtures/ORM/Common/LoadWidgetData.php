<?php

namespace ArcaSolutions\WysiwygBundle\DataFixtures\ORM\Common;

use ArcaSolutions\WysiwygBundle\Entity\Widget;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadWidgetData
 *
 * This class is responsible for inserting at the DataBase the standard widgets of the system
 *
 * @package ArcaSolutions\WysiwygBundle\DataFixtures\ORM\Common
 */
class LoadWidgetData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        /* These are the standard widgets of the system.
         *
         * Widget title is used as reference in LoadPageWidgetData,
         * so if you change here don't forget to change there.
         *
         * Widget's title will be translated in sitemgr,
         * so if you change here don't forget to change there.
         **/
        $standardWidgets = [
            [
                'title'    => 'Header',
                'twigFile' => '/navigation/header.html.twig',
                'type'     => Widget::HEADER_TYPE,
                'content'  => [
                    'labelMenu'        => 'Menu',
                    'labelSignUp'      => 'Sign Up',
                    'labelLogin'       => 'Log in',
                    'labelSponsorArea' => 'Sponsor Area',
                    'labelWelcome'     => 'Welcome',
                    'labelProfile'     => 'Profile',
                    'labelFaq'         => 'Faq',
                    'labelAccountPref' => 'Account Preferences',
                    'labelLogOff'      => 'Log Off',
                ],
                'modal'    => 'edit-header-modal',
            ],
            [
                'title'    => 'Search box with Slider',
                'type'     => Widget::SEARCH_TYPE,
                'twigFile' => '/slider/slider-searchbox.html.twig',
                'content'  => [
                    'labelStartYourSearch' => 'Start your search here',
                    'labelWhatLookingFor'  => 'What are you looking for?',
                ],
                'modal'    => 'edit-slider-modal',
            ],
            [
                'title'    => 'Search box without Slider',
                'twigFile' => '/searchbox/searchbox-without-slider.html.twig',
                'type'     => Widget::SEARCH_TYPE,
                'content'  => [
                    'labelStartYourSearch' => 'Start your search here',
                    'labelWhatLookingFor'  => 'What are you looking for?',
                ],
                'modal'    => 'edit-search-modal',
            ],
            [
                'title'    => 'Leaderboard ad bar (728x90)',
                'twigFile' => '/banners/leaderboard-ad-bar.html.twig',
                'type'     => Widget::BANNER_TYPE,
                'content'  => [],
                'modal'    => '',
            ],
            [
                'title'    => '4 Featured listings',
                'twigFile' => '/listing/4-featured-listings.html.twig',
                'type'     => Widget::LISTING_TYPE,
                'content'  => [
                    'labelFeaturedListings' => 'Featured Listings',
                    'labelMoreListings'     => 'more listings',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Browse by category block with images',
                'twigFile' => '/category/browse-by-category.html.twig',
                'type'     => Widget::COMMON_TYPE,
                'content'  => [
                    'labelBrowseByCat' => 'Browse by category ',
                    'labelMoreCat'     => 'more categories',
                    'limit'            => null,
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => '3 rectangle ad bar',
                'twigFile' => '/banners/rectangle-ad-bar.html.twig',
                'type'     => Widget::BANNER_TYPE,
                'content'  => [],
                'modal'    => '',
            ],
            [
                'title'    => 'Upcoming Events',
                'twigFile' => '/event/upcoming-events-bar.html.twig',
                'type'     => Widget::EVENT_TYPE,
                'content'  => [
                    'labelUpcomingEvents' => 'Upcoming Events',
                    'limit'               => 6,
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => '3 Recent Articles',
                'twigFile' => '/article/3-recent-articles.html.twig',
                'type'     => Widget::ARTICLE_TYPE,
                'content'  => [
                    'labelRecentArticles' => 'Recent Articles',
                    'labelMoreArticles'   => 'more articles',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Signup for our newsletter',
                'twigFile' => '/newsletter/signup-for-our-newsletter.html.twig',
                'type'     => Widget::COMMON_TYPE,
                'content'  => [
                    'labelSignupFor'      => 'Sign up for our newsletter',
                    'labelNewsletterDesc' => 'Sign up for our monthly newsletter. No spams, just product updates.',
                ],
                'modal'    => 'edit-newsletter-modal',
            ],
            [
                'title'    => 'Popular Deals',
                'twigFile' => '/deal/popular-deals.html.twig',
                'type'     => Widget::DEAL_TYPE,
                'content'  => [
                    'labelPopularDeals' => 'Popular Deals',
                    'labelMoreDeals'    => 'more deals',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Browse by Location with Right Banner (160x600)',
                'twigFile' => '/location/location-browse-with-right-banner.html.twig',
                'type'     => Widget::COMMON_TYPE,
                'content'  => [
                    'labelExploreMorePlaces' => 'Explore more places',
                    'labelMoreLocations'     => 'more locations',
                    'limit'                  => 65,
                ],
                'modal'    => 'edit-location-modal',
            ],
            [
                'title'    => 'Featured Classifieds with Right banner (230x230)',
                'twigFile' => '/classified/featured-classifieds-with-right-banner.html.twig',
                'type'     => Widget::CLASSIFIED_TYPE,
                'content'  => [
                    'labelFeaturedClassifieds' => 'Featured Classifieds',
                    'labelMoreClassifieds'     => 'more classifieds',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'twigFile' => '/banners/rectangle-ad-bar-plus-google-ads.html.twig',
                'type'     => Widget::BANNER_TYPE,
                'content'  => [],
                'modal'    => '',
            ],
            [
                'title'    => 'Download our apps bar',
                'twigFile' => '/navigation/footer-download-our-apps.html.twig',
                'type'     => Widget::COMMON_TYPE,
                'content'  => [
                    'labelAvailablePlayStore'  => 'Available on the Play Store',
                    'labelDownloadOurApp'      => 'Download our App',
                    'labelAvailableAppleStore' => 'Available on the Apple Store',
                    'linkPlayStore'            => 'https://play.google.com/store/apps/details?id=com.arcasolutions',
                    'linkAppleStore'           => 'https://itunes.apple.com/br/app/edirectory/id337135168?mt=8',
                    'checkboxOpenWindow'       => '',
                ],
                'modal'    => 'edit-downloadapp-modal',
            ],
            [
                'title'    => 'Footer',
                'twigFile' => '/navigation/footer-nav-with-contactus.html.twig',
                'type'     => Widget::FOOTER_TYPE,
                'content'  => [
                    'labelSiteContent'       => 'Site Content',
                    'labelContactUs'         => 'Contact Us',
                    'labelFollowUs'          => 'Follow Us',
                    'labelCopyrightText'     => '',
                    'datainfoContactAddress' => '7004 Little River Turnpike Annandale , VA 22003-3201 USA ',
                    'datainfoContactPhone'   => '+1 703.914.0770',
                ],
                'modal'    => 'edit-footer-modal',
            ],
            [
                'title'    => 'Search Bar',
                'twigFile' => '/searchbox/searchbox-module-home.html.twig',
                'type'     => Widget::SEARCH_TYPE,
                'content'  => [
                    'labelExploreAndFind' => 'Explore and find Listings',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => '3 Featured Listings',
                'twigFile' => '/listing/3-featured-listings.html.twig',
                'type'     => Widget::LISTING_TYPE,
                'content'  => [
                    'labelFeaturedListings' => 'Featured listings',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Best Of Listings',
                'twigFile' => '/listing/bestof-listings.html.twig',
                'type'     => Widget::LISTING_TYPE,
                'content'  => [
                    'labelBestOf'         => 'Best of',
                    'labelSeeAllListings' => 'See all listings',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Featured Events',
                'twigFile' => '/event/featured-events.html.twig',
                'type'     => Widget::EVENT_TYPE,
                'content'  => [
                    'labelFeaturedEvents' => 'Featured Events',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Upcoming Events Carousel',
                'twigFile' => '/event/upcoming-events-carousel.html.twig',
                'type'     => Widget::EVENT_TYPE,
                'content'  => [
                    'labelUpcomingEvents' => 'Upcoming Events',
                    'labelMoreEvents'     => 'more events',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => '3 Featured Classifieds',
                'twigFile' => '/classified/3-featured-classifieds.html.twig',
                'type'     => Widget::CLASSIFIED_TYPE,
                'content'  => [
                    'labelFeaturedClassifieds' => 'Featured Classifieds',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Popular Classifieds',
                'twigFile' => '/classified/popular-classifieds.html.twig',
                'type'     => Widget::CLASSIFIED_TYPE,
                'content'  => [
                    'labelPopularClassifieds' => 'Popular Classifieds',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => '3 Must Read Articles',
                'twigFile' => '/article/mustread-articles.html.twig',
                'type'     => Widget::ARTICLE_TYPE,
                'content'  => [
                    'labelMustReadArticles' => 'Must Read Articles',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => '4 Recent Articles',
                'twigFile' => '/article/4-recent-articles.html.twig',
                'type'     => Widget::ARTICLE_TYPE,
                'content'  => [
                    'labelRecentArticles' => 'Recent Articles',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => '3 Special Deals',
                'twigFile' => '/deal/special-deals.html.twig',
                'type'     => Widget::DEAL_TYPE,
                'content'  => [
                    'labelSpecialDeals' => 'Specials Deals',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => '4 New Deals',
                'twigFile' => '/deal/new-deals.html.twig',
                'type'     => Widget::DEAL_TYPE,
                'content'  => [
                    'labelNewDeals' => 'New Deals',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => '3 Popular Posts',
                'twigFile' => '/blog/popular-posts.html.twig',
                'type'     => Widget::BLOG_TYPE,
                'content'  => [
                    'labelPopularPosts' => 'Popular Posts',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Recent Posts',
                'twigFile' => '/blog/recent-posts.html.twig',
                'type'     => Widget::BLOG_TYPE,
                'content'  => [
                    'labelRecentPosts' => 'Recent Posts',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Search box',
                'twigFile' => '/searchbox/searchbox.html.twig',
                'type'     => Widget::SEARCH_TYPE,
                'content'  => [],
                'modal'    => '',
            ],
            [
                'title'    => 'Results Info',
                'twigFile' => '/results/results-info.html.twig',
                'type'     => Widget::SEARCH_TYPE,
                'content'  => [],
                'modal'    => '',
            ],
            [
                'title'    => 'Results content with left filters',
                'twigFile' => '/results/results-with-left-filter.html.twig',
                'type'     => Widget::SEARCH_TYPE,
                'content'  => [],
                'modal'    => '',
            ],
            [
                'title'    => 'Results content with right filters',
                'twigFile' => '/results/results-with-right-filter.html.twig',
                'type'     => Widget::SEARCH_TYPE,
                'content'  => [],
                'modal'    => '',
            ],
            [
                'title'    => 'Results content with left filters and grid view',
                'twigFile' => '/results/results-with-left-filters-and-grid-view.html.twig',
                'type'     => Widget::SEARCH_TYPE,
                'content'  => [],
                'modal'    => '',
            ],
            [
                'title'    => 'Results content with right filters and grid view',
                'twigFile' => '/results/results-with-right-filters-and-grid-view.html.twig',
                'type'     => Widget::SEARCH_TYPE,
                'content'  => [],
                'modal'    => '',
            ],
            [
                'title'    => 'Search box module detail',
                'twigFile' => '/searchbox/searchbox-module-detail.html.twig',
                'type'     => Widget::SEARCH_TYPE,
                'content'  => [
                    'labelExploreModule' => 'Explore Listings',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Listing Detail',
                'twigFile' => '/listing/detail-content.html.twig',
                'type'     => Widget::LISTING_TYPE,
                'content'  => [],
                'modal'    => '',
            ],
            [
                'title'    => 'Event Detail',
                'twigFile' => '/event/detail-content.html.twig',
                'type'     => Widget::EVENT_TYPE,
                'content'  => [],
                'modal'    => '',
            ],
            [
                'title'    => 'Classified Detail',
                'twigFile' => '/classified/detail-content.html.twig',
                'type'     => Widget::CLASSIFIED_TYPE,
                'content'  => [],
                'modal'    => '',
            ],
            [
                'title'    => 'Article Detail',
                'twigFile' => '/article/detail-content.html.twig',
                'type'     => Widget::ARTICLE_TYPE,
                'content'  => [],
                'modal'    => '',
            ],
            [
                'title'    => 'Deal Detail',
                'twigFile' => '/deal/detail-content.html.twig',
                'type'     => Widget::DEAL_TYPE,
                'content'  => [],
                'modal'    => '',
            ],
            [
                'title'    => 'Blog Detail',
                'twigFile' => '/blog/detail-content.html.twig',
                'type'     => Widget::BLOG_TYPE,
                'content'  => [],
                'modal'    => '',
            ],
            [
                'title'    => 'Search box Blog detail',
                'twigFile' => '/searchbox/searchbox-module-detail-blog.html.twig',
                'type'     => Widget::SEARCH_TYPE,
                'content'  => [
                    'labelExploreModule' => 'Explore our Blog',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Contact form',
                'twigFile' => '/contactus/contact-form.html.twig',
                'type'     => Widget::COMMON_TYPE,
                'content'  => [
                    'labelContactUs' => 'Contact Us',
                    'labelNeedHelp'  => 'Need help with something? Get in touch with us and we\'ll do our best to answer your question as soon as possible.',
                ],
                'modal'    => 'edit-contactform-modal',
            ],
            [
                'title'    => 'Faq box',
                'twigFile' => '/faq/box.html.twig',
                'type'     => Widget::COMMON_TYPE,
                'content'  => [
                    'labelHowCanIHelp'   => 'How can we help you?',
                    'labelDidYouNotFind' => 'Did you not find your answer? Contact us.',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Faq header',
                'twigFile' => '/faq/header.html.twig',
                'type'     => Widget::COMMON_TYPE,
                'content'  => [],
                'modal'    => '',
            ],
            [
                'title'    => 'Custom Content',
                'twigFile' => '/custompage/content.html.twig',
                'type'     => Widget::COMMON_TYPE,
                'content'  => [],
                'modal'    => 'edit-customcontent-modal',
            ],
            [
                'title'    => 'Sitemap Header',
                'twigFile' => '/sitemap/header.html.twig',
                'type'     => Widget::COMMON_TYPE,
                'content'  => [
                    'labelSitemap' => 'Sitemap',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Sitemap',
                'twigFile' => '/sitemap/sitemap.html.twig',
                'type'     => Widget::COMMON_TYPE,
                'content'  => [],
                'modal'    => '',
            ],
            [
                'title'    => 'Sign Up Text',
                'twigFile' => '/advertise/signupbox.html.twig',
                'type'     => Widget::COMMON_TYPE,
                'content'  => [
                    'labelSignUpToday'   => 'Sign up today - It\'s quick and simple!',
                    'labelDemoDirectory' => 'Demo Directory is proud to announce its new directory service which is now available online to visitors and new suppliers. It boasts endless amounts of new features for customers and suppliers.',
                    'labelYourDirectory' => 'Your directory items are also controlled entirely by you. We have a members interface where you can log in and change any details, add special promotions for Demo Directory customers and much more!',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Pricing & Plans',
                'twigFile' => '/advertise/pricing-plans.html.twig',
                'type'     => Widget::COMMON_TYPE,
                'content'  => [],
                'modal'    => '',
            ],
            [
                'title'    => 'All Categories',
                'twigFile' => '/category/all-categories.html.twig',
                'type'     => Widget::COMMON_TYPE,
                'content'  => [
                    'labelExploreAllCategories' => 'Explore All Categories',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'All Locations',
                'twigFile' => '/location/all-locations-block.html.twig',
                'type'     => Widget::COMMON_TYPE,
                'content'  => [
                    'labelExploreAllLocations' => 'Explore All Locations',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Special Events',
                'twigFile' => '/event/special-events.html.twig',
                'type'     => Widget::EVENT_TYPE,
                'content'  => [
                    'labelSpecialEvents' => 'Specials Events',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Header with Contact Phone',
                'twigFile' => '/navigation/header-with-contact-phone.html.twig',
                'type'     => Widget::HEADER_TYPE,
                'content'  => [
                    'labelMenu'                  => 'Menu',
                    'labelSignUp'                => 'Sign Up',
                    'labelLogin'                 => 'Log in',
                    'labelSponsorArea'           => 'Sponsor Area',
                    'labelWelcome'               => 'Welcome',
                    'labelProfile'               => 'Profile',
                    'labelFaq'                   => 'Faq',
                    'labelAccountPref'           => 'Account Preferences',
                    'labelLogOff'                => 'Log Off',
                    'labelContactUs'             => 'Contact us',
                    'labelAdvertise'             => 'Advertise',
                    'labelDashboard'             => 'Dashboard',
                    'labelAreYouSponsor'         => 'Are you a Sponsor?',
                    'labelListYourBusiness'      => 'List your business today',
                    'datainfoContactPhoneHeader' => '+1 703.914.0770',
                ],
                'modal'    => 'edit-header-with-phone-modal',
            ],
            [
                'title'    => 'Featured Categories',
                'twigFile' => '/category/browse-by-category-featured.html.twig',
                'type'     => Widget::COMMON_TYPE,
                'content'  => [
                    'labelFind' => 'Find',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Footer with Newsletter',
                'twigFile' => '/navigation/footer-with-newsletter.html.twig',
                'type'     => Widget::FOOTER_TYPE,
                'content'  => [
                    'labelSiteContent'       => 'Site Content',
                    'labelContactUs'         => 'Contact Us',
                    'labelCopyrightText'     => '',
                    'datainfoContactAddress' => '7004 Little River Turnpike Annandale , VA 22003-3201 USA ',
                    'datainfoContactPhone'   => '+1 703.914.0770',
                    'datainfoSignupFor'      => 'Sign up for our newsletter',
                    'datainfoNewsletterDesc' => 'Sign up for our monthly newsletter. No spams, just product updates.',
                ],
                'modal'    => 'edit-footer-with-newsletter-modal',
            ],
            [
                'title'    => '2 Column Recent Articles',
                'twigFile' => '/article/2-column-recent-articles.html.twig',
                'type'     => Widget::ARTICLE_TYPE,
                'content'  => [
                    'labelRecentArticles'   => 'Recent Articles',
                    'labelSeeMoreArticles'  => 'See more articles',
                    'labelWriteYourArticle' => 'Write your article',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Browse by Category and Location with Square banner',
                'twigFile' => '/category/browse-by-category-and-location.html.twig',
                'type'     => Widget::COMMON_TYPE,
                'content'  => [
                    'labelBrowseByCategory'     => 'Browse by category ',
                    'labelExploreAllCategories' => 'Explore All Categories',
                    'labelBrowseByLocation'     => 'Browse by location',
                    'labelExploreAllLocations'  => 'Explore all locations',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Recent Reviews plus Wide Skyscraper banner',
                'twigFile' => '/review/recent-reviews-plus-skyscraper-banner.html.twig',
                'type'     => Widget::COMMON_TYPE,
                'content'  => [
                    'labelRecentReviews'     => 'Recent Reviews',
                    'labelCreateYourProfile' => 'Create your profile today and write a review. It’s free!',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Navigation with Centered Logo',
                'twigFile' => '/navigation/navigation-with-centered-logo.html.twig',
                'type'     => Widget::HEADER_TYPE,
                'content'  => [
                    'labelSignUp'      => 'Sign Up',
                    'labelLogin'       => 'Log in',
                    'labelWelcome'     => 'Welcome',
                    'labelProfile'     => 'Profile',
                    'labelFaq'         => 'Faq',
                    'labelAccountPref' => 'Account Preferences',
                    'labelLogOff'      => 'Log Off',
                ],
                'modal'    => 'edit-header-modal',
            ],
            [
                'title'    => '5 Recent Articles',
                'twigFile' => '/article/5-recent-articles.html.twig',
                'type'     => Widget::ARTICLE_TYPE,
                'content'  => [
                    'labelRecentArticles' => 'Recent Articles',
                    'labelMoreArticles'   => 'more articles',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => '6 Featured Listings plus 2 Square Banners',
                'twigFile' => '/listing/6-featured-listings-plus-square-banner.html.twig',
                'type'     => Widget::LISTING_TYPE,
                'content'  => [
                    'labelFeaturedListings' => 'Featured Listings',
                    'labelMoreListings'     => 'more listings',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => '4 Featured Events',
                'twigFile' => '/event/4-featured-events.html.twig',
                'type'     => Widget::EVENT_TYPE,
                'content'  => [
                    'labelFeaturedEvents' => 'Featured Events',
                    'labelMoreEvents'     => 'more events',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => '3 Recent Posts',
                'twigFile' => '/blog/3-recent-posts.html.twig',
                'type'     => Widget::BLOG_TYPE,
                'content'  => [
                    'labelRecentPosts' => 'Recent Posts',
                    'labelMorePosts'   => 'more posts',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Footer with Social Media',
                'twigFile' => '/navigation/footer-with-social-media.html.twig',
                'type'     => Widget::FOOTER_TYPE,
                'content'  => [
                    'labelFollowUs'      => 'Follow Us',
                    'labelCopyrightText' => '',
                ],
                'modal'    => 'edit-footer-with-social-media-modal',
            ],
            [
                'title'    => 'Navigation with left Logo plus Social Media',
                'twigFile' => '/navigation/navigation-left-logo-plus-social.html.twig',
                'type'     => Widget::HEADER_TYPE,
                'content'  => [
                    'labelMenu'        => 'Menu',
                    'labelSignUp'      => 'Sign Up',
                    'labelLogin'       => 'Log in',
                    'labelSponsorArea' => 'Sponsor Area',
                    'labelWelcome'     => 'Welcome',
                    'labelProfile'     => 'Profile',
                    'labelFaq'         => 'Faq',
                    'labelAccountPref' => 'Account Preferences',
                    'labelLogOff'      => 'Log Off',
                ],
                'modal'    => 'edit-header-with-social-media-modal',
            ],
            [
                'title'    => '5 Featured Listings',
                'twigFile' => '/listing/5-featured-listings.html.twig',
                'type'     => Widget::LISTING_TYPE,
                'content'  => [
                    'labelFeaturedListings' => 'Featured Listings',
                    'labelViewMore'         => 'View more featured Listings',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Browse by Locations plus Square Banners',
                'twigFile' => '/location/browse-by-locations-plus-square-banner.html.twig',
                'type'     => Widget::COMMON_TYPE,
                'content'  => [
                    'labelBrowseByLocation'    => 'Browse by location',
                    'labelExploreAllLocations' => 'Explore all locations',
                    'limit'                    => 40,
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Popular Deals plus Wide Skyscraper banner',
                'twigFile' => '/deal/featured-deals-plus-skyscraper-banner.html.twig',
                'type'     => Widget::DEAL_TYPE,
                'content'  => [
                    'labelPopularDeals'  => 'Popular Deals',
                    'labelViewMoreDeals' => 'View more deals',
                ],
                'modal'    => 'edit-generic-modal',
            ],
            [
                'title'    => 'Footer with Logo',
                'twigFile' => '/navigation/footer-with-logo.html.twig',
                'type'     => Widget::FOOTER_TYPE,
                'content'  => [
                    'labelCopyrightText' => '',
                ],
                'modal'    => 'edit-footer-with-logo-modal',
            ],
            [
                'title'    => 'Search box for Reviews page',
                'twigFile' => '/searchbox/searchbox-module-review.html.twig',
                'type'     => Widget::SEARCH_TYPE,
                'content'  => [],
                'modal'    => '',
            ],
            [
                'title'    => 'Reviews block',
                'twigFile' => '/review/module-review.html.twig',
                'type'     => Widget::COMMON_TYPE,
                'content'  => [],
                'modal'    => '',
            ],
            [
                'title'    => 'Sticky Menu',
                'twigFile' => '/navigation/header-sticky-menu.html.twig',
                'type'     => Widget::HEADER_TYPE,
                'content'  => [
                    'labelMenu'        => 'Menu',
                    'labelSignUp'      => 'Sign Up',
                    'labelLogin'       => 'Log in',
                    'labelSponsorArea' => 'Sponsor Area',
                    'labelWelcome'     => 'Welcome',
                    'labelProfile'     => 'Profile',
                    'labelFaq'         => 'Faq',
                    'labelAccountPref' => 'Account Preferences',
                    'labelLogOff'      => 'Log Off',
                ],
                'modal'    => 'edit-header-modal',
            ],
            [
                'title'    => 'Events Calendar',
                'twigFile' => '/event/events-calendar.html.twig',
                'type'     => Widget::EVENT_TYPE,
                'content'  => [
                    'labelCalendar' => 'Events Calendar',
                ],
                'modal'    => 'edit-calendar-modal',
            ],
            /* CUSTOM ADDWIDGET
              * here are an example of how you add the widget 'Widget test'
              */
            /*  [
               'title'    => 'Widget test',
               'twigFile' => '/test/widget-test.html.twig',
               'type'     => Widget::COMMON_TYPE,
               'content'  => [
                   'labelTest'        => 'Test',
               ],
               'modal'    => 'edit-generic-modal',
           ],*/
        ];

        $repository = $manager->getRepository('WysiwygBundle:Widget');

        foreach ($standardWidgets as $sWidget) {
            $query = $repository->findOneBy(['twigFile' => $sWidget['twigFile']]);

            $widget = new Widget();
            /* checks if the widget already exist so they can be updated or added */
            if (count($query) != 0) {
                $widget = $query;
            }

            $widget->setTitle($sWidget['title']);
            $widget->setTwigFile($sWidget['twigFile']);
            $widget->setType($sWidget['type']);
            $widget->setContent(json_encode($sWidget['content']));
            $widget->setModal($sWidget['modal']);

            $manager->persist($widget);
            $manager->flush();

            $this->addReference($widget->getTitle(), $widget);
        }
    }

    /**
     * the order in which fixtures will be loaded
     * the lower the number, the sooner that this fixture is loaded
     *
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
