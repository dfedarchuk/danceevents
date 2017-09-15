<?

	/*==================================================================*\
	######################################################################
	# eDirectory 4.0.1 - Licence Number L62338e2                         #
	# ------------------------------------------------------------------ #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_thumbGenerator.php
	# ----------------------------------------------------------------------------------------------------

	/**
	* This class meant to generate thumbnails
	* The code is all based in gd library functions, so this library is required for this class.
	*
	* @name: ThumbGenerator
	**/
	class ThumbGenerator {

		/**
		* Class constructor.
		* It sets some default initial values for the most important class variables.
		*
		* @name:   ThumbGenerator
		* @access: public
		* @depend: setSupported
		* @return: void
		**/
		function ThumbGenerator() {

			// Thumb default size
			$this->thumbWidth = 50;
			$this->thumbHeight = 50;

			// Error msg border (bool true/false)
			$this->drawBorder = TRUE;

			// Initial position of string for error msg
			$this->initialPixelCol = 3;
			$this->initialPixelRow = 2;

			// Draw image border (bool true/false)
			$this->drawImgBorder = FALSE;

			// Screen output (bool true/false)
			$this->screenOutput = FALSE;

			// Supported files and their respective output functions
			$this->setSupported("IMAGETYPE_GIF", "imageCreateFromGif", "imagegif");
			$this->setSupported("IMAGETYPE_JPEG", "imageCreateFromJpeg", "imagejpeg");
			$this->setSupported("IMAGETYPE_PNG", "imageCreateFromPng", "imagepng");

			// Keep original size
			$this->originalSize = FALSE;

			// Image properties
			$this->img = array();

			// Full destination path with file name to store the file.
			$this->destination_path = "/tmp/image_teste.gif";

		}

		/**
		* Set values for class variables.
		*
		* @name:   set
		* @access: public
		* @param:  string $key
		* @param:  string $value
		* @return: void
		**/
		function set($key, $value) {
			$this->$key = $value;
		}

		/**
		* Extract all relevant information about the image and load it into a class variable.
		*
		* @name:   loadFileInfo
		* @access: private
		* @param:  string $file
		* @return: void
		**/
		function loadFileInfo($file) {
			if (file_exists($file)) {
				list ($this->img["width"], $this->img["height"]) = GetImageSize ($file);
				$this->img["str_len"]  = strlen(basename($file));
				$this->img["name"]     = substr(basename($file),0,$len-4);
				$this->img["ext"]      = substr(basename($file),$len-3,strlen(basename($file)));
				if (strtoupper($this->img["ext"]) == "JPG" || strtoupper($this->img["ext"]) == "JPEG"){                    
                    $this->img["type"] = "IMAGETYPE_JPEG";                    
                }elseif (strtoupper($this->img["ext"]) == "GIF"){
                    $this->img["type"] = "IMAGETYPE_GIF";
                }elseif (strtoupper($this->img["ext"]) == "PNG"){
                    $this->img["type"] = "IMAGETYPE_PNG";
                }
			}
		}

		/**
		* Check if image is supported.
		* This function is just checking extension, so it can fail.
		*
		* @name:   isSupported
		* @access: private
		* @depend: loadFileInfo
		* @param:  string $file
		* @return: boolean(true/false)
		**/
		function isSupported($file) {
			$this->loadFileInfo($file);
			$ext   =& $this->supportedExt;
			$count =& $ext["count"];
			for ($i = 0; $i < $count; $i++) {
				if ($ext["type"][$i] == $this->img["type"]) {
					$supported = TRUE;
					break;
				} else{
                    $supported = FALSE;
                }
			}
			return $supported;
		}

		/**
		* This function returns the appropriate function name to to create the image.
		*
		* @name:   retrieveCreateFunction
		* @access: private
		* @param:  string $file
		* @return: string $ext["function"][$i]
		**/
		function retrieveCreateFunction($file) {
			$ext   =& $this->supportedExt;
			$count =& $ext["count"];
			for ($i = 0; $i < $count; $i++){
                if ($ext["type"][$i] == $this->img["type"]){
                    break;
                }
            }
			return $ext["create_function"][$i];
		}

		/**
		* This function returns the appropriate function name to to generate the image.
		*
		* @name:   retrieveGenerateFunction
		* @access: private
		* @param:  string $file
		* @return: string $ext["function"][$i]
		**/
		function retrieveGenerateFunction($file) {
			$ext   =& $this->supportedExt;
			$count =& $ext["count"];
			for ($i = 0; $i < $count; $i++){
                if ($ext["type"][$i] == $this->img["type"]){
                    break;
                }
            }

			return $ext["generate_function"][$i];
		}

		/**
		* This function meant to set all supported image types and your respective create functions.
		* So if you are trying to resize a jpg file you should use this functions like this below:
		* -> $this->setSupported(IMAGETYPE_JPEG, imageCreateFromJpeg);
		* Note that the default settings are done by the constructor of this class.
		*
		* @name:   setSupported
		* @access: private
		* @param:  string $value
		* @param:  string $function
		* @return: void
		**/
		function setSupported($value, $create_function,$generate_function) {
			$this->supportedExt["type"][]              = $value;
			$this->supportedExt["create_function"][]   = $create_function;
			$this->supportedExt["generate_function"][] = $generate_function;
			$this->supportedExt["count"]               = count($this->supportedExt["type"]);
		}

		/**
		* This function meant to create a image with a error message when the flag outputScreen is turned on.
		*
		* @name:   writeLine
		* @access: private
		* @param:  string $string
		* @param:  string $width
		* @return: void
		**/
		function writeLine($string, $width = FALSE) {
			if ($width === FALSE) {
				$strLen = strlen($string);
				$width = ($strLen * 10) - ($strLen * 2.8);
			}
			$img        = ImageCreateTrueColor($width+1, 16);
			$textColor   = ImageColorAllocate ($img, 255, 255, 255);
			$borderColor = ImageColorAllocate ($img, 0, 0, 0);
			if ($this->drawBorder) ImageRectangle($img, 0, 0, $width, 15, $borderColor);
			ImageString ($img, 3, $this->initialPixelCol, $this->initialPixelRow,  $string, $borderColor);
			if ($this->screenOutput) {
				$generate_func   = $this->retrieveGenerateFunction($file);
				header("Content-type: image/jpeg");
				$generate_func($img);
			}
		}

		/**
		* This is the main function.
		* It generates the resized image.
		* It can output the result to screen or just write the new resized image at the hard disc.
		*
		* @name:   makeThumb
		* @access: private
		* @depend: retrieveGenerateFunction, retrieveCreateFunction, isSupported, writeLine
		* @param:  string $file
		* @return: void
		**/
		function makeThumb($file) {

			if (file_exists($file)) {

				// Defining image size
				if ($this->originalSize) { // Original size
					$newWidth = $this->img["width"];
					$newHeight = $this->img["height"];
				} else { // Default size
					$newWidth = $this->thumbWidth;
					$newHeight = $this->thumbHeight;
				}

				// Check if image is supported
				if (!$this->isSupported($file)) {
					$this->writeLine("Image type not supported!");
				} else { // if (!$this->isSupported($file)) {

					$create_func   = $this->retrieveCreateFunction($file);
                    if((strpos(strtolower($this->img["type"]), "jpg") !== false) && (FORCE_SAVE_JPG_AS_PNG == "on")){
                        $src = ImageCreateTrueColor($this->img["width"], $this->img["height"]); 
                    }else{
                        $src = $create_func($file);
                    }
					
					$img           = ImageCreateTrueColor($newWidth, $newHeight);
                    $lowQuality = false;
					
					//fix for transparent png and gif
					if (strpos(strtolower($this->img["type"]), "png") !== false || strpos(strtolower($this->img["type"]), "gif") !== false){
						imagealphablending($img, false);
						imagesavealpha($img,true);
						$transparent = imagecolorallocatealpha( $img, 255, 255, 255, 127 );
						imagefill( $img, 0, 0, $transparent );
						imagecolortransparent( $img, $transparent);
                        $transindex = imagecolortransparent($src);
                        if($transindex >= 0) {
                            $lowQuality = true; //only use imagecopyresized (low quality) if the image is a transparent gif
                        }
					}
					
					if (strpos(strtolower($this->img["type"]), "gif") !== false && $lowQuality){
						//low quality, but keeps tranparent for .gif
						imagecopyresized ($img, $src, 0, 0, 0, 0, $newWidth, $newHeight, $this->img["width"], $this->img["height"]);
					} else {
						//better quality, but no transparency for .gif
						@imagecopyresampled ($img, $src, 0, 0, 0, 0, $newWidth, $newHeight, $this->img["width"], $this->img["height"]);
					}
					

					if ($this->drawImgBorder) {
						ImageRectangle($img, 0, 0, $newWidth -2, $newHeight -2, $borderColor);
					}

					$generate_func = $this->retrieveGenerateFunction($file);
                    if($generate_func == "imagejpeg"){                        
                        if(FORCE_SAVE_JPG_AS_PNG == "on"){                            
                            imagepng($img,$this->destination_path);
                        }else{                            
                            $generate_func($img,$this->destination_path,82); // To increase quality of image
                            //$generate_func($img,$this->destination_path);
                        }                   
                        
                    }else{
                        $generate_func($img,$this->destination_path);                        
                    }


					if ($this->screenOutput) {
                        
						$generate_func = $this->retrieveGenerateFunction($file);
						header("Content-type: image/jpeg");
						$generate_func($img);
					}

				} // } else { // if (!$this->isSupported($file)) {

			} else $this->writeLine("Image not found!");

		} // function makeThumb($file) {

	}

?>