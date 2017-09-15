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
	# * FILE: /lang/fr_fr.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DATE/TIME
	# ----------------------------------------------------------------------------------------------------
	//january,february,march,april,may,june,july,august,september,october,november,december
	define("LANG_DATE_MONTHS", "janvier,février,mars,avril,mai,juin,juillet,août,septembre,octobre,novembre,décembre");
	//sunday,monday,tuesday,wednesday,thursday,friday,saturday
	define("LANG_DATE_WEEKDAYS", "dimanche,lundi,mardi,mercredi,jeudi,vendredi,samedi");
	//year
	define("LANG_YEAR", "l'année");
	//years
	define("LANG_YEAR_PLURAL", "les année");
	//month
	define("LANG_MONTH", "le mois");
	//months
	define("LANG_MONTH_PLURAL", "les mois");
	//day
	define("LANG_DAY", "jour");
	//days
	define("LANG_DAY_PLURAL", "jours");
	//#,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z
	define("LANG_LETTERS", "#,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z");
	//y
	define("LANG_LETTER_YEAR", "a");
	//m
	define("LANG_LETTER_MONTH", "m");
	//d
	define("LANG_LETTER_DAY", "j");
	//Hour
	define("LANG_LABEL_HOUR", "Heure");
	//Minute
	define("LANG_LABEL_MINUTE", "Minute");

	# ----------------------------------------------------------------------------------------------------
	# ZIPCODE
	# ----------------------------------------------------------------------------------------------------
	//ZIPCODE_UNIT - Available just for: mile or km
	define("ZIPCODE_UNIT", "km");
	//zipcode
	define("ZIPCODE_LABEL", "code postal");

	# ----------------------------------------------------------------------------------------------------
	# STRING EVENT DATE
	# ----------------------------------------------------------------------------------------------------
	//[MONTHNAME] [DAY][SUFFIX], [YEAR]
	define("LANG_STRINGDATE_YEARANDMONTHANDDAY", "d \d\e F \d\e Y");
	//[MONTHNAME] [YEAR]
	define("LANG_STRINGDATE_YEARANDMONTH", "F \d\e Y");

	# ----------------------------------------------------------------------------------------------------
	# HEADER AND FOOTER LABELS
	# ----------------------------------------------------------------------------------------------------
	//Home
	define("LANG_MENU_HOME", "Accueil");
	//Listings
	define("LANG_MENU_LISTING", "Listes");
	//Events
	define("LANG_MENU_EVENT", "Événements");
	//Banners
	define("LANG_MENU_BANNER", "Bannières");
	//Classifieds
	define("LANG_MENU_CLASSIFIED", "Annonces");
	//Articles
	define("LANG_MENU_ARTICLE", "Articles");
	//Deals
	define("LANG_MENU_PROMOTION", "Offres");
	//Blog
	define("LANG_MENU_BLOG", "Blog");
	//Advertise
	define("LANG_MENU_ADVERTISE", "Publicité");
	//FAQ
	define("LANG_MENU_FAQ", "Questions");
	//Sitemap
	define("LANG_MENU_SITEMAP", "Plan du site");
	//Contact Us
	define("LANG_MENU_CONTACT", "Contacter");
	//Enquire
	define("LANG_MENU_ENQUIRE", "Renseignez-vous");
	//Tell us about your project
	define("LANG_MENU_ENQUIRE2", "Parlez-nous de votre projet");
	//Find us on LinkedIn
	define("LANG_ALT_LINKEDIN", "Retrouvez-nous sur LinkedIn");
	//Find us on Facebook
	define("LANG_ALT_FACEBOOK", "Retrouvez-nous sur Facebook");
	//Like Us on Facebook
	define("LANG_LIKE_FACEBOOK", "Aimez-nous sur Facebook");
	//Links
	define("LANG_LINKS", "Liens");
	//Contact
	define("LANG_FOOTER_CONTACT", "Contact");
	//Twitter
	define("LANG_TWITTER", "Twitter");
	//Twitter Updates
	define("LANG_TWITTER_UPDATES", "Mises à jour de Twitter");
	//Follow us on Twitter
	define("LANG_FOLLOW_US_TWITTER", "Suivez-nous sur Twitter");
	//Follow Us
	define("LANG_FOLLOW_US", "Suivez-nous");
	//Send Us a message
    define("LANG_CONTACT_SENDMSG", "Envoyez-nous un message");
	//Site Content
    define("LANG_SITE_CONTENT", "Contenu du Site");
	//Learn More
	define("LANG_LABEL_LEARN_MORE", "Savoir Plus");
	//Download our App
	define("LANG_LABEL_DOWNLOAD_APP", "Téléchargez notre <b>App</b>");

	# ----------------------------------------------------------------------------------------------------
	# JAVASCRIPT LANGUAGES VARIABLES
	# ----------------------------------------------------------------------------------------------------
	//Wait, Loading Category Tree...
	define("LANG_JS_LOADCATEGORYTREE", "Attendez, Chargement du directoire des catégories...");
	//Wait, Loading Locations...
	define("LANG_JS_LOADLOCATIONTREE", "Attendez, Chargement emplacements...");
	//Loading...
	define("LANG_JS_LOADING", "Chargement...");
	//This item was added to your Favorites. You can view your Favorites in your profile page.
	define("LANG_JS_FAVORITEADD", "Cet article a été ajouté à vos favoris.<br />Vous pouvez afficher vos favoris dans votre page de profil.");
	//This item was removed from your Favorites.
	define("LANG_JS_FAVORITEDEL", "Cet article a été retiré de vos favoris.");
	//weak
	define("LANG_JS_LABEL_WEAK", "faible");
	//bad
	define("LANG_JS_LABEL_BAD", "loyal");
	//good
	define("LANG_JS_LABEL_GOOD", "bien");
	//strong
	define("LANG_JS_LABEL_STRONG", "fort");
	//There was a problem retrieving the XML data:
	define("LANG_JS_ACCOUNTSEARCH_PROBLEMRETRIEVING", "Il y avait un problème à la récupération des données XML:");
	//Click here to select an account.
	define("LANG_JS_ACCOUNTSEARCH_CLICKHERETOSELECT", "Cliquez ici pour sélectionner un compte");
	//Please provide at least a 3 letter word for the search!
	define("LANG_JS_ACCOUNTSEARCH_PLEASEPROVIDEATLEAST", "Veuillez fournir au moins un mot de 3 lettres pour effectuer une recherche!");
	//Server response failure!
	define("LANG_JS_ACCOUNTSEARCH_SERVERRESPONSEFAILURE", "Échec de réponse du serveur!");
	//Press ESC Key to close.
	define("LANG_JS_COLORPICKER_CLOSEMSG", "Appuyez sur Echap pour fermer à clé.");
	//Hide Map
	define("LANG_JS_LABEL_HIDEMAP", "Cacher la Carte");
	//Show Map
	define("LANG_JS_LABEL_SHOWMAP", "Afficher la Carte");
	//Show Graphics
	define("LANG_JS_LABEL_SHOWGRAPHICS", "Afficher les Graphiques");
	//Hide Graphics
	define("LANG_JS_LABEL_HIDEGRAPHICS", "Cacher les graphiques");
	//This item was already added to your Favorites.<br />You can view your Favorites in your profile page.
	define("LANG_JS_FAVORITES_ADDED", "Cet article a déjà été ajouté à vos favoris.<br />Vous pouvez afficher vos favoris dans votre page de profil.");
	//Wait...
	define("LANG_JS_WAIT", "Attendez...");
	//Continue
	define("LANG_JS_CONTINUE", "Continuer");
	//Close
	define("LANG_JS_CLOSE", "Fermer");
	//Add keyword
	define("LANG_JS_ADDKEYWORD", "Ajouter un mot clé");
	//Add file
	define("LANG_JS_ADDFILE", "Ajouter un fichier");
	//Prev
	define("LANG_JS_PREV", "Précédent");
	//Next
	define("LANG_JS_NEXT", "Suivant");
	//End Tour
	define("LANG_JS_END_TOUR", "Fermer");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDES
	# ----------------------------------------------------------------------------------------------------
	//You are using an older version of Internet Explorer that may affect the full functionality of some features. We recommend you upgrade to a newer version of Internet Explorer.
	define("LANG_IE6_WARNING", "Vous utilisez une ancienne version d'Internet Explorer qui peut affecter la fonctionnalité complète de certaines fonctions. Nous vous recommandons de mettre à niveau vers une version plus récente d'Internet Explorer.");
	//N/A
	define("LANG_NA", "N/A");
	//characters
	define("LANG_LABEL_CHARACTERES", "caractères");
	//by
	define("LANG_BY", "par");
	//in
	define("LANG_IN", "dans");
	//Read More
	define("LANG_READMORE", "Lire la suite");
	//More
	define("LANG_MORE", "plus");
	//Browse by Category
	define("LANG_BROWSEBYCATEGORY", "Recherche par Catégorie");
	//Browse by Location
	define("LANG_BROWSEBYLOCATION", "Recherche par Région");
	//Browse by Rating
	define("LANG_BROWSEBYREVIEW", "Recherche par Évaluation");
	//Browse Listings
	define("LANG_BROWSELISTINGS", "Recherche par Liste");
	//Browse Events
	define("LANG_BROWSEEVENTS", "Recherche par Événements");
	//Browse Classifieds
	define("LANG_BROWSECLASSIFIEDS", "Recherche par Annonces");
	//Browse Articles
	define("LANG_BROWSEARTICLES", "Recherche par Articles");
	//Browse Deals
	define("LANG_BROWSEPROMOTIONS", "Recherche par Offres");
	//Browse Posts
	define("LANG_BROWSEPOSTS", "Recherche par Posts");
	//show
	define("LANG_SHOW", "afficher");
	//hide
	define("LANG_HIDE", "cacher");
	//Bill to
	define("LANG_BILLTO", "Facturer à");
	//Payable to
	define("LANG_PAYABLETO", "À payer à");
	//Issuing Date
	define("LANG_ISSUINGDATE", "Date d'émission");
	//Expire Date
	define("LANG_EXPIREDATE", "Date d'expiration");
	//Questions
	define("LANG_QUESTIONS", "Questions");
	//Please call
	define("LANG_PLEASECALL", "S'il vous plaît appelez");
	//Invoice Info
	define("LANG_INVOICEINFO", "Informations sur la facture");
	//Invoice Logo
	define("LANG_LABEL_INVOICELOGO", "Logo de facture");
	//Payment Date
	define("LANG_PAYMENTDATE", "Date de paiement");
	//None
	define("LANG_NONE", "Aucun");
	//Custom Invoice
	define("LANG_CUSTOM_INVOICE", "Facture Personnalisée");
	//Custom Invoices
	define("LANG_CUSTOM_INVOICES", "Factures Personnalisées");
	//Locations
	define("LANG_LOCATIONS", "Emplacement");
	//Close
	define("LANG_CLOSE", "Fermer");
	//Close this window
	define("LANG_CLOSEWINDOW", "Fermer la fenêtre");
	//from
	define("LANG_FROM", "à partir de");
	//Transaction Info
	define("LANG_TRANSACTION_INFO", "Information sur la transaction");
	//In manual transactions, subtotal and tax are not calculated.
	define("LANG_TRANSACTION_MANUAL", "Dans les transactions manuelles, total et impôt ne sont pas calculés.");
	//creditcard
	define("LANG_CREDITCARD", "carte de crédit");
	//Join Now!
	define("LANG_JOIN_NOW", "Inscrivez-vous maintenant!");
	//Create Your Account
	define("LANG_JOIN_PROFILE", "Créez Votre Compte");
	//More Information
	define("LANG_MOREINFO", "Plus d'info");
	//and
	define("LANG_AND", "et");
	//Keyword sample 1: "Auto Parts"
	define("LANG_KEYWORD_SAMPLE_1", "Pièces pour véhicule");
	//Keyword sample 2: "Tires"
	define("LANG_KEYWORD_SAMPLE_2", "Pneus");
	//Keyword sample 3: "Engine Repair"
	define("LANG_KEYWORD_SAMPLE_3", "Réparation du moteur");
	//Categories and sub-categories
	define("LANG_CATEGORIES_SUBCATEGS", "Catégories et sous-catégories");
	//per
	define("LANG_PER", "pour");
	//each
	define("LANG_EACH", "chaque");
	//impressions block
	define("LANG_IMPRESSIONSBLOCK", "bloc d'affichage");
	//Add
	define("LANG_ADD", "Ajouter");
	//Manage
	define("LANG_MANAGE", "Gérer");
	//impressions to my paid credit of
	define("LANG_IMPRESSIONPAIDOF", "affichages à mon crédit payé de");
	//Section
	define("LANG_SECTION", "Section");
	//General Pages
	define("LANG_GENERALPAGES", "Pages Générales");
	//Open in a new window
	define("LANG_OPENNEWWINDOW", "Ouvrir dans une nouvelle fenêtre");
	//No
	define("LANG_NO", "Non");
	//Yes
	define("LANG_YES", "Oui");
	//Dear
	define("LANG_DEAR", "Cher");
	//Street Address, P.O. box
	define("LANG_ADDRESS_EXAMPLE", "Adresse, Code Postal");
	//Apartment, suite, unit, building, floor, etc.
	define("LANG_ADDRESS2_EXAMPLE", "Appartement, bureau, unité, bâtiment, étage, etc.");
	//or
	define("LANG_OR", "ou");
	//Hour of Work sample 1: "Sun 8:00 am - 6:00 pm"
	define("LANG_HOURWORK_SAMPLE_1", "Dimanche 8:00 - 18:00");
	//Hour of Work sample 2: "Mon 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_2", "Lundi 8:00 - 21:00");
	//Hour of Work sample 3: "Tue 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_3", "Mardi 8:00 - 21:00");
	//Additional Information
	define("LANG_EXTRA_FIELDS", "Informations Complémentaires");
	//Amenities
	define("LANG_TEMPLATE_AMENITIES", "Aménagements");
	//Sign me in automatically
	define("LANG_AUTOLOGIN", "Se connecter automatiquement");
	//Check / Uncheck All
	define("LANG_CHECK_UNCHECK_ALL", "Cocher / Décocher tous");
	//Billing Information
	define("LANG_BIILING_INFORMATION", "Informations sur la facturation");
	//Listing
	define("LANG_BUSINESS", "Liste");
	//on Listing
	define("LANG_ON_LISTING", "sur la Liste");
	//on Event
	define("LANG_ON_EVENT", "sur l'Événement");
	//on Banner
	define("LANG_ON_BANNER", "sur la Bannière");
	//on Classified
	define("LANG_ON_CLASSIFIED", "sur l'Annonce");
	//on Article
	define("LANG_ON_ARTICLE", "sur l'Article");
	//Listing Name
	define("LANG_LISTING_NAME", "Nom de la Liste");
	//Event Name
	define("LANG_EVENT_NAME", "Nom de l'Événement");
	//Banner Name
	define("LANG_BANNER_NAME", "Nom de la Bannière");
	//Classified Name
	define("LANG_CLASSIFIED_NAME", "Nom de l'Annonce");
	//Article Name
	define("LANG_ARTICLE_NAME", "Nom de l'Article");
	//Frequently Asked Questions
	define("LANG_FAQ_NAME", "Foire Aux Questions");
	//How can we help you?
	define("LANG_FAQ_HELP", "Comment pouvons-nous vous aider?");
	//Enter a question, keyword, topic...
	define("LANG_FAQ_TIP", "Entrez une question, mot-clé, sujet...");
	//click to crop image
	define("LANG_CROPIMAGE", "cliquez ici pour recadrer l'image");
	//Did not find your answer? Contact us.
	define("LANG_FAQ_CONTACT", "Vous ne trouvez pas votre réponse? Contactez-nous.");
	//Active
	define("LANG_LABEL_ACTIVE", "Active");
	//Suspended
	define("LANG_LABEL_SUSPENDED", "Suspendu");
	//Expired
	define("LANG_LABEL_EXPIRED", "Expiré");
	//Pending
	define("LANG_LABEL_PENDING", "En attente");
	//Received
	define("LANG_LABEL_RECEIVED", "Reçu");
	//Promotional Code
	define("LANG_LABEL_DISCOUNTCODE", "Code promotionnel");
	//Account
	define("LANG_LABEL_ACCOUNT", "Compte");
	//Change account
	define("LANG_LABEL_CHANGE_ACCOUNT", "Changer de compte");
	//Name or Title
	define("LANG_LABEL_NAME_OR_TITLE", "Nom ou titre");
	//Name
	define("LANG_LABEL_NAME", "Nom");
	//First, Last
	define("LANG_LABEL_FIRST_LAST", "Première, Dernière");
	//Page Name
	define("LANG_LABEL_PAGE_NAME", "Nom de la page");
	//Summary Description
	define("LANG_LABEL_SUMMARY_DESCRIPTION", "Description du sommaire");
	//Category
	define("LANG_LABEL_CATEGORY", "Catégorie");
	//Sub-Category
	define("LANG_LABEL_SUBCATEGORY", "Sous-Catégorie");
	//Category
	define("LANG_CATEGORY", "Catégorie");
	//Categories
	define("LANG_LABEL_CATEGORY_PLURAL", "Catégories");
	//Categories
	define("LANG_CATEGORY_PLURAL", "Catégories");
	//Country
	define("LANG_LABEL_COUNTRY", "Pays");
	//Region
	define("LANG_LABEL_REGION", "Région");
	//State
	define("LANG_LABEL_STATE", "État");
	//City
	define("LANG_LABEL_CITY", "Ville");
	//Neighborhood
	define("LANG_LABEL_NEIGHBORHOOD", "Quartier");
	//Countries
	define("LANG_LABEL_COUNTRY_PL", "Pays");
	//Regions
	define("LANG_LABEL_REGION_PL", "Régions");
	//States
	define("LANG_LABEL_STATE_PL", "États");
	//Cities
	define("LANG_LABEL_CITY_PL", "Villes");
	//Neighborhoods
	define("LANG_LABEL_NEIGHBORHOOD_PL", "Quartiers");
	//Add a New Region
	define("LANG_LABEL_ADD_A_NEW_REGION", "Ajouter une région nouvelle");
	//Add a New State
	define("LANG_LABEL_ADD_A_NEW_STATE", "Ajouter un état nouveau");
	//Add a New City
	define("LANG_LABEL_ADD_A_NEW_CITY", "Ajouter une ville nouvelle ");
	//Add a New Neighborhood
	define("LANG_LABEL_ADD_A_NEW_NEIGHBORHOOD", "Ajouter un quartier noveau");
	//Choose an Existing Region
	define("LANG_LABEL_CHOOSE_AN_EXISTING_REGION", "Choisir une région existante");
	//Choose an Existing State
	define("LANG_LABEL_CHOOSE_AN_EXISTING_STATE", "Choisir un état existante");
	//Choose an Existing City
	define("LANG_LABEL_CHOOSE_AN_EXISTING_CITY", "Choisir une ville existante");
	//Choose an Existing Neighborhood
	define("LANG_LABEL_CHOOSE_AN_EXISTING_NEIGHBORHOOD", "Choisir un quartier existante");
	//Top Countries
	define("LANG_LABEL_TOP_COUNTRY", "Principaux Pays");
	//Top Regions
	define("LANG_LABEL_TOP_REGION", "Principaux Régions");
	//Top States
	define("LANG_LABEL_TOP_STATE", "Principaux États");
	//Top Cities
	define("LANG_LABEL_TOP_CITY", "Principaux Villes");
	//Top Neighborhoods
	define("LANG_LABEL_TOP_NEIGHBORHOOD", "Principaux Quartiers");
	//No locations found.
	define("LANG_LABEL_NO_LOCATIONS_FOUND", "Aucune adresse trouvée");
	//Renewal
	define("LANG_LABEL_RENEWAL", "Renouvellement");
	//Renewal Date
	define("LANG_LABEL_RENEWAL_DATE", "Date de Renouvellement");
	//Street Address
	define("LANG_LABEL_STREET_ADDRESS", "Adresse");
	//Web Address
	define("LANG_LABEL_WEB_ADDRESS", "Adresse Web");
	//Phone
	define("LANG_LABEL_PHONE", "Téléphone");
	//Fax
	define("LANG_LABEL_FAX", "Fax");
	//Long Description
	define("LANG_LABEL_LONG_DESCRIPTION", "Description longue");
	//Status
	define("LANG_LABEL_STATUS", "État");
	//Level
	define("LANG_LABEL_LEVEL", "Niveau");
	//Empty
	define("LANG_LABEL_EMPTY", "Vide");
	//Videos (Youtube etc)
	define("LANG_LABEL_VIDEOS", "Vidéos (Youtube etc)");
	//Additional Uploads (PDF, DOC, TXT, GIF or PNG)
	define("LANG_LABEL_ATTACH", "Mises à d'autres (PDF, DOC, TXT, JPG, GIF, PNG)");
	//Facebook page
	define("LANG_LABEL_FBPAGE", "Facebook page");
	//Features
	define("LANG_LABEL_FEATURES", "Caractéristiques");
	//Classified Price
	define("LANG_LABEL_CLASSIFIED_PRICE", "Prix Annonce");
	//Event Time
	define("LANG_LABEL_EVENTTIME", "Heure de l'Événement");
	//Imagery
	define("LANG_LABEL_IMAGERY", "Imagerie");
	//Start Date
	define("LANG_LABEL_START_DATE", "Date de Début");
	//Start Date
	define("LANG_LABEL_STARTDATE", "Date de Début");
	//End Date
	define("LANG_LABEL_END_DATE", "Date de Fin");
	//End Date
	define("LANG_LABEL_ENDDATE", "Date de Fin");
	//Invalid date
	define("LANG_LABEL_INVALID_DATE", "Date Incorrecte");
	//Start Time
	define("LANG_LABEL_START_TIME", "Heure de Début");
	//End Time
	define("LANG_LABEL_END_TIME", "Heure de Fin");
	//Unlimited
	define("LANG_LABEL_UNLIMITED", "Illimité");
	//Select
	define("LANG_LABEL_SELECT", "Sélectionner");
	//Selected
	define("LANG_LABEL_SELECTED", "Sélectionné");
	//Select a Type
	define("LANG_LABEL_SELECT_TYPE", "Choisissez un Type");
	//Select a Category
	define("LANG_LABEL_SELECT_CATEGORY", "Choisissez une Catégorie");
	//Time Left
	define("LANG_LABEL_TIMELEFT", "Temps Restant");
	//View Deal
	define("LANG_LABEl_VIEW_DEAL", "Voir Offre");
	//No Deal
	define("LANG_LABEL_NO_PROMOTION", "Pas de Offrir");
	//Select a Deal
	define("LANG_LABEL_SELECT_PROMOTION", "Choisissez un Offrir");
	//Great Offer!
	define("LANG_LABEL_GREAT_OFFER", "Grande Offre!");
	//Contact Name
	define("LANG_LABEL_CONTACTNAME", "Nom du Contact");
	//Contact Name
	define("LANG_LABEL_CONTACT_NAME", "Nom du Contact");
	//Contact Phone
	define("LANG_LABEL_CONTACT_PHONE", "Téléphone du Contact");
	//Contact Fax
	define("LANG_LABEL_CONTACT_FAX", "Fax du Contact");
	//Contact E-mail
	define("LANG_LABEL_CONTACT_EMAIL", "E-mail du Contact");
	//URL
	define("LANG_LABEL_URL", "URL");
	//Address
	define("LANG_LABEL_ADDRESS", "Adresse");
	//E-mail
	define("LANG_LABEL_EMAIL", "E-mail");
	//Notify me about listing reviews and listing traffic
	define("LANG_LABEL_NOTIFY_TRAFFIC", "Me prévenir des évaluations et de la circulation d'listes.");
	//Invoice
	define("LANG_LABEL_INVOICE", "Facture");
	//Invoice #
	define("LANG_LABEL_INVOICENUMBER", "Facture #");
	//Item
	define("LANG_LABEL_ITEM", "Article");
	//Items
	define("LANG_LABEL_ITEMS", "Articles");
	//Extra Category
	define("LANG_LABEL_EXTRA_CATEGORY", "Catégorie Extra");
	//Discount Code
	define("LANG_LABEL_DISCOUNT_CODE", "Code promotionnel");
	//Item Price
	define("LANG_LABEL_ITEMPRICE", "Prix de l'article");
	//Amount
	define("LANG_LABEL_AMOUNT", "Montant");
	//Tax
	define("LANG_LABEL_TAX", "Impôt");
	//Subtotal
	define("LANG_LABEL_SUBTOTAL", "Total");
	//Make checks payable to
	define("LANG_LABEL_MAKE_CHECKS_PAYABLE", "Faire les chèques à l'ordre de");
	//Total
	define("LANG_LABEL_TOTAL", "Total");
	//Id
	define("LANG_LABEL_ID", "Identité");
	//IP
	define("LANG_LABEL_IP", "IP");
	//Title
	define("LANG_LABEL_TITLE", "Titre");
	//Caption
	define("LANG_LABEL_CAPTION", "Légende");
	//impressions
	define("LANG_IMPRESSIONS", "affichages");
	//Impressions
	define("LANG_LABEL_IMPRESSIONS", "Affichages");
	//By impressions
	define("LANG_LABEL_BY_IMPRESSIONS", "Par affichages");
	//By time period
	define("LANG_LABEL_BY_PERIOD", "En période de temps");
	//Date
	define("LANG_LABEL_DATE", "Date");
	//Your E-mail
	define("LANG_LABEL_YOUREMAIL", "Votre E-mail");
	//Subject
	define("LANG_LABEL_SUBJECT", "Sujet");
	//Additional message
	define("LANG_LABEL_ADDITIONALMSG", "Message");
	//Payment type
	define("LANG_LABEL_PAYMENT_TYPE", "Mode de paiement");
	//Notes
	define("LANG_LABEL_NOTES", "Notes");
	//It's easy and fast!
	define("LANG_LABEL_EASYFAST", "C'est facile et rapide!");
	//Write reviews, comment on blog
	define("LANG_LABEL_FOR_PROFILE", "Fais des évaluations, laisse des commentaires sur le blog");
	//Write reviews
	define("LANG_LABEL_FOR_PROFILE2", "Fais des évaluations");
	//Based on
	define("LANG_LABEL_BASED_ON", "Basé sur");
	//Write a review
	define("LANG_WRITE_REVIEW", "Donnez votre évaluation");
	//Already have access?
	define("LANG_LABEL_ALREADYMEMBER", "Avez-vous déjà un accès?");
	//Enjoy our services!
	define("LANG_LABEL_ENJOYSERVICES", "Profitez de nos services!");
	//Test Password
	define("LANG_LABEL_TESTPASSWORD", "Test de mot de passe");
	//Forgot your password?
	define("LANG_LABEL_FORGOTPASSWORD", "Avez-vous oublié votre mot de passe?");
	//Summary
	define("LANG_LABEL_SUMMARY", "Sommaire");
	//Detail
	define("LANG_LABEL_DETAIL", "Détail");
	//(your friend's e-mail)
	define("LANG_LABEL_FRIEND_EMAIL", "(e-mail de votre ami)");
	//General Contact Form
	define("LANG_LABEL_GENERAL_FORM", "General Formulaire de Contact");
	//For
	define("LANG_LABEL_FOR", "Pour");
	//Created
	define("LANG_LABEL_CREATED", "Création");
	//From
	define("LANG_LABEL_FROM", "À partir de");
	//To
	define("LANG_LABEL_TO", "À");
	//to
	define("LANG_LABEL_DATE_TO", "à");
	//Last
	define("LANG_LABEL_LAST", "Dernier");
	//Last
	define("LANG_LABEL_LAST_PLURAL", "Dernier");
	//day
	define("LANG_LABEL_DAY", "jour");
	//days
	define("LANG_LABEL_DAYS", "jours");
	//New
	define("LANG_LABEL_NEW", "Nouveau");
	//New FAQ
	define("LANG_LABEL_NEW_FAQ", "Nouveau FAQ");
	//Type
	define("LANG_LABEL_TYPE", "Type");
	//ClickThru
	define("LANG_LABEL_CLICKTHRU", "Cliquez Grâce");
	//Added
	define("LANG_LABEL_ADDED", "Ajouté");
    //Added on
    define("LANG_LABEL_ADDED_ON", "Ajoutée le");
    //There are no pending items.
    define("LANG_LABEL_NO_PENDING_ITEMS", "Il n'y a pas les points en suspens.");
    //There are no pending reviews.
    define("LANG_LABEL_NO_PENDING_REVIEWS", "Il n'y a aucun avis en suspens.");
    //more
    define("LANG_LABEL_PLUS_REVIEWS", "plus [X]");
	//rates this item with
    define("LANG_LABEL_REVIEW_RATES", "taux cette [item] avec");
    //Did you find this review helpful?
    define("LANG_LABEL_REVIEW_HELPFUL", "Avez-vous trouvé ce commentaire utile?");
    //Blog Comment
    define("LANG_LAVEL_BLOG_COMMENT", "Commentaire du Blog");
	//Post Title
	define("LANG_BLOG_TITLE", "Titre du Post");
	//Add
	define("LANG_LABEL_ADD", "Ajouter");
	//rating
	define("LANG_LABEL_RATING", "Évaluation");
	//evaluator
	define("LANG_LABEL_EVALUATOR", "Évaluateur");
	//Reviewer
	define("LANG_LABEL_REVIEWER", "Commentateur");
	//System
	define("LANG_LABEL_SYSTEM", "Système");
	//Subscribe to RSS
	define("LANG_LABEL_SUBSCRIBERSS", "S'abonner au RSS");
	//Guide
	define("LANG_LABEL_GUIDE", "Guide");
	//Password strength
	define("LANG_LABEL_PASSWORDSTRENGTH", "Niveau de sécurité du mot de passe");
	//Article Title
	define("LANG_ARTICLE_TITLE", "Titre de l'Article");
	//SEO Description
	define("LANG_SEO_DESCRIPTION", "SEO Description");
	//SEO Keywords
	define("LANG_SEO_KEYWORDS", "SEO mots-clés");
	//No line breaks allowed
	define("LANG_SEO_LINEBREAK", "les sauts de ligne ne sont pas autorisés");
	//Separate elements with comma (,)
	define("LANG_SEO_COLON", "séparer les éléments en utilisant une virgule (,)");
	//Click here to edit the SEO information of this item
	define("LANG_MSG_CLICK_TO_EDIT_SEOCENTER", "Cliquez ici pour modifier le référencement des informations de cette rubrique.");
	//SEO successfully updated!
	define("LANG_MSG_SEOCENTER_ITEMUPDATED", "Article mis à jour!");
	//Click here to view this article
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE", "Cliquez ici pour voir cet article");
	//Click here to edit this article
	define("LANG_MSG_CLICK_TO_EDIT_THIS_ARTICLE", "Cliquez ici pour modifier cet article");
	//Click here to view this article reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE_REPORTS", "Cliquez sur ici pour consulter les rapports de cet article");
	//History for this article
	define("LANG_HISTORY_FOR_THIS_ARTICLE", "Historique pour cet article");
	//History not available for this article
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_ARTICLE", "Historique non disponible pour cet article");
	//Click here to delete this article
	define("LANG_MSG_CLICK_TO_DELETE_THIS_ARTICLE", "Cliquez ici pour supprimer cet article");
	//Click here to view this banner
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER", "Cliquez ici pour voir cette bannière");
	//Click here to edit this banner
	define("LANG_MSG_CLICK_TO_EDIT_THIS_BANNER", "Cliquez ici pour modifier cette bannière");
	//Click here to view this banner reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER_REPORTS", "Cliquez ici pour voir les rapports de cette bannière");
	//History for this banner
	define("LANG_HISTORY_FOR_THIS_BANNER", "Historique de cette bannière");
	//History not available for this banner
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_BANNER", "Historique non disponible pour cette bannière");
	//Click here to delete this banner
	define("LANG_MSG_CLICK_TO_DELETE_THIS_BANNER", "Cliquez ici pour supprimer cette bannière");
	//Classified Title
	define("LANG_CLASSIFIED_TITLE", "Titre de l'Annonce");
	//Click here to
	define("LANG_MSG_CLICKTO", "Cliquez ici pour");
	//Click here to view this classified
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED", "Cliquez ici pour voir cette annonce");
	//Click here to edit this classified
	define("LANG_MSG_CLICK_TO_EDIT_THIS_CLASSIFIED", "Cliquez ici pour modifier cette annonce");
	//Click here to view this classified reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED_REPORTS", "Cliquez ici pour voir les rapports pour cette annonce");
	//Click here to map tuning this classified location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_CLASSIFIED", "Cliquez ici pour régler l'emplacement de cette annonce");
	//Map tuning not available for this classified
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_CLASSIFIED", "Carte de réglage non disponible pour cette annonce");
	//History for this classified
	define("LANG_HISTORY_FOR_THIS_CLASSIFIED", "Historique de cette annonce");
	//History not available for this classified
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_CLASSIFIED", "Historique non disponible pour cette annonce");
	//Click here to delete this classified
	define("LANG_MSG_CLICK_TO_DELETE_THIS_CLASSIFIED", "Cliquez ici pour supprimer cette annonce");
	//Event Title
	define("LANG_EVENT_TITLE", "Titre de l'Evénement");
	//Click here to view this event
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT", "Cliquez ici pour voir cet événement");
	//Click here to edit this event
	define("LANG_MSG_CLICK_TO_EDIT_THIS_EVENT", "Cliquez ici pour modifier cet événement");
	//Click here to view this event reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT_REPORTS", "Cliquez ici pour voir les rapports de cet événement");
	//Click here to map tuning this event location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_EVENT", "Cliquez ici pour régler l'emplacement de cet événement");
	//Map tuning not available for this event
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_EVENT", "Carte de réglage non disponible pour cet événement");
	//History for this event
	define("LANG_HISTORY_FOR_THIS_EVENT", "Historique de cet événement");
	//History not available for this event
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_EVENT", "Historique non disponible pour cet événement");
	//Click here to delete this event
	define("LANG_MSG_CLICK_TO_DELETE_THIS_EVENT", "Cliquez ici pour supprimer cet événement");
	//Listing Title
	define("LANG_LISTING_TITLE", "Titre de la Liste");
	//Click here to view this listing
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING", "Cliquez ici pour voir cette liste");
	//Click here to edit this listing
	define("LANG_MSG_CLICK_TO_EDIT_THIS_LISTING", "Cliquez ici pour modifier cette liste");
	//Click here to change deal for this listing
	define("LANG_MSG_CLICK_TO_CHANGE_PROMOTION", "Cliquez ici pour changer le offrir de cette liste");
	//Deal not available for this listing
	define("LANG_MSG_PROMOTION_NOT_AVAILABLE", "Offrir pas disponible pour cette liste");
	//Click here to view this listing reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING_REPORTS", "Cliquez ici pour voir les rapports de cette liste");
	//Click here to map tuning this listing location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_LISTING", "Cliquez ici pour régler l'emplacement de cette liste");
	//Map tuning not available for this listing
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_LISTING", "Carte de réglage non disponible pour cette liste");
	//Map tuning Address Not Found
	define("LANG_MAPTUNING_ADDRESSNOTFOUND", "Adresse introuvable.");
	//Map tuning Please Edit Your Item
	define("LANG_MAPTUNING_PLEASEEDITYOURITEM", "Veuillez éditer votre article.");
	//Click here to view this item reviews
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS", "Cliquez ici pour voir cet article commentaires");
	//Item reviews not available
	define("LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE", "Point commentaires non disponible");
	//History for this listing
	define("LANG_HISTORY_FOR_THIS_LISTING", "Historique de cette liste");
	//History not available for this listing
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_LISTING", "Historique non disponible pour cette liste");
	//Click here to delete this listing
	define("LANG_MSG_CLICK_TO_DELETE_THIS_LISTING", "Cliquez ici pour supprimer cette liste");
	//Save
	define("LANG_MSG_SAVE_CHANGES", "Enregistrer");
	//More Information
	define("LANG_MSG_MORE_INFO", "Plus d'Informations");
	//(Try to use something descriptive, like "10% off of our product" or "3 for the price of two on our product")
	define("LANG_MSG_DEALTITLE_TIP", "(Essayez d'utiliser quelque chose descriptive, comme \"10% de réduction de notre produit \" ou \"3 pour le prix de deux sur notre produit\")");
	//Enter the value of the item / service you are offering. Choose a discount type (Fixed Value or Percentage), and enter the respective value. Check the calculation and then provide us with the number of offers you wish to make.
	define("LANG_MSG_ADD_DEAL_TIP", "Entrez la valeur de l'article ou le service que vous offrez. Choisir un type de rabais (valeur fixe ou en pourcentage), et entrez la valeur respective. Vérifier le calcul, puis nous fournir le nombre d'offres que vous voudrez faire.");
	//Please be sure your image is the right size before you upload it, otherwise the image will likely be stretched to fit the site and image quality will be affected.
	define("LANG_MSG_ADD_DEAL_TIP2", "S'il vous plaît assurez-vous de l'image est la bonne taille avant de la télécharger, sinon l'image sera probablement étendu pour s'adapter à la qualité du site et l'image sera affectée.");
	//Every deal needs to be linked to a listing in order to be active on the site.
	define("LANG_MS_MANGE_DEAL_TIP", "Tout affaire doit être liée à une liste pour être active sur le site..");
	//Associate with the listing
	define("LANG_DEAL_LISTING_SELECT", "Associé à la liste");
	//Please type your item title and wait for suggestions of available associations.
	define("LANG_DEAL_LISTING_TIP", "S'il vous plaît entrez le titre de votre article et d'attendre pour obtenir des suggestions d'associations disponibles.");
	//Empty
	define("LANG_EMPTY", "Vide");
	//Cancel
	define("LANG_CANCEL", "Annulé");
	//Custom Time Period
	define("LANG_SITEMGR_CUSTOMPERIOD", "Période Personnalisée");
	//Fixed Value Discount
	define("LANG_LABEL_FIXEDVALUE_DISC", "Remise Valeur Fixe");
	//Percentage Discount
	define("LANG_LABEL_PERCENTAGE_DISC", "Pourcentage de Réduction");
	//Value with Discount
	define("LANG_LABEL_DISC_AMOUNT", "Valeur avec Escompte");
	//Discount (Calculated)
	define("LANG_LABEL_DISC_CALCULATED", "Remise (Calculé)");
	//How many deals would you like to offer
	define("LANG_LABEL_DEALS_OFFER", "Combien souhaitez-vous faire face à offrir");
	//Linked to Listing
	define("LANG_LABEL_ATTACHED_LISTING", "Lié à la Liste");
	//Choose a Listing
	define("LANG_LABEL_CHOOSE_LISTING", "Choisissez un Liste");
	//You can not add different deals to the same listing.
	define("LANG_MSG_REPEATED_LISTINGS", "Vous ne pouvez pas ajouter offres différentes pour une même liste.");
	//Deals successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATE", "Offres correctement mis à jour!");
	//Options
	define("LANG_LABEL_OPTIONS", "Options");
	//Deal Title
	define("LANG_PROMOTION_TITLE", "Titre du Offrir");
	//Click here to view this deal
	define("LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION", "Cliquez ici pour voir cet offrir");
	//Click here to edit this deal
	define("LANG_MSG_CLICK_TO_EDIT_THIS_PROMOTION", "Cliquez ici pour modifier cet offrir");
	//Click here to view this deal reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION_REPORTS", "Cliquez sur ici pour consulter les rapports de cet offrir");
	//Click here to delete this deal
	define("LANG_MSG_CLICK_TO_DELETE_THIS_PROMOTION", "Cliquez ici pour supprimer cet offrir");
	//Go to "Listings" and click on the deal icon belonging to the listing where you want to add the deal. Select one deal to add to your listing to make it live.
	define("LANG_PROMOTION_EXTRAMESSAGE", "Aller aux \"Listes\" et cliquez sur l'icône de la liste où vous souhaitez ajouter le offrir. Choisissez un offrir à ajouter à votre pour le faire en direct.");
	//The installments will be recurring until your credit card expiration
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATION", "Les versements seront récurrents jusqu'à l'expiration de votre carte de crédit");
	//The installments will be recurring until your credit card expiration ("maximum of 36 installments")
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATIONMAXOF", "maximum de 36 versements");
	//SEO Center
	define("LANG_MSG_SEO_CENTER", "Centre SEO");
	//View
	define("LANG_LABEL_VIEW", "Vue");
	//Edit
	define("LANG_LABEL_EDIT", "Modifier");
	//Traffic Reports
	define("LANG_TRAFFIC_REPORTS", "Rapport du Trafic");
	//Unpaid
	define("LANG_LABEL_UNPAID", "Pas Payé");
	//Paid
	define("LANG_LABEL_PAID", "Payés");
	//Waiting payment approval
	define("LANG_LABEL_WAITING", "En attendant l'approbation");
	//Under review
	define("LANG_LABEL_ANALYSIS", "En cours de révision");
	//Available
	define("LANG_LABEL_AVAILABLE", "Disponible");
	//In dispute
	define("LANG_LABEL_DISPUTE", "Dans le différend");
	//Refunded
	define("LANG_LABEL_REFUNDED", "Remboursé");
	//Cancelled
	define("LANG_LABEL_CANCELLED", "Annulé");
	//Transaction
	define("LANG_LABEL_TRANSACTION", "Transaction");
	//Delete
	define("LANG_LABEL_DELETE", "Supprimer");
	//Download
	define("LANG_LABEL_DOWNLOAD", "Télécharger");
	//Map Tuning
	define("LANG_LABEL_MAP_TUNING", "Carte de Réglage");
	//Hide Map
	define("LANG_LABEL_HIDEMAP", "Cacher la Carte");
	//Show Map
	define("LANG_LABEL_SHOWMAP", "Afficher la Carte");
	//SEO
	define("LANG_LABEL_SEO_TUNING", "SEO");
	//Print
	define("LANG_LABEL_PRINT", "Imprimer");
	//Pending Approval
	define("LANG_LABEL_PENDING_APPROVAL", "En attente d'approbation");
	//Image
	define("LANG_LABEL_IMAGE", "Image");
	//Images
	define("LANG_LABEL_IMAGE_PLURAL", "Images");
	//Required field
	define("LANG_LABEL_REQUIRED_FIELD", "Champ Obligatoire");
	//Please type all the required fields.
	define("LANG_LABEL_TYPE_FIELDS", "S\'il vous plaît entrez tous les champs requis.");
	//Account Information
	define("LANG_LABEL_ACCOUNT_INFORMATION", "Informations sur Le Compte");
	//E-mail
	define("LANG_LABEL_USERNAME", "E-mail");
    //Username
	define("LANG_LABEL_USERNAME2", "Nom d'Utilisateur");
	//Current Password
	define("LANG_LABEL_CURRENT_PASSWORD", "Mot de passe actuel");
	//Password
	define("LANG_LABEL_PASSWORD", "Mot de Passe");
	//Password not changed.
	define("LANG_PASSWORD_NOT_CHANGED", "Mot de passe non changé.");
	//Create Password
	define("LANG_LABEL_CREATE_PASSWORD", "Mot de passe");
	//New Password
	define("LANG_LABEL_NEW_PASSWORD", "Nouveau mot de Passe");
	//Retype Password
	define("LANG_LABEL_RETYPE_PASSWORD", "Répéter mot de passe");
	//Retype Password
	define("LANG_LABEL_RETYPEPASSWORD", "Confirmer le mot de passe");
	//Retype New Password
	define("LANG_LABEL_RETYPE_NEW_PASSWORD", "Confirmer le nouveau mot de passe");
	//OpenID URL
	define("LANG_LABEL_OPENIDURL", "OpenID URL");
	//Information
	define("LANG_LABEL_INFORMATION", "Information");
	//Publication Date
	define("LANG_LABEL_PUBLICATION_DATE", "Date de Publication");
	//Calendar
	define("LANG_LABEL_CALENDAR", "Calendrier");
	//Friendly Url
	define("LANG_LABEL_FRIENDLY_URL", "Url Facile");
	//For example
	define("LANG_LABEL_FOR_EXAMPLE", "Par exemple");
	//Image Source
	define("LANG_LABEL_IMAGE_SOURCE", "Source de l'image");
	//Image Attribute
	define("LANG_LABEL_IMAGE_ATTRIBUTE", "Attributs de l'image");
	//Image Caption
	define("LANG_LABEL_IMAGE_CAPTION", "Légende de l'image");
	//Abstract
	define("LANG_LABEL_ABSTRACT", "Résumé");
	//Keywords for the search
	define("LANG_LABEL_KEYWORDS_FOR_SEARCH", "Mots-clés pour la recherche");
	//Refine By...
	define("LANG_LABEL_REFINEBY", "Affiner par...");
	//You refined by...
	define("LANG_LABEL_REFINEDBY", "Votre recherche...");
	//Remove all
	define("LANG_LABEL_REMOVE_ALL", "Retirer tous");
	//Show only listings with deals
	define("LANG_LABEL_FILTER_DEAL", "Afficher seulement les entreprises avec des offres");
	//maximum
	define("LANG_LABEL_MAX", "max");
	//keywords
	define("LANG_LABEL_KEYWORDS", "Mots-clés");
	//Content
	define("LANG_LABEL_CONTENT", "Contenu");
	//Code
	define("LANG_LABEL_CODE", "Code");
	//free
	define("LANG_FREE", "Gratuites");
	//free
	define("LANG_LABEL_FREE", "gratuites");
	//free
	define("LANG_INCLUDED", "inclus");
	//Destination Url
	define("LANG_LABEL_DESTINATION_URL", "Destination Url");
	//Script
	define("LANG_LABEL_SCRIPT", "Script");
	//File
	define("LANG_LABEL_FILE", "Fichier");
	//Warning
	define("LANG_LABEL_WARNING", "Attention");
	//Display URL (optional)
	define("LANG_LABEL_DISPLAY_URL", "Afficher URL (facultatif)");
	//Visit Website
	define("LANG_VISIT_WEBSITE", "Visitez le site Web");
	//Description line 1
	define("LANG_LABEL_DESCRIPTION_LINE1", "Description de la ligne 1");
	//Description line 2
	define("LANG_LABEL_DESCRIPTION_LINE2", "Description de la ligne 2");
	//Location
	define("LANG_LABEL_LOCATIONS", "Emplacement");
	//Enter a landmark or point of reference for your listing's location.
	define("LANG_LABEL_LOCATIONS_TIP", "Utilisez ce champ pour entrer dans un lieu de référence de votre article");
	//Would you like to add more information about your item? Besides your gallery images, you can upload an additional file with extra information here
	define("LANG_LABEL_ATTACH_ADDITIONAL_FILE_TIP", "Voulez-vous ajouter plus d'informations sur votre produit? Outre les images de votre galerie, vous pouvez télécharger un fichier supplémentaire avec des informations supplémentaires ici");
	//Fill in this field if your URL is too long. Example: "www.example.com" can be shown as "Example".
	define("LANG_LABEL_DISPLAY_URL_TIP", "Remplissez ce champ si votre URL est trop longue. Exemple: \"www.exemple.com\" peut être affiché comme \"exemple\".");
	//Enable monthly e-mail to listing owners that includes their stats and reviews.
	define("LANG_LABEL_NOTIFY_TRAFFIC_TIP", "Activer e-mail tous les mois aux propriétaires d'inscription qui inclut leurs stats et des critiques.");
	//Sponsors have access to the members area and can create items. They can also create their own personal pages.
	define("LANG_LABEL_SPONSOR_TIP", "Les annonceur ont accès à la zone membres et peuvent créer des objets. Ils peuvent également créer leurs propres pages personnelles.");
	//Visitors can visit your frontend pages, write reviews, comment on blog and view other user's personal page. Visitors can upgrade their accounts by adding an item through the advertise process.
	define("LANG_LABEL_PROFILE_TIP", "Les visiteurs peuvent visiter vos pages frontend, écrire des avis, commentaires sur le blog et voir la page personnelle d'un autre utilisateur. Les visiteurs peuvent mettre à jour leurs comptes par l'ajout d'un élément dans le processus publicité.");
	//Address (optional)
	define("LANG_LABEL_ADDRESS_OPTIONAL", "Adresse (facultatif)");
	//Address (Optional)
	define("LANG_LABEL_ADDRESSOPTIONAL", "Adresse (facultatif)");
	//Detail Description
	define("LANG_LABEL_DETAIL_DESCRIPTION", "Description en détail");
	//Price
	define("LANG_LABEL_PRICE", "Prix");
	//Prices
	define("LANG_LABEL_PRICE_PLURAL", "Prix");
	//Contact Information
	define("LANG_LABEL_CONTACT_INFORMATION", "Contact Info");
	//Language
	define("LANG_LABEL_LANGUAGE", "Langue");
	//Select your main language to contact (when necessary).
	define("LANG_LABEL_LANGUAGETIP", "Choisissez votre langue principale (si nécessaire).");
	//First Name
	define("LANG_LABEL_FIRST_NAME", "Prénom");
	//First Name
	define("LANG_LABEL_FIRSTNAME", "Prénom");
	//Last Name
	define("LANG_LABEL_LAST_NAME", "Nom de Famille");
	//Last Name
	define("LANG_LABEL_LASTNAME", "Nom de Famille");
	//Company
	define("LANG_LABEL_COMPANY", "Entreprise");
	//Address
	define("LANG_LABEL_ADDRESS1", "Adresse");
	//Address 2
	define("LANG_LABEL_ADDRESS2", "Adresse 2");
	//Latitude
	define("LANG_LABEL_LATITUDE", "Latitude");
	//Longitude
	define("LANG_LABEL_LONGITUDE", "Longitude");
	//Not found. Please, try to specify better your location.
	define("LANG_LABEL_MAP_NOTFOUND", "Pas trouvé. S'il vous plaît, essayez de mieux spécifier votre emplacement.");
	//The following fields contain errors:
	define("LANG_LABEL_MAP_ERRORS", "Les champs suivants contiennent des erreurs:");
	//Latitude must be a number between -90 and 90.
	define("LANG_LABEL_MAP_INVALID_LAT", "Latitude doit être un nombre compris entre -90 et 90.");
	//Longitude must be a number between -180 and 180.
	define("LANG_LABEL_MAP_INVALID_LON", "Longitude doit être un nombre entre -180 et 180.");
	//Location Name
	define("LANG_LABEL_LOCATION_NAME", "Emplacement");
	//Event Date
	define("LANG_LABEL_EVENT_DATE", "Date de l'Evénement");
	//Description
	define("LANG_LABEL_DESCRIPTION", "Description");
	//Help Information
	define("LANG_LABEL_HELP_INFORMATION", "Aide");
	//Text
	define("LANG_LABEL_TEXT", "Texte");
	//Add Image
	define("LANG_LABEL_ADDIMAGE", "Ajouter une Image");
	//Add Image
	define("LANG_LABEL_ADDIMAGES", "Ajouter une Image");
	//Edit Image Captions
	define("LANG_LABEL_EDITIMAGECAPTIONS", "Modifier la légende de l'Image");
	//Image File
	define("LANG_LABEL_IMAGEFILE", "Fichier de l'Image");
	//Thumb Caption
	define("LANG_LABEL_THUMBCAPTION", "Légende de la Vignette");
	//Image Caption
	define("LANG_LABEL_IMAGECAPTION", "Légende de l'Image");
	//Video Snippet Code
	define("LANG_LABEL_VIDEO_SNIPPET_CODE", "Code Extrait Vidéo");
	//Attach Additional File
	define("LANG_LABEL_ATTACH_ADDITIONAL_FILE", "Joindre des fichiers additionnels");
	//Attach Menu
	define("LANG_LABEL_ATTACH_MENU", "Joindre Menu");
	//Menu
	define("LANG_LABEL_MENU", "Menu");
    //Good to know
    define("LANG_LABEL_GOODKNOW", "Bon à savoir");
    //Make a reservation
    define("LANG_LABEL_RESERVATION", "Faire une réservation");
	//Attention
	define("LANG_LABEL_ATTENTION", "Attention");
	//Source
	define("LANG_LABEL_SOURCE", "Source");
	//Hours
	define("LANG_LABEL_HOURS_OF_WORK", "Heures de travail");
	//Default
	define("LANG_LABEL_DEFAULT", "Défaut");
	//Payment Method
	define("LANG_LABEL_PAYMENT_METHOD", "Mode de Paiement");
    //How do you want to pay us?
    define("LANG_LABEL_PAYMENT_METHOD_TIP", "Comment voulez-vous payer?");
	//By Credit Card
	define("LANG_LABEL_BY_CREDIT_CARD", "Par Carte de Crédit");
	//By PayPal
	define("LANG_LABEL_BY_PAYPAL", "Par PayPal");
	//By SimplePay
	define("LANG_LABEL_BY_SIMPLEPAY", "Par SimplePay");
	//By Pagseguro
	define("LANG_LABEL_BY_PAGSEGURO", "Par Pagseguro");
	//Print Invoice and Mail a Check
	define("LANG_LABEL_PRINT_INVOICE_AND_MAIL_CHECK", "Imprimer la Facture et Envoyer un Chèque");
	//Headline
	define("LANG_LABEL_HEADLINE", "Headline");
	//Offer
	define("LANG_LABEL_OFFER", "Offre");
	//Conditions
	define("LANG_LABEL_CONDITIONS", "Conditions");
	//Deal Dates
	define("LANG_LABEL_PROMOTION_DATE", "Dates du Offrir");
	//Deal Layout
	define("LANG_LABEL_PROMOTION_LAYOUT", "Image du Offrir");
	//You pay
	define("LANG_LABEL_PROMOTION_PAY", "Vous payez");
	//Time left to buy
	define("LANG_LABEL_PROMOTION_TIMELEFT", "Temps restant avant la vente");
	//Printable Deal
	define("LANG_LABEL_PRINTABLE_PROMOTION", "Imprimable");
	//Our HTML template based deal
	define("LANG_LABEL_OUR_HTML_TEMPLATE_BASED", "Notre modèle basé HTML");
	//Fill in the fields above and insert a logo or other image (JPG or GIF)
	define("LANG_LABEL_FILL_FIELDS_ABOVE", "Remplissez les champs ci-dessus et d'insérez un logo ou une image (JPG ou GIF)");
	//A deal provided by you instead
	define("LANG_LABEL_PROMOTION_PROVIDED_BY_YOU", "Un offrir que vous avez fournis au lieu");
	//JPG or GIF image
	define("LANG_LABEL_JPG_GIF_IMAGE", "Image JPG ou GIF");
	//Comment Title
	define("LANG_LABEL_COMMENTTITLE", "Titre");
	//Comment
	define("LANG_LABEL_COMMENT", "Commentaire");
	//Accepted
	define("LANG_LABEL_ACCEPTED", "Accepté");
	//Approved
	define("LANG_LABEL_APPROVED", "Approuvé");
	//Success
	define("LANG_LABEL_SUCCESS", "Succès");
	//Completed
	define("LANG_LABEL_COMPLETED", "Terminé");
	//Y
	define("LANG_LABEL_Y", "O");
	//Failed
	define("LANG_LABEL_FAILED", "Échec");
	//Declined
	define("LANG_LABEL_DECLINED", "Refusée");
	//failure
	define("LANG_LABEL_FAILURE", "échec");
	//Canceled
	define("LANG_LABEL_CANCELED", "Annule");
	//Error
	define("LANG_LABEL_ERROR", "Erreur");
	//Transaction Code
	define("LANG_LABEL_TRANSACTION_CODE", "Code de Transaction");
	//Subscription ID
	define("LANG_LABEL_SUBSCRIPTION_ID", "Abonnement ID");
	//transaction history
	define("LANG_LABEL_TRANSACTION_HISTORY", "Historique des transactions");
	//Authorization Code
	define("LANG_LABEL_AUTHORIZATION_CODE", "Code d'Autorisation");
	//Transaction Status
	define("LANG_LABEL_TRANSACTION_STATUS", "État de la Transaction");
	//Transaction Error
	define("LANG_LABEL_TRANSACTION_ERROR", "Erreur de Transaction");
	//Monthly Bill Amount
	define("LANG_LABEL_MONTHLY_BILL_AMOUNT", "Montant de la Facture Mensuelle");
	//Transaction OID
	define("LANG_LABEL_TRANSACTION_OID", "Transaction OID");
	//Yearly Bill Amount
	define("LANG_LABEL_YEARLY_BILL_AMOUNT", "Montant de la Facture Annuelle");
	//Bill Amount
	define("LANG_LABEL_BILL_AMOUNT", "Montant de la Facture");
	//Transaction ID
	define("LANG_LABEL_TRANSACTION_ID", "ID de la Transaction");
	//Receipt ID
	define("LANG_LABEL_RECEIPT_ID", "ID de la Réception");
	//Subscribe ID
	define("LANG_LABEL_SUBSCRIBE_ID", "ID de l'Abonnement");
	//Transaction Order ID
	define("LANG_LABEL_TRANSACTION_ORDERID", "ID de la Commande");
	//your
	define("LANG_LABEL_YOUR", "votre");
	//Make Your
	define("LANG_LABEL_MAKE_YOUR", "Faites Votre");
	//Payment
	define("LANG_LABEL_PAYMENT", "Paiement");
	//History
	define("LANG_LABEL_HISTORY", "Historique");
	//Log in
	define("LANG_LABEL_LOGIN", "Connexion");
	//Transaction canceled
	define("LANG_LABEL_TRANSACTION_CANCELED", "Transaction annulée");
	//Transaction amount
	define("LANG_LABEL_TRANSACTION_AMOUNT", "Le montant de la transaction");
	//Pay
	define("LANG_LABEL_PAY", "Payer");
	//Back
	define("LANG_LABEL_BACK", "Retour");
	//Total Price
	define("LANG_LABEL_TOTAL_PRICE", "Prix Total");
	//Pay By Invoice
	define("LANG_LABEL_PAY_BY_INVOICE", "Payer par Facturation");
	//Administrator
	define("LANG_LABEL_ADMINISTRATOR", "Administrateur");
	//Billing Info
	define("LANG_LABEL_BILLING_INFO", "Informations sur la Facturation");
	//Card Number
	define("LANG_LABEL_CARD_NUMBER", "Numéro de la Carte");
	//Card Expire date
	define("LANG_LABEL_CARD_EXPIRE_DATE", "Date d'Expiration de la Carte");
	//Card Code
	define("LANG_LABEL_CARD_CODE", "Code de la Carte");
	//Customer Info
	define("LANG_LABEL_CUSTOMER_INFO", "Infos client");
	//zip
	define("LANG_LABEL_ZIP", "code postal");
	//Place Order and Continue
	define("LANG_LABEL_PLACE_ORDER_CONTINUE", "Commander et Continuer");
	//General Information
	define("LANG_LABEL_GENERAL_INFORMATION", "Information générale");
	//Phone Number
	define("LANG_LABEL_PHONE_NUMBER", "Numéro de Téléphone");
	//E-mail Address
	define("LANG_LABEL_EMAIL_ADDRESS", "Adresse E-mail ");
	//Credit Card Information
	define("LANG_LABEL_CREDIT_CARD_INFORMATION", "Informations sur la Carte de Crédit");
	//Exp. Date
	define("LANG_LABEL_EXP_DATE", "Date d'Expiration");
	//Customer Information
	define("LANG_LABEL_CUSTOMER_INFORMATION", "Informations sur le client");
	//Card Expiration
	define("LANG_LABEL_CARD_EXPIRATION", "Expiration de la Carte");
	//Name on Card
	define("LANG_LABEL_NAME_ON_CARD", "Nom sur la Carte");
	//Card Type
	define("LANG_LABEL_CARD_TYPE", "Type de Carte");
	//Card Verification Number
	define("LANG_LABEL_CARD_VERIFICATION_NUMBER", "Numéro de Vérification de la Carte");
	//Province
	define("LANG_LABEL_PROVINCE", "Région");
	//Postal Code
	define("LANG_LABEL_POSTAL_CODE", "Code Postal");
	//Post Code
	define("LANG_LABEL_POST_CODE", "Code Postal");
	//Tel
	define("LANG_LABEL_TEL", "Téléphone");
	//Select Date
	define("LANG_LABEL_SELECTDATE", "Choisissez une Date");
	//Found
	define("LANG_PAGING_FOUND", "Trouvé");
	//Found
	define("LANG_PAGING_FOUND_PLURAL", "Trouvé");
	//record
	define("LANG_PAGING_RECORD", "record");
	//records
	define("LANG_PAGING_RECORD_PLURAL", "records");
	//Showing page
	define("LANG_PAGING_SHOWINGPAGE", "Affichage de la page");
	//of
	define("LANG_PAGING_PAGEOF", "de");
	//pages
	define("LANG_PAGING_PAGE_PLURAL", "pages");
	//Go to page
	define("LANG_PAGING_GOTOPAGE", "Aller à la page");
	//Select
	define("LANG_PAGING_ORDERBYPAGE_SELECT", "Choisissez");
	//Order by
	define("LANG_PAGING_ORDERBYPAGE", "Classement par");
	//Characters
	define("LANG_PAGING_ORDERBYPAGE_CHARACTERS", "Caractères");
    //Alphabetically
    define("LANG_PAGING_ORDERBYPAGE_ALPHABETICALLY", "Alphabétique");
	//Last update
	define("LANG_PAGING_ORDERBYPAGE_LASTUPDATE", "Mettre à jour");
	//Date created
	define("LANG_PAGING_ORDERBYPAGE_DATECREATED", "Date de création");
	//Popular
	define("LANG_PAGING_ORDERBYPAGE_POPULAR", "Populaires");
	//Rating
	define("LANG_PAGING_ORDERBYPAGE_RATING", "Évaluation");
	//Price
	define("LANG_PAGING_ORDERBYPAGE_PRICE", "​​Prix");
	//Start Date
	define("LANG_PAGING_ORDERBYPAGE_STARTDATE", LANG_LABEL_START_DATE);
	//previous page
	define("LANG_PAGING_PREVIOUSPAGE", "retour page");
	//next page
	define("LANG_PAGING_NEXTPAGE", "page suivante");
	//"previous" page
	define("LANG_PAGING_PREVIOUSPAGEMOBILE", "retour");
	//"next" page
	define("LANG_PAGING_NEXTPAGEMOBILE", "suivante");
	//view full listing
	define("LANG_VIEW_LISTING", "voir l'liste complet");
	//view full article
	define("LANG_VIEW_ARTICLE", "avoir l'article complet");
	//Go to Website
	define("LANG_GO_TO_WEBSITE", "Aller au Site web");
	//Article successfully added!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_ADDED", "Article ajouté avec succès!");
	//Banner successfully added!
	define("LANG_MSG_BANNER_SUCCESSFULLY_ADDED", "Bannière ajouté avec succès!");
	//Classified successfully added!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_ADDED", "Annonce ajouté avec succès!");
	//Event successfully added!
	define("LANG_MSG_EVENT_SUCCESSFULLY_ADDED", "Événement ajouté avec succès!");
	//Listing successfully added!
	define("LANG_MSG_LISTING_SUCCESSFULLY_ADDED", "Liste ajouté avec succès!");
	//Offres successfully added!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_ADDED", "Offres ajouté avec succès!");
	//Article successfully updated!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_UPDATED", "Article mis à jour ajouté avec succès!");
	//Banner successfully updated!
	define("LANG_MSG_BANNER_SUCCESSFULLY_UPDATED", "Bannière mise à jour ajouté avec succès!");
	//Classified successfully updated!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_UPDATED", "Annonce mise à jour ajouté avec succès!");
	//Event successfully updated!
	define("LANG_MSG_EVENT_SUCCESSFULLY_UPDATED", "Événement mis à jour ajouté avec succès!");
	//Listing successfully updated!
	define("LANG_MSG_LISTING_SUCCESSFULLY_UPDATED", "Liste mise à jour ajouté avec succès!");
	//Deal successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATED", "Offrir mise à jour ajouté avec succès!");
	//Map Tuning successfully updated!
	define("LANG_MSG_MAPTUNING_SUCCESSFULLY_UPDATED", "Carte des Réglages mis à jour ajouté avec succès!");
	//Deal was successfully deleted!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_DELETED", "Offrir a été supprimé avec succès!");
	//Deal successfully changed!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_CHANGED", "Offrir changé avec succès!");
	//Banner successfully deleted!
	define("LANG_MSG_BANNER_SUCCESSFULLY_DELETED", "Bannière supprimé avec succès!");
	//Invalid image type. Please insert a JPG, GIF or PNG image.
	define("LANG_MSG_INVALID_IMAGE_TYPE", "Type d'image non valide. S'il vous plaît d'insérer une image JPG, GIF ou PNG.");
	//Invalid file type. Please insert a SWF, GIF, JPEG or PNG file.
	define("LANG_MSG_INVALID_FILE_TYPE", "Type de fichier non valide. S'il vous plaît insérez un fichier SWF, GIF, JPEG ou PNG.");
	//The image file is too large
	define("LANG_MSG_IMAGE_FILE_TOO_LARGE", "Le fichier image est trop grande.");
	//Please try again with another image
	define("LANG_PLEASE_TRY_AGAIN_WITH_ANOTHER_IMAGE", "S'il vous plaît essayez de nouveau avec une autre image.");
	//Attached file was denied. Invalid file type.
	define("LANG_MSG_ATTACHED_FILE_DENIED", "Le fichier joint a été refusée. Type de fichier incorrect.");
	//Please type your username.
	define("LANG_MSG_TYPE_USERNAME", "S'il vous plaît entrez votre e-mail.");
	//Username was not found.
	define("LANG_MSG_USERNAME_WAS_NOT_FOUND", "E-mail n'a pas été trouvé.");
	//Please try again or contact support at:
	define("LANG_MSG_TRY_AGAIN_OR_CONTACT_SUPPORT", "S'il vous plaît essayez à nouveau ou contactez le support à l'adresse suivante:");
	//System Forgotten Password is disabled.
	define("LANG_MSG_FORGOTTEN_PASSWORD_DISABLED", "Le système 'mot de passe oublié' est désactivé.");
	//Please contact support at:
	define("LANG_MSG_CONTACT_SUPPORT", "S'il vous plaît contacter le support à l'adresse suivante:");
	//Thank you!
	define("LANG_MSG_THANK_YOU", "Merci!");
	//An e-mail was sent to the account holder with instructions to obtain a new password
	define("LANG_MSG_EMAIL_WAS_SENT_TO_ACCOUNT_HOLDER", "Un e-mail a été envoyé au titulaire du compte avec les instructions pour obtenir un nouveau mot de passe");
	//File not found!
	define("LANG_MSG_FILE_NOT_FOUND", "Fichier non trouvé!");
	//Click here to print the invoice
	define("LANG_MSG_CLICK_TO_PRINT_INVOICE", "Cliquez ici pour imprimer la facture");
	//Click here to view the invoice detail
	define("LANG_MSG_CLICK_TO_VIEW_INVOICE_DETAIL", "Cliquez ici pour consulter la facture détaillée");
	//(prices amount are per installments)
	define("LANG_MSG_PRICES_AMOUNT_PER_INSTALLMENTS", "(les prix sont par acomptes)");
	//Unpaid Item
	define("LANG_MSG_UNPAID_ITEM", "Objets non payés");
	//No Check Out Needed
	define("LANG_MSG_NO_CHECKOUT_NEEDED", "Pas de Check Out obligatoire");
	//(Move the mouse over the bars to see more details about the graphic)
	define("LANG_MSG_MOVE_MOUSEOVER_THE_BARS", "(Déplacez la souris sur les barres pour voir plus de détails sur le graphique)");
	//(Click the report type to display graph)
	define("LANG_MSG_CLICK_REPORT_TYPE", "(Cliquez sur le type de rapport pour afficher le graphique)");
	//Click here to view this review
	define("LANG_MSG_CLICK_TO_VIEW_THIS_REVIEW", "Cliquez ici pour voir cette évaluations");
	//Click here to edit this review
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REVIEW", "Cliquez ici pour éditer cette évaluations");
	//Click here to edit this reply
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REPLY", "Cliquez ici pour éditer cette réponse");
	//Click here to delete this review
	define("LANG_MSG_CLICK_TO_DELETE_THIS_REVIEW", "Cliquez ici pour supprimer cette évaluations");
	//Waiting Site Manager approve
	define("LANG_MSG_WAITINGSITEMGRAPPROVE", "En Attente d'Approbation du Gestionnaire de Site");
	//Waiting Site Manager approve for Review
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW", "Évaluations en Attente d'Approbation du Gestionnaire de Site");
	//Waiting Site Manager approve for Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REPLY", "Réponse en Attente d'Approbation du Gestionnaire de Site");
	//Waiting Site Manager approve for Review Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW_REPLY", "Évaluations et Réponse en Attente d'Approbation du Gestionnaire de Site");
	//Review already approved
	define("LANG_MSG_REVIEW_ALREADY_APPROVED", "Evaluation déjà Approuvé");
	//Review and Reply already approved
	define("LANG_MSG_REVIEWANDREPLY_ALREADY_APPROVED", "Evaluation et Réponse déjà Approuvé");
	//Review pending approval
	define("LANG_REVIEW_PENDINGAPPROVAL", "Evaluation en Attente d'Approbation");
	//Reply pending approval
	define("LANG_REPLY_PENDINGAPPROVAL", "Réponse en Attente d'Approbation");
	//Review active
	define("LANG_REVIEW_ACTIVE", "Evaluation Activer");
	//Reply active
	define("LANG_REPLY_ACTIVE", "Réponse Activer");
	//Review and Reply pending approval
	define("LANG_REVIEWANDREPLY_PENDINGAPPROVAL", "Evaluation et Réponse en Attente d'Approbation");
	//Review and Reply active
	define("LANG_REVIEWANDREPLY_ACTIVE", "Evaluation et Réponse Activer");
	//Reply
	define("LANG_REPLY", "Répondre");
	//Reply (noun)
	define("LANG_REPLYNOUN", "Réponse");
	//Review and Reply
	define("LANG_REVIEWANDREPLY", "Evaluation et Réponse");
	//Edit Review
	define("LANG_LABEL_EDIT_REVIEW", "Modifier Evaluation");
	//Edit Reply
	define("LANG_LABEL_EDIT_REPLY", "Modifier Réponse");
	//Approve Review
	define("LANG_SITEMGR_APPROVE_REVIEW", "Approuver Evaluation");
	//Approve Reply
	define("LANG_SITEMGR_APPROVE_REPLY", "Approuver Réponse");
	//Reply already approved
	define("LANG_MSG_RESPONSE_ALREADY_APPROVED", "Réponse déjà Approuvé");
	//Review successfully sent!
	define("LANG_REVIEW_SUCCESSFULLY", "Evaluation envoyé avec succès!");
	//Reply successfully sent!
	define("LANG_REPLY_SUCCESSFULLY", "Réponse envoyée avec succès!");
	//Please type a valid reply!
	define("LANG_REPLY_EMPTY", "S'il vous plaît taper une réponse valide!");
	//Please type a valid name
	define("LANG_REVIEW_EMPTY_NAME", "S'il vous plaît taper un nom valide!");
	//Please type a valid e-mail
	define("LANG_REVIEW_EMPTY_EMAIL", "S'il vous plaît taper un e-mail valide!");
	//Please type a valid city, State
	define("LANG_REVIEW_EMPTY_LOCATION", "S'il vous plaît taper una ville, région valide!");
	//Please type a valid review title
	define("LANG_REVIEW_EMPTY_TITLE", "S'il vous plaît taper un titre valide!");
	//Please type a valid review!
	define("LANG_REVIEW_EMPTY", "S'il vous plaît taper una evaluation valide!");
	//Please choose an option or click in cancel to exit.
	define("LANG_STATUS_EMPTY", "S'il vous plaît choisir une option ou cliquez sur annuler pour quitter.");
	//Click here to reply this review
	define("LANG_MSG_REVIEW_REPLY", "Cliquez ici pour répondre de cet evaluation");
	//Click here to view the transaction
	define("LANG_MSG_CLICK_TO_VIEW_TRANSACTION", "Cliquez ici pour visualiser la transaction");
	//Username must be between
	define("LANG_MSG_USERNAME_MUST_BE_BETWEEN", "E-mail doit être comprise entre");
	//characters with no spaces.
	define("LANG_MSG_CHARACTERS_WITH_NO_SPACES", "caractères sans espaces.");
	//Password must be between
	define("LANG_MSG_PASSWORD_MUST_BE_BETWEEN", "Mot de passe doit être compris entre");
	//Type you password here if you want to change it.
	define("LANG_MSG_TIPE_YOUR_PASSWORD_HERE_IF_YOU_WANT_TO_CHANGE_IT", "Tapez votre mot de passe ici si vous voulez le changer.");
	//Password is going to be sent to Member E-mail Address.
	define("LANG_MSG_PASSWORD_SENT_TO_MEMBER_EMAIL", "Mot de passe va être envoyé à l'adresse e-mail du membre.");
	//Please write down your username and password for future reference.
	define("LANG_MSG_WRITE_DOWN_YOUR_USERNAME_PASSWORD", "S'il vous plaît écrivez votre e-mail et mot de passe pour référence future.");
	//Please check the agreement terms.
	define("LANG_MSG_ALERT_AGREE_WITH_TERMS_OF_USE", "S\'il vous plaît vérifiez les termes du contrat.");
	//successfully added
	define("LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED", "Ajouté avec succès!");
	//This category was already inserted
	define("LANG_MSG_CATEGORY_ALREADY_INSERTED", "Cette catégorie a déjà été insérée");
	//Please, select a valid category
	define("LANG_MSG_SELECT_VALID_CATEGORY", "S'il vous plaît, choisissez une catégorie valide");
	//Please, select a category first
	define("LANG_MSG_SELECT_CATEGORY_FIRST", "S\'il vous plaît, choisissez une catégorie d\'abord");
	//You can choose a page name title to be accessed directly from the web browser as a static html page. The chosen page name title must contain only alphanumeric chars (like "a-z" and/or "0-9") and "-" instead of spaces.
	define("LANG_MSG_FRIENDLY_URL1", "Vous pouvez choisir que le titre du nom de la page soit directement accessibles à partir du navigateur Web comme une page html statique. Le choix du titre du nom de la page doit contenir uniquement des caractères alphanumériques (comme \"a-z\" et/ou \"0-9\") et \"-\" en lieu d'espaces");
	//The page name title "John Auto Repair" will be available through the url:
	define("LANG_MSG_FRIENDLY_URL2", "Titre du nom de la page");
	//Maximum file size
	define("LANG_MSG_MAX_FILE_SIZE", "Taille maximale du fichier");
	//Transparent .gif or .png not supported
	define("LANG_MSG_TRANSPARENTGIF_NOT_SUPPORTED", "Transparent .Gif ou .Png n'est pas pris en charge");
	//Animated .gif isn't supported.
	define("LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED", "Gif animé n'est pas supporté.");
	//Please be sure that your image dimensions fit within the recommended pixel sizes, otherwise, image quality can be effected.
	define("LANG_MSG_IMAGE_DIMENSIONS_ALERT", "S'il vous plaît assurez-vous que les dimensions de votre image en forme avec les dimensions recommandées des pixels, sinon la qualité d'image peut être affectée.");
	//Check this box to remove your existing image
	define("LANG_MSG_CHECK_TO_REMOVE_IMAGE", "Cochez cette case pour supprimer votre image");
	//maximum 250 characters
	define("LANG_MSG_MAX_250_CHARS", "250 caractères max");
	//maximum 100 characters
	define("LANG_MSG_MAX_100_CHARS", "al massimo 100 caratteri");
	//characters left
	define("LANG_MSG_CHARS_LEFT", "caractères restants");
	//(including spaces and line breaks)
	define("LANG_MSG_INCLUDING_SPACES_LINE_BREAKS", "(y compris les espaces et les sauts de ligne)");
	//Include up to
	define("LANG_MSG_INCLUDE_UP_TO_KEYWORDS", "Inclure jusqu'à");
	//keywords with a maximum of 50 characters each.
	define("LANG_MSG_KEYWORDS_WITH_MAXIMUM_50", "mots-clés avec un maximum de 50 caractères chacun.");
	//Add one keyword or keyword phrase per line.
	define("LANG_MSG_KEYWORD_PER_LINE", "Ajouter un mot-clé ou une expression par ligne.");
	//Only select sub-categories that directly apply to your type.
	define("LANG_MSG_ONLY_SELECT_SUBCATEGS", "Sélectionnez seulement les sous-catégories qui s'appliquent directement à votre type.");
	//Your article will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_ARTICLE_AUTOMATICALLY_APPEAR", "Votre article apparaîtra automatiquement dans la catégorie principale de chaque sous-catégorie que vous sélectionnez.");
	//maximum 25 characters
	define("LANG_MSG_MAX_25_CHARS", "25 caractères maximum");
	//maximum 500 characters
	define("LANG_MSG_MAX_500_CHARS", "500 caractères maximum");
	//Allowed file types
	define("LANG_MSG_ALLOWED_FILE_TYPES", "Types de fichiers acceptés");
	//Click here to preview this listing
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_LISTING", "Cliquez ici pour avoir un aperçu de cette liste");
	//Click here to preview this event
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_EVENT", "Cliquez ici pour avoir un aperçu de cet événement");
	//Click here to preview this classified
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_CLASSIFIED", "Cliquez ici pour avoir un aperçu de cette annonce");
	//Click here to preview this article
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_ARTICLE", "Cliquez ici pour avoir un aperçu de cet article");
	//Click here to preview this banner
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_BANNER", "Cliquez ici pour avoir un aperçu de cette bannière");
	//Click here to preview this deal
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_PROMOTION", "Cliquez ici pour avoir un aperçu de cet offrir");
	//maximum 30 characters
	define("LANG_MSG_MAX_30_CHARS", "30 caractères maximum");
	//Select a Country
	define("LANG_MSG_SELECT_A_COUNTRY", "Choisissez un Pays");
	//Select a Region
	define("LANG_MSG_SELECT_A_REGION", "Choisissez une Région");
	//Select a State
	define("LANG_MSG_SELECT_A_STATE", "Choisissez un État");
	//Select a City
	define("LANG_MSG_SELECT_A_CITY", "Choisissez une Ville");
	//Select a Neighborhood
	define("LANG_MSG_SELECT_A_NEIGHBORHOOD", "Choisissez un Quartier");
	//(This information will not be displayed publicly)
	define("LANG_MSG_INFO_NOT_DISPLAYED", "(Ces informations ne seront pas affichées publiquement)");
	//Your event will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_EVENT_AUTOMATICALLY_APPEAR", "Votre article apparaîtra automatiquement dans la catégorie principale de chaque sous-catégorie que vous sélectionnez.");
	//If video snippet code was filled in, it will appear on the detail page
	define("LANG_MSG_VIDEO_SNIPPET_CODE", "Si le code extrait vidéo a été rempli, il apparaîtra sur la page de détail");
	//Maximum video code size supported
	define("LANG_MSG_MAX_VIDEO_CODE_SIZE", "Taille maximale du code vidéo supporté");
	//If the video code size is bigger than supported video size, it will be modified.
	define("LANG_MSG_VIDEO_MODIFIED", "Si la taille de la vidéo est plus grande que la taille vidéo supportée, elle sera modifiée.");
	//Attachment has no caption
	define("LANG_MSG_ATTACHMENT_HAS_NO_CAPTION", "La pièce jointe n'a pas de légende");
	//Check this box to remove existing listing attachment
	define("LANG_MSG_CLICK_TO_REMOVE_ATTACHMENT", "Cochez cette case pour supprimer les pièces jointes de la Liste");
	//Add one phrase per line.
	define("LANG_MSG_PHRASE_PER_LINE", "Ajoutez une phrase par ligne.");
	//Extra categories cost an
	define("LANG_MSG_EXTRA_CATEGORIES_COST", "Catégories extras coûtent un");
	//additional
	define("LANG_MSG_ADDITIONAL", "supplément de");
	//each. Be seen!
	define("LANG_MSG_BE_SEEN", "chaque.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_LISTING_AUTOMATICALLY_APPEAR", "Votre liste apparaîtra automatiquement dans la catégorie principale de chaque sous-catégorie que vous sélectionnez.");
	//If you add new categories, your listing will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_LISTING_TEMPORARY_CATEGORY", "Si vous ajouter de nouvelles catégories, votre enterprise n'apparaîtra pas dans la catégorie principale de chaque sous-catégorie que vous avez ajouté que gestionnaire du site de les approuver.");
	//If you add new categories, your article will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_ARTICLE_TEMPORARY_CATEGORY", "Si vous ajouter de nouvelles catégories, votre article n'apparaîtra pas dans la catégorie principale de chaque sous-catégorie que vous avez ajouté que gestionnaire du site de les approuver.");
	//If you add new categories, your classified will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_CLASSIFIED_TEMPORARY_CATEGORY", "Si vous ajouter de nouvelles catégories, votre annonce n'apparaîtra pas dans la catégorie principale de chaque sous-catégorie que vous avez ajouté que gestionnaire du site de les approuver.");
	//If you add new categories, your event will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_EVENT_TEMPORARY_CATEGORY", "Si vous ajouter de nouvelles catégories, votre événement n'apparaîtra pas dans la catégorie principale de chaque sous-catégorie que vous avez ajouté que gestionnaire du site de les approuver.");
	//Request your listing to be considered for the following badges.
	define("LANG_MSG_REQUEST_YOUR_LISTING", "Demandez que votre liste soit prise en considération pour les badges suivantes.");
	//Click here to select date
	define("LANG_MSG_CLICK_TO_SELECT_DATE", "Cliquez ici pour sélectionner une date");
	//"Click on the" deal icon below if you wish to add deal to your listing.
	define("LANG_LISTING_CLICK_PROMOTION_BELOW", "Cliquez sur");
	//Click on the "deal icon" below if you wish to add deal to your listing.
	define("LANG_LISTING_PROMOTION_ICON", "l'icônes de le offrir");
	//Click on the deal icon "below if you wish to add deal to your listing."
	define("LANG_LISTING_IFYOUWISHADDPROMOTION", "ci-dessous si vous voulez ajouter un Offres à votre liste");
	//You can add deal to your listing by clicking on the link
	define("LANG_LISTING_YOUCANADDPROMOTION", "Vous pouvez ajouter un offrir à votre liste en cliquant sur le lien");
	//add deal
	define("LANG_LISTING_ADDPROMOTION", "ajouter un offrir");
	//All pages but item pages
	define("LANG_ALLPAGESBUTITEMPAGES", "Toutes les pages sauf les pages d'objets");
	//All pages
	define("LANG_ALLPAGES", "Toutes les pages");
    //All
	define("LANG_ALL", "Tous");
	//Non-category search
	define("LANG_NONCATEGORYSEARCH", "Recherche sans catégorie");
	//deal
	define("LANG_ICONPROMOTION", "offrir");
	//e-mail to friend
	define("LANG_ICONEMAILTOFRIEND", "e-mail un ami");
	//Add to Favorites
	define("LANG_ICONQUICKLIST_ADD", "Ajouter aux Favoris");
	//remove from favorites
	define("LANG_ICONQUICKLIST_REMOVE", "supprimer des favoris");
	//print
	define("LANG_ICONPRINT", "imprimer");
	//map
	define("LANG_ICONMAP", "carte");
	//Add to
	define("LANG_ADDTO_SOCIALBOOKMARKING", "Ajouter à");
	//Google maps are not available. Please contact the administrator.
	define("LANG_GOOGLEMAPS_NOTAVAILABLE_CONTACTADM", "Google Maps n'est pas disponible. S'il vous plaît contacter l'administrateur.");
	//Remove
	define("LANG_QUICKLIST_REMOVE", "Supprimer");
	//Favorite Articles
	define("LANG_FAVORITE_ARTICLE", "Articles Favoris");
	//Favorite Classifieds
	define("LANG_FAVORITE_CLASSIFIED", "Annonces Favoris");
	//Favorite Events
	define("LANG_FAVORITE_EVENT", "Evénements Favoris");
	//Favorite Listings
	define("LANG_FAVORITE_LISTING", "Listes Favories");
	//Favorite Deals
	define("LANG_FAVORITE_PROMOTION", "Offres Favories");
	//Published
	define("LANG_ARTICLE_PUBLISHED", "Publié");
	//More Info
	define("LANG_CLASSIFIED_MOREINFO", "Plus d'Info");
	//Date
	define("LANG_EVENT_DATE", "Date");
	//Time
	define("LANG_EVENT_TIME", "Heure");
	//Get driving directions
	define("LANG_EVENT_DRIVINGDIRECTIONS", "Obtenir l'itinéraire");
	//Website
	define("LANG_EVENT_WEBSITE", "Web site");
	//phone
	define("LANG_EVENT_LETTERPHONE", "Téléphone");
	//More
	define("LANG_EVENT_MORE", "Plus");
	//More Info
	define("LANG_EVENT_MOREINFO", "Plus d'Info");
	//See all categories
	define("LANG_SEEALLCATEGORIES", "Voir toutes les catégories");
	//View all listing categories
	define("LANG_LISTING_VIEWALLCATEGORIES", "Afficher toutes les catégories");
	//More Info
	define("LANG_LISTING_MOREINFO", "Plus d'Info");
	//view phone
	define("LANG_LISTING_VIEWPHONE", "afficher le téléphone");
	//view fax
	define("LANG_LISTING_VIEWFAX", "afficher le fax");
	//Send Email
	define("LANG_SEND_AN_EMAIL", "Envoyer un E-mail");
	//Click here to see more info!
	define("LANG_LISTING_ATTACHMENT", "Cliquez ici pour avoir plus d'infos!");
	//Download [item] Menu
	define("LANG_LISTING_DOWNLOADMENU", "Télécharger le Menu de [item]");
	//Complete the form below to contact us.
	define("LANG_LISTING_CONTACTTITLE", "Pour nous contacter, merci de remplir le formulaire ci-dessous ");
	//Contact this Listing
	define("LANG_LISTING_CONTACT", "Communiquez cette Liste");
	//E-mail an inquiry
	define("LANG_LISTING_INQUIRY", "Soumettre question");
	//phone
	define("LANG_LISTING_LETTERPHONE", "téléphone");
	//fax
	define("LANG_LISTING_LETTERFAX", "fax");
	//website
	define("LANG_LISTING_LETTERWEBSITE", "web site");
	//e-mail
	define("LANG_LISTING_LETTEREMAIL", "e-mail");
	//offers the following products and/or services:
	define("LANG_LISTING_OFFERS", "offre les produits et/ou services suivants:");
	//Hours
	define("LANG_LISTING_HOURS_OF_WORK", "Heures de travail");
	//Check in
	define("LANG_CHECK_IN", "Vérifier dans");
	//No review comment found for this item!
	define("LANG_REVIEW_NORECORD", "Pas de commentaire trouvé pour l'examen de ce point!");
	//Reviews and comments from the last month
	define("LANG_REVIEWS_MONTH", "Revisiones et commentaires du dernier mois");
	//Review
	define("LANG_REVIEW", "Revisione");
	//Reviews
	define("LANG_REVIEW_PLURAL", "Revisiones");
	//Reviews
	define("LANG_REVIEWTITLE", "Revisiones");
	//review
	define("LANG_REVIEWCOUNT", "revisione");
	//reviews
	define("LANG_REVIEWCOUNT_PLURAL", "revisiones");
	//Check In
	define("LANG_CHECKINCOUNT", "Vérifier Dans");
	//Check ins
	define("LANG_CHECKINCOUNT_PLURAL", "Vérifier dans");
	//See check ins
	define("LANG_CHECKINSEECOMMENTS", "Voir vérifier ins");
	//Check ins of
	define("LANG_CHECKINSOF", "Vérifier ins");
	//No check in found for this item!
	define("LANG_CHECKIN_NORECORD", "Pas de vérifier trouvé pour l'examen de ce point!");
	//Related Categories
	define("LANG_RELATEDCATEGORIES", "Catégories Associés");
	//Related Listings
	define("LANG_RELATEDLISTINGS", "Listes Associés");
	//Subcategories
	define("LANG_LISTING_SUBCATEGORIES", "Sous-catégories");
	//See comments
	define("LANG_REVIEWSEECOMMENTS", "Regarder les commentaires");
    //Pending Reviews
    define("LANG_REVIEW_PENDING", "Commentaires en Attente");
    //Approve
    define("LANG_REVIEW_APPROVE", "Approuver");
	//Rate It!
	define("LANG_REVIEWRATEIT", "Donnez votre avis!");
	//Be the first to review this item!
	define("LANG_REVIEWBETHEFIRST", "Soyez le premier à donner!");
	//Offered by
	define("LANG_PROMOTION_OFFEREDBY", "Offert par");
	//More Info
	define("LANG_PROMOTION_MOREINFO", "Plus d'Info");
	//Valid from
	define("LANG_PROMOTION_VALIDFROM", "Valable à partir du");
	//to
	define("LANG_PROMOTION_VALIDTO", "à");
	//Print Deal
	define("LANG_PROMOTION_PRINT", "Imprimer");
	//Article
	define("LANG_ARTICLE_FEATURE_NAME", "Article");
	//Articles
	define("LANG_ARTICLE_FEATURE_NAME_PLURAL", "Articles");
	//Blog
	define("LANG_BLOG_FEATURE_NAME", "Blog");
	//Banner
	define("LANG_BANNER_FEATURE_NAME", "Bannière");
	//Banners
	define("LANG_BANNER_FEATURE_NAME_PLURAL", "Bannières");
	//Classified
	define("LANG_CLASSIFIED_FEATURE_NAME", "Annonce");
	//Classifieds
	define("LANG_CLASSIFIED_FEATURE_NAME_PLURAL", "Annonces");
	//Event
	define("LANG_EVENT_FEATURE_NAME", "Événement");
	//Events
	define("LANG_EVENT_FEATURE_NAME_PLURAL", "Événements");
	//Listing
	define("LANG_LISTING_FEATURE_NAME", "Liste");
	//Listings
	define("LANG_LISTING_FEATURE_NAME_PLURAL", "Listes");
	//Deal
	define("LANG_PROMOTION_FEATURE_NAME", "Offrir");
	//Deals
	define("LANG_PROMOTION_FEATURE_NAME_PLURAL", "Offres");
	//Send
	define("LANG_BUTTON_SEND", "Envoyer");
	//Sign Up
	define("LANG_BUTTON_SIGNUP", "S'inscrire");
	//View Category Path
	define("LANG_BUTTON_VIEWCATEGORYPATH", "Voir le plan de Catégorie");
	//More info
	define("LANG_VIEWCATEGORY", "Plus d'info");
	//No info found
	define("LANG_NOINFO", "Pas d'infos trouvées");
	//Remove Selected Category
	define("LANG_BUTTON_REMOVESELECTEDCATEGORY", "Supprimer la Catégorie Choisie");
	//Continue
	define("LANG_BUTTON_CONTINUE", "Continuer");
	//No, thank you
	define("LANG_BUTTON_NO_THANKS", "Non, merci");
	//Yes, continue
	define("LANG_BUTTON_YES_CONTINUE", "Oui, continuer.");
	//No, Order without the Package!
	define("LANG_BUTTON_NO_ORDER_WITHOUT", "Non, sans ordonnance le Paquet.");
	//Increase your Visibility!
	define("LANG_INCREASE_VISIBILITY", "Augmentez votre Visibilité!");
	//Gift
	define("LANG_GIFT", "Présent");
	//Help to Increase your visibility, check our
	define("LANG_HELP_INCREASE", "Aider à augmenter votre visibilité, consultez notre ");
	//Site statistics
	define("LANG_DOMAIN_STATISTICS", "Statistiques du site!");
	//Visitors per Month
	define("LANG_VISITOR_MONTH", "Visiteurs par Mois");
	//Custom option
	define("LANG_CUSTOM_OPTION", "Option personnalisée");
	//Ok
	define("LANG_BUTTON_OK", "Ok");
	//Cancel
	define("LANG_BUTTON_CANCEL", "Annuler");
	//Log in
	define("LANG_BUTTON_LOGIN", "Connexion");
	//Save Map Tuning
	define("LANG_BUTTON_SAVE_MAP_TUNING", "Enregistrez la Carte des Réglages");
	//Clear Map Tuning
	define("LANG_BUTTON_CLEAR_MAP_TUNING", "Effacer Carte Des Réglages");
	//Next
	define("LANG_BUTTON_NEXT", "Suivant");
	//Pay By CreditCard
	define("LANG_BUTTON_PAY_BY_CREDIT_CARD", "Payer par Carte de Crédit");
	//Pay By PayPal
	define("LANG_BUTTON_PAY_BY_PAYPAL", "Payer par PayPal");
	//Pay By SimplePay
	define("LANG_BUTTON_PAY_BY_SIMPLEPAY", "Payer par SimplePay");
	//Search
	define("LANG_BUTTON_SEARCH", "Rechercher");
	//Advanced
	define("LANG_BUTTON_ADVANCEDSEARCH", "Avancée");
	//Advanced Search Close
	define("LANG_BUTTON_ADVANCEDSEARCH_CLOSE", "Fini");
	//Clear
	define("LANG_BUTTON_CLEAR", "Effacer");
	//Add your Article
	define("LANG_BUTTON_ADDARTICLE", "Ajouter votre Article");
	//Add your Classified
	define("LANG_BUTTON_ADDCLASSIFIED", "Ajouter votre Annonce");
	//Add your Event
	define("LANG_BUTTON_ADDEVENT", "Ajouter votre Événement");
	//Add your Listing
	define("LANG_BUTTON_ADDLISTING", "Ajouter votre Liste");
	//Add your Deal
	define("LANG_BUTTON_ADDPROMOTION", "Ajouter votre Offrir");
	//Home
	define("LANG_BUTTON_HOME", "Accueil");
	//Manage Account
	define("LANG_BUTTON_MANAGE_ACCOUNT", "Gérer Compte");
	//Manage Content
	define("LANG_MANAGE_CONTENT", "Gérez le Contenu");
	//Sponsor
	define("LANG_SPONSOR_AREA", "Sponsor");
	//Site Manager
	define("LANG_SITEMGR_AREA", "Administration");
	//Site Manager Section
	define("LANG_LABEL_SITEMGR_SECTION", "Section Administrative");
	//Help
	define("LANG_BUTTON_HELP", "Aide");
	//Sign out
	define("LANG_BUTTON_LOGOUT", "Déconnexion");
	//Submit
	define("LANG_BUTTON_SUBMIT", "Envoyer");
	//Update
	define("LANG_BUTTON_UPDATE", "Envoyer");
	//Back
	define("LANG_BUTTON_BACK", "Retour");
	//Delete
	define("LANG_BUTTON_DELETE", "Supprimer");
	//Complete the Process
	define("LANG_BUTTON_COMPLETE_THE_PROCESS", "Compléter le Processus");
	//Please enter the text you see in the image at the left into the textbox. This is required to prevent automated submission of contact requests.
	define("LANG_CAPTCHA_HELP", "Entrez le texte que vous voyez dans l'image à gauche dans la zone de texte. Cela est nécessaire pour éviter la soumission automatique de demandes de contact.");
	//Verification Code image cannot be displayed
	define("LANG_CAPTCHA_ALT", "Le Code de Vérification ne peut pas s'afficher");
	//Verification Code
	define("LANG_CAPTCHA_TITLE", "Code de Vérification");
	//Please select a rating for this item
	define("LANG_MSG_REVIEW_SELECTRATING", "S'il vous plaît choisir un avis pour cet article");
	//Fraud detected! Please select a rating for this item!
	define("LANG_MSG_REVIEW_FRAUD_SELECTRATING", "Fraude détectée! S'il vous plaît choisir un avis pour cet article!");
	//"Comment" and "Comment Title" are required to post a comment!
	define("LANG_MSG_REVIEW_COMMENTREQUIRED", "\"Titre du Commentaire\" et \"Commentaire\" sont nécessaires pour poster un commentaire!");
	//"Name" and "E-mail" are required to post a comment!
	define("LANG_MSG_REVIEW_NAMEEMAILREQUIRED", "\"Nom\" et \"E-mail\" sont nécessaires pour poster un commentaire!");
	//"City, State" are required to post a comment!
	define("LANG_MSG_REVIEW_CITYSTATEREQUIRED", "\"Ville, Région\" sont nécessaires pour poster un commentaire!");
	//Please type a valid e-mail address!
	define("LANG_MSG_REVIEW_TYPEVALIDEMAIL", "Entrez un e-mail valide s'il vous plait!");
	//You have already given your opinion on this item. Thank you.
	define("LANG_MSG_REVIEW_YOUALREADYGIVENOPINION", "Vous avez déjà donné votre avis sur ce point. Merci.");
	//Thanks for the feedback!
	define("LANG_MSG_REVIEW_THANKSFEEDBACK", "Merci pour les commentaires!");
	//Your review has been submitted for approval.
	define("LANG_MSG_REVIEW_REVIEWSUBMITTEDAPPROVAL", "Votre évaluation a été soumise pour approbation.");
	//No payment method was selected!
	define("LANG_MSG_NO_PAYMENT_METHOD_SELECTED", "Le mode de paiement n'a pas été sélectionné!");
	//Wrong credit card expiration date. Please, try again.
	define("LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN", "La date d'expiration de la carte de crédit est incorrecte. Essayez de nouveau s'il vous plaît.");
	//Click here to try again
	define("LANG_MSG_CLICK_HERE_TO_TRY_AGAIN", "Cliquez ici pour essayer de nouveau");
	//Payment transactions may not occur immediately.
	define("LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY", "Les opérations de paiement ne sont pas immédiates.");
	//After your payment is processed, information about your transaction
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT", "Après traitement de votre paiement, les informations sur votre transaction");
	//may be found in your transaction history.
	define("LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY", "se trouveront dans l'historique de vos transactions.");
	//"may be found in your" transaction history
	define("LANG_MSG_MAY_BE_FOUND_IN_YOUR", "se trouveront dans");
	//The payment gateway is not available currently
	define("LANG_MSG_PAYMENT_GATEWAY_NOT_AVAILABLE", "La passerelle de paiement n'est pas disponible actuellement");
	//The payment parameters could not be validated
	define("LANG_MSG_PAYMENT_INVALID_PARAMS", "Les paramètres du paiement n'ont pas pu être validés");
	//Internal gateway error was encountered
	define("LANG_MSG_INTERNAL_GATEWAY_ERROR", "Une erreur interne s'est produite sur la passerelle");
	//Information about your transaction may be found
	define("LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND", "Des informations sur votre transaction peuvent être retrouvées");
	//in your transaction history.
	define("LANG_MSG_IN_YOUR_TRANSACTION_HISTORY", "dans l'historique de vos transactions.");
	//in your
	define("LANG_MSG_IN_YOUR", "dans votre");
	//No Transaction ID
	define("LANG_MSG_NO_TRANSACTION_ID", "Pas d'ID de Transaction");
	//System failure, please try again.
	define("LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN", "Défaillance du système, essayez de nouveau s'il vous plaît.");
	//Please, fill in all required fields.
	define("LANG_MSG_FILL_ALL_REQUIRED_FIELDS", "S'il vous plaît remplir tous les champs obligatoires.");
	//Could not connect.
	define("LANG_MSG_COULD_NOT_CONNECT", "Connexion impossible.");
	//Thank you for setting up your items and for making the payment!
	define("LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT", "Merci d'avoir mis en place vos objets et d'avoir fait le paiement!");
	//Site manager will review your items and set it live within 2 working days.
	define("LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS", "Le gestionnaire de site passera en revue vos objets et ils seront disponibles dans les 2 jours ouvrables.");
	//The payment gateway could not respond
	define("LANG_MSG_PAYMENT_GATEWAY_COULD_NOT_RESPOND", "La passerelle de paiement ne peut pas répondre");
	//Pending payments may take 3 to 4 days to be approved.
	define("LANG_MSG_PENDING_PAYMENTS_TAKE_3_4_DAYS_TO_BE_APPROVED", "Paiements en attente peuvent prendre 3 à 4 jours avant d'être approuvé.");
	//Connection Failure
	define("LANG_MSG_CONNECTION_FAILURE", "Problème avec la Connexion");
	//Please, fill correctly zip.
	define("LANG_MSG_FILL_CORRECTLY_ZIP", "S'il vous plaît remplir correctement le code postal.");
	//Please, fill correctly card verification number.
	define("LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER", "S'il vous plaît remplir correctement le code de sécurité.");
	//Card Type and Card Verification Number do not match.
	define("LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH", "Le Type de Carte et le Code de Sécurité ne correspondent pas.");
	//Transaction Not Completed.
	define("LANG_MSG_TRANSACTION_NOT_COMPLETED", "La Transaction n'est pas Terminée.");
	//Error Number:
	define("LANG_MSG_ERROR_NUMBER", "Numéro d'erreur:");
	//Short Message
	define("LANG_MSG_SHORT_MESSAGE", "Message court");
	//Long Message
	define("LANG_MSG_LONG_MESSAGE", "Message long");
	//Transaction Completed Successfully.
	define("LANG_MSG_TRANSACTION_COMPLETED_SUCCESSFULLY", "Transaction Effectuée avec Succès.");
	//Card expire date must be in the future
	define("LANG_MSG_CARD_EXPIRE_DATE_IN_FUTURE", "La date d'expiration de la Carte doit être une date future");
	//If your transaction was confirmed, information about it may be found in
	define("LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED", "Si votre transaction a été confirmée, vous pouvez trouver des informations dans");
	//your transaction history after your payment is processed.
	define("LANG_MSG_YOUR_TRANSACTION_AFTER_PAYMENT_PROCESSED", "l'historique de vos transactions, après traitement de votre paiement.");
	//after your payment is processed.
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED", "après traitement de votre paiement.");
	//No items requiring payment.
	define("LANG_MSG_NO_ITEMS_REQUIRING_PAYMENT", "Aucun élément exigeant paiement.");
	//Pay for outstanding invoices
	define("LANG_MSG_PAY_OUTSTANDING_INVOICES", "Payer les factures impayées");
	//Banner by Impression and Custom Invoices can be paid once.
	define("LANG_MSG_BANNER_CUSTOM_INVOICE_PAID_ONCE", "Bannière par affichage et factures personnalisées peuvent être payé une fois.");
	//Banner by Impression can be paid once.
	define("LANG_MSG_BANNER_PAID_ONCE", "Bannière par affichage peut être payé une fois.");
	//Custom Invoices can be paid once.
	define("LANG_MSG_CUSTOM_INVOICE_PAID_ONCE", "Facture Personnalisé peut être payé une fois.");
	//View Items
	define("LANG_VIEWITEMS", "Voir les Articles");
	//Please do not use recurring payment system.
	define("LANG_MSG_PLEASE_DO_NOT_USE_RECURRING_PAYMENT_SYSTEM", "S'il vous plaît ne pas utiliser le système de paiement récurrent.");
	//Multiple Items
	define("LANG_ORDER_MULTIPLEITEMS", "Plusieurs articles");
	//Try again!
	define("LANG_MSG_TRY_AGAIN", "Essayez de nouveau!");
	//All fields are required.
	define("LANG_MSG_ALL_FIELDS_REQUIRED", "Tous les champs sont obligatoires.");
	//"You have more than" X items. Please contact the administrator to check out it.
	define("LANG_MSG_OVERITEM_MORETHAN", "Vous avez plus de");
	//You have more than X items. "Please contact the administrator to check out it".
	define("LANG_MSG_OVERITEM_CONTACTADMIN", "S'il vous plaît contactez l'administrateur pour effectuer votre paiement.");
	//Article Options
	define("LANG_ARTICLE_OPTIONS", "Options de l'Article");
	//Article Author
	define("LANG_ARTICLE_AUTHOR", "Auteur de l'Article");
	//Article Author URL
	define("LANG_ARTICLE_AUTHOR_URL", "URL de l'Auteur");
	//Article Categories
	define("LANG_ARTICLE_CATEGORIES", "Catégorie de l'Article");
	//Banner Type
	define("LANG_BANNER_TYPE", "Type de Bannière ");
	//Banner Options
	define("LANG_BANNER_OPTIONS", "Options de la Bannière");
	//Order Banner
	define("LANG_ORDER_BANNER", "Commander Bannière");
	//By time period
	define("LANG_BANNER_BY_TIME_PERIOD", "Par période de temps");
	//Banner Details
	define("LANG_BANNER_DETAIL_PLURAL", "Détails de Bannière ");
	//Script Banner
	define("LANG_SCRIPT_BANNER", "Script Bannière");
	//Show by Script Code
	define("LANG_SHOWSCRIPTCODE", "Afficher par Code Script");
	//Allow script to be entered instead of an image. This field allows you to paste in script that will be used to display the banner from an affiliate program or external banner system. If "Show by Script Code" is checked, just "Script" field will be required. The other fields below will not be necessary.
	define("LANG_SCRIPTCODEHELP", "Permettre de rentrer un script au lieu d'une image. Ce champ vous permet de coller le script qui sera utilisé pour afficher la bannière d'un programme affilié ou d'un système de bannière externe. Si \"Afficher par Script Code\" est cochée, seulement le champ \"Script\" sera nécessaire. Les autres champs ci-dessous ne seront pas obligatoires.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload script banners.
	define("LANG_SCRIPTCODEHELP2", "Les deux \"Destination Url\" et \"Trafic Cliquez Grâce\" n'a aucun effet lorsque vous téléchargez le script de bannières.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload swf file
	define("LANG_BANNERFILEHELP", "Les deux \"Url Destination\" et \"Trafic Cliquez Grâce\" n'ont aucun effet lorsque vous téléchargez des fichiers swf");
	//Classified Level
	define("LANG_CLASSIFIED_LEVEL", "Niveau de l'Annonce");
	//Classified Category
	define("LANG_CLASSIFIED_CATEGORY", "Catégorie de l'Annonce");
	//Select classified level
	define("LANG_MENU_SELECT_CLASSIFIED_LEVEL", "Choisissez le niveau de l'Annonce");
	//Classified Options
	define("LANG_CLASSIFIED_OPTIONS", "Options de l'Annonce");
	//Event Level
	define("LANG_EVENT_LEVEL", "Niveau de l'Événement");
	//Event Categories
	define("LANG_EVENT_CATEGORY_PLURAL", "Catégories de l'Événement");
	//Event Categories
	define("LANG_EVENT_CATEGORIES", "Catégories de l'Événement");
	//Select event level
	define("LANG_MENU_SELECT_EVENT_LEVEL", "Choisissez le niveau de l'événement");
	//Event Options
	define("LANG_EVENT_OPTIONS", "Options de l'Événement");
	//Listing Level
	define("LANG_LISTING_LEVEL", "Niveau de la Liste");
	//Listing Type
	define("LANG_LISTING_TEMPLATE", "Type d'annonce");
	//Listing Categories
	define("LANG_LISTING_CATEGORIES", "Catégories de la Liste");
	//Listing Badges
	define("LANG_LISTING_DESIGNATION_PLURAL", "Badges de la Liste ");
	//Subject to administrator approval.
	define("LANG_LISTING_SUBJECTTOAPPROVAL", "Sous réserve de l'approbation de l'administrateur.");
	//Select this choice
	define("LANG_LISTING_SELECT_THIS_CHOICE", "Sélectionnez ce choix");
	//Select listing level
	define("LANG_MENU_SELECTLISTINGLEVEL", "Sélectionnez le niveau de la liste");
	//Select event level
	define("LANG_MENU_SELECTEVENTLEVEL", "Sélectionnez le niveau de l'événement");
	//Select classified level
	define("LANG_MENU_SELECTCLASSIFIEDLEVEL", "Sélectionnez le niveau de l'annonce");
	//Listing Options
	define("LANG_LISTING_OPTIONS", "Options de la Liste ");
	//Payment System is not available. Please contact the
	define("LANG_GATEWAY_NO_AVAILABLE", "Le Système de Paiement n'est pas disponible. S'il vous plaît contacter");
	//Upload Warning
	define("LANG_UPLOAD_WARNING", "Télécharger une Alerte");
	//File successfully uploaded!
	define("LANG_UPLOAD_MSG_SUCCESSUPLOADED", "Fichier téléchargé avec succès!");
	//Extension not allowed or wrong file type!
	define("LANG_UPLOAD_MSG_NOTALLOWED_WRONGFILETYPE", "L'extension du fichier n'est pas autorisée ou le type de fichier est incorrect!");
	//File exceeds size limit!
	define("LANG_UPLOAD_MSG_EXCEEDSLIMIT", "Le fichier dépasse la taille maximale autorisée!");
	//Fail trying to create directory!
	define("LANG_UPLOAD_MSG_FAILCREATEDIRECTORY", "Impossible de créer le répertoire!");
	//Wrong directory permission!
	define("LANG_UPLOAD_MSG_WRONGDIRECTORYPERMISSION", "Permissions du répertoire incorrect!");
	//Unexpected failure!
	define("LANG_UPLOAD_MSG_UNEXPECTEDFAILURE", "Échec inattendu!");
	//File not found or not entered!
	define("LANG_UPLOAD_MSG_NOTFOUND_NOTENTERED", "Fichier non trouvé ou le nom du fichier n'a pas été rentré!");
	//File already exists in directory!
	define("LANG_UPLOAD_MSG_FILEALREADEXISTSINDIRECTORY", "Le fichier existe déjà dans le répertoire!");
	//View all locations
	define("LANG_VIEWALLLOCATIONSCATEGORIES", "Voir tous les Emplacement");
	//Featured Locations
	define("LANG_FEATUREDLOCATIONS", "Sites en Vedette");
	//There aren't any featured location in the system.
	define("LANG_LABEL_NOFEATUREDLOCATIONS", "Il n'y a pas un endroit aussi dans le système.");
	//Overview
	define("LANG_LABEL_OVERVIEW", "Présentation");
	//Video
	define("LANG_LABEL_VIDEO", "Vidéo");
	//Map Location
	define("LANG_LABEL_MAPLOCATION", "Emplacement sur la Carte");
	//More Listings
	define("LANG_LABEL_MORELISTINGS", "Plus Listes");
	//More Events
	define("LANG_LABEL_MOREEVENTS", "Plus Événements");
	//More Classifieds
	define("LANG_LABEL_MORECLASSIFIEDS", "Plus Annonces");
	//More Articles
	define("LANG_LABEL_MOREARTICLES", "Plus Articles");
    //More Promotions
    define("LANG_LABEL_MOREPROMOTIONS", "Plus Offrir");
    //More Posts
    define("LANG_LABEL_MOREPOSTS", "Plus Postes");
	//"Operation not allowed: The deal" (deal_name) is already associated with the listing
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED1", "Opération non permise: le offrir");
	//Operation not allowed: The deal (deal_name) "is already associated with the listing"
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED2", "est déjà associé avec l'liste");
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
	define("LANG_MSG_CLICKADDTOSELECTCATEGORIES", "Cliquez sur \"Ajouter\" pour sélectionner des catégories");
	//Click on "Add main category" or "Add sub-category" to type your new categories
	define("LANG_MSG_CLICKADDTOADDCATEGORIES", "Cliquez sur \"Ajouter une catégorie principale\" ou \"Ajouter sous-catégorie\" à taper votre nouvelles catégories");
	//Add an
	define("LANG_ADD_AN", "Ajouter un");
	//Add a
	define("LANG_ADD_A", "Ajouter un");
	//on these sites
	define("LANG_ON_SITES", "sur ces sites:");
	//on this site
	define("LANG_ON_SITES_SINGULAR", "sur ce site:");

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
	define("LANG_GALLERYTITLE", "Galerie de photos");
	//"Click here" for Slideshow. You can also click on any of the photos to start slideshow.
	define("LANG_GALLERYCLICKHERE", "Cliquez ici");
	//Click here "for Slideshow. You can also click on any of the photos to start slideshow."
	define("LANG_GALLERYSLIDESHOWTEXT", "pour le diaporama. Vous pouvez également cliquer sur une photo pour démarrer le diaporama.");
	//more photos
	define("LANG_GALLERYMOREPHOTOS", "plus de photos");
	//Inexistent Discount Code
	define("LANG_MSG_INEXISTENT_DISCOUNT_CODE", "Code de Rabais Inexistant");
	//is not available.
	define("LANG_MSG_IS_NOT_AVAILABLE", "Non disponible.");
	//is not available for this item type.
	define("LANG_MSG_IS_NOT_AVAILABLE_FOR", "Non disponible pour ce type d'objet.");
	//cannot be used twice.
	define("LANG_MSG_CANNOT_BE_USED_TWICE", "ne peut pas être utilisé deux fois.");
	//Title is required.
	define("LANG_MSG_TITLE_IS_REQUIRED", "Le Titre est obligatoire.");
	//Language is required.
	define("LANG_MSG_LANGUAGE_IS_REQUIRED", "La Langue est obligatoire.");
	//First Name is required.
	define("LANG_MSG_FIRST_NAME_IS_REQUIRED", "Le Prénom est obligatoire.");
	//Last Name is required.
	define("LANG_MSG_LAST_NAME_IS_REQUIRED", "Le Nom de Famille est obligatoire.");
	//Company is required.
	define("LANG_MSG_COMPANY_IS_REQUIRED", "L'Entreprise est obligatoire.");
	//Phone is required.
	define("LANG_MSG_PHONE_IS_REQUIRED", "Le Numéro de Téléphone est obligatoire.");
	//E-mail is required.
	define("LANG_MSG_EMAIL_IS_REQUIRED", "L'Adresse E-mail est obligatoire.");
	//Account is required.
	define("LANG_MSG_ACCOUNT_IS_REQUIRED", "Le Compte est obligatoire.");
	//Page Name is required.
	define("LANG_MSG_PAGE_NAME_IS_REQUIRED", "Le Nom de la Page est obligatoire.");
	//Category is required.
	define("LANG_MSG_CATEGORY_IS_REQUIRED", "La Catégorie est obligatoire.");
	//Abstract is required.
	define("LANG_MSG_ABSTRACT_IS_REQUIRED", "Le Résumé est obligatoire.");
	//Expiration type is required.
	define("LANG_MSG_EXPIRATION_TYPE_IS_REQUIRED", "Le type d'Expiration est obligatoire.");
	//Renewal Date is required.
	define("LANG_MSG_RENEWAL_DATE_IS_REQUIRED", "La Date de Renouvellement est obligatoire.");
	//Impressions are required.
	define("LANG_MSG_IMPRESSIONS_ARE_REQUIRED", "Les affichages sont obligatoires.");
	//File is required.
	define("LANG_MSG_FILE_IS_REQUIRED", "Le Fichier est obligatoire.");
	//Type is required.
	define("LANG_MSG_TYPE_IS_REQUIRED", "Le Type est obligatoire.");
	//Caption is required.
	define("LANG_MSG_CAPTION_IS_REQUIRED", "La Légende est obligatoire.");
	//Script Code is required.
	define("LANG_MSG_SCRIPT_CODE_IS_REQUIRED", "Le Code Script est obligatoire.");
	//Description 1 is required.
	define("LANG_MSG_DESCRIPTION1_IS_REQUIRED", "La Description 1 est obligatoire.");
	//Description 2 is required.
	define("LANG_MSG_DESCRIPTION2_IS_REQUIRED", "La Description 2 est obligatoire.");
	//Name is required.
	define("LANG_MSG_NAME_IS_REQUIRED", "Le Nom est obligatoire.");
	//Deal Title is required.
	define("LANG_MSG_HEADLINE_IS_REQUIRED", "Titre du Offrir est obligatoire.");
	//"Offer" is required.
	define("LANG_MSG_OFFER_IS_REQUIRED", "Offre est obligatoire.");
	//"Start Date" is required.
	define("LANG_MSG_START_DATE_IS_REQUIRED", "Date de début est obligatoire.");
	//"End Date" is required.
	define("LANG_MSG_END_DATE_IS_REQUIRED", "Date de Fin est obligatoire.");
	//Message is required.
	define("LANG_MSG_TEXT_IS_REQUIRED", "Le Texte est obligatoire.");
	//Username is required.
	define("LANG_MSG_USERNAME_IS_REQUIRED", "E-mail est nécessaire.");
	//"Current Password" is incorrect.
	define("LANG_MSG_CURRENT_PASSWORD_IS_INCORRECT", "\"Mot de passe actuel\" est incorrecte.");
	//Password is required.
	define("LANG_MSG_PASSWORD_IS_REQUIRED", "Mot de passe est obligatoire.");
	//"Agree to terms of use" is required.
	define("LANG_MSG_IGREETERMS_IS_REQUIRED", "\"Accepter les termes d'utilisation\" est obligatoire.");
	//The following fields were not filled or contain errors:
	define("LANG_MSG_FIELDS_CONTAIN_ERRORS", "Les champs suivants ne sont pas remplis ou ils contiennent des erreurs:");
	//Title - Please fill out the field
	define("LANG_MSG_TITLE_PLEASE_FILL_OUT", "Titre - S'il vous plaît remplir le champ");
	//Page Name - Please fill out the field
	define("LANG_MSG_PAGE_NAME_PLEASE_FILL_OUT", "Nom de la page - S'il vous plaît remplir le champ");
	//"Maximum of" [MAX_CATEGORY_ALLOWED] categories are allowed
	define("LANG_MSG_MAX_OF_CATEGORIES_1", "Maximum de");
	//Maximum of [MAX_CATEGORY_ALLOWED] "categories are allowed"
	define("LANG_MSG_MAX_OF_CATEGORIES_2", "catégories sont autorisées.");
	//Friendly URL Page Name already in use, please choose another Page Name.
	define("LANG_MSG_FRIENDLY_URL_IN_USE", "URL Facile est en cours d'utilisation, s'il vous plaît choisir un autre URL Facile.");
	//Page Name contain invalid chars
	define("LANG_MSG_PAGE_NAME_INVALID_CHARS", "Le Nom de la page contient des caractères non valides");
	//"Maximum of" [MAX_KEYWORDS] keywords are allowed
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1", "Maximum de");
	//Maximum of [MAX_KEYWORDS] "keywords are allowed"
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2", "mots-clés sont autorisés");
	//Please include keywords with a maximum of 50 characters each
	define("LANG_MSG_PLEASE_INCLUDE_KEYWORDS", "S'il vous plaît inclure des mots-clés avec un maximum de 50 caractères chacun");
	//Please enter a valid "Publication Date".
	define("LANG_MSG_ENTER_VALID_PUBLICATION_DATE", "S'il vous plaît entrez une \"Date de publication\".");
	//Please enter a valid "Start Date".
	define("LANG_MSG_ENTER_VALID_START_DATE", "S'il vous plaît entrez une \"Date de Début\".");
	//Please enter a valid "End Date".
	define("LANG_MSG_ENTER_VALID_END_DATE", "S'il vous plaît entrez une \"Date de Fin\".");
	//The "End Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_END_DATE_GREATER_THAN_START_DATE", "La \"Date de Fin\" doit être supérieure ou égale à la \"Date de Début\".");
	//The "End Time" must be greater than the "Start Time".
	define("LANG_MSG_END_TIME_GREATER_THAN_START_TIME", "La \"Date de Fin\" doit être supérieure à la \"Date de Début\".");
	//The "End Date" cannot be in past.
	define("LANG_MSG_END_DATE_CANNOT_IN_PAST", "La \"Date de Fin\" ne peut pas être dans le passé.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_ENTER_VALID_EMAIL_ADDRESS", "S'il vous plaît entrer une adresse e-mail valide.");
	//Please enter a valid "URL".
	define("LANG_MSG_ENTER_VALID_URL", "S'il vous plaît entrer un \"URL valide\".");
	//Please provide a description with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_DESCRIPTION_WITH_255_CHARS", "S'il vous plaît fournir une description avec un maximum de 255 caractères.");
	//Please provide a conditions with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_255_CHARS", "S'il vous plaît fournir les conditions avec un maximum de 255 caractères.");
	//Please enter a valid renewal date.
	define("LANG_MSG_ENTER_VALID_RENEWAL_DATE", "S'il vous plaît entrer une date de renouvellement valide.");
	//Renewal date must be in the future.
	define("LANG_MSG_RENEWAL_DATE_IN_FUTURE", "Date de renouvellement doit être une date future. ");
	//Please enter a valid expiration date.
	define("LANG_MSG_ENTER_VALID_EXPIRATION_DATE", "S'il vous plaît entrer une date d'expiration valide.");
	//Expiration date must be in the future.
	define("LANG_MSG_EXPIRATION_DATE_IN_FUTURE", "Date d'expiration doit être une date future.");
	//Blank space is not allowed for password.
	define("LANG_MSG_BLANK_SPACE_NOT_ALLOWED_FOR_PASSWORD", "Les espaces ne sont pas autorisés dans le mot de passe.");
	//"Please enter a password with a maximum of" [PASSWORD_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MAX_CHARS", "S'il vous plaît entrer un mot de passe avec un maximum de");
	//"Please enter a password with a minimum of" [PASSWORD_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS", "S'il vous plaît entrer un mot de passe avec un minimum de");
	//Please enter a valid username.
	define("LANG_MSG_ENTER_VALID_USERNAME", "S'il vous plaît entrer un e-mail valide.");
	//Sorry, you can't change this account information
	define("LANG_MSG_YOUCANTCHANGEACCOUNTINFORMATION", "Désolé, vous ne pouvez pas modifier ces informations du compte");
	//Password "abc123" not allowed!
	define("LANG_MSG_ABC123_NOT_ALLOWED", "Mot de Passe \"abc123\" non autorisé!");
	//Passwords do not match. Please enter the same content for "password" and "retype password" fields.
	define("LANG_MSG_PASSWORDS_DO_NOT_MATCH", "Les mots de passe ne correspondent pas. S'il vous plaît entrer le même contenu pour les");
	//Spaces are not allowed for username.
	define("LANG_MSG_SPACES_NOT_ALLOWED_FOR_USERNAME", "Les espaces ne sont pas autorisés pour l'e-mail.");
	//Special characters are not allowed for username.
	define("LANG_MSG_SPECIAL_CHARS_NOT_ALLOWED_FOR_USERNAME", "Les caractères spéciaux ne sont pas autorisés pour l'e-mail.");
	//"Please type an username with a maximum of" [USERNAME_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MAX_CHARS", "S'il vous plaît taper un e-mail avec un maximum de");
	//"Please type an username with a minimum of" [USERNAME_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MIN_CHARS", "S'il vous plaît taper un e-mail avec un minimum de");
	//Please choose a different username.
	define("LANG_MSG_CHOOSE_DIFFERENT_USERNAME", "S'il vous plaît choisir une autre adresse e-mail.");
	//Click here if you do not see your category
	define("LANG_MSG_CLICK_TO_ADD_CATEGORY", "Cliquez ici si vous ne voyez pas votre catégorie");
	//Add main category
	define("LANG_MSG_CLICK_TO_ADD_MAINCATEGORY", "Ajouter la catégorie principale");
	//Add sub-category
	define("LANG_MSG_CLICK_TO_ADD_SUBCATEGORY", "Ajouter la sous-catégorie");
	//Category title already registered!
	define("LANG_CATEGORY_ALREADY_REGISTERED", "Titre de la catégorie déjà inscrit!");
	//Category title available!
	define("LANG_CATEGORY_NOT_REGISTERED", "Titre de la catégorie disponible!");

	# ----------------------------------------------------------------------------------------------------
	# MENU
	# ----------------------------------------------------------------------------------------------------
	//Dashboard
	define("LANG_MEMBERS_DASHBOARD", "Dashboard");
	//Manage
	define("LANG_MENU_MANAGE", "Gérer");
	//Add
	define("LANG_MENU_ADD", "Ajouter");
	//Sponsor Options
	define("LANG_MENU_MEMBEROPTIONS", "Options des Sponsors");
	//Add Listing
	define("LANG_MENU_ADDLISTING", "Ajouter une Liste");
	//Manage Listings
	define("LANG_MENU_MANAGELISTING", "Gérer les Listes");
	//Add Event
	define("LANG_MENU_ADDEVENT", "Ajouter un Événements");
	//Manage Events
	define("LANG_MENU_MANAGEEVENT", "Gérer les Événements");
	//Add Banner
	define("LANG_MENU_ADDBANNER", "Ajouter une Bannière");
	//Manage Banners
	define("LANG_MENU_MANAGEBANNER", "Gérer les Bannières");
	//Add Classified
	define("LANG_MENU_ADDCLASSIFIED", "Ajouter une Annonce");
	//Manage Classifieds
	define("LANG_MENU_MANAGECLASSIFIED", "Gérer les Annonces");
	//Add Article
	define("LANG_MENU_ADDARTICLE", "Ajouter un Article");
	//Manage Articles
	define("LANG_MENU_MANAGEARTICLE", "Gérer les Articles");
	//Add Deal
	define("LANG_MENU_ADDPROMOTION", "Ajouter un Offrir");
	//Manage Deals
	define("LANG_MENU_MANAGEPROMOTION", "Gérer les Offres");
	//Add Post
	define("LANG_MENU_ADDPOST", "Ajouter postal");
	//Page not found
	define("LANG_PAGE_NOT_FOUND", "Page Introuvable");
	//Maintenance Page
	define("LANG_MAINTENANCE_PAGE", "Page de Maintenance");
	//Payment Options
	define("LANG_MENU_PAYMENTOPTIONS", "Options de Paiement");
	//Check Out
	define("LANG_MENU_CHECKOUT", "Passer la Commande");
	//Make Your Payment
	define("LANG_MENU_MAKEPAYMENT", "Faites Votre Paiement");
	//History
	define("LANG_MENU_HISTORY", "Historique");
	//Transaction History
	define("LANG_MENU_TRANSACTIONHISTORY", "Historique des Transactions");
	//Invoice History
	define("LANG_MENU_INVOICEHISTORY", "Historique des Factures");
	//Default Themes
	define("LANG_MENU_CHOOSETHEME", "Thèmes Défaut");
	//Schemes
	define("LANG_MENU_CHOOSESCHEME", "Schéma");
	//Toll free
	define("LANG_LIVE_TOLLFREE", "Contacter");
	//Purchase Now
	define("LANG_LIVE_PURCHASE", "Acheter maintenant");

	# ----------------------------------------------------------------------------------------------------
	# SEARCH
	# ----------------------------------------------------------------------------------------------------
	//Search Article
	define("LANG_LABEL_SEARCHARTICLE", "Recherche un Article");
	//Search Classified
	define("LANG_LABEL_SEARCHCLASSIFIED", "Rechercher un Annonce");
	//Search Event
	define("LANG_LABEL_SEARCHEVENT", "Rechercher un Evénement");
	//Search Listing
	define("LANG_LABEL_SEARCHLISTING", "Rechercher une Liste");
	//Search Deal
	define("LANG_LABEL_SEARCHPROMOTION", "Rechercher un Offrir");
	//Search the blog
    define("LANG_LABEL_SEARCHBLOG", "Rechercher un Poste");
	//Advanced Search
	define("LANG_SEARCH_ADVANCEDSEARCH", "Recherche Avancée");
	//Search
	define("LANG_SEARCH_LABELKEYWORD", "Recherche");
	//Location
	define("LANG_SEARCH_LABELLOCATION", "Emplacement");
	//Select a Country
	define("LANG_SEARCH_LABELCBCOUNTRY", "Choisissez un Pays");
	//Select a Region
	define("LANG_SEARCH_LABELCBREGION", "Choisissez a Région");
	//Select a State
	define("LANG_SEARCH_LABELCBSTATE", "Choisissez une État");
	//Select a City
	define("LANG_SEARCH_LABELCBCITY", "Choisissez une Ville");
	//Select a Neighborhood
	define("LANG_SEARCH_LABELCBNEIGHBORHOOD", "Choisissez a Quartier");
	//Category
	define("LANG_SEARCH_LABELCATEGORY", "Catégorie");
	//Select a Category
	define("LANG_SEARCH_LABELCBCATEGORY", "Choisissez une Catégorie");
	//Match
	define("LANG_SEARCH_LABELMATCH", "Filtre");
	//Exact Match
	define("LANG_SEARCH_LABELMATCH_EXACTMATCH", "Phrase Exacte");
	//Any Word
	define("LANG_SEARCH_LABELMATCH_ANYWORD", "N'importe quel Mot");
	//All Words
	define("LANG_SEARCH_LABELMATCH_ALLWORDS", "Tous les Mots");
	//Listing Type
	define("LANG_SEARCH_LABELBROWSE", "Type de Liste");
	//from
	define("LANG_SEARCH_LABELFROM", "de");
	//to
	define("LANG_SEARCH_LABELTO", "à");
	//Miles "of"
	define("LANG_SEARCH_LABELZIPCODE_OF", "de");
	//Search by keyword
	define("LANG_LABEL_SEARCHFAQ", "Recherche par mots clés");
	//Search
	define("LANG_LABEL_SEARCHFAQ_BUTTON", "Recherche");
	//Please provide words with at least [FT_MIN_WORD_LEN] characters for your search.
	define("LANG_MSG_SEARCH_MIN_WORD_LEN", "S'il vous plaît fournir que des mots avec au moins [FT_MIN_WORD_LEN] lettres pour la recherche.");

	# ----------------------------------------------------------------------------------------------------
	# FRONTEND
	# ----------------------------------------------------------------------------------------------------
	//Featured
	define("LANG_ITEM_FEATURED", "Vedette");
	//Recent Articles
	define("LANG_RECENT_ARTICLE", "Articles Récents");
	//Upcoming Events
	define("LANG_UPCOMING_EVENT", "Prochains Evénements");
	//Featured Events
	define("LANG_FEATURED_EVENT", "Evénements Vedettes");
	//Featured Event
	define("LANG_FEATURED_EVENT_SING", "Evénement Vedette");
	//Featured Classifieds
	define("LANG_FEATURED_CLASSIFIED", "Annonces Vedettes");
	//Featured Classified
	define("LANG_FEATURED_CLASSIFIED_SING", "Annonce Vedette");
	//Featured Articles
	define("LANG_FEATURED_ARTICLE", "Articles Vedettes");
	//Featured Article
	define("LANG_FEATURED_ARTICLE_SING", "Article Vedette");
	//Featured Listings
	define("LANG_FEATURED_LISTING", "Listes Vedettes");
	//Featured Listing
	define("LANG_FEATURED_LISTING_SING", "Liste Vedette");
	//Featured Deals
	define("LANG_FEATURED_PROMOTION", "Offres Vedettes");
	//Featured Deal
	define("LANG_FEATURED_PROMOTION_SING", "Offrir Vedette");
	//View all articles
	define("LANG_LABEL_VIEW_ALL_ARTICLES", "Voir tous les articles");
	//View all events
	define("LANG_LABEL_VIEW_ALL_EVENTS", "Voir tous les evénements");
	//View all classifieds
	define("LANG_LABEL_VIEW_ALL_CLASSIFIEDS", "Voir tous les annonces");
	//View all listings
	define("LANG_LABEL_VIEW_ALL_LISTINGS", "Voir tous les listes");
	//View all deals
	define("LANG_LABEL_VIEW_ALL_PROMOTIONS", "Voir tous les offres");
	//Listing with a deal
	define("LANG_LABEL_VIEW_LISTINGDEAL", "Liste à offrir");
	//Most Read
	define("LANG_LABEL_ARTICLE_POPULAR", "Lire Plus");
	//Recently Added
	define("LANG_LABEL_ARTICLE_RECENT", "Récemment Ajouté");
	//Last Tweets
	define("LANG_LAST_TWEETS", "Dernier Tweets");
	//Quick and Easy.
	define("LANG_EASYANDFAST", "Rapide et Facile.");
	//Just follow the 3 steps
	define("LANG_THREESTEPS", "Il suffit de suivre les 3 étapes");
	//4 Steps
	define("LANG_FOURSTEPS", "4 Étapes");
	//Account Signup
	define("LANG_ACCOUNTSIGNUP", "S'inscrire au Compte");
	//Update your Listing
	define("LANG_LISTINGUPDATE", "Mise à jour de la Liste");
	//Order
	define("LANG_ORDER", "Commander");
	//Check Out
	define("LANG_CHECKOUT", "Payer");
	//Configuration
	define("LANG_CONFIGURATION", "Configuration");
	//Select a level
	define("LANG_SELECTPACKAGE", "Choisissez un niveau");
	//Profile Options
	define("LANG_PROFILE_OPTIONS", "Options du Profil");
	//Directory account
	define("LANG_PROFILE_OPTIONS1", "Répertoire Compte");
	//My existing OpenID 2.0 Account
	define("LANG_PROFILE_OPTIONS2", "Mon compte OpenID 2.0");
	//My existing Facebook Account
	define("LANG_PROFILE_OPTIONS3", "Mon compte Facebook");
	//My existing Google Account
	define("LANG_PROFILE_OPTIONS4", "Mon compte Google");
	//Are you already a member?
	define("LANG_ALREADYHAVEACCOUNT", "Etes-vous déjà membre?");
	//No, I'm a New User.
	define("LANG_ACCOUNTNEWUSER", "Non, je suis un Nouvel Utilisateur.");
	//Yes, I have an Existing Account.
	define("LANG_ACCOUNTEXISTSUSER", "Oui, j'ai déjà un Compte.");
	//Login with your Directory account
	define("LANG_ACCOUNTDIRECTORYUSER", "Connectez-vous à votre compte ".EDIRECTORY_TITLE."");
	//Or login with your OpenID account
	define("LANG_ACCOUNTOPENIDUSER", "Ou identifiez-vous avec votre compte OpenID");
	//Sign in with my existing Facebook Account.
	define("LANG_ACCOUNTFACEBOOKUSER", "Connectez-vous avec mon compte Facebook.");
	//Sign in with my existing Google Account.
	define("LANG_ACCOUNTGOOGLEUSER", "Connectez-vous avec mon compte Google.");
    //Or login with your existing account
    define("LANG_ACCOUNTFBGOOGLEUSER", "Ou ouvrir une session avec votre compte existant");
	//Account Information
	define("LANG_ACCOUNTINFO", "Informations sur le compte");
	//Additional Information
	define("LANG_LABEL_ADDITIONALINFORMATION", "Information Additionnelle");
	//Please write down your e-mail and password for future reference.
	define("LANG_ACCOUNTINFOMSG", "S'il vous plaît écrivez votre e-mail et mot de passe pour référence future.");
	//"Username must be a valid e-mail between" [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG1", "E-mail doit être un e-mail valide entre");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] "and" [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG2", "et");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] "characters with no spaces."
	define("LANG_USERNAME_MSG3", "caractères sans espaces.");
	//"Password must be between" [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG1", "Mot de Passe doit être compris entre");
	//Password must be between [PASSWORD_MIN_LEN] "and" [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG2", "et");
	//Password must be between [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] "characters with no spaces."
	define("LANG_PASSWORD_MSG3", "caractères sans espaces.");
	//I agree with the terms of use
	define("LANG_IGREETERMS", "Je suis d'accord avec les conditions d'utilisation");
	//Do you want to advertise with us?
	define("LANG_DOYOUWANT_ADVERTISEWITHUS", "Publicité avec nous?");
	//Buy a link
	define("LANG_BUY_LINK", "Acheter un lien");
	//Back to Top
	define("LANG_BACKTOTOP", "Haut de page");
	//Back to
	define("LANG_BACKTO", "Retour aux ");
	//Favorites
	define("LANG_QUICK_LIST", "Favoris");
	//view summary
	define("LANG_VIEWSUMMARY", "afficher le résumé");
	//view detail
	define("LANG_VIEWDETAIL", "afficher le détail");
	//Advertisers
	define("LANG_ADVERTISER", "Les Annonceurs");
	//Order Now!
	define("LANG_ORDERNOW", "Commander!");
	//Wait, Loading...
	define("LANG_WAITLOADING", "Patientez, Chargement ...");
	//Wait, loading filter options...
	define("LANG_WAITLOADING_FILTERS", "Attendez, chargement options de filtrage...");
	//Subtotal Amount
	define("LANG_SUBTOTALAMOUNT", "Total partiel");
	//Subtotal
	define("LANG_SUBTOTAL", "Total partiel");
	//Total Tax Amount
	define("LANG_TAXAMOUNT", "Total des taxes");
	//Total Price
	define("LANG_TOTALPRICEAMOUNT", "Montant Total");
	//Favorites
	define("LANG_LABEL_QUICKLIST", "Favoris");
	//No favorites found!
	define("LANG_LABEL_NOQUICKLIST", "Aucun favori trouvé!");
	//Search results for
	define("LANG_LABEL_SEARCHRESULTSFOR", "Résultats de recherche pour");
	//Related Search
	define("LANG_LABEL_RELATEDSEARCH", "Relatif Recherche");
	//Browse by Section
	define("LANG_LABEL_BROWSESECTION", "Rechercher par Section");
	//What are you looking for?
    define("LANG_LABEL_SEARCHINGFOR", "Que cherchez-vous?");
    //Where?
    define("LANG_LABEL_SEARCHINGFOR_WHERE", "Où?");
	//Keyword
	define("LANG_LABEL_SEARCHKEYWORD", "Mots-clés");
	//Type a keyword
	define("LANG_LABEL_SEARCHKEYWORDTIP", "Tapez un mot-clé");
	//Type a keyword or listing name
	define("LANG_LABEL_SEARCHKEYWORDTIP_LISTING", "Mot-clé ou nom de l'liste");
	//Type a keyword or deal title
	define("LANG_LABEL_SEARCHKEYWORDTIP_PROMOTION", "Mot-clé ou titre de le offrir");
	//Type a keyword or event title
	define("LANG_LABEL_SEARCHKEYWORDTIP_EVENT", "Mot-clé ou titre de l'evénement");
	//Type a keyword or classified title
	define("LANG_LABEL_SEARCHKEYWORDTIP_CLASSIFIED", "Mot-clé ou titre de l'annonce");
	//Type a keyword or article title
	define("LANG_LABEL_SEARCHKEYWORDTIP_ARTICLE", "Mot-clé ou titre de l'article");
	//Where
	define("LANG_LABEL_SEARCHWHERE", "Où");
	//Address, City, State or Zip Code
	define("LANG_LABEL_SEARCHWHERETIP", "Adresse, Ville, Région ou Code Postal");
	//Wait, searching your location...
	define("LANG_LABEL_WAIT_LOCATION", "Recherche de votre emplacement...");
	//Complete the form below to contact us.
	define("LANG_LABEL_FORMCONTACTUS", "Pour nous contacter, merci de remplir le formulaire ci-dessous.");
	//Message
	define("LANG_LABEL_MESSAGE", "Message");
	//No disabled categories found in the system.
	define("LANG_DISABLED_CATEGORY_NOTFOUND", "Aucune catégorie handicapés dans le système.");
	//No categories found.
	define("LANG_CATEGORY_NOTFOUND", "Aucune catégorie trouvée.");
	//Please, select a valid category
	define("LANG_CATEGORY_INVALIDERROR", "S'il vous plaît choisir une catégorie valide");
	//Please select a category first!
	define("LANG_CATEGORY_SELECTFIRSTERROR", "S'il vous plaît sélectionner une catégorie d'abord!");
	//View Category Path
	define("LANG_CATEGORY_VIEWPATH", "Afficher le Plan de Catégories");
	//Remove Selected Category
	define("LANG_CATEGORY_REMOVESELECTED", "Supprimer la Catégorie Choisie");
	//"Extra categories cost an" additional [LEVEL_CATEGORY_PRICE] each.
	define("LANG_CATEGORIES_PRICEDESC1", "Catégories extras coûtent un");
	//Extra categories cost an "additional" [LEVEL_CATEGORY_PRICE] each.
	define("LANG_CATEGORIES_PRICEDESC2", "supplément de");
	//Extra categories cost an additional [LEVEL_CATEGORY_PRICE] "each."
	define("LANG_CATEGORIES_PRICEDESC3", "chaque.");
	//Maximum of
	define("LANG_CATEGORIES_CATEGORIESMAXTIP1", "Maximum de");
	//allowed.
	define("LANG_CATEGORIES_CATEGORIESMAXTIP2", "catégories de permis.");
	//Categories and sub-categories
	define("LANG_CATEGORIES_TITLE", "Catégories et sous-catégories");
	//Only select sub-categories that directly apply to your type.
	define("LANG_CATEGORIES_MSG1", "Sélectionnez seulement les sous-catégories qui s'appliquent directement à votre type.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_CATEGORIES_MSG2", "Votre liste apparaîtra automatiquement dans la catégorie principale de chaque sous-catégorie que vous sélectionnez");
	//Account Information Error
	define("LANG_ACCOUNTINFO_ERROR", "Erreur sur les Informations du Compte");
	//Contact Information
	define("LANG_CONTACTINFO", "Contact Information");
	//This information will not be displayed publicly.
	define("LANG_CONTACTINFO_MSG", "Cette information ne sera pas montrée publiquement.");
	//Billing Information
	define("LANG_BILLINGINFO", "Informations de Facturation");
	//This information will not be displayed publicly.
	define("LANG_BILLINGINFO_MSG1", "Cette information ne sera pas montrée publiquement.");
	//You will configure your article after placing the order.
	define("LANG_BILLINGINFO_MSG2_ARTICLE", "Vous allez configurer votre article, après avoir passé commande.");
	//You will configure your banner after placing the order.
	define("LANG_BILLINGINFO_MSG2_BANNER", "Vous allez configurer votre bannière, après avoir passé commande.");
	//You will configure your classified after placing the order.
	define("LANG_BILLINGINFO_MSG2_CLASSIFIED", "Vous allez configurer votre annonce, après avoir passé commande.");
	//You will configure your event after placing the order.
	define("LANG_BILLINGINFO_MSG2_EVENT", "Vous allez configurer votre événement, après avoir passé commande.");
	//You will configure your listing after placing the order.
	define("LANG_BILLINGINFO_MSG2_LISTING", "Vous allez configurer votre liste, après avoir passé commande.");
	//Billing Information Error
	define("LANG_BILLINGINFO_ERROR", "Erreur sur les Informations de Facturation ");
    //Or back to previous page
    define("LANG_ADVERTISE_BACK", "Ou retourner à la page précédente");
	//Checking out
	define("LANG_ADVERTISE_CHECKOUT", "Vérification");
    //Listing [level]
    define("LANG_ADVERTISE_LISTINGLEVEL", "Liste [level]");
    //Event [level]
    define("LANG_ADVERTISE_EVENTLEVEL", "Événement [level]");
    //Classified [level]
    define("LANG_ADVERTISE_CLASSIFIEDLEVEL", "Annonce [level]");
    //Article [level]
    define("LANG_ADVERTISE_ARTICLELEVEL", "Article [level]");
    //Banner [level]
    define("LANG_ADVERTISE_BANNERLEVEL", "Bannière [level]");
    //Identification
    define("LANG_ADVERTISE_IDENTIFICATION", "Identification");
    //Confirmation
    define("LANG_ADVERTISE_CONFIRMATION", "Confirmation");
    //Please, login with your account or sign up today.
    define("LANG_ADVERTISE_SIGNUP", "S'il vous plaît, connectez-vous avec votre compte ou inscrivez-vous aujourd'hui.");
    //I'm already a user
    define("LANG_ADVERTISE_SIGNUP_ALREADYUSER", "Je suis déjà un utilisateur");
    //I'm a new user
    define("LANG_ADVERTISE_SIGNUP_NEWUSER", "Je suis un nouvel utilisateur");
    //Create a new account now.
    define("LANG_ADVERTISE_CREATE_ACC", "Créer un nouveau compte maintenant.");
    //Billing Detail
    define("LANG_ADVERTISE_BILLINGDETAIL", "Détail de Facturation");
    //A quick overview of how much you will be charged.
    define("LANG_ADVERTISE_BILLINGDETAIL_TIP", "Un bref aperçu de combien vous sera facturé.");
    //Payment
    define("LANG_ADVERTISE_PAYMENT", "Paiement");
    //Make your payment and finish your order.
    define("LANG_ADVERTISE_PAYMENT_TIP", "Effectuez votre paiement et terminer votre commande.");
    //Print your invoice and finish your order.
    define("LANG_ADVERTISE_PAYMENT_TIP2", "Imprimez votre facture et terminez votre commande.");
    //Thank you for your order!
    define("LANG_ADVERTISE_THANKYOU", "Merci pour votre commande!");
    //Order Description
    define("LANG_ADVERTISE_ORDERDESC", "Description de la commande");
    //A brief summary of your order.
    define("LANG_ADVERTISE_ORDERDESC_TIP", "Un bref résumé de votre commande.");
    //Thanks!
    define("LANG_ADVERTISE_THANKS", "Merci!");
    //Already registered users should use
    define("LANG_ADVERTISE_ALREADYUSER1", "Les utilisateurs déjà enregistrés doivent utiliser");
    //members check out area
    define("LANG_ADVERTISE_ALREADYUSER2", "des membres de consulter zone");
    //You are already logged as
    define("LANG_ADVERTISE_LOGGED_AS", "Vous êtes déjà connecté en tant que");
	//Most Popular
	define("LANG_ADVERTISE_POPULAR", "Plus Populaire");
	//days free trial!
	define("LANG_ADVERTISE_TRIAL", "jours d'essai gratuit!");
	//after
	define("LANG_AFTER", "après");
	//View Sample
	define("LANG_ADVERTISE_SAMPLE", "Voir un Exemple");
	//Have any questions?
	define("LANG_ADVERTISE_QUESTIONS", "Vous avez des questions?");
	//Contact us today
	define("LANG_ADVERTISE_CONTACT", "Contactez-nous aujourd'hui");
	//No Tax
	define("LANG_ADVERTISE_NOTAX", "Aucune taxe");
	//Article Information
	define("LANG_ARTICLEINFO", "Information sur l'Article");
	//Article Information Error
	define("LANG_ARTICLEINFO_ERROR", "Erreur sur les informations d'Article");
	//Banner Information
	define("LANG_BANNERINFO", "Information sur la Bannière");
	//Banner Information Error
	define("LANG_BANNERINFO_ERROR", "Erreur sur les informations de Bannière");
	//Classified Information
	define("LANG_CLASSIFIEDINFO", "Information sur les Annonces");
	//Classified Information Error
	define("LANG_CLASSIFIEDINFO_ERROR", "Erreur sur les Informations de l'Annonce");
	//Browse Events by Date
	define("LANG_BROWSEEVENTSBYDATE", "Rechercher un événement par date");
	//Event Information
	define("LANG_EVENTINFO", "Information sur l'Événement");
	//Event Information Error
	define("LANG_EVENTINFO_ERROR", "Erreur sur les Informations de l'Événement");
	//Listing Information
	define("LANG_LISTINGINFO", "Informations sur la liste ");
    //What do you want to call your listing? This is normally your company name.
	define("LANG_LISTINGINFO_TIP", "Qu'est-ce que vous voulez appeler votre liste? Ceci est normalement le nom de votre entreprise.");
    //Choose a template applicable to your business type if you feel the need too.
	define("LANG_LISTINGINFO_TIP2", "Choisissez un modèle applicable à votre type d'liste, si vous ressentez le besoin aussi.");
    //What do you want to call your event?
	define("LANG_EVENTINFO_TIP", "Qu'est-ce que vous voulez appeler votre événement?");
    //What do you want to call your classified?
	define("LANG_CLASSIFIEDINFO_TIP", "Qu'est-ce que vous voulez appeler votre petite annonce?");
    //What do you want to call your article?
	define("LANG_ARTICLEINFO_TIP", "Qu'est-ce que vous voulez appeler votre article?");
    //What do you want to call your banner?
	define("LANG_BANNERINFO_TIP", "Qu'est-ce que vous voulez appeler votre bannière?");
	//Listing Information Error
	define("LANG_LISTINGINFO_ERROR", "Erreur sur les Informations de la Liste");
	//Claim this Listing
	define("LANG_LISTING_CLAIMTHIS", "Réclamez cette Liste");
	//Claiming
	define("LANG_LISTING_CLAIMING", "Réclame");
	//To claim this listing, just log in with your existing account details or create a new account.
	define("LANG_CLAIM_SIGNUP", "Pour réclamer cette annonce, connectez-vous avec vos informations de compte existantes ou en créer un nouveau compte.");
	//Listing Type
	define("LANG_LISTING_LABELTEMPLATE", "Type d'annonce");
	//No results were found for the search criteria you requested.
	define("LANG_MSG_NORESULTS", "Aucun résultat trouvé pour les critères de recherche que vous avez demandé.");
	//Please try your search again or browse by section.
	define("LANG_MSG_TRYAGAIN_BROWSESECTION", "S'il vous plaît essayer votre recherche de nouveau ou naviguez par section.");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword and perform your search again.
	define("LANG_MSG_USE_SPECIFIC_KEYWORD", "Parfois, vous n'allez pas reçevoir de résultats pour votre recherche, car le mot-clé que vous avez utilisé est très générique. Essayez d'utiliser un mot-clé plus specifique et de réeffectuer votre recherche.");
	//Please type at least one keyword on the search box.
	define("LANG_MSG_LEASTONEKEYWORD", "S'il vous plaît renter au moins un mot-clé sur le champ de recherche.");
	//"No results content"
	define("LANG_SEARCH_NORESULTS", "<h1>Aucun résultat pour votre recherche</h1><p>Votre recherche ne renvoie aucun résultat. Bien que ce qui est inhabituel, il arrive de temps en temps, quand le terme de recherche que vous avez utilisé est un générique peu ou quand nous n'avons pas vraiment de tout contenu adapté.</p><h2>Suggestions:</h2>&raquo;Soyez plus précis avec vos termes de recherche<br />&raquo;Vérifiez l'orthographe<br />&raquo;Si vous ne pouvez pas trouver via la recherche essayez de naviguer par l'article<br /><br /><p>Si tu crois que vous êtes venus ici dans l'erreur, s'il vous plaît contacter le gestionnaire du site pour signaler un problème.</p>");
	//Image
	define("LANG_SLIDESHOW_IMAGE", "Image");
	//of
	define("LANG_SLIDESHOW_IMAGEOF", "de");
	//Error loading image
	define("LANG_SLIDESHOW_IMAGELOADINGERROR", "Erreur lors du chargement de l'image");
	//Next
	define("LANG_SLIDESHOW_NEXT", "Suivant");
	//Pause
	define("LANG_SLIDESHOW_PAUSE", "Pause");
	//Play
	define("LANG_SLIDESHOW_PLAY", "Lire");
	//Back
	define("LANG_SLIDESHOW_BACK", "Retour");
	//Your e-mail has been sent. Thank you.
	define("LANG_CONTACTMSGSUCCESS", "Votre adresse e-mail a été envoyée. Merci.");
	//There was a problem sending this e-mail. Please try again later.
	define("LANG_CONTACTMSGFAILED", "Un problème est survenu lors de l'envoi de cet e-mail. S'il vous plaît essayer de nouveau.");
	//Please enter your name.
	define("LANG_MSG_CONTACT_ENTER_NAME", "S'il vous plaît entrer votre nom.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_CONTACT_ENTER_VALID_EMAIL", "S'il vous plaît entrer une adresse e-mail valide.");
	//Please type the message.
	define("LANG_MSG_CONTACT_TYPE_MESSAGE", "S'il vous plaît saisir le message.");
	//Please type the code correctly or mark the checkbox if available.
	define("LANG_MSG_CONTACT_TYPE_CODE", "S'il vous plaît rentrer le code correctement ou cochez la case si disponible.");
	//Please correct it and try again.
	define("LANG_MSG_CONTACT_CORRECTIT_TRYAGAIN", "S'il vous plaît corriger et essayer de nouveau.");
	//Please type a name.
	define("LANG_MSG_CONTACT_TYPE_NAME", "S'il vous plaît entrer un nom.");
	//Please type a subject.
	define("LANG_MSG_CONTACT_TYPE_SUBJECT", "S'il vous plaît entrer un sujet.");
	//SOME DETAILS
	define("LANG_ARTICLE_TOFRIEND_MAIL", "QUELQUES DETAILS");
	//SOME DETAILS
	define("LANG_CLASSIFIED_TOFRIEND_MAIL", "QUELQUES DETAILS");
	//SOME DETAILS
	define("LANG_EVENT_TOFRIEND_MAIL", "QUELQUES DETAILS");
	//SOME DETAILS
	define("LANG_LISTING_TOFRIEND_MAIL", "QUELQUES DETAILS");
	//SOME DETAILS
	define("LANG_PROMOTION_TOFRIEND_MAIL", "QUELQUES DETAILS");
	//Please enter a valid e-mail address in the "To" field
	define("LANG_MSG_TOFRIEND1", "S'il vous plaît entrer une adresse e-mail valide dans le champ \"À\"");
	//Please enter a valid e-mail address in the "From" field
	define("LANG_MSG_TOFRIEND2", "S'il vous plaît entrer une adresse e-mail valide dans le champ \"De\"");
	//"Item not found. Please return to" [YOURSITE] and try again.
	define("LANG_MSG_TOFRIEND3", "Point Not Found. S'il vous plaît revenir à");
	//We could not find the item you're trying to send to a friend. Please return to [YOURSITE] "and try again."
	define("LANG_MSG_TOFRIEND4", "et essayez à nouveau.");
	//Please enter a valid e-mail address in the "Your E-mail" field
	define("LANG_MSG_TOFRIEND5", "S'il vous plaît entrer une adresse e-mail valide dans le champ \"Votre E-mail\"");
	//"About" [ARTICLE_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_1", "À propos de ");
	//About [ARTICLE_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_2", "de la ");
	//"About" [CLASSIFIED_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_1", "À propos de ");
	//About [CLASSIFIED_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_2", "de la ");
	//"About" [EVENT_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_1", "À propos de ");
	//About [EVENT_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_2", "de la ");
	//"About" [LISTING_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_1", "À propos de");
	//About [LISTING_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_2", "de la ");
	//"About" [PROMOTION_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_1", "À propos de");
	//About [PROMOTION_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_2", "de la ");
	//Send info about this article to a friend
	define("LANG_ARTICLE_TOFRIEND_SAUDATION", "Envoyer des informations sur cet article à un ami");
	//Send info about this classified to a friend
	define("LANG_CLASSIFIED_TOFRIEND_SAUDATION", "Envoyer des informations sur cette annonce à un ami");
	//Send info about this event to a friend
	define("LANG_EVENT_TOFRIEND_SAUDATION", "Envoyer des informations sur cet événement à un ami");
	//Send info about this listing to a friend
	define("LANG_LISTING_TOFRIEND_SAUDATION", "Envoyer des informations sur cette liste à un ami");
	//Send info about this deal to a friend
	define("LANG_PROMOTION_TOFRIEND_SAUDATION", "Envoyer des informations sur cet offrir à un ami");
	//Message sent by
	define("LANG_MESSAGE_SENT_BY", "Message envoyé par ");
	//This is a automatic message.
	define("LANG_THIS_IS_A_AUTOMATIC_MESSAGE", "Ceci est un message automatique.");
	//Contact
	define("LANG_CONTACT", "Contacter");
	//article
	define("LANG_ARTICLE", "article");
	//classified
	define("LANG_CLASSIFIED", "annonces");
	//event
	define("LANG_EVENT", "événement");
	//listing
	define("LANG_LISTING", "liste");
	//deal
	define("LANG_PROMOTION", "offrir");
	//Please search at least one parameter on the search box!
	define("LANG_MSG_LEASTONEPARAMETER", "S'il vous plaît de recherche au moins un paramètre dans le champ de recherche!");
	//Please try your search again.
	define("LANG_MSG_TRYAGAIN", "S'il vous plaît essayer de nouveau votre recherche.");
	//No articles registered yet.
	define("LANG_MSG_NOARTICLES", "Aucun article enregistré pour le moment.");
	//No classifieds registered yet.
	define("LANG_MSG_NOCLASSIFIEDS", "Aucune annonce enregistré pour le moment.");
	//No events registered yet.
	define("LANG_MSG_NOEVENTS", "Aucun événement enregistré pour le moment.");
	//No listings registered yet.
	define("LANG_MSG_NOLISTINGS", "Aucune liste enregistré pour le moment.");
	//No deals registered yet.
	define("LANG_MSG_NOPROMOTIONS", "Aucun offrir enregistré pour le moment.");
	//Message sent through
	define("LANG_CONTACTPRESUBJECT", "Message envoyé par");
	//E-mail Form
	define("LANG_EMAILFORM", "Formaulaire E-mail");
	//Click here to print
	define("LANG_PRINTCLICK", "Cliquez ici pour imprimer");
	//View all classified categories
	define("LANG_CLASSIFIED_VIEWALLCATEGORIES", "Afficher toutes les catégories");
	//Location
	define("LANG_CLASSIFIED_LOCATIONS", "Emplacement");
	//More Classifieds
	define("LANG_CLASSIFIED_MORE", "Plus d'Annonces");
	//View all event categories
	define("LANG_EVENT_VIEWALLCATEGORIES", "Afficher toutes les catégories");
	//Location
	define("LANG_EVENT_LOCATIONS", "Emplacement");
	//Featured Events
	define("LANG_EVENT_FEATURED", "Événements Vedettes");
	//events
	define("LANG_EVENT_PLURAL", "Événements");
	//Search results
	define("LANG_SEARCHRESULTS", "Résultats de la recherche");
	//Results
	define("LANG_RESULTS", "Résultats");
	//Result
	define("LANG_RESULT", "Résultat");
    //Letter
    define("LANG_LETTER", "Lettre");
	//Search results "for" keyword
	define("LANG_SEARCHRESULTS_KEYWORD", "pour");
	//Search results "in" where
	define("LANG_SEARCHRESULTS_WHERE", "dans");
	//Search results "in" template
	define("LANG_SEARCHRESULTS_TEMPLATE", "dans");
	//Search results "in" category
	define("LANG_SEARCHRESULTS_CATEGORY", "dans");
	//Search results "in category"
	define("LANG_SEARCHRESULTS_INCATEGORY", "dans la catégorie");
	//Search results "in" location
	define("LANG_SEARCHRESULTS_LOCATION", "dans");
	//Search results "in" zip
	define("LANG_SEARCHRESULTS_ZIP", "dans");
	//Search results "for" date
	define("LANG_SEARCHRESULTS_DATE", "à");
	//Search results - "Page" X
	define("LANG_SEARCHRESULTS_PAGE", "Page");
	//Recent Reviews
	define("LANG_RECENT_REVIEWS", "Les Commentaires Récents");
	//Reviews of
	define("LANG_REVIEWSOF", "Les revisiones de");
	//Reviews are disabled
	define("LANG_REVIEWDISABLE", "Revisiones non disponibles");
	//View all article categories
	define("LANG_ARTICLE_VIEWALLCATEGORIES", "Afficher toutes les catégories");
	//View all deal categories
	define("LANG_PROMOTION_VIEWALLCATEGORIES", "Afficher toutes les catégories");
    //View all blog categories
    define("LANG_BLOG_VIEWALLCATEGORIES", "Afficher toutes les catégories");
	//Offer
	define("LANG_PROMOTION_OFFER", "Offre");
	//Description
	define("LANG_PROMOTION_DESCRIPTION", "Description");
	//Conditions
	define("LANG_PROMOTION_CONDITIONS", "Conditions");
	//Location
	define("LANG_PROMOTION_LOCATIONS", "Emplacement");
	//Item not found!
	define("LANG_MSG_NOTFOUND", "Objet non trouvé!");
	//Item not available!
	define("LANG_MSG_NOTAVAILABLE", "Objet non disponible!");
	//Listing Search Results
	define("LANG_MSG_LISTINGRESULTS", "Résultats de Recherche pour Listes");
	//Deal Search Results
	define("LANG_MSG_PROMOTIONRESULTS", "Résultats de Recherche pour Offres");
	//Event Search Results
	define("LANG_MSG_EVENTRESULTS", "Résultats de Recherche pour Événements");
	//Classified Search Results
	define("LANG_MSG_CLASSIFIEDRESULTS", "Résultats de Recherche pour Annonces");
	//Article Search Results
	define("LANG_MSG_ARTICLERESULTS", "Résultats de Recherche pour Articles");
	//Available Languages
	define("LANG_MSG_AVAILABLELANGUAGES", "Langues Disponibles");
	//You can choose up to [MAX_ENABLED_LANGUAGES] of the languages below for your directory.
	define("LANG_MSG_AVAILABLELANGUAGESMSG", "Vous pouvez choisir jusqu'à ".MAX_ENABLED_LANGUAGES." au large des langues ci-dessous pour votre répertoire.");
	//Redeem without Facebook
    define("LANG_DEAL_DONTUSEFACEBOOK", "Échangez sans Facebook");
	//posted on facebook and twitter
	define("LANG_DEAL_POSTFACEBOOK_TWITTER", "publiée sur Facebook et Twitter");
	//posted on facebook
	define("LANG_DEAL_POSTFACEBOOK", "publiée sur Facebook");
	//posted on twitter
	define("LANG_DEAL_TWITTER", "publiée sur Twitter");
	//Posted on
	define("LANG_LABEL_POSTED_ON", "Publiée sur");
	//deal checked out
	define("LANG_DEAL_CHECKOUT", "offre utilisée");
	//deal opened
	define("LANG_DEAL_OPENED", "offre ouverte");
	//Terms & Conditions
	define("LANG_LABEL_DEAL_CONDITIONS", "Termes et Conditions");
	//maximum 1000 characters
	define("LANG_MSG_MAX_1000_CHARS", "1000 caractères max");
	//Please provide a conditions with a maximum of 1000 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_1000_CHARS", "S'il vous plaît fournir conditions avec un maximum de 1000 caractères.");
	//See All
	define("LANG_LABEL_SEE_ALL", "Voir Tous");
	//Stars
	define("LANG_LABEL_STARS", "Etoiles");
	//Star
	define("LANG_LABEL_STAR", "Etoile");
	//Terms of Use
    define("LANG_TERMS_USE", "Conditions d'Utilisation");
	//Privacy Policy
	define("LANG_PRIVACY_POLICY", "Politique de Confidentialité");
	//Size
    define("LANG_ADVERTISE_SIZE", "Dimensions");
	//Title / Address
	define("LANG_ADVERTISE_LIST_TITLE_ADDRESS", "Titre / Adresse");
	//Title
	define("LANG_ADVERTISE_LIST_TITLE", "Titre");
	//Ratings and Reviews
	define("LANG_ADVERTISE_LIST_REVIEW", "Notes et Commentaires");
	//Detail View
	define("LANG_ADVERTISE_LIST_DETAIL_VIEW", "Page de Détails");
	//Deal
	define("LANG_ADVERTISE_LIST_DEAL", "Offrir");
	//Send to Phone
	define("LANG_ADVERTISE_LIST_SEND_TO_PHONE", "Envoyer à Téléphone");
	//Click to Call
	define("LANG_ADVERTISE_LIST_CLICK_TO_CALL", "Cliquez pour Appeler");
	//Phone
	define("LANG_ADVERTISE_LIST_PHONE", "Téléphone");
	//E-mail
	define("LANG_ADVERTISE_LIST_EMAIL", "E-mail");
	//Url
	define("LANG_ADVERTISE_LIST_URL", "Url");
	//Fax Number
	define("LANG_ADVERTISE_LIST_FAX", "Numéro de Fax");
	//Summary Description
	define("LANG_ADVERTISE_LIST_SUMMARY_DESCRIPTION", "Description sommaire");
	//Badges
	define("LANG_ADVERTISE_LIST_BADGES", "Badges");
	//Detail Description
	define("LANG_ADVERTISE_LIST_LONG_DESCRIPTION", "Description longue");
	//Photo Gallery
	define("LANG_ADVERTISE_LIST_MAIN_IMAGE", "Galerie de photos");
	//Video
	define("LANG_ADVERTISE_LIST_VIDEO", "Vidéo");
	//Additional Uploads
	define("LANG_ADVERTISE_LIST_ATTACHMENT_FILE", "Mises supplémentaires");
	//Hours
	define("LANG_ADVERTISE_LIST_HOURS_OF_WORK", "Heures de travail");
	//Location reference
	define("LANG_ADVERTISE_LIST_LOCATIONS", "Référence de Localisation");
	//Features
	define("LANG_ADVERTISE_LIST_FEATURES", "Caractéristiques");
	//Facebook Social Plugin
	define("LANG_ADVERTISE_LIST_FBPAGE", "Facebook page");
	//Contact Name
	define("LANG_ADVERTISE_LIST_CONTACT_NAME", "Nom du Contact");
	//Contact Phone
	define("LANG_ADVERTISE_LIST_CONTACT_PHONE", "Téléphone du Contact");
	//Contact E-mail
	define("LANG_ADVERTISE_LIST_CONTACT_EMAIL", "E-mail du Contact");
	//Event Time
	define("LANG_ADVERTISE_LIST_START_TIME", "Événements Heure");
	//Price
	define("LANG_ADVERTISE_LIST_PRICE", "Prix");
	//Publication Date
	define("LANG_ADVERTISE_LIST_PUBLICATION", "Date de Publication");
	//Author
	define("LANG_ADVERTISE_LIST_AUTHOR", "Auteur");
	//Abstract
	define("LANG_ADVERTISE_LIST_ABSTRACT", "Résumé");
	//Content
	define("LANG_ADVERTISE_LIST_CONTENT", "Content");
    //Social Networking Pages
    define("LANG_ADVERTISE_LIST_SOCIAL_NETWORK", "Social Networking Pages");

	# ----------------------------------------------------------------------------------------------------
	# MANAGE MODULES ORDINATION
	# ----------------------------------------------------------------------------------------------------
	//Click here to order by descending title
	define("LANG_CLICK_ORDERTITLEDESC", "Cliquez ici pour trier par nom décroissant");
	//Click here to order by ascending title
	define("LANG_CLICK_ORDERTITLEASC", "Cliquez ici pour trier par nom croissant");
	//Click here to order by descending level
	define("LANG_CLICK_ORDERLEVELDESC", "Cliquez ici pour trier par niveau décroissant");
	//Click here to order by ascending level
	define("LANG_CLICK_ORDERLEVELASC", "Cliquez ici pour trier par niveau croissant");
	//Click here to order by descending account
	define("LANG_CLICK_ORDERACCOUNTDESC", "Cliquez ici pour trier par compte décroissant");
	//Click here to order by ascending account
	define("LANG_CLICK_ORDERACCOUNTASC", "Cliquez ici pour trier par compte croissant");
	//Click here to order by descending status
	define("LANG_CLICK_ORDERSTATUSDESC", "Cliquez ici pour trier par état décroissant");
	//Click here to order by ascending status
	define("LANG_CLICK_ORDERSTATUSASC", "Cliquez ici pour trier par état croissant");
	//Click here to order by descending caption
	define("LANG_CLICK_ORDERCAPTIONDESC", "Cliquez ici pour trier par légende décroissant");
	//Click here to order by ascending caption
	define("LANG_CLICK_ORDERCAPTIONASC", "Cliquez ici pour trier par légende croissant");
	//Click here to order by descending type
	define("LANG_CLICK_ORDERTYPEDESC", "Cliquez ici pour trier par type décroissant");
	//Click here to order by ascending type
	define("LANG_CLICK_ORDERTYPEASC", "Cliquez ici pour trier par type croissant");
	//Click here to order by descending renewal date
	define("LANG_CLICK_ORDERRENEWALDESC", "Cliquez ici pour trier par renouvellement décroissant");
	//Click here to order by ascending renewal date
	define("LANG_CLICK_ORDERRENEWALASC", "Cliquez ici pour trier par renouvellement croissant");
	//Click here to order by descending impressions
	define("LANG_CLICK_ORDERIMPRESSIONSDESC", "Cliquez ici pour trier par affichages décroissant");
	//Click here to order by ascending impressions
	define("LANG_CLICK_ORDERIMPRESSIONSASC", "Cliquez ici pour trier par affichages croissant");
	//Click here to order by descending start date
	define("LANG_CLICK_ORDERSTARTDATEDESC", "Cliquez ici pour trier par date de Début décroissant");
	//Click here to order by ascending start date
	define("LANG_CLICK_ORDERSTARTDATEASC", "Cliquez ici pour trier par date de Début croissant");

	# ----------------------------------------------------------------------------------------------------
	# MEMBERS
	# ----------------------------------------------------------------------------------------------------
	//Your item has been paid, so you can add a maximum of 3 categories free.
	define("LANG_ITEM_ALREADY_HAS_PAID", "Votre article a été payée, de sorte que vous pouvez ajouter un maximum de [max] catégories gratuitement.");
	//Your item has been paid, so you can add a maximum of 1 category free.
	define("LANG_ITEM_ALREADY_HAS_PAID2", "Votre article a été payée, de sorte que vous pouvez ajouter un maximum de [max] catégorie gratuitement.");
	//Video Snippet Code TIP
	define("LANG_VIDEO_SNIPPETTIP", "Avez-vous une question à propos de la vidéo extrait de code? Cliquez ici.");
	//Enjoy our Services!
	define("LANG_ENJOY_OUR_SERVICES", "Profitez de nos services!");
	//Remove association with
	define("LANG_REMOVE_ASSOCIATION_WITH", "Supprimer l'association avec");
	//Welcome
	define("LANG_LABEL_WELCOME", "Bienvenue");
	//Sponsor Options
	define("LANG_LABEL_MEMBER_OPTIONS", "Options des sponsors");
	//Back to Website
	define("LANG_LABEL_BACK_TO_SEARCH", "Retour au Website");
	//Add New Account
	define("LANG_LABEL_ADD_NEW_ACCOUNT", "Ajouter un Nouveau Compte");
	//Forgotten password
	define("LANG_LABEL_FORGOTTEN_PASSWORD", "Mot de passe oublié");
	//Click here
	define("LANG_LABEL_CLICK_HERE", "Cliquez ici");
	//Help
	define("LANG_LABEL_HELP", "Aide");
	//Reset Password
	define("LANG_LABEL_RESET_PASSWORD", "Réinitialiser le mot de passe");
	//Account and Contact Information
	define("LANG_LABEL_ACCOUNT_AND_CONTACT_INFO", "Information sur le Compte et le Contact");
	//Signup Notification
	define("LANG_LABEL_SIGNUP_NOTIFICATION", "Notification d'Inscription");
	//Go to Sign in
	define("LANG_LABEL_GO_TO_LOGIN", "Aller à la Page de Connexion");
	//Order
	define("LANG_LABEL_ORDER", "Commander");
	//Check Out
	define("LANG_LABEL_CHECKOUT", "Payer");
	//Configuration
	define("LANG_LABEL_CONFIGURATION", "Configuration");
	//Category Detail
	define("LANG_LABEL_CATEGORY_DETAIL", "Détail de la Catégorie");
	//Site Manager
	define("LANG_LABEL_SITE_MANAGER", "Website Manager");
	//Summary page
	define("LANG_LABEL_SUMMARY_PAGE", "Sommaire");
	//Detail page
	define("LANG_LABEL_DETAIL_PAGE", "Page de Détails");
	//Photo Gallery
	define("LANG_LABEL_PHOTO_GALLERY", "Galerie de Photos");
	//To select a main image, simply click on it.
	define("LANG_LABEL_PHOTO_GALLERY_MAIN", "Pour sélectionner une image principale, cliquez simplement dessus.");
	//Add Banner
	define("LANG_LABEL_ADDBANNER", "Ajouter une Bannière");
	//Custom Invoice Title
	define("LANG_LABEL_CUSTOM_INVOICE_TITLE", "Titre de la Facturation Personnalisée");
	//Custom Invoice Items
	define("LANG_LABEL_CUSTOM_INVOICE_ITEMS", "Objets de la Facturation Personnalisée");
	//Easy and Fast.
	define("LANG_LABEL_EASY_AND_FAST", "Facile et Rapide.");
	//Steps
	define("LANG_LABEL_STEPS", "Étapes");
	//Account Signup
	define("LANG_LABEL_ACCOUNT_SIGNUP", "S'inscrire au Compte");
	//Select a Level
	define("LANG_LABEL_SELECT_PACKAGE", "Choisissez un Niveau");
	//Payment Status
	define("LANG_LABEL_PAYMENTSTATUS", "Etat du Paiement");
	//Expiration
	define("LANG_LABEL_EXPIRATION", "Expiration");
	//New Deal
	define("LANG_LABEL_ADDNEWPROMOTION", "Nouveau Offrir");
	//Add a new deal
	define("LANG_LABEL_ADDANEWPROMOTION", "Ajouter un nouveau offrir");
	//Manage Billing
	define("LANG_LABEL_MANAGEBILLING", "Gérer la Facturation");
	//Click here if you have your password already.
	define("LANG_MSG_CLICK_IF_YOU_HAVE_PASSWORD", "Cliquez ici si vous avez déjà votre mot de passe.");
	//Not a sponsor?
	define("LANG_MSG_NOT_A_MEMBER", "Vous n'etez pas Sponsors?");
	//for information on adding your item to
	define("LANG_MSG_FOR_INFORMATION_ON_ADDING_YOUR_ITEM", "pour plus d'informations sur l'ajout de votre objet à");
	//Welcome to the Sponsor Section
	define("LANG_MSG_WELCOME", "Bienvenue à la Section des Sponsors");
	//Welcome to the Member Section
	define("LANG_MSG_WELCOME2", "Bienvenue à la Section des Membres");
	//"Account locked. Wait" X minute(s) and try again.
	define("LANG_MSG_ACCOUNTLOCKED1", "Compte bloqué. Attendre");
	//Account locked. Wait X "minute(s) and try again."
	define("LANG_MSG_ACCOUNTLOCKED2", "minute(s) et essayez de nouveau.");
	//One or more required fields were not filled in. Please confirm that all required information has been entered before continuing.
	define("LANG_MSG_FOREIGNACCOUNTWARNING", "Un ou plusieurs champs obligatoires n'ont pas été pourvus. S'il vous plaît confirmer que toutes les informations nécessaires a été conclu avant de continuer.");
	//You don't have access permission from this IP address!
	define("LANG_MSG_YOUDONTHAVEACCESSFROMTHISIPADDRESS", "Vous n'avez pas l'autorisation d'accès de cette adresse IP!");
	//Your account was deactivated!
	define("LANG_MSG_ACCOUNT_DEACTIVE", "Votre compte a été desactivé!");
	//Sorry, your username or password is incorrect.
	define("LANG_MSG_USERNAME_OR_PASSWORD_INCORRECT", "Désolé, votre e-mail ou mot de passe est incorrect.");
	//Sorry, wrong account.
	define("LANG_MSG_WRONG_ACCOUNT", "Désolé, mauvais compte.");
	//Sorry, for your protection the link sent to your e-mail has expired. If you forgot your password click on the link below.
	define("LANG_MSG_WRONG_KEY", "Désolé, pour votre protection leur lien envoyé à votre adresse e-mail a expiré. Si vous avez oublié votre mot de passe, cliquez sur le lien ci-dessous.");
    //Invalid activation key.
    define("LANG_MSG_WRONG_ACTIVATION_KEY", "Clé d'activation invalide.");
    //Account successfully activated!
    define("LANG_MSG_ACCOUNT_ACTIVATED", "Compte activé avec succès!");
    //OpenID Server not available!
	define("LANG_MSG_OPENID_SERVER", "OpenID Le serveur n'est pas disponible!");
	//Error requesting OpenID Server!
	define("LANG_MSG_OPENID_ERROR", "Erreur lors de l'appel du serveur OpenID!");
	//OpenID request canceled!
	define("LANG_MSG_OPENID_CANCEL", "Demande d'annulation OpenID!");
	//Google request canceled!
	define("LANG_MSG_GOOGLE_CANCEL", "Demande d'annulation Google!");
	//Invalid OpenID Identity!
	define("LANG_MSG_OPENID_INVALID", "Identification des invalides OpenID!");
	//Forgot your password?
	define("LANG_MSG_FORGOT_YOUR_PASSWORD", "Avez-vous oublié votre mot de passe?");
	//What is OpenID?
	define("LANG_MSG_WHATISOPENID", "Qu'est-ce que OpenID?");
	//What is Facebook?
	define("LANG_MSG_WHATISFACEBOOK", "Qu'est-ce que Facebook?");
	//What is Google?
	define("LANG_MSG_WHATISGOOGLE", "Qu'est-ce que Google?");
	//Account successfully updated!
	define("LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED", "Le compte a été mis à jour!");
	//Password successfully updated!
	define("LANG_MSG_PASSWORD_SUCCESSFULLY_UPDATED", "Mot de passe a été mis à jour!");
	//"Thank you for signing up for an account in" [EDIRECTORY_TITLE]
	define("LANG_MSG_THANK_YOU_FOR_SIGNING_UP", "Merci de votre inscription à un compte en");
	//Sign in to manage your account with the e-mail and password below.
	define("LANG_MSG_LOGIN_TO_MANAGE_YOUR_ACCOUNT", "Connectez-vous ci-dessous pour gérer votre compte avec le e-mail et le mot de passe.");
	//You can see
	define("LANG_MSG_YOU_CAN_SEE", "Vous pouvez voir");
	//Your account in
	define("LANG_MSG_YOUR_ACCOUNT_IN", "Votre compte en");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_ARTICLE_WILL_SHOW", "Affiche");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_CLASSIFIED_WILL_SHOW", "Affiche");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_EVENT_WILL_SHOW", "Affiche ");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_LISTING_WILL_SHOW", "Affiche");
	//This [ITEM] will show [UNLIMITED|"the max of" X] images per gallery.
	define("LANG_MSG_THE_MAX_OF", "le maximum de");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTO", "image");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTOS", "images");
	//This [ITEM] will show [UNLIMITED|the max of X] images "per gallery"
	define("LANG_MSG_PER_GALLERY", "dans la galerie");
	// plus one main image.
	define("LANG_MSG_PLUS_MAINIMAGE", " ainsi une image principale.");
	//Click here to pay for your article
	define("LANG_MSG_CONTINUE_TO_PAY_ARTICLE", "Cliquez ici pour payer votre article");
	//Click here to pay for your banner
	define("LANG_MSG_CONTINUE_TO_PAY_BANNER", "Cliquez ici pour payer votre bannière");
	//Click here to pay for your classified
	define("LANG_MSG_CONTINUE_TO_PAY_CLASSIFIED", "Cliquez ici pour payer votre annonce");
	//Click here to pay for your event
	define("LANG_MSG_CONTINUE_TO_PAY_EVENT", "Cliquez ici pour payer votre événement");
	//Click here to pay for your listing
	define("LANG_MSG_CONTINUE_TO_PAY_LISTING", "Cliquez ici pour payer votre liste");
	//Articles are activated by
	define("LANG_MSG_ARTICLES_ARE_ACTIVATED_BY", "Articles sont activés par");
	//Banners are activated by
	define("LANG_MSG_BANNERS_ARE_ACTIVATED_BY", "Bannières sont activés par");
	//Classifieds are activated by
	define("LANG_MSG_CLASSIFIEDS_ARE_ACTIVATED_BY", "Annonces sont activés par");
	//Events are activated by
	define("LANG_MSG_EVENTS_ARE_ACTIVATED_BY", "Événements sont activés par");
	//Listings are activated by
	define("LANG_MSG_LISTINGS_ARE_ACTIVATED_BY", "Listes sont activés par");
	//only after the process is complete.
	define("LANG_MSG_ONLY_PROCCESS_COMPLETE", "seulement après que le processus soit terminé.");
    //You can only pay for [MAX_ITEMS_MODULE] each time.
    define("LANG_MSG_PROCCESS_MAXITEMS", "Vous ne pouvez payer [MAX_ITEMS_MODULE] à chaque fois.");
    //Make the process again with less items.
    define("LANG_MSG_PROCCESS_AGAIN", "Rendre le processus encore une fois avec moins de points.");
	//Tips for the Item Map Tuning
	define("LANG_MSG_TIPSFORMAPTUNING", "Conseils pour la Carte des Réglages des Objets");
	//You can adjust the position in the map,
	define("LANG_MSG_YOUCANADJUSTPOSITION", "Vous pouvez ajuster la position sur la carte,");
	//with more accuracy.
	define("LANG_MSG_WITH_MORE_ACCURACY", "avec plus de précision.");
	//Use the controls "+" and "-" to adjust the map zoom.
	define("LANG_MSG_USE_CONTROLS_TO_ADJUST", "Utilisez les commandes \"+\" et \"-\" pour ajuster le zoom de la carte");
	//Use the arrows to navigate on map.
	define("LANG_MSG_USE_ARROWS_TO_NAVIGATE", "Utilisez les flèches pour naviguer sur la carte.");
	//Drag-and-Drop the marker to adjust the location.
	define("LANG_MSG_DRAG_AND_DROP_MARKER", "Glisser/déplacer le marqueur pour modifier l'emplacement.");
    //Drag files here to upload
    define("LANG_MSG_DROP_IMAGE", "Faites glisser les fichiers ici pour télécharger");
	//Your deal will appear here
	define("LANG_MSG_PROMOTION_WILL_APPEAR_HERE", "Votre offrir apparaîtra ici");
	//Associate an existing deal with this listing
	define("LANG_MSG_ASSOCIATE_EXISTING_PROMOTION", "Associez un Offres a cette liste");
	//No results found!
	define("LANG_MSG_NO_RESULTS_FOUND", "Aucun résultat trouvé!");
	//Access not allowed!
	define("LANG_MSG_ACCESS_NOT_ALLOWED", "Accès non autorisé!");
	//The following problems were found
	define("LANG_MSG_PROBLEMS_WERE_FOUND", "Les problèmes suivants ont été trouvés");
	//No items selected or requiring payment.
	define("LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT", "Aucun produit sélectionné ou exigeant le paiement.");
	//No items found.
	define("LANG_MSG_NO_ITEMS_FOUND", "Aucun objet trouvé.");
	//No invoices in the system.
	define("LANG_MSG_NO_INVOICES_IN_THE_SYSTEM", "Aucune facture dans le système.");
	//No transactions in the system.
	define("LANG_MSG_NO_TRANSACTIONS_IN_THE_SYSTEM", "Aucune transaction dans le système.");
	//Claim this Listing
	define("LANG_MSG_CLAIM_THIS_LISTING", "Réclamez cette Liste");
	//Go to sponsor check out area
	define("LANG_MSG_GO_TO_MEMBERS_CHECKOUT", "Passer la commande dans la zone des sponsors");
	//You can see your invoice in
	define("LANG_MSG_YOU_CAN_SEE_INVOICE", "Vous pouvez voir votre facture dans");
	//I agree to terms
	define("LANG_MSG_AGREE_TO_TERMS", "Je suis d'accord avec les conditions");
	//and I will send payment.
	define("LANG_MSG_I_WILL_SEND_PAYMENT", "et je vais envoyer le paiement.");
	//This page will redirect you to your sponsor area in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU", "Cette page va vous rediriger vers votre espace sponsors en quelques secondes.");
	//This page will redirect you to continue your signup process in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU_SIGNUP", "Cette page va vous rediriger en quelques secondes pour poursuivre votre processus d'inscription.");
	//"If it doesn't work, please" click here
	define("LANG_MSG_IF_IT_DOES_NOT_WORK", "Si cela ne fonctionne pas, s'il vous plaît de");
	//Manage Article
	define("LANG_MANAGE_ARTICLE", "Gérer l'article");
	//Manage Banner
	define("LANG_MANAGE_BANNER", "Gérer la Bannière");
	//Manage Classified
	define("LANG_MANAGE_CLASSIFIED", "Gérer l'Annonce");
	//Manage Event
	define("LANG_MANAGE_EVENT", "Gérer l'Evénement");
	//Manage Listing
	define("LANG_MANAGE_LISTING", "Gérer la Liste");
	//Manage Deal
	define("LANG_MANAGE_PROMOTION", "Gérer le Offrir");
	//Manage Billing
	define("LANG_MANAGE_BILLING", "Gérer la Facturation");
	//Manage Invoices
	define("LANG_MANAGE_INVOICES", "Gérer les Factures");
	//Manage Transactions
	define("LANG_MANAGE_TRANSACTIONS", "Gérer les Transactions");
	//No articles in the system.
	define("LANG_NO_ARTICLES_IN_THE_SYSTEM", "Aucun article dans le système.");
	//No banners in the system.
	define("LANG_NO_BANNERS_IN_THE_SYSTEM", "Aucune bannières dans le système.");
	//No classifieds in the system.
	define("LANG_NO_CLASSIFIEDS_IN_THE_SYSTEM", "Aucune annonce dans le système.");
	//No events in the system.
	define("LANG_NO_EVENTS_IN_THE_SYSTEM", "Aucun événement dans le système.");
	//No listings in the system.
	define("LANG_NO_LISTINGS_IN_THE_SYSTEM", "Aucune liste dans le système.");
	//No deals in the system.
	define("LANG_NO_PROMOTIONS_IN_THE_SYSTEM", "Aucun offres dans le système.");
	//No Reports Available.
	define("LANG_NO_REPORTS", "Rapports non Disponibles.");
	//No article found. It might be deleted.
	define("LANG_NO_ARTICLE_FOUND", "Aucun article trouvé. Peut-être il a été supprimé.");
	//No classified found. It might be deleted.
	define("LANG_NO_CLASSIFIED_FOUND", "Aucune annonce trouvé. Peut-être elle a été supprimé.");
	//No listing found. It might be deleted.
	define("LANG_NO_LISTING_FOUND", "Aucune liste trouvé. Peut-être elle a été supprimé.");
	//Article Information
	define("LANG_ARTICLE_INFORMATION", "Information sur l'Article");
	//Delete Article
	define("LANG_ARTICLE_DELETE", "Supprimer l'Article");
	//Delete Article Information
	define("LANG_ARTICLE_DELETE_INFORMATION", "Supprimer l'information sur l'Article");
	//Are you sure you want to delete this article
	define("LANG_ARTICLE_DELETE_CONFIRM", "Êtes-vous sûr de vouloir supprimer cet article?");
	//Article Preview
	define("LANG_ARTICLE_PREVIEW", "Aperçu de l'Article");
	//Article Traffic Report
	define("LANG_ARTICLE_TRAFFIC_REPORT", "Rapport du Trafic de l'Article");
	//Article Detail
	define("LANG_ARTICLE_DETAIL", "Détail de l'Article");
	//Edit Article Information
	define("LANG_ARTICLE_EDIT_INFORMATION", "Modifier l'Information sur l'Article ");
	//Delete Banner
	define("LANG_BANNER_DELETE", "Supprimer Bannière");
	//Delete Banner Information
	define("LANG_BANNER_DELETE_INFORMATION", "Supprimer l'information sur la Bannière");
	//Are you sure you want to delete this banner?
	define("LANG_BANNER_DELETE_CONFIRM", "Etes-vous sûr de vouloir supprimer cette bannière?");
	//Edit Banner
	define("LANG_BANNER_EDIT", "Modifier la Bannière");
	//Edit Banner Information
	define("LANG_BANNER_EDIT_INFORMATION", "Modifier l'information sur la Bannière");
	//Banner Preview
	define("LANG_BANNER_PREVIEW", "Aperçu de la Bannière");
	//Banner Traffic Report
	define("LANG_BANNER_TRAFFIC_REPORT", "Rapport du Trafic de la Bannière");
	//View Banner
	define("LANG_VIEW_BANNER", "Affichage de la Bannière");
	//Disabled
	define("LANG_BANNER_DISABLED", "Désactivé");
	//Classified Information
	define("LANG_CLASSIFIED_INFORMATION", "Information sur l'Annonce");
	//Delete Classified
	define("LANG_CLASSIFIED_DELETE", "Supprimer l'Annonce");
	//Your classified will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_CLASSIFIED_AUTOMATICALLY_APPEAR", "Votre annonce apparaît automatiquement dans la catégorie de chaque sous-catégorie que vous choisissez.");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORY_PLURAL", "Annonce Catégories");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORIES", "Annonce Catégories");
	//Delete Classified Information
	define("LANG_CLASSIFIED_DELETE_INFORMATION", "Supprimer l'Information sur l'Annonce");
	//Are you sure you want to delete this classified
	define("LANG_CLASSIFIED_DELETE_CONFIRM", "Êtes-vous sûr de vouloir supprimer cette annonce?");
	//Classified Map Tuning
	define("LANG_CLASSIFIED_MAP_TUNING", "Carte des Réglages de l'Annonce");
	//Classified Preview
	define("LANG_CLASSIFIED_PREVIEW", "Aperçu de l'Annonce");
	//Classified Traffic Report
	define("LANG_CLASSIFIED_TRAFFIC_REPORT", "Rapport du Trafic de l'Annonce");
	//Classified Detail
	define("LANG_CLASSIFIED_DETAIL", "Détail de l'Annonce");
	//Edit Classified Information
	define("LANG_CLASSIFIED_EDIT_INFORMATION", "Modifier les Informations de l'Annonce");
	//Edit Classified Level
	define("LANG_CLASSIFIED_EDIT_LEVEL", "Modifier le Niveau de l'Annonce");
	//Delete Event
	define("LANG_EVENT_DELETE", "Supprimer l'Événement");
	//Delete Event Information
	define("LANG_EVENT_DELETE_INFORMATION", "Supprimer l'Information sur l'Événement");
	//Are you sure you want to delete this event?
	define("LANG_EVENT_DELETE_CONFIRM", "Êtes-vous sûr de vouloir supprimer cet événement?");
	//Event Information
	define("LANG_EVENT_INFORMATION", "Information sur l'Événement");
	//Event Map Tuning
	define("LANG_EVENT_MAP_TUNING", "Carte Des Réglages d'Événement");
	//Event Preview
	define("LANG_EVENT_PREVIEW", "Aperçu de l'Événement");
	//Event Traffic Report
	define("LANG_EVENT_TRAFFIC_REPORT", "Rapports de Trafic de l'Événement");
	//Event Detail
	define("LANG_EVENT_DETAIL", "Détail de l'Événement");
	//Edit Event Information
	define("LANG_EVENT_EDIT_INFORMATION", "Modifier l'Événement");
	//Listing Information
	define("LANG_LISTING_INFORMATION", "Information sur la liste");
	//Listing Map Tuning
	define("LANG_LISTING_MAP_TUNING", "Carte Des Réglages de la Liste");
	//Listing Preview
	define("LANG_LISTING_PREVIEW", "Aperçu de la Liste");
	//Listing Deal
	define("LANG_LISTING_PROMOTION", "Offrir sur la Liste");
	//The deal is linked from the listing.
	define("LANG_LISTING_PROMOTION_IS_LINKED", "Le offrir est liée à la liste.");
	//To be active the deal
	define("LANG_LISTING_TO_BE_ACTIVE_PROMOTION", "Pour être actif, le offrir");
	//must have an end date in the future.
	define("LANG_LISTING_END_DATE_IN_FUTURE", "doit avoir une date de fin dans le futur.");
	//must be associated with a listing.
	define("LANG_LISTING_ASSOCIATED_WITH_LISTING", "doit être associé à un liste.");
	//Listing Traffic Report
	define("LANG_LISTING_TRAFFIC_REPORT", "Rapport du Trafic de la Liste");
	//Listing Detail
	define("LANG_LISTING_DETAIL", "Détail de la Liste");
	//for listing
	define("LANG_LISTING_FOR_LISTING", "pour liste");
	//Listing Update
	define("LANG_LISTING_UPDATE", "Mettre à jour la Liste");
	//Delete Deal
	define("LANG_PROMOTION_DELETE", "Supprimer le Offrir");
	//Delete Deal Information
	define("LANG_PROMOTION_DELETE_INFORMATION", "Supprimer l'information sur le Offrir");
	//Are you sure you want to delete this deal?
	define("LANG_PROMOTION_DELETE_CONFIRM", "Êtes-vous sûr de vouloir supprimer cet offrir?");
	//Deal Preview
	define("LANG_PROMOTION_PREVIEW", "Aperçu du Offrir");
	//Deal Traffic Report
	define("LANG_PROMOTION_TRAFFIC_REPORT", "Rapport du Trafic de la offrir");
	//Deal Information
	define("LANG_PROMOTION_INFORMATION", "Information sur le Offrir");
	//Deal Detail
	define("LANG_PROMOTION_DETAIL", "Détail de lo Offrir");
	//Edit Deal Information
	define("LANG_PROMOTION_EDIT_INFORMATION", "Modifier l'Information sur le Offrir");
	//Image successfully deleted!
	define("LANG_IMAGE_SUCCESSFULLY_DELETED", "Image supprimée avec succès!");
	//Review Detail
	define("LANG_REVIEW_DETAIL", "Détail de l'évaluation");
	//Review Preview
	define("LANG_REVIEW_PREVIEW", "Aperçu de l'évaluation");
	//Invoice Detail
	define("LANG_INVOICE_DETAIL", "Facture Détaillée");
	//Invoice not found for this account.
	define("LANG_INVOICE_NOT_FOUND_FOR_ACCOUNT", "Facture non trouvé pour ce compte.");
	//Invoice Notification
	define("LANG_INVOICE_NOTIFICATION", "Notification de Facture");
	//Transaction Detail
	define("LANG_TRANSACTION_DETAIL", "Détails de la Transaction");
	//Transaction not found for this account.
	define("LANG_TRANSACTION_NOT_FOUND_FOR_ACCOUNT", "La transaction n'a pas été trouvée pour ce compte.");
	//Sign in with Directory Account
	define("LANG_LOGINDIRECTORYUSER", "Connexion avec Répertoire compte");
	//Sign in with OpenID 2.0 Account
	define("LANG_LOGINOPENIDUSER", "Connexion avec OpenID 2.0 compte");
	//Log in with Facebook
	define("LANG_LOGINFACEBOOKUSER", "Connexion avec Facebook");
	//Sign up with Facebook
	define("LANG_SIGNUPFACEBOOKUSER", "Enregistrez avec Facebook");
	//Log in with Google
	define("LANG_LOGINGOOGLEUSER", "Connexion avec Google");
	//Sign up with Google
	define("LANG_SIGNUPGOOGLEUSER", "Enregistrez avec Google");
	//Username already registered!
	define("LANG_USERNAME_ALREADY_REGISTERED", LANG_LABEL_USERNAME." déjà enregistré!");
	//This e-mail is available.
	define("LANG_USERNAME_NOT_REGISTERED", "Cet e-mail est disponible.");
	//Error uploading image. Please try again.
	define("LANG_MSGERROR_ERRORUPLOADINGIMAGE", "Erreur de chargement de l'image. S'il vous plaît essayer de nouveau");
	//Image successfully uploaded
	define("LANG_IMAGE_SUCCESSFULLY_UPLOADED", "Image transféré avec succès!");
	//Image successfully updated
	define("LANG_IMAGE_SUCCESSFULLY_UPDATED", "Image correctement mis à jour!");
	//Delete image
	define("LANG_DELETE_IMAGE", "Supprimer l'image");
	//Are you sure you want to delete this image
	define("LANG_DELETE_IMAGE_CONFIRM", "Etes-vous sûr de vouloir supprimer cette image?");
	//Edit Image
	define("LANG_LABEL_EDITIMAGE", "Modifier l'image");
	//Make main
	define("LANG_LABEL_MAKEMAIN", "Faire principales");
	//Main image
	define("LANG_LABEL_MAINIMAGE", "Principale");
	//Click here to set as main image
	define("LANG_LABEL_CLICKTOSETMAINIMAGE", "Cliquez ici pour définir comme image principale");
	//Click here to set as gallery image
	define("LANG_LABEL_CLICKTOSETGALLERYIMAGE", "Cliquez ici pour définir comme la galerie d'images");
	//Packages
	define("LANG_PACKAGE_PLURAL", "Paquets");
	//Package
	define("LANG_PACKAGE_SING", "Paquet");
	//Charging for package
	define("LANG_CHARGING_PACKAGE", "Charge pour le paquet ");

	# ----------------------------------------------------------------------------------------------------
	# SOCIAL NETWORK
	# ----------------------------------------------------------------------------------------------------
	//Profile successfully updated!
	define("LANG_MSG_PROFILE_SUCCESSFULLY_UPDATED", "Profil mis à jour!");
	//Profile
	define("LANG_LABEL_PROFILE", "Profil");
	//Edit Profile
	define("LANG_LABEL_EDIT_PROFILE", "Modifier le Profil");
	//Load from Facebook
	define("LANG_LABEL_IMAGE_FROM_FACEBOOK", "Charger de Facebook.");
	//Personal Infomation
	define("LANG_LABEL_PERSONAL_INFORMATION", "Des renseignements personnels");
	//Twitter Account
	define("LANG_LABEL_TWITTER_ACCOUNT", "Compte Twitter");
	//Twitter Widget
	define("LANG_LABEL_TWITTER_WIDGET", "Twitter Widget");
	//About me
	define("LANG_LABEL_ABOUT_ME", "À propos de Moi");
	//Birthdate
	define("LANG_LABEL_BIRTHDATE", "Date de naissance");
	//Hometown
	define("LANG_LABEL_HOMETOWN", "Ville Natale");
	//Favorite Books
	define("LANG_LABEL_FAVORITEBOOKS", "Livres Préférés");
	//Favorite Movies
	define("LANG_LABEL_FAVORITEMOVIES", "Films Préférés");
	//Favorite Sports
	define("LANG_LABEL_FAVORITESPORTS", "Sports Favoris");
	//Favorite Musics
	define("LANG_LABEL_FAVORITEMUSICS", "Favoris Musiques");
	//Favorite Foods
	define("LANG_LABEL_FAVORITEFOODS", "Aliments Préférés");
	//Are you sure?
	define("LANG_MESSAGE_MSGAREYOUSURE", "Etes-vous sûr?");
	//This is the URL where visitors can see your public profile page
	define("LANG_MSG_FRIENDLY_URL_PROFILE_TIP", "Ceci est l'URL où les visiteurs peuvent voir votre page de profil public");
	//Your URL
	define("LANG_LABEL_YOUR_URL", "Votre URL");
    //Your URL is required.
	define("LANG_LABEL_YOURURL_REQUIRED", "Votre URL est requise.");
    //yoururl
    define("LANG_LABEL_YOUR_URLTIP", "votreurl");
    //Available URL
    define("LANG_LABEL_URLOK", "URL disponible");
    //Unavailable URL
    define("LANG_LABEL_URLNOTOK", "Non disponible URL");
	//Your URL contains invalid chars.
	define("LANG_MSG_FRIENDLY_URL_INVALID_CHARS", "Votre URL contient les caractères invalides.");
	//URL already in use, please choose another URL.
	define("LANG_MSG_PAGE_URL_IN_USE", "URL déjà en cours d'utilisation, s'il vous plaît choisir une autre URL.");
	//View all
	define("LANG_LABEL_VIEW_ALL", "Voir tous");
	//View all
	define("LANG_LABEL_VIEW_ALL2", "Voir tous");
	//No Items
	define("LANG_MSG_NO_ITEMS", "Aucun Article");
	//Share
	define("LANG_LABEL_SHARE", "Part");
	//Comments
	define("LANG_LABEL_COMMENTS", "Commentaires");
	//My Profile
	define("LANG_LABEL_MYPROFILE", "Mon Profil");
	//User profile successfully enabled!
	define("LANG_MSG_PROFILE_ENABLED", "Profil d'utilisateur activé avec succès!");
	//Display my contact information publicly
	define("LANG_LABEL_PUBLISH_MY_CONTACT", "Publier mes coordonnées");
	//Create my Personal Page
	define("LANG_LABEL_CREATE_PERSONAL_PAGE", "Créer ma page personnelle");
	//Public Profile
	define("LANG_LABEL_PERSONAL_PAGE", "Page Personnelle");
	//Article Reviews
	define("LANG_LABEL_ARTICLE_REVIEW", "Article passe en revue");
	//Listing Reviews
	define("LANG_LABEL_LISTING_REVIEW", "Liste des commentaires");
	//Deal Reviews
	define("LANG_LABEL_PROMOTION_REVIEW", "Offres passe en revue");
	//Review successfully deleted.
	define("LANG_MSG_REVIEW_SUCCESS_DELETED", "Revoir supprimé avec succès.");
	//No reviews found!
	define("LANG_LABEL_NOREVIEWS", "Aucun commentaire trouvé!");
	//Edit my Profile
	define("LANG_LABEL_EDITPROFILE", "Modifier mon profil");
	//Back to my Profile
	define("LANG_LABEL_BACKTOPROFILE", "Retour à mon profil");
	//Member Since
	define("LANG_LABEL_MEMBER_SINCE", "Membre depuis");
	//Account Settings
	define("LANG_LABEL_ACCOUNT_SETTINGS", "Paramètres du Compte");
    //Deals Redeemed
	define("LANG_LABEL_ACCOUNT_DEALS", "Offres Rachetées");
	//Favorites
	define("LANG_LABEL_FAVORITES", "Favoris");
	//You have no permission to access this area.
	define("LANG_MSG_NO_PERMISSION", "Vous n'avez pas la permission d'accéder à cette section.");
	//Go to your Profile
	define("LANG_MSG_GO_PROFILE", "Accédez à votre profil.");
	//My Personal Page
	define("LANG_MSG_MY_PERSONAL_PAGE", "Ma page personnelle");
	//Use this Account
	define("LANG_MSG_USE_LOGGED_ACCOUNT", "Utilisez ce compte");
	//Profile Page
	define("LANG_LABEL_PROFILE_PAGE", "Page Profil");
	//Create your Profile
	define("LANG_CREATE_MEMBER_PROFILE", "Créez votre Profil");
	//Your Name is required.
	define("LANG_MSG_NICKANAME_REQUIRED", "Nom d'affichage est exigé.");
	//Be sure that the twitter account you are adding is not protected. If the twitter account is protected the latest tweets on this account will not be shown.
	define("LANG_PROFILE_TWITTER_TIP1", "Assurez-vous que le compte twitter que vous ajoutez ne sont pas protégées. Si le compte twitter est protégé le dernier tweets sur ce compte ne sera pas montré.");
	//Thank you for signing up!
    define("LANG_PROFILE_WELCOME", "Nous vous remercions pour votre inscription!");
    //We appreciate it and welcome to
    define("LANG_PROFILE_WELCOME2", "Nous apprécions et bienvenue à");

	# ----------------------------------------------------------------------------------------------------
	# GALLERY
	# ----------------------------------------------------------------------------------------------------
	//Only
	define("LANG_ONLY", "Sont acceptés  ");
	//images accepted for upload!
	define("LANG_IMAGES_ACCEPETED", "pour le téléchargement!");
	//Images must be under
	define("LANG_IMAGE_MUST_BE", "Les images doivent être sous ");
	//Select an image for upload!
	define("LANG_SELECT_IMAGE", "Sélectionnez une image pour télécharger!");
	//Original image
	define("LANG_ORIGINAL", "Image d'origine");
	//Thumbnail preview
	define("LANG_THUMB_PREVIEW", "Aperçu de Pouce");
	//Edit captions
	define("LANG_LABEL_EDIT_CAPTIONS", "Légendes");
	//You can add the maximum of
	define("LANG_YOU_CAN_ADD_MAXOF", "Vous pouvez ajouter le maximum de ");
	//photos to your gallery
	define("LANG_TO_YOUR_GALLERY", " photos à votre galerie!");
	//Create Thumbnail
	define("LANG_CREATE_THUMB", "Créer Miniature");
	//Thumbnail Preview
	define("LANG_THUMB_PREVIEW", "Avant-première Miniature");
	//Your item already has the maximum number of images in the gallery. Delete an existing image to save this one.
	define("LANG_ITEM_ALREADY_HAD_MAX_IMAGE", "Votre article a déjà le nombre maximum d\'images dans la galerie. Supprimer une image existante pour sauver celui-ci.");

	# ----------------------------------------------------------------------------------------------------
	# RECURRING EVENTS
	# ----------------------------------------------------------------------------------------------------
	//Recurring Event
	define("LANG_EVENT_RECURRING", "Événement Périodique");
	//Repeat
	define("LANG_PERIOD", "Répétition");
	//Choose an option
	define("LANG_CHOOSE_PERIOD", "Choisissez une option");
	//Daily
	define("LANG_DAILY", "Quotidien");
	//Weekly
	define("LANG_WEEKLY", "Hebdomadaire");
	//Monthly
	define("LANG_MONTHLY", "Mensuel");
	//Yearly
	define("LANG_YEARLY", "Annuel");
	//Daily Event
	define("LANG_DAILY2", "Événement Quotidien");
	//Weekly
	define("LANG_WEEKLY2", "Hebdomadaire");
	//Monthly
	define("LANG_MONTHLY2", "Mensuel");
	//Yearly
	define("LANG_YEARLY2", "Annuel");
	//every
	define("LANG_EVERY", "Tous");
	//every
	define("LANG_EVERY2", "Tous");
	//of
	define("LANG_OF", "de");
	//of
	define("LANG_OF2", "de");
	//of
	define("LANG_OF3", "de");
	//of
	define("LANG_OF4", "du");
	//Week
	define("LANG_WEEK", "Semaine");
	//Choose Month
	define("LANG_CHOOSE_MONTH", "Choisissez mois");
	//Choose Day
	define("LANG_CHOOSE_DAY", "Choisir la date");
	//Choose Week
	define("LANG_CHOOSE_WEEK", "Choisissez la Semaine");
	//First
	define("LANG_FIRST", "Première");
	//Second
	define("LANG_SECOND", "Deuxième");
	//Third
	define("LANG_THIRD", "Troisième");
	//Fourth
	define("LANG_FOURTH", "Quatrième");
	//Last
	define("LANG_LAST", "Dernier");
	//1st
    define("LANG_FIRST_2", "1ª");
    //2nd
    define("LANG_SECOND_2", "2ª");
    //3rd
    define("LANG_THIRD_2", "3ª");
    //4th
    define("LANG_FOURTH_2", "4ª");
	//Recurring
	define("LANG_RECURRING", "Récurrent");
	//Please select a day of week
	define("LANG_EVENT_SELECT_DAYOFWEEK", "S'il vous plaît sélectionner un jour de la semaine.");
	//Please type a day
	define("LANG_EVENT_TYPE_DAY", "S'il vous plaît une journée type.");
	//Please select a month
	define("LANG_EVENT_SELECT_MONTH", "S'il vous plaît sélectionner un mois.");
	//Please select a week
	define("LANG_EVENT_SELECT_WEEK", "S'il vous plaît sélectionnez une semaine.");
	//Please select a Repeat option
	define("LANG_EVENT_SELECT_PERIOD", "S'il vous plaît sélectionnez une option de Répétition.");
	//When
	define("LANG_EVENT_WHEN", "Quand");
	//Day must be numeric
	define("LANG_EVENT_TYPE_DAY_NUMERIC", "Journée doit être numérique.");
	//Day must be between 1 and 31
	define("LANG_EVENT_TYPE_DAY_BETWEEN", "Journée doit être comprise entre 1 et 31.");
	//Day doesn't match with the choosen period
	define("LANG_EVENT_CHECK_DAY", "Jour ne correspond pas à la période choisie.");
	//Month doesn't match with the choosen period
	define("LANG_EVENT_CHECK_MONTH", "Mois ne correspond pas à la période choisie.");
	//Days don't match with the choosen period
	define("LANG_EVENT_CHECK_DAYOFWEEK", "Jours ne correspondent pas à la période choisie.");
	//Week doesn't match with the choosen period
	define("LANG_EVENT_CHECK_WEEK", "Semaine ne correspond pas à la période choisie.");
	//No info
	define("LANG_EVENT_NO_INFO", "Pas d'info");
	//Ends on
	define("LANG_ENDS_IN", "Se termine le");
	//Never
	define("LANG_NEVER", "Jamais");
	//Until
	define("LANG_UNTIL", "Jusqu'à ce que");
	//Until Date
	define("LANG_LABEL_UNTIL_DATE", "Jusqu'à ce que");
	//The "Until Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_UNTIL_DATE_GREATER_THAN_START_DATE", "\"Jusqu'à ce que\" doit être supérieure ou égale à la \"Date de Début\".");
	//The "Until Date" cannot be in past.
	define("LANG_MSG_UNTIL_DATE_CANNOT_IN_PAST", "\"Jusqu'à ce que\" ne peut pas être dans le passé.");
	//Starts on
	define("LANG_EVENT_STARTS_ON", "Début le");
	//Starts
	define("LANG_EVENT_STARTS", "Début");
	//Repeats
	define("LANG_EVENT_REPEATS", "Répète");
	//Ends on
	define("LANG_EVENT_ENDS", "Se termine le");
	//weekend
	define("LANG_EVENT_WEEKEND", "fin de la semaine");
	//weekends
	define("LANG_EVENT_WEEKENDS", "fins de la semaines");
	//Mon-Fri
	define("LANG_EVENT_BUSINESSDAY", "Du lundi au vendredi");
	//the Month
	define("LANG_THE_MONTH", "le Mois");
	//Every Year
	define("LANG_EVERY_YEAR", "Chaque Année");

	# ----------------------------------------------------------------------------------------------------
	# SITES
	# ----------------------------------------------------------------------------------------------------
    //Site
    define("LANG_DOMAIN", "Site");
	//Site name
	define("LANG_DOMAIN_NAME", "Nom de site");
	//Click here to view this site
	define("LANG_MSG_CLICK_TO_VIEW_THIS_DOMAIN", "Cliquez ici ne visualiser ce site");
	//Click here to delete this site
	define("LANG_MSG_CLICK_TO_DELETE_THIS_DOMAIN", "Cliquez ici pour supprimer ce site");
	//Site successfully deleted!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_DELETE", "Site supprimé avec succès!");
	//Site successfully added!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2", "Site d'ajouter!");
	//An email notification will be sent to the eDirectory support team, please wait our contact.
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD", LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2."<br />Un courriel sera envoyé à l'équipe de soutien eDirectory, s'il vous plaît attendre notre contact.");
    //Site name is required
	define("LANG_MSG_DOMAINNAME_IS_REQUIRED", "Nom de site est nécessaire");
    //Site URL is required
	define("LANG_MSG_DOMAINURL_IS_REQUIRED", "URL de site est nécessaire");
	//Site name already exists
	define("LANG_MSG_DOMAINNAME_ALREADY_EXISTS", "Nom de site existe déjà");
	//Site URL already exists
	define("LANG_MSG_DOMAINURL_ALREADY_EXISTS", "URL de site existe déjà");
	//Site URL not valid
	define("LANG_MSG_DOMAINURL_INVALID_CHARS", "URL de site n'est pas valide");
	//Site Items
	define("LANG_SITE_ITEMS", "Articles du Site");
	//Select a Site
    define("LANG_SELECT_DOMAIN", "Changez de Site");

	# ----------------------------------------------------------------------------------------------------
	# PROFILE
	# ----------------------------------------------------------------------------------------------------
    //Sign Up with a new Account
    define("LANG_LABEL_PROFILE_SIGNUP", "Inscription d'un nouveau compte");
    //OR
    define("LANG_LABEL_PROFILE_OR", "OU");
    //Sign In with an existing account
    define("LANG_LABEL_PROFILE_FOREIGNACC", "Se connecter avec un compte existant");
    //Or use your OpenID to sign in
    define("LANG_LABEL_PROFILE_OPENID", "Ou utilisez votre OpenID pour vous connecter");
    //Your OpenID
    define("LANG_LABEL_PROFILE_YOUROPENID", "Votre OpenID");
    //Login
    define("LANG_LABEL_PROFILE_LOGIN", "Entrer");
    //Once you have created your account using a foreign system, it was activated automatically. Please disregard this message.
    define("LANG_LABEL_PROFILE_ACTIVATED", "Une fois que vous avez créé votre compte à l'aide d'un système externe, il a été activé automatiquement. S'il vous plaît ignorer ce message.");
    //Thank you for activating your account. The next step is to complete your profile.
    define("LANG_LABEL_PROFILE_WELCOME_ACT", "Merci pour activer votre compte. L'étape suivante consiste à remplir votre profil.");
    //Your account has not been activated yet. Check your activation e-mail and come back later to complete your profile.
    define("LANG_LABEL_PROFILE_WELCOME_NOTACT", "Votre compte n'a pas encore été activé. Vérifiez votre e-mail d'activation et de revenir plus tard pour compléter votre profil.");
    //Complete your profile
    define("LANG_LABEL_PROFILE_COMPLETE", "Complétez votre profil");
    //RECENT ACTIVITY
    define("LANG_LABEL_PROFILE_RECENT_ACTIVITY", "ACTIVITÉ RÉCENTE");
    //You have no recent activity.
    define("LANG_LABEL_PROFILE_RECENT_ACTIVITY_EMPTY", "Vous n'avez pas d'activité récente.");
    //Review on
    define("LANG_LABEL_PROFILE_REVIEWON", "Évaluation le");
    //You can connect your directory account with social networks
    define("LANG_LABEL_PROFILE_SNTIP", "Vous pouvez connecter votre compte d'annuaire avec les réseaux sociaux");
    //Change photo
    define("LANG_LABEL_PROFILE_CHANGEPHOTO", "Changer la photo");
    //Remove photo
    define("LANG_LABEL_PROFILE_REMOVEPHOTO", "Retirer photo");
    //Display Name
    define("LANG_LABEL_PROFILE_DISPLAYNAME", "Nom d'affichage");
    //Personal Page
    define("LANG_LABEL_PROFILE_PERSONALPAGE", "Page Personnelle");
    //Account Username
    define("LANG_LABEL_ACCOUNT_USERNAME", "Nom d'utilisateur");
    //You can change your e-mail access at any time. This is also the contact e-mail we use to reach you.
    define("LANG_LABEL_ACCOUNT_USERNAME_TIP", "Vous pouvez changer votre adresse e-mail l'accès à tout moment. C'est aussi le contact e-mail que nous utilisons pour vous joindre.");
    //Activated
    define("LANG_LABEL_ACCOUNT_ACT", "Activé");
    //Account not activated.
    define("LANG_LABEL_ACCOUNT_NOTACT", "Compte non activé.");
    //Activate account.
    define("LANG_LABEL_ACTIVATE_ACC", "Activer le compte.");
    //Your activation e-mail has been sent. Please, check your inbox.
    define("LANG_LABEL_ACTIVATEEMAIL_SENT", "Votre e-mail d'activation a été envoyé. S'il vous plaît, vérifiez votre boîte de réception.");
    //There was an error trying to send you a new activation e-mail.
    define("LANG_LABEL_ACTIVATEEMAIL_SENT_ERROR", "l y avait une erreur en tentant de vous envoyer un e-mail d'activation.");
    //get a new activation e-mail.
    define("LANG_LABEL_ACTIVATEEMAIL_GETNEW", "recevrez un email d'activation.");
    //Change Password
    define("LANG_LABEL_ACCOUNT_CHANGEPASS", "Changer mot de passe");
    //You can change your password at any time you want.
    define("LANG_LABEL_ACCOUNT_CHANGEPASS_TIP", "Vous pouvez changer votre mot de passe à chaque fois que vous voulez.");
    //This information will be hidden unless you click the publish checkbox below
    define("LANG_LABEL_ACCOUNT_CONTACT_TIP", "Ces informations ne seront pas publiées, si vous ne voulez pas faire.");
    //Settings
    define("LANG_LABEL_CONTACT_SETTINGS", "Préférences");
    //Check your preferences
    define("LANG_LABEL_CONTACT_SETTINGS_TIP", "Vérifiez vos préférences");
    //Profile Options
    define("LANG_MENU_PROFILEOPTIONS", "Options du Profil");
    //Profile Information
	define("LANG_LABEL_PROFILE_INFORMATION", "Renseignements sur le Profil");
	//Social Networking
	define("LANG_LABEL_FOREIGN_ACCOUNTS", "Réseautage Social");
	//Link and import informations
	define("LANG_LABEL_CONNECT_WITH_FB_AND_IMPORT", "Lien information et à l'importation");
	//Just link
	define("LANG_LABEL_CONNECT_WITH_FB", "Tout lien");
	//Link my Facebook account
	define("LANG_LABEL_LINK_FACEBOOK", "Lien mon compte Facebook");
	//Unlink my Facebook account
	define("LANG_LABEL_UNLINK_FB", "Dissocier mon compte Facebook");
	//Your account was unlinked from Facebook
	define("LANG_LABEL_FB_ACT_DISC", "Votre compte a été supprimé le lien entre Facebook");
	//Your Facebook account is already linked with other account in the system.
	define("LANG_FB_ALREADY_LINKED", "Votre compte Facebook est déjà lié avec le compte d'autres dans le système.");
	//Your Twitter account is already linked with other account in the system.
	define("LANG_TW_ALREADY_LINKED", "Votre compte Twitter est déjà lié avec le compte d'autres dans le système.");
	//Linked to twitter as
	define("LANG_MSG_LINKED_TW_AS", "Lié à Twitter comme");
	//Connected as
	define("LANG_LABEL_CONECTED_AS", "Connecté en tant que");
	//Location options
	define("LANG_LABEL_LOCATIONPREF", "Préférences de emplacement");
	//Choose your location preferences in order to auto fill your searches by location
	define("LANG_LABEL_CHOOSELOCATIONPREF", "Choisissez vos préférences d'installation afin de remplir automatiquement vos recherches par emplacement");
	//Use your current location
	define("LANG_LABEL_USECURRENTLOCATION", "Utilisez votre position actuelle");
	//Use Facebook Location
	define("LANG_LABEL_USEFACEBOOKLOCATION", "Utilisez Facebook emplacement");
	//Connect to Facebook
	define("LANG_LABEL_CONECTED_TO_FB", "Connectez-vous à Facebook");
	//Facebook account
	define("LANG_LABEL_FACEBOOK_ACCT", "Compte Facebook");
	//Google account
	define("LANG_LABEL_GOOGLE_ACCT", "Compte Google");
	//Change account
	define("LANG_LABEL_CHANGE_ACCT", "Changer de compte");
	//Twitter account
	define("LANG_LABEL_FB_ACCT", "Compte Twitter");
	//Twitter connection
	define("LANG_LABEL_TW_CONN", "Connexion Twitter");
	//Link my Twitter account
	define("LANG_LABEL_TW_LINK", "Lien mon compte Twitter");
	//Unlink my Twitter account
	define("LANG_LABEL_UNLINK_TW", "Dissocier mon compte Twitter");
	//Post redeems on my twitter account automatically
	define("LANG_LABEL_POSTRED", "Poste rachète sur mon Twitter compte automatiquement");
	//Your account was unlinked from twitter
	define("LANG_LABEL_TW_ACT_DISC", "Votre compte a été supprimé le lien entre Twitter");
	//You must sign in through twitter first
	define("LANG_LABEL_TW_SIGNTW", "Vous devez vous connecter via Twitter première");
	//Your Twitter account was successfully connected
	define("LANG_LABEL_TW_SIGNTW_CONN", "Votre compte Twitter a été connecté avec succès");
	//Your Facebook account was successfully connected
	define("LANG_LABEL_FB_SIGNFB_CONN", "Votre compte Facebook a été connecté avec succès");
	//Your are already logged Facebook account as
	define("LANG_LABEL_FB_ALREADYLOGGED", "Votre compte est déjà connecté en tant Facebook");
	//This user is already attached to another directory account.
	define("LANG_LABEL_FB_ALREADYATTACHED", "Cet utilisateur est déjà connecté à un autre compte.");
	//Click here to switch to this account
	define("LANG_LABEL_FB_CLICKHERETOSWITCH", "Cliquez ici pour passer à ce compte");
	//Connect to Facebook
	define("LANG_LABEL_CONN_FB", "Connectez-vous à Facebook");
	//Use this language upon each sign in to my account
	define("LANG_LABEL_USE_SELECTEDLANGUAGE", "Utilisez cette langue à chaque connecter à mon compte");
    //View my profile page
    define("LANG_LABEL_VIEW_PROFILE", "Voir ma page de profil");

	# ----------------------------------------------------------------------------------------------------
	# DEALS
	# ----------------------------------------------------------------------------------------------------
	//I just got a great deal
	define("DEAL_LIKEDTHIS", "J'ai aimé ce");
	//Redeem
	define("DEAL_REDEEM", "Échangez");
	//Redeem this deal
	define("DEAL_REDEEMTHIS", "Échangez cet Offrir");
	//To redeem you need to post this deal information on your Facebook or Twitter.
	define("DEAL_REDEEMINFO1", "Pour échanger vous avez besoin d'afficher cette information sur votre affaire Facebook ou Twitter.");
	//You can set this button to automatic post on your Profile.
	define("DEAL_REDEEMINFO2", "Vous pouvez configurer ce bouton afin d'envoyer automatiquement le sur votre profil.");
	//Click here to configure it
	define("DEAL_CLICKHERETO", "Cliquez ici pour le configurer");
	//Please wait, posting on Facebook and Twitter (if available).
	define("DEAL_PLEASEWAIT_POSTING", "S'il vous plaît attendre, annonce sur Facebook et Twitter (si disponible).");
	//You already redeemed this deal! Your code is
	define("DEAL_YOUALREADY", "Vous avez déjà racheté cette offrir! Votre code est");
	//Deal done! This is your redeem code
	define("DEAL_DEALDONE", "Chose faite! Ceci est votre code d'activation");
	//No one has redeemed this deal on Facebook yet.
	define("DEAL_REDEEM_NONE_FB", "Personne n'a racheté cet accord sur Facebook encore.");
	//No one has redeemed this deal on Twitter yet.
	define("DEAL_REDEEM_NONE_TW", "Personne n'a racheté cet accord sur Twitter encore.");
	//Recent done deals
	define("DEAL_RECENTDEALS", "Dernières offres fait");
	//No deals found!
	define("DEAL_DIDNTNOTFINISHED", "Aucun offres trouvées!");
	//This deal is not available anymore.
	define("DEAL_NA", "Cet accord n'est plus disponible.");
	//To redeem this deal you need to post to your Facebook wall. First, sign using the Facebook login button and you will need to approve this Application to do it.
	define("DEAL_REDEEMINFO_1", "Pour profiter de cette affaire dont vous avez besoin pour écrire sur votre mur Facebook. Primeiro entre utilizando sua conta do Facebook e aprove nossa aplicação para funcionar no seu perfil.");
	//You already did this deal!
	define("DEAL_REDEEM_DONEALREADY", "Vous avez déjà fait cette entente!");
	//Sorry, there was an error trying to post on your Facebook wall. Please try again.
	define("DEAL_REDEEMINFO_2", "Désolé, il ya eu une erreur en essayant d'afficher sur votre mur Facebook. S'il vous plaît essayez de nouveau.");
	//Value
	define("DEAL_VALUE", "Courage");
	//With this coupon
	define("DEAL_WITHTHISCOUPON", "Avec ce numéro");
	//Thank you
	define("DEAL_THANKYOU", "Je vous remercie");
	//Original value
	define("DEAL_ORIGINALVALUE", "Valeur originale");
	//Amount paid
	define("DEAL_AMOUNTPAID", "Avec cet accord");
	//Valid until
	define("DEAL_VALIDUNTIL", "Valable jusqu'au");
	//Coupon must be presented to receive discount
	define("DEAL_INFODETAILS1", "Le Offres doit être présenté pour obtenir le rabais");
	//Limit of 1 coupon per purchase
	define("DEAL_INFODETAILS2", "Limite de 1 coupon par achat");
	//Not valid with other coupons, offers or discounts of any kind
	define("DEAL_INFODETAILS3", "Non cumulable avec d'autres coupons, des offres ou des remises de toute nature");
	//Valid only for Listing Name - Address
	define("DEAL_INFODETAILS4", "Valable uniquement pour l'inscription Nom - Adresse");
	//Print deal
	define("DEAL_PRINTDEAL", "Imprimer Offrir");
	//deal done
	define("DEAL_DEALSDONE", "Offre Effectué");
	//deals done
	define("DEAL_DEALSDONE_PLURAL", "Offres Effectuées");
	//Deals redeemed
	define("LANG_LABEL_DEAL_BOUGHT", "Offres acheté");
	//Deals left
	define("LANG_LABEL_DEAL_LEFT", "Offres gauche");
	//Left
	define("DEAL_LEFTAMOUNT", "Restantes");
	//Sold Out
	define("DEAL_SOLDOUT", "Épuisé");
	//Sorry, this deal doesn't exist or it was removed by owner
	define("DEAL_DOESNTEXIST", "Désolé, cet accord n'existe pas ou il a été enlevé par le propriétaire");
	//at
	define("DEAL_AT", "à");
	//Friendly URL
	define("DEAL_FRIENDLYURL", "URL conviviale");
	//Select a listing
	define("DEAL_SELECTLISTING", "Sélectionnez une liste");
	//Tagline for Deals
	define("DEAL_TAG", "Slogan pour les Offres");
	//Visibility
	define("LANG_SITEMGR_VISIBILITY", "Visibilité");
	//This deal will show up on
	define("LANG_SITEMGR_DEALSHOWUP", "Cette offrir sera affiché sur");
	//searches and nearby feature
	define("LANG_SITEMGR_DEALSEARCHES_NEARBY", "recherches et disposent à proximité");
	//Nearby
	define("LANG_LABEL_NEARBY", "Proche");
	//About Us
	define("LANG_MENU_ABOUT", "A propos de nous");
	//My Favorites
	define("LANG_MENU_FAVORITES", "Mes Favoris");
	//My Deals
	define("LANG_MENU_MYDEALS", "Mes Offres");
	//My Reviews
	define("LANG_MENU_MYREVIEWS", "Mes Évaluations");
	//My Account
	define("LANG_MENU_ACCOUNT", "Mon Compte");
	//24 hours / day
	define("LANG_SITEMGR_TWFOURHOURSDAY", "24 heures / jour");
	//Custom range
	define("LANG_SITEMGR_CUSTOMRANGE", "Gamme sur mesure");
	//Discount information
	define("LANG_SITEMGR_DISCINFO", "Remise des informations");
	//Item Value
	define("LANG_SITEMGR_ITEMVALUE", "Valeur de l'Élément");
	//Discount
	define("LANG_SITEMGR_DISCOUNT", "Remise");
	//Value with discount
	define("LANG_DEAL_WITH_DISCOUNT", "Valeur avec remise");
	//Amount of deals
	define("LANG_SITEMGR_AMOUNTOFDEALS", "Montant des offres");
    //deals done until now
	define("LANG_SITEMGR_DONEUNTIL_SINGULAR", "fait jusqu'à présent");
    //deals done until now
	define("LANG_SITEMGR_DONEUNTIL_PLURAL", "fait jusqu'à présent");
	//left
	define("LANG_SITEMGR_LEFT", "autres");
    //OFF
    define("LANG_DEAL_OFF", "OFF");
    //Please wait, loading...
    define("LANG_DEAL_PLEASEWAITLOADING", "S'il vous plaît patienter, chargement...");
    //Please wait. We are redirecting your login to complete this step...
    define("LANG_DEAL_PLEASEWAITLOADING2", "S'il vous plaît attendre. Nous sommes rediriger vos informations de connexion pour effectuer cette étape...");
    //Item Value is required.
    define("LANG_MSG_VALIDDEAL_REALVALUE", "Point Valeur est requise.");
    //Value with Discount is required.
    define("LANG_MSG_VALIDDEAL_DEALVALUE", LANG_LABEL_DISC_AMOUNT." est requise.");
	//Value with Discount can not be higher than 99.
    define("LANG_MSG_VALIDDEAL_DEALVALUE2", LANG_LABEL_DISC_AMOUNT." ne peut pas être supérieur à 99.");
    //Deals to offer is required.
    define("LANG_MSG_VALIDDEAL_AMOUNT", "Offres offrir est nécessaire.");
    //Please enter a minor value on Value with Discountfield.
    define("LANG_MSG_VALID_MINOR", "S'il vous plaît entrer une valeur mineure sur le champ delo ".LANG_LABEL_DISC_AMOUNT);
	//Redemeed at
    define("LANG_DEAL_REMEEDED_AT", "Redemeed à");
    //You can only directly link this deal to a listing if you select one account first
    define("DEAL_LINK2LISTING_ACCTINFO", "Vous ne pouvez relier directement cet accord pour une annonce si vous sélectionnez un premier compte");
    //Value
    define("DEAL_VALUE", "Valeur");
    //With discount
    define("DEAL_WITHCOUPON", "With discount");
    //Redeem by e-mail
    define("DEAL_REDEEMBYEMAIL", "Validez par e-mail");
    //Sign In and Redeem
    define("DEAL_CONNECT_REDEEM", "Connectez-vous et échangez");
	//Redeem and Print
	define("LANG_LABEL_REDEEM_PRINT", "Échangez et d'impression");
    //Redeem and Share
    define("DEAL_REDEEMSHARE", "Échangez et partagez");
    //Featured Deals
    define("DEAL_FEATURED_DEALS", "Offres en vedette");
    //Sign in using your Facebook session
    define("LOGIN_FB_CURRENT_SESSION", "Inscrivez-vous en utilisant votre session Facebook");
	//To Redeem using Facebook you need to connect using your Facebook account
    define("LANG_DEAL_DISCONNECTED_NOFB", "Pour Échangez utilisant Facebook, vous devez vous connecter en utilisant votre compte Facebook.");
    //Redemm Statistics
    define("LANG_LABEL_REDEEM_STATISTICS", "Statistiques d'utilisation");
    //Redeem code
    define("DEAL_SITEMGR_REDEEMCODE", "Code d'utilisation");
    //Available
    define("DEAL_SITEMGR_AVAILABLE", "Disponible");
    //Used
    define("DEAL_SITEMGR_USED", "Employée");
    //Redeem using your current Facebook session.
    define("DEAL_REDEEMINFO_3", "Échangez avec votre session Facebook");
    //Use
    define("DEAL_SITEMGR_USE", "Utilisez");
	//Saving...
	define("LANG_DEAL_SAVING", "Enregistrement...");
	//No redeem found
	define("LANG_DEAL_NO_RECORD", "Aucun rachat trouvé.");
	//percentage
	define("LANG_LABEL_PERCENTAGE", "pourcentage");
	//fixed value
	define("LANG_LABEL_FIXEDVALUE", "valeur fixe");

	# ----------------------------------------------------------------------------------------------------
	# IMPORT
	# ----------------------------------------------------------------------------------------------------
	//line
	define("LANG_MSG_IMPORT_ERROR_LINE", "ligne");
	//Error importing to temporary table.
	define("LANG_MSG_IMPORT_ERRORONIMPORTTOTEMPABLE", "Erreur lors du importés de table temporaire.");
	//Invalid renewal date - line
	define("LANG_MSG_IMPORT_INVALIDRENEWALDATE", "Date de renouvellement non valide - ligne");
	//Invalid updated date - line
	define("LANG_MSG_IMPORT_INVALIDUPDATEDATE", "Date de mis à jour non valide - ligne");
	//CSV file imported to temporary table.
	define("LANG_MSG_IMPORT_CSVIMPORTEDTOTEMPORARYTABLE", "Fichier CSV importés de table temporaire.");
	//Invalid e-mail - line
	define("LANG_MSG_IMPORT_INVALIDUSERNAMELINE", "E-mail incorrect - ligne");
	//Invalid password - line
	define("LANG_MSG_IMPORT_INVALIDPASSWORDLINE", "Mot de passe non valide - ligne");
	//Invalid keyword (maximum 10 keywords) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS", "Mots-clé non valide(max ".MAX_KEYWORDS." mots-clés) - ligne");
	//Invalid keyword (keywords with a maximum of 50 characters each.) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS2", "Mots-clé non valide(".LANG_MSG_KEYWORDS_WITH_MAXIMUM_50.") - ligne");
	//Invalid title - line
	define("LANG_MSG_IMPORT_INVALIDTITLELINE", "Non valide titre - ligne");
	//Invalid start date - line
	define("LANG_MSG_IMPORT_INVALIDSTARTDATE", "Date de début non valide - ligne");
	//Invalid end date - line
	define("LANG_MSG_IMPORT_INVALIDENDDATE", "Date de fin non valide - ligne");
	//Start date must be filled - line
	define("LANG_MSG_IMPORT_STARTDATEEMPTY", "Date de début doit être rempli - ligne");
	//End date must be filled - line
	define("LANG_MSG_IMPORT_ENDDATEEMPTY", "Date de fin doivent être remplis - ligne");
	//The "End Date" must be greater than or equal to the "Start Date" - line
	define("LANG_MSG_IMPORT_END_DATE_GREATER_THAN_START_DATE", str_replace(".", "", LANG_MSG_END_DATE_GREATER_THAN_START_DATE)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//The "End Date" cannot be in past - line
	define("LANG_MSG_IMPORT_END_DATE_CANNOT_IN_PAST", str_replace(".", "", LANG_MSG_END_DATE_CANNOT_IN_PAST)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Invalid start time - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_NUMBER", "Heure de début non valide - ligne");
	//Invalid end time - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_NUMBER", "Invalide heure de fin - ligne");
	//Invalid start time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_FORMAT", "Mauvaise format de l'heure de début. Doit être \"xx:xx\" - ligne");
	//Invalid end time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_FORMAT", "Mauvaise format de l'heure de fin. Doit être \"xx:xx\" - ligne");
	//Invalid start time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE1", "Mauvaise mode de l'heure de début. Doit être \"AM\" ou \"PM\" - ligne");
	//Invalid end time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE1", "Mauvaise mode de l'heure de fin. Doit être \"AM\" ou \"PM\" - ligne");
	//Invalid start time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE2", "Mauvaise mode de l'heure de début. Doit être \"24\" - ligne");
	//Invalid end time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE2", "Mauvaise mode de l'heure de fin. Doit être \"24\" - ligne");
	//The "End Time" must be greater than the "Start Time" - line
	define("LANG_MSG_IMPORT_END_TIME_GREATER_THAN_START_TIME", str_replace(".", "", LANG_MSG_END_TIME_GREATER_THAN_START_TIME)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Location and system default location are differents - line
	define("LANG_MSG_IMPORT_INVALIDLOCATIONLINE", "Adresse et de l'adresse par défaut du système sont différents - ligne");
	//Invalid latitude. Must be numeric between -90 and 90 - line
	define("LANG_MSG_IMPORT_INVALIDLATITUDELINE", "Latitude non valide. Doit être numérique entre -90 et 90 - ligne");
	//Invalid longitude. Must be numeric between -180 and 180 - line
	define("LANG_MSG_IMPORT_INVALIDLONGITUDELINE", "Longitude non valide. Doit être numérique entre -180 et 180 - ligne");
	//No CSV Files in Import Folder.
	define("LANG_MSG_IMPORT_NOFILES_INFTP", "Pas de fichiers CSV dans le dossier d'importation.");
	//The number of columns in the following line(s) are wrong:
	define("LANG_MSG_IMPORT_NUMBEROFCOLUMNSAREWRONG", "Le nombre de colonnes dans la ligne suivante est fausse:");
	//Total lines read:
	define("LANG_MSG_IMPORT_TOTALLINESREADY", "Total des lignes suit:");
	//Total error lines:
	define("LANG_MSG_IMPORT_TOTALLINESERROR", "Total des lignes d'erreur:");
	//CSV header does not match - it has more fields that it is allowed
	define("LANG_MSG_IMPORT_WRONG_HEADER", "CSV-tête ne correspond pas - il a plus de champs qu'il est permis");
	//CSV header does not match at field(s):
	define("LANG_MSG_IMPORT_WRONG_HEADER2", "CSV-tête ne correspond pas au champ (s): ");
	//account rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK", "compte annulée");
	//accounts rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK_PLURAL", "comptes annulée");
	//item rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK", "article annulée");
	//items rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK_PLURAL", "articles annulée");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	//Find what you are Looking for...
	define("LANG_SEARCH_MESSAGE_TITLE", "Trouvez ce que vous cherchez...");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword.
	define("LANG_SEARCH_MESSAGE_TEXT", "Parfois, vous pouvez recevoir aucun résultat pour votre recherche car le mot clé que vous avez utilisé est très générique. Essayez d'utiliser un mot clé précis.");

	# ----------------------------------------------------------------------------------------------------
	# PAGING
	# ----------------------------------------------------------------------------------------------------
	//Results per page
	define("LANG_PAGING_RESULTS_PER_PAGE", "Résultats par page");
	//Per Page
	define("LANG_PAGING_PER_PAGE", "Par Page");
	//Showing results
	define("LANG_PAGING_SHOWING_RESULTS", "Affichage des résultats");
	//Showing
	define("LANG_PAGING_SHOWING", "Projection");
	//to
	define("LANG_PAGING_SHOWING_TO", "à");
	//of
	define("LANG_PAGING_SHOWING_OF", "des");
	//Pages
	define("LANG_PAGING_SHOWING_PAGE", "Páges");

	# ----------------------------------------------------------------------------------------------------
	# SUGARCRM
	# ----------------------------------------------------------------------------------------------------
	//Importing [SUGAR_ITEM_TITLE] from SugarCRM to [EDIRECTORY_TITLE]
	define("LANG_IMPORT_ITEM_FROM_SUGAR", "La importación de [SUGAR_ITEM_TITLE] de SugarCRM en [EDIRECTORY_TITLE]");
	//Use the form above to import from the SugarCRM record [SUGAR_ITEM_TITLE], after clicking import your data will be transferred to your directory installation with all relevant information passed across, just fill in the extra data, and payment data.
	define("LANG_MESSAGE_ON_FOOTER", "Utilisez le formulaire ci-dessus pour l'importation du dossier SugarCRM [SUGAR_ITEM_TITLE], après avoir cliqué sur l'importation de vos données seront transférées vers votre installation de répertoire avec toutes les informations pertinentes passé à travers, il suffit de remplir les données supplémentaires, et des données de paiement.");
	//You're nearly done.
	define("LANG_YOU_NEARLY_DONE", "Vous êtes presque fait.");
	//It was not possible to export. Please check your SugarCRM connection information on your directory.
	define("LANG_SUGAR_CHECKINFO", "Il n'était pas possible d'exporter. S'il vous plaît vérifier vos informations de connexion SugarCRM sur votre répertoire.");
	//Wrong eDirectory Key.
	define("LANG_SUGAR_WRONG_KEY", "Mauvaise clé eDirectory.");

	# ----------------------------------------------------------------------------------------------------
	# ADVERTISE
	# ----------------------------------------------------------------------------------------------------
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_TITLE", LANG_LISTING_TITLE);
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_OWNER", "Propriétaire de Liste");
	//10% Off - Deal Title
	define("LANG_LABEL_ADVERTISE_DEAL_TITLE", "10% Off - ".LANG_PROMOTION_TITLE);
	//Review Title
	define("LANG_LABEL_ADVERTISE_REVIEW_TITLE", "Titre de Evaluation");
	//Event Title
	define("LANG_LABEL_ADVERTISE_EVENT_TITLE", LANG_EVENT_TITLE);
	//Event Owner
	define("LANG_LABEL_ADVERTISE_EVENT_OWNER", "Propriétaire de Événement");
	//Classified Title
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_TITLE", LANG_CLASSIFIED_TITLE);
	//Classified Owner
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_OWNER", "Propriétaire de Annonce");
	//Article Title
	define("LANG_LABEL_ADVERTISE_ARTICLE_TITLE", LANG_ARTICLE_TITLE);
	//Article Author
	define("LANG_LABEL_ADVERTISE_ARTICLE_AUTHOR", "Article Auteur");
	//Contact Name
	define("LANG_LABEL_ADVERTISE_ITEM_CONTACT", LANG_LABEL_CONTACTNAME);
	//Zipcode
	define("LANG_LABEL_ADVERTISE_ITEM_ZIPCODE", ZIPCODE_LABEL);
	//www.yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_SITE", "www.votresite.com");
	//youremail@yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_EMAIL", "otrenom@votresite.com");
	//Address
	define("LANG_LABEL_ADVERTISE_ITEM_ADDRESS", LANG_LABEL_ADDRESS);
	//Card holder name
	define("LANG_LABEL_CARDHOLDER_NAME", "Nom du titulaire");
	//Charge for
	define("LANG_CHARGEFOR", "Facturation");
	//Visitor
	define("LANG_LABEL_ADVERTISE_VISITOR", "Visiteur");
	//Category
	define("LANG_LABEL_ADVERTISE_CATEGORY", "Catégorie");
	//Category 1
	define("LANG_LABEL_ADVERTISE_CATEGORY1", "Catégorie 1");
	//Category 1.1
	define("LANG_LABEL_ADVERTISE_CATEGORY1_2", "Catégorie 1.1");
	//Category 2
	define("LANG_LABEL_ADVERTISE_CATEGORY2", "Catégorie 2");
	//Category 2.2
	define("LANG_LABEL_ADVERTISE_CATEGORY2_2", "Catégorie 2.2");
	//Summary View
	define("LANG_LABEL_ADVERTISE_SUMMARYVIEW", "Vue Résumée");
	//Detail View
	define("LANG_LABEL_ADVERTISE_DETAILVIEW", "Vue Détaillée");
	//This content is illustrative
	define("LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE", "Contenu exemplative");

	# ----------------------------------------------------------------------------------------------------
	# TWILIO
	# ----------------------------------------------------------------------------------------------------
	//Activate Click-to-Call
	define("LANG_LABEL_ACTIVATECLICKCALL", "Cliquez pour Appeler");
	//Send to Phone
	define("LANG_LABEL_SENDPHONE", "Envoyer à Téléphone");
	//Click to Call
	define("LANG_LABEL_CLICKTOCALL", "Cliquez pour Appeler");
	//Message successfully sent!
	define("LANG_LABEL_SMS_SENT", "Message envoyé avec succès!");
	//Send info about this listing to a phone.
	define("LANG_LISTING_TOPHONE_SAUDATION", "Envoyer des informations sur cette liste à un téléphone.");
	//Enter your phone to call the listing owner with no costs.
	define("LANG_LISTING_CLICKTOCALL_SAUDATION", "Entrez votre téléphone pour appeler le propriétaire cotation sans frais.");
	//Phone is required.
	define("LANG_PHONE_REQUIRED", "Le téléphone est nécessaire.");
	//Please, type a valid phone number.
	define("LANG_PHONE_INVALID", "S'il vous plaît, entrez un numéro de téléphone valide.");
	//Call
	define("LANG_TWILIO_CALL", "Appelez");
	//Calling
	define("LANG_TWILIO_CALLING", "Appel");
	//Phone
	define("LANG_CLICKTOCALL_PHONE", "Téléphone");
	//Extension
	define("LANG_CLICKTOCALL_EXTENSION", "Extension");
	//Activate
	define("LANG_CLICKTOCALL_ACTIVATE", "Activer");
	//Enter this code in your phone keypad when the test call connects:
	define("LANG_CLICKTOCALL_YOUR_VALIDATION_CODE", "Entrez ce code dans le clavier de votre téléphone lorsque l'appel d'essai relie:");
	//Your phone number was activated!
	define("LANG_CLICKTOCALL_STATUS_ACTIVATED", "Votre numéro de téléphone a été activé!");
	//Phone number successfully deleted!
	define("LANG_CLICKTOCALL_PHONE_DELETED", "Numéro de téléphone supprimé avec succès!");
	//Click to Call not available for this listing
	define("LANG_MSG_CLICKTOCALL_NOT_AVAILABLE", "Cliquez pour Appeler pas disponible pour cette liste");
	//Activate Click-to-Call and Get More Contacts
	define("LANG_CLICKTOCALL_TIPTITLE", "Activer Click-to-Call et obtenir plus de contacts");
	//You need to activate the phone number below in order to allow the users to contact you directly through the directory.
	define("LANG_CLICKTOCALL_TIP1", "Vous avez besoin d'activer le numéro de téléphone ci-dessous afin de permettre aux utilisateurs à vous contacter directement via le répertoire.");
	//Click-to-call allows clients to connect a call between your phone and theirs with the click of a button.  To activate, press the button below and a test call will be made.
	define("LANG_CLICKTOCALL_TIP2", "Click-to-call permet aux clients de se connecter à un appel entre votre téléphone et leur avec le clic d'un bouton. Pour l'activer, appuyez sur le bouton ci-dessous et un appel d'essai sera fait.");
	//A message with your activation code will be shown. Take note of this code and wait for the activation phone call.
	define("LANG_CLICKTOCALL_TIP3", "Un message avec votre code d'activation sera affiché. Prenez note de ce code et d'attendre l'appel téléphonique d'activation.");
	//You will be ask to enter the six digits activation code. Enter the code and wait for the confirmation message.
	define("LANG_CLICKTOCALL_TIP4", "Vous serez demander d'entrer le code à six chiffres d'activation. Entrez le code et attendre le message de confirmation.");
	//After activate your phone number, click in Save Number to finish the process.
	define("LANG_CLICKTOCALL_TIP5", "Après activation de votre numéro de téléphone, cliquez sur Enregistrer pour terminer dans le processus.");
	//For numbers outside the USA, you need to put your country code first.
	define("LANG_CLICKTOCALL_TIP6", "Pour les numéros hors des Etats-Unis, vous devez mettre votre code de pays d'abord.");
	//For numbers outside the USA, the country code must be included.
	define("LANG_CLICKTOCALL_TIP7", "Pour les numéros à l'extérieur des États-Unis, le code du pays doit être incluse.");
	//"Click to Call" report
	define("LANG_CLICKTOCALL_REPORT", "\"Cliquez pour Appeler\" le rapport");
	//Direction
	define("LANG_CLICKTOCALL_REPORT_DIRECTION", "Direction");
	//To
	define("LANG_CLICKTOCALL_REPORT_FROM", "De");
	//Start Time
	define("LANG_CLICKTOCALL_REPORT_START_TIME", "Heure de Début");
	//End Time
	define("LANG_CLICKTOCALL_REPORT_END_TIME", "Heure de Fin");
	//Duration (seconds)
	define("LANG_CLICKTOCALL_REPORT_DURATION", "Durée (en secondes)");
	//No reports available.
	define("LANG_CLICKTOCALL_REPORT_NORECORD", "Pas de rapports disponibles.");
	//Activated by
	define("LANG_LABEL_ACTIVATED_BY", "Activé par");
	//Activation failed. Please, try again.
	define("LANG_TWILIO_ERROR_10000", "D'activation a échoué. S'il vous plaît, essayez de nouveau.");
	//Account is not active.
	define("LANG_TWILIO_ERROR_10001", "Compte n'est pas actif.");
	//Trial account does not support this feature.
    define("LANG_TWILIO_ERROR_10002", "Compte d'essai ne prend pas en charge cette fonctionnalité.");
	//Incoming call rejected due to inactive account.
    define("LANG_TWILIO_ERROR_10003", "Appel entrant rejeté en raison de compte inactif.");
	//Invalid URL format.
    define("LANG_TWILIO_ERROR_11100", "Invalid URL format.");
	//HTTP retrieval failure.
    define("LANG_TWILIO_ERROR_11200", "HTTP l'échec de récupération.");
	//HTTP connection failure.
    define("LANG_TWILIO_ERROR_11205", "HTTP échec de connexion.");
	//HTTP protocol violation.
    define("LANG_TWILIO_ERROR_11206", "HTTP protocole de violation.");
	//HTTP bad host name.
    define("LANG_TWILIO_ERROR_11210", "HTTP nom d'hôte mauvaisee.");
	//HTTP too many redirects.
    define("LANG_TWILIO_ERROR_11215", "HTTP trop de redirections.");
	//Document parse failure.
    define("LANG_TWILIO_ERROR_12100", "L'échec d'analyser le document.");
	//Invalid Twilio Markup XML version.
    define("LANG_TWILIO_ERROR_12101", "Invalide Twilio balisage XML version.");
	//The root element must be Response.
    define("LANG_TWILIO_ERROR_12102", "L'élément racine doit être la réponse.");
	//Schema validation warning.
    define("LANG_TWILIO_ERROR_12200", "Avertissement de validation de schéma.");
	//Invalid Content-Type.
    define("LANG_TWILIO_ERROR_12300", "Invalid Content-Type.");
	//Internal Failure.
    define("LANG_TWILIO_ERROR_12400", "Défaillance interne.");
	//Dial: Cannot Dial out from a Dial Call Segment.
    define("LANG_TWILIO_ERROR_13201", "Dial: Ne peut pas composer à partir d'un segment des appels Dial.");
	//Dial: Invalid method value.
    define("LANG_TWILIO_ERROR_13210", "Dial: Valeur non valide la méthode.");
	//Dial: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13212", "Dial: Invalide valeur de temporisation.");
	//Dial: Invalid hangupOnStar value.
    define("LANG_TWILIO_ERROR_13213", "Dial: Valeur invalide hangupOnStar.");
	//Dial: Invalid callerId value.
    define("LANG_TWILIO_ERROR_13214", "Dial: Valeur invalide callerID.");
	//Dial: Invalid nested element.
    define("LANG_TWILIO_ERROR_13215", "Dial: Invalide élément imbriqué.");
	//Dial: Invalid timeLimit value.
    define("LANG_TWILIO_ERROR_13216", "Dial: Valeur invalide délai.");
	//Dial->Number: Invalid method value.
    define("LANG_TWILIO_ERROR_13221", "Dial->Number: Valeur non valide la méthode.");
	//Dial->Number: Invalid sendDigits value.
    define("LANG_TWILIO_ERROR_13222", "Dial->Number: Valeur invalide sendDigits.");
	//Dial: Invalid phone number format.
    define("LANG_TWILIO_ERROR_13223", "Dial: Invalid format de numéro de téléphone.");
	//Dial: Invalid phone number.
    define("LANG_TWILIO_ERROR_13224", "Dial: Le numéro de téléphone valide.");
	//Dial: Forbidden phone number.
    define("LANG_TWILIO_ERROR_13225", "Dial: Forbidden numéro de téléphone.");
	//Dial->Conference: Invalid muted value.
    define("LANG_TWILIO_ERROR_13230", "Dial->Conference: Valeur non valide en sourdine.");
	//Dial->Conference: Invalid endConferenceOnExit value.
    define("LANG_TWILIO_ERROR_13231", "Dial->Conference: Valeur invalide endConferenceOnExit.");
	//Dial->Conference: Invalid startConferenceOnEnter value.
    define("LANG_TWILIO_ERROR_13232", "Dial->Conference: Valeur invalide startConferenceOnEnter.");
	//Dial->Conference: Invalid waitUrl.
    define("LANG_TWILIO_ERROR_13233", "Dial->Conference: Invalide waitUrl.");
	//Dial->Conference: Invalid waitMethod.
    define("LANG_TWILIO_ERROR_13234", "Dial->Conference: Invalide waitMethod.");
	//Dial->Conference: Invalid beep value.
    define("LANG_TWILIO_ERROR_13235", "Dial->Conference: Valeur invalide bip.");
	//Dial->Conference: Invalid Conference Sid.
    define("LANG_TWILIO_ERROR_13236", "Dial->Conference: Invalide Sid Conférence.");
	//Dial->Conference: Invalid Conference Name.
    define("LANG_TWILIO_ERROR_13237", "Dial->Conference: Nom incorrect de la Conférence.");
	//Dial->Conference: Invalid Verb used in waitUrl TwiML.
    define("LANG_TWILIO_ERROR_13238", "Dial->Conference: Invalide verbe employé dans waitUrl TwiML.");
	//Gather: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13310", "Gather: Valeur invalide finishOnKey.");
	//Gather: Invalid method value.
    define("LANG_TWILIO_ERROR_13312", "Gather: Valeur non valide la méthode.");
	//Gather: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13313", "Gather: Invalide valeur de temporisation.");
	//Gather: Invalid numDigits value.
    define("LANG_TWILIO_ERROR_13314", "Gather: Valeur invalide numDigits.");
	//Gather: Invalid nested verb.
    define("LANG_TWILIO_ERROR_13320", "Gather: Invalide verbe imbriquées.");
	//Gather->Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13321", "Gather->Say: Valeur invalide voix.");
	//Gather->Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13322", "Gather->Say: Valeur non valide boucle.");
	//Gather->Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13325", "Gather->Play: Invalid Content-Type.");
	//Play: Invalid loop value.
    define("LANG_TWILIO_ERROR_13410", "Play: Valeur non valide boucle.");
	//Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13420", "Play: Invalid Content-Type.");
	//Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13510", "Say: Valeur non valide boucle.");
	//Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13511", "Say: Valeur invalide voix.");
	//Say: Invalid text.
    define("LANG_TWILIO_ERROR_13520", "Say: Invalide texte.");
	//Record: Invalid method value.
    define("LANG_TWILIO_ERROR_13610", "Record: Valeur non valide la méthode.");
	//Record: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13611", "Record: Invalide valeur de temporisation.");
	//Record: Invalid maxLength value.
    define("LANG_TWILIO_ERROR_13612", "Record: Valeur invalide maxLength.");
	//Record: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13613", "Record: Valeur invalide finishOnKey.");
	//Redirect: Invalid method value.
    define("LANG_TWILIO_ERROR_13710", "Redirect: Valeur non valide la méthode.");
	//Pause: Invalid length value.
    define("LANG_TWILIO_ERROR_13910", "Pause: Valeur non valide la longueur.");
	//Invalid "To" attribute.
    define("LANG_TWILIO_ERROR_14101", "Invalide \"À\" attribut.");
	//Invalid "From" attribute.
    define("LANG_TWILIO_ERROR_14102", "Invalide \"De\" attribut.");
	//Invalid Body.
    define("LANG_TWILIO_ERROR_14103", "Invalide corps.");
	//Invalid Method attribute.
    define("LANG_TWILIO_ERROR_14104", "Invalide attribut de méthode.");
	//Invalid statusCallback attribute.
    define("LANG_TWILIO_ERROR_14105", "Attribut non valide statusCallback.");
	//Document retrieval limit reached.
    define("LANG_TWILIO_ERROR_14106", "Limite de la récupération de documents atteint.");
	//SMS send rate limit exceeded.
    define("LANG_TWILIO_ERROR_14107", "SMS envoyez limite de taux de dépassement.");
	//From phone number not SMS capable.
    define("LANG_TWILIO_ERROR_14108", "De ne pas le numéro de téléphone SMS capable.");
	//SMS Reply message limit exceeded.
    define("LANG_TWILIO_ERROR_14109", "Limite de SMS Répondre dépassé.");
	//Invalid Verb for SMS Reply.
    define("LANG_TWILIO_ERROR_14110", "Invalid Verb pour les SMS Répondre.");
	//Invalid To phone number for Trial mode.
    define("LANG_TWILIO_ERROR_14111", "Pour le numéro de téléphone valide pour le mode d'essai.");
	//Unknown parameters.
    define("LANG_TWILIO_ERROR_20001", "Paramètres inconnus.");
	//Invalid FriendlyName.
    define("LANG_TWILIO_ERROR_20002", "Invalide FriendlyName.");
	//Permission Denied.
    define("LANG_TWILIO_ERROR_20003", "Autorisation refusée.");
	//Method not allowed.
    define("LANG_TWILIO_ERROR_20004", "Méthode non autorisée.");
	//Account not active.
    define("LANG_TWILIO_ERROR_20005", "Compte non actif.");
	//No Called number specified.
    define("LANG_TWILIO_ERROR_21201", "Aucun numéro appelé spécifié.");
	//Called number is a premium number.
    define("LANG_TWILIO_ERROR_21202", "Numéro appelé est un numéro surtaxé.");
	//International calling not enabled.
    define("LANG_TWILIO_ERROR_21203", "Les appels internationaux pas activé.");
	//Invalid URL.
    define("LANG_TWILIO_ERROR_21205", "URL invalide.");
	//Invalid SendDigits.
    define("LANG_TWILIO_ERROR_21206", "SendDigits invalide.");
	//Invalid IfMachine.
    define("LANG_TWILIO_ERROR_21207", "Invalide IfMachine.");
	//Invalid Timeout.
    define("LANG_TWILIO_ERROR_21208", "TimeOut non valide.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21209", "Méthode non valide.");
	//Caller phone number not verified.
    define("LANG_TWILIO_ERROR_21210", "Appelant le numéro de téléphone n'est pas vérifiée.");
	//Invalid Called Phone Number.
    define("LANG_TWILIO_ERROR_21211", "Appelé numéro de téléphone valide.");
	//Invalid Caller Phone Number.
    define("LANG_TWILIO_ERROR_21212", "Numéro de téléphone valide Caller.");
	//Caller phone number is required.
    define("LANG_TWILIO_ERROR_21213", "Appelant le numéro de téléphone est nécessaire.");
	//Called Phone Number cannot be reached.
    define("LANG_TWILIO_ERROR_21214", "Numéro de téléphone appelé ne peut pas être atteint.");
	//Account not authorized to call phone number.
    define("LANG_TWILIO_ERROR_21215", "Compte pas autorisé à appeler le numéro de téléphone.");
	//Account not allowed to call phone number.
    define("LANG_TWILIO_ERROR_21216", "Compte pas autorisé à appeler le numéro de téléphone.");
	//Phone number does not appear to be valid.
    define("LANG_TWILIO_ERROR_21217", "Numéro de téléphone ne semble pas être valide.");
	//Invalid ApplicationSid.
    define("LANG_TWILIO_ERROR_21218", "Invalide ApplicationSid.");
	//Invalid call state.
    define("LANG_TWILIO_ERROR_21220", "Etat non valide appel.");
	//Invalid Phone Number.
    define("LANG_TWILIO_ERROR_21401", "Numéro de téléphone valide.");
	//Invalid Url.
    define("LANG_TWILIO_ERROR_21402", "URL invalide.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21403", "Méthode non valide");
	//Inbound Phone number not available to trial account.
    define("LANG_TWILIO_ERROR_21404", "Numéro de téléphone entrants ne sont pas disponibles au compte d'essai.");
	//Cannot set VoiceFallbackUrl without setting Url.
    define("LANG_TWILIO_ERROR_21405", "Impossible de définir VoiceFallbackUrl sans paramètre URL.");
	//Cannot set SmsFallbackUrl without setting SmsUrl.
    define("LANG_TWILIO_ERROR_21406", "Impossible de définir SmsFallbackUrl sans réglage SmsUrl.");
	//This Phone Number type does not support SMS.
    define("LANG_TWILIO_ERROR_21407", "Ce type numéro de téléphone ne supporte pas les SMS.");
	//Phone number already validated on your account.
    define("LANG_TWILIO_ERROR_21450", "Numéro de téléphone déjà validé sur votre compte.");
	//Invalid area code.
    define("LANG_TWILIO_ERROR_21451", "Indicatif régional invalide.");
	//No phone numbers found in area code.
    define("LANG_TWILIO_ERROR_21452", "Pas de numéros de téléphone dans l'indicatif régional.");
	//Phone number already validated on another account.
    define("LANG_TWILIO_ERROR_21453", "Numéro de téléphone déjà validés sur un autre compte.");
	//Invalid CallDelay.
    define("LANG_TWILIO_ERROR_21454", "Invalide CallDelay.");
	//Resource not available.
    define("LANG_TWILIO_ERROR_21501", "Ressources ne sont pas disponibles.");
	//Invalid callback url.
    define("LANG_TWILIO_ERROR_21502", "URL invalide rappel.");
	//Invalid transcription type.
    define("LANG_TWILIO_ERROR_21503", "Invalid type de transcription.");
	//RecordingSid is required..
    define("LANG_TWILIO_ERROR_21504", "RecordingSid est nécessaire.");
	//Phone number is not a valid SMS-capable inbound phone number.
    define("LANG_TWILIO_ERROR_21601", "Numéro de téléphone n'est pas valide SMS capables numéro de téléphone entrant.");
	//Message body is required.
    define("LANG_TWILIO_ERROR_21602", "Corps du message est nécessaire.");
	//The source 'from' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21603", "La source 'de' numéro de téléphone est nécessaire pour envoyer un SMS.");
	//The destination 'to' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21604", "La destination \"à\" numéro de téléphone est nécessaire pour envoyer un SMS.");
	//Maximum SMS body length is 160 characters.
    define("LANG_TWILIO_ERROR_21605", "Longueur maximale du corps de SMS est de 160 caractères");
	//The "From" phone number provided is not a valid, SMS-capable inbound phone number for your account.
    define("LANG_TWILIO_ERROR_21606", "Le \"De\" le numéro de téléphone fourni n'est pas valide, le SMS-capable le numéro de téléphone entrant pour votre compte.");
	//The Sandbox number can send messages only to verified numbers.
    define("LANG_TWILIO_ERROR_21608", "Le nombre Sandbox peuvent envoyer des messages à des numéros vérifiés.");

	# ----------------------------------------------------------------------------------------------------
	# FACEBOOK COMMENTS
	# ----------------------------------------------------------------------------------------------------
	//Facebook comments
	define("LANG_LABEL_FACEBOOK_COMMENTS", "Commentaires Facebook");
	//Facebook comments not available for this listing
	define("LANG_LABEL_FACEBOOK_COMMENTS_NOT_AVAILABLE", "Facebook commentaires ne sont pas disponibles pour cette liste");
	//Be sure you're logged into Facebook with the same account you set in your Commenting Options section, otherwise you can not moderate the comments for this item.
	define("LANG_LABEL_FACEBOOK_TIP1", "Soyez sûr que vous êtes connecté à Facebook avec le même compte vous définissez dans votre section Options Commentaire, sinon vous ne pouvez pas modérer les commentaires pour cet article.");
	//You can also moderate your comments by going to
	define("LANG_LABEL_FACEBOOK_TIP2", "Vous pouvez aussi modérer vos commentaires en allant à ");

	# ----------------------------------------------------------------------------------------------------
	# EDIRECTORY API
	# ----------------------------------------------------------------------------------------------------
	//Invalid API key.
	define("LANG_API_INVALIDKEY", "Blancs clé API.");
	//Missing parameter: module.
	define("LANG_API_EMPTYMODULE", "Paramètre manquant: module.");
	//Invalid module name.
	define("LANG_API_INVALIDMODULE", "Nom du module non valide.");
	//Module disabled.
	define("LANG_API_MODULEOFF", "Module désactivé.");
	//Missing parameter: keyword.
	define("LANG_API_EMPTYKEYWORD", "Paramètre manquant: keyword.");
	//API disabled.
	define("LANG_API_DISABLED", "API désactivé.");

	# ----------------------------------------------------------------------------------------------------
	# THEME TEMPLATE
	# ----------------------------------------------------------------------------------------------------
	//Swimming Pool
	define("LANG_LABEL_TEMPLATE_POOL", "Piscine");
	//Bedroom(s)
	define("LANG_LABEL_TEMPLATE_BEDROOM", "Chambre(s) à Coucher");
	//Bathroom(s)
	define("LANG_LABEL_TEMPLATE_BATHROOM", "Salle(s) de Bains");
	//Level(s)
	define("LANG_LABEL_TEMPLATE_LEVEL", "Niveau(s)");
	//Property Type
	define("LANG_LABEL_TEMPLATE_TYPE", "Type de Propriété");
	//Purpose
	define("LANG_LABEL_TEMPLATE_PURPOSE", "Utilité");
	//Price
	define("LANG_LABEL_TEMPLATE_PRICE", "​​Prix");
	//Acres
	define("LANG_LABEL_TEMPLATE_ACRES", "Acres");
	//Built En
	define("LANG_LABEL_TEMPLATE_TYPEBUILTIN", "Construit En");
	//Square Feet
	define("LANG_LABEL_TEMPLATE_SQUARE", "Pieds Carrés");
	//Office
	define("LANG_LABEL_TEMPLATE_OFFICE", "Bureau");
	//Laundry Room
	define("LANG_LABEL_TEMPLATE_LAUNDRYROOM", "Salle de Lavage");
	//Central Air Conditioning
	define("LANG_LABEL_TEMPLATE_AIRCOND", "Climatisation Centrale");
	//Dining Room
	define("LANG_LABEL_TEMPLATE_DINING", "Salle à Manger");
	//Garage
	define("LANG_LABEL_TEMPLATE_GARAGE", "Garage");
	//Garbage Disposal
	define("LANG_LABEL_TEMPLATE_GARBAGE", "L'élimination des Déchets");

	# ----------------------------------------------------------------------------------------------------
	# BLOG
	# ----------------------------------------------------------------------------------------------------
	//Your post will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_POST_AUTOMATICALLY_APPEAR", "Votre message apparaîtra automatiquement dans la catégorie principale de chaque sous-catégorie que vous sélectionnez.");
	//Type a keyword or post title
	define("LANG_LABEL_SEARCHKEYWORDTIP_POST", "Mot clé ou par la poste");
	//Archive
	define("LANG_BLOG_ARCHIVE", "Archives");
	//Recent Topics
	define("LANG_BLOG_RECENTTOPICS", "Sujets Récents");
	//Recent Members
	define("LANG_BLOG_RECENTMEMBERS", "Membres Récents");
	//View more
	define("LANG_VIEWMORE", "Voir Plus");
	//Popular Topics
	define("LANG_BLOG_POPULARTOPICS", "Sujets Populaires");
	//Post Search Results
	define("LANG_MSG_BLOGRESULTS", "Résultats de Recherche pour Post");
	//Comments
	define("LANG_BLOG_COMMENTS", "Commentaires");
	//Comment It
	define("LANG_BLOG_COMMENTIT", "Commentaire Il!");
	//Related Posts
	define("LANG_BLOG_RELATEDPOSTS", "Related Posts");
	//Web Site
	define("LANG_LABEL_WEBSITE", "Site Web");
	//Published
	define("LANG_BLOG_PUBLISHED", "Publié");
	//on
	define("LANG_BLOG_ON", "sur");
	//"About" [POST_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_BLOG_CONTACTSUBJECT_ISNULL_1", "Sur");
	//About [POST_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_BLOG_CONTACTSUBJECT_ISNULL_2", "de l'");
	//Send info about this post to a friend
	define("LANG_BLOG_TOFRIEND_SAUDATION", "Envoyer info sur ce poste à un ami");
	//SOME DETAILS
	define("LANG_BLOG_TOFRIEND_MAIL", "QUELQUES DÉTAILS");
	//Post
	define("LANG_BLOG", "Post");
	//Leave Your Comment
	define("LANG_MSG_LEAVEYOURCOMMENT", "Laissez votre commentaire");
	//Reply this comment
	define("LANG_MSG_REPLYTHISCOMMENT", "Répondre ce commentaire");
	//Please type a valid e-mail
	define("LANG_COMMENT_EMPTY_EMAIL", "S'il vous plaît type une e-mail valide.");
	//Please type a website
	define("LANG_COMMENT_EMPTY_WEBSITE", "S'il vous plaît type d'un site Web.");
	//Please type a comment!
	define("LANG_COMMENT_EMPTY", "S'il vous plaît type un commentaire.");
	//Comments of
	define("LANG_COMMENTS_COMMENTSOF", "Commentaires de ");
	//No comment found for this post!
	define("LANG_COMMENT_NORECORD", "Pas de commentaire pour ce post!");
	//Post
	define("LANG_LABEL_POST", "Post");
	//Click here to view this comment
	define("LANG_MSG_CLICK_TO_VIEW_THIS_COMMENT", "Cliquez ici pour voir ce commentaire");
	//Click here to view this comment's replies
	define("LANG_MSG_CLICK_TO_VIEW_REPLIES", "Cliquez ici pour voir les réponses de ce commentaire");
	//This comments has no replies
	define("LANG_MSG_NO_REPLIES", "Ce commentaire a aucune réponse");
	//Click here to delete this comment
	define("LANG_MSG_CLICK_TO_DELETE_THIS_COMMENT", "Cliquez ici pour supprimer ce commentaire");
	//View replys
	define("LANG_LABEL_VIEW_REPLY", "Voir les réponses");
	//Click here to view this post reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BLOG_REPORTS", "Cliquez ici pour consulter ce post rapports");
	//You need to login to leave your comment
	define("LANG_MSG_NEED_LOGIN", "Vous devez vous identifier pour laisser vos commentaires.");
	//You need to login to redeem a deal.
	define("LANG_MSG_NEED_LOGIN_DEAL", "Vous devez vous identifier pour valider une offre.");
	//No posts found.
	define("LANG_MSG_NOBLOGS", "Aucun post trouvé.");
	//No posts
	define("LANG_MSG_NOPOSTS", "Aucun post trouvé");
	//Comment successfully posted!
	define("LANG_MSG_COMMENT_SUCCESSFULLY_POSTED", "Commentaire en ligne avec succès!");
	//Your comment has been submitted for approval.
	define("LANG_MSG_COMMENT_SENT_TO_APPROVE", "Votre commentaire a été soumis pour approbation.");
	//Reply successfully posted!
	define("LANG_MSG_REPLY_SUCCESSFULLY_POSTED", "Répondre en ligne avec succès!");
	//Your reply has been submitted for approval.
	define("LANG_MSG_REPLY_SENT_TO_APPROVE", "Votre réponse a été soumis pour approbation.");
	//Content
	define("LANG_LABEL_POST_CONTENT", "Teneur");
	//Reply
	define("LANG_LABEL_REPLY", "Réponse");
	//Re
	define("LANG_LABEL_ABBR_REPLY", "Ré");
	//Click here to view this reply
	define("LANG_MSG_CLICK_TO_VIEW_THIS_REPLY", "Cliquez ici pour voir cette réponse");
	//Click here to delete this reply
	define("LANG_MSG_CLICK_TO_DELETE_THIS_REPLY", "Cliquez ici pour supprimer cette réponse");

	# ----------------------------------------------------------------------------------------------------
	# SITEMGR NOTIFICATIONS
	# ----------------------------------------------------------------------------------------------------
	//Account Notification
	define("LANG_NOTIFY_NEWACCOUNT", "[".EDIRECTORY_TITLE."] Notification de Compte");
	//A new account was created in
	define("LANG_NOTIFY_NEWACCOUNT_1", "Un nouveau compte a été créé en");
	//Please review the account information below:
	define("LANG_NOTIFY_NEWACCOUNT_2", "S'il vous plaît examiner les informations du compte ci-dessous:");
	//Article Notification
	define("LANG_NOTIFY_ARTICLE", "[".EDIRECTORY_TITLE."] ".LANG_ARTICLE_FEATURE_NAME." Notification");
	//was changed by the administrator
	define("LANG_NOTIFY_ITEMS_1", "a été modifié par l'administrateur");
	//was created by the administrator
	define("LANG_NOTIFY_ITEMS_2", "a été créé par l'administrateur");
	//and needs to be revised by you.
	define("LANG_NOTIFY_ITEMS_3", "et doit être révisée par vous.");
	//Banner Notification
	define("LANG_NOTIFY_BANNER", "[".EDIRECTORY_TITLE."] ".LANG_BANNER_FEATURE_NAME." Notification");
	//Transaction Notification
	define("LANG_NOTIFY_TRANSACTION", "[".EDIRECTORY_TITLE."] Notification de Transaction");
	//A transaction was made and needs to be revised by you.
	define("LANG_NOTIFY_TRANSACTION_1", "Une transaction a été effectuée et a besoin d'être révisée par vous.");
	//Transaction Info:
	define("LANG_NOTIFY_TRANSACTION_2", "Transaction Info:");
	//Transaction Time
	define("LANG_NOTIFY_TRANSACTION_3", "Date de la Transaction");
	//Gateway
	define("LANG_NOTIFY_TRANSACTION_4", "Mode de Paiement");
	//(prices amount are per installments)
	define("LANG_NOTIFY_TRANSACTION_5", "(montant les prix sont par versements)");
	//Please sign in to the directory at the links below to revise and/or activate these items.
	define("LANG_NOTIFY_TRANSACTION_6", "S'il vous plaît signer dans le répertoire à partir des liens ci-dessous pour réviser et / ou activer ces articles.");
	//Classified Notification
	define("LANG_NOTIFY_CLASSIFIED", "[".EDIRECTORY_TITLE."] ".LANG_CLASSIFIED_FEATURE_NAME." Notification");
	//Contact Us
	define("LANG_NOTIFY_CONTACTUS", "Contactez-nous");
	//Event Notification
	define("LANG_NOTIFY_EVENT", "[".EDIRECTORY_TITLE."] ".LANG_EVENT_FEATURE_NAME." Notification");
	//Listing Notification
	define("LANG_NOTIFY_LISTING", "[".EDIRECTORY_TITLE."] ".LANG_LISTING_FEATURE_NAME." Notification");
    //New Comment Added
    define("LANG_NOTIFY_NEWCOMMENT", "Nouveau Commentaire Ajouté");
    //New Reply Added
    define("LANG_NOTIFY_NEWREPLY", "Nouvelle Réponse Ajouté");
    //Your blog post
    define("LANG_NOTIFY_NEWCOMMENT_1", "Votre blog");
    //has a new reply.
    define("LANG_NOTIFY_NEWCOMMENT_2", "a reçu une nouvelle réponse.");
    //has a new comment.
    define("LANG_NOTIFY_NEWCOMMENT_3", "a reçu un nouveau commentaire.");
    //wrote
    define("LANG_NOTIFY_NEWCOMMENT_4", "écrit");
    //on
    define("LANG_NOTIFY_NEWCOMMENT_5", "en");
    //Click on the link below to moderate the comment
    define("LANG_NOTIFY_NEWCOMMENT_6", "Cliquez sur le lien ci-dessous pour modérer les commentaires");
    //CSS Editor Backup
    define("LANG_NOTIFY_EDITORCHANGED", "Sauvegarde CSS Editor");
    //The file
    define("LANG_NOTIFY_EDITORCHANGED_1", "Le fichier");
    //was changed at
    define("LANG_NOTIFY_EDITORCHANGED_2", "a été modifié en");
    //Enclosed is a copy of the last version submitted to the site.
    define("LANG_NOTIFY_EDITORCHANGED_3", "Trouverez ci-joint la dernière version du fichier téléchargé.");
    //Rating Notification
    define("LANG_NOTIFY_NEWREVIEW", "Avis de Évaluation");
    //has a new review
    define("LANG_NOTIFY_NEWREVIEW_1", "a de nouveaux avis");
    //stars
    define("LANG_NOTIFY_NEWREVIEW_2", "étoiles");
    //Click on the link below to go to the review administration
    define("LANG_NOTIFY_NEWREVIEW_3", "Cliquez sur le lien ci-dessous pour accéder à la gestion des évaluations");
    //from
    define("LANG_NOTIFY_NEWREVIEW_4", "du");
    //wrote
    define("LANG_NOTIFY_NEWREVIEW_5", "écrit");
    //Reply Notification
    define("LANG_NOTIFY_NEWREPLY", "Réponse Notification");
    //Review
    define("LANG_NOTIFY_NEWREPLY_1", "Évaluation");
    //has a new reply
    define("LANG_NOTIFY_NEWREPLY_2", "a une nouvelle réponse");
    //Click on the link below to go to the review administration
    define("LANG_NOTIFY_NEWREPLY_3", "Cliquez sur le lien ci-dessous pour accéder à la gestion des évaluations");
    //Import Correction Notification
    define("LANG_NOTIFY_PREPAREIMPORT", "Avis d'correction de Importation");
    //Event Import Correction Notification
    define("LANG_NOTIFY_PREPAREIMPORT_EVENT", "Avis d'correction de importation des Événements");
    //Your import correction for the file
    define("LANG_NOTIFY_PREPAREIMPORT_1", "La correction du fichier d'importation");
    //was completed but contained errors.
    define("LANG_NOTIFY_PREPAREIMPORT_2", "été finalisé, mais contient des erreurs.");
    //Please review the log at
    define("LANG_NOTIFY_PREPAREIMPORT_3", "S'il vous plaît vérifier l'historique de");
    //has been completed.
    define("LANG_NOTIFY_PREPAREIMPORT_4", "a été achevée.");
    //You can review the log here
    define("LANG_NOTIFY_PREPAREIMPORT_5", "Vous pouvez consulter l'historique ici");
    //Listing Import Notification
    define("LANG_NOTIFY_IMPORTLISTING", "Import Entreprises Notification");
    //Your listing(s) import has been completed.
    define("LANG_NOTIFY_IMPORTLISTING_1", "Sa import'd entreprise(s) a été achevée.");
    //You can review the log here
    define("LANG_NOTIFY_IMPORTLISTING_2", "Vous pouvez consulter l'historique ici");
    //Event Import Notification
    define("LANG_NOTIFY_IMPORTEVENT", "Importer d'Événement Notification");
    //Your event(s) import has been completed
    define("LANG_NOTIFY_IMPORTEVENT_1", "Importation événement(s) a été achevée.");
    //You can review the log here
    define("LANG_NOTIFY_IMPORTEVENT_2", "Vous pouvez consulter l'historique ici");
    //Package Notification
    define("LANG_NOTIFY_PACKAGE", "Notification de Paquet d'achat");
    //The package
    define("LANG_NOTIFY_PACKAGE_1", "Le Paquet");
    //was bought by the administrator
    define("LANG_NOTIFY_PACKAGE_2", "a été acheté par l'annonceur");
    //and needs to be checked over by you.
    define("LANG_NOTIFY_PACKAGE_3", "et doit être revue par vous.");
    //Purchased items
    define("LANG_NOTIFY_PACKAGE_4", "Les articles achetés");
    //Help Request
    define("LANG_NOTIFY_MEMBERSHELP", "Demande d'aide");
    //You have received a message from one of your site members.
    define("LANG_NOTIFY_MEMBERSHELP_1", "Vous avez reçu un message d'un membre de son site.");
    //From
    define("LANG_NOTIFY_MEMBERSHELP_2", "Du");
    //E-mail
    define("LANG_NOTIFY_MEMBERSHELP_3", "E-mail");
    //Message
    define("LANG_NOTIFY_MEMBERSHELP_4", "Message");
    //Forgotten Password
    define("LANG_NOTIFY_FORGOTPASS", "Mot de passe Oublié");
    //A new password was requested from your ".EDIRECTORY_TITLE." account.
    define("LANG_NOTIFY_FORGOTPASS_1", "Un nouveau mot de passe a été demandé pour votre compte ".EDIRECTORY_TITLE.".");
    //To change your password please click the link below and enter a new password
    define("LANG_NOTIFY_FORGOTPASS_2", "Pour changer votre mot de passe, cliquez sur le lien ci-dessous et entrez un nouveau mot de passe");
    //New User Signup (Listing)
    define("LANG_NOTIFY_SIGNUPLISTING", "Nouveau Registre (Entreprise)");
    //A new user has signed up and ordered a listing at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPLISTING_1", "Un nouvel utilisateur inscrit et créé une entreprise sur ".EDIRECTORY_TITLE.".");
    //New User Signup (Event)
    define("LANG_NOTIFY_SIGNUPEVENT", "Nouveau Registre (Événement)");
    //A new user has signed up and ordered an event at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPEVENT_1", "Un nouvel utilisateur inscrit et créé une événement sur ".EDIRECTORY_TITLE.".");
    //New User Signup (Classified)
    define("LANG_NOTIFY_SIGNUPCLASSIFIED", "Nouveau Registre (Annonce)");
    //A new user has signed up and ordered a classified at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPCLASSIFIED_1", "Un nouvel utilisateur inscrit et créé une annonce sur ".EDIRECTORY_TITLE.".");
    //New User Signup (Banner)
    define("LANG_NOTIFY_SIGNUPBANNER", "Nouveau Registre (Bannière)");
    //A new user has signed up and ordered a banner at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPBANNER_1", "Un nouvel utilisateur inscrit et créé une bannière sur ".EDIRECTORY_TITLE.".");
    //New User Signup (Article)
    define("LANG_NOTIFY_SIGNUPARTICLE", "Nouveau Registre (Article)");
    //A new user has signed up and ordered an article at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPARTICLE_1", "Un nouvel utilisateur inscrit et créé une article sur ".EDIRECTORY_TITLE.".");
    //Listing Claimed!
    define("LANG_NOTIFY_NEWCLAIM", "Entreprise Revendiquée!");
    //A listing has recently been claimed on your site - ".EDIRECTORY_TITLE."!
    define("LANG_NOTIFY_NEWCLAIM_1", "Une entreprise a été revendiquée dans votre répertoire - ".EDIRECTORY_TITLE."!");
    //To approve the listing, follow the claim link below
    define("LANG_NOTIFY_NEWCLAIM_2", "D'approuver la revendiquée de la entreprise en suivant le lien ci-dessous");
    //Claim ID
    define("LANG_NOTIFY_NEWCLAIM_3", "ID de la Revendiquée");
    //To preview the listing, follow the listing link below
    define("LANG_NOTIFY_NEWCLAIM_4", "Pour voir l'entreprise, suivre le lien ci-dessous société");
    //To see the user's account information follow the account link below
    define("LANG_NOTIFY_NEWCLAIM_5", "Pour afficher les informations du compte d'utilisateur, suivez le lien ci-dessous compte");
    //Account Details for the listing owner
    define("LANG_NOTIFY_NEWCLAIM_6", "Informations sur le compte du propriétaire de la entreprise");
    //New Signup (Via Mobile)
    define("LANG_NOTIFY_NEWACCOUNTAPP", "Nouveau Registre (Via Mobile Application)");
    //A new user has joined ".EDIRECTORY_TITLE." via the mobile app.
    define("LANG_NOTIFY_NEWACCOUNTAPP_1", "Un nouvel utilisateur enregistré sur ".EDIRECTORY_TITLE." via votre application mobile.");
    //Account information included below for your convenience:
    define("LANG_NOTIFY_NEWACCOUNTAPP_2", "Ci-dessous les informations de compte pour votre commodité:");
	//You received a new lead through the enquire form. To view the lead, follow the link below.
	define("LANG_NOTIFY_NEWLEAD", "Vous avez reçu un nouveau lead à travers le formulaire de demande. Pour consulter le lead, suivez le lien ci-dessous.");

	# ----------------------------------------------------------------------------------------------------
	# MOBILE VERSION
	# ----------------------------------------------------------------------------------------------------
	//We have an app for that!
	define("LANG_MOBILE_APP", "Nous avons une application pour ça!");
	//Grab the eDirectory App for iPhone
	define("LANG_MOBILE_GRAB_APP_IPHONE", "Prenez le App pour iPhone eDirectory.");
	//In Google Play
	define("LANG_MOBILE_GRAB_APP_ANDROID", "Sur Google Play");
	//Available on the
	define("LANG_MOBILE_APP_STORE", "Disponible sur le");
	//ANDROID APP ON
	define("LANG_MOBILE_APP_ANDROID", "ANDROID APP SUR");
    //Recently added listings
    define("LANG_MOBILE_RECENT_LISTINGS", "Listes récemment ajoutés");
    //View full site
    define("LANG_MOBILE_FULLSITE", "Voir le site complet");
    //Download App
    define("LANG_MOBILE_DOWNLOAD_APP", "Télécharger l'App");
    //Use the following code:
    define("LANG_MOBILE_DEAL_USECODE", "Utilisez le code suivant:");
    //REDEEMED
    define("LANG_MOBILE_DEAL_REDEEMED", "RACHETÉ");
    //Please login to redeem
    define("LANG_MOBILE_DEAL_LOGIN", "S'il vous plaît, connectez-vous racheter.");

    # ----------------------------------------------------------------------------------------------------
	# ARCAMAILER
	# ----------------------------------------------------------------------------------------------------
    //Sign up for our Newsletter
    define("LANG_ARCAMAILER_SIGNUP", "Inscrivez-vous à notre Bulletin");
    //Subscribe
    define("LANG_ARCAMAILER_SUBSCRIBE", "Signer");
	//Subscribe to our monthly newsletter, no spam, just product updates.
	define("LANG_ARCAMAILER_SUBSCRIBE_TIP", "Abonnez-vous à notre bulletin mensuelle, pas de spam, à quelques mises à jour de produits.");
    //Please, type your name and e-mail.
    define("LANG_ARCAMAILER_SUBSCRIBEERROR", "S'il vous plaît, entrez votre nom et votre e-mail.");
    //Check your e-mail to complete your subscription.
    define("LANG_ARCAMAILER_SUBSCRIBEDONE", "Vérifiez votre e-mail pour compléter votre inscription.");

    # ----------------------------------------------------------------------------------------------------
	# GENERAL
	# ----------------------------------------------------------------------------------------------------
    //Changing this will lose any unsaved changes made to this form.
    define("LANG_CONFIRM_CHANGE_LEVEL", "Modification sera perdre les modifications non enregistrées apportées à ce formulaire.");

	# ----------------------------------------------------------------------------------------------------
	# DINING GUIDE
	# ----------------------------------------------------------------------------------------------------
    //Top Listing
    define("LANG_LABEL_TOP_LISTING", "Liste Vedette");
    //Featured Deal
    define("LANG_LABEL_FEATURED_DEAL", "Offre Sélectionnée");
    //Popular Reviews
    define("LANG_LABEL_POPULAR_REVIEW", "Évaluations Populaires");
	//Helpful Reviews
	define("LANG_LABEL_HELPFUL_REVIEWS", "Évaluations Utiles");
    //Keep Reading
    define("LANG_LABEL_KEEP_READING", "Continuez à Lire");
    //Best Of
    define("LANG_MENU_BESTOF", "Les Meilleurs");
    //By Cuisine
    define("LANG_MENU_BYCUISINE", "Par Cuisine");
    //By Location
    define("LANG_MENU_BYLOCATION", "Par Lieu");
    //Sign up | Login
    define("LANG_MENU_SIGNUPLOGIN", "Inscription | Connexion");
    //Forgot?
    define("LANG_LABEL_FORGOT", "Oublié?");
    //Not a member? Sign up now
    define("LANG_LABEL_SIGNUPNOW", "Pas encore membre? Inscrivez-vous");
	//Price range
	define("LANG_LABEL_PRICE_RANGE", "Gamme de prix");
	//Need a Specific Category?
	define("LANG_LABEL_SPECIFIC_CATEG", "Besoin d'une Catégorie Spécifique?");
	//Show [x] Reviews
	define("LANG_LABEL_SHOW_REVIEWS", "Afficher [x] Évaluations");
	//Filter by
	define("LANG_LABEL_FILTERBY", "Filtrer par");
	//Filter by Category
	define("LANG_LABEL_FILTERBY_CATEGORY", "Filtrer par Catégorie");
	//Keyword to search...
	define("LANG_LABEL_KEYWORDSEARCH", "Mot clé pour la recherche...");
	//Location to search...
	define("LANG_LABEL_LOCATIONSEARCH", "Emplacement pour la recherche...");
	//See All Locations
	define("LANG_LABEL_SEE_LOCATIONS", "Voir tous les Emplacements");
	//Clear Selections
	define("LANG_LABEL_CLEAR_SELECT", "Effacer les Sélections");
	//Close Advanced Search
	define("LANG_LABEL_ADVSEARCH_CLOSE", "Fermez Recherche Avancée");
	//Offers & Deals
	define("LANG_LABEL_DEAL_FILTER", "Offres & Affaires");
	//Cuisine
	define("LANG_LABEL_CUISINE", "Cuisine");
	//List View
	define("LANG_LABEL_LISTVIEW", "Liste Voir");
	//Map View
	define("LANG_LABEL_MAPVIEW", "Carte Voir");
	//Give us a moment, we're loading in your results.
	define("LANG_LABEL_LOADINGMAP", "Donnez-nous un moment, nous chargeons vos résultats.");
	//Valid for
    define("LANG_LABEL_FILTER_VALID_FOR", "Valable pour");
    //Ends in less than 24 hours
    define("LANG_LABEL_FILTER_ENDS_IN_LESS_THAN_24_HOURS", "Se termine dans moins de 24 heures");
    //aVlid for more than 2 days
    define("LANG_LABEL_FILTER_VALID_FOR_MORE_THAN_2_DAYS", "Valable pour plus de 2 jours");
    //Valid for more than a week
    define("LANG_LABEL_FILTER_VALID_FOR_MORE_THAN_A_WEEK", "Valable pour plus d'une semaine");
	//filter
	define("LANG_LABEL_FILTER", "filtrer");
    //Show more categories
    define("LANG_LABEL_FILTER_SHOW_MORE_CATEGORIES", "Voir plus de catégories");
    //Show more locations
    define("LANG_LABEL_FILTER_SHOW_MORE_LOCATIONS", "Voir plus d'endroits");
    //Showing [NUMBER_EDIR] for KEYWORD_EDIR in LOCATION_EDIR
    define("LANG_LABEL_FILTER_SHOWING_RESULTS_WITH_KEYWORD_AND_LOCATION", "Liste [NUMBER_EDIR] pour KEYWORD_EDIR dans LOCATION_EDIR");
    //Showing [NUMBER_EDIR] for KEYWORD_EDIR
    define("LANG_LABEL_FILTER_SHOWING_RESULTS_WITH_KEYWORD", "Liste [NUMBER_EDIR] pour KEYWORD_EDIR");
    //Map view is only available for result sets with less than [MAX_MARKERS] items. Use filters to refine
    define("LANG_LABEL_FILTER_MAP_MORE_THAN_1000_RESULTS", "La carte est disponible uniquement pour les ensembles de résultats avec moins de [MAX_MARKERS] articles. Utilisez les filtres pour affiner");
    //No Matches
    define("LANG_LABEL_FILTER_NO_MATCHES", "Pas de matchs");
    //Clear Filters
    define("LANG_LABEL_FILTER_SHOW_ORIGINAL_SEARCH", "Voir la recherche originale");

	# ----------------------------------------------------------------------------------------------------
	# LEADS
	# ----------------------------------------------------------------------------------------------------
	//Lead
	define("LANG_LABEL_LEAD", "Lead");
	//Leads
	define("LANG_LABEL_LEADS", "Leads");
	//Click here to view this item leads
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_LEADS", "Cliquez ici pour visualiser cet élément leads");
	//Manage Leads
	define("LANG_MANAGE_LEADS", "Gérer Leads");
	//No records found.
	define("LANG_NORECORD", "Aucun enregistrement trouvé.");
	//Forward
	define("LANG_LABEL_FORWARD", "Vers l'avant");
	//Lead successfully deleted!
	define("LANG_LEAD_SUCCESSDELETED", "Lead supprimé avec succès!");
	//Lead successfully replied!
	define("LANG_LEAD_REPLIED", "Lead a répondu avec succès!");
	//Lead successfully forwarded!
	define("LANG_LEAD_FORWARDED", "Lead transmis avec succès!");
	//Please type a message.
	define("LANG_LEAD_TYPEMESSAGE", "S'il vous plaît taper un message.");
	//New lead received by
	define("LANG_LEAD_RECEIVED", "Nouvelle lead reçue par");
	//Replied
	define("LANG_LEAD_REPLIED_ICO", "Répondit");
	//Forwarded
	define("LANG_LEAD_FORWARDED_ICO", "Transmis");
	//Replied and Forwarded
	define("LANG_LEAD_REPLIED_FORWARDED_ICO", "Répondit [dater] et Transmis [datef]");
	//Talk to Us
	define("LANG_LEAD_TALKTOUS", "Parlez-nous");
	//Your first name
	define("LANG_LEAD_FIRSTNAME", "Votre prénom");
	//Your last name
	define("LANG_LEAD_LASTNAME", "Votre nom");
	//Your email, please?
	define("LANG_LEAD_EMAIL", "Votre e-mail, s'il vous plaît?");
	//Add your phone number
	define("LANG_LEAD_PHONE", "Ajoutez votre numéro de téléphone");
	//Company/Organization
	define("LANG_LEAD_COMPANY", "Société / Organisation");
	//What kind of service do you need?
	define("LANG_LEAD_MESSAGE", "Quel type de service avez-vous besoin?");
	//Please type your first name and last name.
	define("LANG_LEAD_TYPE_NAME", "S'il vous plaît entrez votre prénom et votre nom de famille.");
	//Thank you, we will be in touch shortly.
	define("LANG_LEAD_THANKYOU", "Merci, nous allons être en contact très prochainement.");
	//New Enquire
	define("LANG_LEAD_ENQUERY", "New Renseignez");
	//General Lead
	define("LANG_GENERAL_LEAD", "Lead Général");

	# ----------------------------------------------------------------------------------------------------
	# LOG IN / SIGN UP / MEMBERS
	# ----------------------------------------------------------------------------------------------------
	//Are you a Sponsor?
	define("LANG_AREYOU_SPONSOR_AREA", "Êtes-vous un commanditaire?");
	//List your business today
	define("LANG_AREYOU_SPONSOR_AREA_2", "Inscrivez votre entreprise aujourd'hui");
	//Find Us
	define("LANG_FIND_US", "Trouve nous");
	//or if you already have an account login below
	define("LANG_OR_SIGNUPACCOUNT", "ou si vous avez déjà un compte de connexion ci-dessous");
	//Or log in using your e-mail address
	define("LANG_OR_SIGNINEMAIL", "ou connectez-vous avec votre adresse e-mail");
	//Or sign up using your e-mail address
	define("LANG_OR_SIGNUPEMAIL", "ou inscrivez-vous en utilisant votre e-mail ");
	//Are you a sponsor? Go to our sponsor area
	define("LANG_GO_TO_SPONSOR_AREA", "Êtes-vous un sponsor? Aller à notre sponsor");
	//By creating an account, I accept the Terms of Use.
	define("LANG_ACCEPT_TERMS", "En créant un compte J'accepte les [a]conditions d'utilisation[/a].");
	//Sponsor Area
	define("LANG_LABEL_SPONSORAREA", "Espace de Sponsor");
	//Log in to the Sponsor Area
	define("LANG_LABEL_LOGIN_SPONSORAREA", "Connectez-vous à l'Espace de Sponsor");
	//Already a member - Log in here.
    define("LANG_LABEL_ALREADY_MEMBER", "Déjà membre - Se connecter ici.");
	//Reference
	define("LANG_LABEL_REFERENCE", "Référence");
	//Got an enquiry or something you're stuck on? Send us a message. We'll get back to you as soon as we can.
	define("LANG_HELP_MESSAGE", "Vous avez une question ou quelque chose que vous êtes coincé sur? Envoyez-nous un message. Nous reviendrons vers vous dès que nous le pouvons.");
	//Add a new content
	define("LANG_ADD_NEW_CONTENT", "Ajouter un nouveau contenu");
	//You don't have any content yet.
	define("LANG_ADD_NEW_CONTENT2", "Vous n'avez pas encore de contenu.");
	//Add your business today, it's quick and simple!
	define("LANG_ADD_NEW_CONTENT2_TIP", "Ajoutez votre entreprise aujourd'hui, c'est simple et rapide!");
	//Remove
	define("LANG_LABEL_REMOVE", "Supprimer");
	//View on Website
	define("LANG_LABEL_VIEW_LIVE", "Voir sur le Site");
	//Preview
	define("LANG_LABEL_PREVIEW", "Avant-première");
	//Expires in
	define("LANG_LABEL_EXPIRESON", "Expire le");
	//until it expires
	define("LANG_LABEL_UNTILEXPIRES", "jusqu'à ce qu'il expire");
	//impressions left
	define("LANG_LABEL_IMPRESSIONS_LEFT", "impressions laissées");
	//Billing
	define("LANG_LABEL_BILLING", "Facturation");
	//was successfully deleted!
	define("LANG_LABEL_WASSUCCESSDELETED", "a été supprimé avec succès!");
	//Deal not linked
	define("LANG_LABEL_NOTLINKED", "A ne pas liée");
	//Increase Visibility
	define("LANG_LABEL_INCREASEVISIBILITY", "Augmenter la visibilité");
	//Renew Now
	define("LANG_LABEL_RENEW", "Renouveler maintenant");
	//Add basic information
	define("LANG_LABEL_GAMEFY_DESC", "Ajouter des informations de base");
	//Add photos or video
	define("LANG_LABEL_GAMEFY_MEDIA", "Ajouter des photos ou vidéo");
	//Add additional information
	define("LANG_LABEL_GAMEFY_ADDITIONAL", "Ajouter plus d'informations");
	//Share and get more reviews
	define("LANG_LABEL_DASHBOARD_SHARE", "Partager et avoir plus de commentaires");
	//Share and get more leads
	define("LANG_LABEL_DASHBOARD_SHARE2", "Partager et avoir plus de prospects");
	//Share and get more redeems
    define("LANG_LABEL_DASHBOARD_SHARE3", "Partager et avoir plus de coupons");
	//Review by
	define("LANG_LABEL_REVIEWBY", "Examen par");
	//Reply this
	define("LANG_LABEL_REPLYTHIS", "Répondre à ce");
	//Write your reply
    define("LANG_LABEL_WRITE_REPLY", "Écrivez votre réponse");
	//Activity Report
	define("LANG_LABEL_ACTIVITYREPORT", "Rapport d'activité");
	//See all reviews
	define("LANG_LABEL_SEE_REVIEWS", "Voir tous les avis");
	//See all leads
	define("LANG_LABEL_SEE_LEADS", "Voir toutes les pistes");
	//Statistics
	define("LANG_LABEL_STATISTICS", "Statistiques");
	//Total Viewers
	define("LANG_LABEL_TOTALVIEWERS", "Nombre de vues");
	//Phone Views
	define("LANG_LABEL_PHONEVIEWS", "Téléphone Vues");
	//Website Views
	define("LANG_LABEL_WEBSITEVIEWS", "Site Vues");
	//Fax Views
	define("LANG_LABEL_FAXVIEWS", "Fax Vues");
	//Phone View
	define("LANG_LABEL_PHONEVIEW", "Téléphone Voir");
	//Website View
	define("LANG_LABEL_WEBSITEVIEW", "Voir le site web");
	//Fax View
	define("LANG_LABEL_FAXVIEW", "Fax Voir");
	//View more stats
	define("LANG_LABEL_VIEW_MORE_STATS", "Voir plus de stats");
	//Stats
	define("LANG_LABEL_STATS", "Stats");
	//Listing Completion
    define("LANG_LABEL_LISTING_COMPLETION", "Informations sur l'entreprise");
    //Event Completion
    define("LANG_LABEL_EVENT_COMPLETION", "Informations sur l'événement");
    //Classified Completion
    define("LANG_LABEL_CLASSIFIED_COMPLETION", "Informations sur l'annonce");
    //Article Completion
    define("LANG_LABEL_ARTICLE_COMPLETION", "Informations sur l'article");
	//Deal Completion
    define("LANG_LABEL_PROMOTION_COMPLETION", "Informations sur l'offrir");
    //You're not quite done with your item.
    define("LANG_LABEL_GAMEFY_TIP", "Vous n'êtes pas tout à fait terminé avec votre article.");
	//What are you looking for today?
	define("LANG_LABEL_PROFILE_TIP1", "Que cherchez-vous aujourd'hui?");
	//Thank you for being part of EDIRECTORY_TITLE. Join our community by giving your opinion and evaluating your favorite listings.
	define("LANG_LABEL_PROFILE_TIP2", "Merci de faire partie de ".EDIRECTORY_TITLE.". Rejoignez notre communauté en donnant votre avis et évaluer vos annonces préférées.");
	//Oh wait...
	define("LANG_LABEL_PROFILE_TIP3", "Désolé...");
	//This user has no activity in our portal yet. Don't worry. You can still join our community by giving your opinion and evaluating your favorite listings.
	define("LANG_LABEL_PROFILE_TIP4", "Cet utilisateur n'a pas encore d'activité sur notre portail.<br>Ne vous inquiétez pas. Vous pouvez toujours rejoindre notre communauté en donnant votre avis et évaluer vos annonces préférées.");
	//Rated
	define("LANG_LABEL_RATED", "Évalué");
	//Commented
	define("LANG_LABEL_COMMENTED", "Commenté");
	//Redeemed deal
	define("LANG_LABEL_REDEEMED", "Racheté l'offre");
	//Your redeem code is
	define("LANG_LABEL_DEAL_CODE", "Votre code est");
	//View previous activities
	define("LANG_PREVIOUS_ACTIVITY", "Voir l'activité précédente");
	//with
	define("LANG_WITH", "avec");
	//Redeemed by
	define("LANG_LABEL_REDEEMED_BY", "Racheté par");
	//You received [x] new review
	define("LANG_LABEL_NEW_REVIEW", "Vous avez reçu [x] de nouveaux évaluation");
	//You received [x] new reviews
	define("LANG_LABEL_NEW_REVIEWS", "Vous avez reçu [x] de nouveaux évaluations");
	//You received [x] new lead
	define("LANG_LABEL_NEW_LEAD", "Vous avez reçu [x] nouvelle piste");
	//You received [x] new leads
	define("LANG_LABEL_NEW_LEADS", "Vous avez reçu [x] de nouvelles pistes");

	# ----------------------------------------------------------------------------------------------------
	# NEW ADD MODULES FORMS
	# ----------------------------------------------------------------------------------------------------
	//Você pode mudar suas [a]configurações de níveis e preços[/a] quando quiser.
	define("LANG_SELECTLEVEL_TIP", "Vous pouvez modifier vos paramètres [a]et les niveaux de prix[/a] chaque fois que vous voulez.");
	//Com os [a]tipos de empresa[/a], você pode escolher diferentes layouts para a página de detalhes de suas empresas, criar campos extras e muito mais.
	define("LANG_SELECT_LISTINGTEMPLATE_TIP", "Avec [a]type de société[/a], vous pouvez choisir différentes mises en page pour la page d'information générale pour votre entreprise, créer des champs supplémentaires et plus.");
	//Salvar Alterações
	define("LANG_SAVE_CHANGES", "Enregistrer les modifications");
	//Digite o nome de sua empresa aqui.
	define("LANG_HOLDER_LISTINGTITLE", "Entrez le nom de votre société ici.");
	//Digite o nome de sua oferta aqui.
	define("LANG_HOLDER_PROMOTIONTITLE", "Entrez le nom de votre offre ici.");
	//Digite o nome de seu banner aqui.
	define("LANG_HOLDER_BANNERTITLE", "Entrez le nom de votre bannière ici.");
	//Digite o nome de seu evento aqui.
	define("LANG_HOLDER_EVENTTITLE", "Entrez le nom de votre événement ici.");
	//Digite o nome de seu classificado aqui.
	define("LANG_HOLDER_CLASSIFIEDTITLE", "Entrez le nom de votre classés ici.");
	//Digite o nome de seu artigo aqui.
	define("LANG_HOLDER_ARTICLETITLE", "Entrez le nom de votre article ici.");
	//Digite o nome de seu post aqui.
	define("LANG_HOLDER_BLOGTITLE", "Entrez le nom de votre poste ici.");
	//Informações Básicas
	define("LANG_BASIC_INFO", "Données de base");
	//Clique no botão à direita para selecionar as categorias.
	define("LANG_SELECT_CATEGORIES", "Cliquez sur le bouton vers la droite pour sélectionner les catégories.");
	//Adicionar categorias
	define("LANG_ADD_CATEGORIES", "Ajouter des catégories");
	//Breve descrição da empresa.
	define("LANG_HOLDER_LISTINGSUMMARY", "Brève description de l'entreprise.");
	//Apresente a empresa ao público de forma clara e eficiente. Descreva todas as características que tornam o estabelecimento único e uma ótima opção para os clientes.
	define("LANG_HOLDER_LISTINGDESCRIPTION", "Présenter l'entreprise au public d'une manière claire et efficace. Décrire toutes les caractéristiques qui font de la propriété unique et une excellente option pour les clients.");
	//Breve descrição da oferta.
	define("LANG_HOLDER_PROMOTIONSUMMARY", "Brève description de l'offre.");
	//Apresente a promoção ao público de forma clara e eficiente. Descreva todas as características que a fazem valer a pena.
	define("LANG_HOLDER_PROMOTIONDESCRIPTION", "Introduire la promotion auprès du public de manière claire et efficace. Décrire toutes les caractéristiques qui le rendent intéressant.");
	//Breve descrição do evento.
	define("LANG_HOLDER_EVENTSUMMARY", "Brève description de l'événement.");
	//Apresente o evento ao público de forma clara e eficiente. Descreva os principais destaques e características que atrairão as pessoas.
	define("LANG_HOLDER_EVENTDESCRIPTION", "Soumettre l'événement au public de manière claire et efficace. Décrire les principaux faits saillants et caractéristiques qui attirent les gens.");
	//Breve descrição do classificado.
	define("LANG_HOLDER_CLASSIFIEDSUMMARY", "Brève description de l'annonce.");
	//Apresente o classificado ao público de forma clara e eficiente. Descreva os principais destaques e características que farão as pessoas quererem comprar o seu produto/serviço.
	define("LANG_HOLDER_CLASSIFIEDDESCRIPTION", "Présent classés au public d'une manière claire et efficace. Décrire les principaux faits saillants et caractéristiques qui rendront les gens veulent acheter votre produit / service.");
	//Resumo do artigo.
	define("LANG_HOLDER_ARTICLESUMMARY", "Sommaire de l'article.");
	//Type your keyword. Press 'Tab' or 'Enter' on your keyboard to confirm.
	define("LANG_HOLDER_KEYWORDS", "Entrez le mot-clé et tapez sur 'Tab' pour le confirmer.");
	//Utilize este campo para destacar algumas características que a sua empresa tem a oferecer. Digite um item por linha.
	define("LANG_HOLDER_FEATURES", "Utilisez ce champ pour mettre en évidence certaines caractéristiques que votre entreprise a à offrir. Entrez un élément par ligne.");
	//Você tem um código de desconto? Digite-o aqui.
	define("LANG_HOLDER_DISCOUNTCODE", "Vous avez un code de réduction? Entrez-le ici.");
	//Cole a URL do vídeo aqui. Ex: http://www.youtube.com/watch?v=xxxx
	define("LANG_HOLDER_VIDEO", "Collez l'URL de la vidéo ici. Ex: http://www.youtube.com/watch?v=xxxx");
	//Breve descrição do seu vídeo.
	define("LANG_HOLDER_VIDEOCAPTION", "Brève description de votre vidéo.");
	//O link para download do arquivo será mostrado desta forma.
	define("LANG_HOLDER_ATTACHCAPTION", "Le lien de téléchargement pour le fichier sera affiché de cette façon.");
	//Deseja alterar suas classificações? Clique aqui.
	define("LANG_HOLDER_BADGES", "Vous voulez changer leurs notes? Cliquez ici.");
	//Type here the terms & conditions for redeeming your deal.
	define("LANG_HOLDER_PROMOTIONCONDITIONS", "Tapez ici les termes et conditions pour utiliser votre affaire.");
	//Não foi possível carregar o vídeo. Por favor, verifique a URL do vídeo e tente novamente.
	define("LANG_VIDEO_NOTFOUND", "Impossible de charger la vidéo. Se il vous plaît vérifier l'URL de la vidéo et essayer à nouveau.");
	//Você pode selecionar até [max] categorias.
	define("LANG_SELECTMAX_CATEGORIES", "Vous pouvez sélectionner jusqu'à [Max] catégories.");
	//Por favor, aguarde...
	define("LANG_LABEL_FORM_WAIT", "Se il vous plaît, attendez ...");
	//Título da Imagem
	define("LANG_LABEL_IMAGE_TITLE", "Titre de l'image");
	//Descrição da imagem
	define("LANG_LABEL_IMAGE_DESCRIPTION", "Description de l'image");
	//Recorte da Imagem & Descrição
	define("LANG_LABEL_IMAGE_CROP", "Recadrage Image & description");
	//Recorte
	define("LANG_LABEL_IMAGE_CROPPING", "Tailler");
	//Tipo de Desconto
	define("LANG_LABEL_DISCOUNT_TYPE", "Type de Discount");
	//Precisa de ajuda? Dê uma olhada no tutorial.
	define("LANG_LABEL_TUTORIAL", "Besoin d'aide? Jetez un oeil à ce tutoriel.");
	//Guia de Campos
	define("LANG_LABEL_TUTORIAL_FIELDS", "Guide champs");
	//Fechar Tutorial
	define("LANG_LABEL_TUTORIAL_END", "Tutoriel Fechar");
	//Social networks
    define("LANG_LABEL_SOCIALNETWORK", "Réseaux Sociaux");
	//This is the Title that identifies your item on the site. Keep it brief, yet effective.
	define("LANG_LABEL_TUTORIAL_TOUR-TITLE", "Tel est le titre qui identifie votre article sur le site. Soyez bref, mais efficace.");
	//Choose between different Listing Types that offer varying fields and layouts specific to common listings, or create a new Listing Type that suits your needs.
	define("LANG_LABEL_TUTORIAL_TOUR-TEMPLATE", "Choisir entre différents types de liste qui offrent différentes rubriques et des modèles spécifiques à listes commun, ou créer un nouveau type de liste qui convient à vos besoins.");
	//Choose your item's Level here. Each Level can be customized to offer a different set of features for the item.
	define("LANG_LABEL_TUTORIAL_TOUR-LEVEL", "Choisissez le niveau de votre article ici. Chaque niveau peut être personnalisé pour offrir un ensemble différent de fonctionnalités pour le poste.");
	//Choose the Categories that best fit your item. Visitors will find your item easily by browsing under specific Categories.
	define("LANG_LABEL_TUTORIAL_TOUR-CATEGORIES", "Choisissez les catégories qui correspondent le mieux à votre article. Les visiteurs trouveront votre article facilement en naviguant dans les catégories spécifiques.");
	//This is the account that owns the item. You can change it to another account or leave your item with no owner.
	define("LANG_LABEL_TUTORIAL_TOUR-OWNER", "Ceci est le compte qui possède l'élément. Vous pouvez le changer pour un autre compte ou de quitter votre poste sans propriétaire.");
	//Activated items will be available on the results page. Pending items have just been added to the site and are awaiting approval. Expired items have gone past their renewal date without payment and lastly, you can temporarily make an items Suspended at your choosing.
	define("LANG_LABEL_TUTORIAL_TOUR-STATUS", "Activé articles seront disponibles sur la page de résultats. Points en suspens ont juste été ajouté sur le site et sont en attente d'approbation. Les produits périmés ont dépassé leur date de renouvellement sans paiement et enfin, vous pouvez temporairement faire une Plafonds suspendus à votre choix.");
	//You can manually set the Renewal Date for an items to set when the next payment is due.
	define("LANG_LABEL_TUTORIAL_TOUR-EXPIRATION", "Vous pouvez définir manuellement la date de renouvellement pour un éléments pour définir quand le prochain paiement est dû.");
	//Check this box to disable the claim feature and not allow owners to claim their listing. Leave it blank if you want to allow users to claim their listing.
	define("LANG_LABEL_TUTORIAL_TOUR-CLAIM", "Cochez cette case pour désactiver la fonction de la demande et ne permettent aux propriétaires de faire valoir leurs liste. Laissez ce champ vide si vous souhaitez autoriser les utilisateurs à réclamer leur liste.");
	//This field is shown on the results page and briefly describes your item.
	define("LANG_LABEL_TUTORIAL_TOUR-SUMMARY", "Ce champ est affiché sur la page de résultats et décrit brièvement votre article.");
	//Add more details about your item on this field. This full description will be shown on the item's detail page.
	define("LANG_LABEL_TUTORIAL_TOUR-DESCRIPTION", "Ajouter plus de détails au sujet de votre article sur ce domaine. Cette description complète sera affiché sur la page de détail de l'article.");
	//You can tag specific keywords in this field. Keywords will help users to find your item when searching on the site.
	define("LANG_LABEL_TUTORIAL_TOUR-KEYWORDS", "Vous pouvez marquer des mots clés spécifiques dans ce domaine. Mots-clés aideront les utilisateurs à trouver votre article lors de la recherche sur le site.");
	//In this section you can add all the information for your item's location and contact. The more complete, the easier it is for customers to get in touch with you.
	define("LANG_LABEL_TUTORIAL_TOUR-CONTACT", "Dans cette section, vous pouvez ajouter toutes les informations pour l'emplacement et les coordonnées de votre article. Le plus complet, plus il est facile pour les clients d'entrer en contact avec vous.");
	//Use this field to add a location reference for your listing. For example, two blocks from the mall.
	define("LANG_LABEL_TUTORIAL_TOUR-REFERENCE", "Utilisez ce champ pour ajouter une référence de localisation pour votre liste. Par exemple, deux pâtés de maisons du centre commercial.");
	//Does your event have a Facebook page? Type it here to show the Facebook wall widget on the event's detail page.
	define("LANG_LABEL_TUTORIAL_TOUR-FACEBOOK", "Est-ce que votre événement ont une page Facebook? Tapez ici pour afficher le widget de mur Facebook sur la page des événements de détail.");
	//Use this field to highlight some features of your business or add any additional useful information, what makes it special.
	define("LANG_LABEL_TUTORIAL_TOUR-FEATURES", "Utilisez ce champ pour mettre en évidence certaines caractéristiques de votre entreprise ou ajouter des informations supplémentaires utiles, ce qui le rend spécial.");
	//Type the hours of work for your business here.
	define("LANG_LABEL_TUTORIAL_TOUR-HOURS", "Tapez les heures de travail pour votre entreprise ici.");
	//If applicable, use this field to describe the average price for your products or services.
	define("LANG_LABEL_TUTORIAL_TOUR-PRICE", "Le cas échéant, utilisez ce champ pour décrire le prix moyen pour vos produits ou services.");
	//Have a discount or promotional code? Type it here. The item's next payment will be affected.
	define("LANG_LABEL_TUTORIAL_TOUR-DISCOUNT", "Bénéficient d'une réduction ou un code promotionnel? Tapez ici. Prochain paiement de l'article sera affecté.");
	//Use this box to drop and add images. You can click on a image to adjust the cropping and edit the title and description.
	define("LANG_LABEL_TUTORIAL_TOUR-IMAGES", "Utilisez cette boîte à baisser et ajouter des images. Vous pouvez cliquer sur une image pour ajuster la culture et de modifier le titre et la description.");
	//Copy and paste your video URL here. Add a brief description to say what your video is about.
	define("LANG_LABEL_TUTORIAL_TOUR-VIDEO", "Copiez et collez votre URL de la vidéo ici. Ajouter une brève description de dire ce que votre vidéo est sur.");
	//Use this field to attach an additional file. Use it for a Menu, Product Brochure, or whatever you'd like.
	define("LANG_LABEL_TUTORIAL_TOUR-FILE", "Utilisez ce champ pour joindre un fichier supplémentaire. Utilisez-le pour un menu, Brochure produit, ou ce que vous souhaitez.");
	//You can help your owners to promote their businesses by designating badges for them.
	define("LANG_LABEL_TUTORIAL_TOUR-BADGES", "Vous pouvez aider vos propriétaires pour promouvoir leurs entreprises en désignant badges pour eux.");
	//Use this section to set some more additional information for your business.
	define("LANG_LABEL_TUTORIAL_TOUR-ADDITIONAL", "Utilisez cette section pour définir des informations plus supplémentaire pour votre entreprise.");
	//Deal should be assigned to a listing in order to be shown on the results. Use this box to select a listing
	define("LANG_LABEL_TUTORIAL_TOUR-LISTING", "Offre devrait être confiée à un liste pour être montré sur les résultats. Utilisez cette boîte pour sélectionner une liste");
	//This field is pre-filled with a default text that describes the terms of use and conditions to redeem a deal. You can change it to whatever you need.
	define("LANG_LABEL_TUTORIAL_TOUR-CONDITIONS", "Ce champ est pré-rempli avec un texte par défaut qui décrit les termes et conditions d'utilisation de racheter un offre. Vous pouvez modifier à tout ce que vous avez besoin.");
	//Use this section to set when the deal will be available. After the end date hits, it will no longer be shown in any results.
	define("LANG_LABEL_TUTORIAL_TOUR-DATE2", "Utilisez cette section pour définir quand la offre sera disponible. Après les coups de date de fin, il ne sera plus affichée dans les résultats.");
	//Use this box to add and edit an image for your deal.
	define("LANG_LABEL_TUTORIAL_TOUR-IMAGE", "Utilisez cette case pour ajouter et éditer une image pour votre offre.");
	//Use this section to set when your event is taking place. You can also use the Recurring checkbox to save an event that will be repeating on a regular basis.
	define("LANG_LABEL_TUTORIAL_TOUR-DATE", "Utilisez cette section pour définir quand votre événement se déroule. Vous pouvez également utiliser la case récurrent pour sauver un événement qui sera répéter sur une base régulière.");
	//Type the body of your article here. You can use the editor to format the text, add images, etc.
	define("LANG_LABEL_TUTORIAL_TOUR-CONTENT", "Tapez le corps de votre article ici. Vous pouvez utiliser l'éditeur pour formater le texte, ajouter des images, etc.");
	//Impressions refer to the number of times the banner is shown on the frontend pages.
	define("LANG_LABEL_TUTORIAL_TOUR-IMPRESSIONS", "Impressions réfèrent au nombre de fois que le bannière est affiché sur les pages frontend.");
	//Use this field to identify the article's author.
	define("LANG_LABEL_TUTORIAL_TOUR-AUTHOR", "Utilisez ce champ pour identifier l'auteur de la article.");
	//If the article's author has a website, you can type it in here.
	define("LANG_LABEL_TUTORIAL_TOUR-AUTHORURL", "Si l'auteur de la article a un site, vous pouvez le saisir ici.");
	//Set the publication date for the article here.
	define("LANG_LABEL_TUTORIAL_TOUR-PUBLICATION", "Réglez la date de publication de la article ici.");
	//Use this field to give a quick overview of the article.
	define("LANG_LABEL_TUTORIAL_TOUR-ABSTRACT", "Utilisez ce champ pour donner un aperçu rapide de la article.");
	//Does your business have a profile in any of these social medias? Type it here to show buttons to your profiles on the detail page. For Facebook, the wall widget will also be shown.
	define("LANG_LABEL_TUTORIAL_TOUR-SOCIALNETWORK", "Est-ce que votre entreprise ont un profil dans aucun de ces médias sociaux? Tapez ici pour afficher les boutons à vos profils sur la page de détail. Pour Facebook, le widget de mur sera également présenté.");
	//Select an option below
	define("LANG_CHOOSE_DEAL_ATTACH", "Choisissez une option");
	//No deals available for association with this listing. In order to be linked to this listing, the deal should not be associated with other listing and should belong to the same account.
	define("LANG_ATTACHDEAL_UNAVAILABLE", "Pas offres disponibles pour l'association avec cette annonce. Afin d'être lié à cette annonce, l'affaire ne devrait pas être associé à d'autres annonces et devrait appartenir au même compte.");
	//No listings available for association with this deal. In order to be linked to this deal, the listing should not be associated with other deal and should belong to the same account.
	define("LANG_ATTACHLISTING_UNAVAILABLE", "Pas annonces disponibles pour l'association avec cette affaire. Afin d'être lié à cet accord, la liste ne devrait pas être associé à d'autres affaire et doit appartenir à la même compte.");
    // You must associate a listing and a promotion with the same account.
    define("LANG_SITEMGR_ERROR_LISTING_PROMOTION_SITEMGR_ACCOUNT_DIFFER", "Vous devez associer une liste et une promotion avec le même compte.");
	//Leave it blank to unlink the deal.
	define("LANG_ATTACHDEAL_EMPTY", "Laisser le champ vide pour dissocier l'affaire.");
	//Recommended dimensions
	define("LANG_LABEL_RECOMMENDED_DIMENSIONS", "Dimensions recommandées");
	//Cover Image
	define("LANG_LABEL_COVERIMAGE", "Image de Couverture");
	//Thumbnail
	define("LANG_LABEL_THUMBNAIL", "Miniature");
	//Changing the template now will remove the selected categories so far. Do you want to continue?
	define("LANG_CONFIRM_CHANGELISTINGTYPE", "Changer le modèle va maintenant supprimer les catégories sélectionnées jusqu'à présent. Voulez-vous continuer?");
    // It was selected more classifieds than it is allowed.
    define("LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_QUANTITY", "Il a été sélectionné plus ".LANG_CLASSIFIED_FEATURE_NAME_PLURAL." qu'il lui est permis.");
    // The association was successfully save.
    define("LANG_SITEMGR_ASSOCIATION_SUCCESSFULLY_SAVE", "L'association a réussi à sauver.");
    // You must associate a listing and a classified with the same account.
    define("LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_SITEMGR_ACCOUNT_DIFFER", "Vous devez associer un " .LANG_LISTING. " et un " .LANG_CLASSIFIED. " avec le même compte.");
    // Association not allowed.
    define("LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_USER_ACCOUNT_DIFFER", "Association pas autorisée.");
    // This listing does not support more associations.
    define("LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_QUANTITY", "Ce " .LANG_LISTING. " ne supporte pas plus d'associations.");
	//Powered by
	define("LANG_POWEREDBY", "Alimenté par");
    //Select an option below
    define("LANG_CHOOSE_CLASSIFIED_ATTACH", "Sélectionnez une option ci-dessous");
    //Associate an existing classified with this listing
    define("LANG_SITEMGR_CLASSIFIED_ASSOCIATE", "Associe un ".LANG_CLASSIFIED." existant avec ça ".LISTING_FEATURE_NAME);
//Leave it blank to unlink the classified
    define("LANG_ATTACHCLASSIFIED_EMPTY", "Laisser le champ vide pour dissocier la ".LANG_CLASSIFIED.".");
    //Allow classified to be associated with no owner listing
    define("LANG_LABEL_CLASSIFIED_ASSOCIATION", "Autoriser ".LANG_CLASSIFIED." être associé à aucun propriétaire ".LISTING_FEATURE_NAME);
    //This option is just valid when you are adding or editing a classified
    define("LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_CLASSIFIED_ASSOCIATION", "Cette option est juste valide lorsque vous ajoutez ou modifiez un ".LANG_CLASSIFIED);
    //Welcome back! It's always good to see you here again!
    define("LANG_LABEL_WELCOMEBACK", "Nous saluons le retour! C'est toujours bon de vous revoir ici!");
    //Sign up today and join our community!
    define("LANG_LABEL_SIGNUPTODAY", "Inscrivez-vous aujourd'hui et rejoignez notre communauté!");
    //Join us today and stay connected to businesses around the world.
    define("LANG_LABEL_JOINUSTODAY", "Rejoignez-nous aujourd'hui et restez connecté aux entreprises du monde entier.");
    //With a single login using your computer, tablet, phone or our app!
    define("LANG_LABEL_LOGINEXPLANATION", "Avec une connexion unique à l'aide de votre ordinateur, tablette, téléphone ou notre application!");
    //Oops, something wrong happened. Please try again or contact us.
	define("LANG_LABEL_ERRORLOGIN", "Oops, quelque chose de mal est arrivé. S'il vous plaît essayer de nouveau ou contactez-nous.");
