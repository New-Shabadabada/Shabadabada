<template>
     <section >
         <h1 class="titlePage">Choisis une catégorie</h1>
         <div class="all">

            <div class="cards" v-for="category in categories" :key="category.id">
                <card-category :category="category"><card-category>   
            </div>
            
        </div>
     </section>
     
</template>
<script>
import cardCategory from "../components/cardCategory";
import axios from "axios";
export default {
    name: "shabadabada-category",
    data: function() {
        return {
            // TODO getCategoriesEndPoint change this, if needed
            getCategoriesEndPoint: 'http://localhost/Shabadabada/public/wp-json/wp/v2/music-type',
            //getCategoriesEndPoint: 'http://ec2-54-211-13-201.compute-1.amazonaws.com/apo-Shabadabada/public/wp-json/wp/v2/music-type',
            categories: []
        }
    },
    

    created: function() {
        axios.get(this.getCategoriesEndPoint).then(response => {
            this.categories = response.data;
            
        });
    },



    components: {
        cardCategory
    }




}


</script>

<style scoped lang="scss">
    @import '../scss/main.scss';
    section{

        display : flex;
        // voir pour un flex direction column plutôt que flex-wrap
        //flex-direction: column;
        flex-wrap: wrap;  
        justify-content: center;
        align-content: center;
        min-width: 100%;
        //min-height: 100vh;
        margin-top: $spacing-medium;
        

        h1{
            font-family: "Lazer84";
            color: $color-turquoise;
            font-size: 2.5rem;
            word-spacing: 1rem;
            letter-spacing: 0.4rem;
            line-height: 2.5rem;
            text-shadow: 2px 1.5px $color-pink-f0f;
            padding-top: 1rem;
        }

    }
        .all{
        display: flex;
        box-sizing: border-box;
        flex-direction: column;
        align-content: center;
        align-items: center;
        flex-wrap: wrap;
        max-width: 80%;
        //max-height: 100%;
        .cards{
            width: 100%;
            justify-content: center;
            align-content: center;
        }
    }
    
    .titlePage{
            font-size : 2rem;
            color: $color-turquoise;
            font-weight: bold;
            text-align: center;
            padding: 0rem 2rem 2rem 2rem;
            min-width: 100%;
            width: 100%;
        }
    .cards :hover{
        transition: all 1s;
       
    }

    @include screen-small{
        .all{
        height: 50rem;
        //max-width: 100%;
        //max-height: 20%;
        }
        h1{
            max-width: 80%;
            padding : 0;
            margin: 0;
        }
        .cards{
            justify-content: center;
            align-content: center;
            padding: 0.7rem 0.9rem 0.7rem 0.9rem;
        }
        } 
    
    @include screen-medium{
        .all{
        height: 50rem;
        max-width: 100%;
        max-height: 100%;
        }
        h1{
            max-width: 80%;
            padding : 0;
            margin: 0;
        }
        .cards{
            padding: 2rem 2rem 2rem 2rem;
        }
    }
    @include screen-large{
        .all{
        height: 40rem;
            .cards{
                padding: 3rem;
            }

        }
        
        
        }
</style>