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
	# * FILE: /lang/tr_tr.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DATE/TIME
	# ----------------------------------------------------------------------------------------------------
	//january,february,march,april,may,june,july,august,september,october,november,december
	define("LANG_DATE_MONTHS", "ocak,şubat,mart,nisan,mayıs,haziran,temmuz,ağustos,eylül,ekim,kasım,aralık");
	//sunday,monday,tuesday,wednesday,thursday,friday,saturday
	define("LANG_DATE_WEEKDAYS", "pazar,pazartesi,salı,çarşamba,perşembe,cuma,cumartesi");
	//year
	define("LANG_YEAR", "yıl");
	//years
	define("LANG_YEAR_PLURAL", "yıllar");
	//month
	define("LANG_MONTH", "ay");
	//months
	define("LANG_MONTH_PLURAL", "aylar");
	//day
	define("LANG_DAY", "gün");
	//days
	define("LANG_DAY_PLURAL", "günler");
	//#,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z
	define("LANG_LETTERS", "#,a,b,c,ç,d,e,f,g,ğ,h,ı,i,j,k,l,m,n,o,ö,p,r,s,ş,t,u,ü,v,y,z");
	//y
	define("LANG_LETTER_YEAR", "y");
	//m
	define("LANG_LETTER_MONTH", "a");
	//d
	define("LANG_LETTER_DAY", "g");
	//Hour
	define("LANG_LABEL_HOUR", "Saat");
	//Minute
	define("LANG_LABEL_MINUTE", "Dakika");

	# ----------------------------------------------------------------------------------------------------
	# ZIPCODE
	# ----------------------------------------------------------------------------------------------------
	//ZIPCODE_UNIT - Available just for: mile or km
	define("ZIPCODE_UNIT", "km");
	//zipcode
	define("ZIPCODE_LABEL", "posta kodu");

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
	define("LANG_MENU_HOME", "Ana Sayfa");
	//Listings
	define("LANG_MENU_LISTING", "Listeler");
	//Events
	define("LANG_MENU_EVENT", "Aktiviteler");
	//Banners
	define("LANG_MENU_BANNER", "Afişler");
	//Classifieds
	define("LANG_MENU_CLASSIFIED", "İlanlar");
	//Articles
	define("LANG_MENU_ARTICLE", "Makaleler");
	//Deals
	define("LANG_MENU_PROMOTION", "Teklifler");
	//Blog
	define("LANG_MENU_BLOG", "Blog");
	//Advertise
	define("LANG_MENU_ADVERTISE", "İlan Verin");
	//FAQ
	define("LANG_MENU_FAQ", "SSS");
	//Sitemap
	define("LANG_MENU_SITEMAP", "Site haritası");
	//Contact Us
	define("LANG_MENU_CONTACT", "Bize Ulaşın");
	//Enquire
	define("LANG_MENU_ENQUIRE", "Sorgula");
	//Tell us about your project
	define("LANG_MENU_ENQUIRE2", "Projeniz hakkında bilgi verin");
	//Find us on LinkedIn
	define("LANG_ALT_LINKEDIN", "LinkedIn'ta bizi bulun");
	//Find us on Facebook
	define("LANG_ALT_FACEBOOK", "Facebook'ta bizi bulun");
	//Like Us on Facebook
	define("LANG_LIKE_FACEBOOK", "Facebook Bizi gibi");
	//Links
	define("LANG_LINKS", "Linkler");
	//Contact
	define("LANG_FOOTER_CONTACT", "İletişim");
	//Twitter
	define("LANG_TWITTER", "Twitter");
	//Twitter Updates
	define("LANG_TWITTER_UPDATES", "Twitter Güncellemeleri");
	//Follow us on Twitter
	define("LANG_FOLLOW_US_TWITTER", "Twitter bizi izleyin");
	//Follow Us
	define("LANG_FOLLOW_US", "Bizi izleyin");
	//Send Us a message
    define("LANG_CONTACT_SENDMSG", "Bize bir mesaj gönderin");
	//Site Content
    define("LANG_SITE_CONTENT", "Site İçeriği");
	//Learn More
	define("LANG_LABEL_LEARN_MORE", "Daha Fazla Bilgi");
	//Download our App
	define("LANG_LABEL_DOWNLOAD_APP", "Bizim <b>App</b> indirmek");

	# ----------------------------------------------------------------------------------------------------
	# JAVASCRIPT LANGUAGES VARIABLES
	# ----------------------------------------------------------------------------------------------------
	//Wait, Loading Category Tree...
	define("LANG_JS_LOADCATEGORYTREE", "Bekleyin, Kategori Ağacı Yükleniyor...");
	//Wait, Loading Locations...
	define("LANG_JS_LOADLOCATIONTREE", "Bekleyin, Mekanlar Ağacı Yükleniyor...");
	//Loading...
	define("LANG_JS_LOADING", "Yükleniyor...");
	//This item was added to your Favorites. You can view your Favorites in your profile page.
	define("LANG_JS_FAVORITEADD", "Bu kayıt favorilerinize eklendi.<br />Bu profil sayfanızda Sık görüntüleyebilirsiniz.");
	//This item was removed from your Favorites.
	define("LANG_JS_FAVORITEDEL", "Bu kayıt Favorilerimden kaldırıldı.");
	//weak
	define("LANG_JS_LABEL_WEAK", "güçsüz");
	//bad
	define("LANG_JS_LABEL_BAD", "kötü");
	//good
	define("LANG_JS_LABEL_GOOD", "iyi");
	//strong
	define("LANG_JS_LABEL_STRONG", "güçlü");
	//There was a problem retrieving the XML data:
	define("LANG_JS_ACCOUNTSEARCH_PROBLEMRETRIEVING", "XML verilerini getirirken bir hata oluştu:");
	//Click here to select an account.
	define("LANG_JS_ACCOUNTSEARCH_CLICKHERETOSELECT", "Bir hesap seçmek için tıklayın.");
	//Please provide at least a 3 letter word for the search!
	define("LANG_JS_ACCOUNTSEARCH_PLEASEPROVIDEATLEAST", "Lütfen arama için en az 3 harf girin!");
	//Server response failure!
	define("LANG_JS_ACCOUNTSEARCH_SERVERRESPONSEFAILURE", "Sunucu cevap hatası!");
	//Press ESC Key to close.
	define("LANG_JS_COLORPICKER_CLOSEMSG", "Kapatmak için Esc tuşuna basın.");
	//Hide Map
	define("LANG_JS_LABEL_HIDEMAP", "Haritayı Saklap");
	//Show Map
	define("LANG_JS_LABEL_SHOWMAP", "Haritayı Göster");
	//Show Graphics
	define("LANG_JS_LABEL_SHOWGRAPHICS", "Grafikleri Göster");
	//Hide Graphics
	define("LANG_JS_LABEL_HIDEGRAPHICS", "Grafikleri Sakla");
	//This item was already added to your Favorites.<br />You can view your Favorites in your profile page.
	define("LANG_JS_FAVORITES_ADDED", "Bu kayıt zaten favorilerinize eklendi.\n\nBu profil sayfanızda Sık görüntüleyebilirsiniz.");
	//Wait...
	define("LANG_JS_WAIT", "Bekle...");
	//Continue
	define("LANG_JS_CONTINUE", "Devam Et");
	//Close
	define("LANG_JS_CLOSE", "Kapat");
	//Add keyword
	define("LANG_JS_ADDKEYWORD", "Anahtar Kelime Ekle");
	//Add file
	define("LANG_JS_ADDFILE", "Dosya ekle");
	//Prev
	define("LANG_JS_PREV", "Önceki");
	//Next
	define("LANG_JS_NEXT", "Sonraki");
	//End Tour
	define("LANG_JS_END_TOUR", "Kapat");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDES
	# ----------------------------------------------------------------------------------------------------
	//You are using an older version of Internet Explorer that may affect the full functionality of some features. We recommend you upgrade to a newer version of Internet Explorer.
	define("LANG_IE6_WARNING", "Bazı özellikler tam işlevselliği etkileyebilir Internet Explorer'ın eski bir sürümünü kullanıyorsanız. Internet Explorer'ın yeni bir sürüme yükseltme önerilir.");
	//N/A
	define("LANG_NA", "N/A");
	//characters
	define("LANG_LABEL_CHARACTERES", "karakterler");
	//by
	define("LANG_BY", "-");
	//in
	define("LANG_IN", "içinde");
	//Read More
	define("LANG_READMORE", "Devamı");
	//More
	define("LANG_MORE", "diller");
	//Browse by Category
	define("LANG_BROWSEBYCATEGORY", "Kategoriye göre göster");
	//Browse by Location
	define("LANG_BROWSEBYLOCATION", "Yere göre göster");
	//Browse by Rating
	define("LANG_BROWSEBYREVIEW", "Yorum göre göster");
	//Browse Listings
	define("LANG_BROWSELISTINGS", "Listeler göre göster");
	//Browse Events
	define("LANG_BROWSEEVENTS", "Aktiviteler göre göster");
	//Browse Classifieds
	define("LANG_BROWSECLASSIFIEDS", "İlanlar göre göster");
	//Browse Articles
	define("LANG_BROWSEARTICLES", "Makaleler göre göster");
	//Browse Deals
	define("LANG_BROWSEPROMOTIONS", "Teklifler göre göster");
	//Browse Posts
	define("LANG_BROWSEPOSTS", "İletiler göre göster");
	//show
	define("LANG_SHOW", "göster");
	//hide
	define("LANG_HIDE", "sakla");
	//Bill to
	define("LANG_BILLTO", "Fatura");
	//Payable to
	define("LANG_PAYABLETO", "Ödenebilir");
	//Issuing Date
	define("LANG_ISSUINGDATE", "Düzenleme Tarihi");
	//Expire Date
	define("LANG_EXPIREDATE", "Son Kullanma Tarihi");
	//Questions
	define("LANG_QUESTIONS", "Sorular");
	//Please call
	define("LANG_PLEASECALL", "Lütfen bu numarayı arayın");
	//Invoice Info
	define("LANG_INVOICEINFO", "Fatura Bilgisi");
	//Invoice Logo
	define("LANG_LABEL_INVOICELOGO", "Fatura Logosu");
	//Payment Date
	define("LANG_PAYMENTDATE", "Ödeme Tarihi");
	//None
	define("LANG_NONE", "Yok");
	//Custom Invoice
	define("LANG_CUSTOM_INVOICE", "Özel Fatura");
	//Custom Invoices
	define("LANG_CUSTOM_INVOICES", "Özel Faturalar");
	//Locations
	define("LANG_LOCATIONS", "Yerler");
	//Close
	define("LANG_CLOSE", "Kapat");
	//Close this window
	define("LANG_CLOSEWINDOW", "Pencereyi kapat");
	//from
	define("LANG_FROM", "Dan");
	//Transaction Info
	define("LANG_TRANSACTION_INFO", "İşlem Bilgisi");
	//In manual transactions, subtotal and tax are not calculated.
	define("LANG_TRANSACTION_MANUAL", "Elle yapılan işlemlerde ara toplam ve vergi hesaplanmaz.");
	//creditcard
	define("LANG_CREDITCARD", "kredikartı");
	//Join Now!
	define("LANG_JOIN_NOW", "Bize Katılın!");
	//Create Your Account
	define("LANG_JOIN_PROFILE", "Hesabınızı Oluşturun");
	//More Information
	define("LANG_MOREINFO", "Daha Fazla Bilgi");
	//and
	define("LANG_AND", "ve");
	//Keyword sample 1: "Auto Parts"
	define("LANG_KEYWORD_SAMPLE_1", "Otomobil Parçaları");
	//Keyword sample 2: "Tires"
	define("LANG_KEYWORD_SAMPLE_2", "Lastikler");
	//Keyword sample 3: "Engine Repair"
	define("LANG_KEYWORD_SAMPLE_3", "Motor Tamiri");
	//Categories and sub-categories
	define("LANG_CATEGORIES_SUBCATEGS", "Kategoriler ve alt-kategoriler");
	//per
	define("LANG_PER", "her");
	//each
	define("LANG_EACH", "her");
	//impressions block
	define("LANG_IMPRESSIONSBLOCK", "izlenim bloğu");
	//Add
	define("LANG_ADD", "Ekle");
	//Manage
	define("LANG_MANAGE", "Yönet");
	//impressions to my paid credit of
	define("LANG_IMPRESSIONPAIDOF", "izlenimler benim ödenen kredime");
	//Section
	define("LANG_SECTION", "Bölüm");
	//General Pages
	define("LANG_GENERALPAGES", "Genel Sayfalar");
	//Open in a new window
	define("LANG_OPENNEWWINDOW", "Yeni bir pencerede aç");
	//No
	define("LANG_NO", "Hayır");
	//Yes
	define("LANG_YES", "Evet");
	//Dear
	define("LANG_DEAR", "Sayın");
	//Street Address, P.O. box
	define("LANG_ADDRESS_EXAMPLE", "Sokak Adresi, Posta Kodu");
	//Apartment, suite, unit, building, floor, etc.
	define("LANG_ADDRESS2_EXAMPLE", "Apartman, daire, birim, bina, kat, vs.");
	//or
	define("LANG_OR", "veya");
	//Hour of Work sample 1: "Sun 8:00 am - 6:00 pm"
	define("LANG_HOURWORK_SAMPLE_1", "Pazar 08:00 - 18:00 arası");
	//Hour of Work sample 2: "Mon 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_2", "Pazartesi 08:00 am - 21:00 arası");
	//Hour of Work sample 3: "Tue 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_3", "Salı 08:00 - 21:00 arası");
	//Additional Information
	define("LANG_EXTRA_FIELDS", "Ek Bilgiler");
	//Amenities
	define("LANG_TEMPLATE_AMENITIES", "Tesisler");
	//Sign me in automatically
	define("LANG_AUTOLOGIN", "Otomatik olarak oturum aç");
	//Check / Uncheck All
	define("LANG_CHECK_UNCHECK_ALL", "Tümünü Seç / Bırak");
	//Billing Information
	define("LANG_BIILING_INFORMATION", "Fatura Bilgisi");
	//Listing
	define("LANG_BUSINESS", "Liste");
	//on Listing
	define("LANG_ON_LISTING", "Listede");
	//on Event
	define("LANG_ON_EVENT", "Aktivitede");
	//on Banner
	define("LANG_ON_BANNER", "Afişte");
	//on Classified
	define("LANG_ON_CLASSIFIED", "İlanlarda");
	//on Article
	define("LANG_ON_ARTICLE", "Makalede");
	//Listing Name
	define("LANG_LISTING_NAME", "Liste Adı");
	//Event Name
	define("LANG_EVENT_NAME", "Aktivite Adı");
	//Banner Name
	define("LANG_BANNER_NAME", "Afiş Adı");
	//Classified Name
	define("LANG_CLASSIFIED_NAME", "İlan Adı");
	//Article Name
	define("LANG_ARTICLE_NAME", "Makale Adı");
	//Frequently Asked Questions
	define("LANG_FAQ_NAME", "Sık Sorulan Sorular");
	//How can we help you?
	define("LANG_FAQ_HELP", "Size nasıl yardımcı olabiliriz?");
	//Enter a question, keyword, topic...
	define("LANG_FAQ_TIP", "Bir soru, anahtar kelime, konu girin...");
	//click to crop image
	define("LANG_CROPIMAGE", "resmi kırpmak için tıklayın");
	//Did not find your answer? Contact us.
	define("LANG_FAQ_CONTACT", "Aradığınızı bulamadınız mı? Bize ulaşın.");
	//Active
	define("LANG_LABEL_ACTIVE", "Aktif");
	//Suspended
	define("LANG_LABEL_SUSPENDED", "Askıya Alınmış");
	//Expired
	define("LANG_LABEL_EXPIRED", "Süresi Dolmuş");
	//Pending
	define("LANG_LABEL_PENDING", "Beklemede");
	//Received
	define("LANG_LABEL_RECEIVED", "Alındı");
	//Promotional Code
	define("LANG_LABEL_DISCOUNTCODE", "Promosyon Kodu");
	//Account
	define("LANG_LABEL_ACCOUNT", "Hesap");
	//Change account
	define("LANG_LABEL_CHANGE_ACCOUNT", "Hesap değiştir");
	//Name or Title
	define("LANG_LABEL_NAME_OR_TITLE", "Ad veya Başlık");
	//Name
	define("LANG_LABEL_NAME", "Ad");
	//First, Last
	define("LANG_LABEL_FIRST_LAST", "İlk, Son");
	//Page Name
	define("LANG_LABEL_PAGE_NAME", "Sayfa Adı");
	//Summary Description
	define("LANG_LABEL_SUMMARY_DESCRIPTION", "Özet Tanım");
	//Category
	define("LANG_LABEL_CATEGORY", "Kategori");
	//Sub-Category
	define("LANG_LABEL_SUBCATEGORY", "Alt Kategori");
	//Category
	define("LANG_CATEGORY", "Kategori");
	//Categories
	define("LANG_LABEL_CATEGORY_PLURAL", "Kategoriler");
	//Categories
	define("LANG_CATEGORY_PLURAL", "Kategoriler");
	//Country
	define("LANG_LABEL_COUNTRY", "Ülke");
	//Region
	define("LANG_LABEL_REGION", "Bölge");
	//State
	define("LANG_LABEL_STATE", "İl");
	//City
	define("LANG_LABEL_CITY", "İlçe");
	//Neighborhood
	define("LANG_LABEL_NEIGHBORHOOD", "Mahalle");
	//Countries
	define("LANG_LABEL_COUNTRY_PL", "Ülkeler");
	//Regions
	define("LANG_LABEL_REGION_PL", "Bölgeler");
	//States
	define("LANG_LABEL_STATE_PL", "İller");
	//Cities
	define("LANG_LABEL_CITY_PL", "İlçeler");
	//Neighborhoods
	define("LANG_LABEL_NEIGHBORHOOD_PL", "Mahalleler");
	//Add a New Region
	define("LANG_LABEL_ADD_A_NEW_REGION", "Yeni bölge ekle");
	//Add a New State
	define("LANG_LABEL_ADD_A_NEW_STATE", "Yeni il ekle");
	//Add a New City
	define("LANG_LABEL_ADD_A_NEW_CITY", "Yeni ilçe ekle");
	//Add a New Neighborhood
	define("LANG_LABEL_ADD_A_NEW_NEIGHBORHOOD", "Yeni mahalle ekle");
	//Choose an Existing Region
	define("LANG_LABEL_CHOOSE_AN_EXISTING_REGION", "Mevcut olan bir bölge seç");
	//Choose an Existing State
	define("LANG_LABEL_CHOOSE_AN_EXISTING_STATE", "Mevcut olan bir il seç");
	//Choose an Existing City
	define("LANG_LABEL_CHOOSE_AN_EXISTING_CITY", "Mevcut olan bir ilçe seç");
	//Choose an Existing Neighborhood
	define("LANG_LABEL_CHOOSE_AN_EXISTING_NEIGHBORHOOD", "Mevcut olan bir mahalle seç");
	//Top Countries
	define("LANG_LABEL_TOP_COUNTRY", "İyi Ülkeler");
	//Top Regions
	define("LANG_LABEL_TOP_REGION", "İyi Bölgeler");
	//Top States
	define("LANG_LABEL_TOP_STATE", "İyi İller");
	//Top Cities
	define("LANG_LABEL_TOP_CITY", "İyi İlçeler");
	//Top Neighborhoods
	define("LANG_LABEL_TOP_NEIGHBORHOOD", "İyi Mahalleler");
	//No locations found.
	define("LANG_LABEL_NO_LOCATIONS_FOUND", "Yer bulunamadı");
	//Renewal
	define("LANG_LABEL_RENEWAL", "Yenileme");
	//Renewal Date
	define("LANG_LABEL_RENEWAL_DATE", "Yenileme Tarihi");
	//Street Address
	define("LANG_LABEL_STREET_ADDRESS", "Adres");
	//Web Address
	define("LANG_LABEL_WEB_ADDRESS", "Web Sayfası");
	//Phone
	define("LANG_LABEL_PHONE", "Telefon");
	//Fax
	define("LANG_LABEL_FAX", "Faks");
	//Long Description
	define("LANG_LABEL_LONG_DESCRIPTION", "Uzun Tanım");
	//Status
	define("LANG_LABEL_STATUS", "Statü");
	//Level
	define("LANG_LABEL_LEVEL", "Seviye");
	//Empty
	define("LANG_LABEL_EMPTY", "Boş");
	//Videos (Youtube etc)
	define("LANG_LABEL_VIDEOS", "Videolar (Youtube etc)");
	//Additional Uploads (PDF, DOC, TXT, GIF or PNG)
	define("LANG_LABEL_ATTACH", "Ek Yüklenen (PDF, DOC, TXT, JPG, GIF, PNG)");
	//Facebook page
	define("LANG_LABEL_FBPAGE", "Facebook sayfası");
	//Features
	define("LANG_LABEL_FEATURES", "Özellikler");
	//Classified Price
	define("LANG_LABEL_CLASSIFIED_PRICE", "Seri Fiyat");
	//Event Time
	define("LANG_LABEL_EVENTTIME", "Olay Zaman");
	//Imagery
	define("LANG_LABEL_IMAGERY", "Görüntüler");
	//Start Date
	define("LANG_LABEL_START_DATE", "Başlangıç Tarihi");
	//Start Date
	define("LANG_LABEL_STARTDATE", "Bitiş Tarihi");
	//End Date
	define("LANG_LABEL_END_DATE", "Bitiş Tarihi");
	//End Date
	define("LANG_LABEL_ENDDATE", "Bitiş Tarihi");
	//Invalid date
	define("LANG_LABEL_INVALID_DATE", "Geçersiz tarih");
	//Start Time
	define("LANG_LABEL_START_TIME", "Başlangıç Saati");
	//End Time
	define("LANG_LABEL_END_TIME", "Bitiş Saati");
	//Unlimited
	define("LANG_LABEL_UNLIMITED", "Sınırsız");
	//Select
	define("LANG_LABEL_SELECT", "Seçiniz");
	//Selected
	define("LANG_LABEL_SELECTED", "Seçilmiş");
	//Select a Type
	define("LANG_LABEL_SELECT_TYPE", "Tür seç");
	//Select a Category
	define("LANG_LABEL_SELECT_CATEGORY", "Kategori seç");
	//Time Left
	define("LANG_LABEL_TIMELEFT", "Kalan Süre");
	//View Deal
	define("LANG_LABEl_VIEW_DEAL", "Teklif Görüntüle");
	//No Deal
	define("LANG_LABEL_NO_PROMOTION", "Teklif yok");
	//Select a Deal
	define("LANG_LABEL_SELECT_PROMOTION", "Teklif Seç");
	//Great Offer!
	define("LANG_LABEL_GREAT_OFFER", "Büyük Teklif!");
	//Contact Name
	define("LANG_LABEL_CONTACTNAME", "Yetkili Adı");
	//Contact Name
	define("LANG_LABEL_CONTACT_NAME", "Yetkili Adı");
	//Contact Phone
	define("LANG_LABEL_CONTACT_PHONE", "Yetkilinin Telefonu");
	//Contact Fax
	define("LANG_LABEL_CONTACT_FAX", "Yetkilinin Faksı");
	//Contact E-mail
	define("LANG_LABEL_CONTACT_EMAIL", "Yetkilinin E-posta Adresi");
	//URL
	define("LANG_LABEL_URL", "URL");
	//Address
	define("LANG_LABEL_ADDRESS", "Adres");
	//E-mail
	define("LANG_LABEL_EMAIL", "E-posta");
	//Notify me about listing reviews and listing traffic
	define("LANG_LABEL_NOTIFY_TRAFFIC", "Liste yorum ve listeleme trafiği hakkında bildir.");
	//Invoice
	define("LANG_LABEL_INVOICE", "Fatura");
	//Invoice #
	define("LANG_LABEL_INVOICENUMBER", "Fatura No:");
	//Item
	define("LANG_LABEL_ITEM", "Kayıt");
	//Items
	define("LANG_LABEL_ITEMS", "Kayıtlar");
	//Extra Category
	define("LANG_LABEL_EXTRA_CATEGORY", "Ekstra Kategori");
	//Discount Code
	define("LANG_LABEL_DISCOUNT_CODE", "İndirim Kodu");
	//Item Price
	define("LANG_LABEL_ITEMPRICE", "Kayıt Fiyatı");
	//Amount
	define("LANG_LABEL_AMOUNT", "Tutar");
	//Tax
	define("LANG_LABEL_TAX", "Vergi");
	//Subtotal
	define("LANG_LABEL_SUBTOTAL", "Aratoplam");
	//Make checks payable to
	define("LANG_LABEL_MAKE_CHECKS_PAYABLE", "Çek ödemesi");
	//Total
	define("LANG_LABEL_TOTAL", "Toplam");
	//Id
	define("LANG_LABEL_ID", "Kimlik");
	//IP
	define("LANG_LABEL_IP", "IP");
	//Title
	define("LANG_LABEL_TITLE", "Başlık");
	//Caption
	define("LANG_LABEL_CAPTION", "Altyazı");
	//impressions
	define("LANG_IMPRESSIONS", "izlenimler");
	//Impressions
	define("LANG_LABEL_IMPRESSIONS", "İzlenimler");
	//By impressions
	define("LANG_LABEL_BY_IMPRESSIONS", "Gösterimlerine");
	//By time period
	define("LANG_LABEL_BY_PERIOD", "Zaman diliminde");
	//Date
	define("LANG_LABEL_DATE", "Tarih");
	//Your E-mail
	define("LANG_LABEL_YOUREMAIL", "E-Posta Adresiniz");
	//Subject
	define("LANG_LABEL_SUBJECT", "Konu");
	//Additional message
	define("LANG_LABEL_ADDITIONALMSG", "Mesaj");
	//Payment type
	define("LANG_LABEL_PAYMENT_TYPE", "Ödeme şekli");
	//Notes
	define("LANG_LABEL_NOTES", "Notlar");
	//It's easy and fast!
	define("LANG_LABEL_EASYFAST", "Kolay ve de hızlı!");
	//Write reviews, comment on blog
	define("LANG_LABEL_FOR_PROFILE", "Bloga yorum yazın");
	//Write reviews
	define("LANG_LABEL_FOR_PROFILE2", "Yorum yazın");
	//Based on
	define("LANG_LABEL_BASED_ON", "Geçerli");
	//Write a review
	define("LANG_WRITE_REVIEW", "Bir yorum yazın");
	//Already have access?
	define("LANG_LABEL_ALREADYMEMBER", "Zaten erişiminiz var mı?");
	//Enjoy our services!
	define("LANG_LABEL_ENJOYSERVICES", "Hizmetimizin tadını çıkarın!");
	//Test Password
	define("LANG_LABEL_TESTPASSWORD", "Test Şifresi");
	//Forgot your password?
	define("LANG_LABEL_FORGOTPASSWORD", "Şifrenizi unuttunuz mu?");
	//Summary
	define("LANG_LABEL_SUMMARY", "Özet");
	//Detail
	define("LANG_LABEL_DETAIL", "Detay");
	//(your friend's e-mail)
	define("LANG_LABEL_FRIEND_EMAIL", "(Arkadaşınızın e-posta)");
	//General Contact Form
	define("LANG_LABEL_GENERAL_FORM", "Genel İletişim Formu");
	//For
	define("LANG_LABEL_FOR", "Dolayı");
	//Created
	define("LANG_LABEL_CREATED", "Düzenlendi");
	//From
	define("LANG_LABEL_FROM", "Dan");
	//To
	define("LANG_LABEL_TO", "Gönderilen");
	//to
	define("LANG_LABEL_DATE_TO", "kadar");
	//Last
	define("LANG_LABEL_LAST", "Son");
	//Last
	define("LANG_LABEL_LAST_PLURAL", "Son");
	//day
	define("LANG_LABEL_DAY", "gün");
	//days
	define("LANG_LABEL_DAYS", "günler");
	//New
	define("LANG_LABEL_NEW", "Yeni");
	//New FAQ
	define("LANG_LABEL_NEW_FAQ", "Yeni FAQ");
	//Type
	define("LANG_LABEL_TYPE", "Tür");
	//ClickThru
	define("LANG_LABEL_CLICKTHRU", "Tıklama");
	//Added
	define("LANG_LABEL_ADDED", "Eklendi");
    //Added on
    define("LANG_LABEL_ADDED_ON", "Eklendi");
    //There are no pending items.
    define("LANG_LABEL_NO_PENDING_ITEMS", "Bekleyen öğeler vardır.");
    //There are no pending reviews.
    define("LANG_LABEL_NO_PENDING_REVIEWS", "Bekleyen yorum var.");
    //more
    define("LANG_LABEL_PLUS_REVIEWS", "devamı [X]");
	//rates this item with
    define("LANG_LABEL_REVIEW_RATES", "ile oranları bu [item]");
    //Did you find this review helpful?
    define("LANG_LABEL_REVIEW_HELPFUL", "Bu değerlendirmeyi yararlı buldunuz mu?");
    //Blog Comment
    define("LANG_LAVEL_BLOG_COMMENT", "Blogun Yorum");
	//Post Title
	define("LANG_BLOG_TITLE", "Mesaj Başlığı");
	//Add
	define("LANG_LABEL_ADD", "Ekle");
	//rating
	define("LANG_LABEL_RATING", "puanlama");
	//evaluator
	define("LANG_LABEL_EVALUATOR", "değerlendirici");
	//Reviewer
	define("LANG_LABEL_REVIEWER", "Yorumcu");
	//System
	define("LANG_LABEL_SYSTEM", "Sistem");
	//Subscribe to RSS
	define("LANG_LABEL_SUBSCRIBERSS", "RSS'ye üye olun");
	//Guide
	define("LANG_LABEL_GUIDE", "Kılavuz");
	//Password strength
	define("LANG_LABEL_PASSWORDSTRENGTH", "Şifre gücü");
	//Article Title
	define("LANG_ARTICLE_TITLE", "Makale Başlığı");
	//SEO Description
	define("LANG_SEO_DESCRIPTION", "SEO Tanımı");
	//SEO Keywords
	define("LANG_SEO_KEYWORDS", "SEO Anahtar Kelimeleri");
	//No line breaks allowed
	define("LANG_SEO_LINEBREAK", "satır sonları kabul edilmiyor");
	//Separate elements with comma (,)
	define("LANG_SEO_COLON", "sözcükleri virgülle (,) ayırın");
	//Click here to edit the SEO information of this item
	define("LANG_MSG_CLICK_TO_EDIT_SEOCENTER", "Bu kaydın SEO bilgilerini değiştirmek için tıklayın");
	//SEO successfully updated!
	define("LANG_MSG_SEOCENTER_ITEMUPDATED", "SEO başarılı olarak güncellendi!");
	//Click here to view this article
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE", "Bu makaleyi görmek için tıklayın");
	//Click here to edit this article
	define("LANG_MSG_CLICK_TO_EDIT_THIS_ARTICLE", "Bu makaleyi düzenlemek için tıklayın");
	//Click here to view this article reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE_REPORTS", "Bu makalenin raporlarını görmek için tıklayın");
	//History for this article
	define("LANG_HISTORY_FOR_THIS_ARTICLE", "Bu makalenin geçmişi");
	//History not available for this article
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_ARTICLE", "Bu makale için geçmiş henüz mevcut değil");
	//Click here to delete this article
	define("LANG_MSG_CLICK_TO_DELETE_THIS_ARTICLE", "Bu makaleyi silmek için tıklayın.");
	//Click here to view this banner
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER", "Bu afişi görmek için tıklayın");
	//Click here to edit this banner
	define("LANG_MSG_CLICK_TO_EDIT_THIS_BANNER", "Bu afişi düzenlemek için tıklayın.");
	//Click here to view this banner reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER_REPORTS", "Bu afişin raporlarını görmek için tıklayın.");
	//History for this banner
	define("LANG_HISTORY_FOR_THIS_BANNER", "Bu afişin geçmişi.");
	//History not available for this banner
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_BANNER", "Bu afiş için henüz geçmiş mevcut değil.");
	//Click here to delete this banner
	define("LANG_MSG_CLICK_TO_DELETE_THIS_BANNER", "Bu afişi silmek için tıklayın");
	//Classified Title
	define("LANG_CLASSIFIED_TITLE", "İlan Başlığı");
	//Click here to
	define("LANG_MSG_CLICKTO", "için tıklayın");
	//Click here to view this classified
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED", "Bu ilanı görmek için tıklayın");
	//Click here to edit this classified
	define("LANG_MSG_CLICK_TO_EDIT_THIS_CLASSIFIED", "Bu ilanı düzenlemek için tıklayın");
	//Click here to view this classified reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED_REPORTS", "Bu ilan raporlarını görmek için tıklayın");
	//Click here to map tuning this classified location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_CLASSIFIED", "Bu ilanın harita ayarları için tıklayın");
	//Map tuning not available for this classified
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_CLASSIFIED", "Bu ilan için harita ayarları henüz mevcut değil");
	//History for this classified
	define("LANG_HISTORY_FOR_THIS_CLASSIFIED", "Bu ilanın geçmişi");
	//History not available for this classified
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_CLASSIFIED", "Bu ilan için geçmiş henüz mevcut değil");
	//Click here to delete this classified
	define("LANG_MSG_CLICK_TO_DELETE_THIS_CLASSIFIED", "Bu ilanı silmek için tıklayın");
	//Event Title
	define("LANG_EVENT_TITLE", "Aktivite Başlığı");
	//Click here to view this event
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT", "Bu aktiviteyi görmek için tıklayın");
	//Click here to edit this event
	define("LANG_MSG_CLICK_TO_EDIT_THIS_EVENT", "Bu aktiviteyi düzenlemek için tıklayın");
	//Click here to view this event reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT_REPORTS", "Bu aktivitenin raporlarını görmek için tıklayın");
	//Click here to map tuning this event location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_EVENT", "Bu aktivitenin harita ayarları için tıklayın");
	//Map tuning not available for this event
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_EVENT", "Bu aktivite için harita ayarları henüz mevcut değil");
	//History for this event
	define("LANG_HISTORY_FOR_THIS_EVENT", "Bu aktivitenin geçmişi");
	//History not available for this event
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_EVENT", "Bu aktivite için geçmiş henüz mevcut değil");
	//Click here to delete this event
	define("LANG_MSG_CLICK_TO_DELETE_THIS_EVENT", "Bu aktiviteyi silmek için tıklayın");
	//Listing Title
	define("LANG_LISTING_TITLE", "Liste Başlığı");
	//Click here to view this listing
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING", "Bu listeyi görmek için tıklayın");
	//Click here to edit this listing
	define("LANG_MSG_CLICK_TO_EDIT_THIS_LISTING", "Bu listeyi düzenlemek için tıklayın");
	//Click here to change deal for this listing
	define("LANG_MSG_CLICK_TO_CHANGE_PROMOTION", "Bu listenin bu teklif değiştirmek için tıklayın");
	//Deal not available for this listing
	define("LANG_MSG_PROMOTION_NOT_AVAILABLE", "Bu liste için teklif mevcut değil");
	//Click here to view this listing reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING_REPORTS", "Bu listenin raporlarını görmek için tıklayın");
	//Click here to map tuning this listing location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_LISTING", "Bu listenin harita ayarları için tıklayın");
	//Map tuning not available for this listing
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_LISTING", "Bu liste için harita ayarları mevcut değil");
	//Map tuning Address Not Found
	define("LANG_MAPTUNING_ADDRESSNOTFOUND", "Adres bulunmadı");
	//Map tuning Please Edit Your Item
	define("LANG_MAPTUNING_PLEASEEDITYOURITEM", "Lütfen kaydınızı düzenleyin");
	//Click here to view this item reviews
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS", "Bu kaydın yorumlarını görmek için tıklayın");
	//Item reviews not available
	define("LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE", "Kayıt yorumları mevcut değil ");
	//History for this listing
	define("LANG_HISTORY_FOR_THIS_LISTING", "Bu listenin geçmişi");
	//History not available for this listing
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_LISTING", "Bu liste için geçmiş henüz mevcut değil");
	//Click here to delete this listing
	define("LANG_MSG_CLICK_TO_DELETE_THIS_LISTING", "Bu listeyi silmek için tıklayın");
	//Save
	define("LANG_MSG_SAVE_CHANGES", "Kaydet");
	//More Information
	define("LANG_MSG_MORE_INFO", "Daha fazla Bilgi");
	//(Try to use something descriptive, like "10% off of our product" or "3 for the price of two on our product")
	define("LANG_MSG_DEALTITLE_TIP", "(\"Ürün iki fiyatına 3\" veya \"Ürünümüzün 10% indirim\" gibi bir tanımlayıcı, kullanmaya çalışın.)");
	//Enter the value of the item / service you are offering. Choose a discount type (Fixed Value or Percentage), and enter the respective value. Check the calculation and then provide us with the number of offers you wish to make.
	define("LANG_MSG_ADD_DEAL_TIP", "Size sunuyoruz öğenin değerini girin. Bir indirim türü (Sabit Değer veya Yüzde) seçin ve ilgili değeri girin. hesaplama kontrol edin ve sonra yapmak istediğiniz tekliflerinin sayısını bize.");
	//Please be sure your image is the right size before you upload it, otherwise the image will likely be stretched to fit the site and image quality will be affected.
	define("LANG_MSG_ADD_DEAL_TIP2", "Aksi takdirde görüntü muhtemel site ve görüntü kalitesi etkilenecektir sığdırmak için gergin olacak yükleyin önce görüntü, uygun büyüklükte olduğundan emin olun.");
	//Every deal needs to be linked to a listing in order to be active on the site.
	define("LANG_MS_MANGE_DEAL_TIP", "Her anlaşma için sitede aktif olabilmek için bir liste ile bağlantılı olması gerekir.");
	//Associate with the listing
	define("LANG_DEAL_LISTING_SELECT", "Liste ile ilişkilendirmek");
	//Please type your item title and wait for suggestions of available associations.
	define("LANG_DEAL_LISTING_TIP", "Öğeniz başlığını yazın ve mevcut derneklerin önerileri için bekleyin.");
	//Empty
	define("LANG_EMPTY", "Boş");
	//Cancel
	define("LANG_CANCEL", "İptal");
	//Custom Time Period
	define("LANG_SITEMGR_CUSTOMPERIOD", "Özel Zaman Aralığı");
	//Fixed Value Discount
	define("LANG_LABEL_FIXEDVALUE_DISC", "Sabit değer İndirim");
	//Percentage Discount
	define("LANG_LABEL_PERCENTAGE_DISC", "Yüzde İndirim");
	//Value with Discount
	define("LANG_LABEL_DISC_AMOUNT", "Indirim ile Değer");
	//Discount (Calculated)
	define("LANG_LABEL_DISC_CALCULATED", "Indirim (Hesaplanan)");
	//How many deals would you like to offer
	define("LANG_LABEL_DEALS_OFFER", "Kaç anlaşma size sunmak istiyorum");
	//Linked to Listing
	define("LANG_LABEL_ATTACHED_LISTING", "Listeleme Bağlı");
	//Choose a Listing
	define("LANG_LABEL_CHOOSE_LISTING", "Bir Liste seçin");
	//You can not add different deals to the same listing
	define("LANG_MSG_REPEATED_LISTINGS", "Aynı liste için farklı fırsatlar ekleyemezsiniz.");
	//Deals successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATE", "Fırsatlar başarıyla güncellendi!");
	//Options
	define("LANG_LABEL_OPTIONS", "Seçenekleri");
	//Deal Title
	define("LANG_PROMOTION_TITLE", "Teklif Başlık");
	//Click here to view this deal
	define("LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION", "Bu teklif görmek için tıklayın");
	//Click here to edit this deal
	define("LANG_MSG_CLICK_TO_EDIT_THIS_PROMOTION", "Bu teklif düzenlemek için tıklayın");
	//Click here to view this deal reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION_REPORTS", "Bu tıklayın raporlarını görmek için tıklayın");
	//Click here to delete this deal
	define("LANG_MSG_CLICK_TO_DELETE_THIS_PROMOTION", "Bu teklif silmek için tıklayın");
	//Go to "Listings" and click on the deal icon belonging to the listing where you want to add the deal. Select one deal to add to your listing to make it live.
	define("LANG_PROMOTION_EXTRAMESSAGE", "\"Listeler\" e gidin ve teklif eklemek istediğiniz listeye ait olan teklif sembolüne tıklayın. Listenize ekleyip yayınlamak için bir teklif seçin.");
	//The installments will be recurring until your credit card expiration
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATION", "Taksitler kredi kartınızın son kullanma tarihi dolana kadar tekrar edecektir");
	//The installments will be recurring until your credit card expiration ("maximum of 36 installments")
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATIONMAXOF", "en fazla 36 taksit");
	//SEO Center
	define("LANG_MSG_SEO_CENTER", "SEO Merkezi");
	//View
	define("LANG_LABEL_VIEW", "Görünüm");
	//Edit
	define("LANG_LABEL_EDIT", "Düzenleme");
	//Traffic Reports
	define("LANG_TRAFFIC_REPORTS", "Trafik Raporları");
	//Unpaid
	define("LANG_LABEL_UNPAID", "Ödenmemiş");
	//Paid
	define("LANG_LABEL_PAID", "Ödenmiş");
	//Waiting payment approval
	define("LANG_LABEL_WAITING", "Ödeme onayı bekliyorum");
	//Under review
	define("LANG_LABEL_ANALYSIS", "Inceleniyor");
	//Available
	define("LANG_LABEL_AVAILABLE", "Mevcut");
	//In dispute
	define("LANG_LABEL_DISPUTE", "Anlaşmazlık");
	//Refunded
	define("LANG_LABEL_REFUNDED", "Iade");
	//Cancelled
	define("LANG_LABEL_CANCELLED", "İptal Edildi");
	//Transaction
	define("LANG_LABEL_TRANSACTION", "İşlem");
	//Delete
	define("LANG_LABEL_DELETE", "Sil");
	//Download
	define("LANG_LABEL_DOWNLOAD", "Indir");
	//Map Tuning
	define("LANG_LABEL_MAP_TUNING", "Harita Ayarları");
	//Hide Map
	define("LANG_LABEL_HIDEMAP", "Haritayı Sakla");
	//Show Map
	define("LANG_LABEL_SHOWMAP", "Haritayı Göster");
	//SEO
	define("LANG_LABEL_SEO_TUNING", "SEO");
	//Print
	define("LANG_LABEL_PRINT", "Yazdır");
	//Pending Approval
	define("LANG_LABEL_PENDING_APPROVAL", "Onay Bekliyor");
	//Image
	define("LANG_LABEL_IMAGE", "Resim");
	//Images
	define("LANG_LABEL_IMAGE_PLURAL", "Resimler");
	//Required field
	define("LANG_LABEL_REQUIRED_FIELD", "Gerekli Alan");
	//Please type all the required fields.
	define("LANG_LABEL_TYPE_FIELDS", "Gerekli tüm alanları yazın.");
	//Account Information
	define("LANG_LABEL_ACCOUNT_INFORMATION", "Hesap Bilgileri");
	//E-mail
	define("LANG_LABEL_USERNAME", "E-posta");
    //Username
	define("LANG_LABEL_USERNAME2", "Kullanıcı Adı");
	//Current Password
	define("LANG_LABEL_CURRENT_PASSWORD", "Şimdiki şifreniz");
	//Password
	define("LANG_LABEL_PASSWORD", "Şifre");
	//Password not changed.
	define("LANG_PASSWORD_NOT_CHANGED", "Şifre değişmedi.");
	//Create Password
	define("LANG_LABEL_CREATE_PASSWORD", "Ş​ifre Oluştur");
	//New Password
	define("LANG_LABEL_NEW_PASSWORD", "Yeni Şifre");
	//Retype Password
	define("LANG_LABEL_RETYPE_PASSWORD", "Şifrenizi Tekrarlayın");
	//Retype Password
	define("LANG_LABEL_RETYPEPASSWORD", "Şifrenizi Tekrarlayın");
	//Retype New Password
	define("LANG_LABEL_RETYPE_NEW_PASSWORD", "Yeni Şifrenizi Tekrar Girin");
	//OpenID URL
	define("LANG_LABEL_OPENIDURL", "OpenID URL");
	//Information
	define("LANG_LABEL_INFORMATION", "Bilgiler");
	//Publication Date
	define("LANG_LABEL_PUBLICATION_DATE", "Yayın Tarihi");
	//Calendar
	define("LANG_LABEL_CALENDAR", "Takvim");
	//Friendly Url
	define("LANG_LABEL_FRIENDLY_URL", "Friendly Url");
	//For example
	define("LANG_LABEL_FOR_EXAMPLE", "Örnek");
	//Image Source
	define("LANG_LABEL_IMAGE_SOURCE", "Resim Kaynağı");
	//Image Attribute
	define("LANG_LABEL_IMAGE_ATTRIBUTE", "Resim Niteliği");
	//Image Caption
	define("LANG_LABEL_IMAGE_CAPTION", "Resim Altyazısı");
	//Abstract
	define("LANG_LABEL_ABSTRACT", "Özet");
	//Keywords for the search
	define("LANG_LABEL_KEYWORDS_FOR_SEARCH", "Arama için anahtar kelimeler");
	//Refine By...
	define("LANG_LABEL_REFINEBY", "Filtre...");
	//You refined by...
	define("LANG_LABEL_REFINEDBY", "Sen rafine ...");
	//Remove all
	define("LANG_LABEL_REMOVE_ALL", "Tümünü kaldır");
	//Show only listings with deals
	define("LANG_LABEL_FILTER_DEAL", "Sadece listeleri teklif ile göster");
	//maximum
	define("LANG_LABEL_MAX", "en fazla");
	//keywords
	define("LANG_LABEL_KEYWORDS", "anahtar kelime");
	//Content
	define("LANG_LABEL_CONTENT", "İçerik");
	//Code
	define("LANG_LABEL_CODE", "Kod");
	//free
	define("LANG_FREE", "BEDAVA");
	//free
	define("LANG_LABEL_FREE", "bedava");
	//free
	define("LANG_INCLUDED", "dahil");
	//Destination Url
	define("LANG_LABEL_DESTINATION_URL", "Hedef Url");
	//Script
	define("LANG_LABEL_SCRIPT", "Kod");
	//File
	define("LANG_LABEL_FILE", "Dosya");
	//Warning
	define("LANG_LABEL_WARNING", "Uyarı");
	//Display URL (optional)
	define("LANG_LABEL_DISPLAY_URL", "Gösterilen URL (seçmeli)");
	//Visit Website
	define("LANG_VISIT_WEBSITE", "Web sitesini ziyaret edin");
	//Description line 1
	define("LANG_LABEL_DESCRIPTION_LINE1", "Tanım satırı 1");
	//Description line 2
	define("LANG_LABEL_DESCRIPTION_LINE2", "Tanım satırı 2");
	//Location
	define("LANG_LABEL_LOCATIONS", "Adres bilgileri");
	//Enter a landmark or point of reference for your listing's location.
	define("LANG_LABEL_LOCATIONS_TIP", "Ürününüzü bir referans konuma girmek için bu alanı kullanın");
	//Would you like to add more information about your item? Besides your gallery images, you can upload an additional file with extra information here
	define("LANG_LABEL_ATTACH_ADDITIONAL_FILE_TIP", "Eğer öğe hakkında daha fazla bilgi eklemek ister misiniz? Galeri görüntüleri yanı sıra, burada ek bilgileri ile ek bir dosya yükleyebilirsiniz");
	//Fill in this field if your URL is too long. Example: "www.example.com" can be shown as "Example".
	define("LANG_LABEL_DISPLAY_URL_TIP", "URL çok uzunsa, bu alanda doldurun. Örnek: \"www.ornek.com\" \"Örnek\" olarak gösterilebilir.");
	//Enable monthly e-mail to listing owners that includes their stats and reviews.
	define("LANG_LABEL_NOTIFY_TRAFFIC_TIP", "Kendi istatistikleri ve değerlendirmeleri içeren liste sahiplerine aylık e-posta etkinleştirin.");
	//Sponsors have access to the members area and can create items. They can also create their own personal pages.
	define("LANG_LABEL_SPONSOR_TIP", "Sponsorlar üyeleri alanına erişim ve öğeleri oluşturabilirsiniz. Ayrıca kendi kişisel sayfaları oluşturabilirsiniz.");
	//Visitors can visit your frontend pages, write reviews, comment on blog and view other user's personal page. Visitors can upgrade their accounts by adding an item through the advertise process.
	define("LANG_LABEL_PROFILE_TIP", "Ziyaretçiler, sizin arayüzü sayfalarını ziyaret değerlendirme yazmak, blog yorum ve diğer kullanıcının kişisel sayfası görebilirsiniz. Ziyaretçiler reklam sürecinde bir öğe ekleyerek kendi hesaplarını yükseltebilirsiniz.");
	//Address (optional)
	define("LANG_LABEL_ADDRESS_OPTIONAL", "Adres (seçmeli)");
	//Address (Optional)
	define("LANG_LABEL_ADDRESSOPTIONAL", "Adres (seçmeli)");
	//Detail Description
	define("LANG_LABEL_DETAIL_DESCRIPTION", "Detaylı Tanım");
	//Price
	define("LANG_LABEL_PRICE", "Fiyat");
	//Prices
	define("LANG_LABEL_PRICE_PLURAL", "Fiyatlar");
	//Contact Information
	define("LANG_LABEL_CONTACT_INFORMATION", "İletişim Bilgileri");
	//Language
	define("LANG_LABEL_LANGUAGE", "Dil");
	//Select your main language to contact (when necessary).
	define("LANG_LABEL_LANGUAGETIP", "(İletişim için anadilinizi seçin (gerekliyse).");
	//First Name
	define("LANG_LABEL_FIRST_NAME", "Adı");
	//First Name
	define("LANG_LABEL_FIRSTNAME", "Adı");
	//Last Name
	define("LANG_LABEL_LAST_NAME", "Soyadı");
	//Last Name
	define("LANG_LABEL_LASTNAME", "Soyadı");
	//Company
	define("LANG_LABEL_COMPANY", "Şirket");
	//Address
	define("LANG_LABEL_ADDRESS1", "Adres Satırı");
	//Address 2
	define("LANG_LABEL_ADDRESS2", "Adres Satırı 2");
	//Latitude
	define("LANG_LABEL_LATITUDE", "Enlem");
	//Longitude
	define("LANG_LABEL_LONGITUDE", "Boylam");
	//Not found. Please, try to specify better your location.
	define("LANG_LABEL_MAP_NOTFOUND", "Bulamadık. Konumunuzu daha iyi belirlemek için deneyin.");
	//The following fields contain errors:
	define("LANG_LABEL_MAP_ERRORS", "Aşağıdaki alanlar hataları içerir:");
	//Latitude must be a number between -90 and 90.
	define("LANG_LABEL_MAP_INVALID_LAT", "Enlem -90 ile 90 arasında bir sayı olmalıdır.");
	//Longitude must be a number between -180 and 180.
	define("LANG_LABEL_MAP_INVALID_LON", "Boylam -180 ve 180 arasında bir sayı olmalıdır.");
	//Location Name
	define("LANG_LABEL_LOCATION_NAME", "Yer Adı");
	//Event Date
	define("LANG_LABEL_EVENT_DATE", "Aktivite Günü");
	//Description
	define("LANG_LABEL_DESCRIPTION", "Tanım");
	//Help Information
	define("LANG_LABEL_HELP_INFORMATION", "Yardım Bilgileri");
	//Text
	define("LANG_LABEL_TEXT", "Yazı");
	//Add Image
	define("LANG_LABEL_ADDIMAGE", "Resim Ekle");
	//Add Image
	define("LANG_LABEL_ADDIMAGES", "Resim Ekle");
	//Edit Image Captions
	define("LANG_LABEL_EDITIMAGECAPTIONS", "Resim Altyazılarını Düzenle");
	//Image File
	define("LANG_LABEL_IMAGEFILE", "Resim Dosyası");
	//Thumb Caption
	define("LANG_LABEL_THUMBCAPTION", "Küçük Resim Altyazısı");
	//Image Caption
	define("LANG_LABEL_IMAGECAPTION", "Resim Altyazısı");
	//Video Snippet Code
	define("LANG_LABEL_VIDEO_SNIPPET_CODE", "Video Kodu");
	//Attach Additional File
	define("LANG_LABEL_ATTACH_ADDITIONAL_FILE", "Ek Dosya ekle");
	//Attach Menu
	define("LANG_LABEL_ATTACH_MENU", "Menüsü ekle");
	//Menu
	define("LANG_LABEL_MENU", "Menüsü");
    //Good to know
    define("LANG_LABEL_GOODKNOW", "Bilmek iyi");
    //Make a reservation
    define("LANG_LABEL_RESERVATION", "Rezervasyon yaptırmak");
	//Attention
	define("LANG_LABEL_ATTENTION", "Dikkat");
	//Source
	define("LANG_LABEL_SOURCE", "Kaynak");
	//Hours
	define("LANG_LABEL_HOURS_OF_WORK", "Çalışma Saatleri");
	//Default
	define("LANG_LABEL_DEFAULT", "Varsayılan");
	//Payment Method
	define("LANG_LABEL_PAYMENT_METHOD", "Ödeme Şekli");
    //How do you want to pay us?
    define("LANG_LABEL_PAYMENT_METHOD_TIP", "Nasıl ödemek istersiniz?");
	//By Credit Card
	define("LANG_LABEL_BY_CREDIT_CARD", "Kredi Kartı İle");
	//By PayPal
	define("LANG_LABEL_BY_PAYPAL", "PayPal İle");
	//By SimplePay
	define("LANG_LABEL_BY_SIMPLEPAY", "SimplePay İle");
	//By Pagseguro
	define("LANG_LABEL_BY_PAGSEGURO", "Pagseguro İle");
	//Print Invoice and Mail a Check
	define("LANG_LABEL_PRINT_INVOICE_AND_MAIL_CHECK", "Faturayı Yazdır ve Çek Gönder");
	//Headline
	define("LANG_LABEL_HEADLINE", "Başlık");
	//Offer
	define("LANG_LABEL_OFFER", "Teklif");
	//Conditions
	define("LANG_LABEL_CONDITIONS", "Şartlar");
	//Deal Dates
	define("LANG_LABEL_PROMOTION_DATE", "Teklif Tarihleri​​");
	//Deal Layout
	define("LANG_LABEL_PROMOTION_LAYOUT", "Teklif Düzeni");
	//You pay
	define("LANG_LABEL_PROMOTION_PAY", "Ödeme");
	//Time left to buy
	define("LANG_LABEL_PROMOTION_TIMELEFT", "Zaman almak için bıraktı");
	//Printable Deal
	define("LANG_LABEL_PRINTABLE_PROMOTION", "Yazdırılabilir Teklif");
	//Our HTML template based deal
	define("LANG_LABEL_OUR_HTML_TEMPLATE_BASED", "Bizim HTML şablonumuza dayanan teklif");
	//Fill in the fields above and insert a logo or other image (JPG or GIF)
	define("LANG_LABEL_FILL_FIELDS_ABOVE", "Yukarıdaki alanları doldurun ve bir logo ya da başka bir resim (JPG veya GIF) ekleyin)");
	//A deal provided by you instead
	define("LANG_LABEL_PROMOTION_PROVIDED_BY_YOU", "Onun yerine sizin tarafınızdan sağlanan bir teklif");
	//JPG or GIF image
	define("LANG_LABEL_JPG_GIF_IMAGE", "JPG veya GIF resmi");
	//Comment Title
	define("LANG_LABEL_COMMENTTITLE", "Yorum Başlığı");
	//Comment
	define("LANG_LABEL_COMMENT", "Yorum");
	//Accepted
	define("LANG_LABEL_ACCEPTED", "Kabul Edildi");
	//Approved
	define("LANG_LABEL_APPROVED", "Onaylandı");
	//Success
	define("LANG_LABEL_SUCCESS", "Başarılı");
	//Completed
	define("LANG_LABEL_COMPLETED", "Tamamlandı");
	//Y
	define("LANG_LABEL_Y", "E");
	//Failed
	define("LANG_LABEL_FAILED", "Başarısız");
	//Declined
	define("LANG_LABEL_DECLINED", "Reddedildi");
	//failure
	define("LANG_LABEL_FAILURE", "başarısızlık");
	//Canceled
	define("LANG_LABEL_CANCELED", "İptal Edildi");
	//Error
	define("LANG_LABEL_ERROR", "Hata");
	//Transaction Code
	define("LANG_LABEL_TRANSACTION_CODE", "İşlem Kodu");
	//Subscription ID
	define("LANG_LABEL_SUBSCRIPTION_ID", "Abone Numarası");
	//transaction history
	define("LANG_LABEL_TRANSACTION_HISTORY", "işlem geçmişi");
	//Authorization Code
	define("LANG_LABEL_AUTHORIZATION_CODE", "Onay Kodu");
	//Transaction Status
	define("LANG_LABEL_TRANSACTION_STATUS", "İşlem Durumu");
	//Transaction Error
	define("LANG_LABEL_TRANSACTION_ERROR", "İşlem Hatası");
	//Monthly Bill Amount
	define("LANG_LABEL_MONTHLY_BILL_AMOUNT", "Aylık Fatura Tutarı");
	//Transaction OID
	define("LANG_LABEL_TRANSACTION_OID", "İşlem Nesne Numarası");
	//Yearly Bill Amount
	define("LANG_LABEL_YEARLY_BILL_AMOUNT", "Yıllık Fatura Tutarı");
	//Bill Amount
	define("LANG_LABEL_BILL_AMOUNT", "Fatura Tutarı");
	//Transaction ID
	define("LANG_LABEL_TRANSACTION_ID", "İşlem Numarası");
	//Receipt ID
	define("LANG_LABEL_RECEIPT_ID", "Makbuz Numarası");
	//Subscribe ID
	define("LANG_LABEL_SUBSCRIBE_ID", "Abone Numarası");
	//Transaction Order ID
	define("LANG_LABEL_TRANSACTION_ORDERID", "İşlem Sıra Numarası");
	//your
	define("LANG_LABEL_YOUR", "sizin");
	//Make Your
	define("LANG_LABEL_MAKE_YOUR", "Yapınız");
	//Payment
	define("LANG_LABEL_PAYMENT", "Ödemenizi");
	//History
	define("LANG_LABEL_HISTORY", "Geçmiş");
	//Log in
	define("LANG_LABEL_LOGIN", "Oturum aç");
	//Transaction canceled
	define("LANG_LABEL_TRANSACTION_CANCELED", "İşlem iptal edildi");
	//Transaction amount
	define("LANG_LABEL_TRANSACTION_AMOUNT", "İşlem tutarı");
	//Pay
	define("LANG_LABEL_PAY", "Öde");
	//Back
	define("LANG_LABEL_BACK", "Geri");
	//Total Price
	define("LANG_LABEL_TOTAL_PRICE", "Toplam Fiyat");
	//Pay By Invoice
	define("LANG_LABEL_PAY_BY_INVOICE", "Fatura İle Öde");
	//Administrator
	define("LANG_LABEL_ADMINISTRATOR", "Yönetici");
	//Billing Info
	define("LANG_LABEL_BILLING_INFO", "Fatura Bilgisi");
	//Card Number
	define("LANG_LABEL_CARD_NUMBER", "Kart Numarası");
	//Card Expire date
	define("LANG_LABEL_CARD_EXPIRE_DATE", "Kartın Son Kullanma Tarihi");
	//Card Code
	define("LANG_LABEL_CARD_CODE", "Kart Kodu");
	//Customer Info
	define("LANG_LABEL_CUSTOMER_INFO", "Müşteri Bilgileri");
	//zip
	define("LANG_LABEL_ZIP", "posta kodu");
	//Place Order and Continue
	define("LANG_LABEL_PLACE_ORDER_CONTINUE", "Sipariş Ver ve Devam Et");
	//General Information
	define("LANG_LABEL_GENERAL_INFORMATION", "Genel Bilgiler");
	//Phone Number
	define("LANG_LABEL_PHONE_NUMBER", "Telefon Numarası");
	//E-mail Address
	define("LANG_LABEL_EMAIL_ADDRESS", "E-posta Adresi");
	//Credit Card Information
	define("LANG_LABEL_CREDIT_CARD_INFORMATION", "Kredi Kartı Bilgileri");
	//Exp. Date
	define("LANG_LABEL_EXP_DATE", "Son Kullanma Tarihi");
	//Customer Information
	define("LANG_LABEL_CUSTOMER_INFORMATION", "Müşteri Bilgileri");
	//Card Expiration
	define("LANG_LABEL_CARD_EXPIRATION", "Kartın Son Kullanma Tarihi");
	//Name on Card
	define("LANG_LABEL_NAME_ON_CARD", "Kartın Üzerindeki İsim");
	//Card Type
	define("LANG_LABEL_CARD_TYPE", "Kart Türü");
	//Card Verification Number
	define("LANG_LABEL_CARD_VERIFICATION_NUMBER", "Kart Onay Numarası");
	//Province
	define("LANG_LABEL_PROVINCE", "İl");
	//Postal Code
	define("LANG_LABEL_POSTAL_CODE", "Posta Kodu");
	//Post Code
	define("LANG_LABEL_POST_CODE", "Posta Kodu");
	//Tel
	define("LANG_LABEL_TEL", "Tel");
	//Select Date
	define("LANG_LABEL_SELECTDATE", "Tarih Seç");
	//Found
	define("LANG_PAGING_FOUND", "Bulundu");
	//Found
	define("LANG_PAGING_FOUND_PLURAL", "Bulundu");
	//record
	define("LANG_PAGING_RECORD", "kayıt");
	//records
	define("LANG_PAGING_RECORD_PLURAL", "kayıt");
	//Showing page
	define("LANG_PAGING_SHOWINGPAGE", "Gösteriyor");
	//of
	define("LANG_PAGING_PAGEOF", ".sayfayı");
	//pages
	define("LANG_PAGING_PAGE_PLURAL", "sayfadan");
	//Go to page
	define("LANG_PAGING_GOTOPAGE", "Sayfaya git");
	//Select
	define("LANG_PAGING_ORDERBYPAGE_SELECT", "Seç");
	//Order by
	define("LANG_PAGING_ORDERBYPAGE", "Sırala");
	//Characters
	define("LANG_PAGING_ORDERBYPAGE_CHARACTERS", "Alfabetik");
    //Alphabetically
    define("LANG_PAGING_ORDERBYPAGE_ALPHABETICALLY", "Alfabetik");
	//Last update
	define("LANG_PAGING_ORDERBYPAGE_LASTUPDATE", "Güncelleştirme");
	//Date created
	define("LANG_PAGING_ORDERBYPAGE_DATECREATED", "Eklenme Tarihi");
	//Popular
	define("LANG_PAGING_ORDERBYPAGE_POPULAR", "Popüler");
	//Rating
	define("LANG_PAGING_ORDERBYPAGE_RATING", "Puanlama");
	//Price
	define("LANG_PAGING_ORDERBYPAGE_PRICE", "Fiyat");
	//Start Date
	define("LANG_PAGING_ORDERBYPAGE_STARTDATE", LANG_LABEL_START_DATE);
	//previous page
	define("LANG_PAGING_PREVIOUSPAGE", "önceki sayfa");
	//next page
	define("LANG_PAGING_NEXTPAGE", "sonraki sayfa");
	//"previous" page
	define("LANG_PAGING_PREVIOUSPAGEMOBILE", "önce");
	//"next" page
	define("LANG_PAGING_NEXTPAGEMOBILE", "sonra");
	//view full listing
	define("LANG_VIEW_LISTING", "listesini görüntülemek");
	//view full article
	define("LANG_VIEW_ARTICLE", "makaleyi görüntülemek");
	//Go to Website
	define("LANG_GO_TO_WEBSITE", "Web sayfasına git");
	//Article successfully added!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_ADDED", "Makale başarıyla eklendi!");
	//Banner successfully added!
	define("LANG_MSG_BANNER_SUCCESSFULLY_ADDED", "Afiş başarıyla eklendi!");
	//Classified successfully added!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_ADDED", "Ilan başarıyla eklendi!");
	//Event successfully added!
	define("LANG_MSG_EVENT_SUCCESSFULLY_ADDED", "Aktivite başarıyla eklendi!");
	//Listing successfully added!
	define("LANG_MSG_LISTING_SUCCESSFULLY_ADDED", "Liste başarıyla eklendi!");
	//Deal successfully added!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_ADDED", "Teklif başarıyla eklendi!");
	//Article successfully updated!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_UPDATED", "Makale başarıyla güncellendi!");
	//Banner successfully updated!
	define("LANG_MSG_BANNER_SUCCESSFULLY_UPDATED", "Afiş başarıyla güncellendi!");
	//Classified successfully updated!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_UPDATED", "Ilan başarıyla güncellendi!");
	//Event successfully updated!
	define("LANG_MSG_EVENT_SUCCESSFULLY_UPDATED", "Aktivite başarıyla güncellendi!");
	//Listing successfully updated!
	define("LANG_MSG_LISTING_SUCCESSFULLY_UPDATED", "Liste başarıyla güncellendi!");
	//Deal successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATED", "Teklif başarıyla güncellendi!");
	//Map Tuning successfully updated!
	define("LANG_MSG_MAPTUNING_SUCCESSFULLY_UPDATED", "Harita ayarları başarıyla güncellendi!");
	//Deal was successfully deleted!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_DELETED", "Teklif başarıyla silindi!");
	//Deal successfully changed!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_CHANGED", "Teklif başarıyla değiştirildi!");
	//Banner successfully deleted!
	define("LANG_MSG_BANNER_SUCCESSFULLY_DELETED", "Afiş başarıyla silindi!");
	//Invalid image type. Please insert a JPG, GIF or PNG image.
	define("LANG_MSG_INVALID_IMAGE_TYPE", "Geçersiz resim türü. Lütfen JPG, GIF veya PNG türünden resimler ekleyin.");
	//Invalid file type. Please insert a SWF, GIF, JPEG or PNG file.
	define("LANG_MSG_INVALID_FILE_TYPE", "Geçersiz dosya türü. Bir SWF, GIF, JPEG veya PNG dosyası giriniz.");
	//The image file is too large
	define("LANG_MSG_IMAGE_FILE_TOO_LARGE", "Resim dosyası çok büyük.");
	//Please try again with another image
	define("LANG_PLEASE_TRY_AGAIN_WITH_ANOTHER_IMAGE", "Lütfen başka bir resim seçip tekrar deneyiniz.");
	//Attached file was denied. Invalid file type.
	define("LANG_MSG_ATTACHED_FILE_DENIED", "Eklenen dosya kabul edilmedi. Geçersiz dosya türü.");
	//Please type your username.
	define("LANG_MSG_TYPE_USERNAME", "Lütfen e-posta adresinizi girin.");
	//Username was not found.
	define("LANG_MSG_USERNAME_WAS_NOT_FOUND", "E-posta adresi bulunamadı.");
	//Please try again or contact support at:
	define("LANG_MSG_TRY_AGAIN_OR_CONTACT_SUPPORT", "Lütfen tekrar deneyin ya da teknik destekle iletişime geçin:");
	//System Forgotten Password is disabled.
	define("LANG_MSG_FORGOTTEN_PASSWORD_DISABLED", "Unutulmuş Şifre Sistemi devre dışı bırakıldı.");
	//Please contact support at:
	define("LANG_MSG_CONTACT_SUPPORT", "Lütfen teknik destekle iletişime geçin:");
	//Thank you!
	define("LANG_MSG_THANK_YOU", "Teşekkürler!");
	//An e-mail was sent to the account holder with instructions to obtain a new password
	define("LANG_MSG_EMAIL_WAS_SENT_TO_ACCOUNT_HOLDER", "Yeni şifre almak için gereken talimatların bulunduğu bir e-posta hesap sahibine gönderildi.");
	//File not found!
	define("LANG_MSG_FILE_NOT_FOUND", "Dosya bulunamadı!");
	//Click here to print the invoice
	define("LANG_MSG_CLICK_TO_PRINT_INVOICE", "Faturayı yazdırmak için tıklayın");
	//Click here to view the invoice detail
	define("LANG_MSG_CLICK_TO_VIEW_INVOICE_DETAIL", "Fatura detaylarını görmek için tıklayın");
	//(prices amount are per installments)
	define("LANG_MSG_PRICES_AMOUNT_PER_INSTALLMENTS", "(fiyatlar kurulum başınadır)");
	//Unpaid Item
	define("LANG_MSG_UNPAID_ITEM", "Ödenmemiş Kayıt");
	//No Check Out Needed
	define("LANG_MSG_NO_CHECKOUT_NEEDED", "Hesap Kapatımı Gerekli Değil");
	//(Move the mouse over the bars to see more details about the graphic)
	define("LANG_MSG_MOVE_MOUSEOVER_THE_BARS", "(Grafik hakkında daha fazla detay görmek için çubukların üzerinden mouse ile geçin)");
	//(Click the report type to display graph)
	define("LANG_MSG_CLICK_REPORT_TYPE", "(Grafiği görmek için rapor türünün üzerine tıklayın)");
	//Click here to view this review
	define("LANG_MSG_CLICK_TO_VIEW_THIS_REVIEW", "Bu yorumu görmek için tıklayın");
	//Click here to edit this review
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REVIEW", "Bu yorumu düzenlemek için tıklayın");
	//Click here to edit this reply
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REPLY", "Bu cevabı düzenlemek için tıklayın");
	//Click here to delete this review
	define("LANG_MSG_CLICK_TO_DELETE_THIS_REVIEW", "Bu yorumu silmek için tıklayın");
	//Waiting Site Manager approve
	define("LANG_MSG_WAITINGSITEMGRAPPROVE", "Site Yöneticisinin Onayını Bekliyor");
	//Waiting Site Manager approve for Review
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW", "Yorum için Site Yöneticisinin Onayı Bekleniyor");
	//Waiting Site Manager approve for Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REPLY", "Cevap için Site Yöneticisinin Onayı Bekleniyor");
	//Waiting Site Manager approve for Review Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW_REPLY", "Yorum ve Cevap için Site Yöneticisinin Onayı Bekleniyor");
	//Review already approved
	define("LANG_MSG_REVIEW_ALREADY_APPROVED", "Bu Yorum Onaylandı Bile");
	//Review and Reply already approved
	define("LANG_MSG_REVIEWANDREPLY_ALREADY_APPROVED", "Bu Yorum ve de Cevap Onaylandı Bile");
	//Review pending approval
	define("LANG_REVIEW_PENDINGAPPROVAL", "Yorum Onay Bekliyor");
	//Reply pending approval
	define("LANG_REPLY_PENDINGAPPROVAL", "Cevap Onay Bekliyor");
	//Review active
	define("LANG_REVIEW_ACTIVE", "Yorum Aktif");
	//Reply active
	define("LANG_REPLY_ACTIVE", "Cevap Aktif");
	//Review and Reply pending approval
	define("LANG_REVIEWANDREPLY_PENDINGAPPROVAL", "Yorum ile Cevap Onay Bekliyor");
	//Review and Reply active
	define("LANG_REVIEWANDREPLY_ACTIVE", "Yorum ile Cevap Aktif");
	//Reply
	define("LANG_REPLY", "Cevap");
	//Reply (noun)
	define("LANG_REPLYNOUN", "Cevap");
	//Review and Reply
	define("LANG_REVIEWANDREPLY", "Yorum ile Cevap");
	//Edit Review
	define("LANG_LABEL_EDIT_REVIEW", "Yorumu Düzenle");
	//Edit Reply
	define("LANG_LABEL_EDIT_REPLY", "Cevabı Düzenle");
	//Approve Review
	define("LANG_SITEMGR_APPROVE_REVIEW", "Yorumu Onayla");
	//Approve Reply
	define("LANG_SITEMGR_APPROVE_REPLY", "Cevabı Onayla");
	//Reply already approved
	define("LANG_MSG_RESPONSE_ALREADY_APPROVED", "Cevap  Onaylandı Bile");
	//Review successfully sent!
	define("LANG_REVIEW_SUCCESSFULLY", "Yorum başarıyla gönderildi!");
	//Reply successfully sent!
	define("LANG_REPLY_SUCCESSFULLY", "Cevap başarıyla gönderildi!");
	//Please type a valid reply!
	define("LANG_REPLY_EMPTY", "Lütfen geçerli bir cevap yazın!");
	//Please type a valid name
	define("LANG_REVIEW_EMPTY_NAME", "Lütfen geçerli bir isim yazın!");
	//Please type a valid e-mail
	define("LANG_REVIEW_EMPTY_EMAIL", "Lütfen geçerli bir e-posta adresi yazın");
	//Please type a valid city, State
	define("LANG_REVIEW_EMPTY_LOCATION", "Lütfen geçerli bir il, ilçe yazın");
	//Please type a valid review title
	define("LANG_REVIEW_EMPTY_TITLE", "Lütfen geçerli bir başlık yazın");
	//Please type a valid review!
	define("LANG_REVIEW_EMPTY", "Lütfen geçerli bir yorum yazın!");
	//Please choose an option or click in cancel to exit.
	define("LANG_STATUS_EMPTY", "Lütfen bir seçeneği işaretleyin veya çıkmak için iptali tıklayın.");
	//Click here to reply this review
	define("LANG_MSG_REVIEW_REPLY", "Bu yoruma cevap yazmak için tıklayın");
	//Click here to view the transaction
	define("LANG_MSG_CLICK_TO_VIEW_TRANSACTION", "İşlemi görmek için tıklayın");
	//Username must be between
	define("LANG_MSG_USERNAME_MUST_BE_BETWEEN", "E-posta arasında olmalıdır");
	//characters with no spaces.
	define("LANG_MSG_CHARACTERS_WITH_NO_SPACES", "karakterlerin arasında boşluk olmamalıdır.");
	//Password must be between
	define("LANG_MSG_PASSWORD_MUST_BE_BETWEEN", "Şifre arasında olmalıdır");
	//Type you password here if you want to change it.
	define("LANG_MSG_TIPE_YOUR_PASSWORD_HERE_IF_YOU_WANT_TO_CHANGE_IT", "Değiştirmek isterseniz şifrenizi buraya girin.");
	//Password is going to be sent to Member E-mail Address.
	define("LANG_MSG_PASSWORD_SENT_TO_MEMBER_EMAIL", "Şifre Üyenin E-Posta Adresine gönderilecektir.");
	//Please write down your username and password for future reference.
	define("LANG_MSG_WRITE_DOWN_YOUR_USERNAME_PASSWORD", "Lütfen ileride referans olması için kullanıcı adı ve şifrenizi not alın.");
	//Please check the agreement terms.
	define("LANG_MSG_ALERT_AGREE_WITH_TERMS_OF_USE", "Lütfen anlaşma şartlarını işaretleyin.");
	//successfully added
	define("LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED", "Başarıyla eklendi!");
	//This category was already inserted
	define("LANG_MSG_CATEGORY_ALREADY_INSERTED", "Daha önceden eklediniz bile");
	//Please, select a valid category
	define("LANG_MSG_SELECT_VALID_CATEGORY", "Lütfen geçerli bir kategori seçin");
	//Please, select a category first
	define("LANG_MSG_SELECT_CATEGORY_FIRST", "Lütfen önce bir kategori seçin");
	//You can choose a page name title to be accessed directly from the web browser as a static html page. The chosen page name title must contain only alphanumeric chars (like "a-z" and/or "0-9") and "-" instead of spaces.
	define("LANG_MSG_FRIENDLY_URL1", "Statik bir html sayfası olarak web tarayıcısından doğrudan erişilebilen bir sayfa adı başlığı seçebilirsiniz. Seçilen sayfa adı başlığı harfli veya rakamlı karakterlerden oluşmalıdır (\"a-z\" ve/veya \"0-9\" gibi) ve boşluk yerine \"-\" kullanılmalıdır.");
	//The page name title "John Auto Repair" will be available through the url:
	define("LANG_MSG_FRIENDLY_URL2", "Sayfa adı başlığı \"John Oto Tamir\" url üzerinden erişilebilecektir:");
	//Maximum file size
	define("LANG_MSG_MAX_FILE_SIZE", "En fazla dosya büyüklüğü");
	//Transparent .gif or .png not supported
	define("LANG_MSG_TRANSPARENTGIF_NOT_SUPPORTED", "Saydam .gif veya .png desteklenmemektedir");
	//Animated .gif isn't supported.
	define("LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED", "Animasyonlu gif desteklenmemektedir.");
	//Please be sure that your image dimensions fit within the recommended pixel sizes, otherwise, image quality can be effected.
	define("LANG_MSG_IMAGE_DIMENSIONS_ALERT", "Lütfen resim boyutlarının önerilen pixel büyüklüklerine uyduğundan emin olun yoksa resim kalitesi bundan etkilenebilir.");
	//Check this box to remove your existing image
	define("LANG_MSG_CHECK_TO_REMOVE_IMAGE", "Var olan resminizi kaldırmak için bu kutuyu işaretleyin");
	//max 250 characters
	define("LANG_MSG_MAX_250_CHARS", "en fazla 250 karakter");
	//max 100 characters
	define("LANG_MSG_MAX_100_CHARS", "en fazla 100 karakter");
	//characters left
	define("LANG_MSG_CHARS_LEFT", "karakter kaldı");
	//(including spaces and line breaks)
	define("LANG_MSG_INCLUDING_SPACES_LINE_BREAKS", "(boşluklar ve satır başları dahil)");
	//Include up to
	define("LANG_MSG_INCLUDE_UP_TO_KEYWORDS", "e kadar dahil");
	//keywords with a maximum of 50 characters each.
	define("LANG_MSG_KEYWORDS_WITH_MAXIMUM_50", "her anahtar sözcük başına en fazla 50 karakter.");
	//Add one keyword or keyword phrase per line.
	define("LANG_MSG_KEYWORD_PER_LINE", "satır başına bir anahtar sözcük veya anahtar cümle ekleyin.");
	//Only select sub-categories that directly apply to your type.
	define("LANG_MSG_ONLY_SELECT_SUBCATEGS", "Sadece kendi türünüzle doğrudan alakalı alt-kategoriler seçin.");
	//Your article will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_ARTICLE_AUTOMATICALLY_APPEAR", "Makaleniz seçtiğiniz her alt-kategorinin ana kategorisinin altında gözükecektir.");
	//maximum 25 characters
	define("LANG_MSG_MAX_25_CHARS", "en fazla 25 karakter");
	//maximum 500 characters
	define("LANG_MSG_MAX_500_CHARS", "en fazla 500 karakter");
	//Allowed file types
	define("LANG_MSG_ALLOWED_FILE_TYPES", "İzin verilen dosya türleri");
	//Click here to preview this listing
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_LISTING", "Bu listenin ön izlemesi için tıklayın");
	//Click here to preview this event
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_EVENT", "Bu makalenin ön izlemesi için tıklayın");
	//Click here to preview this classified
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_CLASSIFIED", "Bu ilanın ön izlemesi için tıklayın");
	//Click here to preview this article
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_ARTICLE", "Bu makalenin ön izlemesi için tıklayın");
	//Click here to preview this banner
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_BANNER", "Bu afişin ön izlemesi için tıklayın");
	//Click here to preview this deal
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_PROMOTION", "Bu teklif ön izlemesi için tıklayın");
	//maximum 30 characters
	define("LANG_MSG_MAX_30_CHARS", "en fazla 30 karakter");
	//Select a Country
	define("LANG_MSG_SELECT_A_COUNTRY", "Bir Ülke seçin");
	//Select a Region
	define("LANG_MSG_SELECT_A_REGION", "Bir Bölge seçin");
	//Select a State
	define("LANG_MSG_SELECT_A_STATE", "Bir İl seçin");
	//Select a City
	define("LANG_MSG_SELECT_A_CITY", "Bir İlçe seçin");
	//Select a Neighborhood
	define("LANG_MSG_SELECT_A_NEIGHBORHOOD", "Bir Mahalle seçin");
	//(This information will not be displayed publicly)
	define("LANG_MSG_INFO_NOT_DISPLAYED", "(Bu bilgiler herkese açık olarak gösterilmeyecektir)");
	//Your event will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_EVENT_AUTOMATICALLY_APPEAR", "Aktiviteniz seçtiğiniz her alt-kategorinin ana kategorisinin altında gözükecektir.");
	//If video snippet code was filled in", it will appear on the detail page
	define("LANG_MSG_VIDEO_SNIPPET_CODE", "Eğer video kodu doldurulmuşsa, video detay sayfasında gözükecektir");
	//Maximum video code size supported
	define("LANG_MSG_MAX_VIDEO_CODE_SIZE", "Desteklenen en fazla video büyüklüğü");
	//If the video code size is bigger than supported video size, it will be modified.
	define("LANG_MSG_VIDEO_MODIFIED", "Eğer video kodunun büyüklüğü desteklenen video büyüklüğünden daha fazlaysa video değişikliğe uğrayacaktir.");
	//Attachment has no caption
	define("LANG_MSG_ATTACHMENT_HAS_NO_CAPTION", "Eklentinin hiçbir altbaşlığı yok ");
	//Check this box to remove existing listing attachment
	define("LANG_MSG_CLICK_TO_REMOVE_ATTACHMENT", "Var olan liste eklentisini çıkarmak için bu kutuyu işaretleyin");
	//Add one phrase per line.
	define("LANG_MSG_PHRASE_PER_LINE", "Her satır başına bir cümle ekleyin.");
	//Extra categories cost an
	define("LANG_MSG_EXTRA_CATEGORIES_COST", "Ekstra kategoriler her kategori başına");
	//additional
	define("LANG_MSG_ADDITIONAL", "fazladan");
	//each. Be seen!
	define("LANG_MSG_BE_SEEN", "mal olmaktadır.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_LISTING_AUTOMATICALLY_APPEAR", "Listeniz seçtiğiniz her alt-kategorinin ana kategorisinin altında gözükecektir.");
	//If you add new categories, your listing will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_LISTING_TEMPORARY_CATEGORY", "Eğer yeni kategori eklerseniz, listeniz site yöneticisi onaylamadan eklediğiniz alt-kategorinin ana kategorisinin altında gözükmeyecektir.");
	//If you add new categories, your article will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_ARTICLE_TEMPORARY_CATEGORY", "Eğer yeni kategori eklerseniz, makaleniz site yöneticisi onaylamadan eklediğiniz alt-kategorinin ana kategorisinin altında gözükmeyecektir.");
	//If you add new categories, your classified will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_CLASSIFIED_TEMPORARY_CATEGORY", "Eğer yeni kategori eklerseniz, ilanınız site yöneticisi onaylamadan eklediğiniz alt-kategorinin ana kategorisinin altında gözükmeyecektir.");
	//If you add new categories, your event will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_EVENT_TEMPORARY_CATEGORY", "Eğer yeni kategori eklerseniz, makaleniz site yöneticisi onaylamadan eklediğiniz alt-kategorinin ana kategorisinin altında gözükmeyecektir.");
	//Request your listing to be considered for the following badges.
	define("LANG_MSG_REQUEST_YOUR_LISTING", "Listenizin aşağıdaki rozetler için değerlendirilmesi için istekte bulunun.");
	//Click here to select date
	define("LANG_MSG_CLICK_TO_SELECT_DATE", "Tarih seçmek için tıklayın");
	//"Click on the" deal icon below if you wish to add deal to your listing.
	define("LANG_LISTING_CLICK_PROMOTION_BELOW", "Tıklayın");
	//Click on the "deal icon" below if you wish to add deal to your listing.
	define("LANG_LISTING_PROMOTION_ICON", "aşağıdaki teklif sembolüne");
	//Click on the deal icon "below if you wish to add deal to your listing."
	define("LANG_LISTING_IFYOUWISHADDPROMOTION", "eğer şirketinize teklif eklemek isterseniz.");
	//You can add deal to your listing by clicking on the link
	define("LANG_LISTING_YOUCANADDPROMOTION", "Linke tıklayarak listeninize teklif ekleyebilirsiniz.");
	//add deal
	define("LANG_LISTING_ADDPROMOTION", "teklif ekle");
	//All pages but item pages
	define("LANG_ALLPAGESBUTITEMPAGES", "Kayıt sayfaları dışındaki bütün sayfalar");
	//All pages
	define("LANG_ALLPAGES", "Bütün sayfalar");
    //All
	define("LANG_ALL", "Tüm");
	//Non-category search
	define("LANG_NONCATEGORYSEARCH", "Kategori harici arama");
	//deal
	define("LANG_ICONPROMOTION", "teklif");
	//e-mail to friend
	define("LANG_ICONEMAILTOFRIEND", "arkadaşına gönder");
	//Add to Favorites
	define("LANG_ICONQUICKLIST_ADD", "Favorilerime Ekle");
	//remove from favorites
	define("LANG_ICONQUICKLIST_REMOVE", "favorilerimden kaldır");
	//print
	define("LANG_ICONPRINT", "yazdır");
	//map
	define("LANG_ICONMAP", "harita");
	//Add to
	define("LANG_ADDTO_SOCIALBOOKMARKING", "Ekle");
	//Google maps are not available. Please contact the administrator.
	define("LANG_GOOGLEMAPS_NOTAVAILABLE_CONTACTADM", "Google haritası mevcut değil. Lütfen yöneticiyle iletişime geçin.");
	//Remove
	define("LANG_QUICKLIST_REMOVE", "Kaldır");
	//Favorite Articles
	define("LANG_FAVORITE_ARTICLE", "Favori Makaleler");
	//Favorite Classifieds
	define("LANG_FAVORITE_CLASSIFIED", "Favori İlanlar");
	//Favorite Events
	define("LANG_FAVORITE_EVENT", "Favori Aktiviteler");
	//Favorite Listings
	define("LANG_FAVORITE_LISTING", "Favori Listeler");
	//Favorite Deals
	define("LANG_FAVORITE_PROMOTION", "Favori Teklifler");
	//Published
	define("LANG_ARTICLE_PUBLISHED", "Yayın Tarihi");
	//More Info
	define("LANG_CLASSIFIED_MOREINFO", "Daha Fazla Bilgi");
	//Date
	define("LANG_EVENT_DATE", "Tarih");
	//Time
	define("LANG_EVENT_TIME", "Saat");
	//Get driving directions
	define("LANG_EVENT_DRIVINGDIRECTIONS", "Yol tarifi alın");
	//Website
	define("LANG_EVENT_WEBSITE", "Websitesi");
	//phone
	define("LANG_EVENT_LETTERPHONE", "Telefon");
	//More
	define("LANG_EVENT_MORE", "Daha fazla");
	//More Info
	define("LANG_EVENT_MOREINFO", "Daha Fazla Bilgi");
	//See all categories
	define("LANG_SEEALLCATEGORIES", "Tüm kategoriler bak");
	//View all listing categories
	define("LANG_LISTING_VIEWALLCATEGORIES", "Tüm kategorileri gör");
	//More Info
	define("LANG_LISTING_MOREINFO", "Daha Fazla Bilgi");
	//view phone
	define("LANG_LISTING_VIEWPHONE", "telefonu gör");
	//view fax
	define("LANG_LISTING_VIEWFAX", "faksı gör");
	//Send Email
	define("LANG_SEND_AN_EMAIL", "E-posta Gönder");
	//Click here to see more info!
	define("LANG_LISTING_ATTACHMENT", "Daha fazla bilgi için tıklayın!");
	//Download [item] Menu
	define("LANG_LISTING_DOWNLOADMENU", "[item] Menüsü indirin");
	//Complete the form below to contact us.
	define("LANG_LISTING_CONTACTTITLE", "Bizimle iletişime geçmek için aşağıdaki formu doldurun.");
	//Contact this Listing
	define("LANG_LISTING_CONTACT", "Listenın İletişim");
	//E-mail an inquiry
	define("LANG_LISTING_INQUIRY", "Soru Gönder");
	//phone
	define("LANG_LISTING_LETTERPHONE", "telefon");
	//fax
	define("LANG_LISTING_LETTERFAX", "faks");
	//website
	define("LANG_LISTING_LETTERWEBSITE", "websitesi");
	//e-mail
	define("LANG_LISTING_LETTEREMAIL", "e-posta");
	//offers the following products and/or services:
	define("LANG_LISTING_OFFERS", "aşağıdaki ürün ve/veya hizmetleri sunmaktadır:");
	//Hours
	define("LANG_LISTING_HOURS_OF_WORK", "Çalışma saatleri");
	//Check in
	define("LANG_CHECK_IN", "Giriş yapın");
	//No review comment found for this item!
	define("LANG_REVIEW_NORECORD", "Bu kayıt için hiçbir yorum bulunamadı!");
	//Reviews and comments from the last month
	define("LANG_REVIEWS_MONTH", "Yorum ve son bir ay yorumlarına");
	//Review
	define("LANG_REVIEW", "Yorum");
	//Reviews
	define("LANG_REVIEW_PLURAL", "Yorum");
	//Reviews
	define("LANG_REVIEWTITLE", "Yorum");
	//review
	define("LANG_REVIEWCOUNT", "yorum");
	//reviews
	define("LANG_REVIEWCOUNT_PLURAL", "yorum");
	//Check In
	define("LANG_CHECKINCOUNT", "Giriş Yapın");
	//Check ins
	define("LANG_CHECKINCOUNT_PLURAL", "Girişler");
	//See check ins
	define("LANG_CHECKINSEECOMMENTS", "Girişleri gör");
	//Check ins of
	define("LANG_CHECKINSOF", "Girişleri");
	//No check in found for this item!
	define("LANG_CHECKIN_NORECORD", "Bu kayıt için hiçbir giriş bulunamadı!");
	//Related Categories
	define("LANG_RELATEDCATEGORIES", "İlgili Kategoriler");
	//Related Listings
	define("LANG_RELATEDLISTINGS", "İlgili Listeler");
	//Subcategories
	define("LANG_LISTING_SUBCATEGORIES", "Altkategoriler");
	//See comments
	define("LANG_REVIEWSEECOMMENTS", "Yorumları gör");
    //Pending Reviews
    define("LANG_REVIEW_PENDING", "Bekleyen Yorumlar");
    //Approve
    define("LANG_REVIEW_APPROVE", "Onaylamak");
	//Rate It!
	define("LANG_REVIEWRATEIT", "Puanla!");
	//Be the first to review this item!
	define("LANG_REVIEWBETHEFIRST", "Yorumlayan ilk kişi sen ol!");
	//Offered by
	define("LANG_PROMOTION_OFFEREDBY", "Tarafından sunuldu");
	//More Info
	define("LANG_PROMOTION_MOREINFO", "Daha Fazla Bilgi");
	//Valid from
	define("LANG_PROMOTION_VALIDFROM", "Geçerli");
	//to
	define("LANG_PROMOTION_VALIDTO", "e kadar");
	//Print Deal
	define("LANG_PROMOTION_PRINT", "Teklif Yazdır");
	//Article
	define("LANG_ARTICLE_FEATURE_NAME", "Makale");
	//Articles
	define("LANG_ARTICLE_FEATURE_NAME_PLURAL", "Makaleler");
	//Blog
	define("LANG_BLOG_FEATURE_NAME", "Blog");
	//Banner
	define("LANG_BANNER_FEATURE_NAME", "Afiş");
	//Banners
	define("LANG_BANNER_FEATURE_NAME_PLURAL", "Afişler");
	//Classified
	define("LANG_CLASSIFIED_FEATURE_NAME", "İlan");
	//Classifieds
	define("LANG_CLASSIFIED_FEATURE_NAME_PLURAL", "İlanlar");
	//Event
	define("LANG_EVENT_FEATURE_NAME", "Aktivite");
	//Events
	define("LANG_EVENT_FEATURE_NAME_PLURAL", "Aktiviteler");
	//Listing
	define("LANG_LISTING_FEATURE_NAME", "Liste");
	//Listings
	define("LANG_LISTING_FEATURE_NAME_PLURAL", "Listeler");
	//Deal
	define("LANG_PROMOTION_FEATURE_NAME", "Teklif");
	//Deals
	define("LANG_PROMOTION_FEATURE_NAME_PLURAL", "Teklifler");
	//Send
	define("LANG_BUTTON_SEND", "Gönder");
	//Sign Up
	define("LANG_BUTTON_SIGNUP", "Kaydol");
	//View Category Path
	define("LANG_BUTTON_VIEWCATEGORYPATH", "Kategori Yolunu Gör");
	//More info
	define("LANG_VIEWCATEGORY", "Daha fazla bilgi");
	//No info found
	define("LANG_NOINFO", "Hiçbir bilgi bulunamadı");
	//Remove Selected Category
	define("LANG_BUTTON_REMOVESELECTEDCATEGORY", "Seçilen Kategoriyi Kaldır");
	//Continue
	define("LANG_BUTTON_CONTINUE", "Devam Et");
	//No, thank you
	define("LANG_BUTTON_NO_THANKS", "Hayır, teşekkürler.");
	//Yes, continue
	define("LANG_BUTTON_YES_CONTINUE", "Evet, teşekkürler.");
	//No, Order without the Package!
	define("LANG_BUTTON_NO_ORDER_WITHOUT", "Hayır, Paket olmadan sipariş et.");
	//Increase your Visibility!
	define("LANG_INCREASE_VISIBILITY", "Görünürlüğünüzü Arttırın!");
	//Gift
	define("LANG_GIFT", "Hediye");
	//Help to Increase your visibility, check our
	define("LANG_HELP_INCREASE", "Görünürlüğünüzü arttırmak için yardımcı olun, kontrol edin ");
	//Site statistics
	define("LANG_DOMAIN_STATISTICS", "Site istatistikleri!");
	//Visitors per Month
	define("LANG_VISITOR_MONTH", "Ay başına ziyaretçi");
	//Custom option
	define("LANG_CUSTOM_OPTION", "Özel seçenekler");
	//Ok
	define("LANG_BUTTON_OK", "Tamam");
	//Cancel
	define("LANG_BUTTON_CANCEL", "İptal");
	//Log in
	define("LANG_BUTTON_LOGIN", "Oturum aç");
	//Save Map Tuning
	define("LANG_BUTTON_SAVE_MAP_TUNING", "Harita Ayarlarını Kaydet");
	//Clear Map Tuning
	define("LANG_BUTTON_CLEAR_MAP_TUNING", "Harita Ayarlarını Temizle");
	//Next
	define("LANG_BUTTON_NEXT", "Sonraki");
	//Pay By CreditCard
	define("LANG_BUTTON_PAY_BY_CREDIT_CARD", "Kredi Kartı İle Öde");
	//Pay By PayPal
	define("LANG_BUTTON_PAY_BY_PAYPAL", "PayPal İle Öde");
	//Pay By SimplePay
	define("LANG_BUTTON_PAY_BY_SIMPLEPAY", "SimplePay İle Öde");
	//Search
	define("LANG_BUTTON_SEARCH", "Ara");
	//Advanced
	define("LANG_BUTTON_ADVANCEDSEARCH", "Detaylı");
	//Close
	define("LANG_BUTTON_ADVANCEDSEARCH_CLOSE", "Yakın");
	//Clear
	define("LANG_BUTTON_CLEAR", "Temizle");
	//Add your Article
	define("LANG_BUTTON_ADDARTICLE", "Makalenizi ekleyin");
	//Add your Classified
	define("LANG_BUTTON_ADDCLASSIFIED", "Ilanınızı ekleyin");
	//Add your Event
	define("LANG_BUTTON_ADDEVENT", "Aktivitenizi ekleyin");
	//Add your Listing
	define("LANG_BUTTON_ADDLISTING", "Listenizi ekleyin");
	//Add your Deal
	define("LANG_BUTTON_ADDPROMOTION", "Teklif ekleyin");
	//Home
	define("LANG_BUTTON_HOME", "Ana Sayfa");
	//Manage Account
	define("LANG_BUTTON_MANAGE_ACCOUNT", "Hesabınızı Yönetin");
	//Manage Content
	define("LANG_MANAGE_CONTENT", "İçerik Yönet");
	//Sponsor
	define("LANG_SPONSOR_AREA", "Sponsor");
	//Site Manager
	define("LANG_SITEMGR_AREA", "İdari");
	//Site Manager Section
	define("LANG_LABEL_SITEMGR_SECTION", "İdari Bölüm");
	//Help
	define("LANG_BUTTON_HELP", "Yardım");
	//Sign out
	define("LANG_BUTTON_LOGOUT", "Oturumu kapat");
	//Submit
	define("LANG_BUTTON_SUBMIT", "Gönder");
	//Update
	define("LANG_BUTTON_UPDATE", "Güncelle");
	//Back
	define("LANG_BUTTON_BACK", "Geri");
	//Delete
	define("LANG_BUTTON_DELETE", "Sil");
	//Complete the Process
	define("LANG_BUTTON_COMPLETE_THE_PROCESS", "İşlemi Tamamla");
	//Please enter the text you see in the image at the left into the textbox. This is required to prevent automated submission of contact requests.
	define("LANG_CAPTCHA_HELP", "Lütfen resimde gördüğünüz yazıyı metin kutusuna girin. Bu otomatik iletişim taleplerinin gönderilmesini engellemek için gereklidir.");
	//Verification Code image cannot be displayed
	define("LANG_CAPTCHA_ALT", "Onay Kodu resmi gösterilemiyor");
	//Verification Code
	define("LANG_CAPTCHA_TITLE", "Onay Kodu");
	//Please select a rating for this item
	define("LANG_MSG_REVIEW_SELECTRATING", "Lütfen bu öğe için bir yıldız seçin");
	//Fraud detected! Please select a rating for this item!
	define("LANG_MSG_REVIEW_FRAUD_SELECTRATING", "Hile saptandı! Lütfen bu öğe için bir puan seçin!");
	//"Comment" and "Comment Title" are required to post a comment!
	define("LANG_MSG_REVIEW_COMMENTREQUIRED", "Yorum göndermek için \"Yorum\" ve \"Yorum Başlığı\" gerekli!");
	//"Name" and "E-mail" are required to post a comment!
	define("LANG_MSG_REVIEW_NAMEEMAILREQUIRED", "Yorum göndermek için \"İsim\" ve \"E-posta\" gerekli!");
	//"City, State" are required to post a comment!
	define("LANG_MSG_REVIEW_CITYSTATEREQUIRED", "Yorum göndermek için \"İl , İlçe\" gerekli!");
	//Please type a valid e-mail address!
	define("LANG_MSG_REVIEW_TYPEVALIDEMAIL", "Lütfen geçerli bir e-posta adresi girin!");
	//You have already given your opinion on this item. Thank you.
	define("LANG_MSG_REVIEW_YOUALREADYGIVENOPINION", "Bu konu hakkında daha önce yorum yapmıştınız. Teşekkürler.");
	//Thanks for the feedback!
	define("LANG_MSG_REVIEW_THANKSFEEDBACK", "Yorumunuz için teşekkürler!");
	//Your review has been submitted for approval.
	define("LANG_MSG_REVIEW_REVIEWSUBMITTEDAPPROVAL", "Yorumunuz onaylanmaya gönderildi.");
	//No payment method was selected!
	define("LANG_MSG_NO_PAYMENT_METHOD_SELECTED", "Ödeme yöntemi seçilmedi!");
	//Wrong credit card expiration date. Please, try again.
	define("LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN", "Yanlış kredi kartı son kullanma tarihi girdiniz. Lütfen tekrar deneyin.");
	//Click here to try again
	define("LANG_MSG_CLICK_HERE_TO_TRY_AGAIN", "Tekrar denemek için tıklayın");
	//Payment transactions may not occur immediately.
	define("LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY", "Ödeme işlemleri anında gerçekleşmeyebilir.");
	//After your payment is processed, information about your transaction
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT", "Ödemeniz işleme koyulduktan sonra, işlem bilginiz");
	//may be found in your transaction history.
	define("LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY", "işlem geçmişinde bulunabilir.");
	//"may be found in your" transaction history
	define("LANG_MSG_MAY_BE_FOUND_IN_YOUR", "bulunabilir");
	//The payment gateway is not available currently
	define("LANG_MSG_PAYMENT_GATEWAY_NOT_AVAILABLE", "Ödeme şu an için mümkün değil");
	//The payment parameters could not be validated
	define("LANG_MSG_PAYMENT_INVALID_PARAMS", "Ödeme parametreleri doğrulanamadı");
	//Internal gateway error was encountered
	define("LANG_MSG_INTERNAL_GATEWAY_ERROR", "Dahili ağ geçidi hatası bulundu");
	//Information about your transaction may be found
	define("LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND", "İşleminiz hakkında bilgiler");
	//in your transaction history.
	define("LANG_MSG_IN_YOUR_TRANSACTION_HISTORY", "işlem geçmişinde bulunabilir.");
	//in your
	define("LANG_MSG_IN_YOUR", "sizin");
	//No Transaction ID
	define("LANG_MSG_NO_TRANSACTION_ID", "İşlem Numarası Yok");
	//System failure, please try again.
	define("LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN", "Sistem hatası, lütfen tekrar deneyin.");
	//Please, fill in all required fields.
	define("LANG_MSG_FILL_ALL_REQUIRED_FIELDS", "Lütfen tüm gerekli alanları doldurun.");
	//Could not connect.
	define("LANG_MSG_COULD_NOT_CONNECT", "Bağlantı kurulamadı.");
	//Thank you for setting up your items and for making the payment!
	define("LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT", "Kayıtlarınızı ayarladığınız ve ödemenizi yaptığınız için teşekkürler !");
	//Site manager will review your items and set it live within 2 working days.
	define("LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS", "Site yöneticisi kayıtlarınızı inceledikten sonra 2 iş günü içerisinde sitede yayınlayacaktır.");
	//The payment gateway could not respond
	define("LANG_MSG_PAYMENT_GATEWAY_COULD_NOT_RESPOND", "Ödeme ağı geçidi cevap vermiyor");
	//Pending payments may take 3 to 4 days to be approved.
	define("LANG_MSG_PENDING_PAYMENTS_TAKE_3_4_DAYS_TO_BE_APPROVED", "Beklemede olan ödemelerin onaylanması 3 - 4 gün sürebilir.");
	//Connection Failure
	define("LANG_MSG_CONNECTION_FAILURE", "Bağlantı Hatası");
	//Please, fill correctly zip.
	define("LANG_MSG_FILL_CORRECTLY_ZIP", "Lütfen posta kodunu doğru olarak doldurun.");
	//Please, fill correctly card verification number.
	define("LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER", "Lütfen onay kodunu doğru olarak doldurun.");
	//Card Type and Card Verification Number do not match.
	define("LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH", "Kart Türü ve Kart Onay Numarası birbirini tutmuyor.");
	//Transaction Not Completed.
	define("LANG_MSG_TRANSACTION_NOT_COMPLETED", "İşlem Tamamlanmadı.");
	//Error Number:
	define("LANG_MSG_ERROR_NUMBER", "Hata Numarası:");
	//Short Message
	define("LANG_MSG_SHORT_MESSAGE", "Kısa Mesaj:");
	//Long Message
	define("LANG_MSG_LONG_MESSAGE", "Uzun Mesaj:");
	//Transaction Completed Successfully.
	define("LANG_MSG_TRANSACTION_COMPLETED_SUCCESSFULLY", "İşlem Başarıyla Tamamlandı.");
	//Card expire date must be in the future
	define("LANG_MSG_CARD_EXPIRE_DATE_IN_FUTURE", "Kartın son kullanma tarihi gelecekte olmalıdır");
	//If your transaction was confirmed, information about it may be found in
	define("LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED", "İşleminiz onaylandıysa, işlem bilgileri");
	//your transaction history after your payment is processed.
	define("LANG_MSG_YOUR_TRANSACTION_AFTER_PAYMENT_PROCESSED", "ödemeniz işlem gördükten sonra işlem geçmişinde bulunabilir.");
	//after your payment is processed.
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED", "ödemeniz işlem gördükten sonra.");
	//No items requiring payment.
	define("LANG_MSG_NO_ITEMS_REQUIRING_PAYMENT", "Ödeme gerektiren hiçbir kayıt yok.");
	//Pay for outstanding invoices
	define("LANG_MSG_PAY_OUTSTANDING_INVOICES", "Ödenmemiş faturaları ödeyin");
	//Banner by Impression and Custom Invoices can be paid once.
	define("LANG_MSG_BANNER_CUSTOM_INVOICE_PAID_ONCE", "İzlenim başına afişler ve Özel Faturalar bir kere ödenebilir.");
	//Banner by Impression can be paid once.
	define("LANG_MSG_BANNER_PAID_ONCE", "İzlenim başına afişler bir kere ödenebilir.");
	//Custom Invoices can be paid once.
	define("LANG_MSG_CUSTOM_INVOICE_PAID_ONCE", "Özel Faturalar bir kere ödenebilir.");
	//View Items
	define("LANG_VIEWITEMS", "Kayıtları Gör");
	//Please do not use recurring payment system.
	define("LANG_MSG_PLEASE_DO_NOT_USE_RECURRING_PAYMENT_SYSTEM", "Lütfen tekrar eden ödeme sistemini kullanmayın.");
	//Multiple Items
	define("LANG_ORDER_MULTIPLEITEMS", "Çoklu Öğeler");
	//Try again!
	define("LANG_MSG_TRY_AGAIN", "Tekrar deneyin!");
	//All fields are required.
	define("LANG_MSG_ALL_FIELDS_REQUIRED", "Bütün alanlar zorunlu.");
	//"You have more than" X items. Please contact the administrator to check out it.
	define("LANG_MSG_OVERITEM_MORETHAN", "Daha fazla var");
	//You have more than X items. "Please contact the administrator to check out it".
	define("LANG_MSG_OVERITEM_CONTACTADMIN", "Lütfen hesabı kapatmak için yöneticiyle iletişime geçin.");
	//Article Options
	define("LANG_ARTICLE_OPTIONS", "Makale Seçenekleri");
	//Article Author
	define("LANG_ARTICLE_AUTHOR", "Makale Yazarı");
	//Article Author URL
	define("LANG_ARTICLE_AUTHOR_URL", "Makale Yazarının URL adresi");
	//Article Categories
	define("LANG_ARTICLE_CATEGORIES", "Makale Kategorileri");
	//Banner Type
	define("LANG_BANNER_TYPE", "Afiş Türü");
	//Banner Options
	define("LANG_BANNER_OPTIONS", "Afiş Seçenekleri");
	//Order Banner
	define("LANG_ORDER_BANNER", "Afiş Sipariş Et ");
	//By time period
	define("LANG_BANNER_BY_TIME_PERIOD", "Süre başına");
	//Banner Details
	define("LANG_BANNER_DETAIL_PLURAL", "Afiş Detayları");
	//Script Banner
	define("LANG_SCRIPT_BANNER", "Afiş Kodu");
	//Show by Script Code
	define("LANG_SHOWSCRIPTCODE", "Kod başına göster");
	//Allow script to be entered instead of an image. This field allows you to paste in script that will be used to display the banner from an affiliate program or external banner system. If "Show by Script Code" is checked, just "Script" field will be required. The other fields below will not be necessary.
	define("LANG_SCRIPTCODEHELP", "Resim yerine kod girilmesine izin ver. Bu alan afişin görünümünde kullanılmak üzere bağlı bir programdan ya da dış afiş sistemlerinden gelen kodları yapıştırmanıza izin verir. Eğer \"Kod Başına Göster\" işaretliyse sadece \"Kod\" alanı gerekli olacaktır. Aşağıdaki diğer alanlar gerekli olmayacaktır.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload script banners.
	define("LANG_SCRIPTCODEHELP2", "Kod afişleri eklediğinizde ne \"Hedef Url\"sinin ne de \"Trafik Raporu Tıklaması\"nın hiçbir etkisi olmaz.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload swf file
	define("LANG_BANNERFILEHELP", "swf dosyası eklediğinizde ne \"Hedef Url\"sinin ne de \"Trafik Raporu Tıklaması\"nın hiçbir etkisi olmaz.");
	//Classified Level
	define("LANG_CLASSIFIED_LEVEL", "İlan Seviyesi");
	//Classified Category
	define("LANG_CLASSIFIED_CATEGORY", "İlan Kategorisi");
	//Select classified level
	define("LANG_MENU_SELECT_CLASSIFIED_LEVEL", "İlan seviyesi seç");
	//Classified Options
	define("LANG_CLASSIFIED_OPTIONS", "İlan Seçenekleri");
	//Event Level
	define("LANG_EVENT_LEVEL", "Aktivite Seviyesi");
	//Event Categories
	define("LANG_EVENT_CATEGORY_PLURAL", "Aktivite Kategorileri");
	//Event Categories
	define("LANG_EVENT_CATEGORIES", "Aktivite Kategorileri");
	//Select event level
	define("LANG_MENU_SELECT_EVENT_LEVEL", "Aktivite seviyesi seç");
	//Event Options
	define("LANG_EVENT_OPTIONS", "Aktivite Seçenekleri");
	//Listing Level
	define("LANG_LISTING_LEVEL", "Liste Seviyesi");
	//Listing Type
	define("LANG_LISTING_TEMPLATE", "Liste Türü");
	//Listing Categories
	define("LANG_LISTING_CATEGORIES", "Liste Kategorileri");
	//Listing Badges
	define("LANG_LISTING_DESIGNATION_PLURAL", "Liste Rozetleri");
	//Subject to administrator approval.
	define("LANG_LISTING_SUBJECTTOAPPROVAL", "Yönetici onayına tabidir.");
	//Select this choice
	define("LANG_LISTING_SELECT_THIS_CHOICE", "Bu seçeneği işaretle");
	//Select listing level
	define("LANG_MENU_SELECTLISTINGLEVEL", "Liste seviyesi seç");
	//Select event level
	define("LANG_MENU_SELECTEVENTLEVEL", "Aktivite seviyesi seç");
	//Select classified level
	define("LANG_MENU_SELECTCLASSIFIEDLEVEL", "İlan seviyesi seç");
	//Listing Options
	define("LANG_LISTING_OPTIONS", "Liste Seçenekleri");
	//Payment System is not available. Please contact the
	define("LANG_GATEWAY_NO_AVAILABLE", "Ödeme Sistemi şu anda mevcut değil. Lütfen iletişime geçiniz");
	//Upload Warning
	define("LANG_UPLOAD_WARNING", "Yükleme Uyarısı");
	//File successfully uploaded!
	define("LANG_UPLOAD_MSG_SUCCESSUPLOADED", "Dosya başarıyla yüklendi!");
	//Extension not allowed or wrong file type!
	define("LANG_UPLOAD_MSG_NOTALLOWED_WRONGFILETYPE", "Uzantıya izin verilmedi ya da yanlış dosya türü!");
	//File exceeds size limit!
	define("LANG_UPLOAD_MSG_EXCEEDSLIMIT", "Dosya büyüklük sınırını aşıyor!");
	//Fail trying to create directory!
	define("LANG_UPLOAD_MSG_FAILCREATEDIRECTORY", "Rehberi kurarken hata!");
	//Wrong directory permission!
	define("LANG_UPLOAD_MSG_WRONGDIRECTORYPERMISSION", "Yanlış directory izni!");
	//Unexpected failure!
	define("LANG_UPLOAD_MSG_UNEXPECTEDFAILURE", "Beklenmedik hata!");
	//File not found or not entered!
	define("LANG_UPLOAD_MSG_NOTFOUND_NOTENTERED", "Dosya bulunmadı ya da girilmedi!");
	//File already exists in directory!
	define("LANG_UPLOAD_MSG_FILEALREADEXISTSINDIRECTORY", "Dosya zaten rehberde var!");
	//View all locations
	define("LANG_VIEWALLLOCATIONSCATEGORIES", "Tüm yerleri gör");
	//Featured Locations
	define("LANG_FEATUREDLOCATIONS", "Favori Mekanlar");
	//There aren't any featured location in the system.
	define("LANG_LABEL_NOFEATUREDLOCATIONS", "Sistemde hiçbir favori mekan yok.");
	//Overview
	define("LANG_LABEL_OVERVIEW", "Genel bakış");
	//Video
	define("LANG_LABEL_VIDEO", "Video");
	//Map Location
	define("LANG_LABEL_MAPLOCATION", "Harita Konumu");
	//More Listings
	define("LANG_LABEL_MORELISTINGS", "Daha Fazla Liste");
	//More Events
	define("LANG_LABEL_MOREEVENTS", "Daha Fazla Aktivite");
	//More Classifieds
	define("LANG_LABEL_MORECLASSIFIEDS", "Daha Fazla İlan");
	//More Articles
	define("LANG_LABEL_MOREARTICLES", "Daha Fazla Makale");
    //More Promotions
    define("LANG_LABEL_MOREPROMOTIONS", "Daha Fazla Teklifler");
    //More Posts
    define("LANG_LABEL_MOREPOSTS", "Daha Fazla İleti");
	//"Operation not allowed: The deal" (deal_name) is already associated with the listing
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED1", "İşleme izin verilmedi: Teklif");
	//Operation not allowed: The deal (deal_name) "is already associated with the listing"
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED2", "zaten bir liste ile ilişkilendirilmiş");
	//Pending
	define("LANG_LABEL_SIMPLEPAYPENDING", "Beklemede");
	//Aborted
	define("LANG_LABEL_SIMPLEPAYABORTED", "İptal Edildi");
	//Failed
	define("LANG_LABEL_SIMPLEPAYFAILED", "Başarısız oldu");
	//Declined
	define("LANG_LABEL_SIMPLEPAYDECLINED", "Reddedildi");
	//Unknow
	define("LANG_LABEL_SIMPLEPAYUNKNOW", "Bilinmeyen");
	//Success
	define("LANG_LABEL_SIMPLEPAYSUCCESS", "Başarılı");
	//Click on Add to Select Categories.
	define("LANG_MSG_CLICKADDTOSELECTCATEGORIES", "Kategori seçmek için \"Ekle\"ye tıklayın");
	//Click on "Add main category" or "Add sub-category" to type your new categories
	define("LANG_MSG_CLICKADDTOADDCATEGORIES", "Yeni kategorileriniz eklemek için \"Ana kategori ekle\"ye ya  da \"Alt-kategori eklee\"ye tıklayın");
	//Add an
	define("LANG_ADD_AN", "Ekle");
	//Add a
	define("LANG_ADD_A", "Ekle");
	//on these sites
	define("LANG_ON_SITES", "bu sitelere:");
	//on this site
	define("LANG_ON_SITES_SINGULAR", "bu siteye:");

	# ----------------------------------------------------------------------------------------------------
	# FUNCTIONS
	# ----------------------------------------------------------------------------------------------------
	//slideshow
	define("LANG_SLIDESHOW", "slayt gösterisi");
	//on
	define("LANG_SLIDESHOW_ON", "açık");
	//off
	define("LANG_SLIDESHOW_OFF", "kapalı");
	//Photo Gallery
	define("LANG_GALLERYTITLE", "Foto Galeri");
	//"Click here" for Slideshow. You can also click on any of the photos to start slideshow.
	define("LANG_GALLERYCLICKHERE", "Burayı tıklayın");
	//Click here "for Slideshow. You can also click on any of the photos to start slideshow."
	define("LANG_GALLERYSLIDESHOWTEXT", "slayt gösterisi için. Ayrıca herhangi bir resmin üzerine tıklayarak da slayt gösterisini başlatabilirsiniz.");
	//more photos
	define("LANG_GALLERYMOREPHOTOS", "daha fazla resim");
	//Inexistent Discount Code
	define("LANG_MSG_INEXISTENT_DISCOUNT_CODE", "Var Olmayan Promosyon Kodu");
	//is not available.
	define("LANG_MSG_IS_NOT_AVAILABLE", "mevcut değil.");
	//is not available for this item type.
	define("LANG_MSG_IS_NOT_AVAILABLE_FOR", "bu kayıt türü için mevcut değil.");
	//cannot be used twice.
	define("LANG_MSG_CANNOT_BE_USED_TWICE", "iki kez kullanılamaz.");
	//Title is required.
	define("LANG_MSG_TITLE_IS_REQUIRED", "Başlık gerekli.");
	//Language is required.
	define("LANG_MSG_LANGUAGE_IS_REQUIRED", "Dil gerekli.");
	//First Name is required.
	define("LANG_MSG_FIRST_NAME_IS_REQUIRED", "Ad gerekli.");
	//Last Name is required.
	define("LANG_MSG_LAST_NAME_IS_REQUIRED", "Soyad gerekli.");
	//Company is required.
	define("LANG_MSG_COMPANY_IS_REQUIRED", "Şirket gerekli.");
	//Phone is required.
	define("LANG_MSG_PHONE_IS_REQUIRED", "Telefon gerekli.");
	//E-mail is required.
	define("LANG_MSG_EMAIL_IS_REQUIRED", "E-posta gerekli.");
	//Account is required.
	define("LANG_MSG_ACCOUNT_IS_REQUIRED", "Hesap gerekli.");
	//Page Name is required.
	define("LANG_MSG_PAGE_NAME_IS_REQUIRED", "Sayfa Adı gerekli.");
	//Category is required.
	define("LANG_MSG_CATEGORY_IS_REQUIRED", "Kategori gerekli.");
	//Abstract is required.
	define("LANG_MSG_ABSTRACT_IS_REQUIRED", "Özet geçerli.");
	//Expiration type is required.
	define("LANG_MSG_EXPIRATION_TYPE_IS_REQUIRED", "Süre dolum türü gerekli.");
	//Renewal Date is required.
	define("LANG_MSG_RENEWAL_DATE_IS_REQUIRED", "Yenileme Tarihi gerekli.");
	//Impressions are required.
	define("LANG_MSG_IMPRESSIONS_ARE_REQUIRED", "İzlenimler gerekli.");
	//File is required.
	define("LANG_MSG_FILE_IS_REQUIRED", "Dosya gerekli.");
	//Type is required.
	define("LANG_MSG_TYPE_IS_REQUIRED", "Tür gerekli.");
	//Caption is required.
	define("LANG_MSG_CAPTION_IS_REQUIRED", "Altyazı gerekli.");
	//Script Code is required.
	define("LANG_MSG_SCRIPT_CODE_IS_REQUIRED", "Kod gerekli.");
	//Description 1 is required.
	define("LANG_MSG_DESCRIPTION1_IS_REQUIRED", "Tanım 1 gerekli.");
	//Description 2 is required.
	define("LANG_MSG_DESCRIPTION2_IS_REQUIRED", "Tanım 2 gerekli.");
	//Name is required.
	define("LANG_MSG_NAME_IS_REQUIRED", "Ad gerekli.");
	//Deal Title is required.
	define("LANG_MSG_HEADLINE_IS_REQUIRED", "Teklif Başlık gerekli.");
	//"Offer" is required.
	define("LANG_MSG_OFFER_IS_REQUIRED", "Teklif gerekli.");
	//"Start Date" is required.
	define("LANG_MSG_START_DATE_IS_REQUIRED", "Başlangıç Tarihi gerekli.");
	//"End Date" is required.
	define("LANG_MSG_END_DATE_IS_REQUIRED", "Bitiş Tarihi gerekli.");
	//Message is required.
	define("LANG_MSG_TEXT_IS_REQUIRED", "Metin gerekli.");
	//Username is required.
	define("LANG_MSG_USERNAME_IS_REQUIRED", "E-posta gerekli.");
	//"Current Password" is incorrect.
	define("LANG_MSG_CURRENT_PASSWORD_IS_INCORRECT", "\"Şimdiki Şifre\" yanlış.");
	//Password is required.
	define("LANG_MSG_PASSWORD_IS_REQUIRED", "Şifre gerekli.");
	//"Agree to terms of use" is required.
	define("LANG_MSG_IGREETERMS_IS_REQUIRED", "\"Şartları kabul etmek\" gerekli.");
	//The following fields were not filled or contain errors:
	define("LANG_MSG_FIELDS_CONTAIN_ERRORS", "Aşağıdaki alanlar doldurulmamış veya hata içeriyor:");
	//Title - Please fill out the field
	define("LANG_MSG_TITLE_PLEASE_FILL_OUT", "Başlık  - Lütfen alanı doldurun");
	//Page Name - Please fill out the field
	define("LANG_MSG_PAGE_NAME_PLEASE_FILL_OUT", "Sayfa adı - Lütfen alanı doldurun");
	//"Maximum of" [MAX_CATEGORY_ALLOWED] categories are allowed
	define("LANG_MSG_MAX_OF_CATEGORIES_1", "En fazla");
	//Maximum of [MAX_CATEGORY_ALLOWED] "categories are allowed"
	define("LANG_MSG_MAX_OF_CATEGORIES_2", "kategoriye izin verilir.");
	//Friendly URL Page Name already in use, please choose another Page Name.
	define("LANG_MSG_FRIENDLY_URL_IN_USE", "Friendly URL Sayfa Adı zaten kullanılıyor, lütfen başka bir Sayfa Adı seçin.");
	//Page Name contain invalid chars
	define("LANG_MSG_PAGE_NAME_INVALID_CHARS", "Sayfa Adı geçersiz karakter içeriyor");
	//"Maximum of" [MAX_KEYWORDS] keywords are allowed
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1", "En fazla");
	//Maximum of [MAX_KEYWORDS] "keywords are allowed"
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2", "anahtar sözcüğe izin verilir");
	//Please include keywords with a maximum of 50 characters each
	define("LANG_MSG_PLEASE_INCLUDE_KEYWORDS", "Lütfen her biri en fazla 50 karakter olan anahtar sözcükler ekleyin");
	//Please enter a valid "Publication Date".
	define("LANG_MSG_ENTER_VALID_PUBLICATION_DATE", "Lütfen geçerli bir \"Yayın Tarihi\" ekleyin.");
	//Please enter a valid "Start Date".
	define("LANG_MSG_ENTER_VALID_START_DATE", "Lütfen geçerli bir \"Başlangıç Tarihi\" ekleyin.");
	//Please enter a valid "End Date".
	define("LANG_MSG_ENTER_VALID_END_DATE", "Lütfen geçerli bir \"Bitiş Tarihi\" ekleyin.");
	//The "End Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_END_DATE_GREATER_THAN_START_DATE", "\"Bitiş Tarihi\", \"Başlangıç Tarihi\"ne eşit veya ondan daha ileride olmalıdır.");
	//The "End Time" must be greater than the "Start Time".
	define("LANG_MSG_END_TIME_GREATER_THAN_START_TIME", "\"Bitiş Tarihi\", \"Başlangıç Tarihi\"nden daha ileride olmalıdır.");
	//The "End Date" cannot be in past.
	define("LANG_MSG_END_DATE_CANNOT_IN_PAST", "\"Bitiş Tarihi\" geçmişte olamaz.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_ENTER_VALID_EMAIL_ADDRESS", "Lütfen geçerli bir e-posta adresi girin.");
	//Please enter a valid "URL".
	define("LANG_MSG_ENTER_VALID_URL", "Lütfen geçerli bir \"URL\" girin.");
	//Please provide a description with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_DESCRIPTION_WITH_255_CHARS", "Lütfen en fazla 255 karakterlik bir tanım girin.");
	//Please provide a conditions with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_255_CHARS", "Lütfen en fazla 255 karakterlik bir şart metni girin.");
	//Please enter a valid renewal date.
	define("LANG_MSG_ENTER_VALID_RENEWAL_DATE", "Lütfen geçerli bir yenileme tarihi girin.");
	//Renewal date must be in the future.
	define("LANG_MSG_RENEWAL_DATE_IN_FUTURE", "Yenileme tarihi gelecekte olmalıdır.");
	//Please enter a valid expiration date.
	define("LANG_MSG_ENTER_VALID_EXPIRATION_DATE", "Lütfen geçerli bir son kullanma tarihi girin.");
	//Expiration date must be in the future.
	define("LANG_MSG_EXPIRATION_DATE_IN_FUTURE", "Son kullanma tarihi gelecekte olmalıdır.");
	//Blank space is not allowed for password.
	define("LANG_MSG_BLANK_SPACE_NOT_ALLOWED_FOR_PASSWORD", "Şifrede boşluğa izin verilmez.");
	//"Please enter a password with a maximum of" [PASSWORD_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MAX_CHARS", "Lütfen en fazla olan bir şifre girin");
	//"Please enter a password with a minimum of" [PASSWORD_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS", "Lütfen en az olan bir şifre girin");
	//Please enter a valid username.
	define("LANG_MSG_ENTER_VALID_USERNAME", "Lütfen geçerli bir kullanıcı adı girin.");
	//Sorry, you can't change this account information
	define("LANG_MSG_YOUCANTCHANGEACCOUNTINFORMATION", "Maalesef bu hesabın bilgilerini değiştiremezsiniz");
	//Password "abc123" not allowed!
	define("LANG_MSG_ABC123_NOT_ALLOWED", "\"abc123\" şifresine izin verilmez!");
	//Passwords do not match. Please enter the same content for "password" and "retype password" fields.
	define("LANG_MSG_PASSWORDS_DO_NOT_MATCH", "şifreler birbirini tutmuyor. Lütfen \"şifre\" ile \"şifreyi tekrar girin\" alanları için aynı içeriği girin.");
	//Spaces are not allowed for username.
	define("LANG_MSG_SPACES_NOT_ALLOWED_FOR_USERNAME", "E-posta adresinde boşluğa izin verilmez.");
	//Special characters are not allowed for username.
	define("LANG_MSG_SPECIAL_CHARS_NOT_ALLOWED_FOR_USERNAME", "E-posta adresinde özel karakterlere izin verilmez.");
	//"Please type an username with a maximum of" [USERNAME_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MAX_CHARS", "Lütfen en fazla olan bir e-posta adresi girin");
	//"Please type an username with a minimum of" [USERNAME_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MIN_CHARS", "Lütfen en az olan e-posta adresi girin");
	//Please choose a different username.
	define("LANG_MSG_CHOOSE_DIFFERENT_USERNAME", "Lütfen farklı bir e-posta seçin.");
	//Click here if you do not see your category
	define("LANG_MSG_CLICK_TO_ADD_CATEGORY", "Kategorinizi göremiyorsanız buraya tıklayın");
	//Add main category
	define("LANG_MSG_CLICK_TO_ADD_MAINCATEGORY", "Ana kategori ekle");
	//Add sub-category
	define("LANG_MSG_CLICK_TO_ADD_SUBCATEGORY", "Alt-kategori ekle");
	//Category title already registered!
	define("LANG_CATEGORY_ALREADY_REGISTERED", "Kategori başlığı kaydedildi bile!");
	//Category title available!
	define("LANG_CATEGORY_NOT_REGISTERED", "Kategiri başlığı mevcut!");

	# ----------------------------------------------------------------------------------------------------
	# MENU
	# ----------------------------------------------------------------------------------------------------
	//Dashboard
	define("LANG_MEMBERS_DASHBOARD", "Kontrol Paneli");
	//Manage
	define("LANG_MENU_MANAGE", "Yönet");
	//Add
	define("LANG_MENU_ADD", "Ekle");
	//Sponsor Options
	define("LANG_MENU_MEMBEROPTIONS", "Sponsor Seçenekleri");
	//Add Listing
	define("LANG_MENU_ADDLISTING", "Liste Ekle");
	//Manage Listings
	define("LANG_MENU_MANAGELISTING", "Listeleri Yönet");
	//Add Event
	define("LANG_MENU_ADDEVENT", "Aktivite Ekle");
	//Manage Events
	define("LANG_MENU_MANAGEEVENT", "Aktiviteleri Yönet");
	//Add Banner
	define("LANG_MENU_ADDBANNER", "Afiş Ekle");
	//Manage Banners
	define("LANG_MENU_MANAGEBANNER", "Afişleri Yönet");
	//Add Classified
	define("LANG_MENU_ADDCLASSIFIED", "İlan Ekle");
	//Manage Classifieds
	define("LANG_MENU_MANAGECLASSIFIED", "İlanları Yönet");
	//Add Article
	define("LANG_MENU_ADDARTICLE", "Makale Ekle");
	//Manage Articles
	define("LANG_MENU_MANAGEARTICLE", "Makaleleri Yönet");
	//Add Deal
	define("LANG_MENU_ADDPROMOTION", "Teklif Ekle");
	//Manage Deals
	define("LANG_MENU_MANAGEPROMOTION", "Teklifler Yönet");
	//Add Post
	define("LANG_MENU_ADDPOST", "Mesaj Ekle");
	//Page not found
	define("LANG_PAGE_NOT_FOUND", "Sayfa bulunamadı");
	//Maintenance Page
	define("LANG_MAINTENANCE_PAGE", "Bakım Sayfa");
	//Payment Options
	define("LANG_MENU_PAYMENTOPTIONS", "Ödeme Ayarları");
	//Check Out
	define("LANG_MENU_CHECKOUT", "Hesabı Kapat");
	//Make Your Payment
	define("LANG_MENU_MAKEPAYMENT", "Ödeme Yap");
	//History
	define("LANG_MENU_HISTORY", "Geçmiş");
	//Transaction History
	define("LANG_MENU_TRANSACTIONHISTORY", "İşlem Geçmişi");
	//Invoice History
	define("LANG_MENU_INVOICEHISTORY", "Fatura Geçmişi");
	//Default Themes
	define("LANG_MENU_CHOOSETHEME", "Varsayılan Temalar");
	//Schemes
	define("LANG_MENU_CHOOSESCHEME", "Plan");
	//Toll free
	define("LANG_LIVE_TOLLFREE", "İletişim");
	//Purchase Now
	define("LANG_LIVE_PURCHASE", "Şimdi Satın");

	# ----------------------------------------------------------------------------------------------------
	# SEARCH
	# ----------------------------------------------------------------------------------------------------
	//Search Article
	define("LANG_LABEL_SEARCHARTICLE", "Makale Ara");
	//Search Classified
	define("LANG_LABEL_SEARCHCLASSIFIED", "İlan Ara");
	//Search Event
	define("LANG_LABEL_SEARCHEVENT", " Aktivite Ara");
	//Search Listing
	define("LANG_LABEL_SEARCHLISTING", "Liste Ara");
	//Search Deal
	define("LANG_LABEL_SEARCHPROMOTION", "Teklif Ara");
	//Search the blog
    define("LANG_LABEL_SEARCHBLOG", "Blog Arama");
	//Advanced Search
	define("LANG_SEARCH_ADVANCEDSEARCH", "Detaylı Arama");
	//Search
	define("LANG_SEARCH_LABELKEYWORD", "Ara");
	//Location
	define("LANG_SEARCH_LABELLOCATION", "Yer");
	//Select a Country
	define("LANG_SEARCH_LABELCBCOUNTRY", "Ülke Seçin");
	//Select a Region
	define("LANG_SEARCH_LABELCBREGION", "Bölge Seçin");
	//Select a State
	define("LANG_SEARCH_LABELCBSTATE", "İl Seçin");
	//Select a City
	define("LANG_SEARCH_LABELCBCITY", "İlçe Seçin");
	//Select a Neighborhood
	define("LANG_SEARCH_LABELCBNEIGHBORHOOD", "Mahalle Seçin");
	//Category
	define("LANG_SEARCH_LABELCATEGORY", "Kategori");
	//Select a Category
	define("LANG_SEARCH_LABELCBCATEGORY", "Kategori Seçin");
	//Match
	define("LANG_SEARCH_LABELMATCH", "Eşleşme");
	//Exact Match
	define("LANG_SEARCH_LABELMATCH_EXACTMATCH", "Tam Eşleşme");
	//Any Word
	define("LANG_SEARCH_LABELMATCH_ANYWORD", "Herhangi bir Kelime");
	//All Words
	define("LANG_SEARCH_LABELMATCH_ALLWORDS", "Bütün Kelimeler");
	//Listing Type
	define("LANG_SEARCH_LABELBROWSE", "Liste Türü");
	//from
	define("LANG_SEARCH_LABELFROM", "den");
	//to
	define("LANG_SEARCH_LABELTO", "e");
	//Miles "of"
	define("LANG_SEARCH_LABELZIPCODE_OF", "sinde");
	//Search by keyword
	define("LANG_LABEL_SEARCHFAQ", "Anahtar sözcüğe göre ara");
	//Search
	define("LANG_LABEL_SEARCHFAQ_BUTTON", "Ara");
	//Please provide words with at least [FT_MIN_WORD_LEN] characters for your search.
	define("LANG_MSG_SEARCH_MIN_WORD_LEN", "Arama için lütfen en az [FT_MIN_WORD_LEN] harf girin!");

	# ----------------------------------------------------------------------------------------------------
	# FRONTEND
	# ----------------------------------------------------------------------------------------------------
	//Featured
	define("LANG_ITEM_FEATURED", "Vitrindekiler");
	//Recent Articles
	define("LANG_RECENT_ARTICLE", "En Yeni Makaleler");
	//Upcoming Events
	define("LANG_UPCOMING_EVENT", "Yaklaşan Aktiviteler");
	//Featured Events
	define("LANG_FEATURED_EVENT", "Vitrindeki Aktiviteler");
	//Featured Event
	define("LANG_FEATURED_EVENT_SING", "Vitrindeki Aktiviteler");
	//Featured Classifieds
	define("LANG_FEATURED_CLASSIFIED", "Vitrindeki İlanlar");
	//Featured Classified
	define("LANG_FEATURED_CLASSIFIED_SING", "Vitrindeki İlanlar");
	//Featured Articles
	define("LANG_FEATURED_ARTICLE", "Vitrindeki Makaleler");
	//Featured Article
	define("LANG_FEATURED_ARTICLE_SING", "Vitrindeki Makaleler");
	//Featured Listings
	define("LANG_FEATURED_LISTING", "Vitrindeki Listeler");
	//Featured Listing
	define("LANG_FEATURED_LISTING_SING", "Vitrindeki Listeler");
	//Featured Deals
	define("LANG_FEATURED_PROMOTION", "Vitrindeki Teklifler");
	//Featured Deal
	define("LANG_FEATURED_PROMOTION_SING", "Vitrindeki Teklifler");
	//View all articles
	define("LANG_LABEL_VIEW_ALL_ARTICLES", "Tüm makaleleri Görüntüle");
	//View all events
	define("LANG_LABEL_VIEW_ALL_EVENTS", "Tüm aktiviteler göster");
	//View all classifieds
	define("LANG_LABEL_VIEW_ALL_CLASSIFIEDS", "Tüm ilanlar görüntüle");
	//View all listings
	define("LANG_LABEL_VIEW_ALL_LISTINGS", "Tüm listeler görüntüle");
	//View all deals
	define("LANG_LABEL_VIEW_ALL_PROMOTIONS", "Tüm teklifleri görüntüle");
	//Listing with a deal
	define("LANG_LABEL_VIEW_LISTINGDEAL", "Listeler sunmak");
	//Most Read
	define("LANG_LABEL_ARTICLE_POPULAR", "En Çok Okunanlar");
	//Recently Added
	define("LANG_LABEL_ARTICLE_RECENT", "Son Eklenenler");
	//Last Tweets
	define("LANG_LAST_TWEETS", "En Son Tweetler");
	//Quick and Easy.
	define("LANG_EASYANDFAST", "Kolay ve de Hızlı.");
	//Just follow the 3 steps
	define("LANG_THREESTEPS", "Sadece 3 adımları izleyin");
	//4 Steps
	define("LANG_FOURSTEPS", "4 Adım");
	//Account Signup
	define("LANG_ACCOUNTSIGNUP", "Hesap Kaydı");
	//Update your Listing
	define("LANG_LISTINGUPDATE", "Liste Güncellemesi");
	//Order
	define("LANG_ORDER", "Sipariş Edin");
	//Check Out
	define("LANG_CHECKOUT", "Ödeme Yapın");
	//Configuration
	define("LANG_CONFIGURATION", "Ayarlar");
	//Select a level
	define("LANG_SELECTPACKAGE", "Seviye seçin");
	//Profile Options
	define("LANG_PROFILE_OPTIONS", "Profil Seçenekleri");
	//Directory account
	define("LANG_PROFILE_OPTIONS1", "Directory hesabı");
	//My existing OpenID 2.0 Account
	define("LANG_PROFILE_OPTIONS2", "Benim mevcut OpenID 2.0 Hesap");
	//My existing Facebook Account
	define("LANG_PROFILE_OPTIONS3", "Benim mevcut Facebook Hesabı");
	//My existing Google Account
	define("LANG_PROFILE_OPTIONS4", "Benim mevcut Google Hesabı");
	//Are you already a member?
	define("LANG_ALREADYHAVEACCOUNT", "Zaten üye misin?");
	//No, I'm a New User.
	define("LANG_ACCOUNTNEWUSER", "Hayır, Yeni Kullanıcıyım.");
	//Yes, I have an Existing Account.
	define("LANG_ACCOUNTEXISTSUSER", "Evet, Mevcut Hesabım var.");
	//Login with your Directory account
	define("LANG_ACCOUNTDIRECTORYUSER", "Sizin ".EDIRECTORY_TITLE." hesabınızla giriş yapın");
	//Or login with your OpenID account
	define("LANG_ACCOUNTOPENIDUSER", "Veya OpenID hesabı ile giriş");
	//Sign in with my existing Facebook Account.
	define("LANG_ACCOUNTFACEBOOKUSER", "Mevcut Facebook Hesabınızla oturum açın.");
	//Sign in with my existing Google Account.
	define("LANG_ACCOUNTGOOGLEUSER", "Mevcut Google Hesabınızla oturum açın.");
    //Or login with your existing account
    define("LANG_ACCOUNTFBGOOGLEUSER", "Veya mevcut hesabınızla giriş yapın");
	//Account Information
	define("LANG_ACCOUNTINFO", "Hesap Bilgileri");
	//Additional Information
	define("LANG_LABEL_ADDITIONALINFORMATION", "Ek Bilgi ");
	//Please write down your e-mail and password for future reference.
	define("LANG_ACCOUNTINFOMSG", "İleride referans olması için e-postanızı ve şifrenizi not alın.");
	//"Username must be a valid e-mail between" [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG1", "E-posta arasında geçerli olmak zorunda");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] "and" [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG2", "ve");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] "characters with no spaces."
	define("LANG_USERNAME_MSG3", "boşluksuz karakter.");
	//"Password must be between" [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG1", "Şifre arasında olmalı");
	//Password must be between [PASSWORD_MIN_LEN] "and" [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG2", "ve");
	//Password must be between [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] "characters with no spaces."
	define("LANG_PASSWORD_MSG3", "boşluksuz karakter.");
	//I agree with the terms of use
	define("LANG_IGREETERMS", "Kullanma şartlarını kabul ediyorum");
	//Do you want to advertise with us?
	define("LANG_DOYOUWANT_ADVERTISEWITHUS", "Bize ilan vermek ister misiniz?");
	//Buy a link
	define("LANG_BUY_LINK", "Link satın alın");
	//Back to Top
	define("LANG_BACKTOTOP", "Yukarı Dön");
	//Back to
	define("LANG_BACKTO", "Için yedekleyin ");
	//Favorites
	define("LANG_QUICK_LIST", "Favorileri");
	//view summary
	define("LANG_VIEWSUMMARY", "özeti gör");
	//view detail
	define("LANG_VIEWDETAIL", "detayları gör");
	//Advertisers
	define("LANG_ADVERTISER", "İlan verenler");
	//Order Now!
	define("LANG_ORDERNOW", "Sipariş Et!");
	//Wait, Loading...
	define("LANG_WAITLOADING", "Bekleyin, Yükleniyor...");
	//Wait, loading filter options...
	define("LANG_WAITLOADING_FILTERS", "Filtre seçenekleri Yükleniyor, bekle...");
	//Subtotal Amount
	define("LANG_SUBTOTALAMOUNT", "Aratoplam tutarı");
	//Subtotal
	define("LANG_SUBTOTAL", "Aratoplam");
	//Total Tax Amount
	define("LANG_TAXAMOUNT", "Vergi Tutarı");
	//Total Price
	define("LANG_TOTALPRICEAMOUNT", "Toplam Fiyat");
	//Favorites
	define("LANG_LABEL_QUICKLIST", "Favoriler");
	//No favorites found!
	define("LANG_LABEL_NOQUICKLIST", "Favori bulunmadı!");
	//Search results for
	define("LANG_LABEL_SEARCHRESULTSFOR", "için arama sonuçları");
	//Related Search
	define("LANG_LABEL_RELATEDSEARCH", "İlgili Aramalar");
	//Browse by Section
	define("LANG_LABEL_BROWSESECTION", "Bölüme göre Göster");
	//What are you looking for?
    define("LANG_LABEL_SEARCHINGFOR", "Sizin için ne arıyoruz?");
    //Where?
    define("LANG_LABEL_SEARCHINGFOR_WHERE", "Nerede?");
	//Keyword
	define("LANG_LABEL_SEARCHKEYWORD", "Anahtar sözcük");
	//Type a keyword
	define("LANG_LABEL_SEARCHKEYWORDTIP", "Anahtar sözcük girin");
	//Type a keyword or listing name
	define("LANG_LABEL_SEARCHKEYWORDTIP_LISTING", "Anahtar sözcük veya kayıt başlığı girin");
	//Type a keyword or deal title
	define("LANG_LABEL_SEARCHKEYWORDTIP_PROMOTION", "Anahtar sözcük veya kayıt başlığı girin");
	//Type a keyword or event title
	define("LANG_LABEL_SEARCHKEYWORDTIP_EVENT", "Anahtar sözcük veya kayıt başlığı girin");
	//Type a keyword or classified title
	define("LANG_LABEL_SEARCHKEYWORDTIP_CLASSIFIED", "Anahtar sözcük veya kayıt başlığı girin");
	//Type a keyword or article title
	define("LANG_LABEL_SEARCHKEYWORDTIP_ARTICLE", "Anahtar sözcük veya kayıt başlığı girin");
	//Where
	define("LANG_LABEL_SEARCHWHERE", "Nerede");
	//Address, City, State or Zip Code
	define("LANG_LABEL_SEARCHWHERETIP", "Adres, İlçe, İl veya Posta Kodu");
	//Wait, searching your location...
	define("LANG_LABEL_WAIT_LOCATION", "Bulunduğunuz yer için aranıyor...");
	//Complete the form below to contact us.
	define("LANG_LABEL_FORMCONTACTUS", "Bizimle iletişime geçmek için aşağıdaki formu doldurun.");
	//Message
	define("LANG_LABEL_MESSAGE", "Mesaj");
	//No disabled categories found in the system.
	define("LANG_DISABLED_CATEGORY_NOTFOUND", "Hiçbir engelli kategoriler sistemi bulundu.");
	//No categories found.
	define("LANG_CATEGORY_NOTFOUND", "Kategori bulunmadı.");
	//Please, select a valid category
	define("LANG_CATEGORY_INVALIDERROR", "Lütfen geçerli bir kategori girin");
	//Please select a category first!
	define("LANG_CATEGORY_SELECTFIRSTERROR", "Lütfen önce bir kategori seçin!");
	//View Category Path
	define("LANG_CATEGORY_VIEWPATH", "Kategori Yolunu Gör");
	//Remove Selected Category
	define("LANG_CATEGORY_REMOVESELECTED", "Seçili Karakteri Kaldır");
	//"Extra categories cost an" additional [LEVEL_CATEGORY_PRICE] each.
	define("LANG_CATEGORIES_PRICEDESC1", "Ekstra kategori tutarı:");
	//Extra categories cost an "additional" [LEVEL_CATEGORY_PRICE] each.
	define("LANG_CATEGORIES_PRICEDESC2", "ek");
	//Extra categories cost an additional [LEVEL_CATEGORY_PRICE] "each."
	define("LANG_CATEGORIES_PRICEDESC3", "her biri.");
	//Maximum of
	define("LANG_CATEGORIES_CATEGORIESMAXTIP1", "En fazla");
	//allowed.
	define("LANG_CATEGORIES_CATEGORIESMAXTIP2", "kategoriye izin verilir.");
	//Categories and sub-categories
	define("LANG_CATEGORIES_TITLE", "Kategoriler ve alt-kategoriler");
	//Only select sub-categories that directly apply to your type.
	define("LANG_CATEGORIES_MSG1", "Lütfen sadece kendi türünüzle doğrudan ilgili olan alt-kategorileri seçin.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_CATEGORIES_MSG2", "Listeniz otomatik olarak seçtiğiniz her alt-kategorinin ana kategorisinde gözükecektir.");
	//Account Information Error
	define("LANG_ACCOUNTINFO_ERROR", "Hesap Bilgisi Hatası");
	//Contact Information
	define("LANG_CONTACTINFO", "İletişim Bilgileri");
	//This information will not be displayed publicly.
	define("LANG_CONTACTINFO_MSG", "Bu bilgiler herkes tarafından görüntülenmeyecektir.");
	//Billing Information
	define("LANG_BILLINGINFO", "Fatura Bilgileri");
	//This information will not be displayed publicly.
	define("LANG_BILLINGINFO_MSG1", "Bu bilgiler herkes tarafından görüntülenmeyecektir.");
	//You will configure your article after placing the order.
	define("LANG_BILLINGINFO_MSG2_ARTICLE", "Makalenizi sipariş yaptıktan sonra ayarlayacaksınız.");
	//You will configure your banner after placing the order.
	define("LANG_BILLINGINFO_MSG2_BANNER", "Afişinizi sipariş yaptıktan sonra ayarlayacaksınız.");
	//You will configure your classified after placing the order.
	define("LANG_BILLINGINFO_MSG2_CLASSIFIED", "Ilanınızı sipariş yaptıktan sonra ayarlayacaksınız .");
	//You will configure your event after placing the order.
	define("LANG_BILLINGINFO_MSG2_EVENT", "Aktivitenizi sipariş yaptıktan sonra ayarlayacaksınız.");
	//You will configure your listing after placing the order.
	define("LANG_BILLINGINFO_MSG2_LISTING", "Listenizi sipariş yaptıktan sonra ayarlayacaksınız.");
	//Billing Information Error
	define("LANG_BILLINGINFO_ERROR", "Fatura Bilgisi Hatası");
    //Or back to previous page
    define("LANG_ADVERTISE_BACK", "Veya önceki sayfaya geri dön");
	//Checking out
	define("LANG_ADVERTISE_CHECKOUT", "Kontrol dışarı");
    //Listing [level]
    define("LANG_ADVERTISE_LISTINGLEVEL", "Liste [level]");
    //Event [level]
    define("LANG_ADVERTISE_EVENTLEVEL", "Aktivite [level]");
    //Classified [level]
    define("LANG_ADVERTISE_CLASSIFIEDLEVEL", "İlanlar [level]");
    //Article [level]
    define("LANG_ADVERTISE_ARTICLELEVEL", "Makale [level]");
    //Banner [level]
    define("LANG_ADVERTISE_BANNERLEVEL", "Afiş [level]");
    //Identification
    define("LANG_ADVERTISE_IDENTIFICATION", "Kimlik");
    //Confirmation
    define("LANG_ADVERTISE_CONFIRMATION", "Onay");
    //Please, login with your account or sign up today.
    define("LANG_ADVERTISE_SIGNUP", "Hesabınızla giriş yapın veya bugün kayıt olun.");
    //I'm already a user
    define("LANG_ADVERTISE_SIGNUP_ALREADYUSER", "Zaten bir kullanıcı değilim");
    //I'm a new user
    define("LANG_ADVERTISE_SIGNUP_NEWUSER", "Ben yeni bir kullanıcı değilim");
    //Create a new account now.
    define("LANG_ADVERTISE_CREATE_ACC", "Şimdi yeni bir hesap oluşturun.");
    //Billing Detail
    define("LANG_ADVERTISE_BILLINGDETAIL", "Ödeme Detayları");
    //A quick overview of how much you will be charged.
    define("LANG_ADVERTISE_BILLINGDETAIL_TIP", "Eğer tahsil edilecektir ne kadar hızlı bir bakış.");
    //Payment
    define("LANG_ADVERTISE_PAYMENT", "Ödeme");
    //Make your payment and finish your order.
    define("LANG_ADVERTISE_PAYMENT_TIP", "Ödemenizi yapın ve sipariş bitirmek.");
    //Print your invoice and finish your order.
    define("LANG_ADVERTISE_PAYMENT_TIP2", "Faturanızı yazdırın ve sipariş bitirmek.");
    //Thank you for your order!
    define("LANG_ADVERTISE_THANKYOU", "Siparişiniz için teşekkür ederiz!");
    //Order Description
    define("LANG_ADVERTISE_ORDERDESC", "Sipariş Açıklama");
    //A brief summary of your order.
    define("LANG_ADVERTISE_ORDERDESC_TIP", "Siparişiniz kısa bir özeti.");
    //Thanks!
    define("LANG_ADVERTISE_THANKS", "Teşekkürler!");
    //Already registered users should use
    define("LANG_ADVERTISE_ALREADYUSER1", "Zaten kayıtlı kullanıcılar kullanmalısınız");
    //members check out area
    define("LANG_ADVERTISE_ALREADYUSER2", "üyeleri bölgeyi kontrol");
    //You are already logged as
    define("LANG_ADVERTISE_LOGGED_AS", "Zaten olarak kaydedilir");
	//Most Popular
	define("LANG_ADVERTISE_POPULAR", "En Popüler");
	//days free trial!
	define("LANG_ADVERTISE_TRIAL", "gün ücretsiz deneme!");
	//after
	define("LANG_AFTER", "sonra");
	//View Sample
	define("LANG_ADVERTISE_SAMPLE", "Örnek bilgileri");
	//Have any questions?
	define("LANG_ADVERTISE_QUESTIONS", "Herhangi bir sorunuz var?");
	//Contact us today
	define("LANG_ADVERTISE_CONTACT", "Bize bugün");
	//No Tax
	define("LANG_ADVERTISE_NOTAX", "No Vergi");
	//Article Information
	define("LANG_ARTICLEINFO", "Makale Bilgileri");
	//Article Information Error
	define("LANG_ARTICLEINFO_ERROR", "Makale Bilgisi Hatası");
	//Banner Information
	define("LANG_BANNERINFO", "Afiş Bilgileri");
	//Banner Information Error
	define("LANG_BANNERINFO_ERROR", "Afiş Bilgisi Hatası");
	//Classified Information
	define("LANG_CLASSIFIEDINFO", "İlan Bilgileri");
	//Classified Information Error
	define("LANG_CLASSIFIEDINFO_ERROR", "İlan Bilgisi Hatası");
	//Browse Events by Date
	define("LANG_BROWSEEVENTSBYDATE", "Aktiviteleri tarihe göre göster");
	//Event Information
	define("LANG_EVENTINFO", "Aktivite Bilgileri");
	//Event Information Error
	define("LANG_EVENTINFO_ERROR", "Aktivite Bilgisi Hatası");
	//Listing Information
	define("LANG_LISTINGINFO", "Liste Bilgileri");
    //What do you want to call your listing? This is normally your company name.
	define("LANG_LISTINGINFO_TIP", "Eğer liste aramak ne istiyorsun? Bu normalde şirket adıdır.");
    //Choose a template applicable to your business type if you feel the need too.
	define("LANG_LISTINGINFO_TIP2", "Çok ihtiyacı hissediyorum eğer iş türü için geçerli bir şablon seçin.");
    //What do you want to call your event?
	define("LANG_EVENTINFO_TIP", "Eğer Aktivite aramak ne istiyorsun?");
    //What do you want to call your classified?
	define("LANG_CLASSIFIEDINFO_TIP", "Eğer İlanlar aramak ne istiyorsun?");
    //What do you want to call your article?
	define("LANG_ARTICLEINFO_TIP", "Eğer Makale aramak ne istiyorsun?");
    //What do you want to call your banner?
	define("LANG_BANNERINFO_TIP", "Eğer Afiş aramak ne istiyorsun?");
	//Listing Information Error
	define("LANG_LISTINGINFO_ERROR", "Liste Bilgisi Hatası");
	//Claim this Listing
	define("LANG_LISTING_CLAIMTHIS", "Bu listeyi talep et");
	//Claiming
	define("LANG_LISTING_CLAIMING", "Iddia");
	//To claim this listing, just log in with your existing account details or create a new account.
	define("LANG_CLAIM_SIGNUP", "Bu liste iddia etmek, sadece mevcut hesap detayları ile oturum veya yeni bir hesap oluşturun.");
	//Listing Type
	define("LANG_LISTING_LABELTEMPLATE", "Listeler Tür");
	//No results were found for the search criteria you requested.
	define("LANG_MSG_NORESULTS", "Aradığınız kriterlere uygun bir sonuç bulunamadı.");
	//Please try your search again or browse by section.
	define("LANG_MSG_TRYAGAIN_BROWSESECTION", "Lütfen aramanızı tekrar deneyin veya bölüme göre arayın.");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword and perform your search again.
	define("LANG_MSG_USE_SPECIFIC_KEYWORD", "Bazen kullandığınız anahtar sözcük çok kapsamlı olduğu için sonuç alamayabilirsiniz. Daha spesifik bir anahtar sözcük kullanıp aramanızı tekrar yapmayı deneyin.");
	//Please type at least one keyword on the search box.
	define("LANG_MSG_LEASTONEKEYWORD", "Lütfen arama kutusuna en az bir anahtar sözcük girin.");
	//"No results content"
	define("LANG_SEARCH_NORESULTS", "<h1>Arama için sonuçlar yok</h1><p>Aramanız sonuç döndürür. Bu sıradışı olsa kullandığınız arama terimi biz gerçekten eşleşen herhangi bir içerik yok biraz genel veya olduğunda, zaman zaman olur.</p><h2>Öneriler:</h2>&raquo;Arama terimlerinizi daha spesifik olun<br />&raquo;Yazım kontrol edin<br />&raquo;Arama bölümüne göz atarak deneyin aracılığıyla bulamazsanız<br /><br /><p>Size yanlışlıkla buraya gelmiş inanıyoruz, burada bir sorun bildirmek için site yöneticisi ile irtibata.</p>");
	//Image
	define("LANG_SLIDESHOW_IMAGE", "Resim");
	//of
	define("LANG_SLIDESHOW_IMAGEOF", "i");
	//Error loading image
	define("LANG_SLIDESHOW_IMAGELOADINGERROR", "Resim yükleme hatası");
	//Next
	define("LANG_SLIDESHOW_NEXT", "İleri");
	//Pause
	define("LANG_SLIDESHOW_PAUSE", "Durdur");
	//Play
	define("LANG_SLIDESHOW_PLAY", "Oynat");
	//Back
	define("LANG_SLIDESHOW_BACK", "Geri");
	//Your e-mail has been sent. Thank you.
	define("LANG_CONTACTMSGSUCCESS", "E-postanız gönderildi. Teşekkürler.");
	//There was a problem sending this e-mail. Please try again later.
	define("LANG_CONTACTMSGFAILED", "Bu e-postayı gönderirken bir sorun çıktı. Lütfen tekrar deneyin.");
	//Please enter your name.
	define("LANG_MSG_CONTACT_ENTER_NAME", "Lütfen adınızı girin.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_CONTACT_ENTER_VALID_EMAIL", "Lütfen geçerli bir e-posta adresi girin.");
	//Please type the message.
	define("LANG_MSG_CONTACT_TYPE_MESSAGE", "Lütfen bir mesaj girin.");
	//Please type the code correctly or mark the checkbox if available.
    define("LANG_MSG_CONTACT_TYPE_CODE", "Kodu doğru yazın veya varsa onay kutusunu işaretleyin lütfen.");
	//Please correct it and try again.
	define("LANG_MSG_CONTACT_CORRECTIT_TRYAGAIN", "Lütfen düzeltip tekrar deneyin.");
	//Please type a name.
	define("LANG_MSG_CONTACT_TYPE_NAME", "Lütfen bir ad girin.");
	//Please type a subject.
	define("LANG_MSG_CONTACT_TYPE_SUBJECT", "Lütfen bir konu girin.");
	//SOME DETAILS
	define("LANG_ARTICLE_TOFRIEND_MAIL", "BAZI DETAYLAR");
	//SOME DETAILS
	define("LANG_CLASSIFIED_TOFRIEND_MAIL", "BAZI DETAYLAR");
	//SOME DETAILS
	define("LANG_EVENT_TOFRIEND_MAIL", "BAZI DETAYLAR");
	//SOME DETAILS
	define("LANG_LISTING_TOFRIEND_MAIL", "BAZI DETAYLAR");
	//SOME DETAILS
	define("LANG_PROMOTION_TOFRIEND_MAIL", "BAZI DETAYLAR");
	//Please enter a valid e-mail address in the "To" field
	define("LANG_MSG_TOFRIEND1", "Lütfen \"Gönderen\" alanına geçerli bir e-posta adresi girin");
	//Please enter a valid e-mail address in the "From" field
	define("LANG_MSG_TOFRIEND2", "Lütfen \"Gönderilen\" alanına geçerli bir e-posta adresi girin");
	//"Item not found. Please return to" [YOURSITE] and try again.
	define("LANG_MSG_TOFRIEND3", "Kayıt bulunamadı. Lütfen e geri dönün");
	//We could not find the item you're trying to send to a friend. Please return to [YOURSITE] "and try again."
	define("LANG_MSG_TOFRIEND4", "ve tekrar deneyin.");
	//Please enter a valid e-mail address in the "Your E-mail" field
	define("LANG_MSG_TOFRIEND5", "Lütfen \"E-Posta Adresiniz\" alanına geçerli bir e-posta adresi girin");
	//"About" [ARTICLE_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_1", "Hakkında");
	//About [ARTICLE_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_2", "den");
	//"About" [CLASSIFIED_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_1", "Hakkında");
	//About [CLASSIFIED_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_2", "den");
	//"About" [EVENT_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_1", "Hakkında");
	//About [EVENT_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_2", "den");
	//"About" [LISTING_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_1", "Hakkında");
	//About [LISTING_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_2", "den");
	//"About" [PROMOTION_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_1", "Hakkında");
	//About [PROMOTION_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_2", "den");
	//Send info about this article to a friend
	define("LANG_ARTICLE_TOFRIEND_SAUDATION", "Bu makale hakkında arkadaşına bilgi gönder");
	//Send info about this classified to a friend
	define("LANG_CLASSIFIED_TOFRIEND_SAUDATION", "Bu ilan hakkında arkadaşına bilgi gönder");
	//Send info about this event to a friend
	define("LANG_EVENT_TOFRIEND_SAUDATION", "Bu aktivite hakkında arkadaşına bilgi gönder");
	//Send info about this listing to a friend
	define("LANG_LISTING_TOFRIEND_SAUDATION", "Bu liste hakkında arkadaşına bilgi gönder");
	//Send info about this deal to a friend
	define("LANG_PROMOTION_TOFRIEND_SAUDATION", "Bu teklif hakkında arkadaşına bilgi gönder");
	//Message sent by
	define("LANG_MESSAGE_SENT_BY", "Mesaj tarafından gönderildi ");
	//This is a automatic message.
	define("LANG_THIS_IS_A_AUTOMATIC_MESSAGE", "Bu otomatik bir mesajdır.");
	//Contact
	define("LANG_CONTACT", "İletişim");
	//article
	define("LANG_ARTICLE", "makale");
	//classified
	define("LANG_CLASSIFIED", "ilan");
	//event
	define("LANG_EVENT", "aktivite");
	//listing
	define("LANG_LISTING", "liste");
	//deal
	define("LANG_PROMOTION", "teklif");
	//Please search at least one parameter on the search box!
	define("LANG_MSG_LEASTONEPARAMETER", "Lütfen arama kutusuna en az bir parametre girin!");
	//Please try your search again.
	define("LANG_MSG_TRYAGAIN", "Lütfen aramanızı tekrar deneeyin.");
	//No articles registered yet.
	define("LANG_MSG_NOARTICLES", "Henüz makale kaydedilmemiş.");
	//No classifieds registered yet.
	define("LANG_MSG_NOCLASSIFIEDS", "Henüz ilan kaydedilmemiş.");
	//No events registered yet.
	define("LANG_MSG_NOEVENTS", "Henüz aktivite kaydedilmemiş.");
	//No listings registered yet.
	define("LANG_MSG_NOLISTINGS", "Henüz liste kaydedilmemiş.");
	//No deals registered yet.
	define("LANG_MSG_NOPROMOTIONS", "Henüz teklifler kaydedilmemiş.");
	//Message sent through
	define("LANG_CONTACTPRESUBJECT", "Mesaj üzerinden gönderildi");
	//E-mail Form
	define("LANG_EMAILFORM", "E-posta Formu");
	//Click here to print
	define("LANG_PRINTCLICK", "Yazdırmak için tıklayın");
	//View all classified categories
	define("LANG_CLASSIFIED_VIEWALLCATEGORIES", "Tüm kategorileri gör");
	//Location
	define("LANG_CLASSIFIED_LOCATIONS", "Yer");
	//More Classifieds
	define("LANG_CLASSIFIED_MORE", "Daha fazla ilan");
	//View all event categories
	define("LANG_EVENT_VIEWALLCATEGORIES", "Tüm kategorileri gör");
	//Location
	define("LANG_EVENT_LOCATIONS", "Yer");
	//Featured Events
	define("LANG_EVENT_FEATURED", "Vitrindeki Aktiviteler");
	//events
	define("LANG_EVENT_PLURAL", "Aktiviteler");
	//Search results
	define("LANG_SEARCHRESULTS", "Arama sonuçları");
	//Results
	define("LANG_RESULTS", "Sonuçlar");
	//Result
	define("LANG_RESULT", "Sonuç");
    //Letter
    define("LANG_LETTER", "Mektup");
	//Search results "for" keyword
	define("LANG_SEARCHRESULTS_KEYWORD", "için");
	//Search results "in" where
	define("LANG_SEARCHRESULTS_WHERE", "deki");
	//Search results "in" template
	define("LANG_SEARCHRESULTS_TEMPLATE", "daki");
	//Search results "in" category
	define("LANG_SEARCHRESULTS_CATEGORY", "deki");
	//Search results "in category"
	define("LANG_SEARCHRESULTS_INCATEGORY", "kategorisindeki");
	//Search results "in" location
	define("LANG_SEARCHRESULTS_LOCATION", "deki");
	//Search results "in" zip
	define("LANG_SEARCHRESULTS_ZIP", "daki");
	//Search results "for" date
	define("LANG_SEARCHRESULTS_DATE", "için");
	//Search results - "Page" X
	define("LANG_SEARCHRESULTS_PAGE", "Sayfa");
	//Recent Reviews
	define("LANG_RECENT_REVIEWS", "En Son Yorumlar");
	//Reviews of
	define("LANG_REVIEWSOF", "Yorumları");
	//Reviews are disabled
	define("LANG_REVIEWDISABLE", "Yorumlar etkisiz kılındı");
	//View all article categories
	define("LANG_ARTICLE_VIEWALLCATEGORIES", "Tüm kategorileri gör");
	//View all deal categories
	define("LANG_PROMOTION_VIEWALLCATEGORIES", "Tüm kategorileri gör");
    //View all blog categories
	define("LANG_BLOG_VIEWALLCATEGORIES", "Tüm kategorileri gör");
	//Offer
	define("LANG_PROMOTION_OFFER", "Teklif");
	//Description
	define("LANG_PROMOTION_DESCRIPTION", "Tanım");
	//Conditions
	define("LANG_PROMOTION_CONDITIONS", "Şartlar");
	//Location
	define("LANG_PROMOTION_LOCATIONS", "Yer");
	//Item not found!
	define("LANG_MSG_NOTFOUND", "Kayıt bulunamadı!");
	//Item not available!
	define("LANG_MSG_NOTAVAILABLE", "Kayıt mevcut değil!");
	//Listing Search Results
	define("LANG_MSG_LISTINGRESULTS", "Liste Arama Sonuçları");
	//Deal Search Results
	define("LANG_MSG_PROMOTIONRESULTS", "Teklif Arama Sonuçları");
	//Event Search Results
	define("LANG_MSG_EVENTRESULTS", "Aktivite Arama Sonuçları");
	//Classified Search Results
	define("LANG_MSG_CLASSIFIEDRESULTS", "İlan Arama Sonuçları");
	//Article Search Results
	define("LANG_MSG_ARTICLERESULTS", "Makale Arama Sonuçları");
	//Available Languages
	define("LANG_MSG_AVAILABLELANGUAGES", "Mevcut Diller");
	//You can choose up to [MAX_ENABLED_LANGUAGES] of the languages below for your directory.
	define("LANG_MSG_AVAILABLELANGUAGESMSG", "Rehberiniz için en fazla ".MAX_ENABLED_LANGUAGES." adet dil seçebilirsiniz.");
	//Redeem without Facebook
    define("LANG_DEAL_DONTUSEFACEBOOK", "Facebook olmadan al");
	//posted on facebook and twitter
	define("LANG_DEAL_POSTFACEBOOK_TWITTER", "Facebook ve Twitter'a gönderildi");
	//posted on facebook
	define("LANG_DEAL_POSTFACEBOOK", "Facebook'a gönderildi");
	//posted on twitter
	define("LANG_DEAL_TWITTER", "Twitter'a gönderildi");
	//Posted on
	define("LANG_LABEL_POSTED_ON", "Gönderildi");
	//deal checked out
	define("LANG_DEAL_CHECKOUT", "teklif kapandı");
	//deal opened
	define("LANG_DEAL_OPENED", "teklif açıldı");
	//Terms & Conditions
	define("LANG_LABEL_DEAL_CONDITIONS", "Şartlar ve Koşullar");
	//maximum 1000 characters
	define("LANG_MSG_MAX_1000_CHARS", "en fazla 1000 karakter");
	//Please provide a conditions with a maximum of 1000 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_1000_CHARS", "Lütfen en fazla 1000 karakterlik bir şart metni girin");
	//See All
	define("LANG_LABEL_SEE_ALL", "Tümü");
	//Stars
	define("LANG_LABEL_STARS", "Yıldız");
	//Star
	define("LANG_LABEL_STAR", "Yıldız");
	//Terms of Use
    define("LANG_TERMS_USE", "Kullanım Şartları");
	//Privacy Policy
	define("LANG_PRIVACY_POLICY", "Gizlilik Politikası");
	//Size
    define("LANG_ADVERTISE_SIZE", "Boyutlar");
	//Title / Address
	define("LANG_ADVERTISE_LIST_TITLE_ADDRESS", "Başlık / Adresi");
	//Title
	define("LANG_ADVERTISE_LIST_TITLE", "Başlık");
	//Ratings and Reviews
	define("LANG_ADVERTISE_LIST_REVIEW", "Derecelendirme ve Yorumlar");
	//Detail View
	define("LANG_ADVERTISE_LIST_DETAIL_VIEW", "Detay Görünümü");
	//Deal
	define("LANG_ADVERTISE_LIST_DEAL", "Anlaşma");
	//Send to Phone
	define("LANG_ADVERTISE_LIST_SEND_TO_PHONE", "Telefon Gönder");
	//Click to Call
	define("LANG_ADVERTISE_LIST_CLICK_TO_CALL", "Aramak İçin Tıklayın");
	//Phone
	define("LANG_ADVERTISE_LIST_PHONE", "Telefon");
	//E-mail
	define("LANG_ADVERTISE_LIST_EMAIL", "E-posta");
	//Url
	define("LANG_ADVERTISE_LIST_URL", "URL");
	//Fax Number
	define("LANG_ADVERTISE_LIST_FAX", "Faks Numarası");
	//Summary Description
	define("LANG_ADVERTISE_LIST_SUMMARY_DESCRIPTION", "Özet Açıklama");
	//Badges
	define("LANG_ADVERTISE_LIST_BADGES", "Rozetler");
	//Detail Description
	define("LANG_ADVERTISE_LIST_LONG_DESCRIPTION", "Detay Açıklama");
	//Photo Gallery
	define("LANG_ADVERTISE_LIST_MAIN_IMAGE", "Fotoğraf Galerisi");
	//Video
	define("LANG_ADVERTISE_LIST_VIDEO", "Video");
	//Additional Uploads
	define("LANG_ADVERTISE_LIST_ATTACHMENT_FILE", "Ek Uploads");
	//Hours
	define("LANG_ADVERTISE_LIST_HOURS_OF_WORK", "Çalışma Saatleri");
	//Location reference
	define("LANG_ADVERTISE_LIST_LOCATIONS", "Yer referans");
	//Features
	define("LANG_ADVERTISE_LIST_FEATURES", "Özellikler");
	//Facebook Social Plugin
	define("LANG_ADVERTISE_LIST_FBPAGE", "Facebook Sosyal Eklentisi");
	//Contact Name
	define("LANG_ADVERTISE_LIST_CONTACT_NAME", "Kişi Adı");
	//Contact Phone
	define("LANG_ADVERTISE_LIST_CONTACT_PHONE", "Telefon İletişim");
	//Contact E-mail
	define("LANG_ADVERTISE_LIST_CONTACT_EMAIL", "E-posta İletişim");
	//Event Time
	define("LANG_ADVERTISE_LIST_START_TIME", "Olay Zaman");
	//Price
	define("LANG_ADVERTISE_LIST_PRICE", "Fiyat");
	//Publication Date
	define("LANG_ADVERTISE_LIST_PUBLICATION", "Yayın Tarihi");
	//Author
	define("LANG_ADVERTISE_LIST_AUTHOR", "Yazar");
	//Abstract
	define("LANG_ADVERTISE_LIST_ABSTRACT", "Soyut");
	//Content
	define("LANG_ADVERTISE_LIST_CONTENT", "Içerik");
    //Social Networking Pages
    define("LANG_ADVERTISE_LIST_SOCIAL_NETWORK", "Sosyal Ağ Sayfaları");

	# ----------------------------------------------------------------------------------------------------
	# MANAGE MODULES ORDINATION
	# ----------------------------------------------------------------------------------------------------
	//Click here to order by descending title
	define("LANG_CLICK_ORDERTITLEDESC", "Azalan Tarihe göre sipariş için buraya tıklayın");
	//Click here to order by ascending title
	define("LANG_CLICK_ORDERTITLEASC", "Artan Tarihe göre sipariş için buraya tıklayın");
	//Click here to order by descending level
	define("LANG_CLICK_ORDERLEVELDESC", "Azalan düzeyi tarafindan için buraya tıklayın");
	//Click here to order by ascending level
	define("LANG_CLICK_ORDERLEVELASC", "Artan düzeyde tarafindan için tıklayın");
	//Click here to order by descending account
	define("LANG_CLICK_ORDERACCOUNTDESC", "Azalan hesabı tarafindan için buraya tıklayın");
	//Click here to order by ascending account
	define("LANG_CLICK_ORDERACCOUNTASC", "Artan hesap tarafindan için buraya tıklayın");
	//Click here to order by descending status
	define("LANG_CLICK_ORDERSTATUSDESC", "Durumu azalan Sipariş vermek için tıklayınız");
	//Click here to order by ascending status
	define("LANG_CLICK_ORDERSTATUSASC", "Durum artan tarafindan için tıklayın");
	//Click here to order by descending caption
	define("LANG_CLICK_ORDERCAPTIONDESC", "Başlık azalan Sipariş vermek için tıklayınız");
	//Click here to order by ascending caption
	define("LANG_CLICK_ORDERCAPTIONASC", "Başlık artan tarafindan için buraya tıklayın");
	//Click here to order by descending type
	define("LANG_CLICK_ORDERTYPEDESC", "Türü azalan Sipariş vermek için tıklayınız");
	//Click here to order by ascending type
	define("LANG_CLICK_ORDERTYPEASC", "Türü artan tarafindan için tıklayın");
	//Click here to order by descending renewal date
	define("LANG_CLICK_ORDERRENEWALDESC", "Yenileme tarihinden azalan Sipariş vermek için tıklayınız");
	//Click here to order by ascending renewal date
	define("LANG_CLICK_ORDERRENEWALASC", "Yenileme Tarihi küçükten Sipariş vermek için tıklayınız");
	//Click here to order by descending impressions
	define("LANG_CLICK_ORDERIMPRESSIONSDESC", "Gösterimleri azalan Sipariş vermek için tıklayınız");
	//Click here to order by ascending impressions
	define("LANG_CLICK_ORDERIMPRESSIONSASC", "Artan gösterim tarafindan için tıklayın");
	//Click here to order by descending start date
	define("LANG_CLICK_ORDERSTARTDATEDESC", "Başlangıç ​​tarihi azalan Sipariş vermek için tıklayınız");
	//Click here to order by ascending start date
	define("LANG_CLICK_ORDERSTARTDATEASC", "Başlangıç ​​Tarihi küçükten Sipariş vermek için tıklayınız");

	# ----------------------------------------------------------------------------------------------------
	# MEMBERS
	# ----------------------------------------------------------------------------------------------------
	//Your item has been paid, so you can add a maximum of 3 categories free.
	define("LANG_ITEM_ALREADY_HAS_PAID", "Kaydınızın ödemesi yapıldı, böylece en fazla [max] kategoriyi bedava ekleyebilirsiniz.");
	//Your item has been paid, so you can add a maximum of 1 category free.
	define("LANG_ITEM_ALREADY_HAS_PAID2", "Kaydınızın ödemesi yapıldı, böylece en fazla [max] kategoriyi bedava ekleyebilirsiniz.");
	//Video Snippet Code TIP
	define("LANG_VIDEO_SNIPPETTIP", "Video Kodu hakkında bir sorunuz mu var?");
	//Enjoy our Services!
	define("LANG_ENJOY_OUR_SERVICES", "Hizmetlerimizin tadını çıkarın!");
	//Remove association with
	define("LANG_REMOVE_ASSOCIATION_WITH", "Arasındaki ilişkiyi kaldır");
	//Welcome
	define("LANG_LABEL_WELCOME", "Hoşgeldiniz");
	//Sponsor Options
	define("LANG_LABEL_MEMBER_OPTIONS", "Sponsor Ayarları");
	//Back to Website
	define("LANG_LABEL_BACK_TO_SEARCH", "Website Dön");
	//Add New Account
	define("LANG_LABEL_ADD_NEW_ACCOUNT", "Yeni Hesap Ekle");
	//Forgotten password
	define("LANG_LABEL_FORGOTTEN_PASSWORD", "Unutulmuş şifre");
	//Click here
	define("LANG_LABEL_CLICK_HERE", "Tıklayın");
	//Help
	define("LANG_LABEL_HELP", "Yardım");
	//Reset Password
	define("LANG_LABEL_RESET_PASSWORD", "Şifreyi sıfırla");
	//Account and Contact Information
	define("LANG_LABEL_ACCOUNT_AND_CONTACT_INFO", "Hesap ve İletişim Bilgileri");
	//Signup Notification
	define("LANG_LABEL_SIGNUP_NOTIFICATION", "Kayıt Bildirisi");
	//Go to Sign in
	define("LANG_LABEL_GO_TO_LOGIN", "Kaydol'a git");
	//Order
	define("LANG_LABEL_ORDER", "Sipariş Et");
	//Check Out
	define("LANG_LABEL_CHECKOUT", "Ödeme Yap");
	//Configuration
	define("LANG_LABEL_CONFIGURATION", "Ayarlar");
	//Category Detail
	define("LANG_LABEL_CATEGORY_DETAIL", "Kategori Detayı");
	//Site Manager
	define("LANG_LABEL_SITE_MANAGER", "Site Yöneticisi");
	//Summary page
	define("LANG_LABEL_SUMMARY_PAGE", "Özet Sayfası");
	//Detail page
	define("LANG_LABEL_DETAIL_PAGE", "Detay Sayfası");
	//Photo Gallery
	define("LANG_LABEL_PHOTO_GALLERY", "Foto Galeri");
	//To select a main image, simply click on it.
	define("LANG_LABEL_PHOTO_GALLERY_MAIN", "Bir ana görüntüyü seçmek için sadece üzerine tıklayın.");
	//Add Banner
	define("LANG_LABEL_ADDBANNER", "Afiş Ekle");
	//Custom Invoice Title
	define("LANG_LABEL_CUSTOM_INVOICE_TITLE", "Özel Fatura Başlığı");
	//Custom Invoice Items
	define("LANG_LABEL_CUSTOM_INVOICE_ITEMS", "Özel Fatura Kayıtları");
	//Easy and Fast.
	define("LANG_LABEL_EASY_AND_FAST", "Kolay ve de Hızlı.");
	//Steps
	define("LANG_LABEL_STEPS", "Adımlar");
	//Account Signup
	define("LANG_LABEL_ACCOUNT_SIGNUP", "Hesap Kaydı");
	//Select a Level
	define("LANG_LABEL_SELECT_PACKAGE", "Bir Seviye Seçin");
	//Payment Status
	define("LANG_LABEL_PAYMENTSTATUS", "Ödeme Statüsü");
	//Expiration
	define("LANG_LABEL_EXPIRATION", "Son Kullanma Tarihi");
	//New Deal
	define("LANG_LABEL_ADDNEWPROMOTION", "Teklif Ekle.");
	//Add a new deal
	define("LANG_LABEL_ADDANEWPROMOTION", "Yeni teklif ekle.");
	//Manage Billing
	define("LANG_LABEL_MANAGEBILLING", "Faturaları Yönet");
	//Click here if you have your password already.
	define("LANG_MSG_CLICK_IF_YOU_HAVE_PASSWORD", "Şifrenizi zaten aldıysanız tıklayın.");
	//Not a sponsor?
	define("LANG_MSG_NOT_A_MEMBER", "Sponsor değil misiniz?");
	//for information on adding your item to
	define("LANG_MSG_FOR_INFORMATION_ON_ADDING_YOUR_ITEM", "kaydınızı eklemek hakkında bilgiler");
	//Welcome to the Sponsor Section
	define("LANG_MSG_WELCOME", "Sponsor Bölümüne Hoşgeldiniz");
	//Welcome to the Member Section
	define("LANG_MSG_WELCOME2", "Üye Bölümüne Hoşgeldiniz");
	//"Account locked. Wait" X minute(s) and try again.
	define("LANG_MSG_ACCOUNTLOCKED1", "Hesap kilitlendi.");
	//Account locked. Wait X "minute(s) and try again."
	define("LANG_MSG_ACCOUNTLOCKED2", "dakika bekleyin ve tekrar deneyin.");
	//One or more required fields were not filled in. Please confirm that all required information has been entered before continuing.
	define("LANG_MSG_FOREIGNACCOUNTWARNING", "Bir veya daha fazla gerekli alanların doldurulması değildi. Gerekli tüm bilgileri devam etmeden önce girmiş olduğunu onaylayın.");
	//You don't have access permission from this IP address!
	define("LANG_MSG_YOUDONTHAVEACCESSFROMTHISIPADDRESS", "Bu IP adresinden giriş yapma yetkiniz yok!");
	//Your account was deactivated!
	define("LANG_MSG_ACCOUNT_DEACTIVE", "Hesabınız etkisizleştirildi!");
	//Sorry, your username or password is incorrect.
	define("LANG_MSG_USERNAME_OR_PASSWORD_INCORRECT", "Maalesef kullanıcı adı veya şifreniz yanlış.");
	//Sorry, wrong account.
	define("LANG_MSG_WRONG_ACCOUNT", "Maalesef yanlış hesap.");
	//Sorry, for your protection the link sent to your e-mail has expired. If you forgot your password click on the link below.
	define("LANG_MSG_WRONG_KEY", "Maalesef güvenliğiniz için e-postanıza gönderilen linkin süresi doldu. Şifrenizi unuttuysanız aşağıdaki linke tıklayın.");
    //Invalid activation key.
    define("LANG_MSG_WRONG_ACTIVATION_KEY", "Geçersiz aktivasyon anahtarı.");
    //Account successfully activated!
    define("LANG_MSG_ACCOUNT_ACTIVATED", "Başarıyla aktive Hesap!");
	//OpenID Server not available!
	define("LANG_MSG_OPENID_SERVER", "OpenID Sunucusu uygun değil!");
	//Error requesting OpenID Server!
	define("LANG_MSG_OPENID_ERROR", "OpenID Sunucusu isterken hata!");
	//OpenID request canceled!
	define("LANG_MSG_OPENID_CANCEL", "OpenID isteği iptal edildi!");
	//Google request canceled!
	define("LANG_MSG_GOOGLE_CANCEL", "Google isteği iptal edildi!");
	//Invalid OpenID Identity!
	define("LANG_MSG_OPENID_INVALID", "Geçersiz OpenID Kimliği!");
	//Forgot your password?
	define("LANG_MSG_FORGOT_YOUR_PASSWORD", "Şifrenizi mi unuttunuz?");
	//What is OpenID?
	define("LANG_MSG_WHATISOPENID", "OpenID nedir?");
	//What is Facebook?
	define("LANG_MSG_WHATISFACEBOOK", "Facebook nedir?");
	//What is Google?
	define("LANG_MSG_WHATISGOOGLE", "Google nedir?");
	//Account successfully updated!
	define("LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED", "Hesap başarıyla güncellendi!");
	//Password successfully updated!
	define("LANG_MSG_PASSWORD_SUCCESSFULLY_UPDATED", "Şifre başarıyla güncellendi!");
	//"Thank you for signing up for an account in" [EDIRECTORY_TITLE]
	define("LANG_MSG_THANK_YOU_FOR_SIGNING_UP", "de bir hesap kaydettiğiniz için teşekkür ederiz");
	//Sign in to manage your account with the e-mail and password below.
	define("LANG_MSG_LOGIN_TO_MANAGE_YOUR_ACCOUNT", "Hesabınızı yönetmek için aşağıdaki e-posta ve şifreyi kullanarak oturum açın.");
	//You can see
	define("LANG_MSG_YOU_CAN_SEE", "Görebilirsiniz");
	//Your account in
	define("LANG_MSG_YOUR_ACCOUNT_IN", "daki hesabınız");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_ARTICLE_WILL_SHOW", "Bu makale resim gösterecek");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_CLASSIFIED_WILL_SHOW", "Bu ilan resim gösterecek");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_EVENT_WILL_SHOW", "Bu aktivite resim gösterecek");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_LISTING_WILL_SHOW", "Bu liste resim gösterecek");
	//This [ITEM] will show [UNLIMITED|"the max of" X] images per gallery.
	define("LANG_MSG_THE_MAX_OF", "en fazla");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTO", "resim");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTOS", "resimler");
	//This [ITEM] will show [UNLIMITED|the max of X] images "in the gallery"
	define("LANG_MSG_PER_GALLERY", "galeride");
	// plus one main image.
	define("LANG_MSG_PLUS_MAINIMAGE", " artı bir ana görüntü.");
	//Click here to pay for your article
	define("LANG_MSG_CONTINUE_TO_PAY_ARTICLE", "Makalenizi ödemek için devam edin");
	//Click here to pay for your banner
	define("LANG_MSG_CONTINUE_TO_PAY_BANNER", "Afişinizi ödemek için devam edin");
	//Click here to pay for your classified
	define("LANG_MSG_CONTINUE_TO_PAY_CLASSIFIED", "Ilanızı ödemek için devam edin");
	//Click here to pay for your event
	define("LANG_MSG_CONTINUE_TO_PAY_EVENT", "Aktivitenizi ödemek için devam edin");
	//Click here to pay for your listing
	define("LANG_MSG_CONTINUE_TO_PAY_LISTING", "Listenizi ödemek için devam edin");
	//Articles are activated by
	define("LANG_MSG_ARTICLES_ARE_ACTIVATED_BY", "Makaleler tarafından etkinleştirilir");
	//Banners are activated by
	define("LANG_MSG_BANNERS_ARE_ACTIVATED_BY", "Afişler tarafından etkinleştirilir");
	//Classifieds are activated by
	define("LANG_MSG_CLASSIFIEDS_ARE_ACTIVATED_BY", "Ilanlar tarafından etkinleştirilir");
	//Events are activated by
	define("LANG_MSG_EVENTS_ARE_ACTIVATED_BY", "Aktiviteler tarafından etkinleştirilir");
	//Listings are activated by
	define("LANG_MSG_LISTINGS_ARE_ACTIVATED_BY", "Listeler tarafından etkinleştirilir");
	//only after the process is complete.
	define("LANG_MSG_ONLY_PROCCESS_COMPLETE", "sadece işlem tamalandıktan sonra.");
    //You can only pay for [MAX_ITEMS_MODULE] each time.
    define("LANG_MSG_PROCCESS_MAXITEMS", "Yalnızca [MAX_ITEMS_MODULE] her zaman için ödeme yapabilirsiniz.");
    //Make the process again with less items.
    define("LANG_MSG_PROCCESS_AGAIN", "Az ürün ile tekrar işlemi yapın.");
	//Tips for the Item Map Tuning
	define("LANG_MSG_TIPSFORMAPTUNING", "Kayıtların Harita Ayarları için ipuçları");
	//You can adjust the position in the map,
	define("LANG_MSG_YOUCANADJUSTPOSITION", "Haritadaki konumu ayarlayabilirsiniz,");
	//with more accuracy.
	define("LANG_MSG_WITH_MORE_ACCURACY", "daha fazla kesinlikle.");
	//Use the controls "+" and "-" to adjust the map zoom.
	define("LANG_MSG_USE_CONTROLS_TO_ADJUST", "Haritayı yaklaştırmak için \"+\" ve \"-\" kontrollerini kullanın.");
	//Use the arrows to navigate on map.
	define("LANG_MSG_USE_ARROWS_TO_NAVIGATE", "Haritada gezmek için okları kullanın.");
	//Drag-and-Drop the marker to adjust the location.
	define("LANG_MSG_DRAG_AND_DROP_MARKER", "Konumu ayarlamak için imleci Taşı-ve-Bırak.");
    //Drag files here to upload
    define("LANG_MSG_DROP_IMAGE", "Yüklemek için buraya dosyaları sürükleyip");
	//Your deal will appear here
	define("LANG_MSG_PROMOTION_WILL_APPEAR_HERE", "teklif burada gözükecek");
	//Associate an existing deal with this listing
	define("LANG_MSG_ASSOCIATE_EXISTING_PROMOTION", "Veya mevcut olan bir teklif bu liste ile ilişkilendirin");
	//No results found!
	define("LANG_MSG_NO_RESULTS_FOUND", "Sonuç bulunmadı!");
	//Access not allowed!
	define("LANG_MSG_ACCESS_NOT_ALLOWED", "Giriş izni verilmedi!");
	//The following problems were found
	define("LANG_MSG_PROBLEMS_WERE_FOUND", "Aşağıdaki problemler bulundu");
	//No items selected or requiring payment.
	define("LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT", "Hiçbir kayıt seçilmedi veya ödeme gerekmiyor.");
	//No items found.
	define("LANG_MSG_NO_ITEMS_FOUND", "Hiçbir kayıt bulunmadı.");
	//No invoices in the system.
	define("LANG_MSG_NO_INVOICES_IN_THE_SYSTEM", "Sistemde hiçbir Fatura yok.");
	//No transactions in the system.
	define("LANG_MSG_NO_TRANSACTIONS_IN_THE_SYSTEM", "Sistemde hiçbir İşlem yok.");
	//Claim this Listing
	define("LANG_MSG_CLAIM_THIS_LISTING", "Bu listeyi talep et");
	//Go to sponsor check out area
	define("LANG_MSG_GO_TO_MEMBERS_CHECKOUT", "Sponsor ödeme bölgesine git");
	//You can see your invoice in
	define("LANG_MSG_YOU_CAN_SEE_INVOICE", "Faturanızı görebilirsiniz");
	//I agree to terms
	define("LANG_MSG_AGREE_TO_TERMS", "Şartları kabul ediyorum");
	//and I will send payment.
	define("LANG_MSG_I_WILL_SEND_PAYMENT", "ve ödeme yapacağım.");
	//This page will redirect you to your sponsor area in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU", "Bu sayfa birkaç saniye içinde sponsor bölgesine yönlendirilecektir.");
	//This page will redirect you to continue your signup process in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU_SIGNUP", "Bu sayfa birkaç saniye içinde kayıt işlemine devam sayfasına yönlendirilecektir.");
	//"If it doesn't work, please" click here
	define("LANG_MSG_IF_IT_DOES_NOT_WORK", "Çalışmıyorsa lütfen");
	//Manage Article
	define("LANG_MANAGE_ARTICLE", "Makaleleri Yönet");
	//Manage Banner
	define("LANG_MANAGE_BANNER", "Afişleri Yönet");
	//Manage Classified
	define("LANG_MANAGE_CLASSIFIED", "İlanları Yönet");
	//Manage Event
	define("LANG_MANAGE_EVENT", "Aktiviteleri Yönet");
	//Manage Listing
	define("LANG_MANAGE_LISTING", "Listeleri Yönet");
	//Manage Deal
	define("LANG_MANAGE_PROMOTION", "Teklif Yönet");
	//Manage Billing
	define("LANG_MANAGE_BILLING", "Faturalandırmayı Yönet");
	//Manage Invoices
	define("LANG_MANAGE_INVOICES", "Faturaları Yönet");
	//Manage Transactions
	define("LANG_MANAGE_TRANSACTIONS", "İşlemleri Yönet");
	//No articles in the system.
	define("LANG_NO_ARTICLES_IN_THE_SYSTEM", "Sistemde hiçbir makale yok.");
	//No banners in the system.
	define("LANG_NO_BANNERS_IN_THE_SYSTEM", "Sistemde hiçbir afiş yok.");
	//No classifieds in the system.
	define("LANG_NO_CLASSIFIEDS_IN_THE_SYSTEM", "Sistemde hiçbir ilan yok.");
	//No events in the system.
	define("LANG_NO_EVENTS_IN_THE_SYSTEM", "Sistemde hiçbir aktivite yok.");
	//No listings in the system.
	define("LANG_NO_LISTINGS_IN_THE_SYSTEM", "Sistemde hiçbir liste yok.");
	//No deals in the system.
	define("LANG_NO_PROMOTIONS_IN_THE_SYSTEM", "Sistemde hiçbir teklifler yok.");
	//No Reports Available.
	define("LANG_NO_REPORTS", "Hiçbir Rapor Mevcut Değil.");
	//No article found. It might be deleted.
	define("LANG_NO_ARTICLE_FOUND", "Hiçbir makale bulunmadı. Silinmiş olabilir.");
	//No classified found. It might be deleted.
	define("LANG_NO_CLASSIFIED_FOUND", "Hiçbir ilan bulunmadı. Silinmiş olabilir.");
	//No listing found. It might be deleted.
	define("LANG_NO_LISTING_FOUND", "Hiçbir liste bulunmadı. Silinmiş olabilir.");
	//Article Information
	define("LANG_ARTICLE_INFORMATION", "Makale Bilgileri");
	//Delete Article
	define("LANG_ARTICLE_DELETE", "Makaleyi sil.");
	//Delete Article Information
	define("LANG_ARTICLE_DELETE_INFORMATION", "Makale Bilgilerini Sil");
	//Are you sure you want to delete this article
	define("LANG_ARTICLE_DELETE_CONFIRM", "Bu makaleyi silmek istediğinizden emin misiniz?");
	//Article Preview
	define("LANG_ARTICLE_PREVIEW", "Makalenin Önizlemesi ");
	//Article Traffic Report
	define("LANG_ARTICLE_TRAFFIC_REPORT", "Makalenin Trafik Raporu");
	//Article Detail
	define("LANG_ARTICLE_DETAIL", "Makale Detayları");
	//Edit Article Information
	define("LANG_ARTICLE_EDIT_INFORMATION", "Makale Bilgilerini Düzenle");
	//Delete Banner
	define("LANG_BANNER_DELETE", "Afişi Sil");
	//Delete Banner Information
	define("LANG_BANNER_DELETE_INFORMATION", "Afiş Bilgilerini Sil");
	//Are you sure you want to delete this banner?
	define("LANG_BANNER_DELETE_CONFIRM", "Bu afişi silmek istediğinizden emin misiniz?");
	//Edit Banner
	define("LANG_BANNER_EDIT", "Afişi Düzenle");
	//Edit Banner Information
	define("LANG_BANNER_EDIT_INFORMATION", "Afiş Bilgilerini Düzenle ");
	//Banner Preview
	define("LANG_BANNER_PREVIEW", "Afişin Önizlemesi");
	//Banner Traffic Report
	define("LANG_BANNER_TRAFFIC_REPORT", "Afişin Trafik Raporu");
	//View Banner
	define("LANG_VIEW_BANNER", "Afişi Gör");
	//Disabled
	define("LANG_BANNER_DISABLED", "Kapatıldı");
	//Classified Information
	define("LANG_CLASSIFIED_INFORMATION", "İlan Bilgileri");
	//Delete Classified
	define("LANG_CLASSIFIED_DELETE", "İlanı Sil");
	//Your classified will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_CLASSIFIED_AUTOMATICALLY_APPEAR", "Ilanınız otomatik olarak seçtiğiniz alt-kategorinin ana kategorisinde gözükecektir.");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORY_PLURAL", "İlan Kategorileri");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORIES", "İlan Kategorileri");
	//Delete Classified Information
	define("LANG_CLASSIFIED_DELETE_INFORMATION", "İlan Bilgilerini Sil");
	//Are you sure you want to delete this classified
	define("LANG_CLASSIFIED_DELETE_CONFIRM", "Bu İlanı silmek istediğinizden emin misiniz?");
	//Classified Map Tuning
	define("LANG_CLASSIFIED_MAP_TUNING", "İlanın Harita Ayarları");
	//Classified Preview
	define("LANG_CLASSIFIED_PREVIEW", "İlanın Önizlemesi");
	//Classified Traffic Report
	define("LANG_CLASSIFIED_TRAFFIC_REPORT", "İlanın Trafik Raporları");
	//Classified Detail
	define("LANG_CLASSIFIED_DETAIL", "İlanın Detayları");
	//Edit Classified Information
	define("LANG_CLASSIFIED_EDIT_INFORMATION", "İlanın Bilgilerini Düzenle");
	//Edit Classified Level
	define("LANG_CLASSIFIED_EDIT_LEVEL", "İlanın Seviyelerini Düzenle");
	//Delete Event
	define("LANG_EVENT_DELETE", "Aktiviteyi Sil");
	//Delete Event Information
	define("LANG_EVENT_DELETE_INFORMATION", "Aktivite Bilgilerini Sil");
	//Are you sure you want to delete this event
	define("LANG_EVENT_DELETE_CONFIRM", "Bu aktiviteyi silmek istediğinizden emin misiniz? ");
	//Event Information
	define("LANG_EVENT_INFORMATION", "Aktivite Bilgileri");
	//Event Map Tuning
	define("LANG_EVENT_MAP_TUNING", "Aktivitenin Harita Ayarları");
	//Event Preview
	define("LANG_EVENT_PREVIEW", "Aktivitenin Önizlemesi");
	//Event Traffic Report
	define("LANG_EVENT_TRAFFIC_REPORT", "Aktivitenin Trafik Raporu");
	//Event Detail
	define("LANG_EVENT_DETAIL", "Aktivite Detayları");
	//Edit Event Information
	define("LANG_EVENT_EDIT_INFORMATION", "Aktivite Bilgilerini Düzenle");
	//Listing Information
	define("LANG_LISTING_INFORMATION", "Liste Bilgileri");
	//Listing Map Tuning
	define("LANG_LISTING_MAP_TUNING", "Listenin Harita Ayarları");
	//Listing Preview
	define("LANG_LISTING_PREVIEW", "Listenin Önizlemesi");
	//Listing Deal
	define("LANG_LISTING_PROMOTION", "Liste Teklif");
	//The deal is linked from the listing.
	define("LANG_LISTING_PROMOTION_IS_LINKED", "Teklif listeden bağlanmıştır.");
	//To be active the deal
	define("LANG_LISTING_TO_BE_ACTIVE_PROMOTION", "Aktif olmak için teklif");
	//must have an end date in the future.
	define("LANG_LISTING_END_DATE_IN_FUTURE", "un bitiş tarihi gelecekte olmalıdır.");
	//must be associated with a listing.
	define("LANG_LISTING_ASSOCIATED_WITH_LISTING", "bir liste ile ilişkilendirilmesi gereklidir.");
	//Listing Traffic Report
	define("LANG_LISTING_TRAFFIC_REPORT", "Listenin Trafik Raporu");
	//Listing Detail
	define("LANG_LISTING_DETAIL", "Liste Detayları");
	//for listing
	define("LANG_LISTING_FOR_LISTING", "liste için");
	//Listing Update
	define("LANG_LISTING_UPDATE", "Liste Güncellemesi");
	//Delete Deal
	define("LANG_PROMOTION_DELETE", "Teklif Sil");
	//Delete Deal Information
	define("LANG_PROMOTION_DELETE_INFORMATION", "Teklif Bilgilerini Sil");
	//Are you sure you want to delete this deal?
	define("LANG_PROMOTION_DELETE_CONFIRM", "Bu teklif silmek istediğinizden emin misiniz ?");
	//Deal Preview
	define("LANG_PROMOTION_PREVIEW", "Teklif Önizlemesi");
	//Deal Traffic Report
	define("LANG_PROMOTION_TRAFFIC_REPORT", "Teklif Trafik Raporu");
	//Deal Information
	define("LANG_PROMOTION_INFORMATION", "Teklif Bilgileri");
	//Deal Detail
	define("LANG_PROMOTION_DETAIL", "Teklif Detayları");
	//Edit Deal Information
	define("LANG_PROMOTION_EDIT_INFORMATION", "Teklif Bilgilerini Düzenle");
	//Image successfully deleted!
	define("LANG_IMAGE_SUCCESSFULLY_DELETED", "Resim başarıyla silindi!");
	//Review Detail
	define("LANG_REVIEW_DETAIL", "Yorum Detayları");
	//Review Preview
	define("LANG_REVIEW_PREVIEW", "Yorum Önizlemesi");
	//Invoice Detail
	define("LANG_INVOICE_DETAIL", "Fatura Detayları");
	//Invoice not found for this account.
	define("LANG_INVOICE_NOT_FOUND_FOR_ACCOUNT", "Bu hesapta fatura bulunmadı.");
	//Invoice Notification
	define("LANG_INVOICE_NOTIFICATION", "Fatura Bildirisi");
	//Transaction Detail
	define("LANG_TRANSACTION_DETAIL", "İşlem Detayları");
	//Transaction not found for this account.
	define("LANG_TRANSACTION_NOT_FOUND_FOR_ACCOUNT", "Bu hesapta işlem bulunmadı.");
	//Sign in with Directory Account
	define("LANG_LOGINDIRECTORYUSER", "Dizin Hesabıyla Oturum Aç");
	//Sign in with OpenID 2.0 Account
	define("LANG_LOGINOPENIDUSER", "OpenID 2.0 Hesabıyla Oturum Aç");
	//Log in with Facebook
	define("LANG_LOGINFACEBOOKUSER", "Facebook Oturum Aç");
	//Sign up with Facebook
	define("LANG_SIGNUPFACEBOOKUSER", "Facebook ile Aboneliği");
	//Log in with Google
	define("LANG_LOGINGOOGLEUSER", "Google Oturum Aç");
	//Sign up with Google
	define("LANG_SIGNUPGOOGLEUSER", "Google ile Aboneliği");
	//Username already registered!
	define("LANG_USERNAME_ALREADY_REGISTERED", LANG_LABEL_USERNAME." zaten kayıtlı!");
	//This e-mail is available.
	define("LANG_USERNAME_NOT_REGISTERED", "Bu e-posta uygun.");
	//Error uploading image. Please try again.
	define("LANG_MSGERROR_ERRORUPLOADINGIMAGE", "Resim yükleme hatası. Lütfen tekrar deneyin.");
	//Image successfully uploaded
	define("LANG_IMAGE_SUCCESSFULLY_UPLOADED", "Resim başarıyla yüklendi!");
	//Image successfully updated
	define("LANG_IMAGE_SUCCESSFULLY_UPDATED", "Resim başarıyla güncellendi!");
	//Delete image
	define("LANG_DELETE_IMAGE", "Resmi Sil");
	//Are you sure you want to delete this image
	define("LANG_DELETE_IMAGE_CONFIRM", "Bu resmi silmek istediğinizden emin misiniz ?");
	//Edit Image
	define("LANG_LABEL_EDITIMAGE", "Resmi Düzenle");
	//Make main
	define("LANG_LABEL_MAKEMAIN", "Ana Resim Yap");
	//Main image
	define("LANG_LABEL_MAINIMAGE", "Ana Resim");
	//Click here to set as main image
	define("LANG_LABEL_CLICKTOSETMAINIMAGE", "Ana resim olarak ayarlamak için tıklayın");
	//Click here to set as gallery image
	define("LANG_LABEL_CLICKTOSETGALLERYIMAGE", "Galeri resmi olarak ayarlamak için tıklayın");
	//Packages
	define("LANG_PACKAGE_PLURAL", "Paketler");
	//Package
	define("LANG_PACKAGE_SING", "Paket");
	//Charging for package
	define("LANG_CHARGING_PACKAGE", "Paket ücretlendirmesi ");

	# ----------------------------------------------------------------------------------------------------
	# SOCIAL NETWORK
	# ----------------------------------------------------------------------------------------------------
	//Profile successfully updated!
	define("LANG_MSG_PROFILE_SUCCESSFULLY_UPDATED", "Profil başarıyla güncellendi!");
	//Profile
	define("LANG_LABEL_PROFILE", "Profil");
	//Edit Profile
	define("LANG_LABEL_EDIT_PROFILE", "Profiliz Düzenle");
	//Load from Facebook
	define("LANG_LABEL_IMAGE_FROM_FACEBOOK", "Facebook'tan yükleyin");
	//Personal Infomation
	define("LANG_LABEL_PERSONAL_INFORMATION", "Kişisel Bilgiler");
	//Twitter Account
	define("LANG_LABEL_TWITTER_ACCOUNT", "Twitter hesabı");
	//Twitter Widget
	define("LANG_LABEL_TWITTER_WIDGET", "Twitter Widget");
	//About me
	define("LANG_LABEL_ABOUT_ME", "Hakkımda");
	//Birthdate
	define("LANG_LABEL_BIRTHDATE", "Doğum tarihi");
	//Hometown
	define("LANG_LABEL_HOMETOWN", "Memleketi");
	//Favorite Books
	define("LANG_LABEL_FAVORITEBOOKS", "Favori Kitapları");
	//Favorite Movies
	define("LANG_LABEL_FAVORITEMOVIES", "Favori Filmleri");
	//Favorite Sports
	define("LANG_LABEL_FAVORITESPORTS", "Favori Sporları");
	//Favorite Musics
	define("LANG_LABEL_FAVORITEMUSICS", "Favori Müzikleri");
	//Favorite Foods
	define("LANG_LABEL_FAVORITEFOODS", "Favori Yemekleri");
	//Are you sure?
	define("LANG_MESSAGE_MSGAREYOUSURE", "Emin misiniz?");
	//This is the URL where visitors can see your public profile page
	define("LANG_MSG_FRIENDLY_URL_PROFILE_TIP", "Bu ziyaretçiler, genel profil sayfanızda görebilirsiniz URL'dir");
	//Your URL
	define("LANG_LABEL_YOUR_URL", "Sizin URL sayfanız");
    //Your URL is required.
	define("LANG_LABEL_YOURURL_REQUIRED", "Sizin URL gereklidir.");
    //yoururl
    define("LANG_LABEL_YOUR_URLTIP", "sizinurl");
    //Available URL
    define("LANG_LABEL_URLOK", "Mevcut URL");
    //Unavailable URL
    define("LANG_LABEL_URLNOTOK", "URL Mevcut Değil");
	//Your URL contains invalid chars.
	define("LANG_MSG_FRIENDLY_URL_INVALID_CHARS", "URL geçersiz karakterler içeriyor.");
	//URL already in use, please choose another URL.
	define("LANG_MSG_PAGE_URL_IN_USE", "URL zaten kullanılmakta, lütfen başka bir URL seçin.");
	//View all
	define("LANG_LABEL_VIEW_ALL", "Hepsini gör");
	//View all
	define("LANG_LABEL_VIEW_ALL2", "Hepsini gör");
	//No Items
	define("LANG_MSG_NO_ITEMS", "Hiç Kayıt Yok");
	//Share
	define("LANG_LABEL_SHARE", "Paylaş");
	//Comments
	define("LANG_LABEL_COMMENTS", "Yorumlar");
	//My Profile
	define("LANG_LABEL_MYPROFILE", "Profilim");
	//User profile successfully enabled!
	define("LANG_MSG_PROFILE_ENABLED", "Kullanıcı profili başarıyla etkinleştirildi!");
	//Display my contact information publicly
	define("LANG_LABEL_PUBLISH_MY_CONTACT", "İletişim bilgilerimi herkese görüntüle");
	//Create my Personal Page
	define("LANG_LABEL_CREATE_PERSONAL_PAGE", "Kişisel Sayfamı Yarat");
	//Public Profile
	define("LANG_LABEL_PERSONAL_PAGE", "Genel Profil");
	//Article Reviews
	define("LANG_LABEL_ARTICLE_REVIEW", "Makale Yorumları");
	//Listing Reviews
	define("LANG_LABEL_LISTING_REVIEW", "Liste Yorumları");
	//Deal Reviews
	define("LANG_LABEL_PROMOTION_REVIEW", "Teklif Yorumları");
	//Review successfully deleted.
	define("LANG_MSG_REVIEW_SUCCESS_DELETED", "Yorumlar Başarıyla Silndi.");
	//No reviews found!
	define("LANG_LABEL_NOREVIEWS", "Yorum bulunmadı!");
	//Edit my Profile
	define("LANG_LABEL_EDITPROFILE", "Profilimi düzenle");
	//Back to my Profile
	define("LANG_LABEL_BACKTOPROFILE", "Profilime dön");
	//Member Since
	define("LANG_LABEL_MEMBER_SINCE", "den beri üye");
	//Account Settings
	define("LANG_LABEL_ACCOUNT_SETTINGS", "Hesap Ayarları");
    //Deals Redeemed
	define("LANG_LABEL_ACCOUNT_DEALS", "Alınan Teklifler");
	//Favorites
	define("LANG_LABEL_FAVORITES", "Favoriler");
	//You have no permission to access this area.
	define("LANG_MSG_NO_PERMISSION", "Bu alana giriş izniniz yok.");
	//Go to your Profile
	define("LANG_MSG_GO_PROFILE", "Profile git.");
	//My Personal Page
	define("LANG_MSG_MY_PERSONAL_PAGE", "Kişisel Sayfam");
	//Use this Account
	define("LANG_MSG_USE_LOGGED_ACCOUNT", "Bu Hesabı kullan");
	//Profile Page
	define("LANG_LABEL_PROFILE_PAGE", "Profil Sayfası");
	//Create your Profile
	define("LANG_CREATE_MEMBER_PROFILE", "Profilinizi oluşturun");
	//Your Name is required.
	define("LANG_MSG_NICKANAME_REQUIRED", "Görüntü Adı gereklidir.");
	//Be sure that the twitter account you are adding is not protected. If the twitter account is protected the latest tweets on this account will not be shown.
	define("LANG_PROFILE_TWITTER_TIP1", "Eklediginiz Twitter hesabının korunmalı olmadığından emin olun. Eğer Twitter hesabi korunmalıysa bu hesaptaki son tweetler gösterilmeyecektir.");
    //Thank you for signing up!
    define("LANG_PROFILE_WELCOME", "Kaydolduğunuz için teşekkür ederiz!");
    //We appreciate it and welcome to
    define("LANG_PROFILE_WELCOME2", "Biz takdir ve hoş geldiniz");

	# ----------------------------------------------------------------------------------------------------
	# GALLERY
	# ----------------------------------------------------------------------------------------------------
	//Only
	define("LANG_ONLY", "Sadece ");
	//images accepted for upload!
	define("LANG_IMAGES_ACCEPETED", "resimler yükleme için kabul edilir!");
	//Images must be under
	define("LANG_IMAGE_MUST_BE", "Resimler altında olmalıdır");
	//Select an image for upload!
	define("LANG_SELECT_IMAGE", "Yükleme için bir resim seçin!");
	//Original image
	define("LANG_ORIGINAL", "Orijinal resim");
	//Thumbnail preview
	define("LANG_THUMB_PREVIEW", "Küçük resim önizlemesi");
	//Edit captions
	define("LANG_LABEL_EDIT_CAPTIONS", "Altbaşlıklar");
	//You can add the maximum of
	define("LANG_YOU_CAN_ADD_MAXOF", "Galerinize en fazla");
	//photos to your gallery
	define("LANG_TO_YOUR_GALLERY", " resim ekleyebilirsiniz!");
	//Create Thumbnail
	define("LANG_CREATE_THUMB", "Küçük Resim Yarat");
	//Thumbnail Preview
	define("LANG_THUMB_PREVIEW", "Küçük Resim Önizlemesi");
	//Your item already has the maximum number of images in the gallery. Delete an existing image to save this one.
	define("LANG_ITEM_ALREADY_HAD_MAX_IMAGE", "Kaydınız en fazla resim sayısına ulaşmış. Bu resmi yüklemek için mevcut resimlerden birini silin.");

	# ----------------------------------------------------------------------------------------------------
	# RECURRING EVENTS
	# ----------------------------------------------------------------------------------------------------
	//Recurring Event
	define("LANG_EVENT_RECURRING", "Tekrarlayan Aktiviteler");
	//Repeat
	define("LANG_PERIOD", "Tekrar");
	//Choose an option
	define("LANG_CHOOSE_PERIOD", "Bir seçenek seçin");
	//Daily
	define("LANG_DAILY", "Günlük");
	//Weekly
	define("LANG_WEEKLY", "Haftalık");
	//Monthly
	define("LANG_MONTHLY", "Aylık");
	//Yearly
	define("LANG_YEARLY", "Yıllık");
	//Daily Event
	define("LANG_DAILY2", "Günlük Aktivite");
	//Weekly
	define("LANG_WEEKLY2", "Haftalık");
	//Monthly
	define("LANG_MONTHLY2", "Aylık");
	//Yearly
	define("LANG_YEARLY2", "Yıllık");
	//every
	define("LANG_EVERY", "Her");
	//every
	define("LANG_EVERY2", "Her");
	//of
	define("LANG_OF", "ün");
	//of
	define("LANG_OF2", "nın");
	//of
	define("LANG_OF3", "ın");
	//of
	define("LANG_OF4", "ın");
	//Week
	define("LANG_WEEK", "Hafta");
	//Choose Month
	define("LANG_CHOOSE_MONTH", "Ay Seçin");
	//Choose Day
	define("LANG_CHOOSE_DAY", "Gün Seçin");
	//Choose Week
	define("LANG_CHOOSE_WEEK", "Hafta Seçin");
	//First
	define("LANG_FIRST", "İlk");
	//Second
	define("LANG_SECOND", "İkinci");
	//Third
	define("LANG_THIRD", "Üçüncü");
	//Fourth
	define("LANG_FOURTH", "Dördüncü");
	//Last
	define("LANG_LAST", "Son");
	//1st
	define("LANG_FIRST_2", "1.");
	//2nd
	define("LANG_SECOND_2", "2.");
	//3rd
	define("LANG_THIRD_2", "3.");
	//4th
	define("LANG_FOURTH_2", "4.");
	//Recurring
	define("LANG_RECURRING", "Tekrarlayan");
	//Please select a day of week
	define("LANG_EVENT_SELECT_DAYOFWEEK", "Lürfen haftanın bir gününü seçin.");
	//Please type a day
	define("LANG_EVENT_TYPE_DAY", "Lütfen bir gün seçin.");
	//Please select a month
	define("LANG_EVENT_SELECT_MONTH", "Lütfen bir ay seçin.");
	//Please select a week
	define("LANG_EVENT_SELECT_WEEK", "Lütfen bir gün seçin.");
	//Please select a Repeat option
	define("LANG_EVENT_SELECT_PERIOD", "Lütfen bir Tekrarlama seçeneği seçin.");
	//When
	define("LANG_EVENT_WHEN", "Ne zaman");
	//Day must be numeric
	define("LANG_EVENT_TYPE_DAY_NUMERIC", "Günler rakam olmaıdır.");
	//Day must be between 1 and 31
	define("LANG_EVENT_TYPE_DAY_BETWEEN", "Günler 1 ve 31 arasında olmalıdır.");
	//Day doesn't match with the choosen period
	define("LANG_EVENT_CHECK_DAY", "Gün seçilen zaman aralığıyla eşleşmiyor.");
	//Month doesn't match with the choosen period
	define("LANG_EVENT_CHECK_MONTH", "Ay seçilen zaman aralığıyla eşleşmiyor.");
	//Days don't match with the choosen period
	define("LANG_EVENT_CHECK_DAYOFWEEK", "Günler seçilen zaman aralığıyla eşleşmiyor.");
	//Week doesn't match with the choosen period
	define("LANG_EVENT_CHECK_WEEK", "Hafta seçilen zaman aralığıyla eşleşmiyor.");
	//No info
	define("LANG_EVENT_NO_INFO", "Bilgi yok");
	//Ends on
	define("LANG_ENDS_IN", "Bitiyor");
	//Never
	define("LANG_NEVER", "Asla");
	//Until
	define("LANG_UNTIL", "Kadar");
	//Until Date
	define("LANG_LABEL_UNTIL_DATE", "Tarihine Kadar");
	//The "Until Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_UNTIL_DATE_GREATER_THAN_START_DATE", "\"Tarihine Kadar\", \"Başlangıç Tarihi\"yle eşit ya da ondan daha büyük olmalı .");
	//The "Until Date" cannot be in past.
	define("LANG_MSG_UNTIL_DATE_CANNOT_IN_PAST", "\"Tarihine Kadar\" geçmişte olamaz.");
	//Starts on
	define("LANG_EVENT_STARTS_ON", "Tarihinde Başlıyor");
	//Starts
	define("LANG_EVENT_STARTS", "Başlıyor");
	//Repeats
	define("LANG_EVENT_REPEATS", "Tekrar Ediyor");
	//Ends on
	define("LANG_EVENT_ENDS", "Bitiyor");
	//weekend
	define("LANG_EVENT_WEEKEND", "haftasonu");
	//weekends
	define("LANG_EVENT_WEEKENDS", "hafta sonları");
	//Mon-Fri
	define("LANG_EVENT_BUSINESSDAY", "Pazartesi-Cuma");
	//the Month
	define("LANG_THE_MONTH", "en Ay");
	//Every Year
	define("LANG_EVERY_YEAR", "Her yıl");

	# ----------------------------------------------------------------------------------------------------
	# SITES
	# ----------------------------------------------------------------------------------------------------
    //Site
    define("LANG_DOMAIN", "Site");
	//Site name
	define("LANG_DOMAIN_NAME", "Site adı");
	//Click here to view this site
	define("LANG_MSG_CLICK_TO_VIEW_THIS_DOMAIN", "Bu siteyi görmek için tıklayın");
	//Click here to delete this site
	define("LANG_MSG_CLICK_TO_DELETE_THIS_DOMAIN", "Bu siteyi silmek için tıklayın");
	//Site successfully deleted!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_DELETE", "Site başarıyla silindi!");
	//Site successfully added!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2", "Site başarıyla eklendi!");
	//An email notification will be sent to the eDirectory support team, please wait our contact.
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD", LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2."<br />Bir e-posta bildirimi eDirectory destek ekibi gönderilecektir, lütfen iletişim bekleyin.");
    //Site name is required
	define("LANG_MSG_DOMAINNAME_IS_REQUIRED", "Site adı gerekli");
    //Site URL is required
	define("LANG_MSG_DOMAINURL_IS_REQUIRED", "Site URLsi gerekli");
	//Site name already exists
	define("LANG_MSG_DOMAINNAME_ALREADY_EXISTS", "Site adı zaten var");
	//Site URL already exists
	define("LANG_MSG_DOMAINURL_ALREADY_EXISTS", "Site URLsi zaten var");
	//Site URL not valid
	define("LANG_MSG_DOMAINURL_INVALID_CHARS", "Site URLsi geçersiz");
	//Site Items
	define("LANG_SITE_ITEMS", "Site Kayıtları");
	//Select a Site
	define("LANG_SELECT_DOMAIN", "Siteyi Değiştirin");

	# ----------------------------------------------------------------------------------------------------
	# PROFILE
	# ----------------------------------------------------------------------------------------------------
    //Sign Up with a new Account
    define("LANG_LABEL_PROFILE_SIGNUP", "Yeni Hesabı ile Kaydolun");
    //OR
    define("LANG_LABEL_PROFILE_OR", "VEYA");
    //Sign In with an existing account
    define("LANG_LABEL_PROFILE_FOREIGNACC", "Varolan bir hesabı ile Giriş Yapın");
    //Or use your OpenID to sign in
    define("LANG_LABEL_PROFILE_OPENID", "Veya oturum OpenID kullanın");
    //Your OpenID
    define("LANG_LABEL_PROFILE_YOUROPENID", "OpenID");
    //Login
    define("LANG_LABEL_PROFILE_LOGIN", "Giriş");
    //Once you have created your account using a foreign system, it was activated automatically. Please disregard this message.
    define("LANG_LABEL_PROFILE_ACTIVATED", "Eğer harici bir sistem kullanarak hesabınızı oluşturduktan sonra, otomatik olarak aktive edildi. Bu mesajı dikkate almayın.");
	//Thank you for activating your account. The next step is to complete your profile.
    define("LANG_LABEL_PROFILE_WELCOME_ACT", "Hesabınızı etkinleştirmek için teşekkür ederiz.Sonraki adım Profil tamamlamaktır.");
    //Your account has not been activated yet. Check your activation e-mail and come back later to complete your profile.
    define("LANG_LABEL_PROFILE_WELCOME_NOTACT", "Hesabınız henüz aktif değil. Etkinleştirme e-posta kontrol edin ve profilinize tamamlamak için daha sonra gel.");
    //Complete your profile
    define("LANG_LABEL_PROFILE_COMPLETE", "Profilinizi tamamlayın");
    //RECENT ACTIVITY
    define("LANG_LABEL_PROFILE_RECENT_ACTIVITY", "SON FAALİYET");
    //You have no recent activity.
    define("LANG_LABEL_PROFILE_RECENT_ACTIVITY_EMPTY", "Hiç yeni etkinlik yok.");
    //Review on
    define("LANG_LABEL_PROFILE_REVIEWON", "Review on");
    //You can connect your directory account with social networks
    define("LANG_LABEL_PROFILE_SNTIP", "Sen sosyal ağlar ile dizin hesabınızı bağlayabilirsiniz");
    //Change photo
    define("LANG_LABEL_PROFILE_CHANGEPHOTO", "Fotoğrafı değiştirin");
    //Remove photo
    define("LANG_LABEL_PROFILE_REMOVEPHOTO", "Fotoğrafı kaldır");
    //Display Name
    define("LANG_LABEL_PROFILE_DISPLAYNAME", "Görünen Ad");
    //Personal Page
    define("LANG_LABEL_PROFILE_PERSONALPAGE", "Kişisel Sayfa");
    //Account Username
    define("LANG_LABEL_ACCOUNT_USERNAME", "Hesap adı");
    //You can change your e-mail access at any time. This is also the contact e-mail we use to reach you.
    define("LANG_LABEL_ACCOUNT_USERNAME_TIP", "İstediğiniz zaman e-posta erişimi değiştirebilir. Bu da size ulaşmak için kullanabileceğiniz iletişim e-posta olduğunu.");
    //Activated
    define("LANG_LABEL_ACCOUNT_ACT", "Aktif");
    //Account not activated.
    define("LANG_LABEL_ACCOUNT_NOTACT", "Hesap etkin değil");
    //Activate account.
    define("LANG_LABEL_ACTIVATE_ACC", "Hesabınızı etkinleştirin");
    //Your activation e-mail has been sent. Please, check your inbox.
    define("LANG_LABEL_ACTIVATEEMAIL_SENT", "Sizin etkinleştirme e-postası gönderildi. Gelen kutunuzu kontrol edin.");
    //There was an error trying to send you a new activation e-mail.
    define("LANG_LABEL_ACTIVATEEMAIL_SENT_ERROR", "Eğer yeni bir aktivasyon e-posta göndermeye çalışırken bir hata oluştu.");
    //get a new activation e-mail.
    define("LANG_LABEL_ACTIVATEEMAIL_GETNEW", "yeni bir aktivasyon e-posta almak.");
    //Change Password
    define("LANG_LABEL_ACCOUNT_CHANGEPASS", "Şifre Değiştir");
    //You can change your password at any time you want.
    define("LANG_LABEL_ACCOUNT_CHANGEPASS_TIP", "İstediğiniz herhangi bir zaman şifrenizi değiştirebilirsiniz.");
    //This information will be hidden unless you click the publish checkbox below
    define("LANG_LABEL_ACCOUNT_CONTACT_TIP", "Bunu istemiyorsanız, bu bilgileri yayınlanan olmayacaktır.");
    //Settings
    define("LANG_LABEL_CONTACT_SETTINGS", "Ayarlar");
    //Check your preferences
    define("LANG_LABEL_CONTACT_SETTINGS_TIP", "Tercihlerinizi kontrol edin");
    //Profile Options
    define("LANG_MENU_PROFILEOPTIONS", "Profil Seçenekleri");
    //Profile Information
	define("LANG_LABEL_PROFILE_INFORMATION", "Profil Bilgileri");
	//Social Networking
	define("LANG_LABEL_FOREIGN_ACCOUNTS", "Sosyal Ağ");
	//Link and import informations
	define("LANG_LABEL_CONNECT_WITH_FB_AND_IMPORT", "Link ve dosya alım bilgileri");
	//Just link
	define("LANG_LABEL_CONNECT_WITH_FB", "Sadece link");
	//Link my Facebook account
	define("LANG_LABEL_LINK_FACEBOOK", "Facebook hesabıma bağlantı ekle");
	//Unlink my Facebook account
	define("LANG_LABEL_UNLINK_FB", "Facebook hesabımdan bağlantıyı kaldır");
	//Your account was unlinked from Facebook
	define("LANG_LABEL_FB_ACT_DISC", "Hesabınızın Facebook bağlantısı kaldırıldı");
	//Your Facebook account is already linked with other account in the system.
	define("LANG_FB_ALREADY_LINKED", "Facebook hesabınız sistemdeki başka bir hesapla bağlantılı bile.");
	//Your Twitter account is already linked with other account in the system.
	define("LANG_TW_ALREADY_LINKED", "Twitter hesabınız sistemdeki başka bir hesapla bağlantılı bile.");
	//Linked to twitter as
	define("LANG_MSG_LINKED_TW_AS", "Twitter'a olarak bağlantılı");
	//Connected as
	define("LANG_LABEL_CONECTED_AS", "olarak bağlı");
	//Location options
	define("LANG_LABEL_LOCATIONPREF", "Yer Seçenekleri");
	//Choose your location preferences in order to auto fill your searches by location
	define("LANG_LABEL_CHOOSELOCATIONPREF", "Otomatik konuma göre arama doldurmak amacıyla konumunuzu tercihlerinizi seçin");
	//Use your current location
	define("LANG_LABEL_USECURRENTLOCATION", "Mevcut yer adınızı kullanın");
	//Use Facebook Location
	define("LANG_LABEL_USEFACEBOOKLOCATION", "Facebook Yer Adınızı kullanın");
	//Connect to Facebook
	define("LANG_LABEL_CONECTED_TO_FB", "Facebook'a bağlan");
	//Facebook account
	define("LANG_LABEL_FACEBOOK_ACCT", "Facebook hesabı");
	//Google account
	define("LANG_LABEL_GOOGLE_ACCT", "Google hesabı");
	//Change account
	define("LANG_LABEL_CHANGE_ACCT", "Hesap değiştir");
	//Twitter account
	define("LANG_LABEL_FB_ACCT", "Twitter hesabı");
	//Twitter connection
	define("LANG_LABEL_TW_CONN", "Twitter bağlantısı");
	//Link my Twitter account
	define("LANG_LABEL_TW_LINK", "Twitter hesabıma bağlantı ekle");
	//Unlink my Twitter account
	define("LANG_LABEL_UNLINK_TW", "Twitter hesabımdan bağlantıyı kaldır");
	//Post redeems on my twitter account automatically
	define("LANG_LABEL_POSTRED", "Promosyon alımlarını otomatik olarak Twitter hesabıma gönder");
	//Your account was disconnected from twitter
	define("LANG_LABEL_TW_ACT_DISC", "Hesabınızın Twitter bağlantısı koptu");
	//You must sign in through twitter first
	define("LANG_LABEL_TW_SIGNTW", "Önce Twitter'dan oturum açmalısınız");
	//Your twitter account was successfully connected
	define("LANG_LABEL_TW_SIGNTW_CONN", "Twitter hesabınız başarıyla bağlandı");
	//Your Facebook account was successfully connected
	define("LANG_LABEL_FB_SIGNFB_CONN", "Facebook hesabınız başarıyla bağlandı");
	//Your are already logged Facebook account as
	define("LANG_LABEL_FB_ALREADYLOGGED", "Facebook'a zaten olarak bağlısınız");
	//This user is already attached to another directory account.
	define("LANG_LABEL_FB_ALREADYATTACHED", "Bu kullanıcı zaten başka bir dizine hesabına bağlı.");
	//Click here to switch to this account
	define("LANG_LABEL_FB_CLICKHERETOSWITCH", "Bu hesaba geçmek için tıklayın");
	//Connect to Facebook
	define("LANG_LABEL_CONN_FB", "Facebook'a bağlan");
	//Use this language upon each sign in to my account
	define("LANG_LABEL_USE_SELECTEDLANGUAGE", "Hesabıma her oturum halinde bu dil kullanın");
    //View my profile page
    define("LANG_LABEL_VIEW_PROFILE", "Profilimi görüntüle");

	# ----------------------------------------------------------------------------------------------------
	# DEALS
	# ----------------------------------------------------------------------------------------------------
	//I just got a great deal
	define("DEAL_LIKEDTHIS", "Harika bir teklif aldım");
	//Redeem
	define("DEAL_REDEEM", "Al");
	//Redeem this deal
	define("DEAL_REDEEMTHIS", "Bu teklif al");
	//To redeem you need to post this deal information on your Facebook or Twitter.
	define("DEAL_REDEEMINFO1", "Bu teklif almak için promosyonun bilgilerini Facebook veya Twitter'a göndermeniz lazım");
	//You can set this button to automatic post on your Profile.
	define("DEAL_REDEEMINFO2", "Bu düğmeyi Profilinize otomatik gönder olarak ayarlayabilirsiniz");
	//Click here to configure it
	define("DEAL_CLICKHERETO", "Ayarlamak için tıklayın");
	//Please wait, posting on Facebook and Twitter (if available)
	define("DEAL_PLEASEWAIT_POSTING", "Lütfen bekleyin, Facebook ve Twitter'a gönderiliyor (eğer mevcutsa)");
	//You already redeemed this deal! Your code is
	define("DEAL_YOUALREADY", "Bu teklif aldınız bile! Kodunuz");
	//Deal done! This is your redeem code
	define("DEAL_DEALDONE", "Teklif alındı! Kodunuz bu");
	//No one has redeemed this deal on Facebook yet
	define("DEAL_REDEEM_NONE_FB", "Bu teklif henüz hiç kimse Facebook ile almadı");
	//No one has redeemed this deal on Twitter yet
	define("DEAL_REDEEM_NONE_TW", "Bu teklif henüz hiç kimse Twitter ile almadı");
	//Recent done deals
	define("DEAL_RECENTDEALS", "En son alınmış Teklifler");
	//No deals found!
	define("DEAL_DIDNTNOTFINISHED", "Hayır fırsatlar bulunamadı!");
	//This deal is not available anymore
	define("DEAL_NA", "Bu teklif artık mevct değil");
	//To redeem this deal you need to post to your Facebook wall. First, sign using the Facebook login button and you will need to approve this Application to do it
	define("DEAL_REDEEMINFO_1", "Bu teklif almak için Facebook duvarınıza göndermeniz lazım. Önce Facebook oturumu aç düğmesiyle oturum açın. Bunun için Uygulamayı onaylamanız lazım");
	//You already did this deal!
	define("DEAL_REDEEM_DONEALREADY", "Bu teklif aldınız bile");
	//Sorry, there was an error trying to post on your Facebook wall. Please try again.
	define("DEAL_REDEEMINFO_2", "Maalesef Facebook hesabınıza gönderirken bir hata oluştu. Lütfen tekrar deneyin.");
	//Value
	define("DEAL_VALUE", "Değer");
	//With this coupon
	define("DEAL_WITHTHISCOUPON", "Bu kupon ile");
	//Thank you
	define("DEAL_THANKYOU", "Teşekkürler");
	//Original value
	define("DEAL_ORIGINALVALUE", "Orijinal değer");
	//Amount paid
	define("DEAL_AMOUNTPAID", "Bu promosyon değeri");
	//Valid until
	define("DEAL_VALIDUNTIL", "arasında geçerlidir");
	//Coupon must be presented to receive discount
	define("DEAL_INFODETAILS1", "İndirimi almak için kupon  gösterilmelidir");
	//Limit of 1 coupon per purchase
	define("DEAL_INFODETAILS2", "Satış başına 1 kuponla sınırlı");
	//Not valid with other coupons, offers or discounts of any kind
	define("DEAL_INFODETAILS3", "Diğer kuponlarla veya herhangi bir indirim teklifi türüyle birlikte geçerli değildir.");
	//Valid only for Listing Name - Address
	define("DEAL_INFODETAILS4", "Sadece Liste Adı ve Adresi için geçerlidir");
	//Print deal
	define("DEAL_PRINTDEAL", "Teklif Yazdır");
	//deal done
	define("DEAL_DEALSDONE", "Teklif Yapıldı");
	//deals done
	define("DEAL_DEALSDONE_PLURAL", "Teklifler Yapıldı");
	//Deals redeemed
	define("LANG_LABEL_DEAL_BOUGHT", "Teklifler satın aldı");
	//Deals left
	define("LANG_LABEL_DEAL_LEFT", "Teklifler kaldı");
	//Left
	define("DEAL_LEFTAMOUNT", "Kaldı");
	//Sold Out
	define("DEAL_SOLDOUT", "Satildi");
	//Sorry, this deal doesn't exist or it was removed by owner
	define("DEAL_DOESNTEXIST", "Maalesef bu teklif artık mevcut değil veya sahibi tarafından kaldırılmış.");
	//at
	define("DEAL_AT", "/");
	//Friendly URL
	define("DEAL_FRIENDLYURL", "Friendly URL");
	//Select a listing
	define("DEAL_SELECTLISTING", "Bir liste seç");
	//Tagline for Deals
	define("DEAL_TAG", "Teklifler için Etiket");
	//Visibility
	define("LANG_SITEMGR_VISIBILITY", "Görünürlük");
	//This deal will show up on
	define("LANG_SITEMGR_DEALSHOWUP", "Bu teklif");
	//searches and nearby feature
	define("LANG_SITEMGR_DEALSEARCHES_NEARBY", "aramalarda ve yakın özelliklerde gözükecek");
	//Nearby
	define("LANG_LABEL_NEARBY", "Yakında");
	//About Us
	define("LANG_MENU_ABOUT", "Hakkımızda");
	//My Favorites
	define("LANG_MENU_FAVORITES", "Favorilerim");
	//My Deals
	define("LANG_MENU_MYDEALS", "Benim Fiyatları");
	//My Reviews
	define("LANG_MENU_MYREVIEWS", "Benim yorumlar");
	//My Account
	define("LANG_MENU_ACCOUNT", "Hesabım");
	//24 hours / day
	define("LANG_SITEMGR_TWFOURHOURSDAY", "Günde 24 saat");
	//Custom range
	define("LANG_SITEMGR_CUSTOMRANGE", "Özel aralık");
	//Discount information
	define("LANG_SITEMGR_DISCINFO", "İndirim bilgileri");
	//Deal value
	define("LANG_SITEMGR_ITEMVALUE", "Teklif değeri");
	//Discount
	define("LANG_SITEMGR_DISCOUNT", "İndirim");
	//Value with discount
	define("LANG_DEAL_WITH_DISCOUNT", "İndirimden sonraki değer");
	//Amount of deals
	define("LANG_SITEMGR_AMOUNTOFDEALS", "Teklifler tutarları");
	//deals done until now
	define("LANG_SITEMGR_DONEUNTIL_SINGULAR", "bu zamana kadar yapılan teklifler");
    //deals done until now
	define("LANG_SITEMGR_DONEUNTIL_PLURAL", "bu zamana kadar yapılan teklifler");
	//left
	define("LANG_SITEMGR_LEFT", "kaldı");
    //OFF
    define("LANG_DEAL_OFF", "KAPALI");
    //Please wait, loading...
    define("LANG_DEAL_PLEASEWAITLOADING", "Lütfen bekleyin, yüklüyor...");
    //Please wait. We are redirecting your login to complete this step...
    define("LANG_DEAL_PLEASEWAITLOADING2", "Lütfen bekleyin. Bu adımı tamamlamak için oturumunuzu tekrar yönlendiriyoruz...");
    //Item Value is required.
    define("LANG_MSG_VALIDDEAL_REALVALUE", "Kayıt Değeri gerekli.");
    //Value with Discount is required.
    define("LANG_MSG_VALIDDEAL_DEALVALUE", LANG_LABEL_DISC_AMOUNT." gerekli.");
	//Value with Discount can not be higher than 99.
	define("LANG_MSG_VALIDDEAL_DEALVALUE2", LANG_LABEL_DISC_AMOUNT." 99'dan daha büyük olamaz.");
    //Deals to offer is required.
    define("LANG_MSG_VALIDDEAL_AMOUNT", "Sunmak için fırsatlar gereklidir.");
    //Please enter a minor value on Value with Discount field.
    define("LANG_MSG_VALID_MINOR", LANG_LABEL_DISC_AMOUNT." alanına daha küçük bir değer girin.");
    //Redemeed at
    define("LANG_DEAL_REMEEDED_AT", "Promosyon alındı");
    //You can only directly link this deal to a listing if you select one account first
    define("DEAL_LINK2LISTING_ACCTINFO", "Bu teklif doğrudan bağlanmak için önce bir hesap seçin");
    //Value
    define("DEAL_VALUE", "Değer");
    //With discount
    define("DEAL_WITHCOUPON", "İndirimli");
    //Redeem by e-mail
    define("DEAL_REDEEMBYEMAIL", "E-posta ile promosyon al");
    //Sign In and Redeem
    define("DEAL_CONNECT_REDEEM", "Oturum aç Promosyon Al");
	//Redeem and Print
	define("LANG_LABEL_REDEEM_PRINT", "Kurtarmak ve Yazdırın.");
    //Redeem and Share
    define("DEAL_REDEEMSHARE", "Promosyon Al ve Paylaş");
    //Featured Deals
    define("DEAL_FEATURED_DEALS", "Vitrindeki Teklifler");
    //Sign in using your Facebook session
    define("LOGIN_FB_CURRENT_SESSION", "Facebook kullanarak oturum açın");
    //To Redeem using Facebook you need to connect using your Facebook account
    define("LANG_DEAL_DISCONNECTED_NOFB", "Facebook kullanarak teklif almak için önce Facebook hesabınızı kullanarak baglanmanız lazım.");
	//Redeem Statistics
    define("LANG_LABEL_REDEEM_STATISTICS", "Promosyon Alım İstatistikleri");
    //Redeem code
    define("DEAL_SITEMGR_REDEEMCODE", "Promosyon alış kodu");
    //Available
    define("DEAL_SITEMGR_AVAILABLE", "Mevcut");
    //Used
    define("DEAL_SITEMGR_USED", "Kullanılmış ");
    //Redeem using your current Facebook session.
    define("DEAL_REDEEMINFO_3", "Mevcut Facebook oturumunuzu kullanarak alın");
    //Use
    define("DEAL_SITEMGR_USE", "Kullan");
	//Saving...
	define("LANG_DEAL_SAVING", "Kaydediyor...");
	//No redeem found
	define("LANG_DEAL_NO_RECORD", "Alış bulunamadı");
	//percentage
	define("LANG_LABEL_PERCENTAGE", "yüzde");
	//fixed value
	define("LANG_LABEL_FIXEDVALUE", "sabit değer");

	# ----------------------------------------------------------------------------------------------------
	# IMPORT
	# ----------------------------------------------------------------------------------------------------
	//line
	define("LANG_MSG_IMPORT_ERROR_LINE", "hat");
	//Error importing to temporary table.
	define("LANG_MSG_IMPORT_ERRORONIMPORTTOTEMPABLE", "Geçici tablo dosya alırken hata.");
	//Invalid renewal date - line
	define("LANG_MSG_IMPORT_INVALIDRENEWALDATE", "Geçersiz yenileme tarihi satırı - hat");
	//Invalid updated date - line
	define("LANG_MSG_IMPORT_INVALIDUPDATEDATE", "Geçersiz güncellenme tarihi satırı - hat");
	//CSV file imported to temporary table.
	define("LANG_MSG_IMPORT_CSVIMPORTEDTOTEMPORARYTABLE", "CSV dosyası geçici bir tabloya alındı.");
	//Invalid e-mail - line
	define("LANG_MSG_IMPORT_INVALIDUSERNAMELINE", "Geçersiz e-posta satırı - hat");
	//Invalid password - line
	define("LANG_MSG_IMPORT_INVALIDPASSWORDLINE", "Geçersiz şifre satırı - hat");
	//Invalid keyword (maximum 10 keywords) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS", "Geçersiz anahtar (azami ".MAX_KEYWORDS." anahtar) - hat");
	//Invalid keyword (keywords with a maximum of 50 characters each.) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS2", "Geçersiz anahtar (".LANG_MSG_KEYWORDS_WITH_MAXIMUM_50.") - hat");
	//Invalid title - line
	define("LANG_MSG_IMPORT_INVALIDTITLELINE", "Geçersiz başlık satırı - hat");
	//Invalid start date - line
	define("LANG_MSG_IMPORT_INVALIDSTARTDATE", "Geçersiz başlangıç tarihi - hat");
	//Invalid end date - line
	define("LANG_MSG_IMPORT_INVALIDENDDATE", "Geçersiz bitiş tarihi - hat");
	//Start date must be filled - line
	define("LANG_MSG_IMPORT_STARTDATEEMPTY", "Başlangıç tarihi dolu olmalıdır - hat");
	//End date must be filled - line
	define("LANG_MSG_IMPORT_ENDDATEEMPTY", "Bitiş tarihi dolu olmalıdır - hat");
	//The "End Date" must be greater than or equal to the "Start Date" - line
	define("LANG_MSG_IMPORT_END_DATE_GREATER_THAN_START_DATE", str_replace(".", "", LANG_MSG_END_DATE_GREATER_THAN_START_DATE)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//The "End Date" cannot be in past - line
	define("LANG_MSG_IMPORT_END_DATE_CANNOT_IN_PAST", str_replace(".", "", LANG_MSG_END_DATE_CANNOT_IN_PAST)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Invalid start time - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_NUMBER", "Geçersiz başlangıç saati - hat");
	//Invalid end time - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_NUMBER", "Geçersiz bitiş saati - hat");
	//Invalid start time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_FORMAT", "Geçersiz saat biçimi başlar. Olmalı \"xx:xx\" - hat");
	//Invalid end time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_FORMAT", "Geçersiz bitiş saati biçimi. Olmalı \"xx:xx\" - hat");
	//Invalid start time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE1", "Yanlış başlangıç zamanı modu. Olmalı \"AM\" veya \"PM\" - hat");
	//Invalid end time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE1", "Geçersiz bitiş zamanı modu. Olmalı \"AM\" veya \"PM\" - hat");
	//Invalid start time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE2", "Yanlış başlangıç​zamanı modu. Olmalı \"24\" - hat");
	//Invalid end time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE2", "Yanlış bitiş zamanı modu. Olmalı \"24\" - hat");
	//The "End Time" must be greater than the "Start Time" - line
	define("LANG_MSG_IMPORT_END_TIME_GREATER_THAN_START_TIME", str_replace(".", "", LANG_MSG_END_TIME_GREATER_THAN_START_TIME)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Location and system default location are differents - line
	define("LANG_MSG_IMPORT_INVALIDLOCATIONLINE", "Yer ile sistemin varsayılan yerleri arasında farklılıklar var satırı - hat");
	//Invalid latitude. Must be numeric between -90 and 90 - line
	define("LANG_MSG_IMPORT_INVALIDLATITUDELINE", "Geçersiz enlem. -90 Ile 90 arasında sayısal olmalı - hat");
	//Invalid longitude. Must be numeric between -180 and 180 - line
	define("LANG_MSG_IMPORT_INVALIDLONGITUDELINE", "Geçersiz boylam. -180 Ve 180 arasında sayısal olmalı - hat");
	//No CSV Files in Import Folder.
	define("LANG_MSG_IMPORT_NOFILES_INFTP", "Dosya Alım Klasöründe hiçbir CSV Dosyası yok.");
	//The number of columns in the following line(s) are wrong:
	define("LANG_MSG_IMPORT_NUMBEROFCOLUMNSAREWRONG", "Aşağıdaki satırlardaki sütün sayısı yanlış:");
	//Total lines read:
	define("LANG_MSG_IMPORT_TOTALLINESREADY", "Toplam satır sayısı:");
	//Total error lines:
	define("LANG_MSG_IMPORT_TOTALLINESERROR", "Toplam hata hatları:");
	//CSV header does not match - it has more fields that it is allowed
	define("LANG_MSG_IMPORT_WRONG_HEADER", "CSV başlık eşleşmiyor - buna izin verilirse daha fazla alan vardır");
	//CSV header does not match at field(s):
	define("LANG_MSG_IMPORT_WRONG_HEADER2", "CSV başlık alanı (ler) de uymuyor: ");
	//account rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK", "hesap geri alındı");
	//accounts rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK_PLURAL", "hesapları geri alındı");
	//item rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK", "Öğe geri alındı");
	//items rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK_PLURAL", "Öğeleri geri alındı");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	//Find what you are Looking for...
	define("LANG_SEARCH_MESSAGE_TITLE", "Sen arıyorsun ne bul...");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword.
	define("LANG_SEARCH_MESSAGE_TEXT", "Eğer kullandığınız anahtar kelime çok genel olduğu Bazen bir arama için herhangi bir sonuç alabilirsiniz. Daha belirli bir anahtar kelime kullanmaya çalışın.");

	# ----------------------------------------------------------------------------------------------------
	# PAGING
	# ----------------------------------------------------------------------------------------------------
	//Results per page
	define("LANG_PAGING_RESULTS_PER_PAGE", "Sayfa başına Sonuçlar");
	//Per Page
	define("LANG_PAGING_PER_PAGE", "Sayfa Başına");
	//Showing results
	define("LANG_PAGING_SHOWING_RESULTS", "Sonuç gösteriliyor");
	//Showing
	define("LANG_PAGING_SHOWING", "Gösterilen");
	//to
	define("LANG_PAGING_SHOWING_TO", "için");
	//of
	define("LANG_PAGING_SHOWING_OF", "ve");
	//Pages
	define("LANG_PAGING_SHOWING_PAGE", "Sayfaları");

	# ----------------------------------------------------------------------------------------------------
	# SUGARCRM
	# ----------------------------------------------------------------------------------------------------
	//Importing [SUGAR_ITEM_TITLE] from SugarCRM to [EDIRECTORY_TITLE]
	define("LANG_IMPORT_ITEM_FROM_SUGAR", "[SUGAR_ITEM_TITLE] SugarCRM gelen [EDIRECTORY_TITLE] İçe");
	//Use the form above to import from the SugarCRM record [SUGAR_ITEM_TITLE], after clicking import your data will be transferred to your directory installation with all relevant information passed across, just fill in the extra data, and payment data.
	define("LANG_MESSAGE_ON_FOOTER", "Şeker kayıttan almak için yukarıdaki formu kullanın [SUGAR_ITEM_TITLE], veri üzerinden iletilen tüm bilgileri ile dizini yükleme transfer edilecektir ithalat tıkladıktan sonra, sadece ek veri doldurun ve ödeme verileri.");
	//You're nearly done.
	define("LANG_YOU_NEARLY_DONE", "Neredeyse bitti.");
	//It was not possible to export. Please check your SugarCRM connection information on your directory.
	define("LANG_SUGAR_CHECKINFO", "Ihraç etmek de mümkün değildi. Dizin SugarCRM bağlantı bilgilerini kontrol edin.");
	//Wrong eDirectory Key.
	define("LANG_SUGAR_WRONG_KEY", "Yanlış eDirectory Anahtar.");

	# ----------------------------------------------------------------------------------------------------
	# ADVERTISE
	# ----------------------------------------------------------------------------------------------------
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_TITLE", LANG_LISTING_TITLE);
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_OWNER", "listele Sahibi");
	//10% Off - Deal Title
	define("LANG_LABEL_ADVERTISE_DEAL_TITLE", "10% Off - ".LANG_PROMOTION_TITLE);
	//Review Title
	define("LANG_LABEL_ADVERTISE_REVIEW_TITLE", "Yorum Başlığı");
	//Event Title
	define("LANG_LABEL_ADVERTISE_EVENT_TITLE", LANG_EVENT_TITLE);
	//Event Owner
	define("LANG_LABEL_ADVERTISE_EVENT_OWNER", "Aktivitenin Sahibi");
	//Classified Title
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_TITLE", LANG_CLASSIFIED_TITLE);
	//Classified Owner
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_OWNER", "İlanın Sahibi");
	//Article Title
	define("LANG_LABEL_ADVERTISE_ARTICLE_TITLE", LANG_ARTICLE_TITLE);
	//Article Author
	define("LANG_LABEL_ADVERTISE_ARTICLE_AUTHOR", "Makale Yazarının");
	//Contact Name
	define("LANG_LABEL_ADVERTISE_ITEM_CONTACT", LANG_LABEL_CONTACTNAME);
	//Zipcode
	define("LANG_LABEL_ADVERTISE_ITEM_ZIPCODE", ZIPCODE_LABEL);
	//www.yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_SITE", "www.sitenizin.com");
	//youremail@yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_EMAIL", "adınızı@sitenizin.com");
	//Address
	define("LANG_LABEL_ADVERTISE_ITEM_ADDRESS", LANG_LABEL_ADDRESS);
	//Card holder name
	define("LANG_LABEL_CARDHOLDER_NAME", "Kart Sahibinin Adı");
	//Charge for
	define("LANG_CHARGEFOR", "Koleksiyonu");
	//Visitor
	define("LANG_LABEL_ADVERTISE_VISITOR", "Ziyaretçi");
	//Category
	define("LANG_LABEL_ADVERTISE_CATEGORY", "Kategori");
	//Category 1
	define("LANG_LABEL_ADVERTISE_CATEGORY1", "Kategori 1");
	//Category 1.1
	define("LANG_LABEL_ADVERTISE_CATEGORY1_2", "Kategori 1.1");
	//Category 2
	define("LANG_LABEL_ADVERTISE_CATEGORY2", "Kategori 2");
	//Category 2.2
	define("LANG_LABEL_ADVERTISE_CATEGORY2_2", "Kategori 2.2");
	//Summary View
	define("LANG_LABEL_ADVERTISE_SUMMARYVIEW", "Özet Görünümü");
	//Detail View
	define("LANG_LABEL_ADVERTISE_DETAILVIEW", "Detay Görünümü");
	//This content is illustrative
	define("LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE", "Örnek içeri");

	# ----------------------------------------------------------------------------------------------------
	# TWILIO
	# ----------------------------------------------------------------------------------------------------
	//Activate Click-to-Call
	define("LANG_LABEL_ACTIVATECLICKCALL", "Aramak için tıklayın");
	//Send to Phone
	define("LANG_LABEL_SENDPHONE", "Telefona gönder");
	//Click to Call
	define("LANG_LABEL_CLICKTOCALL", "Aramak için tıklayın");
	//Message successfully sent!
	define("LANG_LABEL_SMS_SENT", "Mesaj başarıyla gönderildi!");
	//Send info about this listing to a phone.
	define("LANG_LISTING_TOPHONE_SAUDATION", "Bir telefon için bu liste hakkında bilgi gönder.");
	//Enter your phone to call the listing owner with no costs.
	define("LANG_LISTING_CLICKTOCALL_SAUDATION", "Hiçbir masraf listesi sahibini aramak için telefonunuzu girin.");
	//Phone is required.
	define("LANG_PHONE_REQUIRED", "Telefon gereklidir.");
	//Please, type a valid phone number.
	define("LANG_PHONE_INVALID", "Lütfen geçerli bir telefon numarasını yazın.");
	//Call
	define("LANG_TWILIO_CALL", "Aramak");
	//Calling
	define("LANG_TWILIO_CALLING", "Arayan");
	//Phone
	define("LANG_CLICKTOCALL_PHONE", "Telefon");
	//Extension
	define("LANG_CLICKTOCALL_EXTENSION", "Uzatma");
	//Activate
	define("LANG_CLICKTOCALL_ACTIVATE", "Kurmak");
	//Enter this code in your phone keypad when the test call connects:
	define("LANG_CLICKTOCALL_YOUR_VALIDATION_CODE", "Test çağrı bağlanır yaparken telefon tuş takımı bu kodu girin:");
	//Your phone number was activated!
	define("LANG_CLICKTOCALL_STATUS_ACTIVATED", "Telefon numaranız aktif oldu!");
	//Phone number successfully deleted!
	define("LANG_CLICKTOCALL_PHONE_DELETED", "Telefon numarası başarıyla silindi!");
	//Click to Call not available for this listing
	define("LANG_MSG_CLICKTOCALL_NOT_AVAILABLE", "Bu liste için kullanılabilir Aramak için Tıklayın");
	//Activate Click-to-Call and Get More Contacts
	define("LANG_CLICKTOCALL_TIPTITLE", "To-Çağrı-tıklatın ve Diğer Rehber alın etkinleştirin");
	//You need to activate the phone number below in order to allow the users to contact you directly through the directory.
	define("LANG_CLICKTOCALL_TIP1", "Kullanıcılar dizine aracılığıyla doğrudan sizinle iletişim kurmak için izin vermek için aşağıdaki telefon numarasını aktive etmek gerekiyor.");
	//Click-to-call allows clients to connect a call between your phone and theirs with the click of a button.  To activate, press the button below and a test call will be made.
	define("LANG_CLICKTOCALL_TIP2", "Click-to-çağrı istemcileri bir düğmeye tıklama ile telefonunuz ve onların arasında bir çağrının bağlanmasını sağlar. , Etkinleştirmek için aşağıdaki düğmeye basın ve bir test çağrısı yapılacağı.");
	//A message with your activation code will be shown. Take note of this code and wait for the activation phone call.
	define("LANG_CLICKTOCALL_TIP3", "Aktivasyon kodu içeren bir mesaj gösterilecektir. Bu kodu not alın ve aktivasyon telefon görüşmesi için bekleyin.");
	//You will be ask to enter the six digits activation code. Enter the code and wait for the confirmation message.
	define("LANG_CLICKTOCALL_TIP4", "Altı haneli aktivasyon kodunu girmeniz istenecektir.Kodunu girin ve onay mesajı için bekleyin.");
	//After activate your phone number, click in Save Number to finish the process.
	define("LANG_CLICKTOCALL_TIP5", "Telefon numaranızı etkinleştirdikten sonra, işlemi tamamlamak için Kaydet'i tıklatın.");
	//For numbers outside the USA, you need to put your country code first.
	define("LANG_CLICKTOCALL_TIP6", "ABD dışındaki numaraları için, ilk önce ülke kodunu koymak gerekir.");
	//For numbers outside the USA, the country code must be included.
	define("LANG_CLICKTOCALL_TIP7", "ABD dışında numaraları için ülke kodu dahil edilmelidir.");
	//"Click to Call" report
	define("LANG_CLICKTOCALL_REPORT", "\"Aramak için tıklayın\" raporu");
	//Direction
	define("LANG_CLICKTOCALL_REPORT_DIRECTION", "Yön");
	//To
	define("LANG_CLICKTOCALL_REPORT_FROM", "Itibaren");
	//Start Time
	define("LANG_CLICKTOCALL_REPORT_START_TIME", "Başlangıç Saati");
	//End Time
	define("LANG_CLICKTOCALL_REPORT_END_TIME", "Bitiş Saati");
	//Duration (seconds)
	define("LANG_CLICKTOCALL_REPORT_DURATION", "Süre (saniye)");
	//No reports available.
	define("LANG_CLICKTOCALL_REPORT_NORECORD", "Yok bildirir.");
	//Activated by
	define("LANG_LABEL_ACTIVATED_BY", "Tarafından aktive");
	//Activation failed. Please, try again.
	define("LANG_TWILIO_ERROR_10000", "Etkinleştirme başarısız oldu. Lütfen yeniden deneyin.");
	//Account is not active.
	define("LANG_TWILIO_ERROR_10001", "Hesap aktif değildir.");
	//Trial account does not support this feature.
    define("LANG_TWILIO_ERROR_10002", "Deneme hesabı, bu özelliği desteklemiyor.");
	//Incoming call rejected due to inactive account.
    define("LANG_TWILIO_ERROR_10003", "Gelen çağrı, pasif hesap nedeniyle reddetti.");
	//Invalid URL format.
    define("LANG_TWILIO_ERROR_11100", "Geçersiz URL biçimi.");
	//HTTP retrieval failure.
    define("LANG_TWILIO_ERROR_11200", "HTTP alma başarısızlık.");
	//HTTP connection failure.
    define("LANG_TWILIO_ERROR_11205", "HTTP bağlantı hatası.");
	//HTTP protocol violation.
    define("LANG_TWILIO_ERROR_11206", "HTTP protokol ihlali.");
	//HTTP bad host name.
    define("LANG_TWILIO_ERROR_11210", "HTTP kötü bir konak adı.");
	//HTTP too many redirects.
    define("LANG_TWILIO_ERROR_11215", "HTTP çok yönlendirir.");
	//Document parse failure.
    define("LANG_TWILIO_ERROR_12100", "Belge ayrıştırma hatası.");
	//Invalid Twilio Markup XML version.
    define("LANG_TWILIO_ERROR_12101", "Geçersiz Twilio Biçimlendirme XML sürümü.");
	//The root element must be Response.
    define("LANG_TWILIO_ERROR_12102", "Tepki kök elemanı olmalıdır.");
	//Schema validation warning.
    define("LANG_TWILIO_ERROR_12200", "Şema doğrulama uyarısı.");
	//Invalid Content-Type.
    define("LANG_TWILIO_ERROR_12300", "Geçersiz Content-Type.");
	//Internal Failure.
    define("LANG_TWILIO_ERROR_12400", "İç Başarısızlık.");
	//Dial: Cannot Dial out from a Dial Call Segment.
    define("LANG_TWILIO_ERROR_13201", "Dial: Çevirmeli Çağrı Segment Dial değil.");
	//Dial: Invalid method value.
    define("LANG_TWILIO_ERROR_13210", "Dial: Geçersiz yöntem değeri.");
	//Dial: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13212", "Dial: Geçersiz zaman aşımı değeri.");
	//Dial: Invalid hangupOnStar value.
    define("LANG_TWILIO_ERROR_13213", "Dial: Geçersiz hangupOnStar değer.");
	//Dial: Invalid callerId value.
    define("LANG_TWILIO_ERROR_13214", "Dial: Geçersiz CallerID değer.");
	//Dial: Invalid nested element.
    define("LANG_TWILIO_ERROR_13215", "Dial: Geçersiz iç içe geçmiş öğesi.");
	//Dial: Invalid timeLimit value.
    define("LANG_TWILIO_ERROR_13216", "Dial: Geçersiz süre kısıtlaması değer.");
	//Dial->Number: Invalid method value.
    define("LANG_TWILIO_ERROR_13221", "Dial->Number: Geçersiz yöntem değeri.");
	//Dial->Number: Invalid sendDigits value.
    define("LANG_TWILIO_ERROR_13222", "Dial->Number: Geçersiz sendDigits değer.");
	//Dial: Invalid phone number format.
    define("LANG_TWILIO_ERROR_13223", "Dial: Geçersiz telefon numarası biçimi.");
	//Dial: Invalid phone number.
    define("LANG_TWILIO_ERROR_13224", "Dial: Geçersiz telefon numarası.");
	//Dial: Forbidden phone number.
    define("LANG_TWILIO_ERROR_13225", "Dial: Telefon numarası yasaktır.");
	//Dial->Conference: Invalid muted value.
    define("LANG_TWILIO_ERROR_13230", "Dial->Conference: Geçersiz sessiz değer.");
	//Dial->Conference: Invalid endConferenceOnExit value.
    define("LANG_TWILIO_ERROR_13231", "Dial->Conference: Geçersiz endConferenceOnExit değer.");
	//Dial->Conference: Invalid startConferenceOnEnter value.
    define("LANG_TWILIO_ERROR_13232", "Dial->Conference: Geçersiz startConferenceOnEnter değer.");
	//Dial->Conference: Invalid waitUrl.
    define("LANG_TWILIO_ERROR_13233", "Dial->Conference: Geçersiz waitUrl.");
	//Dial->Conference: Invalid waitMethod.
    define("LANG_TWILIO_ERROR_13234", "Dial->Conference: Geçersiz waitMethod.");
	//Dial->Conference: Invalid beep value.
    define("LANG_TWILIO_ERROR_13235", "Dial->Conference: Geçersiz bip değeri.");
	//Dial->Conference: Invalid Conference Sid.
    define("LANG_TWILIO_ERROR_13236", "Dial->Conference: Geçersiz Konferansı Sid.");
	//Dial->Conference: Invalid Conference Name.
    define("LANG_TWILIO_ERROR_13237", "Dial->Conference: Geçersiz Konferansı adı.");
	//Dial->Conference: Invalid Verb used in waitUrl TwiML.
    define("LANG_TWILIO_ERROR_13238", "Dial->Conference: Geçersiz Fiil waitUrl TwiML kullanılır.");
	//Gather: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13310", "Gather: Geçersiz finishOnKey değer.");
	//Gather: Invalid method value.
    define("LANG_TWILIO_ERROR_13312", "Gather: Geçersiz yöntem değeri.");
	//Gather: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13313", "Gather: Geçersiz zaman aşımı değeri.");
	//Gather: Invalid numDigits value.
    define("LANG_TWILIO_ERROR_13314", "Gather: Geçersiz numDigits değer.");
	//Gather: Invalid nested verb.
    define("LANG_TWILIO_ERROR_13320", "Gather: Geçersiz iç içe geçmiş fiil.");
	//Gather->Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13321", "Gather->Say: Geçersiz ses değeri.");
	//Gather->Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13322", "Gather->Say: Geçersiz döngü değeri.");
	//Gather->Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13325", "Gather->Play: Geçersiz Content-Type.");
	//Play: Invalid loop value.
    define("LANG_TWILIO_ERROR_13410", "Play: Geçersiz döngü değeri.");
	//Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13420", "Play: Geçersiz Content-Type.");
	//Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13510", "Say: Geçersiz döngü değeri.");
	//Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13511", "Say: Geçersiz ses değeri.");
	//Say: Invalid text.
    define("LANG_TWILIO_ERROR_13520", "Say: Metin Geçersiz.");
	//Record: Invalid method value.
    define("LANG_TWILIO_ERROR_13610", "Record: Geçersiz yöntem değeri.");
	//Record: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13611", "Record: Geçersiz zaman aşımı değeri.");
	//Record: Invalid maxLength value.
    define("LANG_TWILIO_ERROR_13612", "Record: Geçersiz maxLength değer.");
	//Record: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13613", "Record: Geçersiz finishOnKey değeri.");
	//Redirect: Invalid method value.
    define("LANG_TWILIO_ERROR_13710", "Redirect: Geçersiz yöntem değeri.");
	//Pause: Invalid length value.
    define("LANG_TWILIO_ERROR_13910", "Pause: Geçersiz uzunluk değeri.");
	//Invalid "To" attribute.
    define("LANG_TWILIO_ERROR_14101", "Geçersiz öznitelik.");
	//Invalid "From" attribute.
    define("LANG_TWILIO_ERROR_14102", "Geçersiz özniteliği.");
	//Invalid Body.
    define("LANG_TWILIO_ERROR_14103", "Geçersiz Vücut.");
	//Invalid Method attribute.
    define("LANG_TWILIO_ERROR_14104", "Geçersiz Yöntemi özniteliği.");
	//Invalid statusCallback attribute.
    define("LANG_TWILIO_ERROR_14105", "Geçersiz statusCallback özniteliği.");
	//Document retrieval limit reached.
    define("LANG_TWILIO_ERROR_14106", "Belge alma sınırına ulaşıldığında.");
	//SMS send rate limit exceeded.
    define("LANG_TWILIO_ERROR_14107", "SMS hız limiti aşıldığında gönderebilirsiniz.");
	//From phone number not SMS capable.
    define("LANG_TWILIO_ERROR_14108", "Yeteneğine telefon numarası gelen SMS değil.");
	//SMS Reply message limit exceeded.
    define("LANG_TWILIO_ERROR_14109", "SMS Yanıtla mesaj sınırı aşıldı.");
	//Invalid Verb for SMS Reply.
    define("LANG_TWILIO_ERROR_14110", "SMS Yanıtla Geçersiz Fiil.");
	//Invalid To phone number for Trial mode.
    define("LANG_TWILIO_ERROR_14111", "Deneme modu için telefon numarası geçersiz.");
	//Unknown parameters.
    define("LANG_TWILIO_ERROR_20001", "Bilinmeyen parametreler.");
	//Invalid FriendlyName.
    define("LANG_TWILIO_ERROR_20002", "Geçersiz FriendlyName.");
	//Permission Denied.
    define("LANG_TWILIO_ERROR_20003", "İzin Verilmedi.");
	//Method not allowed.
    define("LANG_TWILIO_ERROR_20004", "Yönteme izin verilmiyor.");
	//Account not active.
    define("LANG_TWILIO_ERROR_20005", "Hesap aktif değil.");
	//No Called number specified.
    define("LANG_TWILIO_ERROR_21201", "Yok Aranan numara belirtildi.");
	//Called number is a premium number.
    define("LANG_TWILIO_ERROR_21202", "Aranan numarayı bir prim sayıdır.");
	//International calling not enabled.
    define("LANG_TWILIO_ERROR_21203", "Uluslararası arama etkin değil.");
	//Invalid URL.
    define("LANG_TWILIO_ERROR_21205", "Geçersiz URL.");
	//Invalid SendDigits.
    define("LANG_TWILIO_ERROR_21206", "Geçersiz SendDigits.");
	//Invalid IfMachine.
    define("LANG_TWILIO_ERROR_21207", "Geçersiz IfMachine.");
	//Invalid Timeout.
    define("LANG_TWILIO_ERROR_21208", "Geçersiz Timeout.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21209", "Geçersiz Method.");
	//Caller phone number not verified.
    define("LANG_TWILIO_ERROR_21210", "Arayan telefon numarası doğrulanmadı.");
	//Invalid Called Phone Number.
    define("LANG_TWILIO_ERROR_21211", "Geçersiz Telefon Numarası çağrılır.");
	//Invalid Caller Phone Number.
    define("LANG_TWILIO_ERROR_21212", "Geçersiz Arayan Telefon Numarası.");
	//Caller phone number is required.
    define("LANG_TWILIO_ERROR_21213", "Arayan telefon numarası gereklidir.");
	//Called Phone Number cannot be reached.
    define("LANG_TWILIO_ERROR_21214", "Adında Telefon Numarası ulaşmış olamaz.");
	//Account not authorized to call phone number.
    define("LANG_TWILIO_ERROR_21215", "Hesap telefon numarasını aramak için yetkili değildir.");
	//Account not allowed to call phone number.
    define("LANG_TWILIO_ERROR_21216", "Telefon numarasını aramak için izin verilmez Hesabı.");
	//Phone number does not appear to be valid.
    define("LANG_TWILIO_ERROR_21217", "Telefon numarası geçerli olabilmesi için görünmez.");
	//Invalid ApplicationSid.
    define("LANG_TWILIO_ERROR_21218", "Geçersiz ApplicationSid.");
	//Invalid call state.
    define("LANG_TWILIO_ERROR_21220", "Geçersiz arama durumunda.");
	//Invalid Phone Number.
    define("LANG_TWILIO_ERROR_21401", "Geçersiz Telefon Numarası.");
	//Invalid Url.
    define("LANG_TWILIO_ERROR_21402", "Geçersiz URL.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21403", "Geçersiz Method");
	//Inbound Phone number not available to trial account.
    define("LANG_TWILIO_ERROR_21404", "Gelen Telefon numarası deneme hesabı mevcut değil.");
	//Cannot set VoiceFallbackUrl without setting Url.
    define("LANG_TWILIO_ERROR_21405", "URL ayarı VoiceFallbackUrl ayarlanamıyor.");
	//Cannot set SmsFallbackUrl without setting SmsUrl.
    define("LANG_TWILIO_ERROR_21406", "SmsUrl ayarı SmsFallbackUrl ayarlanamıyor.");
	//This Phone Number type does not support SMS.
    define("LANG_TWILIO_ERROR_21407", "Bu Telefon Numarası türü SMS desteklemiyor.");
	//Phone number already validated on your account.
    define("LANG_TWILIO_ERROR_21450", "Telefon numarası zaten hesabınızda valide.");
	//Invalid area code.
    define("LANG_TWILIO_ERROR_21451", "Geçersiz alan kodu.");
	//No phone numbers found in area code.
    define("LANG_TWILIO_ERROR_21452", "Hiçbir telefon numarası alan kodu bulundu.");
	//Phone number already validated on another account.
    define("LANG_TWILIO_ERROR_21453", "Telefon numarası Zaten başka bir hesabın da tasdik edilmiştir.");
	//Invalid CallDelay.
    define("LANG_TWILIO_ERROR_21454", "Geçersiz CallDelay.");
	//Resource not available.
    define("LANG_TWILIO_ERROR_21501", "Kaynak kullanılabilir değil.");
	//Invalid callback url.
    define("LANG_TWILIO_ERROR_21502", "Geçersiz geri arama url.");
	//Invalid transcription type.
    define("LANG_TWILIO_ERROR_21503", "Geçersiz transkripsiyon yazın.");
	//RecordingSid is required..
    define("LANG_TWILIO_ERROR_21504", "RecordingSid gereklidir.");
	//Phone number is not a valid SMS-capable inbound phone number.
    define("LANG_TWILIO_ERROR_21601", "Telefon numarası, geçerli bir SMS özellikli gelen telefon numarası değildir.");
	//Message body is required.
    define("LANG_TWILIO_ERROR_21602", "Mesaj gövdesi gereklidir.");
	//The source 'from' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21603", "Kaynağı telefon numarası bir SMS göndermek için gereklidir.");
	//The destination 'to' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21604", "Telefon numarası 'için' Hedef bir SMS göndermek için gereklidir.");
	//Maximum SMS body length is 160 characters.
    define("LANG_TWILIO_ERROR_21605", "Maksimum SMS vücut uzunluğu 160 karakter.");
	//The "From" phone number provided is not a valid, SMS-capable inbound phone number for your account.
    define("LANG_TWILIO_ERROR_21606", "Verilen telefon numarası hesabınız için geçerli, SMS özellikli gelen telefon numarası değildir.");
	//The Sandbox number can send messages only to verified numbers.
    define("LANG_TWILIO_ERROR_21608", "Sandbox sayısı sadece doğrulanmış numaralara mesaj gönderebilirsiniz.");

	# ----------------------------------------------------------------------------------------------------
	# FACEBOOK COMMENTS
	# ----------------------------------------------------------------------------------------------------
	//Facebook comments
	define("LANG_LABEL_FACEBOOK_COMMENTS", "Facebook yorum");
	//Facebook comments not available for this listing
	define("LANG_LABEL_FACEBOOK_COMMENTS_NOT_AVAILABLE", "Bu liste için geçerli değildir Facebook yorum");
	//Be sure you're logged into Facebook with the same account you set in your Commenting Options section, otherwise you can not moderate the comments for this item.
	define("LANG_LABEL_FACEBOOK_TIP1", "Yorumlarında Seçenekleri bölümünde belirlenen aynı hesap ile Facebook oturum açmış olduğunuzdan emin olun, aksi takdirde orta Bu öğe için bir yorum olamaz.");
	//You can also moderate your comments by going to
	define("LANG_LABEL_FACEBOOK_TIP2", "Ayrıca, giderek orta ");

	# ----------------------------------------------------------------------------------------------------
	# EDIRECTORY API
	# ----------------------------------------------------------------------------------------------------
	//Invalid API key.
	define("LANG_API_INVALIDKEY", "Geçersiz API anahtarı.");
	//Missing parameter: module.
	define("LANG_API_EMPTYMODULE", "Parametre yok: module.");
	//Invalid module name.
	define("LANG_API_INVALIDMODULE", "Geçersiz modül adı.");
	//Module disabled.
	define("LANG_API_MODULEOFF", "Modül devre dışı.");
	//Missing parameter: keyword.
	define("LANG_API_EMPTYKEYWORD", "Parametre yok: keyword.");
	//API disabled.
	define("LANG_API_DISABLED", "API devre dışı.");

	# ----------------------------------------------------------------------------------------------------
	# THEME TEMPLATE
	# ----------------------------------------------------------------------------------------------------
	//Swimming Pool
	define("LANG_LABEL_TEMPLATE_POOL", "Yüzme Havuzu");
	//Bedrooms(s)
	define("LANG_LABEL_TEMPLATE_BEDROOM", "Yatak Odası");
	//Bathrooms(s)
	define("LANG_LABEL_TEMPLATE_BATHROOM", "Banyolar");
	//Level(s)
	define("LANG_LABEL_TEMPLATE_LEVEL", "Seviye(ler)");
	//Property Type
	define("LANG_LABEL_TEMPLATE_TYPE", "Emlak Tipi");
	//Purpose
	define("LANG_LABEL_TEMPLATE_PURPOSE", "Amaç");
	//Price
	define("LANG_LABEL_TEMPLATE_PRICE", "Fiyat");
	//Acres
	define("LANG_LABEL_TEMPLATE_ACRES", "Acres");
	//Built In
	define("LANG_LABEL_TEMPLATE_TYPEBUILTIN", "Dahili");
	//Square Feet
	define("LANG_LABEL_TEMPLATE_SQUARE", "Feet Kare");
	//Office
	define("LANG_LABEL_TEMPLATE_OFFICE", "Ofis");
	//Laundry Room
	define("LANG_LABEL_TEMPLATE_LAUNDRYROOM", "Çamaşır Odası");
	//Central Air Conditioning
	define("LANG_LABEL_TEMPLATE_AIRCOND", "Merkezi Klima");
	//Dining Room
	define("LANG_LABEL_TEMPLATE_DINING", "Yemek Odası");
	//Garage
	define("LANG_LABEL_TEMPLATE_GARAGE", "Garaj");
	//Garbage Disposal
	define("LANG_LABEL_TEMPLATE_GARBAGE", "Çöp Atma");

	# ----------------------------------------------------------------------------------------------------
	# BLOG
	# ----------------------------------------------------------------------------------------------------
	//Your post will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_POST_AUTOMATICALLY_APPEAR", "İletiniz seçtiğiniz her alt-kategorinin ana kategorisinin altında gözükecektir.");
	//Type a keyword or post title
	define("LANG_LABEL_SEARCHKEYWORDTIP_POST", "Anahtar sözcük veya kayıt başlığı girin");
	//Archive
	define("LANG_BLOG_ARCHIVE", "Arşiv");
	//Recent Topics
	define("LANG_BLOG_RECENTTOPICS", "Yeni Konular");
	//Recent Members
	define("LANG_BLOG_RECENTMEMBERS", "Yeni Üyeler");
	//View more
	define("LANG_VIEWMORE", "Devamı");
	//Popular Topics
	define("LANG_BLOG_POPULARTOPICS", "Popüler Konular");
	//Post Search Results
	define("LANG_MSG_BLOGRESULTS", "Arama Sonuçlarını İlet");
	//Comments
	define("LANG_BLOG_COMMENTS", "Blog Yorumları");
	//Comment It
	define("LANG_BLOG_COMMENTIT", "Yorumla!");
	//Related Posts
	define("LANG_BLOG_RELATEDPOSTS", "İlgili İletiler");
	//Web Site
	define("LANG_LABEL_WEBSITE", "Web Sitesi");
	//Published
	define("LANG_BLOG_PUBLISHED", "Yayınlandı");
	//on
	define("LANG_BLOG_ON", "de");
	//"About" [POST_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_BLOG_CONTACTSUBJECT_ISNULL_1", "Hakkında");
	//About [POST_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_BLOG_CONTACTSUBJECT_ISNULL_2", "den");
	//Send info about this post to a friend
	define("LANG_BLOG_TOFRIEND_SAUDATION", "Bu ileti hakkında arkadaşına bilgi gönder");
	//SOME DETAILS
	define("LANG_BLOG_TOFRIEND_MAIL", "BAZI DETAYLAR");
	//Post
	define("LANG_BLOG", "Gönder");
	//Leave Your Comment
	define("LANG_MSG_LEAVEYOURCOMMENT", "Yorum yap");
	//Reply to this comment
	define("LANG_MSG_REPLYTHISCOMMENT", "Bu yoruma cevap gver");
	//Please type a valid e-mail
	define("LANG_COMMENT_EMPTY_EMAIL", "Lütfen geçerli bir e-posta adresi girin.");
	//Please type a website
	define("LANG_COMMENT_EMPTY_WEBSITE", "Lütfen bir website girin.");
	//Please type a comment!
	define("LANG_COMMENT_EMPTY", "Lütfen bir yorum girin.");
	//Comments of
	define("LANG_COMMENTS_COMMENTSOF", "Yorumları ");
	//No comment found for this post!
	define("LANG_COMMENT_NORECORD", "Bu ileti için yorum bulunmadı!");
	//Post
	define("LANG_LABEL_POST", "İleti");
	//Click here to view this comment
	define("LANG_MSG_CLICK_TO_VIEW_THIS_COMMENT", "Bu yorumu görmek için tıklayın");
	//Click here to view this comment's replies
	define("LANG_MSG_CLICK_TO_VIEW_REPLIES", "Bu yorumun cevaplarını görmek için tıklayın");
	//This comments has no replies
	define("LANG_MSG_NO_REPLIES", "Bu yorumun cevabı yok");
	//Click here to delete this comment
	define("LANG_MSG_CLICK_TO_DELETE_THIS_COMMENT", "Bu yorumu silmek için tıklayın");
	//View replys
	define("LANG_LABEL_VIEW_REPLY", "Cevapları gör");
	//Click here to view this post reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BLOG_REPORTS", "Bu iletinin raporlarını görmek için tıklayın");
	//You need to login to leave your comment
	define("LANG_MSG_NEED_LOGIN", "Yorum yapmak için oturum açmanız gerekli.");
	//You need to login to redeem a deal.
	define("LANG_MSG_NEED_LOGIN_DEAL", "Siz bir teklif doğrulamak için giriş yapmalısınız.");
	//No posts found.
	define("LANG_MSG_NOBLOGS", "İleti bulunmadı.");
	//No posts
	define("LANG_MSG_NOPOSTS", "İleti yok");
	//Comment successfully posted!
	define("LANG_MSG_COMMENT_SUCCESSFULLY_POSTED", "Yorum başarıyla gönderildi!");
	//Your comment has been submitted for approval.
	define("LANG_MSG_COMMENT_SENT_TO_APPROVE", "Yorumunuz onaya gönderildi.");
	//Reply successfully posted!
	define("LANG_MSG_REPLY_SUCCESSFULLY_POSTED", "Cevabınız başarıyla gönderildi!");
	//Your reply has been submitted for approval.
	define("LANG_MSG_REPLY_SENT_TO_APPROVE", "Cevabınız onaya gönderildi.");
	//Content
	define("LANG_LABEL_POST_CONTENT", "İçerik");
	//Reply
	define("LANG_LABEL_REPLY", "Cevap");
	//Re
	define("LANG_LABEL_ABBR_REPLY", "Cevap");
	//Click here to view this reply
	define("LANG_MSG_CLICK_TO_VIEW_THIS_REPLY", "Bu cevabı görmek için tıklayın");
	//Click here to delete this reply
	define("LANG_MSG_CLICK_TO_DELETE_THIS_REPLY", "Bu cevabı silmek için tıklayın");

	# ----------------------------------------------------------------------------------------------------
	# SITEMGR NOTIFICATIONS
	# ----------------------------------------------------------------------------------------------------
	//Account Notification
	define("LANG_NOTIFY_NEWACCOUNT", "[".EDIRECTORY_TITLE."] Hesap Bildirim");
	//A new account was created in
	define("LANG_NOTIFY_NEWACCOUNT_1", "Yeni bir hesap oluşturuldu");
	//Please review the account information below:
	define("LANG_NOTIFY_NEWACCOUNT_2", "Aşağıdaki hesap bilgilerini gözden geçirin:");
	//Article Notification
	define("LANG_NOTIFY_ARTICLE", "[".EDIRECTORY_TITLE."] ".LANG_ARTICLE_FEATURE_NAME." Bildirim");
	//was changed by the administrator
	define("LANG_NOTIFY_ITEMS_1", "yönetici tarafından değiştirildi");
	//was created by the administrator
	define("LANG_NOTIFY_ITEMS_2", "yönetici tarafından oluşturuldu");
	//and needs to be revised by you.
	define("LANG_NOTIFY_ITEMS_3", "ve sizin tarafınızdan gözden geçirilmesi gerekmektedir.");
	//Banner Notification
	define("LANG_NOTIFY_BANNER", "[".EDIRECTORY_TITLE."] ".LANG_BANNER_FEATURE_NAME." Bildirim");
	//Transaction Notification
	define("LANG_NOTIFY_TRANSACTION", "[".EDIRECTORY_TITLE."] İşlem Bildirim");
	//A transaction was made and needs to be revised by you.
	define("LANG_NOTIFY_TRANSACTION_1", "Bir işlem yapılan ve sizin tarafınızdan gözden geçirilmesi gerekmektedir edildi.");
	//Transaction Info:
	define("LANG_NOTIFY_TRANSACTION_2", "İşlem Bilgisi:");
	//Transaction Time
	define("LANG_NOTIFY_TRANSACTION_3", "İşlem Süresi");
	//Gateway
	define("LANG_NOTIFY_TRANSACTION_4", "Ödeme");
	//(prices amount are per installments)
	define("LANG_NOTIFY_TRANSACTION_5", "(fiyatlarının miktarı taksitle başınadır)");
	//Please sign in to the directory at the links below to revise and/or activate these items.
	define("LANG_NOTIFY_TRANSACTION_6", "Bu öğeleri gözden geçirilmesi ve / veya etkinleştirmek için aşağıdaki bağlantılardan dizini için lütfen giriş yapın.");
	//Classified Notification
	define("LANG_NOTIFY_CLASSIFIED", "[".EDIRECTORY_TITLE."] ".LANG_CLASSIFIED_FEATURE_NAME." Bildirim");
	//Contact Us
	define("LANG_NOTIFY_CONTACTUS", "Bize Ulaşın");
	//Event Notification
	define("LANG_NOTIFY_EVENT", "[".EDIRECTORY_TITLE."] ".LANG_EVENT_FEATURE_NAME." Bildirim");
	//Listing Notification
	define("LANG_NOTIFY_LISTING", "[".EDIRECTORY_TITLE."] ".LANG_LISTING_FEATURE_NAME." Bildirim");
    //New Comment Added
    define("LANG_NOTIFY_NEWCOMMENT", "Yeni Yorum Ekleyen");
    //New Reply Added
    define("LANG_NOTIFY_NEWREPLY", "Yeni Yanıt Ekleyen");
    //Your blog post
    define("LANG_NOTIFY_NEWCOMMENT_1", "Blogunuz sonrası");
    //has a new reply.
    define("LANG_NOTIFY_NEWCOMMENT_2", "yeni bir yanıt aldı.");
    //has a new comment.
    define("LANG_NOTIFY_NEWCOMMENT_3", "yeni bir yorum aldı.");
    //wrote
    define("LANG_NOTIFY_NEWCOMMENT_4", "yazdı");
    //on
    define("LANG_NOTIFY_NEWCOMMENT_5", "içinde");
    //Click on the link below to moderate the comment
    define("LANG_NOTIFY_NEWCOMMENT_6", "Yorumları denetlemek için aşağıdaki linki tıklayın");
    //CSS Editor Backup
    define("LANG_NOTIFY_EDITORCHANGED", "Yedekleme CSS Editör");
    //The file
    define("LANG_NOTIFY_EDITORCHANGED_1", "Dosya");
    //was changed at
    define("LANG_NOTIFY_EDITORCHANGED_2", "tadil edilmiştir");
    //Enclosed is a copy of the last version submitted to the site.
    define("LANG_NOTIFY_EDITORCHANGED_3", "Yüklenen dosya en son sürümü olan Attached.");
    //Rating Notification
    define("LANG_NOTIFY_NEWREVIEW", "Değerlendirme Bildirimi");
    //has a new review
    define("LANG_NOTIFY_NEWREVIEW_1", "Yeni bir yorum var");
    //stars
    define("LANG_NOTIFY_NEWREVIEW_2", "yıldızlar");
    //Click on the link below to go to the review administration
    define("LANG_NOTIFY_NEWREVIEW_3", "Değerlendirmelerin idaresine gitmek için aşağıdaki linki tıklayın");
    //from
    define("LANG_NOTIFY_NEWREVIEW_4", "arasında");
    //wrote
    define("LANG_NOTIFY_NEWREVIEW_5", "yazdı");
    //Reply Notification
    define("LANG_NOTIFY_NEWREPLY", "Bildirim Tepki");
    //Review
    define("LANG_NOTIFY_NEWREPLY_1", "Değerlendirme");
    //has a new reply
    define("LANG_NOTIFY_NEWREPLY_2", "Yeni cevap var");
    //Click on the link below to go to the review administration
    define("LANG_NOTIFY_NEWREPLY_3", "Değerlendirmelerin idaresine gitmek için aşağıdaki linki tıklayın");
    //Import Correction Notification
    define("LANG_NOTIFY_PREPAREIMPORT", "Düzeltme İthalat Bildirimi");
    //Event Import Correction Notification
    define("LANG_NOTIFY_PREPAREIMPORT_EVENT", "Düzeltme İthalat Etkinlik Bildirimi");
    //Your import correction for the file
    define("LANG_NOTIFY_PREPAREIMPORT_1", "Ithalat dosyasının düzeltilmesi");
    //was completed but contained errors.
    define("LANG_NOTIFY_PREPAREIMPORT_2", "kesinleşmiş, ancak hatalar içermemektedir.");
    //Please review the log at
    define("LANG_NOTIFY_PREPAREIMPORT_3", "Tarihte kontrol edin");
    //has been completed.
    define("LANG_NOTIFY_PREPAREIMPORT_4", "tamamlanmıştır.");
    //You can review the log here
    define("LANG_NOTIFY_PREPAREIMPORT_5", "Burada geçmişi gözden geçirebilirsiniz");
    //Listing Import Notification
    define("LANG_NOTIFY_IMPORTLISTING", "Bildirim İthalat Şirketi");
    //Your listing(s) import has been completed.
    define("LANG_NOTIFY_IMPORTLISTING_1", "Onun ithalat iş tamamlanmıştır.");
    //You can review the log here
    define("LANG_NOTIFY_IMPORTLISTING_2", "Burada geçmişi gözden geçirebilirsiniz");
    //Event Import Notification
    define("LANG_NOTIFY_IMPORTEVENT", "Bildirim Olay İthalat");
    //Your event(s) import has been completed
    define("LANG_NOTIFY_IMPORTEVENT_1", "Onun ithalat etkinlik sona erdi.");
    //You can review the log here
    define("LANG_NOTIFY_IMPORTEVENT_2", "Burada geçmişi gözden geçirebilirsiniz");
    //Package Notification
    define("LANG_NOTIFY_PACKAGE", "Satınalma Paket bildirim");
    //The package
    define("LANG_NOTIFY_PACKAGE_1", "Paketi");
    //was bought by the administrator
    define("LANG_NOTIFY_PACKAGE_2", "reklamveren tarafından satın alındı");
    //and needs to be checked over by you.
    define("LANG_NOTIFY_PACKAGE_3", "ve sizin tarafınızdan gözden geçirilmelidir.");
    //Purchased items
    define("LANG_NOTIFY_PACKAGE_4", "Ürünleri satın");
    //Help Request
    define("LANG_NOTIFY_MEMBERSHELP", "Yardım Talebi");
    //You have received a message from one of your site members.
    define("LANG_NOTIFY_MEMBERSHELP_1", "Sitenizin bir üyesi bir mesaj aldı.");
    //From
    define("LANG_NOTIFY_MEMBERSHELP_2", "Of");
    //E-mail
    define("LANG_NOTIFY_MEMBERSHELP_3", "E-posta");
    //Message
    define("LANG_NOTIFY_MEMBERSHELP_4", "Mesaj");
    //Forgotten Password
    define("LANG_NOTIFY_FORGOTPASS", "Şifremi Unuttum");
    //A new password was requested from your ".EDIRECTORY_TITLE." account.
    define("LANG_NOTIFY_FORGOTPASS_1", "Yeni parola hesabınız için istendi ".EDIRECTORY_TITLE.".");
    //To change your password please click the link below and enter a new password
    define("LANG_NOTIFY_FORGOTPASS_2", "Şifrenizi değiştirmek için, aşağıdaki bağlantıyı tıklayın ve yeni bir şifre girin");
    //New User Signup (Listing)
    define("LANG_NOTIFY_SIGNUPLISTING", "Yeni Kayıt (Listeler)");
    //A new user has signed up and ordered a listing at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPLISTING_1", "Yeni bir kullanıcı kaydoldum ve bir şirket oluşturdu ".EDIRECTORY_TITLE.".");
    //New User Signup (Event)
    define("LANG_NOTIFY_SIGNUPEVENT", "Yeni Kayıt (Aktiviteler)");
    //A new user has signed up and ordered an event at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPEVENT_1", "Yeni bir kullanıcı bir olay kaydoldum ve oluşturulan ".EDIRECTORY_TITLE.".");
    //New User Signup (Classified)
    define("LANG_NOTIFY_SIGNUPCLASSIFIED", "Yeni Kayıt (Ilanlar)");
    //A new user has signed up and ordered a classified at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPCLASSIFIED_1", "Yeni bir kullanıcı kaydoldum ve bir sıralamaya yarattı ".EDIRECTORY_TITLE.".");
    //New User Signup (Banner)
    define("LANG_NOTIFY_SIGNUPBANNER", "Yeni Kayıt (Afiş)");
    //A new user has signed up and ordered a banner at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPBANNER_1", "Yeni bir kullanıcı kaydoldum ve bir afiş hazırlandı ".EDIRECTORY_TITLE.".");
    //New User Signup (Article)
    define("LANG_NOTIFY_SIGNUPARTICLE", "Yeni Kayıt (Makaleler)");
    //A new user has signed up and ordered an article at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPARTICLE_1", "Yeni bir kullanıcı kaydoldum ve bir makale hazırlandı ".EDIRECTORY_TITLE.".");
    //Listing Claimed!
    define("LANG_NOTIFY_NEWCLAIM", "Şirket Talep!");
    //A listing has recently been claimed on your site - ".EDIRECTORY_TITLE."!
    define("LANG_NOTIFY_NEWCLAIM_1", "Bir şirket senin dizinde istendi - ".EDIRECTORY_TITLE."!");
    //To approve the listing, follow the claim link below
    define("LANG_NOTIFY_NEWCLAIM_2", "Aşağıdaki bağlantıyı izleyerek şirketin isteği onaylamak için");
    //Claim ID
    define("LANG_NOTIFY_NEWCLAIM_3", "İstek Kimliği");
    //To preview the listing, follow the listing link below
    define("LANG_NOTIFY_NEWCLAIM_4", "Aşağıda şirketin bağlantıyı izleyerek, şirket görüntülemek için");
    //To see the user's account information follow the account link below
    define("LANG_NOTIFY_NEWCLAIM_5", "Kullanıcı hesabının bilgilerini görüntülemek için, takip hesabı aşağıdaki bağlantıyı");
    //Account Details for the listing owner
    define("LANG_NOTIFY_NEWCLAIM_6", "Şirketin sahibi Hesap ayrıntıları");
    //New Signup (Via Mobile)
    define("LANG_NOTIFY_NEWACCOUNTAPP", "Yeni Kayıt (Mobil Uygulama Via)");
    //A new user has joined ".EDIRECTORY_TITLE." via the mobile app.
    define("LANG_NOTIFY_NEWACCOUNTAPP_1", "Kayıtlı yeni bir kullanıcı ".EDIRECTORY_TITLE." kendi mobil uygulama aracılığıyla.");
    //Account information included below for your convenience:
    define("LANG_NOTIFY_NEWACCOUNTAPP_2", "Size kolaylık sağlamak için hesap bilgileri aşağıda:");
	//You received a new lead through the enquire form. To view the lead, follow the link below.
	define("LANG_NOTIFY_NEWLEAD", "Bu sorgulama formu ile lead bir yol aldı. Ilanın detaylarını görmek için aşağıdaki bağlantıyı takip edin.");

	# ----------------------------------------------------------------------------------------------------
	# MOBILE VERSION
	# ----------------------------------------------------------------------------------------------------
	//We have an app for that!
	define("LANG_MOBILE_APP", "Biz bunun için bir uygulama var!");
	//Grab the eDirectory App for iPhone
	define("LANG_MOBILE_GRAB_APP_IPHONE", "iPhone eDirectory App tut.");
	//In Google Play
	define("LANG_MOBILE_GRAB_APP_ANDROID", "Google Play'de");
	//Available on the
	define("LANG_MOBILE_APP_STORE", "Üzerinde kullanılabilir");
	//ANDROID APP ON
	define("LANG_MOBILE_APP_ANDROID", "ANDROID APP AÇIK");
    //Recently added listings
    define("LANG_MOBILE_RECENT_LISTINGS", "Son eklenen listeleri");
    //View full site
    define("LANG_MOBILE_FULLSITE", "Siteye görüntüle");
    //Download App
    define("LANG_MOBILE_DOWNLOAD_APP", "App indir");
    //Use the following code:
    define("LANG_MOBILE_DEAL_USECODE", "Şu kodu kullanın:");
    //REDEEMED
    define("LANG_MOBILE_DEAL_REDEEMED", "ALINAN");
    //Please login to redeem
    define("LANG_MOBILE_DEAL_LOGIN", "Kurtarmak için giriş yapın.");

    # ----------------------------------------------------------------------------------------------------
	# ARCAMAILER
	# ----------------------------------------------------------------------------------------------------
    //Sign up for our Newsletter
    define("LANG_ARCAMAILER_SIGNUP", "Bültenimize kaydolun");
    //Subscribe
    define("LANG_ARCAMAILER_SUBSCRIBE", "Katılmak");
	//Subscribe to our monthly newsletter, no spam, just product updates.
	define("LANG_ARCAMAILER_SUBSCRIBE_TIP", "Bizim aylık bülten, hiçbir spam, sadece ürün güncellemeleri abone olun.");
    //Please, type your name and e-mail.
    define("LANG_ARCAMAILER_SUBSCRIBEERROR", "Adınızı ve e-posta yazın lütfen.");
    //Check your e-mail to complete your subscription.
    define("LANG_ARCAMAILER_SUBSCRIBEDONE", "Aboneliğinizi tamamlamak için e-posta kontrol edin.");

    # ----------------------------------------------------------------------------------------------------
	# GENERAL
	# ----------------------------------------------------------------------------------------------------
    //Changing this will lose any unsaved changes made to this form.
    define("LANG_CONFIRM_CHANGE_LEVEL", "Seviye değişen bu formu yapılan kaydedilmemiş değişiklikleri kaybedersiniz.");

	# ----------------------------------------------------------------------------------------------------
	# DINING GUIDE
	# ----------------------------------------------------------------------------------------------------
    //Top Listing
    define("LANG_LABEL_TOP_LISTING", "Liste Bulunuyor");
    //Featured Deal
    define("LANG_LABEL_FEATURED_DEAL", "Teklifi Bulunuyor");
    //Popular Reviews
    define("LANG_LABEL_POPULAR_REVIEW", "Popüler Yorumlar");
	//Helpful Reviews
	define("LANG_LABEL_HELPFUL_REVIEWS", "Faydalı Yorumlar");
    //Keep Reading
    define("LANG_LABEL_KEEP_READING", "Okumaya Devam");
    //Best Of
    define("LANG_MENU_BESTOF", "En Iyi");
    //By Cuisine
    define("LANG_MENU_BYCUISINE", "Mutfağa Göre");
    //By Location
    define("LANG_MENU_BYLOCATION", "Yere Göre");
    //Sign up | Login
    define("LANG_MENU_SIGNUPLOGIN", "Giriş | Kayıt");
    //Forgot?
    define("LANG_LABEL_FORGOT", "Mi unuttunuz?");
    //Not a member? Sign up now
    define("LANG_LABEL_SIGNUPNOW", "Üye değil misiniz? Şimdi kaydolun");
	//Price range
	define("LANG_LABEL_PRICE_RANGE", "Fiyat aralığı");
	//Need a Specific Category?
	define("LANG_LABEL_SPECIFIC_CATEG", "Belirli Bir Kategori ihtiyacınız var?");
	//Show [x] Reviews
	define("LANG_LABEL_SHOW_REVIEWS", "[x] Yorumlar göster");
	//Filter by
	define("LANG_LABEL_FILTERBY", "Göre Filtre");
	//Filter by Category
	define("LANG_LABEL_FILTERBY_CATEGORY", "Kategori Filtre");
	//Keyword to search...
	define("LANG_LABEL_KEYWORDSEARCH", "Kelimeler arama...");
	//Location to search...
	define("LANG_LABEL_LOCATIONSEARCH", "Arama Yer...");
	//See All Locations
	define("LANG_LABEL_SEE_LOCATIONS", "Tüm yerler görmek");
	//Clear Selections
	define("LANG_LABEL_CLEAR_SELECT", "Açık Seçimleri");
	//Close Advanced Search
	define("LANG_LABEL_ADVSEARCH_CLOSE", "Gelişmiş ara Şehir");
	//Offers & Deals
	define("LANG_LABEL_DEAL_FILTER", "Teklifler ve Fiyatları");
	//Cuisine
	define("LANG_LABEL_CUISINE", "Mutfağı");
	//List View
	define("LANG_LABEL_LISTVIEW", "Listesinde");
	//Map View
	define("LANG_LABEL_MAPVIEW", "Harita");
	//Give us a moment, we're loading in your results.
	define("LANG_LABEL_LOADINGMAP", "Bize biraz izin verir, biz sonuçları yüklüyorsanız.");
	//Valid for
    define("LANG_LABEL_FILTER_VALID_FOR", "için geçerlidir");
    //Ends in less than 24 hours
    define("LANG_LABEL_FILTER_ENDS_IN_LESS_THAN_24_HOURS", "Az 24 saat içinde bitiyor?");
    //Valid for more than 2 days
    define("LANG_LABEL_FILTER_VALID_FOR_MORE_THAN_2_DAYS", "En fazla 2 gün için geçerlidir");
    //Valid for more than a week
    define("LANG_LABEL_FILTER_VALID_FOR_MORE_THAN_A_WEEK", "Bir haftadan daha uzun için geçerlidir");
	//filter
	define("LANG_LABEL_FILTER", "filtre");
    //Show more categories
    define("LANG_LABEL_FILTER_SHOW_MORE_CATEGORIES", "Daha fazla kategori göster");
    //Show more locations
    define("LANG_LABEL_FILTER_SHOW_MORE_LOCATIONS", "Daha fazla yerde göster");
    //Showing [NUMBER_EDIR] for KEYWORD_EDIR in LOCATION_EDIR
    define("LANG_LABEL_FILTER_SHOWING_RESULTS_WITH_KEYWORD_AND_LOCATION", "LOCATION_EDIR içinde KEYWORD_EDIR için [NUMBER_EDIR] arası");
    //Showing [NUMBER_EDIR] for KEYWORD_EDIR
    define("LANG_LABEL_FILTER_SHOWING_RESULTS_WITH_KEYWORD", "[NUMBER_EDIR] için KEYWORD_EDIR gösteriliyor");
    //Map view is only available for result sets with less than [MAX_MARKERS] items. Use filters to refine
    define("LANG_LABEL_FILTER_MAP_MORE_THAN_1000_RESULTS", "Harita görünümü [MAX_MARKERS] listeleri daha az olan sonuç kümeleri için kullanılabilir. Daraltmak için filtreleri kullanın");
    //No Matches
    define("LANG_LABEL_FILTER_NO_MATCHES", "Hiçbir Maçlar");
    //Clear Filters
    define("LANG_LABEL_FILTER_SHOW_ORIGINAL_SEARCH", "Orijinal arama göster");

	# ----------------------------------------------------------------------------------------------------
	# LEADS
	# ----------------------------------------------------------------------------------------------------
	//Lead
	define("LANG_LABEL_LEAD", "Lead");
	//Leads
	define("LANG_LABEL_LEADS", "Leads");
	//Click here to view this item leads
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_LEADS", "Bu öğeyi leads görmek için buraya tıklayın");
	//Manage Leads
	define("LANG_MANAGE_LEADS", "Leads yönetin");
	//No records found.
	define("LANG_NORECORD", "Kayıdı bulunamadı.");
	//Forward
	define("LANG_LABEL_FORWARD", "İleri");
	//Lead successfully deleted!
	define("LANG_LEAD_SUCCESSDELETED", "Başarıyla silindi Lead!");
	//Lead successfully replied!
	define("LANG_LEAD_REPLIED", "Başarılı bir şekilde cevap verdi Lead!");
	//Lead successfully forwarded!
	define("LANG_LEAD_FORWARDED", "Başarılı bir şekilde iletilen Lead!");
	//Please type a message.
	define("LANG_LEAD_TYPEMESSAGE", "Bir mesaj yazın lütfen.");
	//New lead received by
	define("LANG_LEAD_RECEIVED", "Yeni lead tarafından alınan");
	//Replied
	define("LANG_LEAD_REPLIED_ICO", "Cevap");
	//Forwarded
	define("LANG_LEAD_FORWARDED_ICO", "Yönlendirilen");
	//Replied [dater] and Forwarded [datef]
	define("LANG_LEAD_REPLIED_FORWARDED_ICO", "Yanıtladı [dater] ve Yönlendirilen [datef]");
	//Talk to Us
	define("LANG_LEAD_TALKTOUS", "Bize konuşun");
	//Your first name
	define("LANG_LEAD_FIRSTNAME", "Adınız");
	//Your last name
	define("LANG_LEAD_LASTNAME", "Soyadınız");
	//Your email, please?
	define("LANG_LEAD_EMAIL", "E-posta, lütfen?");
	//Add your phone number
	define("LANG_LEAD_PHONE", "Telefon numaranızı ekle");
	//Company/Organization
	define("LANG_LEAD_COMPANY", "Kurum / Kuruluş");
	//What kind of service do you need?
	define("LANG_LEAD_MESSAGE", "Servis Ne tür ihtiyacım var?");
	//Please type your first name and last name.
	define("LANG_LEAD_TYPE_NAME", "Adınızı ve soyadınızı giriniz.");
	//Thank you, we will be in touch shortly.
	define("LANG_LEAD_THANKYOU", "Teşekkür ederiz, biz kısa bir süre temas halinde olacaktır.");
	//New Enquire
	define("LANG_LEAD_ENQUERY", "Yeni Sorgula");
	//General Lead
	define("LANG_GENERAL_LEAD", "Genel Lead");

	# ----------------------------------------------------------------------------------------------------
	# LOG IN / SIGN UP / MEMBERS
	# ----------------------------------------------------------------------------------------------------
	//Are you a Sponsor?
	define("LANG_AREYOU_SPONSOR_AREA", "Bir Sponsoru misiniz?");
	//List your business today
	define("LANG_AREYOU_SPONSOR_AREA_2", "Bugün Liste işiniz");
	//Find Us
	define("LANG_FIND_US", "Bizi bul");
	//or if you already have an account login below
	define("LANG_OR_SIGNUPACCOUNT", "ya zaten aşağıda bir hesap giriş varsa");
	//Or log in using your e-mail address
	define("LANG_OR_SIGNINEMAIL", "veya e-posta adresini kullanarak oturum ");
	//Or sign up using your e-mail address
	define("LANG_OR_SIGNUPEMAIL", "veya e-posta adresini kullanarak kayıt");
	//Are you a sponsor? Go to our sponsor area
	define("LANG_GO_TO_SPONSOR_AREA", "Bir sponsor mısınız? Bizim sponsor alana git");
	//By creating an account, I accept the Terms of Use.
	define("LANG_ACCEPT_TERMS", "Bir hesap oluşturarak Ben [a]Kullanım koşulları kabul edin[/a].");
	//Sponsor Area
	define("LANG_LABEL_SPONSORAREA", "Sponsor Alanı");
	//Log in to the Sponsor Area
	define("LANG_LABEL_LOGIN_SPONSORAREA", "Sponsor Alanı için login");
	//Already a member - Log in here.
    define("LANG_LABEL_ALREADY_MEMBER", "Zaten üye - buradan giriş yapın.");
	//Reference
	define("LANG_LABEL_REFERENCE", "Referans");
	//Got an enquiry or something you're stuck on? Send us a message. We'll get back to you as soon as we can.
	define("LANG_HELP_MESSAGE", "Bir soruşturma veya üzerinde sıkışmış bir şey var mı? Bize bir mesaj gönderin. Biz en kısa sürede biz size geri alırsınız.");
	//Add a new content
	define("LANG_ADD_NEW_CONTENT", "Yeni bir içerik ekleme");
	//You don't have any content yet.
	define("LANG_ADD_NEW_CONTENT2", "Henüz herhangi bir içerik yoktur.");
	//Add your business today, it's quick and simple!
	define("LANG_ADD_NEW_CONTENT2_TIP", "Bugün işinizi ekleyin, hızlı ve basit!");
	//Remove
	define("LANG_LABEL_REMOVE", "Kaldırmak");
	//View on Website
	define("LANG_LABEL_VIEW_LIVE", "Web görüntüle");
	//Preview
	define("LANG_LABEL_PREVIEW", "Önizleme");
	//Expires in
	define("LANG_LABEL_EXPIRESON", "Bitiş");
	//until it expires
	define("LANG_LABEL_UNTILEXPIRES", "süresi dolmadan");
	//impressions left
	define("LANG_LABEL_IMPRESSIONS_LEFT", "sol izlenimler");
	//Billing
	define("LANG_LABEL_BILLING", "Fatura");
	//was successfully deleted!
	define("LANG_LABEL_WASSUCCESSDELETED", "başarıyla silindi!");
	//Deal not linked
	define("LANG_LABEL_NOTLINKED", "Deal bağlantılı değildir");
	//Increase Visibility
	define("LANG_LABEL_INCREASEVISIBILITY", "Görüş artırın");
	//Renew Now
	define("LANG_LABEL_RENEW", "Şimdi Yenileyin");
	//Add basic information
	define("LANG_LABEL_GAMEFY_DESC", "Temel bilgileri ekleme");
	//Add photos or video
	define("LANG_LABEL_GAMEFY_MEDIA", "Fotoğraf ya da video eklemek");
	//Add additional information
	define("LANG_LABEL_GAMEFY_ADDITIONAL", "Ek bilgi ekleyin");
	//Share and get more reviews
	define("LANG_LABEL_DASHBOARD_SHARE", "Paylaşın ve daha değerlendirmeleri almak");
	//Share and get more leads
	define("LANG_LABEL_DASHBOARD_SHARE2", "Paylaşın ve daha fazla yol almak");
	//Share and get more redeems
    define("LANG_LABEL_DASHBOARD_SHARE3", "Daha fazla kupon oluşturmak için paylaş");
	//Review by
	define("LANG_LABEL_REVIEWBY", "Yorum tarafından");
	//Reply this
	define("LANG_LABEL_REPLYTHIS", "Bu cevap");
	//Write your reply
    define("LANG_LABEL_WRITE_REPLY", "Cevabınızı yazın");
	//Activity Report
	define("LANG_LABEL_ACTIVITYREPORT", "Faaliyet Raporu");
	//See all reviews
	define("LANG_LABEL_SEE_REVIEWS", "Tüm yorumlarını göster");
	//See all leads
	define("LANG_LABEL_SEE_LEADS", "Tüm yol bak");
	//Statistics
	define("LANG_LABEL_STATISTICS", "Istatistik");
	//Total Viewers
	define("LANG_LABEL_TOTALVIEWERS", "Toplam Görüntüleyenler");
	//Phone Views
	define("LANG_LABEL_PHONEVIEWS", "Telefon İzlenme");
	//Website Views
	define("LANG_LABEL_WEBSITEVIEWS", "Web İzlenme");
	//Fax Views
	define("LANG_LABEL_FAXVIEWS", "Faks İzlenme");
	//Phone View
	define("LANG_LABEL_PHONEVIEW", "Telefon Görüntüle");
	//Website View
	define("LANG_LABEL_WEBSITEVIEW", "Web Görünümü");
	//Fax View
	define("LANG_LABEL_FAXVIEW", "Faks Görüntüle");
	//View more stats
	define("LANG_LABEL_VIEW_MORE_STATS", "Daha istatistiklerini görüntüle");
	//Stats
	define("LANG_LABEL_STATS", "İstatistikler");
	//Listing Completion
    define("LANG_LABEL_LISTING_COMPLETION", "Listeler Bilgisi");
    //Event Completion
    define("LANG_LABEL_EVENT_COMPLETION", "Aktivite Bilgisi");
    //Classified Completion
    define("LANG_LABEL_CLASSIFIED_COMPLETION", "İlan Bilgisi");
    //Article Completion
    define("LANG_LABEL_ARTICLE_COMPLETION", "Makale Bilgisi");
	//Deal Completion
    define("LANG_LABEL_PROMOTION_COMPLETION", "İntifa Bilgisi");
    //You're not quite done with your item.
    define("LANG_LABEL_GAMEFY_TIP", "Bu oldukça öğe ile bitmedi.");
	//What are you looking for today?
	define("LANG_LABEL_PROFILE_TIP1", "Eğer bugün için ne arıyoruz?");
	//Thank you for being part of EDIRECTORY_TITLE. Join our community by giving your opinion and evaluating your favorite listings.
	define("LANG_LABEL_PROFILE_TIP2", EDIRECTORY_TITLE." parçası olmak için teşekkür ederiz. Düşüncelerinizi veren ve favori listeleri değerlendirerek bizim topluluğuna katılın.");
	//Oh wait...
	define("LANG_LABEL_PROFILE_TIP3", "Üzgünüm...");
	//This user has no activity in our portal yet. Don't worry. You can still join our community by giving your opinion and evaluating your favorite listings.
	define("LANG_LABEL_PROFILE_TIP4", "Bu kullanıcı henüz bizim portalımızda hiçbir aktiviteye sahiptir.<br>Merak etmeyin. Hala fikir veren ve favori listeleri değerlendirerek topluluğumuza katılabilirsiniz.");
	//Rated
	define("LANG_LABEL_RATED", "Anma");
	//Commented
	define("LANG_LABEL_COMMENTED", "Yorumlanan");
	//Redeemed deal
	define("LANG_LABEL_REDEEMED", "İntifa anlaşma");
	//Your redeem code is
	define("LANG_LABEL_DEAL_CODE", "Sizin kurtarmak kodu");
	//View previous activities
	define("LANG_PREVIOUS_ACTIVITY", "Önceki faaliyet görüntüle");
	//with
	define("LANG_WITH", "ile");
	//Redeemed by
	define("LANG_LABEL_REDEEMED_BY", "İntifa");
	//You received [x] new review
	define("LANG_LABEL_NEW_REVIEW", "Sen [x] yeni eleştiri aldı");
	//You received [x] new reviews
	define("LANG_LABEL_NEW_REVIEWS", "Sen [x] yeni yorumları aldı");
	//You received [x] new lead
	define("LANG_LABEL_NEW_LEAD", "Sen [x] yeni galibiyeti aldı");
	//You received [x] new leads
	define("LANG_LABEL_NEW_LEADS", "Sen [x] yeni yol aldı");

	# ----------------------------------------------------------------------------------------------------
	# NEW ADD MODULES FORMS
	# ----------------------------------------------------------------------------------------------------
	//Você pode mudar suas [a]configurações de níveis e preços[/a] quando quiser.
	define("LANG_SELECTLEVEL_TIP", "È possibile modificare le impostazioni di [a]e il livello dei prezzi[/a] ogni volta che si desidera.");
	//Com os [a]tipos de empresa[/a], você pode escolher diferentes layouts para a página de detalhes de suas empresas, criar campos extras e muito mais.
	define("LANG_SELECT_LISTINGTEMPLATE_TIP", "Con [a]tipo di società[/a], è possibile scegliere diversi layout per la pagina di informazioni generali per il vostro business, creare campi aggiuntivi e altro ancora.");
	//Salvar Alterações
	define("LANG_SAVE_CHANGES", "Salva modifiche");
	//Digite o nome de sua empresa aqui.
	define("LANG_HOLDER_LISTINGTITLE", "Inserire il nome della vostra azienda qui.");
	//Digite o nome de sua oferta aqui.
	define("LANG_HOLDER_PROMOTIONTITLE", "Inserire il nome della vostra offerta qui.");
	//Digite o nome de seu banner aqui.
	define("LANG_HOLDER_BANNERTITLE", "Immettere il nome del tuo banner qui.");
	//Digite o nome de seu evento aqui.
	define("LANG_HOLDER_EVENTTITLE", "Immettere il nome del vostro evento qui.");
	//Digite o nome de seu classificado aqui.
	define("LANG_HOLDER_CLASSIFIEDTITLE", "Immettere il nome del vostro classificati qui.");
	//Digite o nome de seu artigo aqui.
	define("LANG_HOLDER_ARTICLETITLE", "Immettere il nome del vostro articolo qui.");
	//Digite o nome de seu post aqui.
	define("LANG_HOLDER_BLOGTITLE", "Immettere il nome del tuo post qui.");
	//Informações Básicas
	define("LANG_BASIC_INFO", "Informazioni di Base");
	//Clique no botão à direita para selecionar as categorias.
	define("LANG_SELECT_CATEGORIES", "Fare clic sul pulsante a destra per selezionare categorie.");
	//Adicionar categorias
	define("LANG_ADD_CATEGORIES", "Aggiungi categorie");
	//Breve descrição da empresa.
	define("LANG_HOLDER_LISTINGSUMMARY", "Breve descrizione della società.");
	//Apresente a empresa ao público de forma clara e eficiente. Descreva todas as características que tornam o estabelecimento único e uma ótima opção para os clientes.
	define("LANG_HOLDER_LISTINGDESCRIPTION", "Introdurre l'azienda al pubblico in modo chiaro ed efficace. Descrivere tutte le caratteristiche che rendono la proprietà unica e una grande opzione per i clienti.");
	//Breve descrição da oferta.
	define("LANG_HOLDER_PROMOTIONSUMMARY", "Breve descrizione dell'offerta.");
	//Apresente a promoção ao público de forma clara e eficiente. Descreva todas as características que a fazem valer a pena.
	define("LANG_HOLDER_PROMOTIONDESCRIPTION", "Introdurre la promozione al pubblico in modo chiaro ed efficace. Descrivere tutte le caratteristiche che lo rendono interessante.");
	//Breve descrição do evento.
	define("LANG_HOLDER_EVENTSUMMARY", "Breve descrizione dell'evento.");
	//Apresente o evento ao público de forma clara e eficiente. Descreva os principais destaques e características que atrairão as pessoas.
	define("LANG_HOLDER_EVENTDESCRIPTION", "Invia l'evento al pubblico in modo chiaro ed efficace. Descrivere i punti principali e le caratteristiche in grado di attrarre le persone.");
	//Breve descrição do classificado.
	define("LANG_HOLDER_CLASSIFIEDSUMMARY", "Breve descrizione del classificate.");
	//Apresente o classificado ao público de forma clara e eficiente. Descreva os principais destaques e características que farão as pessoas quererem comprar o seu produto/serviço.
	define("LANG_HOLDER_CLASSIFIEDDESCRIPTION", "Presente classificati al pubblico in modo chiaro ed efficace. Descrivere i punti principali e le caratteristiche che renderanno la gente vuole comprare il vostro prodotto / servizio.");
	//Resumo do artigo.
	define("LANG_HOLDER_ARTICLESUMMARY", "Sommario dell'articolo.");
	//Type your keyword. Press 'Tab' or 'Enter' on your keyboard to confirm.
	define("LANG_HOLDER_KEYWORDS", "Inserisci la parola chiave e premere 'Tab' per confermarla.");
	//Utilize este campo para destacar algumas características que a sua empresa tem a oferecer. Digite um item por linha.
	define("LANG_HOLDER_FEATURES", "Utilizzare questo campo per mettere in evidenza alcune caratteristiche che la vostra azienda ha da offrire. Inserire un elemento per riga.");
	//Você tem um código de desconto? Digite-o aqui.
	define("LANG_HOLDER_DISCOUNTCODE", "Hai un codice sconto? Inseriscilo qui.");
	//Cole a URL do vídeo aqui. Ex: http://www.youtube.com/watch?v=xxxx
	define("LANG_HOLDER_VIDEO", "Incollare l'URL del video qui. Es: http://www.youtube.com/watch?v=xxxx");
	//Breve descrição do seu vídeo.
	define("LANG_HOLDER_VIDEOCAPTION", "Breve descrizione del tuo video.");
	//O link para download do arquivo será mostrado desta forma.
	define("LANG_HOLDER_ATTACHCAPTION", "Il link per il download per il file verrà mostrato in questo modo.");
	//Deseja alterar suas classificações? Clique aqui.
	define("LANG_HOLDER_BADGES", "Vuoi cambiare le loro valutazioni? Clicca qui.");
	//Type here the terms & conditions for redeeming your deal.
	define("LANG_HOLDER_PROMOTIONCONDITIONS", "Burada anlaşma kurtarıcı için şartlar ve koşullar yazın.");
	//Não foi possível carregar o vídeo. Por favor, verifique a URL do vídeo e tente novamente.
	define("LANG_VIDEO_NOTFOUND", "Impossibile caricare video. Si prega di verificare l'URL del video e riprovare.");
	//Você pode selecionar até [max] categorias.
	define("LANG_SELECTMAX_CATEGORIES", "È possibile selezionare fino a [Max] categorie.");
	//Por favor, aguarde...
	define("LANG_LABEL_FORM_WAIT", "Attendere prego ...");
	//Título da Imagem
	define("LANG_LABEL_IMAGE_TITLE", "Titolo di immagine");
	//Descrição da imagem
	define("LANG_LABEL_IMAGE_DESCRIPTION", "Image description");
	//Recorte da Imagem & Descrição
	define("LANG_LABEL_IMAGE_CROP", "Ritaglio immagine e descrizione");
	//Recorte
	define("LANG_LABEL_IMAGE_CROPPING", "Tagliare");
	//Tipo de Desconto
	define("LANG_LABEL_DISCOUNT_TYPE", "Tipo di sconto");
	//Precisa de ajuda? Dê uma olhada no tutorial.
	define("LANG_LABEL_TUTORIAL", "Hai bisogno di aiuto? Date un'occhiata al tutorial.");
	//Guia de Campos
	define("LANG_LABEL_TUTORIAL_FIELDS", "Guida Campi");
	//Fechar Tutorial
	define("LANG_LABEL_TUTORIAL_END", "Fechar Tutorial");
	//Social networks
    define("LANG_LABEL_SOCIALNETWORK", "Sosyal ağlar");
	//This is the Title that identifies your item on the site. Keep it brief, yet effective.
	define("LANG_LABEL_TUTORIAL_TOUR-TITLE", "Bu sitede öğe tanımlayan Başlığı olduğunu. Kısa, ama etkili tutun.");
	//Choose between different Listing Types that offer varying fields and layouts specific to common listings, or create a new Listing Type that suits your needs.
	define("LANG_LABEL_TUTORIAL_TOUR-TEMPLATE", "Ortak Listeler özel değişen alanlar ve düzenleri teklif veya sizin ihtiyaçlarınıza uygun yeni bir Liste türü oluşturmak farklı Liste türleri arasında seçim.");
	//Choose your item's Level here. Each Level can be customized to offer a different set of features for the item.
	define("LANG_LABEL_TUTORIAL_TOUR-LEVEL", "Burada öğenin düzeyini seçin. Her Seviye öğe için özellikleri farklı bir dizi sunmak için özelleştirilebilir.");
	//Choose the Categories that best fit your item. Visitors will find your item easily by browsing under specific Categories.
	define("LANG_LABEL_TUTORIAL_TOUR-CATEGORIES", "En iyi öğeye göre Kategoriler seçin. Ziyaretçiler, belirli Kategoriler altında gezen kolayca öğe bulabilirsiniz.");
	//This is the account that owns the item. You can change it to another account or leave your item with no owner.
	define("LANG_LABEL_TUTORIAL_TOUR-OWNER", "Bu öğeye sahip hesaptır. Sen başka bir hesaba değiştirmek veya sahibi ile madde bırakabilirsiniz.");
	//Activated items will be available on the results page. Pending items have just been added to the site and are awaiting approval. Expired items have gone past their renewal date without payment and lastly, you can temporarily make an items Suspended at your choosing.
	define("LANG_LABEL_TUTORIAL_TOUR-STATUS", "Aktif ürün sonuçları sayfasında mevcut olacaktır. Bekleyen öğeler sadece siteye eklendi ve onay bekliyor. Süresi Doldu ürün ödemeksizin kendilerini yenileme tarihi geçmiş gitmiş ve son olarak, geçici olarak dilemesiyle Asma bir ürün yapabilirsiniz.");
	//You can manually set the Renewal Date for an items to set when the next payment is due.
	define("LANG_LABEL_TUTORIAL_TOUR-EXPIRATION", "El bir sonraki ödeme ne zaman bir ürün ayarlamak için Yenileme Tarih ayarlayabilirsiniz.");
	//Check this box to disable the claim feature and not allow owners to claim their Liste. Leave it blank if you want to allow users to claim their Liste.
	define("LANG_LABEL_TUTORIAL_TOUR-CLAIM", "Iddia özelliğini devre dışı bırakmak için bu kutuyu işaretleyin ve sahipleri Liste iddia izin vermeyin. Boş kullanıcıların kendi Liste etmesine izin vermek istiyorsanız, bırakın.");
	//This field is shown on the results page and briefly describes your item.
	define("LANG_LABEL_TUTORIAL_TOUR-SUMMARY", "Bu alan sonuçları sayfasında gösterilen ve kısaca öğeyi açıklar.");
	//Add more details about your item on this field. This full description will be shown on the item's detail page.
	define("LANG_LABEL_TUTORIAL_TOUR-DESCRIPTION", "Bu alan üzerinde bir öğe ile ilgili daha fazla ayrıntı ekleyin. Bu, tam açıklama öğenin detay sayfasında gösterilecektir.");
	//You can tag specific keywords in this field. Keywords will help users to find your item when searching on the site.
	define("LANG_LABEL_TUTORIAL_TOUR-KEYWORDS", "Bu alanda belirli anahtar kelimeler etiketleyebilirsiniz. Anahtar Kelimeler sitede arama yaparken kullanıcıların öğeyi bulmak için yardımcı olacaktır.");
	//In this section you can add all the information for your item's location and contact. The more complete, the easier it is for customers to get in touch with you.
	define("LANG_LABEL_TUTORIAL_TOUR-CONTACT", "Bu bölümde size öğenin konumu ve temas için tüm bilgiler ekleyebilirsiniz. Müşterilerinizin sizinle temasa geçmek için daha tam, daha kolay olduğunu.");
	//Use this field to add a location reference for your Liste. For example, two blocks from the mall.
	define("LANG_LABEL_TUTORIAL_TOUR-REFERENCE", "Senin Liste için bir konum başvuru eklemek için bu alanı kullanın. Örneğin, alışveriş merkezi iki blok.");
	//Does your event have a Facebook page? Type it here to show the Facebook wall widget on the event's detail page.
	define("LANG_LABEL_TUTORIAL_TOUR-FACEBOOK", "Etkinlik bir Facebook sayfası var mı? olaylar detay sayfasındaki Facebook duvar widget'ı göstermek için burada yazın.");
	//Use this field to highlight some features of your business or add any additional useful information, what makes it special.
	define("LANG_LABEL_TUTORIAL_TOUR-FEATURES", "İşinizin bazı özelliklerini vurgulamak ya da özel kılan herhangi bir ek yararlı bilgiler eklemek için bu alanı kullanın.");
	//Type the hours of work for your business here.
	define("LANG_LABEL_TUTORIAL_TOUR-HOURS", "Burada işiniz için çalışma saatleri yazın.");
	//If applicable, use this field to describe the average price for your products or services.
	define("LANG_LABEL_TUTORIAL_TOUR-PRICE", "Mümkünse, ürün veya hizmetler için ortalama fiyatını açıklamak için bu alanı kullanabilirsiniz.");
	//Have a discount or promotional code? Type it here. The item's next payment will be affected.
	define("LANG_LABEL_TUTORIAL_TOUR-DISCOUNT", "Bir indirim veya promosyon kodu var? Buraya yazın. Öğenin bir sonraki ödeme etkilenecektir.");
	//Use this box to drop and add images. You can click on a image to adjust the cropping and edit the title and description.
	define("LANG_LABEL_TUTORIAL_TOUR-IMAGES", "Damla ve görüntüleri eklemek için bu kutuyu kullanın. Sen kırpma ayarlayın ve başlık ve açıklamasını düzenlemek için resmin üzerine tıklayabilirsiniz.");
	//Copy and paste your video URL here. Add a brief description to say what your video is about.
	define("LANG_LABEL_TUTORIAL_TOUR-VIDEO", "Kopyalayın ve burada video URL'sini yapıştırın. Video hakkında ne söylemek için kısa bir açıklama ekleyin.");
	//Use this field to attach an additional file. Use it for a Menu, Product Brochure, or whatever you'd like.
	define("LANG_LABEL_TUTORIAL_TOUR-FILE", "Ek bir dosya eklemek için bu alanı kullanın. Eğer istediğiniz bir Menü, Ürün Broşürü, ya da ne için kullanın.");
	//You can help your owners to promote their businesses by designating badges for them.
	define("LANG_LABEL_TUTORIAL_TOUR-BADGES", "Onlar için rozetleri atayarak işlerini geliştirmek için sahiplerine yardımcı olabilir.");
	//Use this section to set some more additional information for your business.
	define("LANG_LABEL_TUTORIAL_TOUR-ADDITIONAL", "Işiniz için biraz daha ek bilgileri ayarlamak için bu bölümü kullanın.");
	//Deals should be assigned to a Liste in order to be shown on the results. Use this box to select a Liste
	define("LANG_LABEL_TUTORIAL_TOUR-LISTING", "Teklifler sonuçlarına gösterebilmek için bir Liste tahsis edilmelidir. Bir Liste seçmek için bu kutuyu kullanın");
	//This field is pre-filled with a default text that describes the terms of use and conditions to redeem a deal. You can change it to whatever you need.
	define("LANG_LABEL_TUTORIAL_TOUR-CONDITIONS", "Bu alan bir Teklif kurtarmak için kullanımı ve koşulları koşullarını açıklayan bir varsayılan metin ile önceden doldurulur. Size ihtiyacınız ne olursa olsun bunu değiştirebilirsiniz.");
	//Use this section to set when the deal will be available. After the end date hits, it will no longer be shown in any results.
	define("LANG_LABEL_TUTORIAL_TOUR-DATE2", "Teklif zaman kullanılabilir olacak ayarlamak için bu bölümü kullanın. Bitiş tarihi hitlerinden sonra, artık herhangi bir sonuç gösterilir.");
	//Use this box to add and edit an image for your deal.
	define("LANG_LABEL_TUTORIAL_TOUR-IMAGE", "Ekleyebilir ve Teklif için bir görüntüyü düzenlemek için bu kutuyu kullanın.");
	//Use this section to set when your event is taking place. You can also use the Recurring checkbox to save an event that will be repeating on a regular basis.
	define("LANG_LABEL_TUTORIAL_TOUR-DATE", "Senin Aktivite gerçekleşiyor zaman ayarlamak için bu bölümü kullanın. Ayrıca düzenli olarak yinelenen olacak bir Aktivite kaydetmek için Dönüşümlü onay kutusunu kullanabilirsiniz.");
	//Type the body of your article here. You can use the editor to format the text, add images, etc.
	define("LANG_LABEL_TUTORIAL_TOUR-CONTENT", "Burada Makale gövdesini yazın. Sen görüntüleri eklemek, metni biçimlendirmek için, vb editörü kullanabilirsiniz");
	//Impressions refer to the number of times the banner is shown on the frontend pages.
	define("LANG_LABEL_TUTORIAL_TOUR-IMPRESSIONS", "Gösterimler afiş önyüzü sayfalarda gösterilir kez sayısına bakın.");
	//Use this field to identify the article's author.
	define("LANG_LABEL_TUTORIAL_TOUR-AUTHOR", "Makale yazarı tanımlamak için bu alanı kullanın.");
	//If the article's author has a website, you can type it in here.
	define("LANG_LABEL_TUTORIAL_TOUR-AUTHORURL", "Makale yazarı bir web sitesi varsa, buradan yazabilirsiniz.");
	//Set the publication date for the article here.
	define("LANG_LABEL_TUTORIAL_TOUR-PUBLICATION", "Burada Makale için yayın tarihi ayarlayın.");
	//Use this field to give a quick overview of the article.
	define("LANG_LABEL_TUTORIAL_TOUR-ABSTRACT", "Makale hızlı bir bakış vermek için bu alanı kullanın.");
	//Does your business have a profile in any of these social medias? Type it here to show buttons to your profiles on the detail page. For Facebook, the wall widget will also be shown.
	define("LANG_LABEL_TUTORIAL_TOUR-SOCIALNETWORK", "Iş bu sosyal medya herhangi bir profil var mı? ayrıntı sayfasında profillerine düğmeleri göstermek için burada yazın. Facebook için, duvar widget da gösterilir.");
	//Select an option below
	define("LANG_CHOOSE_DEAL_ATTACH", "Aşağıdan bir seçeneği seçin");
	//No deals available for association with this listing. In order to be linked to this listing, the deal should not be associated with other listing and should belong to the same account.
	define("LANG_ATTACHDEAL_UNAVAILABLE", "Bu liste ile birlikte kullanılabilir yok fiyatlar. Sipariş Bu firma ile bağlantılı In, anlaşma, diğer liste ile ilişkili olmamalı ve aynı hesaba ait olmalıdır.");
	//No listings available for association with this deal. In order to be linked to this deal, the listing should not be associated with other deal and should belong to the same account.
	define("LANG_ATTACHLISTING_UNAVAILABLE", "Bu anlaşma ile birlikte kullanılabilir Hayır listeleri. Sipariş bu anlaşma ile bağlantılı In, liste, diğer anlaşma ile ilişkili olmamalı ve aynı hesaba ait olmalıdır.");
    // You must associate a listing and a promotion with the same account.
    define("LANG_SITEMGR_ERROR_LISTING_PROMOTION_SITEMGR_ACCOUNT_DIFFER", "Bir liste ve aynı hesapla bir promosyon ilişkilendirmek gerekir.");
	//Leave it blank to unlink the deal.
	define("LANG_ATTACHDEAL_EMPTY", "Boş anlaşma bağlantısını kesmek için bırakın.");
	//Recommended dimensions
	define("LANG_LABEL_RECOMMENDED_DIMENSIONS", "Tavsiye edilen boyutlar");
	//Cover Image
	define("LANG_LABEL_COVERIMAGE", "Kapak Resmi");
	//Thumbnail
	define("LANG_LABEL_THUMBNAIL", "Başparmak tırnağı");
	//Changing the template now will remove the selected categories so far. Do you want to continue?
	define("LANG_CONFIRM_CHANGELISTINGTYPE", "Şimdiye kadar seçilen kategorileri kaldıracaktır şimdi şablonu değiştirme. Devam etmek istiyor musun?");
    // It was selected more classifieds than it is allowed.
    define("LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_QUANTITY", "Daha seçildi ".LANG_CLASSIFIED_FEATURE_NAME_PLURAL." daha o izin verilir.");
    // The association was successfully save.
    define("LANG_SITEMGR_ASSOCIATION_SUCCESSFULLY_SAVE", "Dernek kurtarmak başarıyla yapıldı.");
    // You must associate a listing and a classified with the same account.
    define("LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_SITEMGR_ACCOUNT_DIFFER", "Bir ilişkilendirmek gerekir ".LANG_LISTING." ve ".LANG_CLASSIFIED." aynı hesapla.");
    // Association not allowed.
    define("LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_USER_ACCOUNT_DIFFER", "Dernek izin verilmiyor.");
    // This listing does not support more associations.
    define("LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_QUANTITY", "Bu ".LANG_LISTING." daha ilişkilendirmeleri desteklemez.");
	//Powered by
	define("LANG_POWEREDBY", "Tarafından desteklenmektedir");
    //Select an option below
    define("LANG_CHOOSE_CLASSIFIED_ATTACH", "Aşağıdan bir seçenek belirleyin");
    //Associate an existing classified with this listing
    define("LANG_SITEMGR_CLASSIFIED_ASSOCIATE", "Bu var olan bir ".LANG_CLASSIFIED." ilişkilendirmek ".LISTING_FEATURE_NAME);
    //Leave it blank to unlink the classified
    define("LANG_ATTACHCLASSIFIED_EMPTY", "Boş bağlantısını kaldırmak için bırakın ".LANG_CLASSIFIED.".");
    //Allow classified to be associated with no owner listing
    define("LANG_LABEL_CLASSIFIED_ASSOCIATION", "Izin ver ".LANG_CLASSIFIED." hayır sahibi ile ilişkili olduğu ".LISTING_FEATURE_NAME);
    //This option is just valid when you are adding or editing a classified
    define("LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_CLASSIFIED_ASSOCIATION", "Bu seçenek düzenleme, bir ekleme veya zaman sadece geçerli ".LANG_CLASSIFIED);
    //Welcome back! It's always good to see you here again!
    define("LANG_LABEL_WELCOMEBACK", "Tekrar hoşgeldiniz! Seni bir daha görmek ne güzel!");
    //Sign up today and join our community!
    define("LANG_LABEL_SIGNUPTODAY", "Bugün kaydolun ve topluluğumuza katılın!");
    //Join us today and stay connected to businesses around the world.
    define("LANG_LABEL_JOINUSTODAY", "Bugün bize katılın ve dünyadaki işletmelerle bağlantıda kalın.");
    //With a single login using your computer, tablet, phone or our app!
    define("LANG_LABEL_LOGINEXPLANATION", "Bilgisayarınızı, tabletinizi, telefonunuzu veya uygulamanızı kullanarak tek bir oturum açarak!");
    //Oops, something wrong happened. Please try again or contact us.
	define("LANG_LABEL_ERRORLOGIN", "Bir hatayla oldu. tekrar deneyin ya bize ulaşın.");