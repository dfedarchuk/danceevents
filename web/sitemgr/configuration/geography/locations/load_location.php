<?
    // Get some settings
    setting_get("sitemgr_language", $sitemgr_language_aux);
    setting_get("loaded_locations", $loaded_locations);

    if ($loaded_locations) {
        $loaded_locations = unserialize($loaded_locations);
    }

    // Define Languages
	if($sitemgr_language_aux == "en_us"){
		define("LANG_SITEMGR_LOAD_LOC_USA_DATA"     , "USA (Zip Codes, State / City)");
        define("LANG_SITEMGR_LOAD_LOC_CA_DATA"      , "CA (Postal Codes, Province / City)");
        define("LANG_SITEMGR_LOAD_LOC_UK_DATA"      , "UK (Postal Codes, County / Town)");
        define("LANG_SITEMGR_LOAD_LOC_AU_DATA"      , "AU Locations (Country / Town)");
        define("LANG_SITEMGR_LOAD_LOCATIONS"        , "Load Locations");
		define("LANG_SITEMGR_LOAD_LOCATIONS_TIP"	, "Your eDirectory fresh install does not include any location data. Use the form below to load the location data that best suits to your business. If you want, you can skip this step and create your own locations. If you add any location record manually, you won't be able to load the default location database anymore.");
        define("LANG_SITEMGR_LOAD_SUCCESS"          , "Locations successfully loaded.");
        define("LANG_SITEMGR_LOAD_ERROR"            , "Error trying to load the data. Please contact our support.");
	}elseif($sitemgr_language_aux == "es_es"){
        define("LANG_SITEMGR_LOAD_LOC_USA_DATA"     , "USA (Códigos Postales, Estado / Ciudad)");
        define("LANG_SITEMGR_LOAD_LOC_CA_DATA"      , "Canadá (Códigos Postales, Provincia / Ciudad)");
        define("LANG_SITEMGR_LOAD_LOC_UK_DATA"      , "Reino Unido (Códigos Postales, Condado / Ciudad)");
        define("LANG_SITEMGR_LOAD_LOC_AU_DATA"      , "Australia Ubicaciones (Condado / Ciudad)");
        define("LANG_SITEMGR_LOAD_LOCATIONS"        , "Cargar Ubicaciones");
        define("LANG_SITEMGR_LOAD_LOCATIONS_TIP"    , "Su eDirectory nueva instalación no incluye datos de localización. Utilice el siguiente formulario para cargar los datos de localización que mejor se adapte a su negocio. Si lo desea, puede saltarse este paso y crear sus propios lugares. Si se agrega a cualquier registro de ubicación de forma manual, usted no será capaz de cargar la base de datos de ubicación por defecto más.");
        define("LANG_SITEMGR_LOAD_SUCCESS"          , "Ubicaciones cargado correctamente.");
        define("LANG_SITEMGR_LOAD_ERROR"            , "Error al intentar cargar los datos. Por favor, póngase en contacto con nuestro apoyo.");
	}elseif($sitemgr_language_aux == "fr_fr"){
        define("LANG_SITEMGR_LOAD_LOC_USA_DATA"     , "USA (Codes postaux, État / Ville)");
        define("LANG_SITEMGR_LOAD_LOC_CA_DATA"      , "Canada (Codes postaux, Province / Ville)");
        define("LANG_SITEMGR_LOAD_LOC_UK_DATA"      , "Royaume-Uni (Codes postaux, Comté / Ville)");
        define("LANG_SITEMGR_LOAD_LOC_AU_DATA"      , "Australie Lieux (Département / Ville)");
        define("LANG_SITEMGR_LOAD_LOCATIONS"        , "Charger des localisations");
        define("LANG_SITEMGR_LOAD_LOCATIONS_TIP"    , "Votre eDirectory installer frais ne comprennent pas les données de localisation. Utilisez le formulaire ci-dessous pour charger les données de localisation qui convient le mieux à votre entreprise. Si vous le souhaitez, vous pouvez sauter cette étape et de créer vos propres sites. Si vous ajoutez un dossier d'emplacement manuellement, vous ne serez pas en mesure de charger la base de données de localisation de défaut plus.");
        define("LANG_SITEMGR_LOAD_SUCCESS"          , "Lieux chargés correctement.");
        define("LANG_SITEMGR_LOAD_ERROR"            , "Erreur en essayant de charger les données. S'il vous plaît contacter notre support.");
	}elseif($sitemgr_language_aux == "ge_ge"){
        define("LANG_SITEMGR_LOAD_LOC_USA_DATA"     , "US (Zip Codes, Bundesland / Stadt)");
        define("LANG_SITEMGR_LOAD_LOC_CA_DATA"      , "Kanada (Postleitzahlen, Provinz / Stadt)");
        define("LANG_SITEMGR_LOAD_LOC_UK_DATA"      , "Vereinigtes Königreich (Postleitzahlen, Landkreis / Stadt)");
        define("LANG_SITEMGR_LOAD_LOC_AU_DATA"      , "Australien Standorte (Landkreis / Stadt)");
        define("LANG_SITEMGR_LOAD_LOCATIONS"        , "Last Standorte");
        define("LANG_SITEMGR_LOAD_LOCATIONS_TIP"    , "Ihre eDirectory frische Installation keine Standortdaten enthalten. Benutzen Sie das Formular unten, um den Standort-Daten zu laden, die am besten passt zu Ihrem Unternehmen. Wenn Sie möchten, können Sie diesen Schritt überspringen und erstellen Sie Ihre eigenen Standorten. Wenn Sie einen Standort-Verzeichnis manuell hinzufügen, werden Sie nicht in der Lage, die Standard-Ortsdatenbank mehr laden.");
        define("LANG_SITEMGR_LOAD_SUCCESS"          , "Standorte erfolgreich geladen.");
        define("LANG_SITEMGR_LOAD_ERROR"            , "Fehler beim Versuch, die Daten zu laden. Bitte kontaktieren Sie unseren Support.");
	}elseif($sitemgr_language_aux == "it_it"){
        define("LANG_SITEMGR_LOAD_LOC_USA_DATA"     , "USA (Codici di avviamento postale, Stato / Città)");
        define("LANG_SITEMGR_LOAD_LOC_CA_DATA"      , "Canada (Codici postali, Provincia / Città)");
        define("LANG_SITEMGR_LOAD_LOC_UK_DATA"      , "Regno Unito (Codici postali, Regione / Città)");
        define("LANG_SITEMGR_LOAD_LOC_AU_DATA"      , "AU Locations (Regione / Città)");
        define("LANG_SITEMGR_LOAD_LOCATIONS"        , "Caricare Sedi");
        define("LANG_SITEMGR_LOAD_LOCATIONS_TIP"    , "Il tuo eDirectory nuova installazione non include dati di localizzazione. Utilizza il modulo sottostante per caricare i dati di posizione che meglio si adatta al tuo business. Se si desidera, è possibile saltare questo passaggio e creare i propri percorsi. Se si aggiunge un record posizione manualmente, non sarà in grado di caricare più database posizione predefinita.");
        define("LANG_SITEMGR_LOAD_SUCCESS"          , "Locations caricati correttamente.");
        define("LANG_SITEMGR_LOAD_ERROR"            , "Errore cercando di caricare i dati. Si prega di contattare il nostro supporto.");
	}elseif($sitemgr_language_aux == "pt_br"){
        define("LANG_SITEMGR_LOAD_LOC_USA_DATA"     , "EUA (Códigos Postais, Estados / Cidades)");
        define("LANG_SITEMGR_LOAD_LOC_CA_DATA"      , "Canadá (Códigos Postais, Provincias / Cidades)");
        define("LANG_SITEMGR_LOAD_LOC_UK_DATA"      , "Inglaterra (Códigos Postais, Regiões / Cidades)");
        define("LANG_SITEMGR_LOAD_LOC_AU_DATA"      , "Austrália (Códigos Postais / Cidades)");
        define("LANG_SITEMGR_LOAD_LOCATIONS"        , "Carregar Localidades");
        define("LANG_SITEMGR_LOAD_LOCATIONS_TIP"    , "Seu eDirectory nova instalação não inclui quaisquer dados de localização. Utilize o formulário abaixo para carregar os dados de localização que melhor se adequa ao seu negócio. Se você quiser, você pode pular esta etapa e criar suas próprias localidades. Se você adicionar qualquer registro localização manualmente, você não será capaz de carregar o banco de dados local padrão mais.");
        define("LANG_SITEMGR_LOAD_SUCCESS"          , "Locais carregado com êxito.");
        define("LANG_SITEMGR_LOAD_ERROR"            , "Erro ao tentar carregar os dados. Entre em contato com o nosso apoio.");
	}elseif($sitemgr_language_aux == "tr_tr"){
        define("LANG_SITEMGR_LOAD_LOC_USA_DATA"     , "Amerika Birleşik Devletleri (Posta Kodları, Eyalet / Şehir)");
        define("LANG_SITEMGR_LOAD_LOC_CA_DATA"      , "Kanada (Posta Kodları, İl / Şehir)");
        define("LANG_SITEMGR_LOAD_LOC_UK_DATA"      , "İngiltere (Posta Kodları, İlçe / Şehir)");
        define("LANG_SITEMGR_LOAD_LOC_AU_DATA"      , "Avustralya yerler (İlçe / Şehir)");
        define("LANG_SITEMGR_LOAD_LOCATIONS"        , "yük Mekanlar");
        define("LANG_SITEMGR_LOAD_LOCATIONS_TIP"    , "Sizin EDirectory taze install konum verilerini içermez. İşinize ki en uygun konum verilerini yüklemek için aşağıdaki formu kullanın. Eğer isterseniz, bu adımı atlayın ve kendi yerleri oluşturabilirsiniz. Eğer elle herhangi bir yere kayıt eklerseniz, artık varsayılan konumu veritabanı yüklemek mümkün olmayacaktır.");
        define("LANG_SITEMGR_LOAD_SUCCESS"          , "Mekanlar başarıyla yüklendi.");
        define("LANG_SITEMGR_LOAD_ERROR"            , "Veri yüklemek hata oluştu. Bizim desteğe başvurun.");
	}


    // Location Options
    $_array_location_options[0]["value"] = "us";
    $_array_location_options[0]["label"] = system_showText(LANG_SITEMGR_LOAD_LOC_USA_DATA);
    $_array_location_options[1]["value"] = "ca";
    $_array_location_options[1]["label"] = system_showText(LANG_SITEMGR_LOAD_LOC_CA_DATA);
    $_array_location_options[2]["value"] = "uk";
    $_array_location_options[2]["label"] = system_showText(LANG_SITEMGR_LOAD_LOC_UK_DATA);
    $_array_location_options[3]["value"] = "au";
    $_array_location_options[3]["label"] = system_showText(LANG_SITEMGR_LOAD_LOC_AU_DATA);

    $error = false;
    // Preparing to load locations
    if((!empty($_POST["load_location_option"])) && (strpos($_SERVER["HTTP_REFERER"], "configuration/geography") !== false)) {

        // Getting setting from sitemgr
        $_aux_load_location_option = explode("&", $_POST["load_location_option"]);

        // Create MySQL Connection
        $location_link = mysqli_connect(_DIRECTORYDB_HOST, _DIRECTORYDB_USER, _DIRECTORYDB_PASS, _DIRECTORYDB_NAME);
        if (!$location_link) {
            echo "error: mysql connect ".mysqli_error($location_link);
        } else {

            // Loading location to DemoDB
            foreach ($_aux_load_location_option as $_key => $_value) {

                $location_to_load = explode("=",$_value);
                $country_model_db = "demo_location_".$location_to_load[1];

                // Loading Locations
                for($i=1;$i<=5;$i++){

                    switch ($i) {
                        case 1: $locTree = "";
                            break;
                        case 2: $locTree = "location_1, ";
                            break;
                        case 3: $locTree = "location_1, location_2, ";
                            break;
                        case 4: $locTree = "location_1, location_2, location_3, ";
                            break;
                        case 5: $locTree = "location_1, location_2, location_3, location_4, ";
                            break;
                    }


                    $sql = "insert into `"._DIRECTORYDB_NAME."`.Location_".$i." ($locTree name, abbreviation, friendly_url, seo_description, seo_keywords) select $locTree name, abbreviation, friendly_url, seo_description, seo_keywords from ".$country_model_db.".Location_".$i;
                    $result = mysqli_multi_query($location_link, $sql);
                    if(!$result){
                        echo "error: sql error ".mysqli_error($location_link);
                    }
                }
                $loaded_locations[] =  $location_to_load[1];

            }

            // Saving locations loaded
            if (!setting_set("loaded_locations", serialize($loaded_locations))) {
                if (!setting_new("loaded_locations", serialize($loaded_locations))) {
                    $error = true;
                }
            }

            if (!$error) {
                echo "done";
            } else {
                echo "error";
            }

        }

    }
