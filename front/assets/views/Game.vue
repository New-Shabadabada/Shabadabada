<template>

    <div class="game">

        <h1 class="gameTitle" :style="titleOnGameStyle">A toi de jouer !</h1>


        <!-- Rules game -->
        <h2  :style="titleNoticeStyle">
            <i class="fas fa-angle-double-right"></i>
            <span class='one'>i</span>
            <span class='two'>m</span>
            <span class='three'>p</span>
            <span class='four'>o</span>
            <span class='five'>r</span>
            <span class='six'>t</span>
            <span class='seven'>a</span>
            <span class='eight'>n</span>
            <span class='nine'>t</span>
            <i class="fas fa-angle-double-left"></i>
        </h2>

        <div class="notice" :style="noticeStyle">

            <div>
                <p class="notice__title line2">
                    A lire, si tu veux tout déchirer
                </p>
            </div>

            <p class="notice__validate">
                <i class="far fa-hand-point-right"></i> Pour valider ta réponse tu dois <span class="important__bold"> appuyer sur la touche 'ENTRÉE'</span>, ou <span class="important__bold"> sur la touche 'RETOUR' (&#9166;) </span> de ton téléphone.
            </p>

            <p class="notice__nextButton">
                <i class="far fa-hand-point-right"></i> <span class="important__underline important__bold "> Le bouton 'SUIVANT' ne valide pas ta réponse,</span> il te permet simplement de <span class="important__bold"> passer à la chanson suivante </span> si tu ne souhaites pas attendre le temps restant.
            </p>

            <p class="notice__extraSpace">
                <i class="far fa-hand-point-right"></i> Sur mobile, <span class="important__bold"> ton correcteur orthographique est un coquin </span> et il peut te rajouter un espace après le dernier mot tapé, vérifies à bien le supprimer sous peine de rager !
            </p>

                <p class="notice__points">
                <i class="far fa-hand-point-right"></i> Pour chaque extrait diffusé tu as la possibilité de <span class="important__bold"> découvrir le titre et / ou l'artiste </span>. Il faut bien <span class="important__underline important__bold "> séparer tes réponses et les rentrer une par une </span>. Si tu écris l'artiste et le titre à la suite cela ne sera pas pris en compte. Chaque <span class="important__bold">bonne réponse vaut 1 point</span>.
            </p>

        </div>
        <!-- end Rules game -->

        <!-- WIP create loop for audio's tags -->
        <div class = "musicList">
            <audio v-on:ended="playSong" class="audio-player0 current" controls :src="source0"></audio>
            <audio v-on:ended="playSong" class="audio-player1" controls :src="source1"></audio>
            <audio v-on:ended="playSong" class="audio-player2" controls :src="source2"></audio>
            <audio v-on:ended="playSong" class="audio-player3" controls :src="source3"></audio>
            <audio v-on:ended="playSong" class="audio-player4" controls :src="source4"></audio>
            <audio v-on:ended="playSong" class="audio-player5" controls :src="source5"></audio>
            <audio v-on:ended="playSong" class="audio-player6" controls :src="source6"></audio>
            <audio v-on:ended="playSong" class="audio-player7" controls :src="source7"></audio>
            <audio v-on:ended="playSong" class="audio-player8" controls :src="source8"></audio>
            <audio v-on:ended="playSong" class="audio-player9" id="lastAudio" controls :src="source9"></audio>
        </div>

        <div class="question">

            <div :style="progressCircularStyle">
                <v-progress-circular
                    :style ="shadowStyleChange"
                    :button="true"
                    :progress="progress"
                    :rotate="270"
                    :size="150"
                    :width="15"
                    :value="value * 3.33"
                    :legend-value="rating"
                    :color="color"
                >
                    {{ value }}
                </v-progress-circular>
            </div>



            <div class="answer"
            :style="answerDisplayStyle"
            >
                <div class="alertBlock">
                    <p id="alert" :class="{right: classAlertRight, fail: classAlertFail}"></p>
                </div>

                <!-- if we want we can use v-on:keyup="checkUserAnswer to validate the user response in "reel time". But need to choose between the 2 because together they create some bugg-->
                <!-- DOC https://vuejs.org/v2/guide/syntax.html#Attributes -->
                <input
                    id="answer"
                    name="answer"
                    style="font-family: Montserrat; font-size:14px"
                    placeholder="Tapez le titre de la chanson ou l'artiste"
                    spellcheck="false"
                    type="text"
                    :disabled="readonly"
                    v-model="userAnswer"
                    v-on:keyup.enter="checkUserAnswer"
                />

            </div>
        </div> <!-- end div question -->

        <div class="button" :style="buttonsGameNoneStyle">

            <button
                class="button__start"
                type="button"
                v-on:click ="startGame"
                :style="startButtonStyle"
            >
                Start
            <button>


            <button
                class="button__next"
                type="button"
                v-on:click ="playSong"
                :style="nextButtonStyle"
            >
                Suivant
            <button>

        </div>


        <!-- EndGame -->
        <div class="background-popup" :style="bgStyleWhenPopup"></div>


        <h1 class="gameTitle" :style="titleEndGameStyle">Partie terminée ! Envie de remettre ça ?</h1>

        <div class="button" :style="playagainButtonStyle">

            <button
                    class="button__replay"
                    type="button"

                >
                    <router-link :to="{name: 'categoriesList'}" >
                    Rejouer
                </router-link>
                <button>
        </div>

        <!--STEP $emit step 3: we also add a custom event listener onto our component that listens out for 'displayNonePopup'. Our custom listener is waiting for the 'displayNonePopup'event to be fired. It will happen when the string 'displayNonePopup' is emitted from inside the 'popup.vue'-->
        <shabadabada-popup
            class="popup"
            @displayNonePopup="displayNonePopup"
            :style="stylePopup"
            :sentence="this.sentence"
            :points="this.points"
            >
        </shabadabada-popup>
        <!-- end EndGame -->

        <!-- Answers display -->
        <div class="answersBlock" :style="answersBlockStyle">

            <h3>Vous venez d'écouter :</h3>

            <div class="answersDisplay">

                <div class="answerDisplay" v-for="answer in answers" :key="answer[0]">

                    <img class="imgAnswer" :src="answer[3]" alt="">

                    <div class="titleAndArtistAnswer">

                        <p class="titleAnswer">{{answer[2]}}</p>
                        <p class="artistAnswer">{{answer[1]}}</p>

                    </div>

                </div>

            </div>
        </div> <!-- end Answers display -->

    </div> <!--end of div game-->
</template>


<script>

//=============== IMPORT ================

import axios from 'axios';
import Popup from '../components/Popup';

// import the data for the success or fail message during the game
import userDirections from '../javascript/data/userDirections.js';

// import the data for the personalized message according to the score at the end of the game
import scoreSentence from '../javascript/data/scoreSentence';


//======================================


export default {

    name: "shabadabada-game",

    created() {

        this.load();
    },

    components: {

        'shabadabada-popup': Popup,
    },

    props:{

        progress : String,
        rating : String,
    },

    data() {

        return {

            //==== Title page ====//
            titleOnGameStyle: '',
            titleEndGameStyle: 'display:none',

            //==== Notice ====//
            titleNoticeStyle: '',
            noticeStyle: '',

            //==== Audios playlist ====//
            audios: null,
            indexAudio: -1,// default value set to -1, because we incremented the index in the playsong function as soon as the game start
            currentAudio: null,
            playlist: null,
            source0: '',
            source1: '',
            source2: '',
            source3: '',
            source4: '',
            source5: '',
            source6: '',
            source7: '',
            source8: '',
            source9: '',

            //==== Progress circular ====//
            anwserAllowedTime: 0,
            interval: {},
            value: 30,
            color: '#FFD13B',
            shadowStyleChange: 'text-shadow: 2px 1.5px #FF03A4',
            progressCircularStyle: 'display:none',

            //==== Block Answer ====//
            answerDisplayStyle: 'display:none',

            //= Alert =//
            // DOC https://fr.vuejs.org/v2/guide/class-and-style.html
            classAlertRight: false,
            classAlertFail: false,
            // import the data above from an 'external' file located in the folder '../javascript/data/userDirections.js'
            // transform the array imported into  vue.js data to use it in our methods
            userDirections: userDirections,

            //= Input =//
            readonly: Boolean,
            userAnswer: '',

            //= User answers terms =//
            artistFound: false,
            titleFound: false,

            //==== Button's game ====//
            buttonsGameNoneStyle: '',
            startButtonStyle: '',
            nextButtonStyle: 'display:none',

            //==== Display infos music ====//
            answersBlockStyle: 'background-color: white; display:none',
            artist: '',
            musicTitle: '',
            albumThumbnail: '',
            idMusic: 0,
            answers: [],

            //==== End game ====//

            //= Save game =//
            // TODO change this if needed (PROD vs DEVELOPMENT)
            // WIP manage configuration's dev and configuration's prod
            getSaveGameEndpoint : 'http://localhost/Shabadabada/public/wp-json/shabadabada/v1/save-game',
            //getSaveGameEndpoint : 'http://ec2-54-211-13-201.compute-1.amazonaws.com/apo-Shabadabada/public/wp-json/shabadabada/v1/save-game',

            //= Points =//
            points: 0,

            //= Popup end game =//
            bgStyleWhenPopup: '',
            stylePopup: 'display: none',
            closeCross: '',
            sentence : '',
            // import the data above from an 'external' file located in the folder '../javascript/data/scoreSentence.js'
            // transform the array imported into vue.js data to use it in our methods
            scoreSentence: scoreSentence,
            playagainButtonStyle: 'display:none',
        }
    },

    methods: {

        load(){

            this.bgStyleWhenPopup = "display:none";

            //console.log('%c' + 'load playlist', 'color: #0bf; font-size: 1rem; background-color:#f0f');
            // TODO SESSION_STORAGE be careful session storage !
            this.playlist = JSON.parse(sessionStorage.getItem('game'));

            // insert 'points field' to the playlist table, it'll be useful for calculating the points
            this.playlist.points = 0;

            // loop on the playlist musics from the session storage
            let i = 0;
            for(let music of this.playlist.musics) {

                let key = 'source' + i;
                this[key] = music.soundExcerpt;

                // insert fields related to the user answers into the previous data of the previous songs
                // create fields into the json field (game_response) return to the DB
                music.triesCount = 0;
                music.tries = [];
                music.artistFound = false;
                music.titleFound = false;
                music.elapsedTimeForAnswer = null;

                i++;
            }
        },

        startGame() {
            // target & save as a data all the audio players (we'll need this to control the app)
            // reminder: target a parent element with several children, generate a indexed chart with the children data
            // the div element '.musicList', set an index for every audio children
            this.audios = document.querySelectorAll('.musicList audio');

            this.interval = setInterval(() => {

                if (this.value <= 6 && this.value > 0) {

                    this.color = '#FF03A4';
                    this.shadowStyleChange = 'text-shadow: 2px 1.5px #FFD13B';
                }
                else {

                    this.color = "#FFD13B";
                    this.shadowStyleChange = 'text-shadow: 2px 1.5px #FF03A4';
                }

                if (this.value === this.anwserAllowedTime) {

                    return (this.value = 30);
                }

                this.value -= 1;
            }
            , 1000);

            this.playSong();
            this.readonly = false;
            this.answerDisplayStyle= 'display:block';
            this.startButtonStyle = "display:none";
            this.nextButtonStyle = "display:block";
            this.titleNoticeStyle = "display:none";
            this.noticeStyle = "display:none";
            this.progressCircularStyle= 'display:block; font-size: 2rem; font-family: Kanit',
            this.answersBlockStyle = "background-color: white; display:block";
        },

        focusInput(){
            this.userAnswer.focus();
        },


        playSong() {

            // reset the timer for every new song
            this.value = 30;
            this.readonly = false;
            this.artistFound = false;
            this.titleFound = false;

            if(this.currentAudio) {

                // only for the debug ! this is the indexAudio which set the current song played
                // this.currentAudio.classList.remove('current');
                this.currentAudio.pause();
            }

            // if we are on the last song (i.e index 9), we save the game
            if(this.indexAudio == this.playlist.musics.length - 1) {

                this.endGame();
            }
            else {

                // clean the alert before the new song begins
                let alert = document.getElementById("alert");
                // alert.classList.remove('fail', 'right');
                alert.textContent = '';

                this.classAlertRight = false;
                this.classAlertFail = false;

                // otherwise we play the next song
                this.indexAudio++;

                this.currentAudio = this.audios[this.indexAudio];

                //this.currentAudio.classList.add('current');

                // DOC https://developer.mozilla.org/fr/docs/Web/API/HTMLMediaElement/play
                this.currentAudio.play();

                // if 'currentAudio' is not the first song, we call the function 'displayAnswer' and add points if the previous response is correct
                if(this.indexAudio > 0){

                    // call function for display informations of each song
                    this.displayAnswer();

                    // call function calculatePoints for each song
                    this.calculatePoints();
                }
            }

            // APO manage the volum here !
            this.currentAudio.volume=0.1;
            this.idMusic++;
            this.userAnswer = '';
        },


        // method triggered when the user presses the enter key after entering a response in the input
        checkUserAnswer: function (event) {

            // save the user trials & his answers as well (bonus)
            this.playlist.musics[this.indexAudio].triesCount++;
            this.playlist.musics[this.indexAudio].tries.push(this.userAnswer);

            // target currentAudio artist and title answer
            let artistAnswer = this.playlist.musics[this.indexAudio].artist[0];
            let musicTitleAnswer = this.playlist.musics[this.indexAudio].musicTitle;

            let alert = document.getElementById("alert");

            if(this.userAnswer.toLowerCase() === artistAnswer.toLowerCase()){

                this.playlist.musics[this.indexAudio].artistFound = true;
                this.artistFound = true;

                this.changeClassesAlert(this.artistFound);

                if(this.artistFound && this.titleFound){

                    this.displayUserDirectionsIfSuccess();

                    this.readonly = true;
                }
                else {

                    alert.textContent = 'Bravo tu as trouvé l\'artiste, connais-tu le titre ?';
                }
                this.userAnswer = '';
            }
            else if(this.userAnswer.toLowerCase() === musicTitleAnswer.toLowerCase()){

                this.playlist.musics[this.indexAudio].titleFound = true;
                this.titleFound = true;

                this.changeClassesAlert(this.titleFound);

                if(this.titleFound && this.artistFound) {

                    this.displayUserDirectionsIfSuccess();

                    this.readonly = true;
                }
                else {

                    alert.textContent = 'Bravo tu as trouvé le titre, connais-tu l\'artiste ?';
                }

                this.userAnswer = '';

            }
            else if (this.userAnswer.toLowerCase() !== artistAnswer.toLowerCase() || this.userAnswer.toLowerCase() !== musicTitleAnswer.toLowerCase()){

                this.changeClassesAlert(this.userAnswer == artistAnswer || this.userAnswer == musicTitleAnswer);

                this.displayUserDirectionsIfFailure();
            }

            this.playlist.musics[this.indexAudio].elapsedTimeForAnswer = 30 - this.value;

        },

        changeClassesAlert(answer = ''){

            if(answer === true){

                this.classAlertRight = true;
                this.classAlertFail = false;
            }
            else if(answer === false){

                this.classAlertFail = true;
                this.classAlertRight = false;
            }
        },

        displayUserDirectionsIfSuccess() {

            // target the alert div
            let alert = document.getElementById("alert");

            // gives a random element of the array userDirections declare in  data area as output
            // and then display the element in the above input
            let personalizedDirections = _.sample(this.userDirections.ifSuccess);
            alert.textContent = personalizedDirections;
        },

        displayUserDirectionsIfFailure() {

            // target the "div alert" to add the class "fail" and display the matching CSS and text
            let alert = document.getElementById("alert");

            // gives a random element of the array userDirections declare in  data area as output
            // and then display the element in the above input
            let personalizedDirections = _.sample(this.userDirections.ifFailure);

            alert.textContent = personalizedDirections;
        },


        // method to display tracks's informations that the user has already listened to
        // majout de indexAudio en paramètre pour pouvoir gérer l'affichage de la dernière chanson sans répéter le code
        displayAnswer(indexAudio = this.indexAudio -1){

            // retrieve artist, musicTitle and albumThumbnail listened
            this.artist = this.playlist.musics[indexAudio].artist[0];

            this.musicTitle = this.playlist.musics[indexAudio].musicTitle;

            this.albumThumbnail = this.playlist.musics[indexAudio].albumThumbnail;

            // DOC https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Global_Objects/Array/unshift
            this.answers.unshift([this.idMusic, this.artist, this.musicTitle, this.albumThumbnail]);

        },

        // method for calculate points according to user's response it's true are false, useful for display points in the popup
        calculatePoints(){

            // calculation of points according to the answers found (1 points for the artist, 1 points for the title)
            if(this.playlist.musics[this.indexAudio -1].artistFound === true){

                this.playlist.points++;
            }
            if(this.playlist.musics[this.indexAudio -1].titleFound === true) {

                this.playlist.points++;
            }
        },

        // At the end of the game:
            // we save the game using axios, by calling the back endPoint (shabadabada/v1/save-game) used to save the implemented datas of the user answers in the DB
            // make the timer & the 'next' button disappear, display the end game pop-up
        endGame(){
            axios.post(this.getSaveGameEndpoint, this.playlist)
            .then(response => {

               this.playlist = response.data;
            });

            // display title of last song
            this.displayAnswer(this.playlist.musics.length - 1);

            //call function calculatePoints for the last song
            this.calculatePoints();

            this.stylePopup = 'display: block';
            this.nextButtonStyle = 'display: none';
            this.progressCircularStyle = 'display: none';
            this.bgStyleWhenPopup = "display: block";
            this.answerDisplayStyle= 'display:none';
            this.titleEndGameStyle= 'display:block';
            this.titleOnGameStyle='display:none';
            this. buttonsGameNoneStyle='display:none';

            this.points = this.playlist.points;

            this.displayScoreSentence();
        },


        displayScoreSentence(){

            if(this.points >= 0 && this.points <= 9){

                // DOCS _.sample https://underscorejs.org/#sample
                // gives a random element of the array as output
                let personalizedSentenceScore = _.sample(this.scoreSentence.zeroToNine);
                this.sentence = personalizedSentenceScore;
            }
            else if (this.points >= 10 && this.points <= 16) {

                let personalizedSentenceScore = _.sample(this.scoreSentence.tenToSixteen);
                this.sentence = personalizedSentenceScore;
            }
            else if (this.points >= 17 && this.points <= 18){

                let personalizedSentenceScore = _.sample(this.scoreSentence.seventeenToEighteen);
                this.sentence = personalizedSentenceScore;
            }
            else if (this.points >= 19 && this.points <= 20){

                let personalizedSentenceScore = _.sample(this.scoreSentence.nineteenToTwelve);
                this.sentence = personalizedSentenceScore;
            }
        },

        // STEP $emit step 4: when @displayNonePopup event listener is triggered this function happens. It simply put the style display: none on the div popup which allow us to close it in a certain way-->
        displayNonePopup(e){

            this.stylePopup = 'display: none';
            this.bgStyleWhenPopup = "display: none";
            this.playagainButtonStyle= 'display:block';
        }

    }, //end of methods

    beforeDestroy () {

        clearInterval(this.interval)
    },

}// end of export default

</script>


<style scoped lang="scss">
@import '../scss/main.scss';



.game  {

    display: flex;
    flex-direction: column;
    align-items: center;

    box-sizing: border-box;
    padding-top: $spacing-simple;

    &Title {

        font-family: "Lazer84";
        word-spacing: 1rem;
        text-shadow: 2px 1.5px $color-pink-f0f;
        font-size: $spacing-double;
        text-align: center;
        color: $color-turquoise;
        padding: 1rem 0 1rem 0;
        margin-bottom: 3rem;
    }

    .musicList {

        display: none;
    }

    audio  {

        display: none;

        &.current {

            border: solid 6px #f0f;
        }
    }

    h2 {
            text-transform: uppercase;
            animation: glow 1s ease-in-out infinite alternate;
            text-align: center;
            font-family: "monoton";
            font-size: 1.5rem;
            color:#FF03A4;
            font-size: 2rem ;
        }

    @keyframes glow {

        from {
            text-shadow: 0 0 20px #FF03A4;
        }
        to {
            text-shadow: 0 0 20px #f2029a, 0 0 10px #FF03A4;
        }
    }

    .notice {

        font-family: "Montserrat";
        width: 80%;
        color:black;
        border: 2px solid $color-pink-f0f;
        padding : $spacing-simple;
        background-color: white ;
        box-shadow: 6px 6px 0px $color-pink-f0f;
        margin: 1rem 0 4rem 0;

        i {
            color: $color-pink-f0f;
        }

        .important__underline {

            border-bottom: 1px solid black;
        }

        .important__bold {

            font-weight: bold;
        }

        .notice__title {

            text-align: center;
            font-weight: bold;
            margin: 0px; // to overpassed vuejs
            border-bottom: 1px solid $color-pink-f0f;
            font-size: 1rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            font-style: italic;

        }

    }

    .question {

        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        width: 100%;

            .answer {

                width: 90%;
                padding: $spacing-half;
                margin-bottom: $spacing-simple;
                text-align: center;

                .alertBlock {

                    margin-top: $spacing-double;

                    #alert {

                        border-radius: 1rem;
                        padding: 0.3rem 0.5rem;
                        text-align: center;
                        font-weight: bold;
                        font-family: "Montserrat";
                    }

                    .right {

                        background-color: #d1e7dc;
                        color: #39903b;

                    }

                    .fail {

                        background-color:#f8d6d9;
                        color: #ad4337;
                    }
                }

                input[type='text'] {

                    width: 100%;
                    border: solid 1px black;
                    background-color: white;
                    border-radius: 1rem;
                    padding: $spacing-half $spacing-simple;
                    outline-style: none
                }
            }
    }

    .v-progress-circular{

        text-align: center;
        width: 80%;
        font-family: "Lazer84";
        text-shadow: 2px 1.5px$color-pink-f0f;

    }

    .button {

        text-align: center;
    }

    .button__start,
    .button__next,
    .button__replay {

        background-color: $color-yellow;
        border: none;
        color: white;
        font-size: 20px;
        border-radius: 10px;
        padding: 5px 15px;
        font-family: "Lazer84";
        margin: $spacing-simple auto $spacing-double auto;
        width: 100px;
        letter-spacing: 0.1rem;
        text-shadow: 2px 2px black;
        box-shadow: 3px 3px 0px white;
        font-size: 14px;
        outline: none;

        a {
            text-decoration: none;
            color: white;
        }
    }


    .background-popup {

        position: fixed;
        top: 8px;
        left: 16px;
        height: 100%;
        width: 100%;
        background-color: $color-dark-blue;
        opacity: 0.7;

    }


    .popup {

        position: fixed;
        top: 20%;
        left: 10%;
        color: black;
    }

    .answersBlock {

        width: 90%;
        height: auto;
        margin: $spacing-double auto $spacing-double auto;
        padding: $spacing-simple;
        border: 2px solid $color-pink-f0f;


        h3 {

            font-family: "Lazer84" !important;
            text-shadow: 2px 1.5px $color-turquoise;
            word-spacing: 1rem;
            margin-bottom: 1rem;
            text-align: center;
            color: $color-pink-f0f;
            font-weight: bold;
        }

        .answerDisplay {

            display: flex;
            align-items: center;
            width: 90%;
            margin: $spacing-half auto $spacing-half auto;

            .imgAnswer {

                width: 30%;
                border-radius: 4px;
                box-shadow: 3px 3px 3px #0008;
                border: solid 1px  #0008;
            }

            .titleAndArtistAnswer {

                margin-left: $spacing-simple;
                font-size: 0.8rem;

                .titleAnswer,
                .artistAnswer {

                    margin-bottom: 0;
                    font-family: "Montserrat";
                }

                .artistAnswer {

                    font-weight: bold;
                }
            }
        }
    }
}

.v-application {

    all: unset;
    font-family: "Roboto", sans-serif;
    line-height: 1.5;
}

@include screen-small {

    .notice__validate,
    .notice__nextButton,
    .notice__extraSpace,
    .notice__points {

        font-size: 0.8rem;
    }

    .answer .alertBlock #alert {

        font-size: 0.8rem;
    }
}

@include screen-medium {

    .game {
        padding-top: $spacing-double;

        .question .answer  {

            width: 60%;
        }

        .answersBlock {

            h3 {

                font-size: 1.5rem;
                margin-bottom: 2rem;
                font-family: 'Roboto';
            }

            .answerDisplay{
                .imgAnswer{

                    width: 25%;
                }

                .titleAndArtistAnswer {

                    font-size: 1rem;
                }
            }
        }
    }
}

@include screen-large{

    .game {

        .notice .notice__title.line1{
            font-size: 1.5rem;
        }

        .question .answer {

            width: 50%;
        }

        .answersBlock {
            // debug
            //border: solid 3px #f0f;
            width: 70%;
            font-family: 'Roboto';

            .answersDisplay {

                display: flex;
                justify-content: center;
                align-items: center;
                flex-wrap: wrap;
            }

            .answerDisplay {

                display: flex;
                justify-content: center;
                align-items: center;
                width: 50%;
                margin: $spacing-half auto $spacing-half auto;

                    .imgAnswer {

                        width: 25%;
                    }

                .titleAndArtistAnswer {

                    margin-left: $spacing-simple;
                    font-size: 1rem;
                    width: 75%;

                    .titleAnswer,
                    .artistAnswer {

                        margin-bottom: 0;
                        width: 80%;
                    }

                    .artistAnswer {

                        font-weight: bold;
                    }
                }
            }
        }
    }
}

@include screen-extra-large {

    .game {

        .button__start {

            padding: 10px 20px;
            font-size: 1.2rem;
        }

        .answer {

            width: 60%;

            input[type='text'] {

                width: 60%;
            }
        }

        .answerDisplay {

            display: flex;
            align-items: center;
            width: 33%;
        }
    }
}

</style>