<template>

    <footer> 

        <div class="footer">

            <div class="text-footer">
                <p> Ce site est fait avec <i class="fas fa-heart"></i> </p> 
            </div>

            <div class="copyright-footer">

                <p class="copyright-oz">
                    Copyright <i class="far fa-copyright"></i> 2021 - Promo Oz 
                </p> 
                
                <p class="copyright-icons">
                    Icons by<a href="https://icons8.com/icon/"> Icons8</a> and <a href="https://seeklogo.com/">seeklogo</a>
                </p>
                
                <p class="copyright-bg">
                    Fond vecteur créé par rawpixel.com - <a href="https://fr.freepik.com/vecteurs/fond"> fr.freepik.com</a>
                </p>

            </div>

        </div>

    </footer>

</template>

<script>

export default {

    name: 'shabadabada-footer', 
}

</script>

<style scoped lang="scss">

@import '../scss/main.scss';

footer {

    width: 100%;
    background-color: #12013f;
    color: $color-turquoise;
    text-align: center; 
    font-family: "Montserrat";
    font-size: 0.8rem;
    padding: 0.5rem;
}

.text-footer {

    font-size: 0.9rem;
    color: $color-pink-f0f;
    font-family: "Lazer84";
    word-spacing: 0.3rem;
}


.copyright-footer {

    display: flex;
    justify-content: space-around;
    align-items: center;

    .copyright-oz,
    .copyright-icons,
    .copyright-bg {

        width: 100%;
    }

    .copyright-bg {

        margin-left: $spacing-simple;
    }


    .copyright-oz,
    .copyright-icons {

        border-right: 1px solid $color-turquoise;
        padding-right: $spacing-simple;
        padding-left: $spacing-simple;
    }

    a {
        color: $color-turquoise;
    }

}
.copyright-footer p {

    margin: unset;
}

@include screen-large {

    .copyright-footer {

       justify-content: center; 
    }
}

</style>