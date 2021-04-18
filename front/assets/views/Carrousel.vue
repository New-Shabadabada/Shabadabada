<template>

<div class="wrapper">
    <h1>Notre Dream Team</h1>

        <div class="container-carrousel" >

            <div class="items"><!--v-for="info in infos" :key="info.id"-->

                <div class="person first" data-slide-number="0">
                    <div class="image">
                        <img src=""/><!--:src="info.photo"-->
                    </div>

                    <div class="text">
                        <p>Amandine</p><!--{{info.firstname}}-->
                        <p>Git Master et Lead Dev Front</p><!--{{info.role}}-->
                        <p>Viser la lune ça me fait pas peur</p><!--{{info.mantra}}-->
                    </div>
                </div><!-- end of first person-->

                  
                <div class="person second"  data-slide-number="1">
                    <div class="image">
                        <img src=""/><!--:src="info.photo"-->
                    </div>

                    <div class="text">
                        <p>Amandine</p><!--{{info.firstname}}-->
                        <p>Git Master et Lead Dev Front</p><!--{{info.role}}-->
                        <p>Viser la lune ça me fait pas peur</p><!--{{info.mantra}}-->
                    </div>

                </div><!-- end of second person-->


                <div class="person third" data-slide-number="2">
                    <div class="image">
                        <img src=""/><!--:src="info.photo"-->
                    </div>

                    <div class="text">
                        <p>Amandine</p><!--{{info.firstname}}-->
                        <p>Git Master et Lead Dev Front</p><!--{{info.role}}-->
                        <p>Viser la lune ça me fait pas peur</p><!--{{info.mantra}}-->
                    </div>

                </div><!-- end of third person-->

                 <div class="carousel__nav__button">
                    <div class="previous-button"> 
                        <i class="fas fa-chevron-left circle">
                    </div>

                    <div class="next-button">
                        <i class="fas fa-chevron-right circle">
                    </div>
                </div><!-- carousel__nav__button-->

            </div><!-- enf of items-->
        </div><!-- enf of container-carrousel-->
</div><!-- enf of wrapper-->


</template>

<script>
import Popup from '../components/Popup';

export default {
    name : "shabadabada-carrousel",
    components: {
    },

    data(){
        return {
            infos: [
                {
                    id:0,
                    firstname: 'Amandine',
                    role: 'Git Master & Lead Dev Front',
                    mantra : 'Viser la lune ça me fait pas peur',
                    //photo: '../images/amandine_picture_profile.jpg'
                },
                {
                    id:1,
                    firstname: 'JD',
                    role: 'Scrum Master & Lead Dev Back',
                    mantra : 'Il jouait du piano debout',
                    //photo: '../images/jd_picture_profile.jpg'
                },
                {
                    id:2,
                    firstname: 'Solène',
                    role: 'Product Owner',
                    mantra : 'Elle a les yeux revolver',
                    //photo: '../images/solene_picture_profile.jpg'
                },
            ]
        };
    },

    methods :
    {

    }
}
</script>

<style scoped lang="scss">
@import '../scss/main.scss';


h1 {
    color: $color-turquoise;
    font-size: 2rem;
    font-weight: bold;
    text-align: center;
    font-family: "Kanit";
    padding-top: 3rem;
}

.items{
    position: relative;
    height: 100vh;
    //background-color: yellow;
}
.image {
    position: absolute; /* postulat de départ */
    top: 50%; left: 50%; /* à 50%/50% du parent référent */
    transform: translate(-50%, -50%); /* décalage de 50% de sa propre taille */
}
.text {
    position: absolute;
    top: 50%;
    width: 100%;
    text-align: center;
    font-weight: bold;
    color: yellowgreen;
}

.previous-button {
    position: absolute;
    width: 100%;
    top: 50px;
    left: 33px;
    margin-top: 15rem;
}

.next-button {
    position: absolute;
    top: 50px;
    right: 33px;
    margin-top: 15rem;
}

.circle {
    border-radius: 50%;
    width: 30px;
    height: 30px;
    text-align: center;
    vertical-align: middle;
    padding-top: 6px;
    background:grey;
}

</style>
