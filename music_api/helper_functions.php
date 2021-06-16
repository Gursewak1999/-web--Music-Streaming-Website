
<?php

	function contains($str, $sub){
		if (strpos($str, $sub) !== false) {
			return true;
		}else return false;
	}
	
	function convertDownloadUrl($str, $format){
		//https://djyoungster.org/music/download.php?mp3=Single-Tracks/November(2020)/Hon Nhi Dena ft Mankirt Aulakh Bobby Sandhu.mp3&format=48
		//https://djyoungster.org/music/48/Single-Tracks/November(2020)/Hon%20Nhi%20Dena%20ft%20Mankirt%20Aulakh%20Bobby%20Sandhu.mp3
		//$format = explode($str,'&format=')[1];
		$info = explode('&format=',$str)[0];
		$info = explode("?mp3=",$info)[1];
		$url = 'https://djyoungster.org/music/'.$format.'/'.$info.'';
		return $url;
	}
?>