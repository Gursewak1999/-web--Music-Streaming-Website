class Navigator{
    
    static app_dashboard = document.getElementById("app_dashboard");
    static app_punjabi_songs = document.getElementById("app_punjabi_songs");
    static app_hindi_songs = document.getElementById("app_hindi_songs");
    static app_punjabi_albums = document.getElementById("app_punjabi_albums");
    static app_recommended_hindi_songs = document.getElementById("app_recommended_hindi_songs");
    static app_recommended_punjabi_songs = document.getElementById("app_recommended_punjabi_songs");
    static app_search = document.getElementById("app_search");
    static app_selected = document.getElementById("app_dashboard");

    static init(){
        this.app_dashboard = document.getElementById("app_dashboard");
        this.app_punjabi_songs = document.getElementById("app_punjabi_songs");
        this.app_hindi_songs = document.getElementById("app_hindi_songs");
        this.app_punjabi_albums = document.getElementById("app_punjabi_albums");
        this.app_recommended_hindi_songs = document.getElementById("app_recommended_hindi_songs");
        this.app_recommended_punjabi_songs = document.getElementById("app_recommended_punjabi_songs");
        this.app_search = document.getElementById("app_search");

        this.nav_dashboard = document.getElementById("nav_dashboard");
        this.nav_punjabi_songs = document.getElementById("nav_punjabi_songs");
        this.nav_hindi_songs = document.getElementById("nav_hindi_songs");
        this.nav_punjabi_albums = document.getElementById("nav_punjabi_albums");
        this.nav_recommended_hindi_songs = document.getElementById("nav_recommended_hindi_songs");
        this.nav_recommended_punjabi_songs = document.getElementById("nav_recommended_punjabi_songs");
        this.nav_search = document.getElementById("nav_search");
    }

    constructor() {
        this.init();
        hideAll();       
       // this.gotoDashboard();
    }

    static hideAll(){
        if(this.app_dashboard==null)
            this.init()
        this.app_dashboard.style.display="none";
        this.app_punjabi_songs.style.display="none";
        this.app_hindi_songs.style.display="none";
        this.app_punjabi_albums.style.display="none";
        this.app_recommended_hindi_songs.style.display="none";
        this.app_recommended_punjabi_songs.style.display="none";
        this.app_search.style.display="none";

        this.nav_dashboard.className ="nav__link";
        this.nav_punjabi_songs.className ="nav__link";
        this.nav_hindi_songs.className ="nav__link";
        this.nav_punjabi_albums.className ="nav__link";
        this.nav_recommended_hindi_songs.className ="nav__link";
        this.nav_recommended_punjabi_songs.className ="nav__link";
        this.nav_search.className ="nav__link";
    }

    static select(selected_app, selected_nav){
        this.app_selected = selected_app;
        this.hideAll();
        this.app_selected.style.display="block";
        selected_nav.className +=" selected"; 
    }

    static gotoDashboard(){
        this.select(this.app_dashboard,this.nav_dashboard)
    }
    static gotoSearch(){
        this.select(this.app_search,this.nav_search)
    }
    static gotoPunjabiSongs(){
        this.select(this.app_punjabi_songs,this.nav_punjabi_songs)
    }
    static gotoHindiSongs(){
        this.select(this.app_hindi_songs, this.nav_hindi_songs)
    }
    static gotoRecommendedPunjabiSongs(){
        this.select(this.app_recommended_punjabi_songs,this.nav_recommended_punjabi_songs)
    }
    static gotoRecommendedHindiSongs(){
        this.select(this.app_recommended_hindi_songs, this.nav_recommended_hindi_songs)
    }
    static gotoPunjabiAlbums(){
        this.select(this.app_punjabi_albums,this.nav_punjabi_albums)
    }

}