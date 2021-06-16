<?php



	include_once('helper_functions.php');

	include_once('simple_html_dom.php');

	include_once('getPageSongs.php');

	

	$s="";

	$c="";

		

	if(isset($_GET["language"])){

		//punjabi or hindi

        $s=$_GET["language"];

	}

	if(isset($_GET["category"])){

		//category

        $c=$_GET["category"];

	}

	if($s=="" || $c==""){

		echo('{"error":"true","msg":"missing Attributes s, c"}');

		return;

	}

	

	if($c=="top50"){

		if($s=="punjabi")

			$url="https://djyoungster.org/top-punjabi-songs-mp3.html";

		else if($s=="hindi")

			$url="https://djyoungster.org/top-hindi-mp3-songs.html";

	}else if($c=="recommended"){

		$i=1;

		if(isset($_GET['i']) && $_GET['i']!=""){

			$i=$_GET['i'];

		}

		if($s=="punjabi")

			$url="https://djyoungster.org/recommended".$i.".html";

		else if($s=="hindi")

			$url="https://djyoungster.org/hrecommended".$i.".html";

	}

	//echo($url."<br>$c<br>$s<br>");
	echo getPageSongs($url);

	

?>