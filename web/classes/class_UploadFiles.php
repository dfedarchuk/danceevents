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
	# * FILE: /classes/class_uploadFiles.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 *
	 * Class UPLOAD_FILES.
	 *
	 * This class has the purpose of ease and secure the upload of files.
	 *
	 * It executes several tests on the uploaded files and the upload directory
	 * to validate and secure the upload. It checks the file name extension,
	 * type, size and directory permissions.
	 *
	 * It may also create the uploading directory structure, generate a unique
	 * random name for the uploaded file, upload multiples files, and keep track
	 * of the upload success or failure.
	**/

	class UploadFiles extends Handle
	{

	  /**
	   * Receives the original name of the uploaded file.
	   *
	   * @var     string
	   * @access  private
	  **/
	  var $name;
	  
	  /**
	   * Receives the type of the uploaded file.
	   *
	   * @var     string
	   * @access  private
	  **/    
	  var $type;
	  
	  /**
	   * Receives the temporary path and name of the uploaded file.
	   *
	   * @var     string
	   * @access  private
	  **/        
	  var $tmp_name;

	  /**
	   * Receives the error of the uploaded file.
	   *
	   * @var     string
	   * @access  private
	  **/            
	  var $error;
	  
	  /**
	   * Store the size of the uploaded file.
	   *
	   * @var     string
	   * @access  private
	  **/            
	  var $size;

	  /**
	   * Keep track of the files successfully uploaded.
	   *
	   * @var     array
	   * @access  private
	   * @see     moveFileToDestination()
	  **/
	  var $succeed_files_track;
	  
	  /**
	   * Keep track of the files which fail the upload.
	   *
	   * @var     array
	   * @access  private
	   * @see     moveFileToDestination()
	  **/
	  var $fail_files_track;

	  /**
	   * Keep the index of the succeed_files_track array.
	   *
	   * @var     int
	   * @access  private
	   * @see     moveFileToDestination()
	   **/
	  var $succeed_track_index;

	  /**
	   * Keep the index of the fail_files_track array.
	   *
	   * @var     int
	   * @access  private
	   * @see     moveFileToDestination()
	   **/
	  var $fail_track_index;
	  
	  /**
	   * Receives an array with the supported file extensions and types.
	   *
	   * @var     array
	   * @access  private
	   * @see     checkUploadConditions()
	   **/    
	  var $supported_extensions;

	  /**
	   * Receives the destination directory for uploaded files.
	   *
	   * @var     string
	   * @access  private
	   * @see     checkUploadConditions(),createDiretoryStructure(),moveFileToDestination()
	  **/    
	  var $dst_dir;

	  /**
	   * Store the permission for the uploaded file. 
	   * Default value is 0444(read only).
	   *
	   * @var     string
	   * @access  private
	   * @see     moveFileToDestination()
	  **/    
	  var $file_perm;

	  /**
	   * Store the field name of the uploaded file.
	   *
	   * @var     string
	   * @access  private
	   * @see     moveFileToDestination()
	  **/    
	  var $fld_name;

	  /**
	   * Store the file maximum size allowed in bytes.
	   * Default value is 204800 bytes (200 KB).
	   *
	   * @var     int
	   * @access  private
	   * @see     checkUploadConditions()
	  **/        
	  var $max_file_size; //bytes.

	  /**
	   * Store messages of upload status.
	   *
	   * @var     array
	   * @access  private
	   * @see     moveFileToDestination()
	  **/            
	  var $msg;

	  /**
	   * Store the error code of upload.
	   * It became the index for array msg.
	   *
	   * @var     int
	   * @access  private
	  **/            
	  var $error_type; // error code.

	  /**
	   * If TRUE generate a random name to the file else maintain the original name.
	   * Default value is TRUE;
	   *
	   * @var     boolean
	   * @access  private
	   * @see     moveFileToDestination()
	  **/            
	  var $randon_name;  

	  /**
	   * If TRUE replace a existent file, else mantain the original file.
	   * Default value is TRUE;
	   *
	   * @var     boolean
	   * @access  private
	   * @see     moveFileToDestination()
	  **/            
	  var $replace;  
      
      /**
       * Allow to move files without use is_uploaded_file 
       */
      var $allow_move_files;

	///////////////////////////////////////////////////////////////////
	  /**
	   * Constructor
	   *
	   * @access  public
	  **/
	  function UploadFiles(){

		$this->name                 = "";
		$this->type                 = "";
		$this->tmp_name             = "";
		$this->error                = "";
		$this->size                 = "";
		$this->succeed_files_track  = array();
		$this->fail_files_track     = array();
		$this->succeed_track_index  = 0;
		$this->fail_track_index     = 0;
		$this->supported_extensions = array();
		$this->dst_dir              = "";
		$this->file_perm            = "0444";
		$this->fld_name             = "";
		$this->max_file_size        = 204800; //200Kb.
		$this->msg                  = array (
									  "0" => system_showText(LANG_UPLOAD_MSG_SUCCESSUPLOADED),
									  "1" => system_showText(LANG_UPLOAD_MSG_NOTALLOWED_WRONGFILETYPE),
									  "2" => system_showText(LANG_UPLOAD_MSG_EXCEEDSLIMIT),
									  "3" => system_showText(LANG_UPLOAD_MSG_FAILCREATEDIRECTORY),
									  "4" => system_showText(LANG_UPLOAD_MSG_WRONGDIRECTORYPERMISSION),
									  "5" => system_showText(LANG_UPLOAD_MSG_UNEXPECTEDFAILURE),
									  "6" => system_showText(LANG_UPLOAD_MSG_NOTFOUND_NOTENTERED),
									  "7" => system_showText(LANG_UPLOAD_MSG_FILEALREADEXISTSINDIRECTORY)
									  );
		$this->error_type           = 0; // error code.
		$this->randon_name          = TRUE;
		$this->replace              = TRUE;
	  }
	///////////////////////////////////////////////////////////////////
	  /**
	   * Set value to class variables.
	   *
	   * @param   string  $var
	   * @param   string  $value
	   * @access  public
	  **/
	  function set($var,$value){
		$this->$var = $value;
	  }
	///////////////////////////////////////////////////////////////////  
	  /**
	   * Get value of class variables.
	   *
	   * @param   string  $var
	   * @access  public
	  **/
	  function get($var){
		return $this->$var;
	  }
	///////////////////////////////////////////////////////////////////
	  /**
	   * Generate a unique name to the uploaded file.
	   *
	   * @access  private
	  **/
	  function generateUniqueId(){
		return md5(uniqid(mt_rand(),TRUE));
	  }
	///////////////////////////////////////////////////////////////////  
	  /**
	   * Generate the file unique name with extension.
	   * 
	   * @access  private
	   * @return  string $dst_file_name
	   * @uses    generateUniqueId()
	  **/
	  function generateFileName(){
		$dst_file_name = $this->generateUniqueId();
		$arr = explode(".",$this->name);
		$dst_file_name .= ".".$arr[count($arr)-1];
		return $dst_file_name;
	  }
	///////////////////////////////////////////////////////////////////  
	  /**
	   * Replace accents and special chars from file name.
	   * 
	   * @access  private
	   * @return  string $string
	  **/
	  function fixFileName($string){
		$string = strtr ( $string, "Ãâ¬ÃÂÃâÃÆÃâÃâ¦ÃÂ ÃÂ¡ÃÂ¢ÃÂ£ÃÂ¤ÃÂ¥ÃâÃâÃâÃâ¢ÃâÃËÃÂ²ÃÂ³ÃÂ´ÃÂµÃÂ¶ÃÂ¸ÃËÃâ°ÃÅ Ãâ¹ÃÂ¨ÃÂ©ÃÂªÃÂ«Ãâ¡ÃÂ§ÃÅÃÂÃÅ½ÃÂÃÂ¬ÃÂ­ÃÂ®ÃÂ¯Ãâ¢ÃÅ¡ÃâºÃÅÃÂ¹ÃÂºÃÂ»ÃÂ¼ÃÂ¿ÃâÃÂ±", "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn");
		for($i=0 ; $i < string_strlen($string); $i++){
		   if(preg_match('/[^0-9a-zA-Z_\.]/i',$string[$i]))
			 $string[$i] = "_";
		}
		return $string;
	  }
	///////////////////////////////////////////////////////////////////
	  /**
	   * Check upload condictions for file and directory.
	   * 
	   * @access  private
	   * @return  bool (true/false)
	   * @uses    createDiretoryStructure()
	  **/
	  function checkUploadConditions(){

		//-------- extension and type check -----------//
		$arr = explode(".", $this->name);
		$ext = $arr[count($arr)-1];
		foreach ($this->supported_extensions as $each_ext => $type) {
			$each_type = explode(",", $type);
			foreach ($each_type as $type) {
				if (string_strtolower($each_ext) == string_strtolower($ext) && $this->type == $type) $allow = TRUE;
				if (string_strtolower($each_ext) == string_strtolower($ext) && "all" == $type) $allow = TRUE;
			}
		}
		if (!$allow) {
			$this->error_type = 1;
			return FALSE;
		}
		//----------------------------------------------//

		//------ size check ----------------------------//
		if($this->size > $this->max_file_size) {
		  $this->error_type = 2;
		  return FALSE;
		}
		//----------------------------------------------//


		//----- directory check ------------------------//
		if(!file_exists($this->dst_dir)){
		  if(!$this->createDiretoryStructure()){
			$this->error_type = 3;
			return FALSE;
		  } else {
			return TRUE; 
		  }
		} elseif (!is_writable($this->dst_dir)){ 
		  $this->error_type = 4;
		  return FALSE;
		} else {
		  return TRUE;
		}
		//----------------------------------------------//

	  }
	///////////////////////////////////////////////////////////////////  
	  /**
	   * Try to create directory structure for upload.
	   * 
	   * @access  private
	   * @return  bool (true/false)
	  **/
	  function createDiretoryStructure(){

		$arr = explode("/",$this->dst_dir);

		/* Dumping possible garbage inside vector like 
		   empty indexes leaved by repeated slashes.  */
		$j=0;
		for($i=0; $i < count($arr); $i++)
		  if($arr[$i]) $new_arr[$j++] = $arr[$i];
		//---------------------------------------------//

		$arr = $new_arr;
		$end = count($arr);

		for($i=0; $i < $end; $i++){
		  $path .= "/".$arr[$i];
		  if(!file_exists($path)) {
			if(!@mkdir($path,0755)) { 
			  $fail = TRUE; 
			  break; 
			}
		  }
		}

		if($fail) return FALSE; else return TRUE;
	  }

	///////////////////////////////////////////////////////////////////  
	/**
	* Execute the upload. 
	* This is the main function that should be used outside this class.
	* Also is responsable for keep track of succeed and failure uploads.
	* 
	* @access  public
	* @return  bool (true/false)
	* uses     checkUploadConditions(),generateFileName()
	**/
	function moveFileToDestination() {
        if($this->allow_move_files){
            if ($this->checkUploadConditions()) {
                $dst_file_name = ($this->randon_name) ? $this->generateFileName() : $this->fixFileName($this->name);
                $full_destination_path = $this->dst_dir."/".$dst_file_name;
                
                if (rename($this->tmp_name, $full_destination_path)) {
                    @chmod($this->dst_dir."/".$dst_file_name, $this->file_perm);
                    $this->error_type = 0;
                } else {
                    $this->error_type = 5;
                }
            }
        }else{
            if (is_uploaded_file($this->tmp_name) && $this->dst_dir) {
                if ($this->checkUploadConditions()) {
                    $dst_file_name = ($this->randon_name) ? $this->generateFileName() : $this->fixFileName($this->name);
                    $full_destination_path = $this->dst_dir."/".$dst_file_name;
                    if (move_uploaded_file($this->tmp_name, $full_destination_path)) {
                        @chmod($this->dst_dir."/".$dst_file_name, $this->file_perm);
                        $this->error_type = 0;
                    } else {
                        $this->error_type = 5;
                    }
                }
            } else {
                $this->error_type = 6; 
            }    
        }

		if ($this->error_type != 0) {
			$this->fail_files_track[$this->succeed_track_index]["file_name"]             = $this->name;
			$this->fail_files_track[$this->succeed_track_index]["new_file_name"]         = $dst_file_name;
			$this->fail_files_track[$this->succeed_track_index]["destination_directory"] = $this->dst_dir;
			$this->fail_files_track[$this->succeed_track_index]["field_name"]            = $this->fld_name;
			$this->fail_files_track[$this->succeed_track_index]["file_size"]             = $this->size;
			$this->fail_files_track[$this->succeed_track_index]["file_type"]             = $this->type;
			$this->fail_files_track[$this->succeed_track_index]["error_type"]            = $this->error_type;
			$this->fail_files_track[$this->succeed_track_index++]["msg"]                 = $this->msg[$this->error_type];
			return FALSE;
		} else {
			$this->succeed_files_track[$this->fail_track_index]["file_name"]             = $this->name;
			$this->succeed_files_track[$this->fail_track_index]["new_file_name"]         = $dst_file_name;
			$this->succeed_files_track[$this->fail_track_index]["destination_directory"] = $this->dst_dir;
			$this->succeed_files_track[$this->fail_track_index]["field_name"]            = $this->fld_name;
			$this->succeed_files_track[$this->fail_track_index]["file_size"]             = $this->size;
			$this->succeed_files_track[$this->fail_track_index]["file_type"]             = $this->type;
			$this->succeed_files_track[$this->fail_track_index]["error_type"]            = $this->error_type;
			$this->succeed_files_track[$this->fail_track_index++]["msg"]                 = $this->msg[$this->error_type];
			return TRUE;
		}
	}

	}

?>
