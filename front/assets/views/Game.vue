<template>
    <div class="game">
        <div class="background-popup" :style="bgStyleWhenPopup"></div>
        <h1 class="gameTitle" :style="titleOnGameStyle">A toi de jouer !</h1>
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

                <div class="answer" :style="answerCurrentStyle" >

                    <div class="alertBlock">
                        <p id="alert" class=""></p> <!-- attention keep the empty class, used to add a class 'fail' or 'success' in the method checkUserAnswer--> 
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
            </div>

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
            </div>

    </div> <!--end of div game-->
</template>


<script>

//=============== IMPORT ================ 

import axios from 'axios';
import Popup from '../components/Popup';

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
            // duration timer dynamization
            anwserAllowedTime: 0,

            interval: {},
            value: 30,
            color : '#FFD13B',
            shadowStyleChange : 'text-shadow: 2px 1.5px #FF03A4',

            readonly : Boolean,
            
            userAnswer: '',

            // list of all the songs into the playlist
            audios: null, 

            // define an "id" for the current song (it match the index of every song in the playlist)
            // default value set to -1, because it's implemented in the playsong function which start the song 
            indexAudio: -1,

            // current song
            currentAudio: null,

            titleOnGameStyle: '',
            titleEndGameStyle: 'display:none',

            // to modify the input answer style
            answerCurrentStyle: 'display:none',

            startButtonStyle: '',

            nextButtonStyle: 'display:none',

            progressCircularStyle: 'display:none',

            playagainButtonStyle: 'display:none',

            titleNoticeStyle: '',
            noticeStyle: '',

            buttonsGameNoneStyle: '',

            answersBlockStyle: 'background-color: white; display:none',
            artist: '',
            musicTitle: '',
            albumThumbnail: '',
            idMusic: 0,
            answers: [],

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

    
            // TODO change this if needed (PROD vs DEVELOPMENT)
            getSaveGameEndpoint : 'http://localhost/Shabadabada/public/wp-json/shabadabada/v1/save-game',
            //getSaveGameEndpoint : 'http://ec2-54-211-13-201.compute-1.amazonaws.com/apo-Shabadabada/public/wp-json/shabadabada/v1/save-game',

            points: 0,
            stylePopup: 'display: none',
            closeCross: '',

            sentence : '',
            bgStyleWhenPopup: '',

            userDirections : 
            {
                ifSuccess: [
                    'Travail exemplaire, rien à dire.',
                    'T\'es un génie.',
                    'Tes parents peuvent être fiers de toi.',
                    'On s\'incline devant ton savoir.',
                    'Et de 2 bonnes réponses !',
                    'T\'as trouvé l\'artiste et le titre, prends pas la grosse tête surtout.',
                    'Bien joué ! t\'as trouvé l\'artiste et le titre.',
                    'Sacré talent !',
                    'Ah bah tu vois ! quand tu veux, tu peux !',
                    'Bonne réponse. C\'est vrai quoi, pas besoin d\'en faire une montagne.',
                    'Même Yoda reconnaît ta force.',
                    'T\'as tout bon, chope pas le melon.',
                    'Il semblerait que nous ayons un champion !',
                    'YEAH !!!',
                    'Vers l\'infini et au-delà !',
                    'Votre majesté brille aujourd\'hui !',
                    'Standing ovation',
                    'On a enclenché une ola en ton honneur.',
                    'On est ému par tant de justesse.',
                    'Victoire !',
                    'Sur une échelle de 1 à 10 tu vaux au moins 11 !',
                    'Oh, chouette, chouette, chouette !',
                    'Je rêve ou t\'as trouvé les 2 réponses !',
                    'Rien ne semble pouvoir t\'arrêter',
                    'Tu es aussi fantastique que Oprah.',
                    'C\'est de la bombe bébé !',
                    'Les revenants ne vont pas en revenir !',
                    'C\'est ton jour de chance on dirait.',
                    'Sssplendide !!',
                    'C\'est OKKKKKKKK !',
                    'Force et honneur.'
                ],


                ifFailure: [
                    'Mauvaise réponse, essaie encore !',
                    'Nope !',
                    'Faux !',
                    'Du plus profond de notre coeur on t\'invite à réessayer.',
                    'Hum...bien essayé mais non c\'est pas ça !',
                    'Nous sommes au regret de t\'annoncer que ce n\'est pas la bonne réponse.',
                    'Belle tentative mais raté !',
                    'C\'est certe une réponse mais pas celle attendue !',
                    'J\'ai bien peur que ce soit incorrect !',
                    'Bien essayé mais loupé !',
                    'Tu es cordialement invité à taper une réponse correcte cette fois.',
                    'C\'est un échec, j\'en ai bien peur.',
                    'Recalé !',
                    'On me dit dans l\'oreillette que ceci n\'est pas la bonne réponse.',
                    'On salue l\'effort mais non c\'est pas ça !',
                    'Nous on connaît la réponse mais on préfère te laisser la trouver.',
                    'Tout n\'est pas perdu, retente ta chance.',
                    'On attend encore que tu nous donnes la bonne réponse.',
                    'Dis-donc va falloir penser à donner une bonne réponse à un moment.',
                    'Absolument pas !',
                    'Non, y\'a du boulot...courage !',
                    'T\'es plus proche du néant que de la bonne réponse !',
                    'Tu coules à pic !',
                    'Comme dirait Camélia Jordana: non, non,non.',
                    'Nan mais allô quoi ! tu ne connais pas la réponse !',
                    'Merci pour ta réponse, elle est aussi utile qu\'un soutien-gorge en période de confinement.',
                    'Trou de mémoire ? Si ça persiste, consultez svp.',
                    'Vous avez peut-être la réponse sur le bout de la langue mais pas sur le bout des doigts !',
                    'Nous sommes au regret de vous annoncer que vous avez tort.',
                    'Vous voulez qu\'on se fâche ?',
                    'Les miracles, c\'est rare dans la vie.',
                    'C\'est effarant !',
                    'Vous ne passerez pas !',
                    'T\'es à côté de la plaque, sorry !',
                    'Tu connais la différence entre toi et moi ? moi, je connais la bonne réponse.' 

                ]

            },

            scoreSentence : 
            {

                zeroToNine: [

                    'Dans 90% des cas, le problème se trouve entre la chaise et l\'écran ...',
                    'Votre mémoire est comme une poêle Tefal, on a glissé et on a pas accroché !',
                    'On peut pas être bon en tout !',
                    'Un vrai touriste aurait au moins pris des photos.',
                    'Que dire...',  
                    'Houston, nous avons un problème.',
                    'L\'essentiel n\'est pas de participer !', 
                    'Arrêtez de croire à la magie, on est pas à Poudlard ici !',
                    'Si vous tombez plus bas, vous trouverez du pétrole !', 
                    'La mémoire, c\'est comme un géranium: si on ne le nourrit pas, elle crève.',  
                    'Contrairement aux étoiles filantes, vous n\'avez pas brillé',
                    'Travail inexistant: il faut essayer d\'essayer',
                    'Vous avez beaucoup de connaissances ... en dehors de la musique.',
                    'Ouvrir grand tes oreilles tu dois !', 
                    'Vous roulez à contresens sur l\'autoroute du succès.',
                    'Vous êtes venu en touriste, mais vous ne rapporterez aucun souvenir.',
                    'Comme dirait cette poète Wejdene "tu hors de ma vue".',
                    'Visiblement vous portez autant d\'intérêt à la musique qu\'une huître à l\'équitation.',
                    'On compatit !', 
                    'Réussir c\'est souvent accepter l\'échec !',
                    'Les aventuriers de la tribu Shabadabada ont décidé de vous éliminer, et leur sentence est irrévocable !',
                    'On se dit RDV dans 10ans, ça vous laisse le temps de vous améliorer.',
                    'Besoin d\'une consultation chez l\'ORL ?',
                    'Tout est dit...',
                ],

                tenToSixteen: [

                    'Aussi suffisant qu\'insuffisant.',
                    'On note la volonté.',
                    'Vous avez pris le soin de ménager vos efforts.',  
                    'Bof, pas de quoi casser trois pattes à un canard.',
                    'Mouais, pas de quoi pousser mémé dans les orties !',
                    'Peut mieux faire, ou peut-être pas !',
                    'On note l\'effort',
                    'Bien, mais pas top !',
                    'Vraiment ! Vous pouvez pas mieux faire ? 😜',
                    'Encourageant',
                    'Mention passable',
                    'Est-ce que vous voulez vraiment qu\'on dise de vous que vous êtes dans la moyenne ?',
                ],


                seventeenToEighteen: [

                    'Presque ! ça vaut bien nos encouragements.',
                    'Champomy de rigueur.',
                    'Que la Force soit avec toi !',
                    'Eh bien...personne n\'est parfait !',
                    'Tout n\'est pas perdu !',
                    'Presque ! C\'est rageant, hein ?!',
                    'On t\'avoue on est un tout petit peu déçu.',
                    'On est d\'accord avec ta mère, c\'est le minimum syndical.',
                    'Pouce en l\'air 👍',
                    'Peut mieux faire, ou peut-être pas !',
                    'Vous étiez à ça de réussir, c\'est dommage !',
                    'Pas mal, mais on a vu mieux ! 😘',
                    'Dab virtuel en ton honneur.',
                ], 
                
                nineteenToTwelve: [

                    'Heureusement, il y a parfois des joueurs qui compensent pour tous les autres: vous êtes excellent ! Merci, on est trop content 😊',
                    'Grâce à vous, le soleil de l\'esprit luit sur les mornes plaines du quotidien.',
                    'Nec pluribus impar',
                    'Merci ! on vous oubliera jamais.',
                    'À marquer dans les annales.',
                    'On est impressionné, Johnny aussi !',
                    'Félicitations, vous êtes le maître du monde !',
                    'Ma mère vous remercie. Mon père vous remercie. Ma sœur vous remercie. Et je vous remercie.',
                    'Un grand pouvoir implique de grandes responsabilités.',
                    'Petite danse de la joie plus que méritée 👯‍♀️',
                    'Soit assuré que ton talent est reconnu.',
                    'On s\'incline devant ta toute pouissance 🙇‍♂️',
                    'Tu crois que t\arriveras à renouveler l\'exploit ? ',
                ]
            }
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
            this.answerCurrentStyle= 'display:block';
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
            //this.focusInput();
            if(this.currentAudio) {
                // only for the debug ! this is the indexAudio which set the current song played
                // this.currentAudio.classList.remove('current');
                this.currentAudio.pause();
            }

            // if we are on the last song (i.e index 9), we save the game
            if(this.indexAudio == this.playlist.musics.length - 1) {
  
                //this.displayAnswer(this.indexAudio);  replace in endGame function
                this.endGame();
            }
            else {

                // clean the alert before the new song begins
                let alert = document.getElementById("alert");
                alert.classList.remove('fail', 'right');
                alert.textContent = '';

                // otherwise we play the next song
                this.indexAudio++;
                //console.log(this.indexAudio);

                this.currentAudio = this.audios[this.indexAudio];
                //console.log(this.currentAudio);

                this.currentAudio.classList.add('current');
                
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
            //console.log(artistAnswer);

            let musicTitleAnswer = this.playlist.musics[this.indexAudio].musicTitle;
            //console.log(musicTitleAnswer);

            // APO voir si on conserve titre et artiste car des fois c'est le nom de l'album qui sort et pas le titre d'une chanson, allez savoir pourquoi
            // toLowerCase() : method returns the calling string value converted to lower case.
            // if the artist answer entered by the user is correct OR the music title answer entered by the user is correct
            if (this.userAnswer.toLowerCase() === artistAnswer.toLowerCase() || this.userAnswer.toLowerCase() === musicTitleAnswer.toLowerCase())
            {  
                // target the "div alert" to add the class "success" and display the matching CSS and text 
                // need to remove the class before to avoid class superposition 
                let alert = document.getElementById("alert");
                alert.classList.remove('fail');
                alert.classList.add('right');

                // save the validated answer & the time at which the user found it
                if(this.userAnswer.toLowerCase() === artistAnswer.toLowerCase() && (this.playlist.musics[this.indexAudio].titleFound === true)){

                   this.playlist.musics[this.indexAudio].artistFound = true; 
                   //console.log(this.playlist.musics[this.indexAudio].artistFound);
                   this.displayUserDirectionsIfSuccess();

                   this.readonly = true;

                } 
                else if(this.userAnswer.toLowerCase() === artistAnswer.toLowerCase()){

                    this.playlist.musics[this.indexAudio].artistFound = true; 
                    alert.textContent = 'Bravo tu as trouvé l\'artiste, connais-tu le titre ?';
                }
                else if(this.userAnswer.toLowerCase() === musicTitleAnswer.toLowerCase() && (this.playlist.musics[this.indexAudio].artistFound === true)) {

                    this.playlist.musics[this.indexAudio].titleFound = true;
                    this.displayUserDirectionsIfSuccess();
                    
                    
                    this.readonly = true;
                }
                else if(this.userAnswer.toLowerCase() === musicTitleAnswer.toLowerCase()){

                    this.playlist.musics[this.indexAudio].titleFound = true;
                    
                    alert.textContent = 'Bravo tu as trouvé le titre, connais-tu l\'artiste ?';
                }

                this.playlist.musics[this.indexAudio].elapsedTimeForAnswer = 30 - this.value;

                // if the answer is correct we clean the input
                this.userAnswer = '';

                // if the artist answer entered by the user is incorrect or the music title answer entered by the user is incorrect
            } else if (this.userAnswer.toLowerCase() !== artistAnswer.toLowerCase() || this.userAnswer.toLowerCase() === musicTitleAnswer.toLowerCase()) 
            {
                this.displayUserDirectionsIfFailure();
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
            // need to remove the class before to avoid class superposition 
            let alert = document.getElementById("alert");
            //alert.classList.remove('right');
            alert.classList.add('fail');

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
            this.answerCurrentStyle= 'display:none';
            this.titleEndGameStyle= 'display:block';
            this.titleOnGameStyle='display:none';
            this. buttonsGameNoneStyle='display:none';

            this.points = this.playlist.points;
            
            this.displayScoreSentence();
        },


        displayScoreSentence(){

        //console.log(this.points);

            if(this.points >= 0 && this.points <= 9){

                // DOCS _.sample https://underscorejs.org/#sample
                // gives a random element of the array as output
                let personalizedSentenceScore = _.sample(this.scoreSentence.zeroToNine);
                this.sentence = personalizedSentenceScore;
                
            } else if (this.points >= 10 && this.points <= 16) {

                let personalizedSentenceScore = _.sample(this.scoreSentence.tenToSixteen);
                this.sentence = personalizedSentenceScore;
                

            } else if (this.points >= 17 && this.points <= 18){

                let personalizedSentenceScore = _.sample(this.scoreSentence.seventeenToEighteen);
                this.sentence = personalizedSentenceScore;
                

            } else if (this.points >= 19 && this.points <= 20){

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