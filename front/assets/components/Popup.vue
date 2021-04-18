<template>
   <div class = 'popup'>

       <!-- STEP $emit step 1 : put a event listener on the child component, when the cross button is clicked the function closePopUp is triggered and take the 'stylePopup' as a parameter (the variable will be pass to <shabadabada-popup> -->
       <div class="closeCross" @click="closePopUp(stylePopup)">&#x2716;</div>
       <h3 class="header"> Fin de la partie !</h3>

        <div class="container">
       <p class="displayScore"> 
           Ton score est de <span class="score"> {{points}}/20 </span>
        </p>

       <p class="scoreSentence"> 
           {{sentence}}
        </p>

       <button class="replay-button"> 
            <router-link :to="{name: 'categoriesList'}" class="replay">
                Rejouer 
            </router-link>
        </button>

        <!--<button class="button replay" @click="startGameSameCategory"> 
           Rejouer 
        </button>-->
    </div>
   </div>   
</template>


<script>

//=============== IMPORT ================ 

import axios from "axios";
import cardCategory from "../components/cardCategory";

//======================================


export default {
    name: "popup-end-game",

    created: function() {
        axios.get(this.getCategoriesEndPoint).then(response => {
            this.category = response.data.slug;
            //console.log(response.data.slug);
        });
    },

    components: {
        cardCategory
    },
    
    props: {
        points: Number,
        closeCross: String,
        category: String,  
        sentence: String,
    },

    data(){
        return {
            // TODO change this if needed
            getCategoriesEndPoint: 'http://localhost/Shabadabada/public/wp-json/wp/v2/music-type',
            //getCategoriesEndPoint: 'http://ec2-54-211-13-201.compute-1.amazonaws.com/apo-Shabadabada/public/wp-json/wp/v2/music-type',

            getGameStartEndPoint: 'http://localhost/Shabadabada/public/wp-json/shabadabada/v1/create-game',
            //getGameStartEndPoint: 'http://ec2-54-211-13-201.compute-1.amazonaws.com/apo-Shabadabada/public/wp-json/shabadabada/v1/create-game',

            stylePopup: 'display: none',
            
        }      
                
    },



    methods: {
       
        startGameSameCategory: function(event) {
            axios.get(this.getGameStartEndPoint + '?category=' + this.category).then(response => {
                // TODO SESSION_STORAGE  becareful with the url redirection after we get the data's game back
                // DOC https://developer.mozilla.org/fr/docs/Web/API/Storage/setItem
                sessionStorage.setItem('game', JSON.stringify(response.data));
                document.location = 'http://localhost/Shabadabada/public/front/game'
                //document.location = '//apo-Shabadabada/public/front/game';
            });
        },
  
        //  STEP $emit step 2 : this function fires this.$emit. Emit simply send a signal 'closePopUp' (in the form of a string / first parameter) and some piece of data (here the variable 'stylePopUp' / second parameter). Sending that string notify our parent component that the component need to be updated.
        closePopUp(){
            this.$emit('displayNonePopup', 'stylePopup');   
            console.log(this.scoreSentence);
        }
    }, 
}



</script>

<style scoped lang="scss">
    @import '../scss/main.scss';

.popup {
    width:80%;
    height: 50%; // ça parait large mais c'est pour le cas où la phrase de score fait 3 lignes. 
    background-color: white;
    text-align: center;
    padding: 5%;
    border: solid 2px $color-turquoise;
    box-shadow: 6px 6px 0px $color-turquoise;

    .container {
        display: flex;
        flex-direction: column;
        align-items: stretch;
    }

    .closeCross {
        position: absolute;
        right:2%;
        top: 2%;
    }

    .header {
        font-family: "Lazer84";
        color: $color-turquoise;
        word-spacing: 0.5rem;
        text-shadow: 2px 1.5px $color-pink-f0f;
        font-size: 25px;
        
    }

    .displayScore {
        font-family: "Montserrat";
        font-weight: bold;
        font-size: 20px;
        margin-top: 1rem;
    }

    .scoreSentence {
        font-family: "Montserrat";
        font-size: 14px;
        text-align: center;
        margin: 0 0.5rem;
        margin-top: 1rem;
    }


    .replay {
        background-color: $color-yellow;
        border: none; 
        color: white;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        border-radius: 10px;
        padding: 10px 20px;
        font-family: "Lazer84";
        word-spacing: 2rem;
        letter-spacing: 0.2rem;
        text-shadow: 2px 2px black;
        box-shadow: 3px 3px 0px $color-pink-f0f;
    }

    .replay-button {
        margin-top: 2rem;
    }
}  




@include screen-large {

    .popup {

        height: 55%; 

        .header {
            font-size: 33px;
        }

        .displayScore {
            font-size: 23px;
        }

        .scoreSentence {
            font-size: 16px;
        }
    }
}



@include screen-extra-large {

    .popup {

      height: 60%;  

        .replay {
        bottom: 10%;
        left: 45%;
        }
    }
}
     
</style>