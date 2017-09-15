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
	# * FILE: /classes/class_zipFile.php
	# ----------------------------------------------------------------------------------------------------

	class ZipFile {
		
		/* An array that stores the compressed data files and directory headers to be stored in the Zip file */
		var $datasec = array();
		/*An array that stores the central index information appended to the end of the completed Zip file  */
		var $ctrl_dir = array();
		/* This variable is used by the Zip object to provide the information used to create the central index */
		var $eof_ctrl_dir = "\x50\x4b\x05\x06\x00\x00\x00\x00";
		/* Pre-set binary data used to define the end of the central index. */
		var $old_offset = 0;
		/* */

		function ZipFile(){}

		function addDir($name){

			$name = str_replace("\\", "/", $name);

			/*
			* Re-format the directory parameter replacing all back-slashes '\' with forward-slashes '/'
			* Construct the general header information for the directory
			* Construct the directory header specific information
			* Construct an optional data-segment for the directory header
			* Store the complete header information into the $datasec array
			*/
			$fr = "\x50\x4b\x03\x04";
			$fr .= "\x0a\x00";
			$fr .= "\x00\x00";
			$fr .= "\x00\x00";
			$fr .= "\x00\x00\x00\x00";

			$fr .= pack("V",0);
			$fr .= pack("V",0);
			$fr .= pack("V",0);
			$fr .= pack("v", string_strlen($name) );
			$fr .= pack("v", 0);
			$fr .= $name;
			$fr .= pack("V", 0);
			$fr .= pack("V", 0);
			$fr .= pack("V", 0);

			$this->datasec[] = $fr;

			/* Creating a record in the central Index
			* Calculate the new offset that will be used the next time a segment is added
			* Construct the general header for the central index record
			* Construct the Specific header information for the record, including the offset pointing to the start of the just-created header (stored in $old_offset)
			* Save the central index record in the array $ctrl_dir
			* Set the start of the next data segment offset to the end of the current offset by changing $old_offset to equal $new_offset
			*/
			/*improvement issue to future: decides wich line use*/
			//$new_offset = string_strlen(implode("", $this->datasec));
			$new_offset = $this->old_offset + string_strlen($fr);

			$cdrec = "\x50\x4b\x01\x02";
			$cdrec .="\x00\x00";
			$cdrec .="\x0a\x00";
			$cdrec .="\x00\x00";
			$cdrec .="\x00\x00";
			$cdrec .="\x00\x00\x00\x00";
			$cdrec .= pack("V",0);
			$cdrec .= pack("V",0);
			$cdrec .= pack("V",0);
			$cdrec .= pack("v", string_strlen($name) );
			$cdrec .= pack("v", 0 );
			$cdrec .= pack("v", 0 );
			$cdrec .= pack("v", 0 );
			$cdrec .= pack("v", 0 );
			$ext = "\x00\x00\x10\x00";
			$ext = "\xff\xff\xff\xff";
			$cdrec .= pack("V", 16 );
			$cdrec .= pack("V", $this -> old_offset );
			$cdrec .= $name;

			$this -> ctrl_dir[] = $cdrec;
			$this -> old_offset = $new_offset;
			return;

		}

		function addFile($data, $name) {

			$name = str_replace("\\", "/", $name);
			$unc_len = string_strlen($data);
			$crc = crc32($data);
			$zdata = gzcompress($data);
			$zdate = string_substr ($zdata, 2, -4);
			$c_len = string_strlen($zdata);
			/**/
			$fr = "\x50\x4b\x03\x04";
			$fr .= "\x14\x00";
			$fr .= "\x00\x00";
			$fr .= "\x08\x00";
			$fr .= "\x00\x00\x00\x00";
			$fr .= pack("V",$crc);
			$fr .= pack("V",$c_len);
			$fr .= pack("V",$unc_len);
			$fr .= pack("v", string_strlen($name) );
			$fr .= pack("v", 0 );
			$fr .= $name;
			$fr .= $zdata;
			$fr .= pack("V",$crc);
			$fr .= pack("V",$c_len);
			$fr .= pack("V",$unc_len);

			$this->datasec[] = $fr;
			/**/
			$new_offset = string_strlen(implode("", $this->datasec));

			$cdrec = "\x50\x4b\x01\x02";
			$cdrec .="\x00\x00";
			$cdrec .="\x14\x00";
			$cdrec .="\x00\x00";
			$cdrec .="\x08\x00";
			$cdrec .="\x00\x00\x00\x00";
			$cdrec .= pack("V",$crc);
			$cdrec .= pack("V",$c_len);
			$cdrec .= pack("V",$unc_len);
			$cdrec .= pack("v", string_strlen($name) );
			$cdrec .= pack("v", 0 );
			$cdrec .= pack("v", 0 );
			$cdrec .= pack("v", 0 );
			$cdrec .= pack("v", 0 );
			$cdrec .= pack("V", 32 );
			$cdrec .= pack("V", $this -> old_offset );

			$this -> old_offset = $new_offset;

			$cdrec .= $name;
			$this->ctrl_dir[] = $cdrec;

		}

		function closeFile() {
			$data = implode("", $this->datasec);
			$ctrldir = implode("", $this->ctrl_dir);
			return $data . $ctrldir . $this->eof_ctrl_dir . pack("v", sizeof($this -> ctrl_dir)) . pack("v", sizeof($this -> ctrl_dir)) . pack("V", string_strlen($ctrldir)) . pack("V", string_strlen($data)) . "\x00\x00";
		}

		function sendDirectly(){
			header("Content-type: application/octet-stream");
			header("Content-disposition: attachment; filename=zipfile.zip");
			return $this->closeFile();
		}

	}

?>
