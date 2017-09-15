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
	# * FILE: /lang/es_es.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DATE/TIME
	# ----------------------------------------------------------------------------------------------------
	//january,february,march,april,may,june,july,august,september,october,november,december
	define("LANG_DATE_MONTHS", "enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre");
	//sunday,monday,tuesday,wednesday,thursday,friday,saturday
	define("LANG_DATE_WEEKDAYS", "domingo,lunes,martes,miércoles,jueves,viernes,sábado");
	//year
	define("LANG_YEAR", "año");
	//years
	define("LANG_YEAR_PLURAL", "años");
	//month
	define("LANG_MONTH", "mes");
	//months
	define("LANG_MONTH_PLURAL", "meses");
	//day
	define("LANG_DAY", "día");
	//days
	define("LANG_DAY_PLURAL", "días");
	//#,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z
	define("LANG_LETTERS", "#,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z");
	//y
	define("LANG_LETTER_YEAR", "a");
	//m
	define("LANG_LETTER_MONTH", "m");
	//d
	define("LANG_LETTER_DAY", "d");
	//Hour
	define("LANG_LABEL_HOUR", "Hora");
	//Minute
	define("LANG_LABEL_MINUTE", "Minuto");

	# ----------------------------------------------------------------------------------------------------
	# ZIPCODE
	# ----------------------------------------------------------------------------------------------------
	//ZIPCODE_UNIT - Available just for: mile or km
	define("ZIPCODE_UNIT", "km");
	//zipcode
	define("ZIPCODE_LABEL", "código postal");

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
	define("LANG_MENU_HOME", "Inicio");
	//Listings
	define("LANG_MENU_LISTING", "Listados");
	//Events
	define("LANG_MENU_EVENT", "Eventos");
	//Banners
	define("LANG_MENU_BANNER", "Banners");
	//Classifieds
	define("LANG_MENU_CLASSIFIED", "Clasificados");
	//Articles
	define("LANG_MENU_ARTICLE", "Artículos");
	//Deals
	define("LANG_MENU_PROMOTION", "Ofertas");
	//Blog
	define("LANG_MENU_BLOG", "Blog");
	//Advertise
	define("LANG_MENU_ADVERTISE", "Anunciante");
	//FAQ
	define("LANG_MENU_FAQ", "Preguntas");
	//Sitemap
	define("LANG_MENU_SITEMAP", "Mapa del sitio");
	//Contact Us
	define("LANG_MENU_CONTACT", "Contáctenos");
	//Enquire
	define("LANG_MENU_ENQUIRE", "Consulte ahora");
	//Tell us about your project
	define("LANG_MENU_ENQUIRE2", "Háblenos de su proyecto");
	//Find us on LinkedIn
	define("LANG_ALT_LINKEDIN", "Encuéntranos en LinkedIn");
	//Find us on Facebook
	define("LANG_ALT_FACEBOOK", "Encuéntranos en Facebook");
	//Like Us on Facebook
	define("LANG_LIKE_FACEBOOK", "Búscanos en Facebook");
	//Links
	define("LANG_LINKS", "Enlaces");
	//Contact
	define("LANG_FOOTER_CONTACT", "Contacto");
	//Twitter
	define("LANG_TWITTER", "Twitter");
	//Twitter Updates
	define("LANG_TWITTER_UPDATES", "Actualizaciones de Twitter");
	//Follow us on Twitter
	define("LANG_FOLLOW_US_TWITTER", "Síguenos en Twitter");
	//Follow Us
	define("LANG_FOLLOW_US", "Síguenos");
	//Send Us a message
    define("LANG_CONTACT_SENDMSG", "Envíenos un mensaje");
	//Site Content
    define("LANG_SITE_CONTENT", "Contenido del Sitio");
	//Learn More
	define("LANG_LABEL_LEARN_MORE", "Más Información");
	//Download our App
	define("LANG_LABEL_DOWNLOAD_APP", "Descarga nuestra <b>Aplicación</b>");

	# ----------------------------------------------------------------------------------------------------
	# JAVASCRIPT LANGUAGES VARIABLES
	# ----------------------------------------------------------------------------------------------------
	//Wait, Loading Category Tree...
	define("LANG_JS_LOADCATEGORYTREE", "Espere, cargando categorías...");
	//Wait, Loading Locations...
	define("LANG_JS_LOADLOCATIONTREE", "Espere, cargando ubicaciones...");
	//Loading...
	define("LANG_JS_LOADING", "Cargando...");
	//This item was added to your Favorites. You can view your Favorites in your profile page.
	define("LANG_JS_FAVORITEADD", "Este elemento ha sido añadido a tus favoritos.<br />Puedes ver tus favoritos en tu página de perfil.");
	//This item was removed from your Favorites.
	define("LANG_JS_FAVORITEDEL", "Este elemento fue eliminado de tus favoritos.");
	//weak
	define("LANG_JS_LABEL_WEAK", "bajo");
	//bad
	define("LANG_JS_LABEL_BAD", "malo");
	//good
	define("LANG_JS_LABEL_GOOD", "bueno");
	//strong
	define("LANG_JS_LABEL_STRONG", "fuerte");
	//There was a problem retrieving the XML data:
	define("LANG_JS_ACCOUNTSEARCH_PROBLEMRETRIEVING", "Hubo un problema al recuperar los datos XML:");
	//Click here to select an account.
	define("LANG_JS_ACCOUNTSEARCH_CLICKHERETOSELECT", "Haga clic aquí para seleccionar una cuenta");
	//Please provide at least a 3 letter word for the search!
	define("LANG_JS_ACCOUNTSEARCH_PLEASEPROVIDEATLEAST", "¡Escriba al menos una palabra de tres letras para la búsqueda!");
	//Server response failure!
	define("LANG_JS_ACCOUNTSEARCH_SERVERRESPONSEFAILURE", "¡Error de respuesta del servidor!");
	//Press ESC Key to close.
	define("LANG_JS_COLORPICKER_CLOSEMSG", "Pulse la tecla ESC para cerrar.");
	//Hide Map
	define("LANG_JS_LABEL_HIDEMAP", "Ocultar Mapa");
	//Show Map
	define("LANG_JS_LABEL_SHOWMAP", "Ver Mapa");
	//Show Graphics
	define("LANG_JS_LABEL_SHOWGRAPHICS", "Ver Gráficos");
	//Hide Graphics
	define("LANG_JS_LABEL_HIDEGRAPHICS", "Ocultar Gráficos");
	//This item was already added to your Favorites.<br />You can view your Favorites in your profile page.
	define("LANG_JS_FAVORITES_ADDED", "Este elemento esta ya fue agregado a tus favoritos.<br />Puedes ver tus favoritos en tu página de perfil.");
	//Wait...
	define("LANG_JS_WAIT", "Espere...");
	//Continue
	define("LANG_JS_CONTINUE", "Continuar");
	//Close
	define("LANG_JS_CLOSE", "Cerrar");
	//Add keyword
	define("LANG_JS_ADDKEYWORD", "Añadir palabras clave");
	//Add file
	define("LANG_JS_ADDFILE", "Añadir archivo");
	//Prev
	define("LANG_JS_PREV", "Anterior");
	//Next
	define("LANG_JS_NEXT", "Seguinte");
	//End Tour
	define("LANG_JS_END_TOUR", "Cerrar");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDES
	# ----------------------------------------------------------------------------------------------------
	//You are using an older version of Internet Explorer that may affect the full functionality of some features. We recommend you upgrade to a newer version of Internet Explorer.
	define("LANG_IE6_WARNING", "Usted está utilizando una versión anterior de Internet Explorer que puede afectar a la funcionalidad completa de algunas funciones. Le recomendamos que actualice a una versión más reciente de Internet Explorer.");
	//N/A
	define("LANG_NA", "N/D");
	//characters
	define("LANG_LABEL_CHARACTERES", "caracteres");
	//by
	define("LANG_BY", "por");
	//in
	define("LANG_IN", "en");
	//Read More
	define("LANG_READMORE", "Leer más");
	//More
	define("LANG_MORE", "más");
	//Browse by Category
	define("LANG_BROWSEBYCATEGORY", "Búsqueda por Categoría");
	//Browse by Location
	define("LANG_BROWSEBYLOCATION", "Búsqueda por Ubicación");
	//Browse by Rating
	define("LANG_BROWSEBYREVIEW", "Búsqueda por Calificacione");
	//Browse Listings
	define("LANG_BROWSELISTINGS", "Búsqueda por Listados");
	//Browse Events
	define("LANG_BROWSEEVENTS", "Búsqueda por Eventos");
	//Browse Classifieds
	define("LANG_BROWSECLASSIFIEDS", "Búsqueda por Clasificados");
	//Browse Articles
	define("LANG_BROWSEARTICLES", "Búsqueda por Artículos");
	//Browse Deals
	define("LANG_BROWSEPROMOTIONS", "Búsqueda por Ofertas");
	//Browse Posts
	define("LANG_BROWSEPOSTS", "Búsqueda por Entradas");
	//show
	define("LANG_SHOW", "ver");
	//hide
	define("LANG_HIDE", "ocultar");
	//Bill to
	define("LANG_BILLTO", "Facturar a");
	//Payable to
	define("LANG_PAYABLETO", "A favor de");
	//Issuing Date
	define("LANG_ISSUINGDATE", "Fecha de emisión");
	//Expire Date
	define("LANG_EXPIREDATE", "Fecha de vencimiento");
	//Questions
	define("LANG_QUESTIONS", "Preguntas");
	//Please call
	define("LANG_PLEASECALL", "Por Favor Llame");
	//Invoice Info
	define("LANG_INVOICEINFO", "Información de la factura");
	//Invoice Logo
	define("LANG_LABEL_INVOICELOGO", "Logo de la factura");
	//Payment Date
	define("LANG_PAYMENTDATE", "Fecha de pago");
	//None
	define("LANG_NONE", "Ninguna");
	//Custom Invoice
	define("LANG_CUSTOM_INVOICE", "Factura personalizada");
	//Custom Invoices
	define("LANG_CUSTOM_INVOICES", "Facturas personalizadas");
	//Locations
	define("LANG_LOCATIONS", "Ubicaciones");
	//Close
	define("LANG_CLOSE", "Cerrar");
	//Close this window
	define("LANG_CLOSEWINDOW", "Cerrar esta ventana");
	//from
	define("LANG_FROM", "de");
	//Transaction Info
	define("LANG_TRANSACTION_INFO", "Información de la transacción");
	//In manual transactions, subtotal and tax are not calculated.
	define("LANG_TRANSACTION_MANUAL", "En las transacciones manuales, subtotal y el impuesto no se calculan.");
	//creditcard
	define("LANG_CREDITCARD", "Tarjeta de Crédito");
	//Join Now!
	define("LANG_JOIN_NOW", "¡Únase ahora!");
	//Create Your Account
	define("LANG_JOIN_PROFILE", "Crea Tu Cuenta");
	//More Information
	define("LANG_MOREINFO", "Más información");
	//and
	define("LANG_AND", "y");
	//Keyword sample 1: "Auto Parts"
	define("LANG_KEYWORD_SAMPLE_1", "Autopartes");
	//Keyword sample 2: "Tires"
	define("LANG_KEYWORD_SAMPLE_2", "Neumáticos");
	//Keyword sample 3: "Engine Repair"
	define("LANG_KEYWORD_SAMPLE_3", "Reparación de motor");
	//Categories and sub-categories
	define("LANG_CATEGORIES_SUBCATEGS", "Categorías y subcategorías");
	//per
	define("LANG_PER", "por");
	//each
	define("LANG_EACH", "cada");
	//impressions block
	define("LANG_IMPRESSIONSBLOCK", "bloque de impresiones");
	//Add
	define("LANG_ADD", "Agregar");
	//Manage
	define("LANG_MANAGE", "Administrar");
	//impressions to my paid credit of
	define("LANG_IMPRESSIONPAIDOF", "impresiones a mi crédito pago de");
	//Section
	define("LANG_SECTION", "Sección");
	//General Pages
	define("LANG_GENERALPAGES", "Páginas generales");
	//Open in a new window
	define("LANG_OPENNEWWINDOW", "Abrir en una nueva ventana");
	//No
	define("LANG_NO", "No");
	//Yes
	define("LANG_YES", "Sí");
	//Dear
	define("LANG_DEAR", "Estimado");
	//Street Address, P.O. box
	define("LANG_ADDRESS_EXAMPLE", "Domicilio, casilla de correo");
	//Apartment, suite, unit, building, floor, etc.
	define("LANG_ADDRESS2_EXAMPLE", "Departamento, habitación, unidad, edificio, piso, etc.");
	//or
	define("LANG_OR", "o");
	//Hour of Work sample 1: "Sun 8:00 am - 6:00 pm"
	define("LANG_HOURWORK_SAMPLE_1", "Dom. de 08:00 a.m. a 06:00 p.m.");
	//Hour of Work sample 2: "Mon 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_2", "Lun. de 08:00 a.m. a 09:00 p.m.");
	//Hour of Work sample 3: "Tue 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_3", "Mar. de 08:00 a.m. a 09:00 p.m.");
	//Additional Information
	define("LANG_EXTRA_FIELDS", "Información Adicional");
	//Amenities
	define("LANG_TEMPLATE_AMENITIES", "Comodidades");
	//Sign me in automatically
	define("LANG_AUTOLOGIN", "Iniciar automáticamente");
	//Check / Uncheck All
	define("LANG_CHECK_UNCHECK_ALL", "Seleccionar/deseleccionar todo");
	//Billing Information
	define("LANG_BIILING_INFORMATION", "Información de Cuentas");
	//Listing
	define("LANG_BUSINESS", "Listado");
	//on Listing
	define("LANG_ON_LISTING", "en Listado");
	//on Event
	define("LANG_ON_EVENT", "en Evento");
	//on Banner
	define("LANG_ON_BANNER", "en Banner");
	//on Classified
	define("LANG_ON_CLASSIFIED", "en Clasificado");
	//on Article
	define("LANG_ON_ARTICLE", "en Artículo");
	//Listing Name
	define("LANG_LISTING_NAME", "Nombre del Listado");
	//Event Name
	define("LANG_EVENT_NAME", "Nombre del Evento");
	//Banner Name
	define("LANG_BANNER_NAME", "Nombre del Banner");
	//Classified Name
	define("LANG_CLASSIFIED_NAME", "Nombre del Clasificado");
	//Article Name
	define("LANG_ARTICLE_NAME", "Nombre del Artículo");
	//Frequently Asked Questions
	define("LANG_FAQ_NAME", "Preguntas Frecuentes");
	//How can we help you?
	define("LANG_FAQ_HELP", "¿Cómo podemos ayudarle?");
	//Enter a question, keyword, topic...
	define("LANG_FAQ_TIP", "Escriba una pregunta, palabra clave, tema...");
	//click to crop image
	define("LANG_CROPIMAGE", "haga clic para recortar la imagen");
	//Did not find your answer? Contact us.
	define("LANG_FAQ_CONTACT", "¿No encuentras la respuesta a su pregunta? Contáctenos.");
	//Active
	define("LANG_LABEL_ACTIVE", "Activo");
	//Suspended
	define("LANG_LABEL_SUSPENDED", "Suspendido");
	//Expired
	define("LANG_LABEL_EXPIRED", "Vencido");
	//Pending
	define("LANG_LABEL_PENDING", "Pendiente");
	//Received
	define("LANG_LABEL_RECEIVED", "Recibido");
	//Promotional Code
	define("LANG_LABEL_DISCOUNTCODE", "Código de Promoción");
	//Account
	define("LANG_LABEL_ACCOUNT", "Cuenta");
	//Change account
	define("LANG_LABEL_CHANGE_ACCOUNT", "Cambiar cuenta");
	//Name or Title
	define("LANG_LABEL_NAME_OR_TITLE", "Nombre o título");
	//Name
	define("LANG_LABEL_NAME", "Nombre");
	//First, Last
	define("LANG_LABEL_FIRST_LAST", "Primero, Último");
	//Page Name
	define("LANG_LABEL_PAGE_NAME", "Nombre de la página");
	//Summary Description
	define("LANG_LABEL_SUMMARY_DESCRIPTION", "Descripción breve");
	//Category
	define("LANG_LABEL_CATEGORY", "Categoría");
	//Sub-Category
	define("LANG_LABEL_SUBCATEGORY", "Sub-Categoría");
	//Category
	define("LANG_CATEGORY", "Categoría");
	//Categories
	define("LANG_LABEL_CATEGORY_PLURAL", "Categorías");
	//Categories
	define("LANG_CATEGORY_PLURAL", "Categorías");
	//Country
	define("LANG_LABEL_COUNTRY", "País");
	//Region
	define("LANG_LABEL_REGION", "Región");
	//State
	define("LANG_LABEL_STATE", "Estado");
	//City
	define("LANG_LABEL_CITY", "Ciudad");
	//Neighborhood
	define("LANG_LABEL_NEIGHBORHOOD", "Barrio");
	//Countries
	define("LANG_LABEL_COUNTRY_PL", "Países");
	//Regions
	define("LANG_LABEL_REGION_PL", "Regiones");
	//States
	define("LANG_LABEL_STATE_PL", "Estados");
	//Cities
	define("LANG_LABEL_CITY_PL", "Ciudades");
	//Neighborhoods
	define("LANG_LABEL_NEIGHBORHOOD_PL", "Barrios");
	//Add a New Region
	define("LANG_LABEL_ADD_A_NEW_REGION", "Añadir una nueva región");
	//Add a New State
	define("LANG_LABEL_ADD_A_NEW_STATE", "Añadir un nuevo estado");
	//Add a New City
	define("LANG_LABEL_ADD_A_NEW_CITY", "Añadir una nueva ciudad");
	//Add a New Neighborhood
	define("LANG_LABEL_ADD_A_NEW_NEIGHBORHOOD", "Añadir un nuevo barrio");
	//Choose an Existing Region
	define("LANG_LABEL_CHOOSE_AN_EXISTING_REGION", "Elige una región ya existente");
	//Choose an Existing State
	define("LANG_LABEL_CHOOSE_AN_EXISTING_STATE", "Elige un estado ya existente");
	//Choose an Existing City
	define("LANG_LABEL_CHOOSE_AN_EXISTING_CITY", "Elige una ciudad ya existente");
	//Choose an Existing Neighborhood
	define("LANG_LABEL_CHOOSE_AN_EXISTING_NEIGHBORHOOD", "Elige un barrio ya existente");
	//Top Countries
	define("LANG_LABEL_TOP_COUNTRY", "Principales Países");
	//Top Regions
	define("LANG_LABEL_TOP_REGION", "Principales Regiones");
	//Top States
	define("LANG_LABEL_TOP_STATE", "Principales Estados");
	//Top Cities
	define("LANG_LABEL_TOP_CITY", "Principales Ciudades");
	//Top Neighborhoods
	define("LANG_LABEL_TOP_NEIGHBORHOOD", "Principales Barrios");
	//No locations found.
	define("LANG_LABEL_NO_LOCATIONS_FOUND", "Ninguna ubicación encontrada");
	//Renewal
	define("LANG_LABEL_RENEWAL", "Renovación");
	//Renewal Date
	define("LANG_LABEL_RENEWAL_DATE", "Fecha de renovación");
	//Street Address
	define("LANG_LABEL_STREET_ADDRESS", "Domicilio");
	//Web Address
	define("LANG_LABEL_WEB_ADDRESS", "Dirección web");
	//Phone
	define("LANG_LABEL_PHONE", "Teléfono");
	//Fax
	define("LANG_LABEL_FAX", "Fax");
	//Long Description
	define("LANG_LABEL_LONG_DESCRIPTION", "Descripción extensa");
	//Status
	define("LANG_LABEL_STATUS", "Estado");
	//Level
	define("LANG_LABEL_LEVEL", "Nivel");
	//Empty
	define("LANG_LABEL_EMPTY", "Vacío");
	//Videos (Youtube etc)
	define("LANG_LABEL_VIDEOS", "Videos (Youtube etc)");
	//Additional Uploads (PDF, DOC, TXT, GIF or PNG)
	define("LANG_LABEL_ATTACH", "Cargas Adicionales (PDF, DOC, TXT, JPG, GIF, PNG)");
	//Facebook page
	define("LANG_LABEL_FBPAGE", "Página de Facebook");
	//Features
	define("LANG_LABEL_FEATURES", "Características");
	//Classified Price
	define("LANG_LABEL_CLASSIFIED_PRICE", "Precio Anuncio");
	//Event Time
	define("LANG_LABEL_EVENTTIME", "Hora del Evento");
	//Imagery
	define("LANG_LABEL_IMAGERY", "Imágenes");
	//Start Date
	define("LANG_LABEL_START_DATE", "Fecha de inicio");
	//Start Date
	define("LANG_LABEL_STARTDATE", "Fecha de inicio");
	//End Date
	define("LANG_LABEL_END_DATE", "Fecha de finalización");
	//End Date
	define("LANG_LABEL_ENDDATE", "Fecha de finalización");
	//Invalid date
	define("LANG_LABEL_INVALID_DATE", "Fecha no válida");
	//Start Time
	define("LANG_LABEL_START_TIME", "Hora de inicio");
	//End Time
	define("LANG_LABEL_END_TIME", "Hora de finalización");
	//Unlimited
	define("LANG_LABEL_UNLIMITED", "Sin límite");
	//Select
	define("LANG_LABEL_SELECT", "Seleccione");
	//Selected
	define("LANG_LABEL_SELECTED", "Seleccionado");
	//Select a Type
	define("LANG_LABEL_SELECT_TYPE", "Seleccione un tipo");
	//Select a Category
	define("LANG_LABEL_SELECT_CATEGORY", "Seleccione una categoría");
	//Time Left
	define("LANG_LABEL_TIMELEFT", "Tiempo Restante");
	//View Deal
	define("LANG_LABEl_VIEW_DEAL", "Ver Oferta");
	//No Deal
	define("LANG_LABEL_NO_PROMOTION", "No hay Oferta");
	//Select a Deal
	define("LANG_LABEL_SELECT_PROMOTION", "Seleccione un Oferta");
	//Great Offer!
	define("LANG_LABEL_GREAT_OFFER", "¡Gran Oferta!");
	//Contact Name
	define("LANG_LABEL_CONTACTNAME", "Nombre de Contacto");
	//Contact Name
	define("LANG_LABEL_CONTACT_NAME", "Nombre de Contacto");
	//Contact Phone
	define("LANG_LABEL_CONTACT_PHONE", "Teléfono de Contacto");
	//Contact Fax
	define("LANG_LABEL_CONTACT_FAX", "Fax de Contacto");
	//Contact E-mail
	define("LANG_LABEL_CONTACT_EMAIL", "Correo electrónico");
	//URL
	define("LANG_LABEL_URL", "URL");
	//Address
	define("LANG_LABEL_ADDRESS", "Dirección");
	//E-mail
	define("LANG_LABEL_EMAIL", "Correo electrónico");
	//Notify me about listing reviews and listing traffic
	define("LANG_LABEL_NOTIFY_TRAFFIC", "Avisame de las evaluaciones y el tráfico de las empresas.");
	//Invoice
	define("LANG_LABEL_INVOICE", "Factura");
	//Invoice #
	define("LANG_LABEL_INVOICENUMBER", "N. º de Factura");
	//Item
	define("LANG_LABEL_ITEM", "Elemento");
	//Items
	define("LANG_LABEL_ITEMS", "Elementos");
	//Extra Category
	define("LANG_LABEL_EXTRA_CATEGORY", "Categoría extra");
	//Discount Code
	define("LANG_LABEL_DISCOUNT_CODE", "Código de lo Oferta");
	//Item Price
	define("LANG_LABEL_ITEMPRICE", "Precio del Elemento");
	//Amount
	define("LANG_LABEL_AMOUNT", "Valor");
	//Tax
	define("LANG_LABEL_TAX", "Impuesto");
	//Subtotal
	define("LANG_LABEL_SUBTOTAL", "Total parcial");
	//Make checks payable to
	define("LANG_LABEL_MAKE_CHECKS_PAYABLE", "Emitir cheques a nombre de");
	//Total
	define("LANG_LABEL_TOTAL", "Total");
	//Id
	define("LANG_LABEL_ID", "Id.");
	//IP
	define("LANG_LABEL_IP", "IP");
	//Title
	define("LANG_LABEL_TITLE", "Nombre");
	//Caption
	define("LANG_LABEL_CAPTION", "Epígrafe");
	//impressions
	define("LANG_IMPRESSIONS", "impresiones");
	//Impressions
	define("LANG_LABEL_IMPRESSIONS", "Impresiones");
	//By impressions
	define("LANG_LABEL_BY_IMPRESSIONS", "Por impresiones");
	//By time period
	define("LANG_LABEL_BY_PERIOD", "Por período de tiempo");
	//Date
	define("LANG_LABEL_DATE", "Fecha");
	//Your E-mail
	define("LANG_LABEL_YOUREMAIL", "Su correo electrónico");
	//Subject
	define("LANG_LABEL_SUBJECT", "Asunto");
	//Additional message
	define("LANG_LABEL_ADDITIONALMSG", "Mensaje adicional");
	//Payment type
	define("LANG_LABEL_PAYMENT_TYPE", "Tipo de pago");
	//Notes
	define("LANG_LABEL_NOTES", "Notas");
	//It's easy and fast!
	define("LANG_LABEL_EASYFAST", "¡Es fácil y rápido!");
	//Write reviews, comment on blog
	define("LANG_LABEL_FOR_PROFILE", "Escribe calificaciones, comente en el blog");
	//Write reviews
	define("LANG_LABEL_FOR_PROFILE2", "Escribe calificaciones");
	//Based on
	define("LANG_LABEL_BASED_ON", "Basado en");
	//Write a review
	define("LANG_WRITE_REVIEW", "Escribe una calificacione");
	//Already have access?
	define("LANG_LABEL_ALREADYMEMBER", "¿Ya tiene acceso?");
	//Enjoy our services!
	define("LANG_LABEL_ENJOYSERVICES", "¡Disfrute nuestros servicios!");
	//Test Password
	define("LANG_LABEL_TESTPASSWORD", "Contraseña de Prueba");
	//Forgot your password?
	define("LANG_LABEL_FORGOTPASSWORD", "¿Olvidó su contraseña?");
	//Summary
	define("LANG_LABEL_SUMMARY", "Resumen");
	//Detail
	define("LANG_LABEL_DETAIL", "Detalle");
	//(your friend's e-mail)
	define("LANG_LABEL_FRIEND_EMAIL", "(e-mail de tu amigo)");
	//General Contact Form
	define("LANG_LABEL_GENERAL_FORM", "Formulario de Contacto General");
	//For
	define("LANG_LABEL_FOR", "Para");
	//Created
	define("LANG_LABEL_CREATED", "Creado");
	//From
	define("LANG_LABEL_FROM", "De");
	//To
	define("LANG_LABEL_TO", "A");
	//to
	define("LANG_LABEL_DATE_TO", "a");
	//Last
	define("LANG_LABEL_LAST", "último");
	//Last
	define("LANG_LABEL_LAST_PLURAL", "últimos");
	//day
	define("LANG_LABEL_DAY", "día");
	//days
	define("LANG_LABEL_DAYS", "días");
	//New
	define("LANG_LABEL_NEW", "Nuevo");
	//New FAQ
	define("LANG_LABEL_NEW_FAQ", "Nueva Pregunta Frecuente");
	//Type
	define("LANG_LABEL_TYPE", "Tipo");
	//ClickThru
	define("LANG_LABEL_CLICKTHRU", "Clic directo");
	//Added
	define("LANG_LABEL_ADDED", "Agregado");
    //Added on
    define("LANG_LABEL_ADDED_ON", "Agregado el");
    //There are no pending items.
    define("LANG_LABEL_NO_PENDING_ITEMS", "No hay elementos pendientes.");
    //There are no pending reviews.
    define("LANG_LABEL_NO_PENDING_REVIEWS", "Todavía no hay calificaciones pendientes.");
    //more
    define("LANG_LABEL_PLUS_REVIEWS", "más [X]");
	//rates this item with
    define("LANG_LABEL_REVIEW_RATES", "califica este [item] con");
    //Did you find this review helpful?
    define("LANG_LABEL_REVIEW_HELPFUL", "¿Te ha resultado útil esta calificacion?");
    //Blog Comment
    define("LANG_LAVEL_BLOG_COMMENT", "Comentario del Blog");
	//Post Title
	define("LANG_BLOG_TITLE", "Título del Post");
	//Add
	define("LANG_LABEL_ADD", "Agregar");
	//rating
	define("LANG_LABEL_RATING", "clasificación");
	//evaluator
	define("LANG_LABEL_EVALUATOR", "evaluador");
	//Reviewer
	define("LANG_LABEL_REVIEWER", "Critico");
	//System
	define("LANG_LABEL_SYSTEM", "Sistema");
	//Subscribe to RSS
	define("LANG_LABEL_SUBSCRIBERSS", "Suscripción a RSS");
	//Guide
	define("LANG_LABEL_GUIDE", "Guía");
	//Password strength
	define("LANG_LABEL_PASSWORDSTRENGTH", "Fortaleza de la contraseña");
	//Article Title
	define("LANG_ARTICLE_TITLE", "Nombre del Artículo");
	//SEO Description
	define("LANG_SEO_DESCRIPTION", "Descripción SEO ");
	//SEO Keywords
	define("LANG_SEO_KEYWORDS", "palabras clave SEO ");
	//No line breaks allowed
	define("LANG_SEO_LINEBREAK", "no se permite saltos de línea");
	//Separate elements with comma (,)
	define("LANG_SEO_COLON", "usar elementos separados por comas (,)");
	//Click here to edit the SEO information of this item
	define("LANG_MSG_CLICK_TO_EDIT_SEOCENTER", "Haga clic aquí para editar la información SEO de este elemento.");
	//SEO successfully updated!
	define("LANG_MSG_SEOCENTER_ITEMUPDATED", "¡SEO actualzado correctamente!");
	//Click here to view this article
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE", "Haga clic aquí para ver este artículo");
	//Click here to edit this article
	define("LANG_MSG_CLICK_TO_EDIT_THIS_ARTICLE", "Haga clic aquí para modificar este artículo");
	//Click here to view this article reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE_REPORTS", "Haga clic aquí para ver los informes de este artículo");
	//History for this article
	define("LANG_HISTORY_FOR_THIS_ARTICLE", "Historial de este artículo");
	//History not available for this article
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_ARTICLE", "No hay historial para este artículo");
	//Click here to delete this article
	define("LANG_MSG_CLICK_TO_DELETE_THIS_ARTICLE", "Haga clic aquí para eliminar este artículo");
	//Click here to view this banner
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER", "Haga clic aquí para ver este banner");
	//Click here to edit this banner
	define("LANG_MSG_CLICK_TO_EDIT_THIS_BANNER", "Haga clic aquí para modificar este banner");
	//Click here to view this banner reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER_REPORTS", "Haga clic aquí para ver los informes de este banner");
	//History for this banner
	define("LANG_HISTORY_FOR_THIS_BANNER", "Historial de este banner");
	//History not available for this banner
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_BANNER", "No hay historial para este banner");
	//Click here to delete this banner
	define("LANG_MSG_CLICK_TO_DELETE_THIS_BANNER", "Haga clic aquí para eliminar este banner");
	//Classified Title
	define("LANG_CLASSIFIED_TITLE", "Nombre del Clasificado");
	//Click here to
	define("LANG_MSG_CLICKTO", "Haga clic aquí para");
	//Click here to view this classified
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED", "Haga clic aquí para ver este clasificado");
	//Click here to edit this classified
	define("LANG_MSG_CLICK_TO_EDIT_THIS_CLASSIFIED", "Haga clic aquí para modificar este clasificado");
	//Click here to view this classified reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED_REPORTS", "Haga clic aquí para ver los informes de este clasificado");
	//Click here to map tuning this classified location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_CLASSIFIED", "Haga clic aquí para ajustar el mapa de ubicación de este clasificado");
	//Map tuning not available for this classified
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_CLASSIFIED", "No hay ajuste de mapa para este clasificado");
	//History for this classified
	define("LANG_HISTORY_FOR_THIS_CLASSIFIED", "Historial de este clasificado");
	//History not available for this classified
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_CLASSIFIED", "No hay historial para este clasificado");
	//Click here to delete this classified
	define("LANG_MSG_CLICK_TO_DELETE_THIS_CLASSIFIED", "Haga clic aquí para eliminar este clasificado");
	//Event Title
	define("LANG_EVENT_TITLE", "Nombre del Evento");
	//Click here to view this event
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT", "Haga clic aquí para ver este evento");
	//Click here to edit this event
	define("LANG_MSG_CLICK_TO_EDIT_THIS_EVENT", "Haga clic aquí para modificar este evento");
	//Click here to view this event reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT_REPORTS", "Haga clic aquí para ver los informes de este evento");
	//Click here to map tuning this event location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_EVENT", "Haga clic aquí para ajustar el mapa de ubicación de este evento");
	//Map tuning not available for this event
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_EVENT", "No hay ajuste de mapa para este evento");
	//History for this event
	define("LANG_HISTORY_FOR_THIS_EVENT", "Historial de este evento");
	//History not available for this event
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_EVENT", "No hay historial para este evento");
	//Click here to delete this event
	define("LANG_MSG_CLICK_TO_DELETE_THIS_EVENT", "Haga clic aquí para eliminar este evento");
	//Listing Title
	define("LANG_LISTING_TITLE", "Nombre del Listado");
	//Click here to view this listing
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING", "Haga clic aquí para ver este listado");
	//Click here to edit this listing
	define("LANG_MSG_CLICK_TO_EDIT_THIS_LISTING", "Haga clic aquí para modificar este listado");
	//Click here to change deal for this listing
	define("LANG_MSG_CLICK_TO_CHANGE_PROMOTION", "Haga clic aquí para cambiar la Oferta de este listado");
	//Deal not available for this listing
	define("LANG_MSG_PROMOTION_NOT_AVAILABLE", "La Oferta no está disponible para el listado");
	//Click here to view this listing reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING_REPORTS", "Haga clic aquí para ver los informes del listado");
	//Click here to map tuning this listing location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_LISTING", "Haga clic aquí para ajustar el mapa de ubicación del listado");
	//Map tuning not available for this listing
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_LISTING", "No hay ajuste de mapa para el listado");
	//Map tuning Address Not Found
	define("LANG_MAPTUNING_ADDRESSNOTFOUND", "No se encontró la dirección.");
	//Map tuning Please Edit Your Item
	define("LANG_MAPTUNING_PLEASEEDITYOURITEM", "Modifique el elemento.");
	//Click here to view this item reviews
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS", "Haga clic aquí para ver las calificaciones del elemento");
	//Item reviews not available
	define("LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE", "No hay calificaciones para este Elemento");
	//History for this listing
	define("LANG_HISTORY_FOR_THIS_LISTING", "Historial del listado");
	//History not available for this listing
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_LISTING", "No hay historial para el listado");
	//Click here to delete this listing
	define("LANG_MSG_CLICK_TO_DELETE_THIS_LISTING", "Haga clic aquí para eliminar el listado");
	//Save
	define("LANG_MSG_SAVE_CHANGES", "Guardar");
	//More Information
	define("LANG_MSG_MORE_INFO", "Más Información");
	//(Try to use something descriptive, like "10% off of our product" or "3 for the price of two on our product")
	define("LANG_MSG_DEALTITLE_TIP", "(Intenta usar algo descriptivo, como \"10% de descuento en nuestro producto\" o \"3 por el precio de dos en nuestro producto\")");
	//Enter the value of the item / service you are offering. Choose a discount type (Fixed Value or Percentage), and enter the respective value. Check the calculation and then provide us with the number of offers you wish to make.
	define("LANG_MSG_ADD_DEAL_TIP", "Introduzca el valor del artículo o servicio que usted ofrece. Elija un tipo de descuento (valor fijo o porcentaje), y entrar en el valor respectivo. Verifica en el cálculo y, a continuación nos proporcione el número de ofertas que desea hacer.");
	//Please be sure your image is the right size before you upload it, otherwise the image will likely be stretched to fit the site and image quality will be affected.
	define("LANG_MSG_ADD_DEAL_TIP2", "Por favor, asegúrese de que la imagen sea del tamaño adecuado antes de subirlo, de lo contrario la imagen es probable que se estira para ajustarse a la calidad del sitio y la imagen se verá afectada.");
	//Every deal needs to be linked to a listing in order to be active on the site.
	define("LANG_MS_MANGE_DEAL_TIP", "Cada oferta debe estar vinculada a un listado para poder estar activa en el sitio.");
	//Associate with the listing
	define("LANG_DEAL_LISTING_SELECT", "Asociar con el listado");
	//Please type your item title and wait for suggestions of available associations.
	define("LANG_DEAL_LISTING_TIP", "Por favor escriba el título de su artículo y espere sugerencias de asociaciones disponibles.");
	//Empty
	define("LANG_EMPTY", "Vaciar");
	//Cancel
	define("LANG_CANCEL", "Cancelar");
	//Custom Time Period
	define("LANG_SITEMGR_CUSTOMPERIOD", "Período de Tiempo Personalizado");
	//Fixed Value Discount
	define("LANG_LABEL_FIXEDVALUE_DISC", "Valor Fijo de Descuento");
	//Percentage Discount
	define("LANG_LABEL_PERCENTAGE_DISC", "Porcentaje de Descuento");
	//Value with Discount
	define("LANG_LABEL_DISC_AMOUNT", "Valor con Descuento");
	//Discount (Calculated)
	define("LANG_LABEL_DISC_CALCULATED", "Descuento (Calculado)");
	//How many deals would you like to offer
	define("LANG_LABEL_DEALS_OFFER", "¿Cuántas ofertas le gustaría ofrecer?");
	//Linked to Listing
	define("LANG_LABEL_ATTACHED_LISTING", "Vinculado al Listado");
	//Choose a Listing
	define("LANG_LABEL_CHOOSE_LISTING", "Elija un Listado");
	//You can not add different deals to the same listing.
	define("LANG_MSG_REPEATED_LISTINGS", "No se puede agregar ofertas diferentes para el mismo listado.");
	//Deals successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATE", "¡Ofertas actualizadas correctamente!");
	//Options
	define("LANG_LABEL_OPTIONS", "Opciones");
	//Deal Title
	define("LANG_PROMOTION_TITLE", "Nombre de la Oferta");
	//Click here to view this deal
	define("LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION", "Haga clic aquí para ver esta oferta");
	//Click here to edit this deal
	define("LANG_MSG_CLICK_TO_EDIT_THIS_PROMOTION", "Haga clic aquí para modificar esta oferta");
	//Click here to view this deal reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION_REPORTS", "Haga clic aquí para ver los informes de esta oferta");
	//Click here to delete this deal
	define("LANG_MSG_CLICK_TO_DELETE_THIS_PROMOTION", "Haga clic aquí para eliminar este Oferta");
	//Go to "Listings" and click on the deal icon belonging to the listing where you want to add the deal. Select one deal to add to your listing to make it live.
	define("LANG_PROMOTION_EXTRAMESSAGE", "Vaya a \"Listados\" y haga clic en el icono de Oferta que pertenece a el listado donde desea agregar la Oferta. Seleccione una Oferta para agregar a su listado y activarla.");
	//The installments will be recurring until your credit card expiration
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATION", "Los pagos recurrentes se reiterarán hasta el vencimiento de su Tarjeta de Crédito");
	//The installments will be recurring until your credit card expiration ("maximum of 36 installments")
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATIONMAXOF", "máximo de 36 pagos recurrentes");
	//SEO Center
	define("LANG_MSG_SEO_CENTER", "Centro de SEO");
	//View
	define("LANG_LABEL_VIEW", "Ver");
	//Edit
	define("LANG_LABEL_EDIT", "Modificar");
	//Traffic Reports
	define("LANG_TRAFFIC_REPORTS", "Informes de tráfico");
	//Unpaid
	define("LANG_LABEL_UNPAID", "Sin pagar");
	//Paid
	define("LANG_LABEL_PAID", "Pagado");
	//Waiting payment approval
	define("LANG_LABEL_WAITING", "Esperando la aprobación del pago");
	//Under review
	define("LANG_LABEL_ANALYSIS", "En proceso de revisión");
	//Available
	define("LANG_LABEL_AVAILABLE", "Disponible");
	//In dispute
	define("LANG_LABEL_DISPUTE", "En disputa");
	//Refunded
	define("LANG_LABEL_REFUNDED", "Reintegrado");
	//Cancelled
	define("LANG_LABEL_CANCELLED", "Cancelado");
	//Transaction
	define("LANG_LABEL_TRANSACTION", "Transacción");
	//Delete
	define("LANG_LABEL_DELETE", "Eliminar");
	//Download
	define("LANG_LABEL_DOWNLOAD", "Descargar");
	//Map Tuning
	define("LANG_LABEL_MAP_TUNING", "Ajuste de mapa");
	//Hide Map
	define("LANG_LABEL_HIDEMAP", "Ocultar Mapa");
	//Show Map
	define("LANG_LABEL_SHOWMAP", "Ver Mapa");
	//SEO
	define("LANG_LABEL_SEO_TUNING", "SEO");
	//Print
	define("LANG_LABEL_PRINT", "Imprimir");
	//Pending Approval
	define("LANG_LABEL_PENDING_APPROVAL", "Aprobación pendiente");
	//Image
	define("LANG_LABEL_IMAGE", "Imagen");
	//Images
	define("LANG_LABEL_IMAGE_PLURAL", "Imágenes");
	//Required field
	define("LANG_LABEL_REQUIRED_FIELD", "Campo requerido");
	//Please type all the required fields.
	define("LANG_LABEL_TYPE_FIELDS", "Por favor escriba todos los campos obligatorios.");
	//Account Information
	define("LANG_LABEL_ACCOUNT_INFORMATION", "Informaciones de la Cuenta");
	//E-mail
	define("LANG_LABEL_USERNAME", "Correo Electronico");
    //Username
	define("LANG_LABEL_USERNAME2", "Nombre de usuario");
	//Current Password
	define("LANG_LABEL_CURRENT_PASSWORD", "Contraseña actual");
	//Password
	define("LANG_LABEL_PASSWORD", "Contraseña");
	//Password not changed.
	define("LANG_PASSWORD_NOT_CHANGED", "Contraseña no cambiada.");
	//Create Password
	define("LANG_LABEL_CREATE_PASSWORD", "Crear contraseña");
    //New Password
	define("LANG_LABEL_NEW_PASSWORD", "Nueva contraseña");
    //Retype Password
	define("LANG_LABEL_RETYPE_PASSWORD", "Repetir contraseña");
	//Retype Password
	define("LANG_LABEL_RETYPEPASSWORD", "Repetir contraseña");
	//Retype New Password
	define("LANG_LABEL_RETYPE_NEW_PASSWORD", "Repetir nueva contraseña");
    //OpenID URL
	define("LANG_LABEL_OPENIDURL", "OpenID URL");
	//Information
	define("LANG_LABEL_INFORMATION", "Información");
	//Publication Date
	define("LANG_LABEL_PUBLICATION_DATE", "Fecha de publicación");
	//Calendar
	define("LANG_LABEL_CALENDAR", "Calendario");
	//Friendly Url
	define("LANG_LABEL_FRIENDLY_URL", "URL semántica");
	//For example
	define("LANG_LABEL_FOR_EXAMPLE", "Por ejemplo");
	//Image Source
	define("LANG_LABEL_IMAGE_SOURCE", "Origen de la imagen");
	//Image Attribute
	define("LANG_LABEL_IMAGE_ATTRIBUTE", "Atributo de la imagen");
	//Image Caption
	define("LANG_LABEL_IMAGE_CAPTION", "Epígrafe de la imagen");
	//Abstract
	define("LANG_LABEL_ABSTRACT", "Resumen");
	//Keywords for the search
	define("LANG_LABEL_KEYWORDS_FOR_SEARCH", "Palabras clave para la búsqueda");
	//Refine By...
	define("LANG_LABEL_REFINEBY", "Filtrar Por...");
	//You refined by...
	define("LANG_LABEL_REFINEDBY", "Usted filtro por ...");
	//Remove all
	define("LANG_LABEL_REMOVE_ALL", "Retire todo");
	//Show only listings with deals
	define("LANG_LABEL_FILTER_DEAL", "Mostrar sólo los listados con oferta");
	//maximum
	define("LANG_LABEL_MAX", "máx.");
	//keywords
	define("LANG_LABEL_KEYWORDS", "palabras clave");
	//Content
	define("LANG_LABEL_CONTENT", "Contenido");
	//Code
	define("LANG_LABEL_CODE", "Código");
	//free
	define("LANG_FREE", "GRATIS");
	//free
	define("LANG_LABEL_FREE", "gratis");
	//free
	define("LANG_INCLUDED", "incluidas");
	//Destination Url
	define("LANG_LABEL_DESTINATION_URL", "URL de destino");
	//Script
	define("LANG_LABEL_SCRIPT", "Secuencia de comandos");
	//File
	define("LANG_LABEL_FILE", "Archivo");
	//Warning
	define("LANG_LABEL_WARNING", "Advertencia");
	//Display URL (optional)
	define("LANG_LABEL_DISPLAY_URL", "Mostrar URL (opcional)");
	//Visit Website
	define("LANG_VISIT_WEBSITE", "Sitio web");
	//Description line 1
	define("LANG_LABEL_DESCRIPTION_LINE1", "Línea de descripción 1");
	//Description line 2
	define("LANG_LABEL_DESCRIPTION_LINE2", "Línea de descripción 2");
	//Location
	define("LANG_LABEL_LOCATIONS", "Ubicación");
	//Enter a landmark or point of reference for your listing's location.
	define("LANG_LABEL_LOCATIONS_TIP", "Utilice este campo para introducir una referencia de ubicación de su artículo");
	//Would you like to add more information about your item? Besides your gallery images, you can upload an additional file with extra information here
	define("LANG_LABEL_ATTACH_ADDITIONAL_FILE_TIP", "¿Quieres agregar más información acerca de su artículo? Además de su galería de imágenes, puede cargar un archivo adicional con la información extra aquí");
	//Fill in this field if your URL is too long. Example: "www.example.com" can be shown as "Example".
	define("LANG_LABEL_DISPLAY_URL_TIP", "Rellene este campo si el URL es demasiado largo. Ejemplo: \"www.ejemplo.com\" se puede mostrar como \"Ejemplo\".");
	//Enable monthly e-mail to listing owners that includes their stats and reviews.
	define("LANG_LABEL_NOTIFY_TRAFFIC_TIP", "Habilitar correo electrónico mensual a los propietarios de listado que incluye sus estadísticas y comentarios.");
	//Sponsors have access to the members area and can create items. They can also create their own personal pages.
	define("LANG_LABEL_SPONSOR_TIP", "Los anunciantes tienen acceso a la zona de miembros y pueden crear artículos. También pueden crear sus propias páginas personales.");
	//Visitors can visit your frontend pages, write reviews, comment on blog and view other user's personal page. Visitors can upgrade their accounts by adding an item through the advertise process.
	define("LANG_LABEL_PROFILE_TIP", "Los visitantes pueden visitar sus páginas frontend, escribir comentarios, comentarios en el blog y ver la página personal de otro usuario. Los visitantes pueden actualizar sus cuentas mediante la adición de un artículo a través del proceso de publicidad.");
	//Address (optional)
	define("LANG_LABEL_ADDRESS_OPTIONAL", "Dirección (opcional)");
	//Address (Optional)
	define("LANG_LABEL_ADDRESSOPTIONAL", "Dirección (opcional)");
	//Detail Description
	define("LANG_LABEL_DETAIL_DESCRIPTION", "Descripción detallada");
	//Price
	define("LANG_LABEL_PRICE", "Precio");
	//Prices
	define("LANG_LABEL_PRICE_PLURAL", "Precios");
	//Contact Information
	define("LANG_LABEL_CONTACT_INFORMATION", "Información de contacto");
	//Language
	define("LANG_LABEL_LANGUAGE", "Idioma");
	//Select your main language to contact (when necessary).
	define("LANG_LABEL_LANGUAGETIP", "Seleccione su idioma principal de contacto (cuando sea necesario).");
	//First Name
	define("LANG_LABEL_FIRST_NAME", "Nombre");
	//First Name
	define("LANG_LABEL_FIRSTNAME", "Nombre");
	//Last Name
	define("LANG_LABEL_LAST_NAME", "Apellido");
	//Last Name
	define("LANG_LABEL_LASTNAME", "Apellido");
	//Company
	define("LANG_LABEL_COMPANY", "Empresa");
	//Address
	define("LANG_LABEL_ADDRESS1", "Dirección");
	//Address 2
	define("LANG_LABEL_ADDRESS2", "Dirección 2");
	//Latitude
	define("LANG_LABEL_LATITUDE", "Latitud");
	//Longitude
	define("LANG_LABEL_LONGITUDE", "Longitud");
	//Not found. Please, try to specify better your location.
	define("LANG_LABEL_MAP_NOTFOUND", "No se ha encontrado. Por favor, intente especificar mejor su ubicación.");
	//The following fields contain errors:
	define("LANG_LABEL_MAP_ERRORS", "Los siguientes campos contienen errores:");
	//Latitude must be a number between -90 and 90.
	define("LANG_LABEL_MAP_INVALID_LAT", "La latitud debe ser un número entre -90 y 90.");
	//Longitude must be a number between -180 and 180.
	define("LANG_LABEL_MAP_INVALID_LON", "Longitud debe ser un número entre -180 y 180.");
	//Venue
	define("LANG_LABEL_LOCATION_NAME", "Nombre del lugar");
	//Event Date
	define("LANG_LABEL_EVENT_DATE", "Fecha del Evento");
	//Description
	define("LANG_LABEL_DESCRIPTION", "Descripción");
	//Help Information
	define("LANG_LABEL_HELP_INFORMATION", "Información de ayuda");
	//Text
	define("LANG_LABEL_TEXT", "Texto");
	//Add Image
	define("LANG_LABEL_ADDIMAGE", "Agregar imagen");
	//Add Image
	define("LANG_LABEL_ADDIMAGES", "Agregar imagen");
	//Edit Image Captions
	define("LANG_LABEL_EDITIMAGECAPTIONS", "Modificar epígrafes de la imagen");
	//Image File
	define("LANG_LABEL_IMAGEFILE", "Archivo de imagen");
	//Thumb Caption
	define("LANG_LABEL_THUMBCAPTION", "Epígrafe de la imagen miniatura");
	//Image Caption
	define("LANG_LABEL_IMAGECAPTION", "Epígrafe de la imagen");
	//Video Snippet Code
	define("LANG_LABEL_VIDEO_SNIPPET_CODE", "Fragmento de código de video");
	//Attach Additional File
	define("LANG_LABEL_ATTACH_ADDITIONAL_FILE", "Adjuntar archivo adicional");
	//Attach Menu
	define("LANG_LABEL_ATTACH_MENU", "Adjuntar Menú");
	//Menu
	define("LANG_LABEL_MENU", "Menú");
    //Good to know
    define("LANG_LABEL_GOODKNOW", "Bueno saber");
    //Make a reservation
    define("LANG_LABEL_RESERVATION", "Hacer una reservacion");
	//Attention
	define("LANG_LABEL_ATTENTION", "Atención");
	//Source
	define("LANG_LABEL_SOURCE", "Origen");
	//Hours
	define("LANG_LABEL_HOURS_OF_WORK", "Horas de trabajo");
	//Default
	define("LANG_LABEL_DEFAULT", "Valor predeterminado");
	//Payment Method
	define("LANG_LABEL_PAYMENT_METHOD", "Forma de pago");
    //How do you want to pay us?
    define("LANG_LABEL_PAYMENT_METHOD_TIP", "¿Cómo desea pagar?");
	//By Credit Card
	define("LANG_LABEL_BY_CREDIT_CARD", "Con Tarjeta de Crédito");
	//By PayPal
	define("LANG_LABEL_BY_PAYPAL", "Con PayPal");
	//By SimplePay
	define("LANG_LABEL_BY_SIMPLEPAY", "Con SimplePay");
	//By Pagseguro
	define("LANG_LABEL_BY_PAGSEGURO", "Con Pagseguro");
	//Print Invoice and Mail a Check
	define("LANG_LABEL_PRINT_INVOICE_AND_MAIL_CHECK", "Imprimir Factura y enviar un Cheque por Correo");
	//Headline
	define("LANG_LABEL_HEADLINE", "Título");
	//Offer
	define("LANG_LABEL_OFFER", "Oferta");
	//Conditions
	define("LANG_LABEL_CONDITIONS", "Condiciones");
	//Deal Dates
	define("LANG_LABEL_PROMOTION_DATE", "Fechas de la oferta");
	//Deal Layout
	define("LANG_LABEL_PROMOTION_LAYOUT", "Imagen de la oferta");
	//You pay
	define("LANG_LABEL_PROMOTION_PAY", "Usted paga");
	//Time left to buy
	define("LANG_LABEL_PROMOTION_TIMELEFT", "Tiempo restante para comprar");
	//Printable Deal
	define("LANG_LABEL_PRINTABLE_PROMOTION", "Oferta imprimible");
	//Our HTML template based deal
	define("LANG_LABEL_OUR_HTML_TEMPLATE_BASED", "Nuestra Oferta basada en una plantilla HTML");
	//Fill in the fields above and insert a logo or other image (JPG or GIF)
	define("LANG_LABEL_FILL_FIELDS_ABOVE", "Complete los campos anteriores e inserte un logo u otra imagen (JPG o GIF)");
	//A deal provided by you instead
	define("LANG_LABEL_PROMOTION_PROVIDED_BY_YOU", "Una Oferta proporcionada por usted");
	//JPG or GIF image
	define("LANG_LABEL_JPG_GIF_IMAGE", "Imagen JPG o GIF");
	//Comment Title
	define("LANG_LABEL_COMMENTTITLE", "Título");
	//Comment
	define("LANG_LABEL_COMMENT", "Comentario");
	//Accepted
	define("LANG_LABEL_ACCEPTED", "Aceptado");
	//Approved
	define("LANG_LABEL_APPROVED", "Aprobado");
	//Success
	define("LANG_LABEL_SUCCESS", "Éxito");
	//Completed
	define("LANG_LABEL_COMPLETED", "Completo");
	//Y
	define("LANG_LABEL_Y", "S");
	//Failed
	define("LANG_LABEL_FAILED", "Fallo");
	//Declined
	define("LANG_LABEL_DECLINED", "Declinado");
	//failure
	define("LANG_LABEL_FAILURE", "fallo");
	//Canceled
	define("LANG_LABEL_CANCELED", "Cancelado");
	//Error
	define("LANG_LABEL_ERROR", "Error");
	//Transaction Code
	define("LANG_LABEL_TRANSACTION_CODE", "Código de la transacción");
	//Subscription ID
	define("LANG_LABEL_SUBSCRIPTION_ID", "Identificador de la suscripción");
	//transaction history
	define("LANG_LABEL_TRANSACTION_HISTORY", "historial de transacciones");
	//Authorization Code
	define("LANG_LABEL_AUTHORIZATION_CODE", "Código de autorización");
	//Transaction Status
	define("LANG_LABEL_TRANSACTION_STATUS", "Estado de la transacción");
	//Transaction Error
	define("LANG_LABEL_TRANSACTION_ERROR", "Error en la transacción");
	//Monthly Bill Amount
	define("LANG_LABEL_MONTHLY_BILL_AMOUNT", "Valor de las cuentas mensuales");
	//Transaction OID
	define("LANG_LABEL_TRANSACTION_OID", "OID de la transacción");
	//Yearly Bill Amount
	define("LANG_LABEL_YEARLY_BILL_AMOUNT", "Importe Anual");
	//Bill Amount
	define("LANG_LABEL_BILL_AMOUNT", "Monto de la factura");
	//Transaction ID
	define("LANG_LABEL_TRANSACTION_ID", "Identificador de la transacción");
	//Receipt ID
	define("LANG_LABEL_RECEIPT_ID", "Identificador del recibo");
	//Subscribe ID
	define("LANG_LABEL_SUBSCRIBE_ID", "Identificador de la suscripción");
	//Transaction Order ID
	define("LANG_LABEL_TRANSACTION_ORDERID", "Identificador de la transacción del pedido");
	//your
	define("LANG_LABEL_YOUR", "su");
	//Make Your
	define("LANG_LABEL_MAKE_YOUR", "Haga su");
	//Payment
	define("LANG_LABEL_PAYMENT", "Pago");
	//History
	define("LANG_LABEL_HISTORY", "Historial");
	//Log in
	define("LANG_LABEL_LOGIN", "Inicio de sesión");
	//Transaction canceled
	define("LANG_LABEL_TRANSACTION_CANCELED", "Se canceló la transacción");
	//Transaction amount
	define("LANG_LABEL_TRANSACTION_AMOUNT", "Valor de la transacción");
	//Pay
	define("LANG_LABEL_PAY", "Pagar");
	//Back
	define("LANG_LABEL_BACK", "Volver");
	//Total Price
	define("LANG_LABEL_TOTAL_PRICE", "Precio total");
	//Pay By Invoice
	define("LANG_LABEL_PAY_BY_INVOICE", "Pagar con Factura");
	//Administrator
	define("LANG_LABEL_ADMINISTRATOR", "Administrador");
	//Billing Info
	define("LANG_LABEL_BILLING_INFO", "Información de Facturacion");
	//Card Number
	define("LANG_LABEL_CARD_NUMBER", "Número de Tarjeta");
	//Card Expire date
	define("LANG_LABEL_CARD_EXPIRE_DATE", "Fecha de vencimiento de la Tarjeta");
	//Card Code
	define("LANG_LABEL_CARD_CODE", "Código de la Tarjeta");
	//Customer Info
	define("LANG_LABEL_CUSTOMER_INFO", "Información del Cliente");
	//zip
	define("LANG_LABEL_ZIP", "código postal");
	//Place Order and Continue
	define("LANG_LABEL_PLACE_ORDER_CONTINUE", "Ordenar y continuar");
	//General Information
	define("LANG_LABEL_GENERAL_INFORMATION", "Información General");
	//Phone Number
	define("LANG_LABEL_PHONE_NUMBER", "Número de Teléfono");
	//E-mail Address
	define("LANG_LABEL_EMAIL_ADDRESS", "Dirección de Correo Electrónico");
	//Credit Card Information
	define("LANG_LABEL_CREDIT_CARD_INFORMATION", "Información de la Tarjeta de Crédito");
	//Exp. Date
	define("LANG_LABEL_EXP_DATE", "Fecha de Vencimiento");
	//Customer Information
	define("LANG_LABEL_CUSTOMER_INFORMATION", "Información del Cliente");
	//Card Expiration
	define("LANG_LABEL_CARD_EXPIRATION", "Vencimiento de la Tarjeta");
	//Name on Card
	define("LANG_LABEL_NAME_ON_CARD", "Nombre que figura en la Tarjeta");
	//Card Type
	define("LANG_LABEL_CARD_TYPE", "Tipo de Tarjeta");
	//Card Verification Number
	define("LANG_LABEL_CARD_VERIFICATION_NUMBER", "Número de Verificación de la Tarjeta");
	//Province
	define("LANG_LABEL_PROVINCE", "Provincia");
	//Postal Code
	define("LANG_LABEL_POSTAL_CODE", "Código Postal");
	//Post Code
	define("LANG_LABEL_POST_CODE", "Código Postal");
	//Tel
	define("LANG_LABEL_TEL", "Tel.");
	//Select Date
	define("LANG_LABEL_SELECTDATE", "Seleccionar fecha");
	//Found
	define("LANG_PAGING_FOUND", "Se encontró");
	//Found
	define("LANG_PAGING_FOUND_PLURAL", "Se encontraron");
	//record
	define("LANG_PAGING_RECORD", "registro");
	//records
	define("LANG_PAGING_RECORD_PLURAL", "registros");
	//Showing page
	define("LANG_PAGING_SHOWINGPAGE", "Mostrando página");
	//of
	define("LANG_PAGING_PAGEOF", "de");
	//pages
	define("LANG_PAGING_PAGE_PLURAL", "páginas");
	//Go to page
	define("LANG_PAGING_GOTOPAGE", "Ir a la página");
	//Select
	define("LANG_PAGING_ORDERBYPAGE_SELECT", "Seleccione");
	//Order by
	define("LANG_PAGING_ORDERBYPAGE", "Ordenar por");
	//Characters
	define("LANG_PAGING_ORDERBYPAGE_CHARACTERS", "Caracteres");
    //Alphabetically
    define("LANG_PAGING_ORDERBYPAGE_ALPHABETICALLY", "Alfabéticamente");
	//Last update
	define("LANG_PAGING_ORDERBYPAGE_LASTUPDATE", "Actualización");
	//Date created
	define("LANG_PAGING_ORDERBYPAGE_DATECREATED", "Fecha de creación");
	//Popular
	define("LANG_PAGING_ORDERBYPAGE_POPULAR", "Popular");
	//Rating
	define("LANG_PAGING_ORDERBYPAGE_RATING", "Calificación");
	//Price
	define("LANG_PAGING_ORDERBYPAGE_PRICE", "Precio");
	//Start Date
	define("LANG_PAGING_ORDERBYPAGE_STARTDATE", LANG_LABEL_START_DATE);
	//previous page
	define("LANG_PAGING_PREVIOUSPAGE", "página anterior");
	//next page
	define("LANG_PAGING_NEXTPAGE", "página siguiente");
	//"previous" page
	define("LANG_PAGING_PREVIOUSPAGEMOBILE", "anterior");
	//"next" page
	define("LANG_PAGING_NEXTPAGEMOBILE", "siguiente");
	//view full listing
	define("LANG_VIEW_LISTING", "ver listado completo");
	//view full article
	define("LANG_VIEW_ARTICLE", "ver artículo completo");
	//Go to Website
	define("LANG_GO_TO_WEBSITE", "Ir al Sitio Web");
	//Article successfully added!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_ADDED", "¡El Artículo se agregó correctamente !");
	//Banner successfully added!
	define("LANG_MSG_BANNER_SUCCESSFULLY_ADDED", "¡El Banner se agregó correctamente !");
	//Classified successfully added!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_ADDED", "¡El Anuncio Clasificado se agregó correctamente !");
	//Event successfully added!
	define("LANG_MSG_EVENT_SUCCESSFULLY_ADDED", "¡El Evento se agregó correctamente !");
	//Listing successfully added!
	define("LANG_MSG_LISTING_SUCCESSFULLY_ADDED", "¡El Listado se agregó correctamente");
	//Deal successfully added!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_ADDED", "¡La Oferta se agregó correctamente!");
	//Article successfully updated!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_UPDATED", "¡El Artículo se actualizó correctamente!");
	//Banner successfully updated!
	define("LANG_MSG_BANNER_SUCCESSFULLY_UPDATED", "¡El Banner se actualizó correctamente!");
	//Classified successfully updated!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_UPDATED", "¡El Anuncio Clasificado se actualizó correctamente!");
	//Event successfully updated!
	define("LANG_MSG_EVENT_SUCCESSFULLY_UPDATED", "¡El Evento se actualizó correctamente!");
	//Listing successfully updated!
	define("LANG_MSG_LISTING_SUCCESSFULLY_UPDATED", "¡El Listado se actualizó correctamente!");
	//Deal successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATED", "¡La Oferta se actualizó correctamente!");
	//Map Tuning successfully updated!
	define("LANG_MSG_MAPTUNING_SUCCESSFULLY_UPDATED", "¡Se actualizó correctamente el Ajuste de mapa!");
	//Deal was successfully deleted!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_DELETED", "¡La Oferta se ha eliminado con éxito!");
	//Deal successfully changed!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_CHANGED", "¡Se modificó la Oferta correctamente!");
	//Banner successfully deleted!
	define("LANG_MSG_BANNER_SUCCESSFULLY_DELETED", "¡El Banner se eliminó correctamente!");
	//Invalid image type. Please insert a JPG, GIF or PNG image.
	define("LANG_MSG_INVALID_IMAGE_TYPE", "Tipo de imagen no válido. Por favor inserte una imagen JPG, GIF o PNG.");
	//Invalid file type. Please insert a SWF, GIF, JPEG or PNG file.
	define("LANG_MSG_INVALID_FILE_TYPE", "Tipo de archivo no válido. Por favor, inserte un archivo SWF, GIF, JPEG o PNG.");
	//The image file is too large
	define("LANG_MSG_IMAGE_FILE_TOO_LARGE", "El archivo de imagen es demasiado grande.");
	//Please try again with another image
	define("LANG_PLEASE_TRY_AGAIN_WITH_ANOTHER_IMAGE", "Por favor, inténtelo de nuevo con otra imagen.");
	//Attached file was denied. Invalid file type.
	define("LANG_MSG_ATTACHED_FILE_DENIED", "Se rechazó el archivo adjunto. Tipo de archivo no válido.");
	//Please type your username.
	define("LANG_MSG_TYPE_USERNAME", "Escriba su nombre de usuario.");
	//Username was not found.
	define("LANG_MSG_USERNAME_WAS_NOT_FOUND", "No se encontró el nombre de usuario.");
	//Please try again or contact support at:
	define("LANG_MSG_TRY_AGAIN_OR_CONTACT_SUPPORT", "Intente nuevamente o póngase en contacto con el departamento de soporte en:");
	//System Forgotten Password is disabled.
	define("LANG_MSG_FORGOTTEN_PASSWORD_DISABLED", "El sistema de contraseña olvidada está desactivado.");
	//Please contact support at:
	define("LANG_MSG_CONTACT_SUPPORT", "Póngase en contacto con el departamento de soporte en:");
	//Thank you!
	define("LANG_MSG_THANK_YOU", "¡Gracias!");
	//An e-mail was sent to the account holder with instructions to obtain a new password
	define("LANG_MSG_EMAIL_WAS_SENT_TO_ACCOUNT_HOLDER", "Se envió un mensaje de correo electrónico al titular de la cuenta con instrucciones de como obtener una nueva contraseña");
	//File not found!
	define("LANG_MSG_FILE_NOT_FOUND", "¡No se encontró el archivo!");
	//Click here to print the invoice
	define("LANG_MSG_CLICK_TO_PRINT_INVOICE", "Haga clic aquí para imprimir la factura");
	//Click here to view the invoice detail
	define("LANG_MSG_CLICK_TO_VIEW_INVOICE_DETAIL", "Haga clic aquí para ver el detalle de la factura");
	//(prices amount are per installments)
	define("LANG_MSG_PRICES_AMOUNT_PER_INSTALLMENTS", "(el monto de los precios es por pagos)");
	//Unpaid Item
	define("LANG_MSG_UNPAID_ITEM", "Elemento sin pagar");
	//No Check Out Needed
	define("LANG_MSG_NO_CHECKOUT_NEEDED", "No se necesita pagar");
	//(Move the mouse over the bars to see more details about the graphic)
	define("LANG_MSG_MOVE_MOUSEOVER_THE_BARS", "(Pase el mouse sobre las barras para ver más detalles sobre el gráfico)");
	//(Click the report type to display graph)
	define("LANG_MSG_CLICK_REPORT_TYPE", "(Haga clic en el tipo de informe para mostrar el gráfico)");
	//Click here to view this review
	define("LANG_MSG_CLICK_TO_VIEW_THIS_REVIEW", "Haga clic aquí para ver esta calificación");
	//Click here to edit this review
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REVIEW", "Haga clic aquí para modificar esta calificación");
	//Click here to edit this reply
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REPLY", "Haga clic aquí para modificar esta respuesta");
	//Click here to delete this review
	define("LANG_MSG_CLICK_TO_DELETE_THIS_REVIEW", "Haga clic aquí para eliminar esta calificación");
	//Waiting Site Manager approve
	define("LANG_MSG_WAITINGSITEMGRAPPROVE", "Esperando la Aprobación del Administrador Del Sitio");
	//Waiting Site Manager approve for Review
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW", "Esperando la Aprobación del Administrador Del Sitio para la Calificación");
	//Waiting Site Manager approve for Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REPLY", "Esperando la Aprobación del Administrador Del Sitio para la Respuesta");
	//Waiting Site Manager approve for Review Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW_REPLY", "Esperando la Aprobación del Administrador Del Sitio para la Calificación y Respuesta");
	//Review already approved
	define("LANG_MSG_REVIEW_ALREADY_APPROVED", "La Calificación ya está Aprobada");
	//Review and Reply already approved
	define("LANG_MSG_REVIEWANDREPLY_ALREADY_APPROVED", "Calificación y Respuesta ya Aprobadas");
	//Review pending approval
	define("LANG_REVIEW_PENDINGAPPROVAL", "Calificación en Espera de Aprobación");
	//Reply pending approval
	define("LANG_REPLY_PENDINGAPPROVAL", "Respuesta en Espera de Aprobación");
	//Review active
	define("LANG_REVIEW_ACTIVE", "Calificación Activa");
	//Reply active
	define("LANG_REPLY_ACTIVE", "Respuesta Activa");
	//Review and Reply pending approval
	define("LANG_REVIEWANDREPLY_PENDINGAPPROVAL", "Calificación y Respuesta en Espera de Aprobación");
	//Review and Reply active
	define("LANG_REVIEWANDREPLY_ACTIVE", "Calificar y Responder Activos");
	//Reply
	define("LANG_REPLY", "Responder");
	//Reply (noun)
	define("LANG_REPLYNOUN", "Respuesta");
	//Review and Reply
	define("LANG_REVIEWANDREPLY", "Calificar y Responder");
	//Edit Review
	define("LANG_LABEL_EDIT_REVIEW", "Editar Calificación");
	//Edit Reply
	define("LANG_LABEL_EDIT_REPLY", "Editar Respuesta");
	//Approve Review
	define("LANG_SITEMGR_APPROVE_REVIEW", "Aprobar Calificación");
	//Approve Reply
	define("LANG_SITEMGR_APPROVE_REPLY", "Aprobar Respuesta");
	//Reply already approved
	define("LANG_MSG_RESPONSE_ALREADY_APPROVED", "Respuesta ya Aprobada");
	//Review successfully sent!
	define("LANG_REVIEW_SUCCESSFULLY", "¡La calificación se ha enviado con éxito!");
	//Reply successfully sent!
	define("LANG_REPLY_SUCCESSFULLY", "¡La respuesta se ha enviado con éxito!");
	//Please type a valid reply!
	define("LANG_REPLY_EMPTY", "¡Por favor, ingrese una respuesta válida!");
	//Please type a valid name
	define("LANG_REVIEW_EMPTY_NAME", "¡Por favor, ingrese un nombre válido!");
	//Please type a valid e-mail
	define("LANG_REVIEW_EMPTY_EMAIL", "¡Por favor, ingrese un correo electrónico valido!");
	//Please type a valid city, State
	define("LANG_REVIEW_EMPTY_LOCATION", "¡Por favor, ingrese una ciudad, estado válido!");
	//Please type a valid review title
	define("LANG_REVIEW_EMPTY_TITLE", "¡Por favor, ingrese un nombre válido!");
	//Please type a valid review!
	define("LANG_REVIEW_EMPTY", "¡Por favor, ingrese una calificación válida!");
	//Please choose an option or click in cancel to exit.
	define("LANG_STATUS_EMPTY", "Por favor, elija una opción o haga clic en Cancelar para salir.");
	//Click here to reply this review
	define("LANG_MSG_REVIEW_REPLY", "Haga clic aquí para responder a esta calificación");
	//Click here to view the transaction
	define("LANG_MSG_CLICK_TO_VIEW_TRANSACTION", "Haga clic aquí para ver la transacción");
	//Username must be between
	define("LANG_MSG_USERNAME_MUST_BE_BETWEEN", "El nombre de usuario debe tener entre");
	//characters with no spaces.
	define("LANG_MSG_CHARACTERS_WITH_NO_SPACES", "caracteres, sin espacios.");
	//Password must be between
	define("LANG_MSG_PASSWORD_MUST_BE_BETWEEN", "La contraseña debe tener entre");
	//Type you password here if you want to change it.
	define("LANG_MSG_TIPE_YOUR_PASSWORD_HERE_IF_YOU_WANT_TO_CHANGE_IT", "Escriba aquí su contraseña si desea modificarla.");
	//Password is going to be sent to Member E-mail Address.
	define("LANG_MSG_PASSWORD_SENT_TO_MEMBER_EMAIL", "Se enviará la contraseña a la dirección de correo electrónico del miembro.");
	//Please write down your username and password for future reference.
	define("LANG_MSG_WRITE_DOWN_YOUR_USERNAME_PASSWORD", "Por favor escriba su correo electrónico y contraseña para referencias futuras.");
	//Please check the agreement terms.
	define("LANG_MSG_ALERT_AGREE_WITH_TERMS_OF_USE", "Por favor revise los términos del acuerdo.");
	//successfully added
	define("LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED", "Se agregó correctamente");
	//This category was already inserted
	define("LANG_MSG_CATEGORY_ALREADY_INSERTED", "Esta categoría ya se ingreso");
	//Please, select a valid category
	define("LANG_MSG_SELECT_VALID_CATEGORY", "Seleccione una categoría válida");
	//Please, select a category first
	define("LANG_MSG_SELECT_CATEGORY_FIRST", "Por favor, primero seleccione una categoría");
	//You can choose a page name title to be accessed directly from the web browser as a static html page. The chosen page name title must contain only alphanumeric chars (like "a-z" and/or "0-9") and "-" instead of spaces.
	define("LANG_MSG_FRIENDLY_URL1", "Puede elegir un nombre para la página de modo que se acceda directamente desde el navegador web, como una página html estática. El nombre elegido debe contener únicamente caracteres alfanuméricos (como \"a-z\" o \"0-9\") y \"-\" en lugar de espacios.");
	//The page name title "John Auto Repair" will be available through the url:
	define("LANG_MSG_FRIENDLY_URL2", "El nombre de la página \"Taller de reparaciones Juan\" estará disponible en la dirección URL:");
	//Maximum file size
	define("LANG_MSG_MAX_FILE_SIZE", "Tamaño máximo de archivo");
	//Transparent .gif or .png not supported
	define("LANG_MSG_TRANSPARENTGIF_NOT_SUPPORTED", "No se admiten archivos .gif o .png con transparencias");
	//Animated .gif isn't supported.
	define("LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED", "Gif animado no es compatible.");
	//Please be sure that your image dimensions fit within the recommended pixel sizes, otherwise, image quality can be effected.
	define("LANG_MSG_IMAGE_DIMENSIONS_ALERT", "Por favor, asegúrese de que las dimensiones de la imagen se adapten a las dimensiones de pixeles recomendada, de lo contrario la calidad de la imagen puede verse afectada.");
	//Check this box to remove your existing image
	define("LANG_MSG_CHECK_TO_REMOVE_IMAGE", "Marque esta casilla para quitar su imagen actual");
	//maximum 250 characters
	define("LANG_MSG_MAX_250_CHARS", "máximo 250 caracteres");
	//maximum 100 characters
	define("LANG_MSG_MAX_100_CHARS", "máximo 100 caracteres");
	//characters left
	define("LANG_MSG_CHARS_LEFT", "caracteres restantes");
	//(including spaces and line breaks)
	define("LANG_MSG_INCLUDING_SPACES_LINE_BREAKS", "(incluidos espacios y saltos de línea)");
	//Include up to
	define("LANG_MSG_INCLUDE_UP_TO_KEYWORDS", "Incluir hasta");
	//keywords with a maximum of 50 characters each.
	define("LANG_MSG_KEYWORDS_WITH_MAXIMUM_50", "palabras clave, de no más de 50 caracteres cada una.");
	//Add one keyword or keyword phrase per line.
	define("LANG_MSG_KEYWORD_PER_LINE", "Agregue una palabra o frase clave por línea.");
	//Only select sub-categories that directly apply to your type.
	define("LANG_MSG_ONLY_SELECT_SUBCATEGS", "Seleccione únicamente subcategorías que se apliquen directamente a su tipo.");
	//Your article will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_ARTICLE_AUTOMATICALLY_APPEAR", "Su articulo aparecerá automáticamente en la categoría principal de cada subcategoría que seleccione.");
	//maximum 25 characters
	define("LANG_MSG_MAX_25_CHARS", "máximo 25 caracteres");
	//maximum 500 characters
	define("LANG_MSG_MAX_500_CHARS", "máximo 500 caracteres");
	//Allowed file types
	define("LANG_MSG_ALLOWED_FILE_TYPES", "Tipos de archivo permitidos");
	//Click here to preview this listing
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_LISTING", "Haga clic aquí para tener una vista previa de el listado");
	//Click here to preview this event
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_EVENT", "Haga clic aquí para tener una vista previa de este evento");
	//Click here to preview this classified
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_CLASSIFIED", "Haga clic aquí para tener una vista previa de este clasificado");
	//Click here to preview this article
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_ARTICLE", "Haga clic aquí para tener una vista previa de este artículo");
	//Click here to preview this banner
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_BANNER", "Haga clic aquí para tener una vista previa de este banner");
	//Click here to preview this deal
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_PROMOTION", "Haga clic aquí para tener una vista previa de esta oferta");
	//maximum 30 characters
	define("LANG_MSG_MAX_30_CHARS", "máximo 30 caracteres");
	//Select a Country
	define("LANG_MSG_SELECT_A_COUNTRY", "Seleccione un País");
	//Select a Region
	define("LANG_MSG_SELECT_A_REGION", "Seleccione una Región");
	//Select a State
	define("LANG_MSG_SELECT_A_STATE", "Seleccione un Estado");
	//Select a City
	define("LANG_MSG_SELECT_A_CITY", "Seleccione una Ciudad");
	//Select a Neighborhood
	define("LANG_MSG_SELECT_A_NEIGHBORHOOD", "Seleccione un Barrio");
	//(This information will not be displayed publicly)
	define("LANG_MSG_INFO_NOT_DISPLAYED", "(Esta información no se mostrará al público)");
	//Your event will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_EVENT_AUTOMATICALLY_APPEAR", "Su evento aparecerá automáticamente en la categoría principal de cada subcategoría que seleccione.");
	//If video snippet code was filled in, it will appear on the detail page
	define("LANG_MSG_VIDEO_SNIPPET_CODE", "Si el fragmento de código de video se completó, aparecerá en la página de detalles");
	//Maximum video code size supported
	define("LANG_MSG_MAX_VIDEO_CODE_SIZE", "Tamaño máximo de código de video admitido");
	//If the video code size is bigger than supported video size, it will be modified.
	define("LANG_MSG_VIDEO_MODIFIED", "Si el tamaño de código de video es mayor que el tamaño de video admitido, será modificado.");
	//Attachment has no caption
	define("LANG_MSG_ATTACHMENT_HAS_NO_CAPTION", "El adjunto no tiene subtitulo");
	//Check this box to remove existing listing attachment
	define("LANG_MSG_CLICK_TO_REMOVE_ATTACHMENT", "Marque esta casilla para quitar el adjunto del listado existente");
	//Add one phrase per line.
	define("LANG_MSG_PHRASE_PER_LINE", "Agregue una frase por línea.");
	//Extra categories cost an
	define("LANG_MSG_EXTRA_CATEGORIES_COST", "Las categorías extras cuestan");
	//additional
	define("LANG_MSG_ADDITIONAL", "adicional");
	//each. Be seen!
	define("LANG_MSG_BE_SEEN", "cada una.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_LISTING_AUTOMATICALLY_APPEAR", "Su listado aparecerá automáticamente en la categoría principal de cada subcategoría que seleccione.");
	//If you add new categories, your listing will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_LISTING_TEMPORARY_CATEGORY", "Si agrega nuevas categorías, el listado no aparecerá en la categoría principal de cada sub-categoría que agrega hasta que las apruebe administrador del sitio.");
	//If you add new categories, your article will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_ARTICLE_TEMPORARY_CATEGORY", "Si agrega nuevas categorías, el artículo no aparecerá en la categoría principal de cada sub-categoría que agrega hasta que las apruebe administrador del sitio.");
	//If you add new categories, your classified will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_CLASSIFIED_TEMPORARY_CATEGORY", "Si agrega nuevas categorías, el clasificado no aparecerá en la categoría principal de cada sub-categoría que agrega hasta que las apruebe administrador del sitio.");
	//If you add new categories, your event will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_EVENT_TEMPORARY_CATEGORY", "Si agrega nuevas categorías, el evento no aparecerá en la categoría principal de cada sub-categoría que agrega hasta que las apruebe administrador del sitio.");
	//Request your listing to be considered for the following badges.
	define("LANG_MSG_REQUEST_YOUR_LISTING", "Solicite que su listado sea tenida en cuenta para las siguientes clasificaciones.");
	//Click here to select date
	define("LANG_MSG_CLICK_TO_SELECT_DATE", "Haga clic aquí para seleccionar la fecha");
	//"Click on the" deal icon below if you wish to add deal to your listing.
	define("LANG_LISTING_CLICK_PROMOTION_BELOW", "Haga clic en el");
	//Click on the "deal icon" below if you wish to add deal to your listing.
	define("LANG_LISTING_PROMOTION_ICON", "icono de lo Oferta");
	//Click on the deal icon "below if you wish to add deal to your listing."
	define("LANG_LISTING_IFYOUWISHADDPROMOTION", "situado más abajo, si desea agregar lo Oferta a su listado.");
	//You can add deal to your listing by clicking on the link
	define("LANG_LISTING_YOUCANADDPROMOTION", "Puede agregar la oferta a su listado haciendo clic en el vínculo");
	//add deal
	define("LANG_LISTING_ADDPROMOTION", "agregar oferta");
	//All pages but item pages
	define("LANG_ALLPAGESBUTITEMPAGES", "Todas las páginas menos las páginas de elementos");
	//All pages
	define("LANG_ALLPAGES", "Todas las páginas");
    //All
	define("LANG_ALL", "Todas");
	//Non-category search
	define("LANG_NONCATEGORYSEARCH", "Búsqueda sin categorías");
	//deal
	define("LANG_ICONPROMOTION", "oferta");
	//e-mail to friend
	define("LANG_ICONEMAILTOFRIEND", "enviar a un amigo");
	//Add to Favorites
	define("LANG_ICONQUICKLIST_ADD", "Agregar a los Favoritos");
	//remove from favorites
	define("LANG_ICONQUICKLIST_REMOVE", "eliminar de favoritos");
	//print
	define("LANG_ICONPRINT", "imprimir");
	//map
	define("LANG_ICONMAP", "mapa");
	//Add to
	define("LANG_ADDTO_SOCIALBOOKMARKING", "Añadir a");
	//Google maps are not available. Please contact the administrator.
	define("LANG_GOOGLEMAPS_NOTAVAILABLE_CONTACTADM", "No hay mapas de Google disponibles. Póngase en contacto con el administrador.");
	//Remove
	define("LANG_QUICKLIST_REMOVE", "Quitar");
	//Favorite Articles
	define("LANG_FAVORITE_ARTICLE", "Artículos Favoritos");
	//Favorite Classifieds
	define("LANG_FAVORITE_CLASSIFIED", "Clasificados Favoritos");
	//Favorite Events
	define("LANG_FAVORITE_EVENT", "Eventos Favoritos");
	//Favorite Listings
	define("LANG_FAVORITE_LISTING", "Listados Favoritos");
	//Favorite Deals
	define("LANG_FAVORITE_PROMOTION", "Ofertas Favoritas");
	//Published
	define("LANG_ARTICLE_PUBLISHED", "Publicado");
	//More Info
	define("LANG_CLASSIFIED_MOREINFO", "Más información");
	//Date
	define("LANG_EVENT_DATE", "Fecha");
	//Time
	define("LANG_EVENT_TIME", "Hora");
	//Get driving directions
	define("LANG_EVENT_DRIVINGDIRECTIONS", "Obtener indicaciones para llegar");
	//Website
	define("LANG_EVENT_WEBSITE", "Sitio web");
	//phone
	define("LANG_EVENT_LETTERPHONE", "Teléfono");
	//More
	define("LANG_EVENT_MORE", "Más");
	//More Info
	define("LANG_EVENT_MOREINFO", "Más información");
	//See all categories
	define("LANG_SEEALLCATEGORIES", "Ver todas las categorías");
	//View all listing categories
	define("LANG_LISTING_VIEWALLCATEGORIES", "Ver todas las categorías");
	//More Info
	define("LANG_LISTING_MOREINFO", "Más información");
	//view phone
	define("LANG_LISTING_VIEWPHONE", "ver teléfono");
	//view fax
	define("LANG_LISTING_VIEWFAX", "ver fax");
	//Send Email
	define("LANG_SEND_AN_EMAIL", "Enviar un Mensaje");
	//Click here to see more info!
	define("LANG_LISTING_ATTACHMENT", "¡Haga clic aquí para obtener más información!");
	//Download [item] Menu
	define("LANG_LISTING_DOWNLOADMENU", "Descargar [item] del Menú");
	//Complete the form below to contact us.
	define("LANG_LISTING_CONTACTTITLE", "Complete el siguiente formulario para ponerse en contacto con nosotros.");
	//Contact this Listing
	define("LANG_LISTING_CONTACT", "Contacte a este Listado");
	//E-mail an inquiry
	define("LANG_LISTING_INQUIRY", "Colsunta por correo electronico");
	//phone
	define("LANG_LISTING_LETTERPHONE", "teléfono");
	//fax
	define("LANG_LISTING_LETTERFAX", "fax");
	//website
	define("LANG_LISTING_LETTERWEBSITE", "sitio web");
	//e-mail
	define("LANG_LISTING_LETTEREMAIL", "correo electrónico");
	//offers the following products and/or services:
	define("LANG_LISTING_OFFERS", "ofrece los siguientes productos y servicios:");
	//Hours
	define("LANG_LISTING_HOURS_OF_WORK", "Horas de trabajo");
	//Check in
	define("LANG_CHECK_IN", "Entrada");
	//No review comment found for this item!
	define("LANG_REVIEW_NORECORD", "¡No se encontraron calificaciones para este elemento!");
	//Reviews and comments from the last month
	define("LANG_REVIEWS_MONTH", "Calificaciones y comentarios del último mes");
	//Review
	define("LANG_REVIEW", "Calificación");
	//Reviews
	define("LANG_REVIEW_PLURAL", "Calificaciones");
	//Reviews
	define("LANG_REVIEWTITLE", "Calificaciones");
	//review
	define("LANG_REVIEWCOUNT", "calificación");
	//reviews
	define("LANG_REVIEWCOUNT_PLURAL", "calificaciones");
	//Check In
	define("LANG_CHECKINCOUNT", "Entrada");
	//Check ins
	define("LANG_CHECKINCOUNT_PLURAL", "Entradas");
	//See check ins
	define("LANG_CHECKINSEECOMMENTS", "Ver entradas");
	//Check ins of
	define("LANG_CHECKINSOF", "Entradas de");
	//No check in found for this item!
	define("LANG_CHECKIN_NORECORD", "¡No se encontraron entradas para este elemento!");
	//Related Categories
	define("LANG_RELATEDCATEGORIES", "Categorías relacionadas");
	//Related Listings
	define("LANG_RELATEDLISTINGS", "Listados relacionados");
	//Subcategories
	define("LANG_LISTING_SUBCATEGORIES", "Subcategorías");
	//See comments
	define("LANG_REVIEWSEECOMMENTS", "Ver calificaciones");
    //Pending Reviews
    define("LANG_REVIEW_PENDING", "Revisiones Pendientes");
    //Approve
    define("LANG_REVIEW_APPROVE", "Aprobar");
	//Rate It!
	define("LANG_REVIEWRATEIT", "¡Calificar!");
	//Be the first to review this item!
	define("LANG_REVIEWBETHEFIRST", "¡Sea el primero en calificar este articulo!");
	//Offered by
	define("LANG_PROMOTION_OFFEREDBY", "Ofrecido por");
	//More Info
	define("LANG_PROMOTION_MOREINFO", "Más información");
	//Valid from
	define("LANG_PROMOTION_VALIDFROM", "Válido de");
	//to
	define("LANG_PROMOTION_VALIDTO", "a");
	//Print Deal
	define("LANG_PROMOTION_PRINT", "Imprimir");
	//Article
	define("LANG_ARTICLE_FEATURE_NAME", "Artículo");
	//Articles
	define("LANG_ARTICLE_FEATURE_NAME_PLURAL", "Artículos");
	//Blog
	define("LANG_BLOG_FEATURE_NAME", "Blog");
	//Banner
	define("LANG_BANNER_FEATURE_NAME", "Banner");
	//Banners
	define("LANG_BANNER_FEATURE_NAME_PLURAL", "Banners");
	//Classified
	define("LANG_CLASSIFIED_FEATURE_NAME", "Clasificado");
	//Classifieds
	define("LANG_CLASSIFIED_FEATURE_NAME_PLURAL", "Clasificados");
	//Event
	define("LANG_EVENT_FEATURE_NAME", "Evento");
	//Events
	define("LANG_EVENT_FEATURE_NAME_PLURAL", "Eventos");
	//Listing
	define("LANG_LISTING_FEATURE_NAME", "Listado");
	//Listings
	define("LANG_LISTING_FEATURE_NAME_PLURAL", "Listados");
	//Deal
	define("LANG_PROMOTION_FEATURE_NAME", "Oferta");
	//Deals
	define("LANG_PROMOTION_FEATURE_NAME_PLURAL", "Ofertas");
	//Send
	define("LANG_BUTTON_SEND", "Enviar");
	//Sign Up
	define("LANG_BUTTON_SIGNUP", "Registrarse");
	//View Category Path
	define("LANG_BUTTON_VIEWCATEGORYPATH", "Ver ruta de la Categoría");
	//More info
	define("LANG_VIEWCATEGORY", "Más información");
	//No info found
	define("LANG_NOINFO", "No se encontro información");
	//Remove Selected Category
	define("LANG_BUTTON_REMOVESELECTEDCATEGORY", "Quitar categoría");
	//Continue
	define("LANG_BUTTON_CONTINUE", "Continuar");
	//No, thank you
	define("LANG_BUTTON_NO_THANKS", "No, gracias");
	//Yes, continue
	define("LANG_BUTTON_YES_CONTINUE", "Sí, continúe.");
	//No, Order without the Package!
	define("LANG_BUTTON_NO_ORDER_WITHOUT", "¡No, Orden sin el paquete.");
	//Increase your Visibility!
	define("LANG_INCREASE_VISIBILITY", "Aumente su Visibilidad!");
	//Gift
	define("LANG_GIFT", "Regalo");
	//Help to Increase your visibility, check our
	define("LANG_HELP_INCREASE", "¡Ayude a mejorar su visibilidad, visita nuestra ");
	//Site statistics
	define("LANG_DOMAIN_STATISTICS", "Estadísticas del Sitio!");
	//Visitors per Month
	define("LANG_VISITOR_MONTH", "Visitantes por Mes");
	//Custom option
	define("LANG_CUSTOM_OPTION", "Opción personalizada");
	//Ok
	define("LANG_BUTTON_OK", "Ok");
	//Cancel
	define("LANG_BUTTON_CANCEL", "Cancelar");
	//Log in
	define("LANG_BUTTON_LOGIN", "Iniciar");
	//Save Map Tuning
	define("LANG_BUTTON_SAVE_MAP_TUNING", "Guardar ajuste de mapa");
	//Clear Map Tuning
	define("LANG_BUTTON_CLEAR_MAP_TUNING", "Borrar ajuste de mapa");
	//Next
	define("LANG_BUTTON_NEXT", "Siguiente");
	//Pay By CreditCard
	define("LANG_BUTTON_PAY_BY_CREDIT_CARD", "Pagar con Tarjeta de Crédito");
	//Pay By PayPal
	define("LANG_BUTTON_PAY_BY_PAYPAL", "Pagar con PayPal");
	//Pay By SimplePay
	define("LANG_BUTTON_PAY_BY_SIMPLEPAY", "Pagar con SimplePay");
	//Search
	define("LANG_BUTTON_SEARCH", "Buscar");
	//Advanced
	define("LANG_BUTTON_ADVANCEDSEARCH", "Avanzada");
	//Close
	define("LANG_BUTTON_ADVANCEDSEARCH_CLOSE", "Cerrar");
	//Clear
	define("LANG_BUTTON_CLEAR", "Borrar");
	//Add your Article
	define("LANG_BUTTON_ADDARTICLE", "Agregue su Artículo");
	//Add your Classified
	define("LANG_BUTTON_ADDCLASSIFIED", "Agregue su Clasificado");
	//Add your Event
	define("LANG_BUTTON_ADDEVENT", "Agregue su Evento");
	//Add your Listing
	define("LANG_BUTTON_ADDLISTING", "Agregue su Listado");
	//Add your Deal
	define("LANG_BUTTON_ADDPROMOTION", "Agregue su Oferta");
	//Home
	define("LANG_BUTTON_HOME", "Inicio");
	//Manage Account
	define("LANG_BUTTON_MANAGE_ACCOUNT", "Administrar Cuenta");
	//Manage Content
	define("LANG_MANAGE_CONTENT", "Gestionar Contenido");
	//Sponsor
	define("LANG_SPONSOR_AREA", "Anunciante");
	//Site Manager
	define("LANG_SITEMGR_AREA", "Administración");
	//Site Manager Section
	define("LANG_LABEL_SITEMGR_SECTION", "Sección Administrativa");
	//Help
	define("LANG_BUTTON_HELP", "Ayuda");
	//Sign out
	define("LANG_BUTTON_LOGOUT", "Salir");
	//Submit
	define("LANG_BUTTON_SUBMIT", "Enviar");
	//Update
	define("LANG_BUTTON_UPDATE", "Actualizar");
	//Back
	define("LANG_BUTTON_BACK", "Volver");
	//Delete
	define("LANG_BUTTON_DELETE", "Eliminar");
	//Complete the Process
	define("LANG_BUTTON_COMPLETE_THE_PROCESS", "Completar el proceso");
	//Please enter the text you see in the image at the left into the textbox. This is required to prevent automated submission of contact requests.
	define("LANG_CAPTCHA_HELP", "Escriba el texto de la imagen situada a la izquierda en el cuadro de texto. Esto es necesario para evitar el envío automatizado de solicitudes de contacto.");
	//Verification Code image cannot be displayed
	define("LANG_CAPTCHA_ALT", "No se puede mostrar la imagen del código de verificación");
	//Verification Code
	define("LANG_CAPTCHA_TITLE", "Código de verificación");
	//Please select a rating for this item
	define("LANG_MSG_REVIEW_SELECTRATING", "Seleccione una calificación para este elemento");
	//Fraud detected! Please select a rating for this item!
	define("LANG_MSG_REVIEW_FRAUD_SELECTRATING", "¡Se detectó un fraude! ¡Seleccione una calificación para este elemento!");
	//"Comment" and "Comment Title" are required to post a comment!
	define("LANG_MSG_REVIEW_COMMENTREQUIRED", "¡Se requiere el \"Comentario\" y el \"Nombre del comentario\" para enviar un comentario!");
	//"Name" and "E-mail" are required to post a comment!
	define("LANG_MSG_REVIEW_NAMEEMAILREQUIRED", "¡Se requiere el \"Nombre\" y el \"Correo Electrónico\" para enviar un comentario!");
	//"City, State" are required to post a comment!
	define("LANG_MSG_REVIEW_CITYSTATEREQUIRED", "¡Se requiere la \"Ciudad, Estado\" para enviar un comentario!");
	//Please type a valid e-mail address!
	define("LANG_MSG_REVIEW_TYPEVALIDEMAIL", "¡Escriba una dirección de correo electrónico válida!");
	//You have already given your opinion on this item. Thank you.
	define("LANG_MSG_REVIEW_YOUALREADYGIVENOPINION", "Ya calificó este elemento. Gracias.");
	//Thanks for the feedback!
	define("LANG_MSG_REVIEW_THANKSFEEDBACK", "¡Gracias por sus comentarios!");
	//Your review has been submitted for approval.
	define("LANG_MSG_REVIEW_REVIEWSUBMITTEDAPPROVAL", "Se envió su revisión y se evaluará su aprobación.");
	//No payment method was selected!
	define("LANG_MSG_NO_PAYMENT_METHOD_SELECTED", "¡No se seleccionó una forma de pago!");
	//Wrong credit card expiration date. Please, try again.
	define("LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN", "La fecha de vencimiento de la Tarjeta de Crédito es errónea. Intente nuevamente.");
	//Click here to try again
	define("LANG_MSG_CLICK_HERE_TO_TRY_AGAIN", "Haga clic aquí para intentar nuevamente");
	//Payment transactions may not occur immediately.
	define("LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY", "Es posible que las transacciones de pago no tengan lugar inmediatamente.");
	//After your payment is processed, information about your transaction
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT", "Después de que se haya procesado el pago, la información acerca de su transacción");
	//may be found in your transaction history.
	define("LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY", "se podrá encontrar en el historial de transacciones.");
	//"may be found in your" transaction history
	define("LANG_MSG_MAY_BE_FOUND_IN_YOUR", "se podrá encontrar en el");
	//The payment gateway is not available currently
	define("LANG_MSG_PAYMENT_GATEWAY_NOT_AVAILABLE", "La puerta de enlace del pago no está actualmente disponible");
	//The payment parameters could not be validated
	define("LANG_MSG_PAYMENT_INVALID_PARAMS", "No se pudieron validar los parámetros del pago");
	//Internal gateway error was encountered
	define("LANG_MSG_INTERNAL_GATEWAY_ERROR", "Error en la puerta de enlace interna");
	//Information about your transaction may be found
	define("LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND", "La información acerca de su transacción se podrá encontrar");
	//in your transaction history.
	define("LANG_MSG_IN_YOUR_TRANSACTION_HISTORY", "en el historial de transacciones.");
	//in your
	define("LANG_MSG_IN_YOUR", "en el");
	//No Transaction ID
	define("LANG_MSG_NO_TRANSACTION_ID", "No hay Id. de la transacción");
	//System failure, please try again.
	define("LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN", "Error del sistema, intente nuevamente.");
	//Please, fill in all required fields.
	define("LANG_MSG_FILL_ALL_REQUIRED_FIELDS", "Complete todos los campos requeridos.");
	//Could not connect.
	define("LANG_MSG_COULD_NOT_CONNECT", "No se pudo conectar.");
	//Thank you for setting up your items and for making the payment!
	define("LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT", "¡Gracias por configurar sus elementos y realizar el pago!");
	//Site manager will review your items and set it live within 2 working days.
	define("LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS", "El administrador del sitio revisará sus elementos y los activará en los proximos dos días laborables.");
	//The payment gateway could not respond
	define("LANG_MSG_PAYMENT_GATEWAY_COULD_NOT_RESPOND", "La puerta de enlace de pago no respondió");
	//Pending payments may take 3 to 4 days to be approved.
	define("LANG_MSG_PENDING_PAYMENTS_TAKE_3_4_DAYS_TO_BE_APPROVED", "Es posible que los pagos pendientes demoren entre 3 y 4 días en ser aprobados.");
	//Connection Failure
	define("LANG_MSG_CONNECTION_FAILURE", "Error de conexión");
	//Please, fill correctly zip.
	define("LANG_MSG_FILL_CORRECTLY_ZIP", "Complete correctamente el código postal.");
	//Please, fill correctly card verification number.
	define("LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER", "Complete correctamente el número de verificación de la tarjeta.");
	//Card Type and Card Verification Number do not match.
	define("LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH", "El tipo de la tarjeta y el número de identificación de la tarjeta no coinciden.");
	//Transaction Not Completed.
	define("LANG_MSG_TRANSACTION_NOT_COMPLETED", "No se completó la transacción.");
	//Error Number:
	define("LANG_MSG_ERROR_NUMBER", "Número de error:");
	//Short Message
	define("LANG_MSG_SHORT_MESSAGE", "Mensaje corto:");
	//Long Message
	define("LANG_MSG_LONG_MESSAGE", "Mensaje largo:");
	//Transaction Completed Successfully.
	define("LANG_MSG_TRANSACTION_COMPLETED_SUCCESSFULLY", "Se completó correctamente la transacción.");
	//Card expire date must be in the future
	define("LANG_MSG_CARD_EXPIRE_DATE_IN_FUTURE", "La fecha de vencimiento de la tarjeta debe estar en el futuro");
	//If your transaction was confirmed, information about it may be found in
	define("LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED", "Si se confirmó la transacción, podrá encontrar la información en");
	//your transaction history after your payment is processed.
	define("LANG_MSG_YOUR_TRANSACTION_AFTER_PAYMENT_PROCESSED", "el historial de transacciones, después de que se haya procesado el pago.");
	//after your payment is processed.
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED", "después de que se haya procesado el pago.");
	//No items requiring payment.
	define("LANG_MSG_NO_ITEMS_REQUIRING_PAYMENT", "No hay elementos que requieran pagarse.");
	//Pay for outstanding invoices
	define("LANG_MSG_PAY_OUTSTANDING_INVOICES", "Pagar facturas pendientes");
	//Banner by Impression and Custom Invoices can be paid once.
	define("LANG_MSG_BANNER_CUSTOM_INVOICE_PAID_ONCE", "Banner por impresión y facturas personalizadas se puede pagar una vez.");
	//Banner by Impression can be paid once.
	define("LANG_MSG_BANNER_PAID_ONCE", "Banner por impresión se puede pagar una vez.");
	//Custom Invoices can be paid once.
	define("LANG_MSG_CUSTOM_INVOICE_PAID_ONCE", "Las facturas personalizadas se pueden pagar una vez.");
	//View Items
	define("LANG_VIEWITEMS", "Ver Artículos");
	//Please do not use recurring payment system.
	define("LANG_MSG_PLEASE_DO_NOT_USE_RECURRING_PAYMENT_SYSTEM", "No use un sistema de pago recurrente.");
	//Multiple Items
	define("LANG_ORDER_MULTIPLEITEMS", "Artículos múltiples");
	//Try again!
	define("LANG_MSG_TRY_AGAIN", "¡Intente nuevamente!");
	//All fields are required.
	define("LANG_MSG_ALL_FIELDS_REQUIRED", "Se requieren todos los campos.");
	//"You have more than" X items. Please contact the administrator to check out it.
	define("LANG_MSG_OVERITEM_MORETHAN", "Usted tiene más de ");
	//You have more than X items. "Please contact the administrator to check out it".
	define("LANG_MSG_OVERITEM_CONTACTADMIN", "Por favor, póngase en contacto con el administrador para pagar.");
	//Article Options
	define("LANG_ARTICLE_OPTIONS", "Opciones del Artículo");
	//Article Author
	define("LANG_ARTICLE_AUTHOR", "Autor del Artículo");
	//Article Author URL
	define("LANG_ARTICLE_AUTHOR_URL", "URL del autor");
	//Article Categories
	define("LANG_ARTICLE_CATEGORIES", "Categorías del Artículo");
	//Banner Type
	define("LANG_BANNER_TYPE", "Tipo de Banner");
	//Banner Options
	define("LANG_BANNER_OPTIONS", "Opciones de Banners");
	//Order Banner
	define("LANG_ORDER_BANNER", "Solicitar Banner");
	//By time period
	define("LANG_BANNER_BY_TIME_PERIOD", "Por período");
	//Banner Details
	define("LANG_BANNER_DETAIL_PLURAL", "Detalles del Banner");
	//Script Banner
	define("LANG_SCRIPT_BANNER", "Hacer secuencia de comandos del Banner");
	//Show by Script Code
	define("LANG_SHOWSCRIPTCODE", "Mostrar por código de secuencia de comandos");
	//Allow script to be entered instead of an image. This field allows you to paste in script that will be used to display the banner from an affiliate program or external banner system. If "Show by Script Code" is checked, just "Script" field will be required. The other fields below will not be necessary.
	define("LANG_SCRIPTCODEHELP", "Permitir especificar una secuencia de comandos en lugar de una imagen. Este campo permite pegar una secuencia de comandos que se usará para mostrar el banner de un programa asociado o un sistema de banner externo. Si \"Mostrar por código de secuencia de comandos\" está activado, solo se requerirá el campo \"Secuencia de comandos\". No se necesitarán los demás campos situados a continuación.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload script banners.
	define("LANG_SCRIPTCODEHELP2", "\"URL de Destino\" y \"Informe de Tráfico Clic Directo\" no tendrán efecto cuando se haya cargado banners por secuencia de comandos.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload swf file
	define("LANG_BANNERFILEHELP", "\"URL de destino\" y \"Informe de Tráfico Clic Directo\" no tendrán efecto al cargar el archivo swf");
	//Classified Level
	define("LANG_CLASSIFIED_LEVEL", "Nivel del Clasificado");
	//Classified Category
	define("LANG_CLASSIFIED_CATEGORY", "Categoría del Clasificado");
	//Select classified level
	define("LANG_MENU_SELECT_CLASSIFIED_LEVEL", "Seleccionar el nivel del clasificado");
	//Classified Options
	define("LANG_CLASSIFIED_OPTIONS", "Opciones de Clasificados");
	//Event Level
	define("LANG_EVENT_LEVEL", "Nivel del Evento");
	//Event Categories
	define("LANG_EVENT_CATEGORY_PLURAL", "Categorías del Evento");
	//Event Categories
	define("LANG_EVENT_CATEGORIES", "Categorías del Evento");
	//Select event level
	define("LANG_MENU_SELECT_EVENT_LEVEL", "Seleccionar nivel de evento");
	//Event Options
	define("LANG_EVENT_OPTIONS", "Opciones de Eventos");
	//Listing Level
	define("LANG_LISTING_LEVEL", "Nivel del Listado");
	//Listing Type
	define("LANG_LISTING_TEMPLATE", "Tipo de Listado");
	//Listing Categories
	define("LANG_LISTING_CATEGORIES", "Categorías del Listado");
	//Listing Badges
	define("LANG_LISTING_DESIGNATION_PLURAL", "Clasificaciones del Listado");
	//Subject to administrator approval.
	define("LANG_LISTING_SUBJECTTOAPPROVAL", "Sujeto a la aprobación del administrador.");
	//Select this choice
	define("LANG_LISTING_SELECT_THIS_CHOICE", "Seleccionar esta opción");
	//Select listing level
	define("LANG_MENU_SELECTLISTINGLEVEL", "Seleccionar el nivel del listado");
	//Select event level
	define("LANG_MENU_SELECTEVENTLEVEL", "Seleccionar el nivel del evento");
	//Select classified level
	define("LANG_MENU_SELECTCLASSIFIEDLEVEL", "Seleccionar el nivel del clasificado");
	//Listing Options
	define("LANG_LISTING_OPTIONS", "Opciones de Listados");
	//Payment System is not available. Please contact the
	define("LANG_GATEWAY_NO_AVAILABLE", "El sistema de pago no está disponible. Póngase en contacto con el");
	//Upload Warning
	define("LANG_UPLOAD_WARNING", "Advertencia de carga");
	//File successfully uploaded!
	define("LANG_UPLOAD_MSG_SUCCESSUPLOADED", "¡Se cargó correctamente el archivo!");
	//Extension not allowed or wrong file type!
	define("LANG_UPLOAD_MSG_NOTALLOWED_WRONGFILETYPE", "¡La extensión no está permitida, o el tipo de archivo no es correcto!");
	//File exceeds size limit!
	define("LANG_UPLOAD_MSG_EXCEEDSLIMIT", "¡El archivo excede el límite de tamaño!");
	//Fail trying to create directory!
	define("LANG_UPLOAD_MSG_FAILCREATEDIRECTORY", "¡Error al intentar crear el directorio!");
	//Wrong directory permission!
	define("LANG_UPLOAD_MSG_WRONGDIRECTORYPERMISSION", "¡Permiso de directorio erróneo!");
	//Unexpected failure!
	define("LANG_UPLOAD_MSG_UNEXPECTEDFAILURE", "¡Error inesperado!");
	//File not found or not entered!
	define("LANG_UPLOAD_MSG_NOTFOUND_NOTENTERED", "¡No se encontró o no se especificó el archivo!");
	//File already exists in directory!
	define("LANG_UPLOAD_MSG_FILEALREADEXISTSINDIRECTORY", "¡El archivo ya existe en el directorio!");
	//View all locations
	define("LANG_VIEWALLLOCATIONSCATEGORIES", "Ver todas las Ubicaciónes");
	//Featured Locations
	define("LANG_FEATUREDLOCATIONS", "Lugares Destacados");
	//There aren't any featured location in the system.
	define("LANG_LABEL_NOFEATUREDLOCATIONS", "No hay ningun lugar destacado en el sistema.");
	//Overview
	define("LANG_LABEL_OVERVIEW", "Resumen");
	//Video
	define("LANG_LABEL_VIDEO", "Video");
	//Map Location
	define("LANG_LABEL_MAPLOCATION", "Ubicación en el Mapa");
	//More Listings
	define("LANG_LABEL_MORELISTINGS", "Más Listados");
	//More Events
	define("LANG_LABEL_MOREEVENTS", "Más Eventos");
	//More Classifieds
	define("LANG_LABEL_MORECLASSIFIEDS", "Más Clasificados");
	//More Articles
	define("LANG_LABEL_MOREARTICLES", "Más Artículos");
    //More Promotions
    define("LANG_LABEL_MOREPROMOTIONS", "Más Ofertas");
    //More Posts
    define("LANG_LABEL_MOREPOSTS", "Más Entradas");
	//"Operation not allowed: The deal" (deal_name) is already associated with the listing
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED1", "No se permite la operación: la oferta");
	//Operation not allowed: The deal (deal_name) "is already associated with the listing"
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED2", "ya está asociada con el listado");
	//Pending
	define("LANG_LABEL_SIMPLEPAYPENDING", "Pendiente");
	//Aborted
	define("LANG_LABEL_SIMPLEPAYABORTED", "Abortado");
	//Failed
	define("LANG_LABEL_SIMPLEPAYFAILED", "Fallido");
	//Declined
	define("LANG_LABEL_SIMPLEPAYDECLINED", "Denegado");
	//Unknow
	define("LANG_LABEL_SIMPLEPAYUNKNOW", "Desconocido");
	//Success
	define("LANG_LABEL_SIMPLEPAYSUCCESS", "Exito");
	//Click on Add to Select Categories.
	define("LANG_MSG_CLICKADDTOSELECTCATEGORIES", "Haga clic en \"Agregar\" para seleccionar las categorías");
	//Click on "Add main category" or "Add sub-category" to type your new categories
	define("LANG_MSG_CLICKADDTOADDCATEGORIES", "Haga clic en \"Agregar categoría principal\" o \"Agregar sub-categoría\" para ingresar sus nuevas categorías");
	//Add an
	define("LANG_ADD_AN", "Añadir un(a)");
	//Add a
	define("LANG_ADD_A", "Añadir un(a)");
	//on these sites
	define("LANG_ON_SITES", "en estos sitios:");
	//on this site
	define("LANG_ON_SITES_SINGULAR", "en este sitio:");

	# ----------------------------------------------------------------------------------------------------
	# FUNCTIONS
	# ----------------------------------------------------------------------------------------------------
	//slideshow
	define("LANG_SLIDESHOW", "Diapositivas");
	//on
	define("LANG_SLIDESHOW_ON", "activo");
	//off
	define("LANG_SLIDESHOW_OFF", "desactivado");
	//Photo Gallery
	define("LANG_GALLERYTITLE", "Galería de fotos");
	//"Click here" for Slideshow. You can also click on any of the photos to start slideshow.
	define("LANG_GALLERYCLICKHERE", "Haga clic aquí");
	//Click here "for Slideshow. You can also click on any of the photos to start slideshow."
	define("LANG_GALLERYSLIDESHOWTEXT", "para ver la presentación de diapositivas. También puede hacer clic en cualquier foto para iniciar la presentación.");
	//more photos
	define("LANG_GALLERYMOREPHOTOS", "más fotos");
	//Inexistent Discount Code
	define("LANG_MSG_INEXISTENT_DISCOUNT_CODE", "Código de la Oferta inexistente");
	//is not available.
	define("LANG_MSG_IS_NOT_AVAILABLE", "no está disponible.");
	//is not available for this item type.
	define("LANG_MSG_IS_NOT_AVAILABLE_FOR", "no está disponible para este tipo de elemento.");
	//cannot be used twice.
	define("LANG_MSG_CANNOT_BE_USED_TWICE", "no se puede usar dos veces.");
	//Title is required.
	define("LANG_MSG_TITLE_IS_REQUIRED", "Se requiere el nombre.");
	//Language is required.
	define("LANG_MSG_LANGUAGE_IS_REQUIRED", "Se requiere el idioma.");
	//First Name is required.
	define("LANG_MSG_FIRST_NAME_IS_REQUIRED", "Se requiere el nombre.");
	//Last Name is required.
	define("LANG_MSG_LAST_NAME_IS_REQUIRED", "Se requiere el apellido.");
	//Company is required.
	define("LANG_MSG_COMPANY_IS_REQUIRED", "Se requiere el nombre de la compañia.");
	//Phone is required.
	define("LANG_MSG_PHONE_IS_REQUIRED", "Se requiere el teléfono.");
	//E-mail is required.
	define("LANG_MSG_EMAIL_IS_REQUIRED", "Se requiere el correo electrónico.");
	//Account is required.
	define("LANG_MSG_ACCOUNT_IS_REQUIRED", "Se requiere la cuenta.");
	//Page Name is required.
	define("LANG_MSG_PAGE_NAME_IS_REQUIRED", "Se requiere el nombre de la página.");
	//Category is required.
	define("LANG_MSG_CATEGORY_IS_REQUIRED", "Se requiere la categoría.");
	//Abstract is required.
	define("LANG_MSG_ABSTRACT_IS_REQUIRED", "Se requiere el resumen.");
	//Expiration type is required.
	define("LANG_MSG_EXPIRATION_TYPE_IS_REQUIRED", "Se requiere el tipo de vencimiento.");
	//Renewal Date is required.
	define("LANG_MSG_RENEWAL_DATE_IS_REQUIRED", "Se requiere la fecha de renovación.");
	//Impressions are required.
	define("LANG_MSG_IMPRESSIONS_ARE_REQUIRED", "Se requieren las impresiones.");
	//File is required.
	define("LANG_MSG_FILE_IS_REQUIRED", "Se requiere el archivo.");
	//Type is required.
	define("LANG_MSG_TYPE_IS_REQUIRED", "Se requiere el tipo.");
	//Caption is required.
	define("LANG_MSG_CAPTION_IS_REQUIRED", "Se requiere el epígrafe.");
	//Script Code is required.
	define("LANG_MSG_SCRIPT_CODE_IS_REQUIRED", "Se requiere el código de secuencia de comandos.");
	//Description 1 is required.
	define("LANG_MSG_DESCRIPTION1_IS_REQUIRED", "Se requiere la descripción 1.");
	//Description 2 is required.
	define("LANG_MSG_DESCRIPTION2_IS_REQUIRED", "Se requiere la descripción 2.");
	//Name is required.
	define("LANG_MSG_NAME_IS_REQUIRED", "Se requiere el nombre.");
	//Deal Title is required.
	define("LANG_MSG_HEADLINE_IS_REQUIRED", "Se requiere el Nombre de la Oferta.");
	//"Offer" is required.
	define("LANG_MSG_OFFER_IS_REQUIRED", "Se requiere la Oferta.");
	//"Start Date" is required.
	define("LANG_MSG_START_DATE_IS_REQUIRED", "Se requiere la Fecha de inicio.");
	//"End Date" is required.
	define("LANG_MSG_END_DATE_IS_REQUIRED", "Se requiere la Fecha de finalización.");
	//Message is required.
	define("LANG_MSG_TEXT_IS_REQUIRED", "Se requiere el texto.");
	//Username is required.
	define("LANG_MSG_USERNAME_IS_REQUIRED", "E-mail es obligatorio.");
	//"Current Password" is incorrect.
	define("LANG_MSG_CURRENT_PASSWORD_IS_INCORRECT", "La \"Contraseña actual\" no es correcta.");
	//Password is required.
	define("LANG_MSG_PASSWORD_IS_REQUIRED", "Se requiere la Contraseña.");
	//"Agree to terms of use" is required.
	define("LANG_MSG_IGREETERMS_IS_REQUIRED", "Se requiere que \"Acepte los términos de uso\".");
	//The following fields were not filled or contain errors:
	define("LANG_MSG_FIELDS_CONTAIN_ERRORS", "No se completaron los siguientes campos, o contienen errores:");
	//Title - Please fill out the field
	define("LANG_MSG_TITLE_PLEASE_FILL_OUT", "Titulo: complete el campo");
	//Page Name - Please fill out the field
	define("LANG_MSG_PAGE_NAME_PLEASE_FILL_OUT", "Nombre de la página: complete el campo");
	//"Maximum of" [MAX_CATEGORY_ALLOWED] categories are allowed
	define("LANG_MSG_MAX_OF_CATEGORIES_1", "Máximo de");
	//Maximum of [MAX_CATEGORY_ALLOWED] "categories are allowed"
	define("LANG_MSG_MAX_OF_CATEGORIES_2", "categorías permitidas.");
	//Friendly URL Page Name already in use, please choose another Page Name.
	define("LANG_MSG_FRIENDLY_URL_IN_USE", "El nombre de la página de URL semántica ya está en uso, seleccione otro nombre para la página.");
	//Page Name contain invalid chars
	define("LANG_MSG_PAGE_NAME_INVALID_CHARS", "El nombre de la página contiene caracteres no válidos");
	//"Maximum of" [MAX_KEYWORDS] keywords are allowed
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1", "Máximo de");
	//Maximum of [MAX_KEYWORDS] "keywords are allowed"
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2", "palabras clave permitidas");
	//Please include keywords with a maximum of 50 characters each
	define("LANG_MSG_PLEASE_INCLUDE_KEYWORDS", "Incluya palabras clave, de no más de 50 caracteres cada una.");
	//Please enter a valid "Publication Date".
	define("LANG_MSG_ENTER_VALID_PUBLICATION_DATE", "Especifique una \"Fecha de publicación\" válida.");
	//Please enter a valid "Start Date".
	define("LANG_MSG_ENTER_VALID_START_DATE", "Especifique una \"Fecha de inicio\" válida.");
	//Please enter a valid "End Date".
	define("LANG_MSG_ENTER_VALID_END_DATE", "Especifique una \"Fecha de finalización\" válida.");
	//The "End Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_END_DATE_GREATER_THAN_START_DATE", "La \"Fecha de finalización\" debe ser posterior o igual a la \"Fecha de inicio\".");
	//The "End Time" must be greater than the "Start Time".
	define("LANG_MSG_END_TIME_GREATER_THAN_START_TIME", "La \"Hora de finalización\" debe ser posterior a la \"Hora de inicio\".");
	//The "End Date" cannot be in past.
	define("LANG_MSG_END_DATE_CANNOT_IN_PAST", "La \"Fecha de finalización\" no puede estar en el pasado.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_ENTER_VALID_EMAIL_ADDRESS", "Especifique una dirección del correo electrónico válido.");
	//Please enter a valid "URL".
	define("LANG_MSG_ENTER_VALID_URL", "Especifique un \"URL\" válido.");
	//Please provide a description with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_DESCRIPTION_WITH_255_CHARS", "Escriba una descripción de no más de 255 caracteres.");
	//Please provide a conditions with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_255_CHARS", "Escriba una condición de no más de 255 caracteres.");
	//Please enter a valid renewal date.
	define("LANG_MSG_ENTER_VALID_RENEWAL_DATE", "Especifique una fecha de renovación válida.");
	//Renewal date must be in the future.
	define("LANG_MSG_RENEWAL_DATE_IN_FUTURE", "La fecha de renovación debe estar en el futuro");
	//Please enter a valid expiration date.
	define("LANG_MSG_ENTER_VALID_EXPIRATION_DATE", "Especifique una fecha de vencimiento válida.");
	//Expiration date must be in the future.
	define("LANG_MSG_EXPIRATION_DATE_IN_FUTURE", "La fecha de vencimiento debe estar en el futuro");
	//Blank space is not allowed for password.
	define("LANG_MSG_BLANK_SPACE_NOT_ALLOWED_FOR_PASSWORD", "No se permite dejar en blanco la contraseña.");
	//"Please enter a password with a maximum of" [PASSWORD_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MAX_CHARS", "Escriba una contraseña de no más de");
	//"Please enter a password with a minimum of" [PASSWORD_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS", "Escriba una contraseña de no menos de");
	//Please enter a valid username.
	define("LANG_MSG_ENTER_VALID_USERNAME", "Especifique un e-mail válido.");
	//Sorry, you can't change this account information
	define("LANG_MSG_YOUCANTCHANGEACCOUNTINFORMATION", "Lo sentimos, no puedes cambiar esta informacion de la cuenta");
	//Password "abc123" not allowed!
	define("LANG_MSG_ABC123_NOT_ALLOWED", "¡No se permite contraseña \"abc123\"!");
	//Passwords do not match. Please enter the same content for "password" and "retype password" fields.
	define("LANG_MSG_PASSWORDS_DO_NOT_MATCH", "Las contraseñas no coinciden. Escriba el mismo texto en los campos \"Contraseña\" y \"Vuelva a escribir la contraseña\".");
	//Spaces are not allowed for username.
	define("LANG_MSG_SPACES_NOT_ALLOWED_FOR_USERNAME", "No se permiten espacios para el e-mail.");
	//Special characters are not allowed for username.
	define("LANG_MSG_SPECIAL_CHARS_NOT_ALLOWED_FOR_USERNAME", "No se permiten caracteres especiales para el e-mail.");
	//"Please type an username with a maximum of" [USERNAME_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MAX_CHARS", "Por favor, escriba un e-mail de no más de");
	//"Please type an username with a minimum of" [USERNAME_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MIN_CHARS", "Por favor, escriba un e-mail de no menos de");
	//Please choose a different username.
	define("LANG_MSG_CHOOSE_DIFFERENT_USERNAME", "Seleccione un e-mail diferente.");
	//Click here if you do not see your category
	define("LANG_MSG_CLICK_TO_ADD_CATEGORY", "Haga clic aquí si no aparece su categoría");
	//Add main category
	define("LANG_MSG_CLICK_TO_ADD_MAINCATEGORY", "Añadir categoría principal");
	//Add sub-category
	define("LANG_MSG_CLICK_TO_ADD_SUBCATEGORY", "Añadir subcategoría");
	//Category title already registered!
	define("LANG_CATEGORY_ALREADY_REGISTERED", "¡Nombre de la categoría ya está registrado!");
	//Category title available!
	define("LANG_CATEGORY_NOT_REGISTERED", "¡Nombre de la categoría disponible!");

	# ----------------------------------------------------------------------------------------------------
	# MENU
	# ----------------------------------------------------------------------------------------------------
	//Dashboard
	define("LANG_MEMBERS_DASHBOARD", "Panel de Control");
	//Manage
	define("LANG_MENU_MANAGE", "Administrar");
	//Add
	define("LANG_MENU_ADD", "Agregar");
	//Sponsor Options
	define("LANG_MENU_MEMBEROPTIONS", "Opciones del Anunciante");
	//Add Listing
	define("LANG_MENU_ADDLISTING", "Agregar Listado");
	//Manage Listings
	define("LANG_MENU_MANAGELISTING", "Administrar Listados");
	//Add Event
	define("LANG_MENU_ADDEVENT", "Agregar Evento");
	//Manage Events
	define("LANG_MENU_MANAGEEVENT", "Administrar Eventos");
	//Add Banner
	define("LANG_MENU_ADDBANNER", "Agregar Banner");
	//Manage Banners
	define("LANG_MENU_MANAGEBANNER", "Administrar Banners");
	//Add Classified
	define("LANG_MENU_ADDCLASSIFIED", "Agregar Clasificado");
	//Manage Classifieds
	define("LANG_MENU_MANAGECLASSIFIED", "Administrar Clasificados");
	//Add Article
	define("LANG_MENU_ADDARTICLE", "Agregar Artículo");
	//Manage Articles
	define("LANG_MENU_MANAGEARTICLE", "Administrar Artículos");
	//Add Deal
	define("LANG_MENU_ADDPROMOTION", "Agregar Oferta");
	//Manage Deals
	define("LANG_MENU_MANAGEPROMOTION", "Administrar Ofertas");
	//Add Post
	define("LANG_MENU_ADDPOST", "Agregar Mensaje");
	//Page not found
	define("LANG_PAGE_NOT_FOUND", "Página no encontrada");
	//Maintenance Page
	define("LANG_MAINTENANCE_PAGE", "Página de Mantenimiento");
	//Payment Options
	define("LANG_MENU_PAYMENTOPTIONS", "Opciones de pago");
	//Check Out
	define("LANG_MENU_CHECKOUT", "Pagar");
	//Make Your Payment
	define("LANG_MENU_MAKEPAYMENT", "Realice su pago");
	//History
	define("LANG_MENU_HISTORY", "Historial");
	//Transaction History
	define("LANG_MENU_TRANSACTIONHISTORY", "Historial de transacciones");
	//Invoice History
	define("LANG_MENU_INVOICEHISTORY", "Historial de facturas");
	//Default Themes
	define("LANG_MENU_CHOOSETHEME", "Temas por Defecto");
	//Schemes
	define("LANG_MENU_CHOOSESCHEME", "Esquemas");
	//Toll free
	define("LANG_LIVE_TOLLFREE", "Contacto");
	//Purchase Now
	define("LANG_LIVE_PURCHASE", "Compre Ahora");

	# ----------------------------------------------------------------------------------------------------
	# SEARCH
	# ----------------------------------------------------------------------------------------------------
	//Search Article
	define("LANG_LABEL_SEARCHARTICLE", "Buscar Artículo");
	//Search Classified
	define("LANG_LABEL_SEARCHCLASSIFIED", "Buscar Clasificado");
	//Search Event
	define("LANG_LABEL_SEARCHEVENT", "Buscar Evento");
	//Search Listing
	define("LANG_LABEL_SEARCHLISTING", "Buscar Listado");
	//Search Deal
	define("LANG_LABEL_SEARCHPROMOTION", "Buscar Oferta");
	//Search the blog
    define("LANG_LABEL_SEARCHBLOG", "Buscar Entrada");
	//Advanced Search
	define("LANG_SEARCH_ADVANCEDSEARCH", "Búsqueda avanzada");
	//Search
	define("LANG_SEARCH_LABELKEYWORD", "Buscar");
	//Location
	define("LANG_SEARCH_LABELLOCATION", "Ubicación");
	//Select a Country
	define("LANG_SEARCH_LABELCBCOUNTRY", "Seleccione un País");
	//Select a Region
	define("LANG_SEARCH_LABELCBREGION", "Select una Región");
	//Select a State
	define("LANG_SEARCH_LABELCBSTATE", "Seleccione un Estado");
	//Select a City
	define("LANG_SEARCH_LABELCBCITY", "Seleccione una Ciudad");
	//Select a Neighborhood
	define("LANG_SEARCH_LABELCBNEIGHBORHOOD", "Seleccione un Barrio");
	//Category
	define("LANG_SEARCH_LABELCATEGORY", "Categoría");
	//Select a Category
	define("LANG_SEARCH_LABELCBCATEGORY", "Seleccione una categoría");
	//Match
	define("LANG_SEARCH_LABELMATCH", "Coincidencia");
	//Exact Match
	define("LANG_SEARCH_LABELMATCH_EXACTMATCH", "Coincidencia Exacta");
	//Any Word
	define("LANG_SEARCH_LABELMATCH_ANYWORD", "Cualquier Palabra");
	//All Words
	define("LANG_SEARCH_LABELMATCH_ALLWORDS", "Todas las Palabras");
	//Listing Type
	define("LANG_SEARCH_LABELBROWSE", "Tipo de Listado");
	//from
	define("LANG_SEARCH_LABELFROM", "de");
	//to
	define("LANG_SEARCH_LABELTO", "a");
	//Miles "of"
	define("LANG_SEARCH_LABELZIPCODE_OF", "millas de");
	//Search by keyword
	define("LANG_LABEL_SEARCHFAQ", "Buscar por palabra clave");
	//Search
	define("LANG_LABEL_SEARCHFAQ_BUTTON", "Buscar");
	//Please provide words with at least [FT_MIN_WORD_LEN] characters for your search.
	define("LANG_MSG_SEARCH_MIN_WORD_LEN", "Sírvanse proporcionar palabras con al menos [FT_MIN_WORD_LEN] letras para la búsqueda.");

	# ----------------------------------------------------------------------------------------------------
	# FRONTEND
	# ----------------------------------------------------------------------------------------------------
	//Featured
	define("LANG_ITEM_FEATURED", "Presentado");
	//Recent Articles
	define("LANG_RECENT_ARTICLE", "Artículos Recientes");
	//Upcoming Events
	define("LANG_UPCOMING_EVENT", "Próximos Eventos");
	//Featured Events
	define("LANG_FEATURED_EVENT", "Eventos Destacados");
	//Featured Event
	define("LANG_FEATURED_EVENT_SING", "Evento Destacado");
	//Featured Classifieds
	define("LANG_FEATURED_CLASSIFIED", "Clasificados Destacados");
	//Featured Classified
	define("LANG_FEATURED_CLASSIFIED_SING", "Clasificado Destacado");
	//Featured Articles
	define("LANG_FEATURED_ARTICLE", "Artículos Destacados");
	//Featured Article
	define("LANG_FEATURED_ARTICLE_SING", "Artículo Destacado");
	//Featured Listings
	define("LANG_FEATURED_LISTING", "Listados Destacados");
	//Featured Listing
	define("LANG_FEATURED_LISTING_SING", "Listado Destacado");
	//Featured Deals
	define("LANG_FEATURED_PROMOTION", "Ofertas Destacadas");
	//Featured Deal
	define("LANG_FEATURED_PROMOTION_SING", "Oferta Destacada");
	//View all articles
	define("LANG_LABEL_VIEW_ALL_ARTICLES", "Ver todos los artículos");
	//View all events
	define("LANG_LABEL_VIEW_ALL_EVENTS", "Ver todos los eventos");
	//View all classifieds
	define("LANG_LABEL_VIEW_ALL_CLASSIFIEDS", "Ver todos los clasificados");
	//View all listings
	define("LANG_LABEL_VIEW_ALL_LISTINGS", "Ver todos los listados");
	//View all deals
	define("LANG_LABEL_VIEW_ALL_PROMOTIONS", "Ver todas las ofertas");
	//Listing with a deal
	define("LANG_LABEL_VIEW_LISTINGDEAL", "Listado con oferta");
	//Most Read
	define("LANG_LABEL_ARTICLE_POPULAR", "Más Leído");
	//Recently Added
	define("LANG_LABEL_ARTICLE_RECENT", "Recientes");
	//Last Tweets
	define("LANG_LAST_TWEETS", "Últimos Tweets");
	//Quick and Easy.
	define("LANG_EASYANDFAST", "Rápido y Fácil.");
	//Just follow the 3 steps
	define("LANG_THREESTEPS", "Sólo tienes que seguir los 3 pasos");
	//4 Steps
	define("LANG_FOURSTEPS", "4 Pasos");
	//Account Signup
	define("LANG_ACCOUNTSIGNUP", "Registrar cuenta");
	//Update your Listing
	define("LANG_LISTINGUPDATE", "Actualización");
	//Order
	define("LANG_ORDER", "Solicitar");
	//Check Out
	define("LANG_CHECKOUT", "Pagar");
	//Configuration
	define("LANG_CONFIGURATION", "Configuración");
	//Select a level
	define("LANG_SELECTPACKAGE", "Seleccionar un nivel");
	//Profile Options
	define("LANG_PROFILE_OPTIONS", "Opciones de Perfil");
	//Directory account
	define("LANG_PROFILE_OPTIONS1", "Cuenta de Directorio");
	//My existing OpenID 2.0 Account
	define("LANG_PROFILE_OPTIONS2", "Mi cuenta de OpenID 2.0");
	//My existing Facebook Account
	define("LANG_PROFILE_OPTIONS3", "Mi cuenta de Facebook");
	//My existing Google Account
	define("LANG_PROFILE_OPTIONS4", "Mi cuenta de Google");
	//Are you already a member?
	define("LANG_ALREADYHAVEACCOUNT", "¿Ya eres miembro?");
	//No, I'm a New User.
	define("LANG_ACCOUNTNEWUSER", "No, soy un Usuario Nuevo.");
	//Yes, I have an Existing Account.
	define("LANG_ACCOUNTEXISTSUSER", "Sí, ya tengo una Cuenta.");
	//Login with your Directory account
	define("LANG_ACCOUNTDIRECTORYUSER", "Inicia sesión con tu cuenta de ".EDIRECTORY_TITLE."");
	//Or login with your OpenID account
	define("LANG_ACCOUNTOPENIDUSER", "O ingresa con tu cuenta de OpenID");
	//Sign in with my existing Facebook Account.
	define("LANG_ACCOUNTFACEBOOKUSER", "Iniciar sesión con mi cuenta de Facebook.");
	//Sign in with my existing Google Account.
	define("LANG_ACCOUNTGOOGLEUSER", "Iniciar sesión con mi cuenta de Google.");
    //Or login with your existing account
    define("LANG_ACCOUNTFBGOOGLEUSER", "O ingresar con su cuenta existente");
	//Account Information
	define("LANG_ACCOUNTINFO", "Informacion de la cuenta");
	//Additional Information
	define("LANG_LABEL_ADDITIONALINFORMATION", "Información Adicional");
	//Please write down your e-mail and password for future reference.
	define("LANG_ACCOUNTINFOMSG", "Tome nota de su nombre de usuario y contraseña para referencia.");
	//"Username must be a valid e-mail between" [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG1", "E-mail debe ser un correo electrónico válido entre ");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] "and" [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG2", "y");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] "characters with no spaces."
	define("LANG_USERNAME_MSG3", "caracteres, sin espacios.");
	//"Password must be between" [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG1", "La contraseña debe tener entre");
	//Password must be between [PASSWORD_MIN_LEN] "and" [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG2", "y");
	//Password must be between [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] "characters with no spaces."
	define("LANG_PASSWORD_MSG3", "caracteres, sin espacios.");
	//I agree with the terms of use
	define("LANG_IGREETERMS", "Acepto los términos de uso");
	//Do you want to advertise with us?
	define("LANG_DOYOUWANT_ADVERTISEWITHUS", "¿Quieres anunciarte con nosotros?");
	//Buy a link
	define("LANG_BUY_LINK", "Comprar un vínculo");
	//Back to Top
	define("LANG_BACKTOTOP", "Volver Arriba");
	//Back to
	define("LANG_BACKTO", "Volver a ");
	//Favorites
	define("LANG_QUICK_LIST", "Favoritos");
	//view summary
	define("LANG_VIEWSUMMARY", "ver resumen");
	//view detail
	define("LANG_VIEWDETAIL", "ver detalles");
	//Advertisers
	define("LANG_ADVERTISER", "Anunciantes");
	//Order Now!
	define("LANG_ORDERNOW", "¡Ordene Ahora!");
	//Wait, Loading...
	define("LANG_WAITLOADING", "Espere, cargando...");
	//Wait, loading filter options...
	define("LANG_WAITLOADING_FILTERS", "Espere, cargando opciones de filtro...");
	//Subtotal Amount
	define("LANG_SUBTOTALAMOUNT", "Subtotal");
	//Subtotal
	define("LANG_SUBTOTAL", "Subtotal");
	//Total Tax Amount
	define("LANG_TAXAMOUNT", "Total de impuestos");
	//Total Price
	define("LANG_TOTALPRICEAMOUNT", "Valor Total");
	//Favorites
	define("LANG_LABEL_QUICKLIST", "Favoritos");
	//No favorites found!
	define("LANG_LABEL_NOQUICKLIST", "¡No se encontraron favoritos!");
	//Search results for
	define("LANG_LABEL_SEARCHRESULTSFOR", "Buscar resultados por");
	//Related Search
	define("LANG_LABEL_RELATEDSEARCH", "Búsqueda Relacionada");
	//Browse by Section
	define("LANG_LABEL_BROWSESECTION", "Búsqueda por sección");
	//What are you looking for?
    define("LANG_LABEL_SEARCHINGFOR", "¿Qué estás buscando?");
    //Where?
    define("LANG_LABEL_SEARCHINGFOR_WHERE", "¿Dónde?");
	//Keyword
	define("LANG_LABEL_SEARCHKEYWORD", "Palabra Clave");
	//Type a keyword
	define("LANG_LABEL_SEARCHKEYWORDTIP", "Escriba una palabra clave");
	//Type a keyword or listing name
	define("LANG_LABEL_SEARCHKEYWORDTIP_LISTING", "Palabra clave o nombre del listado");
	//Type a keyword or deal title
	define("LANG_LABEL_SEARCHKEYWORDTIP_PROMOTION", "Palabra clave o nombre de la oferta");
	//Type a keyword or event title
	define("LANG_LABEL_SEARCHKEYWORDTIP_EVENT", "Palabra clave o nombre del evento");
	//Type a keyword or classified title
	define("LANG_LABEL_SEARCHKEYWORDTIP_CLASSIFIED", "Palabra clave o nombre del clasificado");
	//Type a keyword or article title
	define("LANG_LABEL_SEARCHKEYWORDTIP_ARTICLE", "Palabra clave o nombre del artículo");
	//Where
	define("LANG_LABEL_SEARCHWHERE", "Dónde");
	//Address, City, State or Zip Code
	define("LANG_LABEL_SEARCHWHERETIP", "Dirección, Ciudad, Estado o Código Postal");
	//Wait, searching your location...
	define("LANG_LABEL_WAIT_LOCATION", "En busca de su ubicación...");
	//Complete the form below to contact us.
	define("LANG_LABEL_FORMCONTACTUS", "Complete el siguiente formulario para ponerse en contacto con nosotros.");
	//Message
	define("LANG_LABEL_MESSAGE", "Mensaje");
	//No disabled categories found in the system.
	define("LANG_DISABLED_CATEGORY_NOTFOUND", "No hay encontrado categorías con discapacidad en el sistema.");
	//No categories found.
	define("LANG_CATEGORY_NOTFOUND", "No se encontraron categorías.");
	//Please, select a valid category
	define("LANG_CATEGORY_INVALIDERROR", "Seleccione una categoría válida");
	//Please select a category first!
	define("LANG_CATEGORY_SELECTFIRSTERROR", "¡Seleccione una categoría en primer lugar!");
	//View Category Path
	define("LANG_CATEGORY_VIEWPATH", "Ver ruta de las categorías");
	//Remove Selected Category
	define("LANG_CATEGORY_REMOVESELECTED", "Quitar categoría");
	//"Extra categories cost an" additional [LEVEL_CATEGORY_PRICE] each.
	define("LANG_CATEGORIES_PRICEDESC1", "Las categorías extras cuestan");
	//Extra categories cost an "additional" [LEVEL_CATEGORY_PRICE] each.
	define("LANG_CATEGORIES_PRICEDESC2", "adicional");
	//Extra categories cost an additional [LEVEL_CATEGORY_PRICE] "each."
	define("LANG_CATEGORIES_PRICEDESC3", "cada una.");
	//Maximum of
	define("LANG_CATEGORIES_CATEGORIESMAXTIP1", "Máximo de");
	//allowed.
	define("LANG_CATEGORIES_CATEGORIESMAXTIP2", "categorías permitidas.");
	//Categories and sub-categories
	define("LANG_CATEGORIES_TITLE", "Categorías y subcategorías");
	//Only select sub-categories that directly apply to your type.
	define("LANG_CATEGORIES_MSG1", "Seleccione únicamente subcategorías que se apliquen directamente a su tipo.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_CATEGORIES_MSG2", "Su listado aparecerá automáticamente en la categoría principal de cada subcategoría que seleccione.");
	//Account Information Error
	define("LANG_ACCOUNTINFO_ERROR", "Error de información de la cuenta");
	//Contact Information
	define("LANG_CONTACTINFO", "Información de Contacto");
	//This information will not be displayed publicly.
	define("LANG_CONTACTINFO_MSG", "Esta información no se mostrará al público.");
	//Billing Information
	define("LANG_BILLINGINFO", "Datos de Facturacion");
	//This information will not be displayed publicly.
	define("LANG_BILLINGINFO_MSG1", "Esta información no se mostrará al público.");
	//You will configure your article after placing the order.
	define("LANG_BILLINGINFO_MSG2_ARTICLE", "Deberá configurar su artículo después de realizar el pedido.");
	//You will configure your banner after placing the order.
	define("LANG_BILLINGINFO_MSG2_BANNER", "Deberá configurar su banner después de realizar el pedido.");
	//You will configure your classified after placing the order.
	define("LANG_BILLINGINFO_MSG2_CLASSIFIED", "Deberá configurar su clasificado después de realizar el pedido.");
	//You will configure your event after placing the order.
	define("LANG_BILLINGINFO_MSG2_EVENT", "Deberá configurar su evento después de realizar el pedido.");
	//You will configure your listing after placing the order.
	define("LANG_BILLINGINFO_MSG2_LISTING", "Deberá configurar su listado después de realizar el pedido.");
	//Billing Information Error
	define("LANG_BILLINGINFO_ERROR", "Error de información de cuentas");
    //Or back to previous page
    define("LANG_ADVERTISE_BACK", "O volver a la página anterior");
	//Checking out
	define("LANG_ADVERTISE_CHECKOUT", "Verificando");
    //Listing [level]
    define("LANG_ADVERTISE_LISTINGLEVEL", "Listado [level]");
    //Event [level]
    define("LANG_ADVERTISE_EVENTLEVEL", "Evento [level]");
    //Classified [level]
    define("LANG_ADVERTISE_CLASSIFIEDLEVEL", "Clasificado [level]");
    //Article [level]
    define("LANG_ADVERTISE_ARTICLELEVEL", "Artículo [level]");
    //Banner [level]
    define("LANG_ADVERTISE_BANNERLEVEL", "Banner [level]");
    //Identification
    define("LANG_ADVERTISE_IDENTIFICATION", "Identificación");
    //Confirmation
    define("LANG_ADVERTISE_CONFIRMATION", "Confirmación");
    //Please, login with your account or sign up today.
    define("LANG_ADVERTISE_SIGNUP", "Por favor, ingresa con tu cuenta o regístrate hoy.");
    //I'm already a user
    define("LANG_ADVERTISE_SIGNUP_ALREADYUSER", "Ya soy un usuario");
    //I'm a new user
    define("LANG_ADVERTISE_SIGNUP_NEWUSER", "Soy un nuevo usuario");
    //Create a new account now.
    define("LANG_ADVERTISE_CREATE_ACC", "Crea una cuenta nueva ahora.");
    //Billing Detail
    define("LANG_ADVERTISE_BILLINGDETAIL", "Detalle de Facturación");
    //A quick overview of how much you will be charged.
    define("LANG_ADVERTISE_BILLINGDETAIL_TIP", "Un resumen rápido de lo mucho que se le cobrará.");
    //Payment
    define("LANG_ADVERTISE_PAYMENT", "Pago");
    //Make your payment and finish your order.
    define("LANG_ADVERTISE_PAYMENT_TIP", "Haga su pago y terminar el pedido.");
    //Print your invoice and finish your order.
    define("LANG_ADVERTISE_PAYMENT_TIP2", "Imprima su factura y termine su orden.");
    //Thank you for your order!
    define("LANG_ADVERTISE_THANKYOU", "Gracias por su pedido!");
    //Order Description
    define("LANG_ADVERTISE_ORDERDESC", "Descripción del Pedido");
    //A brief summary of your order.
    define("LANG_ADVERTISE_ORDERDESC_TIP", "Un breve resumen de tu pedido.");
    //Thanks!
    define("LANG_ADVERTISE_THANKS", "¡gracias!");
    //Already registered users should use
    define("LANG_ADVERTISE_ALREADYUSER1", "Los usuarios ya registrados deben utilizar");
    //members check out area
    define("LANG_ADVERTISE_ALREADYUSER2", "miembros echa un vistazo a la zona");
    //You are already logged as
    define("LANG_ADVERTISE_LOGGED_AS", "Usted ya está registrado como");
	//Most Popular
	define("LANG_ADVERTISE_POPULAR", "Más Popular");
	//days free trial!
	define("LANG_ADVERTISE_TRIAL", "días de prueba gratuita!");
	//after
	define("LANG_AFTER", "después");
	//View Sample
	define("LANG_ADVERTISE_SAMPLE", "Ver Ejemplo");
	//Have any questions?
	define("LANG_ADVERTISE_QUESTIONS", "¿Tiene alguna pregunta?");
	//Contact us today
	define("LANG_ADVERTISE_CONTACT", "Póngase en contacto con nosotros hoy");
	//No Tax
	define("LANG_ADVERTISE_NOTAX", "Sin Impuesto");
	//Article Information
	define("LANG_ARTICLEINFO", "Información del Artículo");
	//Article Information Error
	define("LANG_ARTICLEINFO_ERROR", "Error de información del Artículo");
	//Banner Information
	define("LANG_BANNERINFO", "Información del Banner");
	//Banner Information Error
	define("LANG_BANNERINFO_ERROR", "Error de información del Banner");
	//Classified Information
	define("LANG_CLASSIFIEDINFO", "Información del Clasificado");
	//Classified Information Error
	define("LANG_CLASSIFIEDINFO_ERROR", "Error de información del Clasificado");
	//Browse Events by Date
	define("LANG_BROWSEEVENTSBYDATE", "Buscar Eventos por Fecha");
	//Event Information
	define("LANG_EVENTINFO", "Información del Evento");
	//Event Information Error
	define("LANG_EVENTINFO_ERROR", "Error de información del Evento");
	//Listing Information
	define("LANG_LISTINGINFO", "Información del Listado");
    //What do you want to call your listing? This is normally your company name.
	define("LANG_LISTINGINFO_TIP", "¿Qué es lo que quiere llamar tu listado? Este es normalmente el nombre de su empresa.");
    //Choose a template applicable to your business type if you feel the need too.
	define("LANG_LISTINGINFO_TIP2", "Elija una plantilla aplicable a su tipo de negocio si usted siente la necesidad también.");
    //What do you want to call your event?
	define("LANG_EVENTINFO_TIP", "¿Como quiere llamar a su evento?");
    //What do you want to call your classified?
	define("LANG_CLASSIFIEDINFO_TIP", "¿Como quiere llamar a su clasificado?");
    //What do you want to call your article?
	define("LANG_ARTICLEINFO_TIP", "¿Como quiere llamar a su artículo?");
    //What do you want to call your banner?
	define("LANG_BANNERINFO_TIP", "¿Como quiere llamar a su banner?");
	//Listing Information Error
	define("LANG_LISTINGINFO_ERROR", "Error de información del Listado");
	//Claim this Listing
	define("LANG_LISTING_CLAIMTHIS", "Reclame este Listado");
	//Claiming
	define("LANG_LISTING_CLAIMING", "Reclamando");
	//To claim this listing, just log in with your existing account details or create a new account.
	define("LANG_CLAIM_SIGNUP", "Para reclamar este listado, sólo tienes que ingresar a su cuenta o crear una nueva.");
	//Listing Type
	define("LANG_LISTING_LABELTEMPLATE", "Tipo de listado");
	//No results were found for the search criteria you requested.
	define("LANG_MSG_NORESULTS", "No se encontraron resultados para los criterios de búsqueda requeridos.");
	//Please try your search again or browse by section.
	define("LANG_MSG_TRYAGAIN_BROWSESECTION", "Intente la búsqueda nuevamente o busque por sección.");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword and perform your search again.
	define("LANG_MSG_USE_SPECIFIC_KEYWORD", "Es posible que, a veces, la búsqueda no arroje resultados, ya que la palabra clave usada es demasiado genérica. Realice una nueva búsqueda con una palabra clave más específica.");
	//Please type at least one keyword on the search box.
	define("LANG_MSG_LEASTONEKEYWORD", "Escriba al menos una palabra clave en el cuadro de búsqueda.");
	//"No results content"
	define("LANG_SEARCH_NORESULTS", "<h1>No hay resultados para su búsqueda</h1><p>Su búsqueda me devuelve ningún resultado. Aunque esto es poco frecuente, que ocurre de vez en cuando, cuando el término de búsqueda que ha utilizado es un genérico poco o cuando en realidad no tienen ningún contenido coincidente.</p><h2>Sugerencias:</h2>&raquo;Sea más específico con los términos de búsqueda<br />&raquo;Revisa tu ortografía<br />&raquo;Si usted no puede encontrar a través de la búsqueda de tratar de navegar por la sección<br /><br /><p>Si creemos que usted ha venido aquí por error, por favor póngase en contacto con el administrador del sitio para reportar un problema.</p>");
	//Image
	define("LANG_SLIDESHOW_IMAGE", "Imagen");
	//of
	define("LANG_SLIDESHOW_IMAGEOF", "de");
	//Error loading image
	define("LANG_SLIDESHOW_IMAGELOADINGERROR", "Error al cargar imagen");
	//Next
	define("LANG_SLIDESHOW_NEXT", "Siguiente");
	//Pause
	define("LANG_SLIDESHOW_PAUSE", "Pausa");
	//Play
	define("LANG_SLIDESHOW_PLAY", "Reproducir");
	//Back
	define("LANG_SLIDESHOW_BACK", "Volver");
	//Your e-mail has been sent. Thank you.
	define("LANG_CONTACTMSGSUCCESS", "Se envió su mensaje de correo electrónico. Gracias.");
	//There was a problem sending this e-mail. Please try again later.
	define("LANG_CONTACTMSGFAILED", "Hubo un problema al enviar este mensaje de correo electrónico. Intente de nuevo.");
	//Please enter your name.
	define("LANG_MSG_CONTACT_ENTER_NAME", "Por favor ingrese su nombre.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_CONTACT_ENTER_VALID_EMAIL", "¡Escriba una dirección de correo electrónico válida.");
	//Please type the message.
	define("LANG_MSG_CONTACT_TYPE_MESSAGE", "¡Escriba un mensaje.");
	//Please type the code correctly or mark the checkbox if available.
	define("LANG_MSG_CONTACT_TYPE_CODE", "¡Escriba el código correctamente o marque la casilla si está disponible.");
	//Please correct it and try again.
	define("LANG_MSG_CONTACT_CORRECTIT_TRYAGAIN", "Por favor corríjalo e intente de nuevo.");
	//Please type a name.
	define("LANG_MSG_CONTACT_TYPE_NAME", "Escriba un nombre.");
	//Please type a subject.
	define("LANG_MSG_CONTACT_TYPE_SUBJECT", "Escriba un asunto.");
	//SOME DETAILS
	define("LANG_ARTICLE_TOFRIEND_MAIL", "ALGUNOS DETALLES");
	//SOME DETAILS
	define("LANG_CLASSIFIED_TOFRIEND_MAIL", "ALGUNOS DETALLES");
	//SOME DETAILS
	define("LANG_EVENT_TOFRIEND_MAIL", "ALGUNOS DETALLES");
	//SOME DETAILS
	define("LANG_LISTING_TOFRIEND_MAIL", "ALGUNOS DETALLES");
	//SOME DETAILS
	define("LANG_PROMOTION_TOFRIEND_MAIL", "ALGUNOS DETALLES");
	//Please enter a valid e-mail address in the "To" field
	define("LANG_MSG_TOFRIEND1", "Escriba una dirección de correo electrónico válida en el campo \"Para\"");
	//Please enter a valid e-mail address in the "From" field
	define("LANG_MSG_TOFRIEND2", "Escriba una dirección de correo electrónico válida en el campo \"De\"");
	//"Item not found. Please return to" [YOURSITE] and try again.
	define("LANG_MSG_TOFRIEND3", "Artículo no encontrado. Por favor, regrese a");
	//We could not find the item you're trying to send to a friend. Please return to [YOURSITE] "and try again."
	define("LANG_MSG_TOFRIEND4", "y vuelve a intentarlo.");
	//Please enter a valid e-mail address in the "Your E-mail" field
	define("LANG_MSG_TOFRIEND5", "Escriba una dirección de correo electrónico válida en el campo \"Su correo electrónico\"");
	//"About" [ARTICLE_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_1", "Acerca de");
	//About [ARTICLE_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_2", "del");
	//"About" [CLASSIFIED_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_1", "Acerca de");
	//About [CLASSIFIED_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_2", "del");
	//"About" [EVENT_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_1", "Acerca de");
	//About [EVENT_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_2", "del");
	//"About" [LISTING_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_1", "Acerca de");
	//About [LISTING_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_2", "del");
	//"About" [PROMOTION_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_1", "Acerca de");
	//About [PROMOTION_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_2", "del");
	//Send info about this article to a friend
	define("LANG_ARTICLE_TOFRIEND_SAUDATION", "Enviar información acerca de este artículo a un amigo");
	//Send info about this classified to a friend
	define("LANG_CLASSIFIED_TOFRIEND_SAUDATION", "Enviar información acerca de este clasificado a un amigo");
	//Send info about this event to a friend
	define("LANG_EVENT_TOFRIEND_SAUDATION", "Enviar información acerca de este evento a un amigo");
	//Send info about this listing to a friend
	define("LANG_LISTING_TOFRIEND_SAUDATION", "Enviar información acerca del listado a un amigo");
	//Send info about this deal to a friend
	define("LANG_PROMOTION_TOFRIEND_SAUDATION", "Enviar información acerca de esta Oferta a un amigo");
	//Message sent by
	define("LANG_MESSAGE_SENT_BY", "Mensaje enviado por ");
	//This is a automatic message.
	define("LANG_THIS_IS_A_AUTOMATIC_MESSAGE", "Este es un mensaje automático.");
	//Contact
	define("LANG_CONTACT", "Contacto");
	//article
	define("LANG_ARTICLE", "artículo");
	//classified
	define("LANG_CLASSIFIED", "clasificado");
	//event
	define("LANG_EVENT", "evento");
	//listing
	define("LANG_LISTING", "listado");
	//deal
	define("LANG_PROMOTION", "oferta");
	//Please search at least one parameter on the search box!
	define("LANG_MSG_LEASTONEPARAMETER", "¡Busque al menos un parámetro en el cuadro de búsqueda!");
	//Please try your search again.
	define("LANG_MSG_TRYAGAIN", "Por favor intente su búsqueda de nuevo.");
	//No articles registered yet.
	define("LANG_MSG_NOARTICLES", "Aún no hay artículos registrados.");
	//No classifieds registered yet.
	define("LANG_MSG_NOCLASSIFIEDS", "Aún no hay clasificados registrados.");
	//No events registered yet.
	define("LANG_MSG_NOEVENTS", "Aún no hay eventos registrados.");
	//No listings registered yet.
	define("LANG_MSG_NOLISTINGS", "Aún no hay listados registrados.");
	//No deals registered yet.
	define("LANG_MSG_NOPROMOTIONS", "Aún no hay ofertas registradas.");
	//Message sent through
	define("LANG_CONTACTPRESUBJECT", "Mensaje enviado por medio de");
	//E-mail Form
	define("LANG_EMAILFORM", "Formulario de correo electrónico");
	//Click here to print
	define("LANG_PRINTCLICK", "Haga clic aquí para imprimir");
	//View all classified categories
	define("LANG_CLASSIFIED_VIEWALLCATEGORIES", "Ver todas las categorías");
	//Location
	define("LANG_CLASSIFIED_LOCATIONS", "Ubicación");
	//More Classifieds
	define("LANG_CLASSIFIED_MORE", "Más Clasificados");
	//View all event categories
	define("LANG_EVENT_VIEWALLCATEGORIES", "Ver todas las categorías");
	//Location
	define("LANG_EVENT_LOCATIONS", "Ubicación");
	//Featured Events
	define("LANG_EVENT_FEATURED", "Eventos Destacados");
	//events
	define("LANG_EVENT_PLURAL", "Eventos");
	//Search results
	define("LANG_SEARCHRESULTS", "Resultados de la búsqueda");
	//Results
	define("LANG_RESULTS", "Resultados");
	//Result
	define("LANG_RESULT", "Resultado");
    //Letter
    define("LANG_LETTER", "Letra");
	//Search results "for" keyword
	define("LANG_SEARCHRESULTS_KEYWORD", "para");
	//Search results "in" where
	define("LANG_SEARCHRESULTS_WHERE", "en");
	//Search results "in" template
	define("LANG_SEARCHRESULTS_TEMPLATE", "en");
	//Search results "in" category
	define("LANG_SEARCHRESULTS_CATEGORY", "en");
	//Search results "in category"
	define("LANG_SEARCHRESULTS_INCATEGORY", "en la categoría");
	//Search results "in" location
	define("LANG_SEARCHRESULTS_LOCATION", "en");
	//Search results "in" zip
	define("LANG_SEARCHRESULTS_ZIP", "en");
	//Search results "for" date
	define("LANG_SEARCHRESULTS_DATE", "para");
	//Search results - "Page" X
	define("LANG_SEARCHRESULTS_PAGE", "Página");
	//Recent Reviews
	define("LANG_RECENT_REVIEWS", "Calificaciones Recientes");
	//Reviews of
	define("LANG_REVIEWSOF", "Revisiones de");
	//Reviews are disabled
	define("LANG_REVIEWDISABLE", "Las calificaciones están desactivadas");
	//View all article categories
	define("LANG_ARTICLE_VIEWALLCATEGORIES", "Ver todas las categorías");
	//View all deal categories
	define("LANG_PROMOTION_VIEWALLCATEGORIES", "Ver todas las categorías");
    //View all blog categories
    define("LANG_BLOG_VIEWALLCATEGORIES", "Ver todas las categorías");
	//Offer
	define("LANG_PROMOTION_OFFER", "Oferta");
	//Description
	define("LANG_PROMOTION_DESCRIPTION", "Descripción");
	//Conditions
	define("LANG_PROMOTION_CONDITIONS", "Condiciones");
	//Location
	define("LANG_PROMOTION_LOCATIONS", "Ubicación");
	//Item not found!
	define("LANG_MSG_NOTFOUND", "¡No se encontró el elemento!");
	//Item not available!
	define("LANG_MSG_NOTAVAILABLE", "¡El elemento no está disponible!");
	//Listing Search Results
	define("LANG_MSG_LISTINGRESULTS", "Resultados de la Búsqueda de Listados");
	//Deal Search Results
	define("LANG_MSG_PROMOTIONRESULTS", "Resultados de la Búsqueda de Ofertas");
	//Event Search Results
	define("LANG_MSG_EVENTRESULTS", "Resultados de la Búsqueda de Eventos");
	//Classified Search Results
	define("LANG_MSG_CLASSIFIEDRESULTS", "Resultados de la Búsqueda de Clasificados");
	//Article Search Results
	define("LANG_MSG_ARTICLERESULTS", "Resultados de la Búsqueda de Artículos");
	//Available Languages
	define("LANG_MSG_AVAILABLELANGUAGES", "Idiomas Disponibles");
	//You can choose up to [MAX_ENABLED_LANGUAGES] of the languages below for your directory.
	define("LANG_MSG_AVAILABLELANGUAGESMSG", "Usted puede elegir un máximo de ".MAX_ENABLED_LANGUAGES." de los idiomas para su directorio.");
	//Redeem without Facebook
    define("LANG_DEAL_DONTUSEFACEBOOK", "Validar sin Facebook");
	//posted on facebook and twitter
	define("LANG_DEAL_POSTFACEBOOK_TWITTER", "publicado en Facebook y Twitter");
	//posted on facebook
	define("LANG_DEAL_POSTFACEBOOK", "publicado en Facebook");
	//posted on twitter
	define("LANG_DEAL_TWITTER", "publicado en Twitter");
	//Posted on
	define("LANG_LABEL_POSTED_ON", "publicado en");
	//deal checked out
	define("LANG_DEAL_CHECKOUT", "oferta usada");
	//deal opened
	define("LANG_DEAL_OPENED", "oferta abierta");
	//Terms & Conditions
	define("LANG_LABEL_DEAL_CONDITIONS", "Términos y Condiciones");
	//maximum 1000 characters
	define("LANG_MSG_MAX_1000_CHARS", "máximo 1000 caracteres");
	//Please provide a conditions with a maximum of 1000 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_1000_CHARS", "Escriba condiciones de no más de 1000 caracteres.");
	//See All
	define("LANG_LABEL_SEE_ALL", "Ver Todos");
	//Stars
	define("LANG_LABEL_STARS", "Estrellas");
	//Star
	define("LANG_LABEL_STAR", "Estrella");
	//Terms of Use
    define("LANG_TERMS_USE", "Términos de Uso");
	//Privacy Policy
	define("LANG_PRIVACY_POLICY", "Política de Privacidad");
	//Size
    define("LANG_ADVERTISE_SIZE", "Dimensiones");
	//Title / Address
	define("LANG_ADVERTISE_LIST_TITLE_ADDRESS", "Título / Dirección");
	//Title
	define("LANG_ADVERTISE_LIST_TITLE", "Título");
	//Ratings and Reviews
	define("LANG_ADVERTISE_LIST_REVIEW", "Evaluaciones y Opiniones");
	//Detail View
	define("LANG_ADVERTISE_LIST_DETAIL_VIEW", "Detallado");
	//Deal
	define("LANG_ADVERTISE_LIST_DEAL", "Oferta");
	//Send to Phone
	define("LANG_ADVERTISE_LIST_SEND_TO_PHONE", "Enviar a Teléfono");
	//Click to Call
	define("LANG_ADVERTISE_LIST_CLICK_TO_CALL", "Haga clic para llamar");
	//Phone
	define("LANG_ADVERTISE_LIST_PHONE", "Teléfono");
	//E-mail
	define("LANG_ADVERTISE_LIST_EMAIL", "E-mail");
	//Url
	define("LANG_ADVERTISE_LIST_URL", "Url");
	//Fax Number
	define("LANG_ADVERTISE_LIST_FAX", "Fax");
	//Summary Description
	define("LANG_ADVERTISE_LIST_SUMMARY_DESCRIPTION", "Descripción breve");
	//Badges
	define("LANG_ADVERTISE_LIST_BADGES", "Clasificaciones");
	//Detail Description
	define("LANG_ADVERTISE_LIST_LONG_DESCRIPTION", "Descripción Detallada");
	//Photo Gallery
	define("LANG_ADVERTISE_LIST_MAIN_IMAGE", "Galería de Fotos");
	//Video
	define("LANG_ADVERTISE_LIST_VIDEO", "Vídeo");
	//Additional Uploads
	define("LANG_ADVERTISE_LIST_ATTACHMENT_FILE", "Cargas adicionales");
	//Hours
	define("LANG_ADVERTISE_LIST_HOURS_OF_WORK", "Horas de Trabajo");
	//Location reference
	define("LANG_ADVERTISE_LIST_LOCATIONS", "Referencia de Ubicación");
	//Features
	define("LANG_ADVERTISE_LIST_FEATURES", "Características");
	//Facebook Social Plugin
	define("LANG_ADVERTISE_LIST_FBPAGE", "Página de Facebook");
	//Contact Name
	define("LANG_ADVERTISE_LIST_CONTACT_NAME", "Nombre de Contacto");
	//Contact Phone
	define("LANG_ADVERTISE_LIST_CONTACT_PHONE", "Teléfono de Contacto");
	//Contact E-mail
	define("LANG_ADVERTISE_LIST_CONTACT_EMAIL", "Correo electronico del Contacto");
	//Event Time
	define("LANG_ADVERTISE_LIST_START_TIME", "Hora del Evento");
	//Price
	define("LANG_ADVERTISE_LIST_PRICE", "Precio");
	//Publication Date
	define("LANG_ADVERTISE_LIST_PUBLICATION", "Fecha de Publicación");
	//Author
	define("LANG_ADVERTISE_LIST_AUTHOR", "Autor");
	//Abstract
	define("LANG_ADVERTISE_LIST_ABSTRACT", "Resumen");
	//Content
	define("LANG_ADVERTISE_LIST_CONTENT", "Contenido");
    //Social Networking Pages
    define("LANG_ADVERTISE_LIST_SOCIAL_NETWORK", "Páginas de Redes Sociales ");

	# ----------------------------------------------------------------------------------------------------
	# MANAGE MODULES ORDINATION
	# ----------------------------------------------------------------------------------------------------
	//Click here to order by descending title
	define("LANG_CLICK_ORDERTITLEDESC", "Haga clic aquí para ordenar por título descendente");
	//Click here to order by ascending title
	define("LANG_CLICK_ORDERTITLEASC", "Haga clic aquí para ordenar por título ascendente");
	//Click here to order by descending level
	define("LANG_CLICK_ORDERLEVELDESC", "Haga clic aquí para ordenar por nivel descendente");
	//Click here to order by ascending level
	define("LANG_CLICK_ORDERLEVELASC", "Haga clic aquí para ordenar por nivel ascendente");
	//Click here to order by descending account
	define("LANG_CLICK_ORDERACCOUNTDESC", "Haga clic aquí para ordenar por cuenta descendente");
	//Click here to order by ascending account
	define("LANG_CLICK_ORDERACCOUNTASC", "Haga clic aquí para ordenar por cuenta ascendente");
	//Click here to order by descending status
	define("LANG_CLICK_ORDERSTATUSDESC", "Haga clic aquí para ordenar por estado descendente");
	//Click here to order by ascending status
	define("LANG_CLICK_ORDERSTATUSASC", "Haga clic aquí para ordenar por estado ascendente");
	//Click here to order by descending caption
	define("LANG_CLICK_ORDERCAPTIONDESC", "Haga clic aquí para ordenar por epígrafe descendente");
	//Click here to order by ascending caption
	define("LANG_CLICK_ORDERCAPTIONASC", "Haga clic aquí para ordenar por epígrafe ascendente");
	//Click here to order by descending type
	define("LANG_CLICK_ORDERTYPEDESC", "Haga clic aquí para ordenar por tipo descendente");
	//Click here to order by ascending type
	define("LANG_CLICK_ORDERTYPEASC", "Haga clic aquí para ordenar por tipo ascendente");
	//Click here to order by descending renewal date
	define("LANG_CLICK_ORDERRENEWALDESC", "Haga clic aquí para ordenar por fecha de renovación descendente");
	//Click here to order by ascending renewal date
	define("LANG_CLICK_ORDERRENEWALASC", "Haga clic aquí para ordenar por fecha de renovación ascendente");
	//Click here to order by descending impressions
	define("LANG_CLICK_ORDERIMPRESSIONSDESC", "Haga clic aquí para ordenar por impresiones descendente");
	//Click here to order by ascending impressions
	define("LANG_CLICK_ORDERIMPRESSIONSASC", "Haga clic aquí para ordenar por impresiones ascendente");
	//Click here to order by descending start date
	define("LANG_CLICK_ORDERSTARTDATEDESC", "Haga clic aquí para ordenar por fecha de inicio descendente");
	//Click here to order by ascending start date
	define("LANG_CLICK_ORDERSTARTDATEASC", "Haga clic aquí para ordenar por fecha de inicio ascendente");

	# ----------------------------------------------------------------------------------------------------
	# MEMBERS
	# ----------------------------------------------------------------------------------------------------
	//Your item has been paid, so you can add a maximum of 3 categories free.
	define("LANG_ITEM_ALREADY_HAS_PAID", "Su artículo ha sido pagado, puede añadir un máximo de [max] categorías gratis.");
	//Your item has been paid, so you can add a maximum of 1 category free.
	define("LANG_ITEM_ALREADY_HAS_PAID2", "Su artículo ha sido pagado, puede añadir un máximo de [max] categoría gratis.");
	//Video Snippet Code TIP
	define("LANG_VIDEO_SNIPPETTIP", "¿Tiene una pregunta sobre el Video de fragmento de código? Haga clic aquí.");
	//Enjoy our Services!
	define("LANG_ENJOY_OUR_SERVICES", "¡Disfrute nuestros servicios!");
	//Remove association with
	define("LANG_REMOVE_ASSOCIATION_WITH", "Quitar asociación con");
	//Welcome
	define("LANG_LABEL_WELCOME", "Bienvenido");
	//Sponsor Options
	define("LANG_LABEL_MEMBER_OPTIONS", "Opciones del Anunciante");
	//Back to Website
	define("LANG_LABEL_BACK_TO_SEARCH", "Volver a Sitio Web");
	//Add New Account
	define("LANG_LABEL_ADD_NEW_ACCOUNT", "Agregar nueva cuenta");
	//Forgotten password
	define("LANG_LABEL_FORGOTTEN_PASSWORD", "Contraseña olvidada");
	//Click here
	define("LANG_LABEL_CLICK_HERE", "Haga clic aquí");
	//Help
	define("LANG_LABEL_HELP", "Ayuda");
	//Reset Password
	define("LANG_LABEL_RESET_PASSWORD", "Restablecer Contraseña");
	//Account and Contact Information
	define("LANG_LABEL_ACCOUNT_AND_CONTACT_INFO", "Información del contacto y de la cuenta");
	//Signup Notification
	define("LANG_LABEL_SIGNUP_NOTIFICATION", "Notificación al registrarse");
	//Go to Sign in
	define("LANG_LABEL_GO_TO_LOGIN", "Ir a Inicio de sesión");
	//Order
	define("LANG_LABEL_ORDER", "Solicitar");
	//Check Out
	define("LANG_LABEL_CHECKOUT", "Pagar");
	//Configuration
	define("LANG_LABEL_CONFIGURATION", "Configuración");
	//Category Detail
	define("LANG_LABEL_CATEGORY_DETAIL", "Detalle de la categoría");
	//Site manager
	define("LANG_LABEL_SITE_MANAGER", "Administrador del sitio");
	//Summary page
	define("LANG_LABEL_SUMMARY_PAGE", "Página de Resumen");
	//Detail page
	define("LANG_LABEL_DETAIL_PAGE", "Página de Detalles");
	//Photo Gallery
	define("LANG_LABEL_PHOTO_GALLERY", "Galería de fotos");
	//To select a main image, simply click on it.
	define("LANG_LABEL_PHOTO_GALLERY_MAIN", "Para seleccionar una imagen principal, basta con hacer clic en él.");
	//Add Banner
	define("LANG_LABEL_ADDBANNER", "Agregar Banner");
	//Custom Invoice Title
	define("LANG_LABEL_CUSTOM_INVOICE_TITLE", "Nombre de la factura personalizada");
	//Custom Invoice Items
	define("LANG_LABEL_CUSTOM_INVOICE_ITEMS", "Elementos de la factura personalizada");
	//Easy and Fast.
	define("LANG_LABEL_EASY_AND_FAST", "Fácil y rápido.");
	//Steps
	define("LANG_LABEL_STEPS", "Pasos");
	//Account Signup
	define("LANG_LABEL_ACCOUNT_SIGNUP", "Registrar cuenta");
	//Select a Level
	define("LANG_LABEL_SELECT_PACKAGE", "Seleccionar un Nivel");
	//Payment Status
	define("LANG_LABEL_PAYMENTSTATUS", "Estado del pago");
	//Expiration
	define("LANG_LABEL_EXPIRATION", "Vencimiento");
	//New Deal
	define("LANG_LABEL_ADDNEWPROMOTION", "Nueva Oferta");
	//Add a new deal
	define("LANG_LABEL_ADDANEWPROMOTION", "Agregar una nueva oferta");
	//Manage Billing
	define("LANG_LABEL_MANAGEBILLING", "Administrar Cuentas");
	//Click here if you have your password already.
	define("LANG_MSG_CLICK_IF_YOU_HAVE_PASSWORD", "Haga clic aquí si ya tiene una contraseña.");
	//Not a sponsor?
	define("LANG_MSG_NOT_A_MEMBER", "¿No es un anunciante?");
	//for information on adding your item to
	define("LANG_MSG_FOR_INFORMATION_ON_ADDING_YOUR_ITEM", "para obtener información acerca de cómo agregar su elemento a");
	//Welcome to the Sponsor Section
	define("LANG_MSG_WELCOME", "Bienvenido a la Sección de Anunciante");
	//Welcome to the Member Section
	define("LANG_MSG_WELCOME2", "Bienvenido a la Sección de Miembros");
	//"Account locked. Wait" X minute(s) and try again.
	define("LANG_MSG_ACCOUNTLOCKED1", "Cuenta bloqueada. Espere");
	//Account locked. Wait X "minute(s) and try again."
	define("LANG_MSG_ACCOUNTLOCKED2", "minuto(s) e intente nuevamente.");
	//One or more required fields were not filled in. Please confirm that all required information has been entered before continuing.
	define("LANG_MSG_FOREIGNACCOUNTWARNING", "Uno o más campos obligatorios no se llenaron. Por favor, confirme que toda la información requerida fue ingresada antes de continuar.");
	//You don't have access permission from this IP address!
	define("LANG_MSG_YOUDONTHAVEACCESSFROMTHISIPADDRESS", "¡Usted no tiene permiso de acceso de esta dirección IP!");
	//Your account was deactivated!
	define("LANG_MSG_ACCOUNT_DEACTIVE", "¡Tu cuenta ha sido desactivado!");
	//Sorry, your username or password is incorrect.
	define("LANG_MSG_USERNAME_OR_PASSWORD_INCORRECT", "El correo electronico o la contraseña son incorrectos.");
	//Sorry, wrong account.
	define("LANG_MSG_WRONG_ACCOUNT", "Cuenta errónea.");
	//Sorry, for your protection the link sent to your e-mail has expired. If you forgot your password click on the link below.
	define("LANG_MSG_WRONG_KEY", "Lo sentimos, para su protección en el vínculo enviado a su correo electrónico ha vencido. Si has olvidado su contraseña, haga clic en el enlace de abajo.");
	//Invalid activation key.
    define("LANG_MSG_WRONG_ACTIVATION_KEY", "Clave de activación inválida.");
    //Account successfully activated!
    define("LANG_MSG_ACCOUNT_ACTIVATED", "¡Cuenta activada con éxito!");
    //OpenID Server not available!
	define("LANG_MSG_OPENID_SERVER", "¡El servidor OpenID no está disponible!");
	//Error requesting OpenID Server!
	define("LANG_MSG_OPENID_ERROR", "¡Error al llamar al servidor de OpenID!");
	//OpenID request canceled!
	define("LANG_MSG_OPENID_CANCEL", "¡Solicitud OpenID cancelada!");
	//Google request canceled!
	define("LANG_MSG_GOOGLE_CANCEL", "¡Solicitud Google  cancelada!");
	//Invalid OpenID Identity!
	define("LANG_MSG_OPENID_INVALID", "¡Identidad de OpenID no valida!");
	//Forgot your password?
	define("LANG_MSG_FORGOT_YOUR_PASSWORD", "¿Olvidó su contraseña?");
	//What is OpenID?
	define("LANG_MSG_WHATISOPENID", "¿Qué es OpenID?");
	//What is Facebook?
	define("LANG_MSG_WHATISFACEBOOK", "¿Qué es Facebook?");
	//What is Google?
	define("LANG_MSG_WHATISGOOGLE", "¿Qué es Google?");
	//Account successfully updated!
	define("LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED", "¡Se actualizó correctamente la cuenta!");
	//Password successfully updated!
	define("LANG_MSG_PASSWORD_SUCCESSFULLY_UPDATED", "¡Contraseña correctamente actualizada!");
	//"Thank you for signing up for an account in" [EDIRECTORY_TITLE]
	define("LANG_MSG_THANK_YOU_FOR_SIGNING_UP", "Gracias por registrar su cuenta en");
	//Sign in to manage your account with the e-mail and password below.
	define("LANG_MSG_LOGIN_TO_MANAGE_YOUR_ACCOUNT", "Inicie sesión para administrar su cuenta con el correo electrónico y la contraseña que figuran a continuación.");
	//You can see
	define("LANG_MSG_YOU_CAN_SEE", "Usted puede ver");
	//Your account in
	define("LANG_MSG_YOUR_ACCOUNT_IN", "Su cuenta en");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_ARTICLE_WILL_SHOW", "Este artículo mostrará");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_CLASSIFIED_WILL_SHOW", "Este clasificado mostrará");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_EVENT_WILL_SHOW", "Este evento mostrará");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_LISTING_WILL_SHOW", "Este listado mostrará");
	//This [ITEM] will show [UNLIMITED|"the max of" X] images per gallery.
	define("LANG_MSG_THE_MAX_OF", "la cantidad máxima de");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTO", "imagen");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTOS", "imágenes");
	//This [ITEM] will show [UNLIMITED|the max of X] images "in the gallery"
	define("LANG_MSG_PER_GALLERY", "en la galería");
	// plus one main image.
	define("LANG_MSG_PLUS_MAINIMAGE", " además de una imagen principal.");
	//Click here to pay for your article
	define("LANG_MSG_CONTINUE_TO_PAY_ARTICLE", "Click aqui para pagar por su artículo");
	//Click here to pay for your banner
	define("LANG_MSG_CONTINUE_TO_PAY_BANNER", "Click aqui para pagar por su banner");
	//Click here to pay for your classified
	define("LANG_MSG_CONTINUE_TO_PAY_CLASSIFIED", "Click aqui para pagar por su clasificado");
	//Click here to pay for your event
	define("LANG_MSG_CONTINUE_TO_PAY_EVENT", "Click aqui para pagar por su evento");
	//Click here to pay for your listing
	define("LANG_MSG_CONTINUE_TO_PAY_LISTING", "Click aqui para pagar por su listado");
	//Articles are activated by
	define("LANG_MSG_ARTICLES_ARE_ACTIVATED_BY", "Los artículos son activados por");
	//Banners are activated by
	define("LANG_MSG_BANNERS_ARE_ACTIVATED_BY", "Los banners son activados por");
	//Classifieds are activated by
	define("LANG_MSG_CLASSIFIEDS_ARE_ACTIVATED_BY", "Los clasificados son activados por");
	//Events are activated by
	define("LANG_MSG_EVENTS_ARE_ACTIVATED_BY", "Los eventos son activados por");
	//Listings are activated by
	define("LANG_MSG_LISTINGS_ARE_ACTIVATED_BY", "Los listados son activados por");
	//only after the process is complete.
	define("LANG_MSG_ONLY_PROCCESS_COMPLETE", "solo después de que se haya completado el proceso.");
    //You can only pay for [MAX_ITEMS_MODULE] each time.
    define("LANG_MSG_PROCCESS_MAXITEMS", "Sólo puedes pagar [MAX_ITEMS_MODULE] cada vez.");
    //Make the process again with less items.
    define("LANG_MSG_PROCCESS_AGAIN", "Hacer el proceso de nuevo con menos elementos.");
	//Tips for the Item Map Tuning
	define("LANG_MSG_TIPSFORMAPTUNING", "Sugerencias para el ajuste de mapa de los elementos");
	//You can adjust the position in the map,
	define("LANG_MSG_YOUCANADJUSTPOSITION", "Puede ajustar la posición en el mapa,");
	//with more accuracy.
	define("LANG_MSG_WITH_MORE_ACCURACY", "con más precisión.");
	//Use the controls "+" and "-" to adjust the map zoom.
	define("LANG_MSG_USE_CONTROLS_TO_ADJUST", "Acerque o aleje el mapa con los controles \"+\" y \"-\".");
	//Use the arrows to navigate on map.
	define("LANG_MSG_USE_ARROWS_TO_NAVIGATE", "Desplácese por el mapa con las flechas.");
	//Drag-and-Drop the marker to adjust the location.
	define("LANG_MSG_DRAG_AND_DROP_MARKER", "Arrastre y suelte el marcador para ajustar la ubicación.");
    //Drag files here to upload
    define("LANG_MSG_DROP_IMAGE", "Arrastre los archivos aqui para cargar");
	//Your deal will appear here
	define("LANG_MSG_PROMOTION_WILL_APPEAR_HERE", "Su Oferta aparecerá aquí");
	//Associate an existing deal with this listing
	define("LANG_MSG_ASSOCIATE_EXISTING_PROMOTION", "Asociar un Oferta existente con este listado");
	//No results found!
	define("LANG_MSG_NO_RESULTS_FOUND", "¡No se encontraron resultados!");
	//Access not allowed!
	define("LANG_MSG_ACCESS_NOT_ALLOWED", "¡No se permite el acceso!");
	//The following problems were found
	define("LANG_MSG_PROBLEMS_WERE_FOUND", "Se encontraron los siguientes problemas");
	//No items selected or requiring payment.
	define("LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT", "No hay elementos seleccionados que requieran pagarse.");
	//No items found.
	define("LANG_MSG_NO_ITEMS_FOUND", "No se encontraron elementos.");
	//No invoices in the system.
	define("LANG_MSG_NO_INVOICES_IN_THE_SYSTEM", "No hay facturas en el sistema.");
	//No transactions in the system.
	define("LANG_MSG_NO_TRANSACTIONS_IN_THE_SYSTEM", "No hay transacciones en el sistema.");
	//Claim this Listing
	define("LANG_MSG_CLAIM_THIS_LISTING", "Reclame este Listado");
	//Go to sponsor check out area
	define("LANG_MSG_GO_TO_MEMBERS_CHECKOUT", "Vaya al área de pago del anunciante");
	//You can see your invoice in
	define("LANG_MSG_YOU_CAN_SEE_INVOICE", "Puede ver su factura en");
	//I agree to terms
	define("LANG_MSG_AGREE_TO_TERMS", "Acepto los términos");
	//and I will send payment.
	define("LANG_MSG_I_WILL_SEND_PAYMENT", "y enviaré el pago.");
	//This page will redirect you to your sponsor area in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU", "Esta página lo dirigirá, en algunos segundos, al área de anunciante.");
	//This page will redirect you to continue your signup process in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU_SIGNUP", "Esta página lo dirigirá, en algunos segundos, para que pueda continuar el proceso de registro.");
	//"If it doesn't work, please" click here
	define("LANG_MSG_IF_IT_DOES_NOT_WORK", "Si no funciona,");
	//Manage Article
	define("LANG_MANAGE_ARTICLE", "Administrar Artículo");
	//Manage Banner
	define("LANG_MANAGE_BANNER", "Administrar Banner");
	//Manage Classified
	define("LANG_MANAGE_CLASSIFIED", "Administrar Clasificado");
	//Manage Event
	define("LANG_MANAGE_EVENT", "Administrar Evento");
	//Manage Listing
	define("LANG_MANAGE_LISTING", "Administrar Listado");
	//Manage Deal
	define("LANG_MANAGE_PROMOTION", "Administrar Oferta");
	//Manage Billing
	define("LANG_MANAGE_BILLING", "Administrar cuentas");
	//Manage Invoices
	define("LANG_MANAGE_INVOICES", "Administrar facturas");
	//Manage Transactions
	define("LANG_MANAGE_TRANSACTIONS", "Administrar Transacciones");
	//No articles in the system.
	define("LANG_NO_ARTICLES_IN_THE_SYSTEM", "No hay artículos en el sistema.");
	//No banners in the system.
	define("LANG_NO_BANNERS_IN_THE_SYSTEM", "No hay banners en el sistema.");
	//No classifieds in the system.
	define("LANG_NO_CLASSIFIEDS_IN_THE_SYSTEM", "No hay clasificados en el sistema.");
	//No events in the system.
	define("LANG_NO_EVENTS_IN_THE_SYSTEM", "No hay eventos en el sistema.");
	//No listings in the system.
	define("LANG_NO_LISTINGS_IN_THE_SYSTEM", "No hay listados en el sistema.");
	//No deals in the system.
	define("LANG_NO_PROMOTIONS_IN_THE_SYSTEM", "No hay ofertas en el sistema.");
	//No Reports Available.
	define("LANG_NO_REPORTS", "No hay informes disponibles.");
	//No article found. It might be deleted.
	define("LANG_NO_ARTICLE_FOUND", "No se encontró el artículo. Es posible que se haya eliminado.");
	//No classified found. It might be deleted.
	define("LANG_NO_CLASSIFIED_FOUND", "No se encontró el clasificado. Es posible que se haya eliminado.");
	//No listing found. It might be deleted.
	define("LANG_NO_LISTING_FOUND", "No se encontró el listado. Es posible que se haya eliminado.");
	//Article Information
	define("LANG_ARTICLE_INFORMATION", "Información del Artículo");
	//Delete Article
	define("LANG_ARTICLE_DELETE", "Eliminar Artículo");
	//Delete Article Information
	define("LANG_ARTICLE_DELETE_INFORMATION", "Eliminar información del Artículo");
	//Are you sure you want to delete this article
	define("LANG_ARTICLE_DELETE_CONFIRM", "¿Confirma que desea eliminar este artículo?");
	//Article Preview
	define("LANG_ARTICLE_PREVIEW", "Vista previa de Artículo");
	//Article Traffic Report
	define("LANG_ARTICLE_TRAFFIC_REPORT", "Informe de tráfico del Artículo");
	//Article Detail
	define("LANG_ARTICLE_DETAIL", "Detalle del Artículo");
	//Edit Article Information
	define("LANG_ARTICLE_EDIT_INFORMATION", "Modificar información del Artículo");
	//Delete Banner
	define("LANG_BANNER_DELETE", "Eliminar Banner");
	//Delete Banner Information
	define("LANG_BANNER_DELETE_INFORMATION", "Eliminar información del Banner");
	//Are you sure you want to delete this banner?
	define("LANG_BANNER_DELETE_CONFIRM", "¿Confirma que desea eliminar este banner?");
	//Edit Banner
	define("LANG_BANNER_EDIT", "Modificar Banner");
	//Edit Banner Information
	define("LANG_BANNER_EDIT_INFORMATION", "Modificar información del Banner");
	//Banner Preview
	define("LANG_BANNER_PREVIEW", "Vista previa del Banner");
	//Banner Traffic Report
	define("LANG_BANNER_TRAFFIC_REPORT", "Informe de tráfico del Banner");
	//View Banner
	define("LANG_VIEW_BANNER", "Ver Banner");
	//Disabled
	define("LANG_BANNER_DISABLED", "Desactivado");
	//Classified Information
	define("LANG_CLASSIFIED_INFORMATION", "Información del Clasificado");
	//Delete Classified
	define("LANG_CLASSIFIED_DELETE", "Eliminar Clasificado");
	//Your classified will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_CLASSIFIED_AUTOMATICALLY_APPEAR", "Su clasificado aparecerá automáticamente en la categoría principal de cada sub-categoría que usted seleccione.");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORY_PLURAL", "Categorías del Clasificado");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORIES", "Categorías del Clasificado");
	//Delete Classified Information
	define("LANG_CLASSIFIED_DELETE_INFORMATION", "Eliminar información del Clasificado");
	//Are you sure you want to delete this classified
	define("LANG_CLASSIFIED_DELETE_CONFIRM", "¿Confirma que desea eliminar este clasificado?");
	//Classified Map Tuning
	define("LANG_CLASSIFIED_MAP_TUNING", "Ajuste de mapa del Clasificado");
	//Classified Preview
	define("LANG_CLASSIFIED_PREVIEW", "Vista previa del Clasificado");
	//Classified Traffic Report
	define("LANG_CLASSIFIED_TRAFFIC_REPORT", "Informe de tráfico del Clasificado");
	//Classified Detail
	define("LANG_CLASSIFIED_DETAIL", "Detalle del Clasificado");
	//Edit Classified Information
	define("LANG_CLASSIFIED_EDIT_INFORMATION", "Modificar información del Clasificado");
	//Edit Classified Level
	define("LANG_CLASSIFIED_EDIT_LEVEL", "Modificar nivel del Clasificado");
	//Delete Event
	define("LANG_EVENT_DELETE", "Eliminar Evento");
	//Delete Event Information
	define("LANG_EVENT_DELETE_INFORMATION", "Eliminar información del Evento");
	//Are you sure you want to delete this event
	define("LANG_EVENT_DELETE_CONFIRM", "¿Confirma que desea eliminar este evento?");
	//Event Information
	define("LANG_EVENT_INFORMATION", "Información del Evento");
	//Event Map Tuning
	define("LANG_EVENT_MAP_TUNING", "Ajuste de mapa del Evento");
	//Event Preview
	define("LANG_EVENT_PREVIEW", "Vista previa del Evento");
	//Event Traffic Report
	define("LANG_EVENT_TRAFFIC_REPORT", "Informe de tráfico del Evento");
	//Event Detail
	define("LANG_EVENT_DETAIL", "Detalle del Evento");
	//Edit Event Information
	define("LANG_EVENT_EDIT_INFORMATION", "Modificar información del Evento");
	//Listing Information
	define("LANG_LISTING_INFORMATION", "Información del Listado");
	//Listing Map Tuning
	define("LANG_LISTING_MAP_TUNING", "Ajuste de mapa del Listado");
	//Listing Preview
	define("LANG_LISTING_PREVIEW", "Vista previa del Listado");
	//Listing Deal
	define("LANG_LISTING_PROMOTION", "Oferta del Listado");
	//The deal is linked from the listing.
	define("LANG_LISTING_PROMOTION_IS_LINKED", "La Oferta está vinculada desde el listado.");
	//To be active the deal
	define("LANG_LISTING_TO_BE_ACTIVE_PROMOTION", "Para estar activa, la oferta");
	//must have an end date in the future.
	define("LANG_LISTING_END_DATE_IN_FUTURE", "debe tener una fecha de finalización en el futuro.");
	//must be associated with a listing.
	define("LANG_LISTING_ASSOCIATED_WITH_LISTING", "debe estar asociada con un listado.");
	//Listing Traffic Report
	define("LANG_LISTING_TRAFFIC_REPORT", "Informe de tráfico del Listado");
	//Listing Detail
	define("LANG_LISTING_DETAIL", "Detalle del Listado");
	//for listing
	define("LANG_LISTING_FOR_LISTING", "para listado");
	//Listing Update
	define("LANG_LISTING_UPDATE", "Actualización de Listado");
	//Delete Deal
	define("LANG_PROMOTION_DELETE", "Eliminar Oferta");
	//Delete Deal Information
	define("LANG_PROMOTION_DELETE_INFORMATION", "Eliminar información de la Oferta");
	//Are you sure you want to delete this deal?
	define("LANG_PROMOTION_DELETE_CONFIRM", "¿Confirma que desea eliminar este Oferta?");
	//Deal Preview
	define("LANG_PROMOTION_PREVIEW", "Vista previa de la Oferta");
	//Deal Traffic Report
	define("LANG_PROMOTION_TRAFFIC_REPORT", "Informe de tráfico de la Oferta");
	//Deal Information
	define("LANG_PROMOTION_INFORMATION", "Información de la Oferta");
	//Deal Detail
	define("LANG_PROMOTION_DETAIL", "Detalle de la Oferta");
	//Edit Deal Information
	define("LANG_PROMOTION_EDIT_INFORMATION", "Modificar información de la Oferta");
	//Image successfully deleted!
	define("LANG_IMAGE_SUCCESSFULLY_DELETED", "¡Se eliminó correctamente la imagen!");
	//Review Detail
	define("LANG_REVIEW_DETAIL", "Detalle de la calificación");
	//Review Preview
	define("LANG_REVIEW_PREVIEW", "Vista previa de la calificación");
	//Invoice Detail
	define("LANG_INVOICE_DETAIL", "Detalle de la factura");
	//Invoice not found for this account.
	define("LANG_INVOICE_NOT_FOUND_FOR_ACCOUNT", "No se encontró la factura de esta cuenta.");
	//Invoice Notification
	define("LANG_INVOICE_NOTIFICATION", "Notificación de la factura");
	//Transaction Detail
	define("LANG_TRANSACTION_DETAIL", "Detalle de la transacción");
	//Transaction not found for this account.
	define("LANG_TRANSACTION_NOT_FOUND_FOR_ACCOUNT", "No se encontró la transacción de esta cuenta.");
	//Sign in with Directory Account
	define("LANG_LOGINDIRECTORYUSER", "Iniciar sesión con cuenta de Directorio");
	//Sign in with OpenID 2.0 Account
	define("LANG_LOGINOPENIDUSER", "Iniciar sesión con cuenta de OpenID 2.0");
	//Log in with Facebook
	define("LANG_LOGINFACEBOOKUSER", "Iniciar sesión con Facebook");
	//Sign up with Facebook
	define("LANG_SIGNUPFACEBOOKUSER", "Registrate con Facebook");
	//Log in with Google
	define("LANG_LOGINGOOGLEUSER", "Iniciar sesión con Google");
	//Sign up with Google
	define("LANG_SIGNUPGOOGLEUSER", "Registrate con Google");
	//Username already registered!
	define("LANG_USERNAME_ALREADY_REGISTERED", "¡".LANG_LABEL_USERNAME." ya está registrado!");
	//This e-mail is available.
	define("LANG_USERNAME_NOT_REGISTERED", "¡Este correo electrónico está disponible!");
	//Error uploading image. Please try again.
	define("LANG_MSGERROR_ERRORUPLOADINGIMAGE", "Error al subir la imagen. Por favor, inténtelo de nuevo.");
	//Image successfully uploaded
	define("LANG_IMAGE_SUCCESSFULLY_UPLOADED", "¡Imagen cargada con éxito!");
	//Image successfully updated
	define("LANG_IMAGE_SUCCESSFULLY_UPDATED", "¡Imagen actualizada correctamente!");
	//Delete image
	define("LANG_DELETE_IMAGE", "Eliminar imagen");
	//Are you sure you want to delete this image
	define("LANG_DELETE_IMAGE_CONFIRM", "¿Está seguro que quiere borrar esta imagen?");
	//Edit Image
	define("LANG_LABEL_EDITIMAGE", "Editar imagen");
	//Make main
	define("LANG_LABEL_MAKEMAIN", "Hacer principal");
	//Main image
	define("LANG_LABEL_MAINIMAGE", "Imagen Principal");
	//Click here to set as main image
	define("LANG_LABEL_CLICKTOSETMAINIMAGE", "Haga clic aquí para establecer como imagen principal");
	//Click here to set as gallery image
	define("LANG_LABEL_CLICKTOSETGALLERYIMAGE", "Haga clic aquí para establecer como imagen de galería de imágenes");
	//Packages
	define("LANG_PACKAGE_PLURAL", "Paquetes");
	//Package
	define("LANG_PACKAGE_SING", "Paquete");
	//Charging for package
	define("LANG_CHARGING_PACKAGE", "El cobro por paquete ");

	# ----------------------------------------------------------------------------------------------------
	# SOCIAL NETWORK
	# ----------------------------------------------------------------------------------------------------
	//Profile successfully updated!
	define("LANG_MSG_PROFILE_SUCCESSFULLY_UPDATED", "¡Perfil actualizado correctamente!");
	//Profile
	define("LANG_LABEL_PROFILE", "Perfil");
	//Edit Profile
	define("LANG_LABEL_EDIT_PROFILE", "Editar Perfil");
	//Load from Facebook
	define("LANG_LABEL_IMAGE_FROM_FACEBOOK", "Cargar de su Facebook.");
	//Personal Infomation
	define("LANG_LABEL_PERSONAL_INFORMATION", "Información Personal");
	//Twitter Account
	define("LANG_LABEL_TWITTER_ACCOUNT", "Cuenta de Twitter");
	//Twitter Widget
	define("LANG_LABEL_TWITTER_WIDGET", "Widget de Twitter");
	//About me
	define("LANG_LABEL_ABOUT_ME", "Acerca de Mí");
	//Birthdate
	define("LANG_LABEL_BIRTHDATE", "Fecha de Nacimiento");
	//Hometown
	define("LANG_LABEL_HOMETOWN", "Ciudad Natal");
	//Favorite Books
	define("LANG_LABEL_FAVORITEBOOKS", "Libros Favoritos");
	//Favorite Movies
	define("LANG_LABEL_FAVORITEMOVIES", "Películas Favoritas");
	//Favorite Sports
	define("LANG_LABEL_FAVORITESPORTS", "Deportes Favoritos ");
	//Favorite Musics
	define("LANG_LABEL_FAVORITEMUSICS", "Música Favorita");
	//Favorite Foods
	define("LANG_LABEL_FAVORITEFOODS", "Alimentos Favoritos");
	//Are you sure?
	define("LANG_MESSAGE_MSGAREYOUSURE", "¿Estás seguro?");
	//This is the URL where visitors can see your public profile page
	define("LANG_MSG_FRIENDLY_URL_PROFILE_TIP", "Esta es la URL donde los visitantes pueden ver su página de perfil público");
	//Your URL
	define("LANG_LABEL_YOUR_URL", "Su URL");
    //Your URL is required.
	define("LANG_LABEL_YOURURL_REQUIRED", "Su URL es requerida.");
    //yoururl
    define("LANG_LABEL_YOUR_URLTIP", "suurl");
    //Available URL
    define("LANG_LABEL_URLOK", "URL disponible");
    //Unavailable URL
    define("LANG_LABEL_URLNOTOK", "URL no disponible");
	//Your URL contains invalid chars.
	define("LANG_MSG_FRIENDLY_URL_INVALID_CHARS", "Su URL contiene caracteres no válidos.");
	//URL already in use, please choose another URL.
	define("LANG_MSG_PAGE_URL_IN_USE", "URL ya está en uso, por favor, elija otro URL.");
	//View all
	define("LANG_LABEL_VIEW_ALL", "Ver todos");
	//View all
	define("LANG_LABEL_VIEW_ALL2", "Ver todas");
	//No Items
	define("LANG_MSG_NO_ITEMS", "No hay elementos");
	//Share
	define("LANG_LABEL_SHARE", "Compartir");
	//Comments
	define("LANG_LABEL_COMMENTS", "Comentarios");
	//My Profile
	define("LANG_LABEL_MYPROFILE", "Mi Perfil");
	//User profile successfully enabled!
	define("LANG_MSG_PROFILE_ENABLED", "¡Perfil de usuario habilitado correctamente!");
	//Display my contact information publicly
	define("LANG_LABEL_PUBLISH_MY_CONTACT", "Publicar mi información de contacto");
	//Create my Personal Page
	define("LANG_LABEL_CREATE_PERSONAL_PAGE", "Crear mi página personal");
	//Public Profile
	define("LANG_LABEL_PERSONAL_PAGE", "Página Personal");
	//Article Reviews
	define("LANG_LABEL_ARTICLE_REVIEW", "Calificaciones de Artículos");
	//Listing Reviews
	define("LANG_LABEL_LISTING_REVIEW", "Calificaciones de Listados");
	//Deal Reviews
	define("LANG_LABEL_PROMOTION_REVIEW", "Calificaciones de Ofertas");
	//Review successfully deleted.
	define("LANG_MSG_REVIEW_SUCCESS_DELETED", "Calificaciones eliminadas correctamente.");
	//No reviews found!
	define("LANG_LABEL_NOREVIEWS", "¡No se encontraron calificaciones!");
	//Edit my Profile
	define("LANG_LABEL_EDITPROFILE", "Modificar mi perfil");
	//Back to my Profile
	define("LANG_LABEL_BACKTOPROFILE", "Volver a mi perfil");
	//Member Since
	define("LANG_LABEL_MEMBER_SINCE", "Miembro desde");
	//Account Settings
	define("LANG_LABEL_ACCOUNT_SETTINGS", "Configuraciones de la Cuenta");
    //Deals Redeemed
	define("LANG_LABEL_ACCOUNT_DEALS", "Ofertas Redimidas");
	//Favorites
	define("LANG_LABEL_FAVORITES", "Favoritos");
	//You have no permission to access this area.
	define("LANG_MSG_NO_PERMISSION", "Usted no tiene permiso para acceder a esta zona.");
	//Go to your Profile
	define("LANG_MSG_GO_PROFILE", "Ve a tu perfil.");
	//My Personal Page
	define("LANG_MSG_MY_PERSONAL_PAGE", "Mi Página Personal");
	//Use this Account
	define("LANG_MSG_USE_LOGGED_ACCOUNT", "Utilice esta cuenta");
	//Profile Page
	define("LANG_LABEL_PROFILE_PAGE", "Página de Perfil");
	//Create your Profile
	define("LANG_CREATE_MEMBER_PROFILE", "Crea tu Perfil");
	//Your Name is required.
	define("LANG_MSG_NICKANAME_REQUIRED", "Nombre es necesario.");
	//Be sure that the twitter account you are adding is not protected. If the twitter account is protected the latest tweets on this account will not be shown.
	define("LANG_PROFILE_TWITTER_TIP1", "Asegúrese de que la cuenta de twitter que estás agregando no está protegida. Si la cuenta de twitter esta protegida, los últimos tweets en esta cuenta no se veran.");
	//Thank you for signing up!
    define("LANG_PROFILE_WELCOME", "¡Gracias por registrarse!");
    //We appreciate it and welcome to
    define("LANG_PROFILE_WELCOME2", "Se lo agradecemos y damos la bienvenida a");

	# ----------------------------------------------------------------------------------------------------
	# GALLERY
	# ----------------------------------------------------------------------------------------------------
	//Only
	define("LANG_ONLY", "¡Sólo imágenes");
	//images accepted for upload!
	define("LANG_IMAGES_ACCEPETED", "se aceptan para cargar!");
	//Images must be under
	define("LANG_IMAGE_MUST_BE", "Las imágenes deben estar bajo ");
	//Select an image for upload!
	define("LANG_SELECT_IMAGE", "¡Seleccione una imagen para subir!");
	//Original image
	define("LANG_ORIGINAL", "Imagen original");
	//Thumbnail preview
	define("LANG_THUMB_PREVIEW", "Vista previa de imagen miniatura");
	//Edit captions
	define("LANG_LABEL_EDIT_CAPTIONS", "Leyendas");
	//You can add the maximum of
	define("LANG_YOU_CAN_ADD_MAXOF", "¡Puede agregar el máximo de ");
	//photos to your gallery
	define("LANG_TO_YOUR_GALLERY", " fotos a su galería!");
	//Create Thumbnail
	define("LANG_CREATE_THUMB", "Crear Imagen Miniatura");
	//Thumbnail Preview
	define("LANG_THUMB_PREVIEW", "Vista previa en miniatura");
	//Your item already has the maximum number of images in the gallery. Delete an existing image to save this one.
	define("LANG_ITEM_ALREADY_HAD_MAX_IMAGE", "Su elemento ya tiene el número máximo de imágenes en la galería. Elimine una imagen existente para salvar esta.");

	# ----------------------------------------------------------------------------------------------------
	# RECURRING EVENTS
	# ----------------------------------------------------------------------------------------------------
	//Recurring Event
	define("LANG_EVENT_RECURRING", "Evento Recurrente");
	//Repeat
	define("LANG_PERIOD", "Repetición");
	//Choose an option
	define("LANG_CHOOSE_PERIOD", "Elija una opción");
	//Daily
	define("LANG_DAILY", "Diario");
	//Weekly
	define("LANG_WEEKLY", "Semanal");
	//Monthly
	define("LANG_MONTHLY", "Mensual");
	//Yearly
	define("LANG_YEARLY", "Anual");
	//Daily Event
	define("LANG_DAILY2", "Evento Diario");
	//Weekly
	define("LANG_WEEKLY2", "Semanal");
	//Monthly
	define("LANG_MONTHLY2", "Mensual");
	//Yearly
	define("LANG_YEARLY2", "Anual");
	//every
	define("LANG_EVERY", "Cada");
	//every
	define("LANG_EVERY2", "Cada");
	//of
	define("LANG_OF", "do(a)");
	//of
	define("LANG_OF2", "de");
	//of
	define("LANG_OF3", "da");
	//of
	define("LANG_OF4", "del");
	//Week
	define("LANG_WEEK", "Semana");
	//Choose Month
	define("LANG_CHOOSE_MONTH", "Elige Mes");
	//Choose Day
	define("LANG_CHOOSE_DAY", "Elige Día");
	//Choose Week
	define("LANG_CHOOSE_WEEK", "Elige Semana");
	//First
	define("LANG_FIRST", "Primero(a)");
	//Second
	define("LANG_SECOND", "Segundo(a)");
	//Third
	define("LANG_THIRD", "Tercero(a)");
	//Fourth
	define("LANG_FOURTH", "Cuarto(a)");
	//Last
	define("LANG_LAST", "Último(a)");
	//1st
	define("LANG_FIRST_2", "1ª");
    //2nd
	define("LANG_SECOND_2", "2ª");
    //3rd
	define("LANG_THIRD_2", "3ª");
    //4th
	define("LANG_FOURTH_2", "4ª");
	//Recurring
	define("LANG_RECURRING", "Recurrente");
	//Please select a day of week
	define("LANG_EVENT_SELECT_DAYOFWEEK", "Por favor, seleccione un día de la semana.");
	//Please type a day
	define("LANG_EVENT_TYPE_DAY", "Por favor, escriba un día.");
	//Please select a month
	define("LANG_EVENT_SELECT_MONTH", "Seleccione un mes.");
	//Please select a week
	define("LANG_EVENT_SELECT_WEEK", "Por favor, seleccione una semana.");
	//Please select a Repeat option
	define("LANG_EVENT_SELECT_PERIOD", "Por favor, seleccione una opción de Repetición.");
	//When
	define("LANG_EVENT_WHEN", "Cuando");
	//Day must be numeric
	define("LANG_EVENT_TYPE_DAY_NUMERIC", "Día debe ser numérico.");
	//Day must be between 1 and 31
	define("LANG_EVENT_TYPE_DAY_BETWEEN", "Día debe ser entre 1 y 31.");
	//Day doesn't match with the choosen period
	define("LANG_EVENT_CHECK_DAY", "Día no coincide con el período elegido.");
	//Month doesn't match with the choosen period
	define("LANG_EVENT_CHECK_MONTH", "Mes no coincide con el período elegido.");
	//Days don't match with the choosen period
	define("LANG_EVENT_CHECK_DAYOFWEEK", "Días no coinciden con el período elegido.");
	//Week doesn't match with the choosen period
	define("LANG_EVENT_CHECK_WEEK", "Semana no coincide con el período elegido.");
	//No info
	define("LANG_EVENT_NO_INFO", "No hay información");
	//Ends on
	define("LANG_ENDS_IN", "Finaliza el");
	//Never
	define("LANG_NEVER", "Nunca");
	//Until
	define("LANG_UNTIL", "Hasta");
	//Until Date
	define("LANG_LABEL_UNTIL_DATE", "Hasta");
	//The "Until Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_UNTIL_DATE_GREATER_THAN_START_DATE", "\"Hasta\" debe ser mayor o igual a la \"Fecha de inicio\".");
	//The "Until Date" cannot be in past.
	define("LANG_MSG_UNTIL_DATE_CANNOT_IN_PAST", "\"Hasta\" no puede ser en el pasado.");
	//Starts on
	define("LANG_EVENT_STARTS_ON", "Comienza el");
	//Starts
	define("LANG_EVENT_STARTS", "Comienza");
	//Repeats
	define("LANG_EVENT_REPEATS", "Repite");
	//Ends on
	define("LANG_EVENT_ENDS", "Finaliza el");
	//weekend
	define("LANG_EVENT_WEEKEND", "fin de semana");
	//weekends
	define("LANG_EVENT_WEEKENDS", "fines de semana");
	//Mon-Fri
	define("LANG_EVENT_BUSINESSDAY", "De lunes a viernes");
	//the Month
	define("LANG_THE_MONTH", "del Mes");
	//Every Year
	define("LANG_EVERY_YEAR", "Cada Año");

	# ----------------------------------------------------------------------------------------------------
	# SITES
	# ----------------------------------------------------------------------------------------------------
	//Site
	define("LANG_DOMAIN", "Sitio");
	//Site name
	define("LANG_DOMAIN_NAME", "Nombre del Sitio");
	//Click here to view this site
	define("LANG_MSG_CLICK_TO_VIEW_THIS_DOMAIN", "Haga clic aquí hacer ver este sitio");
	//Click here to delete this site
	define("LANG_MSG_CLICK_TO_DELETE_THIS_DOMAIN", "Haga clic aquí para borrar este sitio");
	//Site successfully deleted!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_DELETE", "¡Sitio eliminado correctamente!");
	//Site successfully added!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2", "¡Sitio agregado correctamente!");
	//An email notification will be sent to the eDirectory support team, please wait our contact.
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD", LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2."<br />Una notificación por correo electrónico será enviada al equipo de soporte de eDirectory, por favor espere a que le contactemos.");
    //Site name is required
	define("LANG_MSG_DOMAINNAME_IS_REQUIRED", "El nombre del sitio se requiere");
    //Site URL is required
	define("LANG_MSG_DOMAINURL_IS_REQUIRED", "Se requiere el URL del sitio");
	//Site name already exists
	define("LANG_MSG_DOMAINNAME_ALREADY_EXISTS", "El nombre del sitio ya existe");
	//Site URL already exists
	define("LANG_MSG_DOMAINURL_ALREADY_EXISTS", "El URL del sitio ya existe");
	//Site URL not valid
	define("LANG_MSG_DOMAINURL_INVALID_CHARS", "El URL del sitio no es válido");
	//Site Items
	define("LANG_SITE_ITEMS", "Elementos del Sitio");
	//Select a Site
	define("LANG_SELECT_DOMAIN", "Cambiar Sitio");

	# ----------------------------------------------------------------------------------------------------
	# PROFILE
	# ----------------------------------------------------------------------------------------------------
    //Sign Up with a new Account
    define("LANG_LABEL_PROFILE_SIGNUP", "Registrarse con una cuenta nueva");
    //OR
    define("LANG_LABEL_PROFILE_OR", "O");
    //Sign In with an existing account
    define("LANG_LABEL_PROFILE_FOREIGNACC", "Iniciar sesión con una cuenta existente");
    //Or use your OpenID to sign in
    define("LANG_LABEL_PROFILE_OPENID", "O usa tu OpenID para iniciar sesión");
    //Your OpenID
    define("LANG_LABEL_PROFILE_YOUROPENID", "Su OpenID");
    //Login
    define("LANG_LABEL_PROFILE_LOGIN", "Login");
    //Once you have created your account using a foreign system, it was activated automatically. Please disregard this message.
    define("LANG_LABEL_PROFILE_ACTIVATED", "Una vez que haya creado su cuenta a través de un sistema externo, se activa automáticamente. Haga caso omiso a este mensaje.");
	//Thank you for activating your account. The next step is to complete your profile.
    define("LANG_LABEL_PROFILE_WELCOME_ACT", "Gracias por la activación de su cuenta. El siguiente paso es completar su perfil.");
    //Your account has not been activated yet. Check your activation e-mail and come back later to complete your profile.
    define("LANG_LABEL_PROFILE_WELCOME_NOTACT", "Tu cuenta no ha sido activada todavía. Revise su correo de activación y volver más tarde para completar su perfil.");
    //Complete your profile
    define("LANG_LABEL_PROFILE_COMPLETE", "Complete su perfil");
    //RECENT ACTIVITY
    define("LANG_LABEL_PROFILE_RECENT_ACTIVITY", "ACTIVIDAD RECIENTE");
    //You have no recent activity.
    define("LANG_LABEL_PROFILE_RECENT_ACTIVITY_EMPTY", "Usted no tiene actividad reciente.");
    //Review on
    define("LANG_LABEL_PROFILE_REVIEWON", "Calificacione en");
    //You can connect your directory account with social networks
    define("LANG_LABEL_PROFILE_SNTIP", "Puede conectar su cuenta de directorio con las redes sociales");
    //Change photo
    define("LANG_LABEL_PROFILE_CHANGEPHOTO", "Cambiar foto");
    //Remove photo
    define("LANG_LABEL_PROFILE_REMOVEPHOTO", "Retire foto");
    //Display Name
    define("LANG_LABEL_PROFILE_DISPLAYNAME", "Nombre de exibición");
    //Personal Page
    define("LANG_LABEL_PROFILE_PERSONALPAGE", "Página Personal");
    //Account Username
    define("LANG_LABEL_ACCOUNT_USERNAME", "Nombre de Usuario");
    //You can change your e-mail access at any time. This is also the contact e-mail we use to reach you.
    define("LANG_LABEL_ACCOUNT_USERNAME_TIP", "Usted puede cambiar su correo electronico de acceso en cualquier momento. Este es también el correo electrónico de contacto que utilizamos para contactarle.");
    //Activated
    define("LANG_LABEL_ACCOUNT_ACT", "Activado");
    //Account not activated.
    define("LANG_LABEL_ACCOUNT_NOTACT", "Cuenta no activada.");
    //Activate account.
    define("LANG_LABEL_ACTIVATE_ACC", "Activar cuenta.");
    //Your activation e-mail has been sent. Please, check your inbox.
    define("LANG_LABEL_ACTIVATEEMAIL_SENT", "El correo ellectronico de activación ha sido enviado. Por favor, revise su bandeja de entrada.");
    //There was an error trying to send you a new activation e-mail.
    define("LANG_LABEL_ACTIVATEEMAIL_SENT_ERROR", "Se ha producido un error al intentar enviar un nuevo correo electrónico de activación.");
    //get a new activation e-mail.
    define("LANG_LABEL_ACTIVATEEMAIL_GETNEW", "obtener un nuevo correo electrónico de activación.");
    //Change Password
    define("LANG_LABEL_ACCOUNT_CHANGEPASS", "Cambiar contraseña");
    //You can change your password at any time you want.
    define("LANG_LABEL_ACCOUNT_CHANGEPASS_TIP", "Usted puede cambiar su contraseña en cualquier momento que desee.");
    //This information will be hidden unless you click the publish checkbox below
    define("LANG_LABEL_ACCOUNT_CONTACT_TIP", "Estos datos no serán publicados si no desea hacerlo.");
    //Settings
    define("LANG_LABEL_CONTACT_SETTINGS", "Configuración");
    //Check your preferences
    define("LANG_LABEL_CONTACT_SETTINGS_TIP", "Revise sus preferencias");
    //Profile Options
    define("LANG_MENU_PROFILEOPTIONS", "Opciones del Perfil");
    //Profile Information
	define("LANG_LABEL_PROFILE_INFORMATION", "Informaciones del Perfil");
	//Social Networking
	define("LANG_LABEL_FOREIGN_ACCOUNTS", "Redes Sociales");
	//Link and import informations
	define("LANG_LABEL_CONNECT_WITH_FB_AND_IMPORT", "Conectar y importar las informaciones");
	//Just link
	define("LANG_LABEL_CONNECT_WITH_FB", "Sólo Conectar");
	//Link my Facebook account
	define("LANG_LABEL_LINK_FACEBOOK", "Conectar a mi cuenta de Facebook");
	//Unlink my Facebook account
	define("LANG_LABEL_UNLINK_FB", "Desconectar mi cuenta de Facebook");
	//Your account was unlinked from Facebook
	define("LANG_LABEL_FB_ACT_DISC", "Su cuenta ha sido desconectada de facebook");
	//Your Facebook account is already linked with other account in the system.
	define("LANG_FB_ALREADY_LINKED", "Su cuenta de Facebook ya está conectada a otra cuenta en el sistema.");
	//Your Twitter account is already linked with other account in the system.
	define("LANG_TW_ALREADY_LINKED", "Su cuenta de Twitter ya está conectada a otra cuenta en el sistema.");
	//Linked to twitter as
	define("LANG_MSG_LINKED_TW_AS", "Vinculado a Twitter como");
	//Connected as
	define("LANG_LABEL_CONECTED_AS", "Conectado como");
	//Location options
	define("LANG_LABEL_LOCATIONPREF", "Preferencias de ubicación");
	//Choose your location preferences in order to auto fill your searches by location
	define("LANG_LABEL_CHOOSELOCATIONPREF", "Seleccione sus preferencias de ubicación para auto llenar sus búsquedas por ubicación");
	//Use your current location
	define("LANG_LABEL_USECURRENTLOCATION", "Utilice su ubicación actual");
	//Use Facebook Location
	define("LANG_LABEL_USEFACEBOOKLOCATION", "Utilice su ubicación del Facebook");
	//Connect to Facebook
	define("LANG_LABEL_CONECTED_TO_FB", "Conectar con Facebook");
	//Facebook account
	define("LANG_LABEL_FACEBOOK_ACCT", "Cuenta de Facebook");
	//Google account
	define("LANG_LABEL_GOOGLE_ACCT", "Cuenta de Google");
	//Change account
	define("LANG_LABEL_CHANGE_ACCT", "Cambiar cuenta");
	//Twitter account
	define("LANG_LABEL_FB_ACCT", "Cuenta Twitter");
	//Twitter connection
	define("LANG_LABEL_TW_CONN", "Twitter con");
	//Link my Twitter account
	define("LANG_LABEL_TW_LINK", "Conectar a mi cuenta de Twitter");
	//Unlink my Twitter account
	define("LANG_LABEL_UNLINK_TW", "Desconectar mi cuenta de Twitter");
	//Post redeems on my twitter account automatically
	define("LANG_LABEL_POSTRED", "Publicar oferta en mi cuenta de Twitter de forma automática");
	//Your account was unlinked from twitter
	define("LANG_LABEL_TW_ACT_DISC", "Su cuenta ha sido desconectada de Twitter");
	//You must sign in through twitter first
	define("LANG_LABEL_TW_SIGNTW", "Usted debe registrarse primero a través de Twitter");
	//Your Twitter account was successfully connected
	define("LANG_LABEL_TW_SIGNTW_CONN", "Su cuenta de Twitter fue conectada con éxito");
	//Your Facebook account was successfully connected
	define("LANG_LABEL_FB_SIGNFB_CONN", "Su cuenta de Facebook fue conectada con éxito");
	//Your are already logged Facebook account as
	define("LANG_LABEL_FB_ALREADYLOGGED", "Usted ya ha iniciado sesión como cuenta de Facebook");
	//This user is already attached to another directory account.
	define("LANG_LABEL_FB_ALREADYATTACHED", "Este usuario está ya conectado a otra cuenta.");
	//Click here to switch to this account
	define("LANG_LABEL_FB_CLICKHERETOSWITCH", "Haga clic aquí para ver esta cuenta");
	//Connect to Facebook
	define("LANG_LABEL_CONN_FB", "Conectar con Facebook");
	//Use this language upon each sign in to my account
	define("LANG_LABEL_USE_SELECTEDLANGUAGE", "Utilizar el lenguaje en cada sesión en mi cuenta");
    //View my profile page
    define("LANG_LABEL_VIEW_PROFILE", "Ver mi perfil");

	# ----------------------------------------------------------------------------------------------------
	# DEALS
	# ----------------------------------------------------------------------------------------------------
	//I just got a great deal
	define("DEAL_LIKEDTHIS", "Me gustó este");
	//Redeem
	define("DEAL_REDEEM", "Validar");
	//Redeem this deal
	define("DEAL_REDEEMTHIS", "Validar esta oferta");
	//To redeem you need to post this deal information on your Facebook or Twitter.
	define("DEAL_REDEEMINFO1", "Para validar usted necesita enviar esta información mucho en tu Facebook o Twitter.");
	//You can set this button to automatic post on your Profile.
	define("DEAL_REDEEMINFO2", "Puede configurar este botón para enviar automáticamente en tu perfil.");
	//Click here to configure it
	define("DEAL_CLICKHERETO", "Haga clic aquí para configurar");
	//Please wait, posting on Facebook and Twitter (if available).
	define("DEAL_PLEASEWAIT_POSTING", "Por favor, espere, publicando en Facebook y Twitter (si está disponible).");
	//You already redeemed this deal! Your code is
	define("DEAL_YOUALREADY", "Ya ha redimido este acuerdo! Su código es");
	//Deal done! This is your redeem code
	define("DEAL_DEALDONE", "Oferta hecho! Este es su código de validacion");
	//No one has redeemed this deal on Facebook yet.
	define("DEAL_REDEEM_NONE_FB", "Nadie ha redimido este acuerdo en Facebook sin embargo.");
	//No one has redeemed this deal on Twitter yet.
	define("DEAL_REDEEM_NONE_TW", "Nadie ha redimido este acuerdo sin embargo en Twitter.");
	//Recent done deals
	define("DEAL_RECENTDEALS", "Recientes ofertas validadas");
	//No deals found!
	define("DEAL_DIDNTNOTFINISHED", "¡No hay ofertas encontradas!");
	//This deal is not available anymore.
	define("DEAL_NA", "Este acuerdo ya no está disponible.");
	//To redeem this deal you need to post to your Facebook wall. First, sign using the Facebook login button and you will need to approve this Application to do it.
	define("DEAL_REDEEMINFO_1", "Para validar esta oferta es necesario publicar en su muro de Facebook. En primer lugar usted debe ingresar a su cuenta de Facebook y aprobar nuestra aplicación para trabajar en su perfil.");
	//You already did this deal!
	define("DEAL_REDEEM_DONEALREADY", "¡Ya has hecho esta oferta!");
	//Sorry, there was an error trying to post on your Facebook wall. Please try again.
	define("DEAL_REDEEMINFO_2", "Lo sentimos, hubo un error intentando escribir un mensaje en su muro de Facebook. Por favor, inténtelo de nuevo.");
	//Value
	define("DEAL_VALUE", "Valor");
	//With this coupon
	define("DEAL_WITHTHISCOUPON", "Con esta oferta");
	//Thank you
	define("DEAL_THANKYOU", "Gracias");
	//Original value
	define("DEAL_ORIGINALVALUE", "Valor original");
	//Amount paid
	define("DEAL_AMOUNTPAID", "Con este acuerdo");
	//Valid until
	define("DEAL_VALIDUNTIL", "Válido hasta el");
	//Coupon must be presented to receive discount
	define("DEAL_INFODETAILS1", "El Cupon debe ser presentado para recibir el descuento");
	//Limit of 1 coupon per purchase
	define("DEAL_INFODETAILS2", "Límite de un Oferta por compra");
	//Not valid with other coupons, offers or discounts of any kind
	define("DEAL_INFODETAILS3", "No es válido con otros cupones, oferta o descuentos de ningún tipo");
	//Valid only for Listing Name - Address
	define("DEAL_INFODETAILS4", "Sólo es válido para el Nombre del listado - Dirección");
	//Print deal
	define("DEAL_PRINTDEAL", "Imprimir Oferta");
	//deal done
	define("DEAL_DEALSDONE", "Oferta Completada");
	//deals done
	define("DEAL_DEALSDONE_PLURAL", "Ofertas Completadas");
	//Deals redeemed
	define("LANG_LABEL_DEAL_BOUGHT", "Ofertas redimidas");
	//Deals left
	define("LANG_LABEL_DEAL_LEFT", "Ofertas restantes");
	//Left
	define("DEAL_LEFTAMOUNT", "Restantes");
	//Sold Out
	define("DEAL_SOLDOUT", "Vendido");
	//Sorry, this deal doesn't exist or it was removed by owner
	define("DEAL_DOESNTEXIST", "Lo sentimos, este acuerdo no existe o fue eliminado por el propietario");
	//at
	define("DEAL_AT", "en");
	//Friendly URL
	define("DEAL_FRIENDLYURL", "URL amigable");
	//Select a listing
	define("DEAL_SELECTLISTING", "Seleccione un listado");
	//Tagline for Deals
	define("DEAL_TAG", "Tagline for Deals");
	//Visibility
	define("LANG_SITEMGR_VISIBILITY", "Visibilidad");
	//This deal will show up on
	define("LANG_SITEMGR_DEALSHOWUP", "Esta oferta se mostrará en");
	//searches and nearby feature
	define("LANG_SITEMGR_DEALSEARCHES_NEARBY", "búsquedas y características cercanas");
	//Nearby
	define("LANG_LABEL_NEARBY", "Cercano");
	//About Us
	define("LANG_MENU_ABOUT", "Acerca de Nosotros");
	//My Favorites
	define("LANG_MENU_FAVORITES", "Mis Favoritos");
	//My Deals
	define("LANG_MENU_MYDEALS", "Mis Ofertas");
	//My Reviews
	define("LANG_MENU_MYREVIEWS", "Mis Calificaciones");
	//My Account
	define("LANG_MENU_ACCOUNT", "Mi Cuenta");
	//24 hours / day
	define("LANG_SITEMGR_TWFOURHOURSDAY", "24 horas / día");
	//Custom range
	define("LANG_SITEMGR_CUSTOMRANGE", "Período específico");
	//Discount information
	define("LANG_SITEMGR_DISCINFO", "Información de descuento");
	//Item Value
	define("LANG_SITEMGR_ITEMVALUE", "Valor del Articulo");
	//Discount
	define("LANG_SITEMGR_DISCOUNT", "Descuento");
	//Value with discount
	define("LANG_DEAL_WITH_DISCOUNT", "Valor con descuento");
	//Amount of deals
	define("LANG_SITEMGR_AMOUNTOFDEALS", "Cantidad de ofertas");
     //deals done until now
	define("LANG_SITEMGR_DONEUNTIL_SINGULAR", "oferta concluida hasta ahora");
    //deals done until now
	define("LANG_SITEMGR_DONEUNTIL_PLURAL", "ofertas concluidas hasta ahora");
	//left
	define("LANG_SITEMGR_LEFT", "restantes");
    //OFF
    define("LANG_DEAL_OFF", "OFF");
    //Please wait, loading...
    define("LANG_DEAL_PLEASEWAITLOADING", "Por favor, espere...");
    //Please wait. We are redirecting your login to complete this step...
    define("LANG_DEAL_PLEASEWAITLOADING2", "Por favor, espere. Estamos redireccionando su nombre de inicio de sesion para completar este paso...");
    //Item Value is required.
    define("LANG_MSG_VALIDDEAL_REALVALUE", "Se requiere el Valor del Articulo.");
    //Value with Discount is required.
    define("LANG_MSG_VALIDDEAL_DEALVALUE", "Se requiere el ".LANG_LABEL_DISC_AMOUNT);
	//Value with Discount can not be higher than 99.
    define("LANG_MSG_VALIDDEAL_DEALVALUE2", LANG_LABEL_DISC_AMOUNT." no puede ser superior a 99.");
    //Deals to offer is required.
    define("LANG_MSG_VALIDDEAL_AMOUNT", "Se requiere las Ofertas para ofrecer.");
    //Please enter a minor value on Value with Discount field.
    define("LANG_MSG_VALID_MINOR", "Por favor, ingrese un valor menor en el campo ".LANG_LABEL_DISC_AMOUNT);
	//Redemeed at
    define("LANG_DEAL_REMEEDED_AT", "Redimido a");
	//You can only directly link this deal to a listing if you select one account first
    define("DEAL_LINK2LISTING_ACCTINFO", "Sólo se puede vincular directamente este acuerdo a un listado si selecciona una cuenta antes");
    //Value
    define("DEAL_VALUE", "Valor");
    //With discount
    define("DEAL_WITHCOUPON", "Con descuento");
	//Redeem by e-mail
    define("DEAL_REDEEMBYEMAIL", "Validar por correo electrónico");
	//Sign In and Redeem
    define("DEAL_CONNECT_REDEEM", "Iniciar sessión y canjear");
	//Redeem and Print
	define("LANG_LABEL_REDEEM_PRINT", "Conecte y de impresión");
    //Redeem and Share
    define("DEAL_REDEEMSHARE", "Redimir y Compartir");
    //Featured Deals
    define("DEAL_FEATURED_DEALS", "Ofertas Destacadas");
    //Sign in using your Facebook session
    define("LOGIN_FB_CURRENT_SESSION", "Accede a través de su sesión de Facebook");
	//To Redeem using Facebook you need to connect using your Facebook account
    define("LANG_DEAL_DISCONNECTED_NOFB", "Para canjear utilizando Facebook usted necesita conectarse a través de tu cuenta de Facebook.");
    //Redeem Statistics
    define("LANG_LABEL_REDEEM_STATISTICS", "Canjear Estadísticas");
    //Redeem code
    define("DEAL_SITEMGR_REDEEMCODE", "Canjear código");
    //Available
    define("DEAL_SITEMGR_AVAILABLE", "Disponible");
    //Used
    define("DEAL_SITEMGR_USED", "Usado");
    //Redeem using your current Facebook session.
    define("DEAL_REDEEMINFO_3", "Redimir con su actual período de sesiones Facebook");
    //Use
    define("DEAL_SITEMGR_USE", "Utilice");
	//Saving...
	define("LANG_DEAL_SAVING", "Guardando...");
	//No redeem found
	define("LANG_DEAL_NO_RECORD", "No canje encontrado.");
	//percentage
	define("LANG_LABEL_PERCENTAGE", "porcentaje");
	//fixed value
	define("LANG_LABEL_FIXEDVALUE", "valor fijo");

	# ----------------------------------------------------------------------------------------------------
	# IMPORT
	# ----------------------------------------------------------------------------------------------------
	//line
	define("LANG_MSG_IMPORT_ERROR_LINE", "línea");
	//Error importing to temporary table.
	define("LANG_MSG_IMPORT_ERRORONIMPORTTOTEMPABLE", "Error al importar a tabla temporal.");
	//Invalid renewal date - line
	define("LANG_MSG_IMPORT_INVALIDRENEWALDATE", "Fecha de renovación no válida  - línea");
	//Invalid updated date - line
	define("LANG_MSG_IMPORT_INVALIDUPDATEDATE", "Fecha de actualización no válida  - línea");
	//CSV file imported to temporary table.
	define("LANG_MSG_IMPORT_CSVIMPORTEDTOTEMPORARYTABLE", "Archivo CSV importado a tabla temporal.");
	//Invalid e-mail - line
	define("LANG_MSG_IMPORT_INVALIDUSERNAMELINE", "Correo electronico no válido - línea");
	//Invalid password - line
	define("LANG_MSG_IMPORT_INVALIDPASSWORDLINE", "Contraseña no válida - línea");
	//Invalid keyword (maximum 10 keywords) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS", "Palabra clave no válida (máximo ".MAX_KEYWORDS." palabras clave) - línea");
	//Invalid keyword (keywords with a maximum of 50 characters each.) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS2", "Palabra clave no válida(".LANG_MSG_KEYWORDS_WITH_MAXIMUM_50.") - línea");
	//Invalid title - line
	define("LANG_MSG_IMPORT_INVALIDTITLELINE", "Titulo no válido - línea");
	//Invalid start date - line
	define("LANG_MSG_IMPORT_INVALIDSTARTDATE", "Fecha de inicio no válida - línea");
	//Invalid end date - line
	define("LANG_MSG_IMPORT_INVALIDENDDATE", "Fecha de finalización no válida - línea");
	//Start date must be filled - line
	define("LANG_MSG_IMPORT_STARTDATEEMPTY", "Fecha de inicio debe ser completada - línea");
	//End date must be filled - line
	define("LANG_MSG_IMPORT_ENDDATEEMPTY", "Fecha de finalización debe ser completada - línea");
	//The "End Date" must be greater than or equal to the "Start Date" - line
	define("LANG_MSG_IMPORT_END_DATE_GREATER_THAN_START_DATE", str_replace(".", "", LANG_MSG_END_DATE_GREATER_THAN_START_DATE)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//The "End Date" cannot be in past - line
	define("LANG_MSG_IMPORT_END_DATE_CANNOT_IN_PAST", str_replace(".", "", LANG_MSG_END_DATE_CANNOT_IN_PAST)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Invalid start time - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_NUMBER", "Hora de inicio inválida. - línea");
	//Invalid end time - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_NUMBER", "Hora de finalización inválida - línea");
	//Invalid start time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_FORMAT", "Formato Inválido de la hora de inicio. Debe ser \"xx:xx\" - línea");
	//Invalid end time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_FORMAT", "Formato Inválido de la hora de finalización. Debe ser \"xx:xx\" - línea");
	//Invalid start time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE1", "Modo inválido de la hora de inicio. Debe ser \"AM\" o \"PM\" - línea");
	//Invalid end time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE1", "Modo no válido de la hora de finalización. Debe ser \"AM\" o \"PM\" - línea");
	//Invalid start time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE2", "Modo no válido de la hora de inicio. Debe ser \"24\" - línea");
	//Invalid end time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE2", "Modo no válido de la hora de finalización. Debe ser \"24\" - línea");
	//The "End Time" must be greater than the "Start Time" - line
	define("LANG_MSG_IMPORT_END_TIME_GREATER_THAN_START_TIME", str_replace(".", "", LANG_MSG_END_TIME_GREATER_THAN_START_TIME)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Location and system default location are different - line
	define("LANG_MSG_IMPORT_INVALIDLOCATIONLINE", "Ubicación y la ubicación estándar del sistema son diferentes - línea");
	//Invalid latitude. Must be numeric between -90 and 90 - line
	define("LANG_MSG_IMPORT_INVALIDLATITUDELINE", "Latitud inválida . Debe ser numérico entre -90 y 90 - línea");
	//Invalid longitude. Must be numeric between -180 and 180 - line
	define("LANG_MSG_IMPORT_INVALIDLONGITUDELINE", "Longitud inválida . Debe ser numérico entre -180 y 180 - línea");
	//No CSV Files in Import Folder.
	define("LANG_MSG_IMPORT_NOFILES_INFTP", "No hay archivos CSV en el directorio de importación.");
	//The number of columns in the following line(s) are wrong:
	define("LANG_MSG_IMPORT_NUMBEROFCOLUMNSAREWRONG", "El número de columnas en la(s) línea(s) siguiente(s) están equivocados:");
	//Total lines read:
	define("LANG_MSG_IMPORT_TOTALLINESREADY", "Total de líneas que se lee:");
	//Total error lines:
	define("LANG_MSG_IMPORT_TOTALLINESERROR", "Total de líneas de error:");
	//CSV header does not match - it has more fields that it is allowed
	define("LANG_MSG_IMPORT_WRONG_HEADER", "CSV header does not match - it has more fields than it is allowed");
	//CSV header does not match at field(s):
	define("LANG_MSG_IMPORT_WRONG_HEADER2", "Encabezado en el archivo CSV no coincide en el campo(s): ");
	//account rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK", "cuenta revertida");
	//accounts rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK_PLURAL", "cuentas revertidas");
	//item rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK", "artículo revertido");
	//items rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK_PLURAL", "artículos revertidos");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	//Find what you are Looking for...
	define("LANG_SEARCH_MESSAGE_TITLE", "Encuentre lo que está buscando...");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword.
	define("LANG_SEARCH_MESSAGE_TEXT", "A veces puede no recibir algun resultado de su búsqueda por la palabra clave que han utilizado es muy genérico. Asegurese de usar una palabra clave más específica.");

	# ----------------------------------------------------------------------------------------------------
	# PAGING
	# ----------------------------------------------------------------------------------------------------
	//Results per page
	define("LANG_PAGING_RESULTS_PER_PAGE", "Resultados por página");
	//Per Page
	define("LANG_PAGING_PER_PAGE", "Por Página");
	//Showing results
	define("LANG_PAGING_SHOWING_RESULTS", "Mostrando resultados");
	//Showing
	define("LANG_PAGING_SHOWING", "Mostrando");
	//to
	define("LANG_PAGING_SHOWING_TO", "a");
	//of
	define("LANG_PAGING_SHOWING_OF", "de");
	//Pages
	define("LANG_PAGING_SHOWING_PAGE", "Páginas");

	# ----------------------------------------------------------------------------------------------------
	# SUGARCRM
	# ----------------------------------------------------------------------------------------------------
	//Importing [SUGAR_ITEM_TITLE] from SugarCRM to [EDIRECTORY_TITLE]
	define("LANG_IMPORT_ITEM_FROM_SUGAR", "La importación de [SUGAR_ITEM_TITLE] de SugarCRM en [EDIRECTORY_TITLE]");
	//Use the form above to import from the SugarCRM record [SUGAR_ITEM_TITLE], after clicking import your data will be transferred to your directory installation with all relevant information passed across, just fill in the extra data, and payment data.
	define("LANG_MESSAGE_ON_FOOTER", "Utilice el formulario de arriba para importar desde el registro del SugarCRM [SUGAR_ITEM_TITLE], después de hacer clic importar sus datos serán transferidos a su directorio con toda la información relevante pasa a través, por favor llene los datos adicionales, y los datos de pago.");
	//You're nearly done.
	define("LANG_YOU_NEARLY_DONE", "Estás a punto de terminar.");
	//It was not possible to export. Please check your SugarCRM connection information on your directory.
	define("LANG_SUGAR_CHECKINFO", "No fue posible exportar. Por favor, revise la información de conexión de SugarCRM en su directorio.");
	//Wrong eDirectory Key.
	define("LANG_SUGAR_WRONG_KEY", "Llave incorrecta de eDirectory.");

	# ----------------------------------------------------------------------------------------------------
	# ADVERTISE
	# ----------------------------------------------------------------------------------------------------
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_TITLE", LANG_LISTING_TITLE);
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_OWNER", "Proprietario del Listado");
	//10% Off - Deal Title
	define("LANG_LABEL_ADVERTISE_DEAL_TITLE", "10% Off - ".LANG_PROMOTION_TITLE);
	//Review Title
	define("LANG_LABEL_ADVERTISE_REVIEW_TITLE", "Título de la Calificacion");
	//Event Title
	define("LANG_LABEL_ADVERTISE_EVENT_TITLE", LANG_EVENT_TITLE);
	//Event Owner
	define("LANG_LABEL_ADVERTISE_EVENT_OWNER", "Proprietario del Evento");
	//Classified Title
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_TITLE", LANG_CLASSIFIED_TITLE);
	//Classified Owner
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_OWNER", "Proprietario del Clasificado");
	//Article Title
	define("LANG_LABEL_ADVERTISE_ARTICLE_TITLE", LANG_ARTICLE_TITLE);
	//Article Author
	define("LANG_LABEL_ADVERTISE_ARTICLE_AUTHOR", "Autor del Articulo");
	//Contact Name
	define("LANG_LABEL_ADVERTISE_ITEM_CONTACT", LANG_LABEL_CONTACTNAME);
	//Zipcode
	define("LANG_LABEL_ADVERTISE_ITEM_ZIPCODE", ZIPCODE_LABEL);
	//www.yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_SITE", "www.susitio.com");
	//youremail@yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_EMAIL", "tunombre@susitio.com");
	//Address
	define("LANG_LABEL_ADVERTISE_ITEM_ADDRESS", LANG_LABEL_ADDRESS);
	//Card holder name
	define("LANG_LABEL_CARDHOLDER_NAME", "Nombre del titular de la tarjeta");
	//Charge for
	define("LANG_CHARGEFOR", "Facturación");
	//Visitor
	define("LANG_LABEL_ADVERTISE_VISITOR", "Visitante");
	//Category
	define("LANG_LABEL_ADVERTISE_CATEGORY", "Categoría");
	//Category 1
	define("LANG_LABEL_ADVERTISE_CATEGORY1", "Categoría 1");
	//Category 1.1
	define("LANG_LABEL_ADVERTISE_CATEGORY1_2", "Categoría 1.1");
	//Category 2
	define("LANG_LABEL_ADVERTISE_CATEGORY2", "Categoría 2");
	//Category 2.2
	define("LANG_LABEL_ADVERTISE_CATEGORY2_2", "Categoría 2.2");
	//Summary View
	define("LANG_LABEL_ADVERTISE_SUMMARYVIEW", "Vista 	Resumida");
	//Detail View
	define("LANG_LABEL_ADVERTISE_DETAILVIEW", "Descripcion Completa");
	//This content is illustrative
	define("LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE", "Contenido ilustrativo");

	# ----------------------------------------------------------------------------------------------------
	# TWILIO
	# ----------------------------------------------------------------------------------------------------
	//Activate Click-to-Call
	define("LANG_LABEL_ACTIVATECLICKCALL", "Haga clic para Llamar");
	//Send to Phone
	define("LANG_LABEL_SENDPHONE", "Enviar a Teléfono");
	//Click to Call
	define("LANG_LABEL_CLICKTOCALL", "Haga clic para Llamar");
	//Message successfully sent!
	define("LANG_LABEL_SMS_SENT", "¡Mensaje enviado con éxito!");
	//Send info about this listing to a phone.
	define("LANG_LISTING_TOPHONE_SAUDATION", "Enviar información sobre este listado a un teléfono.");
	//Enter your phone to call the listing owner with no costs.
	define("LANG_LISTING_CLICKTOCALL_SAUDATION", "Ingrese su numero de teléfono para llamar al dueño del listado, sin costo.");
	//Phone is required.
	define("LANG_PHONE_REQUIRED", "El teléfono es requerido.");
	//Please, type a valid phone number.
	define("LANG_PHONE_INVALID", "Por favor, escriba un número de teléfono válido.");
	//Call
	define("LANG_TWILIO_CALL", "llamar");
	//Calling
	define("LANG_TWILIO_CALLING", "Llamando");
	//Phone
	define("LANG_CLICKTOCALL_PHONE", "Teléfono");
	//Extension
	define("LANG_CLICKTOCALL_EXTENSION", "Extensión");
	//Activate
	define("LANG_CLICKTOCALL_ACTIVATE", "Activar");
	//Enter this code in your phone keypad when the test call connects:
	define("LANG_CLICKTOCALL_YOUR_VALIDATION_CODE", "Introduzca este código en el teclado de su teléfono cuando la llamada de prueba se conecta:");
	//Your phone number was activated!
	define("LANG_CLICKTOCALL_STATUS_ACTIVATED", "¡Su número de teléfono fue activado!");
	//Phone number successfully deleted!
	define("LANG_CLICKTOCALL_PHONE_DELETED", "¡Número de teléfono eliminado correctamente!");
	//Click to Call not available for this listing
	define("LANG_MSG_CLICKTOCALL_NOT_AVAILABLE", "Click para llamar no esta disponible para este listado");
	//Activate Click-to-Call and Get More Contacts
	define("LANG_CLICKTOCALL_TIPTITLE", "Activar Click-to-Call y conseguir más contactos");
	//You need to activate the phone number below in order to allow the users to contact you directly through the directory.
	define("LANG_CLICKTOCALL_TIP1", "Debes activar el número de teléfono de abajo con el fin de permitir a los usuarios contactarle directamente através del directorio.");
	//Click-to-call allows clients to connect a call between your phone and theirs with the click of a button.  To activate, press the button below and a test call will be made.
	define("LANG_CLICKTOCALL_TIP2", "Click-to-call permite a los clientes conectar una llamada entre el teléfono de ellos y el suyo con el clic de un botón. Para activarlo, pulse el botón de abajo y se hará una llamada de prueba.");
	//A message with your activation code will be shown. Take note of this code and wait for the activation phone call.
	define("LANG_CLICKTOCALL_TIP3", "Un mensaje con el código de activación será mostrado. Tome nota de este código y espere la llamada de activación.");
	//You will be ask to enter the six digits activation code. Enter the code and wait for the confirmation message.
	define("LANG_CLICKTOCALL_TIP4", "Se le pedirá que introduzca el código de seis dígitos de activación. Introduzca el código y espere el mensaje de confirmación.");
	//After activate your phone number, click in Save Number to finish the process.
	define("LANG_CLICKTOCALL_TIP5", "Después de activar su número de teléfono, haga clic en Guardar para finalizar el proceso.");
	//For numbers outside the USA, you need to put your country code first.
	define("LANG_CLICKTOCALL_TIP6", "Para los números fuera de los EE.UU., es necesario poner el código de país primero.");
	//For numbers outside the USA, the country code must be included.
	define("LANG_CLICKTOCALL_TIP7", "Para los números fuera de los EE.UU., se debe incluir el código del país.");
	//"Click to Call" report
	define("LANG_CLICKTOCALL_REPORT", "\"Haga clic para Llamar\" informe");
	//Direction
	define("LANG_CLICKTOCALL_REPORT_DIRECTION", "Dirección");
	//To
	define("LANG_CLICKTOCALL_REPORT_FROM", "De");
	//Start Time
	define("LANG_CLICKTOCALL_REPORT_START_TIME", "Hora de Inicio");
	//End Time
	define("LANG_CLICKTOCALL_REPORT_END_TIME", "Hora de Finalización");
	//Duration (seconds)
	define("LANG_CLICKTOCALL_REPORT_DURATION", "Duracion (en segundos)");
	//No reports available.
	define("LANG_CLICKTOCALL_REPORT_NORECORD", "No hay informes disponibles.");
	//Activated by
	define("LANG_LABEL_ACTIVATED_BY", "Activado por");
	//Activation failed. Please, try again.
	define("LANG_TWILIO_ERROR_10000", "La activación ha fallado. Por favor, inténtelo de nuevo.");
	//Account is not active.
	define("LANG_TWILIO_ERROR_10001", "Cuenta no está activa.");
	//Trial account does not support this feature.
    define("LANG_TWILIO_ERROR_10002", "Cuenta de prueba no es compatible con esta función.");
	//Incoming call rejected due to inactive account.
    define("LANG_TWILIO_ERROR_10003", "Llamada entrante rechazada debido a cuenta inactiva.");
	//Invalid URL format.
    define("LANG_TWILIO_ERROR_11100", "Formato del URL no válido.");
	//HTTP retrieval failure.
    define("LANG_TWILIO_ERROR_11200", "Recuperación HTTP ha fallado.");
	//HTTP connection failure.
    define("LANG_TWILIO_ERROR_11205", "La conexión HTTP ha fallado.");
	//HTTP protocol violation.
    define("LANG_TWILIO_ERROR_11206", "Violación HTTP del protocolo.");
	//HTTP bad host name.
    define("LANG_TWILIO_ERROR_11210", "HTTP mal nombre de host.");
	//HTTP too many redirects.
    define("LANG_TWILIO_ERROR_11215", "HTTP demasiados redireccionamientos.");
	//Document parse failure.
    define("LANG_TWILIO_ERROR_12100", "Fallo al analizar documento.");
	//Invalid Twilio Markup XML version.
    define("LANG_TWILIO_ERROR_12101", "Versión XML Inválida de Twilio Markup  .");
	//The root element must be Response.
    define("LANG_TWILIO_ERROR_12102", "El elemento raíz debe ser Response.");
	//Schema validation warning.
    define("LANG_TWILIO_ERROR_12200", "Advertencia de validación del esquema.");
	//Invalid Content-Type.
    define("LANG_TWILIO_ERROR_12300", "Tipo de Contenido Invalido.");
	//Internal Failure.
    define("LANG_TWILIO_ERROR_12400", "Falla interna.");
	//Dial: Cannot Dial out from a Dial Call Segment.
    define("LANG_TWILIO_ERROR_13201", "Marcar: No se puede marcar desde un segmento de llamadas de marcación.");
	//Dial: Invalid method value.
    define("LANG_TWILIO_ERROR_13210", "Marcar: método de valor no válido.");
	//Dial: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13212", "Marcar: tiempo de espera no válido.");
	//Dial: Invalid hangupOnStar value.
    define("LANG_TWILIO_ERROR_13213", "Marcar: valor de hangupOnStar no válido.");
	//Dial: Invalid callerId value.
    define("LANG_TWILIO_ERROR_13214", "Marcar: valor de callerId no válido.");
	//Dial: Invalid nested element.
    define("LANG_TWILIO_ERROR_13215", "Marcar: Elemento anidado inválido.");
	//Dial: Invalid timeLimit value.
    define("LANG_TWILIO_ERROR_13216", "Marcar: valor de timeLimit no válido.");
	//Dial->Number: Invalid method value.
    define("LANG_TWILIO_ERROR_13221", "Marcar->Number: Valor del método no válido.");
	//Dial->Number: Invalid sendDigits value.
    define("LANG_TWILIO_ERROR_13222", "Marcar->Number: Valor de sendDigits no válido.");
	//Dial: Invalid phone number format.
    define("LANG_TWILIO_ERROR_13223", "Marcar: Formato de número de teléfono no válido.");
	//Dial: Invalid phone number.
    define("LANG_TWILIO_ERROR_13224", "Marcar: Número de teléfono no válido.");
	//Dial: Forbidden phone number.
    define("LANG_TWILIO_ERROR_13225", "Marcar: Número de teléfono prohibido.");
	//Dial->Conference: Invalid muted value.
    define("LANG_TWILIO_ERROR_13230", "Marcar->Conferencia: Valor silenciado no válido .");
	//Dial->Conference: Invalid endConferenceOnExit value.
    define("LANG_TWILIO_ERROR_13231", "Marcar->Conferencia: Valor endConferenceOnExit no válido .");
	//Dial->Conference: Invalid startConferenceOnEnter value.
    define("LANG_TWILIO_ERROR_13232", "Marcar->Conferencia: Valor startConferenceOnEnter no válido .");
	//Dial->Conference: Invalid waitUrl.
    define("LANG_TWILIO_ERROR_13233", "Marcar->Conferencia: waitUrl inválido .");
	//Dial->Conference: Invalid waitMethod.
    define("LANG_TWILIO_ERROR_13234", "Marcar->Conferencia: waitMethod inválido.");
	//Dial->Conference: Invalid beep value.
    define("LANG_TWILIO_ERROR_13235", "Marcar->Conferencia: beep value inválido.");
	//Dial->Conference: Invalid Conference Sid.
    define("LANG_TWILIO_ERROR_13236", "Marcar->Conferencia: Conference Sid inválido.");
	//Dial->Conference: Invalid Conference Name.
    define("LANG_TWILIO_ERROR_13237", "Marcar->Conferencia: Conference Name inválido.");
	//Dial->Conference: Invalid Verb used in waitUrl TwiML.
    define("LANG_TWILIO_ERROR_13238", "Marcar->Conferencia: Verb usado en waitUrl TwiML es inválido.");
	//Gather: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13310", "Reunir: Valor finishOnKey no válido.");
	//Gather: Invalid method value.
    define("LANG_TWILIO_ERROR_13312", "Reunir: Valor del método no válido.");
	//Gather: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13313", "Reunir: Valor del tiempo de espera no válido.");
	//Gather: Invalid numDigits value.
    define("LANG_TWILIO_ERROR_13314", "Reunir: Valor del numDigits no válido.");
	//Gather: Invalid nested verb.
    define("LANG_TWILIO_ERROR_13320", "Reunir: Inválida verbo anidadas.");
	//Gather->Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13321", "Reunir->Decir: Valor de voz no válido.");
	//Gather->Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13322", "Reunir->Decir: Valor de bucle no válido .");
	//Gather->Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13325", "Reunir->Reproducir: Contenido-Tipo No válido.");
	//Play: Invalid loop value.
    define("LANG_TWILIO_ERROR_13410", "Play: Valor no válido bucle.");
	//Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13420", "Play: No válido Content-Type.");
	//Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13510", "Decir: Valor de bucle no válido.");
	//Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13511", "Decir: Valor de voz no válido.");
	//Say: Invalid text.
    define("LANG_TWILIO_ERROR_13520", "Decir: Texto no válido.");
	//Record: Invalid method value.
    define("LANG_TWILIO_ERROR_13610", "Grabar: Valor no válido el método.");
	//Record: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13611", "Grabar: Valor no válido de tiempo de espera.");
	//Record: Invalid maxLength value.
    define("LANG_TWILIO_ERROR_13612", "Grabar: Valor no válido maxLength.");
	//Record: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13613", "Grabar: Valor no válido finishOnKey");
	//Redirect: Invalid method value.
    define("LANG_TWILIO_ERROR_13710", "Redireccionar: Valor no válido el método.");
	//Pause: Invalid length value.
    define("LANG_TWILIO_ERROR_13910", "Pausar: Valor no válido longitud.");
	//Invalid "To" attribute.
    define("LANG_TWILIO_ERROR_14101", "Invalido \"Para\" atributo.");
	//Invalid "From" attribute.
    define("LANG_TWILIO_ERROR_14102", "Invalido \"De\" atributo.");
	//Invalid Body.
    define("LANG_TWILIO_ERROR_14103", "Cuerpo no válido.");
	//Invalid Method attribute.
    define("LANG_TWILIO_ERROR_14104", "Atributo no válido el método.");
	//Invalid statusCallback attribute.
    define("LANG_TWILIO_ERROR_14105", "Atributo no válido statusCallback.");
	//Document retrieval limit reached.
    define("LANG_TWILIO_ERROR_14106", "Limitar la recuperación de documentos alcanzado.");
	//SMS send rate limit exceeded.
    define("LANG_TWILIO_ERROR_14107", "SMS enviar superado el límite de velocidad.");
	//From phone number not SMS capable.
    define("LANG_TWILIO_ERROR_14108", "De número de teléfono SMS no pueden.");
	//SMS Reply message limit exceeded.
    define("LANG_TWILIO_ERROR_14109", "Responder mensaje SMS límite excedido.");
	//Invalid Verb for SMS Reply.
    define("LANG_TWILIO_ERROR_14110", "No válido para el verbo Responder SMS.");
	//Invalid To phone number for Trial mode.
    define("LANG_TWILIO_ERROR_14111", "Número de teléfono no válido para el modo de prueba.");
	//Unknown parameters.
    define("LANG_TWILIO_ERROR_20001", "Parámetros desconocidos.");
	//Invalid FriendlyName.
    define("LANG_TWILIO_ERROR_20002", "Inválida FriendlyName.");
	//Permission Denied.
    define("LANG_TWILIO_ERROR_20003", "Permiso denegado.");
	//Method not allowed.
    define("LANG_TWILIO_ERROR_20004", "Método no permitido.");
	//Account not active.
    define("LANG_TWILIO_ERROR_20005", "Cuenta no está activa.");
	//No Called number specified.
    define("LANG_TWILIO_ERROR_21201", "No se especifica número llamado.");
	//Called number is a premium number.
    define("LANG_TWILIO_ERROR_21202", "Número de llamada es un número premium.");
	//International calling not enabled.
    define("LANG_TWILIO_ERROR_21203", "No están habilitadas las Llamadas internacionales .");
	//Invalid URL.
    define("LANG_TWILIO_ERROR_21205", "URL no válida.");
	//Invalid SendDigits.
    define("LANG_TWILIO_ERROR_21206", "SendDigits no válido.");
	//Invalid IfMachine.
    define("LANG_TWILIO_ERROR_21207", "Inválida IfMachine.");
	//Invalid Timeout.
    define("LANG_TWILIO_ERROR_21208", "Tiempo de espera Inválido.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21209", "Método no válido.");
	//Caller phone number not verified.
    define("LANG_TWILIO_ERROR_21210", "Número de teléfono de llamada no verificado.");
	//Invalid Called Phone Number.
    define("LANG_TWILIO_ERROR_21211", "Número de teléfono llamado no válido.");
	//Invalid Caller Phone Number.
    define("LANG_TWILIO_ERROR_21212", "Número de teléfono del llamante No válido.");
	//Caller phone number is required.
    define("LANG_TWILIO_ERROR_21213", "Número de teléfono de quien llamada es necesario.");
	//Called Phone Number cannot be reached.
    define("LANG_TWILIO_ERROR_21214", "Número de teléfono llamado no puede ser accesado.");
	//Account not authorized to call phone number.
    define("LANG_TWILIO_ERROR_21215", "Cuenta no autorizada para llamar al número de teléfono.");
	//Account not allowed to call phone number.
    define("LANG_TWILIO_ERROR_21216", "A esta cuenta no se le permite llamar al número de teléfono.");
	//Phone number does not appear to be valid.
    define("LANG_TWILIO_ERROR_21217", "Número de teléfono no parece ser válido.");
	//Invalid ApplicationSid.
    define("LANG_TWILIO_ERROR_21218", "ApplicationSid Inválida .");
	//Invalid call state.
    define("LANG_TWILIO_ERROR_21220", "Estado no válido de llamada.");
	//Invalid Phone Number.
    define("LANG_TWILIO_ERROR_21401", "Número de teléfono no válido.");
	//Invalid Url.
    define("LANG_TWILIO_ERROR_21402", "URL no válido.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21403", "Método no válido");
	//Inbound Phone number not available to trial account.
    define("LANG_TWILIO_ERROR_21404", "Número de teléfono entrante no está disponible en la cuenta de prueba.");
	//Cannot set VoiceFallbackUrl without setting Url.
    define("LANG_TWILIO_ERROR_21405", "No se puede establecer sin establecer VoiceFallbackUrl Url.");
	//Cannot set SmsFallbackUrl without setting SmsUrl.
    define("LANG_TWILIO_ERROR_21406", "No se puede establecer sin establecer SmsFallbackUrl SmsUrl.");
	//This Phone Number type does not support SMS.
    define("LANG_TWILIO_ERROR_21407", "Este tipo de número de teléfono no es compatible con SMS.");
	//Phone number already validated on your account.
    define("LANG_TWILIO_ERROR_21450", "Número de teléfono ya validados en su cuenta.");
	//Invalid area code.
    define("LANG_TWILIO_ERROR_21451", "Código de área no válido.");
	//No phone numbers found in area code.
    define("LANG_TWILIO_ERROR_21452", "No se encontraron números de teléfono en el código de área.");
	//Phone number already validated on another account.
    define("LANG_TWILIO_ERROR_21453", "Número de teléfono ya validados en otra cuenta.");
	//Invalid CallDelay.
    define("LANG_TWILIO_ERROR_21454", "CallDelay Inválido.");
	//Resource not available.
    define("LANG_TWILIO_ERROR_21501", "Recurso no disponible.");
	//Invalid callback url.
    define("LANG_TWILIO_ERROR_21502", "URL no válida de devolución de llamada.");
	//Invalid transcription type.
    define("LANG_TWILIO_ERROR_21503", "Tipo de transcripción Invalido.");
	//RecordingSid is required..
    define("LANG_TWILIO_ERROR_21504", "RecordingSid es necesario.");
	//Phone number is not a valid SMS-capable inbound phone number.
    define("LANG_TWILIO_ERROR_21601", "Número de teléfono no es un numero con capacidad de recibir SMS de número de teléfono entrante.");
	//Message body is required.
    define("LANG_TWILIO_ERROR_21602", "Se requiere el cuerpo del mensaje.");
	//The source 'from' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21603", "El numero de telefono \"de\" es necesario para enviar un SMS.");
	//The destination 'to' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21604", "El numero de telefono de destino \"a\" es necesario para enviar un SMS.");
	//Maximum SMS body length is 160 characters.
    define("LANG_TWILIO_ERROR_21605", "La longitud máxima del cuerpo de SMS es de 160 caracteres");
	//The "From" phone number provided is not a valid, SMS-capable inbound phone number for your account.
    define("LANG_TWILIO_ERROR_21606", "El \"De\" número de teléfono proporcionado no es un numero con capacidad de SMS entrante para su cuenta.");
	//The Sandbox number can send messages only to verified numbers.
    define("LANG_TWILIO_ERROR_21608", "El número de Sandbox puede enviar mensajes solamente a números verificados.");

	# ----------------------------------------------------------------------------------------------------
	# FACEBOOK COMMENTS
	# ----------------------------------------------------------------------------------------------------
	//Facebook comments
	define("LANG_LABEL_FACEBOOK_COMMENTS", "Comentarios del Facebook");
	//Facebook comments not available for this listing
	define("LANG_LABEL_FACEBOOK_COMMENTS_NOT_AVAILABLE", "Comentarios del Facebook no estan disponibles para este listado");
	//Be sure you're logged into Facebook with the same account you set in your Commenting Options section, otherwise you can not moderate the comments for this item.
	define("LANG_LABEL_FACEBOOK_TIP1", "Asegúrese de estar conectado a Facebook con la misma cuenta se establece en la sección Opciones de Comentarios, de lo contrario no podra moderar los comentarios para este artículo.");
	//You can also moderate your comments by going to
	define("LANG_LABEL_FACEBOOK_TIP2", "También puede moderar los comentarios a través de ");

	# ----------------------------------------------------------------------------------------------------
	# EDIRECTORY API
	# ----------------------------------------------------------------------------------------------------
	//Invalid API key.
	define("LANG_API_INVALIDKEY", "Llave de API no es valida.");
	//Missing parameter: module.
	define("LANG_API_EMPTYMODULE", "Falta un parámetro: modulo.");
	//Invalid module name.
	define("LANG_API_INVALIDMODULE", "Nombre del módulo no válido.");
	//Module disabled.
	define("LANG_API_MODULEOFF", "Módulo desactivado.");
	//Missing parameter: keyword.
	define("LANG_API_EMPTYKEYWORD", "Falta un parámetro: palabra clave.");
	//API disabled.
	define("LANG_API_DISABLED", "API deshabilitada.");

	# ----------------------------------------------------------------------------------------------------
	# THEME TEMPLATE
	# ----------------------------------------------------------------------------------------------------
	//Swimming Pool
	define("LANG_LABEL_TEMPLATE_POOL", "Piscina");
	//Bedroom(s)
	define("LANG_LABEL_TEMPLATE_BEDROOM", "Habitacione(s)");
	//Bathroom(s)
	define("LANG_LABEL_TEMPLATE_BATHROOM", "Baño(s)");
	//Level(s)
	define("LANG_LABEL_TEMPLATE_LEVEL", "Piso(s)");
	//Property Type
	define("LANG_LABEL_TEMPLATE_TYPE", "Tipo de Inmueble");
	//Purpose
	define("LANG_LABEL_TEMPLATE_PURPOSE", "Uso");
	//Price
	define("LANG_LABEL_TEMPLATE_PRICE", "Precio");
	//Acres
	define("LANG_LABEL_TEMPLATE_ACRES", "Acres");
	//Built In
	define("LANG_LABEL_TEMPLATE_TYPEBUILTIN", "Construido En");
	//Square Feet
	define("LANG_LABEL_TEMPLATE_SQUARE", "Pies Cuadrados");
	//Office
	define("LANG_LABEL_TEMPLATE_OFFICE", "Oficina");
	//Laundry Room
	define("LANG_LABEL_TEMPLATE_LAUNDRYROOM", "Lavandería");
	//Central Air Conditioning
	define("LANG_LABEL_TEMPLATE_AIRCOND", "Aire Acondicionado Central");
	//Dining Room
	define("LANG_LABEL_TEMPLATE_DINING", "Comedor");
	//Garage
	define("LANG_LABEL_TEMPLATE_GARAGE", "Garaje");
	//Garbage Disposal
	define("LANG_LABEL_TEMPLATE_GARBAGE", "Basura y Residuos");

	# ----------------------------------------------------------------------------------------------------
	# BLOG
	# ----------------------------------------------------------------------------------------------------
	//Your post will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_POST_AUTOMATICALLY_APPEAR", "Tu entrada aparecerá automáticamente en la categoría principal de cada subcategoría que seleccione.");
	//Type a keyword or post title
	define("LANG_LABEL_SEARCHKEYWORDTIP_POST", "Ingrese una palabra clave o el nombre de la entrada");
	//Archive
	define("LANG_BLOG_ARCHIVE", "Archivo");
	//Recent Topics
	define("LANG_BLOG_RECENTTOPICS", "Temas Recientes");
	//Recent Members
	define("LANG_BLOG_RECENTMEMBERS", "Miembros Recientes");
	//View more
	define("LANG_VIEWMORE", "Ver más");
	//Popular Topics
	define("LANG_BLOG_POPULARTOPICS", "Temas Populares");
	//Post Search Results
	define("LANG_MSG_BLOGRESULTS", "Resultados de la Búsqueda de Entrada");
	//Comments
	define("LANG_BLOG_COMMENTS", "Comentarios");
	//Comment It
	define("LANG_BLOG_COMMENTIT", "¡Comentario!");
	//Related Posts
	define("LANG_BLOG_RELATEDPOSTS", "Entradas relacionadas");
	//Web Site
	define("LANG_LABEL_WEBSITE", "Web Site");
	//Published
	define("LANG_BLOG_PUBLISHED", "Publicado");
	//on
	define("LANG_BLOG_ON", "en");
	//"About" [POST_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_BLOG_CONTACTSUBJECT_ISNULL_1", "Sobre");
	//About [POST_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_BLOG_CONTACTSUBJECT_ISNULL_2", "de la");
	//Send info about this post to a friend
	define("LANG_BLOG_TOFRIEND_SAUDATION", "Enviar información acerca de esta entrada a un amigo");
	//SOME DETAILS
	define("LANG_BLOG_TOFRIEND_MAIL", "ALGUNOS DETALLES");
	//Post
	define("LANG_BLOG", "Entrada");
	//Leave Your Comment
	define("LANG_MSG_LEAVEYOURCOMMENT", "Deja tu comentario");
	//Reply this comment
	define("LANG_MSG_REPLYTHISCOMMENT", "Responder este comentario");
	//Please type a valid e-mail
	define("LANG_COMMENT_EMPTY_EMAIL", "Por favor ingrese un correo electronico válido.");
	//Please type a website
	define("LANG_COMMENT_EMPTY_WEBSITE", "Por favor ingrese un correo electronico válido.");
	//Please type a comment!
	define("LANG_COMMENT_EMPTY", "¡Por favor, escriba un comentario!");
	//Comments of
	define("LANG_COMMENTS_COMMENTSOF", "Comentarios de ");
	//No comment found for this post!
	define("LANG_COMMENT_NORECORD", "¡Sin comentarios encontrados para esta entrada!");
	//Post
	define("LANG_LABEL_POST", "Entrada");
	//Click here to view this comment
	define("LANG_MSG_CLICK_TO_VIEW_THIS_COMMENT", "Haga clic aquí para ver este comentario");
	//Click here to view this comment's replies
	define("LANG_MSG_CLICK_TO_VIEW_REPLIES", "Haga clic aquí para ver las respuestas de este comentario");
	//This comments has no replies
	define("LANG_MSG_NO_REPLIES", "Este comentario no tiene respuestas");
	//Click here to delete this comment
	define("LANG_MSG_CLICK_TO_DELETE_THIS_COMMENT", "Haga clic aquí para borrar este comentario");
	//View replys
	define("LANG_LABEL_VIEW_REPLY", "Ver las respuestas");
	//Click here to view this post reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BLOG_REPORTS", "Haga clic aquí para ver esta entrada informes");
	//You need to login to leave your comment
	define("LANG_MSG_NEED_LOGIN", "Tiene que iniciar sesión para dejar su comentario.");
	//You need to login to redeem a deal.
	define("LANG_MSG_NEED_LOGIN_DEAL", "Tiene que iniciar sesión para validar una oferta.");
	//No posts found.
	define("LANG_MSG_NOBLOGS", "No hay mensajes encontrados.");
	//No posts
	define("LANG_MSG_NOPOSTS", "No hay mensajes");
	//Comment successfully posted!
	define("LANG_MSG_COMMENT_SUCCESSFULLY_POSTED", "¡Comentario publicado correctamente!");
	//Your comment has been submitted for approval.
	define("LANG_MSG_COMMENT_SENT_TO_APPROVE", "Tu comentario ha sido presentado para su aprobación.");
	//Reply successfully posted!
	define("LANG_MSG_REPLY_SUCCESSFULLY_POSTED", "¡Respuesta publicada correctamente!");
	//Your reply has been submitted for approval.
	define("LANG_MSG_REPLY_SENT_TO_APPROVE", "Tu respuesta ha sido presentada para su aprobación.");
	//Content
	define("LANG_LABEL_POST_CONTENT", "Contenido");
	//Reply
	define("LANG_LABEL_REPLY", "Respuesta");
	//Re
	define("LANG_LABEL_ABBR_REPLY", "Re");
	//Click here to view this reply
	define("LANG_MSG_CLICK_TO_VIEW_THIS_REPLY", "Haga clic aquí para ver esta respuesta");
	//Click here to delete this reply
	define("LANG_MSG_CLICK_TO_DELETE_THIS_REPLY", "Haga clic aquí para borrar esta respuesta");

	# ----------------------------------------------------------------------------------------------------
	# SITEMGR NOTIFICATIONS
	# ----------------------------------------------------------------------------------------------------
	//Account Notification
	define("LANG_NOTIFY_NEWACCOUNT", "[".EDIRECTORY_TITLE."] Notificación de Cuenta");
	//A new account was created in
	define("LANG_NOTIFY_NEWACCOUNT_1", "Una nueva cuenta fue creada en");
	//Please review the account information below:
	define("LANG_NOTIFY_NEWACCOUNT_2", "Por favor revise la información de la cuenta a continuación:");
	//Article Notification
	define("LANG_NOTIFY_ARTICLE", "[".EDIRECTORY_TITLE."] ".LANG_ARTICLE_FEATURE_NAME." Notificación");
	//was changed by the administrator
	define("LANG_NOTIFY_ITEMS_1", "fue cambiado por el administrador");
	//was created by the administrator
	define("LANG_NOTIFY_ITEMS_2", "fue creado por el administrador");
	//and needs to be revised by you.
	define("LANG_NOTIFY_ITEMS_3", "y necesita ser revisado por usted.");
	//Banner Notification
	define("LANG_NOTIFY_BANNER", "[".EDIRECTORY_TITLE."] ".LANG_BANNER_FEATURE_NAME." Notificación");
	//Transaction Notification
	define("LANG_NOTIFY_TRANSACTION", "[".EDIRECTORY_TITLE."] Notificación de Transacciones");
	//A transaction was made and needs to be revised by you.
	define("LANG_NOTIFY_TRANSACTION_1", "Una transacción se hizo y debe ser revisada por usted.");
	//Transaction Info:
	define("LANG_NOTIFY_TRANSACTION_2", "Informacion de la Transacción:");
	//Transaction Time
	define("LANG_NOTIFY_TRANSACTION_3", "Fecha de Transacción");
	//Gateway
	define("LANG_NOTIFY_TRANSACTION_4", "Puerto de Pago");
	//(prices amount are per installments)
	define("LANG_NOTIFY_TRANSACTION_5", "(monto de precios son por pago)");
	//Please sign in to the directory at the links below to revise and/or activate these items.
	define("LANG_NOTIFY_TRANSACTION_6", "Accede al directorio en los siguientes enlaces para revisar y/o activar estos elementos.");
	//Classified Notification
	define("LANG_NOTIFY_CLASSIFIED", "[".EDIRECTORY_TITLE."] ".LANG_CLASSIFIED_FEATURE_NAME." Notificación");
	//Contact Us
	define("LANG_NOTIFY_CONTACTUS", "Contáctenos");
	//Event Notification
	define("LANG_NOTIFY_EVENT", "[".EDIRECTORY_TITLE."] ".LANG_EVENT_FEATURE_NAME." Notificación");
	//Listing Notification
	define("LANG_NOTIFY_LISTING", "[".EDIRECTORY_TITLE."] ".LANG_LISTING_FEATURE_NAME." Notificación");
    //New Comment Added
    define("LANG_NOTIFY_NEWCOMMENT", "Nuevo Comentario Enviado");
    //New Reply Added
    define("LANG_NOTIFY_NEWREPLY", "Nueva Respuesta Enviada");
    //Your blog post
    define("LANG_NOTIFY_NEWCOMMENT_1", "Su entrada en el blog");
    //has a new reply.
    define("LANG_NOTIFY_NEWCOMMENT_2", "recibió una nueva respuesta.");
    //has a new comment.
    define("LANG_NOTIFY_NEWCOMMENT_3", "ha recibido un nuevo comentario.");
    //wrote
    define("LANG_NOTIFY_NEWCOMMENT_4", "escribió");
    //on
    define("LANG_NOTIFY_NEWCOMMENT_5", "en");
    //Click on the link below to moderate the comment
    define("LANG_NOTIFY_NEWCOMMENT_6", "Haga clic en el enlace de abajo para moderar los comentarios");
    //CSS Editor Backup
    define("LANG_NOTIFY_EDITORCHANGED", "Copia de Seguridad CSS Editor");
    //The file
    define("LANG_NOTIFY_EDITORCHANGED_1", "El archivo");
    //was changed at
    define("LANG_NOTIFY_EDITORCHANGED_2", "fue modificado");
    //Enclosed is a copy of the last version submitted to the site.
    define("LANG_NOTIFY_EDITORCHANGED_3", "Se adjunta la última versión del archivo cargado.");
    //Rating Notification
    define("LANG_NOTIFY_NEWREVIEW", "Notificación de Calificación");
    //has a new review
    define("LANG_NOTIFY_NEWREVIEW_1", "tiene una nueva calificación");
    //stars
    define("LANG_NOTIFY_NEWREVIEW_2", "estrellas");
    //Click on the link below to go to the review administration
    define("LANG_NOTIFY_NEWREVIEW_3", "Haga clic en el enlace de abajo para ir a la administración de las calificaciones");
    //from
    define("LANG_NOTIFY_NEWREVIEW_4", "de");
    //wrote
    define("LANG_NOTIFY_NEWREVIEW_5", "escribió");
    //Reply Notification
    define("LANG_NOTIFY_NEWREPLY", "Notificación de Respuesta");
    //Review
    define("LANG_NOTIFY_NEWREPLY_1", "Calificación");
    //has a new reply
    define("LANG_NOTIFY_NEWREPLY_2", "tiene una nueva respuesta");
    //Click on the link below to go to the review administration
    define("LANG_NOTIFY_NEWREPLY_3", "Haga clic en el enlace de abajo para ir a la administración de las calificaciones");
    //Import Correction Notification
    define("LANG_NOTIFY_PREPAREIMPORT", "Notificación de Corrección de Importación");
    //Event Import Correction Notification
    define("LANG_NOTIFY_PREPAREIMPORT_EVENT", "Notificación de Corrección de Importación de Eventos");
    //Your import correction for the file
    define("LANG_NOTIFY_PREPAREIMPORT_1", "La corrección del archivo de importación");
    //was completed but contained errors.
    define("LANG_NOTIFY_PREPAREIMPORT_2", "se completó, pero contiene errores.");
    //Please review the log at
    define("LANG_NOTIFY_PREPAREIMPORT_3", "Por favor revise el histórico");
    //has been completed.
    define("LANG_NOTIFY_PREPAREIMPORT_4", "se completó.");
    //You can review the log here
    define("LANG_NOTIFY_PREPAREIMPORT_5", "Usted puede revisar la historia aquí");
    //Listing Import Notification
    define("LANG_NOTIFY_IMPORTLISTING", "Notificación de Importación de Listado");
    //Your listing(s) import has been completed.
    define("LANG_NOTIFY_IMPORTLISTING_1", "Su importación de listado(s) se completó.");
    //You can review the log here
    define("LANG_NOTIFY_IMPORTLISTING_2", "Usted puede revisar el historial aquí");
    //Event Import Notification
    define("LANG_NOTIFY_IMPORTEVENT", "Notificación de importaciónn de Evento");
    //Your event(s) import has been completed
    define("LANG_NOTIFY_IMPORTEVENT_1", "Su importación de evento(s) se completó.");
    //You can review the log here
    define("LANG_NOTIFY_IMPORTEVENT_2", "Usted puede revisar la historia aquí");
    //Package Notification
    define("LANG_NOTIFY_PACKAGE", "Notificación de compra de Paquete");
    //The package
    define("LANG_NOTIFY_PACKAGE_1", "El paquete");
    //was bought by the administrator
    define("LANG_NOTIFY_PACKAGE_2", "fue comprado por el anunciante");
    //and needs to be checked over by you.
    define("LANG_NOTIFY_PACKAGE_3", "y debe ser revisada por ti.");
    //Purchased items
    define("LANG_NOTIFY_PACKAGE_4", "Los artículos comprados");
    //Help Request
    define("LANG_NOTIFY_MEMBERSHELP", "Solicitud de Ayuda");
    //You have received a message from one of your site members.
    define("LANG_NOTIFY_MEMBERSHELP_1", "Ha recibido un mensaje de un miembro de su sitio.");
    //From
    define("LANG_NOTIFY_MEMBERSHELP_2", "De");
    //E-mail
    define("LANG_NOTIFY_MEMBERSHELP_3", "Correo Electrónico");
    //Message
    define("LANG_NOTIFY_MEMBERSHELP_4", "Mensaje");
    //Forgotten Password
    define("LANG_NOTIFY_FORGOTPASS", "He olvidado la contraseña");
    //A new password was requested from your ".EDIRECTORY_TITLE." account.
    define("LANG_NOTIFY_FORGOTPASS_1", "Una nueva contraseña se solicitó para su cuenta en ".EDIRECTORY_TITLE.".");
    //To change your password please click the link below and enter a new password
    define("LANG_NOTIFY_FORGOTPASS_2", "Para cambiar su contraseña, haga clic en el enlace de abajo e introduzca una nueva contraseña");
    //New User Signup (Listing)
    define("LANG_NOTIFY_SIGNUPLISTING", "Nuevo Registro (Listado)");
    //A new user has signed up and ordered a listing at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPLISTING_1", "Un nuevo usuario se ha registrado y ha creado un listado en ".EDIRECTORY_TITLE.".");
    //New User Signup (Event)
    define("LANG_NOTIFY_SIGNUPEVENT", "Nuevo Registro (Evento)");
    //A new user has signed up and ordered an event at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPEVENT_1", "Un nuevo usuario se ha registrado y ha creado un evento en ".EDIRECTORY_TITLE.".");
    //New User Signup (Classified)
    define("LANG_NOTIFY_SIGNUPCLASSIFIED", "Nuevo Registro (Clasificado)");
    //A new user has signed up and ordered a classified at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPCLASSIFIED_1", "Un nuevo usuario se ha registrado y ha creado un clasificado en ".EDIRECTORY_TITLE.".");
    //New User Signup (Banner)
    define("LANG_NOTIFY_SIGNUPBANNER", "Nuevo Registro (Banner)");
    //A new user has signed up and ordered a banner at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPBANNER_1", "Un nuevo usuario se ha registrado y ha creado un banner en ".EDIRECTORY_TITLE.".");
    //New User Signup (Article)
    define("LANG_NOTIFY_SIGNUPARTICLE", "Nuevo Registro (Artículo)");
    //A new user has signed up and ordered an article at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPARTICLE_1", "Un nuevo usuario se ha registrado y ha creado un artículo en ".EDIRECTORY_TITLE.".");
    //Listing Claimed!
    define("LANG_NOTIFY_NEWCLAIM", "¡Listado Reclamado!");
    //A listing has recently been claimed on your site - ".EDIRECTORY_TITLE."!
    define("LANG_NOTIFY_NEWCLAIM_1", "Un listado se ​​solicitó en el directorio - ".EDIRECTORY_TITLE."!");
    //To approve the listing, follow the claim link below
    define("LANG_NOTIFY_NEWCLAIM_2", "Aprobar la solicitud de el listado siguiendo el siguiente enlace");
    //Claim ID
    define("LANG_NOTIFY_NEWCLAIM_3", "Reclamación ID");
    //To preview the listing, follow the listing link below
    define("LANG_NOTIFY_NEWCLAIM_4", "Para ver el listado, a raíz de enlace del listado por debajo de");
    //To see the user's account information follow the account link below
    define("LANG_NOTIFY_NEWCLAIM_5", "Para ver la información de la cuenta de usuario, siga el siguiente enlace");
    //Account Details for the listing owner
    define("LANG_NOTIFY_NEWCLAIM_6", "Detalles de la cuenta del titular del listado");
    //New Signup (Via Mobile)
    define("LANG_NOTIFY_NEWACCOUNTAPP", "Nuevo Registro (A través de aplicación móvil)");
    //A new user has joined ".EDIRECTORY_TITLE." via the mobile app.
    define("LANG_NOTIFY_NEWACCOUNTAPP_1", "Un nuevo usuario se registra en".EDIRECTORY_TITLE." a través de su aplicación móvil.");
    //Account information included below for your convenience:
    define("LANG_NOTIFY_NEWACCOUNTAPP_2", "Información de la cuenta se incluyen a continuación para su comodidad:");
	//You received a new lead through the enquire form. To view the lead, follow the link below.
	define("LANG_NOTIFY_NEWLEAD", "Usted recibió un nuevo contacto a través del formulario de consulta. Para ver el contacto, siga el siguiente enlace.");

	# ----------------------------------------------------------------------------------------------------
	# MOBILE VERSION
	# ----------------------------------------------------------------------------------------------------
	//We have an app for that!
	define("LANG_MOBILE_APP", "¡Tenemos una aplicación para eso!");
	//Grab the eDirectory App for iPhone
	define("LANG_MOBILE_GRAB_APP_IPHONE", "Obtenga la Aplicacion de eDirectory para iPhone.");
	//In Google Play
	define("LANG_MOBILE_GRAB_APP_ANDROID", "En Google Play");
	//Available on the
	define("LANG_MOBILE_APP_STORE", "Disponible en la");
	//ANDROID APP ON
	define("LANG_MOBILE_APP_ANDROID", "Aplicacion ANDROID Activada");
    //Recently added listings
    define("LANG_MOBILE_RECENT_LISTINGS", "Listados recientes");
    //View full site
    define("LANG_MOBILE_FULLSITE", "Ver sitio completo");
    //Download App
    define("LANG_MOBILE_DOWNLOAD_APP", "Descarga Aplicacion");
    //Use the following code:
    define("LANG_MOBILE_DEAL_USECODE", "Utilice el siguiente código:");
    //REDEEMED
    define("LANG_MOBILE_DEAL_REDEEMED", "REDIMIDO");
    //Please login to redeem
    define("LANG_MOBILE_DEAL_LOGIN", "Por favor, entra para redimir.");

    # ----------------------------------------------------------------------------------------------------
	# ARCAMAILER
	# ----------------------------------------------------------------------------------------------------
    //Sign up for our Newsletter
    define("LANG_ARCAMAILER_SIGNUP", "Suscríbase a nuestro Boletín Informativo");
    //Subscribe
    define("LANG_ARCAMAILER_SUBSCRIBE", "Suscríbase");
	//Subscribe to our monthly newsletter, no spam, just product updates.
	define("LANG_ARCAMAILER_SUBSCRIBE_TIP", "Suscríbete a nuestro boletín informativo mensual, no contiene spam, solamente actualizaciones de productos.");
    //Please, type your name and e-mail.
    define("LANG_ARCAMAILER_SUBSCRIBEERROR", "Por favor, ingrese su nombre y correo electrónico.");
    //Check your e-mail to complete your subscription.
    define("LANG_ARCAMAILER_SUBSCRIBEDONE", "Verifique su correo electrónico para completar la suscripción.");

    # ----------------------------------------------------------------------------------------------------
	# GENERAL
	# ----------------------------------------------------------------------------------------------------
    //Changing this will lose any unsaved changes made to this form.
    define("LANG_CONFIRM_CHANGE_LEVEL", "Al cambiar esto perderá los cambios no guardados realizados en este formulario.");

	# ----------------------------------------------------------------------------------------------------
	# DINING GUIDE
	# ----------------------------------------------------------------------------------------------------
    //Top Listing
    define("LANG_LABEL_TOP_LISTING", "Listado Destacado");
    //Featured Deal
    define("LANG_LABEL_FEATURED_DEAL", "Oferta Destacada");
    //Popular Reviews
    define("LANG_LABEL_POPULAR_REVIEW", "Calificaciones Mas Populares");
	//Helpful Reviews
	define("LANG_LABEL_HELPFUL_REVIEWS", "Calificaciones Útiles");
    //Keep Reading
    define("LANG_LABEL_KEEP_READING", "Siga Leyendo");
    //Best Of
    define("LANG_MENU_BESTOF", "Los Mejores");
    //By Cuisine
    define("LANG_MENU_BYCUISINE", "Cocinas");
    //By Location
    define("LANG_MENU_BYLOCATION", "Por Ubicación");
    //Sign up | Login
    define("LANG_MENU_SIGNUPLOGIN", "Registrarse | Entrar");
    //Forgot?
    define("LANG_LABEL_FORGOT", "¿Olvidó?");
    //Not a member? Sign up now
    define("LANG_LABEL_SIGNUPNOW", "¿No eres miembro? Regístrate");
	//Price range
	define("LANG_LABEL_PRICE_RANGE", "Gama de precios");
	//Need a Specific Category?
	define("LANG_LABEL_SPECIFIC_CATEG", "¿Necesitas una Categoría Específica?");
	//Show [x] Reviews
	define("LANG_LABEL_SHOW_REVIEWS", "Mostrar [x] Calificaciones");
	//Filter by
	define("LANG_LABEL_FILTERBY", "Filtrar por");
	//Filter by Category
	define("LANG_LABEL_FILTERBY_CATEGORY", "Filtrar por Categoría");
	//Keyword to search...
	define("LANG_LABEL_KEYWORDSEARCH", "Palabra clave para buscar...");
	//Location to search...
	define("LANG_LABEL_LOCATIONSEARCH", "Ubicación para buscar...");
	//See All Locations
	define("LANG_LABEL_SEE_LOCATIONS", "Ver todas las Ubicaciones");
	//Clear Selections
	define("LANG_LABEL_CLEAR_SELECT", "Borrar Selecciones");
	//Close Advanced Search
	define("LANG_LABEL_ADVSEARCH_CLOSE", "Cerrar Búsqueda Avanzada");
	//Offers & Deals
	define("LANG_LABEL_DEAL_FILTER", "Ofertas");
	//Cuisine
	define("LANG_LABEL_CUISINE", "Cocina");
	//List View
	define("LANG_LABEL_LISTVIEW", "Ver Lista");
	//Map View
	define("LANG_LABEL_MAPVIEW", "Ver Mapa");
	//Give us a moment, we're loading in your results.
	define("LANG_LABEL_LOADINGMAP", "Danos un momento, nos estamos cargando sus resultados.");
	//Valid for
    define("LANG_LABEL_FILTER_VALID_FOR", "Válido para");
    //Ends in less than 24 hours
    define("LANG_LABEL_FILTER_ENDS_IN_LESS_THAN_24_HOURS", "Finaliza en menos de 24 horas");
    //Valid for more than 2 days
    define("LANG_LABEL_FILTER_VALID_FOR_MORE_THAN_2_DAYS", "Válido por más de 2 días");
    //Valid for more than a week
    define("LANG_LABEL_FILTER_VALID_FOR_MORE_THAN_A_WEEK", "Válido por más de una semana");
	//filter
	define("LANG_LABEL_FILTER", "filtrar");
    //Show more categories
    define("LANG_LABEL_FILTER_SHOW_MORE_CATEGORIES", "Ver más categorías");
    //Show more locations
    define("LANG_LABEL_FILTER_SHOW_MORE_LOCATIONS", "Mostrar más lugares");
    //Showing [NUMBER_EDIR] for KEYWORD_EDIR in LOCATION_EDIR
    define("LANG_LABEL_FILTER_SHOWING_RESULTS_WITH_KEYWORD_AND_LOCATION", "Listado [NUMBER_EDIR] para KEYWORD_EDIR en LOCATION_EDIR");
    //Showing [NUMBER_EDIR] for KEYWORD_EDIR
    define("LANG_LABEL_FILTER_SHOWING_RESULTS_WITH_KEYWORD", "Listado [NUMBER_EDIR] para KEYWORD_EDIR");
    //Map view is only available for result sets with less than [MAX_MARKERS] items. Use filters to refine
    define("LANG_LABEL_FILTER_MAP_MORE_THAN_1000_RESULTS", "Ver mapa sólo está disponible para los conjuntos de resultados con menos de [MAX_MARKERS] artículos. Utilice los filtros para refinar");
    //No Matches
    define("LANG_LABEL_FILTER_NO_MATCHES", "Sin Coincidencias");
    //Clear Filters
    define("LANG_LABEL_FILTER_SHOW_ORIGINAL_SEARCH", "Limpiar Filtros");

	# ----------------------------------------------------------------------------------------------------
	# LEADS
	# ----------------------------------------------------------------------------------------------------
	//Lead
	define("LANG_LABEL_LEAD", "Lead");
	//Leads
	define("LANG_LABEL_LEADS", "Leads");
	//Click here to view this item leads
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_LEADS", "Haz clic aquí para ver este los contactos de este elemento");
	//Manage Leads
	define("LANG_MANAGE_LEADS", "Gestione Contactos");
	//No records found.
	define("LANG_NORECORD", "No se encontraron registros.");
	//Forward
	define("LANG_LABEL_FORWARD", "Re-Enviar");
	//Lead successfully deleted!
	define("LANG_LEAD_SUCCESSDELETED", "Contacto eliminado correctamente!");
	//Lead successfully replied!
	define("LANG_LEAD_REPLIED", "Contacto contestado correctamente!");
	//Lead successfully forwarded!
	define("LANG_LEAD_FORWARDED", "Contacto enviado Re-enviado!");
	//Please type a message.
	define("LANG_LEAD_TYPEMESSAGE", "Por favor, escriba un mensaje.");
	//New lead received by
	define("LANG_LEAD_RECEIVED", "Nuevo contacto recibido por");
	//Replied
	define("LANG_LEAD_REPLIED_ICO", "Respondió");
	//Forwarded
	define("LANG_LEAD_FORWARDED_ICO", "Re-envio");
	//Replied and Forwarded
	define("LANG_LEAD_REPLIED_FORWARDED_ICO", "Respondió [dater] y Re-envio [datef]");
	//Talk to Us
	define("LANG_LEAD_TALKTOUS", "Hable con Nosotros");
	//Your first name
	define("LANG_LEAD_FIRSTNAME", "Su nombre");
	//Your last name
	define("LANG_LEAD_LASTNAME", "Sus apellidos");
	//Your email, please?
	define("LANG_LEAD_EMAIL", "Su correo electronico, por favor?");
	//Add your phone number
	define("LANG_LEAD_PHONE", "Añadir su número de teléfono");
	//Company/Organization
	define("LANG_LEAD_COMPANY", "Empresa / Organización");
	//What kind of service do you need?
	define("LANG_LEAD_MESSAGE", "¿Qué tipo de servicio necesita?");
	//Please type your first name and last name.
	define("LANG_LEAD_TYPE_NAME", "Por favor ingrese su nombre y apellido.");
	//Thank you, we will be in touch shortly.
	define("LANG_LEAD_THANKYOU", "Gracias, estaremos en contacto en breve.");
	//New Enquire
	define("LANG_LEAD_ENQUERY", "Nueva Consulta");
	//General Lead
	define("LANG_GENERAL_LEAD", "Contacto General");

	# ----------------------------------------------------------------------------------------------------
	# LOG IN / SIGN UP / MEMBERS
	# ----------------------------------------------------------------------------------------------------
	//Are you a Sponsor?
	define("LANG_AREYOU_SPONSOR_AREA", "¿Es usted un patrocinador?");
	//List your business today
	define("LANG_AREYOU_SPONSOR_AREA_2", "Anuncie su empresa hoy");
	//Find Us
	define("LANG_FIND_US", "Encuéntrenos");
	//or if you already have an account login below
	define("LANG_OR_SIGNUPACCOUNT", "o si ya tiene una cuenta ingrese abajo");
	//Or log in using your e-mail address
	define("LANG_OR_SIGNINEMAIL", "o inicia sesión con su correo electronico");
	//Or sign up using your e-mail address
	define("LANG_OR_SIGNUPEMAIL", "o registrese con su correo electronico");
	//Are you a sponsor? Go to our sponsor area
	define("LANG_GO_TO_SPONSOR_AREA", "¿Eres un anunciante? Visita nuestra sección anunciante");
	//By creating an account, I accept the Terms of Use.
	define("LANG_ACCEPT_TERMS", "Al crear una cuenta Acepto las [a]condiciones de uso[/a].");
	//Sponsor Area
	define("LANG_LABEL_SPONSORAREA", "Sección Anunciante");
	//Log in to the Sponsor Area
	define("LANG_LABEL_LOGIN_SPONSORAREA", "Inicie sesión en el sección anunciante");
	//Already a member - Log in here.
    define("LANG_LABEL_ALREADY_MEMBER", "Ya eres usuario - Ingresa aquí.");
	//Reference
	define("LANG_LABEL_REFERENCE", "Referencia");
	//Got an enquiry or something you're stuck on? Send us a message. We'll get back to you as soon as we can.
	define("LANG_HELP_MESSAGE", "¿Tienes una pregunta? Envíanos un mensaje. Nos pondremos en contacto con usted tan pronto como nos sea posible.");
	//Add a new content
	define("LANG_ADD_NEW_CONTENT", "Añadir un nuevo contenido");
	//You don't have any content yet.
	define("LANG_ADD_NEW_CONTENT2", "Usted no tiene ningún contenido.");
	//Add your business today, it's quick and simple!
	define("LANG_ADD_NEW_CONTENT2_TIP", "Añada su empresa hoy, es rápido y sencillo!");
	//Remove
	define("LANG_LABEL_REMOVE", "Eliminar");
	//View on Website
	define("LANG_LABEL_VIEW_LIVE", "Ver en el Sitio Web");
	//Preview
	define("LANG_LABEL_PREVIEW", "Vista Previa");
	//Expires in
	define("LANG_LABEL_EXPIRESON", "Válida hasta el");
	//until it expires
	define("LANG_LABEL_UNTILEXPIRES", "hasta que expire");
	//impressions left
	define("LANG_LABEL_IMPRESSIONS_LEFT", "impresiones dejadas");
	//Billing
	define("LANG_LABEL_BILLING", "Facturación");
	//was successfully deleted!
	define("LANG_LABEL_WASSUCCESSDELETED", "ha sido eliminada satisfactoriamente!");
	//Deal not linked
	define("LANG_LABEL_NOTLINKED", "Oferta no vinculada");
	//Increase Visibility
	define("LANG_LABEL_INCREASEVISIBILITY", "Aumentar la visibilidad");
	//Renew Now
	define("LANG_LABEL_RENEW", "Renovar ahora");
	//Add basic information
	define("LANG_LABEL_GAMEFY_DESC", "Añadir información básica");
	//Add photos or video
	define("LANG_LABEL_GAMEFY_MEDIA", "Añadir fotos o de vídeo");
	//Add additional information
	define("LANG_LABEL_GAMEFY_ADDITIONAL", "Añadir información adicional");
	//Share and get more reviews
	define("LANG_LABEL_DASHBOARD_SHARE", "Comparte y consigue más opiniones");
	//Share and get more leads
	define("LANG_LABEL_DASHBOARD_SHARE2", "Comparte y consigue más clientes potenciales");
	//Share and get more redeems
    define("LANG_LABEL_DASHBOARD_SHARE3", "Comparte y consigue más cupones");
	//Review by
	define("LANG_LABEL_REVIEWBY", "Revisión por");
	//Reply this
	define("LANG_LABEL_REPLYTHIS", "Responder este");
	//Write your reply
    define("LANG_LABEL_WRITE_REPLY", "Escribe tu respuesta");
	//Activity Report
	define("LANG_LABEL_ACTIVITYREPORT", "Informe de Actividades");
	//See all reviews
	define("LANG_LABEL_SEE_REVIEWS", "Ver todas las calificaciones");
	//See all leads
	define("LANG_LABEL_SEE_LEADS", "Ver todos los Contactos");
	//Statistics
	define("LANG_LABEL_STATISTICS", "Estadística");
	//Total Viewers
	define("LANG_LABEL_TOTALVIEWERS", "Vistas Totales");
	//Phone Views
	define("LANG_LABEL_PHONEVIEWS", "Teléfono Vistas");
	//Website Views
	define("LANG_LABEL_WEBSITEVIEWS", "Sitio web Vistas");
	//Fax Views
	define("LANG_LABEL_FAXVIEWS", "Fax Vistas");
	//Phone View
	define("LANG_LABEL_PHONEVIEW", "Teléfono Vista");
	//Website View
	define("LANG_LABEL_WEBSITEVIEW", "Sitio web vista");
	//Fax View
	define("LANG_LABEL_FAXVIEW", "Fax vista");
	//View more stats
	define("LANG_LABEL_VIEW_MORE_STATS", "Ver más estadísticas");
	//Stats
	define("LANG_LABEL_STATS", "Estadísticas");
	//Listing Completion
    define("LANG_LABEL_LISTING_COMPLETION", "Finalizacion de Listado");
    //Event Completion
    define("LANG_LABEL_EVENT_COMPLETION", "Finalizacion de Evento");
    //Classified Completion
    define("LANG_LABEL_CLASSIFIED_COMPLETION", "Finalizacion de Clasificado");
    //Article Completion
    define("LANG_LABEL_ARTICLE_COMPLETION", "Finalizacion de Artículo");
	//Deal Completion
    define("LANG_LABEL_PROMOTION_COMPLETION", "Finalizacion de Oferta");
    //You're not quite done with your item.
    define("LANG_LABEL_GAMEFY_TIP", "No has terminado con tu Articulo.");
	//What are you looking for today?
	define("LANG_LABEL_PROFILE_TIP1", "¿Qué estás buscando?");
	//Thank you for being part of EDIRECTORY_TITLE. Join our community by giving your opinion and evaluating your favorite listings.
	define("LANG_LABEL_PROFILE_TIP2", "Gracias por ser parte de ".EDIRECTORY_TITLE.". Únete a nuestra comunidad, dando tu opinión y evaluando tus listados favoritos.");
	//Oh wait...
	define("LANG_LABEL_PROFILE_TIP3", "Oh Espere...");
	//This user has no activity in our portal yet. Don't worry. You can still join our community by giving your opinion and evaluating your favorite listings.
	define("LANG_LABEL_PROFILE_TIP4", "Este usuario no tiene actividad en nuestro portal todavía.<br>No se preocupe. Usted puede unirse a nuestra comunidad, dando su opinión y evaluando tus listados favoritos.");
	//Rated
	define("LANG_LABEL_RATED", "Evaluó");
	//Commented
	define("LANG_LABEL_COMMENTED", "Comentó");
	//Redeemed deal
	define("LANG_LABEL_REDEEMED", "Oferta Redimida ");
	//Your redeem code is
	define("LANG_LABEL_DEAL_CODE", "Su código es");
	//View previous activities
	define("LANG_PREVIOUS_ACTIVITY", "Ver actividad anterior");
	//with
	define("LANG_WITH", "con");
	//Redeemed by
	define("LANG_LABEL_REDEEMED_BY", "Redimido por");
	//You received [x] new review
	define("LANG_LABEL_NEW_REVIEW", "Usted recibió [x] nueva calificación");
	//You received [x] new reviews
	define("LANG_LABEL_NEW_REVIEWS", "Usted recibió [x] nuevas calificaciones");
	//You received [x] new lead
	define("LANG_LABEL_NEW_LEAD", "Usted recibió [x] nuevos contacto");
	//You received [x] new leads
	define("LANG_LABEL_NEW_LEADS", "Usted recibió [x] nuevos contactos");

	# ----------------------------------------------------------------------------------------------------
	# NEW ADD MODULES FORMS
	# ----------------------------------------------------------------------------------------------------
	//Você pode mudar suas [a]configurações de níveis e preços[/a] quando quiser.
	define("LANG_SELECTLEVEL_TIP", "Usted puede cambiar sus ajustes de [a]y los niveles de precios[/a] cada vez que desee.");
	//Com os [a]tipos de empresa[/a], você pode escolher diferentes layouts para a página de detalhes de suas empresas, criar campos extras e muito mais.
	define("LANG_SELECT_LISTINGTEMPLATE_TIP", "Con [a]tipo de empresa[/a], puede elegir diferentes diseños para la página de información general para su negocio, crear campos adicionales y más.");
	//Salvar Alterações
	define("LANG_SAVE_CHANGES", "Guardar cambios");
	//Digite o nome de sua empresa aqui.
	define("LANG_HOLDER_LISTINGTITLE", "Introduzca el nombre de su empresa aquí.");
	//Digite o nome de sua oferta aqui.
	define("LANG_HOLDER_PROMOTIONTITLE", "Introduzca el nombre de su oferta aquí.");
	//Digite o nome de seu banner aqui.
	define("LANG_HOLDER_BANNERTITLE", "Introduzca el nombre de su banner aquí.");
	//Digite o nome de seu evento aqui.
	define("LANG_HOLDER_EVENTTITLE", "Introduzca el nombre de su evento aquí.");
	//Digite o nome de seu classificado aqui.
	define("LANG_HOLDER_CLASSIFIEDTITLE", "Introduzca el nombre de su clasificado aquí.");
	//Digite o nome de seu artigo aqui.
	define("LANG_HOLDER_ARTICLETITLE", "Introduzca el nombre de su artículo aquí.");
	//Digite o nome de seu post aqui.
	define("LANG_HOLDER_BLOGTITLE", "Introduzca el nombre de su post aquí.");
	//Informações Básicas
	define("LANG_BASIC_INFO", "Datos Básicos");
	//Clique no botão à direita para selecionar as categorias.
	define("LANG_SELECT_CATEGORIES", "Haga clic en el botón de la derecha para seleccionar las categorías.");
	//Adicionar categorias
	define("LANG_ADD_CATEGORIES", "Añadir categorías");
	//Breve descrição da empresa.
	define("LANG_HOLDER_LISTINGSUMMARY", "Breve descripción de la empresa.");
	//Apresente a empresa ao público de forma clara e eficiente. Descreva todas as características que tornam o estabelecimento único e uma ótima opção para os clientes.
	define("LANG_HOLDER_LISTINGDESCRIPTION", "Dar a conocer la empresa al público de una manera clara y eficiente. Describir todas las características que hacen que la propiedad única y una gran opción para los clientes.");
	//Breve descrição da oferta.
	define("LANG_HOLDER_PROMOTIONSUMMARY", "Breve descripción de la oferta.");
	//Apresente a promoção ao público de forma clara e eficiente. Descreva todas as características que a fazem valer a pena.
	define("LANG_HOLDER_PROMOTIONDESCRIPTION", "Dar a conocer la promoción al público de una manera clara y eficiente. Describir todas las características que hacen que valga la pena.");
	//Breve descrição do evento.
	define("LANG_HOLDER_EVENTSUMMARY", "Breve descripción del evento.");
	//Apresente o evento ao público de forma clara e eficiente. Descreva os principais destaques e características que atrairão as pessoas.
	define("LANG_HOLDER_EVENTDESCRIPTION", "Presentar el evento al público de una manera clara y eficiente. Describir los aspectos más destacados y las características que atraigan a la gente.");
	//Breve descrição do classificado.
	define("LANG_HOLDER_CLASSIFIEDSUMMARY", "Breve descripción de la clasificada.");
	//Apresente o classificado ao público de forma clara e eficiente. Descreva os principais destaques e características que farão as pessoas quererem comprar o seu produto/serviço.
	define("LANG_HOLDER_CLASSIFIEDDESCRIPTION", "Presente clasifican al público de una manera clara y eficiente. Describir los aspectos más destacados y las características que harán que la gente quiera comprar su producto / servicio.");
	//Resumo do artigo.
	define("LANG_HOLDER_ARTICLESUMMARY", "Resumen del artículo.");
	//Type your keyword. Press 'Tab' or 'Enter' on your keyboard to confirm.
	define("LANG_HOLDER_KEYWORDS", "Ingresa la palabra clave y pulse 'Tab' para confirmar.");
	//Utilize este campo para destacar algumas características que a sua empresa tem a oferecer. Digite um item por linha.
	define("LANG_HOLDER_FEATURES", "Utilice este campo para poner destacar algunas de las características que su empresa tiene para ofrecer. Introduce un elemento por línea.");
	//Você tem um código de desconto? Digite-o aqui.
	define("LANG_HOLDER_DISCOUNTCODE", "Usted tiene un código de descuento? Ingreselo aquí.");
	//Cole a URL do vídeo aqui. Ex: http://www.youtube.com/watch?v=xxxx
	define("LANG_HOLDER_VIDEO", "Pegue el URL del video aquí. Ex: http://www.youtube.com/watch?v=xxxx");
	//Breve descrição do seu vídeo.
	define("LANG_HOLDER_VIDEOCAPTION", "Breve descripción de su vídeo.");
	//O link para download do arquivo será mostrado desta forma.
	define("LANG_HOLDER_ATTACHCAPTION", "El enlace de descarga para el archivo se muestra de esta manera.");
	//Deseja alterar suas classificações? Clique aqui.
	define("LANG_HOLDER_BADGES", "¿Quieres cambiar sus calificaciones? Haga clic aquí.");
	//Type here the terms & conditions for redeeming your deal.
	define("LANG_HOLDER_PROMOTIONCONDITIONS", "Escriba aquí los términos y condiciones para redimir su oferta.");
	//Não foi possível carregar o vídeo. Por favor, verifique a URL do vídeo e tente novamente.
	define("LANG_VIDEO_NOTFOUND", "No se puede cargar el vídeo. Por favor, compruebe el URL del video y vuelva a intentarlo.");
	//Você pode selecionar até [max] categorias.
	define("LANG_SELECTMAX_CATEGORIES", "Puede seleccionar hasta [max] categorías.");
	//Por favor, aguarde...
	define("LANG_LABEL_FORM_WAIT", "Por favor espere ...");
	//Título da Imagem
	define("LANG_LABEL_IMAGE_TITLE", "Título de la Imagen");
	//Descrição da imagem
	define("LANG_LABEL_IMAGE_DESCRIPTION", "Descripción de la imagen");
	//Recorte da Imagem & Descrição
	define("LANG_LABEL_IMAGE_CROP", "Recorte de imagen y Descripción");
	//Recorte
	define("LANG_LABEL_IMAGE_CROPPING", "Recorte");
	//Tipo de Desconto
	define("LANG_LABEL_DISCOUNT_TYPE", "Tipo de descuento");
	//Precisa de ajuda? Dê uma olhada no tutorial.
	define("LANG_LABEL_TUTORIAL", "¿Necesita ayuda? Echa un vistazo a la guía de aprendizaje.");
	//Guia de Campos
	define("LANG_LABEL_TUTORIAL_FIELDS", "Guía de Campos");
	//Fechar Tutorial
	define("LANG_LABEL_TUTORIAL_END", "Fecha Tutorial");
	//Social networks
    define("LANG_LABEL_SOCIALNETWORK", "Redes Sociales");
	//This is the Title that identifies your item on the site. Keep it brief, yet effective.
	define("LANG_LABEL_TUTORIAL_TOUR-TITLE", "Este es el título que identifica a su artículo en el sitio. Sea breve, pero eficiente.");
	//Choose between different Listing Types that offer varying fields and layouts specific to common listings, or create a new Listing Type that suits your needs.
	define("LANG_LABEL_TUTORIAL_TOUR-TEMPLATE", "Elegir entre diferentes tipos de listados que ofrecen diversos campos y diseños específicos para listados en común, o cree un nuevo tipo de listado que se adapte a sus necesidades.");
	//Choose your item's Level here. Each Level can be customized to offer a different set of features for the item.
	define("LANG_LABEL_TUTORIAL_TOUR-LEVEL", "Elija el nivel de su artículo aquí. Cada nivel se puede personalizar para ofrecer un conjunto diferente de características para el artículo.");
	//Choose the Categories that best fit your item. Visitors will find your item easily by browsing under specific Categories.
	define("LANG_LABEL_TUTORIAL_TOUR-CATEGORIES", "Seleccione las categorías que mejor se adapten a su artículo. Los visitantes encontrarán su artículo fácilmente navegando bajo determinadas categorías.");
	//This is the account that owns the item. You can change it to another account or leave your item with no owner.
	define("LANG_LABEL_TUTORIAL_TOUR-OWNER", "Esta es la cuenta que posee el elemento. Usted puede cambiar a otra cuenta o deje su artículo sin propietario.");
	//Activated items will be available on the results page. Pending items have just been added to the site and are awaiting approval. Expired items have gone past their renewal date without payment and lastly, you can temporarily make an items Suspended at your choosing.
	define("LANG_LABEL_TUTORIAL_TOUR-STATUS", "Artículos activados estarán disponibles en la página de resultados. Artículos pendientes sólo se han añadido al sitio y están en espera de aprobación. Artículos caducados han ido más allá de su fecha de renovación sin pago y, por último, usted puede temporalmente ahcer que un elementos estevsuspendido.");
	//You can manually set the Renewal Date for an items to set when the next payment is due.
	define("LANG_LABEL_TUTORIAL_TOUR-EXPIRATION", "Puede configurar manualmente la fecha de renovación de un artículo para establecer cuando sera el próximo pago.");
	//Check this box to disable the claim feature and not allow owners to claim their listing. Leave it blank if you want to allow users to claim their listing.
	define("LANG_LABEL_TUTORIAL_TOUR-CLAIM", "Marque esta casilla para desactivar la función de reclamar y no permitir a los propietarios reclamar su listado. Déjelo en blanco si desea permitir a los usuarios reclamar su listado.");
	//This field is shown on the results page and briefly describes your item.
	define("LANG_LABEL_TUTORIAL_TOUR-SUMMARY", "Este campo se muestra en la página de resultados y describe brevemente su artículo.");
	//Add more details about your item on this field. This full description will be shown on the item's detail page.
	define("LANG_LABEL_TUTORIAL_TOUR-DESCRIPTION", "Añadir más detalles sobre su artículo en este campo. Esta descripción completa se mostrará en la página de detalles del artículo.");
	//You can tag specific keywords in this field. Keywords will help users to find your item when searching on the site.
	define("LANG_LABEL_TUTORIAL_TOUR-KEYWORDS", "Puede etiquetar palabras clave específicas en este campo. Las palabras clave ayudarán a los usuarios a encontrar su artículo en la búsqueda en el sitio.");
	//In this section you can add all the information for your item's location and contact. The more complete, the easier it is for customers to get in touch with you.
	define("LANG_LABEL_TUTORIAL_TOUR-CONTACT", "En esta sección usted puede agregar toda la información de ubicación y contacto de su artículo. Entre más completa, más fácil sera para los clientes ponerse en contacto con usted.");
	//Use this field to add a location reference for your listing. For example, two blocks from the mall.
	define("LANG_LABEL_TUTORIAL_TOUR-REFERENCE", "Utilice este campo para agregar una referencia de su ubicación. Por ejemplo, a dos cuadras del centro comercial.");
	//Does your event have a Facebook page? Type it here to show the Facebook wall widget on the event's detail page.
	define("LANG_LABEL_TUTORIAL_TOUR-FACEBOOK", "¿Tiene su evento una página de Facebook? Ingresela aquí para mostrar el widget del muro de Facebook en la página de detalles del evento.");
	//Use this field to highlight some features of your business or add any additional useful information, what makes it special.
	define("LANG_LABEL_TUTORIAL_TOUR-FEATURES", "Utilice este campo para resaltar algunas de las características de su negocio o añadir cualquier información adicional útil, que lo hace especial.");
	//Type the hours of work for your business here.
	define("LANG_LABEL_TUTORIAL_TOUR-HOURS", "Escriba las horas de trabajo de su negocio aquí.");
	//If applicable, use this field to describe the average price for your products or services.
	define("LANG_LABEL_TUTORIAL_TOUR-PRICE", "Si procede, utilice este campo para describir el precio promedio de sus productos o servicios.");
	//Have a discount or promotional code? Type it here. The item's next payment will be affected.
	define("LANG_LABEL_TUTORIAL_TOUR-DISCOUNT", "Tiene un descuento o código promocional? Ingreselo aquí. Próximo pago del artículo será afectado.");
	//Use this box to drop and add images. You can click on a image to adjust the cropping and edit the title and description.
	define("LANG_LABEL_TUTORIAL_TOUR-IMAGES", "Utilice esta casilla para soltar y añadir imágenes. Puede hacer clic en una imagen para ajustar, recortar y editar el título y la descripción.");
	//Copy and paste your video URL here. Add a brief description to say what your video is about.
	define("LANG_LABEL_TUTORIAL_TOUR-VIDEO", "Copie y pegue el URL del video aquí. Añada una breve descripción sobre de lo que se trata su video.");
	//Use this field to attach an additional file. Use it for a Menu, Product Brochure, or whatever you'd like.
	define("LANG_LABEL_TUTORIAL_TOUR-FILE", "Utilice este campo para adjuntar un archivo adicional. Utilícelo para un menú, el folleto del producto, o lo que usted quiera.");
	//You can help your owners to promote their businesses by designating badges for them.
	define("LANG_LABEL_TUTORIAL_TOUR-BADGES", "Usted puede ayudar a sus propietarios a promover sus negocios mediante la designación de insignias para ellos.");
	//Use this section to set some more additional information for your business.
	define("LANG_LABEL_TUTORIAL_TOUR-ADDITIONAL", "Utilice esta sección para configurar alguna información adicional para su negocio.");
	//Deals should be assigned to a listing in order to be shown on the results. Use this box to select a listing
	define("LANG_LABEL_TUTORIAL_TOUR-LISTING", "Las Ofertas deben ser asignadas a un listado para ser mostradas en los resultados. Utilice este cuadro para seleccionar un listado");
	//This field is pre-filled with a default text that describes the terms of use and conditions to redeem a oferta. You can change it to whatever you need.
	define("LANG_LABEL_TUTORIAL_TOUR-CONDITIONS", "Este campo está pre-llenado con un texto predeterminado donde se describen los términos de uso y condiciones para canjear un oferta. Usted puede cambiarlo por lo que usted necesita.");
	//Use this section to set when the deal will be available. After the end date hits, it will no longer be shown in any results.
	define("LANG_LABEL_TUTORIAL_TOUR-DATE2", "Utilice esta sección para configurar cuando la oferta estará disponible. Después de la fecha de finalización, ya no se mostrara en ningún resultado.");
	//Use this box to add and edit an image for your deal.
	define("LANG_LABEL_TUTORIAL_TOUR-IMAGE", "Utilice esta casilla para agregar y editar una imagen para su oferta.");
	//Use this section to set when your event is taking place. You can also use the Recurring checkbox to save an event that will be repeating on a regular basis.
	define("LANG_LABEL_TUTORIAL_TOUR-DATE", "Utilice esta sección para configurar cuando su evento se está llevando a cabo. También puede utilizar la casilla de recurrente para guardar un evento que se repite de forma regular.");
	//Type the body of your article here. You can use the editor to format the text, add images, etc.
	define("LANG_LABEL_TUTORIAL_TOUR-CONTENT", "Escriba el cuerpo de su artículo aquí. Usted puede utilizar el editor para dar formato al texto, añadir imágenes, etc.");
	//Impressions refer to the number of times the banner is shown on the frontend pages.
	define("LANG_LABEL_TUTORIAL_TOUR-IMPRESSIONS", "Las impresiones se refieren al número de veces que el banner se muestra en las páginas.");
	//Use this field to identify the article's author.
	define("LANG_LABEL_TUTORIAL_TOUR-AUTHOR", "Utilice este campo para identificar al autor del artículo.");
	//If the article's author has a website, you can type it in here.
	define("LANG_LABEL_TUTORIAL_TOUR-AUTHORURL", "Si el autor del artículo tiene un sitio web, puede escribirlo aquí.");
	//Set the publication date for the article here.
	define("LANG_LABEL_TUTORIAL_TOUR-PUBLICATION", "Establecer la fecha de publicación del artículo aquí.");
	//Use this field to give a quick overview of the article.
	define("LANG_LABEL_TUTORIAL_TOUR-ABSTRACT", "Utilice este campo para dar una visión general rápida del artículo.");
	//Does your business have a profile in any of these social medias? Type it here to show buttons to your profiles on the detail page. For Facebook, the wall widget will also be shown.
	define("LANG_LABEL_TUTORIAL_TOUR-SOCIALNETWORK", "¿Tiene su negocio un perfil en cualquiera de estos redes sociales? Escríbalo aquí para mostrar los botones a sus perfiles en la página de detalles. Para Facebook, también se mostrará el widget del muro.");
	//Select an option below
	define("LANG_CHOOSE_DEAL_ATTACH", "Seleccione una opción a continuación");
	//No deals available for association with this listing. In order to be linked to this listing, the deal should not be associated with other listing and should belong to the same account.
	define("LANG_ATTACHDEAL_UNAVAILABLE", "No hay ofertas disponibles para la asociación con esta propiedad. Con el fin de estar vinculada a este perfil, la oferta no debe asociarse con otro anuncio y debe pertenecer a la misma cuenta.");
	//No listings available for association with this deal. In order to be linked to this deal, the listing should not be associated with other deal and should belong to the same account.
	define("LANG_ATTACHLISTING_UNAVAILABLE", "No hay resultados disponibles para la asociación con este acuerdo. Con el fin de estar vinculado a esta oferta, el listado no debe de estar asociado con otra oferta y debe pertenecer a la misma cuenta.");
    // You must associate a listing and a promotion with the same account.
    define("LANG_SITEMGR_ERROR_LISTING_PROMOTION_SITEMGR_ACCOUNT_DIFFER", "Debe asociar una lista y una promoción con la misma cuenta.");
	//Leave it blank to unlink the deal.
	define("LANG_ATTACHDEAL_EMPTY", "Déjelo en blanco para desvincular la oferta.");
	//Recommended dimensions
	define("LANG_LABEL_RECOMMENDED_DIMENSIONS", "Dimensiones recomendadas");
	//Cover Image
	define("LANG_LABEL_COVERIMAGE", "Imagen de Portada");
	//Thumbnail
	define("LANG_LABEL_THUMBNAIL", "Miniatura");
	//Changing the template now will remove the selected categories so far. Do you want to continue?
	define("LANG_CONFIRM_CHANGELISTINGTYPE", "Cambiar la plantilla ahora removera las categorias seleccionadas hasta el momento. ¿Desea continuar?");
    // It was selected more classifieds than it is allowed.
    define("LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_QUANTITY", "Se han seleccionado más " .LANG_CLASSIFIED_FEATURE_NAME_PLURAL. " de los que están permitidos.");
    // The association was successfully save.
    define("LANG_SITEMGR_ASSOCIATION_SUCCESSFULLY_SAVE", "La asociación fue guardada con éxito.");
    // You must associate a listing and a classified with the same account.
    define("LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_SITEMGR_ACCOUNT_DIFFER", "Debe asociar un " .LANG_LISTING. " y un " .LANG_CLASSIFIED. " con la misma cuenta.");
    // Association not allowed.
    define("LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_USER_ACCOUNT_DIFFER", "Asociación no permitida.");
    // This listing does not support more associations.
    define("LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_QUANTITY", "Este " .LANG_LISTING. " no soporta más asociaciones.");
    //Powered by
    define("LANG_POWEREDBY", "Distribuido por");
    //Select an option below
    define("LANG_CHOOSE_CLASSIFIED_ATTACH", "Seleccione una opción a continuación");
    //Associate an existing classified with this listing
    define("LANG_SITEMGR_CLASSIFIED_ASSOCIATE", "Asociar un ".LANG_CLASSIFIED." existente con este ".LISTING_FEATURE_NAME);
    //Leave it blank to unlink the classified
    define("LANG_ATTACHCLASSIFIED_EMPTY", "Dejar en blanco para desvincular la ".LANG_CLASSIFIED.".");
    //Allow classified to be associated with no owner listing
    define("LANG_LABEL_CLASSIFIED_ASSOCIATION", "Permitir ". LANG_CLASSIFIED ." no estar asociado con ningún propietario ".LISTING_FEATURE_NAME);
    //This option is just valid when you are adding or editing a classified
    define("LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_CLASSIFIED_ASSOCIATION", "Esta opción es sólo válida cuando se está agregando o editando un ".LANG_CLASSIFIED);
    //Welcome back! It's always good to see you here again!
    define("LANG_LABEL_WELCOMEBACK", "¡Bienvenido de nuevo! Siempre es bueno verte de nuevo!");
    //Sign up today and join our community!
    define("LANG_LABEL_SIGNUPTODAY", "¡Regístrese hoy y únase a nuestra comunidad!");
    //Join us today and stay connected to businesses around the world.
    define("LANG_LABEL_JOINUSTODAY", "Únase a nosotros hoy y manténgase conectado con negocios de todo el mundo.");
    //With a single login using your computer, tablet, phone or our app!
    define("LANG_LABEL_LOGINEXPLANATION", "¡Con una sola conexión usando su computadora, tableta, teléfono o nuestra app!");
    //Oops, something wrong happened. Please try again or contact us.
	define("LANG_LABEL_ERRORLOGIN", "Algo malo sucedió. Inténtelo de nuevo o póngase en contacto con nosotros.");
