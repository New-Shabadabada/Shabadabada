<template>
    <div class="cardCategory" @click="startGame">
        <a>
            <div 
                class="icon" 
                @mouseover="mouseOver" 
                @mouseleave="mouseLeave"
            >
                <v-hover><img :src="icon" :style="imgPlay"></v-hover>
                <img :src="category.description" :style="imgCategory">
            
            </div>
            <div class="name">

                <span>{{category.name}}</span>

            </div>
        </a>     
    </div>
    
</template>
<script>
import axios from "axios";
export default {
    name: "shabadabada-category",
    data: function() {
        return {
            // TODO change this if needed
            getGameStartEndPoint: 'http://localhost/Shabadabada/public/wp-json/shabadabada/v1/create-game',
            //getGameStartEndPoint: 'http://' + document.location.host + '/apo-Shabadabada/public/wp-json/shabadabada/v1/create-game',
            // getGameStartEndPoint: './apo-Shabadabada/public/wp-json/shabadabada/v1/create-game',
            imgPlay : 'display: none',
            imgCategory : '',
            icon : require('../images/play5.png')

           
        }
    },
    props: {
        category: {
            type: Object,
        },

        
    },

    methods: {
        startGame: function(event) {
            axios.get(this.getGameStartEndPoint + '?category=' + this.category.slug).then(response => {
                // TODO SESSION_STORAGE  attention aux url de redirection après avoir récupéré les data d'une game
                // DOC https://developer.mozilla.org/fr/docs/Web/API/Storage/setItem
                sessionStorage.setItem('game', JSON.stringify(response.data));
                document.location = 'http://localhost/Shabadabada/public/front/game'
                //document.location = 'http://' + document.location.host + '/apo-Shabadabada/public/front/game';
                //console.log('go');
                
            });
        },
        mouseOver: function(){

            this.imgPlay = 'display : block';
            this.imgCategory = 'display : none';
        },

        mouseLeave: function(){

            this.imgPlay = 'display : none';
            this.imgCategory = 'display : block';
        }

    }
      
}


</script>

<style scoped lang="scss">
    @import '../scss/main.scss';
        a{
        display: flex; 
        text-decoration: none;
        align-items:center;
        justify-content :center;
        flex-wrap: wrap;
    }
    .cardCategory {

        display: flex;
        justify-content :center;
        align-items:center;
        background-color: $color-pink-f0f;
        box-shadow: 4px 2px 2px 0px $color-turquoise;
        border-radius: 15%;
        padding : 0rem;
        width: 10rem;
        height: 10rem;

        .icon {
            display: flex;
            background-color: white;
            //align-self : start;
            justify-content :center;
            align-items: center;
            border-radius: 50%;
            margin-top: 1.3rem;
            margin-bottom: 0.8rem;
            //padding: 2.5rem;
            width: 7rem;
            height: 7rem;
            :hover{
                transition: 0.5s;
                //box-shadow: 1px 1px 1px rgb(160, 156, 156);
                //background-color: white;
                //border-radius: 50%;
                transform: scale(1.1);
                //transform: scale(0.5);
            }
            

            img{
                width: 4rem;
                height: 4rem
            }
        }
   
        .name {

            // Pas besoin de flex ici - AF
            //display : flex;
            //margin-top: 0.4rem;
            //align-items: center;
            margin-bottom: 1.3rem;
            font-size: 1rem;
            text-align: center;
            font-family: "Lazer84";
            width: 8rem;
            //font-family: "Montserrat";
            letter-spacing: 0.1rem;
            text-shadow: 2px 1.5px black;

                
            span {

                min-width: 100%;
                color: white;
                text-align: center;
                }
        }

    }
</style>