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
	# * FILE: /lang/pt_br.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DATE/TIME
	# ----------------------------------------------------------------------------------------------------
	//january,february,march,april,may,june,july,august,september,october,november,december
	define("LANG_DATE_MONTHS", "janeiro,fevereiro,março,abril,maio,junho,julho,agosto,setembro,outubro,novembro,dezembro");
	//sunday,monday,tuesday,wednesday,thursday,friday,saturday
	define("LANG_DATE_WEEKDAYS", "domingo,segunda-feira,terça-feira,quarta-feira,quinta-feira,sexta-feira,sábado");
	//year
	define("LANG_YEAR", "ano");
	//years
	define("LANG_YEAR_PLURAL", "anos");
	//month
	define("LANG_MONTH", "mês");
	//months
	define("LANG_MONTH_PLURAL", "meses");
	//day
	define("LANG_DAY", "dia");
	//days
	define("LANG_DAY_PLURAL", "dias");
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
	define("ZIPCODE_LABEL", "CEP");

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
	define("LANG_MENU_HOME", "Home");
	//Listings
	define("LANG_MENU_LISTING", "Empresas");
	//Events
	define("LANG_MENU_EVENT", "Eventos");
	//Banners
	define("LANG_MENU_BANNER", "Banners");
	//Classifieds
	define("LANG_MENU_CLASSIFIED", "Classificados");
	//Articles
	define("LANG_MENU_ARTICLE", "Artigos");
	//Deals
	define("LANG_MENU_PROMOTION", "Ofertas");
	//Blog
	define("LANG_MENU_BLOG", "Blog");
	//Advertise
	define("LANG_MENU_ADVERTISE", "Anuncie");
	//FAQ
	define("LANG_MENU_FAQ", "FAQ");
	//Sitemap
	define("LANG_MENU_SITEMAP", "Mapa do Site");
	//Contact Us
	define("LANG_MENU_CONTACT", "Entre em Contato");
	//Enquire
	define("LANG_MENU_ENQUIRE", "Informe-se");
	//Tell us about your project
	define("LANG_MENU_ENQUIRE2", "Conte-nos sobre seu projeto");
	//Find us on LinkedIn
	define("LANG_ALT_LINKEDIN", "Siga-nos no LinkedIn");
	//Find us on Facebook
	define("LANG_ALT_FACEBOOK", "Siga-nos no Facebook");
	//Like Us on Facebook
	define("LANG_LIKE_FACEBOOK", "Curta-nos no Facebook");
	//Links
	define("LANG_LINKS", "Links");
	//Contact
	define("LANG_FOOTER_CONTACT", "Contato");
	//Twitter
	define("LANG_TWITTER", "Twitter");
	//Twitter Updates
	define("LANG_TWITTER_UPDATES", "Atualizações do Twitter");
	//Follow us on Twitter
	define("LANG_FOLLOW_US_TWITTER", "Siga-nos no Twitter");
	//Follow Us
	define("LANG_FOLLOW_US", "Siga-nos");
	//Send Us a message
    define("LANG_CONTACT_SENDMSG", "Envie-nos uma mensagem");
	//Site Content
    define("LANG_SITE_CONTENT", "Conteúdo do Site");
	//Learn More
	define("LANG_LABEL_LEARN_MORE", "Saiba Mais");
	//Download our App
	define("LANG_LABEL_DOWNLOAD_APP", "Baixe nosso <b>Aplicativo</b>");

	# ----------------------------------------------------------------------------------------------------
	# JAVASCRIPT LANGUAGES VARIABLES
	# ----------------------------------------------------------------------------------------------------
	//Wait, Loading Category Tree...
	define("LANG_JS_LOADCATEGORYTREE", "Aguarde, Carregando a Árvore de Categorias...");
	//Wait, Loading Locations...
	define("LANG_JS_LOADLOCATIONTREE", "Aguarde, Carregando Localidades...");
	//Loading...
	define("LANG_JS_LOADING", "Carregando...");
	//This item was added to your Favorites. You can view your Favorites in your profile page.
	define("LANG_JS_FAVORITEADD", "Este item foi adicionado aos seus Favoritos.<br />Você pode ver sua lista de Favoritos na página do seu perfil.");
	//This item was removed from your Favorites.
	define("LANG_JS_FAVORITEDEL", "Este item foi removido dos seus Favoritos.");
	//weak
	define("LANG_JS_LABEL_WEAK", "fraco");
	//bad
	define("LANG_JS_LABEL_BAD", "ruim");
	//good
	define("LANG_JS_LABEL_GOOD", "bom");
	//strong
	define("LANG_JS_LABEL_STRONG", "forte");
	//There was a problem retrieving the XML data:
	define("LANG_JS_ACCOUNTSEARCH_PROBLEMRETRIEVING", "Ocorreu um problema ao requisitar os dados em XML:");
	//Click here to select an account.
	define("LANG_JS_ACCOUNTSEARCH_CLICKHERETOSELECT", "Clique aqui para selecionar uma conta.");
	//Please provide at least a 3 letter word for the search!
	define("LANG_JS_ACCOUNTSEARCH_PLEASEPROVIDEATLEAST", "Por favor, digite pelo menos 3 letras ao efetuar uma busca!");
	//Server response failure!
	define("LANG_JS_ACCOUNTSEARCH_SERVERRESPONSEFAILURE", "Falha de resposta do servidor!");
	//Press ESC Key to close.
	define("LANG_JS_COLORPICKER_CLOSEMSG", "Tecle ESC para fechar.");
	//Hide Map
	define("LANG_JS_LABEL_HIDEMAP", "Ocultar Mapa");
	//Show Map
	define("LANG_JS_LABEL_SHOWMAP", "Exibir Mapa");
	//Show Graphics
	define("LANG_JS_LABEL_SHOWGRAPHICS", "Exibir Gráficos");
	//Hide Graphics
	define("LANG_JS_LABEL_HIDEGRAPHICS", "Ocultar Gráficos");
	//This item was already added to your Favorites.<br />You can view your Favorites in your profile page.
	define("LANG_JS_FAVORITES_ADDED", "Este item já foi adicionado aos seus Favoritos.\n\nVocê pode ver sua lista de Favoritos na página do seu perfil.");
	//Wait...
	define("LANG_JS_WAIT", "Aguarde...");
	//Continue
	define("LANG_JS_CONTINUE", "Avançar");
	//Close
	define("LANG_JS_CLOSE", "Fechar");
	//Add keyword
	define("LANG_JS_ADDKEYWORD", "Adicionar palavra-chave");
	//Add file
	define("LANG_JS_ADDFILE", "Adicionar arquivo");
	//Prev
	define("LANG_JS_PREV", "Anterior");
	//Next
	define("LANG_JS_NEXT", "Próximo");
	//End Tour
	define("LANG_JS_END_TOUR", "Fechar");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDES
	# ----------------------------------------------------------------------------------------------------
	//You are using an older version of Internet Explorer that may affect the full functionality of some features. We recommend you upgrade to a newer version of Internet Explorer.
	define("LANG_IE6_WARNING", "Você está usando uma versão antiga do Internet Explorer que pode afetar a funcionalidade completa de alguns recursos. Nós recomendamos que você atualize para uma versão mais recente do Internet Explorer.");
	//N/A
	define("LANG_NA", "n.d.");
	//characters
	define("LANG_LABEL_CHARACTERES", "caracteres");
	//by
	define("LANG_BY", "por");
	//in
	define("LANG_IN", "em");
	//Read More
	define("LANG_READMORE", "Leia Mais");
	//More
	define("LANG_MORE", "mais");
	//Browse by Category
	define("LANG_BROWSEBYCATEGORY", "Busca por Categoria");
	//Browse by Location
	define("LANG_BROWSEBYLOCATION", "Busca por Localidade");
	//Browse by Rating
	define("LANG_BROWSEBYREVIEW", "Busca por Avaliação");
	//Browse Listings
	define("LANG_BROWSELISTINGS", "Busca por Empresas");
	//Browse Events
	define("LANG_BROWSEEVENTS", "Busca por Eventos");
	//Browse Classifieds
	define("LANG_BROWSECLASSIFIEDS", "Busca por Classificados");
	//Browse Articles
	define("LANG_BROWSEARTICLES", "Busca por Artigos");
	//Browse Deals
	define("LANG_BROWSEPROMOTIONS", "Busca por Ofertas");
	//Browse Posts
	define("LANG_BROWSEPOSTS", "Busca por Postagens");
	//show
	define("LANG_SHOW", "exibir");
	//hide
	define("LANG_HIDE", "ocultar");
	//Bill to
	define("LANG_BILLTO", "Para faturamento");
	//Payable to
	define("LANG_PAYABLETO", "Pague a");
	//Issuing Date
	define("LANG_ISSUINGDATE", "Data de Emissão");
	//Expire Date
	define("LANG_EXPIREDATE", "Data de Vencimento");
	//Questions
	define("LANG_QUESTIONS", "Dúvidas");
	//Please call
	define("LANG_PLEASECALL", "Por favor ligue para");
	//Invoice Info
	define("LANG_INVOICEINFO", "Informações da Fatura");
	//Invoice Logo
	define("LANG_LABEL_INVOICELOGO", "Logomarca da Fatura");
	//Payment Date
	define("LANG_PAYMENTDATE", "Data do Pagamento");
	//None
	define("LANG_NONE", "Nenhum");
	//Custom Invoice
	define("LANG_CUSTOM_INVOICE", "Serviço Extra");
	//Custom Invoices
	define("LANG_CUSTOM_INVOICES", "Serviços Extras");
	//Locations
	define("LANG_LOCATIONS", "Localização");
	//Close
	define("LANG_CLOSE", "Fechar");
	//Close this window
	define("LANG_CLOSEWINDOW", "Fechar esta janela");
	//from
	define("LANG_FROM", "de");
	//Transaction Info
	define("LANG_TRANSACTION_INFO", "Informações da Transação");
	//In manual transactions, subtotal and tax are not calculated.
	define("LANG_TRANSACTION_MANUAL", "Em transações manuais, subtotal e o imposto não são calculados.");
	//creditcard
	define("LANG_CREDITCARD", "cartão de crédito");
	//Join Now!
	define("LANG_JOIN_NOW", "Registre-se Agora!");
	//Create Your Account
	define("LANG_JOIN_PROFILE", "Crie Sua Conta");
	//More Information
	define("LANG_MOREINFO", "Mais Informações");
	//and
	define("LANG_AND", "e");
	//Keyword sample 1: "Auto Parts"
	define("LANG_KEYWORD_SAMPLE_1", "Auto Peças");
	//Keyword sample 2: "Tires"
	define("LANG_KEYWORD_SAMPLE_2", "Pneus e Rodas");
	//Keyword sample 3: "Engine Repair"
	define("LANG_KEYWORD_SAMPLE_3", "Reparo de Motor");
	//Categories and sub-categories
	define("LANG_CATEGORIES_SUBCATEGS", "Categorias e subcategorias");
	//per
	define("LANG_PER", "por");
	//each
	define("LANG_EACH", "cada");
	//impressions block
	define("LANG_IMPRESSIONSBLOCK", "blocos de visualizações");
	//Add
	define("LANG_ADD", "Adicionar");
	//Manage
	define("LANG_MANAGE", "Gerenciar");
	//impressions to my paid credit of
	define("LANG_IMPRESSIONPAIDOF", "visualizações ao meu crédito de");
	//Section
	define("LANG_SECTION", "Seção");
	//General Pages
	define("LANG_GENERALPAGES", "Páginas Gerais");
	//Open in a new window
	define("LANG_OPENNEWWINDOW", "Abrir em uma nova janela");
	//No
	define("LANG_NO", "Não");
	//Yes
	define("LANG_YES", "Sim");
	//Dear
	define("LANG_DEAR", "Querido(a)");
	//Street Address, P.O. box
	define("LANG_ADDRESS_EXAMPLE", "Endereço, Caixa Postal");
	//Apartment, suite, unit, building, floor, etc.
	define("LANG_ADDRESS2_EXAMPLE", "Apartamento, suite, unidade, prédio, andar, etc.");
	//or
	define("LANG_OR", "ou");
	//Hour of Work sample 1: "Sun 8:00 am - 6:00 pm"
	define("LANG_HOURWORK_SAMPLE_1", "Segunda à Sexta - 8:00 às 18:00");
	//Hour of Work sample 2: "Mon 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_2", "Sábado - 8:00 às 14:00");
	//Hour of Work sample 3: "Tue 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_3", "Domingo - 10:00 às 12:00");
	//Additional Information
	define("LANG_EXTRA_FIELDS", "Informações Adicionais");
	//Amenities
	define("LANG_TEMPLATE_AMENITIES", "Comodidades");
	//Sign me in automatically
	define("LANG_AUTOLOGIN", "Entrar automaticamente");
	//Check / Uncheck All
	define("LANG_CHECK_UNCHECK_ALL", "Marcar / Desmarcar Todos");
	//Billing Information
	define("LANG_BIILING_INFORMATION", "Informações da Fatura");
	//Listing
	define("LANG_BUSINESS", "Empresa");
	//on Listing
	define("LANG_ON_LISTING", "na Empresa");
	//on Event
	define("LANG_ON_EVENT", "no Evento");
	//on Banner
	define("LANG_ON_BANNER", "no Banner");
	//on Classified
	define("LANG_ON_CLASSIFIED", "no Classificado");
	//on Article
	define("LANG_ON_ARTICLE", "no Artigo");
	//Listing Name
	define("LANG_LISTING_NAME", "Nome da Empresa");
	//Event Name
	define("LANG_EVENT_NAME", "Nome do Evento");
	//Banner Name
	define("LANG_BANNER_NAME", "Nome do Banner");
	//Classified Name
	define("LANG_CLASSIFIED_NAME", "Nome do Classificado");
	//Article Name
	define("LANG_ARTICLE_NAME", "Nome do Artigo");
	//Frequently Asked Questions
	define("LANG_FAQ_NAME", "Dúvidas Frequentes");
	//How can we help you?
	define("LANG_FAQ_HELP", "Como podemos ajudá-lo?");
	//Enter a question, keyword, topic...
	define("LANG_FAQ_TIP", "Digite uma pergunta, palavra-chave, assunto...");
	//click to crop image
	define("LANG_CROPIMAGE", "clique aqui para recortar a imagem");
	//Did not find your answer? Contact us.
	define("LANG_FAQ_CONTACT", "Não encontrou sua resposta? Entre em contato.");
	//Active
	define("LANG_LABEL_ACTIVE", "Ativo");
	//Suspended
	define("LANG_LABEL_SUSPENDED", "Suspenso");
	//Expired
	define("LANG_LABEL_EXPIRED", "Expirado");
	//Pending
	define("LANG_LABEL_PENDING", "Pendente");
	//Received
	define("LANG_LABEL_RECEIVED", "Recebido");
	//Promotional Code
	define("LANG_LABEL_DISCOUNTCODE", "Código Promocional");
	//Account
	define("LANG_LABEL_ACCOUNT", "Conta");
	//Change account
	define("LANG_LABEL_CHANGE_ACCOUNT", "Mudar a conta");
	//Name or Title
	define("LANG_LABEL_NAME_OR_TITLE", "Nome ou Título");
	//Name
	define("LANG_LABEL_NAME", "Nome");
	//First, Last
	define("LANG_LABEL_FIRST_LAST", "Primeiro, Último");
	//Page Name
	define("LANG_LABEL_PAGE_NAME", "Nome da Página");
	//Summary Description
	define("LANG_LABEL_SUMMARY_DESCRIPTION", "Resumo");
	//Category
	define("LANG_LABEL_CATEGORY", "Categoria");
    //Sub-Category
	define("LANG_LABEL_SUBCATEGORY", "Sub-Categoria");
	//Category
	define("LANG_CATEGORY", "Categoria");
	//Categories
	define("LANG_LABEL_CATEGORY_PLURAL", "Categorias");
	//Categories
	define("LANG_CATEGORY_PLURAL", "Categorias");
	//Country
	define("LANG_LABEL_COUNTRY", "País");
	//Region
	define("LANG_LABEL_REGION", "Região");
	//State
	define("LANG_LABEL_STATE", "Estado");
	//City
	define("LANG_LABEL_CITY", "Cidade");
	//Neighborhood
	define("LANG_LABEL_NEIGHBORHOOD", "Bairro");
	//Countries
	define("LANG_LABEL_COUNTRY_PL", "Países");
	//Regions
	define("LANG_LABEL_REGION_PL", "Regiões");
	//States
	define("LANG_LABEL_STATE_PL", "Estados");
	//Cities
	define("LANG_LABEL_CITY_PL", "Cidades");
	//Neighborhoods
	define("LANG_LABEL_NEIGHBORHOOD_PL", "Bairros");
	//Add a New Region
	define("LANG_LABEL_ADD_A_NEW_REGION", "Adicione uma nova região");
	//Add a New State
	define("LANG_LABEL_ADD_A_NEW_STATE", "Adicione um novo estado");
	//Add a New City
	define("LANG_LABEL_ADD_A_NEW_CITY", "Adicione uma nova cidade");
	//Add a New Neighborhood
	define("LANG_LABEL_ADD_A_NEW_NEIGHBORHOOD", "Adicione um novo bairro");
	//Choose an Existing Region
	define("LANG_LABEL_CHOOSE_AN_EXISTING_REGION", "Escolher uma região existente");
	//Choose an Existing State
	define("LANG_LABEL_CHOOSE_AN_EXISTING_STATE", "Escolher um estado existente");
	//Choose an Existing City
	define("LANG_LABEL_CHOOSE_AN_EXISTING_CITY", "Escolher uma cidade existente");
	//Choose an Existing Neighborhood
	define("LANG_LABEL_CHOOSE_AN_EXISTING_NEIGHBORHOOD", "Escolher um bairro existente");
	//Top Countries
	define("LANG_LABEL_TOP_COUNTRY", "Principais Países");
	//Top Regions
	define("LANG_LABEL_TOP_REGION", "Principais Regiões");
	//Top States
	define("LANG_LABEL_TOP_STATE", "Principais Estados");
	//Top Cities
	define("LANG_LABEL_TOP_CITY", "Principais Cidades");
	//Top Neighborhoods
	define("LANG_LABEL_TOP_NEIGHBORHOOD", "Principais Bairros");
	//No locations found.
	define("LANG_LABEL_NO_LOCATIONS_FOUND", "Nenhuma localidade encontrada");
	//Renewal
	define("LANG_LABEL_RENEWAL", "Renovação");
	//Renewal Date
	define("LANG_LABEL_RENEWAL_DATE", "Data de Renovação");
	//Street Address
	define("LANG_LABEL_STREET_ADDRESS", "Endereço");
	//Web Address
	define("LANG_LABEL_WEB_ADDRESS", "Website");
	//Phone
	define("LANG_LABEL_PHONE", "Fone");
	//Fax
	define("LANG_LABEL_FAX", "Fax");
	//Long Description
	define("LANG_LABEL_LONG_DESCRIPTION", "Descrição");
	//Status
	define("LANG_LABEL_STATUS", "Status");
	//Level
	define("LANG_LABEL_LEVEL", "Nível");
	//Empty
	define("LANG_LABEL_EMPTY", "Vazio");
	//Videos (Youtube etc)
	define("LANG_LABEL_VIDEOS", "Vídeos (Youtube etc)");
	//Additional Uploads (PDF, DOC, TXT, GIF or PNG)
	define("LANG_LABEL_ATTACH", "Arquivos adicionais (PDF, DOC, TXT, JPG, GIF ou PNG)");
	//Facebook page
	define("LANG_LABEL_FBPAGE", "Página do Facebook");
	//Features
	define("LANG_LABEL_FEATURES", "Diferenciais");
	//Classified Price
	define("LANG_LABEL_CLASSIFIED_PRICE", "Preço do Classificado");
	//Event Time
	define("LANG_LABEL_EVENTTIME", "Hora do Evento");
	//Imagery
	define("LANG_LABEL_IMAGERY", "Imagens");
	//Start Date
	define("LANG_LABEL_START_DATE", "Data de Início");
	//Start Date
	define("LANG_LABEL_STARTDATE", "Data de Início");
	//End Date
	define("LANG_LABEL_END_DATE", "Data de Término");
	//End Date
	define("LANG_LABEL_ENDDATE", "Data de Término");
	//Invalid date
	define("LANG_LABEL_INVALID_DATE", "Data inválida");
	//Start Time
	define("LANG_LABEL_START_TIME", "Hora de Início");
	//End Time
	define("LANG_LABEL_END_TIME", "Hora de Término");
	//Unlimited
	define("LANG_LABEL_UNLIMITED", "ilimitado");
	//Select
	define("LANG_LABEL_SELECT", "Selecione");
	//Selected
	define("LANG_LABEL_SELECTED", "Selecionado");
	//Select a Type
	define("LANG_LABEL_SELECT_TYPE", "Selecione um Tipo");
	//Select a Category
	define("LANG_LABEL_SELECT_CATEGORY", "Selecione uma Categoria");
	//Time Left
	define("LANG_LABEL_TIMELEFT", "Tempo Restante");
	//View Deal
	define("LANG_LABEl_VIEW_DEAL", "Ver Oferta");
	//No Deal
	define("LANG_LABEL_NO_PROMOTION", "Nenhuma Oferta");
	//Select a Deal
	define("LANG_LABEL_SELECT_PROMOTION", "Selecione uma Oferta");
	//Great Offer!
	define("LANG_LABEL_GREAT_OFFER", "Ótima Oferta!");
	//Contact Name
	define("LANG_LABEL_CONTACTNAME", "Nome do Contato");
	//Contact Name
	define("LANG_LABEL_CONTACT_NAME", "Nome do Contato");
	//Contact Phone
	define("LANG_LABEL_CONTACT_PHONE", "Telefone");
	//Contact Fax
	define("LANG_LABEL_CONTACT_FAX", "Fax");
	//Contact E-mail
	define("LANG_LABEL_CONTACT_EMAIL", "E-mail");
	//URL
	define("LANG_LABEL_URL", "URL");
	//Address
	define("LANG_LABEL_ADDRESS", "Endereço");
	//E-mail
	define("LANG_LABEL_EMAIL", "E-mail");
	//Notify me about listing reviews and listing traffic
	define("LANG_LABEL_NOTIFY_TRAFFIC", "Notifique-me sobre avaliações e tráfego das empresas");
	//Invoice
	define("LANG_LABEL_INVOICE", "Fatura");
	//Invoice #
	define("LANG_LABEL_INVOICENUMBER", "Fatura Nº");
	//Item
	define("LANG_LABEL_ITEM", "Item");
	//Items
	define("LANG_LABEL_ITEMS", "Itens");
	//Extra Category
	define("LANG_LABEL_EXTRA_CATEGORY", "Categoria Extra");
	//Discount Code
	define("LANG_LABEL_DISCOUNT_CODE", "Código Promocional");
	//Item Price
	define("LANG_LABEL_ITEMPRICE", "Preço do Item");
	//Amount
	define("LANG_LABEL_AMOUNT", "Valor");
	//Tax
	define("LANG_LABEL_TAX", "Imposto");
	//Subtotal
	define("LANG_LABEL_SUBTOTAL", "Subtotal");
	//Make checks payable to
	define("LANG_LABEL_MAKE_CHECKS_PAYABLE", "Fazer os cheques nominais para");
	//Total
	define("LANG_LABEL_TOTAL", "Total");
	//Id
	define("LANG_LABEL_ID", "Id");
	//IP
	define("LANG_LABEL_IP", "IP");
	//Title
	define("LANG_LABEL_TITLE", "Título");
	//Caption
	define("LANG_LABEL_CAPTION", "Legenda");
	//impressions
	define("LANG_IMPRESSIONS", "visualizações");
	//Impressions
	define("LANG_LABEL_IMPRESSIONS", "Visualizações");
	//By impressions
	define("LANG_LABEL_BY_IMPRESSIONS", "Por visualizações");
	//By time period
	define("LANG_LABEL_BY_PERIOD", "Por período de tempo");
	//Date
	define("LANG_LABEL_DATE", "Data");
	//Your E-mail
	define("LANG_LABEL_YOUREMAIL", "Seu E-mail");
	//Subject
	define("LANG_LABEL_SUBJECT", "Assunto");
	//Additional message
	define("LANG_LABEL_ADDITIONALMSG", "Mensagem adicional");
	//Payment type
	define("LANG_LABEL_PAYMENT_TYPE", "Tipo de pagamento");
	//Notes
	define("LANG_LABEL_NOTES", "Notas");
	//It's easy and fast!
	define("LANG_LABEL_EASYFAST", "É fácil e rápido!");
	//Write reviews, comment on blog
	define("LANG_LABEL_FOR_PROFILE", "Escreva avaliações, comente no blog");
	//Write reviews
	define("LANG_LABEL_FOR_PROFILE2", "Escreva avaliações");
	//Based on
	define("LANG_LABEL_BASED_ON", "Baseado em");
	//Write a review
	define("LANG_WRITE_REVIEW", "Escreva uma avaliação");
	//Already have access?
	define("LANG_LABEL_ALREADYMEMBER", "Já possui uma conta?");
	//Enjoy our services!
	define("LANG_LABEL_ENJOYSERVICES", "Aproveite nossos serviços!");
	//Test Password
	define("LANG_LABEL_TESTPASSWORD", "Senha de Teste");
	//Forgot your password?
	define("LANG_LABEL_FORGOTPASSWORD", "Esqueceu sua senha?");
	//Summary
	define("LANG_LABEL_SUMMARY", "Resumo");
	//Detail
	define("LANG_LABEL_DETAIL", "Detalhes");
	//(your friend's e-mail)
	define("LANG_LABEL_FRIEND_EMAIL", "(e-mail do seu amigo)");
	//General Contact Form
	define("LANG_LABEL_GENERAL_FORM", "Formulário de Contato Geral");
	//For
	define("LANG_LABEL_FOR", "Para");
	//Created
	define("LANG_LABEL_CREATED", "Criação");
	//From
	define("LANG_LABEL_FROM", "De");
	//To
	define("LANG_LABEL_TO", "Para");
	//to
	define("LANG_LABEL_DATE_TO", "a");
	//Last
	define("LANG_LABEL_LAST", "Último");
	//Last
	define("LANG_LABEL_LAST_PLURAL", "Últimos");
	//day
	define("LANG_LABEL_DAY", "dia");
	//days
	define("LANG_LABEL_DAYS", "dias");
	//New
	define("LANG_LABEL_NEW", "Nova");
	//New FAQ
	define("LANG_LABEL_NEW_FAQ", "Novo FAQ");
	//Type
	define("LANG_LABEL_TYPE", "Tipo");
	//ClickThru
	define("LANG_LABEL_CLICKTHRU", "Website");
	//Added
	define("LANG_LABEL_ADDED", "Adicionado");
    //Added on
    define("LANG_LABEL_ADDED_ON", "Adicionado em");
    //There are no pending items.
    define("LANG_LABEL_NO_PENDING_ITEMS", "Não há itens pendentes.");
    //There are no pending reviews.
    define("LANG_LABEL_NO_PENDING_REVIEWS", "Não há avaliações pendentes.");
    //more
    define("LANG_LABEL_PLUS_REVIEWS", "mais [X]");
	//rates this item with
    define("LANG_LABEL_REVIEW_RATES", "avaliou essa [item] com");
    //Did you find this review helpful?
    define("LANG_LABEL_REVIEW_HELPFUL", "Essa avaliação foi útil?");
    //Blog Comment
    define("LANG_LAVEL_BLOG_COMMENT", "Comentário do Blog");
	//Post Title
	define("LANG_BLOG_TITLE", "Título do Post");
	//Add
	define("LANG_LABEL_ADD", "Adicionar");
	//rating
	define("LANG_LABEL_RATING", "avaliação");
	//evaluator
	define("LANG_LABEL_EVALUATOR", "avaliador");
	//Reviewer
	define("LANG_LABEL_REVIEWER", "Avaliador");
	//System
	define("LANG_LABEL_SYSTEM", "Sistema");
	//Subscribe to RSS
	define("LANG_LABEL_SUBSCRIBERSS", "Inscrição de RSS");
	//Guide
	define("LANG_LABEL_GUIDE", "Guia");
	//Password strength
	define("LANG_LABEL_PASSWORDSTRENGTH", "Força da senha");
	//Article Title
	define("LANG_ARTICLE_TITLE", "Título do Artigo");
	//SEO Description
	define("LANG_SEO_DESCRIPTION", "SEO - Descrição");
	//SEO Keywords
	define("LANG_SEO_KEYWORDS", "SEO - Palavras-chave");
	//No line breaks allowed
	define("LANG_SEO_LINEBREAK", "não são permitidas quebras de linha");
	//Separate elements with comma (,)
	define("LANG_SEO_COLON", "separe os elementos com vírgula (,)");
	//Click here to edit the SEO information of this item
	define("LANG_MSG_CLICK_TO_EDIT_SEOCENTER", "Clique aqui para editar as informações de SEO deste item");
	//SEO successfully updated!
	define("LANG_MSG_SEOCENTER_ITEMUPDATED", "Informações de SEO atualizadas!");
	//Click here to view this article
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE", "Clique aqui para visualizar este artigo");
	//Click here to edit this article
	define("LANG_MSG_CLICK_TO_EDIT_THIS_ARTICLE", "Clique aqui para editar este artigo");
	//Click here to view this article reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE_REPORTS", "Clique aqui para ver o relatório deste artigo");
	//History for this article
	define("LANG_HISTORY_FOR_THIS_ARTICLE", "Histórico deste artigo");
	//History not available for this article
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_ARTICLE", "Histórico indisponível para este artigo");
	//Click here to delete this article
	define("LANG_MSG_CLICK_TO_DELETE_THIS_ARTICLE", "Clique aqui para remover este artigo");
	//Click here to view this banner
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER", "Clique aqui para visualizar este banner");
	//Click here to edit this banner
	define("LANG_MSG_CLICK_TO_EDIT_THIS_BANNER", "Clique aqui para editar este banner");
	//Click here to view this banner reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER_REPORTS", "Clique aqui para ver o relatório deste banner");
	//History for this banner
	define("LANG_HISTORY_FOR_THIS_BANNER", "Histórico deste banner");
	//History not available for this banner
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_BANNER", "Histórico indisponível para este banner");
	//Click here to delete this banner
	define("LANG_MSG_CLICK_TO_DELETE_THIS_BANNER", "Clique aqui para remover este banner");
	//Classified Title
	define("LANG_CLASSIFIED_TITLE", "Título do Classificado");
	//Click here to
	define("LANG_MSG_CLICKTO", "Clique aqui para");
	//Click here to view this classified
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED", "Clique aqui para visualizar este classificado");
	//Click here to edit this classified
	define("LANG_MSG_CLICK_TO_EDIT_THIS_CLASSIFIED", "Clique aqui para editar este classificado");
	//Click here to view this classified reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED_REPORTS", "Clique aqui para ver o relatório deste classificado");
	//Click here to map tuning this classified location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_CLASSIFIED", "Clique aqui para ajustar a localização deste classificado no mapa");
	//Map tuning not available for this classified
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_CLASSIFIED", "Ajuste de localização indisponível para este classificado");
	//History for this classified
	define("LANG_HISTORY_FOR_THIS_CLASSIFIED", "Histórico deste classificado");
	//History not available for this classified
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_CLASSIFIED", "Histórico indisponível para este classificado");
	//Click here to delete this classified
	define("LANG_MSG_CLICK_TO_DELETE_THIS_CLASSIFIED", "Clique aqui para remover este classificado");
	//Event Title
	define("LANG_EVENT_TITLE", "Título do Evento");
	//Click here to view this event
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT", "Clique aqui para visualizar este evento");
	//Click here to edit this event
	define("LANG_MSG_CLICK_TO_EDIT_THIS_EVENT", "Clique aqui para editar este evento");
	//Click here to view this event reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT_REPORTS", "Clique aqui para ver o relatório deste evento");
	//Click here to map tuning this event location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_EVENT", "Clique aqui para ajustar a localização deste evento no mapa");
	//Map tuning not available for this event
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_EVENT", "Ajuste de localização indisponível para este evento");
	//History for this event
	define("LANG_HISTORY_FOR_THIS_EVENT", "Histórico deste evento");
	//History not available for this event
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_EVENT", "Histórico indisponível para este evento");
	//Click here to delete this event
	define("LANG_MSG_CLICK_TO_DELETE_THIS_EVENT", "Clique aqui para remover este evento");
	//Listing Title
	define("LANG_LISTING_TITLE", "Nome da Empresa");
	//Click here to view this listing
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING", "Clique aqui para visualizar esta empresa");
	//Click here to edit this listing
	define("LANG_MSG_CLICK_TO_EDIT_THIS_LISTING", "Clique aqui para editar esta empresa");
	//Click here to change deal for this listing
	define("LANG_MSG_CLICK_TO_CHANGE_PROMOTION", "Clique aqui para alterar a oferta desta empresa");
	//Deal not available for this listing
	define("LANG_MSG_PROMOTION_NOT_AVAILABLE", "Oferta indisponível para esta empresa");
	//Click here to view this listing reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING_REPORTS", "Clique aqui para ver o relatório desta empresa");
	//Click here to map tuning this listing location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_LISTING", "Clique aqui para ajustar a localização desta empresa no mapa");
	//Map tuning not available for this listing
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_LISTING", "Ajuste de localização indisponível para esta empresa");
	//Map tuning Address Not Found
	define("LANG_MAPTUNING_ADDRESSNOTFOUND", "Endereço não encontrado.");
	//Map tuning Please Edit Your Item
	define("LANG_MAPTUNING_PLEASEEDITYOURITEM", "Por favor edite o seu item.");
	//Click here to view this item reviews
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS", "Clique aqui para ver as avaliações deste item");
	//Item reviews not available
	define("LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE", "Avaliações indisponíveis para este item");
	//History for this listing
	define("LANG_HISTORY_FOR_THIS_LISTING", "Histórico desta empresa");
	//History not available for this listing
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_LISTING", "Histórico indisponível para esta empresa");
	//Click here to delete this listing
	define("LANG_MSG_CLICK_TO_DELETE_THIS_LISTING", "Clique aqui para remover esta empresa");
	//Save
	define("LANG_MSG_SAVE_CHANGES", "Salvar");
	//More Information
	define("LANG_MSG_MORE_INFO", "Mais Informação");
	//(Try to use something descriptive, like "10% off of our product" or "3 for the price of two on our product")
	define("LANG_MSG_DEALTITLE_TIP", "(Tente usar algo descritivo, como \"10% de desconto no nosso produto\" ou \"3 pelo preço de dois em nosso produto\")");
	//Enter the value of the item / service you are offering. Choose a discount type (Fixed Value or Percentage), and enter the respective value. Check the calculation and then provide us with the number of offers you wish to make.
	define("LANG_MSG_ADD_DEAL_TIP", "Digite o valor do item / serviço que você está oferecendo. Escolha um tipo de desconto (valor fixo ou percentual) e digite o respectivo valor. Verifique o cálculo e, em seguida, forneça o número de ofertas que você deseja fazer.");
	//Please be sure your image is the right size before you upload it, otherwise the image will likely be stretched to fit the site and image quality will be affected.
	define("LANG_MSG_ADD_DEAL_TIP2", "Por favor, certifique-se que a imagem é do tamanho correto antes de carregá-la, caso contrário, a imagem provavelmente será esticada e a qualidade será afetada.");
	//Every deal needs to be linked to a listing in order to be active on the site.
	define("LANG_MS_MANGE_DEAL_TIP", "Toda oferta precisa ser ligada a uma empresa para ser ativa no site.");
	//Associate with the listing
	define("LANG_DEAL_LISTING_SELECT", "Associar com a empresa");
	//Please type your item title and wait for suggestions of available associations.
	define("LANG_DEAL_LISTING_TIP", "Por favor, digite o título do seu item e aguarde por sugestões de associações disponíveis.");
	//Empty
	define("LANG_EMPTY", "Vazio");
	//Cancel
	define("LANG_CANCEL", "Cancelar");
	//Custom Time Period
	define("LANG_SITEMGR_CUSTOMPERIOD", "Período Personalizado");
	//Fixed Value Discount
	define("LANG_LABEL_FIXEDVALUE_DISC", "Valor de Desconto Fixo");
	//Percentage Discount
	define("LANG_LABEL_PERCENTAGE_DISC", "Desconto Percentual");
	//Value with Discount
	define("LANG_LABEL_DISC_AMOUNT", "Valor com Desconto");
	//Discount (Calculated)
	define("LANG_LABEL_DISC_CALCULATED", "Desconto (Calculado)");
	//How many deals would you like to offer
	define("LANG_LABEL_DEALS_OFFER", "Quantas ofertas você gostaria de oferecer");
	//Linked to Listing
	define("LANG_LABEL_ATTACHED_LISTING", "Ligada à Empresa");
	//Choose a Listing
	define("LANG_LABEL_CHOOSE_LISTING", "Escolha uma Empresa");
	//You can not add different deals to the same listing.
	define("LANG_MSG_REPEATED_LISTINGS", "Você não pode adicionar ofertas diferentes para a mesma empresa.");
	//Deals successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATE", "Ofertas atualizadas com sucesso!");
	//Options
	define("LANG_LABEL_OPTIONS", "Opções");
	//Deal Title
	define("LANG_PROMOTION_TITLE", "Título da Oferta");
	//Click here to view this deal
	define("LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION", "Clique aqui para visualizar esta oferta");
	//Click here to edit this deal
	define("LANG_MSG_CLICK_TO_EDIT_THIS_PROMOTION", "Clique aqui editar esta oferta");
	//Click here to view this deal reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION_REPORTS", "Clique aqui para ver o relatório desta oferta");
	//Click here to delete this deal
	define("LANG_MSG_CLICK_TO_DELETE_THIS_PROMOTION", "Clique aqui para remover esta Oferta");
	//Go to "Listings" and click on the deal icon belonging to the listing where you want to add the deal. Select one deal to add to your listing to make it live.
	define("LANG_PROMOTION_EXTRAMESSAGE", "Vá para \"Empresas\" e clique no ícone Oferta da empresa que terá uma Oferta. Escolha uma Oferta para a empresa. Somente após esse processo a Oferta será publicada.");
	//The installments will be recurring until your credit card expiration
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATION", "As parcelas serão debitadas até a expiração do cartão de crédito");
	//The installments will be recurring until your credit card expiration ("maximum of 36 installments")
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATIONMAXOF", "máximo de 36 parcelas");
	//SEO Center
	define("LANG_MSG_SEO_CENTER", "Configurações de SEO");
	//View
	define("LANG_LABEL_VIEW", "Visualizar");
	//Edit
	define("LANG_LABEL_EDIT", "Editar");
	//Traffic Reports
	define("LANG_TRAFFIC_REPORTS", "Relatório de Tráfego");
	//Unpaid
	define("LANG_LABEL_UNPAID", "Pendente");
	//Paid
	define("LANG_LABEL_PAID", "Pago");
	//Waiting payment approval
	define("LANG_LABEL_WAITING", "Aguardando pagamento/aprovação");
	//Under review
	define("LANG_LABEL_ANALYSIS", "Em análise");
	//Available
	define("LANG_LABEL_AVAILABLE", "Disponível");
	//In dispute
	define("LANG_LABEL_DISPUTE", "Em disputa");
	//Refunded
	define("LANG_LABEL_REFUNDED", "Devolvido");
	//Cancelled
	define("LANG_LABEL_CANCELLED", "Cancelado");
	//Transaction
	define("LANG_LABEL_TRANSACTION", "Transação");
	//Delete
	define("LANG_LABEL_DELETE", "Excluir");
	//Download
	define("LANG_LABEL_DOWNLOAD", "Baixar");
	//Map Tuning
	define("LANG_LABEL_MAP_TUNING", "Ajustar Localização");
	//Hide Map
	define("LANG_LABEL_HIDEMAP", "Ocultar Mapa");
	//Show Map
	define("LANG_LABEL_SHOWMAP", "Exibir Mapa");
	//SEO
	define("LANG_LABEL_SEO_TUNING", "SEO");
	//Print
	define("LANG_LABEL_PRINT", "Imprimir");
	//Pending Approval
	define("LANG_LABEL_PENDING_APPROVAL", "Pendente");
	//Image
	define("LANG_LABEL_IMAGE", "Imagem");
	//Images
	define("LANG_LABEL_IMAGE_PLURAL", "Imagens");
	//Required field
	define("LANG_LABEL_REQUIRED_FIELD", "Campo obrigatório");
	//Please type all the required fields.
	define("LANG_LABEL_TYPE_FIELDS", "Por favor, digite todos os campos requeridos.");
	//Account Information
	define("LANG_LABEL_ACCOUNT_INFORMATION", "Informações da Conta");
	//E-mail
	define("LANG_LABEL_USERNAME", "E-mail");
    //Username
	define("LANG_LABEL_USERNAME2", "Usuário");
	//Current Password
	define("LANG_LABEL_CURRENT_PASSWORD", "Senha Atual");
	//Password
	define("LANG_LABEL_PASSWORD", "Senha");
	//Password not changed.
	define("LANG_PASSWORD_NOT_CHANGED", "A senha não foi alterada.");
	//Create Password
	define("LANG_LABEL_CREATE_PASSWORD", "Criar Senha");
	//New Password
	define("LANG_LABEL_NEW_PASSWORD", "Nova Senha");
	//Retype Password
	define("LANG_LABEL_RETYPE_PASSWORD", "Confirme a Senha");
	//Retype Password
	define("LANG_LABEL_RETYPEPASSWORD", "Confirme a Senha");
	//Retype New Password
	define("LANG_LABEL_RETYPE_NEW_PASSWORD", "Confirme a Nova Senha");
	//OpenID URL
	define("LANG_LABEL_OPENIDURL", "OpenID URL");
	//Information
	define("LANG_LABEL_INFORMATION", "Informações");
	//Publication Date
	define("LANG_LABEL_PUBLICATION_DATE", "Data de Publicação");
	//Calendar
	define("LANG_LABEL_CALENDAR", "Calendário");
	//Friendly Url
	define("LANG_LABEL_FRIENDLY_URL", "Url Amigável");
	//For example
	define("LANG_LABEL_FOR_EXAMPLE", "Por exemplo");
	//Image Source
	define("LANG_LABEL_IMAGE_SOURCE", "Imagem");
	//Image Attribute
	define("LANG_LABEL_IMAGE_ATTRIBUTE", "Autor da imagem");
	//Image Caption
	define("LANG_LABEL_IMAGE_CAPTION", "Legenda da imagem");
	//Abstract
	define("LANG_LABEL_ABSTRACT", "Resumo");
	//Keywords for the search
	define("LANG_LABEL_KEYWORDS_FOR_SEARCH", "Palavras-chave para a busca");
	//Refine By...
	define("LANG_LABEL_REFINEBY", "Filtrar Por...");
	//You refined by...
    define("LANG_LABEL_REFINEDBY", "Você filtrou por...");
    //Remove all
    define("LANG_LABEL_REMOVE_ALL", "Remover tudo");
	//Show only listings with deals
	define("LANG_LABEL_FILTER_DEAL", "Exibir apenas empresas com ofertas");
	//maximum
	define("LANG_LABEL_MAX", "max");
	//keywords
	define("LANG_LABEL_KEYWORDS", "palavras-chave");
	//Content
	define("LANG_LABEL_CONTENT", "Conteúdo");
	//Code
	define("LANG_LABEL_CODE", "Código");
	//free
	define("LANG_FREE", "Grátis");
	//free
	define("LANG_LABEL_FREE", "grátis");
	//free
	define("LANG_INCLUDED", "inclusas");
	//Destination Url
	define("LANG_LABEL_DESTINATION_URL", "Url de Destino");
	//Script
	define("LANG_LABEL_SCRIPT", "Script");
	//File
	define("LANG_LABEL_FILE", "Arquivo");
	//Warning
	define("LANG_LABEL_WARNING", "Aviso");
	//Display URL (optional)
	define("LANG_LABEL_DISPLAY_URL", "Exibir URL (opcional)");
	//Visit Website
	define("LANG_VISIT_WEBSITE", "Visite o Site");
	//Description line 1
	define("LANG_LABEL_DESCRIPTION_LINE1", "Descrição 1");
	//Description line 2
	define("LANG_LABEL_DESCRIPTION_LINE2", "Descrição 2");
	//Location
	define("LANG_LABEL_LOCATIONS", "Localização");
	//Enter a landmark or point of reference for your listing's location.
	define("LANG_LABEL_LOCATIONS_TIP", "Utilize este campo para indicar uma referência de localização do seu item");
	//Would you like to add more information about your item? Besides your gallery images, you can upload an additional file with extra information here
	define("LANG_LABEL_ATTACH_ADDITIONAL_FILE_TIP", "Gostaria de adicionar mais informações sobre o seu item? Além de sua galeria de imagens, você pode fazer upload de um arquivo adicional com informações extras");
	//Fill in this field if your URL is too long. Example: "www.example.com" can be shown as "Example".
	define("LANG_LABEL_DISPLAY_URL_TIP", "Preencha este campo se a sua URL é muito longa. Exemplo: \"www.exemplo.com\" pode ser mostrada apenas como \"Exemplo\".");
	//Enable monthly e-mail to listing owners that includes their stats and reviews.
	define("LANG_LABEL_NOTIFY_TRAFFIC_TIP", "Ativar e-mail mensal para os proprietários com estatísticas e avaliações das empresas.");
	//Sponsors have access to the members area and can create items. They can also create their own personal pages.
	define("LANG_LABEL_SPONSOR_TIP", "Anunciantes tem acesso à área de membros e podem criar itens. Eles também podem criar suas próprias páginas pessoais.");
	//Visitors can visit your frontend pages, write reviews, comment on blog and view other user's personal page. Visitors can upgrade their accounts by adding an item through the advertise process.
	define("LANG_LABEL_PROFILE_TIP", "Os visitantes podem visitar o site, escrever avaliações, comentar no blog e visualizar a página pessoal de outros usuários. Os visitantes podem atualizar suas contas para \"Anunciante\" criando um item através do processo de anúncio.");
	//Address (optional)
	define("LANG_LABEL_ADDRESS_OPTIONAL", "Complemento");
	//Address (Optional)
	define("LANG_LABEL_ADDRESSOPTIONAL", "Complemento");
	//Detail Description
	define("LANG_LABEL_DETAIL_DESCRIPTION", "Descrição");
	//Price
	define("LANG_LABEL_PRICE", "Preço");
	//Prices
	define("LANG_LABEL_PRICE_PLURAL", "Preços");
	//Contact Information
	define("LANG_LABEL_CONTACT_INFORMATION", "Informações de Contato");
	//Language
	define("LANG_LABEL_LANGUAGE", "Idioma");
	//Select your main language to contact (when necessary).
	define("LANG_LABEL_LANGUAGETIP", "Selecione seu idioma de origem para contato (quando necessário).");
	//First Name
	define("LANG_LABEL_FIRST_NAME", "Nome");
	//First Name
	define("LANG_LABEL_FIRSTNAME", "Nome");
	//Last Name
	define("LANG_LABEL_LAST_NAME", "Sobrenome");
	//Last Name
	define("LANG_LABEL_LASTNAME", "Sobrenome");
	//Company
	define("LANG_LABEL_COMPANY", "Empresa");
	//Address
	define("LANG_LABEL_ADDRESS1", "Endereço");
	//Address 2
	define("LANG_LABEL_ADDRESS2", "Complemento");
	//Latitude
	define("LANG_LABEL_LATITUDE", "Latitude");
	//Longitude
	define("LANG_LABEL_LONGITUDE", "Longitude");
	//Not found. Please, try to specify better your location.
	define("LANG_LABEL_MAP_NOTFOUND", "Não encontrado. Por favor, tente especificar melhor sua localização.");
	//The following fields contain errors:
	define("LANG_LABEL_MAP_ERRORS", "Os campos a seguir contêm erros:");
	//Latitude must be a number between -90 and 90.
	define("LANG_LABEL_MAP_INVALID_LAT", "Latitude deve ser um número entre -90 e 90.");
	//Longitude must be a number between -180 and 180.
	define("LANG_LABEL_MAP_INVALID_LON", "Longitude deve ser um número entre -180 e 180.");
	//Location Name
	define("LANG_LABEL_LOCATION_NAME", "Nome do Local");
	//Event Date
	define("LANG_LABEL_EVENT_DATE", "Data do Evento");
	//Description
	define("LANG_LABEL_DESCRIPTION", "Descrição");
	//Help Information
	define("LANG_LABEL_HELP_INFORMATION", "Informações");
	//Text
	define("LANG_LABEL_TEXT", "Texto");
	//Add Image
	define("LANG_LABEL_ADDIMAGE", "Adicionar Imagem");
	//Add Image
	define("LANG_LABEL_ADDIMAGES", "Adicionar Imagem");
	//Edit Image Captions
	define("LANG_LABEL_EDITIMAGECAPTIONS", "Editar Legendas da Imagem");
	//Image File
	define("LANG_LABEL_IMAGEFILE", "Arquivo");
	//Thumb Caption
	define("LANG_LABEL_THUMBCAPTION", "Legenda da Miniatura");
	//Image Caption
	define("LANG_LABEL_IMAGECAPTION", "Legenda da Imagem");
	//Video Snippet Code
	define("LANG_LABEL_VIDEO_SNIPPET_CODE", "Código do Vídeo");
	//Attach Additional File
	define("LANG_LABEL_ATTACH_ADDITIONAL_FILE", "Anexar um Arquivo");
	//Attach Menu
	define("LANG_LABEL_ATTACH_MENU", "Anexar Cardápio");
	//Menu
	define("LANG_LABEL_MENU", "Cardápio");
    //Good to know
    define("LANG_LABEL_GOODKNOW", "Bom saber");
    //Make a reservation
    define("LANG_LABEL_RESERVATION", "Faça uma reserva");
	//Attention
	define("LANG_LABEL_ATTENTION", "Atenção");
	//Source
	define("LANG_LABEL_SOURCE", "Arquivo");
	//Hours
	define("LANG_LABEL_HOURS_OF_WORK", "Horário de funcionamento");
	//Default
	define("LANG_LABEL_DEFAULT", "Padrão");
	//Payment Method
	define("LANG_LABEL_PAYMENT_METHOD", "Método de Pagamento");
    //How do you want to pay us?
    define("LANG_LABEL_PAYMENT_METHOD_TIP", "Qual a melhor forma de pagamento para você?");
	//By Credit Card
	define("LANG_LABEL_BY_CREDIT_CARD", "Por Cartão de Crédito");
	//By PayPal
	define("LANG_LABEL_BY_PAYPAL", "Por Paypal");
	//By SimplePay
	define("LANG_LABEL_BY_SIMPLEPAY", "Por SimplePay");
	//By Pagseguro
	define("LANG_LABEL_BY_PAGSEGURO", "Por Pagseguro");
	//Print Invoice and Mail a Check
	define("LANG_LABEL_PRINT_INVOICE_AND_MAIL_CHECK", "Imprimir Fatura");
	//Headline
	define("LANG_LABEL_HEADLINE", "Título");
	//Offer
	define("LANG_LABEL_OFFER", "Oferta");
	//Conditions
	define("LANG_LABEL_CONDITIONS", "Condições");
	//Deal Dates
	define("LANG_LABEL_PROMOTION_DATE", "Datas da Oferta");
	//Deal Layout
	define("LANG_LABEL_PROMOTION_LAYOUT", "Imagem da Oferta");
	//You pay
	define("LANG_LABEL_PROMOTION_PAY", "Você paga");
	//Time left to buy
	define("LANG_LABEL_PROMOTION_TIMELEFT", "Tempo para comprar");
	//Printable Deal
	define("LANG_LABEL_PRINTABLE_PROMOTION", "Versão Impressa");
	//Our HTML template based deal
	define("LANG_LABEL_OUR_HTML_TEMPLATE_BASED", "Nosso modelo padrão de Oferta");
	//Fill in the fields above and insert a logo or other image (JPG or GIF)
	define("LANG_LABEL_FILL_FIELDS_ABOVE", "Preencha os campos acima e insira uma logomarca ou outra imagem (JPG ou GIF)");
	//A deal provided by you instead
	define("LANG_LABEL_PROMOTION_PROVIDED_BY_YOU", "Uma Oferta fornecida por você");
	//JPG or GIF image
	define("LANG_LABEL_JPG_GIF_IMAGE", "imagem JPG ou GIF");
	//Comment Title
	define("LANG_LABEL_COMMENTTITLE", "Título");
	//Comment
	define("LANG_LABEL_COMMENT", "Comentário");
	//Accepted
	define("LANG_LABEL_ACCEPTED", "Aceito");
	//Approved
	define("LANG_LABEL_APPROVED", "Aprovado");
	//Success
	define("LANG_LABEL_SUCCESS", "Sucesso");
	//Completed
	define("LANG_LABEL_COMPLETED", "Finalizado");
	//Y
	define("LANG_LABEL_Y", "S");
	//Failed
	define("LANG_LABEL_FAILED", "Falha");
	//Declined
	define("LANG_LABEL_DECLINED", "Recusado");
	//failure
	define("LANG_LABEL_FAILURE", "falha");
	//Canceled
	define("LANG_LABEL_CANCELED", "Cancelado");
	//Error
	define("LANG_LABEL_ERROR", "Erro");
	//Transaction Code
	define("LANG_LABEL_TRANSACTION_CODE", "Código da Transação");
	//Subscription ID
	define("LANG_LABEL_SUBSCRIPTION_ID", "ID da Subscrição");
	//transaction history
	define("LANG_LABEL_TRANSACTION_HISTORY", "histórico de transações");
	//Authorization Code
	define("LANG_LABEL_AUTHORIZATION_CODE", "Código de Autorização");
	//Transaction Status
	define("LANG_LABEL_TRANSACTION_STATUS", "Status da Transação");
	//Transaction Error
	define("LANG_LABEL_TRANSACTION_ERROR", "Erro na Transação");
	//Monthly Bill Amount
	define("LANG_LABEL_MONTHLY_BILL_AMOUNT", "Valor Mensal da Conta");
	//Transaction OID
	define("LANG_LABEL_TRANSACTION_OID", "ID da Transação");
	//Yearly Bill Amount
	define("LANG_LABEL_YEARLY_BILL_AMOUNT", "Valor Anual da Conta");
	//Bill Amount
	define("LANG_LABEL_BILL_AMOUNT", "Valor da Conta");
	//Transaction ID
	define("LANG_LABEL_TRANSACTION_ID", "ID da Transação");
	//Receipt ID
	define("LANG_LABEL_RECEIPT_ID", "ID do Recibo");
	//Subscribe ID
	define("LANG_LABEL_SUBSCRIBE_ID", "ID da Subscrição");
	//Transaction Order ID
	define("LANG_LABEL_TRANSACTION_ORDERID", "ID da Transação");
	//your
	define("LANG_LABEL_YOUR", "seu");
	//Make Your
	define("LANG_LABEL_MAKE_YOUR", "Faça Seu");
	//Payment
	define("LANG_LABEL_PAYMENT", "Pagamento");
	//History
	define("LANG_LABEL_HISTORY", "Histórico");
	//Log in
	define("LANG_LABEL_LOGIN", "Entrar");
	//Transaction canceled
	define("LANG_LABEL_TRANSACTION_CANCELED", "Transação cancelada");
	//Transaction amount
	define("LANG_LABEL_TRANSACTION_AMOUNT", "Valor da transação");
	//Pay
	define("LANG_LABEL_PAY", "Pagar");
	//Back
	define("LANG_LABEL_BACK", "Voltar");
	//Total Price
	define("LANG_LABEL_TOTAL_PRICE", "Preço Total");
	//Pay By Invoice
	define("LANG_LABEL_PAY_BY_INVOICE", "Imprimir Fatura");
	//Administrator
	define("LANG_LABEL_ADMINISTRATOR", "Administrador");
	//Billing Info
	define("LANG_LABEL_BILLING_INFO", "Informações do Pagamento");
	//Card Number
	define("LANG_LABEL_CARD_NUMBER", "Número do Cartão");
	//Card Expire date
	define("LANG_LABEL_CARD_EXPIRE_DATE", "Data de Expiração do Cartão");
	//Card Code
	define("LANG_LABEL_CARD_CODE", "Código do Cartão");
	//Customer Info
	define("LANG_LABEL_CUSTOMER_INFO", "Informações do Cliente");
	//zip
	define("LANG_LABEL_ZIP", "CEP");
	//Place Order and Continue
	define("LANG_LABEL_PLACE_ORDER_CONTINUE", "Pagar e Continuar");
	//General Information
	define("LANG_LABEL_GENERAL_INFORMATION", "Informações Gerais");
	//Phone Number
	define("LANG_LABEL_PHONE_NUMBER", "Fone");
	//E-mail Address
	define("LANG_LABEL_EMAIL_ADDRESS", "Endereço de E-mail");
	//Credit Card Information
	define("LANG_LABEL_CREDIT_CARD_INFORMATION", "Informações do Cartão de Crédito");
	//Exp. Date
	define("LANG_LABEL_EXP_DATE", "Data de Exp.");
	//Customer Information
	define("LANG_LABEL_CUSTOMER_INFORMATION", "Informações do Cliente");
	//Card Expiration
	define("LANG_LABEL_CARD_EXPIRATION", "Expiração do Cartão");
	//Name on Card
	define("LANG_LABEL_NAME_ON_CARD", "Nome Impresso no Cartão");
	//Card Type
	define("LANG_LABEL_CARD_TYPE", "Tipo de Cartão");
	//Card Verification Number
	define("LANG_LABEL_CARD_VERIFICATION_NUMBER", "Número de Verificação do Cartão");
	//Province
	define("LANG_LABEL_PROVINCE", "Estado");
	//Postal Code
	define("LANG_LABEL_POSTAL_CODE", "CEP");
	//Post Code
	define("LANG_LABEL_POST_CODE", "CEP");
	//Tel
	define("LANG_LABEL_TEL", "Fone");
	//Select Date
	define("LANG_LABEL_SELECTDATE", "Selecione uma Data");
	//Found
	define("LANG_PAGING_FOUND", "Encontrado");
	//Found
	define("LANG_PAGING_FOUND_PLURAL", "Encontrados");
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
	define("LANG_PAGING_GOTOPAGE", "Ir para página");
	//Select
	define("LANG_PAGING_ORDERBYPAGE_SELECT", "Selecione");
	//Order by
	define("LANG_PAGING_ORDERBYPAGE", "Ordenação por");
	//Characters
	define("LANG_PAGING_ORDERBYPAGE_CHARACTERS", "Caracteres");
    //Alphabetically
    define("LANG_PAGING_ORDERBYPAGE_ALPHABETICALLY", "Alfabeticamente");
	//Last update
	define("LANG_PAGING_ORDERBYPAGE_LASTUPDATE", "Atualização");
	//Date created
	define("LANG_PAGING_ORDERBYPAGE_DATECREATED", "Data de Criação");
	//Popular
	define("LANG_PAGING_ORDERBYPAGE_POPULAR", "Popular");
	//Rating
	define("LANG_PAGING_ORDERBYPAGE_RATING", "Avaliação");
	//Price
	define("LANG_PAGING_ORDERBYPAGE_PRICE", "Preço");
	//Start Date
	define("LANG_PAGING_ORDERBYPAGE_STARTDATE", LANG_LABEL_START_DATE);
	//previous page
	define("LANG_PAGING_PREVIOUSPAGE", "página anterior");
	//next page
	define("LANG_PAGING_NEXTPAGE", "próxima página");
	//"previous" page
	define("LANG_PAGING_PREVIOUSPAGEMOBILE", "anterior");
	//"next" page
	define("LANG_PAGING_NEXTPAGEMOBILE", "próxima");
	//view full listing
	define("LANG_VIEW_LISTING", "ver empresa");
	//view full article
	define("LANG_VIEW_ARTICLE", "ver artigo");
	//Go to Website
	define("LANG_GO_TO_WEBSITE", "Ir para o Site");
	//Article successfully added!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_ADDED", "Artigo adicionado com sucesso!");
	//Banner successfully added!
	define("LANG_MSG_BANNER_SUCCESSFULLY_ADDED", "Banner adicionado com sucesso!");
	//Classified successfully added!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_ADDED", "Classificado adicionado com sucesso!");
	//Event successfully added!
	define("LANG_MSG_EVENT_SUCCESSFULLY_ADDED", "Evento adicionado com sucesso!");
	//Listing successfully added!
	define("LANG_MSG_LISTING_SUCCESSFULLY_ADDED", "Empresa adicionada com sucesso!");
	//Deal successfully added!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_ADDED", "Oferta adicionada com sucesso!");
	//Article successfully updated!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_UPDATED", "Artigo atualizado com sucesso!");
	//Banner successfully updated!
	define("LANG_MSG_BANNER_SUCCESSFULLY_UPDATED", "Banner atualizado com sucesso!");
	//Classified successfully updated!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_UPDATED", "Classificado atualizado com sucesso!");
	//Event successfully updated!
	define("LANG_MSG_EVENT_SUCCESSFULLY_UPDATED", "Evento atualizado com sucesso!");
	//Listing successfully updated!
	define("LANG_MSG_LISTING_SUCCESSFULLY_UPDATED", "Empresa atualizada com sucesso!");
	//Deal successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATED", "Oferta atualizada com sucesso!");
	//Map Tuning successfully updated!
	define("LANG_MSG_MAPTUNING_SUCCESSFULLY_UPDATED", "Ajuste de Localização atualizado com sucesso!");
	//Deal was successfully deleted!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_DELETED", "Oferta removida com sucesso!");
	//Deal successfully changed!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_CHANGED", "Oferta alterada com sucesso!");
	//Banner successfully deleted!
	define("LANG_MSG_BANNER_SUCCESSFULLY_DELETED", "Banner removido com sucesso!");
	//Invalid image type. Please insert a JPG, GIF or PNG image.
	define("LANG_MSG_INVALID_IMAGE_TYPE", "Tipo de imagem inválida. Por favor, insira uma imagem JPG, GIF ou PNG.");
	//Invalid file type. Please insert a SWF, GIF, JPEG or PNG file.
	define("LANG_MSG_INVALID_FILE_TYPE", "Tipo de arquivo inválido. Por favor, insira um arquivo SWF, GIF, JPEG ou PNG.");
	//The image file is too large
	define("LANG_MSG_IMAGE_FILE_TOO_LARGE", "O arquivo de imagem é muito grande.");
	//Please try again with another image
	define("LANG_PLEASE_TRY_AGAIN_WITH_ANOTHER_IMAGE", "Por favor tente novamente com uma outra imagem.");
	//Attached file was denied. Invalid file type.
	define("LANG_MSG_ATTACHED_FILE_DENIED", "Arquivo anexado negado. Tipo de arquivo inválido.");
	//Please type your username.
	define("LANG_MSG_TYPE_USERNAME", "Por favor, digite seu e-mail.");
	//Username was not found.
	define("LANG_MSG_USERNAME_WAS_NOT_FOUND", "E-mail não encontrado.");
	//Please try again or contact support at:
	define("LANG_MSG_TRY_AGAIN_OR_CONTACT_SUPPORT", "Por favor, tente novamente ou entre em contato com o suporte:");
	//System Forgotten Password is disabled.
	define("LANG_MSG_FORGOTTEN_PASSWORD_DISABLED", "Sistema de Recuperação de Senha está desabilitado.");
	//Please contact support at:
	define("LANG_MSG_CONTACT_SUPPORT", "Por favor, entre em contato com o suporte:");
	//Thank you!
	define("LANG_MSG_THANK_YOU", "Obrigado!");
	//An e-mail was sent to the account holder with instructions to obtain a new password
	define("LANG_MSG_EMAIL_WAS_SENT_TO_ACCOUNT_HOLDER", "Um e-mail foi enviado para o proprietário da conta com instruções para obter uma nova senha");
	//File not found!
	define("LANG_MSG_FILE_NOT_FOUND", "Arquivo não encontrado!");
	//Click here to print the invoice
	define("LANG_MSG_CLICK_TO_PRINT_INVOICE", "Clique aqui para imprimir a fatura");
	//Click here to view the invoice detail
	define("LANG_MSG_CLICK_TO_VIEW_INVOICE_DETAIL", "Clique aqui para ver os detalhes da fatura");
	//(prices amount are per installments)
	define("LANG_MSG_PRICES_AMOUNT_PER_INSTALLMENTS", "(o preço total é por prestações)");
	//Unpaid Item
	define("LANG_MSG_UNPAID_ITEM", "Item Pendente");
	//No Check Out Needed
	define("LANG_MSG_NO_CHECKOUT_NEEDED", "Nenhum pagamento necessário");
	//(Move the mouse over the bars to see more details about the graphic)
	define("LANG_MSG_MOVE_MOUSEOVER_THE_BARS", "(Coloque o mouse sobre as barras para ver mais detalhes sobre o gráfico)");
	//(Click the report type to display graph)
	define("LANG_MSG_CLICK_REPORT_TYPE", "(Clique no tipo de relatório para exibir o gráfico)");
	//Click here to view this review
	define("LANG_MSG_CLICK_TO_VIEW_THIS_REVIEW", "Clique aqui para visualizar esta avaliação");
	//Click here to edit this review
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REVIEW", "Clique aqui para editar esta avaliação");
	//Click here to edit this reply
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REPLY", "Clique aqui para editar esta resposta");
	//Click here to delete this review
	define("LANG_MSG_CLICK_TO_DELETE_THIS_REVIEW", "Clique aqui para remover esta avaliação");
	//Waiting Site Manager approve
	define("LANG_MSG_WAITINGSITEMGRAPPROVE", "Esperando Aprovação do Administrador");
	//Waiting Site Manager approve for Review
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW", "Avaliação esperando Aprovação do Administrador");
	//Waiting Site Manager approve for Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REPLY", "Resposta esperando Aprovação do Administrador");
	//Waiting Site Manager approve for Review Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW_REPLY", "Avaliação e Resposta esperando Aprovação do Administrador");
	//Review already approved
	define("LANG_MSG_REVIEW_ALREADY_APPROVED", "Avaliação já Aprovada");
	//Review and Reply already approved
	define("LANG_MSG_REVIEWANDREPLY_ALREADY_APPROVED", "Avaliação e Resposta já Aprovadas");
	//Review pending approval
	define("LANG_REVIEW_PENDINGAPPROVAL", "Avaliação Pendente");
	//Reply pending approval
	define("LANG_REPLY_PENDINGAPPROVAL", "Resposta Pendente");
	//Review active
	define("LANG_REVIEW_ACTIVE", "Avaliação Ativa");
	//Reply active
	define("LANG_REPLY_ACTIVE", "Resposta Ativa");
	//Review and Reply pending approval
	define("LANG_REVIEWANDREPLY_PENDINGAPPROVAL", "Avaliação e Resposta Pendentes");
	//Review and Reply active
	define("LANG_REVIEWANDREPLY_ACTIVE", "Avaliação e Resposta Ativas");
	//Reply
	define("LANG_REPLY", "Responder");
	//Reply (noun)
	define("LANG_REPLYNOUN", "Resposta");
	//Review and Reply
	define("LANG_REVIEWANDREPLY", "Avaliação e Resposta");
	//Edit Review
	define("LANG_LABEL_EDIT_REVIEW", "Editar Avaliação");
	//Edit Reply
	define("LANG_LABEL_EDIT_REPLY", "Editar Resposta");
	//Approve Review
	define("LANG_SITEMGR_APPROVE_REVIEW", "Aprovar Avaliação");
	//Approve Reply
	define("LANG_SITEMGR_APPROVE_REPLY", "Aprovar Resposta");
	//Reply already approved
	define("LANG_MSG_RESPONSE_ALREADY_APPROVED", "Resposta já Aprovada");
	//Review successfully sent!
	define("LANG_REVIEW_SUCCESSFULLY", "Avaliação atualizada com sucesso!");
	//Reply successfully sent!
	define("LANG_REPLY_SUCCESSFULLY", "Resposta enviada com sucesso!");
	//Please type a valid reply!
	define("LANG_REPLY_EMPTY", "Por favor, escreva uma resposta válida!");
	//Please type a valid name
	define("LANG_REVIEW_EMPTY_NAME", "Por favor, escreva um nome válido!");
	//Please type a valid e-mail
	define("LANG_REVIEW_EMPTY_EMAIL", "Por favor, escreva um e-mail válido!");
	//Please type a valid city, State
	define("LANG_REVIEW_EMPTY_LOCATION", "Por favor, escreva uma cidade, estado válido!");
	//Please type a valid review title
	define("LANG_REVIEW_EMPTY_TITLE", "Por favor, escreva um título válido!");
	//Please type a valid review!
	define("LANG_REVIEW_EMPTY", "Por favor, escreva uma avaliação válida!");
	//Please choose an option or click in cancel to exit.
	define("LANG_STATUS_EMPTY", "Por favor, escolha uma opção ou clique em cancelar para sair.");
	//Click here to reply this review
	define("LANG_MSG_REVIEW_REPLY", "Clique aqui para responder esta avaliação");
	//Click here to view the transaction
	define("LANG_MSG_CLICK_TO_VIEW_TRANSACTION", "Clique aqui para ver a transação");
	//Username must be between
	define("LANG_MSG_USERNAME_MUST_BE_BETWEEN", "E-mail deve ter entre");
	//characters with no spaces.
	define("LANG_MSG_CHARACTERS_WITH_NO_SPACES", "caracteres sem espaços.");
	//Password must be between
	define("LANG_MSG_PASSWORD_MUST_BE_BETWEEN", "A senha deve ter entre");
	//Type you password here if you want to change it.
	define("LANG_MSG_TIPE_YOUR_PASSWORD_HERE_IF_YOU_WANT_TO_CHANGE_IT", "Digite sua senha se você deseja alterá-la.");
	//Password is going to be sent to Member E-mail Address.
	define("LANG_MSG_PASSWORD_SENT_TO_MEMBER_EMAIL", "A senha será enviada para o E-mail do Sócio.");
	//Please write down your username and password for future reference.
	define("LANG_MSG_WRITE_DOWN_YOUR_USERNAME_PASSWORD", "Por favor, anote o seu e-mail e senha para futura referência.");
	//Please check the agreement terms.
	define("LANG_MSG_ALERT_AGREE_WITH_TERMS_OF_USE", "Por favor, aceite os termos de uso.");
	//successfully added
	define("LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED", "Adicionada com sucesso!");
	//This category was already inserted
	define("LANG_MSG_CATEGORY_ALREADY_INSERTED", "Esta categoria já foi adicionada");
	//Please, select a valid category
	define("LANG_MSG_SELECT_VALID_CATEGORY", "Por favor, selecione uma categoria válida");
	//Please, select a category first
	define("LANG_MSG_SELECT_CATEGORY_FIRST", "Por favor, selecione uma categoria primeiro");
	//You can choose a page name title to be accessed directly from the web browser as a static html page. The chosen page name title must contain only alphanumeric chars (like "a-z" and/or "0-9") and "-" instead of spaces.
	define("LANG_MSG_FRIENDLY_URL1", "Você pode escolher um nome para a página ser acessada diretamente do navegador como uma página HTML estática. O nome escolhido para a página deve conter somente caracteres alfanuméricos (como \"a-z\" e/ou \"0-9\") e \"-\" ao invés de espaços.");
	//The page name title "John Auto Repair" will be available through the url:
	define("LANG_MSG_FRIENDLY_URL2", "O nome \"John Auto Repair\" estará disponível através da url:");
	//Maximum file size
	define("LANG_MSG_MAX_FILE_SIZE", "Tamanho máximo do arquivo");
	//Transparent .gif or .png not supported
	define("LANG_MSG_TRANSPARENTGIF_NOT_SUPPORTED", "Imagens .gif ou .png transparentes não são suportadas");
	//Animated .gif isn't supported.
	define("LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED", "Gif animado não é suportado.");
	//Please be sure that your image dimensions fit within the recommended pixel sizes, otherwise, image quality can be effected.
	define("LANG_MSG_IMAGE_DIMENSIONS_ALERT", "Por favor, certifique-se que as dimensões de sua imagem se adaptem com as dimensões dos pixels recomendadas, caso contrário a qualidade da imagem pode ser afetada.");
	//Check this box to remove your existing image
	define("LANG_MSG_CHECK_TO_REMOVE_IMAGE", "Marque esta caixa para remover a imagem existente");
	//maximum 250 characters
	define("LANG_MSG_MAX_250_CHARS", "max 250 caracteres");
	//maximum 100 characters
	define("LANG_MSG_MAX_100_CHARS", "max 100 caracteres");
	//characters left
	define("LANG_MSG_CHARS_LEFT", "caracteres restantes");
	//(including spaces and line breaks)
	define("LANG_MSG_INCLUDING_SPACES_LINE_BREAKS", "(incluindo espaços e quebras de linha)");
	//Include up to
	define("LANG_MSG_INCLUDE_UP_TO_KEYWORDS", "Adicione até");
	//keywords with a maximum of 50 characters each.
	define("LANG_MSG_KEYWORDS_WITH_MAXIMUM_50", "palavras-chave com no máximo 50 caracteres cada.");
	//Add one keyword or keyword phrase per line.
	define("LANG_MSG_KEYWORD_PER_LINE", "Adicionar uma palavra-chave ou frase por linha.");
	//Only select sub-categories that directly apply to your type.
	define("LANG_MSG_ONLY_SELECT_SUBCATEGS", "Selecione somente subcategorias que se enquadram diretamente em seu tipo.");
	//Your article will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_ARTICLE_AUTOMATICALLY_APPEAR", "Seu artigo aparecerá automaticamente na categoria principal de cada subcategoria que você selecionar.");
	//maximum 25 characters
	define("LANG_MSG_MAX_25_CHARS", "max 25 caracteres");
	//maximum 500 characters
	define("LANG_MSG_MAX_500_CHARS", "max 500 caracteres");
	//Allowed file types
	define("LANG_MSG_ALLOWED_FILE_TYPES", "Tipos de arquivo permitidos");
	//Click here to preview this listing
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_LISTING", "Clique aqui para visualizar esta empresa");
	//Click here to preview this event
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_EVENT", "Clique aqui para visualizar este evento");
	//Click here to preview this classified
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_CLASSIFIED", "Clique aqui para visualizar este classificado");
	//Click here to preview this article
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_ARTICLE", "Clique aqui para visualizar este artigo");
	//Click here to preview this banner
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_BANNER", "Clique aqui para visualizar este banner");
	//Click here to preview this deal
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_PROMOTION", "Clique aqui para visualizar esta oferta");
	//maximum 30 characters
	define("LANG_MSG_MAX_30_CHARS", "max 30 caracteres");
	//Select a Country
	define("LANG_MSG_SELECT_A_COUNTRY", "Selecione um País");
	//Select a Region
	define("LANG_MSG_SELECT_A_REGION", "Selecione uma Região");
	//Select a State
	define("LANG_MSG_SELECT_A_STATE", "Selecione um Estado");
	//Select a City
	define("LANG_MSG_SELECT_A_CITY", "Selecione uma Cidade");
	//Select a Neighborhood
	define("LANG_MSG_SELECT_A_NEIGHBORHOOD", "Selecione um Bairro");
	//(This information will not be displayed publicly)
	define("LANG_MSG_INFO_NOT_DISPLAYED", "(Estas informações não serão divulgadas)");
	//Your event will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_EVENT_AUTOMATICALLY_APPEAR", "Seu evento aparecerá automaticamente na categoria principal de cada subcategoria que você selecionar.");
	//If video snippet code was filled in, it will appear on the detail page
	define("LANG_MSG_VIDEO_SNIPPET_CODE", "Se o código do vídeo for preenchido, ele aparecerá na página de detalhe");
	//Maximum video code size supported
	define("LANG_MSG_MAX_VIDEO_CODE_SIZE", "Tamanho máximo suportado do código do vídeo");
	//If the video code size is bigger than supported video size, it will be modified.
	define("LANG_MSG_VIDEO_MODIFIED", "Se o tamanho do código do vídeo for maior que o suportado, ele será modificado.");
	//Attachment has no caption
	define("LANG_MSG_ATTACHMENT_HAS_NO_CAPTION", "Anexo não tem legenda");
	//Check this box to remove existing listing attachment
	define("LANG_MSG_CLICK_TO_REMOVE_ATTACHMENT", "Marque esta caixa para remover o anexo existente");
	//Add one phrase per line.
	define("LANG_MSG_PHRASE_PER_LINE", "Adicionar uma frase por linha.");
	//Extra categories cost an
	define("LANG_MSG_EXTRA_CATEGORIES_COST", "Categorias extras terão um custo");
	//additional
	define("LANG_MSG_ADDITIONAL", "adicional de");
	//each. Be seen!
	define("LANG_MSG_BE_SEEN", "cada.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_LISTING_AUTOMATICALLY_APPEAR", "Sua empresa aparecerá automaticamente na categoria principal de cada subcategoria que você selecionar.");
	//If you add new categories, your listing will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_LISTING_TEMPORARY_CATEGORY", "Se você adicionar novas categorias, sua empresa não aparecerá na categoria principal das subcategorias adicionadas até que o administrador do site as aprove.");
	//If you add new categories, your article will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_ARTICLE_TEMPORARY_CATEGORY", "Se você adicionar novas categorias, seu artigo não aparecerá na categoria principal das subcategorias adicionadas até que o administrador do site as aprove.");
	//If you add new categories, your classified will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_CLASSIFIED_TEMPORARY_CATEGORY", "Se você adicionar novas categorias, seu classificado não aparecerá na categoria principal das subcategorias adicionadas até que o administrador do site as aprove.");
	//If you add new categories, your event will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_EVENT_TEMPORARY_CATEGORY", "Se você adicionar novas categorias, seu evento não aparecerá na categoria principal das subcategorias adicionadas até que o administrador do site as aprove.");
	//Request your listing to be considered for the following badges.
	define("LANG_MSG_REQUEST_YOUR_LISTING", "Solicite que sua empresa seja inserida nas classificações seguintes.");
	//Click here to select date
	define("LANG_MSG_CLICK_TO_SELECT_DATE", "Clique aqui para selecionar uma data");
	//"Click on the" deal icon below if you wish to add deal to your listing.
	define("LANG_LISTING_CLICK_PROMOTION_BELOW", "Clique no");
	//Click on the "deal icon" below if you wish to add deal to your listing.
	define("LANG_LISTING_PROMOTION_ICON", "ícone de Oferta");
	//Click on the deal icon "below if you wish to add deal to your listing."
	define("LANG_LISTING_IFYOUWISHADDPROMOTION", "abaixo se você deseja adicionar Ofertas à sua empresa.");
	//You can add deal to your listing by clicking on the link
	define("LANG_LISTING_YOUCANADDPROMOTION", "Você pode adicionar ofertas à sua empresa clicando no link");
	//add deal
	define("LANG_LISTING_ADDPROMOTION", "adicionar oferta");
	//All pages but item pages
	define("LANG_ALLPAGESBUTITEMPAGES", "Todas as páginas exceto as páginas dos items");
	//All pages
	define("LANG_ALLPAGES", "Todas as páginas");
    //All
	define("LANG_ALL", "Todas");
	//Non-category search
	define("LANG_NONCATEGORYSEARCH", "Busca sem categoria");
	//deal
	define("LANG_ICONPROMOTION", "oferta");
	//e-mail to friend
	define("LANG_ICONEMAILTOFRIEND", "indique");
	//Add to Favorites
	define("LANG_ICONQUICKLIST_ADD", "Adicionar aos Favoritos");
	//remove from favorites
	define("LANG_ICONQUICKLIST_REMOVE", "remover dos favoritos");
	//print
	define("LANG_ICONPRINT", "imprimir");
	//map
	define("LANG_ICONMAP", "mapa");
	//Add to
	define("LANG_ADDTO_SOCIALBOOKMARKING", "Adicionar ao");
	//Google maps are not available. Please contact the administrator.
	define("LANG_GOOGLEMAPS_NOTAVAILABLE_CONTACTADM", "Google maps não está disponível. Entre em contato com o administrador.");
	//Remove
	define("LANG_QUICKLIST_REMOVE", "Remover");
	//Favorite Articles
	define("LANG_FAVORITE_ARTICLE", "Artigos Favoritos");
	//Favorite Classifieds
	define("LANG_FAVORITE_CLASSIFIED", "Classificados Favoritos");
	//Favorite Events
	define("LANG_FAVORITE_EVENT", "Eventos Favoritos");
	//Favorite Listings
	define("LANG_FAVORITE_LISTING", "Empresas Favoritas");
	//Favorite Deals
	define("LANG_FAVORITE_PROMOTION", "Ofertas Favoritas");
	//Published
	define("LANG_ARTICLE_PUBLISHED", "Publicado em");
	//More Info
	define("LANG_CLASSIFIED_MOREINFO", "Mais Informações");
	//Date
	define("LANG_EVENT_DATE", "Data");
	//Time
	define("LANG_EVENT_TIME", "Hora");
	//Get driving directions
	define("LANG_EVENT_DRIVINGDIRECTIONS", "Como chegar");
	//Website
	define("LANG_EVENT_WEBSITE", "Website");
	//phone
	define("LANG_EVENT_LETTERPHONE", "Fone");
	//More
	define("LANG_EVENT_MORE", "Mais");
	//More Info
	define("LANG_EVENT_MOREINFO", "Mais Informações");
	//See all categories
	define("LANG_SEEALLCATEGORIES", "Veja todas as categorias");
	//View all listing categories
	define("LANG_LISTING_VIEWALLCATEGORIES", "Ver todas as categorias");
	//More Info
	define("LANG_LISTING_MOREINFO", "Mais Informações");
	//view phone
	define("LANG_LISTING_VIEWPHONE", "ver fone");
	//view fax
	define("LANG_LISTING_VIEWFAX", "ver fax");
	//Send Email
	define("LANG_SEND_AN_EMAIL", "Envie um E-mail");
	//Click here to see more info!
	define("LANG_LISTING_ATTACHMENT", "Clique aqui para ver mais informações!");
	//Download [item] Menu
	define("LANG_LISTING_DOWNLOADMENU", "Baixar o Cardápio de [item]");
	//Complete the form below to contact us.
	define("LANG_LISTING_CONTACTTITLE", "Preencha o formulário abaixo para entrar em contato conosco.");
	//Contact this Listing
	define("LANG_LISTING_CONTACT", "Entre em Contato");
	//E-mail an inquiry
	define("LANG_LISTING_INQUIRY", "Enviar pergunta");
	//phone
	define("LANG_LISTING_LETTERPHONE", "fone");
	//fax
	define("LANG_LISTING_LETTERFAX", "fax");
	//website
	define("LANG_LISTING_LETTERWEBSITE", "website");
	//e-mail
	define("LANG_LISTING_LETTEREMAIL", "e-mail");
	//offers the following products and/or services:
	define("LANG_LISTING_OFFERS", "oferece os seguintes produtos e/ou serviços:");
	//Hours
	define("LANG_LISTING_HOURS_OF_WORK", "Horário de funcionamento");
	//Check in
	define("LANG_CHECK_IN", "Check in");
	//No review comment found for this item!
	define("LANG_REVIEW_NORECORD", "Nenhuma avaliação encontrada para este item!");
	//Reviews and comments from the last month
	define("LANG_REVIEWS_MONTH", "Avaliações e comentários do último mês");
	//Review
	define("LANG_REVIEW", "Avaliação");
	//Reviews
	define("LANG_REVIEW_PLURAL", "Avaliações");
	//Reviews
	define("LANG_REVIEWTITLE", "Avaliações");
	//review
	define("LANG_REVIEWCOUNT", "avaliação");
	//reviews
	define("LANG_REVIEWCOUNT_PLURAL", "avaliações");
	//Check In
	define("LANG_CHECKINCOUNT", "Check In");
	//Check ins
	define("LANG_CHECKINCOUNT_PLURAL", "Check ins");
	//See check ins
	define("LANG_CHECKINSEECOMMENTS", "Ver check ins");
	//Check ins of
	define("LANG_CHECKINSOF", "Check ins de");
	//No check in found for this item!
	define("LANG_CHECKIN_NORECORD", "Nenhum check in encontrado para este item!");
	//Related Categories
	define("LANG_RELATEDCATEGORIES", "Categorias Relacionadas");
	//Related Listings
	define("LANG_RELATEDLISTINGS", "Empresas Relacionadas");
	//Subcategories
	define("LANG_LISTING_SUBCATEGORIES", "Subcategorias");
	//See comments
	define("LANG_REVIEWSEECOMMENTS", "Ver avaliações");
    //Pending Reviews
    define("LANG_REVIEW_PENDING", "Avaliações Pendentes");
    //Approve
    define("LANG_REVIEW_APPROVE", "Aprovar");
	//Rate It!
	define("LANG_REVIEWRATEIT", "Dê sua nota!");
	//Be the first to review this item!
	define("LANG_REVIEWBETHEFIRST", "Seja o primeiro a avaliar!");
	//Offered by
	define("LANG_PROMOTION_OFFEREDBY", "oferecida por");
	//More Info
	define("LANG_PROMOTION_MOREINFO", "Mais Informações");
	//Valid from
	define("LANG_PROMOTION_VALIDFROM", "Válido de");
	//to
	define("LANG_PROMOTION_VALIDTO", "até");
	//Print Deal
	define("LANG_PROMOTION_PRINT", "Imprimir");
	//Article
	define("LANG_ARTICLE_FEATURE_NAME", "Artigo");
	//Articles
	define("LANG_ARTICLE_FEATURE_NAME_PLURAL", "Artigos");
	//Blog
	define("LANG_BLOG_FEATURE_NAME", "Blog");
	//Banner
	define("LANG_BANNER_FEATURE_NAME", "Banner");
	//Banners
	define("LANG_BANNER_FEATURE_NAME_PLURAL", "Banners");
	//Classified
	define("LANG_CLASSIFIED_FEATURE_NAME", "Classificado");
	//Classifieds
	define("LANG_CLASSIFIED_FEATURE_NAME_PLURAL", "Classificados");
	//Event
	define("LANG_EVENT_FEATURE_NAME", "Evento");
	//Events
	define("LANG_EVENT_FEATURE_NAME_PLURAL", "Eventos");
	//Listing
	define("LANG_LISTING_FEATURE_NAME", "Empresa");
	//Listings
	define("LANG_LISTING_FEATURE_NAME_PLURAL", "Empresas");
	//Deal
	define("LANG_PROMOTION_FEATURE_NAME", "Oferta");
	//Deals
	define("LANG_PROMOTION_FEATURE_NAME_PLURAL", "Ofertas");
	//Send
	define("LANG_BUTTON_SEND", "Enviar");
	//Sign Up
	define("LANG_BUTTON_SIGNUP", "Cadastre-se");
	//View Category Path
	define("LANG_BUTTON_VIEWCATEGORYPATH", "Ver o Caminho da Categoria");
	//More info
	define("LANG_VIEWCATEGORY", "Mais informações");
	//No info found
	define("LANG_NOINFO", "Nenhuma informação encontrada");
	//Remove Selected Category
	define("LANG_BUTTON_REMOVESELECTEDCATEGORY", "Remover a Categoria");
	//Continue
	define("LANG_BUTTON_CONTINUE", "Avançar");
	//No, thank you
	define("LANG_BUTTON_NO_THANKS", "Não, obrigado");
	//Yes, continue
	define("LANG_BUTTON_YES_CONTINUE", "Sim, continue.");
	//No, Order without the Package!
	define("LANG_BUTTON_NO_ORDER_WITHOUT", "Não, Comprar sem o Pacote.");
	//Increase your Visibility!
	define("LANG_INCREASE_VISIBILITY", "Aumente a sua visibilidade!");
	//Gift
	define("LANG_GIFT", "Brinde");
	//Help to Increase your visibility, check our
	define("LANG_HELP_INCREASE", "Ajude a Aumentar sua visibilidade, veja as ");
	//Site statistics
	define("LANG_DOMAIN_STATISTICS", "estatísticas do Site!");
	//Visitors per Month
	define("LANG_VISITOR_MONTH", "Visitantes por Mês");
	//Custom option
	define("LANG_CUSTOM_OPTION", "Opção personalizada");
	//Ok
	define("LANG_BUTTON_OK", "Ok");
	//Cancel
	define("LANG_BUTTON_CANCEL", "Cancelar");
	//Log in
	define("LANG_BUTTON_LOGIN", "Entre");
	//Save Map Tuning
	define("LANG_BUTTON_SAVE_MAP_TUNING", "Salvar ajuste");
	//Clear Map Tuning
	define("LANG_BUTTON_CLEAR_MAP_TUNING", "Limpar ajuste");
	//Next
	define("LANG_BUTTON_NEXT", "Próximo");
	//Pay By CreditCard
	define("LANG_BUTTON_PAY_BY_CREDIT_CARD", "Pagar por Cartão de Crédito");
	//Pay By PayPal
	define("LANG_BUTTON_PAY_BY_PAYPAL", "Pagar por PayPal");
	//Pay By SimplePay
	define("LANG_BUTTON_PAY_BY_SIMPLEPAY", "Pagar por SimplePay");
	//Search
	define("LANG_BUTTON_SEARCH", "Buscar");
	//Advanced
	define("LANG_BUTTON_ADVANCEDSEARCH", "Avançada");
	//Close
	define("LANG_BUTTON_ADVANCEDSEARCH_CLOSE", "Fechar");
	//Clear
	define("LANG_BUTTON_CLEAR", "Limpar");
	//Add your Article
	define("LANG_BUTTON_ADDARTICLE", "Adicione seu Artigo");
	//Add your Classified
	define("LANG_BUTTON_ADDCLASSIFIED", "Adicione seu Classificado");
	//Add your Event
	define("LANG_BUTTON_ADDEVENT", "Adicione seu Evento");
	//Add your Listing
	define("LANG_BUTTON_ADDLISTING", "Adicione sua Empresa");
	//Add your Deal
	define("LANG_BUTTON_ADDPROMOTION", "Adicione sua Oferta");
	//Home
	define("LANG_BUTTON_HOME", "Home");
	//Manage Account
	define("LANG_BUTTON_MANAGE_ACCOUNT", "Gerenciar Conta");
	//Manage Content
	define("LANG_MANAGE_CONTENT", "Gerenciar Conteúdo");
	//Sponsor
	define("LANG_SPONSOR_AREA", "Anunciante");
	//Site Manager
	define("LANG_SITEMGR_AREA", "Administração");
	//Site Manager Section
	define("LANG_LABEL_SITEMGR_SECTION", "Seção Administrativa");
	//Help
	define("LANG_BUTTON_HELP", "Ajuda");
	//Sign out
	define("LANG_BUTTON_LOGOUT", "Sair");
	//Submit
	define("LANG_BUTTON_SUBMIT", "Enviar");
	//Update
	define("LANG_BUTTON_UPDATE", "Atualizar");
	//Back
	define("LANG_BUTTON_BACK", "Voltar");
	//Delete
	define("LANG_BUTTON_DELETE", "Remover");
	//Complete the Process
	define("LANG_BUTTON_COMPLETE_THE_PROCESS", "Completar o Processo");
	//Please enter the text you see in the image at the left into the textbox. This is required to prevent automated submission of contact requests.
	define("LANG_CAPTCHA_HELP", "Por favor, digite o código que está na imagem. Este campo é obrigatório para evitar o envio automático de e-mails.");
	//Verification Code image cannot be displayed
	define("LANG_CAPTCHA_ALT", "Código de Verificação não pôde ser mostrado");
	//Verification Code
	define("LANG_CAPTCHA_TITLE", "Código de Verificação");
	//Please select a rating for this item
	define("LANG_MSG_REVIEW_SELECTRATING", "Por favor, selecione uma nota para este item");
	//Fraud detected! Please select a rating for this item!
	define("LANG_MSG_REVIEW_FRAUD_SELECTRATING", "Fraude detectada! Por favor, selecione uma nota para este item!");
	//"Comment" and "Comment Title" are required to post a comment!
	define("LANG_MSG_REVIEW_COMMENTREQUIRED", "\"Comentário\" e \"Título\" são obrigatórios para enviar um comentário!");
	//"Name" and "E-mail" are required to post a comment!
	define("LANG_MSG_REVIEW_NAMEEMAILREQUIRED", "\"Nome\" e \"E-mail\" são obrigatórios para enviar um comentário!");
	//"City, State" are required to post a comment!
	define("LANG_MSG_REVIEW_CITYSTATEREQUIRED", "\"Cidade, Estado\" são obrigatórios para enviar um comentário!");
	//Please type a valid e-mail address!
	define("LANG_MSG_REVIEW_TYPEVALIDEMAIL", "Por favor, digite um e-mail válido!");
	//You have already given your opinion on this item. Thank you.
	define("LANG_MSG_REVIEW_YOUALREADYGIVENOPINION", "Você já deu sua opnião para este item. Obrigado.");
	//Thanks for the feedback!
	define("LANG_MSG_REVIEW_THANKSFEEDBACK", "Obrigado!");
	//Your review has been submitted for approval.
	define("LANG_MSG_REVIEW_REVIEWSUBMITTEDAPPROVAL", "Sua avaliação foi enviada para aprovação.");
	//No payment method was selected!
	define("LANG_MSG_NO_PAYMENT_METHOD_SELECTED", "Nenhum método de pagamento foi selecionado!");
	//Wrong credit card expiration date. Please, try again.
	define("LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN", "Data de expiração do cartão errada. Por favor, tente novamente.");
	//Click here to try again
	define("LANG_MSG_CLICK_HERE_TO_TRY_AGAIN", "Clique aqui para tentar novamente");
	//Payment transactions may not occur immediately.
	define("LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY", "As transações podem não ocorrer imediatamente.");
	//After your payment is processed, information about your transaction
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT", "Depois que seu pagamento for processado, informações sobre sua transação");
	//may be found in your transaction history.
	define("LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY", "podem ser encontradas em seu histórico de transações.");
	//"may be found in your" transaction history
	define("LANG_MSG_MAY_BE_FOUND_IN_YOUR", "podem ser encontradas em");
	//The payment gateway is not available currently
	define("LANG_MSG_PAYMENT_GATEWAY_NOT_AVAILABLE", "O sistema de pagamento não está disponível no momento");
	//The payment parameters could not be validated
	define("LANG_MSG_PAYMENT_INVALID_PARAMS", "Os parâmetros de pagamento não puderam ser validados");
	//Internal gateway error was encountered
	define("LANG_MSG_INTERNAL_GATEWAY_ERROR", "Foi encontrado um erro interno no pagamento");
	//Information about your transaction may be found
	define("LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND", "Informações sobre sua transação podem ser encontradas");
	//in your transaction history.
	define("LANG_MSG_IN_YOUR_TRANSACTION_HISTORY", "em seu histórico de transação.");
	//in your
	define("LANG_MSG_IN_YOUR", "em seu");
	//No Transaction ID
	define("LANG_MSG_NO_TRANSACTION_ID", "não há ID da Transação");
	//System failure, please try again.
	define("LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN", "Falha no sistema, por favor, tente novamente.");
	//Please, fill in all required fields.
	define("LANG_MSG_FILL_ALL_REQUIRED_FIELDS", "Por favor, preencha todos os campos obrigatórios.");
	//Could not connect.
	define("LANG_MSG_COULD_NOT_CONNECT", "não foi possível conectar.");
	//Thank you for setting up your items and for making the payment!
	define("LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT", "Obrigado por adicionar seus itens e fazer o pagamento!");
	//Site manager will review your items and set it live within 2 working days.
	define("LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS", "O administrador revisará seus itens e os colocará no ar dentro 2 dias úteis.");
	//The payment gateway could not respond
	define("LANG_MSG_PAYMENT_GATEWAY_COULD_NOT_RESPOND", "O sistema de pagamento não pôde responder");
	//Pending payments may take 3 to 4 days to be approved.
	define("LANG_MSG_PENDING_PAYMENTS_TAKE_3_4_DAYS_TO_BE_APPROVED", "Pagamentos pendentes podem levar de 3 a 4 dias para serem aprovados.");
	//Connection Failure
	define("LANG_MSG_CONNECTION_FAILURE", "Falha na Conexão");
	//Please, fill correctly zip.
	define("LANG_MSG_FILL_CORRECTLY_ZIP", "Por favor, preencha corretamente o CEP.");
	//Please, fill correctly card verification number.
	define("LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER", "Por favor, preencha corretamente o número de verificação do cartão.");
	//Card Type and Card Verification Number do not match.
	define("LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH", "Tipo de Cartão e Número de Verificação não coincidem.");
	//Transaction Not Completed.
	define("LANG_MSG_TRANSACTION_NOT_COMPLETED", "A Transação não foi completada.");
	//Error Number:
	define("LANG_MSG_ERROR_NUMBER", "Número do Erro:");
	//Short Message
	define("LANG_MSG_SHORT_MESSAGE", "Mensagem:");
	//Long Message
	define("LANG_MSG_LONG_MESSAGE", "Mensagem:");
	//Transaction Completed Successfully.
	define("LANG_MSG_TRANSACTION_COMPLETED_SUCCESSFULLY", "Transação Completada com Sucesso.");
	//Card expire date must be in the future
	define("LANG_MSG_CARD_EXPIRE_DATE_IN_FUTURE", "Data de expiração do cartão deve estar no futuro");
	//If your transaction was confirmed, information about it may be found in
	define("LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED", "Se a sua transação for confirmada, informações sobre ela poderão ser encontradas em");
	//your transaction history after your payment is processed.
	define("LANG_MSG_YOUR_TRANSACTION_AFTER_PAYMENT_PROCESSED", "seu histórico de transação depois que seu pagamento for processado.");
	//after your payment is processed.
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED", "depois que seu pagamento for processado.");
	//No items requiring payment.
	define("LANG_MSG_NO_ITEMS_REQUIRING_PAYMENT", "Nenhum item requerendo pagamento.");
	//Pay for outstanding invoices
	define("LANG_MSG_PAY_OUTSTANDING_INVOICES", "Pagar por serviços extras");
	//Banner by Impression and Custom Invoices can be paid once.
	define("LANG_MSG_BANNER_CUSTOM_INVOICE_PAID_ONCE", "Banners por visualização e Serviços Extras podem ser pagos somente uma vez.");
	//Banner by Impression can be paid once.
	define("LANG_MSG_BANNER_PAID_ONCE", "Banners por visualização podem ser pagos somente uma vez.");
	//Custom Invoices can be paid once.
	define("LANG_MSG_CUSTOM_INVOICE_PAID_ONCE", "Serviços Extras podem ser pagos somente uma vez.");
	//View Items
	define("LANG_VIEWITEMS", "Ver Itens");
	//Please do not use recurring payment system.
	define("LANG_MSG_PLEASE_DO_NOT_USE_RECURRING_PAYMENT_SYSTEM", "Por favor não utilize sistema de pagamento recorrente.");
	//Multiple Items
	define("LANG_ORDER_MULTIPLEITEMS", "Múltiplos Itens");
	//Try again!
	define("LANG_MSG_TRY_AGAIN", "Tente novamente!");
	//All fields are required.
	define("LANG_MSG_ALL_FIELDS_REQUIRED", "Todos os campos são obrigatórios.");
	//"You have more than" X items. Please contact the administrator to check out it.
	define("LANG_MSG_OVERITEM_MORETHAN", "Você tem mais do que");
	//You have more than X items. "Please contact the administrator to check out it".
	define("LANG_MSG_OVERITEM_CONTACTADMIN", "Por favor, entre em contato com o administrador para realizar o pagamento.");
	//Article Options
	define("LANG_ARTICLE_OPTIONS", "Opção de Artigo");
	//Article Author
	define("LANG_ARTICLE_AUTHOR", "Autor");
	//Article Author URL
	define("LANG_ARTICLE_AUTHOR_URL", "Website do autor");
	//Article Categories
	define("LANG_ARTICLE_CATEGORIES", "Categorias do Artigo");
	//Banner Type
	define("LANG_BANNER_TYPE", "Tipo de Banner");
	//Banner Options
	define("LANG_BANNER_OPTIONS", "Opções de Banner");
	//Order Banner
	define("LANG_ORDER_BANNER", "Expiração do Banner");
	//By time period
	define("LANG_BANNER_BY_TIME_PERIOD", "Por período de tempo");
	//Banner Details
	define("LANG_BANNER_DETAIL_PLURAL", "Detalhes do Banner");
	//Script Banner
	define("LANG_SCRIPT_BANNER", "Banner por Script");
	//Show by Script Code
	define("LANG_SHOWSCRIPTCODE", "Mostrar por Código");
	//Allow script to be entered instead of an image. This field allows you to paste in script that will be used to display the banner from an affiliate program or external banner system. If "Show by Script Code" is checked, just "Script" field will be required. The other fields below will not be necessary.
	define("LANG_SCRIPTCODEHELP", "Permite que um código seja inserido ao invés de uma imagem. Este campo permite que você cole um script que será utilizado para exibir o banner de um programa afiliado ou sistema externo de banner. Se \"Mostrar por Código\" estiver marcado, somente o campo \"Script\" será obrigatório. Os outros campos abaixo não serão necessários.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload script banners.
	define("LANG_SCRIPTCODEHELP2", "Ambos \"Url de Destino\" e \"Relatório de Tráfego - Website\" não terão efeito ao adicionar um banner por script.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload swf file
	define("LANG_BANNERFILEHELP", "Ambos \"Url de Destino\" e \"Relatório de Tráfego - Website\" não terão efeito se você fizer upload de um arquivo swf");
	//Classified Level
	define("LANG_CLASSIFIED_LEVEL", "Nível do Classificado");
	//Classified Category
	define("LANG_CLASSIFIED_CATEGORY", "Categoria do Classificado");
	//Select classified level
	define("LANG_MENU_SELECT_CLASSIFIED_LEVEL", "Selecionar nível do classificado");
	//Classified Options
	define("LANG_CLASSIFIED_OPTIONS", "Opções de Classificado");
	//Event Level
	define("LANG_EVENT_LEVEL", "Nível do Evento");
	//Event Categories
	define("LANG_EVENT_CATEGORY_PLURAL", "Categorias do Evento");
	//Event Categories
	define("LANG_EVENT_CATEGORIES", "Categorias do Evento");
	//Select event level
	define("LANG_MENU_SELECT_EVENT_LEVEL", "Selecionar nível do evento");
	//Event Options
	define("LANG_EVENT_OPTIONS", "Opções de Evento");
	//Listing Level
	define("LANG_LISTING_LEVEL", "Nível da Empresa");
	//Listing Type
	define("LANG_LISTING_TEMPLATE", "Tipo da Empresa");
	//Listing Categories
	define("LANG_LISTING_CATEGORIES", "Categorias da Empresa");
	//Listing Badges
	define("LANG_LISTING_DESIGNATION_PLURAL", "Classificações da Empresa");
	//Subject to administrator approval.
	define("LANG_LISTING_SUBJECTTOAPPROVAL", "Sujeito à aprovação do administrador.");
	//Select this choice
	define("LANG_LISTING_SELECT_THIS_CHOICE", "Selecione esta opção");
	//Select listing level
	define("LANG_MENU_SELECTLISTINGLEVEL", "Selecione o nível da empresa");
	//Select event level
	define("LANG_MENU_SELECTEVENTLEVEL", "Selecione o nível do evento");
	//Select classified level
	define("LANG_MENU_SELECTCLASSIFIEDLEVEL", "Selecione o nível do classificado");
	//Listing Options
	define("LANG_LISTING_OPTIONS", "Opções de Empresa");
	//Payment System is not available. Please contact the
	define("LANG_GATEWAY_NO_AVAILABLE", "O sistema de pagamento não está disponível no momento. Por favor, entre em contato com o");
	//Upload Warning
	define("LANG_UPLOAD_WARNING", "Aviso sobre o Upload");
	//File successfully uploaded!
	define("LANG_UPLOAD_MSG_SUCCESSUPLOADED", "Arquivo enviado com sucesso!");
	//Extension not allowed or wrong file type!
	define("LANG_UPLOAD_MSG_NOTALLOWED_WRONGFILETYPE", "Extensão não permitida ou tipo errado de arquivo!");
	//File exceeds size limit!
	define("LANG_UPLOAD_MSG_EXCEEDSLIMIT", "O arquivo excedeu o tamanho permitido!");
	//Fail trying to create directory!
	define("LANG_UPLOAD_MSG_FAILCREATEDIRECTORY", "Falha ao tentar criar diretório!");
	//Wrong directory permission!
	define("LANG_UPLOAD_MSG_WRONGDIRECTORYPERMISSION", "Permissão errada!");
	//Unexpected failure!
	define("LANG_UPLOAD_MSG_UNEXPECTEDFAILURE", "Falha inesperada!");
	//File not found or not entered!
	define("LANG_UPLOAD_MSG_NOTFOUND_NOTENTERED", "Arquivo não encontrado ou não informado!");
	//File already exists in directory!
	define("LANG_UPLOAD_MSG_FILEALREADEXISTSINDIRECTORY", "Arquivo já existente!");
	//View all locations
	define("LANG_VIEWALLLOCATIONSCATEGORIES", "Ver todas as localidades");
	//Featured Locations
	define("LANG_FEATUREDLOCATIONS", "Localidades em Destaque");
	//There aren't any featured location in the system.
	define("LANG_LABEL_NOFEATUREDLOCATIONS", "não existe nenhuma localicade em destaque no sistema.");
	//Overview
	define("LANG_LABEL_OVERVIEW", "Resumo");
	//Video
	define("LANG_LABEL_VIDEO", "Vídeo");
	//Map Location
	define("LANG_LABEL_MAPLOCATION", "Localização no Mapa");
	//More Listings
	define("LANG_LABEL_MORELISTINGS", "Mais Empresas");
	//More Events
	define("LANG_LABEL_MOREEVENTS", "Mais Eventos");
	//More Classifieds
	define("LANG_LABEL_MORECLASSIFIEDS", "Mais Classificados");
	//More Articles
	define("LANG_LABEL_MOREARTICLES", "Mais Artigos");
    //More Promotions
    define("LANG_LABEL_MOREPROMOTIONS", "Mais Ofertas");
    //More Posts
    define("LANG_LABEL_MOREPOSTS", "Mais Posts");
	//"Operation not allowed: The deal" (promotion_name) is already associated with the listing
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED1", "Operação não permitida: a oferta");
	//Operation not allowed: The deal (promotion_name) "is already associated with the listing"
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED2", "ja está associada a uma empresa");
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
	define("LANG_MSG_CLICKADDTOSELECTCATEGORIES", "Clique em \"Adicionar\" para selecionar categorias");
	//Click on "Add main category" or "Add sub-category" to type your new categories
	define("LANG_MSG_CLICKADDTOADDCATEGORIES", "Clique em \"Adicionar categoria principal\" ou \"Adicionar subcategorias\" para digitar suas novas categorias");
	//Add an
	define("LANG_ADD_AN", "Adicionar um(a)");
	//Add a
	define("LANG_ADD_A", "Adicionar um(a)");
	//on these sites
	define("LANG_ON_SITES", "nesses sites:");
	//on this site
	define("LANG_ON_SITES_SINGULAR", "neste site:");

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
	define("LANG_GALLERYTITLE", "Galeria de Fotos");
	//"Click here" for Slideshow. You can also click on any of the photos to start slideshow.
	define("LANG_GALLERYCLICKHERE", "Clique aqui");
	//Click here "for Slideshow. You can also click on any of the photos to start slideshow."
	define("LANG_GALLERYSLIDESHOWTEXT", "ou nas fotos para iniciar o slideshow.");
	//more photos
	define("LANG_GALLERYMOREPHOTOS", "mais fotos");
	//Inexistent Discount Code
	define("LANG_MSG_INEXISTENT_DISCOUNT_CODE", "Código Promocional Inexistente");
	//is not available.
	define("LANG_MSG_IS_NOT_AVAILABLE", "não está disponível.");
	//is not available for this item type.
	define("LANG_MSG_IS_NOT_AVAILABLE_FOR", "não está disponível para este tipo de item.");
	//cannot be used twice.
	define("LANG_MSG_CANNOT_BE_USED_TWICE", "não pode ser utilizado duas vezes.");
	//Title is required.
	define("LANG_MSG_TITLE_IS_REQUIRED", "Título é obrigatório.");
	//Language is required.
	define("LANG_MSG_LANGUAGE_IS_REQUIRED", "Idioma é obrigatório.");
	//First Name is required.
	define("LANG_MSG_FIRST_NAME_IS_REQUIRED", "Nome é obrigatório.");
	//Last Name is required.
	define("LANG_MSG_LAST_NAME_IS_REQUIRED", "Sobrenome é obrigatório.");
	//Company is required.
	define("LANG_MSG_COMPANY_IS_REQUIRED", "Empresa é obrigatória.");
	//Phone is required.
	define("LANG_MSG_PHONE_IS_REQUIRED", "Fone é obrigatório.");
	//E-mail is required.
	define("LANG_MSG_EMAIL_IS_REQUIRED", "E-mail é obrigatório.");
	//Account is required.
	define("LANG_MSG_ACCOUNT_IS_REQUIRED", "Conta é obrigatória.");
	//Page Name is required.
	define("LANG_MSG_PAGE_NAME_IS_REQUIRED", "Nome da Página é obrigatório.");
	//Category is required.
	define("LANG_MSG_CATEGORY_IS_REQUIRED", "Categoria é obrigatória.");
	//Abstract is required.
	define("LANG_MSG_ABSTRACT_IS_REQUIRED", "Resumo é obrigatório.");
	//Expiration type is required.
	define("LANG_MSG_EXPIRATION_TYPE_IS_REQUIRED", "Tipo de expiração é obrigatório.");
	//Renewal Date is required.
	define("LANG_MSG_RENEWAL_DATE_IS_REQUIRED", "Data de Renovação é obrigatória.");
	//Impressions are required.
	define("LANG_MSG_IMPRESSIONS_ARE_REQUIRED", "Visualizações é obrigatório.");
	//File is required.
	define("LANG_MSG_FILE_IS_REQUIRED", "Arquivo é obrigatório.");
	//Type is required.
	define("LANG_MSG_TYPE_IS_REQUIRED", "Tipo é obrigatório.");
	//Caption is required.
	define("LANG_MSG_CAPTION_IS_REQUIRED", "Legenda é obrigatória.");
	//Script Code is required.
	define("LANG_MSG_SCRIPT_CODE_IS_REQUIRED", "Código é obrigatório.");
	//Description 1 is required.
	define("LANG_MSG_DESCRIPTION1_IS_REQUIRED", "Descrição 1 é obrigatório.");
	//Description 2 is required.
	define("LANG_MSG_DESCRIPTION2_IS_REQUIRED", "Descrição 2 é obrigatório.");
	//Name is required.
	define("LANG_MSG_NAME_IS_REQUIRED", "Nome é obrigatório.");
	//Deal Title is required.
	define("LANG_MSG_HEADLINE_IS_REQUIRED", "Título da Oferta é requerido.");
	//"Offer" is required.
	define("LANG_MSG_OFFER_IS_REQUIRED", "Oferta é obrigatória.");
	//"Start Date" is required.
	define("LANG_MSG_START_DATE_IS_REQUIRED", "Data de Início é obrigatória.");
	//"End Date" is required.
	define("LANG_MSG_END_DATE_IS_REQUIRED", "Data de Término é obrigatória.");
	//Message is required.
	define("LANG_MSG_TEXT_IS_REQUIRED", "Mensagem é obrigatória.");
	//Username is required.
	define("LANG_MSG_USERNAME_IS_REQUIRED", "E-mail é obrigatório.");
	//"Current Password" is incorrect.
	define("LANG_MSG_CURRENT_PASSWORD_IS_INCORRECT", "\"Senha Atual\" está incorreta.");
	//Password is required.
	define("LANG_MSG_PASSWORD_IS_REQUIRED", "Senha é obrigatória.");
	//"Agree to terms of use" is required.
	define("LANG_MSG_IGREETERMS_IS_REQUIRED", "\"Eu concordo com os termos de uso\" é obrigatório.");
	//The following fields were not filled or contain errors:
	define("LANG_MSG_FIELDS_CONTAIN_ERRORS", "Os campos a seguir não foram preenchidos ou contêm erros:");
	//Title - Please fill out the field
	define("LANG_MSG_TITLE_PLEASE_FILL_OUT", "Título - Por favor, preencha o campo");
	//Page Name - Please fill out the field
	define("LANG_MSG_PAGE_NAME_PLEASE_FILL_OUT", "Nome da Página - Por favor, preencha o campo");
	//"Maximum of" [MAX_CATEGORY_ALLOWED] categories are allowed
	define("LANG_MSG_MAX_OF_CATEGORIES_1", "No máximo");
	//Maximum of [MAX_CATEGORY_ALLOWED] "categories are allowed"
	define("LANG_MSG_MAX_OF_CATEGORIES_2", "categorias são permitidas.");
	//Friendly URL Page Name already in use, please choose another Page Name.
	define("LANG_MSG_FRIENDLY_URL_IN_USE", "A URL Amigável já está em uso, por favor, escolha outra.");
	//Page Name contain invalid chars
	define("LANG_MSG_PAGE_NAME_INVALID_CHARS", "O Nome da Página contém caracteres inválidos");
	//"Maximum of" [MAX_KEYWORDS] keywords are allowed
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1", "No máximo");
	//Maximum of [MAX_KEYWORDS] "keywords are allowed"
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2", "palavras-chave são permitidas");
	//Please include keywords with a maximum of 50 characters each
	define("LANG_MSG_PLEASE_INCLUDE_KEYWORDS", "Por favor, coloque palavras-chave com no máximo 50 caracteres cada");
	//Please enter a valid "Publication Date".
	define("LANG_MSG_ENTER_VALID_PUBLICATION_DATE", "Por favor, digite uma \"Data de Publicação\" válida.");
	//Please enter a valid "Start Date".
	define("LANG_MSG_ENTER_VALID_START_DATE", "Por favor, digite uma \"Data de Início\" válida.");
	//Please enter a valid "End Date".
	define("LANG_MSG_ENTER_VALID_END_DATE", "Por favor, digite uma \"Data de Término\" válida.");
	//The "End Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_END_DATE_GREATER_THAN_START_DATE", "A \"Data de Término\" deve ser maior ou igual à \"Data de Início\".");
	//The "End Time" must be greater than the "Start Time".
	define("LANG_MSG_END_TIME_GREATER_THAN_START_TIME", "A \"Hora de Término\" deve ser maior que a \"Hora de Início\".");
	//The "End Date" cannot be in past.
	define("LANG_MSG_END_DATE_CANNOT_IN_PAST", "A \"Data de Término\" não pode estar no passado.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_ENTER_VALID_EMAIL_ADDRESS", "Por favor, digite um e-mail válido.");
	//Please enter a valid "URL".
	define("LANG_MSG_ENTER_VALID_URL", "Por favor, digite uma \"URL\" válida.");
	//Please provide a description with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_DESCRIPTION_WITH_255_CHARS", "Por favor, forneça uma descrição com no máximo 255 caracteres.");
	//Please provide a conditions with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_255_CHARS", "Por favor, forneça uma condição com no máximo 255 caracteres.");
	//Please enter a valid renewal date.
	define("LANG_MSG_ENTER_VALID_RENEWAL_DATE", "Por favor, digite uma data de renovação válida.");
	//Renewal date must be in the future.
	define("LANG_MSG_RENEWAL_DATE_IN_FUTURE", "A data de renovação deve estar no futuro.");
	//Please enter a valid expiration date.
	define("LANG_MSG_ENTER_VALID_EXPIRATION_DATE", "Por favor, digite uma data de expiração.");
	//Expiration date must be in the future.
	define("LANG_MSG_EXPIRATION_DATE_IN_FUTURE", "A data de expiração deve estar no futuro.");
	//Blank space is not allowed for password.
	define("LANG_MSG_BLANK_SPACE_NOT_ALLOWED_FOR_PASSWORD", "A senha não pode ter espaços.");
	//"Please enter a password with a maximum of" [PASSWORD_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MAX_CHARS", "Por favor, digite uma senha com no máximo");
	//"Please enter a password with a minimum of" [PASSWORD_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS", "Por favor, digite uma senha com no mínimo");
	//Please enter a valid username.
	define("LANG_MSG_ENTER_VALID_USERNAME", "Por favor, digite um e-mail válido.");
	//Sorry, you can't change this account information
	define("LANG_MSG_YOUCANTCHANGEACCOUNTINFORMATION", "Desculpe, você não pode alterar as informações desta conta");
	//Password "abc123" not allowed!
	define("LANG_MSG_ABC123_NOT_ALLOWED", "A senha \"abc123\" não é permitida!");
	//Passwords do not match. Please enter the same content for "password" and "retype password" fields.
	define("LANG_MSG_PASSWORDS_DO_NOT_MATCH", "As senhas não coincidem. Por favor, digite a mesma senha nos campos \"Senha\" e \"Confirme a Senha\".");
	//Spaces are not allowed for username.
	define("LANG_MSG_SPACES_NOT_ALLOWED_FOR_USERNAME", "O e-mail não pode ter espaços.");
	//Special characters are not allowed for username.
	define("LANG_MSG_SPECIAL_CHARS_NOT_ALLOWED_FOR_USERNAME", "O e-mail não pode ter caracteres especiais.");
	//"Please type an username with a maximum of" [USERNAME_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MAX_CHARS", "Por favor, digite um e-mail com no máximo");
	//"Please type an username with a minimum of" [USERNAME_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MIN_CHARS", "Por favor, digite um e-mail com no mínimo");
	//Please choose a different username.
	define("LANG_MSG_CHOOSE_DIFFERENT_USERNAME", "Por favor, escolha um e-mail diferente.");
	//Click here if you do not see your category
	define("LANG_MSG_CLICK_TO_ADD_CATEGORY", "Clique aqui se você não ver a sua categoria");
	//Add main category
	define("LANG_MSG_CLICK_TO_ADD_MAINCATEGORY", "Adicionar categoria principal");
	//Add sub-category
	define("LANG_MSG_CLICK_TO_ADD_SUBCATEGORY", "Adicionar subcategoria");
	//Category title already registered!
	define("LANG_CATEGORY_ALREADY_REGISTERED", "Categoria já registrada!");
	//Category title available!
	define("LANG_CATEGORY_NOT_REGISTERED", "Categoria disponível!");

	# ----------------------------------------------------------------------------------------------------
	# MENU
	# ----------------------------------------------------------------------------------------------------
	//Dashboard
	define("LANG_MEMBERS_DASHBOARD", "Painel");
	//Manage
	define("LANG_MENU_MANAGE", "Gerenciar");
	//Add
	define("LANG_MENU_ADD", "Adicionar");
	//Sponsor Options
	define("LANG_MENU_MEMBEROPTIONS", "Anunciante - Opções");
	//Add Listing
	define("LANG_MENU_ADDLISTING", "Adicionar Empresa");
	//Manage Listings
	define("LANG_MENU_MANAGELISTING", "Gerenciar Empresas");
	//Add Event
	define("LANG_MENU_ADDEVENT", "Adicionar Evento");
	//Manage Events
	define("LANG_MENU_MANAGEEVENT", "Gerenciar Evento");
	//Add Banner
	define("LANG_MENU_ADDBANNER", "Adicionar Banner");
	//Manage Banners
	define("LANG_MENU_MANAGEBANNER", "Gerenciar Banners");
	//Add Classified
	define("LANG_MENU_ADDCLASSIFIED", "Adicionar Classificados");
	//Manage Classifieds
	define("LANG_MENU_MANAGECLASSIFIED", "Gerenciar Classificados");
	//Add Article
	define("LANG_MENU_ADDARTICLE", "Adicionar Artigo");
	//Manage Articles
	define("LANG_MENU_MANAGEARTICLE", "Gerenciar Artigos");
	//Add Deal
	define("LANG_MENU_ADDPROMOTION", "Adicionar Oferta");
	//Manage Deals
	define("LANG_MENU_MANAGEPROMOTION", "Gerenciar Ofertas");
	//Add Post
	define("LANG_MENU_ADDPOST", "Adicionar Post");
	//Page not found
	define("LANG_PAGE_NOT_FOUND", "Página não encontrada");
	//Maintenance Page
	define("LANG_MAINTENANCE_PAGE", "Página em manutenção");
	//Payment Options
	define("LANG_MENU_PAYMENTOPTIONS", "Pagamento - Opções");
	//Check Out
	define("LANG_MENU_CHECKOUT", "Pagar");
	//Make Your Payment
	define("LANG_MENU_MAKEPAYMENT", "Faça seu Pagamento");
	//History
	define("LANG_MENU_HISTORY", "Histórico");
	//Transaction History
	define("LANG_MENU_TRANSACTIONHISTORY", "Histórico de Transações");
	//Invoice History
	define("LANG_MENU_INVOICEHISTORY", "Histórico de Faturas");
	//Default Themes
	define("LANG_MENU_CHOOSETHEME", "Temas Padrão");
	//Schemes
	define("LANG_MENU_CHOOSESCHEME", "Esquemas");
	//Toll free
	define("LANG_LIVE_TOLLFREE", "Entre em contato");
	//Purchase Now
	define("LANG_LIVE_PURCHASE", "Compre Agora");

	# ----------------------------------------------------------------------------------------------------
	# SEARCH
	# ----------------------------------------------------------------------------------------------------
	//Search Article
	define("LANG_LABEL_SEARCHARTICLE", "Busca de Artigos");
	//Search Classified
	define("LANG_LABEL_SEARCHCLASSIFIED", "Busca de Classificados");
	//Search Event
	define("LANG_LABEL_SEARCHEVENT", "Busca de Eventos");
	//Search Listing
	define("LANG_LABEL_SEARCHLISTING", "Busca de Empresas");
	//Search Deal
	define("LANG_LABEL_SEARCHPROMOTION", "Busca de Ofertas");
	//Search the blog
    define("LANG_LABEL_SEARCHBLOG", "Busca de Post");
	//Advanced Search
	define("LANG_SEARCH_ADVANCEDSEARCH", "Busca Avançada");
	//Search
	define("LANG_SEARCH_LABELKEYWORD", "Procurar por");
	//Location
	define("LANG_SEARCH_LABELLOCATION", "Localidade");
	//Select a Country
	define("LANG_SEARCH_LABELCBCOUNTRY", "Selecione um País");
	//Select a Region
	define("LANG_SEARCH_LABELCBREGION", "Selecione uma Região");
	//Select a State
	define("LANG_SEARCH_LABELCBSTATE", "Selecione um Estado");
	//Select a City
	define("LANG_SEARCH_LABELCBCITY", "Selecione uma Cidade");
	//Select a Neighborhood
	define("LANG_SEARCH_LABELCBNEIGHBORHOOD", "Selecione um Bairro");
	//Category
	define("LANG_SEARCH_LABELCATEGORY", "Categoria");
	//Select a Category
	define("LANG_SEARCH_LABELCBCATEGORY", "Selecione uma Categoria");
	//Match
	define("LANG_SEARCH_LABELMATCH", "Filtro");
	//Exact Match
	define("LANG_SEARCH_LABELMATCH_EXACTMATCH", "Sentença Exata");
	//Any Word
	define("LANG_SEARCH_LABELMATCH_ANYWORD", "Qualquer Palavra");
	//All Words
	define("LANG_SEARCH_LABELMATCH_ALLWORDS", "Todas as Palavras");
	//Listing Type
	define("LANG_SEARCH_LABELBROWSE", "Tipo de Empresa");
	//from
	define("LANG_SEARCH_LABELFROM", "de");
	//to
	define("LANG_SEARCH_LABELTO", "até");
	//Miles "of"
	define("LANG_SEARCH_LABELZIPCODE_OF", "do");
	//Search by keyword
	define("LANG_LABEL_SEARCHFAQ", "Busca por Palavra-Chave ");
	//Search
	define("LANG_LABEL_SEARCHFAQ_BUTTON", "Procurar");
	//Please provide words with at least [FT_MIN_WORD_LEN] characters for your search.
	define("LANG_MSG_SEARCH_MIN_WORD_LEN", "Por favor, forneça palavras com pelo menos [FT_MIN_WORD_LEN] caracteres para sua busca.");

	# ----------------------------------------------------------------------------------------------------
	# FRONTEND
	# ----------------------------------------------------------------------------------------------------
	//Featured
	define("LANG_ITEM_FEATURED", "Destaque");
	//Recent Articles
	define("LANG_RECENT_ARTICLE", "Novos Artigos");
	//Upcoming Events
	define("LANG_UPCOMING_EVENT", "Próximos Eventos");
	//Featured Events
	define("LANG_FEATURED_EVENT", "Eventos em Destaque");
	//Featured Event
	define("LANG_FEATURED_EVENT_SING", "Evento em Destaque");
	//Featured Classifieds
	define("LANG_FEATURED_CLASSIFIED", "Classificados em Destaque");
	//Featured Classified
	define("LANG_FEATURED_CLASSIFIED_SING", "Classificado em Destaque");
	//Featured Articles
	define("LANG_FEATURED_ARTICLE", "Artigos em Destaque");
	//Featured Article
	define("LANG_FEATURED_ARTICLE_SING", "Artigo em Destaque");
	//Featured Listings
	define("LANG_FEATURED_LISTING", "Empresas em Destaque");
	//Featured Listing
	define("LANG_FEATURED_LISTING_SING", "Empresa em Destaque");
	//Featured Deals
	define("LANG_FEATURED_PROMOTION", "Ofertas em Destaque");
	//Featured Deal
	define("LANG_FEATURED_PROMOTION_SING", "Oferta em Destaque");
	//View all articles
	define("LANG_LABEL_VIEW_ALL_ARTICLES", "Ver todos os artigos");
	//View all events
	define("LANG_LABEL_VIEW_ALL_EVENTS", "Ver todos os eventos");
	//View all classifieds
	define("LANG_LABEL_VIEW_ALL_CLASSIFIEDS", "Ver todos os classificados");
	//View all listings
	define("LANG_LABEL_VIEW_ALL_LISTINGS", "Ver todas as empresas");
	//View all deals
	define("LANG_LABEL_VIEW_ALL_PROMOTIONS", "Ver todas as ofertas");
	//Listing with a deal
	define("LANG_LABEL_VIEW_LISTINGDEAL", "Empresa com oferta");
	//Most Read
	define("LANG_LABEL_ARTICLE_POPULAR", "Mais Lidos");
	//Recently Added
	define("LANG_LABEL_ARTICLE_RECENT", "Recentes");
	//Last Tweets
	define("LANG_LAST_TWEETS", "Últimos Tweets");
	//Quick and Easy.
	define("LANG_EASYANDFAST", "Rápido e Fácil.");
	//Just follow the 3 steps
	define("LANG_THREESTEPS", "Basta seguir os 3 passos");
	//4 Steps
	define("LANG_FOURSTEPS", "4 Passos");
	//Account Signup
	define("LANG_ACCOUNTSIGNUP", "Cadastro");
	//Update your Listing
	define("LANG_LISTINGUPDATE", "Atualizar sua Empresa");
	//Order
	define("LANG_ORDER", "Cadastro");
	//Check Out
	define("LANG_CHECKOUT", "Pagamento");
	//Configuration
	define("LANG_CONFIGURATION", "Configuração");
	//Select a level
	define("LANG_SELECTPACKAGE", "Selecione um nível");
	//Profile Options
	define("LANG_PROFILE_OPTIONS", "Opções de Perfil");
	//Directory account
	define("LANG_PROFILE_OPTIONS1", "Conta do Diretório");
	//My existing OpenID 2.0 Account
	define("LANG_PROFILE_OPTIONS2", "Minha conta do OpenID 2.0");
	//My existing Facebook Account
	define("LANG_PROFILE_OPTIONS3", "Minha conta do Facebook");
	//My existing Google Account
	define("LANG_PROFILE_OPTIONS4", "Minha conta do Google");
	//Are you already a member?
	define("LANG_ALREADYHAVEACCOUNT", "Você já é um membro?");
	//No, I'm a New User.
	define("LANG_ACCOUNTNEWUSER", "Não, sou um Novo Usuário.");
	//Yes, I have an Existing Account.
	define("LANG_ACCOUNTEXISTSUSER", "Sim, já tenho uma Conta.");
	//Login with your Directory account
	define("LANG_ACCOUNTDIRECTORYUSER", "Entre com sua conta do ".EDIRECTORY_TITLE."");
	//Or login with your OpenID account
	define("LANG_ACCOUNTOPENIDUSER", "Ou entre com sua conta do OpenID");
	//Sign in with my existing Facebook Account.
	define("LANG_ACCOUNTFACEBOOKUSER", "Entrar com minha conta do Facebook.");
	//Sign in with my existing Google Account.
	define("LANG_ACCOUNTGOOGLEUSER", "Entrar com minha conta do Google.");
    //Or login with your existing account
    define("LANG_ACCOUNTFBGOOGLEUSER", "Ou entre com sua conta existente");
	//Account Information
	define("LANG_ACCOUNTINFO", "Informações da Conta");
	//Additional Information
	define("LANG_LABEL_ADDITIONALINFORMATION", "Informações Adicionais");
	//Please write down your e-mail and password for future reference.
	define("LANG_ACCOUNTINFOMSG", "Por favor, anote o seu e-mail e senha para futura referência.");
	//"Username must be a valid e-mail between" [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG1", "O e-mail deve ser um e-mail válido entre ");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] "and" [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG2", "e");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] "characters with no spaces."
	define("LANG_USERNAME_MSG3", "caracteres sem espaços.");
	//"Password must be between" [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG1", "A senha deve ter entre");
	//Password must be between [PASSWORD_MIN_LEN] "and" [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG2", "e");
	//Password must be between [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] "characters with no spaces."
	define("LANG_PASSWORD_MSG3", "caracteres sem espaços.");
	//I agree with the terms of use
	define("LANG_IGREETERMS", "Eu concordo com os termos de uso");
	//Do you want to advertise with us?
	define("LANG_DOYOUWANT_ADVERTISEWITHUS", "Gostaria de anunciar conosco?");
	//Buy a link
	define("LANG_BUY_LINK", "Anuncie também");
	//Back to Top
	define("LANG_BACKTOTOP", "Voltar para o topo");
	//Back to
	define("LANG_BACKTO", "Voltar para ");
	//Favorites
	define("LANG_QUICK_LIST", "Favoritos");
	//view summary
	define("LANG_VIEWSUMMARY", "ver resumo");
	//view detail
	define("LANG_VIEWDETAIL", "ver detalhes");
	//Advertisers
	define("LANG_ADVERTISER", "Publicidade");
	//Order Now!
	define("LANG_ORDERNOW", "Cadastre-se!");
	//Wait, Loading...
	define("LANG_WAITLOADING", "Aguarde, Carregando...");
	//Wait, loading filter options...
	define("LANG_WAITLOADING_FILTERS", "Aguarde, carregando opções de filtro...");
	//Subtotal Amount
	define("LANG_SUBTOTALAMOUNT", "Subtotal");
	//Subtotal
	define("LANG_SUBTOTAL", "Subtotal");
	//Total Tax Amount
	define("LANG_TAXAMOUNT", "Total de Impostos");
	//Total Price
	define("LANG_TOTALPRICEAMOUNT", "Preço Total");
	//Favorites
	define("LANG_LABEL_QUICKLIST", "Favoritos");
	//No favorites found!
	define("LANG_LABEL_NOQUICKLIST", "Nenhum item favorito encontrado!");
	//Search results for
	define("LANG_LABEL_SEARCHRESULTSFOR", "Resultados da busca por");
	//Related Search
	define("LANG_LABEL_RELATEDSEARCH", "Busca Relacionada");
	//Browse by Section
	define("LANG_LABEL_BROWSESECTION", "Procure por Seção");
	//What are you looking for?
    define("LANG_LABEL_SEARCHINGFOR", "O que você está procurando?");
    //Where?
    define("LANG_LABEL_SEARCHINGFOR_WHERE", "Onde?");
	//Keyword
	define("LANG_LABEL_SEARCHKEYWORD", "Palavra-Chave");
	//Type a keyword
	define("LANG_LABEL_SEARCHKEYWORDTIP", "Digite uma palavra-chave");
	//Type a keyword or listing name
	define("LANG_LABEL_SEARCHKEYWORDTIP_LISTING", "Palavra-chave ou nome da empresa");
	//Type a keyword or deal title
	define("LANG_LABEL_SEARCHKEYWORDTIP_PROMOTION", "Palavra-chave ou título da oferta");
	//Type a keyword or event title
	define("LANG_LABEL_SEARCHKEYWORDTIP_EVENT", "Palavra-chave ou título do evento");
	//Type a keyword or classified title
	define("LANG_LABEL_SEARCHKEYWORDTIP_CLASSIFIED", "Palavra-chave ou título do classificado");
	//Type a keyword or article title
	define("LANG_LABEL_SEARCHKEYWORDTIP_ARTICLE", "Palavra-chave ou título do artigo");
	//Where
	define("LANG_LABEL_SEARCHWHERE", "Onde");
	//Address, City, State or Zip Code
	define("LANG_LABEL_SEARCHWHERETIP", "Endereço, Cidade, Estado ou CEP");
	//Wait, searching your location...
	define("LANG_LABEL_WAIT_LOCATION", "Procurando sua localização...");
	//Complete the form below to contact us.
	define("LANG_LABEL_FORMCONTACTUS", "Preencha o formulário abaixo para entrar em contato conosco.");
	//Message
	define("LANG_LABEL_MESSAGE", "Mensagem");
	//No disabled categories found in the system.
	define("LANG_DISABLED_CATEGORY_NOTFOUND", "Nenhuma categoria desabilitada encontrada no sistema.");
	//No categories found.
	define("LANG_CATEGORY_NOTFOUND", "Nenhuma categoria encontrada.");
	//Please, select a valid category
	define("LANG_CATEGORY_INVALIDERROR", "Por favor, selecione uma categoria válida");
	//Please select a category first!
	define("LANG_CATEGORY_SELECTFIRSTERROR", "Por favor, selecione uma categoria primeiro!");
	//View Category Path
	define("LANG_CATEGORY_VIEWPATH", "Ver o Caminho da Categoria");
	//Remove Selected Category
	define("LANG_CATEGORY_REMOVESELECTED", "Remover a Categoria");
	//"Extra categories cost an" additional [LEVEL_CATEGORY_PRICE] each.
	define("LANG_CATEGORIES_PRICEDESC1", "Categorias extras terão um custo");
	//Extra categories cost an "additional" [LEVEL_CATEGORY_PRICE] each.
	define("LANG_CATEGORIES_PRICEDESC2", "adicional de");
	//Extra categories cost an additional [LEVEL_CATEGORY_PRICE] "each."
	define("LANG_CATEGORIES_PRICEDESC3", "cada.");
	//Maximum of
	define("LANG_CATEGORIES_CATEGORIESMAXTIP1", "Máximo de");
	//allowed.
	define("LANG_CATEGORIES_CATEGORIESMAXTIP2", "categorias permitidas.");
	//Categories and sub-categories
	define("LANG_CATEGORIES_TITLE", "Categorias e Subcategorias");
	//Only select sub-categories that directly apply to your type.
	define("LANG_CATEGORIES_MSG1", "Selecione somente subcategorias que se enquadram diretamente em sua empresa.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_CATEGORIES_MSG2", "Sua empresa aparecerá automaticamente na categoria principal de cada subcategoria que você selecionar.");
	//Account Information Error
	define("LANG_ACCOUNTINFO_ERROR", "Informações da Conta Possuem Erros");
	//Contact Information
	define("LANG_CONTACTINFO", "Informações de Contato");
	//This information will not be displayed publicly.
	define("LANG_CONTACTINFO_MSG", "Estas informações não serão divulgadas.");
	//Billing Information
	define("LANG_BILLINGINFO", "Informações da Fatura");
	//This information will not be displayed publicly.
	define("LANG_BILLINGINFO_MSG1", "Estas informações não serão divulgadas.");
	//You will configure your article after placing the order.
	define("LANG_BILLINGINFO_MSG2_ARTICLE", "Você irá configurar seu artigo após fazer o cadastro.");
	//You will configure your banner after placing the order.
	define("LANG_BILLINGINFO_MSG2_BANNER", "Você irá configurar seu banner após fazer o cadastro.");
	//You will configure your classified after placing the order.
	define("LANG_BILLINGINFO_MSG2_CLASSIFIED", "Você irá configurar seu classificado após fazer o cadastro.");
	//You will configure your event after placing the order.
	define("LANG_BILLINGINFO_MSG2_EVENT", "Você irá configurar seu evento após fazer o cadastro.");
	//You will configure your listing after placing the order.
	define("LANG_BILLINGINFO_MSG2_LISTING", "Você irá configurar sua empresa após fazer o cadastro.");
	//Billing Information Error
	define("LANG_BILLINGINFO_ERROR", "Informações da Fatura Possuem Erros");
    //Or back to previous page
    define("LANG_ADVERTISE_BACK", "Ou volte para a página anterior");
	//Checking out
	define("LANG_ADVERTISE_CHECKOUT", "Anunciando");
    //Listing [level]
    define("LANG_ADVERTISE_LISTINGLEVEL", "Empresa [level]");
    //Event [level]
    define("LANG_ADVERTISE_EVENTLEVEL", "Evento [level]");
    //Classified [level]
    define("LANG_ADVERTISE_CLASSIFIEDLEVEL", "Classificado [level]");
    //Article [level]
    define("LANG_ADVERTISE_ARTICLELEVEL", "Artigo [level]");
    //Banner [level]
    define("LANG_ADVERTISE_BANNERLEVEL", "Banner [level]");
    //Identification
    define("LANG_ADVERTISE_IDENTIFICATION", "Identificação");
    //Confirmation
    define("LANG_ADVERTISE_CONFIRMATION", "Confirmação");
    //Please, login with your account or sign up today.
    define("LANG_ADVERTISE_SIGNUP", "Por favor, entre com sua conta ou cadastre-se.");
    //I'm already a user
    define("LANG_ADVERTISE_SIGNUP_ALREADYUSER", "Já sou um membro");
    //I'm a new user
    define("LANG_ADVERTISE_SIGNUP_NEWUSER", "Sou um novo membro");
    //Create a new account now.
    define("LANG_ADVERTISE_CREATE_ACC", "Crie uma nova conta agora.");
    //Billing Detail
    define("LANG_ADVERTISE_BILLINGDETAIL", "Detalhes de Pagamento");
    //A quick overview of how much you will be charged.
    define("LANG_ADVERTISE_BILLINGDETAIL_TIP", "Visão geral do que será cobrado.");
    //Payment
    define("LANG_ADVERTISE_PAYMENT", "Pagamento");
    //Make your payment and finish your order.
    define("LANG_ADVERTISE_PAYMENT_TIP", "Faça seu pagamento e conclua seu pedido.");
    //Print your invoice and finish your order.
    define("LANG_ADVERTISE_PAYMENT_TIP2", "Imprima a fatura e conclua seu pedido.");
    //Thank you for your order!
    define("LANG_ADVERTISE_THANKYOU", "Obrigado pelo seu pedido!");
    //Order Description
    define("LANG_ADVERTISE_ORDERDESC", "Descrição do Pedido");
    //A brief summary of your order.
    define("LANG_ADVERTISE_ORDERDESC_TIP", "Resumo do seu pedido.");
    //Thanks!
    define("LANG_ADVERTISE_THANKS", "Obrigado!");
    //Already registered users should use
    define("LANG_ADVERTISE_ALREADYUSER1", "Usuários já cadastrados devem usar");
    //members check out area
    define("LANG_ADVERTISE_ALREADYUSER2", "a área de membros para comprar novos itens");
    //You are already logged as
    define("LANG_ADVERTISE_LOGGED_AS", "Você já está registrado como");
	//Most Popular
	define("LANG_ADVERTISE_POPULAR", "Mais Popular");
	//days free trial!
	define("LANG_ADVERTISE_TRIAL", "dias grátis!");
	//after
	define("LANG_AFTER", "depois");
	//View Sample
	define("LANG_ADVERTISE_SAMPLE", "Ver Exemplo");
	//Have any questions?
	define("LANG_ADVERTISE_QUESTIONS", "Tem alguma dúvida?");
	//Contact us today
	define("LANG_ADVERTISE_CONTACT", "Entre em contato hoje");
	//No Tax
	define("LANG_ADVERTISE_NOTAX", "Nenhuma taxa");
	//Article Information
	define("LANG_ARTICLEINFO", "Informações do Artigo");
	//Article Information Error
	define("LANG_ARTICLEINFO_ERROR", "Informações do Artigo Possuem Erros");
	//Banner Information
	define("LANG_BANNERINFO", "Informações do Banner");
	//Banner Information Error
	define("LANG_BANNERINFO_ERROR", "Informações do Banner Possuem Erros");
	//Classified Information
	define("LANG_CLASSIFIEDINFO", "Informações do Classificado");
	//Classified Information Error
	define("LANG_CLASSIFIEDINFO_ERROR", "Informações do Classificado Possuem Erros");
	//Browse Events by Date
	define("LANG_BROWSEEVENTSBYDATE", "Procure Eventos por Data");
	//Event Information
	define("LANG_EVENTINFO", "Informações do Evento");
	//Event Information Error
	define("LANG_EVENTINFO_ERROR", "Informações do Evento Possuem Erros");
	//Listing Information
	define("LANG_LISTINGINFO", "Informações da Empresa");
    //What do you want to call your listing? This is normally your company name.
	define("LANG_LISTINGINFO_TIP", "Qual é o nome da sua empresa?");
    //Choose a template applicable to your business type if you feel the need too.
	define("LANG_LISTINGINFO_TIP2", "Você também pode escolher um modelo adequado ao seu tipo de negócio, caso necessário.");
    //What do you want to call your event?
	define("LANG_EVENTINFO_TIP", "Qual é o nome do seu evento?");
    //What do you want to call your classified?
	define("LANG_CLASSIFIEDINFO_TIP", "Qual é o nome do seu classificado?");
    //What do you want to call your article?
	define("LANG_ARTICLEINFO_TIP", "Qual é o nome do seu artigo?");
    //What do you want to call your banner?
	define("LANG_BANNERINFO_TIP", "Qual é o nome do seu banner?");
	//Listing Information Error
	define("LANG_LISTINGINFO_ERROR", "Informações da Empresa Possuem Erros");
	//Claim this Listing
	define("LANG_LISTING_CLAIMTHIS", "Solicite esta Empresa");
	//Claiming
	define("LANG_LISTING_CLAIMING", "Solicitando");
	//To claim this listing, just log in with your existing account details or create a new account.
	define("LANG_CLAIM_SIGNUP", "Para solicitar esta empresa, faça log in com os dados de sua conta ou crie uma nova conta.");
	//Listing Type
	define("LANG_LISTING_LABELTEMPLATE", "Tipo da Empresa");
	//No results were found for the search criteria you requested.
	define("LANG_MSG_NORESULTS", "Nenhum resultado foi encontrado com o seu critério de busca.");
	//Please try your search again or browse by section.
	define("LANG_MSG_TRYAGAIN_BROWSESECTION", "Por favor, tente novamente ou procure por seção.");
	//Sometimes you may receive no results for your search because the keyword you used is highly generic. Try to use a more specific keyword and perform your search again.
	define("LANG_MSG_USE_SPECIFIC_KEYWORD", "Algumas vezes sua busca pode não retornar resultados porque a palavra-chave utilizada foi muito genérica. Tente fazer uma nova busca usando uma palavra-chave mais específica.");
	//Please type at least one keyword on the search box.
	define("LANG_MSG_LEASTONEKEYWORD", "Por favor, digite pelo menos uma palavra-chave no formulário de busca.");
	//"No results content"
	define("LANG_SEARCH_NORESULTS", "<h1>Nenhum resultado para a sua pesquisa</h1><p>Sua pesquisa não trouxe resultados. Embora não seja comum, isso pode acontecer se o termo de pesquisa que você usou é muito genérico ou quando nós realmente não temos conteúdo correspondente.</p><h2>Sugestões:</h2>&raquo;Seja mais específico nos termos da sua pesquisa<br />&raquo;Verifique a ortografia<br />&raquo;Se você não conseguir encontrar através da busca, tente navegar por seção<br /><br /><p>Se você acredita que chegou aqui por engano, por favor contacte o administrador do site para relatar o problema.</p>");
	//Image
	define("LANG_SLIDESHOW_IMAGE", "Imagem");
	//of
	define("LANG_SLIDESHOW_IMAGEOF", "de");
	//Error loading image
	define("LANG_SLIDESHOW_IMAGELOADINGERROR", "Erro ao carregar imagem");
	//Next
	define("LANG_SLIDESHOW_NEXT", "Próxima");
	//Pause
	define("LANG_SLIDESHOW_PAUSE", "Pausar");
	//Play
	define("LANG_SLIDESHOW_PLAY", "Play");
	//Back
	define("LANG_SLIDESHOW_BACK", "Anterior");
	//Your e-mail has been sent. Thank you.
	define("LANG_CONTACTMSGSUCCESS", "Sua mensagem foi enviada. Obrigado.");
	//There was a problem sending this e-mail. Please try again later.
	define("LANG_CONTACTMSGFAILED", "Ocorreu um problema ao tentar enviar seu e-mail. Por favor, tente novamente.");
	//Please enter your name.
	define("LANG_MSG_CONTACT_ENTER_NAME", "Por favor, digite seu nome.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_CONTACT_ENTER_VALID_EMAIL", "Por favor, digite um e-mail válido.");
	//Please type the message.
	define("LANG_MSG_CONTACT_TYPE_MESSAGE", "Por favor, digite a mensagem.");
	//Please type the code correctly or mark the checkbox if available.
    define("LANG_MSG_CONTACT_TYPE_CODE", "Por favor digite o código de verificação corretamente ou marque a caixa de seleção se disponível.");
	//Please correct it and try again.
	define("LANG_MSG_CONTACT_CORRECTIT_TRYAGAIN", "Por favor, corrija os itens e tente novamente.");
	//Please type a name.
	define("LANG_MSG_CONTACT_TYPE_NAME", "Por favor, digite um nome.");
	//Please type a subject.
	define("LANG_MSG_CONTACT_TYPE_SUBJECT", "Por favor, digite um assunto.");
	//SOME DETAILS
	define("LANG_ARTICLE_TOFRIEND_MAIL", "ALGUNS DETALHES");
	//SOME DETAILS
	define("LANG_CLASSIFIED_TOFRIEND_MAIL", "ALGUNS DETALHES");
	//SOME DETAILS
	define("LANG_EVENT_TOFRIEND_MAIL", "ALGUNS DETALHES");
	//SOME DETAILS
	define("LANG_LISTING_TOFRIEND_MAIL", "ALGUNS DETALHES");
	//SOME DETAILS
	define("LANG_PROMOTION_TOFRIEND_MAIL", "ALGUNS DETALHES");
	//Please enter a valid e-mail address in the "To" field
	define("LANG_MSG_TOFRIEND1", "Por favor, digite um e-mail válido no campo \"Para\"");
	//Please enter a valid e-mail address in the "Your E-mail" field
	define("LANG_MSG_TOFRIEND2", "Por favor, digite um e-mail válido no campo \"De\"");
	//"Item not found. Please return to" [YOURSITE] and try again.
	define("LANG_MSG_TOFRIEND3", "Item não encontrado. Por favor, retorne para");
	//We could not find the item you're trying to send to a friend. Please return to [YOURSITE] "and try again."
	define("LANG_MSG_TOFRIEND4", "e tente novamente.");
	//Please enter a valid e-mail address in the "Your E-mail" field
	define("LANG_MSG_TOFRIEND5", "Por favor, digite um e-mail válido no campo \"Seu E-mail\"");
	//"About" [ARTICLE_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_1", "Sobre");
	//About [ARTICLE_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_2", "do");
	//"About" [CLASSIFIED_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_1", "Sobre");
	//About [CLASSIFIED_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_2", "do");
	//"About" [EVENT_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_1", "Sobre");
	//About [EVENT_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_2", "do");
	//"About" [LISTING_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_1", "Sobre");
	//About [LISTING_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_2", "do");
	//"About" [PROMOTION_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_1", "Sobre");
	//About [PROMOTION_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_2", "do");
	//Send info about this article to a friend
	define("LANG_ARTICLE_TOFRIEND_SAUDATION", "Enviar informações sobre este artigo para um amigo");
	//Send info about this classified to a friend
	define("LANG_CLASSIFIED_TOFRIEND_SAUDATION", "Enviar informações sobre este classificado para um amigo");
	//Send info about this event to a friend
	define("LANG_EVENT_TOFRIEND_SAUDATION", "Enviar informações sobre este evento para um amigo");
	//Send info about this listing to a friend
	define("LANG_LISTING_TOFRIEND_SAUDATION", "Enviar informações sobre esta empresa para um amigo");
	//Send info about this deal to a friend
	define("LANG_PROMOTION_TOFRIEND_SAUDATION", "Enviar informações sobre esta oferta para um amigo");
	//Message sent by
	define("LANG_MESSAGE_SENT_BY", "Mensagem enviada por ");
	//This is a automatic message.
	define("LANG_THIS_IS_A_AUTOMATIC_MESSAGE", "Esta é uma mensagem automática.");
	//Contact
	define("LANG_CONTACT", "Contato");
	//article
	define("LANG_ARTICLE", "artigo");
	//classified
	define("LANG_CLASSIFIED", "classificado");
	//event
	define("LANG_EVENT", "evento");
	//listing
	define("LANG_LISTING", "empresa");
	//deal
	define("LANG_PROMOTION", "oferta");
	//Please search at least one parameter on the search box!
	define("LANG_MSG_LEASTONEPARAMETER", "Por favor, busque por pelo menos um parâmetro no formulário de busca!");
	//Please try your search again.
	define("LANG_MSG_TRYAGAIN", "Por favor, tente sua busca novamente.");
	//No articles registered yet.
	define("LANG_MSG_NOARTICLES", "Nenhum artigo registrado ainda.");
	//No classifieds registered yet.
	define("LANG_MSG_NOCLASSIFIEDS", "Nenhum classificado registrado ainda.");
	//No events registered yet.
	define("LANG_MSG_NOEVENTS", "Nenhum evento registrado ainda.");
	//No listings registered yet.
	define("LANG_MSG_NOLISTINGS", "Nenhuma empresa registrada ainda.");
	//No deals registered yet.
	define("LANG_MSG_NOPROMOTIONS", "Nenhuma oferta registrada ainda.");
	//Message sent through
	define("LANG_CONTACTPRESUBJECT", "Mensagem enviada através do");
	//E-mail Form
	define("LANG_EMAILFORM", "Formulário de E-mail");
	//Click here to print
	define("LANG_PRINTCLICK", "Clique aqui para imprimir");
	//View all classified categories
	define("LANG_CLASSIFIED_VIEWALLCATEGORIES", "Ver todas as categorias");
	//Location
	define("LANG_CLASSIFIED_LOCATIONS", "Localização");
	//More Classifieds
	define("LANG_CLASSIFIED_MORE", "Mais Classificados");
	//View all event categories
	define("LANG_EVENT_VIEWALLCATEGORIES", "Ver todas as categorias");
	//Location
	define("LANG_EVENT_LOCATIONS", "Localização");
	//Featured Events
	define("LANG_EVENT_FEATURED", "Destaque: Eventos");
	//events
	define("LANG_EVENT_PLURAL", "eventos");
	//Search results
	define("LANG_SEARCHRESULTS", "Resultados da busca");
	//Results
	define("LANG_RESULTS", "Resultados");
	//Result
	define("LANG_RESULT", "Resultado");
    //Letter
    define("LANG_LETTER", "Letra");
	//Search results "for" keyword
	define("LANG_SEARCHRESULTS_KEYWORD", "por");
	//Search results "in" where
	define("LANG_SEARCHRESULTS_WHERE", "em");
	//Search results "in" template
	define("LANG_SEARCHRESULTS_TEMPLATE", "em");
	//Search results "in" category
	define("LANG_SEARCHRESULTS_CATEGORY", "em");
	//Search results "in category"
	define("LANG_SEARCHRESULTS_INCATEGORY", "na categoria");
	//Search results "in" location
	define("LANG_SEARCHRESULTS_LOCATION", "em");
	//Search results "in" zip
	define("LANG_SEARCHRESULTS_ZIP", "no");
	//Search results "for" date
	define("LANG_SEARCHRESULTS_DATE", "para");
	//Search results - "Page" X
	define("LANG_SEARCHRESULTS_PAGE", "Página");
	//Recent Reviews
	define("LANG_RECENT_REVIEWS", "Avaliações Recentes");
	//Reviews of
	define("LANG_REVIEWSOF", "Comentários de");
	//Reviews are disabled
	define("LANG_REVIEWDISABLE", "Avaliações estão desabilitadas");
	//View all article categories
	define("LANG_ARTICLE_VIEWALLCATEGORIES", "Ver todas as categorias");
	//View all deal categories
	define("LANG_PROMOTION_VIEWALLCATEGORIES", "Ver todas as categorias");
    //View all blog categories
	define("LANG_BLOG_VIEWALLCATEGORIES", "Ver todas as categorias");
	//Offer
	define("LANG_PROMOTION_OFFER", "Oferta");
	//Description
	define("LANG_PROMOTION_DESCRIPTION", "Descrição");
	//Conditions
	define("LANG_PROMOTION_CONDITIONS", "Condições");
	//Location
	define("LANG_PROMOTION_LOCATIONS", "Localização");
	//Item not found!
	define("LANG_MSG_NOTFOUND", "Item não encontrado!");
	//Item not available!
	define("LANG_MSG_NOTAVAILABLE", "Item não disponível!");
	//Listing Search Results
	define("LANG_MSG_LISTINGRESULTS", "Resultados da Busca por Empresas");
	//Deal Search Results
	define("LANG_MSG_PROMOTIONRESULTS", "Resultados da Busca por Ofertas");
	//Event Search Results
	define("LANG_MSG_EVENTRESULTS", "Resultados da Busca por Eventos");
	//Classified Search Results
	define("LANG_MSG_CLASSIFIEDRESULTS", "Resultados da Busca por Classificados");
	//Article Search Results
	define("LANG_MSG_ARTICLERESULTS", "Resultados da Busca por Artigos");
	//Available Languages
	define("LANG_MSG_AVAILABLELANGUAGES", "Idiomas Disponíveis");
	//You can choose up to [MAX_ENABLED_LANGUAGES] of the languages below for your directory.
	define("LANG_MSG_AVAILABLELANGUAGESMSG", "Você pode escolher até ".MAX_ENABLED_LANGUAGES." dos idiomas abaixo para o seu diretório.");
	//Redeem without Facebook
    define("LANG_DEAL_DONTUSEFACEBOOK", "Resgatar sem Facebook");
	//posted on facebook and twitter
	define("LANG_DEAL_POSTFACEBOOK_TWITTER", "postada no Facebook e Twitter");
	//posted on facebook
	define("LANG_DEAL_POSTFACEBOOK", "postada no Facebook");
	//posted on twitter
	define("LANG_DEAL_TWITTER", "postada no Twitter");
	//Posted on
	define("LANG_LABEL_POSTED_ON", "Postada no");
	//deal checked out
	define("LANG_DEAL_CHECKOUT", "oferta utilizada");
	//deal opened
	define("LANG_DEAL_OPENED", "oferta em aberto");
	//Terms & Conditions
	define("LANG_LABEL_DEAL_CONDITIONS", "Termos e Condições");
	//maximum 1000 characters
	define("LANG_MSG_MAX_1000_CHARS", "max 1000 caracteres");
	//Please provide a conditions with a maximum of 1000 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_1000_CHARS", "Por favor, forneça as condições com no máximo 1000 caracteres.");
	//See All
	define("LANG_LABEL_SEE_ALL", "Ver Todos(as)");
	//Stars
	define("LANG_LABEL_STARS", "Estrelas");
	//Star
	define("LANG_LABEL_STAR", "Estrela");
	//Terms of Use
    define("LANG_TERMS_USE", "Termos de Uso");
	//Privacy Policy
	define("LANG_PRIVACY_POLICY", "Política de Privacidade");
	//Size
    define("LANG_ADVERTISE_SIZE", "Dimensões");
	//Title / Address
	define("LANG_ADVERTISE_LIST_TITLE_ADDRESS", "Título / Endereço");
	//Title
	define("LANG_ADVERTISE_LIST_TITLE", "Título");
	//Ratings and Reviews
	define("LANG_ADVERTISE_LIST_REVIEW", "Avaliações e Comentários");
	//Detail View
	define("LANG_ADVERTISE_LIST_DETAIL_VIEW", "Página de Detalhes");
	//Deal
	define("LANG_ADVERTISE_LIST_DEAL", "Oferta");
	//Send to Phone
	define("LANG_ADVERTISE_LIST_SEND_TO_PHONE", "Enviar para Celular");
	//Click to Call
	define("LANG_ADVERTISE_LIST_CLICK_TO_CALL", "Clique para Ligar");
	//Phone
	define("LANG_ADVERTISE_LIST_PHONE", "Telefone");
	//E-mail
	define("LANG_ADVERTISE_LIST_EMAIL", "E-mail");
	//Url
	define("LANG_ADVERTISE_LIST_URL", "Url");
	//Fax Number
	define("LANG_ADVERTISE_LIST_FAX", "Número de Fax");
	//Summary Description
	define("LANG_ADVERTISE_LIST_SUMMARY_DESCRIPTION", "Descrição Resumida");
	//Badges
	define("LANG_ADVERTISE_LIST_BADGES", "Classificações");
	//Detail Description
	define("LANG_ADVERTISE_LIST_LONG_DESCRIPTION", "Descrição detalhada");
	//Photo Gallery
	define("LANG_ADVERTISE_LIST_MAIN_IMAGE", "Galeria de Fotos");
	//Video
	define("LANG_ADVERTISE_LIST_VIDEO", "Vídeo");
	//Additional Uploads
	define("LANG_ADVERTISE_LIST_ATTACHMENT_FILE", "Arquivo adicional");
	//Hours
	define("LANG_ADVERTISE_LIST_HOURS_OF_WORK", "Horário de Trabalho");
	//Location reference
	define("LANG_ADVERTISE_LIST_LOCATIONS", "Referência de Localização");
	//Features
	define("LANG_ADVERTISE_LIST_FEATURES", "Diferenciais");
	//Facebook Social Plugin
	define("LANG_ADVERTISE_LIST_FBPAGE", "Página do Facebook");
	//Contact Name
	define("LANG_ADVERTISE_LIST_CONTACT_NAME", "Nome do Contato");
	//Contact Phone
	define("LANG_ADVERTISE_LIST_CONTACT_PHONE", "Telefone de Contato");
	//Contact E-mail
	define("LANG_ADVERTISE_LIST_CONTACT_EMAIL", "E-mail de Contato");
	//Event Time
	define("LANG_ADVERTISE_LIST_START_TIME", "Hora do Evento");
	//Price
	define("LANG_ADVERTISE_LIST_PRICE", "Preço");
	//Publication Date
	define("LANG_ADVERTISE_LIST_PUBLICATION", "Data de Publicação");
	//Author
	define("LANG_ADVERTISE_LIST_AUTHOR", "Autor");
	//Abstract
	define("LANG_ADVERTISE_LIST_ABSTRACT", "Resumo");
	//Content
	define("LANG_ADVERTISE_LIST_CONTENT", "Conteúdo");
    //Social Networking Pages
    define("LANG_ADVERTISE_LIST_SOCIAL_NETWORK", "Páginas de Redes Sociais");

	# ----------------------------------------------------------------------------------------------------
	# MANAGE MODULES ORDINATION
	# ----------------------------------------------------------------------------------------------------
	//Click here to order by descending title
	define("LANG_CLICK_ORDERTITLEDESC", "Clique aqui para ordenar por nome descendente");
	//Click here to order by ascending title
	define("LANG_CLICK_ORDERTITLEASC", "Clique aqui para ordenar por nome ascendente");
	//Click here to order by descending level
	define("LANG_CLICK_ORDERLEVELDESC", "Clique aqui para ordenar por nível descendente");
	//Click here to order by ascending level
	define("LANG_CLICK_ORDERLEVELASC", "Clique aqui para ordenar por nível ascendente");
	//Click here to order by descending account
	define("LANG_CLICK_ORDERACCOUNTDESC", "Clique aqui para ordenar por conta descendente");
	//Click here to order by ascending account
	define("LANG_CLICK_ORDERACCOUNTASC", "Clique aqui para ordenar por conta ascendente");
	//Click here to order by descending status
	define("LANG_CLICK_ORDERSTATUSDESC", "Clique aqui para ordenar por status descendente");
	//Click here to order by ascending status
	define("LANG_CLICK_ORDERSTATUSASC", "Clique aqui para ordenar por status ascendente");
	//Click here to order by descending caption
	define("LANG_CLICK_ORDERCAPTIONDESC", "Clique aqui para ordenar por legenda descendente");
	//Click here to order by ascending caption
	define("LANG_CLICK_ORDERCAPTIONASC", "Clique aqui para ordenar por legenda ascendente");
	//Click here to order by descending type
	define("LANG_CLICK_ORDERTYPEDESC", "Clique aqui para ordenar por tipo descendente");
	//Click here to order by ascending type
	define("LANG_CLICK_ORDERTYPEASC", "Clique aqui para ordenar por tipo ascendente");
	//Click here to order by descending renewal date
	define("LANG_CLICK_ORDERRENEWALDESC", "Clique aqui para ordenar por renovação descendente");
	//Click here to order by ascending renewal date
	define("LANG_CLICK_ORDERRENEWALASC", "Clique aqui para ordenar por renovação ascendente");
	//Click here to order by descending impressions
	define("LANG_CLICK_ORDERIMPRESSIONSDESC", "Clique aqui para ordenar por visualizações descendente");
	//Click here to order by ascending impressions
	define("LANG_CLICK_ORDERIMPRESSIONSASC", "Clique aqui para ordenar por visualizações ascendente");
	//Click here to order by descending start date
	define("LANG_CLICK_ORDERSTARTDATEDESC", "Clique aqui para ordenar por data de início descendente");
	//Click here to order by ascending start date
	define("LANG_CLICK_ORDERSTARTDATEASC", "Clique aqui para ordenar por data de início ascendente");

	# ----------------------------------------------------------------------------------------------------
	# MEMBERS
	# ----------------------------------------------------------------------------------------------------
	//Your item has been paid, so you can add a maximum of 3 categories free.
	define("LANG_ITEM_ALREADY_HAS_PAID", "Seu item já foi pago, portanto você pode adicionar no máximo [max] categorias grátis.");
	//Your item has been paid, so you can add a maximum of 1 category free.
	define("LANG_ITEM_ALREADY_HAS_PAID2", "Seu item já foi pago, portanto você pode adicionar no máximo [max] categoria grátis.");
	//Video Snippet Code TIP
	define("LANG_VIDEO_SNIPPETTIP", "Tem alguma pergunta sobre o Código do Vídeo? Clique Aqui.");
	//Enjoy our Services!
	define("LANG_ENJOY_OUR_SERVICES", "Aproveite nossos serviços!");
	//Remove association with
	define("LANG_REMOVE_ASSOCIATION_WITH", "Remover relação com");
	//Welcome
	define("LANG_LABEL_WELCOME", "Bem-vindo(a)");
	//Sponsor Options
	define("LANG_LABEL_MEMBER_OPTIONS", "Anunciante - Opções");
	//Back to Website
	define("LANG_LABEL_BACK_TO_SEARCH", "Voltar ao Website");
	//Add New Account
	define("LANG_LABEL_ADD_NEW_ACCOUNT", "Adicionar Nova Conta");
	//Forgotten password
	define("LANG_LABEL_FORGOTTEN_PASSWORD", "Recuperação de senha");
	//Click here
	define("LANG_LABEL_CLICK_HERE", "Clique aqui");
	//Help
	define("LANG_LABEL_HELP", "Ajuda");
	//Reset Password
	define("LANG_LABEL_RESET_PASSWORD", "Redefinir Senha");
	//Account and Contact Information
	define("LANG_LABEL_ACCOUNT_AND_CONTACT_INFO", "Informações de Conta e Contato");
	//Signup Notification
	define("LANG_LABEL_SIGNUP_NOTIFICATION", "Notificação de Cadastro");
	//Go to Sign in
	define("LANG_LABEL_GO_TO_LOGIN", "Ir para a página de acesso");
	//Order
	define("LANG_LABEL_ORDER", "Cadastro");
	//Check Out
	define("LANG_LABEL_CHECKOUT", "Pagamento");
	//Configuration
	define("LANG_LABEL_CONFIGURATION", "Configuração");
	//Category Detail
	define("LANG_LABEL_CATEGORY_DETAIL", "Detalhes da Categoria");
	//Site Manager
	define("LANG_LABEL_SITE_MANAGER", "Administrador");
	//Summary page
	define("LANG_LABEL_SUMMARY_PAGE", "Página de Resumo");
	//Detail page
	define("LANG_LABEL_DETAIL_PAGE", "Página de Detalhe");
	//Photo Gallery
	define("LANG_LABEL_PHOTO_GALLERY", "Galeria de Fotos");
	//To select a main image, simply click on it.
	define("LANG_LABEL_PHOTO_GALLERY_MAIN", "Para selecionar uma imagem principal, basta clicar sobre ela.");
	//Add Banner
	define("LANG_LABEL_ADDBANNER", "Adicionar Banner");
	//Custom Invoice Title
	define("LANG_LABEL_CUSTOM_INVOICE_TITLE", "Título do Serviço Adicional");
	//Custom Invoice Items
	define("LANG_LABEL_CUSTOM_INVOICE_ITEMS", "Itens do Serviço Adicional");
	//Easy and Fast.
	define("LANG_LABEL_EASY_AND_FAST", "Fácil e Rápido.");
	//Steps
	define("LANG_LABEL_STEPS", "Passos");
	//Account Signup
	define("LANG_LABEL_ACCOUNT_SIGNUP", "Cadastro");
	//Select a Level
	define("LANG_LABEL_SELECT_PACKAGE", "Selecione um Nível");
	//Payment Status
	define("LANG_LABEL_PAYMENTSTATUS", "Status do Pagamento");
	//Expiration
	define("LANG_LABEL_EXPIRATION", "Expiração");
	//New Deal
	define("LANG_LABEL_ADDNEWPROMOTION", "Nova Oferta");
	//Add a new deal
	define("LANG_LABEL_ADDANEWPROMOTION", "Adicionar uma nova oferta");
	//Manage Billing
	define("LANG_LABEL_MANAGEBILLING", "Gerenciar Faturas");
	//Click here if you have your password already.
	define("LANG_MSG_CLICK_IF_YOU_HAVE_PASSWORD", "Clique aqui se você já tem sua senha.");
	//Not a sponsor?
	define("LANG_MSG_NOT_A_MEMBER", "Não é anunciante?");
	//for information on adding your item to
	define("LANG_MSG_FOR_INFORMATION_ON_ADDING_YOUR_ITEM", "para informação sobre o cadastro de seu item no");
	//Welcome to the Sponsor Section
	define("LANG_MSG_WELCOME", "Bem-vindo(a) à Seção de Anunciante");
	//Welcome to the Member Section
	define("LANG_MSG_WELCOME2", "Bem-vindo(a) à Seção de Sócios");
	//"Account locked. Wait" X minute(s) and try again.
	define("LANG_MSG_ACCOUNTLOCKED1", "Conta bloqueada. Aguarde");
	//Account locked. Wait X "minute(s) and try again."
	define("LANG_MSG_ACCOUNTLOCKED2", "minuto(s) e tente novamente.");
	//One or more required fields were not filled in. Please confirm that all required information has been entered before continuing.
	define("LANG_MSG_FOREIGNACCOUNTWARNING", "Um ou mais campos obrigatórios não foram preenchidos. Por favor, confirme se todas as informações requeridas foram inseridas antes de continuar");
	//You don't have access permission from this IP address!
	define("LANG_MSG_YOUDONTHAVEACCESSFROMTHISIPADDRESS", "Você não tem permissão de acesso neste endereço IP!");
	//Your account was deactivated!
	define("LANG_MSG_ACCOUNT_DEACTIVE", "Sua conta foi desativada!");
	//Sorry, your username or password is incorrect.
	define("LANG_MSG_USERNAME_OR_PASSWORD_INCORRECT", "Desculpe, seu e-mail ou senha está incorreto.");
	//Sorry, wrong account.
	define("LANG_MSG_WRONG_ACCOUNT", "Desculpe, conta errada.");
	//Sorry, for your protection the link sent to your e-mail has expired. If you forgot your password click on the link below.
	define("LANG_MSG_WRONG_KEY", "Desculpe, para sua proteção o link enviado para seu e-mail expirou. Se você esqueceu sua senha, clique no link abaixo.");
    //Invalid activation key.
    define("LANG_MSG_WRONG_ACTIVATION_KEY", "Chave de ativação inválida.");
    //Account successfully activated!
    define("LANG_MSG_ACCOUNT_ACTIVATED", "Conta ativada com sucesso!");
	//OpenID Server not available!
	define("LANG_MSG_OPENID_SERVER", "O servidor do OpenID não está disponível!");
	//Error requesting OpenID Server!
	define("LANG_MSG_OPENID_ERROR", "Erro ao requisitar o servidor do OpenID!");
	//OpenID request canceled!
	define("LANG_MSG_OPENID_CANCEL", "Requisição do OpenID cancelada!");
	//Google request canceled!
	define("LANG_MSG_GOOGLE_CANCEL", "Requisição do Google cancelada!");
	//Invalid OpenID Identity!
	define("LANG_MSG_OPENID_INVALID", "Identificação do OpenID inválida!");
	//Forgot your password?
	define("LANG_MSG_FORGOT_YOUR_PASSWORD", "Esqueceu sua senha?");
	//What is OpenID?
	define("LANG_MSG_WHATISOPENID", "O que é OpenID?");
	//What is Facebook?
	define("LANG_MSG_WHATISFACEBOOK", "O que é Facebook?");
	//What is Google?
	define("LANG_MSG_WHATISGOOGLE", "O que é Google?");
	//Account successfully updated!
	define("LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED", "Conta atualizada com sucesso!");
	//Password successfully updated!
	define("LANG_MSG_PASSWORD_SUCCESSFULLY_UPDATED", "Senha atualizada com sucesso!");
	//"Thank you for signing up for an account in" [EDIRECTORY_TITLE]
	define("LANG_MSG_THANK_YOU_FOR_SIGNING_UP", "Obrigado por criar uma conta no");
	//Sign in to manage your account with the e-mail and password below.
	define("LANG_MSG_LOGIN_TO_MANAGE_YOUR_ACCOUNT", "Utilize o usuário e senha abaixo para gerenciar sua conta.");
	//You can see
	define("LANG_MSG_YOU_CAN_SEE", "Você pode ver");
	//Your account in
	define("LANG_MSG_YOUR_ACCOUNT_IN", "Sua conta em");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_ARTICLE_WILL_SHOW", "Este artigo mostrará");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_CLASSIFIED_WILL_SHOW", "Este classificado mostrará");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_EVENT_WILL_SHOW", "Este evento mostrará");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_LISTING_WILL_SHOW", "Esta empresa mostrará");
	//This [ITEM] will show [UNLIMITED|"the max of" X] images per gallery.
	define("LANG_MSG_THE_MAX_OF", "no máximo");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTO", "imagem");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTOS", "imagens");
	//This [ITEM] will show [UNLIMITED|the max of X] images "in the gallery"
	define("LANG_MSG_PER_GALLERY", "na galeria");
	// plus one main image.
	define("LANG_MSG_PLUS_MAINIMAGE", " mais uma imagem principal.");
	//Click here to pay for your article
	define("LANG_MSG_CONTINUE_TO_PAY_ARTICLE", "Clique aqui para pagar por seu artigo");
	//Click here to pay for your banner
	define("LANG_MSG_CONTINUE_TO_PAY_BANNER", "Clique aqui para pagar por seu banner");
	//Click here to pay for your classified
	define("LANG_MSG_CONTINUE_TO_PAY_CLASSIFIED", "Clique aqui para pagar por seu classificado");
	//Click here to pay for your event
	define("LANG_MSG_CONTINUE_TO_PAY_EVENT", "Clique aqui para pagar por seu evento");
	//Click here to pay for your listing
	define("LANG_MSG_CONTINUE_TO_PAY_LISTING", "Clique aqui para pagar por sua empresa");
	//Articles are activated by
	define("LANG_MSG_ARTICLES_ARE_ACTIVATED_BY", "Artigos são ativados pelo");
	//Banners are activated by
	define("LANG_MSG_BANNERS_ARE_ACTIVATED_BY", "Banners são ativados pelo");
	//Classifieds are activated by
	define("LANG_MSG_CLASSIFIEDS_ARE_ACTIVATED_BY", "Classificados são ativados pelo");
	//Events are activated by
	define("LANG_MSG_EVENTS_ARE_ACTIVATED_BY", "Eventos são ativados pelo");
	//Listings are activated by
	define("LANG_MSG_LISTINGS_ARE_ACTIVATED_BY", "Empresas são ativadas pelo");
	//only after the process is complete.
	define("LANG_MSG_ONLY_PROCCESS_COMPLETE", "somente depois que o processo estiver completo.");
    //You can only pay for [MAX_ITEMS_MODULE] each time.
    define("LANG_MSG_PROCCESS_MAXITEMS", "Você só pode pagar por [MAX_ITEMS_MODULE] por vez.");
    //Make the process again with less items.
    define("LANG_MSG_PROCCESS_AGAIN", "Faça o processo novamente com menos itens.");
	//Tips for the Item Map Tuning
	define("LANG_MSG_TIPSFORMAPTUNING", "Dicas para o Ajuste de Localização");
	//You can adjust the position in the map,
	define("LANG_MSG_YOUCANADJUSTPOSITION", "Você pode ajustar a posição no mapa,");
	//with more accuracy.
	define("LANG_MSG_WITH_MORE_ACCURACY", "com mais exatidão.");
	//Use the controls "+" and "-" to adjust the map zoom.
	define("LANG_MSG_USE_CONTROLS_TO_ADJUST", "Use os controles \"+\" e \"-\" para ajustar o zoom do mapa.");
	//Use the arrows to navigate on map.
	define("LANG_MSG_USE_ARROWS_TO_NAVIGATE", "Use as flechas para navegar no mapa.");
	//Drag-and-Drop the marker to adjust the location.
	define("LANG_MSG_DRAG_AND_DROP_MARKER", "Arraste e solte o marcador para ajustar a localização.");
    //Drag files here to upload
    define("LANG_MSG_DROP_IMAGE", "Arraste arquivos aqui para enviar");
	//Your deal will appear here
	define("LANG_MSG_PROMOTION_WILL_APPEAR_HERE", "Sua oferta aparecerá aqui");
	//Associate an existing deal with this listing
	define("LANG_MSG_ASSOCIATE_EXISTING_PROMOTION", "Relacionar uma oferta existente com esta empresa");
	//No results found!
	define("LANG_MSG_NO_RESULTS_FOUND", "Nenhum resultado encontrado!");
	//Access not allowed!
	define("LANG_MSG_ACCESS_NOT_ALLOWED", "Acesso não permitido!");
	//The following problems were found
	define("LANG_MSG_PROBLEMS_WERE_FOUND", "Os seguintes problemas foram encontrados");
	//No items selected or requiring payment.
	define("LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT", "Nenhum item selecionado ou requerendo pagamento.");
	//No items found.
	define("LANG_MSG_NO_ITEMS_FOUND", "Nenhum item encontrado.");
	//No invoices in the system.
	define("LANG_MSG_NO_INVOICES_IN_THE_SYSTEM", "Não há faturas no sistema.");
	//No transactions in the system.
	define("LANG_MSG_NO_TRANSACTIONS_IN_THE_SYSTEM", "Não há transações no sistema.");
	//Claim this Listing
	define("LANG_MSG_CLAIM_THIS_LISTING", "Solicite esta Empresa");
	//Go to sponsor check out area
	define("LANG_MSG_GO_TO_MEMBERS_CHECKOUT", "Ir à área de pagamento da seção de anunciante");
	//You can see your invoice in
	define("LANG_MSG_YOU_CAN_SEE_INVOICE", "Você pode ver sua fatura em");
	//I agree to terms
	define("LANG_MSG_AGREE_TO_TERMS", "Eu concordo com os termos de uso");
	//and I will send payment.
	define("LANG_MSG_I_WILL_SEND_PAYMENT", "e vou enviar o pagamento.");
	//This page will redirect you to your sponsor area in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU", "Esta página redirecionará você à seção de anunciante em alguns segundos.");
	//This page will redirect you to continue your signup process in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU_SIGNUP", "Você será redirecionado em alguns segundos para continuar o processo de cadastro.");
	//"If it doesn't work, please" click here
	define("LANG_MSG_IF_IT_DOES_NOT_WORK", "Se não funcionar, por favor,");
	//Manage Article
	define("LANG_MANAGE_ARTICLE", "Gerenciar Artigo");
	//Manage Banner
	define("LANG_MANAGE_BANNER", "Gerenciar Banner");
	//Manage Classified
	define("LANG_MANAGE_CLASSIFIED", "Gerenciar Classificados");
	//Manage Event
	define("LANG_MANAGE_EVENT", "Gerenciar Evento");
	//Manage Listing
	define("LANG_MANAGE_LISTING", "Gerenciar Empresa");
	//Manage Deal
	define("LANG_MANAGE_PROMOTION", "Gerenciar Oferta");
	//Manage Billing
	define("LANG_MANAGE_BILLING", "Gerenciar Fatura");
	//Manage Invoices
	define("LANG_MANAGE_INVOICES", "Gerenciar Faturas");
	//Manage Transactions
	define("LANG_MANAGE_TRANSACTIONS", "Gerenciar Transações");
	//No articles in the system.
	define("LANG_NO_ARTICLES_IN_THE_SYSTEM", "Não há artigos no sistema.");
	//No banners in the system.
	define("LANG_NO_BANNERS_IN_THE_SYSTEM", "Não há banners no sistema");
	//No classifieds in the system.
	define("LANG_NO_CLASSIFIEDS_IN_THE_SYSTEM", "Não há classificados no sistema.");
	//No events in the system.
	define("LANG_NO_EVENTS_IN_THE_SYSTEM", "Não há eventos no sistema");
	//No listings in the system.
	define("LANG_NO_LISTINGS_IN_THE_SYSTEM", "Não há empresas no sistema.");
	//No deals in the system.
	define("LANG_NO_PROMOTIONS_IN_THE_SYSTEM", "Não há ofertas no sistema.");
	//No Reports Available.
	define("LANG_NO_REPORTS", "Nenhum Relatório Disponível.");
	//No article found. It might be deleted.
	define("LANG_NO_ARTICLE_FOUND", "Nenhum artigo encontrado. Ele pode ter sido removido.");
	//No classified found. It might be deleted.
	define("LANG_NO_CLASSIFIED_FOUND", "Nenhum classificado encontrado. Ele pode ter sido removido.");
	//No listing found. It might be deleted.
	define("LANG_NO_LISTING_FOUND", "Nenhuma empresa encontrada. Ela pode ter sido removida.");
	//Article Information
	define("LANG_ARTICLE_INFORMATION", "Informação do Artigo");
	//Delete Article
	define("LANG_ARTICLE_DELETE", "Remover Artigo");
	//Delete Article Information
	define("LANG_ARTICLE_DELETE_INFORMATION", "Remover Informações do Artigo");
	//Are you sure you want to delete this article
	define("LANG_ARTICLE_DELETE_CONFIRM", "Você tem certeza que deseja remover este artigo?");
	//Article Preview
	define("LANG_ARTICLE_PREVIEW", "Visualizar Artigo");
	//Article Traffic Report
	define("LANG_ARTICLE_TRAFFIC_REPORT", "Relatório de Tráfego do Artigo");
	//Article Detail
	define("LANG_ARTICLE_DETAIL", "Detalhes do Artigo");
	//Edit Article Information
	define("LANG_ARTICLE_EDIT_INFORMATION", "Editar Informações do Artigo");
	//Delete Banner
	define("LANG_BANNER_DELETE", "Remover Banner");
	//Delete Banner Information
	define("LANG_BANNER_DELETE_INFORMATION", "Remover Informações do Banner");
	//Are you sure you want to delete this banner?
	define("LANG_BANNER_DELETE_CONFIRM", "Você tem certeza que deseja remover este banner?");
	//Edit Banner
	define("LANG_BANNER_EDIT", "Editar Banner");
	//Edit Banner Information
	define("LANG_BANNER_EDIT_INFORMATION", "Editar Informação do Banner");
	//Banner Preview
	define("LANG_BANNER_PREVIEW", "Visualizar Banner");
	//Banner Traffic Report
	define("LANG_BANNER_TRAFFIC_REPORT", "Relatório de Tráfego do Banner");
	//View Banner
	define("LANG_VIEW_BANNER", "Visualizar Banner");
	//Disabled
	define("LANG_BANNER_DISABLED", "Desabilitado");
	//Classified Information
	define("LANG_CLASSIFIED_INFORMATION", "Informação do Classificado");
	//Delete Classified
	define("LANG_CLASSIFIED_DELETE", "Remover Classificado");
	//Your classified will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_CLASSIFIED_AUTOMATICALLY_APPEAR", "Seu classificado irá aparecer na categoria principal de cada subcategoria que você selecionar.");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORY_PLURAL", "Categorias do Classificado");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORIES", "Categorias do Classificado");
	//Delete Classified Information
	define("LANG_CLASSIFIED_DELETE_INFORMATION", "Remover Informações do Classificado");
	//Are you sure you want to delete this classified
	define("LANG_CLASSIFIED_DELETE_CONFIRM", "Você tem certeza que deseja remover este classificado?");
	//Classified Map Tuning
	define("LANG_CLASSIFIED_MAP_TUNING", "Ajustar Localização do Classificado");
	//Classified Preview
	define("LANG_CLASSIFIED_PREVIEW", "Visualizar Classificado");
	//Classified Traffic Report
	define("LANG_CLASSIFIED_TRAFFIC_REPORT", "Relatório de Tráfego do Classificado");
	//Classified Detail
	define("LANG_CLASSIFIED_DETAIL", "Detalhes do Classificado");
	//Edit Classified Information
	define("LANG_CLASSIFIED_EDIT_INFORMATION", "Editar Informações do Classificado");
	//Edit Classified Level
	define("LANG_CLASSIFIED_EDIT_LEVEL", "Editar Nível do Classificado");
	//Delete Event
	define("LANG_EVENT_DELETE", "Remover Evento");
	//Delete Event Information
	define("LANG_EVENT_DELETE_INFORMATION", "Remover Informações do Evento");
	//Are you sure you want to delete this event
	define("LANG_EVENT_DELETE_CONFIRM", "Você tem certeza que deseja remover este evento?");
	//Event Information
	define("LANG_EVENT_INFORMATION", "Informações do Evento");
	//Event Map Tuning
	define("LANG_EVENT_MAP_TUNING", "Ajustar Localização do Evento");
	//Event Preview
	define("LANG_EVENT_PREVIEW", "Visualizar Evento");
	//Event Traffic Report
	define("LANG_EVENT_TRAFFIC_REPORT", "Relatório de Tráfego do Evento");
	//Event Detail
	define("LANG_EVENT_DETAIL", "Detalhes do Evento");
	//Edit Event Information
	define("LANG_EVENT_EDIT_INFORMATION", "Editar Informações do Evento");
	//Listing Information
	define("LANG_LISTING_INFORMATION", "Informações da Empresa");
	//Listing Map Tuning
	define("LANG_LISTING_MAP_TUNING", "Ajustar Localização da Empresa");
	//Listing Preview
	define("LANG_LISTING_PREVIEW", "Visualizar Empresa");
	//Listing Deal
	define("LANG_LISTING_PROMOTION", "Oferta da Empresa");
	//The deal is linked from the listing.
	define("LANG_LISTING_PROMOTION_IS_LINKED", "A oferta é acessada a partir da empresa");
	//To be active the deal
	define("LANG_LISTING_TO_BE_ACTIVE_PROMOTION", "Para estar ativa, a oferta");
	//must have an end date in the future.
	define("LANG_LISTING_END_DATE_IN_FUTURE", "deve ter uma data de término no futuro.");
	//must be associated with a listing.
	define("LANG_LISTING_ASSOCIATED_WITH_LISTING", "deve estar relacionada com uma empresa.");
	//Listing Traffic Report
	define("LANG_LISTING_TRAFFIC_REPORT", "Relatório de Tráfego da Empresa");
	//Listing Detail
	define("LANG_LISTING_DETAIL", "Detalhes da Empresa");
	//for listing
	define("LANG_LISTING_FOR_LISTING", "para a empresa");
	//Listing Update
	define("LANG_LISTING_UPDATE", "Editar Empresa");
	//Delete Deal
	define("LANG_PROMOTION_DELETE", "Remover Oferta");
	//Delete Deal Information
	define("LANG_PROMOTION_DELETE_INFORMATION", "Remover Informações da Oferta");
	//Are you sure you want to delete this deal?
	define("LANG_PROMOTION_DELETE_CONFIRM", "Você tem certeza que deseja remover esta Oferta?");
	//Deal Preview
	define("LANG_PROMOTION_PREVIEW", "Visualizar Oferta");
	//Deal Traffic Report
	define("LANG_PROMOTION_TRAFFIC_REPORT", "Relatório de Tráfego da Oferta");
	//Deal Information
	define("LANG_PROMOTION_INFORMATION", "Informações da Oferta");
	//Deal Detail
	define("LANG_PROMOTION_DETAIL", "Detalhes da Oferta");
	//Edit Deal Information
	define("LANG_PROMOTION_EDIT_INFORMATION", "Editar Informações da Oferta");
	//Image successfully deleted!
	define("LANG_IMAGE_SUCCESSFULLY_DELETED", "Imagem removida com sucesso!");
	//Review Detail
	define("LANG_REVIEW_DETAIL", "Detalhes da Avaliação");
	//Review Preview
	define("LANG_REVIEW_PREVIEW", "Visualizar Avaliação");
	//Invoice Detail
	define("LANG_INVOICE_DETAIL", "Detalhes da Fatura");
	//Invoice not found for this account.
	define("LANG_INVOICE_NOT_FOUND_FOR_ACCOUNT", "Fatura não encontrada para esta conta.");
	//Invoice Notification
	define("LANG_INVOICE_NOTIFICATION", "Notificação de Fatura");
	//Transaction Detail
	define("LANG_TRANSACTION_DETAIL", "Detalhes da Transação");
	//Transaction not found for this account.
	define("LANG_TRANSACTION_NOT_FOUND_FOR_ACCOUNT", "Transação não encontrada para esta conta.");
	//Sign in with Directory Account
	define("LANG_LOGINDIRECTORYUSER", "Entrar com minha conta do Diretório");
	//Sign in with OpenID 2.0 Account
	define("LANG_LOGINOPENIDUSER", "Entrar com minha conta do OpenID 2.0");
	//Log in with Facebook
	define("LANG_LOGINFACEBOOKUSER", "Entrar com Facebook");
	//Sign up with Facebook
	define("LANG_SIGNUPFACEBOOKUSER", "Cadastrar com Facebook");
	//Log in with Google
	define("LANG_LOGINGOOGLEUSER", "Entrar com Google");
	//Sign up with Google
	define("LANG_SIGNUPGOOGLEUSER", "Cadastrar com Google");
	//Username already registered!
	define("LANG_USERNAME_ALREADY_REGISTERED", LANG_LABEL_USERNAME." já registrado!");
	//This e-mail is available.
	define("LANG_USERNAME_NOT_REGISTERED", "Este e-mail está disponível.");
	//Error uploading image. Please try again.
	define("LANG_MSGERROR_ERRORUPLOADINGIMAGE", "Erro no envio da imagem. Por favor, tente de novo.");
	//Image successfully uploaded
	define("LANG_IMAGE_SUCCESSFULLY_UPLOADED", "Imagem enviada com sucesso!");
	//Image successfully updated
	define("LANG_IMAGE_SUCCESSFULLY_UPDATED", "Imagem alterada com sucesso!");
	//Delete image
	define("LANG_DELETE_IMAGE", "Apagar Imagem");
	//Are you sure you want to delete this image
	define("LANG_DELETE_IMAGE_CONFIRM", "Tem certeza que deseja apagar esta imagem?");
	//Edit Image
	define("LANG_LABEL_EDITIMAGE", "Editar Imagem");
	//Make main
	define("LANG_LABEL_MAKEMAIN", "Tornar principal");
	//Main image
	define("LANG_LABEL_MAINIMAGE", "Principal");
	//Click here to set as main image
	define("LANG_LABEL_CLICKTOSETMAINIMAGE", "Clique aqui para salvar como imagem principal");
	//Click here to set as gallery image
	define("LANG_LABEL_CLICKTOSETGALLERYIMAGE", "Clique aqui para salvar como imagem da galeria");
	//Packages
	define("LANG_PACKAGE_PLURAL", "Pacotes");
	//Package
	define("LANG_PACKAGE_SING", "Pacote");
	//Charging for package
	define("LANG_CHARGING_PACKAGE", "Cobrança do pacote ");

	# ----------------------------------------------------------------------------------------------------
	# SOCIAL NETWORK
	# ----------------------------------------------------------------------------------------------------
	//Profile successfully updated!
	define("LANG_MSG_PROFILE_SUCCESSFULLY_UPDATED", "Perfil atualizado com sucesso!");
	//Profile
	define("LANG_LABEL_PROFILE", "Perfil");
	//Edit Profile
	define("LANG_LABEL_EDIT_PROFILE", "Editar Perfil");
	//Load from Facebook
	define("LANG_LABEL_IMAGE_FROM_FACEBOOK", "Carregar do Facebook.");
	//Personal Infomation
	define("LANG_LABEL_PERSONAL_INFORMATION", "Informações Pessoais");
	//Twitter Account
	define("LANG_LABEL_TWITTER_ACCOUNT", "Conta do Twitter");
	//Twitter Widget
	define("LANG_LABEL_TWITTER_WIDGET", "Widget do Twitter");
	//About me
	define("LANG_LABEL_ABOUT_ME", "Sobre Mim");
	//Birthdate
	define("LANG_LABEL_BIRTHDATE", "Data de Aniversário");
	//Hometown
	define("LANG_LABEL_HOMETOWN", "Cidade Natal");
	//Favorite Books
	define("LANG_LABEL_FAVORITEBOOKS", "Livros Favoritos");
	//Favorite Movies
	define("LANG_LABEL_FAVORITEMOVIES", "Filmes Favoritos");
	//Favorite Sports
	define("LANG_LABEL_FAVORITESPORTS", "Esportes Favoritos");
	//Favorite Musics
	define("LANG_LABEL_FAVORITEMUSICS", "Músicas Favoritas");
	//Favorite Foods
	define("LANG_LABEL_FAVORITEFOODS", "Comidas Favoritas");
	//Are you sure?
	define("LANG_MESSAGE_MSGAREYOUSURE", "Você tem certeza?");
	//This is the URL where visitors can see your public profile page
	define("LANG_MSG_FRIENDLY_URL_PROFILE_TIP", "Esta é a URL onde os visitantes podem ver a sua página de perfil público");
	//Your URL
	define("LANG_LABEL_YOUR_URL", "Sua URL");
    //Your URL is required.
	define("LANG_LABEL_YOURURL_REQUIRED", "Sua URL é requerida.");
    //yoururl
    define("LANG_LABEL_YOUR_URLTIP", "suaurl");
    //Available URL
    define("LANG_LABEL_URLOK", "URL disponível");
    //Unavailable URL
    define("LANG_LABEL_URLNOTOK", "URL indisponível");
	//Your URL contains invalid chars.
	define("LANG_MSG_FRIENDLY_URL_INVALID_CHARS", "Sua URL contém caracteres inválidos.");
	//URL already in use, please choose another URL.
	define("LANG_MSG_PAGE_URL_IN_USE", "URL já em uso, escolha outra URL.");
	//View all
	define("LANG_LABEL_VIEW_ALL", "Ver todos");
	//View all
	define("LANG_LABEL_VIEW_ALL2", "Ver todas");
	//No Items
	define("LANG_MSG_NO_ITEMS", "Nenhum Item");
	//Share
	define("LANG_LABEL_SHARE", "Compartilhar");
	//Comments
	define("LANG_LABEL_COMMENTS", "Comentários");
	//My Profile
	define("LANG_LABEL_MYPROFILE", "Meu Perfil");
	//User profile successfully enabled!
	define("LANG_MSG_PROFILE_ENABLED", "Perfil do Usuário habilitado com sucesso!");
	//Display my contact information publicly
	define("LANG_LABEL_PUBLISH_MY_CONTACT", "Publicar minhas informações de contato");
	//Create my Personal Page
	define("LANG_LABEL_CREATE_PERSONAL_PAGE", "Criar minha página pessoal");
	//Public Profile
	define("LANG_LABEL_PERSONAL_PAGE", "Página Pessoal");
	//Article Reviews
	define("LANG_LABEL_ARTICLE_REVIEW", "Avaliações de Artigos");
	//Listing Reviews
	define("LANG_LABEL_LISTING_REVIEW", "Avaliações de Empresas");
	//Deal Reviews
	define("LANG_LABEL_PROMOTION_REVIEW", "Avaliações de Ofertas");
	//Review successfully deleted.
	define("LANG_MSG_REVIEW_SUCCESS_DELETED", "Avaliação apagada com sucesso.");
	//No reviews found!
	define("LANG_LABEL_NOREVIEWS", "Nenhuma avaliação encontrada!");
	//Edit my Profile
	define("LANG_LABEL_EDITPROFILE", "Editar meu Perfil");
	//Back to my Profile
	define("LANG_LABEL_BACKTOPROFILE", "Voltar ao meu Perfil");
	//Member Since
	define("LANG_LABEL_MEMBER_SINCE", "Membro Desde");
	//Account Settings
	define("LANG_LABEL_ACCOUNT_SETTINGS", "Configurações da Conta");
    //Deals Redeemed
	define("LANG_LABEL_ACCOUNT_DEALS", "Ofertas Resgatadas");
	//Favorites
	define("LANG_LABEL_FAVORITES", "Favoritos");
	//You have no permission to access this area.
	define("LANG_MSG_NO_PERMISSION", "Você não tem permissão para acessar esta área.");
	//Go to your Profile
	define("LANG_MSG_GO_PROFILE", "Ir para o seu Profile.");
	//My Personal Page
	define("LANG_MSG_MY_PERSONAL_PAGE", "Minha Página Pessoal");
	//Use this Account
	define("LANG_MSG_USE_LOGGED_ACCOUNT", "Usar esta Conta");
	//Profile Page
	define("LANG_LABEL_PROFILE_PAGE", "Página Pessoal");
	//Create your Profile
	define("LANG_CREATE_MEMBER_PROFILE", "Crie o seu Perfil");
	//Your Name is required.
	define("LANG_MSG_NICKANAME_REQUIRED", "Nome é obrigatório.");
	//Be sure that the twitter account you are adding is not protected. If the twitter account is protected the latest tweets on this account will not be shown.
	define("LANG_PROFILE_TWITTER_TIP1", "Tenha certeza de que a conta do twitter que você está adicionando não esteja protegida. Se a conta do twitter estiver protegida os últimos tweets desta conta não serão mostrados.");
	//Thank you for signing up!
    define("LANG_PROFILE_WELCOME", "Obrigado por se inscrever!");
    //We appreciate it and welcome to
    define("LANG_PROFILE_WELCOME2", "Nós agradecemos e bem-vindo a");

	# ----------------------------------------------------------------------------------------------------
	# GALLERY
	# ----------------------------------------------------------------------------------------------------
	//Only
	define("LANG_ONLY", "Apenas imagens ");
	//images accepted for upload!
	define("LANG_IMAGES_ACCEPETED", "são aceitas para envio!");
	//Images must be under
	define("LANG_IMAGE_MUST_BE", "Imagens devem ter menos que ");
	//Select an image for upload!
	define("LANG_SELECT_IMAGE", "Selecione uma imagem para enviar!");
	//Original image
	define("LANG_ORIGINAL", "Imagem original");
	//Thumbnail preview
	define("LANG_THUMB_PREVIEW", "Miniatura");
	//Edit captions
	define("LANG_LABEL_EDIT_CAPTIONS", "Legendas");
	//You can add the maximum of
	define("LANG_YOU_CAN_ADD_MAXOF", "Você pode adicionar no máximo ");
	//photos to your gallery
	define("LANG_TO_YOUR_GALLERY", " fotos na sua galeria!");
	//Create Thumbnail
	define("LANG_CREATE_THUMB", "Criar miniatura");
	//Thumbnail Preview
	define("LANG_THUMB_PREVIEW", "Visualizar miniatura");
	//Your item already has the maximum number of images in the gallery. Delete an existing image to save this one.
	define("LANG_ITEM_ALREADY_HAD_MAX_IMAGE", "Seu item já possui o número máximo de imagens na galeria. Para salvar a nova imagem, exclua uma das já existentes.");

	# ----------------------------------------------------------------------------------------------------
	# RECURRING EVENTS
	# ----------------------------------------------------------------------------------------------------
	//Recurring Event
	define("LANG_EVENT_RECURRING", "Evento Recorrente");
	//Repeat
	define("LANG_PERIOD", "Repetição");
	//Choose an option
	define("LANG_CHOOSE_PERIOD", "Escolha uma opção");
	//Daily
	define("LANG_DAILY", "Diário");
	//Weekly
	define("LANG_WEEKLY", "Semanal");
	//Monthly
	define("LANG_MONTHLY", "Mensal");
	//Yearly
	define("LANG_YEARLY", "Anual");
	//Daily Event
	define("LANG_DAILY2", "Evento Diário");
	//Weekly
	define("LANG_WEEKLY2", "Semanalmente");
	//Monthly
	define("LANG_MONTHLY2", "Mensalmente");
	//Yearly
	define("LANG_YEARLY2", "Anualmente");
	//every
	define("LANG_EVERY", "Todo(a)");
	//every
	define("LANG_EVERY2", "Todo(a)");
	//of
	define("LANG_OF", "do(a)");
	//of
	define("LANG_OF2", "de");
	//of
	define("LANG_OF3", "da");
	//of
	define("LANG_OF4", "do");
	//Week
	define("LANG_WEEK", "Semana");
	//Choose Month
	define("LANG_CHOOSE_MONTH", "Escolha o Mês");
	//Choose Day
	define("LANG_CHOOSE_DAY", "Escolha o Dia");
	//Choose Week
	define("LANG_CHOOSE_WEEK", "Escolha a Semana");
	//First
	define("LANG_FIRST", "Primeiro(a)");
	//Second
	define("LANG_SECOND", "Segundo(a)");
	//Third
	define("LANG_THIRD", "Terceiro(a)");
	//Fourth
	define("LANG_FOURTH", "Quarto(a)");
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
	define("LANG_RECURRING", "Recorrente");
	//Please select a day of week
	define("LANG_EVENT_SELECT_DAYOFWEEK", "Por favor, selecione um dia da semana.");
	//Please type a day
	define("LANG_EVENT_TYPE_DAY", "Por favor, informe o dia.");
	//Please select a month
	define("LANG_EVENT_SELECT_MONTH", "Por favor, selecione o mês.");
	//Please select a week
	define("LANG_EVENT_SELECT_WEEK", "Por favor, selecione a semana.");
	//Please select a Repeat option
	define("LANG_EVENT_SELECT_PERIOD", "Por favor, selecione uma opção de Repetição.");
	//When
	define("LANG_EVENT_WHEN", "Quando");
	//Day must be numeric
	define("LANG_EVENT_TYPE_DAY_NUMERIC", "Dia deve ser um número.");
	//Day must be between 1 and 31
	define("LANG_EVENT_TYPE_DAY_BETWEEN", "Dia deve estar entre 1 e 31.");
	//Day doesn't match with the choosen period
	define("LANG_EVENT_CHECK_DAY", "Dia não coincide com o período selecionado.");
	//Month doesn't match with the choosen period
	define("LANG_EVENT_CHECK_MONTH", "Mês não coincide com o período selecionado.");
	//Days don't match with the choosen period
	define("LANG_EVENT_CHECK_DAYOFWEEK", "Dias não coincidem com o período selecionado.");
	//Week doesn't match with the choosen period
	define("LANG_EVENT_CHECK_WEEK", "Semana não coincide com o período selecionado.");
	//No info
	define("LANG_EVENT_NO_INFO", "Sem informação");
	//Ends on
	define("LANG_ENDS_IN", "Termina em");
	//Never
	define("LANG_NEVER", "Nunca");
	//Until
	define("LANG_UNTIL", "Até");
	//Until Date
	define("LANG_LABEL_UNTIL_DATE", "Até");
	//The "Until Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_UNTIL_DATE_GREATER_THAN_START_DATE", "\"Até\" deve ser maior ou igual à \"Data de Início\".");
	//The "Until Date" cannot be in past.
	define("LANG_MSG_UNTIL_DATE_CANNOT_IN_PAST", "\"Até\" não pode estar no passado.");
	//Starts on
	define("LANG_EVENT_STARTS_ON", "Começa em");
	//Starts
	define("LANG_EVENT_STARTS", "Começa");
	//Repeats
	define("LANG_EVENT_REPEATS", "Repete");
	//Ends on
	define("LANG_EVENT_ENDS", "Termina em");
	//weekend
	define("LANG_EVENT_WEEKEND", "final de semana");
	//weekends
	define("LANG_EVENT_WEEKENDS", "fins de semana");
	//Mon-Fri
	define("LANG_EVENT_BUSINESSDAY", "Seg-Sex");
	//the Month
	define("LANG_THE_MONTH", "Mês");
	//Every Year
	define("LANG_EVERY_YEAR", "Anualmente");

	# ----------------------------------------------------------------------------------------------------
	# SITES
	# ----------------------------------------------------------------------------------------------------
	//Site
	define("LANG_DOMAIN", "Site");
	//Site name
	define("LANG_DOMAIN_NAME", "Nome do site");
	//Click here to view this site
	define("LANG_MSG_CLICK_TO_VIEW_THIS_DOMAIN", "Clique aqui para visualizar este site");
	//Click here to delete this site
	define("LANG_MSG_CLICK_TO_DELETE_THIS_DOMAIN", "Clique aqui para remover este site");
	//Site successfully deleted!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_DELETE", "Site excluído com sucesso!");
	//Site successfully added!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2", "Site adicionado com sucesso!");
	//An email notification will be sent to the eDirectory support team, please wait our contact.
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD", LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2."<br />Uma notificação de email foi enviada para o time de suporte do eDirectory, por favor aguarde nosso contato.");
    //Site name is required
	define("LANG_MSG_DOMAINNAME_IS_REQUIRED", "Nome do site é requerido");
    //Site URL is required
	define("LANG_MSG_DOMAINURL_IS_REQUIRED", "URL do site é requerida");
	//Site name already exists
	define("LANG_MSG_DOMAINNAME_ALREADY_EXISTS", "Nome do site já existe");
	//Site URL already exists
	define("LANG_MSG_DOMAINURL_ALREADY_EXISTS", "URL do site já existe");
	//Site URL not valid
	define("LANG_MSG_DOMAINURL_INVALID_CHARS", "URL do site não é válida");
	//Site Items
	define("LANG_SITE_ITEMS", "Itens do Site");
	//Select a Site
	define("LANG_SELECT_DOMAIN", "Alterar Site");

	# ----------------------------------------------------------------------------------------------------
	# PROFILE
	# ----------------------------------------------------------------------------------------------------
    //Sign Up with a new Account
    define("LANG_LABEL_PROFILE_SIGNUP", "Inscreva-se com uma nova conta");
    //OR
    define("LANG_LABEL_PROFILE_OR", "OU");
    //Sign In with an existing account
    define("LANG_LABEL_PROFILE_FOREIGNACC", "Entre com uma conta existente");
    //Or use your OpenID to sign in
    define("LANG_LABEL_PROFILE_OPENID", "Ou use seu OpenID para entrar");
    //Your OpenID
    define("LANG_LABEL_PROFILE_YOUROPENID", "Seu OpenID");
    //Login
    define("LANG_LABEL_PROFILE_LOGIN", "Entrar");
    //Once you have created your account using a foreign system, it was activated automatically. Please disregard this message.
    define("LANG_LABEL_PROFILE_ACTIVATED", "Uma vez que você criou sua conta usando um sistema externo, ela já foi ativada automaticamente. Por favor, desconsidere essa mensagem.");
	//Thank you for activating your account. The next step is to complete your profile.
    define("LANG_LABEL_PROFILE_WELCOME_ACT", "Obrigado para ativar sua conta. O próximo passo é completar o seu perfil.");
    //Your account has not been activated yet. Check your activation e-mail and come back later to complete your profile.
    define("LANG_LABEL_PROFILE_WELCOME_NOTACT", "Sua conta não foi ativada. Verifique seu e-mail de ativação e volte mais tarde para completar o seu perfil.");
    //Complete your profile
    define("LANG_LABEL_PROFILE_COMPLETE", "Complete o seu perfil");
    //RECENT ACTIVITY
    define("LANG_LABEL_PROFILE_RECENT_ACTIVITY", "ATIVIDADES RECENTE");
    //You have no recent activity.
    define("LANG_LABEL_PROFILE_RECENT_ACTIVITY_EMPTY", "Você não tem nenhuma atividade.");
    //Review on
    define("LANG_LABEL_PROFILE_REVIEWON", "Avaliação em");
    //You can connect your directory account with social networks
    define("LANG_LABEL_PROFILE_SNTIP", "Você pode conectar sua conta do diretório com as redes sociais");
    //Change photo
    define("LANG_LABEL_PROFILE_CHANGEPHOTO", "Alterar foto");
    //Remove photo
    define("LANG_LABEL_PROFILE_REMOVEPHOTO", "Remover foto");
    //Display Name
    define("LANG_LABEL_PROFILE_DISPLAYNAME", "Nome de exibição");
    //Personal Page
    define("LANG_LABEL_PROFILE_PERSONALPAGE", "Página Pessoal");
    //Account Username
    define("LANG_LABEL_ACCOUNT_USERNAME", "Nome de Usuário");
    //You can change your e-mail access at any time. This is also the contact e-mail we use to reach you.
    define("LANG_LABEL_ACCOUNT_USERNAME_TIP", "Você pode mudar o seu e-mail de acesso a qualquer momento. Este também é o e-mail de contato que usamos para chegar até você.");
    //Activated
    define("LANG_LABEL_ACCOUNT_ACT", "Ativado");
    //Account not activated.
    define("LANG_LABEL_ACCOUNT_NOTACT", "Conta não ativada.");
    //Activate account.
    define("LANG_LABEL_ACTIVATE_ACC", "Ativar conta.");
    //Your activation e-mail has been sent. Please, check your inbox.
    define("LANG_LABEL_ACTIVATEEMAIL_SENT", "Seu e-mail de ativação foi enviado. Por favor, verifique a sua caixa de entrada.");
    //There was an error trying to send you a new activation e-mail.
    define("LANG_LABEL_ACTIVATEEMAIL_SENT_ERROR", "Houve um erro ao tentar enviar um novo e-mail de ativação.");
    //get a new activation e-mail.
    define("LANG_LABEL_ACTIVATEEMAIL_GETNEW", "receber um novo e-mail de ativação.");
    //Change Password
    define("LANG_LABEL_ACCOUNT_CHANGEPASS", "Alterar Senha");
    //You can change your password at any time you want.
    define("LANG_LABEL_ACCOUNT_CHANGEPASS_TIP", "Você pode alterar sua senha a qualquer hora que quiser.");
    //This information will be hidden unless you click the publish checkbox below
    define("LANG_LABEL_ACCOUNT_CONTACT_TIP", "Estas informações não serão publicados se você não quiser.");
    //Settings
    define("LANG_LABEL_CONTACT_SETTINGS", "Configurações");
    //Check your preferences
    define("LANG_LABEL_CONTACT_SETTINGS_TIP", "Verifique as suas preferências");
    //Profile Options
    define("LANG_MENU_PROFILEOPTIONS", "Opções de Perfil");
    //Profile Information
	define("LANG_LABEL_PROFILE_INFORMATION", "Informações do Perfil");
	//Social Networking
	define("LANG_LABEL_FOREIGN_ACCOUNTS", "Redes Sociais");
	//Link and import informations
	define("LANG_LABEL_CONNECT_WITH_FB_AND_IMPORT", "Associar e importar informações");
	//Just link
	define("LANG_LABEL_CONNECT_WITH_FB", "Apenas associar");
	//Link my Facebook account
	define("LANG_LABEL_LINK_FACEBOOK", "Associar à minha conta do Facebook");
	//Unlink my Facebook account
	define("LANG_LABEL_UNLINK_FB", "Desassociar minha conta do Facebook");
	//Your account was unlinked from Facebook
	define("LANG_LABEL_FB_ACT_DISC", "Sua conta foi desassociada do Facebook");
	//Your Facebook account is already linked with other account in the system.
	define("LANG_FB_ALREADY_LINKED", "Sua conta do Facebook já está associada a outra conta no sistema.");
	//Your Twitter account is already linked with other account in the system.
	define("LANG_TW_ALREADY_LINKED", "Sua conta do Twitter já está associada a outra conta no sistema.");
	//Linked to twitter as
	define("LANG_MSG_LINKED_TW_AS", "Conectado ao Twitter como");
	//Connected as
	define("LANG_LABEL_CONECTED_AS", "Conectado como");
	//Location options
	define("LANG_LABEL_LOCATIONPREF", "Opções de localidade");
	//Choose your location preferences in order to auto fill your searches by location
	define("LANG_LABEL_CHOOSELOCATIONPREF", "Escolha suas preferências de localização, a fim de auto preencher suas pesquisas por localização");
	//Use your current location
	define("LANG_LABEL_USECURRENTLOCATION", "Usar sua localidade atual");
	//Use Facebook Location
	define("LANG_LABEL_USEFACEBOOKLOCATION", "Usar localidade do Facebook");
	//Connect to Facebook
	define("LANG_LABEL_CONECTED_TO_FB", "Conectar ao Facebook");
	//Facebook account
	define("LANG_LABEL_FACEBOOK_ACCT", "Conta do Facebook");
	//Google account
	define("LANG_LABEL_GOOGLE_ACCT", "Conta do Google");
	//Change account
	define("LANG_LABEL_CHANGE_ACCT", "Mudar a conta");
	//Twitter account
	define("LANG_LABEL_FB_ACCT", "Conta do Twitter");
	//Twitter connection
	define("LANG_LABEL_TW_CONN", "Conexão com Twitter");
	//Link my Twitter account
	define("LANG_LABEL_TW_LINK", "Associar à minha conta do Twitter");
	//Unlink my Twitter account
	define("LANG_LABEL_UNLINK_TW", "Desassociar minha conta do Twitter");
	//Post redeems on my twitter account automatically
	define("LANG_LABEL_POSTRED", "Publicar ofertas resgatadas diretamente na minha conta do Twitter");
	//Your account was unlinked from twitter
	define("LANG_LABEL_TW_ACT_DISC", "Sua conta foi desassociada do Twitter");
	//You must sign in through twitter first
	define("LANG_LABEL_TW_SIGNTW", "Você precisa conectar no Twitter primeiro");
	//Your Twitter account was successfully connected
	define("LANG_LABEL_TW_SIGNTW_CONN", "Sua conta do Twitter foi conectada com sucesso");
	//Your Facebook account was successfully connected
	define("LANG_LABEL_FB_SIGNFB_CONN", "Sua conta do Facebook foi conectada com sucesso");
	//Your are already logged Facebook account as
	define("LANG_LABEL_FB_ALREADYLOGGED", "Você já está conectado no Facebook como");
	//This user is already attached to another directory account.
	define("LANG_LABEL_FB_ALREADYATTACHED", "Esse usuário já esta conectado com outra conta.");
	//Click here to switch to this account
	define("LANG_LABEL_FB_CLICKHERETOSWITCH", "Clique aqui para trocar essa conta");
	//Connect to Facebook
	define("LANG_LABEL_CONN_FB", "Conectar ao Facebook");
	//Use this language upon each sign in to my account
	define("LANG_LABEL_USE_SELECTEDLANGUAGE", "Use este idioma a cada vez que entrar na minha conta");
    //View my profile page
    define("LANG_LABEL_VIEW_PROFILE", "Ver meu perfil");

	# ----------------------------------------------------------------------------------------------------
	# DEALS
	# ----------------------------------------------------------------------------------------------------
	//I just got a great deal
	define("DEAL_LIKEDTHIS", "Gostei disso");
	//Redeem
	define("DEAL_REDEEM", "Resgatar");
	//Redeem this deal
	define("DEAL_REDEEMTHIS", "Resgatar esta oferta");
	//To redeem you need to post this deal information on your Facebook or Twitter.
	define("DEAL_REDEEMINFO1", "Para resgatar, você precisa publicar essa informação no seu Facebook ou Twitter.");
	//You can set this button to automatic post on your Profile.
	define("DEAL_REDEEMINFO2", "Você pode configurar este botão para publicar automaticamente no seu perfil.");
	//Click here to configure it
	define("DEAL_CLICKHERETO", "Clique aqui para configurá-lo");
	//Please wait, posting on Facebook and Twitter (if available).
	define("DEAL_PLEASEWAIT_POSTING", "Por favor aguarde, publicando no Facebook e/ou Twitter (se disponível).");
	//You already redeemed this deal! Your code is
	define("DEAL_YOUALREADY", "Você já resgatou esta oferta! Seu código é");
	//Deal done! This is your redeem code
	define("DEAL_DEALDONE", "Oferta resgatada! Este é seu código:");
	//No one has redeemed this deal on Facebook yet.
	define("DEAL_REDEEM_NONE_FB", "Ninguém resgatou esta oferta no Facebook ainda.");
	//No one has redeemed this deal on Twitter yet.
	define("DEAL_REDEEM_NONE_TW", "Ninguém resgatou esta oferta no Twitter ainda.");
	//Recent done deals
	define("DEAL_RECENTDEALS", "Ofertas resgatadas recentemente");
	//No deals found!
	define("DEAL_DIDNTNOTFINISHED", "Nenhuma oferta encontrada!");
	//This deal is not available anymore.
	define("DEAL_NA", "Esta oferta não está mais disponível.");
	//To redeem this deal you need to post to your Facebook wall. First, sign using the Facebook login button and you will need to approve this Application to do it.
	define("DEAL_REDEEMINFO_1", "Para resgatar esta oferta você precisa publicar no seu mural do Facebook. Primeiro entre utilizando sua conta do Facebook e aprove nossa aplicação para funcionar no seu perfil.");
	//You already did this deal!
	define("DEAL_REDEEM_DONEALREADY", "Você já resgatou esta oferta!");
	//Sorry, there was an error trying to post on your Facebook wall. Please try again.
	define("DEAL_REDEEMINFO_2", "Desculpe, houve um erro na tentativa de publicar no seu mural do Facebook. Por favor, tente novamente.");
	//Value
	define("DEAL_VALUE", "Valor");
	//With this coupon
	define("DEAL_WITHTHISCOUPON", "Com esta oferta");
	//Thank you
	define("DEAL_THANKYOU", "Obrigado");
	//Original value
	define("DEAL_ORIGINALVALUE", "Valor original");
	//Amount paid
	define("DEAL_AMOUNTPAID", "Valor pago");
	//Valid until
	define("DEAL_VALIDUNTIL", "Valido até");
	//Coupon must be presented to receive discount
	define("DEAL_INFODETAILS1", "O código deve ser mostrado para validar o desconto");
	//Limit of 1 coupon per purchase
	define("DEAL_INFODETAILS2", "Limite de uma oferta por compra");
	//Not valid with other coupons, offers or discounts of any kind
	define("DEAL_INFODETAILS3", "Não válido para outras ofertas ou outros descontos");
	//Valid only for Listing Name - Address
	define("DEAL_INFODETAILS4", "Válido apenas para itens relacionados à ofertas");
	//Print deal
	define("DEAL_PRINTDEAL", "Imprimir Oferta");
	//deal done
	define("DEAL_DEALSDONE", "Oferta Concluída");
	//deals done
	define("DEAL_DEALSDONE_PLURAL", "Ofertas Concluídas");
	//Deals redeemed
	define("LANG_LABEL_DEAL_BOUGHT", "Ofertas resgatadas");
	//Deals left
	define("LANG_LABEL_DEAL_LEFT", "Ofertas restantes");
	//Left
	define("DEAL_LEFTAMOUNT", "Restantes");
	//Sold Out
	define("DEAL_SOLDOUT", "Vendido");
	//Sorry, this deal doesn't exist or it was removed by owner
	define("DEAL_DOESNTEXIST", "Desculpe, esta oferta não existe ou foi removida pelo proprietário");
	//at
	define("DEAL_AT", "em");
	//Friendly URL
	define("DEAL_FRIENDLYURL", "Endereço amigável");
	//Select a listing
	define("DEAL_SELECTLISTING", "Selecione uma empresa");
	//Tagline for Deals
	define("DEAL_TAG", "Mensagem no mural do Facebook");
	//Visibility
	define("LANG_SITEMGR_VISIBILITY", "Visibilidade");
	//This deal will show up on
	define("LANG_SITEMGR_DEALSHOWUP", "Esta oferta vai aparecer em");
	//searches and nearby feature
	define("LANG_SITEMGR_DEALSEARCHES_NEARBY", "buscas gerais e aproximadas");
	//Nearby
	define("LANG_LABEL_NEARBY", "Próximo");
	//About Us
	define("LANG_MENU_ABOUT", "Sobre Nós");
	//My Favorites
	define("LANG_MENU_FAVORITES", "Meus Favoritos");
	//My Deals
	define("LANG_MENU_MYDEALS", "Minhas Ofertas");
	//My Reviews
	define("LANG_MENU_MYREVIEWS", "Minhas Avaliações");
	//My Account
	define("LANG_MENU_ACCOUNT", "Minha Conta");
	//24 hours / day
	define("LANG_SITEMGR_TWFOURHOURSDAY", "24 horas / dia");
	//Custom range
	define("LANG_SITEMGR_CUSTOMRANGE", "Período específico");
	//Discount information
	define("LANG_SITEMGR_DISCINFO", "Informação de desconto");
	//Item Value
	define("LANG_SITEMGR_ITEMVALUE", "Valor do Item");
	//Discount
	define("LANG_SITEMGR_DISCOUNT", "Desconto");
	//Value with discount
	define("LANG_DEAL_WITH_DISCOUNT", "Valor com desconto");
	//Amount of deals
	define("LANG_SITEMGR_AMOUNTOFDEALS", "Quantidade de ofertas");
    //deals done until now
	define("LANG_SITEMGR_DONEUNTIL_SINGULAR", "oferta finalizada até agora");
    //deals done until now
	define("LANG_SITEMGR_DONEUNTIL_PLURAL", "ofertas finalizadas até agora");
	//left
	define("LANG_SITEMGR_LEFT", "restantes");
    //OFF
    define("LANG_DEAL_OFF", "OFF");
    //Please wait, loading...
    define("LANG_DEAL_PLEASEWAITLOADING", "Por favor aguarde, carregando...");
    //Please wait. We are redirecting your login to complete this step...
    define("LANG_DEAL_PLEASEWAITLOADING2", "Por favor aguarde. Estamos redirecionando sua conta para finalizar esse passo...");
    //Item Value is required.
    define("LANG_MSG_VALIDDEAL_REALVALUE", "Valor do Item é requerido.");
    //Value with Discount is required.
    define("LANG_MSG_VALIDDEAL_DEALVALUE", LANG_LABEL_DISC_AMOUNT." é requerido.");
	//Value with Discount can not be higher than 99.
    define("LANG_MSG_VALIDDEAL_DEALVALUE2", LANG_LABEL_DISC_AMOUNT." não pode ser superior a 99.");
    //Deals to offer is required.
    define("LANG_MSG_VALIDDEAL_AMOUNT", "Ofertas a oferecer é requerida.");
    //Please enter a minor value on Value with Discount field.
    define("LANG_MSG_VALID_MINOR", "Por favor insira um número menor no campo ".LANG_LABEL_DISC_AMOUNT);
    //Redemeed at
    define("LANG_DEAL_REMEEDED_AT", "Validado em");
    //You can only directly link this deal to a listing if you select one account first
    define("DEAL_LINK2LISTING_ACCTINFO", "Você só poderá relacionar a oferta com uma empresa se escolher uma conta primeiro");
    //Value
    define("DEAL_VALUE", "Valor");
    //With discount
    define("DEAL_WITHCOUPON", "Com desconto");
    //Redeem by e-mail
    define("DEAL_REDEEMBYEMAIL", "Resgatar por e-mail");
    //Sign In and Redeem
    define("DEAL_CONNECT_REDEEM", "Entrar e Resgatar");
	//Redeem and Print
	define("LANG_LABEL_REDEEM_PRINT", "Resgatar e Imprimir");
    //Redeem and Share
    define("DEAL_REDEEMSHARE", "Resgatar e Compartilhar");
    //Featured Deals
    define("DEAL_FEATURED_DEALS", "Ofertas em Destaque");
    //Sign in using your Facebook session
    define("LOGIN_FB_CURRENT_SESSION", "Entrar usando sua conta atual do Facebook");
	//To Redeem using Facebook you need to connect using your Facebook account
    define("LANG_DEAL_DISCONNECTED_NOFB", "Para resgatar pelo Facebook você precisa logar usando sua conta do Facebook.");
    //Redeem Statistics
    define("LANG_LABEL_REDEEM_STATISTICS", "Estatísticas de Resgates");
    //Redeem code
    define("DEAL_SITEMGR_REDEEMCODE", "Código do Cupon");
    //Available
    define("DEAL_SITEMGR_AVAILABLE", "Disponível");
    //Used
    define("DEAL_SITEMGR_USED", "Usado");
    //Redeem using your current Facebook session.
    define("DEAL_REDEEMINFO_3", "Resgatar usando a conta do seu Facebook");
    //Use
    define("DEAL_SITEMGR_USE", "Usar");
	//Saving...
	define("LANG_DEAL_SAVING", "Salvando...");
	//No redeem found
	define("LANG_DEAL_NO_RECORD", "Nenhum resgate encontrado.");
	//percentage
	define("LANG_LABEL_PERCENTAGE", "porcentagem");
	//fixed value
	define("LANG_LABEL_FIXEDVALUE", "valor fixo");

	# ----------------------------------------------------------------------------------------------------
	# IMPORT
	# ----------------------------------------------------------------------------------------------------
	//line
	define("LANG_MSG_IMPORT_ERROR_LINE", "linha");
	//Error importing to temporary table.
	define("LANG_MSG_IMPORT_ERRORONIMPORTTOTEMPABLE", "Erro ao importar para a tabela temporária.");
	//Invalid renewal date - line
	define("LANG_MSG_IMPORT_INVALIDRENEWALDATE", "Data de renovação inválida - linha");
	//Invalid updated date - line
	define("LANG_MSG_IMPORT_INVALIDUPDATEDATE", "Data de atualização inválida - linha");
	//CSV file imported to temporary table.
	define("LANG_MSG_IMPORT_CSVIMPORTEDTOTEMPORARYTABLE", "Arquivo CSV importado para a tabela temporária.");
	//Invalid e-mail - line
	define("LANG_MSG_IMPORT_INVALIDUSERNAMELINE", "E-mail inválido - linha");
	//Invalid password - line
	define("LANG_MSG_IMPORT_INVALIDPASSWORDLINE", "Senha inválida - linha");
	//Invalid keyword (maximum 10 keywords) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS", "Palavra-chave inválida (máximo ".MAX_KEYWORDS." palavras-chave) - linha");
	//Invalid keyword (keywords with a maximum of 50 characters each.) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS2", "Palavra-chave inválida (".LANG_MSG_KEYWORDS_WITH_MAXIMUM_50.") - linha");
	//Invalid title - line
	define("LANG_MSG_IMPORT_INVALIDTITLELINE", "Título inválido - linha");
	//Invalid start date - line
	define("LANG_MSG_IMPORT_INVALIDSTARTDATE", "Data de início inválida - linha");
	//Invalid end date - line
	define("LANG_MSG_IMPORT_INVALIDENDDATE", "Data de término inválida - linha");
	//Start date must be filled - line
	define("LANG_MSG_IMPORT_STARTDATEEMPTY", "Data de início deve ser preenchida - linha");
	//End date must be filled - line
	define("LANG_MSG_IMPORT_ENDDATEEMPTY", "Data de término deve ser preenchida - linha");
	//The "End Date" must be greater than or equal to the "Start Date" - line
	define("LANG_MSG_IMPORT_END_DATE_GREATER_THAN_START_DATE", str_replace(".", "", LANG_MSG_END_DATE_GREATER_THAN_START_DATE)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//The "End Date" cannot be in past - line
	define("LANG_MSG_IMPORT_END_DATE_CANNOT_IN_PAST", str_replace(".", "", LANG_MSG_END_DATE_CANNOT_IN_PAST)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Invalid start time - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_NUMBER", "Hora de início inválida - linha");
	//Invalid end time - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_NUMBER", "Hora de término inválida - linha");
	//Invalid start time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_FORMAT", "Formato da hora de início inválido. Deve ser \"xx:xx\" - linha");
	//Invalid end time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_FORMAT", "Formato da hora de término inválido. Deve ser \"xx:xx\" - linha");
	//Invalid start time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE1", "Modo da hora de início inválido. Deve ser \"AM\" ou \"PM\" - linha");
	//Invalid end time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE1", "Modo da hora de término inválido. Deve ser \"AM\" ou \"PM\" - linha");
	//Invalid start time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE2", "Modo da hora de início inválido. Deve ser \"24\" - linha");
	//Invalid end time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE2", "Modo da hora de término inválido. Deve ser \"24\" - linha");
	//The "End Time" must be greater than the "Start Time" - line
	define("LANG_MSG_IMPORT_END_TIME_GREATER_THAN_START_TIME", str_replace(".", "", LANG_MSG_END_TIME_GREATER_THAN_START_TIME)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Location and system default location are differents - line
	define("LANG_MSG_IMPORT_INVALIDLOCATIONLINE", "Localidade e localidade padrão do sistema são diferentes - linha");
	//Invalid latitude. Must be numeric between -90 and 90 - line
	define("LANG_MSG_IMPORT_INVALIDLATITUDELINE", "Latitude inválida. Deve ser numérica entre -90 e 90 - linha");
	//Invalid longitude. Must be numeric between -180 and 180 - line
	define("LANG_MSG_IMPORT_INVALIDLONGITUDELINE", "Longitude inválida. Deve ser numérica entre -180 e 180 - linha");
	//No CSV Files in Import Folder.
	define("LANG_MSG_IMPORT_NOFILES_INFTP", "Não existem arquivos CSV na pasta de importação.");
	//The number of columns in the following line(s) are wrong:
	define("LANG_MSG_IMPORT_NUMBEROFCOLUMNSAREWRONG", "O número de colunas na(s) seguinte(s) linha(s) está errado:");
	//Total lines read:
	define("LANG_MSG_IMPORT_TOTALLINESREADY", "Total de linhas lidas:");
	//Total error lines:
	define("LANG_MSG_IMPORT_TOTALLINESERROR", "Total de linhas com erros:");
	//CSV header does not match - it has more fields that it is allowed
	define("LANG_MSG_IMPORT_WRONG_HEADER", "Cabeçalho do CSV incorreto - possui mais campos que o permitido");
	//CSV header does not match at field(s):
	define("LANG_MSG_IMPORT_WRONG_HEADER2", "Cabeçalho do CSV incorreto nos campos: ");
	//account rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK", "conta revertida");
	//accounts rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK_PLURAL", "contas revertidas");
	//item rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK", "item revertido");
	//items rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK_PLURAL", "itens revertidos");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	//Find what you are Looking for...
	define("LANG_SEARCH_MESSAGE_TITLE", "Encontre o que você está procurando...");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword.
	define("LANG_SEARCH_MESSAGE_TEXT", "Às vezes você pode não encontrar resultados da busca pois a palavra-chave que você utilizou é muito genérica. Tente usar uma palavra mais específica.");

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
	define("LANG_PAGING_SHOWING", "Exibindo");
	//to
	define("LANG_PAGING_SHOWING_TO", "para");
	//of
	define("LANG_PAGING_SHOWING_OF", "de");
	//Pages
	define("LANG_PAGING_SHOWING_PAGE", "Páginas");

	# ----------------------------------------------------------------------------------------------------
	# SUGARCRM
	# ----------------------------------------------------------------------------------------------------
	//Importing [SUGAR_ITEM_TITLE] from SugarCRM to [EDIRECTORY_TITLE]
	define("LANG_IMPORT_ITEM_FROM_SUGAR", "Importação de [SUGAR_ITEM_TITLE] do SugarCRM para o [EDIRECTORY_TITLE]");
	//Use the form above to import from the SugarCRM record [SUGAR_ITEM_TITLE], after clicking import your data will be transferred to your directory installation with all relevant information passed across, just fill in the extra data, and payment data.
	define("LANG_MESSAGE_ON_FOOTER", "Utilize o formulário acima para realizar a importação a partir do registro [SUGAR_ITEM_TITLE] do SugarCRM. Depois de clicar em importar, seus dados serão transferidos para o seu diretório, você precisará preencher somente os dados extras e os dados de pagamento.");
	//You're nearly done.
	define("LANG_YOU_NEARLY_DONE", "Está quase pronto.");
	//It was not possible to export. Please check your SugarCRM connection information on your directory.
	define("LANG_SUGAR_CHECKINFO", "Não foi possível realizar a exportação. Por favor, verifique as informações de conexão do SugarCRM em seu diretório.");
	//Wrong eDirectory Key.
	define("LANG_SUGAR_WRONG_KEY", "Chave do eDirectory inválida.");

	# ----------------------------------------------------------------------------------------------------
	# ADVERTISE
	# ----------------------------------------------------------------------------------------------------
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_TITLE", LANG_LISTING_TITLE);
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_OWNER", "Dono da Empresa");
	//10% Off - Deal Title
	define("LANG_LABEL_ADVERTISE_DEAL_TITLE", "10% Off - ".LANG_PROMOTION_TITLE);
	//Review Title
	define("LANG_LABEL_ADVERTISE_REVIEW_TITLE", "Título da Avaliação");
	//Event Title
	define("LANG_LABEL_ADVERTISE_EVENT_TITLE", LANG_EVENT_TITLE);
	//Event Owner
	define("LANG_LABEL_ADVERTISE_EVENT_OWNER", "Dono do Evento");
	//Classified Title
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_TITLE", LANG_CLASSIFIED_TITLE);
	//Classified Owner
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_OWNER", "Dono do Classificado");
	//Article Title
	define("LANG_LABEL_ADVERTISE_ARTICLE_TITLE", LANG_ARTICLE_TITLE);
	//Article Author
	define("LANG_LABEL_ADVERTISE_ARTICLE_AUTHOR", "Autor do Artigo");
	//Contact Name
	define("LANG_LABEL_ADVERTISE_ITEM_CONTACT", LANG_LABEL_CONTACTNAME);
	//Zipcode
	define("LANG_LABEL_ADVERTISE_ITEM_ZIPCODE", ZIPCODE_LABEL);
	//www.yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_SITE", "www.seusite.com");
	//youremail@yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_EMAIL", "seunome@seusite.com");
	//Address
	define("LANG_LABEL_ADVERTISE_ITEM_ADDRESS", LANG_LABEL_ADDRESS);
	//Card holder name
	define("LANG_LABEL_CARDHOLDER_NAME", "Nome do titular do cartão");
	//Charge for
	define("LANG_CHARGEFOR", "Cobrança de");
	//Visitor
	define("LANG_LABEL_ADVERTISE_VISITOR", "Visitante");
	//Category
	define("LANG_LABEL_ADVERTISE_CATEGORY", "Categoria");
	//Category 1
	define("LANG_LABEL_ADVERTISE_CATEGORY1", "Categoria 1");
	//Category 1.1
	define("LANG_LABEL_ADVERTISE_CATEGORY1_2", "Categoria 1.1");
	//Category 2
	define("LANG_LABEL_ADVERTISE_CATEGORY2", "Categoria 2");
	//Category 2.2
	define("LANG_LABEL_ADVERTISE_CATEGORY2_2", "Categoria 2.2");
	//Summary View
	define("LANG_LABEL_ADVERTISE_SUMMARYVIEW", "Visão Resumida");
	//Detail View
	define("LANG_LABEL_ADVERTISE_DETAILVIEW", "Visão Detalhada");
	//This content is illustrative
	define("LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE", "Conteúdo ilustrativo");

	# ----------------------------------------------------------------------------------------------------
	# TWILIO
	# ----------------------------------------------------------------------------------------------------
	//Activate Click-to-Call
	define("LANG_LABEL_ACTIVATECLICKCALL", "Clique para Ligar");
	//Send to Phone
	define("LANG_LABEL_SENDPHONE", "Enviar para Celular");
	//Click to Call
	define("LANG_LABEL_CLICKTOCALL", "Clique para Ligar");
	//Message successfully sent!
	define("LANG_LABEL_SMS_SENT", "Mensagem enviada com sucesso!");
	//Send info about this listing to a phone.
	define("LANG_LISTING_TOPHONE_SAUDATION", "Enviar informações sobre esta empresa a um telefone.");
	//Enter your phone to call the listing owner with no costs.
	define("LANG_LISTING_CLICKTOCALL_SAUDATION", "Digite o seu telefone para ligar para o proprietário da empresa sem custos.");
	//Phone is required.
	define("LANG_PHONE_REQUIRED", "Telefone é requerido.");
	//Please, type a valid phone number.
	define("LANG_PHONE_INVALID", "Por favor, digite um número de telefone válido.");
	//Call
	define("LANG_TWILIO_CALL", "Ligar");
	//Calling
	define("LANG_TWILIO_CALLING", "Ligando...");
	//Phone
	define("LANG_CLICKTOCALL_PHONE", "Telefone");
	//Extension
	define("LANG_CLICKTOCALL_EXTENSION", "Extensão");
	//Activate
	define("LANG_CLICKTOCALL_ACTIVATE", "Ativar");
	//Enter this code in your phone keypad when the test call connects:
	define("LANG_CLICKTOCALL_YOUR_VALIDATION_CODE", "Digite este código em seu telefone quando receber a chamada:");
	//Your phone number was activated!
	define("LANG_CLICKTOCALL_STATUS_ACTIVATED", "Seu número de telefone foi ativado!");
	//Phone number successfully deleted!
	define("LANG_CLICKTOCALL_PHONE_DELETED", "Número de telefone apagado com sucesso!");
	//Click to Call not available for this listing
	define("LANG_MSG_CLICKTOCALL_NOT_AVAILABLE", "Clique para Ligar indisponível para esta empresa");
	//Activate Click-to-Call and Get More Contacts
	define("LANG_CLICKTOCALL_TIPTITLE", "Ative Clique para Ligar e tenha mais Contatos");
	//You need to activate the phone number below in order to allow the users to contact you directly through the directory.
	define("LANG_CLICKTOCALL_TIP1", "Você precisa ativar o número de telefone abaixo a fim de permitir que os usuários o contacte diretamente através do diretório.");
	//Click-to-call allows clients to connect a call between your phone and theirs with the click of a button.  To activate, press the button below and a test call will be made.
	define("LANG_CLICKTOCALL_TIP2", "Clique para Ligar permite que os clientes liguem para você com o clique de um botão. Para ativar, pressione o botão abaixo para receber a chamada de ativação.");
	//A message with your activation code will be shown. Take note of this code and wait for the activation phone call.
	define("LANG_CLICKTOCALL_TIP3", "Uma mensagem com o código de ativação será mostrada. Anote o código e aguarde o telefonema de ativação.");
	//You will be ask to enter the six digits activation code. Enter the code and wait for the confirmation message.
	define("LANG_CLICKTOCALL_TIP4", "Você será solicitado a digitar o código de ativação de seis dígitos. Digite o código e espere a mensagem de confirmação.");
	//After activate your phone number, click in Save Number to finish the process.
	define("LANG_CLICKTOCALL_TIP5", "Depois de ativar o seu número de telefone, clique em Salvar para concluir o processo.");
	//For numbers outside the USA, you need to put your country code first.
	define("LANG_CLICKTOCALL_TIP6", "Para números de fora dos EUA, você precisa colocar o código do país primeiro.");
	//For numbers outside the USA, the country code must be included.
	define("LANG_CLICKTOCALL_TIP7", "Para números de fora dos EUA, o código do país deve ser incluído.");
	//"Click to Call" report
	define("LANG_CLICKTOCALL_REPORT", "Relatórios do \"Clique para Ligar\"");
	//Direction
	define("LANG_CLICKTOCALL_REPORT_DIRECTION", "Direção");
	//To
	define("LANG_CLICKTOCALL_REPORT_FROM", "De");
	//Start Time
	define("LANG_CLICKTOCALL_REPORT_START_TIME", "Hora de Início");
	//End Time
	define("LANG_CLICKTOCALL_REPORT_END_TIME", "Hora de Término");
	//Duration (seconds)
	define("LANG_CLICKTOCALL_REPORT_DURATION", "Duração (segundos)");
	//No reports available.
	define("LANG_CLICKTOCALL_REPORT_NORECORD", "Nenhum relatório disponível.");
	//Activated by
	define("LANG_LABEL_ACTIVATED_BY", "Ativado por");
	//Activation failed. Please, try again.
	define("LANG_TWILIO_ERROR_10000", "Ativação falhou. Por favor, tente novamente.");
	//Account is not active.
	define("LANG_TWILIO_ERROR_10001", "Conta não está ativa.");
	//Trial account does not support this feature.
    define("LANG_TWILIO_ERROR_10002", "Conta de teste não suporta esse recurso.");
	//Incoming call rejected due to inactive account.
    define("LANG_TWILIO_ERROR_10003", "Chamada rejeitada devido a conta inativa.");
	//Invalid URL format.
    define("LANG_TWILIO_ERROR_11100", "Formato de URL inválido.");
	//HTTP retrieval failure.
    define("LANG_TWILIO_ERROR_11200", "HTTP falha de recuperação.");
	//HTTP connection failure.
    define("LANG_TWILIO_ERROR_11205", "HTTP falha na conexão.");
	//HTTP protocol violation.
    define("LANG_TWILIO_ERROR_11206", "HTTP violação do protocolo.");
	//HTTP bad host name.
    define("LANG_TWILIO_ERROR_11210", "HTTP nome do host ruim.");
	//HTTP too many redirects.
    define("LANG_TWILIO_ERROR_11215", "HTTP muitos redirecionamentos.");
	//Document parse failure.
    define("LANG_TWILIO_ERROR_12100", "Falha de interpretação do documento.");
	//Invalid Twilio Markup XML version.
    define("LANG_TWILIO_ERROR_12101", "Versão do Twilio Markup XML inválida.");
	//The root element must be Response.
    define("LANG_TWILIO_ERROR_12102", "O elemento raiz deve ser Response.");
	//Schema validation warning.
    define("LANG_TWILIO_ERROR_12200", "Aviso de validação do esquema.");
	//Invalid Content-Type.
    define("LANG_TWILIO_ERROR_12300", "Inválido Content-Type.");
	//Internal Failure.
    define("LANG_TWILIO_ERROR_12400", "Falha interna.");
	//Dial: Cannot Dial out from a Dial Call Segment.
    define("LANG_TWILIO_ERROR_13201", "Dial: Não é possível discar a partir de um segmento das chamadas Dial.");
	//Dial: Invalid method value.
    define("LANG_TWILIO_ERROR_13210", "Dial: Valor do método inválido.");
	//Dial: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13212", "Dial: Valor de tempo limite inválido.");
	//Dial: Invalid hangupOnStar value.
    define("LANG_TWILIO_ERROR_13213", "Dial: Valor inválido hangupOnStar.");
	//Dial: Invalid callerId value.
    define("LANG_TWILIO_ERROR_13214", "Dial: Valor inválido callerId.");
	//Dial: Invalid nested element.
    define("LANG_TWILIO_ERROR_13215", "Dial: Inválido elemento aninhado.");
	//Dial: Invalid timeLimit value.
    define("LANG_TWILIO_ERROR_13216", "Dial: Valor inválido timelimit.");
	//Dial->Number: Invalid method value.
    define("LANG_TWILIO_ERROR_13221", "Dial->Number: Valor do método inválido.");
	//Dial->Number: Invalid sendDigits value.
    define("LANG_TWILIO_ERROR_13222", "Dial->Number: Valor inválido sendDigits.");
	//Dial: Invalid phone number format.
    define("LANG_TWILIO_ERROR_13223", "Dial: Inválido formato de número de telefone.");
	//Dial: Invalid phone number.
    define("LANG_TWILIO_ERROR_13224", "Dial: Número de telefone inválido.");
	//Dial: Forbidden phone number.
    define("LANG_TWILIO_ERROR_13225", "Dial: Número de telefone proibido.");
	//Dial->Conference: Invalid muted value.
    define("LANG_TWILIO_ERROR_13230", "Dial->Conference: Valor inválido silenciado.");
	//Dial->Conference: Invalid endConferenceOnExit value.
    define("LANG_TWILIO_ERROR_13231", "Dial->Conference: Valor inválido endConferenceOnExit.");
	//Dial->Conference: Invalid startConferenceOnEnter value.
    define("LANG_TWILIO_ERROR_13232", "Dial->Conference: Valor inválido endConferenceOnExit.");
	//Dial->Conference: Invalid waitUrl.
    define("LANG_TWILIO_ERROR_13233", "Dial->Conference: Inválido waitUrl.");
	//Dial->Conference: Invalid waitMethod.
    define("LANG_TWILIO_ERROR_13234", "Dial->Conference: Inválido waitMethod.");
	//Dial->Conference: Invalid beep value.
    define("LANG_TWILIO_ERROR_13235", "Dial->Conference: Valor inválido beep.");
	//Dial->Conference: Invalid Conference Sid.
    define("LANG_TWILIO_ERROR_13236", "Dial->Conference: Inválido Sid Conferência.");
	//Dial->Conference: Invalid Conference Name.
    define("LANG_TWILIO_ERROR_13237", "Dial->Conference: Inválido Nome Conferência.");
	//Dial->Conference: Invalid Verb used in waitUrl TwiML.
    define("LANG_TWILIO_ERROR_13238", "Dial->Conference: Inválido verbo usado em waitUrl TwiML.");
	//Gather: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13310", "Gather: Valor inválido finishOnKey.");
	//Gather: Invalid method value.
    define("LANG_TWILIO_ERROR_13312", "Gather: Valor inválido método.");
	//Gather: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13313", "Gather: Valor de tempo limite inválido.");
	//Gather: Invalid numDigits value.
    define("LANG_TWILIO_ERROR_13314", "Gather: Valor inválido numDigits.");
	//Gather: Invalid nested verb.
    define("LANG_TWILIO_ERROR_13320", "Gather: Inválido verbo aninhadas.");
	//Gather->Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13321", "Gather->Say: Valor inválido voz.");
	//Gather->Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13322", "Gather->Say: Valor inválido laço.");
	//Gather->Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13325", "Gather->Play: Inválido Content-Type.");
	//Play: Invalid loop value.
    define("LANG_TWILIO_ERROR_13410", "Play: Valor inválido laço.");
	//Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13420", "Play: Inválido Content-Type.");
	//Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13510", "Say: Valor inválido loop.");
	//Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13511", "Say: Valor inválido voz.");
	//Say: Invalid text.
    define("LANG_TWILIO_ERROR_13520", "Say: Inválido texto.");
	//Record: Invalid method value.
    define("LANG_TWILIO_ERROR_13610", "Record: Valor inválido método.");
	//Record: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13611", "Record: Valor de tempo limite inválido.");
	//Record: Invalid maxLength value.
    define("LANG_TWILIO_ERROR_13612", "Record: Valor inválido maxLength.");
	//Record: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13613", "Record: Valor inválido finishOnKey");
	//Redirect: Invalid method value.
    define("LANG_TWILIO_ERROR_13710", "Redirect: Valor inválido método.");
	//Pause: Invalid length value.
    define("LANG_TWILIO_ERROR_13910", "Pause: Inválido valor de comprimento.");
	//Invalid "To" attribute.
    define("LANG_TWILIO_ERROR_14101", "Atributo \"Para\" inválido.");
	//Invalid "From" attribute.
    define("LANG_TWILIO_ERROR_14102", "Atributo \"De\" inválido.");
	//Invalid Body.
    define("LANG_TWILIO_ERROR_14103", "Corpo inválido.");
	//Invalid Method attribute.
    define("LANG_TWILIO_ERROR_14104", "Método inválido atributo.");
	//Invalid statusCallback attribute.
    define("LANG_TWILIO_ERROR_14105", "Atributo inválido statusCallback.");
	//Document retrieval limit reached.
    define("LANG_TWILIO_ERROR_14106", "Limite de recuperação de documentos alcançados.");
	//SMS send rate limit exceeded.
    define("LANG_TWILIO_ERROR_14107", "SMS enviar limite da taxa de ultrapassado.");
	//From phone number not SMS capable.
    define("LANG_TWILIO_ERROR_14108", "De número de telefone não SMS capaz.");
	//SMS Reply message limit exceeded.
    define("LANG_TWILIO_ERROR_14109", "SMS limite mensagem de resposta excedido.");
	//Invalid Verb for SMS Reply.
    define("LANG_TWILIO_ERROR_14110", "Inválido verbo para Responder SMS.");
	//Invalid To phone number for Trial mode.
    define("LANG_TWILIO_ERROR_14111", "Para inválidos número de telefone para o modo de teste.");
	//Unknown parameters.
    define("LANG_TWILIO_ERROR_20001", "Parâmetros desconhecidos.");
	//Invalid FriendlyName.
    define("LANG_TWILIO_ERROR_20002", "FriendlyName inválido.");
	//Permission Denied.
    define("LANG_TWILIO_ERROR_20003", "Permissão negada.");
	//Method not allowed.
    define("LANG_TWILIO_ERROR_20004", "Método não permitido.");
	//Account not active.
    define("LANG_TWILIO_ERROR_20005", "Conta não ativa.");
	//No Called number specified.
    define("LANG_TWILIO_ERROR_21201", "Chamado nenhum número especificado.");
	//Called number is a premium number.
    define("LANG_TWILIO_ERROR_21202", "Número chamado é um número premium.");
	//International calling not enabled.
    define("LANG_TWILIO_ERROR_21203", "Internacional de chamada não habilitado.");
	//Invalid URL.
    define("LANG_TWILIO_ERROR_21205", "Inválido URL.");
	//Invalid SendDigits.
    define("LANG_TWILIO_ERROR_21206", "SendDigits inválido.");
	//Invalid IfMachine.
    define("LANG_TWILIO_ERROR_21207", "IfMachine inválido.");
	//Invalid Timeout.
    define("LANG_TWILIO_ERROR_21208", "Inválido Timeout.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21209", "Método inválido.");
	//Caller phone number not verified.
    define("LANG_TWILIO_ERROR_21210", "Número de telefone chamador não verificado.");
	//Invalid Called Phone Number.
    define("LANG_TWILIO_ERROR_21211", "Chamado inválido número de telefone.");
	//Invalid Caller Phone Number.
    define("LANG_TWILIO_ERROR_21212", "Número de telefone inválido Caller.");
	//Caller phone number is required.
    define("LANG_TWILIO_ERROR_21213", "Número de telefone chamador é necessária.");
	//Called Phone Number cannot be reached.
    define("LANG_TWILIO_ERROR_21214", "Número de telefone chamado não pode ser alcançado.");
	//Account not authorized to call phone number.
    define("LANG_TWILIO_ERROR_21215", "Conta não autorizado a chamada número de telefone.");
	//Account not allowed to call phone number.
    define("LANG_TWILIO_ERROR_21216", "Conta não tem permissão para chamar o número de telefone.");
	//Phone number does not appear to be valid.
    define("LANG_TWILIO_ERROR_21217", "Número de telefone não parece ser válido.");
	//Invalid ApplicationSid.
    define("LANG_TWILIO_ERROR_21218", "ApplicationSid inválido.");
	//Invalid call state.
    define("LANG_TWILIO_ERROR_21220", "Estado inválido chamada.");
	//Invalid Phone Number.
    define("LANG_TWILIO_ERROR_21401", "Número de telefone inválido.");
	//Invalid Url.
    define("LANG_TWILIO_ERROR_21402", "Url inválida.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21403", "Método inválido");
	//Inbound Phone number not available to trial account.
    define("LANG_TWILIO_ERROR_21404", "Telefone de entrada não estão disponíveis a conta de teste.");
	//Cannot set VoiceFallbackUrl without setting Url.
    define("LANG_TWILIO_ERROR_21405", "Não é possível definir VoiceFallbackUrl sem definir Url.");
	//Cannot set SmsFallbackUrl without setting SmsUrl.
    define("LANG_TWILIO_ERROR_21406", "Não é possível definir SmsFallbackUrl sem definir SmsUrl.");
	//This Phone Number type does not support SMS.
    define("LANG_TWILIO_ERROR_21407", "Este tipo de número de telefone não suporta SMS.");
	//Phone number already validated on your account.
    define("LANG_TWILIO_ERROR_21450", "Número de telefone já validado em sua conta.");
	//Invalid area code.
    define("LANG_TWILIO_ERROR_21451", "Inválido o código de área.");
	//No phone numbers found in area code.
    define("LANG_TWILIO_ERROR_21452", "Nenhum número de telefone encontrado no código de área.");
	//Phone number already validated on another account.
    define("LANG_TWILIO_ERROR_21453", "Número de telefone já validado em outra conta.");
	//Invalid CallDelay.
    define("LANG_TWILIO_ERROR_21454", "CallDelay inválido.");
	//Resource not available.
    define("LANG_TWILIO_ERROR_21501", "Recurso não disponível.");
	//Invalid callback url.
    define("LANG_TWILIO_ERROR_21502", "Inválido url callback.");
	//Invalid transcription type.
    define("LANG_TWILIO_ERROR_21503", "Inválido tipo de transcrição.");
	//RecordingSid is required..
    define("LANG_TWILIO_ERROR_21504", "RecordingSid é necessária.");
	//Phone number is not a valid SMS-capable inbound phone number.
    define("LANG_TWILIO_ERROR_21601", "Número de telefone não é um válido SMS com capacidade de número de telefone de entrada.");
	//Message body is required.
    define("LANG_TWILIO_ERROR_21602", "Corpo da mensagem é necessário.");
	//The source 'from' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21603", "O número de telefone \"de\" é necessário para enviar um SMS.");
	//The destination 'to' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21604", "O número de telefone \"para\" é necessário para enviar um SMS.");
	//Maximum SMS body length is 160 characters.
    define("LANG_TWILIO_ERROR_21605", "Máximo comprimento do corpo SMS é de 160 caracteres");
	//The "From" phone number provided is not a valid, SMS-capable inbound phone number for your account.
    define("LANG_TWILIO_ERROR_21606", "O \"De\" número de telefone fornecido não é um válido, o SMS-capaz número de telefone de entrada para sua conta.");
	//The Sandbox number can send messages only to verified numbers.
    define("LANG_TWILIO_ERROR_21608", "O número Sandbox pode enviar mensagens apenas para números verificados.");

	# ----------------------------------------------------------------------------------------------------
	# FACEBOOK COMMENTS
	# ----------------------------------------------------------------------------------------------------
	//Facebook comments
	define("LANG_LABEL_FACEBOOK_COMMENTS", "Comentários do Facebook");
	//Facebook comments not available for this listing
	define("LANG_LABEL_FACEBOOK_COMMENTS_NOT_AVAILABLE", "Comentários do Facebook indisponíveis para esta empresa.");
	//Be sure you're logged into Facebook with the same account you set in your Commenting Options section, otherwise you can not moderate the comments for this item.
	define("LANG_LABEL_FACEBOOK_TIP1", "Tenha certeza que você está logado no Facebook com a mesma conta que você configurou na seção Opções de Comentários, caso contrário, você não poderá moderar os comentários deste item.");
	//You can also moderate your comments by going to
	define("LANG_LABEL_FACEBOOK_TIP2", "Você também pode moderar seus comentários indo até ");

	# ----------------------------------------------------------------------------------------------------
	# EDIRECTORY API
	# ----------------------------------------------------------------------------------------------------
	//Invalid API key.
	define("LANG_API_INVALIDKEY", "Chave da API inválida.");
	//Missing parameter: module.
	define("LANG_API_EMPTYMODULE", "Parâmetro ausente: module.");
	//Invalid module name.
	define("LANG_API_INVALIDMODULE", "Nome do módulo inválido.");
	//Module disabled.
	define("LANG_API_MODULEOFF", "Módulo desabilitado.");
	//Missing parameter: keyword.
	define("LANG_API_EMPTYKEYWORD", "Parâmetro ausente: keyword.");
	//API disabled.
	define("LANG_API_DISABLED", "API desabilitada.");

	# ----------------------------------------------------------------------------------------------------
	# THEME TEMPLATE
	# ----------------------------------------------------------------------------------------------------
	//Swimming Pool
	define("LANG_LABEL_TEMPLATE_POOL", "Piscina");
	//Bedroom(s)
	define("LANG_LABEL_TEMPLATE_BEDROOM", "Quarto(s)");
	//Bathroom(s)
	define("LANG_LABEL_TEMPLATE_BATHROOM", "Banheiro(s)");
	//Level(s)
	define("LANG_LABEL_TEMPLATE_LEVEL", "Andar(es)");
	//Property Type
	define("LANG_LABEL_TEMPLATE_TYPE", "Tipo de Imóvel");
	//Purpose
	define("LANG_LABEL_TEMPLATE_PURPOSE", "Finalidade");
	//Price
	define("LANG_LABEL_TEMPLATE_PRICE", "Preço");
	//Acres
	define("LANG_LABEL_TEMPLATE_ACRES", "Hectares");
	//Built In
	define("LANG_LABEL_TEMPLATE_TYPEBUILTIN", "Construído Em");
	//Square Feet
	define("LANG_LABEL_TEMPLATE_SQUARE", "Metros Quadrados");
	//Office
	define("LANG_LABEL_TEMPLATE_OFFICE", "Escritório");
	//Laundry Room
	define("LANG_LABEL_TEMPLATE_LAUNDRYROOM", "Lavanderia");
	//Central Air Conditioning
	define("LANG_LABEL_TEMPLATE_AIRCOND", "Ar Condicionado");
	//Dining Room
	define("LANG_LABEL_TEMPLATE_DINING", "Sala de Jantar");
	//Garage
	define("LANG_LABEL_TEMPLATE_GARAGE", "Garagem");
	//Garbage Disposal
	define("LANG_LABEL_TEMPLATE_GARBAGE", "Remoção de Lixo");

	# ----------------------------------------------------------------------------------------------------
	# BLOG
	# ----------------------------------------------------------------------------------------------------
	//Your post will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_POST_AUTOMATICALLY_APPEAR", "Seu post aparecerá automaticamente na categoria principal de cada subcategoria que você selecionar.");
	//Type a keyword or post title
	define("LANG_LABEL_SEARCHKEYWORDTIP_POST", "Palavra-chave ou título do post");
	//Archive
	define("LANG_BLOG_ARCHIVE", "Arquivo");
	//Recent Topics
	define("LANG_BLOG_RECENTTOPICS", "Tópicos Recentes");
	//Recent Members
	define("LANG_BLOG_RECENTMEMBERS", "Membros Recentes");
	//View more
	define("LANG_VIEWMORE", "Ver mais");
	//Popular Topics
	define("LANG_BLOG_POPULARTOPICS", "Tópicos Populares");
	//Post Search Results
	define("LANG_MSG_BLOGRESULTS", "Resultados da Busca por Postagens");
	//Comments
	define("LANG_BLOG_COMMENTS", "Comentários");
	//Comment It
	define("LANG_BLOG_COMMENTIT", "Comente!");
	//Related Posts
	define("LANG_BLOG_RELATEDPOSTS", "Postagens Relacionadas");
	//Web Site
	define("LANG_LABEL_WEBSITE", "Web site");
	//Published
	define("LANG_BLOG_PUBLISHED", "Publicado");
	//on
	define("LANG_BLOG_ON", "em");
	//"About" [POST_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_BLOG_CONTACTSUBJECT_ISNULL_1", "Sobre");
	//About [POST_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_BLOG_CONTACTSUBJECT_ISNULL_2", "do");
	//Send info about this post to a friend
	define("LANG_BLOG_TOFRIEND_SAUDATION", "Enviar informações sobre este post para um amigo");
	//SOME DETAILS
	define("LANG_BLOG_TOFRIEND_MAIL", "ALGUNS DETALHES");
	//Post
	define("LANG_BLOG", "Post");
	//Leave Your Comment
	define("LANG_MSG_LEAVEYOURCOMMENT", "Deixe seu comentário");
	//Reply this comment
	define("LANG_MSG_REPLYTHISCOMMENT", "Responder a este comentário");
	//Please type a valid e-mail
	define("LANG_COMMENT_EMPTY_EMAIL", "Por favor, digite um e-mail válido.");
	//Please type a website
	define("LANG_COMMENT_EMPTY_WEBSITE", "Por favor, digite um website.");
	//Please type a comment!
	define("LANG_COMMENT_EMPTY", "Por favor, digite um comentário.");
	//Comments of
	define("LANG_COMMENTS_COMMENTSOF", "Comentários de ");
	//No comment found for this post!
	define("LANG_COMMENT_NORECORD", "Nenhum comentário encontrado para esse post!");
	//Post
	define("LANG_LABEL_POST", "Post");
	//Click here to view this comment
	define("LANG_MSG_CLICK_TO_VIEW_THIS_COMMENT", "Clique aqui para ver seu comentário");
	//Click here to view this comment's replies
	define("LANG_MSG_CLICK_TO_VIEW_REPLIES", "Clique aqui para ver as respostas deste comentário");
	//This comments has no replies
	define("LANG_MSG_NO_REPLIES", "Este comentário não tem respostas");
	//Click here to delete this comment
	define("LANG_MSG_CLICK_TO_DELETE_THIS_COMMENT", "Clique aqui para deletar este comentário");
	//View replys
	define("LANG_LABEL_VIEW_REPLY", "Ver respostas");
	//Click here to view this post reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BLOG_REPORTS", "Clique aqui para ver os relatórios deste post");
	//You need to login to leave your comment
	define("LANG_MSG_NEED_LOGIN", "Você precisa estar logado para deixar o seu comentário.");
	//You need to login to redeem a deal.
	define("LANG_MSG_NEED_LOGIN_DEAL", "Você precisa estar logado para resgatar uma oferta.");
	//No posts found.
	define("LANG_MSG_NOBLOGS", "Nenhum post encontrado.");
	//No posts
	define("LANG_MSG_NOPOSTS", "Nenhum post");
	//Comment successfully posted!
	define("LANG_MSG_COMMENT_SUCCESSFULLY_POSTED", "Comentário postado com sucesso!");
	//Your comment has been submitted for approval.
	define("LANG_MSG_COMMENT_SENT_TO_APPROVE", "Seu comentário foi enviado para aprovação.");
	//Reply successfully posted!
	define("LANG_MSG_REPLY_SUCCESSFULLY_POSTED", "Resposta postada com sucesso!");
	//Your reply has been submitted for approval.
	define("LANG_MSG_REPLY_SENT_TO_APPROVE", "Sua resposta foi enviada para aprovação.");
	//Content
	define("LANG_LABEL_POST_CONTENT", "Conteúdo");
	//Reply
	define("LANG_LABEL_REPLY", "Resposta");
	//Re
	define("LANG_LABEL_ABBR_REPLY", "Re");
	//Click here to view this reply
	define("LANG_MSG_CLICK_TO_VIEW_THIS_REPLY", "Clique aqui para ver esta reposta");
	//Click here to delete this reply
	define("LANG_MSG_CLICK_TO_DELETE_THIS_REPLY", "Clique aqui para apagar esta resposta");

	# ----------------------------------------------------------------------------------------------------
	# SITEMGR NOTIFICATIONS
	# ----------------------------------------------------------------------------------------------------
	//Account Notification
	define("LANG_NOTIFY_NEWACCOUNT", "[".EDIRECTORY_TITLE."] Notificação de Conta");
	//A new account was created in
	define("LANG_NOTIFY_NEWACCOUNT_1", "Uma nova conta foi criada em");
	//Please review the account information below:
	define("LANG_NOTIFY_NEWACCOUNT_2", "Por favor, reveja as informações da conta abaixo:");
	//Article Notification
	define("LANG_NOTIFY_ARTICLE", "[".EDIRECTORY_TITLE."] Notificação de ".LANG_ARTICLE_FEATURE_NAME."");
	//was changed by the administrator
	define("LANG_NOTIFY_ITEMS_1", "foi alterado(a) pelo administrador");
	//was created by the administrator
	define("LANG_NOTIFY_ITEMS_2", "foi criado(a) pelo administrador");
	//and needs to be revised by you.
	define("LANG_NOTIFY_ITEMS_3", "e precisa ser revisto por você.");
	//Banner Notification
	define("LANG_NOTIFY_BANNER", "[".EDIRECTORY_TITLE."] Notificação de ".LANG_BANNER_FEATURE_NAME."");
	//Transaction Notification
	define("LANG_NOTIFY_TRANSACTION", "[".EDIRECTORY_TITLE."] Notificação de Transação");
	//A transaction was made and needs to be revised by you.
	define("LANG_NOTIFY_TRANSACTION_1", "Uma transação foi feita e precisa ser revista por você.");
	//Transaction Info:
	define("LANG_NOTIFY_TRANSACTION_2", "Informações da Transação:");
	//Transaction Time
	define("LANG_NOTIFY_TRANSACTION_3", "Data da Transação");
	//Gateway
	define("LANG_NOTIFY_TRANSACTION_4", "Forma de Pagamento");
	//(prices amount are per installments)
	define("LANG_NOTIFY_TRANSACTION_5", "(os preços são por parcelas)");
	//Please sign in to the directory at the links below to revise and/or activate these items.
	define("LANG_NOTIFY_TRANSACTION_6", "Faça login no diretório através dos links abaixo para rever e/ou ativar esses itens.");
	//Classified Notification
	define("LANG_NOTIFY_CLASSIFIED", "[".EDIRECTORY_TITLE."] Notificação de ".LANG_CLASSIFIED_FEATURE_NAME."");
	//Contact Us
	define("LANG_NOTIFY_CONTACTUS", "Entre em contato");
	//Event Notification
	define("LANG_NOTIFY_EVENT", "[".EDIRECTORY_TITLE."] Notificação de ".LANG_EVENT_FEATURE_NAME."");
	//Listing Notification
	define("LANG_NOTIFY_LISTING", "[".EDIRECTORY_TITLE."] Notificação de ".LANG_LISTING_FEATURE_NAME."");
    //New Comment Added
    define("LANG_NOTIFY_NEWCOMMENT", "Novo Comentário Enviado");
    //New Reply Added
    define("LANG_NOTIFY_NEWREPLY", "Nova Resposta Enviada");
    //Your blog post
    define("LANG_NOTIFY_NEWCOMMENT_1", "Seu post no blog");
    //has a new reply.
    define("LANG_NOTIFY_NEWCOMMENT_2", "recebeu uma nova resposta.");
    //has a new comment.
    define("LANG_NOTIFY_NEWCOMMENT_3", "recebeu um novo comentário.");
    //wrote
    define("LANG_NOTIFY_NEWCOMMENT_4", "escreveu");
    //on
    define("LANG_NOTIFY_NEWCOMMENT_5", "em");
    //Click on the link below to moderate the comment
    define("LANG_NOTIFY_NEWCOMMENT_6", "Clique no link abaixo para moderar o comentário");
    //CSS Editor Backup
    define("LANG_NOTIFY_EDITORCHANGED", "Backup do Editor CSS");
    //The file
    define("LANG_NOTIFY_EDITORCHANGED_1", "O arquivo");
    //was changed at
    define("LANG_NOTIFY_EDITORCHANGED_2", "foi alterado em");
    //Enclosed is a copy of the last version submitted to the site.
    define("LANG_NOTIFY_EDITORCHANGED_3", "Segue em anexo a última versão do arquivo enviado.");
    //Rating Notification
    define("LANG_NOTIFY_NEWREVIEW", "Notificação de Avaliação");
    //has a new review
    define("LANG_NOTIFY_NEWREVIEW_1", "tem uma nova avaliação");
    //stars
    define("LANG_NOTIFY_NEWREVIEW_2", "estrelas");
    //Click on the link below to go to the review administration
    define("LANG_NOTIFY_NEWREVIEW_3", "Clique no link abaixo para ir para a administração de avaliações");
    //from
    define("LANG_NOTIFY_NEWREVIEW_4", "de");
    //wrote
    define("LANG_NOTIFY_NEWREVIEW_5", "escreveu");
    //Reply Notification
    define("LANG_NOTIFY_NEWREPLY", "Notificação de Resposta");
    //Review
    define("LANG_NOTIFY_NEWREPLY_1", "Avaliação");
    //has a new reply
    define("LANG_NOTIFY_NEWREPLY_2", "tem uma nova resposta");
    //Click on the link below to go to the review administration
    define("LANG_NOTIFY_NEWREPLY_3", "Clique no link abaixo para ir para a administração de avaliações");
    //Import Correction Notification
    define("LANG_NOTIFY_PREPAREIMPORT", "Notificação de Correção de Importação");
    //Event Import Correction Notification
    define("LANG_NOTIFY_PREPAREIMPORT_EVENT", "Notificação de Correção de Importação de Eventos");
    //Your import correction for the file
    define("LANG_NOTIFY_PREPAREIMPORT_1", "A correção do arquivo de importação");
    //was completed but contained errors.
    define("LANG_NOTIFY_PREPAREIMPORT_2", "foi finalizada, mas contém erros.");
    //Please review the log at
    define("LANG_NOTIFY_PREPAREIMPORT_3", "Por favor, verifique o histórico em");
    //has been completed.
    define("LANG_NOTIFY_PREPAREIMPORT_4", "foi finalizada.");
    //You can review the log here
    define("LANG_NOTIFY_PREPAREIMPORT_5", "Você pode rever o histórico aqui");
    //Listing Import Notification
    define("LANG_NOTIFY_IMPORTLISTING", "Notificação de Importação de Empresa");
    //Your listing(s) import has been completed.
    define("LANG_NOTIFY_IMPORTLISTING_1", "Sua importação de empresa(s) foi finalizada.");
    //You can review the log here
    define("LANG_NOTIFY_IMPORTLISTING_2", "Você pode rever o histórico aqui");
    //Event Import Notification
    define("LANG_NOTIFY_IMPORTEVENT", "Notificação de Importação de Evento");
    //Your event(s) import has been completed
    define("LANG_NOTIFY_IMPORTEVENT_1", "Sua importação de evento(s) foi finalizada.");
    //You can review the log here
    define("LANG_NOTIFY_IMPORTEVENT_2", "Você pode rever o histórico aqui");
    //Package Notification
    define("LANG_NOTIFY_PACKAGE", "Notificação de compra de Pacote");
    //The package
    define("LANG_NOTIFY_PACKAGE_1", "O pacote");
    //was bought by the administrator
    define("LANG_NOTIFY_PACKAGE_2", "foi comprado pelo anunciante");
    //and needs to be checked over by you.
    define("LANG_NOTIFY_PACKAGE_3", "e precisa ser revisto por você.");
    //Purchased items
    define("LANG_NOTIFY_PACKAGE_4", "Itens adquiridos");
    //Help Request
    define("LANG_NOTIFY_MEMBERSHELP", "Solicitação de Ajuda");
    //You have received a message from one of your site members.
    define("LANG_NOTIFY_MEMBERSHELP_1", "Você recebeu uma mensagem de um dos membros do seu site.");
    //From
    define("LANG_NOTIFY_MEMBERSHELP_2", "De");
    //E-mail
    define("LANG_NOTIFY_MEMBERSHELP_3", "E-mail");
    //Message
    define("LANG_NOTIFY_MEMBERSHELP_4", "Mensagem");
    //Forgotten Password
    define("LANG_NOTIFY_FORGOTPASS", "Recuperação de Senha");
    //A new password was requested from your ".EDIRECTORY_TITLE." account.
    define("LANG_NOTIFY_FORGOTPASS_1", "Uma nova senha foi solicitada para a sua conta em ".EDIRECTORY_TITLE.".");
    //To change your password please click the link below and enter a new password
    define("LANG_NOTIFY_FORGOTPASS_2", "Para alterar sua senha, clique no link abaixo e digite uma nova senha");
    //New User Signup (Listing)
    define("LANG_NOTIFY_SIGNUPLISTING", "Novo Cadastro (Empresa)");
    //A new user has signed up and ordered a listing at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPLISTING_1", "Um novo usuário se inscreveu e criou uma empresa em ".EDIRECTORY_TITLE.".");
    //New User Signup (Event)
    define("LANG_NOTIFY_SIGNUPEVENT", "Novo Cadastro (Evento)");
    //A new user has signed up and ordered an event at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPEVENT_1", "Um novo usuário se inscreveu e criou um evento em ".EDIRECTORY_TITLE.".");
    //New User Signup (Classified)
    define("LANG_NOTIFY_SIGNUPCLASSIFIED", "Novo Cadastro (Classificado)");
    //A new user has signed up and ordered a classified at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPCLASSIFIED_1", "Um novo usuário se inscreveu e criou um classificado em ".EDIRECTORY_TITLE.".");
    //New User Signup (Banner)
    define("LANG_NOTIFY_SIGNUPBANNER", "Novo Cadastro (Banner)");
    //A new user has signed up and ordered a banner at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPBANNER_1", "Um novo usuário se inscreveu e criou um banner em ".EDIRECTORY_TITLE.".");
    //New User Signup (Article)
    define("LANG_NOTIFY_SIGNUPARTICLE", "Novo Cadastro (Artigo)");
    //A new user has signed up and ordered an article at ".EDIRECTORY_TITLE.".
    define("LANG_NOTIFY_SIGNUPARTICLE_1", "Um novo usuário se inscreveu e criou um artigo em ".EDIRECTORY_TITLE.".");
    //Listing Claimed!
    define("LANG_NOTIFY_NEWCLAIM", "Empresa Solicitada!");
    //A listing has recently been claimed on your site - ".EDIRECTORY_TITLE."!
    define("LANG_NOTIFY_NEWCLAIM_1", "Uma empresa foi solicitada no seu diretório - ".EDIRECTORY_TITLE."!");
    //To approve the listing, follow the claim link below
    define("LANG_NOTIFY_NEWCLAIM_2", "Para aprovar a empresa, segue o link da solicitação abaixo");
    //Claim ID
    define("LANG_NOTIFY_NEWCLAIM_3", "ID da Solicitação");
    //To preview the listing, follow the listing link below
    define("LANG_NOTIFY_NEWCLAIM_4", "Para visualizar a empresa, segue o link da empresa abaixo");
    //To see the user's account information follow the account link below
    define("LANG_NOTIFY_NEWCLAIM_5", "Para visualizar as informações da conta do usuário, segue o link da conta abaixo");
    //Account Details for the listing owner
    define("LANG_NOTIFY_NEWCLAIM_6", "Detalhes da conta do dono da empresa");
    //New Signup (Via Mobile)
    define("LANG_NOTIFY_NEWACCOUNTAPP", "Novo Cadastro (Via Aplicativo Móvel)");
    //A new user has joined ".EDIRECTORY_TITLE." via the mobile app.
    define("LANG_NOTIFY_NEWACCOUNTAPP_1", "Um novo usuário cadastrou-se em ".EDIRECTORY_TITLE." através do seu aplicativo móvel.");
    //Account information included below for your convenience:
    define("LANG_NOTIFY_NEWACCOUNTAPP_2", "Seguem abaixo informações da conta para sua conveniência:");
	//You received a new lead through the enquire form. To view the lead, follow the link below.
	define("LANG_NOTIFY_NEWLEAD", "Você recebeu um novo lead através do formulário de informação. Para visualizar o lead, clique no link abaixo.");

	# ----------------------------------------------------------------------------------------------------
	# MOBILE VERSION
	# ----------------------------------------------------------------------------------------------------
	//We have an app for that!
	define("LANG_MOBILE_APP", "Nós temos um aplicativo para isso!");
	//Grab the eDirectory App for iPhone
	define("LANG_MOBILE_GRAB_APP_IPHONE", "Adquira o aplicativo eDirectory para iPhone.");
	//In Google Play
	define("LANG_MOBILE_GRAB_APP_ANDROID", "no Google Play");
	//Available on the
	define("LANG_MOBILE_APP_STORE", "Disponível na");
	//ANDROID APP ON
	define("LANG_MOBILE_APP_ANDROID", "ANDROID APP NA");
    //Recently added listings
    define("LANG_MOBILE_RECENT_LISTINGS", "Empresas recentes");
    //View full site
    define("LANG_MOBILE_FULLSITE", "Ver site completo");
    //Download App
    define("LANG_MOBILE_DOWNLOAD_APP", "Baixar App");
    //Use the following code:
    define("LANG_MOBILE_DEAL_USECODE", "Use o seguinte código:");
    //REDEEMED
    define("LANG_MOBILE_DEAL_REDEEMED", "RESGATADO");
    //Please login to redeem
    define("LANG_MOBILE_DEAL_LOGIN", "Por favor, faça o login para resgatar.");

    # ----------------------------------------------------------------------------------------------------
	# ARCAMAILER
	# ----------------------------------------------------------------------------------------------------
    //Sign up for our Newsletter
    define("LANG_ARCAMAILER_SIGNUP", "Assine nosso Boletim Informativo");
    //Subscribe
    define("LANG_ARCAMAILER_SUBSCRIBE", "Assinar");
	//Subscribe to our monthly newsletter, no spam, just product updates.
	define("LANG_ARCAMAILER_SUBSCRIBE_TIP", "Assine nosso boletim informativo, sem spams, apenas atualizações de produtos.");
    //Please, type your name and e-mail.
    define("LANG_ARCAMAILER_SUBSCRIBEERROR", "Por favor, digite seu nome e e-mail.");
    //Check your e-mail to complete your subscription.
    define("LANG_ARCAMAILER_SUBSCRIBEDONE", "Verifique seu e-mail para completar sua inscrição.");

    # ----------------------------------------------------------------------------------------------------
	# GENERAL
	# ----------------------------------------------------------------------------------------------------
    //Changing this will lose any unsaved changes made to this form.
    define("LANG_CONFIRM_CHANGE_LEVEL", "Alterando esta informação você perderá todas as alterações não salvas feitas neste formulário.");

	# ----------------------------------------------------------------------------------------------------
	# DINING GUIDE
	# ----------------------------------------------------------------------------------------------------
    //Top Listing
    define("LANG_LABEL_TOP_LISTING", "Empresa em Destaque");
    //Featured Deal
    define("LANG_LABEL_FEATURED_DEAL", "Oferta do Dia");
    //Popular Reviews
    define("LANG_LABEL_POPULAR_REVIEW", "Avaliações Populares");
	//Helpful Reviews
	define("LANG_LABEL_HELPFUL_REVIEWS", "Avaliações Úteis");
    //Keep Reading
    define("LANG_LABEL_KEEP_READING", "Leia Mais");
    //Best Of
    define("LANG_MENU_BESTOF", "Destaques");
    //By Cuisine
    define("LANG_MENU_BYCUISINE", "Culinária");
    //By Location
    define("LANG_MENU_BYLOCATION", "Locais");
    //Sign up | Login
    define("LANG_MENU_SIGNUPLOGIN", "Registrar | Entrar");
    //Forgot?
    define("LANG_LABEL_FORGOT", "Esqueceu?");
    //Not a member? Sign up now
    define("LANG_LABEL_SIGNUPNOW", "Ainda não é um membro? Registre-se agora");
	//Price range
	define("LANG_LABEL_PRICE_RANGE", "Faixa de preço");
	//Need a Specific Category?
	define("LANG_LABEL_SPECIFIC_CATEG", "Precisa de uma Categoria Específica?");
	//Show [x] Reviews
	define("LANG_LABEL_SHOW_REVIEWS", "Mostrar as [x] Avaliações");
	//Filter by
	define("LANG_LABEL_FILTERBY", "Filtrar por");
	//Filter by Category
	define("LANG_LABEL_FILTERBY_CATEGORY", "Filtrar por Categoria");
	//Keyword to search...
	define("LANG_LABEL_KEYWORDSEARCH", "Palavra-chave para busca...");
	//Location to search...
	define("LANG_LABEL_LOCATIONSEARCH", "Localidade para busca...");
	//See All Locations
	define("LANG_LABEL_SEE_LOCATIONS", "Ver todas as Localidades");
	//Clear Selections
	define("LANG_LABEL_CLEAR_SELECT", "Limpar Opções");
	//Close Advanced Search
	define("LANG_LABEL_ADVSEARCH_CLOSE", "Fechar Busca Avançada");
	//Offers & Deals
	define("LANG_LABEL_DEAL_FILTER", "Ofertas & Promoções");
	//Cuisine
	define("LANG_LABEL_CUISINE", "Culinária");
	//List View
	define("LANG_LABEL_LISTVIEW", "Ver Lista");
	//Map View
	define("LANG_LABEL_MAPVIEW", "Ver Mapa");
	//Give us a moment, we're loading in your results.
	define("LANG_LABEL_LOADINGMAP", "Por favor, aguarde. Estamos carregando seus resultados.");
	//Valid for
    define("LANG_LABEL_FILTER_VALID_FOR", "Válido para");
    //Ends in less than 24 hours
    define("LANG_LABEL_FILTER_ENDS_IN_LESS_THAN_24_HOURS", "Encerra em menos de 24 horas");
    //Valid for more than 2 days
    define("LANG_LABEL_FILTER_VALID_FOR_MORE_THAN_2_DAYS", "Válido para mais de 2 dias");
    //Valid for more than a week
    define("LANG_LABEL_FILTER_VALID_FOR_MORE_THAN_A_WEEK", "Válido para mais de uma semana");
	//filter
	define("LANG_LABEL_FILTER", "filtrar");
    //Show more categories
    define("LANG_LABEL_FILTER_SHOW_MORE_CATEGORIES", "Ver mais categorias");
    //Show more locations
    define("LANG_LABEL_FILTER_SHOW_MORE_LOCATIONS", "Ver mais locais");
    //Showing [NUMBER_EDIR] for KEYWORD_EDIR in LOCATION_EDIR
    define("LANG_LABEL_FILTER_SHOWING_RESULTS_WITH_KEYWORD_AND_LOCATION", "Mostrando [NUMBER_EDIR] para KEYWORD_EDIR em LOCATION_EDIR");
    //Showing [NUMBER_EDIR] for KEYWORD_EDIR
    define("LANG_LABEL_FILTER_SHOWING_RESULTS_WITH_KEYWORD", "Mostrando [NUMBER_EDIR] para KEYWORD_EDIR");
    //Map view is only available for result sets with less than [MAX_MARKERS] items. Use filters to refine
    define("LANG_LABEL_FILTER_MAP_MORE_THAN_1000_RESULTS", "Visualização no mapa está disponível apenas para conjuntos de resultados com menos de [MAX_MARKERS] itens. Use filtros para refinar");
    //No Matches
    define("LANG_LABEL_FILTER_NO_MATCHES", "Nenhum Resultado");
    //Clear Filters
    define("LANG_LABEL_FILTER_SHOW_ORIGINAL_SEARCH", "Mostrar pesquisa original");

	# ----------------------------------------------------------------------------------------------------
	# LEADS
	# ----------------------------------------------------------------------------------------------------
	//Lead
	define("LANG_LABEL_LEAD", "Lead");
	//Leads
	define("LANG_LABEL_LEADS", "Leads");
	//Click here to view this item leads
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_LEADS", "Clique aqui para ver os leads deste item");
	//Manage Leads
	define("LANG_MANAGE_LEADS", "Gerenciar Leads");
	//No records found.
	define("LANG_NORECORD", "Nenhum registro encontrado.");
	//Forward
	define("LANG_LABEL_FORWARD", "Encaminhar");
	//Lead successfully deleted!
	define("LANG_LEAD_SUCCESSDELETED", "Lead excluído com sucesso!");
	//Lead successfully replied!
	define("LANG_LEAD_REPLIED", "Lead respondido com sucesso!");
	//Lead successfully forwarded!
	define("LANG_LEAD_FORWARDED", "Lead encaminhado com sucesso!");
	//Please type a message.
	define("LANG_LEAD_TYPEMESSAGE", "Por favor escreva uma mensagem.");
	//New lead received by
	define("LANG_LEAD_RECEIVED", "Novo lead recebido por");
	//Replied
	define("LANG_LEAD_REPLIED_ICO", "Respondido");
	//Forwarded
	define("LANG_LEAD_FORWARDED_ICO", "Encaminhado");
	//Replied and Forwarded
	define("LANG_LEAD_REPLIED_FORWARDED_ICO", "Respondido [dater] e Encaminhado [datef]");
	//Talk to Us
	define("LANG_LEAD_TALKTOUS", "Entre em contato");
	//Your first name
	define("LANG_LEAD_FIRSTNAME", "Seu nome");
	//Your last name
	define("LANG_LEAD_LASTNAME", "Seu sobrenome");
	//Your email, please?
	define("LANG_LEAD_EMAIL", "Seu e-mail, por favor?");
	//Add your phone number
	define("LANG_LEAD_PHONE", "Adicione o seu número de telefone");
	//Company/Organization
	define("LANG_LEAD_COMPANY", "Empresa / Organização");
	//What kind of service do you need?
	define("LANG_LEAD_MESSAGE", "Que tipo de serviço você precisa?");
	//Please type your first name and last name.
	define("LANG_LEAD_TYPE_NAME", "Por favor, digite seu nome e sobrenome.");
	//Thank you, we will be in touch shortly.
	define("LANG_LEAD_THANKYOU", "Obrigado, nós entraremos em contato em breve.");
	//New Enquire
	define("LANG_LEAD_ENQUERY", "Nova Solicitação de Informação");
	//General Lead
	define("LANG_GENERAL_LEAD", "Lead Geral");

	# ----------------------------------------------------------------------------------------------------
	# LOG IN / SIGN UP / MEMBERS
	# ----------------------------------------------------------------------------------------------------
	//Are you a Sponsor?
	define("LANG_AREYOU_SPONSOR_AREA", "Você é um anunciante?");
	//List your business today
	define("LANG_AREYOU_SPONSOR_AREA_2", "Cadastre sua empresa hoje");
	//Find Us
	define("LANG_FIND_US", "Ache-nos");
	//or if you already have an account login below
	define("LANG_OR_SIGNUPACCOUNT", "ou se você já possui uma conta...");
	//Or log in using your e-mail address
	define("LANG_OR_SIGNINEMAIL", "ou entre usando seu endereço de email");
	//Or sign up using your e-mail address
	define("LANG_OR_SIGNUPEMAIL", "ou crie usando seu endereço de email");
	//Are you a sponsor? Go to our sponsor area
	define("LANG_GO_TO_SPONSOR_AREA", "Você é um anunciante? Entre na nossa área de anunciantes");
	//By creating an account, I accept the Terms of Use.
	define("LANG_ACCEPT_TERMS", "Criando uma conta eu aceito as condições dos [a]Termos de Uso[/a].");
	//Sponsor Area
	define("LANG_LABEL_SPONSORAREA", "Área do Anunciante");
	//Log in to the Sponsor Area
	define("LANG_LABEL_LOGIN_SPONSORAREA", "Entre em nossa área de anunciante");
	//Already a member - Log in here.
    define("LANG_LABEL_ALREADY_MEMBER", "Já é um membro - Entrar aqui.");
	//Reference
	define("LANG_LABEL_REFERENCE", "Referência");
	//Got an enquiry or something you're stuck on? Send us a message. We'll get back to you as soon as we can.
	define("LANG_HELP_MESSAGE", "Tem um pedido ou dúvida? Envie-nos uma mensagem. Iremos te atender o mais rápido possível.");
	//Add a new content
	define("LANG_ADD_NEW_CONTENT", "Adicionar um novo conteúdo");
	//You don't have any content yet.
	define("LANG_ADD_NEW_CONTENT2", "Você ainda não tem conteúdo.");
	//Add your business today, it's quick and simple!
	define("LANG_ADD_NEW_CONTENT2_TIP", "Adicione a sua empresa hoje, é fácil e rápido!");
	//Remove
	define("LANG_LABEL_REMOVE", "Remover");
	//View on Website
	define("LANG_LABEL_VIEW_LIVE", "Ver no site");
	//Preview
	define("LANG_LABEL_PREVIEW", "Pré-visualizar");
	//Expires in
	define("LANG_LABEL_EXPIRESON", "Expira em");
	//until it expires
	define("LANG_LABEL_UNTILEXPIRES", "até que expire");
	//impressions left
	define("LANG_LABEL_IMPRESSIONS_LEFT", "impressões restantes");
	//Billing
	define("LANG_LABEL_BILLING", "Pagamento");
	//was successfully deleted!
	define("LANG_LABEL_WASSUCCESSDELETED", "excluído(a) com sucesso!");
	//Deal not linked
	define("LANG_LABEL_NOTLINKED", "Não está relacionada");
	//Increase Visibility
	define("LANG_LABEL_INCREASEVISIBILITY", "Aumentar a visibilidade");
	//Renew Now
	define("LANG_LABEL_RENEW", "Renovar agora");
	//Add basic information
	define("LANG_LABEL_GAMEFY_DESC", "Adicione informações básicas");
	//Add photos or video
	define("LANG_LABEL_GAMEFY_MEDIA", "Adicione fotos ou video");
	//Add additional information
	define("LANG_LABEL_GAMEFY_ADDITIONAL", "Adicione informações complementares");
	//Share and get more reviews
	define("LANG_LABEL_DASHBOARD_SHARE", "Compartilhe para ter mais comentários");
	//Share and get more leads
	define("LANG_LABEL_DASHBOARD_SHARE2", "Compartilhe para obter mais leads");
	//Share and get more redeems
    define("LANG_LABEL_DASHBOARD_SHARE3", "Compartilhe para gerar mais cupons");
	//Review by
	define("LANG_LABEL_REVIEWBY", "Avaliado por");
	//Reply this
	define("LANG_LABEL_REPLYTHIS", "Responder este");
	//Write your reply
    define("LANG_LABEL_WRITE_REPLY", "Escreva sua resposta");
	//Activity Report
	define("LANG_LABEL_ACTIVITYREPORT", "Relatório de Atividades");
	//See all reviews
	define("LANG_LABEL_SEE_REVIEWS", "Ver todas as avaliações");
	//See all leads
	define("LANG_LABEL_SEE_LEADS", "Ver todos os leads");
	//Statistics
	define("LANG_LABEL_STATISTICS", "Estatísticas");
	//Total Viewers
	define("LANG_LABEL_TOTALVIEWERS", "Total de visualizações");
	//Phone Views
	define("LANG_LABEL_PHONEVIEWS", "Cliques de Telefone");
	//Website Views
	define("LANG_LABEL_WEBSITEVIEWS", "Cliques de Website");
	//Fax Views
	define("LANG_LABEL_FAXVIEWS", "Cliques de Fax");
	//Phone View
	define("LANG_LABEL_PHONEVIEW", "Clique de Telefone");
	//Website View
	define("LANG_LABEL_WEBSITEVIEW", "Clique de Website");
	//Fax View
	define("LANG_LABEL_FAXVIEW", "Clique de Fax");
	//View more stats
	define("LANG_LABEL_VIEW_MORE_STATS", "Ver mais estatísticas");
	//Stats
	define("LANG_LABEL_STATS", "Estatísticas");
	//Listing Completion
    define("LANG_LABEL_LISTING_COMPLETION", "Informações da Empresa");
    //Event Completion
    define("LANG_LABEL_EVENT_COMPLETION", " Informações do Evento");
    //Classified Completion
    define("LANG_LABEL_CLASSIFIED_COMPLETION", "Informações do Classificado");
    //Article Completion
    define("LANG_LABEL_ARTICLE_COMPLETION", "Informações do Artigo");
	//Deal Completion
    define("LANG_LABEL_PROMOTION_COMPLETION", "Informações da Oferta");
    //You're not quite done with your item.
    define("LANG_LABEL_GAMEFY_TIP", "Seu item ainda não está completo.");
	//What are you looking for today?
	define("LANG_LABEL_PROFILE_TIP1", "O que você está procurando hoje?");
	//Thank you for being part of EDIRECTORY_TITLE. Join our community by giving your opinion and evaluating your favorite listings.
	define("LANG_LABEL_PROFILE_TIP2", "Obrigado por ser parte do ".EDIRECTORY_TITLE.". Participe da nossa comunidade dando sua opinião e avaliação de suas empresas favoritas.");
	//Oh wait...
	define("LANG_LABEL_PROFILE_TIP3", "Ops...");
	//This user has no activity in our portal yet. Don't worry. You can still join our community by giving your opinion and evaluating your favorite listings.
	define("LANG_LABEL_PROFILE_TIP4", "Este usuário ainda não tem nenhuma atividade no nosso portal.<br>Não se preocupe. Você ainda pode participar da nossa comunidade dando sua opinião e avaliação de suas empresas favoritas.");
	//Rated
	define("LANG_LABEL_RATED", "Avaliou");
	//Commented
	define("LANG_LABEL_COMMENTED", "Comentou em");
	//Redeemed deal
	define("LANG_LABEL_REDEEMED", "Resgatou a oferta");
	//Your redeem code is
	define("LANG_LABEL_DEAL_CODE", "Seu código é");
	//View previous activities
	define("LANG_PREVIOUS_ACTIVITY", "Ver atividades anteriores");
	//with
	define("LANG_WITH", "com");
	//Redeemed by
	define("LANG_LABEL_REDEEMED_BY", "Resgatado por");
	//You received [x] new review
	define("LANG_LABEL_NEW_REVIEW", "Você recebeu [x] nova avaliação");
	//You received [x] new reviews
	define("LANG_LABEL_NEW_REVIEWS", "Você recebeu [x] novas avaliações");
	//You received [x] new lead
	define("LANG_LABEL_NEW_LEAD", "Você recebeu [x] novo lead");
	//You received [x] new leads
	define("LANG_LABEL_NEW_LEADS", "Você recebeu [x] novos leads");

	# ----------------------------------------------------------------------------------------------------
	# NEW ADD MODULES FORMS
	# ----------------------------------------------------------------------------------------------------
	//You can change your [a]levels and pricing[/a] settings anytime you want.
	define("LANG_SELECTLEVEL_TIP", "Você pode mudar suas [a]configurações de níveis e preços[/a] quando quiser.");
	//With the [a]listing types[/a] you can choose different detail layouts for your listings, define extra fields and more.
	define("LANG_SELECT_LISTINGTEMPLATE_TIP", "Com os [a]tipos de empresa[/a], você pode definir categorias específicas para suas empresas, criar campos extras e muito mais.");
	//Save Changes
	define("LANG_SAVE_CHANGES", "Salvar Alterações");
	//Type your listing title here.
	define("LANG_HOLDER_LISTINGTITLE", "Digite o nome de sua empresa aqui.");
	//Type your deal title here.
	define("LANG_HOLDER_PROMOTIONTITLE", "Digite o nome de sua oferta aqui.");
	//Type your banner title here.
	define("LANG_HOLDER_BANNERTITLE", "Digite o nome de seu banner aqui.");
	//Type your event title here.
	define("LANG_HOLDER_EVENTTITLE", "Digite o nome de seu evento aqui.");
	//Type your classified title here.
	define("LANG_HOLDER_CLASSIFIEDTITLE", "Digite o nome de seu classificado aqui.");
	//Type your article title here.
	define("LANG_HOLDER_ARTICLETITLE", "Digite o nome de seu artigo aqui.");
	//Type your post title here.
	define("LANG_HOLDER_BLOGTITLE", "Digite o nome de seu post aqui.");
	//Basic Information
	define("LANG_BASIC_INFO", "Informações Básicas");
	//Click on the button on the right to select categories.
	define("LANG_SELECT_CATEGORIES", "Clique no botão à direita para selecionar as categorias.");
	//Add categories
	define("LANG_ADD_CATEGORIES", "Adicionar categorias");
	//Brief description of the listing.
	define("LANG_HOLDER_LISTINGSUMMARY", "Breve descrição da empresa.");
	//Introduce the listing to the public in a clear and efficient way. Describe all features that make the establishment unique and a great option for clients.
	define("LANG_HOLDER_LISTINGDESCRIPTION", "Apresente a empresa ao público de forma clara e eficiente. Descreva todas as características que tornam o estabelecimento único e uma ótima opção para os clientes.");
	//Brief description of the deal.
	define("LANG_HOLDER_PROMOTIONSUMMARY", "Breve descrição da oferta.");
	//Introduce the deal to the public in a clear and efficient way. Describe all features that make it worth.
	define("LANG_HOLDER_PROMOTIONDESCRIPTION", "Apresente a promoção ao público de forma clara e eficiente. Descreva todas as características que a fazem valer a pena.");
	//Brief description of the event.
	define("LANG_HOLDER_EVENTSUMMARY", "Breve descrição do evento.");
	//Introduce the event to the public in a clear and efficient way. Describe highlights and features that will make people want to check it.
	define("LANG_HOLDER_EVENTDESCRIPTION", "Apresente o evento ao público de forma clara e eficiente. Descreva os principais destaques e características que atrairão as pessoas.");
	//Brief description of the classified.
	define("LANG_HOLDER_CLASSIFIEDSUMMARY", "Breve descrição do classificado.");
	//Introduce the classified to the public in a clear and efficient way. Describe highlights and features that will make people want to buy your product/service.
	define("LANG_HOLDER_CLASSIFIEDDESCRIPTION", "Apresente o classificado ao público de forma clara e eficiente. Descreva os principais destaques e características que farão as pessoas quererem comprar o seu produto/serviço.");
	//Abstract of the article.
	define("LANG_HOLDER_ARTICLESUMMARY", "Resumo do artigo.");
	//Type your keyword. Press 'Tab' or 'Enter' on your keyboard to confirm.
	define("LANG_HOLDER_KEYWORDS", "Digite a palavra-chave e toque em 'Tab' para confirmá-la.");
	//Use this field to highlight some features that your business has to offer. Type one item per line.
	define("LANG_HOLDER_FEATURES", "Utilize este campo para destacar algumas características que a sua empresa tem a oferecer. Digite um item por linha.");
	//Do you have a discount code? Type it here.
	define("LANG_HOLDER_DISCOUNTCODE", "Você tem um código de desconto? Digite-o aqui.");
	//Paste your video URL here. Ex: http://www.youtube.com/watch?v=xxxx
	define("LANG_HOLDER_VIDEO", "Cole a URL do vídeo aqui. Ex: http://www.youtube.com/watch?v=xxxx");
	//Brief description of your video.
	define("LANG_HOLDER_VIDEOCAPTION", "Breve descrição do seu vídeo.");
	//This is how the link to download your file will be shown.
	define("LANG_HOLDER_ATTACHCAPTION", "O link para download do arquivo será mostrado desta forma.");
	//Want to change your badges? Click here.
	define("LANG_HOLDER_BADGES", "Deseja alterar suas classificações? Clique aqui.");
	//Type here the terms & conditions for redeeming your deal.
	define("LANG_HOLDER_PROMOTIONCONDITIONS", "Digite aqui os termos e condições para resgatar sua oferta.");
	//Could not load video. Please check your video URL and try again.
	define("LANG_VIDEO_NOTFOUND", "Não foi possível carregar o vídeo. Por favor, verifique a URL do vídeo e tente novamente.");
	//You can select up to [max] categories.
	define("LANG_SELECTMAX_CATEGORIES", "Você pode selecionar até [max] categorias.");
	//Please, wait...
	define("LANG_LABEL_FORM_WAIT", "Por favor, aguarde...");
	//Image Title
	define("LANG_LABEL_IMAGE_TITLE", "Título da Imagem");
	//Image Description
	define("LANG_LABEL_IMAGE_DESCRIPTION", "Descrição da imagem");
	//Image Cropping & Description
	define("LANG_LABEL_IMAGE_CROP", "Recorte da Imagem & Descrição");
	//Cropping
	define("LANG_LABEL_IMAGE_CROPPING", "Recorte");
	//Discount Type
	define("LANG_LABEL_DISCOUNT_TYPE", "Tipo de Desconto");
	//Need help? Take a look on the tutorial.
	define("LANG_LABEL_TUTORIAL", "Precisa de ajuda? Dê uma olhada no tutorial.");
	//Fields Guide
	define("LANG_LABEL_TUTORIAL_FIELDS", "Guia de Campos");
	//End tutorial
	define("LANG_LABEL_TUTORIAL_END", "Fechar Tutorial");
	//Social networks
    define("LANG_LABEL_SOCIALNETWORK", "Redes Sociais");
	//This is the Title that identifies your item on the site. Keep it brief, yet effective.
	define("LANG_LABEL_TUTORIAL_TOUR-TITLE", "Este é o título que identifica o item no site. Seja breve, mas eficaz.");
	//Choose between different Listing Types that offer varying fields and layouts specific to common listings, or create a new Listing Type that suits your needs.
	define("LANG_LABEL_TUTORIAL_TOUR-TEMPLATE", "Escolha entre diferentes Tipos de Empresa que oferecem campos variados e layouts específicos, ou crie um novo tipo de empresa que se adapte às suas necessidades.");
	//Choose your item's Level here. Each Level can be customized to offer a different set of features for the item.
	define("LANG_LABEL_TUTORIAL_TOUR-LEVEL", "Escolha o nível de seu item aqui. Cada nível pode ser personalizado para oferecer um conjunto diferente de recursos para o item.");
	//Choose the Categories that best fit your item. Visitors will find your item easily by browsing under specific Categories.
	define("LANG_LABEL_TUTORIAL_TOUR-CATEGORIES", "Escolha as categorias que melhor se adequam ao seu item. Os visitantes vão encontrar o item facilmente navegando por categorias específicas.");
	//This is the account that owns the item. You can change it to another account or leave your item with no owner.
	define("LANG_LABEL_TUTORIAL_TOUR-OWNER", "Esta é a conta que possui o item. Você pode mudá-lo para outra conta ou deixá-lo sem dono.");
	//Activated items will be available on the results page. Pending items have just been added to the site and are awaiting approval. Expired items have gone past their renewal date without payment and lastly, you can temporarily make an items Suspended at your choosing.
	define("LANG_LABEL_TUTORIAL_TOUR-STATUS", "Itens ativos estarão disponíveis na página de resultados. Itens pendentes foram adicionados recentemente ao site e estão aguardando aprovação. Os itens expirados não foram pagos após a data de renovação, e por fim, você pode suspender temporariamente um item.");
	//You can manually set the Renewal Date for an items to set when the next payment is due.
	define("LANG_LABEL_TUTORIAL_TOUR-EXPIRATION", "Você pode escolher manualmente a data de renovação para um item, definindo quando o próximo pagamento deve ser feito.");
	//Check this box to disable the claim feature and not allow owners to claim their listing. Leave it blank if you want to allow users to claim their listing.
	define("LANG_LABEL_TUTORIAL_TOUR-CLAIM", "Marque esta caixa para desativar o recurso de solicitação e não permitir que os proprietários solicitem empresas. Deixe em branco se você quiser permitir que os usuários solicitem empresas sem dono.");
	//This field is shown on the results page and briefly describes your item.
	define("LANG_LABEL_TUTORIAL_TOUR-SUMMARY", "Este campo é mostrado na página de resultados e descreve brevemente o seu item.");
	//Add more details about your item on this field. This full description will be shown on the item's detail page.
	define("LANG_LABEL_TUTORIAL_TOUR-DESCRIPTION", "Adicione mais detalhes sobre o item neste campo. A descrição completa será mostrada na página de detalhes do item.");
	//You can tag specific keywords in this field. Keywords will help users to find your item when searching on the site.
	define("LANG_LABEL_TUTORIAL_TOUR-KEYWORDS", "Você pode escolher palavras-chave específicas nesta área. Palavras-chave ajudam os usuários a encontrar seu item mais fácil.");
	//In this section you can add all the information for your item's location and contact. The more complete, the easier it is for customers to get in touch with you.
	define("LANG_LABEL_TUTORIAL_TOUR-CONTACT", "Nesta seção, você pode adicionar todas as informações de localização e contato. Quanto mais completo, mais fácil para os clientes entrar em contato com você.");
	//Use this field to add a location reference for your listing. For example, two blocks from the mall.
	define("LANG_LABEL_TUTORIAL_TOUR-REFERENCE", "Utilize este campo para adicionar uma referência de local para a sua empresa. Por exemplo, a duas quadras do shopping.");
	//Does your event have a Facebook page? Type it here to show the Facebook wall widget on the event's detail page.
	define("LANG_LABEL_TUTORIAL_TOUR-FACEBOOK", "O seu evento tem uma página no Facebook? Informe a URL aqui para mostrar o mural do Facebook na página de detalhes do evento.");
	//Use this field to highlight some features of your business or add any additional useful information, what makes it special.
	define("LANG_LABEL_TUTORIAL_TOUR-FEATURES", "Utilize este campo para destacar algumas características do seu negócio ou acrescentar informações adicionais.");
	//Type the hours of work for your business here.
	define("LANG_LABEL_TUTORIAL_TOUR-HOURS", "Escreva o horário de funcionamento do seu negócio aqui.");
	//If applicable, use this field to describe the average price for your products or services.
	define("LANG_LABEL_TUTORIAL_TOUR-PRICE", "Se for o caso, use este campo para descrever o preço médio de seus produtos ou serviços.");
	//Have a discount or promotional code? Type it here. The item's next payment will be affected.
	define("LANG_LABEL_TUTORIAL_TOUR-DISCOUNT", "Tem um desconto ou código promocional? Informe-o aqui. O desconto será aplicado no próximo pagamento do item.");
	//Use this box to drop and add images. You can click on a image to adjust the cropping and edit the title and description.
	define("LANG_LABEL_TUTORIAL_TOUR-IMAGES", "Use esta caixa para adicionar e remover imagens. Você pode clicar em uma imagem para ajustar o recorte e editar o título e descrição.");
	//Copy and paste your video URL here. Add a brief description to say what your video is about.
	define("LANG_LABEL_TUTORIAL_TOUR-VIDEO", "Copie e cole a URL do vídeo aqui. Você também pode adicionar uma breve descrição sobre o vídeo.");
	//Use this field to attach an additional file. Use it for a Menu, Product Brochure, or whatever you'd like.
	define("LANG_LABEL_TUTORIAL_TOUR-FILE", "Utilize este campo para anexar um arquivo adicional. Use-o para um Menu, folheto de produto, etc.");
	//You can help your owners to promote their businesses by designating badges for them.
	define("LANG_LABEL_TUTORIAL_TOUR-BADGES", "Você pode ajudar seus anunciantes a promover seus negócios com a designação de classificações para eles.");
	//Use this section to set some more additional information for your business.
	define("LANG_LABEL_TUTORIAL_TOUR-ADDITIONAL", "Use esta seção para adicionar mais algumas informações adicionais da empresa.");
	//Deals should be assigned to a listing in order to be shown on the results. Use this box to select a listing
	define("LANG_LABEL_TUTORIAL_TOUR-LISTING", "Para serem disponibilizadas no site, ofertas devem ser atribuídas a uma empresa. Use essa caixa para selecionar uma empresa.");
	//This field is pre-filled with a default text that describes the terms of use and conditions to redeem a deal. You can change it to whatever you need.
	define("LANG_LABEL_TUTORIAL_TOUR-CONDITIONS", "Este campo é preenchido com um texto padrão que descreve os termos de uso e condições para resgatar uma oferta. Você pode alterá-lo de acordo com sua necessidade.");
	//Use this section to set when the deal will be available. After the end date hits, it will no longer be shown in any results.
	define("LANG_LABEL_TUTORIAL_TOUR-DATE2", "Use esta seção para definir quando a oferta estará disponível. Após este período, ela não será mais mostrada nos resultados.");
	//Use this box to add and edit an image for your deal.
	define("LANG_LABEL_TUTORIAL_TOUR-IMAGE", "Use esta caixa para adicionar e editar uma imagem à sua oferta.");
	//Use this section to set when your event is taking place. You can also use the Recurring checkbox to save an event that will be repeating on a regular basis.
	define("LANG_LABEL_TUTORIAL_TOUR-DATE", "Use esta seção para definir a data do evento. Você também pode usar a caixa de seleção Recorrente para salvar um evento recorrente.");
	//Type the body of your article here. You can use the editor to format the text, add images, etc.
	define("LANG_LABEL_TUTORIAL_TOUR-CONTENT", "Digite o conteúdo do seu artigo aqui. Você pode usar o editor para formatar o texto, adicionar imagens, etc.");
	//Impressions refer to the number of times the banner is shown on the frontend pages.
	define("LANG_LABEL_TUTORIAL_TOUR-IMPRESSIONS", "Impressões referem-se ao número de vezes que o banner é exibido.");
	//Use this field to identify the article's author.
	define("LANG_LABEL_TUTORIAL_TOUR-AUTHOR", "Utilize este campo para identificar o autor do artigo.");
	//If the article's author has a website, you can type it in here.
	define("LANG_LABEL_TUTORIAL_TOUR-AUTHORURL", "Se o autor do artigo tem um site, você pode digitá-lo aqui.");
	//Set the publication date for the article here.
	define("LANG_LABEL_TUTORIAL_TOUR-PUBLICATION", "Defina a data de publicação do artigo aqui.");
	//Use this field to give a quick overview of the article.
	define("LANG_LABEL_TUTORIAL_TOUR-ABSTRACT", "Utilize este campo para dar uma visão geral do artigo.");
	//Does your business have a profile in any of these social medias? Type it here to show buttons to your profiles on the detail page. For Facebook, the wall widget will also be shown.
	define("LANG_LABEL_TUTORIAL_TOUR-SOCIALNETWORK", "A sua empresa tem um perfil em qualquer uma dessas mídias sociais? Digite-a aqui para mostrar botões para seus perfis na página de detalhes. Para o Facebook, o widget do mural também será mostrado.");
	//Select an option below
	define("LANG_CHOOSE_DEAL_ATTACH", "Selecione uma opção abaixo");
	//No deals available for association with this listing. In order to be linked to this listing, the deal should not be associated with other listing and should belong to the same account.
	define("LANG_ATTACHDEAL_UNAVAILABLE", "Não há ofertas disponíveis para a associação com esta empresa. Para ser associada a esta empresa, a oferta não deve estar associada a outra empresa e deve pertencer à mesma conta.");
	//No listings available for association with this deal. In order to be linked to this deal, the listing should not be associated with other deal and should belong to the same account.
	define("LANG_ATTACHLISTING_UNAVAILABLE", "Nenhuma empresa disponível para associação com esta oferta. Para ser associada a esta oferta, a empresa não deve ser associada a outra oferta e deve pertencer à mesma conta.");
    // You must associate a listing and a promotion with the same account.
    define("LANG_SITEMGR_ERROR_LISTING_PROMOTION_SITEMGR_ACCOUNT_DIFFER", "Você deve associar uma lista e uma promoção com a mesma conta.");
	//Leave it blank to unlink the deal.
	define("LANG_ATTACHDEAL_EMPTY", "Deixe em branco para desvincular a oferta.");
	//Recommended dimensions
	define("LANG_LABEL_RECOMMENDED_DIMENSIONS", "Dimensões recomendadas");
	//Cover Image
	define("LANG_LABEL_COVERIMAGE", "Imagem de Capa");
	//Thumbnail
	define("LANG_LABEL_THUMBNAIL", "Thumbnail");
	//Changing the template now will remove the selected categories so far. Do you want to continue?
	define("LANG_CONFIRM_CHANGELISTINGTYPE", "Alterar o tipo de empresa agora irá remover as categorias selecionadas até agora. Você quer continuar?");
    // It was selected more classifieds than it is allowed.
    define("LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_QUANTITY", "Foi selecionado mais ".LANG_CLASSIFIED_FEATURE_NAME_PLURAL." que o permitido.");
    // The association was successfully save.
    define("LANG_SITEMGR_ASSOCIATION_SUCCESSFULLY_SAVE", "Associação foi salva com sucesso");
    // You must associate a listing and a classified with the same account.
    define("LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_SITEMGR_ACCOUNT_DIFFER", "Você deve associar uma ".LANG_LISTING." e um ".LANG_CLASSIFIED." da mesma conta.");
    // Association not allowed.
    define("LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_USER_ACCOUNT_DIFFER", "Associação não permitida.");
    // This listing does not support more associations.
    define("LANG_SITEMGR_ERROR_LISTING_CLASSIFIED_QUANTITY", "Essa ".LANG_LISTING." não suporta mais associações");
	//Powered by
	define("LANG_POWEREDBY", "Distribuído por");
    //Select an option below
    define("LANG_CHOOSE_CLASSIFIED_ATTACH", "Selecione uma opção abaixo");
    //Associate an existing classified with this listing
    define("LANG_SITEMGR_CLASSIFIED_ASSOCIATE", "Associe um ".LANG_CLASSIFIED." existente com uma ".LISTING_FEATURE_NAME);
    //Leave it blank to unlink the classified
    define("LANG_ATTACHCLASSIFIED_EMPTY", "Deixe em branco para desassociar o ".LANG_CLASSIFIED.".");
    //Allow classified to be associated with no owner listing
    define("LANG_LABEL_CLASSIFIED_ASSOCIATION", "Permitir ".LANG_CLASSIFIED." ser associada a qualquer ".LISTING_FEATURE_NAME);
    //This option is just valid when you are adding or editing a classified
    define("LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_CLASSIFIED_ASSOCIATION", "Esta opção é apenas válida quando você está adicionando ou editando a ".LANG_CLASSIFIED);
    //Welcome back! It's always good to see you here again!
    define("LANG_LABEL_WELCOMEBACK", "Bem vindo de volta! É sempre bom vê-lo aqui!");
    //Sign up today and join our community!
    define("LANG_LABEL_SIGNUPTODAY", "Inscreva-se hoje e participe de nossa comunidade!");
    //Join us today and stay connected to businesses around the world.
    define("LANG_LABEL_JOINUSTODAY", "Junte-se a nós hoje e fique conectado a empresas em todo o mundo.");
    //With a single login using your computer, tablet, phone or our app!
    define("LANG_LABEL_LOGINEXPLANATION", "Com um único login usando seu computador, tablet, telefone ou nosso aplicativo!");
    //Oops, something wrong happened. Please try again or contact us.
	define("LANG_LABEL_ERRORLOGIN", "Opa, algo errado aconteceu. Por favor tente novamente ou contacte-nos.");
