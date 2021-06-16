<?php

	include_once('getPageSongs.php');

    $url = $_GET["url"];
    echo getPageSongs($url);
  //$html = file_get_html();
  //echo($html);

  //echo(urlencode("https://djyoungster.org/music/search_song.php?word=Karan%20Aujla"));
?>