<template>
    <div class="home">
        <div class="home__part1" :style="styleCatchline">

            <div class="home__catchline">

                <transition name="bounce1">
                    <p class="word1">wanna</p>
                </transition>

                <transition name="bounce2">
                    <p class="word2">have</p>
                </transition>

               <transition name="bounce3">
                    <p class="word3">fun ?</p>
               </transition>
                
            </div> <!--end of home__catchline-->

            <div class="button">
                <button v-on:click ="rules" class="button__click-here" type="button">Clique ici<button>   
            </div>    

        </div> <!--end of home__part1-->

        <div class="home__part2" :style="styleRules">

            <div class="home__introduction">
                <h1> Bienvenue sur Shabadabada </h1>
                <h2> Simply the best blind-test musical pour voir la vie en rose </h2>
            </div>

               
            <h3> Comment ça marche ? </h3>

            <div class="home__explanation">
            
                <div class="rules rule1">
                    <div class="number one"> 1 </div>
                        <p class="rule"> 
                            Choisis la catégorie de ton blind-test. 
                        </p>
                </div>
            
                <div class="rules rule2">
                    <div class="number two"> 2 </div>
                        <p class="rule"> 
                            Trouve l'artiste et/ou le titre des 10 extraits diffusés. 
                        </p>
                </div>
            
                <div class="rules rule3">
                    <div class="number three"> 3 </div>
                        <p class="rule">
                            Ecris ta réponse dans les 30 secondes imparties et appuie sur entrée pour valider.
                        </p>
                </div>
      
            </div> <!--end of home__explanation-->

            <div class="button">  
                <router-link :to="{name: 'categoriesList'}">
                    <button class="button__play" type="button"> Jouer <button>
                </router-link>
            </div>

        </div><!--end of home__part2-->
    </div> <!--END OF HOME-->
</template>

<script>

export default {

    name: "shabadabada-home",

    data(){

        return {
            styleCatchline:'',
            styleRules: 'display: none',
        }
    },
   
    methods: {

        rules(){
            this.styleCatchline = 'display:none';
            this.styleRules = 'display: block';
        }
    },

    
}
</script>


<style scoped lang="scss">

@import '../scss/main.scss';

// JULIEN test transition
// .word1 {
//     display: block;
//     transition: display 1s;
// }
// .bounce1-enter-active {
//   animation: bounce-in .5s;
// }

// // .bounce-leave-active {
// //   animation: bounce-in .5s reverse;
// // }
// @keyframes bounce-in {
//   0% {
//     transform: scale(0);
//   }
//   50% {
//     transform: scale(1.5);
//   }
//   100% {
//     transform: scale(1);
//   }
// }

.home__part1 {

    display: flex;
    flex-direction: column;
    max-width: 100%;
    height: 100%;

    .home__catchline {

        display: flex;
        flex-direction: column;
        color: $color-pink-f0f;
        font-family: "Lunch";
        text-transform: uppercase;
        font-size: 6rem;
        text-align: center;
        padding-top : 1.5rem;
        margin-top: $spacing-double;
    }

    .button {

        align-self: center;
    }

    .button__click-here {

        background-color: $color-yellow;
        border: none; 
        color: white;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        font-weight: bold;
        border-radius: 10px;
        padding: 5px 15px;
        margin: $spacing-double 0 $spacing-double 0;
        font-family: "Lazer84";
        word-spacing: 0.4rem;
        letter-spacing: 0.2rem;
        text-shadow: 2px 2px black;
        box-shadow: 3px 3px 0px white;
        outline: none;

    }
}

.home__part2 {

    .home__introduction {
        
        text-align: center;

        h1 {

            font-family: "Lazer84";
            color: $color-turquoise;
            font-size: 2.5rem;
            word-spacing: 1.5rem;
            text-shadow: 2px 1.5px $color-pink-f0f;
            padding-top: 1rem;
            letter-spacing: 0.1rem;
        }


        h2 {

            font-family: "Montserrat";
            font-size: 20px;
            color: white;
            text-align: center;
            margin: 1rem 3rem 0rem 3rem;
        }
    }

    h3 {

        align-items: flex-start;
        font-family: "Lazer84";
        color : $color-yellow;
        font-size: 23px;
        padding-left: 1rem;
        word-spacing: 0.5rem;
        text-shadow: 2px 1.5px $color-pink-f0f;
        margin-top: 4rem;
        //margin-left: 1rem;
    }   

    .home__explanation {

        display : flex;
        flex-direction: column;
        color: white;
        font-family: "Montserrat";
        max-width: 100%;
        margin-top: 0.5rem;

        .number,
        .rule {

            height: 100%;
        }

        .rules {

            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            width: 100%;
            margin-top: 2rem;
            padding-right: 3rem;

            .number {

                //display: block;
                width: 10%;            
                text-align: center;
                background-color: $color-yellow;
                border-radius: 50%;
                color : white;
                font-weight: bold;
                font-size: 1.5rem;
                padding-bottom : 2.2rem;
                margin-left: 1rem;
                font-family: "Lazer84";
                max-width : 2rem;
                max-height : 2rem;
                text-shadow: 2px 1.5px $color-pink-f0f;
            }

            .rule {

                margin-left: 1rem;
                width: 80%;
                //text-align: justify;
                font-size: 20px;   
            }
        }
    }

    .button {

       text-align: center;
    }

    .button__play {

        background-color: $color-yellow;
        border: none; 
        color: white;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        border-radius: 10px;
        padding: 5px 15px;
        margin: $spacing-double 0 $spacing-double 0;
        font-family: "Lazer84";
        letter-spacing: 0.2rem;
        text-shadow: 2px 2px black;
        box-shadow: 3px 3px 0px white;
        outline: none;

    }

}
.v-application p {

    margin-bottom: 0px;
}

// ========= MIXINS / RESPONSIVE ========= 

@include screen-small {
    .home__part2 h3 {
        margin-left: 0;
    }
}
@include screen-medium{

    .home {
        margin-top: $spacing-simple;
    }

    .home__catchline {

        margin: 0 5rem 0 5rem;

        .word1 {

            align-self: start;
        }

        .word2 {

            align-self: center;
            margin-left: $spacing-double;
        }   

        .word3 {

            align-self: flex-end;
        }
    }

    .home__part2 {


        .home__introduction h1 {

            font-size: 4rem;  
            padding-top: 1rem; 
        }

        .home__introduction h2 {

            font-size: 1.5rem;
            color: white;
            text-align: center;
            margin: 0rem 3rem 0rem 3rem;
            padding: 1rem 7rem 0 7rem;
        }

        h3 {
            margin: 3rem 0 2rem 0;
            text-align: center;
            font-size: 2rem;
        }

        h3,
        .home__explanation {
            padding: 0 5rem 0 5rem;
        }

        .home__explanation {
            font-size: 1.2rem;
        }

        .home__explanation .rules .number {
            width: 15%;
        }

        .button {
            margin-top: 3rem;
        }

       
    }

    

} // end of screen-medium
   
   
@include screen-large{

    .home__catchline {

        line-height: 10rem;

        .word1,
        .word2,
        .word3 {
           font-size: 8rem; 
        }
        
    }

    .home__part2 {

        h3 {
            margin-top: 6rem;
            text-align: center;
        }

        .rule1,
        .rule2 {

            padding-right : 1rem;
            //border-right: 1px solid $color-yellow;
            //height : 10rem;
        }

    }

}// end of screen-large


@include screen-extra-large{

    .home__part1 {

        .home__catchline {

            font-size: 8rem;
            margin: 0 10rem 0 10rem;

            .word1,
            .word2,
            .word3 {
            font-size: 10rem; 
            }

            

        }
        .button .button__click-here {

            padding: 10px 20px;
            margin: 4.8rem 0 $spacing-simple 0;
            font-size: 1.5rem;
        }

    }

    .home__part2 {
        .home__explanation {

            flex-direction: row;
            align-items: flex-start;

            .rules {
                padding: 0 3rem 0 3rem;

                .rule {
                    font-size: 1.5rem;
                }
                

            }
        }

        h3,
        .home__explanation {
            padding: 0 10rem 0 10rem;
        }

        h3 {
            font-size: 2.5rem;
        }

        .button .button__play {
            padding: 10px 20px;
            margin: 0.5rem 0 $spacing-half 0;
            font-size: 1.5rem;
        }
    }
   
}// end of screen-extra-large


</style>