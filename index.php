<html lang="en">
	<head>
		<?php 
		
		session_start();
		if($_SESSION['valid']){
			
		}else{
			header( "location: ./auth/login.php" ); 
		}

		?>
    <meta charset="UTF-8">
	<meta name = "viewport" content = "width=device-width, minimum-scale=1.0, maximum-scale = 1.0, user-scalable = no">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="./assets/css/card.css">
    <link rel="stylesheet" href="./assets/css/music-player.css">

	<script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" data-auto-replace-svg="nest"></script>
	<script type="text/javascript" src="./assets/js/music-player.js"></script>
	<script type="text/javascript" src="./assets/js/helper.js"></script>
	<script type="text/javascript" src="./assets/js/navigator.js"></script>

	<script type="text/javascript">
		function loadSongs(){
			getEditorSongs(document.querySelector("#editor_container"));
			getLatestSongs(document.querySelector("#releases_container"));

			getLatestPunjabiSongs(document.querySelector("#latest_punjabi_song_container"));
			getLatestHindiSongs(document.querySelector("#latest_hindi_song_container"));
			getRecommendedPunjabiSongs(document.querySelector("#recommended_punjabi_song_container"));
			getRecommendedHindiSongs(document.querySelector("#recommended_hindi_song_container"));
		}
		function load(){
			initMusicPlayer()
			loadSongs()
		}
	</script>
</head>
<body onload="load()">
	
    <nav class="nav">
        <a id="nav_dashboard" onclick="Navigator.gotoDashboard()" class="nav__link selected" >Dashboard</a>
        <a id="nav_search" onclick="Navigator.gotoSearch()" class="nav__link" >Search</a>
        <a id="nav_punjabi_songs" onclick="Navigator.gotoPunjabiSongs()" class="nav__link" >Latest Punjabi Songs</a>
        <a id="nav_hindi_songs" onclick="Navigator.gotoHindiSongs()" class="nav__link" >Latest Hindi Songs</a>
        <a id="nav_recommended_punjabi_songs" onclick="Navigator.gotoRecommendedPunjabiSongs()" class="nav__link" >Recommended Punjabi Songs</a>
        <a id="nav_recommended_hindi_songs" onclick="Navigator.gotoRecommendedHindiSongs()" class="nav__link" >Recommended Hindi Songs</a>
        <a style="display:none" id="nav_punjabi_albums" onclick="Navigator.gotoPunjabiAlbums()" class="nav__link" data-link="">Punjabi Album</a>
    </nav>
	<div>
		<div style="display:block; position:absolute" id="progressBar" style="align-self: center;">
			<center >
				
			</center>
		</div>
		<div id="app">
			<div id="app_dashboard" style="display:block;">
				<h2>New Releases</h2>
				<div id="releases_container" class="container"></div>
			</div>
			<div id="app_search" style="display:none;">
				<h2>Search Songs</h2>
				<div class="searchbox_container">
					<input type="text" placeholder="Search.." name="search" id="search_bar"
					><button type="submit" id="search_button" onclick="searchSongs()">
						<i class="fa fa-search" aria-hidden="true"></i>
					</button>
				</div>
				<div id="search_song_container" class="container"></div>
				</div>
			<div id="app_punjabi_songs" style="display:none;">
				<h2>Latest Punjabi Songs</h2>
				<div id="latest_punjabi_song_container" class="container"></div>
			</div>
			<div id="app_hindi_songs" style="display:none;">
				<h2>Latest Hindi Songs</h2>
				<div id="latest_hindi_song_container" class="container"></div>
			</div>
			<div id="app_recommended_punjabi_songs" style="display:none;">
				<h2>Recommended Punjabi Songs</h2>
				<div id="recommended_punjabi_song_container" class="container"></div>
			</div>
			<div id="app_recommended_hindi_songs" style="display:none;">
				<h2>Recommended Hindi Songs</h2>
				<div id="recommended_hindi_song_container" class="container"></div>
			</div>
			<div id="app_punjabi_albums" style="display:none;">
				<h2>Punjabi Albums</h2>
				<div id="punjabi_albums_container" class="container list"></div>
			</div>
			
		</div> 
		<div id="music_player">
			<?php echo(file_get_contents('./assets/views/bottom-music-player.php'))?>
		</div>
	</div>
</body>
</html>