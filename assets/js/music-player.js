var track_list = [
  {
    name: "",
    artist: "",
    image: "",
    path: ""
  }
];
//var now_playing = document.querySelector(".now-playing");
var track_art = document.querySelector(".avatar");
var track_name = document.querySelector(".title_song");
var track_artist = document.querySelector(".artist_song");

var playpause_btn = document.querySelector("#play");
var next_btn = document.querySelector("#forward");
var prev_btn = document.querySelector("#back");

var seek_slider = document.querySelector('div#soundline_color')
//var volume_slider = document.querySelector(".volume_slider");

var total_duration = document.querySelector(".totalduration");
var current_time = document.querySelector(".currenttime");
var track_index = 0;
var isPlaying = false;
var updateTimer;
var curr_track = document.createElement('audio');

function setSongLoading(){
  playpause_btn.innerHTML = '<i class="fas fa-circle-notch fa-spin" aria-hidden="true"></i>';
}

function initIds(){
     track_art = document.querySelector(".avatar");
     track_name = document.querySelector(".title_song");
     track_artist = document.querySelector(".artist_song");

     playpause_btn = document.querySelector("#play");
     next_btn = document.querySelector("#forward");
     prev_btn = document.querySelector("#back");

     seek_slider = document.querySelector('div#soundline_color')
    //var volume_slider = document.querySelector(".volume_slider");

     total_duration = document.querySelector(".totalduration");
      current_time = document.querySelector(".currenttime");
}

function loadTrack2(track_index) {
  clearInterval(updateTimer);
  resetValues();
  curr_track.src = track_list[track_index].path;
  curr_track.load();

  if(track_art == null) initIds();
  track_art.style.backgroundImage = "url(" + track_list[track_index].image + ")";
  if(track_name == null) initIds();
  track_name.textContent = track_list[track_index].name;
  if(track_artist == null) initIds();
  track_artist.textContent = track_list[track_index].artist;
 // now_playing.textContent = "PLAYING " + (track_index + 1) + " OF " + track_list.length;
  updateTimer = setInterval(seekUpdate, 1000);
  curr_track.addEventListener("ended", nextTrack);
}
    
function loadTrack(track,toPlay = true) {
  clearInterval(updateTimer);
  resetValues();

  setSongLoading();
  getSongDetails(track.name, track.cover, track.url,  (song_details)=>{
      //song_details.download_links[0].d48,song_details.cover,song_details.name,song_details.artist
      curr_track.src = song_details.download_links[0].d48;
      curr_track.load();
    
      track_art.innerHTML='<img src="'+track.cover+'" //>';
      
      document.querySelector(".back").style.backgroundImage = "url(" + track.cover + ")";
      track_name.textContent = track.name;
      track_artist.textContent = track.artist;
     // now_playing.textContent = "PLAYING " + (track_index + 1) + " OF " + track_list.length;
    
      updateTimer = setInterval(seekUpdate, 1000);
      curr_track.addEventListener("ended", nextTrack);
      curr_track.addEventListener("play",onPlay)
      curr_track.addEventListener("canplay",onPlay)
      curr_track.addEventListener("canplaythrough",onPlay);      curr_track.addEventListener("pause",onPause);

     // if(toPlay
        playTrack();
  })
}
function resetValues() {
    if(current_time == null) initIds();
    current_time.textContent = "00:00";
    if(total_duration == null) initIds();
    total_duration.textContent = "00:00";
    if(seek_slider == null) initIds();
    seek_slider.style.width = 0;
}

function playpauseTrack() {
  if(!isPlaying) 
    playTrack();
  else
    pauseTrack();
}

function playTrack() {
  curr_track.play();
  
  //playpause_btn.innerHTML = '<i class="fa fa-pause" aria-hidden="true"></i>';
}
function onPause(){  
  isPlaying = false;
  playpause_btn.innerHTML = '<i class="fa fa-play" aria-hidden="true"></i>'
}
function onPlay(){
  isPlaying = true
  playpause_btn.innerHTML = '<i class="fa fa-pause" aria-hidden="true"></i>'
}

function pauseTrack() {
  curr_track.pause();
  
 // playpause_btn.innerHTML = '<i class="fa fa-play" aria-hidden="true"></i>';;
}

function nextTrack() {
  if (track_index < track_list.length - 1)
    track_index += 1;
  else track_index = 0;
  loadTrack(track_index);
  playTrack();
}


function prevTrack() {
  if (track_index > 0)
    track_index -= 1;
  else track_index = track_list.length;
  loadTrack(track_index);
  playTrack();
}

function seekTo() {
  var seekto = curr_track.duration * (seek_slider.style.width / 100);
  curr_track.currentTime = seekto+"%";
}

function setVolume() {
 // curr_track.volume = volume_slider.value / 100;
}

function seekUpdate() {
  var seekPosition = 0;

  if (!isNaN(curr_track.duration)) {
    seekPosition = curr_track.currentTime * (100 / curr_track.duration);

    seek_slider.style.width = seekPosition+"%";

    var currentMinutes = Math.floor(curr_track.currentTime / 60);
    var currentSeconds = Math.floor(curr_track.currentTime - currentMinutes * 60);
    var durationMinutes = Math.floor(curr_track.duration / 60);
    var durationSeconds = Math.floor(curr_track.duration - durationMinutes * 60);

    if (currentSeconds < 10) { currentSeconds = "0" + currentSeconds; }
    if (durationSeconds < 10) { durationSeconds = "0" + durationSeconds; }
    if (currentMinutes < 10) { currentMinutes = "0" + currentMinutes; }
    if (durationMinutes < 10) { durationMinutes = "0" + durationMinutes; }

    current_time.textContent = currentMinutes + ":" + currentSeconds;
    total_duration.textContent = durationMinutes + ":" + durationSeconds;
  }
}

function initMusicPlayer(){
  initIds();

  track_index = 0;
  isPlaying = false;
  updateTimer;

  // Create new audio element
  curr_track = document.createElement('audio');

  curr_track.onloadstart = function(){
    setSongLoading();
  };

  loadTrack({
    name: 'Burberry',
    artist: 'Sidhu Moosewala',
    cover: 'https://art.djyoungster.in/img/250x250/72096.jpg',
    url: 'https://djyoungster.org/music/burberry-sidhu-moosewala-v72096.html'})

}

