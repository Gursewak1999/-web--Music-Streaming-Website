<?php

	include_once('helper_functions.php');
	include_once('simple_html_dom.php');
	
	$page_url="https://djyoungster.org/";
	
	$html=file_get_html($page_url);
	
	$editors_choice = [];
	
	function extractSong($div){
		
		$cover="";
		$url="";
		$name="";
		$artist="";
		
		$a=$div->find("a",0);
		
		foreach($a->find("picture",0)->find("source") as $source){
			if($source->type=="image/jpeg")
				$cover=$source->srcset."<br>";
		}
		
		$name=$a->find("div",0)->find("h2",0)->find('text',0);
	
		$url=$a->href;
		$temp=explode(" - ",$name);
		$name=$temp[0];
		$artist=$temp[1];
		
		$json='{"name":"'.$name.'", "artist":"'.$artist.'", "cover":"'.$cover.'", "url":"'.$url.'"}';
		
		return $json;
	}
	
	if($html!=null){
		
		foreach($html->find("div") as $div){
			
			if($div->class=="page_padding ma_discover_page"){
				
				foreach($div->find("div") as $div2){
					if($div2->class=="owl-carousel home_top_slider owl-theme")
						
						foreach($div2->find("div[class=item]") as $div3){
							//echo("<br>".$div3);
							$js = extractSong($div3);
							//echo($js."<br>");
							array_push($editors_choice, $js);
						}
				
					if($div2->class=="sq_music_tracks mb-60"){
						
						foreach($div2->find("div[class=owl-stage]") as $div3){
							//echo("<br>".$div2);
						}
					}
				}	
			}
		}
		
		foreach($html->find("a") as $a){
			if($a->find("picture",0))
				echo("<br>".$a);
		}
	}
	
	
?>