<?php
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
	# * FILE: /classes/class_AppCustomPage.php
	# ----------------------------------------------------------------------------------------------------

    /**
	 * <code>
	 *		$customPage = new AppCustomPage($title, $icon, $json);
	 *		$customPage = new AppCustomPage($title, $icon, $json, $id);
	 * <code>
	 * @copyright Copyright 2014 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @version 9.8.01
	 * @package Classes
	 * @name AppCustomPage
	 * @method AppCustomPage
	 * @method Delete
	 * @method HandlePost
	 * @method Load
	 * @method LoadAll
	 * @method Save
	 * @method renderCarrousel
	 * @method renderIconModal
	 * @access Public
	 */

	class AppCustomPage extends Handle
    {
        public static $imageNameFormat = "sitemgr_photo_%s";
        public static $iconPath = "/assets/icons/api/";
        public static $imagePath = IMAGE_DIR;
        public static $imageURL = IMAGE_URL;

        /**
         * Custom page's id in DB
         * @var int
         */
		public $id;
        /**
         * Custom page's title
         * @var string
         */
		public $title;
        /**
         * Icon image name without the extension (.png)
         * @var string
         */
		public $icon;
        /**
         * Sir Trevor's JSON
         * @var string
         */
		public $json;

        /**
         * Constructor - creates a new instance
         * @param type $title
         * @param type $icon
         * @param type $json
         * @param type $id
         */
		function AppCustomPage( $title, $icon, $json = null, $id = 0 )
        {
            $this->id    = (int)$id;
            $this->title = $title;
            $this->icon  = $icon;
            $this->json  = $json;
		}

        /**
         * Saves current instace data to the Database. Updates entry if
         * Id already exists
         * @return boolean
         */
		function Save( $addToMenu = false )
        {
            $result = false;

			$dbMain = db_getDBObject(DEFAULT_DB, true);

			if (defined("SELECTED_DOMAIN_ID"))
            {
				$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			}
            else
            {
				$dbObj = db_getDBObject();
			}
			unset($dbMain);

            $title = db_formatString($this->title);
            $icon = db_formatString($this->icon);
            $json = db_formatString($this->json);

			if ( $this->id == 0 )
            {
				$sql = "INSERT INTO AppCustomPages (title, icon, json )"
					. " VALUES( $title, $icon, $json )";

                $result = $dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);

                if( $addToMenu )
                {
                    $sql = "SELECT ( MAX( Setting_Navigation.order ) ) AS lastItemOrder FROM Setting_Navigation WHERE area = 'tabbar';";
                    $result = $dbObj->query($sql);
                    $order = 1;
                    if ( $row = mysql_fetch_object($result) ) {
                        $order = $row->lastItemOrder - 3;


                        for ($i = $row->lastItemOrder; $i >= $order  ; $i--) {
                            $newOrder = $i + 1;
                            $sqlUpdateLastOptions = "UPDATE Setting_Navigation SET `order`= {$newOrder} WHERE `order` = $i AND `area` = 'tabbar'";
                            $dbObj->query($sqlUpdateLastOptions);
                        }
                    }

                    $sql = "INSERT INTO Setting_Navigation (`order`, `label`, `link`, `area`, `custom`) VALUES ($order, $title, 'cp_{$this->id}', 'tabbar', 'n')";
                    $result = $dbObj->query($sql);
                }
			}
            else
            {
				$sql  = "UPDATE AppCustomPages SET "
					. " title = $title,"
					. " icon = $icon,"
					. " json = $json"
					. " WHERE id = $this->id";

                $result = $dbObj->query($sql);
			}

			unset($dbObj);

            return $result;
		}


        /**
         * Deletes a Custom page from the Database
         * @param int $id
         * @return boolean
         */
		public static function Delete( $id )
        {
            $id = (int)$id;
            $result = false;

            if ( $id > 0 )
            {
                $dbMain = db_getDBObject(DEFAULT_DB, true);

                if (defined("SELECTED_DOMAIN_ID"))
                {
                    $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                }
                else
                {
                    $dbObj = db_getDBObject();
                }
                unset($dbMain);

                $customPage = self::Load($id);
                $customPage->cleanImages();

                $sql  = "DELETE FROM Setting_Navigation WHERE link = 'cp_{$id}'";
                $dbObj->query($sql);

                $sql  = "DELETE FROM AppCustomPages WHERE id = {$id} ";
                $result = $dbObj->query($sql);

                unset($dbObj);
            }

            return $result;
		}

        /**
         * Handles post requests linked to custom pages
         */
        public static function HandlePost()
        {
            if ( $_FILES && count( $_FILES ) == 1 )
            {
                /* This is supposed to handle the upload of just one image */
                $file = array_pop($_FILES);

                $fileError = $file['error']['file'];
                $fileTemporaryName = $file['tmp_name']['file'];

                $maxImageSize = ((UPLOAD_MAX_SIZE * 10) + 1) . "00000";
                $fileSize = $file['size']['file'];

                $errors = null;

                /**
                 * Error and Validation handling
                 */
                if ( $fileError || empty( $fileTemporaryName ) )
                {
                    switch ( $fileError )
                    {
                        case 1:
                        case 2: $errors[] = LANG_SITEMGR_CUSTOMPAGES_ADD_FAILURE_IMAGE_BIG; break;
                        case 3: $errors[] = LANG_SITEMGR_CUSTOMPAGES_ADD_FAILURE_IMAGE_PARTIAL; break;
                        case 4: $errors[] = LANG_SITEMGR_CUSTOMPAGES_ADD_FAILURE_IMAGE_PARTIAL; break;
                        default: $errors[] = LANG_SITEMGR_CUSTOMPAGES_ADD_FAILURE_IMAGE; break;
                    }
                }
                else
                {
                    if( $fileSize > $maxImageSize )
                    {
                        $errors[] = LANG_SITEMGR_CUSTOMPAGES_ADD_FAILURE_IMAGE_BIG;
                    }

                    if( !image_upload_check( $fileTemporaryName ) )
                    {
                        $errors[] = LANG_SITEMGR_CUSTOMPAGES_ADD_FAILURE_IMAGE_EXTENSION;
                    }
                }

                /* If we got any errors, glue them together and let the user know */
                if ( $errors )
                {
                    echo implode( "<br>", $errors);
                    exit;
                }

                /* Otherwise, lets get the image's binary content
                 * and send it back to sir Trevor */
                $blob = file_get_contents($fileTemporaryName);

                /* The @ in front of any function supress errors
                 * it's a necessary evil here, since we need the real
                 * image extension to be able to generate the image
                 * back from it's binary info once the custom page is saved */
                $info = @getimagesize( $fileTemporaryName );

                $imageExtension = image_type_to_extension($info[2]);

                echo json_encode( array(
                    'file' => array(
                        'url'       => " ",
                        'blob'      => base64_encode( $blob ),
                        'extension' => $imageExtension,
                    )
                ));
                exit;
            }


            switch($_POST['action'])
            {
                case "load" :
                    $page = AppCustomPage::Load( $_POST['id'] );
                    $page->iconImgTag = " <img src='".DEFAULT_URL."/assets/icons/api/{$page->icon}.png' alt='Icon'>";

                    echo json_encode($page);
                    exit;
                case "delete" :
                    echo AppCustomPage::Delete( $_POST['id'] );
                    exit;
                case "save" :
                    $responseArray['result'] = 0;

                    $title     = $_POST['title'];
                    $json      = $_POST['json'];
                    $icon      = $_POST['icon'];
                    $addToMenu = ( $_POST['addToMenu'] == "true" );

                    $errors = null;

                    self::Validate( $title, "title", $errors );
                    self::Validate( $json, "json", $errors );
                    self::Validate( $icon, "icon", $errors );

                    if( !$errors )
                    {
                        if ( $_POST['id'] )
                        {
                            $customPage = AppCustomPage::Load( $_POST['id'] );
                            $customPage->icon = $icon;
                            $customPage->title = $title;
                            $action = 'save';
                        }
                        else
                        {
                            $customPage = new AppCustomPage( $title, $icon );
                            $action = 'add';
                        }

                        $customPage->handleImages( $json );

                        if( $customPage->Save( $addToMenu ) )
                        {
                            $responseArray['result'] = 1;
                            switch ( $action )
                            {
                                case 'save': $responseArray['message'] = str_replace( "PAGENAME", $customPage->title, LANG_SITEMGR_CUSTOMPAGES_CHANGE_SUCCESS); break;
                                case 'add' : $responseArray['message'] = str_replace( "PAGENAME", $customPage->title, LANG_SITEMGR_CUSTOMPAGES_ADD_SUCCESS); break;
                            }
                        }
                        else
                        {
                            switch ( $action )
                            {
                                case 'save': $responseArray['message'] = LANG_SITEMGR_CUSTOMPAGES_CHANGE_FAILURE; break;
                                case 'add' : $responseArray['message'] = LANG_SITEMGR_CUSTOMPAGES_ADD_FAILURE; break;
                            }
                        }
                    }
                    else
                    {
                        $responseArray['message'] = "<ul>";
                        foreach ( $errors as $error )
                        {
                            $responseArray['message'] .= "<li>$error</li>";
                        }
                        $responseArray['message'] .= "</ul>";
                    }

                    echo json_encode($responseArray);
                    exit();

                case "carousel" :
                    echo self::renderCarrousel();
                    exit();
            }
            exit();
		}

        /**
         * Handles post requests linked to custom pages while DEMO_LIVE_MODE is on
         */
        public static function HandleDemoPost()
        {
            if ( ( $_FILES && count( $_FILES ) == 1 ) || $_POST['action'] == "load" || $_POST['action'] == "carousel" )
            {
                self::HandlePost();
            }

            exit();
		}

        /**
         * Attempts to load one custom page from the database using it's id
         * @param int $id
         * @return \AppCustomPage|null
         */
        public static function Load( $id )
        {
            if ( !empty($id) )
            {
                $dbMain = db_getDBObject(DEFAULT_DB, true);

                if (defined("SELECTED_DOMAIN_ID"))
                {
                    $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                }
                else
                {
                    $dbObj = db_getDBObject();
                }
                unset($dbMain);

                $sql  = "SELECT * FROM AppCustomPages WHERE id = " . (int)$id;

                $result = $dbObj->query($sql);

                if ( $row = mysql_fetch_object($result) )
                {
                    $loaded = new AppCustomPage($row->title, $row->icon, $row->json, $row->id);
                    return $loaded;
                }

                unset($dbObj);
            }

            return null;
        }

        /**
         * Attempts to retrieve all pages from the Database
         * @return \AppCustomPage
         */
        public static function LoadAll()
        {
            $dbMain = db_getDBObject(DEFAULT_DB, true);

            if (defined("SELECTED_DOMAIN_ID"))
            {
                $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            }
            else
            {
                $dbObj = db_getDBObject();
            }
            unset($dbMain);

            $sql  = "SELECT * FROM AppCustomPages";

            $result = $dbObj->query($sql);

            $return = null;
            while( $row = mysql_fetch_object($result) )
            {
                $return[$row->id] = new AppCustomPage($row->title, $row->icon, $row->json, $row->id);
            }

            unset($dbObj);

            return $return;
        }

        /**
         * Generates an open-carousel instance with buttons to every custom page
         * created by the user.
         * @return string
         */
        public static function renderCarrousel()
        {
            $maxPagesPerSlide = 4;
            $html = null;

            if ( $customPages = self::LoadAll() )
            {
                $scrollAmount = min( array( count($customPages), $maxPagesPerSlide ) );

                $disabled = count($customPages) <= $maxPagesPerSlide ? 'disabled' : '';

                $html = "<div class=\"ocarousel\" data-ocarousel-perscroll=\"{$scrollAmount}\" >" .
                        '   <div class="ocarousel_window">';

                foreach ( $customPages as $page )
                {
                    $html .= "      <div>"
                            ."          <a class='custompage' href='#' alt='{$page->title}' data-id='{$page->id}'>"
                            ."              <span class='cpage-icon'><img src='".DEFAULT_URL."/assets/icons/api/{$page->icon}.png'></span>"
                            ."              <span class='cpage-name'>{$page->title}</span>"
                            ."          </a>"
                            ."      </div>";
                }

                $html.= '   </div>'.
                        '   <br>'.
                        "   <a href=\"#\" data-ocarousel-link=\"left\" style=\"float: left;\" class=\"$disabled\"> <i class=\"ocarousel-left-arrow\"></i> </a>".
                        "   <a href=\"#\" data-ocarousel-link=\"right\" style=\"float: right;\" class=\"$disabled\"> <i class=\"ocarousel-right-arrow\"></i></a>".
                        '</div>';

            }

            return $html;
        }

        /**
         * Collects all image files from the specified directory and
         * generates a unordered list with entries for each one of them
         * @return type
         */
        public static function renderIconModal()
        {
            $iconDirectory = EDIRECTORY_ROOT. "/assets/icons/api";
            $directoryHandler = opendir($iconDirectory);

            echo "<div id='iconmodaldiv'><input class='search' placeholder='".system_showText(LANG_SITEMGR_CUSTOMPAGES_ICON_MODAL_SEARCH)."' /><ul class='list'>";
            while ( false !== ( $filename = readdir( $directoryHandler ) ) )
            {
                // ignore the _selected icons and anything else other than .png
                if ( !preg_match( "/\_selected/i", $filename ) && strpos( $filename,'.png') )
                {
                    $iconName = str_replace(".png", "", $filename);

                    /*  Removes the first 3 characters from the name (ic_ ), swaps
                     *  underlines for spaces and upcases the first letters */
                    $friendlyName = ucwords ( str_replace('_', ' ', substr($iconName, 3)) );
                    echo "<li> <a href='#' id='{$iconName}' class='iconbuttonmodal' title='{$friendlyName}' alt='{$friendlyName}'><span class='cpage-icon'> <img src='".DEFAULT_URL."/assets/icons/api/{$iconName}.png'> </span><span class='modaliconbuttonlabel'>{$friendlyName}</span> </a></li>";
                }


            }

            echo "</ul></div>";
        }

        /**
         * Overrides Handle -> prepareToSave()
         *
         * Analyzes the JSON structure to check if the user removed any images.
         * Purge the images if positive or saves and handles new images.
         * @param string $newJSON The new json string.
         */
        public function handleImages( $newJSON )
        {
            if ( get_magic_quotes_gpc() )
            {
                $newJSON = stripslashes( $newJSON );
            }

            if ( $this->id != 0 )
            {
                $this->cleanImages( $newJSON );
            }

            $decodedJSON = json_decode( $newJSON );

            foreach ( $decodedJSON->data as $block)
            {
                if ( $block->type === "image" && !empty( $block->data->file->blob ))
                {
                    /* This humongous 'if' translates to (in order):
                     * IF we can decode the image blob as a BASE64 thing
                     * AND we can also generate an unique name for it
                     * AND we can create a new image on the specified folder
                     * AND we can write all the image bytes into this new image file
                     * AND we can close (and save) it
                     * Then erase blob and extension info - we won't need it anymore
                     * set the JSON URL to the newly created image
                     * and save the image into the $createdImages array
                     */
                    if( $imageData = base64_decode( $block->data->file->blob ) and $filename = self::generateImageUID( self::$imageNameFormat . $block->data->file->extension ) and $newImage = fopen( self::$imagePath . "/{$filename}" , "wb") and fwrite($newImage, $imageData) and fclose($newImage) )
                    {
                        unset($block->data->file->blob);
                        unset($block->data->file->extension);
                        $block->data->file->url = self::$imageURL . "/{$filename}";
                        $createdImages[] = $newImage;
                    }
                    else
                    {
                        /* Coldn't decode image or generate a new name.
                           Could be corrupted json or image folder REALLY full. */
                        echo system_showText(LANG_SITEMGR_CUSTOMPAGES_ADD_FAILURE_IMAGE);
                        foreach ($createdImages as $image )
                        {
                            unlink($image);
                        }
                        exit;
                    }
                }
            }

            $this->json = json_encode($decodedJSON);
        }

        /**
         * Generates a unique id for an image based on a skeleton name
         * The code is composed of random characters from the $codeCharacters
         * static variable and is swapped for a %s in the name model.
         *
         * Example: echo generateImageUID( "new_image_%s.jpg" );
         * output new_image_a63GP.jpg
         *
         * @staticvar string $codeCharacters the allowed random characters
         * @param string $namemodel the file name model string containing a %s where the code will be placed
         * @return string the generated random name.
         */
        public static function generateImageUID( $namemodel )
        {
            static $codeCharacters = "abcdefghijklmnopqrstuxyvwzABCDEFGHIJKLMNOPQRSTUXYVWZ1234567890";

            $maximumAttempts = 2000;
            $currentAttempt  = 0;

            $randNumberLength = 4;

            $randNumber = NULL;

            do
            {
                $randNumber = NULL;
                $currentAttempt++;

                for ( $i = 0; $i < $randNumberLength; $i++ )
                {
                    $randNumber .= $codeCharacters[rand( 0, strlen( $codeCharacters ) - 1 )];
                }

                $filename = sprintf( $namemodel, $randNumber );
            }
            while ( file_exists( self::$imagePath . $filename ) && $currentAttempt < $maximumAttempts );

            return ($currentAttempt < $maximumAttempts ? $filename : false );
        }

        /**
         * Deletes images from the server. If a new (encoded) Sir Trevor JSON
         * is provided, we'll check against it to delete only images
         * that won't be used anymore.
         * @param string $json The new sir trevor JSON structure
         */
        public function cleanImages( $json = null )
        {
            if ( $json )
            {
                $usedImages  = array();

                /* First let's check the new JSON and get all the images in it */
                $decodedJSON = json_decode( $json );

                foreach ( $decodedJSON->data as $block)
                {
                    ( $block->type === "image" ) and empty( $block->data->file->blob ) and  $usedImages[] = $block->data->file->url;
                }

                /* Then let's get our old JSON and check ifit's old pics are still there.
                 * Delete those who aren't */
                $decodedJSON = json_decode( $this->json );
                foreach ( $decodedJSON->data as $block)
                {
                    if( $block->type === "image" && !in_array( $block->data->file->url, $usedImages ) )
                    {
                        $fileName = pathinfo( $block->data->file->url , PATHINFO_BASENAME);

                        if ( file_exists( self::$imagePath . "/{$fileName}" ) )
                        {
                            @unlink( self::$imagePath . "/{$fileName}" );
                        }
                    }
                }
            }
            else
            {
                /* Since no JSON was provided for us to compare to,
                 * we'll just delete everything. That will teach them!
                 * Jokes apart, this is used before custom page deletion
                 * to ensure file consistency */
                $decodedJSON = json_decode( $this->json );
                foreach ( $decodedJSON->data as $block)
                {
                    if( $block->type === "image" )
                    {
                        $fileName = pathinfo( $block->data->file->url , PATHINFO_BASENAME);
                        unlink( self::$imagePath . "/{$fileName}");
                    }
                }
            }
        }

        /**
         * Validates and filters data.
         *
         * @param string $item
         * @param string $type Possible types: json, title or icon
         * @param array $errors
         * @return boolean
         */
        public static function Validate( &$item, $type, &$errors )
        {
            $validationErrors = null;

            switch ( $type )
            {
                case 'json' :
                    if( empty( $item ) || $item == '{"data":[]}' )
                    {
                        $validationErrors[] = LANG_SITEMGR_CUSTOMPAGES_ADD_FAILURE_JSON;
                    }
                    break;
                case 'icon' :
                    /* Filter all sorts of unholy things */
                    $item = strip_tags( trim($item) );
                    if( empty( $item ) )
                    {
                        $item = 'ic_plus';
                    }
                    break;
                case 'title' :
                    /* Filter all sorts of unholy things */
                    $item = strip_tags( trim($item) );

                    if( empty( $item ) )
                    {
                        $validationErrors[] = LANG_SITEMGR_CUSTOMPAGES_ADD_FAILURE_TITLE;
                    }
                    break;
            }

            if ( $validationErrors )
            {
                if ( is_array( $errors ) )
                {
                    $validationErrors = array_merge($validationErrors,$errors );
                }
                else if ( $errors )
                {
                    $validationErrors[] = $errors;
                }

                $errors = $validationErrors;

                return false;
            }

            return true;
        }

        public static function getMenuOptions( $id = null )
        {
            $response = null;
            $customPages = self::LoadAll();

            if ( $customPages )
            {
                $response .= "<option>---</option>";

                foreach ( $customPages as $page )
                {
                    $selected = $page->id == $id ? 'selected=\"selected\"' : '';
                    $response .= "<option value=\"cp_{$page->id}\" {$selected}>{$page->title}</option>";
                }
            }

            return $response;
        }

        public static function count()
        {
            static $count = null;

            if(!$count)
            {
                $dbMain = db_getDBObject(DEFAULT_DB, true);

                if (defined("SELECTED_DOMAIN_ID"))
                {
                    $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                }
                else
                {
                    $dbObj = db_getDBObject();
                }
                unset($dbMain);

                $result = mysql_query( "SELECT count(*) as total from AppCustomPages" );
                $data   = mysql_fetch_assoc( $result );
                $count  =  $data['total'];

                unset($dbObj);
            }

            return $count;
        }

    }
