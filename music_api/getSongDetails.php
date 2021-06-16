<?php

include_once('helper_functions.php');
include_once('simple_html_dom.php');

$name = $_GET['name'];
$cover = $_GET['cover'];
$page = $_GET['page'];	
$links="";
$pairs_str="";
$pairs=array();

	$html = file_get_html($page);

        if ($html != null) {
            $p = "";
			$span = "";
            
            foreach ($html->find("div") as $div) {
                if ($div->class=="ss_track_info_innr") {
					$isFirst = 0;
                    foreach ($div->children() as $el) {

                        if($el->tag=="span" || $el->tag=="p"){
							
							if ($el->tag=="p")
								$p = $el->plaintext;
							
							if($isFirst==0)
								$isFirst=1;
							else
								array_push($pairs,'{"'.$span.'" : "'.$p.'"}');		
                        
							if ($el->tag=="span")
                            $span = $el->plaintext;
							
							//echo($el->tag.' : '.$el->plaintext.'<br>');
						}
						
					//echo('p = '.$p.' & span = '.$span.'<br>');
                    }
					
					
					$ar = array();
					foreach($pairs as $str){
						if(!in_array($str, $ar))
							array_push($ar, $str);
					}
					$isF = 0;
					$pairs_str = '[';
					foreach($ar as $str){
						
						if($str!='{"" : ""}'){
							if(!contains($str,'&#8471;')){
								if($isF==0)
									$isF=1;
								else $pairs_str = $pairs_str.',';
								
								$pairs_str = $pairs_str.$str;
							}
						}
					}
					$pairs_str = $pairs_str.']';
                }
                if ($div->class=="col-md-12 text-center") {
					
                    foreach ($div->find("a") as $a) {

                        $txt = $a->plaintext;
                        if (contains($txt,"48")) {
							$links = $links.'{"d48":"'.convertDownloadUrl($a->href,"48").'"},';
                        } else if (contains($txt,"128")) {
                            $links = $links.'{"d128":"'.convertDownloadUrl($a->href,"128").'"},';
                        } else if (contains($txt,"192")) {
                            $links = $links.'{"d192":"'.convertDownloadUrl($a->href,"192").'"},';
                        } else if (contains($txt,"320")) {
                            $links = $links.'{"d320":"'.convertDownloadUrl($a->href,"320").'"}';
                        }
					
                    }
                }
            }
			
			
			$final = '{"name":"'.$name.'",
				"cover":"'.$cover.'",
				"details":'.$pairs_str.',
				"download_links":['.$links.']}';
				
                echo($final);
		} else {
            new Toast("Unable to get Song Details.").showToast();
        }


?>