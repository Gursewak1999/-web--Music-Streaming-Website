<?php

include_once('helper_functions.php');
include_once('simple_html_dom.php');

$url="";
if(isset($_GET['url']))
	$url = $_GET['url'];
else return;

$html = file_get_html($url);

if($html ==null)
	return;

foreach($html->find("ul[class=s_list_songs]",0)->find("li[class=song_search_list]") as $li){
	foreach($li->find("ul[class=s_lsongs_child]",0)->find("li") as $li1){
		
		if($li1->class="first"){
		}else if($li1->class="first"){
		}else if($li1->class="second"){
		}else if($li1->class="first"){
		}
	}
}

?>