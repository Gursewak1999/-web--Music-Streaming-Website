<html>

<head>

    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/b4a35c5382.css" media="all"> -->

    <script>

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

    </script>

</head>



<body>

    <div class="player">

        <div class="head">

            <div class="back"></div>

            <div class="front">

                <div class="avatar"></div>

                <div class="infos">

                    <div class="title_song">Old School</div>

                    <div class="artist_song">Prem Dhillon</div>

                </div>

            </div>

        </div>

    <div class="timeline">

        <div class="soundline">

            <div id="soundline_color"></div>

        </div>

        <div class="controllers active">

            <p class="currenttime">00:00</p>

            <!-- <div class="back" id="back" onclick="prevTrack()">

                <i class="fa fa-backward" aria-hidden="true"></i>

            </div> -->

            <div class="play" id="play" onclick="playpauseTrack()">

                <i class="fa fa-play" aria-hidden="true"></i>

            </div>

            <!-- <div class="forward" id="forward" onclick="nextTrack()">

                <i class="fa fa-forward" aria-hidden="true"></i>

            </div> -->

            <p class="totalduration">02:19</p>

        </div>

    </div>

</div>



</body>

</html>