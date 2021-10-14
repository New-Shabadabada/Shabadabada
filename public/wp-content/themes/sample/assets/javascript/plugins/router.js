// STEP Routing ne pas oublier de charger vuejs
import Vue from 'vue';

// STEP Routing chargement de la bibliothèque router de vuejs
import VueRouter from 'vue-router';


// STEP Routing  configuration de vuejs pour utiliser le router
Vue.use(VueRouter);


// STEP Routing Création (configuration du routeur en fonction de nos besoins)
const router = new VueRouter({
  mode: 'history',
  // base: configuration.getBaseURI(),
  routes: [
    /*
    {
      name: 'home', // nom de la route
      path: '/',  // url à matcher
      component: ArticlesList // le "controller" a executer si route validée
    },

    {
      name: 'recipe-create',
      path: '/recipe-create',
      component: CreateRecipeForm,

      // TIPS pseudo hook/event qui permet de lancer des traintement avant que la route ne s'execute
      // WARNING on ne peut pas utiliser this dans beforeEnter
      // to, page de destination, from, page d'où l'on vient, next fonction permettant de laisser la route faire son traitement normal
      async beforeEnter(to, from, next) {
        console.log('%c' + "Before enter recipe create " + to, 'color: #b0f; font-size: 1rem; background-color:#fff');

        const userLogged = await userService.isLogged();
        // si l'utilisateur est connecté, on fait le traitement par défaut
        if(userLogged) {
          next(); // continue de "rediriger" le visiteur vers le "to"
        }
        else {
          router.push({
            name: 'signin',
            query: {
              redirect: 'recipe-create'
            }
          });
        }
      }
    },
    */
  ]
});

export default router;
