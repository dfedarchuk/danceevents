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
	# * FILE: /classes/class_rssWriter.php
	# ----------------------------------------------------------------------------------------------------

	class FeedImage {

		var $xml;			// resulting XML

		// required 
		var $link;			// hyperlink
		var $title;			// title attribute for image
		var $url;			// image src

		// optional
		var $description;	// title of the html element arround image
		var $height;		// height of the image
		var $width;			// width of the image

		// constructor
		function FeedImage($properties) {

			$this->link			= ($properties["link"])			? $properties["link"]			: null;
			$this->url 			= ($properties["url"])			? $properties["url"] 			: null;
			$this->description	= ($properties["description"])	? $properties["description"]	: null;
			$this->height 		= ($properties["height"])		? $properties["height"]			: null;
			$this->width 		= ($properties["width"])		? $properties["width"]			: null;
			$this->title		= ($properties["title"])		? $properties["title"]			: null;

			if ($this->link && $this->title && $this-> url) {

				$this->xml = "";

										$this->xml	.= "	<image>\n";
				if ($this->url)			$this->xml	.= "		<url>".$this->url."</url>\n";
				if ($this->title)		$this->xml	.= "		<title>".$this->title."</title>\n";
				if ($this->link)		$this->xml	.= "		<link>".$this->link."</link>\n";
				if ($this->description)	$this->xml 	.= "		<description>".$this->description."</description>\n";
				if ($this->height)		$this->xml	.= "		<height>".$this->height."</height>\n";
				if ($this->width)		$this->xml	.= "		<width>".$this->height."</width>\n";
										$this->xml	.= "	</image>\n";

			}

		}

		function getXML(){
			return $this->xml;
		}

	}

	class FeedItem {

		var $xml;			// resulting XML

		// required
		var $title;			// item title
		var $link;			// hyperlink
		var $description;	// description

		// optional
		var $guid;			// defines a unique identifier (url)
		var $pubDate;		// publication date

		// constructor
		function FeedItem($properties) {

			$this->title		= ($properties["title"])		? $properties["title"]			: null;
			$this->link			= ($properties["link"])			? $properties["link"]			: null;
			$this->description	= ($properties["description"])	? $properties["description"]	: null;

			$this->guid			= ($properties["guid"])			? $properties["guid"]			: null;

			$this->pubDate		= ($properties["pubDate"])		? $properties["pubDate"]		: null;
			$this->phone		= ($properties["phone"])		? $properties["phone"]			: null;
			$this->url			= ($properties["url"])			? $properties["url"]			: null;
			$this->email		= ($properties["email"])		? $properties["email"]			: null;
			$this->address		= ($properties["address"])		? $properties["address"]		: null;

			$this->img_src		= ($properties["img_src"])		? $properties["img_src"]		: null;
			$this->img_width	= ($properties["img_width"])	? $properties["img_width"]		: null;
			$this->img_height	= ($properties["img_height"])	? $properties["img_height"]		: null;

			if ($this->title && $this->link && $this->description) {

				$this->xml = "";

										$this->xml	.= "	<item>\n";
				if ($this->title)		$this->xml	.= "		<title>".$this->title."</title>\n";
				if ($this->link)		$this->xml	.= "		<link>".$this->link."</link>\n";
				if ($this->description)	$this->xml	.= "		<description>".$this->description."</description>\n";
				if ($this->guid)		$this->xml	.= "		<guid>".$this->guid."</guid>\n";
				if ($this->pubDate)		$this->xml	.= "		<pubDate>".$this->pubDate."</pubDate>\n";
				if ($this->phone)		$this->xml	.= "		<phone>".$this->phone."</phone>\n";
				if ($this->url)			$this->xml	.= "		<url>".$this->url."</url>\n";
				if ($this->email)		$this->xml	.= "		<email>".$this->email."</email>\n";
				if ($this->address)		$this->xml	.= "		<address>".$this->address."</address>\n";
				if ($this->img_src)		$this->xml	.= "		<img_src>".$this->img_src."</img_src>\n";
				if ($this->img_width)	$this->xml	.= "		<img_width>".$this->img_width."</img_width>\n";
				if ($this->img_height)	$this->xml	.= "		<img_height>".$this->img_height."</img_height>\n";
										$this->xml	.= "	</item>\n";

			}

		}

		function getXml(){
			return $this->xml;
		}

	}

	class FeedChannel {

		var $xml;			// resulting XML

		// required
		var $title;			// title
		var $link;			// hyperlink
		var $description;	// description

		// optional
		var $pubDate;		// publication date
		var $itens;			// array of objects FeedItem
		var $image;			// FeedImage object

		// constructor
		function FeedChannel($properties) {

			$this->title		= ($properties["title"])		? $properties["title"]			: null;
			$this->link			= ($properties["link"])			? $properties["link"]			: null;
			$this->description	= ($properties["description"])	? $properties["description"]	: null;
			$this->pubDate		= ($properties["pubDate"])		? $properties["pubDate"]		: null;
			$this->image		= ($properties["image"])		? $properties["image"]			: null;
			$this->itens		= ($properties["itens"])		? $properties["itens"]			: null;

			$this->xml = "";

										$this->xml	.= "	<channel>\n";
			if ($this->title)			$this->xml	.= "		<title>".$this->title."</title>\n";
			if ($this->link)			$this->xml	.= "		<link>".$this->link."</link>\n";
			if ($this->description)		$this->xml	.= "		<description>".$this->description."</description>\n";
			if ($this->pubDate)			$this->xml	.= "		<pubDate>".$this->pubDate."</pubDate>\n";
			if ($this->image)			$this->xml	.=			$this->image->getXML();
			if (is_array($this->itens)) {
				foreach ($this->itens as $each_item) {
										$this->xml	.=			$each_item->getXML();
				}
			}
										$this->xml	.= "	</channel>\n";

		}

		function getXML(){
			return $this->xml;
		}

	}

	class RSSWriter {

		// Private variables
		var $encoding;
		var $default_url;
		var $channelFeed;
		var $rss_content;
		var $item_properties;
		var $image_properties;
		var $channel_properties;

		function RSSWriter($encoding = "uft-8", $default_url = DEFAULT_URL) {
			$this->encoding = $encoding;
			$this->default_url = $default_url;
		}

		function addChannel($properties) {

			$this->channel_properties["title"]		= ($properties["title"])		? $properties["title"]		: " ";
			$this->channel_properties["link"]		= ($properties["link"])			? $properties["link"]		: " ";
			$this->channel_properties["description"]= ($properties["description"])	? $properties["description"]: " ";

			$this->channel_properties["pubDate"]	= ($properties["pubDate"])		? $properties["pubDate"]	: null;

		}

		function addItem($properties) {

			$this->item_properties["title"]			= ($properties["title"])		? $properties["title"]		: " ";
			$this->item_properties["link"]			= ($properties["link"])			? $properties["link"]		: " ";
			$this->item_properties["description"]	= ($properties["description"])	? $properties["description"]: " ";

			$this->item_properties["guid"]			= ($properties["guid"])			? $properties["guid"]		: null;
			$this->item_properties["pubDate"]		= ($properties["pubDate"])		? $properties["pubDate"]	: null;
			$this->item_properties["phone"]			= ($properties["phone"])		? $properties["phone"]		: null;
			$this->item_properties["url"]			= ($properties["url"])			? $properties["url"]		: null;
			$this->item_properties["email"]			= ($properties["email"])		? $properties["email"]		: null;
			$this->item_properties["address"]		= ($properties["address"])		? $properties["address"]	: null;
			$this->item_properties["img_src"]		= ($properties["img_src"])		? $properties["img_src"]	: null;
			$this->item_properties["img_width"]		= ($properties["img_width"])	? $properties["img_width"]	: null;
			$this->item_properties["img_height"]	= ($properties["img_height"])	? $properties["img_height"]	: null;

		}

		function addChannelImage($properties) {

			$this->image_properties["link"]			= ($properties["link"])			? $properties["link"]			: " ";
			$this->image_properties["url"] 			= ($properties["url"])			? $properties["url"] 			: " ";
			$this->image_properties["description"]	= ($properties["description"])	? $properties["description"]	: " ";

			$this->image_properties["height"] 		= ($properties["height"])		? $properties["height"]			: null;
			$this->image_properties["width"] 		= ($properties["width"])		? $properties["width"]			: null;
			$this->image_properties["title"]		= ($properties["title"])		? $properties["title"]			: null;

		}

		function buildItem() {
			$itemFeed  = new FeedItem($this->item_properties);
			$this->channel_properties["itens"][] = $itemFeed;
			unset($this->item_properties);
		}

		function buildChannel() {

			if ($this->image_properties) {
				$imageFeed = new FeedImage($this->image_properties);
				$this->channel_properties["image"] = $imageFeed;
				unset($this->image_properties);
			}

			$this->channelFeed  = new FeedChannel($this->channel_properties);
			unset($this->channel_properties);

		}

		function sendHeader() {
			header("Content-Type: text/xml");
		}

		function getRSS(){

			if (!$this->rss_content) {
				$this->rss_content = "";
				/*$this->rss_content .= "<?xml version=\"1.0\" encoding=\"".$this->encoding."\"?>\n";*/
				$this->rss_content .= "<?xml-stylesheet type=\"text/xsl\" href=\"".$this->default_url."/layout/rss.xsl\"?>\n";
				$this->rss_content .= "<rss version=\"2.0\">\n";
				$this->rss_content .= $this->channelFeed->getXML()."\n";
				$this->rss_content .= "</rss>\n";
			}

			return $this->rss_content;

		}

		function outputRSS(){
			$this->sendHeader();
			echo $this->getRSS();
		}

	}

?>