var BASE_URL = "./music_api";

progressBar = document.createElement("div");
progressBar.className="progressBar";
progressBar.innerHTML= `<center class="centerProgressBar">
                            <i class="fas fa-3x fa-circle-notch fa-spin"></i>
                        </center>`;
progressIndex=0;

function getRequest(url,func){

    showProgressBar();
    const response  = new XMLHttpRequest();
    response.onreadystatechange = function () {
        if(response.readyState == 4){
            if(response.status == 200){
                const json = JSON.parse(response.responseText);
                func(json)
                hideProgressBar();
                //json.forEach((el)=>{});
            }
            if(response.status == 404){
                console.log("404 not found");
            }
        }
    }
    response.open('GET',url,true)
    response.send()
}

function getSongDetails(name,cover,page, func){
    var url=BASE_URL+'/getSongDetails.php?name='+name+'&cover='+cover+'&page='+page;
    getRequest(url,(song_details)=>{
        //console.log(song_details);
        func(song_details);
    })
}

function getEditorSongs(parent){
    var url = BASE_URL+"/getHomeData.php";
    // json.forEach((el)=>{});
    var i=0
    getRequest(url,(json)=>{
        json.editors_choice.forEach(song => {

            parent.appendChild(getCard(song.url,song.cover,song.name,song.artist))
        
        });

    })
}

function getLatestSongs(parent){
    var url = BASE_URL+"/getHomeData.php";
    // json.forEach((el)=>{});
    var i=0
    getRequest(url,(json)=>{
        json.new_release.forEach(song => {
            parent.appendChild(getCard(song.url,song.cover,song.name,song.artist))
        });

    })
}

function getSongs(parent, language, category){
    var url = BASE_URL+"/getTopSongs.php?language="+language+"&category="+category;
    // json.forEach((el)=>{});
    
    var i=0
    getRequest(url,(json)=>{
        json.ar.forEach(song => {
            parent.appendChild(getCard(song.url,song.cover,song.name,song.artist))
        });

    })
}

function getLatestPunjabiSongs(parent){
    getSongs(parent,"punjabi","top50");
}
function getLatestHindiSongs(parent){
    getSongs(parent,"hindi","top50");
}
function getRecommendedPunjabiSongs(parent){
    getSongs(parent,"punjabi","recommended");
}
function getRecommendedHindiSongs(parent){
    getSongs(parent,"hindi","recommended");
}

function getSearchedSong(parent,query){
    var url = BASE_URL+"/getSongs.php?url="+encodeURIComponent("https://djyoungster.org/music/search_song.php?word=")+query.replace(" ","%2520");
   // json.forEach((el)=>{});
   var i=0
    getRequest(url,(json)=>{
        document.getElementById("search_song_container").innerHTML=``;
        json.ar.forEach(song => {
            parent.appendChild(getCard(song.url,song.cover,song.name,song.artist))
        });
    })
}
function searchSongs(){
    document.getElementById("search_song_container").innerHTML =   `<div style="align-self: center;">
                                                                        <center style="">
                                                                            <i class="fas fa-circle-notch fa-spin"></i>
                                                                        </center>
                                                                    </div>`;
    var query = document.getElementById("search_bar").value;
    getSearchedSong(document.getElementById("search_song_container"),query);
}


function getCard(url, cover, name, artist){
    var div = document.createElement("div");
    div.className="card";
    div.innerHTML = `<a onclick="loadTrack({
        name: '`+name+`',
        artist: '`+artist+`',
        cover: '`+cover+`',
        url: '`+url+`'})">
            <div class="bar">
                <div class="emptybar">
                    <img class="cover" src="`+cover+`" alt="`+name+` song by `+artist+`">
                </div>
                <div class="filledbar">
                    <div class="play_btn">
                        <svg class="play_svg" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                            <path fill="#000000" d="M10,16.5V7.5L16,12M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        <h5 class="title">`+name+` <br> `+artist+`</h5></a>`;
    return div;
}

function getList(url, cover, name, artist){

    var div = document.createElement("div");
    div.className="card";

    div.innerHTML=`<a onclick="loadTrack({
        name: '`+name+`',
        artist: '`+artist+`',
        cover: '`+cover+`',
        url: '`+url+`'})">
            <div class="bar">
                    <div class="emptybar">
                        <img class="cover" src="`+cover+`" alt="`+name+` song by `+artist+`">
                    </div>
                    <div class="filledbar">
                        <div class="play_btn">
                            <svg class="play_svg" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                            <path fill="#000000" d="M10,16.5V7.5L16,12M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"></path>
                            </svg>
                        </div>
                    </div>
            </div>
        <h5 class="title">`+name+` <br> `+artist+`</h5></a>`;
    return div;
}

function showProgressBar(){

    console.log(progressIndex);
    if(progressIndex==1)
        document.getElementsByTagName("body")[0].appendChild(progressBar);
    progressIndex++;
}
function hideProgressBar(){
    
    progressIndex--;
    console.log(progressIndex);
    if(progressIndex==1)
        document.getElementsByTagName("body")[0].removeChild(progressBar);
    
}