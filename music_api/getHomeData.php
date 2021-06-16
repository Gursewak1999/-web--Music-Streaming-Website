<?php



if (isset($_SERVER["HTTP_ORIGIN"]) === true) {

    header('Access-Control-Allow-Origin: *');

	header('Access-Control-Allow-Credentials: true');

	header('Access-Control-Allow-Methods: GET,POST');

	header('Access-Control-Allow-Headers: Content-Type');

	

	if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {

		exit; // OPTIONS request wants only the policy, we can stop here

	}

}



	include_once('helper_functions.php');

	include_once('simple_html_dom.php');

	

	$page_url="https://djyoungster.org/";

	

	$html=file_get_html($page_url);

	

	$editors_choice = [];

	$new_release=[];

	$punjabi_albums=[];

	$hindi_albums=[];

	$hindi_single_tracks=[];

	

	function extractNewReleaseSong($a){

		

		$cover="";

		$url="";

		$name="";

		$artist="";

		

		foreach($a->find("picture",0)->find("source") as $source){

			if($source->type=="image/jpeg")

				$cover=$source->srcset;

		}

		

		$name=$a->find("picture",0)->find("img",0)->alt;

		

		$url=$a->href;

		$temp=explode(" song download by ",$name);

		$name=$temp[0];

		if(isset($temp[1]))
			$artist=$temp[1];
		

		$name=trim($name);

		$url=trim($url);

		$name=trim($name);

		$artist=trim($artist);

		

		$json='{"name":"'.$name.'", "artist":"'.$artist.'", "cover":"'.$cover.'", "url":"'.$url.'"}';

		

		return $json;

	}

	

	$i=1;

	function checkForCategory($a){

		global $i, $editors_choice, $new_release, $punjabi_albums, $hindi_albums, $hindi_single_tracks;

		$href = $a->href;
		
		if (strpos($href, 'playlist') !== false) {
			return;
}

		$href = substr($href, strlen("https://djyoungster.org/music/"));
		$_s = substr($href,0,1);
		
		//echo($_s."<br>");
		if($_s=='-')
			return;

		if($a->find("div[class=bg_text]",0)){

			array_push($editors_choice,extractNewReleaseSong($a));

			//echo("editors_choice<br>");

		}else if($a->find("div[class=play_btn]",0)){

			array_push($new_release,extractNewReleaseSong($a));//echo("new_release<br>");

		}else if($a->find("div[class=art_song]",0)){

			if($i>=1 && $i<=10){

				array_push($punjabi_albums,extractNewReleaseSong($a));

				//echo("punjabi_albums<br>");

			}else if($i<=20){

				array_push($hindi_albums,extractNewReleaseSong($a));

				//echo("hindi_albums<br>");

			}else if($i<=30){

				array_push($hindi_single_tracks,extractNewReleaseSong($a));

				//echo("hindi_single_tracks<br>");

			}	$i=$i+1;

		}

	}

	if($html!=null){

		

		foreach($html->find("a") as $a){

			if($a->find("picture",0))

				checkForCategory($a);

		}

	}

	

	$edi="[";

	foreach($editors_choice as $json){

		$edi=$edi.$json.",";

	}

	$edi=rtrim($edi,", ")."]";

	

	$ne = "[";

	foreach($new_release as $json){

		$ne=$ne.$json.",";

	}

	$ne=rtrim($ne,", ")."]";

	

	$pun_alb = "[";

	foreach($punjabi_albums as $json){

		$pun_alb=$pun_alb.$json.",";

	}

	$pun_alb=rtrim($pun_alb,", ")."]";

	

	$hin_al = "[";

	foreach($hindi_albums as $json){

		$hin_al=$hin_al.$json.",";

	}

	$hin_al=rtrim($hin_al,", ")."]";

	

	$hin_sin = "[";

	foreach($hindi_single_tracks as $json){

		$hin_sin=$hin_sin.$json.",";

	}

	$hin_sin=rtrim($hin_sin,", ")."]";

	

	

	$final_json='{"editors_choice":'.$edi.', "new_release":'.$ne.', "punjabi_albums":'.$pun_alb.', "hindi_albums":'.$hin_al.', "hindi_single_tracks":'.$hin_sin.'}';

	

	echo($final_json);

	

	

?>