<?php

	function getTitle($linkSource) {
		// The page should only have one title, so lets go ahead and get it!
		return addslashes($linkSource->getElementsByTagname('title')->item(0)->nodeValue);
	}
	
	function getDescription($linkSource) {
		// Description is in the meta tags, so lets iterate through them, until we find it
		$metas = $linkSource->getElementsByTagname('meta'); 
		foreach ($metas as $meta) {
			if ($meta->getAttribute("name") == "description") {
				return addslashes($meta->getAttribute("content"));
			} 
		}
	}
	
	function getImage($linkSource, $linkurl) {
		// Some sites hard code image urls for Twitter and Facebook, lets just use those.
		$metas = $linkSource->getElementsByTagname('meta'); 
		foreach ($metas as $meta) {
			if($meta->getAttribute("name") == "twitter:image") {
				return addslashes($meta->getAttribute("content"));
			} else if($meta->getAttribute("property") == "og:image") {
				return addslashes($meta->getAttribute("content"));
			} else {
				// Do Nothing
			}
		}
		// If this site doesn't do that, lets just grab the first image, because I don't know what else to do
		$firstImage = "";
		$imgs       = $linkSource->getElementsByTagname('img');
		foreach ($imgs as $img) {
			$firstImage = $img->getAttribute("src");
			if (strpos("http://", $firstImage) === false) {
				$firstImage = $linkurl . $firstImage; 
			}
			break;
		}
		return addslashes($firstImage);
	}
	
	function loadSource($url) {
		$html = file_get_contents($_GET['link']);
		$dom = new DOMDocument();
		$dom->loadHTML($html);
		$dom->preserveWhiteSpace = false; 
		return $dom;
	}
	
	error_reporting(0);
	
	$urlSource = loadSource(file_get_contents($_GET['link']));
	
	/* if you want to support jsonp output, uncomment this block, and remove this line, obviously
	if($_GET['callback'] != "") {
		echo $_GET['callback'] + "({\"title\" : \"".getTitle($urlSource)."\", \"description\" : \"".getDescription($urlSource)."\", \"image\" : \"".getImage($urlSource)."\"});";
	}
	*/	

    echo "{\"title\" : \"".getTitle($urlSource)."\", \"description\" : \"".getDescription($urlSource)."\", \"image\" : \"".getImage($urlSource, $_GET['link'])."\"}";
?>