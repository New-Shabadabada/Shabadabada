<template>
    <header class="header">
        <div class="main-menu">  

           <div class="logo">
            <router-link :to="{name: 'home'}">
                <img class="logoMobile" src="../images/Logo_mobile.png" />
                <!--<img class="logo" src="../images/Logo.png" />-->
            </router-link>

            <div class="logoText">
                <router-link :to="{name: 'home'}">
                    <h1>Shabadabada</h1>
                </router-link>
            </div>
            
           </div>
            <div class="main-menu__category main-menu__item">
                <router-link :to="{name: 'categoriesList'}">
                    Catégories
                </router-link>
            </div>

            <div class="main-menu__team main-menu__item">
                <router-link :to="{name: 'team'}">
                    Team
                </router-link>
            </div>

        </div>
    </header>
</template>

<script>
export default {
    name: 'shabadabada-header',
    components: {

    },  
}

</script>

<style scoped lang="scss">
@import '../scss/main.scss';

.header {

    background-color: #12013f;
    width: 100%;
    padding: $spacing-simple 0 $spacing-simple 0;
    

    .main-menu {

        display: flex;
        justify-content: space-around;  
        align-items: center;
        
    }

    .main-menu__item{

        font-family: "Lazer84";
        font-size: 18px;
        font-weight: bold;
        text-shadow: 1px 1px white;
        letter-spacing: 0.3rem;
        
    }

    .logo {

        padding-top: 0.2rem;
    }

    .logoText {

            display: none;
            padding-top: 0.2rem;
        }
    

   
}

.v-application a {

        color:$color-pink-f0f;
        text-decoration: none;
    }

    .v-application p {

        margin: unset; 
        padding: unset;
    }

@include screen-medium {

    .header {

        .logo {
            display: flex;
        }

        .logoText {  
            
            display: block;

            h1 {
                text-transform: uppercase;
                text-align: center;
                font-family: "Neoneon";
                font-size: 1.5rem;
                color: $color-turquoise;
                font-size: 2rem ;
                margin-left: 1rem;
                text-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 15px #01DCBC, 0 0 20px #01DCBC, 0 0 25px #01DCBC, 0 0 30px #01DCBC, 0 0 35px #01DCBC;
            }
        }
    }
}

@include screen-extra-large {

    .header {
        .main-menu__item {
            font-size: 1.5rem;
        }
    }
    
}



</style>