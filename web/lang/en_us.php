<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /lang/en_us.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DATE/TIME
	# ----------------------------------------------------------------------------------------------------
	//january,february,march,april,may,june,july,august,september,october,november,december
	define("LANG_DATE_MONTHS", "january,february,march,april,may,june,july,august,september,october,november,december");
	//sunday,monday,tuesday,wednesday,thursday,friday,saturday
	define("LANG_DATE_WEEKDAYS", "sunday,monday,tuesday,wednesday,thursday,friday,saturday");
	//year
	define("LANG_YEAR", "year");
	//years
	define("LANG_YEAR_PLURAL", "years");
	//month
	define("LANG_MONTH", "month");
	//months
	define("LANG_MONTH_PLURAL", "months");
	//day
	define("LANG_DAY", "day");
	//days
	define("LANG_DAY_PLURAL", "days");
	//#,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z
	define("LANG_LETTERS", "#,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z");
	//y
	define("LANG_LETTER_YEAR", "y");
	//m
	define("LANG_LETTER_MONTH", "m");
	//d
	define("LANG_LETTER_DAY", "d");
	//Hour
	define("LANG_LABEL_HOUR", "Hour");
	//Minute
	define("LANG_LABEL_MINUTE", "Minute");

	# ----------------------------------------------------------------------------------------------------
	# ZIPCODE
	# ----------------------------------------------------------------------------------------------------
	//ZIPCODE_UNIT - Available just for: mile or km
	define("ZIPCODE_UNIT", "mile");
	//zipcode
	define("ZIPCODE_LABEL", "zipcode");

	# ----------------------------------------------------------------------------------------------------
	# STRING EVENT DATE
	# ----------------------------------------------------------------------------------------------------
	//[MONTHNAME] [DAY][SUFFIX], [YEAR]
	define("LANG_STRINGDATE_YEARANDMONTHANDDAY", "F dS, Y");
	//[MONTHNAME] [YEAR]
	define("LANG_STRINGDATE_YEARANDMONTH", "F Y");

	# ----------------------------------------------------------------------------------------------------
	# HEADER AND FOOTER LABELS
	# ----------------------------------------------------------------------------------------------------
	//Home
	define("LANG_MENU_HOME", "Home");
	//Listings
	define("LANG_MENU_LISTING", string_ucwords(LISTING_FEATURE_NAME_PLURAL));
	//Events
	define("LANG_MENU_EVENT", string_ucwords(EVENT_FEATURE_NAME_PLURAL));
	//Banners
	define("LANG_MENU_BANNER", string_ucwords(BANNER_FEATURE_NAME_PLURAL));
	//Classifieds
	define("LANG_MENU_CLASSIFIED", string_ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//Articles
	define("LANG_MENU_ARTICLE", string_ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//Deals
	define("LANG_MENU_PROMOTION", string_ucwords(PROMOTION_FEATURE_NAME_PLURAL));
	//Blog
	define("LANG_MENU_BLOG", string_ucwords(BLOG_FEATURE_NAME_PLURAL));
	//Advertise
	define("LANG_MENU_ADVERTISE", "Advertise");
	//FAQ
	define("LANG_MENU_FAQ", "FAQ");
	//Sitemap
	define("LANG_MENU_SITEMAP", "Sitemap");
	//Contact Us
	define("LANG_MENU_CONTACT", "Contact Us");
	//Enquire
	define("LANG_MENU_ENQUIRE", "Inquire");
	//Tell us about your project
	define("LANG_MENU_ENQUIRE2", "Tell us about your project");
	//Find us on LinkedIn
	define("LANG_ALT_LINKEDIN", "Find us on LinkedIn");
	//Find us on Facebook
	define("LANG_ALT_FACEBOOK", "Find us on Facebook");
	//Like Us on Facebook
	define("LANG_LIKE_FACEBOOK", "Like Us on Facebook");
	//Links
	define("LANG_LINKS", "Links");
	//Contact
	define("LANG_FOOTER_CONTACT", "Contact");
	//Twitter
	define("LANG_TWITTER", "Twitter");
    //Twitter Updates
	define("LANG_TWITTER_UPDATES", "Twitter Updates");
	//Follow us on Twitter
	define("LANG_FOLLOW_US_TWITTER", "Follow us on Twitter");
	//Follow Us
	define("LANG_FOLLOW_US", "Follow Us");
    //Send Us a message
    define("LANG_CONTACT_SENDMSG", "Send Us a message");
    //Site Content
    define("LANG_SITE_CONTENT", "Site Content");
	//Learn More
	define("LANG_LABEL_LEARN_MORE", "Learn More");
	//Download our App
	define("LANG_LABEL_DOWNLOAD_APP", "Download our <b>App</b>");

	# ----------------------------------------------------------------------------------------------------
	# JAVASCRIPT LANGUAGES VARIABLES
	# ----------------------------------------------------------------------------------------------------
	//Wait, Loading Category Tree...
	define("LANG_JS_LOADCATEGORYTREE", "Wait, Loading Category Tree...");
	//Wait, Loading Locations...
	define("LANG_JS_LOADLOCATIONTREE", "Wait, Loading Locations...");
	//Loading...
	define("LANG_JS_LOADING", "Loading...");
	//This item was added to your Favorites. You can view your Favorites in your profile page.
	define("LANG_JS_FAVORITEADD", "This item was added to your Favorites.<br />You can view your Favorites in your profile page.");
	//This item was removed from your Favorites.
	define("LANG_JS_FAVORITEDEL", "This item was removed from your Favorites.");
	//weak
	define("LANG_JS_LABEL_WEAK", "weak");
	//bad
	define("LANG_JS_LABEL_BAD", "bad");
	//good
	define("LANG_JS_LABEL_GOOD", "good");
	//strong
	define("LANG_JS_LABEL_STRONG", "strong");
	//There was a problem retrieving the XML data:
	define("LANG_JS_ACCOUNTSEARCH_PROBLEMRETRIEVING", "There was a problem retrieving the XML data:");
	//Click here to select an account.
	define("LANG_JS_ACCOUNTSEARCH_CLICKHERETOSELECT", "Click here to select an account");
	//Please provide at least a 3 letter word for the search!
	define("LANG_JS_ACCOUNTSEARCH_PLEASEPROVIDEATLEAST", "Please provide at least a 3 letter word for the search!");
	//Server response failure!
	define("LANG_JS_ACCOUNTSEARCH_SERVERRESPONSEFAILURE", "Server response failure!");
	//Press ESC Key to close.
	define("LANG_JS_COLORPICKER_CLOSEMSG", "Press ESC Key to close.");
	//Hide Map
	define("LANG_JS_LABEL_HIDEMAP", "Hide Map");
	//Show Map
	define("LANG_JS_LABEL_SHOWMAP", "Show Map");
	//Show Graphics
	define("LANG_JS_LABEL_SHOWGRAPHICS", "Show Graphics");
	//Hide Graphics
	define("LANG_JS_LABEL_HIDEGRAPHICS", "Hide Graphics");
	//This item was already added to your Favorites.<br />You can view your Favorites in your profile page.
	define("LANG_JS_FAVORITES_ADDED", "This item was already added to your Favorites.<br />You can view your Favorites in your profile page.");
	//Wait...
	define("LANG_JS_WAIT", "Wait...");
	//Continue
	define("LANG_JS_CONTINUE", "Continue");
	//Close
	define("LANG_JS_CLOSE", "Close");
	//Add keyword
	define("LANG_JS_ADDKEYWORD", "Add keyword");
	//Add file
	define("LANG_JS_ADDFILE", "Choose file");
	//Prev
	define("LANG_JS_PREV", "Prev");
	//Next
	define("LANG_JS_NEXT", "Next");
	//End Tour
	define("LANG_JS_END_TOUR", "End Tour");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDES
	# ----------------------------------------------------------------------------------------------------
	//You are using an older version of Internet Explorer that may affect the full functionality of some features. We recommend you upgrade to a newer version of Internet Explorer.
	define("LANG_IE6_WARNING", "You are using an older version of Internet Explorer that may affect the full functionality of some features. We recommend you upgrade to a newer version of Internet Explorer.");
	//N/A
	define("LANG_NA", "N/A");
	//characters
	define("LANG_LABEL_CHARACTERES", "characters");
	//by
	define("LANG_BY", "by");
	//in
	define("LANG_IN", "in");
	//Read More
	define("LANG_READMORE", "Read More");
	//More
	define("LANG_MORE", "more");
	//Browse by Category
	define("LANG_BROWSEBYCATEGORY", "Browse by Category");
	//Browse by Location
	define("LANG_BROWSEBYLOCATION", "Browse by Location");
	//Browse by Rating
	define("LANG_BROWSEBYREVIEW", "Browse by Rating");
	//Browse Listings
	define("LANG_BROWSELISTINGS", "Browse ".string_ucwords(LISTING_FEATURE_NAME_PLURAL));
	//Browse Events
	define("LANG_BROWSEEVENTS", "Browse ".string_ucwords(EVENT_FEATURE_NAME_PLURAL));
	//Browse Classifieds
	define("LANG_BROWSECLASSIFIEDS", "Browse ".string_ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//Browse Articles
	define("LANG_BROWSEARTICLES", "Browse ".string_ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//Browse Deals
	define("LANG_BROWSEPROMOTIONS", "Browse ".string_ucwords(PROMOTION_FEATURE_NAME_PLURAL));
	//Browse Posts
	define("LANG_BROWSEPOSTS", "Browse Posts");
	//show
	define("LANG_SHOW", "show");
	//hide
	define("LANG_HIDE", "hide");
	//Bill to
	define("LANG_BILLTO", "Bill to");
	//Payable to
	define("LANG_PAYABLETO", "Payable to");
	//Issuing Date
	define("LANG_ISSUINGDATE", "Issuing Date");
	//Expire Date
	define("LANG_EXPIREDATE", "Expire Date");
	//Questions
	define("LANG_QUESTIONS", "Questions");
	//Please call
	define("LANG_PLEASECALL", "Please call");
	//Invoice Info
	define("LANG_INVOICEINFO", "Invoice Info");
	//Invoice Logo
	define("LANG_LABEL_INVOICELOGO", "Invoice Logo");
	//Payment Date
	define("LANG_PAYMENTDATE", "Payment Date");
	//None
	define("LANG_NONE", "None");
	//Custom Invoice
	define("LANG_CUSTOM_INVOICE", "Custom Invoice");
	//Custom Invoices
	define("LANG_CUSTOM_INVOICES", "Custom Invoices");
	//Locations
	define("LANG_LOCATIONS", "Locations");
	//Close
	define("LANG_CLOSE", "Close");
	//Close this window
	define("LANG_CLOSEWINDOW", "Close this window");
	//from
	define("LANG_FROM", "from");
	//Transaction Info
	define("LANG_TRANSACTION_INFO", "Transaction Info");
	//In manual transactions, subtotal and tax are not calculated.
	define("LANG_TRANSACTION_MANUAL", "In manual transactions, subtotal and tax are not calculated.");
	//creditcard
	define("LANG_CREDITCARD", "creditcard");
	//Join Now!
	define("LANG_JOIN_NOW", "Join Now!");
	//Create Your Account
	define("LANG_JOIN_PROFILE", "Create Your Account");
	//More Information
	define("LANG_MOREINFO", "More Information");
	//and
	define("LANG_AND", "and");
	//Keyword sample 1: "Auto Parts"
	define("LANG_KEYWORD_SAMPLE_1", "Auto Parts");
	//Keyword sample 2: "Tires"
	define("LANG_KEYWORD_SAMPLE_2", "Tires");
	//Keyword sample 3: "Engine Repair"
	define("LANG_KEYWORD_SAMPLE_3", "Engine Repair");
	//Categories and sub-categories
	define("LANG_CATEGORIES_SUBCATEGS", "Categories and sub-categories");
	//per
	define("LANG_PER", "per");
	//each
	define("LANG_EACH", "each");
	//impressions block
	define("LANG_IMPRESSIONSBLOCK", "impressions block");
	//Add
	define("LANG_ADD", "Add");
	//Manage
	define("LANG_MANAGE", "Manage");
	//impressions to my paid credit of
	define("LANG_IMPRESSIONPAIDOF", "impressions to my paid credit of");
	//Section
	define("LANG_SECTION", "Section");
	//General Pages
	define("LANG_GENERALPAGES", "General Pages");
	//Open in a new window
	define("LANG_OPENNEWWINDOW", "Open in a new window");
	//No
	define("LANG_NO", "No");
	//Yes
	define("LANG_YES", "Yes");
	//Dear
	define("LANG_DEAR", "Dear");
	//Street Address, P.O. box
	define("LANG_ADDRESS_EXAMPLE", "Street Address, P.O. box");
	//Apartment, suite, unit, building, floor, etc.
	define("LANG_ADDRESS2_EXAMPLE", "Apartment, suite, unit, building, floor, etc.");
	//or
	define("LANG_OR", "or");
	//Hour of Work sample 1: "Sun 8:00 am - 6:00 pm"
	define("LANG_HOURWORK_SAMPLE_1", "Sun 8:00 am - 6:00 pm");
	//Hour of Work sample 2: "Mon 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_2", "Mon 8:00 am - 9:00 pm");
	//Hour of Work sample 3: "Tue 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_3", "Tue 8:00 am - 9:00 pm");
	//Additional Information
	define("LANG_EXTRA_FIELDS", "Additional Information");
	//Amenities
	define("LANG_TEMPLATE_AMENITIES", "Amenities");
	//Sign me in automatically
	define("LANG_AUTOLOGIN", "Sign me in automatically");
	//Check / Uncheck All
	define("LANG_CHECK_UNCHECK_ALL", "Check / Uncheck All");
	//Billing Information
	define("LANG_BIILING_INFORMATION", "Billing Information");
	//Listing
	define("LANG_BUSINESS", string_ucwords(LISTING_FEATURE_NAME));
	//on Listing
	define("LANG_ON_LISTING", "on ".string_ucwords(LISTING_FEATURE_NAME));
	//on Event
	define("LANG_ON_EVENT", "on ".string_ucwords(EVENT_FEATURE_NAME));
	//on Banner
	define("LANG_ON_BANNER", "on ".string_ucwords(BANNER_FEATURE_NAME));
	//on Classified
	define("LANG_ON_CLASSIFIED", "on ".string_ucwords(CLASSIFIED_FEATURE_NAME));
	//on Article
	define("LANG_ON_ARTICLE", "on ".string_ucwords(ARTICLE_FEATURE_NAME));
	//Listing Name
	define("LANG_LISTING_NAME", string_ucwords(LISTING_FEATURE_NAME)." Name");
	//Event Name
	define("LANG_EVENT_NAME", string_ucwords(EVENT_FEATURE_NAME)." Name");
	//Banner Name
	define("LANG_BANNER_NAME", string_ucwords(BANNER_FEATURE_NAME)." Name");
	//Classified Name
	define("LANG_CLASSIFIED_NAME", string_ucwords(CLASSIFIED_FEATURE_NAME)." Name");
	//Article Name
	define("LANG_ARTICLE_NAME", string_ucwords(ARTICLE_FEATURE_NAME)." Name");
	//Frequently Asked Questions
	define("LANG_FAQ_NAME", "Frequently Asked Questions");
	//How can we help you?
	define("LANG_FAQ_HELP", "How can we help you?");
	//Enter a question, keyword, topic...
	define("LANG_FAQ_TIP", "Enter a question, keyword, topic...");
	//click to crop image
	define("LANG_CROPIMAGE", "click here to crop the image");
	//Did not find your answer? Contact us.
	define("LANG_FAQ_CONTACT", "Did not find your answer? Contact us.");
	//Active
	define("LANG_LABEL_ACTIVE", "Active");
	//Suspended
	define("LANG_LABEL_SUSPENDED", "Suspended");
	//Expired
	define("LANG_LABEL_EXPIRED", "Expired");
	//Pending
	define("LANG_LABEL_PENDING", "Pending");
	//Received
	define("LANG_LABEL_RECEIVED", "Received");
	//Promotional Code
	define("LANG_LABEL_DISCOUNTCODE", string_ucwords(DISCOUNTCODE_LABEL));
	//Account
	define("LANG_LABEL_ACCOUNT", "Account");
	//Change account
	define("LANG_LABEL_CHANGE_ACCOUNT", "Change account");
	//Name or Title
	define("LANG_LABEL_NAME_OR_TITLE", "Name or Title");
	//Name
	define("LANG_LABEL_NAME", "Name");
	//First, Last
	define("LANG_LABEL_FIRST_LAST", "First, Last");
	//Page Name
	define("LANG_LABEL_PAGE_NAME", "Page Name");
	//Summary Description
	define("LANG_LABEL_SUMMARY_DESCRIPTION", "Summary Description");
	//Category
	define("LANG_LABEL_CATEGORY", "Category");
    //Sub-Category
	define("LANG_LABEL_SUBCATEGORY", "Sub-Category");
	//Category
	define("LANG_CATEGORY", "Category");
	//Categories
	define("LANG_LABEL_CATEGORY_PLURAL", "Categories");
	//Categories
	define("LANG_CATEGORY_PLURAL", "Categories");
	//Country
	define("LANG_LABEL_COUNTRY", "Country");
	//Region
	define("LANG_LABEL_REGION", "Region");
	//State
	define("LANG_LABEL_STATE", "State");
	//City
	define("LANG_LABEL_CITY", "City");
	//Neighborhood
	define("LANG_LABEL_NEIGHBORHOOD", "Neighborhood");
	//Countries
	define("LANG_LABEL_COUNTRY_PL", "Countries");
	//Regions
	define("LANG_LABEL_REGION_PL", "Regions");
	//States
	define("LANG_LABEL_STATE_PL", "States");
	//Cities
	define("LANG_LABEL_CITY_PL", "Cities");
	//Neighborhoods
	define("LANG_LABEL_NEIGHBORHOOD_PL", "Neighborhoods");
	//Add a New Region
	define("LANG_LABEL_ADD_A_NEW_REGION", "Add a new region");
	//Add a New State
	define("LANG_LABEL_ADD_A_NEW_STATE", "Add a new state");
	//Add a New City
	define("LANG_LABEL_ADD_A_NEW_CITY", "Add a new city");
	//Add a New Neighborhood
	define("LANG_LABEL_ADD_A_NEW_NEIGHBORHOOD", "Add a new neighborhood");
	//Choose an Existing Region
	define("LANG_LABEL_CHOOSE_AN_EXISTING_REGION", "Choose an existing region");
	//Choose an Existing State
	define("LANG_LABEL_CHOOSE_AN_EXISTING_STATE", "Choose an existing state");
	//Choose an Existing City
	define("LANG_LABEL_CHOOSE_AN_EXISTING_CITY", "Choose an existing city");
	//Choose an Existing Neighborhood
	define("LANG_LABEL_CHOOSE_AN_EXISTING_NEIGHBORHOOD", "Choose an existing neighborhood");
	//Top Countries
	define("LANG_LABEL_TOP_COUNTRY", "Top Countries");
	//Top Regions
	define("LANG_LABEL_TOP_REGION", "Top Regions");
	//Top States
	define("LANG_LABEL_TOP_STATE", "Top States");
	//Top Cities
	define("LANG_LABEL_TOP_CITY", "Top Cities");
	//Top Neighborhoods
	define("LANG_LABEL_TOP_NEIGHBORHOOD", "Top Neighborhoods");
	//No locations found.
	define("LANG_LABEL_NO_LOCATIONS_FOUND", "No locations found.");
	//Renewal
	define("LANG_LABEL_RENEWAL", "Renewal");
	//Renewal Date
	define("LANG_LABEL_RENEWAL_DATE", "Renewal Date");
	//Street Address
	define("LANG_LABEL_STREET_ADDRESS", "Street Address");
	//Web Address
	define("LANG_LABEL_WEB_ADDRESS", "Web Address");
	//Phone
	define("LANG_LABEL_PHONE", "Phone");
	//Fax
	define("LANG_LABEL_FAX", "Fax");
	//Long Description
	define("LANG_LABEL_LONG_DESCRIPTION", "Long Description");
	//Status
	define("LANG_LABEL_STATUS", "Status");
	//Level
	define("LANG_LABEL_LEVEL", "Level");
	//Empty
	define("LANG_LABEL_EMPTY", "Empty");
	//Videos (Youtube etc)
	define("LANG_LABEL_VIDEOS", "Videos (Youtube etc)");
	//Additional Uploads (PDF, DOC, TXT, GIF or PNG)
	define("LANG_LABEL_ATTACH", "Additional Uploads (PDF, DOC, TXT, JPG, GIF or PNG)");
	//Facebook page
	define("LANG_LABEL_FBPAGE", "Facebook page");
	//Features
	define("LANG_LABEL_FEATURES", "Features");
	//Classified Price
	define("LANG_LABEL_CLASSIFIED_PRICE", string_ucwords(CLASSIFIED_FEATURE_NAME)." Price");
	//Event Time
	define("LANG_LABEL_EVENTTIME", string_ucwords(EVENT_FEATURE_NAME)." Time");
	//Imagery
	define("LANG_LABEL_IMAGERY", "Imagery");
	//Start Date
	define("LANG_LABEL_START_DATE", "Start Date");
	//Start Date
	define("LANG_LABEL_STARTDATE", "Start Date");
	//End Date
	define("LANG_LABEL_END_DATE", "End Date");
	//End Date
	define("LANG_LABEL_ENDDATE", "End Date");
	//Invalid date
	define("LANG_LABEL_INVALID_DATE", "Invalid date");
	//Start Time
	define("LANG_LABEL_START_TIME", "Start Time");
	//End Time
	define("LANG_LABEL_END_TIME", "End Time");
	//Unlimited
	define("LANG_LABEL_UNLIMITED", "Unlimited");
	//Select
	define("LANG_LABEL_SELECT", "Select");
	//Selected
	define("LANG_LABEL_SELECTED", "Selected");
	//Select a Type
	define("LANG_LABEL_SELECT_TYPE", "Select a Type");
	//Select a Category
	define("LANG_LABEL_SELECT_CATEGORY", "Select a Category");
	//Time Left
	define("LANG_LABEL_TIMELEFT", "Time Left");
	//View Deal
	define("LANG_LABEl_VIEW_DEAL", "View ".string_ucwords(PROMOTION_FEATURE_NAME));
	//No Deal
	define("LANG_LABEL_NO_PROMOTION", "No ".string_ucwords(PROMOTION_FEATURE_NAME));
	//Select a Deal
	define("LANG_LABEL_SELECT_PROMOTION", "Select a ". string_ucwords(PROMOTION_FEATURE_NAME));
	//Great Offer!
	define("LANG_LABEL_GREAT_OFFER", "Great Offer!");
	//Contact Name
	define("LANG_LABEL_CONTACTNAME", "Contact Name");
	//Contact Name
	define("LANG_LABEL_CONTACT_NAME", "Contact Name");
	//Contact Phone
	define("LANG_LABEL_CONTACT_PHONE", "Contact Phone");
	//Contact Fax
	define("LANG_LABEL_CONTACT_FAX", "Contact Fax");
	//Contact E-mail
	define("LANG_LABEL_CONTACT_EMAIL", "Contact E-mail");
	//URL
	define("LANG_LABEL_URL", "URL");
	//Address
	define("LANG_LABEL_ADDRESS", "Address");
	//E-mail
	define("LANG_LABEL_EMAIL", "E-mail");
	//Notify me about listing reviews and listing traffic
	define("LANG_LABEL_NOTIFY_TRAFFIC", "Notify me about ".LISTING_FEATURE_NAME." reviews and ".LISTING_FEATURE_NAME." traffic");
	//Invoice
	define("LANG_LABEL_INVOICE", "Invoice");
	//Invoice #
	define("LANG_LABEL_INVOICENUMBER", "Invoice #");
	//Item
	define("LANG_LABEL_ITEM", "Item");
	//Items
	define("LANG_LABEL_ITEMS", "Items");
	//Extra Category
	define("LANG_LABEL_EXTRA_CATEGORY", "Extra Category");
	//Discount Code
	define("LANG_LABEL_DISCOUNT_CODE", string_ucwords(DISCOUNTCODE_LABEL));
	//Item Price
	define("LANG_LABEL_ITEMPRICE", "Item Price");
	//Amount
	define("LANG_LABEL_AMOUNT", "Amount");
	//Tax
	define("LANG_LABEL_TAX", "Tax");
	//Subtotal
	define("LANG_LABEL_SUBTOTAL", "Subtotal");
	//Make checks payable to
	define("LANG_LABEL_MAKE_CHECKS_PAYABLE", "Make checks payable to");
	//Total
	define("LANG_LABEL_TOTAL", "Total");
	//Id
	define("LANG_LABEL_ID", "Id");
	//IP
	define("LANG_LABEL_IP", "IP");
	//Title
	define("LANG_LABEL_TITLE", "Title");
	//Caption
	define("LANG_LABEL_CAPTION", "Caption");
	//impressions
	define("LANG_IMPRESSIONS", "impressions");
	//Impressions
	define("LANG_LABEL_IMPRESSIONS", "Impressions");
	//By impressions
	define("LANG_LABEL_BY_IMPRESSIONS", "By impressions");
	//By time period
	define("LANG_LABEL_BY_PERIOD", "By time period");
	//Date
	define("LANG_LABEL_DATE", "Date");
	//Your E-mail
	define("LANG_LABEL_YOUREMAIL", "Your E-mail");
	//Subject
	define("LANG_LABEL_SUBJECT", "Subject");
	//Additional message
	define("LANG_LABEL_ADDITIONALMSG", "Additional message");
	//Payment type
	define("LANG_LABEL_PAYMENT_TYPE", "Payment type");
	//Notes
	define("LANG_LABEL_NOTES", "Notes");
	//It's easy and fast!
	define("LANG_LABEL_EASYFAST", "It's easy and fast!");
	//Write reviews, comment on blog
	define("LANG_LABEL_FOR_PROFILE", "Write reviews, comment on ".BLOG_FEATURE_NAME);
	//Write reviews
	define("LANG_LABEL_FOR_PROFILE2", "Write reviews");
	//Based on
	define("LANG_LABEL_BASED_ON", "Based on");
	//Write a review
	define("LANG_WRITE_REVIEW", "Write a review");
	//Already have access?
	define("LANG_LABEL_ALREADYMEMBER", "Already have access?");
	//Enjoy our services!
	define("LANG_LABEL_ENJOYSERVICES", "Enjoy our services!");
	//Test Password
	define("LANG_LABEL_TESTPASSWORD", "Test Password");
	//Forgot your password?
	define("LANG_LABEL_FORGOTPASSWORD", "Forgot your password?");
	//Summary
	define("LANG_LABEL_SUMMARY", "Summary");
	//Detail
	define("LANG_LABEL_DETAIL", "Detail");
	//(your friend's e-mail)
	define("LANG_LABEL_FRIEND_EMAIL", "(your friend's e-mail)");
	//General Contact Form
	define("LANG_LABEL_GENERAL_FORM", "General Contact Form");
	//For
	define("LANG_LABEL_FOR", "For");
	//Created
	define("LANG_LABEL_CREATED", "Created");
	//From
	define("LANG_LABEL_FROM", "From");
	//To
	define("LANG_LABEL_TO", "To");
	//to
	define("LANG_LABEL_DATE_TO", "to");
	//Last
	define("LANG_LABEL_LAST", "Last");
	//Last
	define("LANG_LABEL_LAST_PLURAL", "Last");
	//day
	define("LANG_LABEL_DAY", "day");
	//days
	define("LANG_LABEL_DAYS", "days");
	//New
	define("LANG_LABEL_NEW", "New");
	//New FAQ
	define("LANG_LABEL_NEW_FAQ", "New FAQ");
	//Type
	define("LANG_LABEL_TYPE", "Type");
	//ClickThru
	define("LANG_LABEL_CLICKTHRU", "ClickThru");
	//Added
	define("LANG_LABEL_ADDED", "Added");
    //Added on
    define("LANG_LABEL_ADDED_ON", "Added on");
    //There are no pending items.
    define("LANG_LABEL_NO_PENDING_ITEMS", "There are no pending items.");
    //There are no pending reviews.
    define("LANG_LABEL_NO_PENDING_REVIEWS", "There are no pending reviews.");
    //more
    define("LANG_LABEL_PLUS_REVIEWS", "[X] more");
    //rates this item with
    define("LANG_LABEL_REVIEW_RATES", "rates this [item] with");
    //Did you find this review helpful?
    define("LANG_LABEL_REVIEW_HELPFUL", "Did you find this review helpful?");
    //Blog Comment
    define("LANG_LAVEL_BLOG_COMMENT", string_ucwords(BLOG_FEATURE_NAME)." Comment");
	//Post Title
	define("LANG_BLOG_TITLE", "Post Title");
	//Add
	define("LANG_LABEL_ADD", "Add");
	//rating
	define("LANG_LABEL_RATING", "rating");
	//evaluator
	define("LANG_LABEL_EVALUATOR", "evaluator");
	//Reviewer
	define("LANG_LABEL_REVIEWER", "Reviewer");
	//System
	define("LANG_LABEL_SYSTEM", "System");
	//Subscribe to RSS
	define("LANG_LABEL_SUBSCRIBERSS", "Subscribe to RSS");
	//Guide
	define("LANG_LABEL_GUIDE", "Guide");
	//Password strength
	define("LANG_LABEL_PASSWORDSTRENGTH", "Password strength");
	//Article Title
	define("LANG_ARTICLE_TITLE", string_ucwords(ARTICLE_FEATURE_NAME)." Title");
	//SEO Description
	define("LANG_SEO_DESCRIPTION", "SEO Description");
	//SEO Keywords
	define("LANG_SEO_KEYWORDS", "SEO Keywords");
	//No line breaks allowed
	define("LANG_SEO_LINEBREAK", "line breaks are not allowed");
	//Separate elements with comma (,)
	define("LANG_SEO_COLON", "separate elements using comma (,)");
	//Click here to edit the SEO information of this item
	define("LANG_MSG_CLICK_TO_EDIT_SEOCENTER", "Click here to edit the SEO information of this item");
	//SEO successfully updated!
	define("LANG_MSG_SEOCENTER_ITEMUPDATED", "SEO successfully updated!");
	//Click here to view this article
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE", "Click here to view this ".ARTICLE_FEATURE_NAME);
	//Click here to edit this article
	define("LANG_MSG_CLICK_TO_EDIT_THIS_ARTICLE", "Click here to edit this ".ARTICLE_FEATURE_NAME);
	//Click here to view this article reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE_REPORTS", "Click here to view this ".ARTICLE_FEATURE_NAME." reports");
	//History for this article
	define("LANG_HISTORY_FOR_THIS_ARTICLE", "History for this ".ARTICLE_FEATURE_NAME);
	//History not available for this article
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_ARTICLE", "History not available for this ".ARTICLE_FEATURE_NAME);
	//Click here to delete this article
	define("LANG_MSG_CLICK_TO_DELETE_THIS_ARTICLE", "Click here to delete this ".ARTICLE_FEATURE_NAME);
	//Click here to view this banner
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER", "Click here to view this ".BANNER_FEATURE_NAME);
	//Click here to edit this banner
	define("LANG_MSG_CLICK_TO_EDIT_THIS_BANNER", "Click here to edit this ".BANNER_FEATURE_NAME);
	//Click here to view this banner reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER_REPORTS", "Click here to view this ".BANNER_FEATURE_NAME." reports");
	//History for this banner
	define("LANG_HISTORY_FOR_THIS_BANNER", "History for this ".BANNER_FEATURE_NAME);
	//History not available for this banner
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_BANNER", "History not available for this ".BANNER_FEATURE_NAME);
	//Click here to delete this banner
	define("LANG_MSG_CLICK_TO_DELETE_THIS_BANNER", "Click here to delete this ".BANNER_FEATURE_NAME);
	//Classified Title
	define("LANG_CLASSIFIED_TITLE", string_ucwords(CLASSIFIED_FEATURE_NAME)." Title");
	//Click here to
	define("LANG_MSG_CLICKTO", "Click here to");
	//Click here to view this classified
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED", "Click here to view this ".CLASSIFIED_FEATURE_NAME);
	//Click here to edit this classified
	define("LANG_MSG_CLICK_TO_EDIT_THIS_CLASSIFIED", "Click here to edit this ".CLASSIFIED_FEATURE_NAME);
	//Click here to view this classified reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED_REPORTS", "Click here to view this ".CLASSIFIED_FEATURE_NAME." reports");
	//Click here to map tuning this classified location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_CLASSIFIED", "Click here to map tuning this ".CLASSIFIED_FEATURE_NAME." location");
	//Map tuning not available for this classified
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_CLASSIFIED", "Map tuning not available for this ".CLASSIFIED_FEATURE_NAME);
	//History for this classified
	define("LANG_HISTORY_FOR_THIS_CLASSIFIED", "History for this ".CLASSIFIED_FEATURE_NAME);
	//History not available for this classified
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_CLASSIFIED", "History not available for this ".CLASSIFIED_FEATURE_NAME);
	//Click here to delete this classified
	define("LANG_MSG_CLICK_TO_DELETE_THIS_CLASSIFIED", "Click here to delete this ".CLASSIFIED_FEATURE_NAME);
	//Event Title
	define("LANG_EVENT_TITLE", string_ucwords(EVENT_FEATURE_NAME)." Title");
	//Click here to view this event
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT", "Click here to view this ".EVENT_FEATURE_NAME);
	//Click here to edit this event
	define("LANG_MSG_CLICK_TO_EDIT_THIS_EVENT", "Click here to edit this ". EVENT_FEATURE_NAME);
	//Click here to view this event reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT_REPORTS", "Click here to view this ".EVENT_FEATURE_NAME." reports");
	//Click here to map tuning this event location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_EVENT", "Click here to map tuning this ".EVENT_FEATURE_NAME." location");
	//Map tuning not available for this event
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_EVENT", "Map tuning not available for this ".EVENT_FEATURE_NAME);
	//History for this event
	define("LANG_HISTORY_FOR_THIS_EVENT", "History for this ".EVENT_FEATURE_NAME);
	//History not available for this event
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_EVENT", "History not available for this ".EVENT_FEATURE_NAME);
	//Click here to delete this event
	define("LANG_MSG_CLICK_TO_DELETE_THIS_EVENT", "Click here to delete this ".EVENT_FEATURE_NAME);
	//Listing Title
	define("LANG_LISTING_TITLE", string_ucwords(LISTING_FEATURE_NAME)." Title");
	//Click here to view this listing
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING", "Click here to view this ".LISTING_FEATURE_NAME);
	//Click here to edit this listing
	define("LANG_MSG_CLICK_TO_EDIT_THIS_LISTING", "Click here to edit this ".LISTING_FEATURE_NAME);
	//Click here to change deal for this listing
	define("LANG_MSG_CLICK_TO_CHANGE_PROMOTION", "Click here to change ".PROMOTION_FEATURE_NAME." for this ".LISTING_FEATURE_NAME);
	//Deal not available for this listing
	define("LANG_MSG_PROMOTION_NOT_AVAILABLE", string_ucwords(PROMOTION_FEATURE_NAME)." not available for this ".LISTING_FEATURE_NAME);
	//Click here to view this listing reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING_REPORTS", "Click here to view this ".LISTING_FEATURE_NAME." reports");
	//Click here to map tuning this listing location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_LISTING", "Click here to map tuning this ".LISTING_FEATURE_NAME." location");
	//Map tuning not available for this listing
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_LISTING", "Map tuning not available for this ".LISTING_FEATURE_NAME);
	//Map tuning Address Not Found
	define("LANG_MAPTUNING_ADDRESSNOTFOUND", "Address not found.");
	//Map tuning Please Edit Your Item
	define("LANG_MAPTUNING_PLEASEEDITYOURITEM", "Please edit your item.");
	//Click here to view this item reviews
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS", "Click here to view this item reviews");
	//Item reviews not available
	define("LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE", "Item reviews not available");
	//History for this listing
	define("LANG_HISTORY_FOR_THIS_LISTING", "History for this ".LISTING_FEATURE_NAME);
	//History not available for this listing
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_LISTING", "History not available for this ".LISTING_FEATURE_NAME);
	//Click here to delete this listing
	define("LANG_MSG_CLICK_TO_DELETE_THIS_LISTING", "Click here to delete this ".LISTING_FEATURE_NAME);
	//Save
	define("LANG_MSG_SAVE_CHANGES", "Save");
	//More Information
	define("LANG_MSG_MORE_INFO", "More Information");
	//(Try to use something descriptive, like "10% off of our product" or "3 for the price of two on our product")
	define("LANG_MSG_DEALTITLE_TIP", "(Try to use something descriptive, like \"10% off of our product\" or \"3 for the price of two on our product\")");
	//Enter the value of the item / service you are offering. Choose a discount type (Fixed Value or Percentage), and enter the respective value. Check the calculation and then provide us with the number of offers you wish to make.
	define("LANG_MSG_ADD_DEAL_TIP", "Enter the value of the item / service you are offering. Choose a discount type (Fixed Value or Percentage), and enter the respective value. Check the calculation and then provide us with the number of offers you wish to make.");
	//Please be sure your image is the right size before you upload it, otherwise the image will likely be stretched to fit the site and image quality will be affected.
	define("LANG_MSG_ADD_DEAL_TIP2", "Please be sure your image is the right size before you upload it, otherwise the image will likely be stretched to fit the site and image quality will be affected.");
	//Every deal needs to be linked to a listing in order to be active on the site.
	define("LANG_MS_MANGE_DEAL_TIP", "Every ".PROMOTION_FEATURE_NAME." needs to be linked to a ".LISTING_FEATURE_NAME." in order to be active on the site.");
	//Associate with the listing
	define("LANG_DEAL_LISTING_SELECT", "Associate with the ".LISTING_FEATURE_NAME);
	//Please type your item title and wait for suggestions of available associations.
	define("LANG_DEAL_LISTING_TIP", "Please type your item title and wait for suggestions of available associations.");
	//Empty
	define("LANG_EMPTY", "Empty");
	//Cancel
	define("LANG_CANCEL", "Cancel");
	//Custom Time Period
	define("LANG_SITEMGR_CUSTOMPERIOD", "Custom Time Period");
	//Fixed Value Discount
	define("LANG_LABEL_FIXEDVALUE_DISC", "Fixed Value Discount");
	//Percentage Discount
	define("LANG_LABEL_PERCENTAGE_DISC", "Percentage Discount");
	//Value with Discount
	define("LANG_LABEL_DISC_AMOUNT", "Value with Discount");
	//Discount (Calculated)
	define("LANG_LABEL_DISC_CALCULATED", "Discount (Calculated)");
	//How many deals would you like to offer
	define("LANG_LABEL_DEALS_OFFER", "How many ".PROMOTION_FEATURE_NAME_PLURAL." would you like to offer");
	//Linked to Listing
	define("LANG_LABEL_ATTACHED_LISTING", "Linked to ".string_ucwords(LISTING_FEATURE_NAME));
	//Choose a Listing
	define("LANG_LABEL_CHOOSE_LISTING", "Choose a ".string_ucwords(LISTING_FEATURE_NAME));
	//You can not add different deals to the same listing.
	define("LANG_MSG_REPEATED_LISTINGS", "You can not add different ".PROMOTION_FEATURE_NAME_PLURAL." to the same ".LISTING_FEATURE_NAME.".");
	//Deals successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATE", string_ucwords(PROMOTION_FEATURE_NAME_PLURAL)." successfully updated!");
	//Options
	define("LANG_LABEL_OPTIONS", "Options");
	//Deal Title
	define("LANG_PROMOTION_TITLE", string_ucwords(PROMOTION_FEATURE_NAME)." Title");
	//Click here to view this deal
	define("LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION", "Click here to view this ".PROMOTION_FEATURE_NAME);
	//Click here to edit this deal
	define("LANG_MSG_CLICK_TO_EDIT_THIS_PROMOTION", "Click here to edit this ".PROMOTION_FEATURE_NAME);
	//Click here to view this deal reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION_REPORTS", "Click here to view this ".PROMOTION_FEATURE_NAME." reports");
	//Click here to delete this deal
	define("LANG_MSG_CLICK_TO_DELETE_THIS_PROMOTION", "Click here to delete this ".PROMOTION_FEATURE_NAME);
	//Go to "Listings" and click on the deal icon belonging to the listing where you want to add the deal. Select one deal to add to your listing to make it live.
	define("LANG_PROMOTION_EXTRAMESSAGE", "Go to \"".string_ucwords(LISTING_FEATURE_NAME_PLURAL)."\" and click on the ".PROMOTION_FEATURE_NAME." icon belonging to the ".LISTING_FEATURE_NAME." where you want to add the ".PROMOTION_FEATURE_NAME.". Select one ".PROMOTION_FEATURE_NAME." to add to your ".LISTING_FEATURE_NAME." to make it live.");
	//The installments will be recurring until your credit card expiration
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATION", "The installments will be recurring until your credit card expiration");
	//The installments will be recurring until your credit card expiration ("maximum of 36 installments")
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATIONMAXOF", "maximum of 36 installments");
	//SEO Center
	define("LANG_MSG_SEO_CENTER", "SEO Center");
	//View
	define("LANG_LABEL_VIEW", "View");
	//Edit
	define("LANG_LABEL_EDIT", "Edit");
	//Traffic Reports
	define("LANG_TRAFFIC_REPORTS", "Traffic Reports");
	//Unpaid
	define("LANG_LABEL_UNPAID", "Unpaid");
	//Paid
	define("LANG_LABEL_PAID", "Paid");
	//Waiting payment approval
	define("LANG_LABEL_WAITING", "Waiting payment approval");
	//Under review
	define("LANG_LABEL_ANALYSIS", "Under review");
	//Available
	define("LANG_LABEL_AVAILABLE", "Available");
	//In dispute
	define("LANG_LABEL_DISPUTE", "In dispute");
	//Refunded
	define("LANG_LABEL_REFUNDED", "Refunded");
	//Cancelled
	define("LANG_LABEL_CANCELLED", "Cancelled");
	//Transaction
	define("LANG_LABEL_TRANSACTION", "Transaction");
	//Delete
	define("LANG_LABEL_DELETE", "Delete");
	//Download
	define("LANG_LABEL_DOWNLOAD", "Download");
	//Map Tuning
	define("LANG_LABEL_MAP_TUNING", "Map Tuning");
	//Hide Map
	define("LANG_LABEL_HIDEMAP", "Hide Map");
	//Show Map
	define("LANG_LABEL_SHOWMAP", "Show Map");
	//SEO
	define("LANG_LABEL_SEO_TUNING", "SEO");
	//Print
	define("LANG_LABEL_PRINT", "Print");
	//Pending Approval
	define("LANG_LABEL_PENDING_APPROVAL", "Pending Approval");
	//Image
	define("LANG_LABEL_IMAGE", "Image");
	//Images
	define("LANG_LABEL_IMAGE_PLURAL", "Images");
	//Required field
	define("LANG_LABEL_REQUIRED_FIELD", "Required field");
	//Please type all the required fields.
	define("LANG_LABEL_TYPE_FIELDS", "Please type all the required fields.");
	//Account Information
	define("LANG_LABEL_ACCOUNT_INFORMATION", "Account Information");
	//E-mail
	define("LANG_LABEL_USERNAME", "E-mail");
    //Username
	define("LANG_LABEL_USERNAME2", "Username");
	//Current Password
	define("LANG_LABEL_CURRENT_PASSWORD", "Current Password");
	//Password
	define("LANG_LABEL_PASSWORD", "Password");
	//Password not changed.
	define("LANG_PASSWORD_NOT_CHANGED", "Password not changed.");
	//Create Password
	define("LANG_LABEL_CREATE_PASSWORD", "Create Password");
	//New Password
	define("LANG_LABEL_NEW_PASSWORD", "New Password");
	//Retype Password
	define("LANG_LABEL_RETYPE_PASSWORD", "Retype Password");
	//Retype Password
	define("LANG_LABEL_RETYPEPASSWORD", "Retype Password");
	//Retype New Password
	define("LANG_LABEL_RETYPE_NEW_PASSWORD", "Retype New Password");
	//OpenID URL
	define("LANG_LABEL_OPENIDURL", "OpenID URL");
	//Information
	define("LANG_LABEL_INFORMATION", "Information");
	//Publication Date
	define("LANG_LABEL_PUBLICATION_DATE", "Publication Date");
	//Calendar
	define("LANG_LABEL_CALENDAR", "Calendar");
	//Friendly Url
	define("LANG_LABEL_FRIENDLY_URL", "Friendly Url");
	//For example
	define("LANG_LABEL_FOR_EXAMPLE", "For example");
	//Image Source
	define("LANG_LABEL_IMAGE_SOURCE", "Image Source");
	//Image Attribute
	define("LANG_LABEL_IMAGE_ATTRIBUTE", "Image Attribute");
	//Image Caption
	define("LANG_LABEL_IMAGE_CAPTION", "Image Caption");
	//Abstract
	define("LANG_LABEL_ABSTRACT", "Abstract");
	//Keywords for the search
	define("LANG_LABEL_KEYWORDS_FOR_SEARCH", "Keywords for the search");
	//Refine By...
	define("LANG_LABEL_REFINEBY", "Refine By...");
    //You refined by...
    define("LANG_LABEL_REFINEDBY", "You refined by...");
    //Remove all
    define("LANG_LABEL_REMOVE_ALL", "Remove all");
	//Show only listings with deals
	define("LANG_LABEL_FILTER_DEAL", "Show only ".LISTING_FEATURE_NAME_PLURAL." with ".PROMOTION_FEATURE_NAME_PLURAL);
	//maximum
	define("LANG_LABEL_MAX", "maximum");
	//keywords
	define("LANG_LABEL_KEYWORDS", "keywords");
	//Content
	define("LANG_LABEL_CONTENT", "Content");
	//Code
	define("LANG_LABEL_CODE", "Code");
	//free
	define("LANG_FREE", "FREE");
	//free
	define("LANG_LABEL_FREE", "free");
	//included
	define("LANG_INCLUDED", "included");
	//Destination Url
	define("LANG_LABEL_DESTINATION_URL", "Destination Url");
	//Script
	define("LANG_LABEL_SCRIPT", "Script");
	//File
	define("LANG_LABEL_FILE", "File");
	//Warning
	define("LANG_LABEL_WARNING", "Warning");
	//Display URL (optional)
	define("LANG_LABEL_DISPLAY_URL", "Display URL (optional)");
    //Visit Website
    define("LANG_VISIT_WEBSITE", "Visit Website");
	//Description line 1
	define("LANG_LABEL_DESCRIPTION_LINE1", "Description line 1");
	//Description line 2
	define("LANG_LABEL_DESCRIPTION_LINE2", "Description line 2");
	//Location
	define("LANG_LABEL_LOCATIONS", "Location");
	//Enter a landmark or point of reference for your listing's location.
	define("LANG_LABEL_LOCATIONS_TIP", "Enter a landmark or point of reference for your listing's location.");
	//Would you like to add more information about your item? Besides your gallery images, you can upload an additional file with extra information here
	define("LANG_LABEL_ATTACH_ADDITIONAL_FILE_TIP", "Would you like to add more information about your item? Besides your gallery images, you can upload an additional file with extra information here");
	//Fill in this field if your URL is too long. Example: "www.example.com" can be shown as "Example".
	define("LANG_LABEL_DISPLAY_URL_TIP", "Fill in this field if your URL is too long. Example: \"www.example.com\" can be shown as \"Example\".");
	//Enable monthly e-mail to listing owners that includes their stats and reviews.
	define("LANG_LABEL_NOTIFY_TRAFFIC_TIP", "Enable monthly e-mail to ".LISTING_FEATURE_NAME." owners that includes their stats and reviews.");
	//Sponsors have access to the members area and can create items. They can also create their own personal pages.
	define("LANG_LABEL_SPONSOR_TIP", "Sponsors have access to the members area and can create items. They can also create their own personal pages.");
	//Visitors can visit your frontend pages, write reviews, comment on blog and view other user's personal page. Visitors can upgrade their accounts by adding an item through the advertise process.
	define("LANG_LABEL_PROFILE_TIP", "Visitors can visit your frontend pages, write reviews, comment on ".BLOG_FEATURE_NAME." and view other user's personal page. Visitors can upgrade their accounts by adding an item through the advertise process.");
	//Address (optional)
	define("LANG_LABEL_ADDRESS_OPTIONAL", "Address (optional)");
	//Address (Optional)
	define("LANG_LABEL_ADDRESSOPTIONAL", "Address (Optional)");
	//Detail Description
	define("LANG_LABEL_DETAIL_DESCRIPTION", "Detail Description");
	//Price
	define("LANG_LABEL_PRICE", "Price");
	//Prices
	define("LANG_LABEL_PRICE_PLURAL", "Prices");
	//Contact Information
	define("LANG_LABEL_CONTACT_INFORMATION", "Contact Information");
	//Language
	define("LANG_LABEL_LANGUAGE", "Language");
	//Select your main language to contact (when necessary).
	define("LANG_LABEL_LANGUAGETIP", "Select your main language to contact (when necessary).");
	//First Name
	define("LANG_LABEL_FIRST_NAME", "First Name");
	//First Name
	define("LANG_LABEL_FIRSTNAME", "First Name");
	//Last Name
	define("LANG_LABEL_LAST_NAME", "Last Name");
	//Last Name
	define("LANG_LABEL_LASTNAME", "Last Name");
	//Company
	define("LANG_LABEL_COMPANY", "Company");
	//Address
	define("LANG_LABEL_ADDRESS1", "Address");
	//Address 2
	define("LANG_LABEL_ADDRESS2", "Address 2");
	//Latitude
	define("LANG_LABEL_LATITUDE", "Latitude");
	//Longitude
	define("LANG_LABEL_LONGITUDE", "Longitude");
	//Not found. Please, try to specify better your location.
	define("LANG_LABEL_MAP_NOTFOUND", "Not found. Please, try to specify better your location.");
	//The following fields contain errors:
	define("LANG_LABEL_MAP_ERRORS", "The following fields contain errors:");
	//Latitude must be a number between -90 and 90.
	define("LANG_LABEL_MAP_INVALID_LAT", "Latitude must be a number between -90 and 90.");
	//Longitude must be a number between -180 and 180.
	define("LANG_LABEL_MAP_INVALID_LON", "Longitude must be a number between -180 and 180.");
	//Venue
	define("LANG_LABEL_LOCATION_NAME", "Venue");
	//Event Date
	define("LANG_LABEL_EVENT_DATE", string_ucwords(EVENT_FEATURE_NAME)." Date");
	//Description
	define("LANG_LABEL_DESCRIPTION", "Description");
	//Help Information
	define("LANG_LABEL_HELP_INFORMATION", "Help Information");
	//Text
	define("LANG_LABEL_TEXT", "Text");
	//Add Image
	define("LANG_LABEL_ADDIMAGE", "Add Image");
	//Add Image
	define("LANG_LABEL_ADDIMAGES", "Add Image");
	//Edit Image Captions
	define("LANG_LABEL_EDITIMAGECAPTIONS", "Edit Image Captions");
	//Image File
	define("LANG_LABEL_IMAGEFILE", "Image File");
	//Thumb Caption
	define("LANG_LABEL_THUMBCAPTION", "Thumb Caption");
	//Image Caption
	define("LANG_LABEL_IMAGECAPTION", "Image Caption");
	//Video Snippet Code
	define("LANG_LABEL_VIDEO_SNIPPET_CODE", "Video Snippet Code");
	//Attach Additional File
	define("LANG_LABEL_ATTACH_ADDITIONAL_FILE", "Attach Additional File");
	//Attach Menu
	define("LANG_LABEL_ATTACH_MENU", "Attach Menu");
    //Menu
	define("LANG_LABEL_MENU", "Menu");
    //Good to know
    define("LANG_LABEL_GOODKNOW", "Good to know");
    //Make a reservation
    define("LANG_LABEL_RESERVATION", "Make a reservation");
	//Attention
	define("LANG_LABEL_ATTENTION", "Attention");
	//Source
	define("LANG_LABEL_SOURCE", "Source");
	//Hours
	define("LANG_LABEL_HOURS_OF_WORK", "Hours");
	//Default
	define("LANG_LABEL_DEFAULT", "Default");
	//Payment Method
	define("LANG_LABEL_PAYMENT_METHOD", "Payment Method");
    //How do you want to pay us?
    define("LANG_LABEL_PAYMENT_METHOD_TIP", "How do you want to pay us?");
	//By Credit Card
	define("LANG_LABEL_BY_CREDIT_CARD", "By Credit Card");
	//By PayPal
	define("LANG_LABEL_BY_PAYPAL", "By PayPal");
	//By SimplePay
	define("LANG_LABEL_BY_SIMPLEPAY", "By SimplePay");
	//By Pagseguro
	define("LANG_LABEL_BY_PAGSEGURO", "By Pagseguro");
	//Print Invoice and Mail a Check
	define("LANG_LABEL_PRINT_INVOICE_AND_MAIL_CHECK", "Print Invoice and Mail a Check");
	//Headline
	define("LANG_LABEL_HEADLINE", "Headline");
	//Offer
	define("LANG_LABEL_OFFER", "Offer");
	//Conditions
	define("LANG_LABEL_CONDITIONS", "Conditions");
	//Deal Dates
	define("LANG_LABEL_PROMOTION_DATE", string_ucwords(PROMOTION_FEATURE_NAME)." Dates");
	//Deal Layout
	define("LANG_LABEL_PROMOTION_LAYOUT", string_ucwords(PROMOTION_FEATURE_NAME)." Image");
	//You pay
	define("LANG_LABEL_PROMOTION_PAY", "You pay");
	//Time left to buy
	define("LANG_LABEL_PROMOTION_TIMELEFT", "Time left to buy");
	//Printable Deal
	define("LANG_LABEL_PRINTABLE_PROMOTION", "Printable ".string_ucwords(PROMOTION_FEATURE_NAME));
	//Our HTML template based deal
	define("LANG_LABEL_OUR_HTML_TEMPLATE_BASED", "Our HTML template based ".PROMOTION_FEATURE_NAME);
	//Fill in the fields above and insert a logo or other image (JPG or GIF)
	define("LANG_LABEL_FILL_FIELDS_ABOVE", "Fill in the fields above and insert a logo or other image (JPG or GIF)");
	//A deal provided by you instead
	define("LANG_LABEL_PROMOTION_PROVIDED_BY_YOU", "A ".(PROMOTION_FEATURE_NAME)." provided by you instead");
	//JPG or GIF image
	define("LANG_LABEL_JPG_GIF_IMAGE", "JPG or GIF image");
	//Comment Title
	define("LANG_LABEL_COMMENTTITLE", "Comment Title");
	//Comment
	define("LANG_LABEL_COMMENT", "Comment");
	//Accepted
	define("LANG_LABEL_ACCEPTED", "Accepted");
	//Approved
	define("LANG_LABEL_APPROVED", "Approved");
	//Success
	define("LANG_LABEL_SUCCESS", "Success");
	//Completed
	define("LANG_LABEL_COMPLETED", "Completed");
	//Y
	define("LANG_LABEL_Y", "Y");
	//Failed
	define("LANG_LABEL_FAILED", "Failed");
	//Declined
	define("LANG_LABEL_DECLINED", "Declined");
	//failure
	define("LANG_LABEL_FAILURE", "failure");
	//Canceled
	define("LANG_LABEL_CANCELED", "Canceled");
	//Error
	define("LANG_LABEL_ERROR", "Error");
	//Transaction Code
	define("LANG_LABEL_TRANSACTION_CODE", "Transaction Code");
	//Subscription ID
	define("LANG_LABEL_SUBSCRIPTION_ID", "Subscription ID");
	//transaction history
	define("LANG_LABEL_TRANSACTION_HISTORY", "transaction history");
	//Authorization Code
	define("LANG_LABEL_AUTHORIZATION_CODE", "Authorization Code");
	//Transaction Status
	define("LANG_LABEL_TRANSACTION_STATUS", "Transaction Status");
	//Transaction Error
	define("LANG_LABEL_TRANSACTION_ERROR", "Transaction Error");
	//Monthly Bill Amount
	define("LANG_LABEL_MONTHLY_BILL_AMOUNT", "Monthly Bill Amount");
	//Transaction OID
	define("LANG_LABEL_TRANSACTION_OID", "Transaction OID");
	//Yearly Bill Amount
	define("LANG_LABEL_YEARLY_BILL_AMOUNT", "Yearly Bill Amount");
	//Bill Amount
	define("LANG_LABEL_BILL_AMOUNT", "Bill Amount");
	//Transaction ID
	define("LANG_LABEL_TRANSACTION_ID", "Transaction ID");
	//Receipt ID
	define("LANG_LABEL_RECEIPT_ID", "Receipt ID");
	//Subscribe ID
	define("LANG_LABEL_SUBSCRIBE_ID", "Subscribe ID");
	//Transaction Order ID
	define("LANG_LABEL_TRANSACTION_ORDERID", "Transaction Order ID");
	//your
	define("LANG_LABEL_YOUR", "your");
	//Make Your
	define("LANG_LABEL_MAKE_YOUR", "Make Your");
	//Payment
	define("LANG_LABEL_PAYMENT", "Payment");
	//History
	define("LANG_LABEL_HISTORY", "History");
	//Log in
	define("LANG_LABEL_LOGIN", "Log in");
	//Transaction canceled
	define("LANG_LABEL_TRANSACTION_CANCELED", "Transaction canceled");
	//Transaction amount
	define("LANG_LABEL_TRANSACTION_AMOUNT", "Transaction amount");
	//Pay
	define("LANG_LABEL_PAY", "Pay");
	//Back
	define("LANG_LABEL_BACK", "Back");
	//Total Price
	define("LANG_LABEL_TOTAL_PRICE", "Total Price");
	//Pay By Invoice
	define("LANG_LABEL_PAY_BY_INVOICE", "Pay By Invoice");
	//Administrator
	define("LANG_LABEL_ADMINISTRATOR", "Administrator");
	//Billing Info
	define("LANG_LABEL_BILLING_INFO", "Billing Info");
	//Card Number
	define("LANG_LABEL_CARD_NUMBER", "Card Number");
	//Card Expire date
	define("LANG_LABEL_CARD_EXPIRE_DATE", "Card Expire date");
	//Card Code
	define("LANG_LABEL_CARD_CODE", "Card Code");
	//Customer Info
	define("LANG_LABEL_CUSTOMER_INFO", "Customer Info");
	//zip
	define("LANG_LABEL_ZIP", "zip");
	//Place Order and Continue
	define("LANG_LABEL_PLACE_ORDER_CONTINUE", "Place Order and Continue");
	//General Information
	define("LANG_LABEL_GENERAL_INFORMATION", "General Information");
	//Phone Number
	define("LANG_LABEL_PHONE_NUMBER", "Phone Number");
	//E-mail Address
	define("LANG_LABEL_EMAIL_ADDRESS", "E-mail Address");
	//Credit Card Information
	define("LANG_LABEL_CREDIT_CARD_INFORMATION", "Credit Card Information");
	//Exp. Date
	define("LANG_LABEL_EXP_DATE", "Exp. Date");
	//Customer Information
	define("LANG_LABEL_CUSTOMER_INFORMATION", "Customer Information");
	//Card Expiration
	define("LANG_LABEL_CARD_EXPIRATION", "Card Expiration");
	//Name on Card
	define("LANG_LABEL_NAME_ON_CARD", "Name on Card");
	//Card Type
	define("LANG_LABEL_CARD_TYPE", "Card Type");
	//Card Verification Number
	define("LANG_LABEL_CARD_VERIFICATION_NUMBER", "Card Verification Number");
	//Province
	define("LANG_LABEL_PROVINCE", "Province");
	//Postal Code
	define("LANG_LABEL_POSTAL_CODE", "Postal Code");
	//Post Code
	define("LANG_LABEL_POST_CODE", "Post Code");
	//Tel
	define("LANG_LABEL_TEL", "Tel");
	//Select Date
	define("LANG_LABEL_SELECTDATE", "Select Date");
	//Found
	define("LANG_PAGING_FOUND", "Found");
	//Found
	define("LANG_PAGING_FOUND_PLURAL", "Found");
	//record
	define("LANG_PAGING_RECORD", "record");
	//records
	define("LANG_PAGING_RECORD_PLURAL", "records");
	//Showing page
	define("LANG_PAGING_SHOWINGPAGE", "Showing page");
	//of
	define("LANG_PAGING_PAGEOF", "of");
	//pages
	define("LANG_PAGING_PAGE_PLURAL", "pages");
	//Go to page
	define("LANG_PAGING_GOTOPAGE", "Go to page");
	//Select
	define("LANG_PAGING_ORDERBYPAGE_SELECT", "Select");
	//Order by
	define("LANG_PAGING_ORDERBYPAGE", "Order by");
	//Characters
	define("LANG_PAGING_ORDERBYPAGE_CHARACTERS", "Characters");
    //Alphabetically
    define("LANG_PAGING_ORDERBYPAGE_ALPHABETICALLY", "Alphabetically");
	//Last update
	define("LANG_PAGING_ORDERBYPAGE_LASTUPDATE", "Last Updated");
	//Date created
	define("LANG_PAGING_ORDERBYPAGE_DATECREATED", "Date Created");
	//Popular
	define("LANG_PAGING_ORDERBYPAGE_POPULAR", "Popular");
	//Rating
	define("LANG_PAGING_ORDERBYPAGE_RATING", "Rating");
	//Price
	define("LANG_PAGING_ORDERBYPAGE_PRICE", "Price");
	//Start Date
	define("LANG_PAGING_ORDERBYPAGE_STARTDATE", LANG_LABEL_START_DATE);
	//previous page
	define("LANG_PAGING_PREVIOUSPAGE", "previous page");
	//next page
	define("LANG_PAGING_NEXTPAGE", "next page");
	//"previous" page
	define("LANG_PAGING_PREVIOUSPAGEMOBILE", "previous");
	//"next" page
	define("LANG_PAGING_NEXTPAGEMOBILE", "next");
	//view full listing
	define("LANG_VIEW_LISTING", "view full ".LISTING_FEATURE_NAME);
	//view full article
	define("LANG_VIEW_ARTICLE", "view full ".ARTICLE_FEATURE_NAME);
	//Go to Website
	define("LANG_GO_TO_WEBSITE", "Go to Website");
	//Article successfully added!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_ADDED", string_ucwords(ARTICLE_FEATURE_NAME)." successfully added!");
	//Banner successfully added!
	define("LANG_MSG_BANNER_SUCCESSFULLY_ADDED", string_ucwords(BANNER_FEATURE_NAME)." successfully added!");
	//Classified successfully added!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_ADDED", string_ucwords(CLASSIFIED_FEATURE_NAME)." successfully added!");
	//Event successfully added!
	define("LANG_MSG_EVENT_SUCCESSFULLY_ADDED", string_ucwords(EVENT_FEATURE_NAME)." successfully added!");
	//Listing successfully added!
	define("LANG_MSG_LISTING_SUCCESSFULLY_ADDED", string_ucwords(LISTING_FEATURE_NAME)." successfully added!");
	//Deal successfully added!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_ADDED", string_ucwords(PROMOTION_FEATURE_NAME)." successfully added!");
	//Article successfully updated!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_UPDATED", string_ucwords(ARTICLE_FEATURE_NAME)." successfully updated!");
	//Banner successfully updated!
	define("LANG_MSG_BANNER_SUCCESSFULLY_UPDATED", string_ucwords(BANNER_FEATURE_NAME)." successfully updated!");
	//Classified successfully updated!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_UPDATED", string_ucwords(CLASSIFIED_FEATURE_NAME)." successfully updated!");
	//Event successfully updated!
	define("LANG_MSG_EVENT_SUCCESSFULLY_UPDATED", string_ucwords(EVENT_FEATURE_NAME)." successfully updated!");
	//Listing successfully updated!
	define("LANG_MSG_LISTING_SUCCESSFULLY_UPDATED", string_ucwords(LISTING_FEATURE_NAME)." successfully updated!");
	//Deal successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATED", string_ucwords(PROMOTION_FEATURE_NAME)." successfully updated!");
	//Map Tuning successfully updated!
	define("LANG_MSG_MAPTUNING_SUCCESSFULLY_UPDATED", "Map Tuning successfully updated!");
	//Deal was successfully deleted!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_DELETED", string_ucwords(PROMOTION_FEATURE_NAME)." was successfully deleted!");
	//Deal successfully changed!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_CHANGED", string_ucwords(PROMOTION_FEATURE_NAME)." successfully changed!");
	//Banner successfully deleted!
	define("LANG_MSG_BANNER_SUCCESSFULLY_DELETED", string_ucwords(BANNER_FEATURE_NAME)." successfully deleted!");
	//Invalid image type. Please insert a JPG, GIF or PNG image.
	define("LANG_MSG_INVALID_IMAGE_TYPE", "Invalid image type. Please insert a JPG, GIF or PNG image.");
	//Invalid file type. Please insert a SWF, GIF, JPEG or PNG file.
	define("LANG_MSG_INVALID_FILE_TYPE", "Invalid file type. Please insert a SWF, GIF, JPEG or PNG file.");
	//The image file is too large
	define("LANG_MSG_IMAGE_FILE_TOO_LARGE", "The image file is too large.");
	//Please try again with another image
	define("LANG_PLEASE_TRY_AGAIN_WITH_ANOTHER_IMAGE", "Please try again with another image.");
	//Attached file was denied. Invalid file type.
	define("LANG_MSG_ATTACHED_FILE_DENIED", "Attached file was denied. Invalid file type.");
	//Please type your username.
	define("LANG_MSG_TYPE_USERNAME", "Please type your e-mail.");
	//Username was not found.
	define("LANG_MSG_USERNAME_WAS_NOT_FOUND", "E-mail was not found.");
	//Please try again or contact support at:
	define("LANG_MSG_TRY_AGAIN_OR_CONTACT_SUPPORT", "Please try again or contact support at:");
	//System Forgotten Password is disabled.
	define("LANG_MSG_FORGOTTEN_PASSWORD_DISABLED", "System Forgotten Password is disabled.");
	//Please contact support at:
	define("LANG_MSG_CONTACT_SUPPORT", "Please contact support at:");
	//Thank you!
	define("LANG_MSG_THANK_YOU", "Thank you!");
	//An e-mail was sent to the account holder with instructions to obtain a new password
	define("LANG_MSG_EMAIL_WAS_SENT_TO_ACCOUNT_HOLDER", "An e-mail was sent to the account holder with instructions to obtain a new password");
	//File not found!
	define("LANG_MSG_FILE_NOT_FOUND", "File not found!");
	//Click here to print the invoice
	define("LANG_MSG_CLICK_TO_PRINT_INVOICE", "Click here to print the invoice");
	//Click here to view the invoice detail
	define("LANG_MSG_CLICK_TO_VIEW_INVOICE_DETAIL", "Click here to view the invoice detail");
	//(prices amount are per installments)
	define("LANG_MSG_PRICES_AMOUNT_PER_INSTALLMENTS", "(prices amount are per installments)");
	//Unpaid Item
	define("LANG_MSG_UNPAID_ITEM", "Unpaid Item");
	//No Check Out Needed
	define("LANG_MSG_NO_CHECKOUT_NEEDED", "No Check Out Needed");
	//(Move the mouse over the bars to see more details about the graphic)
	define("LANG_MSG_MOVE_MOUSEOVER_THE_BARS", "(Move the mouse over the bars to see more details about the graphic)");
	//(Click the report type to display graph)
	define("LANG_MSG_CLICK_REPORT_TYPE", "(Click the report type to display graph)");
	//Click here to view this review
	define("LANG_MSG_CLICK_TO_VIEW_THIS_REVIEW", "Click here to view this review");
	//Click here to edit this review
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REVIEW", "Click here to edit this review");
	//Click here to edit this reply
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REPLY", "Click here to edit this reply");
	//Click here to delete this review
	define("LANG_MSG_CLICK_TO_DELETE_THIS_REVIEW", "Click here to delete this review");
	//Waiting Site Manager approve
	define("LANG_MSG_WAITINGSITEMGRAPPROVE", "Waiting Site Manager Approval");
	//Waiting Site Manager approve for Review
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW", "Waiting Site Manager Approval for Review");
	//Waiting Site Manager approve for Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REPLY", "Waiting Site Manager Approval for Reply");
	//Waiting Site Manager approve for Review Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW_REPLY", "Waiting Site Manager Approval for Review and Reply");
	//Review already approved
	define("LANG_MSG_REVIEW_ALREADY_APPROVED", "Review Already Approved");
	//Review and Reply already approved
	define("LANG_MSG_REVIEWANDREPLY_ALREADY_APPROVED", "Review and Reply Already Approved");
	//Review pending approval
	define("LANG_REVIEW_PENDINGAPPROVAL", "Review Pending Approval");
	//Reply pending approval
	define("LANG_REPLY_PENDINGAPPROVAL", "Reply Pending Approval");
	//Review active
	define("LANG_REVIEW_ACTIVE", "Review Active");
	//Reply active
	define("LANG_REPLY_ACTIVE", "Reply Active");
	//Review and Reply pending approval
	define("LANG_REVIEWANDREPLY_PENDINGAPPROVAL", "Review and Reply Pending Approval");
	//Review and Reply active
	define("LANG_REVIEWANDREPLY_ACTIVE", "Review and Reply Active");
	//Reply
	define("LANG_REPLY", "Reply");
	//Reply (noun)
	define("LANG_REPLYNOUN", "Reply");
	//Review and Reply
	define("LANG_REVIEWANDREPLY", "Review and Reply");
	//Edit Review
	define("LANG_LABEL_EDIT_REVIEW", "Edit Review");
	//Edit Reply
	define("LANG_LABEL_EDIT_REPLY", "Edit Reply");
	//Approve Review
	define("LANG_SITEMGR_APPROVE_REVIEW", "Approve Review");
	//Approve Reply
	define("LANG_SITEMGR_APPROVE_REPLY", "Approve Reply");
	//Reply already approved
	define("LANG_MSG_RESPONSE_ALREADY_APPROVED", "Reply Already Approved");
	//Review successfully sent!
	define("LANG_REVIEW_SUCCESSFULLY", "Review successfully sent!");
	//Reply successfully sent!
	define("LANG_REPLY_SUCCESSFULLY", "Reply successfully sent!");
	//Please type a valid reply!
	define("LANG_REPLY_EMPTY", "Please type a valid reply!");
	//Please type a valid name
	define("LANG_REVIEW_EMPTY_NAME", "Please type a valid name!");
	//Please type a valid e-mail
	define("LANG_REVIEW_EMPTY_EMAIL", "Please type a valid e-mail!");
	//Please type a valid city, State
	define("LANG_REVIEW_EMPTY_LOCATION", "Please type a valid city, state!");
	//Please type a valid review title
	define("LANG_REVIEW_EMPTY_TITLE", "Please type a valid title!");
	//Please type a valid review!
	define("LANG_REVIEW_EMPTY", "Please type a valid review!");
	//Please choose an option or click in cancel to exit.
	define("LANG_STATUS_EMPTY", "Please choose an option or click in cancel to exit.");
	//Click here to reply this review
	define("LANG_MSG_REVIEW_REPLY", "Click here to reply this review");
	//Click here to view the transaction
	define("LANG_MSG_CLICK_TO_VIEW_TRANSACTION", "Click here to view the transaction");
	//Username must be between
	define("LANG_MSG_USERNAME_MUST_BE_BETWEEN", "E-mail must be between");
	//characters with no spaces.
	define("LANG_MSG_CHARACTERS_WITH_NO_SPACES", "characters with no spaces.");
	//Password must be between
	define("LANG_MSG_PASSWORD_MUST_BE_BETWEEN", "Password must be between");
	//Type you password here if you want to change it.
	define("LANG_MSG_TIPE_YOUR_PASSWORD_HERE_IF_YOU_WANT_TO_CHANGE_IT", "Type your password here if you want to change it.");
	//Password is going to be sent to Member E-mail Address.
	define("LANG_MSG_PASSWORD_SENT_TO_MEMBER_EMAIL", "Password is going to be sent to Member E-mail Address.");
	//Please write down your username and password for future reference.
	define("LANG_MSG_WRITE_DOWN_YOUR_USERNAME_PASSWORD", "Please write down your e-mail and password for future reference.");
	//Please check the agreement terms.
	define("LANG_MSG_ALERT_AGREE_WITH_TERMS_OF_USE", "Please check the agreement terms.");
	//successfully added
	define("LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED", "Successfully added!");
	//This category was already inserted
	define("LANG_MSG_CATEGORY_ALREADY_INSERTED", "Already added");
	//Please, select a valid category
	define("LANG_MSG_SELECT_VALID_CATEGORY", "Please, select a valid category");
	//Please, select a category first
	define("LANG_MSG_SELECT_CATEGORY_FIRST", "Please, select a category first");
	//You can choose a page name title to be accessed directly from the web browser as a static html page. The chosen page name title must contain only alphanumeric chars (like "a-z" and/or "0-9") and "-" instead of spaces.
	define("LANG_MSG_FRIENDLY_URL1", "You can choose a page name title to be accessed directly from the web browser as a static html page. The chosen page name title must contain only alphanumeric chars (like \"a-z\" and/or \"0-9\") and \"-\" instead of spaces.");
	//The page name title "John Auto Repair" will be available through the url:
	define("LANG_MSG_FRIENDLY_URL2", "The page name title \"John Auto Repair\" will be available through the url:");
	//Maximum file size
	define("LANG_MSG_MAX_FILE_SIZE", "Maximum file size");
	//Transparent .gif or .png not supported
	define("LANG_MSG_TRANSPARENTGIF_NOT_SUPPORTED", "Transparent .gif or .png not supported");
	//Animated .gif isn't supported.
	define("LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED", "Animated .gif isn't supported.");
	//Please be sure that your image dimensions fit within the recommended pixel sizes, otherwise, image quality can be effected.
	define("LANG_MSG_IMAGE_DIMENSIONS_ALERT", "Please be sure that your image dimensions fit within the recommended pixel sizes, otherwise, image quality can be effected.");
	//Check this box to remove your existing image
	define("LANG_MSG_CHECK_TO_REMOVE_IMAGE", "Check this box to remove your existing image");
	//maximum 250 characters
	define("LANG_MSG_MAX_250_CHARS", "maximum 250 characters");
	//maximum 100 characters
	define("LANG_MSG_MAX_100_CHARS", "maximum 100 characters");
	//characters left
	define("LANG_MSG_CHARS_LEFT", "characters left");
	//(including spaces and line breaks)
	define("LANG_MSG_INCLUDING_SPACES_LINE_BREAKS", "(including spaces and line breaks)");
	//Include up to
	define("LANG_MSG_INCLUDE_UP_TO_KEYWORDS", "Include up to");
	//keywords with a maximum of 50 characters each.
	define("LANG_MSG_KEYWORDS_WITH_MAXIMUM_50", "keywords with a maximum of 50 characters each.");
	//Add one keyword or keyword phrase per line.
	define("LANG_MSG_KEYWORD_PER_LINE", "Add one keyword or keyword phrase per line.");
	//Only select sub-categories that directly apply to your type.
	define("LANG_MSG_ONLY_SELECT_SUBCATEGS", "Only select sub-categories that directly apply to your type.");
	//Your article will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_ARTICLE_AUTOMATICALLY_APPEAR", "Your ".ARTICLE_FEATURE_NAME." will automatically appear in the main category of each sub-category you select.");
	//maximum 25 characters
	define("LANG_MSG_MAX_25_CHARS", "maximum 25 characters");
	//maximum 500 characters
	define("LANG_MSG_MAX_500_CHARS", "maximum 500 characters");
	//Allowed file types
	define("LANG_MSG_ALLOWED_FILE_TYPES", "Allowed file types");
	//Click here to preview this listing
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_LISTING", "Click here to preview this ".LISTING_FEATURE_NAME);
	//Click here to preview this event
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_EVENT", "Click here to preview this ".EVENT_FEATURE_NAME);
	//Click here to preview this classified
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_CLASSIFIED", "Click here to preview this ".CLASSIFIED_FEATURE_NAME);
	//Click here to preview this article
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_ARTICLE", "Click here to preview this ".ARTICLE_FEATURE_NAME);
	//Click here to preview this banner
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_BANNER", "Click here to preview this ".BANNER_FEATURE_NAME);
	//Click here to preview this deal
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_PROMOTION", "Click here to preview this ".PROMOTION_FEATURE_NAME);
	//maximum 30 characters
	define("LANG_MSG_MAX_30_CHARS", "maximum 30 characters");
	//Select a Country
	define("LANG_MSG_SELECT_A_COUNTRY", "Select a Country");
	//Select a Region
	define("LANG_MSG_SELECT_A_REGION", "Select a Region");
	//Select a State
	define("LANG_MSG_SELECT_A_STATE", "Select a State");
	//Select a City
	define("LANG_MSG_SELECT_A_CITY", "Select a City");
	//Select a Neighborhood
	define("LANG_MSG_SELECT_A_NEIGHBORHOOD", "Select a Neighborhood");
	//(This information will not be displayed publicly)
	define("LANG_MSG_INFO_NOT_DISPLAYED", "(This information will not be displayed publicly)");
	//Your event will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_EVENT_AUTOMATICALLY_APPEAR", "Your ".EVENT_FEATURE_NAME." will automatically appear in the main category of each sub-category you select.");
	//If video snippet code was filled in, it will appear on the detail page
	define("LANG_MSG_VIDEO_SNIPPET_CODE", "If video snippet code was filled in, it will appear on the detail page");
	//Maximum video code size supported
	define("LANG_MSG_MAX_VIDEO_CODE_SIZE", "Maximum video code size supported");
	//If the video code size is bigger than supported video size, it will be modified.
	define("LANG_MSG_VIDEO_MODIFIED", "If the video code size is bigger than supported video size, it will be modified.");
	//Attachment has no caption
	define("LANG_MSG_ATTACHMENT_HAS_NO_CAPTION", "Attachment has no caption");
	//Check this box to remove existing listing attachment
	define("LANG_MSG_CLICK_TO_REMOVE_ATTACHMENT", "Check this box to remove existing ".LISTING_FEATURE_NAME." attachment");
	//Add one phrase per line.
	define("LANG_MSG_PHRASE_PER_LINE", "Add one phrase per line.");
	//Extra categories cost an
	define("LANG_MSG_EXTRA_CATEGORIES_COST", "Extra categories cost an");
	//additional
	define("LANG_MSG_ADDITIONAL", "additional");
	//each.
	define("LANG_MSG_BE_SEEN", "each.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_LISTING_AUTOMATICALLY_APPEAR", "Your ".LISTING_FEATURE_NAME." will automatically appear in the main category of each sub-category you select.");
	//If you add new categories, your listing will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_LISTING_TEMPORARY_CATEGORY", "If you add new categories, your ".LISTING_FEATURE_NAME." will not appear in the main category of each sub-category you added until site manager approve them.");
	//If you add new categories, your article will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_ARTICLE_TEMPORARY_CATEGORY", "If you add new categories, your ".ARTICLE_FEATURE_NAME." will not appear in the main category of each sub-category you added until site manager approve them.");
	//If you add new categories, your classified will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_CLASSIFIED_TEMPORARY_CATEGORY", "If you add new categories, your ".CLASSIFIED_FEATURE_NAME." will not appear in the main category of each sub-category you added until site manager approve them.");
	//If you add new categories, your event will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_EVENT_TEMPORARY_CATEGORY", "If you add new categories, your ".EVENT_FEATURE_NAME." will not appear in the main category of each sub-category you added until site manager approve them.");
	//Request your listing to be considered for the following badges.
	define("LANG_MSG_REQUEST_YOUR_LISTING", "Request your ".LISTING_FEATURE_NAME." to be considered for the following badges.");
	//Click here to select date
	define("LANG_MSG_CLICK_TO_SELECT_DATE", "Click here to select date");
	//"Click on the" deal icon below if you wish to add deal to your listing.
	define("LANG_LISTING_CLICK_PROMOTION_BELOW", "Click on the");
	//Click on the "deal icon" below if you wish to add deal to your listing.
	define("LANG_LISTING_PROMOTION_ICON", string_ucwords(PROMOTION_FEATURE_NAME)." icon");
	//Click on the deal icon "below if you wish to add deal to your listing."
	define("LANG_LISTING_IFYOUWISHADDPROMOTION", "below if you wish to add ".PROMOTION_FEATURE_NAME." to your listing.");
	//You can add deal to your listing by clicking on the link
	define("LANG_LISTING_YOUCANADDPROMOTION", "You can add ".PROMOTION_FEATURE_NAME." to your ".LISTING_FEATURE_NAME." by clicking on the link");
	//add deal
	define("LANG_LISTING_ADDPROMOTION", "add ".PROMOTION_FEATURE_NAME);
	//All pages but item pages
	define("LANG_ALLPAGESBUTITEMPAGES", "All pages but item pages");
	//All pages
	define("LANG_ALLPAGES", "All pages");
	//All
	define("LANG_ALL", "All");
	//Non-category search
	define("LANG_NONCATEGORYSEARCH", "Non-category search");
	//deal
	define("LANG_ICONPROMOTION", PROMOTION_FEATURE_NAME);
	//e-mail to friend
	define("LANG_ICONEMAILTOFRIEND", "e-mail to friend");
	//Add to Favorites
	define("LANG_ICONQUICKLIST_ADD", "Add to Favorites");
	//remove from favorites
	define("LANG_ICONQUICKLIST_REMOVE", "remove from favorites");
	//print
	define("LANG_ICONPRINT", "print");
	//map
	define("LANG_ICONMAP", "map");
	//Add to
	define("LANG_ADDTO_SOCIALBOOKMARKING", "Add to");
	//Google maps are not available. Please contact the administrator.
	define("LANG_GOOGLEMAPS_NOTAVAILABLE_CONTACTADM", "Google maps are not available. Please contact the administrator.");
	//Remove
	define("LANG_QUICKLIST_REMOVE", "Remove");
	//Favorite Articles
	define("LANG_FAVORITE_ARTICLE", "Favorite ".string_ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//Favorite Classifieds
	define("LANG_FAVORITE_CLASSIFIED", "Favorite ".string_ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//Favorite Events
	define("LANG_FAVORITE_EVENT", "Favorite ".string_ucwords(EVENT_FEATURE_NAME_PLURAL));
	//Favorite Listings
	define("LANG_FAVORITE_LISTING", "Favorite ".string_ucwords(LISTING_FEATURE_NAME_PLURAL));
	//Favorite Deals
	define("LANG_FAVORITE_PROMOTION", "Favorite ".string_ucwords(PROMOTION_FEATURE_NAME_PLURAL));
	//Published
	define("LANG_ARTICLE_PUBLISHED", "Published");
	//More Info
	define("LANG_CLASSIFIED_MOREINFO", "More Info");
	//Date
	define("LANG_EVENT_DATE", "Date");
	//Time
	define("LANG_EVENT_TIME", "Time");
	//Get driving directions
	define("LANG_EVENT_DRIVINGDIRECTIONS", "Get driving directions");
	//Website
	define("LANG_EVENT_WEBSITE", "Website");
	//phone
	define("LANG_EVENT_LETTERPHONE", "Phone");
	//More
	define("LANG_EVENT_MORE", "More");
	//More Info
	define("LANG_EVENT_MOREINFO", "More Info");
	//See all categories
	define("LANG_SEEALLCATEGORIES", "See all categories");
	//View all listing categories
	define("LANG_LISTING_VIEWALLCATEGORIES", "View all ".LISTING_FEATURE_NAME." categories");
	//More Info
	define("LANG_LISTING_MOREINFO", "More Info");
	//view phone
	define("LANG_LISTING_VIEWPHONE", "view phone");
	//view fax
	define("LANG_LISTING_VIEWFAX", "view fax");
	//Send Email
	define("LANG_SEND_AN_EMAIL", "Send Email");
	//Click here to see more info!
	define("LANG_LISTING_ATTACHMENT", "Click here to see more info!");
	//Download [item] Menu
	define("LANG_LISTING_DOWNLOADMENU", "Download [item] Menu");
	//Complete the form below to contact us.
	define("LANG_LISTING_CONTACTTITLE", "Complete the form below to contact us.");
	//Contact this Listing
	define("LANG_LISTING_CONTACT", "Contact this ".ucfirst(LISTING_FEATURE_NAME));
	//E-mail an inquiry
	define("LANG_LISTING_INQUIRY", "E-mail an inquiry");
	//phone
	define("LANG_LISTING_LETTERPHONE", "phone");
	//fax
	define("LANG_LISTING_LETTERFAX", "fax");
	//website
	define("LANG_LISTING_LETTERWEBSITE", "website");
	//e-mail
	define("LANG_LISTING_LETTEREMAIL", "e-mail");
	//offers the following products and/or services:
	define("LANG_LISTING_OFFERS", "offers the following products and/or services:");
	//Hours
	define("LANG_LISTING_HOURS_OF_WORK", "Hours");
	//Check in
	define("LANG_CHECK_IN", "Check in");
	//No review comment found for this item!
	define("LANG_REVIEW_NORECORD", "No review comment found for this item!");
	//Reviews and comments from the last month
	define("LANG_REVIEWS_MONTH", "Reviews and comments from the last month");
	//Review
	define("LANG_REVIEW", "Review");
	//Reviews
	define("LANG_REVIEW_PLURAL", "Reviews");
	//Reviews
	define("LANG_REVIEWTITLE", "Reviews");
	//review
	define("LANG_REVIEWCOUNT", "review");
	//reviews
	define("LANG_REVIEWCOUNT_PLURAL", "reviews");
	//Check In
	define("LANG_CHECKINCOUNT", "Check In");
	//Check ins
	define("LANG_CHECKINCOUNT_PLURAL", "Check ins");
	//See check ins
	define("LANG_CHECKINSEECOMMENTS", "See check ins");
	//Check ins of
	define("LANG_CHECKINSOF", "Check ins of");
	//No check in found for this item!
	define("LANG_CHECKIN_NORECORD", "No check in found for this item!");
	//Related Categories
	define("LANG_RELATEDCATEGORIES", "Related Categories");
    //Related Listings
	define("LANG_RELATEDLISTINGS", "Related ".LISTING_FEATURE_NAME_PLURAL);
	//Subcategories
	define("LANG_LISTING_SUBCATEGORIES", "Subcategories");
	//See comments
	define("LANG_REVIEWSEECOMMENTS", "See comments");
    //Pending Reviews
    define("LANG_REVIEW_PENDING", "Pending Reviews");
    //Approve
    define("LANG_REVIEW_APPROVE", "Approve");
	//Rate It!
	define("LANG_REVIEWRATEIT", "Rate It");
	//Be the first to review this item!
	define("LANG_REVIEWBETHEFIRST", "Be the first to review this item!");
	//Offered by
	define("LANG_PROMOTION_OFFEREDBY", "Offered by");
	//More Info
	define("LANG_PROMOTION_MOREINFO", "More Info");
	//Valid from
	define("LANG_PROMOTION_VALIDFROM", "Valid from");
	//to
	define("LANG_PROMOTION_VALIDTO", "to");
	//Print Deal
	define("LANG_PROMOTION_PRINT", "Print ".string_ucwords(PROMOTION_FEATURE_NAME));
	//Article
	define("LANG_ARTICLE_FEATURE_NAME", string_ucwords(ARTICLE_FEATURE_NAME));
	//Articles
	define("LANG_ARTICLE_FEATURE_NAME_PLURAL", string_ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//Blog
	define("LANG_BLOG_FEATURE_NAME", string_ucwords(BLOG_FEATURE_NAME));
	//Banner
	define("LANG_BANNER_FEATURE_NAME", string_ucwords(BANNER_FEATURE_NAME));
	//Banners
	define("LANG_BANNER_FEATURE_NAME_PLURAL", string_ucwords(BANNER_FEATURE_NAME_PLURAL));
	//Classified
	define("LANG_CLASSIFIED_FEATURE_NAME", string_ucwords(CLASSIFIED_FEATURE_NAME));
	//Classifieds
	define("LANG_CLASSIFIED_FEATURE_NAME_PLURAL", string_ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//Event
	define("LANG_EVENT_FEATURE_NAME", string_ucwords(EVENT_FEATURE_NAME));
	//Events
	define("LANG_EVENT_FEATURE_NAME_PLURAL", string_ucwords(EVENT_FEATURE_NAME_PLURAL));
	//Listing
	define("LANG_LISTING_FEATURE_NAME", string_ucwords(LISTING_FEATURE_NAME));
	//Listings
	define("LANG_LISTING_FEATURE_NAME_PLURAL", string_ucwords(LISTING_FEATURE_NAME_PLURAL));
	//Deal
	define("LANG_PROMOTION_FEATURE_NAME", string_ucwords(PROMOTION_FEATURE_NAME));
	//Deals
	define("LANG_PROMOTION_FEATURE_NAME_PLURAL", string_ucwords(PROMOTION_FEATURE_NAME_PLURAL));
	//Send
	define("LANG_BUTTON_SEND", "Send");
	//Sign Up
	define("LANG_BUTTON_SIGNUP", "Sign Up");
	//View Category Path
	define("LANG_BUTTON_VIEWCATEGORYPATH", "View Category Path");
	//More info
	define("LANG_VIEWCATEGORY", "More info");
	//No info found
	define("LANG_NOINFO", "No info found");
	//Remove Selected Category
	define("LANG_BUTTON_REMOVESELECTEDCATEGORY", "Remove Selected Category");
	//Continue
	define("LANG_BUTTON_CONTINUE", "Continue");
	//No, thank you
	define("LANG_BUTTON_NO_THANKS", "No, thank you");
	//Yes, continue
	define("LANG_BUTTON_YES_CONTINUE", "Yes, continue.");
	//No, Order without the Package!
	define("LANG_BUTTON_NO_ORDER_WITHOUT", "No, Order without the Package.");
	//Increase your Visibility!
	define("LANG_INCREASE_VISIBILITY", "Increase your Visibility!");
	//Gift
	define("LANG_GIFT", "Gift");
	//Help to Increase your visibility, check our
	define("LANG_HELP_INCREASE", "Help to Increase your visibility, check our ");
	//Site statistics
	define("LANG_DOMAIN_STATISTICS", "Site statistics!");
	//Visitors per Month
	define("LANG_VISITOR_MONTH", "Visitors per Month");
	//Custom option
	define("LANG_CUSTOM_OPTION", "Custom option");
	//Ok
	define("LANG_BUTTON_OK", "Ok");
	//Cancel
	define("LANG_BUTTON_CANCEL", "Cancel");
	//Log in
	define("LANG_BUTTON_LOGIN", "Log in");
	//Save Map Tuning
	define("LANG_BUTTON_SAVE_MAP_TUNING", "Save Map Tuning");
	//Clear Map Tuning
	define("LANG_BUTTON_CLEAR_MAP_TUNING", "Clear Map Tuning");
	//Next
	define("LANG_BUTTON_NEXT", "Next");
	//Pay By CreditCard
	define("LANG_BUTTON_PAY_BY_CREDIT_CARD", "Pay By CreditCard");
	//Pay By PayPal
	define("LANG_BUTTON_PAY_BY_PAYPAL", "Pay By PayPal");
	//Pay By SimplePay
	define("LANG_BUTTON_PAY_BY_SIMPLEPAY", "Pay By SimplePay");
	//Search
	define("LANG_BUTTON_SEARCH", "Search");
	//Advanced
	define("LANG_BUTTON_ADVANCEDSEARCH", "Advanced");
	//Close
	define("LANG_BUTTON_ADVANCEDSEARCH_CLOSE", "Close");
	//Clear
	define("LANG_BUTTON_CLEAR", "Clear");
	//Add your Article
	define("LANG_BUTTON_ADDARTICLE", "Add your ".string_ucwords(ARTICLE_FEATURE_NAME));
	//Add your Classified
	define("LANG_BUTTON_ADDCLASSIFIED", "Add your ".string_ucwords(CLASSIFIED_FEATURE_NAME));
	//Add your Event
	define("LANG_BUTTON_ADDEVENT", "Add your ".string_ucwords(EVENT_FEATURE_NAME));
	//Add your Listing
	define("LANG_BUTTON_ADDLISTING", "Add your ".string_ucwords(LISTING_FEATURE_NAME));
	//Add your Deal
	define("LANG_BUTTON_ADDPROMOTION", "Add your ".string_ucwords(PROMOTION_FEATURE_NAME));
	//Home
	define("LANG_BUTTON_HOME", "Home");
	//Manage Account
	define("LANG_BUTTON_MANAGE_ACCOUNT", "Manage Account");
	//Manage Content
	define("LANG_MANAGE_CONTENT", "Manage Content");
	//Sponsor
	define("LANG_SPONSOR_AREA", "Sponsor");
	//Site Manager
	define("LANG_SITEMGR_AREA", "Site Manager");
	//Site Manager Section
	define("LANG_LABEL_SITEMGR_SECTION", "Site Manager Section");
	//Help
	define("LANG_BUTTON_HELP", "Help");
	//Sign out
	define("LANG_BUTTON_LOGOUT", "Sign out");
	//Submit
	define("LANG_BUTTON_SUBMIT", "Submit");
	//Update
	define("LANG_BUTTON_UPDATE", "Update");
	//Back
	define("LANG_BUTTON_BACK", "Back");
	//Delete
	define("LANG_BUTTON_DELETE", "Delete");
	//Complete the Process
	define("LANG_BUTTON_COMPLETE_THE_PROCESS", "Complete the Process");
	//Please enter the text you see in the image at the left into the textbox. This is required to prevent automated submission of contact requests.
	define("LANG_CAPTCHA_HELP", "Please enter the text you see in the image at the left into the textbox. This is required to prevent automated submission of contact requests.");
	//Verification Code image cannot be displayed
	define("LANG_CAPTCHA_ALT", "Verification Code image cannot be displayed");
	//Verification Code
	define("LANG_CAPTCHA_TITLE", "Verification Code");
	//Please select a rating for this item
	define("LANG_MSG_REVIEW_SELECTRATING", "Please select a rating for this item");
	//Fraud detected! Please select a rating for this item!
	define("LANG_MSG_REVIEW_FRAUD_SELECTRATING", "Fraud detected! Please select a rating for this item!");
	//"Comment" and "Comment Title" are required to post a comment!
	define("LANG_MSG_REVIEW_COMMENTREQUIRED", "\"Comment\" and \"Comment Title\" are required to post a comment!");
	//"Name" and "E-mail" are required to post a comment!
	define("LANG_MSG_REVIEW_NAMEEMAILREQUIRED", "\"Name\" and \"E-mail\" are required to post a comment!");
	//"City, State" are required to post a comment!
	define("LANG_MSG_REVIEW_CITYSTATEREQUIRED", "\"City, State\" are required to post a comment!");
	//Please type a valid e-mail address!
	define("LANG_MSG_REVIEW_TYPEVALIDEMAIL", "Please type a valid e-mail address!");
	//You have already given your opinion on this item. Thank you.
	define("LANG_MSG_REVIEW_YOUALREADYGIVENOPINION", "You have already given your opinion on this item. Thank you.");
	//Thanks for the feedback!
	define("LANG_MSG_REVIEW_THANKSFEEDBACK", "Thanks for the feedback!");
	//Your review has been submitted for approval.
	define("LANG_MSG_REVIEW_REVIEWSUBMITTEDAPPROVAL", "Your review has been submitted for approval.");
	//No payment method was selected!
	define("LANG_MSG_NO_PAYMENT_METHOD_SELECTED", "No payment method was selected!");
	//Wrong credit card expiration date. Please, try again.
	define("LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN", "Wrong credit card expiration date. Please, try again.");
	//Click here to try again
	define("LANG_MSG_CLICK_HERE_TO_TRY_AGAIN", "Click here to try again");
	//Payment transactions may not occur immediately.
	define("LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY", "Payment transactions may not occur immediately.");
	//After your payment is processed, information about your transaction
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT", "After your payment is processed, information about your transaction");
	//may be found in your transaction history.
	define("LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY", "may be found in your transaction history.");
	//"may be found in your" transaction history
	define("LANG_MSG_MAY_BE_FOUND_IN_YOUR", "may be found in your");
	//The payment gateway is not available currently
	define("LANG_MSG_PAYMENT_GATEWAY_NOT_AVAILABLE", "The payment gateway is not available currently");
	//The payment parameters could not be validated
	define("LANG_MSG_PAYMENT_INVALID_PARAMS", "The payment parameters could not be validated");
	//Internal gateway error was encountered
	define("LANG_MSG_INTERNAL_GATEWAY_ERROR", "Internal gateway error was encountered");
	//Information about your transaction may be found
	define("LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND", "Information about your transaction may be found");
	//in your transaction history.
	define("LANG_MSG_IN_YOUR_TRANSACTION_HISTORY", "in your transaction history.");
	//in your
	define("LANG_MSG_IN_YOUR", "in your");
	//No Transaction ID
	define("LANG_MSG_NO_TRANSACTION_ID", "No Transaction ID");
	//System failure, please try again.
	define("LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN", "System failure, please try again.");
	//Please, fill in all required fields.
	define("LANG_MSG_FILL_ALL_REQUIRED_FIELDS", "Please, fill in all required fields.");
	//Could not connect.
	define("LANG_MSG_COULD_NOT_CONNECT", "Could not connect.");
	//Thank you for setting up your items and for making the payment!
	define("LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT", "Thank you for setting up your items and for making the payment!");
	//Site manager will review your items and set it live within 2 working days.
	define("LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS", "Site manager will review your items and set it live within 2 working days.");
	//The payment gateway could not respond
	define("LANG_MSG_PAYMENT_GATEWAY_COULD_NOT_RESPOND", "The payment gateway could not respond");
	//Pending payments may take 3 to 4 days to be approved.
	define("LANG_MSG_PENDING_PAYMENTS_TAKE_3_4_DAYS_TO_BE_APPROVED", "Pending payments may take 3 to 4 days to be approved.");
	//Connection Failure
	define("LANG_MSG_CONNECTION_FAILURE", "Connection Failure");
	//Please, fill correctly zip.
	define("LANG_MSG_FILL_CORRECTLY_ZIP", "Please, fill correctly zip.");
	//Please, fill correctly card verification number.
	define("LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER", "Please, fill correctly card verification number.");
	//Card Type and Card Verification Number do not match.
	define("LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH", "Card Type and Card Verification Number do not match.");
	//Transaction Not Completed.
	define("LANG_MSG_TRANSACTION_NOT_COMPLETED", "Transaction Not Completed.");
	//Error Number:
	define("LANG_MSG_ERROR_NUMBER", "Error Number:");
	//Short Message
	define("LANG_MSG_SHORT_MESSAGE", "Short Message:");
	//Long Message
	define("LANG_MSG_LONG_MESSAGE", "Long Message:");
	//Transaction Completed Successfully.
	define("LANG_MSG_TRANSACTION_COMPLETED_SUCCESSFULLY", "Transaction Completed Successfully.");
	//Card expire date must be in the future
	define("LANG_MSG_CARD_EXPIRE_DATE_IN_FUTURE", "Card expire date must be in the future");
	//If your transaction was confirmed, information about it may be found in
	define("LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED", "If your transaction was confirmed, information about it may be found in");
	//your transaction history after your payment is processed.
	define("LANG_MSG_YOUR_TRANSACTION_AFTER_PAYMENT_PROCESSED", "your transaction history after your payment is processed.");
	//after your payment is processed.
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED", "after your payment is processed.");
	//No items requiring payment.
	define("LANG_MSG_NO_ITEMS_REQUIRING_PAYMENT", "No items requiring payment.");
	//Pay for outstanding invoices
	define("LANG_MSG_PAY_OUTSTANDING_INVOICES", "Pay for outstanding invoices");
	//Banner by Impression and Custom Invoices can be paid once.
	define("LANG_MSG_BANNER_CUSTOM_INVOICE_PAID_ONCE", string_ucwords(BANNER_FEATURE_NAME)." by Impression and Custom Invoices can be paid once.");
	//Banner by Impression can be paid once.
	define("LANG_MSG_BANNER_PAID_ONCE", string_ucwords(BANNER_FEATURE_NAME)." by Impression can be paid once.");
	//Custom Invoices can be paid once.
	define("LANG_MSG_CUSTOM_INVOICE_PAID_ONCE", "Custom Invoices can be paid once.");
	//View Items
	define("LANG_VIEWITEMS", "View Items");
	//Please do not use recurring payment system.
	define("LANG_MSG_PLEASE_DO_NOT_USE_RECURRING_PAYMENT_SYSTEM", "Please do not use recurring payment system.");
	//Multiple Items
	define("LANG_ORDER_MULTIPLEITEMS", "Multiple Items");
	//Try again!
	define("LANG_MSG_TRY_AGAIN", "Try again!");
	//All fields are required.
	define("LANG_MSG_ALL_FIELDS_REQUIRED", "All fields are required.");
	//"You have more than" X items. Please contact the administrator to check out it.
	define("LANG_MSG_OVERITEM_MORETHAN", "You have more than");
	//You have more than X items. "Please contact the administrator to check out it".
	define("LANG_MSG_OVERITEM_CONTACTADMIN", "Please contact the administrator to check out it");
	//Article Options
	define("LANG_ARTICLE_OPTIONS", string_ucwords(ARTICLE_FEATURE_NAME)." Options");
	//Article Author
	define("LANG_ARTICLE_AUTHOR", string_ucwords(ARTICLE_FEATURE_NAME)." Author");
	//Article Author URL
	define("LANG_ARTICLE_AUTHOR_URL", string_ucwords(ARTICLE_FEATURE_NAME)." Author URL");
	//Article Categories
	define("LANG_ARTICLE_CATEGORIES", string_ucwords(ARTICLE_FEATURE_NAME)." Categories");
	//Banner Type
	define("LANG_BANNER_TYPE", string_ucwords(BANNER_FEATURE_NAME)." Type");
	//Banner Options
	define("LANG_BANNER_OPTIONS", string_ucwords(BANNER_FEATURE_NAME)." Options");
	//Order Banner
	define("LANG_ORDER_BANNER", "Order ".string_ucwords(BANNER_FEATURE_NAME));
	//By time period
	define("LANG_BANNER_BY_TIME_PERIOD", "By time period");
	//Banner Details
	define("LANG_BANNER_DETAIL_PLURAL", string_ucwords(BANNER_FEATURE_NAME)." Details");
	//Script Banner
	define("LANG_SCRIPT_BANNER", "Script ".string_ucwords(BANNER_FEATURE_NAME));
	//Show by Script Code
	define("LANG_SHOWSCRIPTCODE", "Show by Script Code");
	//Allow script to be entered instead of an image. This field allows you to paste in script that will be used to display the banner from an affiliate program or external banner system. If "Show by Script Code" is checked, just "Script" field will be required. The other fields below will not be necessary.
	define("LANG_SCRIPTCODEHELP", "Allow script to be entered instead of an image. This field allows you to paste in script that will be used to display the ".BANNER_FEATURE_NAME." from an affiliate program or external ".BANNER_FEATURE_NAME." system. If \"Show by Script Code\" is checked, just \"Script\" field will be required. The other fields below will not be necessary.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload script banners.
	define("LANG_SCRIPTCODEHELP2", "Both \"Destination Url\" and \"Traffic Report ClickThru\" has no effect when you upload script ".BANNER_FEATURE_NAME_PLURAL.".");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload swf file
	define("LANG_BANNERFILEHELP", "Both \"Destination Url\" and \"Traffic Report ClickThru\" has no effect when you upload swf file");
	//Classified Level
	define("LANG_CLASSIFIED_LEVEL", string_ucwords(CLASSIFIED_FEATURE_NAME)." Level");
	//Classified Category
	define("LANG_CLASSIFIED_CATEGORY", string_ucwords(CLASSIFIED_FEATURE_NAME)." Category");
	//Select classified level
	define("LANG_MENU_SELECT_CLASSIFIED_LEVEL", "Select ".CLASSIFIED_FEATURE_NAME." level");
	//Classified Options
	define("LANG_CLASSIFIED_OPTIONS", string_ucwords(CLASSIFIED_FEATURE_NAME)." Options");
	//Event Level
	define("LANG_EVENT_LEVEL", string_ucwords(EVENT_FEATURE_NAME)." Level");
	//Event Categories
	define("LANG_EVENT_CATEGORY_PLURAL", string_ucwords(EVENT_FEATURE_NAME)." Categories");
	//Event Categories
	define("LANG_EVENT_CATEGORIES", string_ucwords(EVENT_FEATURE_NAME)." Categories");
	//Select event level
	define("LANG_MENU_SELECT_EVENT_LEVEL", "Select ".EVENT_FEATURE_NAME." level");
	//Event Options
	define("LANG_EVENT_OPTIONS", string_ucwords(EVENT_FEATURE_NAME)." Options");
	//Listing Level
	define("LANG_LISTING_LEVEL", string_ucwords(LISTING_FEATURE_NAME)." Level");
	//Listing Type
	define("LANG_LISTING_TEMPLATE", string_ucwords(LISTING_FEATURE_NAME)." Type");
	//Listing Categories
	define("LANG_LISTING_CATEGORIES", string_ucwords(LISTING_FEATURE_NAME)." Categories");
	//Listing Badges
	define("LANG_LISTING_DESIGNATION_PLURAL", string_ucwords(LISTING_FEATURE_NAME)." Badges");
	//Subject to administrator approval.
	define("LANG_LISTING_SUBJECTTOAPPROVAL", "Subject to administrator approval.");
	//Select this choice
	define("LANG_LISTING_SELECT_THIS_CHOICE", "Select this choice");
	//Select listing level
	define("LANG_MENU_SELECTLISTINGLEVEL", "Select ".LISTING_FEATURE_NAME." level");
	//Select event level
	define("LANG_MENU_SELECTEVENTLEVEL", "Select ".EVENT_FEATURE_NAME." level");
	//Select classified level
	define("LANG_MENU_SELECTCLASSIFIEDLEVEL", "Select ".CLASSIFIED_FEATURE_NAME." level");
	//Listing Options
	define("LANG_LISTING_OPTIONS", string_ucwords(LISTING_FEATURE_NAME)." Options");
	//Payment System is not available. Please contact the
	define("LANG_GATEWAY_NO_AVAILABLE", "Payment System is not available. Please contact the");
	//Upload Warning
	define("LANG_UPLOAD_WARNING", "Upload Warning");
	//File successfully uploaded!
	define("LANG_UPLOAD_MSG_SUCCESSUPLOADED", "File successfully uploaded!");
	//Extension not allowed or wrong file type!
	define("LANG_UPLOAD_MSG_NOTALLOWED_WRONGFILETYPE", "Extension not allowed or wrong file type!");
	//File exceeds size limit!
	define("LANG_UPLOAD_MSG_EXCEEDSLIMIT", "File exceeds size limit!");
	//Fail trying to create directory!
	define("LANG_UPLOAD_MSG_FAILCREATEDIRECTORY", "Fail trying to create directory!");
	//Wrong directory permission!
	define("LANG_UPLOAD_MSG_WRONGDIRECTORYPERMISSION", "Wrong directory permission!");
	//Unexpected failure!
	define("LANG_UPLOAD_MSG_UNEXPECTEDFAILURE", "Unexpected failure!");
	//File not found or not entered!
	define("LANG_UPLOAD_MSG_NOTFOUND_NOTENTERED", "File not found or not entered!");
	//File already exists in directory!
	define("LANG_UPLOAD_MSG_FILEALREADEXISTSINDIRECTORY", "File already exists in directory!");
	//View all locations
	define("LANG_VIEWALLLOCATIONSCATEGORIES", "View all locations");
	//Featured Locations
	define("LANG_FEATUREDLOCATIONS", "Featured Locations");
	//There aren't any featured location in the system.
	define("LANG_LABEL_NOFEATUREDLOCATIONS", "There aren't any featured location in the system.");
	//Overview
	define("LANG_LABEL_OVERVIEW", "Overview");
	//Video
	define("LANG_LABEL_VIDEO", "Video");
	//Map Location
	define("LANG_LABEL_MAPLOCATION", "Map Location");
	//More Listings
	define("LANG_LABEL_MORELISTINGS", "More ".string_ucwords(LISTING_FEATURE_NAME_PLURAL));
	//More Events
	define("LANG_LABEL_MOREEVENTS", "More ".string_ucwords(EVENT_FEATURE_NAME_PLURAL));
	//More Classifieds
	define("LANG_LABEL_MORECLASSIFIEDS", "More ".string_ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//More Articles
	define("LANG_LABEL_MOREARTICLES", "More ".string_ucwords(ARTICLE_FEATURE_NAME_PLURAL));
    //More Promotions
    define("LANG_LABEL_MOREPROMOTIONS", "More ".string_ucwords(PROMOTION_FEATURE_NAME_PLURAL));
    //More Posts
    define("LANG_LABEL_MOREPOSTS", "More Posts");
	//"Operation not allowed: The deal" (deal_name) is already associated with the listing
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED1", "Operation not allowed: The ".PROMOTION_FEATURE_NAME."");
	//Operation not allowed: The deal (deal_name) "is already associated with the listing"
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED2", "is already associated with the ".LISTING_FEATURE_NAME."");
	//Pending
	define("LANG_LABEL_SIMPLEPAYPENDING", "Pending");
	//Aborted
	define("LANG_LABEL_SIMPLEPAYABORTED", "Aborted");
	//Failed
	define("LANG_LABEL_SIMPLEPAYFAILED", "Failed");
	//Declined
	define("LANG_LABEL_SIMPLEPAYDECLINED", "Declined");
	//Unknow
	define("LANG_LABEL_SIMPLEPAYUNKNOW", "Unknow");
	//Success
	define("LANG_LABEL_SIMPLEPAYSUCCESS", "Success");
	//Click on Add to Select Categories.
	define("LANG_MSG_CLICKADDTOSELECTCATEGORIES", "Click on \"Add\" to select categories");
	//Click on "Add main category" or "Add sub-category" to type your new categories
	define("LANG_MSG_CLICKADDTOADDCATEGORIES", "Click at \"Add main category\" or \"Add sub-category\" to type your new categories");
	//Add an
	define("LANG_ADD_AN", "Add an");
	//Add a
	define("LANG_ADD_A", "Add a");
	//on these sites
	define("LANG_ON_SITES", "on these sites:");
	//on this site
	define("LANG_ON_SITES_SINGULAR", "on this site:");

	# ----------------------------------------------------------------------------------------------------
	# FUNCTIONS
	# ----------------------------------------------------------------------------------------------------
	//slideshow
	define("LANG_SLIDESHOW", "slideshow");
	//on
	define("LANG_SLIDESHOW_ON", "on");
	//off
	define("LANG_SLIDESHOW_OFF", "off");
	//Photo Gallery
	define("LANG_GALLERYTITLE", "Photos");
	//"Click here" for Slideshow. You can also click on any of the photos to start slideshow.
	define("LANG_GALLERYCLICKHERE", "Click here");
	//Click here "for Slideshow. You can also click on any of the photos to start slideshow."
	define("LANG_GALLERYSLIDESHOWTEXT", "for Slideshow. You can also click on any of the photos to start slideshow.");
	//more photos
	define("LANG_GALLERYMOREPHOTOS", "View more photos");
	//Inexistent Discount Code
	define("LANG_MSG_INEXISTENT_DISCOUNT_CODE", "Inexistent ".string_ucwords(DISCOUNTCODE_LABEL));
	//is not available.
	define("LANG_MSG_IS_NOT_AVAILABLE", "is not available.");
	//is not available for this item type.
	define("LANG_MSG_IS_NOT_AVAILABLE_FOR", "is not available for this item type.");
	//cannot be used twice.
	define("LANG_MSG_CANNOT_BE_USED_TWICE", "cannot be used twice.");
	//Title is required.
	define("LANG_MSG_TITLE_IS_REQUIRED", "Title is required.");
	//Language is required.
	define("LANG_MSG_LANGUAGE_IS_REQUIRED", "Language is required.");
	//First Name is required.
	define("LANG_MSG_FIRST_NAME_IS_REQUIRED", "First Name is required.");
	//Last Name is required.
	define("LANG_MSG_LAST_NAME_IS_REQUIRED", "Last Name is required.");
	//Company is required.
	define("LANG_MSG_COMPANY_IS_REQUIRED", "Company is required.");
	//Phone is required.
	define("LANG_MSG_PHONE_IS_REQUIRED", "Phone is required.");
	//E-mail is required.
	define("LANG_MSG_EMAIL_IS_REQUIRED", "E-mail is required.");
	//Account is required.
	define("LANG_MSG_ACCOUNT_IS_REQUIRED", "Account is required.");
	//Page Name is required.
	define("LANG_MSG_PAGE_NAME_IS_REQUIRED", "Page Name is required.");
	//Category is required.
	define("LANG_MSG_CATEGORY_IS_REQUIRED", "Category is required.");
	//Abstract is required.
	define("LANG_MSG_ABSTRACT_IS_REQUIRED", "Abstract is required.");
	//Expiration type is required.
	define("LANG_MSG_EXPIRATION_TYPE_IS_REQUIRED", "Expiration type is required.");
	//Renewal Date is required.
	define("LANG_MSG_RENEWAL_DATE_IS_REQUIRED", "Renewal Date is required.");
	//Impressions are required.
	define("LANG_MSG_IMPRESSIONS_ARE_REQUIRED", "Impressions are required.");
	//File is required.
	define("LANG_MSG_FILE_IS_REQUIRED", "File is required.");
	//Type is required.
	define("LANG_MSG_TYPE_IS_REQUIRED", "Type is required.");
	//Caption is required.
	define("LANG_MSG_CAPTION_IS_REQUIRED", "Caption is required.");
	//Script Code is required.
	define("LANG_MSG_SCRIPT_CODE_IS_REQUIRED", "Script Code is required.");
	//Description 1 is required.
	define("LANG_MSG_DESCRIPTION1_IS_REQUIRED", "Description 1 is required.");
	//Description 2 is required.
	define("LANG_MSG_DESCRIPTION2_IS_REQUIRED", "Description 2 is required.");
	//Name is required.
	define("LANG_MSG_NAME_IS_REQUIRED", "Name is required.");
	//Deal Title is required.
	define("LANG_MSG_HEADLINE_IS_REQUIRED", string_ucwords(PROMOTION_FEATURE_NAME)." Title is required.");
	//"Offer" is required.
	define("LANG_MSG_OFFER_IS_REQUIRED", "Offer is required.");
	//"Start Date" is required.
	define("LANG_MSG_START_DATE_IS_REQUIRED", "Start Date is required.");
	//"End Date" is required.
	define("LANG_MSG_END_DATE_IS_REQUIRED", "End Date is required.");
	//Text is required.
	define("LANG_MSG_TEXT_IS_REQUIRED", "Text is required.");
	//Username is required.
	define("LANG_MSG_USERNAME_IS_REQUIRED", "E-mail is required.");
	//"Current Password" is incorrect.
	define("LANG_MSG_CURRENT_PASSWORD_IS_INCORRECT", "\"Current Password\" is incorrect.");
	//Password is required.
	define("LANG_MSG_PASSWORD_IS_REQUIRED", "Password is required.");
	//"Agree to terms of use" is required.
	define("LANG_MSG_IGREETERMS_IS_REQUIRED", "\"Agree to terms of use\" is required.");
	//The following fields were not filled or contain errors:
	define("LANG_MSG_FIELDS_CONTAIN_ERRORS", "The following fields were not filled or contain errors:");
	//Title - Please fill out the field
	define("LANG_MSG_TITLE_PLEASE_FILL_OUT", "Title - Please fill out the field");
	//Page Name - Please fill out the field
	define("LANG_MSG_PAGE_NAME_PLEASE_FILL_OUT", "Page Name - Please fill out the field");
	//"Maximum of" [MAX_CATEGORY_ALLOWED] categories are allowed
	define("LANG_MSG_MAX_OF_CATEGORIES_1", "Maximum of");
	//Maximum of [MAX_CATEGORY_ALLOWED] "categories are allowed"
	define("LANG_MSG_MAX_OF_CATEGORIES_2", "categories are allowed.");
	//Friendly URL Page Name already in use, please choose another Page Name.
	define("LANG_MSG_FRIENDLY_URL_IN_USE", "Friendly URL Page Name already in use, please choose another Page Name.");
	//Page Name contain invalid chars
	define("LANG_MSG_PAGE_NAME_INVALID_CHARS", "Page Name contain invalid chars");
	//"Maximum of" [MAX_KEYWORDS] keywords are allowed
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1", "Maximum of");
	//Maximum of [MAX_KEYWORDS] "keywords are allowed"
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2", "keywords are allowed");
	//Please include keywords with a maximum of 50 characters each
	define("LANG_MSG_PLEASE_INCLUDE_KEYWORDS", "Please include keywords with a maximum of 50 characters each");
	//Please enter a valid "Publication Date".
	define("LANG_MSG_ENTER_VALID_PUBLICATION_DATE", "Please enter a valid \"Publication Date\".");
	//Please enter a valid "Start Date".
	define("LANG_MSG_ENTER_VALID_START_DATE", "Please enter a valid \"Start Date\".");
	//Please enter a valid "End Date".
	define("LANG_MSG_ENTER_VALID_END_DATE", "Please enter a valid \"End Date\".");
	//The "End Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_END_DATE_GREATER_THAN_START_DATE", "The \"End Date\" must be greater than or equal to the \"Start Date\".");
	//The "End Time" must be greater than the "Start Time".
	define("LANG_MSG_END_TIME_GREATER_THAN_START_TIME", "The \"End Time\" must be greater than the \"Start Time\".");
	//The "End Date" cannot be in past.
	define("LANG_MSG_END_DATE_CANNOT_IN_PAST", "The \"End Date\" cannot be in past.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_ENTER_VALID_EMAIL_ADDRESS", "Please enter a valid e-mail address.");
	//Please enter a valid "URL".
	define("LANG_MSG_ENTER_VALID_URL", "Please enter a valid \"URL\".");
	//Please provide a description with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_DESCRIPTION_WITH_255_CHARS", "Please provide a description with a maximum of 255 characters.");
	//Please provide a conditions with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_255_CHARS", "Please provide a conditions with a maximum of 255 characters.");
	//Please enter a valid renewal date.
	define("LANG_MSG_ENTER_VALID_RENEWAL_DATE", "Please enter a valid renewal date.");
	//Renewal date must be in the future.
	define("LANG_MSG_RENEWAL_DATE_IN_FUTURE", "Renewal date must be in the future.");
	//Please enter a valid expiration date.
	define("LANG_MSG_ENTER_VALID_EXPIRATION_DATE", "Please enter a valid expiration date.");
	//Expiration date must be in the future.
	define("LANG_MSG_EXPIRATION_DATE_IN_FUTURE", "Expiration date must be in the future.");
	//Blank space is not allowed for password.
	define("LANG_MSG_BLANK_SPACE_NOT_ALLOWED_FOR_PASSWORD", "Blank space is not allowed for password.");
	//"Please enter a password with a maximum of" [PASSWORD_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MAX_CHARS", "Please enter a password with a maximum of");
	//"Please enter a password with a minimum of" [PASSWORD_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS", "Please enter a password with a minimum of");
	//Please enter a valid username.
	define("LANG_MSG_ENTER_VALID_USERNAME", "Please enter a valid e-mail.");
	//Sorry, you can't change this account information
	define("LANG_MSG_YOUCANTCHANGEACCOUNTINFORMATION", "Sorry, you can't change this account information");
	//Password "abc123" not allowed!
	define("LANG_MSG_ABC123_NOT_ALLOWED", "Password \"abc123\" not allowed!");
	//Passwords do not match. Please enter the same content for "password" and "retype password" fields.
	define("LANG_MSG_PASSWORDS_DO_NOT_MATCH", "Passwords do not match. Please enter the same content for \"password\" and \"retype password\" fields.");
	//Spaces are not allowed for username.
	define("LANG_MSG_SPACES_NOT_ALLOWED_FOR_USERNAME", "Spaces are not allowed for e-mail.");
	//Special characters are not allowed for username.
	define("LANG_MSG_SPECIAL_CHARS_NOT_ALLOWED_FOR_USERNAME", "Special characters are not allowed for e-mail.");
	//"Please type an username with a maximum of" [USERNAME_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MAX_CHARS", "Please type an e-mail with a maximum of");
	//"Please type an username with a minimum of" [USERNAME_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MIN_CHARS", "Please type an e-mail with a minimum of");
	//Please choose a different username.
	define("LANG_MSG_CHOOSE_DIFFERENT_USERNAME", "Please choose a different e-mail.");
	//Click here if you do not see your category
	define("LANG_MSG_CLICK_TO_ADD_CATEGORY", "Click here if you do not see your category");
	//Add main category
	define("LANG_MSG_CLICK_TO_ADD_MAINCATEGORY", "Add main category");
	//Add sub-category
	define("LANG_MSG_CLICK_TO_ADD_SUBCATEGORY", "Add sub-category");
	//Category title already registered!
	define("LANG_CATEGORY_ALREADY_REGISTERED", LANG_LABEL_CATEGORY." title already registered!");
	//Category title available!
	define("LANG_CATEGORY_NOT_REGISTERED", LANG_LABEL_CATEGORY." title available!");

	# ----------------------------------------------------------------------------------------------------
	# MENU
	# ----------------------------------------------------------------------------------------------------
	//Dashboard
	define("LANG_MEMBERS_DASHBOARD", "Dashboard");
	//Manage
	define("LANG_MENU_MANAGE", "Manage");
	//Add
	define("LANG_MENU_ADD", "Add");
	//Sponsor Options
	define("LANG_MENU_MEMBEROPTIONS", "Sponsor Options");
	//Add Listing
	define("LANG_MENU_ADDLISTING", "Add ".string_ucwords(LISTING_FEATURE_NAME));
	//Manage Listings
	define("LANG_MENU_MANAGELISTING", "Manage ".string_ucwords(LISTING_FEATURE_NAME_PLURAL));
	//Add Event
	define("LANG_MENU_ADDEVENT", "Add ".string_ucwords(EVENT_FEATURE_NAME));
	//Manage Events
	define("LANG_MENU_MANAGEEVENT", "Manage ".string_ucwords(EVENT_FEATURE_NAME_PLURAL));
	//Add Banner
	define("LANG_MENU_ADDBANNER", "Add ".string_ucwords(BANNER_FEATURE_NAME));
	//Manage Banners
	define("LANG_MENU_MANAGEBANNER", "Manage ".string_ucwords(BANNER_FEATURE_NAME_PLURAL));
	//Add Classified
	define("LANG_MENU_ADDCLASSIFIED", "Add ".string_ucwords(CLASSIFIED_FEATURE_NAME));
	//Manage Classifieds
	define("LANG_MENU_MANAGECLASSIFIED", "Manage ".string_ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//Add Article
	define("LANG_MENU_ADDARTICLE", "Add ".string_ucwords(ARTICLE_FEATURE_NAME));
	//Manage Articles
	define("LANG_MENU_MANAGEARTICLE", "Manage ".string_ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//Add Deal
	define("LANG_MENU_ADDPROMOTION", "Add ".string_ucwords(PROMOTION_FEATURE_NAME));
	//Manage Deals
	define("LANG_MENU_MANAGEPROMOTION", "Manage ".string_ucwords(PROMOTION_FEATURE_NAME_PLURAL));
	//Add Post
	define("LANG_MENU_ADDPOST", "Add Post");
	//Page not found
	define("LANG_PAGE_NOT_FOUND", "Page not found");
	//Maintenance Page
	define("LANG_MAINTENANCE_PAGE", "Maintenance Page");
	//Payment Options
	define("LANG_MENU_PAYMENTOPTIONS", "Payment Options");
	//Check Out
	define("LANG_MENU_CHECKOUT", "Check Out");
	//Make Your Payment
	define("LANG_MENU_MAKEPAYMENT", "Make Your Payment");
	//History
	define("LANG_MENU_HISTORY", "History");
	//Transaction History
	define("LANG_MENU_TRANSACTIONHISTORY", "Transaction History");
	//Invoice History
	define("LANG_MENU_INVOICEHISTORY", "Invoice History");
	//Default Themes
	define("LANG_MENU_CHOOSETHEME", "Default Themes");
	//Schemes
	define("LANG_MENU_CHOOSESCHEME", "Schemes");
	//Toll free
	define("LANG_LIVE_TOLLFREE", "Toll free");
	//Purchase Now
	define("LANG_LIVE_PURCHASE", "Purchase Now");

	# ----------------------------------------------------------------------------------------------------
	# SEARCH
	# ----------------------------------------------------------------------------------------------------
	//Search Article
	define("LANG_LABEL_SEARCHARTICLE", "Search ".string_ucwords(ARTICLE_FEATURE_NAME));
	//Search Classified
	define("LANG_LABEL_SEARCHCLASSIFIED", "Search ".string_ucwords(CLASSIFIED_FEATURE_NAME));
	//Search Event
	define("LANG_LABEL_SEARCHEVENT", "Search ".string_ucwords(EVENT_FEATURE_NAME));
	//Search Listing
	define("LANG_LABEL_SEARCHLISTING", "Search ".string_ucwords(LISTING_FEATURE_NAME));
	//Search Deal
	define("LANG_LABEL_SEARCHPROMOTION", "Search ".string_ucwords(PROMOTION_FEATURE_NAME));
    //Search the blog
    define("LANG_LABEL_SEARCHBLOG", "Search the ".string_ucwords(BLOG_FEATURE_NAME));
	//Advanced Search
	define("LANG_SEARCH_ADVANCEDSEARCH", "Advanced Search");
	//Search
	define("LANG_SEARCH_LABELKEYWORD", "Search");
	//Location
	define("LANG_SEARCH_LABELLOCATION", "Location");
	//Select a Country
	define("LANG_SEARCH_LABELCBCOUNTRY", "Select a Country");
	//Select a Region
	define("LANG_SEARCH_LABELCBREGION", "Select a Region");
	//Select a State
	define("LANG_SEARCH_LABELCBSTATE", "Select a State");
	//Select a City
	define("LANG_SEARCH_LABELCBCITY", "Select a City");
	//Select a Neighborhood
	define("LANG_SEARCH_LABELCBNEIGHBORHOOD", "Select a Neighborhood");
	//Category
	define("LANG_SEARCH_LABELCATEGORY", "Category");
	//Select a Category
	define("LANG_SEARCH_LABELCBCATEGORY", "Select a Category");
	//Match
	define("LANG_SEARCH_LABELMATCH", "Match");
	//Exact Match
	define("LANG_SEARCH_LABELMATCH_EXACTMATCH", "Exact Match");
	//Any Word
	define("LANG_SEARCH_LABELMATCH_ANYWORD", "Any Word");
	//All Words
	define("LANG_SEARCH_LABELMATCH_ALLWORDS", "All Words");
	//Listing Type
	define("LANG_SEARCH_LABELBROWSE", string_ucwords(LISTING_FEATURE_NAME)." Type");
	//from
	define("LANG_SEARCH_LABELFROM", "from");
	//to
	define("LANG_SEARCH_LABELTO", "to");
	//Miles "of"
	define("LANG_SEARCH_LABELZIPCODE_OF", "of");
	//Search by keyword
	define("LANG_LABEL_SEARCHFAQ", "Search by keyword");
	//Search
	define("LANG_LABEL_SEARCHFAQ_BUTTON", "Search");
	//Please provide words with at least [FT_MIN_WORD_LEN] characters for your search.
	define("LANG_MSG_SEARCH_MIN_WORD_LEN", "Please provide words with at least [FT_MIN_WORD_LEN] characters for your search.");

	# ----------------------------------------------------------------------------------------------------
	# FRONTEND
	# ----------------------------------------------------------------------------------------------------
	//Featured
	define("LANG_ITEM_FEATURED", "Featured");
	//Recent Articles
	define("LANG_RECENT_ARTICLE", "Recent ".string_ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//Upcoming Events
	define("LANG_UPCOMING_EVENT", "Upcoming ".string_ucwords(EVENT_FEATURE_NAME_PLURAL));
    //Featured Events
	define("LANG_FEATURED_EVENT", "Featured ".string_ucwords(EVENT_FEATURE_NAME_PLURAL));
	//Featured Event
	define("LANG_FEATURED_EVENT_SING", "Featured ".string_ucwords(EVENT_FEATURE_NAME));
	//Featured Classifieds
	define("LANG_FEATURED_CLASSIFIED", "Featured ".string_ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//Featured Classified
	define("LANG_FEATURED_CLASSIFIED_SING", "Featured ".string_ucwords(CLASSIFIED_FEATURE_NAME));
	//Featured Articles
	define("LANG_FEATURED_ARTICLE", "Featured ".string_ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//Featured Article
	define("LANG_FEATURED_ARTICLE_SING", "Featured ".string_ucwords(ARTICLE_FEATURE_NAME));
	//Featured Listings
	define("LANG_FEATURED_LISTING", "Featured ".string_ucwords(LISTING_FEATURE_NAME_PLURAL));
    //Featured Listing
	define("LANG_FEATURED_LISTING_SING", "Featured ".string_ucwords(LISTING_FEATURE_NAME));
	//Featured Deals
	define("LANG_FEATURED_PROMOTION", "Featured ".string_ucwords(PROMOTION_FEATURE_NAME_PLURAL));
    //Featured Deal
	define("LANG_FEATURED_PROMOTION_SING", "Featured ".string_ucwords(PROMOTION_FEATURE_NAME));
	//View all articles
	define("LANG_LABEL_VIEW_ALL_ARTICLES", "View all ".ARTICLE_FEATURE_NAME_PLURAL);
	//View all events
	define("LANG_LABEL_VIEW_ALL_EVENTS", "View all ".EVENT_FEATURE_NAME_PLURAL);
	//View all classifieds
	define("LANG_LABEL_VIEW_ALL_CLASSIFIEDS", "View all ".CLASSIFIED_FEATURE_NAME_PLURAL);
	//View all listings
	define("LANG_LABEL_VIEW_ALL_LISTINGS", "View all ".LISTING_FEATURE_NAME_PLURAL);
	//View all deals
	define("LANG_LABEL_VIEW_ALL_PROMOTIONS", "View all ".PROMOTION_FEATURE_NAME_PLURAL);
	//Listing with a deal
	define("LANG_LABEL_VIEW_LISTINGDEAL", "Listing with a ".PROMOTION_FEATURE_NAME);
	//Most Read
	define("LANG_LABEL_ARTICLE_POPULAR", "Most Read");
	//Recently Added
	define("LANG_LABEL_ARTICLE_RECENT", "Recently Added");
	//Last Tweets
	define("LANG_LAST_TWEETS", "Last Tweets");
	//Quick and Easy.
	define("LANG_EASYANDFAST", "Quick and Easy.");
	//Just follow the 3 steps
	define("LANG_THREESTEPS", "Just follow the 3 steps");
	//4 Steps
	define("LANG_FOURSTEPS", "4 Steps");
	//Account Signup
	define("LANG_ACCOUNTSIGNUP", "Account Signup");
	//Update your Listing
	define("LANG_LISTINGUPDATE", "Update your ".string_ucwords(LISTING_FEATURE_NAME));
	//Order
	define("LANG_ORDER", "Order");
	//Check Out
	define("LANG_CHECKOUT", "Check Out");
	//Configuration
	define("LANG_CONFIGURATION", "Configuration");
	//Select a level
	define("LANG_SELECTPACKAGE", "Select a level");
	//Profile Options
	define("LANG_PROFILE_OPTIONS", "Profile Options");
	//Directory account
	define("LANG_PROFILE_OPTIONS1", "Directory account");
	//My existing OpenID 2.0 Account
	define("LANG_PROFILE_OPTIONS2", "My existing OpenID 2.0 Account");
	//My existing Facebook Account
	define("LANG_PROFILE_OPTIONS3", "My existing Facebook Account");
	//My existing Google Account
	define("LANG_PROFILE_OPTIONS4", "My existing Google Account");
	//Are you already a member?
	define("LANG_ALREADYHAVEACCOUNT", "Are you already a member?");
	//No, I'm a New User.
	define("LANG_ACCOUNTNEWUSER", "No, I'm a New User.");
	//Yes, I have an Existing Account.
	define("LANG_ACCOUNTEXISTSUSER", "Yes, I have an Existing Account.");
	//Login with your Directory account
	define("LANG_ACCOUNTDIRECTORYUSER", "Login with your ".EDIRECTORY_TITLE." account");
	//Or login with your OpenID account
	define("LANG_ACCOUNTOPENIDUSER", "Or login with your OpenID account");
	//Sign in with my existing Facebook Account.
	define("LANG_ACCOUNTFACEBOOKUSER", "Sign in with my existing Facebook Account.");
	//Sign in with my existing Google Account.
	define("LANG_ACCOUNTGOOGLEUSER", "Sign in with my existing Google Account.");
    //Or login with your existing account
    define("LANG_ACCOUNTFBGOOGLEUSER", "Or login with your existing account");
	//Account Information
	define("LANG_ACCOUNTINFO", "Account Information");
	//Additional Information
	define("LANG_LABEL_ADDITIONALINFORMATION", "Additional Information");
	//Please write down your e-mail and password for future reference.
	define("LANG_ACCOUNTINFOMSG", "Please write down your e-mail and password for future reference.");
	//"Username must be a valid e-mail between" [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG1", "E-mail must be a valid e-mail between");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] "and" [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG2", "and");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] "characters with no spaces."
	define("LANG_USERNAME_MSG3", "characters with no spaces.");
	//"Password must be between" [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG1", "Password must be between");
	//Password must be between [PASSWORD_MIN_LEN] "and" [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG2", "and");
	//Password must be between [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] "characters with no spaces."
	define("LANG_PASSWORD_MSG3", "characters with no spaces.");
	//I agree with the terms of use
	define("LANG_IGREETERMS", "I agree with the terms of use");
	//Do you want to advertise with us?
	define("LANG_DOYOUWANT_ADVERTISEWITHUS", "Do you want to advertise with us?");
	//Buy a link
	define("LANG_BUY_LINK", "Buy a link");
	//Back to Top
	define("LANG_BACKTOTOP", "Back to Top");
	//Back to
	define("LANG_BACKTO", "Back to ");
	//Favorites
	define("LANG_QUICK_LIST", "Favorites");
	//view summary
	define("LANG_VIEWSUMMARY", "view summary");
	//view detail
	define("LANG_VIEWDETAIL", "view detail");
	//Advertisers
	define("LANG_ADVERTISER", "Advertisers");
	//Order Now!
	define("LANG_ORDERNOW", "Order Now!");
	//Wait, Loading...
	define("LANG_WAITLOADING", "Wait, Loading...");
	//Wait, loading filter options...
	define("LANG_WAITLOADING_FILTERS", "Wait, loading filter options...");
	//Subtotal Amount
	define("LANG_SUBTOTALAMOUNT", "Subtotal Amount");
	//Subtotal
	define("LANG_SUBTOTAL", "Subtotal");
	//Total Tax Amount
	define("LANG_TAXAMOUNT", "Tax Amount");
	//Total Price
	define("LANG_TOTALPRICEAMOUNT", "Total Price");
	//Favorites
	define("LANG_LABEL_QUICKLIST", "Favorites");
	//No favorites found!
	define("LANG_LABEL_NOQUICKLIST", "No favorites found!");
	//Search results for
	define("LANG_LABEL_SEARCHRESULTSFOR", "Search results for");
	//Related Search
	define("LANG_LABEL_RELATEDSEARCH", "Related Search");
	//Browse by Section
	define("LANG_LABEL_BROWSESECTION", "Browse by Section");
    //What are you looking for?
    define("LANG_LABEL_SEARCHINGFOR", "What are you looking for?");
    //Where?
    define("LANG_LABEL_SEARCHINGFOR_WHERE", "Where?");
	//Keyword
	define("LANG_LABEL_SEARCHKEYWORD", "Keyword");
	//Type a keyword
	define("LANG_LABEL_SEARCHKEYWORDTIP", "Type a keyword");
	//Type a keyword or listing name
	define("LANG_LABEL_SEARCHKEYWORDTIP_LISTING", "Type a keyword or ".LISTING_FEATURE_NAME." name");
	//Type a keyword or deal title
	define("LANG_LABEL_SEARCHKEYWORDTIP_PROMOTION", "Type a keyword or ".PROMOTION_FEATURE_NAME." title");
	//Type a keyword or event title
	define("LANG_LABEL_SEARCHKEYWORDTIP_EVENT", "Type a keyword or ".EVENT_FEATURE_NAME." title");
	//Type a keyword or classified title
	define("LANG_LABEL_SEARCHKEYWORDTIP_CLASSIFIED", "Type a keyword or ".CLASSIFIED_FEATURE_NAME." title");
	//Type a keyword or article title
	define("LANG_LABEL_SEARCHKEYWORDTIP_ARTICLE", "Type a keyword or ".ARTICLE_FEATURE_NAME." title");
	//Where
	define("LANG_LABEL_SEARCHWHERE", "Where");
	//Address, City, State or Zip Code
	define("LANG_LABEL_SEARCHWHERETIP", "Address, City, State or Zip Code");
	//Wait, searching your location...
	define("LANG_LABEL_WAIT_LOCATION", "Wait, searching your location...");
	//Complete the form below to contact us.
	define("LANG_LABEL_FORMCONTACTUS", "Complete the form below to contact us.");
	//Message
	define("LANG_LABEL_MESSAGE", "Message");
	//No disabled categories found in the system.
	define("LANG_DISABLED_CATEGORY_NOTFOUND", "No disabled categories found in the system.");
	//No categories found.
	define("LANG_CATEGORY_NOTFOUND", "No categories found.");
	//Please, select a valid category
	define("LANG_CATEGORY_INVALIDERROR", "Please, select a valid category");
	//Please select a category first!
	define("LANG_CATEGORY_SELECTFIRSTERROR", "Please select a category first!");
	//View Category Path
	define("LANG_CATEGORY_VIEWPATH", "View Category Path");
	//Remove Selected Category
	define("LANG_CATEGORY_REMOVESELECTED", "Remove Selected Category");
	//"Extra categories cost an" additional [LEVEL_CATEGORY_PRICE] each.
	define("LANG_CATEGORIES_PRICEDESC1", "Extra categories cost an");
	//Extra categories cost an "additional" [LEVEL_CATEGORY_PRICE] each.
	define("LANG_CATEGORIES_PRICEDESC2", "additional");
	//Extra categories cost an additional [LEVEL_CATEGORY_PRICE] "each."
	define("LANG_CATEGORIES_PRICEDESC3", "each.");
	//Maximum of
	define("LANG_CATEGORIES_CATEGORIESMAXTIP1", "Maximum of");
	//allowed.
	define("LANG_CATEGORIES_CATEGORIESMAXTIP2", "categories allowed.");
	//Categories and sub-categories
	define("LANG_CATEGORIES_TITLE", "Categories and sub-categories");
	//Only select sub-categories that directly apply to your type.
	define("LANG_CATEGORIES_MSG1", "Only select sub-categories that directly apply to your type.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_CATEGORIES_MSG2", "Your ".LISTING_FEATURE_NAME." will automatically appear in the main category of each sub-category you select.");
	//Account Information Error
	define("LANG_ACCOUNTINFO_ERROR", "Account Information Error");
	//Contact Information
	define("LANG_CONTACTINFO", "Contact Information");
	//This information will not be displayed publicly.
	define("LANG_CONTACTINFO_MSG", "This information will not be displayed publicly.");
	//Billing Information
	define("LANG_BILLINGINFO", "Billing Information");
	//This information will not be displayed publicly.
	define("LANG_BILLINGINFO_MSG1", "This information will not be displayed publicly.");
	//You will configure your article after placing the order.
	define("LANG_BILLINGINFO_MSG2_ARTICLE", "You will configure your ".ARTICLE_FEATURE_NAME." after placing the order.");
	//You will configure your banner after placing the order.
	define("LANG_BILLINGINFO_MSG2_BANNER", "You will configure your ".BANNER_FEATURE_NAME." after placing the order.");
	//You will configure your classified after placing the order.
	define("LANG_BILLINGINFO_MSG2_CLASSIFIED", "You will configure your ".CLASSIFIED_FEATURE_NAME." after placing the order.");
	//You will configure your event after placing the order.
	define("LANG_BILLINGINFO_MSG2_EVENT", "You will configure your ".EVENT_FEATURE_NAME." after placing the order.");
	//You will configure your listing after placing the order.
	define("LANG_BILLINGINFO_MSG2_LISTING", "You will configure your ".LISTING_FEATURE_NAME." after placing the order.");
	//Billing Information Error
	define("LANG_BILLINGINFO_ERROR", "Billing Information Error");
    //Or back to previous page
    define("LANG_ADVERTISE_BACK", "Or back to previous page");
	//Checking out
	define("LANG_ADVERTISE_CHECKOUT", "Checking out");
    //Listing [level]
    define("LANG_ADVERTISE_LISTINGLEVEL", LISTING_FEATURE_NAME." [level]");
    //Event [level]
    define("LANG_ADVERTISE_EVENTLEVEL", EVENT_FEATURE_NAME." [level]");
    //Classified [level]
    define("LANG_ADVERTISE_CLASSIFIEDLEVEL", CLASSIFIED_FEATURE_NAME." [level]");
    //Article [level]
    define("LANG_ADVERTISE_ARTICLELEVEL", ARTICLE_FEATURE_NAME." [level]");
    //Banner [level]
    define("LANG_ADVERTISE_BANNERLEVEL", BANNER_FEATURE_NAME." [level]");
    //Identification
    define("LANG_ADVERTISE_IDENTIFICATION", "Identification");
    //Confirmation
    define("LANG_ADVERTISE_CONFIRMATION", "Confirmation");
    //Please, login with your account or sign up today.
    define("LANG_ADVERTISE_SIGNUP", "Please, login with your account or sign up today.");
    //I'm already a user
    define("LANG_ADVERTISE_SIGNUP_ALREADYUSER", "I'm already a user");
    //I'm a new user
    define("LANG_ADVERTISE_SIGNUP_NEWUSER", "I'm a new user");
    //Create a new account now.
    define("LANG_ADVERTISE_CREATE_ACC", "Create a new account now.");
    //Billing Detail
    define("LANG_ADVERTISE_BILLINGDETAIL", "Billing Detail");
    //A quick overview of how much you will be charged.
    define("LANG_ADVERTISE_BILLINGDETAIL_TIP", "A quick overview of how much you will be charged.");
    //Payment
    define("LANG_ADVERTISE_PAYMENT", "Payment");
    //Make your payment and finish your order.
    define("LANG_ADVERTISE_PAYMENT_TIP", "Make your payment and finish your order.");
    //Print your invoice and finish your order.
    define("LANG_ADVERTISE_PAYMENT_TIP2", "Print your invoice and finish your order.");
    //Thank you for your order!
    define("LANG_ADVERTISE_THANKYOU", "Thank you for your order!");
    //Order Description
    define("LANG_ADVERTISE_ORDERDESC", "Order Description");
    //A brief summary of your order.
    define("LANG_ADVERTISE_ORDERDESC_TIP", "A brief summary of your order.");
    //Thanks!
    define("LANG_ADVERTISE_THANKS", "Thanks!");
    //Already registered users should use
    define("LANG_ADVERTISE_ALREADYUSER1", "Already registered users should use");
    //members check out area
    define("LANG_ADVERTISE_ALREADYUSER2", "members check out area");
    //You are already logged as
    define("LANG_ADVERTISE_LOGGED_AS", "You are already logged as");
	//Most Popular
	define("LANG_ADVERTISE_POPULAR", "Most Popular");
	//days free trial!
	define("LANG_ADVERTISE_TRIAL", "days free trial!");
	//after
	define("LANG_AFTER", "after");
	//View Sample
	define("LANG_ADVERTISE_SAMPLE", "View Sample");
	//Have any questions?
	define("LANG_ADVERTISE_QUESTIONS", "Have any questions?");
	//Contact us today
	define("LANG_ADVERTISE_CONTACT", "Contact us today");
	//No Tax
	define("LANG_ADVERTISE_NOTAX", "No Tax");
	//Article Information
	define("LANG_ARTICLEINFO", string_ucwords(ARTICLE_FEATURE_NAME)." Information");
	//Article Information Error
	define("LANG_ARTICLEINFO_ERROR", string_ucwords(ARTICLE_FEATURE_NAME)." Information Error");
	//Banner Information
	define("LANG_BANNERINFO", string_ucwords(BANNER_FEATURE_NAME)." Information");
	//Banner Information Error
	define("LANG_BANNERINFO_ERROR", string_ucwords(BANNER_FEATURE_NAME)." Information Error");
	//Classified Information
	define("LANG_CLASSIFIEDINFO", string_ucwords(CLASSIFIED_FEATURE_NAME)." Information");
	//Classified Information Error
	define("LANG_CLASSIFIEDINFO_ERROR", string_ucwords(CLASSIFIED_FEATURE_NAME)." Information Error");
	//Browse Events by Date
	define("LANG_BROWSEEVENTSBYDATE", "Browse ".string_ucwords(EVENT_FEATURE_NAME_PLURAL)." by Date");
	//Event Information
	define("LANG_EVENTINFO", string_ucwords(EVENT_FEATURE_NAME)." Information");
	//Event Information Error
	define("LANG_EVENTINFO_ERROR", string_ucwords(EVENT_FEATURE_NAME)." Information Error");
	//Listing Information
	define("LANG_LISTINGINFO", string_ucwords(LISTING_FEATURE_NAME)." Information");
    //What do you want to call your listing? This is normally your company name.
	define("LANG_LISTINGINFO_TIP", "What do you want to call your ".LISTING_FEATURE_NAME."? This is normally your company name.");
    //Choose a template applicable to your business type if you feel the need too.
	define("LANG_LISTINGINFO_TIP2", "Choose a template applicable to your business type if you feel the need too.");
    //What do you want to call your event?
	define("LANG_EVENTINFO_TIP", "What do you want to call your ".EVENT_FEATURE_NAME."?");
    //What do you want to call your classified?
	define("LANG_CLASSIFIEDINFO_TIP", "What do you want to call your ".CLASSIFIED_FEATURE_NAME."?");
    //What do you want to call your article?
	define("LANG_ARTICLEINFO_TIP", "What do you want to call your ".ARTICLE_FEATURE_NAME."?");
    //What do you want to call your banner?
	define("LANG_BANNERINFO_TIP", "What do you want to call your ".BANNER_FEATURE_NAME."?");
	//Listing Information Error
	define("LANG_LISTINGINFO_ERROR", string_ucwords(LISTING_FEATURE_NAME)." Information Error");
	//Claim this Listing
	define("LANG_LISTING_CLAIMTHIS", "Claim this ".string_ucwords(LISTING_FEATURE_NAME));
	//Claiming
	define("LANG_LISTING_CLAIMING", "Claiming");
	//To claim this listing, just log in with your existing account details or create a new account.
	define("LANG_CLAIM_SIGNUP", "To claim this ".LISTING_FEATURE_NAME.", just log in with your existing account details or create a new account.");
	//Listing Type
	define("LANG_LISTING_LABELTEMPLATE", string_ucwords(LISTING_FEATURE_NAME)." Type");
	//No results were found for the search criteria you requested.
	define("LANG_MSG_NORESULTS", "No results were found for the search criteria you requested.");
	//Please try your search again or browse by section.
	define("LANG_MSG_TRYAGAIN_BROWSESECTION", "Please try your search again or browse by section.");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword and perform your search again.
	define("LANG_MSG_USE_SPECIFIC_KEYWORD", "Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword and perform your search again.");
	//Please type at least one keyword on the search box.
	define("LANG_MSG_LEASTONEKEYWORD", "Please type at least one keyword on the search box.");
	//"No results content"
	define("LANG_SEARCH_NORESULTS", "<h1>No Results Returned for your search</h1><p>Your search returned no results. Although this is unusual, it happens from time to time. Perhaps the search term you used is a little generic, or perhaps we just don't have any content for that search.</p><h2>Suggestions:</h2>&raquo;Be more specific with your search terms<br />&raquo;Check your spelling<br />&raquo;If you can't find via search, try browsing by section<br /><br /><p>If you believe you have come here in error, please contact the site manager and report a problem.</p>");
	//Image
	define("LANG_SLIDESHOW_IMAGE", "Image");
	//of
	define("LANG_SLIDESHOW_IMAGEOF", "of");
	//Error loading image
	define("LANG_SLIDESHOW_IMAGELOADINGERROR", "Error loading image");
	//Next
	define("LANG_SLIDESHOW_NEXT", "Next");
	//Pause
	define("LANG_SLIDESHOW_PAUSE", "Pause");
	//Play
	define("LANG_SLIDESHOW_PLAY", "Play");
	//Back
	define("LANG_SLIDESHOW_BACK", "Back");
	//Your e-mail has been sent. Thank you.
	define("LANG_CONTACTMSGSUCCESS", "Your e-mail has been sent. Thank you.");
	//There was a problem sending this e-mail. Please try again later.
	define("LANG_CONTACTMSGFAILED", "There was a problem sending this e-mail. Please try again later.");
	//Please enter your name.
	define("LANG_MSG_CONTACT_ENTER_NAME", "Please enter your name.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_CONTACT_ENTER_VALID_EMAIL", "Please enter a valid e-mail address.");
	//Please type the message.
	define("LANG_MSG_CONTACT_TYPE_MESSAGE", "Please type the message.");
	//Please type the code correctly or mark the checkbox if available.
	define("LANG_MSG_CONTACT_TYPE_CODE", "Please type the code correctly or mark the checkbox if available.");
	//Please correct it and try again.
	define("LANG_MSG_CONTACT_CORRECTIT_TRYAGAIN", "Please correct it and try again.");
	//Please type a name.
	define("LANG_MSG_CONTACT_TYPE_NAME", "Please type a name.");
	//Please type a subject.
	define("LANG_MSG_CONTACT_TYPE_SUBJECT", "Please type a subject.");
	//SOME DETAILS
	define("LANG_ARTICLE_TOFRIEND_MAIL", "SOME DETAILS");
	//SOME DETAILS
	define("LANG_CLASSIFIED_TOFRIEND_MAIL", "SOME DETAILS");
	//SOME DETAILS
	define("LANG_EVENT_TOFRIEND_MAIL", "SOME DETAILS");
	//SOME DETAILS
	define("LANG_LISTING_TOFRIEND_MAIL", "SOME DETAILS");
	//SOME DETAILS
	define("LANG_PROMOTION_TOFRIEND_MAIL", "SOME DETAILS");
	//Please enter a valid e-mail address in the "To" field
	define("LANG_MSG_TOFRIEND1", "Please enter a valid e-mail address in the \"To\" field");
	//Please enter a valid e-mail address in the "From" field
	define("LANG_MSG_TOFRIEND2", "Please enter a valid e-mail address in the \"From\" field");
	//"Item not found. Please return to" [YOURSITE] and try again.
	define("LANG_MSG_TOFRIEND3", "Item not found. Please return to");
	//We could not find the item you're trying to send to a friend. Please return to [YOURSITE] "and try again."
	define("LANG_MSG_TOFRIEND4", "and try again.");
	//Please enter a valid e-mail address in the "Your E-mail" field
	define("LANG_MSG_TOFRIEND5", "Please enter a valid e-mail address in the \"Your E-mail\" field");
	//"About" [ARTICLE_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_1", "About");
	//About [ARTICLE_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_2", "from the");
	//"About" [CLASSIFIED_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_1", "About");
	//About [CLASSIFIED_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_2", "from the");
	//"About" [EVENT_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_1", "About");
	//About [EVENT_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_2", "from the");
	//"About" [LISTING_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_1", "About");
	//About [LISTING_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_2", "from the");
	//"About" [PROMOTION_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_1", "About");
	//About [PROMOTION_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_2", "from the");
	//Send info about this article to a friend
	define("LANG_ARTICLE_TOFRIEND_SAUDATION", "Send info about this ".ARTICLE_FEATURE_NAME." to a friend");
	//Send info about this classified to a friend
	define("LANG_CLASSIFIED_TOFRIEND_SAUDATION", "Send info about this ".CLASSIFIED_FEATURE_NAME." to a friend");
	//Send info about this event to a friend
	define("LANG_EVENT_TOFRIEND_SAUDATION", "Send info about this ".EVENT_FEATURE_NAME." to a friend");
	//Send info about this listing to a friend
	define("LANG_LISTING_TOFRIEND_SAUDATION", "Send info about this ".LISTING_FEATURE_NAME." to a friend");
	//Send info about this deal to a friend
	define("LANG_PROMOTION_TOFRIEND_SAUDATION", "Send info about this ".PROMOTION_FEATURE_NAME." to a friend");
	//Message sent by
	define("LANG_MESSAGE_SENT_BY", "Message sent by ");
	//This is a automatic message.
	define("LANG_THIS_IS_A_AUTOMATIC_MESSAGE", "This is a automatic message.");
	//Contact
	define("LANG_CONTACT", "Contact");
	//article
	define("LANG_ARTICLE", ARTICLE_FEATURE_NAME);
	//classified
	define("LANG_CLASSIFIED", CLASSIFIED_FEATURE_NAME);
	//event
	define("LANG_EVENT", EVENT_FEATURE_NAME);
	//listing
	define("LANG_LISTING", LISTING_FEATURE_NAME);
	//deal
	define("LANG_PROMOTION", PROMOTION_FEATURE_NAME);
	//Please search at least one parameter on the search box!
	define("LANG_MSG_LEASTONEPARAMETER", "Please search at least one parameter on the search box!");
	//Please try your search again.
	define("LANG_MSG_TRYAGAIN", "Please try your search again.");
	//No articles registered yet.
	define("LANG_MSG_NOARTICLES", "No ".ARTICLE_FEATURE_NAME_PLURAL." registered yet.");
	//No classifieds registered yet.
	define("LANG_MSG_NOCLASSIFIEDS", "No ".CLASSIFIED_FEATURE_NAME_PLURAL." registered yet.");
	//No events registered yet.
	define("LANG_MSG_NOEVENTS", "No ".EVENT_FEATURE_NAME_PLURAL." registered yet.");
	//No listings registered yet.
	define("LANG_MSG_NOLISTINGS", "No ".LISTING_FEATURE_NAME_PLURAL." registered yet.");
	//No deals registered yet.
	define("LANG_MSG_NOPROMOTIONS", "No ".PROMOTION_FEATURE_NAME_PLURAL." registered yet.");
	//Message sent through
	define("LANG_CONTACTPRESUBJECT", "Message sent through");
	//E-mail Form
	define("LANG_EMAILFORM", "E-mail Form");
	//Click here to print
	define("LANG_PRINTCLICK", "Click here to print");
	//View all classified categories
	define("LANG_CLASSIFIED_VIEWALLCATEGORIES", "View all ".CLASSIFIED_FEATURE_NAME." categories");
	//Location
	define("LANG_CLASSIFIED_LOCATIONS", "Location");
	//More Classifieds
	define("LANG_CLASSIFIED_MORE", "More ".string_ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//View all event categories
	define("LANG_EVENT_VIEWALLCATEGORIES", "View all ".EVENT_FEATURE_NAME." categories");
	//Location
	define("LANG_EVENT_LOCATIONS", "Location");
	//Featured Events
	define("LANG_EVENT_FEATURED", "Featured ".string_ucwords(EVENT_FEATURE_NAME_PLURAL));
	//events
	define("LANG_EVENT_PLURAL", EVENT_FEATURE_NAME_PLURAL);
	//Search results
	define("LANG_SEARCHRESULTS", "Search results");
	//Results
	define("LANG_RESULTS", "Results");
	//Result
	define("LANG_RESULT", "Result");
    //Letter
    define("LANG_LETTER", "Letter");
	//Search results "for" keyword
	define("LANG_SEARCHRESULTS_KEYWORD", "for");
	//Search results "in" where
	define("LANG_SEARCHRESULTS_WHERE", "in");
	//Search results "in" template
	define("LANG_SEARCHRESULTS_TEMPLATE", "in");
	//Search results "in" category
	define("LANG_SEARCHRESULTS_CATEGORY", "in");
	//Search results "in category"
	define("LANG_SEARCHRESULTS_INCATEGORY", "in category");
	//Search results "in" location
	define("LANG_SEARCHRESULTS_LOCATION", "in");
	//Search results "in" zip
	define("LANG_SEARCHRESULTS_ZIP", "in");
	//Search results "for" date
	define("LANG_SEARCHRESULTS_DATE", "for");
	//Search results - "Page" X
	define("LANG_SEARCHRESULTS_PAGE", "Page");
	//Recent Reviews
	define("LANG_RECENT_REVIEWS", "Recent Reviews");
	//Reviews of
	define("LANG_REVIEWSOF", "Reviews of");
	//Reviews are disabled
	define("LANG_REVIEWDISABLE", "Reviews are disabled");
	//View all article categories
	define("LANG_ARTICLE_VIEWALLCATEGORIES", "View all ".ARTICLE_FEATURE_NAME." categories");
	//View all deal categories
	define("LANG_PROMOTION_VIEWALLCATEGORIES", "View all ".PROMOTION_FEATURE_NAME." categories");
    //View all blog categories
    define("LANG_BLOG_VIEWALLCATEGORIES", "View all ".BLOG_FEATURE_NAME." categories");
	//Offer
	define("LANG_PROMOTION_OFFER", "Offer");
	//Description
	define("LANG_PROMOTION_DESCRIPTION", "Description");
	//Conditions
	define("LANG_PROMOTION_CONDITIONS", "Conditions");
	//Location
	define("LANG_PROMOTION_LOCATIONS", "Location");
	//Item not found!
	define("LANG_MSG_NOTFOUND", "Item not found!");
	//Item not available!
	define("LANG_MSG_NOTAVAILABLE", "Item not available!");
	//Listing Search Results
	define("LANG_MSG_LISTINGRESULTS", string_ucwords(LISTING_FEATURE_NAME)." Search Results");
	//Deal Search Results
	define("LANG_MSG_PROMOTIONRESULTS", string_ucwords(PROMOTION_FEATURE_NAME)." Search Results");
	//Event Search Results
	define("LANG_MSG_EVENTRESULTS", string_ucwords(EVENT_FEATURE_NAME)." Search Results");
	//Classified Search Results
	define("LANG_MSG_CLASSIFIEDRESULTS", string_ucwords(CLASSIFIED_FEATURE_NAME)." Search Results");
	//Article Search Results
	define("LANG_MSG_ARTICLERESULTS", string_ucwords(ARTICLE_FEATURE_NAME)." Search Results");
	//Available Languages
	define("LANG_MSG_AVAILABLELANGUAGES", "Available Languages");
	//You can choose up to [MAX_ENABLED_LANGUAGES] of the languages below for your directory.
	define("LANG_MSG_AVAILABLELANGUAGESMSG", "You can choose up to ".MAX_ENABLED_LANGUAGES." of the languages below for your directory.");
	//Redeem without Facebook
    define("LANG_DEAL_DONTUSEFACEBOOK", "Redeem without Facebook");
	//posted on facebook and twitter
	define("LANG_DEAL_POSTFACEBOOK_TWITTER", "posted on Facebook and Twitter");
	//posted on facebook
	define("LANG_DEAL_POSTFACEBOOK", "posted on Facebook");
	//posted on twitter
	define("LANG_DEAL_TWITTER", "posted on Twitter");
	//Posted on
	define("LANG_LABEL_POSTED_ON", "Posted on");
	//deal checked out
	define("LANG_DEAL_CHECKOUT", PROMOTION_FEATURE_NAME." checked out");
	//deal opened
	define("LANG_DEAL_OPENED", PROMOTION_FEATURE_NAME." opened");
	//Terms & Conditions
	define("LANG_LABEL_DEAL_CONDITIONS", "Terms & Conditions");
	//maximum 1000 characters
	define("LANG_MSG_MAX_1000_CHARS", "maximum 1000 characters");
	//Please provide a conditions with a maximum of 1000 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_1000_CHARS", "Please provide a conditions with a maximum of 1000 characters.");
	//See All
	define("LANG_LABEL_SEE_ALL", "See All");
	//Stars
	define("LANG_LABEL_STARS", "Stars");
	//Star
	define("LANG_LABEL_STAR", "Star");
    //Terms of Use
    define("LANG_TERMS_USE", "Terms of Use");
	//Privacy Policy
	define("LANG_PRIVACY_POLICY", "Privacy Policy");
    //Size
    define("LANG_ADVERTISE_SIZE", "Size");
	//Title / Address
	define("LANG_ADVERTISE_LIST_TITLE_ADDRESS", "Title / Address");
	//Title
	define("LANG_ADVERTISE_LIST_TITLE", "Title");
	//Ratings and Reviews
	define("LANG_ADVERTISE_LIST_REVIEW", "Ratings and Reviews");
	//Detail View
	define("LANG_ADVERTISE_LIST_DETAIL_VIEW", "Detail View");
	//Deal
	define("LANG_ADVERTISE_LIST_DEAL", string_ucwords(PROMOTION_FEATURE_NAME));
	//Send to Phone
	define("LANG_ADVERTISE_LIST_SEND_TO_PHONE", "Send to Phone");
	//Click to Call
	define("LANG_ADVERTISE_LIST_CLICK_TO_CALL", "Click to Call");
	//Phone
	define("LANG_ADVERTISE_LIST_PHONE", "Phone");
	//E-mail
	define("LANG_ADVERTISE_LIST_EMAIL", "E-mail");
	//Url
	define("LANG_ADVERTISE_LIST_URL", "Url");
	//Fax Number
	define("LANG_ADVERTISE_LIST_FAX", "Fax Number");
	//Summary Description
	define("LANG_ADVERTISE_LIST_SUMMARY_DESCRIPTION", "Summary Description");
	//Badges
	define("LANG_ADVERTISE_LIST_BADGES", "Badges");
	//Detail Description
	define("LANG_ADVERTISE_LIST_LONG_DESCRIPTION", "Detail Description");
	//Photo Gallery
	define("LANG_ADVERTISE_LIST_MAIN_IMAGE", "Photo Gallery");
	//Video
	define("LANG_ADVERTISE_LIST_VIDEO", "Video");
	//Additional Uploads
	define("LANG_ADVERTISE_LIST_ATTACHMENT_FILE", "Additional Uploads");
	//Hours
	define("LANG_ADVERTISE_LIST_HOURS_OF_WORK", "Hours");
	//Location reference
	define("LANG_ADVERTISE_LIST_LOCATIONS", "Location reference");
	//Features
	define("LANG_ADVERTISE_LIST_FEATURES", "Features");
	//Facebook Social Plugin
	define("LANG_ADVERTISE_LIST_FBPAGE", "Facebook Social Plugin");
	//Contact Name
	define("LANG_ADVERTISE_LIST_CONTACT_NAME", "Contact Name");
	//Contact Phone
	define("LANG_ADVERTISE_LIST_CONTACT_PHONE", "Contact Phone");
	//Contact E-mail
	define("LANG_ADVERTISE_LIST_CONTACT_EMAIL", "Contact E-mail");
	//Event Time
	define("LANG_ADVERTISE_LIST_START_TIME", string_ucwords(EVENT_FEATURE_NAME)." Time");
	//Price
	define("LANG_ADVERTISE_LIST_PRICE", "Price");
	//Publication Date
	define("LANG_ADVERTISE_LIST_PUBLICATION", "Publication Date");
	//Author
	define("LANG_ADVERTISE_LIST_AUTHOR", "Author");
	//Abstract
	define("LANG_ADVERTISE_LIST_ABSTRACT", "Abstract");
	//Content
	define("LANG_ADVERTISE_LIST_CONTENT", "Content");
    //Social Networking Pages
    define("LANG_ADVERTISE_LIST_SOCIAL_NETWORK", "Social Networking Pages");

	# ----------------------------------------------------------------------------------------------------
	# MANAGE MODULES ORDINATION
	# ----------------------------------------------------------------------------------------------------
	//Click here to order by descending title
	define("LANG_CLICK_ORDERTITLEDESC", "Click here to order by descending title");
	//Click here to order by ascending title
	define("LANG_CLICK_ORDERTITLEASC", "Click here to order by ascending title");
	//Click here to order by descending level
	define("LANG_CLICK_ORDERLEVELDESC", "Click here to order by descending level");
	//Click here to order by ascending level
	define("LANG_CLICK_ORDERLEVELASC", "Click here to order by ascending level");
	//Click here to order by descending account
	define("LANG_CLICK_ORDERACCOUNTDESC", "Click here to order by descending account");
	//Click here to order by ascending account
	define("LANG_CLICK_ORDERACCOUNTASC", "Click here to order by ascending account");
	//Click here to order by descending status
	define("LANG_CLICK_ORDERSTATUSDESC", "Click here to order by descending status");
	//Click here to order by ascending status
	define("LANG_CLICK_ORDERSTATUSASC", "Click here to order by ascending status");
	//Click here to order by descending caption
	define("LANG_CLICK_ORDERCAPTIONDESC", "Click here to order by descending caption");
	//Click here to order by ascending caption
	define("LANG_CLICK_ORDERCAPTIONASC", "Click here to order by ascending caption");
	//Click here to order by descending type
	define("LANG_CLICK_ORDERTYPEDESC", "Click here to order by descending type");
	//Click here to order by ascending type
	define("LANG_CLICK_ORDERTYPEASC", "Click here to order by ascending type");
	//Click here to order by descending renewal date
	define("LANG_CLICK_ORDERRENEWALDESC", "Click here to order by descending renewal date");
	//Click here to order by ascending renewal date
	define("LANG_CLICK_ORDERRENEWALASC", "Click here to order by ascending renewal date");
	//Click here to order by descending impressions
	define("LANG_CLICK_ORDERIMPRESSIONSDESC", "Click here to order by descending impressions");
	//Click here to order by ascending impressions
	define("LANG_CLICK_ORDERIMPRESSIONSASC", "Click here to order by ascending impressions");
	//Click here to order by descending start date
	define("LANG_CLICK_ORDERSTARTDATEDESC", "Click here to order by descending start date");
	//Click here to order by ascending start date
	define("LANG_CLICK_ORDERSTARTDATEASC", "Click here to order by ascending start date");

	# ----------------------------------------------------------------------------------------------------
	# MEMBERS
	# ----------------------------------------------------------------------------------------------------
	//Your item has been paid, so you can add a maximum of 3 categories free.
	define("LANG_ITEM_ALREADY_HAS_PAID", "Your item has been paid, so you can add a maximum of [max] categories free.");
	//Your item has been paid, so you can add a maximum of 1 category free.
	define("LANG_ITEM_ALREADY_HAS_PAID2", "Your item has been paid, so you can add a maximum of [max] category free.");
	//Video Snippet Code TIP
	define("LANG_VIDEO_SNIPPETTIP", "Do you have a question about Video Snippet Code? Click here.");
	//Enjoy our Services!
	define("LANG_ENJOY_OUR_SERVICES", "Enjoy our Services!");
	//Remove association with
	define("LANG_REMOVE_ASSOCIATION_WITH", "Remove association with");
	//Welcome
	define("LANG_LABEL_WELCOME", "Welcome");
	//Sponsor Options
	define("LANG_LABEL_MEMBER_OPTIONS", "Sponsor Options");
	//Back to Website
	define("LANG_LABEL_BACK_TO_SEARCH", "Back to Website");
	//Add New Account
	define("LANG_LABEL_ADD_NEW_ACCOUNT", "Add New Account");
	//Forgotten password
	define("LANG_LABEL_FORGOTTEN_PASSWORD", "Forgotten password");
	//Click here
	define("LANG_LABEL_CLICK_HERE", "Click here");
	//Help
	define("LANG_LABEL_HELP", "Help");
	//Reset Password
	define("LANG_LABEL_RESET_PASSWORD", "Reset Password");
	//Account and Contact Information
	define("LANG_LABEL_ACCOUNT_AND_CONTACT_INFO", "Account and Contact Information");
	//Signup Notification
	define("LANG_LABEL_SIGNUP_NOTIFICATION", "Signup Notification");
	//Go to Sign in
	define("LANG_LABEL_GO_TO_LOGIN", "Go to Sign in");
	//Order
	define("LANG_LABEL_ORDER", "Order");
	//Check Out
	define("LANG_LABEL_CHECKOUT", "Check Out");
	//Configuration
	define("LANG_LABEL_CONFIGURATION", "Configuration");
	//Category Detail
	define("LANG_LABEL_CATEGORY_DETAIL", "Category Detail");
	//Site Manager
	define("LANG_LABEL_SITE_MANAGER", "Site Manager");
	//Summary page
	define("LANG_LABEL_SUMMARY_PAGE", "Summary Page");
	//Detail page
	define("LANG_LABEL_DETAIL_PAGE", "Detail Page");
	//Photo Gallery
	define("LANG_LABEL_PHOTO_GALLERY", "Photo Gallery");
	//To select a main image, simply click on it.
	define("LANG_LABEL_PHOTO_GALLERY_MAIN", "To select a main image, simply click on it.");
	//Add Banner
	define("LANG_LABEL_ADDBANNER", "Add ".string_ucwords(BANNER_FEATURE_NAME));
	//Custom Invoice Title
	define("LANG_LABEL_CUSTOM_INVOICE_TITLE", "Custom Invoice Title");
	//Custom Invoice Items
	define("LANG_LABEL_CUSTOM_INVOICE_ITEMS", "Custom Invoice Items");
	//Easy and Fast.
	define("LANG_LABEL_EASY_AND_FAST", "Easy and Fast.");
	//Steps
	define("LANG_LABEL_STEPS", "Steps");
	//Account Signup
	define("LANG_LABEL_ACCOUNT_SIGNUP", "Account Signup");
	//Select a Level
	define("LANG_LABEL_SELECT_PACKAGE", "Select a Level");
	//Payment Status
	define("LANG_LABEL_PAYMENTSTATUS", "Payment Status");
	//Expiration
	define("LANG_LABEL_EXPIRATION", "Expiration");
	//New Deal
	define("LANG_LABEL_ADDNEWPROMOTION", "New ". string_ucwords(PROMOTION_FEATURE_NAME));
	//Add a new deal
	define("LANG_LABEL_ADDANEWPROMOTION", "Add a new ".PROMOTION_FEATURE_NAME);
	//Manage Billing
	define("LANG_LABEL_MANAGEBILLING", "Manage Billing");
	//Click here if you have your password already.
	define("LANG_MSG_CLICK_IF_YOU_HAVE_PASSWORD", "Click here if you have your password already.");
	//Not a sponsor?
	define("LANG_MSG_NOT_A_MEMBER", "Not a sponsor?");
	//for information on adding your item to
	define("LANG_MSG_FOR_INFORMATION_ON_ADDING_YOUR_ITEM", "for information on adding your item to");
	//Welcome to the Sponsor Section
	define("LANG_MSG_WELCOME", "Welcome to the Sponsor Section");
	//Welcome to the Member Section
	define("LANG_MSG_WELCOME2", "Welcome to the Member Section");
	//"Account locked. Wait" X minute(s) and try again.
	define("LANG_MSG_ACCOUNTLOCKED1", "Account locked. Wait");
	//Account locked. Wait X "minute(s) and try again."
	define("LANG_MSG_ACCOUNTLOCKED2", "minute(s) and try again.");
	//One or more required fields were not filled in. Please confirm that all required information has been entered before continuing.
	define("LANG_MSG_FOREIGNACCOUNTWARNING", "One or more required fields were not filled in. Please confirm that all required information has been entered before continuing.");
	//You don't have access permission from this IP address!
	define("LANG_MSG_YOUDONTHAVEACCESSFROMTHISIPADDRESS", "You don't have access permission from this IP address!");
	//Your account was deactivated!
	define("LANG_MSG_ACCOUNT_DEACTIVE", "Your account was deactivated!");
	//Sorry, your username or password is incorrect.
	define("LANG_MSG_USERNAME_OR_PASSWORD_INCORRECT", "Sorry, your e-mail or password is incorrect.");
	//Sorry, wrong account.
	define("LANG_MSG_WRONG_ACCOUNT", "Sorry, wrong account.");
	//Sorry, for your protection the link sent to your e-mail has expired. If you forgot your password click on the link below.
	define("LANG_MSG_WRONG_KEY", "Sorry, for your protection the link sent to your e-mail has expired. If you forgot your password click on the link below.");
    //Invalid activation key.
    define("LANG_MSG_WRONG_ACTIVATION_KEY", "Invalid activation key.");
    //Account successfully activated!
    define("LANG_MSG_ACCOUNT_ACTIVATED", "Account successfully activated!");
	//OpenID Server not available!
	define("LANG_MSG_OPENID_SERVER", "OpenID Server not available!");
	//Error requesting OpenID Server!
	define("LANG_MSG_OPENID_ERROR", "Error requesting OpenID Server!");
	//OpenID request canceled!
	define("LANG_MSG_OPENID_CANCEL", "OpenID request canceled!");
	//Google request canceled!
	define("LANG_MSG_GOOGLE_CANCEL", "Google request canceled!");
	//Invalid OpenID Identity!
	define("LANG_MSG_OPENID_INVALID", "Invalid OpenID Identity!");
	//Forgot your password?
	define("LANG_MSG_FORGOT_YOUR_PASSWORD", "Forgot your password?");
	//What is OpenID?
	define("LANG_MSG_WHATISOPENID", "What is OpenID?");
	//What is Facebook?
	define("LANG_MSG_WHATISFACEBOOK", "What is Facebook?");
	//What is Google?
	define("LANG_MSG_WHATISGOOGLE", "What is Google?");
	//Account successfully updated!
	define("LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED", "Account successfully updated!");
	//Password successfully updated!
	define("LANG_MSG_PASSWORD_SUCCESSFULLY_UPDATED", "Password successfully updated!");
	//"Thank you for signing up for an account in" [EDIRECTORY_TITLE]
	define("LANG_MSG_THANK_YOU_FOR_SIGNING_UP", "Thank you for signing up for an account in");
	//Sign in to manage your account with the e-mail and password below.
	define("LANG_MSG_LOGIN_TO_MANAGE_YOUR_ACCOUNT", "Sign in to manage your account with the e-mail and password below.");
	//You can see
	define("LANG_MSG_YOU_CAN_SEE", "You can see");
	//Your account in
	define("LANG_MSG_YOUR_ACCOUNT_IN", "Your account in");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_ARTICLE_WILL_SHOW", "This ".ARTICLE_FEATURE_NAME." will show");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_CLASSIFIED_WILL_SHOW", "This ".CLASSIFIED_FEATURE_NAME." will show");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_EVENT_WILL_SHOW", "This ".EVENT_FEATURE_NAME." will show");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_LISTING_WILL_SHOW", "This ".LISTING_FEATURE_NAME." will show");
	//This [ITEM] will show [UNLIMITED|"the max of" X] images per gallery.
	define("LANG_MSG_THE_MAX_OF", "the maximum of");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTO", "image");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTOS", "images");
	//This [ITEM] will show [UNLIMITED|the max of X] images "in the gallery"
	define("LANG_MSG_PER_GALLERY", "in the gallery");
	// plus one main image.
	define("LANG_MSG_PLUS_MAINIMAGE", " plus one main image.");
	//Click here to pay for your article
	define("LANG_MSG_CONTINUE_TO_PAY_ARTICLE", "Click here to pay for your ".ARTICLE_FEATURE_NAME);
	//Click here to pay for your banner
	define("LANG_MSG_CONTINUE_TO_PAY_BANNER", "Click here to pay for your ".BANNER_FEATURE_NAME);
	//Click here to pay for your classified
	define("LANG_MSG_CONTINUE_TO_PAY_CLASSIFIED", "Click here to pay for your ".CLASSIFIED_FEATURE_NAME);
	//Click here to pay for your event
	define("LANG_MSG_CONTINUE_TO_PAY_EVENT", "Click here to pay for your ".EVENT_FEATURE_NAME);
	//Click here to pay for your listing
	define("LANG_MSG_CONTINUE_TO_PAY_LISTING", "Click here to pay for your ".LISTING_FEATURE_NAME);
	//Articles are activated by
	define("LANG_MSG_ARTICLES_ARE_ACTIVATED_BY", string_ucwords(ARTICLE_FEATURE_NAME_PLURAL)." are activated by");
	//Banners are activated by
	define("LANG_MSG_BANNERS_ARE_ACTIVATED_BY", string_ucwords(BANNER_FEATURE_NAME_PLURAL)." are activated by");
	//Classifieds are activated by
	define("LANG_MSG_CLASSIFIEDS_ARE_ACTIVATED_BY", string_ucwords(CLASSIFIED_FEATURE_NAME_PLURAL)." are activated by");
	//Events are activated by
	define("LANG_MSG_EVENTS_ARE_ACTIVATED_BY", string_ucwords(EVENT_FEATURE_NAME_PLURAL)." are activated by");
	//Listings are activated by
	define("LANG_MSG_LISTINGS_ARE_ACTIVATED_BY", string_ucwords(LISTING_FEATURE_NAME_PLURAL)." are activated by");
	//only after the process is complete.
	define("LANG_MSG_ONLY_PROCCESS_COMPLETE", "only after the process is complete.");
    //You can only pay for [MAX_ITEMS_MODULE] each time.
    define("LANG_MSG_PROCCESS_MAXITEMS", "You can only pay for [MAX_ITEMS_MODULE] each time.");
    //Make the process again with less items.
    define("LANG_MSG_PROCCESS_AGAIN", "Make the process again with less items.");
	//Tips for the Item Map Tuning
	define("LANG_MSG_TIPSFORMAPTUNING", "Tips for the Item Map Tuning");
	//You can adjust the position in the map,
	define("LANG_MSG_YOUCANADJUSTPOSITION", "You can adjust the position in the map,");
	//with more accuracy.
	define("LANG_MSG_WITH_MORE_ACCURACY", "with more accuracy.");
	//Use the controls "+" and "-" to adjust the map zoom.
	define("LANG_MSG_USE_CONTROLS_TO_ADJUST", "Use the controls \"+\" and \"-\" to adjust the map zoom.");
	//Use the arrows to navigate on map.
	define("LANG_MSG_USE_ARROWS_TO_NAVIGATE", "Use the arrows to navigate on map.");
	//Drag-and-Drop the marker to adjust the location.
	define("LANG_MSG_DRAG_AND_DROP_MARKER", "Drag-and-Drop the marker to adjust the location.");
	//Drop files here to upload.
	define("LANG_MSG_DROP_IMAGE", "Drop files here to upload");
	//Your deal will appear here
	define("LANG_MSG_PROMOTION_WILL_APPEAR_HERE", "Your ".PROMOTION_FEATURE_NAME." will appear here");
	//Associate an existing deal with this listing
	define("LANG_MSG_ASSOCIATE_EXISTING_PROMOTION", "Associate an existing ".PROMOTION_FEATURE_NAME." with this ".LISTING_FEATURE_NAME);
	//No results found!
	define("LANG_MSG_NO_RESULTS_FOUND", "No results found!");
	//Access not allowed!
	define("LANG_MSG_ACCESS_NOT_ALLOWED", "Access not allowed!");
	//The following problems were found
	define("LANG_MSG_PROBLEMS_WERE_FOUND", "The following problems were found");
	//No items selected or requiring payment.
	define("LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT", "No items selected or requiring payment.");
	//No items found.
	define("LANG_MSG_NO_ITEMS_FOUND", "No items found.");
	//No invoices in the system.
	define("LANG_MSG_NO_INVOICES_IN_THE_SYSTEM", "No Invoices in the system.");
	//No transactions in the system.
	define("LANG_MSG_NO_TRANSACTIONS_IN_THE_SYSTEM", "No Transactions in the system.");
	//Claim this Listing
	define("LANG_MSG_CLAIM_THIS_LISTING", "Claim this ".string_ucwords(LISTING_FEATURE_NAME));
	//Go to sponsor check out area
	define("LANG_MSG_GO_TO_MEMBERS_CHECKOUT", "Go to sponsor check out area");
	//You can see your invoice in
	define("LANG_MSG_YOU_CAN_SEE_INVOICE", "You can see your invoice in");
	//I agree to terms
	define("LANG_MSG_AGREE_TO_TERMS", "I agree to terms");
	//and I will send payment.
	define("LANG_MSG_I_WILL_SEND_PAYMENT", "and I will send payment.");
	//This page will redirect you to your sponsor area in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU", "This page will redirect you to your sponsor area in few seconds.");
	//This page will redirect you to continue your signup process in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU_SIGNUP", "This page will redirect you to continue your signup process in few seconds.");
	//"If it doesn't work, please" click here
	define("LANG_MSG_IF_IT_DOES_NOT_WORK", "If it doesn't work, please");
	//Manage Article
	define("LANG_MANAGE_ARTICLE", "Manage ".string_ucwords(ARTICLE_FEATURE_NAME));
	//Manage Banner
	define("LANG_MANAGE_BANNER", "Manage ".string_ucwords(BANNER_FEATURE_NAME));
	//Manage Classified
	define("LANG_MANAGE_CLASSIFIED", "Manage ".string_ucwords(CLASSIFIED_FEATURE_NAME));
	//Manage Event
	define("LANG_MANAGE_EVENT", "Manage ".string_ucwords(EVENT_FEATURE_NAME));
	//Manage Listing
	define("LANG_MANAGE_LISTING", "Manage ".string_ucwords(LISTING_FEATURE_NAME));
	//Manage Deal
	define("LANG_MANAGE_PROMOTION", "Manage ".string_ucwords(PROMOTION_FEATURE_NAME));
	//Manage Billing
	define("LANG_MANAGE_BILLING", "Manage Billing");
	//Manage Invoices
	define("LANG_MANAGE_INVOICES", "Manage Invoices");
	//Manage Transactions
	define("LANG_MANAGE_TRANSACTIONS", "Manage Transactions");
	//No articles in the system.
	define("LANG_NO_ARTICLES_IN_THE_SYSTEM", "No ".ARTICLE_FEATURE_NAME_PLURAL." in the system.");
	//No banners in the system.
	define("LANG_NO_BANNERS_IN_THE_SYSTEM", "No ".BANNER_FEATURE_NAME_PLURAL." in the system.");
	//No classifieds in the system.
	define("LANG_NO_CLASSIFIEDS_IN_THE_SYSTEM", "No ".CLASSIFIED_FEATURE_NAME_PLURAL." in the system.");
	//No events in the system.
	define("LANG_NO_EVENTS_IN_THE_SYSTEM", "No ".EVENT_FEATURE_NAME_PLURAL." in the system.");
	//No listings in the system.
	define("LANG_NO_LISTINGS_IN_THE_SYSTEM", "No ".LISTING_FEATURE_NAME_PLURAL." in the system.");
	//No deals in the system.
	define("LANG_NO_PROMOTIONS_IN_THE_SYSTEM", "No ".PROMOTION_FEATURE_NAME_PLURAL." in the system.");
	//No Reports Available.
	define("LANG_NO_REPORTS", "No Reports Available.");
	//No article found. It might be deleted.
	define("LANG_NO_ARTICLE_FOUND", "No ".ARTICLE_FEATURE_NAME." found. It might be deleted.");
	//No classified found. It might be deleted.
	define("LANG_NO_CLASSIFIED_FOUND", "No ".CLASSIFIED_FEATURE_NAME." found. It might be deleted.");
	//No listing found. It might be deleted.
	define("LANG_NO_LISTING_FOUND", "No ".LISTING_FEATURE_NAME." found. It might be deleted.");
	//Article Information
	define("LANG_ARTICLE_INFORMATION", string_ucwords(ARTICLE_FEATURE_NAME)." Information");
	//Delete Article
	define("LANG_ARTICLE_DELETE", "Delete ".string_ucwords(ARTICLE_FEATURE_NAME));
	//Delete Article Information
	define("LANG_ARTICLE_DELETE_INFORMATION", "Delete ".string_ucwords(ARTICLE_FEATURE_NAME)." Information");
	//Are you sure you want to delete this article
	define("LANG_ARTICLE_DELETE_CONFIRM", "Are you sure you want to delete this ".ARTICLE_FEATURE_NAME."?");
	//Article Preview
	define("LANG_ARTICLE_PREVIEW", string_ucwords(ARTICLE_FEATURE_NAME)." Preview");
	//Article Traffic Report
	define("LANG_ARTICLE_TRAFFIC_REPORT", string_ucwords(ARTICLE_FEATURE_NAME)." Traffic Report");
	//Article Detail
	define("LANG_ARTICLE_DETAIL", string_ucwords(ARTICLE_FEATURE_NAME)." Detail");
	//Edit Article Information
	define("LANG_ARTICLE_EDIT_INFORMATION", "Edit ".string_ucwords(ARTICLE_FEATURE_NAME)." Information");
	//Delete Banner
	define("LANG_BANNER_DELETE", "Delete ".string_ucwords(BANNER_FEATURE_NAME));
	//Delete Banner Information
	define("LANG_BANNER_DELETE_INFORMATION", "Delete ".string_ucwords(BANNER_FEATURE_NAME)." Information");
	//Are you sure you want to delete this banner?
	define("LANG_BANNER_DELETE_CONFIRM", "Are you sure you want to delete this ".BANNER_FEATURE_NAME."?");
	//Edit Banner
	define("LANG_BANNER_EDIT", "Edit ".string_ucwords(BANNER_FEATURE_NAME));
	//Edit Banner Information
	define("LANG_BANNER_EDIT_INFORMATION", "Edit ".string_ucwords(BANNER_FEATURE_NAME)." Information");
	//Banner Preview
	define("LANG_BANNER_PREVIEW", string_ucwords(BANNER_FEATURE_NAME)." Preview");
	//Banner Traffic Report
	define("LANG_BANNER_TRAFFIC_REPORT", string_ucwords(BANNER_FEATURE_NAME)." Traffic Report");
	//View Banner
	define("LANG_VIEW_BANNER", "View ".string_ucwords(BANNER_FEATURE_NAME));
	//Disabled
	define("LANG_BANNER_DISABLED", "Disabled");
	//Classified Information
	define("LANG_CLASSIFIED_INFORMATION", string_ucwords(CLASSIFIED_FEATURE_NAME)." Information");
	//Delete Classified
	define("LANG_CLASSIFIED_DELETE", "Delete ".string_ucwords(CLASSIFIED_FEATURE_NAME));
	//Your classified will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_CLASSIFIED_AUTOMATICALLY_APPEAR", "Your ".CLASSIFIED_FEATURE_NAME." will automatically appear in the main category of each sub-category you select.");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORY_PLURAL", string_ucwords(CLASSIFIED_FEATURE_NAME)." Categories");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORIES", string_ucwords(CLASSIFIED_FEATURE_NAME)." Categories");
	//Delete Classified Information
	define("LANG_CLASSIFIED_DELETE_INFORMATION", "Delete ".string_ucwords(CLASSIFIED_FEATURE_NAME)." Information");
	//Are you sure you want to delete this classified
	define("LANG_CLASSIFIED_DELETE_CONFIRM", "Are you sure you want to delete this ".CLASSIFIED_FEATURE_NAME."?");
	//Classified Map Tuning
	define("LANG_CLASSIFIED_MAP_TUNING", string_ucwords(CLASSIFIED_FEATURE_NAME)." Map Tuning");
	//Classified Preview
	define("LANG_CLASSIFIED_PREVIEW", string_ucwords(CLASSIFIED_FEATURE_NAME)." Preview");
	//Classified Traffic Report
	define("LANG_CLASSIFIED_TRAFFIC_REPORT", string_ucwords(CLASSIFIED_FEATURE_NAME)." Traffic Report");
	//Classified Detail
	define("LANG_CLASSIFIED_DETAIL", string_ucwords(CLASSIFIED_FEATURE_NAME)." Detail");
	//Edit Classified Information
	define("LANG_CLASSIFIED_EDIT_INFORMATION", "Edit ".string_ucwords(CLASSIFIED_FEATURE_NAME)." Information");
	//Edit Classified Level
	define("LANG_CLASSIFIED_EDIT_LEVEL", "Edit ".string_ucwords(CLASSIFIED_FEATURE_NAME)." Level");
	//Delete Event
	define("LANG_EVENT_DELETE", "Delete ".string_ucwords(EVENT_FEATURE_NAME));
	//Delete Event Information
	define("LANG_EVENT_DELETE_INFORMATION", "Delete ".string_ucwords(EVENT_FEATURE_NAME)." Information");
	//Are you sure you want to delete this event
	define("LANG_EVENT_DELETE_CONFIRM", "Are you sure you want to delete this ".EVENT_FEATURE_NAME."?");
	//Event Information
	define("LANG_EVENT_INFORMATION", string_ucwords(EVENT_FEATURE_NAME)." Information");
	//Event Map Tuning
	define("LANG_EVENT_MAP_TUNING", string_ucwords(EVENT_FEATURE_NAME)." Map Tuning");
	//Event Preview
	define("LANG_EVENT_PREVIEW", string_ucwords(EVENT_FEATURE_NAME)." Preview");
	//Event Traffic Report
	define("LANG_EVENT_TRAFFIC_REPORT", string_ucwords(EVENT_FEATURE_NAME)." Traffic Report");
	//Event Detail
	define("LANG_EVENT_DETAIL", string_ucwords(EVENT_FEATURE_NAME)." Detail");
	//Edit Event Information
	define("LANG_EVENT_EDIT_INFORMATION", "Edit ".string_ucwords(EVENT_FEATURE_NAME)." Information");
	//Listing Information
	define("LANG_LISTING_INFORMATION", string_ucwords(LISTING_FEATURE_NAME)." Information");
	//Listing Map Tuning
	define("LANG_LISTING_MAP_TUNING", string_ucwords(LISTING_FEATURE_NAME)." Map Tuning");
	//Listing Preview
	define("LANG_LISTING_PREVIEW", string_ucwords(LISTING_FEATURE_NAME)." Preview");
	//Listing Deal
	define("LANG_LISTING_PROMOTION", string_ucwords(LISTING_FEATURE_NAME)." ".string_ucwords(PROMOTION_FEATURE_NAME));
	//The deal is linked from the listing.
	define("LANG_LISTING_PROMOTION_IS_LINKED", "The ".PROMOTION_FEATURE_NAME." is linked from the ".LISTING_FEATURE_NAME.".");
	//To be active the deal
	define("LANG_LISTING_TO_BE_ACTIVE_PROMOTION", "To be active the ".PROMOTION_FEATURE_NAME);
	//must have an end date in the future.
	define("LANG_LISTING_END_DATE_IN_FUTURE", "must have an end date in the future.");
	//must be associated with a listing.
	define("LANG_LISTING_ASSOCIATED_WITH_LISTING", "must be associated with a ".LISTING_FEATURE_NAME.".");
	//Listing Traffic Report
	define("LANG_LISTING_TRAFFIC_REPORT", string_ucwords(LISTING_FEATURE_NAME)." Traffic Report");
	//Listing Detail
	define("LANG_LISTING_DETAIL", string_ucwords(LISTING_FEATURE_NAME)." Detail");
	//for listing
	define("LANG_LISTING_FOR_LISTING", "for ".LISTING_FEATURE_NAME);
	//Listing Update
	define("LANG_LISTING_UPDATE", string_ucwords(LISTING_FEATURE_NAME)." Update");
	//Delete Deal
	define("LANG_PROMOTION_DELETE", "Delete ".string_ucwords(PROMOTION_FEATURE_NAME));
	//Delete Deal Information
	define("LANG_PROMOTION_DELETE_INFORMATION", "Delete ".string_ucwords(PROMOTION_FEATURE_NAME)." Information");
	//Are you sure you want to delete this deal?
	define("LANG_PROMOTION_DELETE_CONFIRM", "Are you sure you want to delete this ".PROMOTION_FEATURE_NAME."?");
	//Deal Preview
	define("LANG_PROMOTION_PREVIEW", string_ucwords(PROMOTION_FEATURE_NAME)." Preview");
	//Deal Traffic Report
	define("LANG_PROMOTION_TRAFFIC_REPORT", string_ucwords(PROMOTION_FEATURE_NAME)." Traffic Report");
	//Deal Information
	define("LANG_PROMOTION_INFORMATION", string_ucwords(PROMOTION_FEATURE_NAME)." Information");
	//Deal Detail
	define("LANG_PROMOTION_DETAIL", string_ucwords(PROMOTION_FEATURE_NAME)." Detail");
	//Edit Deal Information
	define("LANG_PROMOTION_EDIT_INFORMATION", "Edit ".string_ucwords(PROMOTION_FEATURE_NAME)." Information");
	//Image successfully deleted!
	define("LANG_IMAGE_SUCCESSFULLY_DELETED", "Image successfully deleted!");
	//Review Detail
	define("LANG_REVIEW_DETAIL", "Review Detail");
	//Review Preview
	define("LANG_REVIEW_PREVIEW", "Review Preview");
	//Invoice Detail
	define("LANG_INVOICE_DETAIL", "Invoice Detail");
	//Invoice not found for this account.
	define("LANG_INVOICE_NOT_FOUND_FOR_ACCOUNT", "Invoice not found for this account.");
	//Invoice Notification
	define("LANG_INVOICE_NOTIFICATION", "Invoice Notification");
	//Transaction Detail
	define("LANG_TRANSACTION_DETAIL", "Transaction Detail");
	//Transaction not found for this account.
	define("LANG_TRANSACTION_NOT_FOUND_FOR_ACCOUNT", "Transaction not found for this account.");
	//Sign in with Directory Account
	define("LANG_LOGINDIRECTORYUSER", "Sign in with Directory Account");
	//Sign in with OpenID 2.0 Account
	define("LANG_LOGINOPENIDUSER", "Sign in with OpenID 2.0 Account");
	//Log in with Facebook
	define("LANG_LOGINFACEBOOKUSER", "Log in with Facebook");
	//Sign up with Facebook
	define("LANG_SIGNUPFACEBOOKUSER", "Sign up with Facebook");
	//Log in with Google
	define("LANG_LOGINGOOGLEUSER", "Log in with Google");
	//Sign up with Google
	define("LANG_SIGNUPGOOGLEUSER", "Sign up with Google");
	//Username already registered!
	define("LANG_USERNAME_ALREADY_REGISTERED", LANG_LABEL_USERNAME." already registered!");
	//This e-mail is available.
	define("LANG_USERNAME_NOT_REGISTERED", "This e-mail is available.");
	//Error uploading image. Please try again.
	define("LANG_MSGERROR_ERRORUPLOADINGIMAGE", "Error uploading image. Please try again.");
	//Image successfully uploaded
	define("LANG_IMAGE_SUCCESSFULLY_UPLOADED", "Image successfully uploaded!");
	//Image successfully updated
	define("LANG_IMAGE_SUCCESSFULLY_UPDATED", "Image successfully updated!");
	//Delete image
	define("LANG_DELETE_IMAGE", "Delete Image");
	//Are you sure you want to delete this image
	define("LANG_DELETE_IMAGE_CONFIRM", "Are you sure you want to delete this image?");
	//Edit Image
	define("LANG_LABEL_EDITIMAGE", "Edit Image");
	//Make main
	define("LANG_LABEL_MAKEMAIN", "Make main");
	//Main image
	define("LANG_LABEL_MAINIMAGE", "Main");
	//Click here to set as main image
	define("LANG_LABEL_CLICKTOSETMAINIMAGE", "Click here to set as main image");
	//Click here to set as gallery image
	define("LANG_LABEL_CLICKTOSETGALLERYIMAGE", "Click here to set as gallery image");
	//Packages
	define("LANG_PACKAGE_PLURAL", "Packages");
	//Package
	define("LANG_PACKAGE_SING", "Package");
	//Charging for package
	define("LANG_CHARGING_PACKAGE", "Charging for package ");

	# ----------------------------------------------------------------------------------------------------
	# SOCIAL NETWORK
	# ----------------------------------------------------------------------------------------------------
	//Profile successfully updated!
	define("LANG_MSG_PROFILE_SUCCESSFULLY_UPDATED", "Profile successfully updated!");
	//Profile
	define("LANG_LABEL_PROFILE", "Profile");
	//Edit Profile
	define("LANG_LABEL_EDIT_PROFILE", "Edit Profile");
	//Load from Facebook
	define("LANG_LABEL_IMAGE_FROM_FACEBOOK", "Load from Facebook");
	//Personal Infomation
	define("LANG_LABEL_PERSONAL_INFORMATION", "Personal Information");
	//Twitter Account
	define("LANG_LABEL_TWITTER_ACCOUNT", "Twitter account");
	//Twitter Widget
	define("LANG_LABEL_TWITTER_WIDGET", "Twitter Widget");
	//About me
	define("LANG_LABEL_ABOUT_ME", "About Me");
	//Birthdate
	define("LANG_LABEL_BIRTHDATE", "Birthdate");
	//Hometown
	define("LANG_LABEL_HOMETOWN", "Hometown");
	//Favorite Books
	define("LANG_LABEL_FAVORITEBOOKS", "Favorite Books");
	//Favorite Movies
	define("LANG_LABEL_FAVORITEMOVIES", "Favorite Movies");
	//Favorite Sports
	define("LANG_LABEL_FAVORITESPORTS", "Favorite Sports");
	//Favorite Musics
	define("LANG_LABEL_FAVORITEMUSICS", "Favorite Music");
	//Favorite Foods
	define("LANG_LABEL_FAVORITEFOODS", "Favorite Food");
	//Are you sure?
	define("LANG_MESSAGE_MSGAREYOUSURE", "Are you sure?");
	//This is the URL where visitors can see your public profile page
	define("LANG_MSG_FRIENDLY_URL_PROFILE_TIP", "This is the URL where visitors can see your public profile page");
	//Your URL
	define("LANG_LABEL_YOUR_URL", "Your URL");
    //Your URL is required.
	define("LANG_LABEL_YOURURL_REQUIRED", "Your URL is required.");
    //yoururl
    define("LANG_LABEL_YOUR_URLTIP", "yoururl");
    //Available URL
    define("LANG_LABEL_URLOK", "Available URL");
    //Unavailable URL
    define("LANG_LABEL_URLNOTOK", "Unavailable URL");
	//Your URL contains invalid chars.
	define("LANG_MSG_FRIENDLY_URL_INVALID_CHARS", "Your URL contains invalid chars.");
	//URL already in use, please choose another URL.
	define("LANG_MSG_PAGE_URL_IN_USE", "URL already in use, please choose another URL.");
	//View all
	define("LANG_LABEL_VIEW_ALL", "View all");
	//View all
	define("LANG_LABEL_VIEW_ALL2", "View all");
	//No Items
	define("LANG_MSG_NO_ITEMS", "No Items");
	//Share
	define("LANG_LABEL_SHARE", "Share");
	//Comments
	define("LANG_LABEL_COMMENTS", "Comments");
	//My Profile
	define("LANG_LABEL_MYPROFILE", "My Profile");
	//User profile successfully enabled!
	define("LANG_MSG_PROFILE_ENABLED", "User profile successfully enabled!");
	//Display my contact information publicly
	define("LANG_LABEL_PUBLISH_MY_CONTACT", "Publish my contact information");
	//Create my Personal Page
	define("LANG_LABEL_CREATE_PERSONAL_PAGE", "Create my Personal Page");
	//Public Profile
	define("LANG_LABEL_PERSONAL_PAGE", "Public Profile");
	//Article Reviews
	define("LANG_LABEL_ARTICLE_REVIEW",  string_ucwords(ARTICLE_FEATURE_NAME)." Reviews");
	//Listing Reviews
	define("LANG_LABEL_LISTING_REVIEW", string_ucwords(LISTING_FEATURE_NAME)." Reviews");
	//Deal Reviews
	define("LANG_LABEL_PROMOTION_REVIEW", string_ucwords(PROMOTION_FEATURE_NAME)." Reviews");
	//Review successfully deleted.
	define("LANG_MSG_REVIEW_SUCCESS_DELETED", "Review successfully deleted.");
	//No reviews found!
	define("LANG_LABEL_NOREVIEWS", "No reviews found!");
	//Edit my Profile
	define("LANG_LABEL_EDITPROFILE", "Edit my Profile");
	//Back to my Profile
	define("LANG_LABEL_BACKTOPROFILE", "Back to my Profile");
	//Member Since
	define("LANG_LABEL_MEMBER_SINCE", "Member Since");
	//Account Settings
	define("LANG_LABEL_ACCOUNT_SETTINGS", "Account Settings");
    //Deals Redeemed
	define("LANG_LABEL_ACCOUNT_DEALS", string_ucwords(PROMOTION_FEATURE_NAME_PLURAL)." Redeemed");
	//Favorites
	define("LANG_LABEL_FAVORITES", "Favorites");
	//You have no permission to access this area.
	define("LANG_MSG_NO_PERMISSION", "You have no permission to access this area.");
	//Go to your Profile
	define("LANG_MSG_GO_PROFILE", "Go to your Profile.");
	//My Personal Page
	define("LANG_MSG_MY_PERSONAL_PAGE", "My Personal Page");
	//Use this Account
	define("LANG_MSG_USE_LOGGED_ACCOUNT", "Use this Account");
	//Profile Page
	define("LANG_LABEL_PROFILE_PAGE", "Profile Page");
	//Create your Profile
	define("LANG_CREATE_MEMBER_PROFILE", "Create your Profile");
	//Your Name is required.
	define("LANG_MSG_NICKANAME_REQUIRED", "Your Name is required.");
	//Be sure that the twitter account you are adding is not protected. If the twitter account is protected the latest tweets on this account will not be shown.
	define("LANG_PROFILE_TWITTER_TIP1", "Be sure that the twitter account you are adding is not protected. If the twitter account is protected the latest tweets on this account will not be shown.");
    //Thank you for signing up!
    define("LANG_PROFILE_WELCOME", "Thank you for signing up!");
    //We appreciate it and welcome to
    define("LANG_PROFILE_WELCOME2", "We appreciate it and welcome to");

	# ----------------------------------------------------------------------------------------------------
	# GALLERY
	# ----------------------------------------------------------------------------------------------------
	//Only
	define("LANG_ONLY", "Only ");
	//images accepted for upload!
	define("LANG_IMAGES_ACCEPETED", "images accepted for upload!");
	//Images must be under
	define("LANG_IMAGE_MUST_BE", "Images must be under ");
	//Select an image for upload!
	define("LANG_SELECT_IMAGE", "Select an image for upload!");
	//Original image
	define("LANG_ORIGINAL", "Original image");
	//Thumbnail preview
	define("LANG_THUMB_PREVIEW", "Thumb preview");
	//Edit captions
	define("LANG_LABEL_EDIT_CAPTIONS", "Captions");
	//You can add the maximum of
	define("LANG_YOU_CAN_ADD_MAXOF", "You can add the maximum of ");
	//photos to your gallery
	define("LANG_TO_YOUR_GALLERY", " photos to your gallery!");
	//Create Thumbnail
	define("LANG_CREATE_THUMB", "Create Thumbnail");
	//Thumbnail Preview
	define("LANG_THUMB_PREVIEW", "Thumbnail Preview");
	//Your item already has the maximum number of images in the gallery. Delete an existing image to save this one.
	define("LANG_ITEM_ALREADY_HAD_MAX_IMAGE", "Your item already has the maximum number of images in the gallery. Delete an existing image to save this one.");

	# ----------------------------------------------------------------------------------------------------
	# RECURRING EVENTS
	# ----------------------------------------------------------------------------------------------------
	//Recurring Event
	define("LANG_EVENT_RECURRING", "Recurring ".string_ucwords(EVENT_FEATURE_NAME));
	//Repeat
	define("LANG_PERIOD", "Repeat");
	//Choose an option
	define("LANG_CHOOSE_PERIOD", "Choose an option");
	//Daily
	define("LANG_DAILY", "Daily");
	//Weekly
	define("LANG_WEEKLY", "Weekly");
	//Monthly
	define("LANG_MONTHLY", "Monthly");
	//Yearly
	define("LANG_YEARLY", "Yearly");
	//Daily Event
	define("LANG_DAILY2", "Daily ".string_ucwords(EVENT_FEATURE_NAME));
	//Weekly
	define("LANG_WEEKLY2", "Weekly");
	//Monthly
	define("LANG_MONTHLY2", "Monthly");
	//Yearly
	define("LANG_YEARLY2", "Yearly");
	//every
	define("LANG_EVERY", "Every");
	//every
	define("LANG_EVERY2", "Every");
	//of
	define("LANG_OF", "of");
	//of
	define("LANG_OF2", "of");
	//of
	define("LANG_OF3", "of");
	//of
	define("LANG_OF4", "of");
	//Week
	define("LANG_WEEK", "Week");
	//Choose Month
	define("LANG_CHOOSE_MONTH", "Choose Month");
	//Choose Day
	define("LANG_CHOOSE_DAY", "Choose Day");
	//Choose Week
	define("LANG_CHOOSE_WEEK", "Choose Week");
	//First
	define("LANG_FIRST", "First");
	//Second
	define("LANG_SECOND", "Second");
	//Third
	define("LANG_THIRD", "Third");
	//Fourth
	define("LANG_FOURTH", "Fourth");
	//Last
	define("LANG_LAST", "Last");
	//1st
	define("LANG_FIRST_2", "1st");
	//2nd
	define("LANG_SECOND_2", "2nd");
	//3rd
	define("LANG_THIRD_2", "3rd");
	//4th
	define("LANG_FOURTH_2", "4th");
	//Recurring
	define("LANG_RECURRING", "Recurring");
	//Please select a day of week
	define("LANG_EVENT_SELECT_DAYOFWEEK", "Please select a day of week.");
	//Please type a day
	define("LANG_EVENT_TYPE_DAY", "Please type a day.");
	//Please select a month
	define("LANG_EVENT_SELECT_MONTH", "Please select a month.");
	//Please select a week
	define("LANG_EVENT_SELECT_WEEK", "Please select a week.");
	//Please select a Repeat option
	define("LANG_EVENT_SELECT_PERIOD", "Please select a Repeat option.");
	//When
	define("LANG_EVENT_WHEN", "When");
	//Day must be numeric
	define("LANG_EVENT_TYPE_DAY_NUMERIC", "Day must be numeric.");
	//Day must be between 1 and 31
	define("LANG_EVENT_TYPE_DAY_BETWEEN", "Day must be between 1 and 31.");
	//Day doesn't match with the choosen period
	define("LANG_EVENT_CHECK_DAY", "Day doesn't match with the choosen period.");
	//Month doesn't match with the choosen period
	define("LANG_EVENT_CHECK_MONTH", "Month doesn't match with the choosen period.");
	//Days don't match with the choosen period
	define("LANG_EVENT_CHECK_DAYOFWEEK", "Days don't match with the choosen period.");
	//Week doesn't match with the choosen period
	define("LANG_EVENT_CHECK_WEEK", "Week doesn't match with the choosen period.");
	//No info
	define("LANG_EVENT_NO_INFO", "No info");
	//Ends on
	define("LANG_ENDS_IN", "Ends on");
	//Never
	define("LANG_NEVER", "Never");
	//Until
	define("LANG_UNTIL", "Until");
	//Until Date
	define("LANG_LABEL_UNTIL_DATE", "Until Date");
	//The "Until Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_UNTIL_DATE_GREATER_THAN_START_DATE", "The \"Until Date\" must be greater than or equal to the \"Start Date\".");
	//The "Until Date" cannot be in past.
	define("LANG_MSG_UNTIL_DATE_CANNOT_IN_PAST", "The \"Until Date\" cannot be in past.");
	//Starts on
	define("LANG_EVENT_STARTS_ON", "Starts on");
    //Starts
	define("LANG_EVENT_STARTS", "Starts");
	//Repeats
	define("LANG_EVENT_REPEATS", "Repeats");
	//Ends on
	define("LANG_EVENT_ENDS", "Ends on");
	//weekend
	define("LANG_EVENT_WEEKEND", "weekend");
	//weekends
	define("LANG_EVENT_WEEKENDS", "weekends");
	//Mon-Fri
	define("LANG_EVENT_BUSINESSDAY", "Mon-Fri");
	//the Month
	define("LANG_THE_MONTH", "the Month");
	//Every Year
	define("LANG_EVERY_YEAR", "Every Year");

	# ----------------------------------------------------------------------------------------------------
	# SITES
	# ----------------------------------------------------------------------------------------------------
    //Site
    define("LANG_DOMAIN", "Site");
	//Site name
	define("LANG_DOMAIN_NAME", "Site name");
	//Click here to view this site
	define("LANG_MSG_CLICK_TO_VIEW_THIS_DOMAIN", "Click here to view this site");
	//Click here to delete this site
	define("LANG_MSG_CLICK_TO_DELETE_THIS_DOMAIN", "Click here to delete this site");
	//Site successfully deleted!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_DELETE", "Site successfully deleted!");
	//Site successfully added!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2", "Site successfully added!");
	//An email notification will be sent to the eDirectory support team, please wait our contact.
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD", LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2."<br />An email notification will be sent to the eDirectory support team, please wait our contact.");
    //Site name is required
	define("LANG_MSG_DOMAINNAME_IS_REQUIRED", "Site name is required");
    //Site URL is required
	define("LANG_MSG_DOMAINURL_IS_REQUIRED", "Site URL is required");
	//Site name already exists
	define("LANG_MSG_DOMAINNAME_ALREADY_EXISTS", "Site name already exists");
	//Site URL already exists
	define("LANG_MSG_DOMAINURL_ALREADY_EXISTS", "Site URL already exists");
	//Site URL not valid
	define("LANG_MSG_DOMAINURL_INVALID_CHARS", "Site URL not valid");
	//Site Items
	define("LANG_SITE_ITEMS", "Site Items");
	//Select a Site
    define("LANG_SELECT_DOMAIN", "Change Site");

	# ----------------------------------------------------------------------------------------------------
	# PROFILE
	# ----------------------------------------------------------------------------------------------------
    //Sign Up with a new Account
    define("LANG_LABEL_PROFILE_SIGNUP", "Sign Up with a new Account");
    //OR
    define("LANG_LABEL_PROFILE_OR", "OR");
    //Sign In with an existing account
    define("LANG_LABEL_PROFILE_FOREIGNACC", "Sign In with an existing account");
    //Or use your OpenID to sign in
    define("LANG_LABEL_PROFILE_OPENID", "Or use your OpenID to sign in");
    //Your OpenID
    define("LANG_LABEL_PROFILE_YOUROPENID", "Your OpenID");
    //Login
    define("LANG_LABEL_PROFILE_LOGIN", "Login");
    //Once you have created your account using a foreign system, it was activated automatically. Please disregard this message.
    define("LANG_LABEL_PROFILE_ACTIVATED", "Once you have created your account using a foreign system, it was activated automatically. Please disregard this message.");
	//Thank you for activating your account. The next step is to complete your profile.
    define("LANG_LABEL_PROFILE_WELCOME_ACT", "Thank you for activating your account. The next step is to complete your profile.");
    //Your account has not been activated yet. Check your activation e-mail and come back later to complete your profile.
    define("LANG_LABEL_PROFILE_WELCOME_NOTACT", "Your account has not been activated yet. Check your activation e-mail and come back later to complete your profile.");
    //Complete your profile
    define("LANG_LABEL_PROFILE_COMPLETE", "Complete your profile");
    //RECENT ACTIVITY
    define("LANG_LABEL_PROFILE_RECENT_ACTIVITY", "RECENT ACTIVITY");
    //You have no recent activity.
    define("LANG_LABEL_PROFILE_RECENT_ACTIVITY_EMPTY", "You have no recent activity.");
    //Review on
    define("LANG_LABEL_PROFILE_REVIEWON", "Review on");
    //You can connect your directory account with social networks
    define("LANG_LABEL_PROFILE_SNTIP", "You can connect your directory account with social networks");
    //Change photo
    define("LANG_LABEL_PROFILE_CHANGEPHOTO", "Change photo");
    //Remove photo
    define("LANG_LABEL_PROFILE_REMOVEPHOTO", "Remove photo");
    //Display Name
    define("LANG_LABEL_PROFILE_DISPLAYNAME", "Display Name");
    //Personal Page
    define("LANG_LABEL_PROFILE_PERSONALPAGE", "Personal Page");
    //Account Username
    define("LANG_LABEL_ACCOUNT_USERNAME", "Account Username");
    //You can change your e-mail access at any time. This is also the contact e-mail we use to reach you.
    define("LANG_LABEL_ACCOUNT_USERNAME_TIP", "You can change your e-mail access at any time. This is also the contact e-mail we use to reach you.");
    //Activated
    define("LANG_LABEL_ACCOUNT_ACT", "Activated");
    //Account not activated.
    define("LANG_LABEL_ACCOUNT_NOTACT", "Account not activated.");
    //Activate account.
    define("LANG_LABEL_ACTIVATE_ACC", "Activate account.");
    //Your activation e-mail has been sent. Please, check your inbox.
    define("LANG_LABEL_ACTIVATEEMAIL_SENT", "Your activation e-mail has been sent. Please, check your inbox.");
    //There was an error trying to send you a new activation e-mail.
    define("LANG_LABEL_ACTIVATEEMAIL_SENT_ERROR", "There was an error trying to send you a new activation e-mail.");
    //get a new activation e-mail.
    define("LANG_LABEL_ACTIVATEEMAIL_GETNEW", "get a new activation e-mail.");
    //Change Password
    define("LANG_LABEL_ACCOUNT_CHANGEPASS", "Change Password");
    //You can change your password at any time you want.
    define("LANG_LABEL_ACCOUNT_CHANGEPASS_TIP", "You can change your password at any time you want.");
    //This information will be hidden unless you click the publish checkbox below
    define("LANG_LABEL_ACCOUNT_CONTACT_TIP", "This information will be hidden unless you click the publish checkbox below");
    //Settings
    define("LANG_LABEL_CONTACT_SETTINGS", "Settings");
    //Check your preferences
    define("LANG_LABEL_CONTACT_SETTINGS_TIP", "Check your preferences");
    //Profile Options
    define("LANG_MENU_PROFILEOPTIONS", "Profile Options");
    //Profile Information
	define("LANG_LABEL_PROFILE_INFORMATION", "Profile Information");
	//Social Networking
	define("LANG_LABEL_FOREIGN_ACCOUNTS", "Social Networking");
	//Link and import informations
	define("LANG_LABEL_CONNECT_WITH_FB_AND_IMPORT", "Link and import informations");
	//Just link
	define("LANG_LABEL_CONNECT_WITH_FB", "Just link");
	//Link my Facebook account
	define("LANG_LABEL_LINK_FACEBOOK", "Link my Facebook account");
	//Unlink my Facebook account
	define("LANG_LABEL_UNLINK_FB", "Unlink my Facebook account");
	//Your account was unlinked from Facebook
	define("LANG_LABEL_FB_ACT_DISC", "Your account was unlinked from Facebook");
	//Your Facebook account is already linked with other account in the system.
	define("LANG_FB_ALREADY_LINKED", "Your Facebook account is already linked with other account in the system.");
	//Your Twitter account is already linked with other account in the system.
	define("LANG_TW_ALREADY_LINKED", "Your Twitter account is already linked with other account in the system.");
	//Linked to twitter as
	define("LANG_MSG_LINKED_TW_AS", "Linked to Twitter as");
	//Connected as
	define("LANG_LABEL_CONECTED_AS", "Connected as");
	//Location options
	define("LANG_LABEL_LOCATIONPREF", "Location Preferences");
	//Choose your location preferences in order to auto fill your searches by location
	define("LANG_LABEL_CHOOSELOCATIONPREF", "Choose your location preferences in order to auto fill your searches by location");
	//Use your current location
	define("LANG_LABEL_USECURRENTLOCATION", "Use your current location");
	//Use Facebook Location
	define("LANG_LABEL_USEFACEBOOKLOCATION", "Use Facebook Location");
	//Connect to Facebook
	define("LANG_LABEL_CONECTED_TO_FB", "Connect to Facebook");
	//Facebook account
	define("LANG_LABEL_FACEBOOK_ACCT", "Facebook account");
	//Google account
	define("LANG_LABEL_GOOGLE_ACCT", "Google account");
	//Change account
	define("LANG_LABEL_CHANGE_ACCT", "Change account");
	//Twitter account
	define("LANG_LABEL_FB_ACCT", "Twitter account");
	//Twitter connection
	define("LANG_LABEL_TW_CONN", "Twitter connection");
	//Link my Twitter account
	define("LANG_LABEL_TW_LINK", "Link my Twitter account");
	//Unlink my Twitter account
	define("LANG_LABEL_UNLINK_TW", "Unlink my Twitter account");
	//Post redeems on my twitter account automatically
	define("LANG_LABEL_POSTRED", "Post redeems on my Twitter account automatically");
	//Your account was unlinked from twitter
	define("LANG_LABEL_TW_ACT_DISC", "Your account was unlinked from Twitter");
	//You must sign in through twitter first
	define("LANG_LABEL_TW_SIGNTW", "You must sign in through Twitter first");
	//Your Twitter account was successfully connected
	define("LANG_LABEL_TW_SIGNTW_CONN", "Your Twitter account was successfully connected");
	//Your Facebook account was successfully connected
	define("LANG_LABEL_FB_SIGNFB_CONN", "Your Facebook account was successfully connected");
	//Your are already logged Facebook account as
	define("LANG_LABEL_FB_ALREADYLOGGED", "Your are already logged Facebook account as");
	//This user is already attached to another directory account.
	define("LANG_LABEL_FB_ALREADYATTACHED", "This user is already attached to another directory account.");
	//Click here to switch to this account
	define("LANG_LABEL_FB_CLICKHERETOSWITCH", "Click here to switch to this account");
	//Connect to Facebook
	define("LANG_LABEL_CONN_FB", "Connect to Facebook");
	//Use this language upon each sign in to my account
	define("LANG_LABEL_USE_SELECTEDLANGUAGE", "Use this language upon each sign in to my account");
    //View my profile page
    define("LANG_LABEL_VIEW_PROFILE", "View my profile page");

	# ----------------------------------------------------------------------------------------------------
	# DEALS
	# ----------------------------------------------------------------------------------------------------
	//I just got a great deal
	define("DEAL_LIKEDTHIS", "I just got a great ".PROMOTION_FEATURE_NAME);
	//Redeem
	define("DEAL_REDEEM", "Redeem");
	//Redeem this deal
	define("DEAL_REDEEMTHIS", "Redeem this ".PROMOTION_FEATURE_NAME);
	//To redeem you need to post this deal information on your Facebook or Twitter.
	define("DEAL_REDEEMINFO1", "To redeem you need to post this ".PROMOTION_FEATURE_NAME." information on your Facebook or Twitter.");
	//You can set this button to automatic post on your Profile.
	define("DEAL_REDEEMINFO2", "You can set this button to automatic post on your Profile.");
	//Click here to configure it
	define("DEAL_CLICKHERETO", "Click here to configure it.");
	//Please wait, posting on Facebook and Twitter (if available).
	define("DEAL_PLEASEWAIT_POSTING", "Please wait, posting to Facebook and Twitter (if available).");
	//You already redeemed this deal! Your code is
	define("DEAL_YOUALREADY", "You already redeemed this ".PROMOTION_FEATURE_NAME."! Your code is");
	//Deal done! This is your redeem code
	define("DEAL_DEALDONE", string_ucwords(PROMOTION_FEATURE_NAME)." done! This is your code");
	//No one has redeemed this deal on Facebook yet.
	define("DEAL_REDEEM_NONE_FB", "No one has redeemed this ".PROMOTION_FEATURE_NAME." on Facebook yet.");
	//No one has redeemed this deal on Twitter yet.
	define("DEAL_REDEEM_NONE_TW", "No one has redeemed this ".PROMOTION_FEATURE_NAME." on Twitter yet.");
	//Recent done deals
	define("DEAL_RECENTDEALS", "Recent done deals");
	//No deals found!
	define("DEAL_DIDNTNOTFINISHED", "No deals found!");
	//This deal is not available anymore.
	define("DEAL_NA", "This ".PROMOTION_FEATURE_NAME." is not available anymore.");
	//To redeem this deal you need to post to your Facebook wall. First, sign using the Facebook login button and you will need to approve this Application to do it.
	define("DEAL_REDEEMINFO_1", "To redeem this ".PROMOTION_FEATURE_NAME." you need to post to your Facebook wall. First, sign using the Facebook login button and you will need to approve this Application to do it.");
	//You already did this deal!
	define("DEAL_REDEEM_DONEALREADY", "You already did this ".PROMOTION_FEATURE_NAME."!");
	//Sorry, there was an error trying to post on your Facebook wall. Please try again.
	define("DEAL_REDEEMINFO_2", "Sorry, there was an error trying to post on your Facebook wall. Please try again.");
	//Value
	define("DEAL_VALUE", "Value");
	//With this coupon
	define("DEAL_WITHTHISCOUPON", "With this coupon");
	//Thank you
	define("DEAL_THANKYOU", "Thank you");
	//Original value
	define("DEAL_ORIGINALVALUE", "Original value");
	//Amount paid
	define("DEAL_AMOUNTPAID", "This ".PROMOTION_FEATURE_NAME." value");
	//Valid until
	define("DEAL_VALIDUNTIL", "Valid until");
	//Coupon must be presented to receive discount
	define("DEAL_INFODETAILS1", "Coupon must be presented to receive discount");
	//Limit of 1 coupon per purchase
	define("DEAL_INFODETAILS2", "Limit of 1 coupon per purchase");
	//Not valid with other coupons, offers or discounts of any kind
	define("DEAL_INFODETAILS3", "Not valid with other coupons, offers or discounts of any kind");
	//Valid only for Listing Name - Address
	define("DEAL_INFODETAILS4", "Valid only for ".string_ucwords(LISTING_FEATURE_NAME)." Name - Address");
	//Print deal
	define("DEAL_PRINTDEAL", "Print ".string_ucwords(PROMOTION_FEATURE_NAME));
	//deal done
	define("DEAL_DEALSDONE", string_ucwords(PROMOTION_FEATURE_NAME)." Done");
	//deals done
	define("DEAL_DEALSDONE_PLURAL", string_ucwords(PROMOTION_FEATURE_NAME_PLURAL)." Done");
	//Deals redeemed
	define("LANG_LABEL_DEAL_BOUGHT", string_ucwords(PROMOTION_FEATURE_NAME_PLURAL)." redeemed");
	//Deals left
	define("LANG_LABEL_DEAL_LEFT", string_ucwords(PROMOTION_FEATURE_NAME_PLURAL)." left");
	//Left
	define("DEAL_LEFTAMOUNT", "Left");
	//Sold Out
	define("DEAL_SOLDOUT", "Sold Out");
	//Sorry, this deal doesn't exist or it was removed by owner
	define("DEAL_DOESNTEXIST", "Sorry, this ".PROMOTION_FEATURE_NAME." doesn't exist or it was removed by owner");
	//at
	define("DEAL_AT", "at");
	//Friendly URL
	define("DEAL_FRIENDLYURL", "Friendly URL");
	//Select a listing
	define("DEAL_SELECTLISTING", "Select a ".LISTING_FEATURE_NAME);
	//Tagline for Deals
	define("DEAL_TAG", "Tagline for ".string_ucwords(PROMOTION_FEATURE_NAME_PLURAL));
	//Visibility
	define("LANG_SITEMGR_VISIBILITY", "Visibility");
	//This deal will show up on
	define("LANG_SITEMGR_DEALSHOWUP", "This ".PROMOTION_FEATURE_NAME." will show up on");
	//searches and nearby feature
	define("LANG_SITEMGR_DEALSEARCHES_NEARBY", "searches and nearby feature");
	//Nearby
	define("LANG_LABEL_NEARBY", "Nearby");
	//About Us
	define("LANG_MENU_ABOUT", "About Us");
	//My Favorites
	define("LANG_MENU_FAVORITES", "My Favorites");
	//My Deals
	define("LANG_MENU_MYDEALS", "My Deals");
	//My Reviews
	define("LANG_MENU_MYREVIEWS", "My Reviews");
	//My Account
	define("LANG_MENU_ACCOUNT", "My Account");
	//24 hours / day
	define("LANG_SITEMGR_TWFOURHOURSDAY", "24 hours / day");
	//Custom range
	define("LANG_SITEMGR_CUSTOMRANGE", "Custom range");
	//Discount information
	define("LANG_SITEMGR_DISCINFO", "Discount information");
	//Item Value
	define("LANG_SITEMGR_ITEMVALUE", "Item Value");
	//Discount
	define("LANG_SITEMGR_DISCOUNT", "Discount");
	//Value with discount
	define("LANG_DEAL_WITH_DISCOUNT", "Value with discount");
	//Amount of deals
	define("LANG_SITEMGR_AMOUNTOFDEALS", "Amount of ".PROMOTION_FEATURE_NAME_PLURAL);
	//deal done until now
	define("LANG_SITEMGR_DONEUNTIL_SINGULAR", PROMOTION_FEATURE_NAME." done until now");
    //deals done until now
	define("LANG_SITEMGR_DONEUNTIL_PLURAL", PROMOTION_FEATURE_NAME_PLURAL." done until now");
	//left
	define("LANG_SITEMGR_LEFT", "left");
    //OFF
    define("LANG_DEAL_OFF", "OFF");
    //Please wait, loading...
    define("LANG_DEAL_PLEASEWAITLOADING", "Please wait, loading...");
    //Please wait. We are redirecting your login to complete this step...
    define("LANG_DEAL_PLEASEWAITLOADING2", "Please wait. We are redirecting your login to complete this step...");
    //Item Value is required.
    define("LANG_MSG_VALIDDEAL_REALVALUE", "Item Value is required.");
    //Value with Discount is required.
    define("LANG_MSG_VALIDDEAL_DEALVALUE", LANG_LABEL_DISC_AMOUNT." is required.");
	//Value with Discount can not be higher than 99.
    define("LANG_MSG_VALIDDEAL_DEALVALUE2", LANG_LABEL_DISC_AMOUNT." can not be higher than 99.");
    //Deals to offer is required.
    define("LANG_MSG_VALIDDEAL_AMOUNT", string_ucwords(PROMOTION_FEATURE_NAME_PLURAL)." to offer is required.");
    //Please enter a minor value on Value with Discount field.
    define("LANG_MSG_VALID_MINOR", "Please enter a minor value on ".LANG_LABEL_DISC_AMOUNT." field.");
    //Redemeed at
    define("LANG_DEAL_REMEEDED_AT", "Redemeed at");
    //You can only directly link this deal to a listing if you select one account first
    define("DEAL_LINK2LISTING_ACCTINFO", "You can only directly link this ".PROMOTION_FEATURE_NAME." to a ".LISTING_FEATURE_NAME." if you select an account first");
    //Value
    define("DEAL_VALUE", "Value");
    //With discount
    define("DEAL_WITHCOUPON", "With discount");
    //Redeem by e-mail
    define("DEAL_REDEEMBYEMAIL", "Redeem by e-mail");
    //Sign In and Redeem
    define("DEAL_CONNECT_REDEEM", "Sign In and Redeem");
	//Redeem and Print
	define("LANG_LABEL_REDEEM_PRINT", "Redeem and Print");
    //Redeem and Share
    define("DEAL_REDEEMSHARE", "Redeem and Share");
    //Featured Deals
    define("DEAL_FEATURED_DEALS", "Featured ".string_ucwords(PROMOTION_FEATURE_NAME_PLURAL));
    //Sign in using your Facebook session
    define("LOGIN_FB_CURRENT_SESSION", "Sign in using your Facebook");
    //To Redeem using Facebook you need to connect using your Facebook account
    define("LANG_DEAL_DISCONNECTED_NOFB", "To Redeem using Facebook you need to connect using your Facebook account.");
    //Redeem Statistics
    define("LANG_LABEL_REDEEM_STATISTICS", "Redeem Statistics");
    //Redeem code
    define("DEAL_SITEMGR_REDEEMCODE", "Redeem code");
    //Available
    define("DEAL_SITEMGR_AVAILABLE", "Available");
    //Used
    define("DEAL_SITEMGR_USED", "Used");
    //Redeem using your current Facebook session.
    define("DEAL_REDEEMINFO_3", "Redeem using your current Facebook session");
    //Use
    define("DEAL_SITEMGR_USE", "Use");
	//Saving...
	define("LANG_DEAL_SAVING", "Saving...");
	//No redeem found
	define("LANG_DEAL_NO_RECORD", "No redeem found.");
	//percentage
	define("LANG_LABEL_PERCENTAGE", "percentage");
	//fixed value
	define("LANG_LABEL_FIXEDVALUE", "fixed value");

	# ----------------------------------------------------------------------------------------------------
	# IMPORT
	# ----------------------------------------------------------------------------------------------------
	//line
	define("LANG_MSG_IMPORT_ERROR_LINE", "line");
	//Error importing to temporary table.
	define("LANG_MSG_IMPORT_ERRORONIMPORTTOTEMPABLE", "Error importing to temporary table.");
	//Invalid renewal date - line
	define("LANG_MSG_IMPORT_INVALIDRENEWALDATE", "Invalid renewal date - line");
	//Invalid updated date - line
	define("LANG_MSG_IMPORT_INVALIDUPDATEDATE", "Invalid updated date - line");
	//CSV file imported to temporary table.
	define("LANG_MSG_IMPORT_CSVIMPORTEDTOTEMPORARYTABLE", "CSV file imported to temporary table.");
	//Invalid e-mail - line
	define("LANG_MSG_IMPORT_INVALIDUSERNAMELINE", "Invalid e-mail - line");
	//Invalid password - line
	define("LANG_MSG_IMPORT_INVALIDPASSWORDLINE", "Invalid password - line");
	//Invalid keyword (maximum 10 keywords) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS", "Invalid keyword (maximum ".MAX_KEYWORDS." keywords) - line");
	//Invalid keyword (keywords with a maximum of 50 characters each.) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS2", "Invalid keyword (".LANG_MSG_KEYWORDS_WITH_MAXIMUM_50.") - line");
	//Invalid title - line
	define("LANG_MSG_IMPORT_INVALIDTITLELINE", "Invalid title - line");
	//Invalid start date - line
	define("LANG_MSG_IMPORT_INVALIDSTARTDATE", "Invalid start date - line");
	//Invalid end date - line
	define("LANG_MSG_IMPORT_INVALIDENDDATE", "Invalid end date - line");
	//Start date must be filled - line
	define("LANG_MSG_IMPORT_STARTDATEEMPTY", "Start date must be filled - line");
	//End date must be filled - line
	define("LANG_MSG_IMPORT_ENDDATEEMPTY", "End date must be filled - line");
	//The "End Date" must be greater than or equal to the "Start Date" - line
	define("LANG_MSG_IMPORT_END_DATE_GREATER_THAN_START_DATE", str_replace(".", "", LANG_MSG_END_DATE_GREATER_THAN_START_DATE)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//The "End Date" cannot be in past - line
	define("LANG_MSG_IMPORT_END_DATE_CANNOT_IN_PAST", str_replace(".", "", LANG_MSG_END_DATE_CANNOT_IN_PAST)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Invalid start time - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_NUMBER", "Invalid start time - line");
	//Invalid end time - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_NUMBER", "Invalid end time - line");
	//Invalid start time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_FORMAT", "Invalid start time format. Must be \"xx:xx\" - line");
	//Invalid end time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_FORMAT", "Invalid end time format. Must be \"xx:xx\" - line");
	//Invalid start time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE1", "Invalid start time mode. Must be \"AM\" or \"PM\" - line");
	//Invalid end time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE1", "Invalid end time mode. Must be \"AM\" or \"PM\" - line");
	//Invalid start time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE2", "Invalid start time mode. Must be \"24\" - line");
	//Invalid end time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE2", "Invalid end time mode. Must be \"24\" - line");
	//The "End Time" must be greater than the "Start Time" - line
	define("LANG_MSG_IMPORT_END_TIME_GREATER_THAN_START_TIME", str_replace(".", "", LANG_MSG_END_TIME_GREATER_THAN_START_TIME)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Location and system default location are differents - line
	define("LANG_MSG_IMPORT_INVALIDLOCATIONLINE", "Location and system default location are differents - line");
	//Invalid latitude. Must be numeric between -90 and 90 - line
	define("LANG_MSG_IMPORT_INVALIDLATITUDELINE", "Invalid latitude. Must be numeric between -90 and 90 - line");
	//Invalid longitude. Must be numeric between -180 and 180 - line
	define("LANG_MSG_IMPORT_INVALIDLONGITUDELINE", "Invalid longitude. Must be numeric between -180 and 180 - line");
	//No CSV Files in Import Folder.
	define("LANG_MSG_IMPORT_NOFILES_INFTP", "No CSV Files in Import Folder.");
	//The number of columns in the following line(s) are wrong:
	define("LANG_MSG_IMPORT_NUMBEROFCOLUMNSAREWRONG", "The number of columns in the following line(s) are wrong:");
	//Total lines read:
	define("LANG_MSG_IMPORT_TOTALLINESREADY", "Total lines read:");
	//Total error lines:
	define("LANG_MSG_IMPORT_TOTALLINESERROR", "Total error lines:");
	//CSV header does not match - it has more fields that it is allowed
	define("LANG_MSG_IMPORT_WRONG_HEADER", "CSV header does not match - it has more fields that it is allowed");
	//CSV header does not match at field(s):
	define("LANG_MSG_IMPORT_WRONG_HEADER2", "CSV header does not match at field(s): ");
	//account rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK", "account rolled back");
	//accounts rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK_PLURAL", "accounts rolled back");
	//item rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK", "item rolled back");
	//items rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK_PLURAL", "items rolled back");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	//Find what you are Looking for...
	define("LANG_SEARCH_MESSAGE_TITLE", "Find what you are Looking for...");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword.
	define("LANG_SEARCH_MESSAGE_TEXT", "Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword.");

	# ----------------------------------------------------------------------------------------------------
	# PAGING
	# ----------------------------------------------------------------------------------------------------
	//Results per page
	define("LANG_PAGING_RESULTS_PER_PAGE", "Results per page");
	//Per Page
	define("LANG_PAGING_PER_PAGE", "Per Page");
	//Showing results
	define("LANG_PAGING_SHOWING_RESULTS", "Showing results");
    //Showing
	define("LANG_PAGING_SHOWING", "Showing");
	//to
	define("LANG_PAGING_SHOWING_TO", "to");
	//of
	define("LANG_PAGING_SHOWING_OF", "of");
	//Pages
	define("LANG_PAGING_SHOWING_PAGE", "Pages");

	# ----------------------------------------------------------------------------------------------------
	# SUGARCRM
	# ----------------------------------------------------------------------------------------------------
	//Importing [SUGAR_ITEM_TITLE] from SugarCRM to [EDIRECTORY_TITLE]
	define("LANG_IMPORT_ITEM_FROM_SUGAR", "Importing [SUGAR_ITEM_TITLE] from SugarCRM to [EDIRECTORY_TITLE]");
	//Use the form above to import from the SugarCRM record [SUGAR_ITEM_TITLE], after clicking import your data will be transferred to your directory installation with all relevant information passed across, just fill in the extra data, and payment data.
	define("LANG_MESSAGE_ON_FOOTER", "Use the form above to import from the SugarCRM record [SUGAR_ITEM_TITLE], after clicking import your data will be transferred to your directory installation with all relevant information passed across, just fill in the extra data, and payment data.");
	//You're nearly done.
	define("LANG_YOU_NEARLY_DONE", "You're nearly done.");
	//It was not possible to export. Please check your SugarCRM connection information on your directory.
	define("LANG_SUGAR_CHECKINFO", "It was not possible to export. Please check your SugarCRM connection information on your directory.");
	//Wrong eDirectory Key.
	define("LANG_SUGAR_WRONG_KEY", "Wrong eDirectory Key.");

	# ----------------------------------------------------------------------------------------------------
	# ADVERTISE
	# ----------------------------------------------------------------------------------------------------
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_TITLE", LANG_LISTING_TITLE);
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_OWNER", string_ucwords(LISTING_FEATURE_NAME)." Owner");
	//10% Off - Deal Title
	define("LANG_LABEL_ADVERTISE_DEAL_TITLE", "10% Off - ".LANG_PROMOTION_TITLE);
	//Review Title
	define("LANG_LABEL_ADVERTISE_REVIEW_TITLE", "Review Title");
	//Event Title
	define("LANG_LABEL_ADVERTISE_EVENT_TITLE", LANG_EVENT_TITLE);
	//Event Owner
	define("LANG_LABEL_ADVERTISE_EVENT_OWNER", string_ucwords(EVENT_FEATURE_NAME)." Owner");
	//Classified Title
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_TITLE", LANG_CLASSIFIED_TITLE);
	//Classified Owner
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_OWNER", string_ucwords(CLASSIFIED_FEATURE_NAME)." Owner");
	//Article Title
	define("LANG_LABEL_ADVERTISE_ARTICLE_TITLE", LANG_ARTICLE_TITLE);
	//Article Author
	define("LANG_LABEL_ADVERTISE_ARTICLE_AUTHOR",  string_ucwords(ARTICLE_FEATURE_NAME)." Author");
	//Contact Name
	define("LANG_LABEL_ADVERTISE_ITEM_CONTACT", LANG_LABEL_CONTACTNAME);
	//Zipcode
	define("LANG_LABEL_ADVERTISE_ITEM_ZIPCODE", ZIPCODE_LABEL);
	//www.yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_SITE", "www.yoursite.com");
	//youremail@yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_EMAIL", "youremail@yoursite.com");
	//Address
	define("LANG_LABEL_ADVERTISE_ITEM_ADDRESS", LANG_LABEL_ADDRESS);
	//Card holder name
	define("LANG_LABEL_CARDHOLDER_NAME", "Card holder name");
	//Charge for
	define("LANG_CHARGEFOR", "Charge for");
	//Visitor
	define("LANG_LABEL_ADVERTISE_VISITOR", "Visitor");
	//Category
	define("LANG_LABEL_ADVERTISE_CATEGORY", "Category");
	//Category 1
	define("LANG_LABEL_ADVERTISE_CATEGORY1", "Category 1");
	//Category 1.1
	define("LANG_LABEL_ADVERTISE_CATEGORY1_2", "Category 1.1");
	//Category 2
	define("LANG_LABEL_ADVERTISE_CATEGORY2", "Category 2");
	//Category 2.2
	define("LANG_LABEL_ADVERTISE_CATEGORY2_2", "Category 2.2");
	//Summary View
	define("LANG_LABEL_ADVERTISE_SUMMARYVIEW", "Summary View");
	//Detail View
	define("LANG_LABEL_ADVERTISE_DETAILVIEW", "Detail View");
	//This content is illustrative
	define("LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE", "This content is illustrative");

	# ----------------------------------------------------------------------------------------------------
	# TWILIO
	# ----------------------------------------------------------------------------------------------------
	//Activate Click-to-Call
	define("LANG_LABEL_ACTIVATECLICKCALL", "Activate Click-to-Call");
	//Send to Phone
	define("LANG_LABEL_SENDPHONE", "Send to Phone");
	//Click to Call
	define("LANG_LABEL_CLICKTOCALL", "Click to Call");
	//Message successfully sent!
	define("LANG_LABEL_SMS_SENT", "Message successfully sent!");
	//Send info about this listing to a phone.
	define("LANG_LISTING_TOPHONE_SAUDATION", "Send info about this ".LISTING_FEATURE_NAME." to a phone.");
	//Enter your phone to call the listing owner with no costs.
	define("LANG_LISTING_CLICKTOCALL_SAUDATION", "Enter your phone to call the ".LISTING_FEATURE_NAME." owner with no costs.");
	//Phone is required.
	define("LANG_PHONE_REQUIRED", "Phone is required.");
	//Please, type a valid phone number.
	define("LANG_PHONE_INVALID", "Please, type a valid phone number.");
	//Call
	define("LANG_TWILIO_CALL", "Call");
	//Calling
	define("LANG_TWILIO_CALLING", "Calling");
	//Phone
	define("LANG_CLICKTOCALL_PHONE", "Phone");
	//Extension
	define("LANG_CLICKTOCALL_EXTENSION", "Extension");
	//Activate
	define("LANG_CLICKTOCALL_ACTIVATE", "Activate");
	//Enter this code in your phone keypad when the test call connects:
	define("LANG_CLICKTOCALL_YOUR_VALIDATION_CODE", "Enter this code in your phone keypad when the test call connects:");
	//Your phone number was activated!
	define("LANG_CLICKTOCALL_STATUS_ACTIVATED", "Your phone number was activated!");
	//Phone number successfully deleted!
	define("LANG_CLICKTOCALL_PHONE_DELETED", "Phone number successfully deleted!");
	//Click to Call not available for this listing
	define("LANG_MSG_CLICKTOCALL_NOT_AVAILABLE", "Click to Call not available for this ".LISTING_FEATURE_NAME);
	//Activate Click-to-Call and Get More Contacts
	define("LANG_CLICKTOCALL_TIPTITLE", "Activate Click-to-Call and Get More Contacts");
	//You need to activate the phone number below in order to allow the users to contact you directly through the directory.
	define("LANG_CLICKTOCALL_TIP1", "You need to activate the phone number below in order to allow the users to contact you directly through the directory.");
	//Click-to-call allows clients to connect a call between your phone and theirs with the click of a button.  To activate, press the button below and a test call will be made.
	define("LANG_CLICKTOCALL_TIP2", "Click-to-call allows clients to connect a call between your phone and theirs with the click of a button. To activate, press the button below and a test call will be made.");
	//A message with your activation code will be shown. Take note of this code and wait for the activation phone call.
	define("LANG_CLICKTOCALL_TIP3", "A message with your activation code will be shown. Take note of this code and wait for the activation phone call.");
	//You will be ask to enter the six digits activation code. Enter the code and wait for the confirmation message.
	define("LANG_CLICKTOCALL_TIP4", "You will be ask to enter the six digits activation code. Enter the code and wait for the confirmation message.");
	//After activate your phone number, click in Save Number to finish the process.
	define("LANG_CLICKTOCALL_TIP5", "After activate your phone number, click in Save to finish the process.");
	//For numbers outside the USA, you need to put your country code first.
	define("LANG_CLICKTOCALL_TIP6", "For numbers outside the USA, you need to put your country code first.");
	//For numbers outside the USA, the country code must be included.
	define("LANG_CLICKTOCALL_TIP7", "For numbers outside the USA, the country code must be included.");
	//"Click to Call" report
	define("LANG_CLICKTOCALL_REPORT", "\"Click to Call\" report");
	//Direction
	define("LANG_CLICKTOCALL_REPORT_DIRECTION", "Direction");
	//To
	define("LANG_CLICKTOCALL_REPORT_FROM", "From");
	//Start Time
	define("LANG_CLICKTOCALL_REPORT_START_TIME", "Start Time");
	//End Time
	define("LANG_CLICKTOCALL_REPORT_END_TIME", "End Time");
	//Duration (seconds)
	define("LANG_CLICKTOCALL_REPORT_DURATION", "Duration (seconds)");
	//No reports available.
	define("LANG_CLICKTOCALL_REPORT_NORECORD", "No reports available.");
	//Activated by
	define("LANG_LABEL_ACTIVATED_BY", "Activated by");
	//Activation failed. Please, try again.
	define("LANG_TWILIO_ERROR_10000", "Activation failed. Please, try again.");
	//Account is not active.
	define("LANG_TWILIO_ERROR_10001", "Account is not active.");
	//Trial account does not support this feature.
    define("LANG_TWILIO_ERROR_10002", "Trial account does not support this feature.");
	//Incoming call rejected due to inactive account.
    define("LANG_TWILIO_ERROR_10003", "Incoming call rejected due to inactive account.");
	//Invalid URL format.
    define("LANG_TWILIO_ERROR_11100", "Invalid URL format.");
	//HTTP retrieval failure.
    define("LANG_TWILIO_ERROR_11200", "HTTP retrieval failure.");
	//HTTP connection failure.
    define("LANG_TWILIO_ERROR_11205", "HTTP connection failure.");
	//HTTP protocol violation.
    define("LANG_TWILIO_ERROR_11206", "HTTP protocol violation.");
	//HTTP bad host name.
    define("LANG_TWILIO_ERROR_11210", "HTTP bad host name.");
	//HTTP too many redirects.
    define("LANG_TWILIO_ERROR_11215", "HTTP too many redirects.");
	//Document parse failure.
    define("LANG_TWILIO_ERROR_12100", "Document parse failure.");
	//Invalid Twilio Markup XML version.
    define("LANG_TWILIO_ERROR_12101", "Invalid Twilio Markup XML version.");
	//The root element must be Response.
    define("LANG_TWILIO_ERROR_12102", "The root element must be Response.");
	//Schema validation warning.
    define("LANG_TWILIO_ERROR_12200", "Schema validation warning.");
	//Invalid Content-Type.
    define("LANG_TWILIO_ERROR_12300", "Invalid Content-Type.");
	//Internal Failure.
    define("LANG_TWILIO_ERROR_12400", "Internal Failure.");
	//Dial: Cannot Dial out from a Dial Call Segment.
    define("LANG_TWILIO_ERROR_13201", "Dial: Cannot Dial out from a Dial Call Segment.");
	//Dial: Invalid method value.
    define("LANG_TWILIO_ERROR_13210", "Dial: Invalid method value.");
	//Dial: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13212", "Dial: Invalid timeout value.");
	//Dial: Invalid hangupOnStar value.
    define("LANG_TWILIO_ERROR_13213", "Dial: Invalid hangupOnStar value.");
	//Dial: Invalid callerId value.
    define("LANG_TWILIO_ERROR_13214", "Dial: Invalid callerId value.");
	//Dial: Invalid nested element.
    define("LANG_TWILIO_ERROR_13215", "Dial: Invalid nested element.");
	//Dial: Invalid timeLimit value.
    define("LANG_TWILIO_ERROR_13216", "Dial: Invalid timeLimit value.");
	//Dial->Number: Invalid method value.
    define("LANG_TWILIO_ERROR_13221", "Dial->Number: Invalid method value.");
	//Dial->Number: Invalid sendDigits value.
    define("LANG_TWILIO_ERROR_13222", "Dial->Number: Invalid sendDigits value.");
	//Dial: Invalid phone number format.
    define("LANG_TWILIO_ERROR_13223", "Dial: Invalid phone number format.");
	//Dial: Invalid phone number.
    define("LANG_TWILIO_ERROR_13224", "Dial: Invalid phone number.");
	//Dial: Forbidden phone number.
    define("LANG_TWILIO_ERROR_13225", "Dial: Forbidden phone number.");
	//Dial->Conference: Invalid muted value.
    define("LANG_TWILIO_ERROR_13230", "Dial->Conference: Invalid muted value.");
	//Dial->Conference: Invalid endConferenceOnExit value.
    define("LANG_TWILIO_ERROR_13231", "Dial->Conference: Invalid endConferenceOnExit value.");
	//Dial->Conference: Invalid startConferenceOnEnter value.
    define("LANG_TWILIO_ERROR_13232", "Dial->Conference: Invalid startConferenceOnEnter value.");
	//Dial->Conference: Invalid waitUrl.
    define("LANG_TWILIO_ERROR_13233", "Dial->Conference: Invalid waitUrl.");
	//Dial->Conference: Invalid waitMethod.
    define("LANG_TWILIO_ERROR_13234", "Dial->Conference: Invalid waitMethod.");
	//Dial->Conference: Invalid beep value.
    define("LANG_TWILIO_ERROR_13235", "Dial->Conference: Invalid beep value.");
	//Dial->Conference: Invalid Conference Sid.
    define("LANG_TWILIO_ERROR_13236", "Dial->Conference: Invalid Conference Sid.");
	//Dial->Conference: Invalid Conference Name.
    define("LANG_TWILIO_ERROR_13237", "Dial->Conference: Invalid Conference Name.");
	//Dial->Conference: Invalid Verb used in waitUrl TwiML.
    define("LANG_TWILIO_ERROR_13238", "Dial->Conference: Invalid Verb used in waitUrl TwiML.");
	//Gather: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13310", "Gather: Invalid finishOnKey value.");
	//Gather: Invalid method value.
    define("LANG_TWILIO_ERROR_13312", "Gather: Invalid method value.");
	//Gather: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13313", "Gather: Invalid timeout value.");
	//Gather: Invalid numDigits value.
    define("LANG_TWILIO_ERROR_13314", "Gather: Invalid numDigits value.");
	//Gather: Invalid nested verb.
    define("LANG_TWILIO_ERROR_13320", "Gather: Invalid nested verb.");
	//Gather->Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13321", "Gather->Say: Invalid voice value.");
	//Gather->Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13322", "Gather->Say: Invalid loop value.");
	//Gather->Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13325", "Gather->Play: Invalid Content-Type.");
	//Play: Invalid loop value.
    define("LANG_TWILIO_ERROR_13410", "Play: Invalid loop value.");
	//Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13420", "Play: Invalid Content-Type.");
	//Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13510", "Say: Invalid loop value.");
	//Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13511", "Say: Invalid voice value.");
	//Say: Invalid text.
    define("LANG_TWILIO_ERROR_13520", "Say: Invalid text.");
	//Record: Invalid method value.
    define("LANG_TWILIO_ERROR_13610", "Record: Invalid method value.");
	//Record: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13611", "Record: Invalid timeout value.");
	//Record: Invalid maxLength value.
    define("LANG_TWILIO_ERROR_13612", "Record: Invalid maxLength value.");
	//Record: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13613", "Record: Invalid finishOnKey value");
	//Redirect: Invalid method value.
    define("LANG_TWILIO_ERROR_13710", "Redirect: Invalid method value.");
	//Pause: Invalid length value.
    define("LANG_TWILIO_ERROR_13910", "Pause: Invalid length value.");
	//Invalid "To" attribute.
    define("LANG_TWILIO_ERROR_14101", "Invalid \"To\" attribute.");
	//Invalid "From" attribute.
    define("LANG_TWILIO_ERROR_14102", "Invalid \"From\" attribute.");
	//Invalid Body.
    define("LANG_TWILIO_ERROR_14103", "Invalid Body.");
	//Invalid Method attribute.
    define("LANG_TWILIO_ERROR_14104", "Invalid Method attribute.");
	//Invalid statusCallback attribute.
    define("LANG_TWILIO_ERROR_14105", "Invalid statusCallback attribute.");
	//Document retrieval limit reached.
    define("LANG_TWILIO_ERROR_14106", "Document retrieval limit reached.");
	//SMS send rate limit exceeded.
    define("LANG_TWILIO_ERROR_14107", "SMS send rate limit exceeded.");
	//From phone number not SMS capable.
    define("LANG_TWILIO_ERROR_14108", "From phone number not SMS capable.");
	//SMS Reply message limit exceeded.
    define("LANG_TWILIO_ERROR_14109", "SMS Reply message limit exceeded.");
	//Invalid Verb for SMS Reply.
    define("LANG_TWILIO_ERROR_14110", "Invalid Verb for SMS Reply.");
	//Invalid To phone number for Trial mode.
    define("LANG_TWILIO_ERROR_14111", "Invalid To phone number for Trial mode.");
	//Unknown parameters.
    define("LANG_TWILIO_ERROR_20001", "Unknown parameters.");
	//Invalid FriendlyName.
    define("LANG_TWILIO_ERROR_20002", "Invalid FriendlyName.");
	//Permission Denied.
    define("LANG_TWILIO_ERROR_20003", "Permission Denied.");
	//Method not allowed.
    define("LANG_TWILIO_ERROR_20004", "Method not allowed.");
	//Account not active.
    define("LANG_TWILIO_ERROR_20005", "Account not active.");
	//No Called number specified.
    define("LANG_TWILIO_ERROR_21201", "No Called number specified.");
	//Called number is a premium number.
    define("LANG_TWILIO_ERROR_21202", "Called number is a premium number.");
	//International calling not enabled.
    define("LANG_TWILIO_ERROR_21203", "International calling not enabled.");
	//Invalid URL.
    define("LANG_TWILIO_ERROR_21205", "Invalid URL.");
	//Invalid SendDigits.
    define("LANG_TWILIO_ERROR_21206", "Invalid SendDigits.");
	//Invalid IfMachine.
    define("LANG_TWILIO_ERROR_21207", "Invalid IfMachine.");
	//Invalid Timeout.
    define("LANG_TWILIO_ERROR_21208", "Invalid Timeout.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21209", "Invalid Method.");
	//Caller phone number not verified.
    define("LANG_TWILIO_ERROR_21210", "Caller phone number not verified.");
	//Invalid Called Phone Number.
    define("LANG_TWILIO_ERROR_21211", "Invalid Called Phone Number.");
	//Invalid Caller Phone Number.
    define("LANG_TWILIO_ERROR_21212", "Invalid Caller Phone Number.");
	//Caller phone number is required.
    define("LANG_TWILIO_ERROR_21213", "Caller phone number is required.");
	//Called Phone Number cannot be reached.
    define("LANG_TWILIO_ERROR_21214", "Called Phone Number cannot be reached.");
	//Account not authorized to call phone number.
    define("LANG_TWILIO_ERROR_21215", "Account not authorized to call phone number.");
	//Account not allowed to call phone number.
    define("LANG_TWILIO_ERROR_21216", "Account not allowed to call phone number.");
	//Phone number does not appear to be valid.
    define("LANG_TWILIO_ERROR_21217", "Phone number does not appear to be valid.");
	//Invalid ApplicationSid.
    define("LANG_TWILIO_ERROR_21218", "Invalid ApplicationSid.");
	//Invalid call state.
    define("LANG_TWILIO_ERROR_21220", "Invalid call state.");
	//Invalid Phone Number.
    define("LANG_TWILIO_ERROR_21401", "Invalid Phone Number.");
	//Invalid Url.
    define("LANG_TWILIO_ERROR_21402", "Invalid Url.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21403", "Invalid Method");
	//Inbound Phone number not available to trial account.
    define("LANG_TWILIO_ERROR_21404", "Inbound Phone number not available to trial account.");
	//Cannot set VoiceFallbackUrl without setting Url.
    define("LANG_TWILIO_ERROR_21405", "Cannot set VoiceFallbackUrl without setting Url.");
	//Cannot set SmsFallbackUrl without setting SmsUrl.
    define("LANG_TWILIO_ERROR_21406", "Cannot set SmsFallbackUrl without setting SmsUrl.");
	//This Phone Number type does not support SMS.
    define("LANG_TWILIO_ERROR_21407", "This Phone Number type does not support SMS.");
	//Phone number already validated on your account.
    define("LANG_TWILIO_ERROR_21450", "Phone number already validated on your account.");
	//Invalid area code.
    define("LANG_TWILIO_ERROR_21451", "Invalid area code.");
	//No phone numbers found in area code.
    define("LANG_TWILIO_ERROR_21452", "No phone numbers found in area code.");
	//Phone number already validated on another account.
    define("LANG_TWILIO_ERROR_21453", "Phone number already validated on another account.");
	//Invalid CallDelay.
    define("LANG_TWILIO_ERROR_21454", "Invalid CallDelay.");
	//Resource not available.
    define("LANG_TWILIO_ERROR_21501", "Resource not available.");
	//Invalid callback url.
    define("LANG_TWILIO_ERROR_21502", "Invalid callback url.");
	//Invalid transcription type.
    define("LANG_TWILIO_ERROR_21503", "Invalid transcription type.");
	//RecordingSid is required..
    define("LANG_TWILIO_ERROR_21504", "RecordingSid is required.");
	//Phone number is not a valid SMS-capable inbound phone number.
    define("LANG_TWILIO_ERROR_21601", "Phone number is not a valid SMS-capable inbound phone number.");
	//Message body is required.
    define("LANG_TWILIO_ERROR_21602", "Message body is required.");
	//The source 'from' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21603", "The source 'from' phone number is required to send an SMS.");
	//The destination 'to' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21604", "The destination 'to' phone number is required to send an SMS.");
	//Maximum SMS body length is 160 characters.
    define("LANG_TWILIO_ERROR_21605", "Maximum SMS body length is 160 characters");
	//The "From" phone number provided is not a valid, SMS-capable inbound phone number for your account.
    define("LANG_TWILIO_ERROR_21606", "The \"From\" phone number provided is not a valid, SMS-capable inbound phone number for your account.");
	//The Sandbox number can send messages only to verified numbers.
    define("LANG_TWILIO_ERROR_21608", "The Sandbox number can send messages only to verified numbers.");

	# ----------------------------------------------------------------------------------------------------
	# FACEBOOK COMMENTS
	# ----------------------------------------------------------------------------------------------------
	//Facebook comments
	define("LANG_LABEL_FACEBOOK_COMMENTS", "Facebook comments");
	//Facebook comments not available for this listing
	define("LANG_LABEL_FACEBOOK_COMMENTS_NOT_AVAILABLE", "Facebook comments not available for this ".LISTING_FEATURE_NAME);
	//Be sure you're logged into Facebook with the same account you set in your Commenting Options section, otherwise you can not moderate the comments for this item.
	define("LANG_LABEL_FACEBOOK_TIP1", "Be sure you're logged into Facebook with the same account you set in your Commenting Options section, otherwise you can not moderate the comments for this item.");
	//You can also moderate your comments by going to
	define("LANG_LABEL_FACEBOOK_TIP2", "You can also moderate your comments by going to ");

	# ----------------------------------------------------------------------------------------------------
	# EDIRECTORY API
	# ----------------------------------------------------------------------------------------------------
	//Invalid API key.
	define("LANG_API_INVALIDKEY", "Invalid API key.");
	//Missing parameter: module.
	define("LANG_API_EMPTYMODULE", "Missing parameter: module.");
	//Invalid module name.
	define("LANG_API_INVALIDMODULE", "Invalid module name.");
	//Module disabled.
	define("LANG_API_MODULEOFF", "Module disabled.");
	//Missing parameter: keyword.
	define("LANG_API_EMPTYKEYWORD", "Missing parameter: keyword.");
	//API disabled.
	define("LANG_API_DISABLED", "API disabled.");

	# ----------------------------------------------------------------------------------------------------
	# THEME TEMPLATE
	# ----------------------------------------------------------------------------------------------------
	//Swimming Pool
	define("LANG_LABEL_TEMPLATE_POOL", "Swimming Pool");
	//Bedroom(s)
	define("LANG_LABEL_TEMPLATE_BEDROOM", "Bedroom(s)");
	//Bathroom(s)
	define("LANG_LABEL_TEMPLATE_BATHROOM", "Bathroom(s)");
	//Level(s)
	define("LANG_LABEL_TEMPLATE_LEVEL", "Level(s)");
	//Property Type
	define("LANG_LABEL_TEMPLATE_TYPE", "Property Type");
	//Purpose
	define("LANG_LABEL_TEMPLATE_PURPOSE", "Purpose");
	//Price
	define("LANG_LABEL_TEMPLATE_PRICE", "Price");
	//Acres
	define("LANG_LABEL_TEMPLATE_ACRES", "Acres");
	//Built In
	define("LANG_LABEL_TEMPLATE_TYPEBUILTIN", "Built In");
	//Square Feet
	define("LANG_LABEL_TEMPLATE_SQUARE", "Square Feet");
	//Office
	define("LANG_LABEL_TEMPLATE_OFFICE", "Office");
	//Laundry Room
	define("LANG_LABEL_TEMPLATE_LAUNDRYROOM", "Laundry Room");
	//Central Air Conditioning
	define("LANG_LABEL_TEMPLATE_AIRCOND", "Central Air Conditioning");
	//Dining Room
	define("LANG_LABEL_TEMPLATE_DINING", "Dining Room");
	//Garage
	define("LANG_LABEL_TEMPLATE_GARAGE", "Garage");
	//Garbage Disposal
	define("LANG_LABEL_TEMPLATE_GARBAGE", "Garbage Disposal");

	# ----------------------------------------------------------------------------------------------------
	# BLOG
	# ----------------------------------------------------------------------------------------------------
	//Your post will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_POST_AUTOMATICALLY_APPEAR", "Your post will automatically appear in the main category of each sub-category you select.");
	//Type a keyword or post title
	define("LANG_LABEL_SEARCHKEYWORDTIP_POST", "Type a keyword or post title");
	//Archive
	define("LANG_BLOG_ARCHIVE", "Archive");
	//Recent Topics
	define("LANG_BLOG_RECENTTOPICS", "Recent Topics");
	//Recent Members
	define("LANG_BLOG_RECENTMEMBERS", "Recent Members");
	//View more
	define("LANG_VIEWMORE", "View more");
	//Popular Topics
	define("LANG_BLOG_POPULARTOPICS", "Popular Topics");
	//Post Search Results
	define("LANG_MSG_BLOGRESULTS", "Post Search Results");
	//Comments
	define("LANG_BLOG_COMMENTS", "Comments");
	//Comment It
	define("LANG_BLOG_COMMENTIT", "Comment It!");
	//Related Posts
	define("LANG_BLOG_RELATEDPOSTS", "Related Posts");
	//Web Site
	define("LANG_LABEL_WEBSITE", "Web Site");
	//Published
	define("LANG_BLOG_PUBLISHED", "Published");
	//on
	define("LANG_BLOG_ON", "on");
	//"About" [POST_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_BLOG_CONTACTSUBJECT_ISNULL_1", "About");
	//About [POST_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_BLOG_CONTACTSUBJECT_ISNULL_2", "from the");
	//Send info about this post to a friend
	define("LANG_BLOG_TOFRIEND_SAUDATION", "Send info about this post to a friend");
	//SOME DETAILS
	define("LANG_BLOG_TOFRIEND_MAIL", "SOME DETAILS");
	//Post
	define("LANG_BLOG", "Post");
	//Leave Your Comment
	define("LANG_MSG_LEAVEYOURCOMMENT", "Leave your comment");
	//Reply this comment
	define("LANG_MSG_REPLYTHISCOMMENT", "Reply this comment");
	//Please type a valid e-mail
	define("LANG_COMMENT_EMPTY_EMAIL", "Please type a valid e-mail.");
	//Please type a website
	define("LANG_COMMENT_EMPTY_WEBSITE", "Please type a website.");
	//Please type a comment!
	define("LANG_COMMENT_EMPTY", "Please type a comment.");
	//Comments of
	define("LANG_COMMENTS_COMMENTSOF", "Comments of ");
	//No comment found for this post!
	define("LANG_COMMENT_NORECORD", "No comment found for this post!");
	//Post
	define("LANG_LABEL_POST", "Post");
	//Click here to view this comment
	define("LANG_MSG_CLICK_TO_VIEW_THIS_COMMENT", "Click here to view this comment");
	//Click here to view this comment's replies
	define("LANG_MSG_CLICK_TO_VIEW_REPLIES", "Click here to view this comment's replies");
	//This comments has no replies
	define("LANG_MSG_NO_REPLIES", "This comment has no replies");
	//Click here to delete this comment
	define("LANG_MSG_CLICK_TO_DELETE_THIS_COMMENT", "Click here to delete this comment");
	//View replys
	define("LANG_LABEL_VIEW_REPLY", "View replies");
	//Click here to view this post reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BLOG_REPORTS", "Click here to view this post reports");
	//You need to login to leave your comment
	define("LANG_MSG_NEED_LOGIN", "You need to login to leave your comment.");
	//You need to login to redeem a deal.
	define("LANG_MSG_NEED_LOGIN_DEAL", "You need to login to redeem a ".PROMOTION_FEATURE_NAME.".");
	//No posts found.
	define("LANG_MSG_NOBLOGS", "No posts found.");
	//No posts
	define("LANG_MSG_NOPOSTS", "No posts");
	//Comment successfully posted!
	define("LANG_MSG_COMMENT_SUCCESSFULLY_POSTED", "Comment successfully posted!");
	//Your comment has been submitted for approval.
	define("LANG_MSG_COMMENT_SENT_TO_APPROVE", "Your comment has been submitted for approval.");
	//Reply successfully posted!
	define("LANG_MSG_REPLY_SUCCESSFULLY_POSTED", "Reply successfully posted!");
	//Your reply has been submitted for approval.
	define("LANG_MSG_REPLY_SENT_TO_APPROVE", "Your reply has been submitted for approval.");
	//Content
	define("LANG_LABEL_POST_CONTENT", "Content");
	//Reply
	define("LANG_LABEL_REPLY", "Reply");
	//Re
	define("LANG_LABEL_ABBR_REPLY", "Re");
	//Click here to view this reply
	define("LANG_MSG_CLICK_TO_VIEW_THIS_REPLY", "Click here to view this reply");
	//Click here to delete this reply
	define("LANG_MSG_CLICK_TO_DELETE_THIS_REPLY", "Click here to delete this reply");

	# ----------------------------------------------------------------------------------------------------
	# SITEMGR NOTIFICATIONS
	# ----------------------------------------------------------------------------------------------------
	//Account Notification
	define("LANG_NOTIFY_NEWACCOUNT", "[".EDIRECTORY_TITLE."] Account Notification");
	//A new account was created in
	define("LANG_NOTIFY_NEWACCOUNT_1", "A new account was created in");
	//Please review the account information below:
	define("LANG_NOTIFY_NEWACCOUNT_2", "Please review the account information below:");
	//Article Notification
	define("LANG_NOTIFY_ARTICLE", "[".EDIRECTORY_TITLE."] ".LANG_ARTICLE_FEATURE_NAME." Notification");
	//was changed by the administrator
	define("LANG_NOTIFY_ITEMS_1", "was changed by the administrator");
	//was created by the administrator
	define("LANG_NOTIFY_ITEMS_2", "was created by the administrator");
	//and needs to be revised by you.
	define("LANG_NOTIFY_ITEMS_3", "and needs to be reviewed by you.");
	//Banner Notification
	define("LANG_NOTIFY_BANNER", "[".EDIRECTORY_TITLE."] ".LANG_BANNER_FEATURE_NAME." Notification");
	//Transaction Notification
	define("LANG_NOTIFY_TRANSACTION", "[".EDIRECTORY_TITLE."] Transaction Notification");
	//A transaction was made and needs to be revised by you.
	define("LANG_NOTIFY_TRANSACTION_1", "A transaction was made and needs to be reviewed by you.");
	//Transaction Info:
	define("LANG_NOTIFY_TRANSACTION_2", "Transaction Info:");
	//Transaction Time
	define("LANG_NOTIFY_TRANSACTION_3", "Transaction Time");
	//Gateway
	define("LANG_NOTIFY_TRANSACTION_4", "Gateway");
	//(prices amount are per installments)
	define("LANG_NOTIFY_TRANSACTION_5", "(prices amount are per installments)");
	//Please sign in to the directory at the links below to revise and/or activate these items.
	define("LANG_NOTIFY_TRANSACTION_6", "Please sign in to the directory at the links below to revise and/or activate these items.");
	//Classified Notification
	define("LANG_NOTIFY_CLASSIFIED", "[".EDIRECTORY_TITLE."] ".LANG_CLASSIFIED_FEATURE_NAME." Notification");
	//Contact Us
	define("LANG_NOTIFY_CONTACTUS", "Contact Us");
	//Event Notification
	define("LANG_NOTIFY_EVENT", "[".EDIRECTORY_TITLE."] ".LANG_EVENT_FEATURE_NAME." Notification");
	//Listing Notification
	define("LANG_NOTIFY_LISTING", "[".EDIRECTORY_TITLE."] ".LANG_LISTING_FEATURE_NAME." Notification");
    //New Comment Added
    define("LANG_NOTIFY_NEWCOMMENT", "New Comment Added");
    //New Reply Added
    define("LANG_NOTIFY_NEWREPLY", "New Reply Added");
    //Your blog post
    define("LANG_NOTIFY_NEWCOMMENT_1", "Your ".BLOG_FEATURE_NAME." post");
    //has a new reply.
    define("LANG_NOTIFY_NEWCOMMENT_2", "has a new reply.");
    //has a new comment.
    define("LANG_NOTIFY_NEWCOMMENT_3", "has a new comment.");
    //wrote
    define("LANG_NOTIFY_NEWCOMMENT_4", "wrote");
    //on
    define("LANG_NOTIFY_NEWCOMMENT_5", "on");
    //Click on the link below to moderate the comment
    define("LANG_NOTIFY_NEWCOMMENT_6", "Click on the link below to moderate the comment");
    //CSS Editor Backup
    define("LANG_NOTIFY_EDITORCHANGED", "CSS Editor Backup");
    //The file
    define("LANG_NOTIFY_EDITORCHANGED_1", "The file");
    //was changed at
    define("LANG_NOTIFY_EDITORCHANGED_2", "was changed at");
    //Enclosed is a copy of the last version submitted to the site.
    define("LANG_NOTIFY_EDITORCHANGED_3", "Enclosed is a copy of the last version submitted to the site.");
    //Rating Notification
    define("LANG_NOTIFY_NEWREVIEW", "Rating Notification");
    //has a new review
    define("LANG_NOTIFY_NEWREVIEW_1", "has a new review");
    //stars
    define("LANG_NOTIFY_NEWREVIEW_2", "stars");
    //Click on the link below to go to the review administration
    define("LANG_NOTIFY_NEWREVIEW_3", "Click on the link below to go to the review administration");
    //from
    define("LANG_NOTIFY_NEWREVIEW_4", "from");
    //wrote
    define("LANG_NOTIFY_NEWREVIEW_5", "wrote");
    //Reply Notification
    define("LANG_NOTIFY_NEWREPLY", "Reply Notification");
    //Review
    define("LANG_NOTIFY_NEWREPLY_1", "Review");
    //has a new reply
    define("LANG_NOTIFY_NEWREPLY_2", "has a new reply");
    //Click on the link below to go to the review administration
    define("LANG_NOTIFY_NEWREPLY_3", "Click on the link below to go to the review administration");
    //Import Correction Notification
    define("LANG_NOTIFY_PREPAREIMPORT", "Import Correction Notification");
    //Event Import Correction Notification
    define("LANG_NOTIFY_PREPAREIMPORT_EVENT", string_ucwords(EVENT_FEATURE_NAME)." Import Correction Notification");
    //Your import correction for the file
    define("LANG_NOTIFY_PREPAREIMPORT_1", "Your import correction for the file");
    //was completed but contained errors.
    define("LANG_NOTIFY_PREPAREIMPORT_2", "was completed but contained errors.");
    //Please review the log at
    define("LANG_NOTIFY_PREPAREIMPORT_3", "Please review the log at");
    //has been completed.
    define("LANG_NOTIFY_PREPAREIMPORT_4", "has been completed.");
    //You can review the log here
    define("LANG_NOTIFY_PREPAREIMPORT_5", "You can review the log here");
    //Listing Import Notification
    define("LANG_NOTIFY_IMPORTLISTING", string_ucwords(LISTING_FEATURE_NAME)." Import Notification");
    //Your listing(s) import has been completed.
    define("LANG_NOTIFY_IMPORTLISTING_1", "Your ".LISTING_FEATURE_NAME."(s) import has been completed.");
    //You can review the log here
    define("LANG_NOTIFY_IMPORTLISTING_2", "You can review the log here");
    //Event Import Notification
    define("LANG_NOTIFY_IMPORTEVENT", string_ucwords(EVENT_FEATURE_NAME)." Import Notification");
    //Your event(s) import has been completed
    define("LANG_NOTIFY_IMPORTEVENT_1", "Your ".EVENT_FEATURE_NAME."(s) import has been completed.");
    //You can review the log here
    define("LANG_NOTIFY_IMPORTEVENT_2", "You can review the log here");
    //Package Notification
    define("LANG_NOTIFY_PACKAGE", "Package Notification");
    //The package
    define("LANG_NOTIFY_PACKAGE_1", "The package");
    //was bought by the administrator
    define("LANG_NOTIFY_PACKAGE_2", "was bought by the administrator");
    //and needs to be checked over by you.
    define("LANG_NOTIFY_PACKAGE_3", "and needs to be checked over by you.");
    //Purchased items
    define("LANG_NOTIFY_PACKAGE_4", "Purchased items");
    //Help Request
    define("LANG_NOTIFY_MEMBERSHELP", "Help Request");
    //You have received a message from one of your site members.
    define("LANG_NOTIFY_MEMBERSHELP_1", "You have received a message from one of your site members.");
    //From
    define("LANG_NOTIFY_MEMBERSHELP_2", "From");
    //E-mail
    define("LANG_NOTIFY_MEMBERSHELP_3", "E-mail");
    //Message
    define("LANG_NOTIFY_MEMBERSHELP_4", "Message");
    //Forgotten Password
    define("LANG_NOTIFY_FORGOTPASS", "Forgotten Password");
    //A new password was requested from your ".EDIRECTORY_TITLE." account.
    define("LANG_NOTIFY_FORGOTPASS_1", "A new password was requested from your ".EDIRECTORY_TITLE." account.");
    //To change your password please click the link below and enter a new password
    define("LANG_NOTIFY_FORGOTPASS_2", "To change your password please click the link below and enter a new password");
    //New User Signup (Listing)
    define("LANG_NOTIFY_SIGNUPLISTING", "New User Signup (".string_ucwords(LISTING_FEATURE_NAME).")");
    //A new user has signed up and ordered a listing at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPLISTING_1", "A new user has signed up and ordered a ".LISTING_FEATURE_NAME." at ".EDIRECTORY_TITLE.".");
    //New User Signup (Event)
    define("LANG_NOTIFY_SIGNUPEVENT", "New User Signup (".string_ucwords(EVENT_FEATURE_NAME).")");
    //A new user has signed up and ordered an event at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPEVENT_1", "A new user has signed up and ordered an ".string_ucwords(EVENT_FEATURE_NAME)." at ".EDIRECTORY_TITLE.".");
    //New User Signup (Classified)
    define("LANG_NOTIFY_SIGNUPCLASSIFIED", "New User Signup (".string_ucwords(CLASSIFIED_FEATURE_NAME).")");
    //A new user has signed up and ordered a classified at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPCLASSIFIED_1", "A new user has signed up and ordered a ".string_ucwords(CLASSIFIED_FEATURE_NAME)." at ".EDIRECTORY_TITLE.".");
    //New User Signup (Banner)
    define("LANG_NOTIFY_SIGNUPBANNER", "New User Signup (".string_ucwords(BANNER_FEATURE_NAME).")");
    //A new user has signed up and ordered a banner at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPBANNER_1", "A new user has signed up and ordered a ".BANNER_FEATURE_NAME." at ".EDIRECTORY_TITLE.".");
    //New User Signup (Article)
    define("LANG_NOTIFY_SIGNUPARTICLE", "New User Signup (".string_ucwords(ARTICLE_FEATURE_NAME).")");
    //A new user has signed up and ordered an article at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPARTICLE_1", "A new user has signed up and ordered an ".string_ucwords(ARTICLE_FEATURE_NAME)." at ".EDIRECTORY_TITLE.".");
    //Listing Claimed!
    define("LANG_NOTIFY_NEWCLAIM", string_ucwords(LISTING_FEATURE_NAME)." Claimed!");
    //A ".LISTING_FEATURE_NAME." has recently been claimed on your site - ".EDIRECTORY_TITLE."!
    define("LANG_NOTIFY_NEWCLAIM_1", "A ".LISTING_FEATURE_NAME." has recently been claimed on your site - ".EDIRECTORY_TITLE."!");
    //To approve the ".LISTING_FEATURE_NAME.", follow the claim link below
    define("LANG_NOTIFY_NEWCLAIM_2", "To approve the ".LISTING_FEATURE_NAME.", follow the claim link below");
    //Claim ID
    define("LANG_NOTIFY_NEWCLAIM_3", "Claim ID");
    //To preview the listing, follow the listing link below
    define("LANG_NOTIFY_NEWCLAIM_4", "To preview the ".LISTING_FEATURE_NAME.", follow the ".LISTING_FEATURE_NAME." link below");
    //To see the user's account information follow the account link below
    define("LANG_NOTIFY_NEWCLAIM_5", "To see the user's account information follow the account link below");
    //Account Details for the listing owner
    define("LANG_NOTIFY_NEWCLAIM_6", "Account Details for the ".LISTING_FEATURE_NAME." owner");
    //New Signup (Via Mobile)
    define("LANG_NOTIFY_NEWACCOUNTAPP", "New Signup (Via Mobile)");
    //A new user has joined ".EDIRECTORY_TITLE." via the mobile app.
    define("LANG_NOTIFY_NEWACCOUNTAPP_1", "A new user has joined ".EDIRECTORY_TITLE." via the mobile app.");
    //Account information included below for your convenience:
    define("LANG_NOTIFY_NEWACCOUNTAPP_2", "Account information included below for your convenience:");
	//You received a new lead through the enquire form. To view the lead, follow the link below.
	define("LANG_NOTIFY_NEWLEAD", "You received a new lead through the inquire form. To view the lead, follow the link below.");

	# ----------------------------------------------------------------------------------------------------
	# MOBILE VERSION
	# ----------------------------------------------------------------------------------------------------
	//We have an app for that!
	define("LANG_MOBILE_APP", "We have an app for that!");
	//Grab the eDirectory App for iPhone
	define("LANG_MOBILE_GRAB_APP_IPHONE", "Grab the eDirectory App for iPhone");
	//In Google Play
	define("LANG_MOBILE_GRAB_APP_ANDROID", "In Google Play");
	//Available on the
	define("LANG_MOBILE_APP_STORE", "Available on the");
	//ANDROID APP ON
	define("LANG_MOBILE_APP_ANDROID", "ANDROID APP ON");
    //Recently added listings
    define("LANG_MOBILE_RECENT_LISTINGS", "Recently added ".LISTING_FEATURE_NAME_PLURAL);
    //View full site
    define("LANG_MOBILE_FULLSITE", "View full site");
    //Download App
    define("LANG_MOBILE_DOWNLOAD_APP", "Download App");
    //Use the following code:
    define("LANG_MOBILE_DEAL_USECODE", "Use the following code:");
    //REDEEMED
    define("LANG_MOBILE_DEAL_REDEEMED", "REDEEMED");
    //Please login to redeem
    define("LANG_MOBILE_DEAL_LOGIN", "Please login to redeem");

    # ----------------------------------------------------------------------------------------------------
	# ARCAMAILER
	# ----------------------------------------------------------------------------------------------------
    //Sign up for our Newsletter
    define("LANG_ARCAMAILER_SIGNUP", "Sign up for our Newsletter");
    //Subscribe
    define("LANG_ARCAMAILER_SUBSCRIBE", "Subscribe");
	//Subscribe to our monthly newsletter, no spam, just product updates.
	define("LANG_ARCAMAILER_SUBSCRIBE_TIP", "Subscribe to our monthly newsletter, no spam, just product updates.");
    //Please, type your name and e-mail.
    define("LANG_ARCAMAILER_SUBSCRIBEERROR", "Please, type your name and e-mail.");
    //Check your e-mail to complete your subscription.
    define("LANG_ARCAMAILER_SUBSCRIBEDONE", "Check your e-mail to complete your subscription.");

    # ----------------------------------------------------------------------------------------------------
	# GENERAL
	# ----------------------------------------------------------------------------------------------------
    //Changing this will lose any unsaved changes made to this form.
    define("LANG_CONFIRM_CHANGE_LEVEL", "Changing this will lose any unsaved changes made to this form.");

    # ----------------------------------------------------------------------------------------------------
	# DINING GUIDE
	# ----------------------------------------------------------------------------------------------------
    //Top Listing
    define("LANG_LABEL_TOP_LISTING", "Top ".string_ucwords(LISTING_FEATURE_NAME));
    //Featured Deal
    define("LANG_LABEL_FEATURED_DEAL", "Featured ".string_ucwords(PROMOTION_FEATURE_NAME));
    //Popular Reviews
    define("LANG_LABEL_POPULAR_REVIEW", "Popular Reviews");
	//Helpful Reviews
	define("LANG_LABEL_HELPFUL_REVIEWS", "Helpful Reviews");
    //Keep Reading
    define("LANG_LABEL_KEEP_READING", "Keep Reading");
    //Best Of
    define("LANG_MENU_BESTOF", "Best Of");
    //By Cuisine
    define("LANG_MENU_BYCUISINE", "By Cuisine");
    //By Location
    define("LANG_MENU_BYLOCATION", "By Location");
    //Sign up | Login
    define("LANG_MENU_SIGNUPLOGIN", "Sign up | Login");
    //Forgot?
    define("LANG_LABEL_FORGOT", "Forgot?");
    //Not a member? Sign up now
    define("LANG_LABEL_SIGNUPNOW", "Not a member? Sign up now");
	//Price range
	define("LANG_LABEL_PRICE_RANGE", "Price range");
	//Need a Specific Category?
	define("LANG_LABEL_SPECIFIC_CATEG", "Need a Specific Category?");
	//Show [x] Reviews
	define("LANG_LABEL_SHOW_REVIEWS", "Show [x] Reviews");
	//Filter by
	define("LANG_LABEL_FILTERBY", "Filter by");
	//Filter by Category
	define("LANG_LABEL_FILTERBY_CATEGORY", "Filter by Category");
	//Keyword to search...
	define("LANG_LABEL_KEYWORDSEARCH", "Keyword to search...");
	//Location to search...
	define("LANG_LABEL_LOCATIONSEARCH", "Location to search...");
	//See All Locations
	define("LANG_LABEL_SEE_LOCATIONS", "See All Locations");
	//Clear Selections
	define("LANG_LABEL_CLEAR_SELECT", "Clear Selections");
	//Close Advanced Search
	define("LANG_LABEL_ADVSEARCH_CLOSE", "Close Advanced Search");
	//Offers & Deals
	define("LANG_LABEL_DEAL_FILTER", "Offers & ".string_ucwords(PROMOTION_FEATURE_NAME_PLURAL));
	//Cuisine
	define("LANG_LABEL_CUISINE", "Cuisine");
	//List View
	define("LANG_LABEL_LISTVIEW", "List View");
	//Map View
	define("LANG_LABEL_MAPVIEW", "Map View");
	//Give us a moment, we're loading in your results.
	define("LANG_LABEL_LOADINGMAP", "Give us a moment, we're loading in your results.");
	//Valid for
    define("LANG_LABEL_FILTER_VALID_FOR", "Valid for");
    //Ends in less than 24 hours
    define("LANG_LABEL_FILTER_ENDS_IN_LESS_THAN_24_HOURS", "Ends in less than 24 hours");
    //Valid for more than 2 days
    define("LANG_LABEL_FILTER_VALID_FOR_MORE_THAN_2_DAYS", "Valid for more than 2 days");
    //Valid for more than a week
    define("LANG_LABEL_FILTER_VALID_FOR_MORE_THAN_A_WEEK", "Valid for more than a week");
	//filter
	define("LANG_LABEL_FILTER", "filter");
    //Show more categories
    define("LANG_LABEL_FILTER_SHOW_MORE_CATEGORIES", "Show more categories");
    //Show more locations
    define("LANG_LABEL_FILTER_SHOW_MORE_LOCATIONS", "Show more locations");
    //Showing [NUMBER_EDIR] for KEYWORD_EDIR in LOCATION_EDIR
    define("LANG_LABEL_FILTER_SHOWING_RESULTS_WITH_KEYWORD_AND_LOCATION", "Showing [NUMBER_EDIR] for KEYWORD_EDIR in LOCATION_EDIR");
    //Showing [NUMBER_EDIR] for KEYWORD_EDIR
    define("LANG_LABEL_FILTER_SHOWING_RESULTS_WITH_KEYWORD", "Showing [NUMBER_EDIR] for KEYWORD_EDIR");
    //Map view is only available for result sets with less than [MAX_MARKERS] items. Use filters to refine
    define("LANG_LABEL_FILTER_MAP_MORE_THAN_1000_RESULTS", "Map view is only available for result sets with less than [MAX_MARKERS] items. Use filters to refine");
    //No Matches
    define("LANG_LABEL_FILTER_NO_MATCHES", "No Matches");
    //Clear Filters
    define("LANG_LABEL_FILTER_SHOW_ORIGINAL_SEARCH", "Clear Filters");

	# ----------------------------------------------------------------------------------------------------
	# LEADS
	# ----------------------------------------------------------------------------------------------------
    //Lead
	define("LANG_LABEL_LEAD", "Lead");
	//Leads
	define("LANG_LABEL_LEADS", "Leads");
	//Click here to view this item leads
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_LEADS", "Click here to view this item leads");
	//Manage Leads
	define("LANG_MANAGE_LEADS", "Manage Leads");
	//No records found.
	define("LANG_NORECORD", "No records found.");
	//Forward
	define("LANG_LABEL_FORWARD", "Forward");
	//Lead successfully deleted!
	define("LANG_LEAD_SUCCESSDELETED", "Lead successfully deleted!");
	//Lead successfully replied!
	define("LANG_LEAD_REPLIED", "Lead successfully replied!");
	//Lead successfully forwarded!
	define("LANG_LEAD_FORWARDED", "Lead successfully forwarded!");
	//Please type a message.
	define("LANG_LEAD_TYPEMESSAGE", "Please type a message.");
	//New lead received by
	define("LANG_LEAD_RECEIVED", "New lead received by");
	//Replied
	define("LANG_LEAD_REPLIED_ICO", "Replied");
	//Forwarded
	define("LANG_LEAD_FORWARDED_ICO", "Forwarded");
	//Replied and Forwarded
	define("LANG_LEAD_REPLIED_FORWARDED_ICO", "Replied [dater] and Forwarded [datef]");
	//Talk to Us
	define("LANG_LEAD_TALKTOUS", "Talk to Us");
	//Your first name
	define("LANG_LEAD_FIRSTNAME", "Your first name");
	//Your last name
	define("LANG_LEAD_LASTNAME", "Your last name");
	//Your email, please?
	define("LANG_LEAD_EMAIL", "Your email, please?");
	//Add your phone number
	define("LANG_LEAD_PHONE", "Add your phone number");
	//Company/Organization
	define("LANG_LEAD_COMPANY", "Company/Organization");
	//What kind of service do you need?
	define("LANG_LEAD_MESSAGE", "What kind of service do you need?");
	//Please type your first name and last name.
	define("LANG_LEAD_TYPE_NAME", "Please type your first name and last name.");
	//Thank you, we will be in touch shortly.
	define("LANG_LEAD_THANKYOU", "Thank you, we will be in touch shortly.");
	//New Enquire
	define("LANG_LEAD_ENQUERY", "New Inquire");
	//General Lead
	define("LANG_GENERAL_LEAD", "General Lead");

	# ----------------------------------------------------------------------------------------------------
	# LOG IN / SIGN UP / MEMBERS
	# ----------------------------------------------------------------------------------------------------
	//Are you a Sponsor?
	define("LANG_AREYOU_SPONSOR_AREA", "Are you a Sponsor?");
	//List your business today
	define("LANG_AREYOU_SPONSOR_AREA_2", "List your business today");
	//Find Us
	define("LANG_FIND_US", "Find Us");
	//or if you already have an account login below
	define("LANG_OR_SIGNUPACCOUNT", "or if you already have an account login below");
	//Or log in using your e-mail address
	define("LANG_OR_SIGNINEMAIL", "or log in using your email address");
	//Or sign up using your e-mail address
	define("LANG_OR_SIGNUPEMAIL", "or sign up using your email address");
	//Are you a sponsor? Go to our sponsor area
	define("LANG_GO_TO_SPONSOR_AREA", "Are you a sponsor? Go to our sponsor area");
	//By creating an account, I accept the Terms of Use.
	define("LANG_ACCEPT_TERMS", "By creating an account, I accept the [a]Terms of Use[/a].");
	//Sponsor Area
	define("LANG_LABEL_SPONSORAREA", "Sponsor Area");
	//Log in to the Sponsor Area
	define("LANG_LABEL_LOGIN_SPONSORAREA", "Log in to the Sponsor Area");
    //Already a member - Log in here.
    define("LANG_LABEL_ALREADY_MEMBER", "Already a member - Log in here.");
	//Reference
	define("LANG_LABEL_REFERENCE", "Reference");
	//Got an enquiry or something you're stuck on? Send us a message. We'll get back to you as soon as we can.
	define("LANG_HELP_MESSAGE", "Got an enquiry or something you're stuck on? Send us a message. We'll get back to you as soon as we can.");
    //Add a new content
    define("LANG_ADD_NEW_CONTENT", "Add a new content");
	//You don't have any content yet.
	define("LANG_ADD_NEW_CONTENT2", "You don't have any content yet.");
	//Add your business today, it's quick and simple!
	define("LANG_ADD_NEW_CONTENT2_TIP", "Add your business today, it's quick and simple!");
    //Remove
    define("LANG_LABEL_REMOVE", "Remove");
    //View on Website
    define("LANG_LABEL_VIEW_LIVE", "View on Website");
	//Preview
	define("LANG_LABEL_PREVIEW", "Preview");
	//Expires in
	define("LANG_LABEL_EXPIRESON", "Expires in");
	//until it expires
	define("LANG_LABEL_UNTILEXPIRES", "until it expires");
	//impressions left
	define("LANG_LABEL_IMPRESSIONS_LEFT", "impressions left");
    //Billing
	define("LANG_LABEL_BILLING", "Billing");
    //was successfully deleted!
	define("LANG_LABEL_WASSUCCESSDELETED", "was successfully deleted!");
    //Deal not linked
    define("LANG_LABEL_NOTLINKED", string_ucwords(PROMOTION_FEATURE_NAME)." not linked");
    //Increase Visibility
    define("LANG_LABEL_INCREASEVISIBILITY", "Increase Visibility");
    //Renew Now
    define("LANG_LABEL_RENEW", "Renew Now");
    //Add basic information
    define("LANG_LABEL_GAMEFY_DESC", "Add basic information");
    //Add photos or video
    define("LANG_LABEL_GAMEFY_MEDIA", "Add photos or videos");
    //Add additional information
    define("LANG_LABEL_GAMEFY_ADDITIONAL", "Add additional information");
    //Share and get more reviews
    define("LANG_LABEL_DASHBOARD_SHARE", "Share and get more reviews");
    //Share and get more leads
    define("LANG_LABEL_DASHBOARD_SHARE2", "Share and get more leads");
	//Share and get more redeems
    define("LANG_LABEL_DASHBOARD_SHARE3", "Share and get more redeems");
    //Review by
    define("LANG_LABEL_REVIEWBY", "Review by");
    //Reply this
    define("LANG_LABEL_REPLYTHIS", "Reply this");
    //Write your reply
    define("LANG_LABEL_WRITE_REPLY", "Write your reply");
    //Activity Report
    define("LANG_LABEL_ACTIVITYREPORT", "Activity Report");
    //See all reviews
    define("LANG_LABEL_SEE_REVIEWS", "See all reviews");
    //See all leads
    define("LANG_LABEL_SEE_LEADS", "See all leads");
    //Statistics
    define("LANG_LABEL_STATISTICS", "Statistics");
    //Total Viewers
    define("LANG_LABEL_TOTALVIEWERS", "Total Viewers");
    //Phone Views
    define("LANG_LABEL_PHONEVIEWS", "Phone Views");
    //Website Views
    define("LANG_LABEL_WEBSITEVIEWS", "Website Views");
    //Fax Views
    define("LANG_LABEL_FAXVIEWS", "Fax Views");
    //Phone View
    define("LANG_LABEL_PHONEVIEW", "Phone View");
    //Website View
    define("LANG_LABEL_WEBSITEVIEW", "Website View");
    //Fax View
    define("LANG_LABEL_FAXVIEW", "Fax View");
    //View more stats
    define("LANG_LABEL_VIEW_MORE_STATS", "View more stats");
	//Stats
	define("LANG_LABEL_STATS", "Stats");
	//Listing Completion
    define("LANG_LABEL_LISTING_COMPLETION", string_ucwords(LISTING_FEATURE_NAME)." Completion");
    //Event Completion
    define("LANG_LABEL_EVENT_COMPLETION", string_ucwords(EVENT_FEATURE_NAME)." Completion");
    //Classified Completion
    define("LANG_LABEL_CLASSIFIED_COMPLETION", string_ucwords(CLASSIFIED_FEATURE_NAME)." Completion");
    //Article Completion
    define("LANG_LABEL_ARTICLE_COMPLETION", string_ucwords(ARTICLE_FEATURE_NAME)." Completion");
	//Deal Completion
    define("LANG_LABEL_PROMOTION_COMPLETION", string_ucwords(PROMOTION_FEATURE_NAME)." Completion");
    //You're not quite done with your item.
    define("LANG_LABEL_GAMEFY_TIP", "You're not quite done with your item.");
	//What are you looking for today?
	define("LANG_LABEL_PROFILE_TIP1", "What are you looking for today?");
	//Thank you for being part of EDIRECTORY_TITLE. Join our community by giving your opinion and evaluating your favorite listings.
	define("LANG_LABEL_PROFILE_TIP2", "Thank you for being part of ".EDIRECTORY_TITLE.". Join our community by giving your opinion and evaluating your favorite ".LISTING_FEATURE_NAME_PLURAL.".");
	//Oh wait...
	define("LANG_LABEL_PROFILE_TIP3", "Oh wait...");
	//This user has no activity in our portal yet. Don't worry. You can still join our community by giving your opinion and evaluating your favorite listings.
	define("LANG_LABEL_PROFILE_TIP4", "This user has no activity in our portal yet.<br>Don't worry. You can still join our community by giving your opinion and evaluating your favorite ".LISTING_FEATURE_NAME_PLURAL.".");
	//Rated
	define("LANG_LABEL_RATED", "Rated");
	//Commented
	define("LANG_LABEL_COMMENTED", "Commented");
	//Redeemed deal
	define("LANG_LABEL_REDEEMED", "Redeemed ".PROMOTION_FEATURE_NAME);
	//Your redeem code is
	define("LANG_LABEL_DEAL_CODE", "Your redeem code is ");
	//View previous activities
	define("LANG_PREVIOUS_ACTIVITY", "View previous activities");
	//with
	define("LANG_WITH", "with");
	//Redeemed by
	define("LANG_LABEL_REDEEMED_BY", "Redeemed by");
	//You received [x] new review
	define("LANG_LABEL_NEW_REVIEW", "You received [x] new review");
	//You received [x] new reviews
	define("LANG_LABEL_NEW_REVIEWS", "You received [x] new reviews");
	//You received [x] new lead
	define("LANG_LABEL_NEW_LEAD", "You received [x] new lead");
	//You received [x] new leads
	define("LANG_LABEL_NEW_LEADS", "You received [x] new leads");

	# ----------------------------------------------------------------------------------------------------
	# NEW ADD MODULES FORMS
	# ----------------------------------------------------------------------------------------------------
	//You can change your [a]levels and pricing[/a] settings anytime you want.
	define("LANG_SELECTLEVEL_TIP", "You can change your [a]levels and pricing[/a] settings anytime you want.");
	//With the [a]listing types[/a] you can define specific categories for your listings, define extra fields and more.
	define("LANG_SELECT_LISTINGTEMPLATE_TIP", "With the [a]".LISTING_FEATURE_NAME." types[/a] you can define specific categories for your ".LISTING_FEATURE_NAME_PLURAL.", define extra fields and more.");
	//Save Changes
	define("LANG_SAVE_CHANGES", "Save Changes");
	//Type your listing title here.
	define("LANG_HOLDER_LISTINGTITLE", "Type your ".LISTING_FEATURE_NAME." title here.");
	//Type your deal title here.
	define("LANG_HOLDER_PROMOTIONTITLE", "Type your ".PROMOTION_FEATURE_NAME." title here.");
	//Type your banner title here.
	define("LANG_HOLDER_BANNERTITLE", "Type your ".BANNER_FEATURE_NAME." title here.");
	//Type your event title here.
	define("LANG_HOLDER_EVENTTITLE", "Type your ".EVENT_FEATURE_NAME." title here.");
	//Type your classified title here.
	define("LANG_HOLDER_CLASSIFIEDTITLE", "Type your ".CLASSIFIED_FEATURE_NAME." title here.");
	//Type your article title here.
	define("LANG_HOLDER_ARTICLETITLE", "Type your ".ARTICLE_FEATURE_NAME." title here.");
	//Type your post title here.
	define("LANG_HOLDER_BLOGTITLE", "Type your post title here.");
	//Basic Information
	define("LANG_BASIC_INFO", "Basic Information");
	//Click on the button to on right to select categories.
	define("LANG_SELECT_CATEGORIES", "Click on the button on the right to select categories.");
	//Add categories
	define("LANG_ADD_CATEGORIES", "Add categories");
	//Brief description of the listing.
	define("LANG_HOLDER_LISTINGSUMMARY", "Brief description of the ".LISTING_FEATURE_NAME.".");
	//Introduce the listing to the public in a clear and efficient way. Describe all features that make the establishment unique and a great option for clients.
	define("LANG_HOLDER_LISTINGDESCRIPTION", "Introduce the ".LISTING_FEATURE_NAME." to the public in a clear and efficient way. Describe all features that make the establishment unique and a great option for clients.");
	//Brief description of the deal.
	define("LANG_HOLDER_PROMOTIONSUMMARY", "Brief description of the ".PROMOTION_FEATURE_NAME.".");
	//Introduce the deal to the public in a clear and efficient way. Describe all features that make it worth.
	define("LANG_HOLDER_PROMOTIONDESCRIPTION", "Introduce the ".PROMOTION_FEATURE_NAME." to the public in a clear and efficient way. Describe all features that make it worth.");
	//Brief description of the event.
	define("LANG_HOLDER_EVENTSUMMARY", "Brief description of the ".EVENT_FEATURE_NAME.".");
	//Introduce the event to the public in a clear and efficient way. Describe highlights and features that will make people want to check it.
	define("LANG_HOLDER_EVENTDESCRIPTION", "Introduce the ".EVENT_FEATURE_NAME." to the public in a clear and efficient way. Describe highlights and features that will make people want to check it.");
	//Brief description of the classified.
	define("LANG_HOLDER_CLASSIFIEDSUMMARY", "Brief description of the ".CLASSIFIED_FEATURE_NAME.".");
	//Introduce the classified to the public in a clear and efficient way. Describe highlights and features that will make people want to buy your product/service.
	define("LANG_HOLDER_CLASSIFIEDDESCRIPTION", "Introduce the ".CLASSIFIED_FEATURE_NAME." to the public in a clear and efficient way. Describe highlights and features that will make people want to buy your product/service.");
	//Abstract of the article.
	define("LANG_HOLDER_ARTICLESUMMARY", "Abstract of the ".ARTICLE_FEATURE_NAME.".");
	//Type your keyword. Press 'Tab' or 'Enter' on your keyboard to confirm.
	define("LANG_HOLDER_KEYWORDS", "Type your keyword. Press 'Tab' or 'Enter' on your keyboard to confirm.");
	//Use this field to highlight some features that your business has to offer. Type one item per line.
	define("LANG_HOLDER_FEATURES", "Use this field to highlight some features that your business has to offer. Type one item per line.");
	//Do you have a discount code? Type it here.
	define("LANG_HOLDER_DISCOUNTCODE", "Do you have a discount code? Type it here.");
	//Paste your video URL here. Ex: http://www.youtube.com/watch?v=xxxx
	define("LANG_HOLDER_VIDEO", "Paste your video URL here. Ex: http://www.youtube.com/watch?v=xxxx");
	//Brief description of your video.
	define("LANG_HOLDER_VIDEOCAPTION", "Brief description of your video.");
	//This is how the link to download your file will be shown.
	define("LANG_HOLDER_ATTACHCAPTION", "This is how the link to download your file will be shown.");
	//Want to change your badges? Click here.
	define("LANG_HOLDER_BADGES", "Want to change your badges? Click here.");
	//Type here the terms & conditions for redeeming your deal.
	define("LANG_HOLDER_PROMOTIONCONDITIONS", "Type here the terms & conditions for redeeming your ".PROMOTION_FEATURE_NAME.".");
	//Could not load video. Please check your video URL and try again.
	define("LANG_VIDEO_NOTFOUND", "Could not load video. Please check your video URL and try again.");
	//You can select up to [max] categories.
	define("LANG_SELECTMAX_CATEGORIES", "You can select up to [max] categories.");
	//Please, wait...
	define("LANG_LABEL_FORM_WAIT", "Please, wait...");
	//Image Title
	define("LANG_LABEL_IMAGE_TITLE", "Image Title");
	//Image Description
	define("LANG_LABEL_IMAGE_DESCRIPTION", "Image Description");
	//Image Cropping & Description
	define("LANG_LABEL_IMAGE_CROP", "Image Cropping & Description");
	//Cropping
	define("LANG_LABEL_IMAGE_CROPPING", "Cropping");
    //Discount Type
    define("LANG_LABEL_DISCOUNT_TYPE", "Discount Type");
    //Need help? Take a look on the tutorial.
    define("LANG_LABEL_TUTORIAL", "Need help? Take a look on the tutorial.");
    //Fields Guide
    define("LANG_LABEL_TUTORIAL_FIELDS", "Fields Guide");
    //End tutorial
    define("LANG_LABEL_TUTORIAL_END", "End tutorial");
    //Social networks
    define("LANG_LABEL_SOCIALNETWORK", "Social networks");
    //This is the Title that identifies your item on the site. Keep it brief, yet effective.
	define("LANG_LABEL_TUTORIAL_TOUR-TITLE", "This is the Title that identifies your item on the site. Keep it brief, yet effective.");
	//Choose between different Listing Types that offer varying fields and layouts specific to common listings, or create a new Listing Type that suits your needs.
	define("LANG_LABEL_TUTORIAL_TOUR-TEMPLATE", "Choose between different ".LISTING_FEATURE_NAME." Types that offer varying fields and layouts specific to common ".LISTING_FEATURE_NAME_PLURAL.", or create a new ".LISTING_FEATURE_NAME." Type that suits your needs.");
	//Choose your item's Level here. Each Level can be customized to offer a different set of features for the item.
	define("LANG_LABEL_TUTORIAL_TOUR-LEVEL", "Choose your item's Level here. Each Level can be customized to offer a different set of features for the item.");
	//Choose the Categories that best fit your item. Visitors will find your item easily by browsing under specific Categories.
	define("LANG_LABEL_TUTORIAL_TOUR-CATEGORIES", "Choose the Categories that best fit your item. Visitors will find your item easily by browsing under specific Categories.");
	//This is the account that owns the item. You can change it to another account or leave your item with no owner.
	define("LANG_LABEL_TUTORIAL_TOUR-OWNER", "This is the account that owns the item. You can change it to another account or leave your item with no owner.");
	//Activated items will be available on the results page. Pending items have just been added to the site and are awaiting approval. Expired items have gone past their renewal date without payment and lastly, you can temporarily make an item Suspended at your choosing.
	define("LANG_LABEL_TUTORIAL_TOUR-STATUS", "Activated items will be available on the results page. Pending items have just been added to the site and are awaiting approval. Expired items have gone past their renewal date without payment and lastly, you can temporarily make an items Suspended at your choosing.");
	//You can manually set the Renewal Date for an item to set when the next payment is due.
	define("LANG_LABEL_TUTORIAL_TOUR-EXPIRATION", "You can manually set the Renewal Date for an items to set when the next payment is due.");
	//Check this box to disable the claim feature and not allow owners to claim their listings. Leave it blank if you want to allow users to claim their listings.
	define("LANG_LABEL_TUTORIAL_TOUR-CLAIM", "Check this box to disable the claim feature and not allow owners to claim their ".LISTING_FEATURE_NAME.". Leave it blank if you want to allow users to claim their ".LISTING_FEATURE_NAME.".");
	//This field is shown on the results page and briefly describes your item.
	define("LANG_LABEL_TUTORIAL_TOUR-SUMMARY", "This field is shown on the results page and briefly describes your item.");
	//Add more details about your item on this field. This full description will be shown on the item's detail page.
	define("LANG_LABEL_TUTORIAL_TOUR-DESCRIPTION", "Add more details about your item on this field. This full description will be shown on the item's detail page.");
	//You can tag specific keywords in this field. Keywords will help users to find your item when searching on the site.
	define("LANG_LABEL_TUTORIAL_TOUR-KEYWORDS", "You can tag specific keywords in this field. Keywords will help users to find your item when searching on the site.");
	//In this section you can add all the information for your item's location and contact. The more complete, the easier it is for customers to get in touch with you.
	define("LANG_LABEL_TUTORIAL_TOUR-CONTACT", "In this section you can add all the information for your item's location and contact. The more complete, the easier it is for customers to get in touch with you.");
	//Use this field to add a location reference for your listing. For example, two blocks from the mall.
	define("LANG_LABEL_TUTORIAL_TOUR-REFERENCE", "Use this field to add a location reference for your ".LISTING_FEATURE_NAME.". For example, two blocks from the mall.");
	//Does your event have a Facebook page? Type it here to show the Facebook wall widget on the event's detail page.
	define("LANG_LABEL_TUTORIAL_TOUR-FACEBOOK", "Does your ".EVENT_FEATURE_NAME." have a Facebook page? Type it here to show the Facebook wall widget on the ".EVENT_FEATURE_NAME."'s detail page.");
	//Use this field to highlight some features of your business or add any additional useful information, what makes it special.
	define("LANG_LABEL_TUTORIAL_TOUR-FEATURES", "Use this field to highlight some features of your business or add any additional useful information, what makes it special.");
	//Type the hours of work for your business here.
	define("LANG_LABEL_TUTORIAL_TOUR-HOURS", "Type the hours of work for your business here.");
	//If applicable, use this field to describe the average price for your products or services.
	define("LANG_LABEL_TUTORIAL_TOUR-PRICE", "If applicable, use this field to describe the average price for your products or services.");
	//Have a discount or promotional code? Type it here. The item's next payment will be affected.
	define("LANG_LABEL_TUTORIAL_TOUR-DISCOUNT", "Have a discount or promotional code? Type it here. The item's next payment will be affected.");
	//Use this box to drop and add images. You can click on a image to adjust the cropping and edit the title and description.
	define("LANG_LABEL_TUTORIAL_TOUR-IMAGES", "Use this box to drop and add images. You can click on a image to adjust the cropping and edit the title and description.");
	//Copy and paste your video URL here. Add a brief description to say what your video is about.
	define("LANG_LABEL_TUTORIAL_TOUR-VIDEO", "Copy and paste your video URL here. Add a brief description to say what your video is about.");
	//Use this field to attach an additional file. Use it for a Menu, Product Brochure, or whatever you'd like.
	define("LANG_LABEL_TUTORIAL_TOUR-FILE", "Use this field to attach an additional file. Use it for a Menu, Product Brochure, or whatever you'd like.");
	//You can help your owners to promote their businesses by designating badges for them.
	define("LANG_LABEL_TUTORIAL_TOUR-BADGES", "You can help your owners to promote their businesses by designating badges for them.");
	//Use this section to set some more additional information for your business.
	define("LANG_LABEL_TUTORIAL_TOUR-ADDITIONAL", "Use this section to set some more additional information for your business.");
	//Deals should be assigned to a listing in order to be shown on the results. Use this box to select a listing.
	define("LANG_LABEL_TUTORIAL_TOUR-LISTING", "".PROMOTION_FEATURE_NAME_PLURAL." should be assigned to a ".LISTING_FEATURE_NAME." in order to be shown on the results. Use this box to select a ".LISTING_FEATURE_NAME."");
	//This field is pre-filled with a default text that describes the terms of use and conditions to redeem a deal. You can change it to whatever you need.
	define("LANG_LABEL_TUTORIAL_TOUR-CONDITIONS", "This field is pre-filled with a default text that describes the terms of use and conditions to redeem a ".PROMOTION_FEATURE_NAME.". You can change it to whatever you need.");
	//Use this section to set when the deal will be available. After the end date hits, it will no longer be shown in any results.
	define("LANG_LABEL_TUTORIAL_TOUR-DATE2", "Use this section to set when the ".PROMOTION_FEATURE_NAME." will be available. After the end date hits, it will no longer be shown in any results.");
	//Use this box to add and edit an image for your deal.
	define("LANG_LABEL_TUTORIAL_TOUR-IMAGE", "Use this box to add and edit an image for your ".PROMOTION_FEATURE_NAME.".");
	//Use this section to set when your event is taking place. You can also use the Recurring checkbox to save an event that will be repeating on a regular basis.
	define("LANG_LABEL_TUTORIAL_TOUR-DATE", "Use this section to set when your ".EVENT_FEATURE_NAME." is taking place. You can also use the Recurring checkbox to save an ".EVENT_FEATURE_NAME." that will be repeating on a regular basis.");
	//Type the body of your article here. You can use the editor to format the text, add images, etc.
	define("LANG_LABEL_TUTORIAL_TOUR-CONTENT", "Type the body of your ".ARTICLE_FEATURE_NAME." here. You can use the editor to format the text, add images, etc.");
	//Impressions refer to the number of times the banner is shown on the frontend pages.
	define("LANG_LABEL_TUTORIAL_TOUR-IMPRESSIONS", "Impressions refer to the number of times the ".BANNER_FEATURE_NAME." is shown on the frontend pages.");
	//Use this field to identify the article's author.
	define("LANG_LABEL_TUTORIAL_TOUR-AUTHOR", "Use this field to identify the ".ARTICLE_FEATURE_NAME."'s author.");
	//If the article's author has a website, you can type it in here.
	define("LANG_LABEL_TUTORIAL_TOUR-AUTHORURL", "If the ".ARTICLE_FEATURE_NAME."'s author has a website, you can type it in here.");
	//Set the publication date for the article here.
	define("LANG_LABEL_TUTORIAL_TOUR-PUBLICATION", "Set the publication date for the ".ARTICLE_FEATURE_NAME." here.");
	//Use this field to give a quick overview of the article.
	define("LANG_LABEL_TUTORIAL_TOUR-ABSTRACT", "Use this field to give a quick overview of the ".ARTICLE_FEATURE_NAME.".");
	//Does your business have a profile in any of these social medias? Type it here to show buttons to your profiles on the detail page. For Facebook, the wall widget will also be shown.
	define("LANG_LABEL_TUTORIAL_TOUR-SOCIALNETWORK", "Does your business have a profile in any of these social medias? Type it here to show buttons to your profiles on the detail page. For Facebook, the wall widget will also be shown.");
	//Select an option below
	define("LANG_CHOOSE_DEAL_ATTACH", "Select an option below");
	//No deals available for association with this listing. In order to be linked to this listing, the deal should not be associated with other listing and should belong to the same account.
	define("LANG_ATTACHDEAL_UNAVAILABLE", "No ".PROMOTION_FEATURE_NAME_PLURAL." available for association with this ".LISTING_FEATURE_NAME.". In order to be linked to this ".LISTING_FEATURE_NAME.", the ".PROMOTION_FEATURE_NAME." should not be associated with other ".LISTING_FEATURE_NAME." and should belong to the same account.");
	//No listings available for association with this deal. In order to be linked to this deal, the listing should not be associated with other deal and should belong to the same account.
	define("LANG_ATTACHLISTING_UNAVAILABLE", "No listings available for association with this ".PROMOTION_FEATURE_NAME.". In order to be linked to this ".PROMOTION_FEATURE_NAME.", the ".LISTING_FEATURE_NAME." should not be associated with other ".PROMOTION_FEATURE_NAME." and should belong to the same account.");
    // You must associate a listing and a promotion with the same account.
    define("LANG_SITEMGR_ERROR_LISTING_PROMOTION_SITEMGR_ACCOUNT_DIFFER", "You must associate a ".LANG_LISTING." and a ".LANG_PROMOTION." with the same account.");
	//Leave it blank to unlink the deal.
	define("LANG_ATTACHDEAL_EMPTY", "Leave it blank to unlink the ".PROMOTION_FEATURE_NAME.".");
	//Recommended dimensions
	define("LANG_LABEL_RECOMMENDED_DIMENSIONS", "Recommended dimensions");
	//Cover Image
	define("LANG_LABEL_COVERIMAGE", "Cover Image");
	//Thumbnail
	define("LANG_LABEL_THUMBNAIL", "Thumbnail");
	//Changing the template now will remove the selected categories so far. Do you want to continue?
	define("LANG_CONFIRM_CHANGELISTINGTYPE", "Changing the template now will remove the selected categories so far. Do you want to continue?");
    // It was selected more classifieds than it is allowed.
    define("LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_QUANTITY", "It was selected more ".LANG_CLASSIFIED_FEATURE_NAME_PLURAL." than it is allowed.");
    // The association was successfully save.
    define("LANG_SITEMGR_ASSOCIATION_SUCCESSFULLY_SAVE", "The association was successfully save.");
    // You must associate a listing and a classified with the same account.
    define("LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_SITEMGR_ACCOUNT_DIFFER", "You must associate a ".LANG_LISTING." and a ".LANG_CLASSIFIED." with the same account.");
    // Association not allowed.
    define("LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_USER_ACCOUNT_DIFFER", "Association not allowed.");
    // This listing does not support more associations.
    define("LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_QUANTITY", "This ".LANG_LISTING." does not support more associations.");
	//Powered by
	define("LANG_POWEREDBY", "Powered by");
    //Select an option below
    define("LANG_CHOOSE_CLASSIFIED_ATTACH", "Select an option below");
    //Associate an existing classified with this listing
    define("LANG_SITEMGR_CLASSIFIED_ASSOCIATE", "Associate an existing ".LANG_CLASSIFIED." with this ".LISTING_FEATURE_NAME);
    //Leave it blank to unlink the classified
    define("LANG_ATTACHCLASSIFIED_EMPTY", "Leave it blank to unlink the ".LANG_CLASSIFIED.".");
    //Allow classified to be associated with no owner listing
    define("LANG_LABEL_CLASSIFIED_ASSOCIATION", "Allow ".LANG_CLASSIFIED." to be associated with no owner ".LISTING_FEATURE_NAME);
    //This option is just valid when you are adding or editing a classified
    define("LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_CLASSIFIED_ASSOCIATION", "This option is just valid when you are adding or editing a ".LANG_CLASSIFIED);
    //Welcome back! It's always good to see you here again!
    define("LANG_LABEL_WELCOMEBACK", "Welcome back! It's always good to see you here again!");
    //Sign up today and join our community!
    define("LANG_LABEL_SIGNUPTODAY", "Sign up today and join our community!");
    //Join us today and stay connected to businesses around the world.
    define("LANG_LABEL_JOINUSTODAY", "Join us today and stay connected to businesses around the world.");
    //With a single login using your computer, tablet, phone or our app!
    define("LANG_LABEL_LOGINEXPLANATION", "With a single login using your computer, tablet, phone or our app!");
    //Oops, something wrong happened. Please try again or contact us.
    define("LANG_LABEL_ERRORLOGIN", "Oops, something wrong happened. Please try again or contact us.");
