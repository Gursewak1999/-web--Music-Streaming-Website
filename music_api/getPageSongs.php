<?php

include_once('helper_functions.php');
include_once('simple_html_dom.php');

function getPageSongs($url){
	$html="";
	$html = file_get_html($url);

$ar = array();
if ($html != null) {
	foreach ($html->find("div") as $div) {
		
		$url = ""; 
		$name = ""; 
		$cover = "";
		$artist = "";

		if (isset($div->attr['class']) && $div->attr['class'] == "track") {
			foreach ($div->find("div") as $div1) {

				if ($div1->class == "cover_art") {
					foreach ($div1->find("source") as $source) {
						if (isset($source->type) && $source->type=="image/jpeg") {
							$cover = $source->srcset;
							//songData.setCoverUrl(cover != null ? cover : "");
						}
					}
				}
				if ($div1->class=="track_info") {
					$a = $div1->find("a",0);
					$url = $a->href;
					$name = $a->plaintext;
					$artist=$div1->find("span",1)->plaintext;
				}
			}
		}
		if (contains($cover,"https://art.djyoungster.in/img/")) {
			array_push($ar,'{"name":"'.trim($name).'",
			"cover":"'.trim($cover).'",
			"artist":"'.trim($artist).'",
			"url":"'.trim($url).'"}');
		}
	}
} 

$isFirst = 0;
$final = '{"error":true,"ar":[';
foreach($ar as $str){
	if($isFirst==0)
		$isFirst=1;
	else $final = $final.",";
	
	$final = $final.$str;
}

return($final.']}');

}
?>