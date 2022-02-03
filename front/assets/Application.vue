<template>
    <!-- IMPORTANT  to use vuetify, the application must be encapsuled in a v-app balise //-->
    <v-app>
        <main>

            <shabadabada-header></shabadabada-header>

            <section class="background">
                <router-view></router-view>
            </section>

            <shabadabada-footer></shabadabada-footer>

        </main>
    </v-app>
</template>


<script>

//=========== import components =============
import Header from './components/Header';
import Footer from './components/Footer';


// =========== import views =============
import CategoriesList from './views/CategoriesList';
import Error404 from './views/Error404';
import Game from './views/Game';
import Home from './views/Home';
import Team from './views/Team';


export default {
    name: "application",
    components: {
        'shabadabada-header': Header,
        'shabadabada-footer': Footer,
        'shabadabada-category': CategoriesList,
        'shabadabada-error404': Error404,
        'shabadabada-game': Game,
        'shabadabada-home': Home,
        'shabadabada-team': Team,
    },
};

</script>

<style scoped lang="scss">
@import './scss/main.scss';

.background {
    margin: 0 auto;
    background-image: url("./images/background-long.jpg");
    background-size: cover;
    background-attachment: fixed;
    width: 100%;
}

main {
    min-height: 100vh;
    width: 100%;
    display: flex;
    flex-direction: column;
    margin: auto;

    section {
        flex-grow:1;
    }

    shabadabada-footer {
        align-self: flex-end;
    }
}

</style>