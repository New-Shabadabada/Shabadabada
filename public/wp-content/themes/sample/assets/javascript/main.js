console.log('%c' + 'Fichier main.js chargé', 'color: #0bf; font-size: 1rem; background-color:#fff');


// import 'reset-css';

// installation de font awesome
import '@fortawesome/fontawesome-free/css/all.css';


import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.css' // Import precompiled Bootstrap css


// import de vuejs
import Vue from 'vue';


// ==========================================================
import router from './plugins/router';

// inclusion de la configuration de vuetify
import vuetifyInstance from './plugins/vuetify';


// inclusion de la configuration de vuex
import store from './plugins/vuex';
// ==========================================================

import Application from "./Application";
import Application2 from "./Application2";

import '../scss/main.scss';



// création de l'application vuejs
// c'est "un peu " comme un main controller
let application = new Vue({
  // élément du dom (via selecteur) dans lequel l'application va s'afficher
  el: '#vuejs-container',

  // STEP injection des plugins
  router,
  store,
  vuetify: vuetifyInstance,

  // TIPS on injecte un objet Application dans le container #vuejs-container
  render: createApplication => createApplication(Application),
  // on "injecte" les composant dont l'application va avoir besoin
});


// Vue.config.runtimeCompiler = true;
// création de l'application vuejs
// c'est "un peu " comme un main controller
let application2 = new Vue({
  // élément du dom (via selecteur) dans lequel l'application va s'afficher
  el: '#vuejs-container-2',

  // STEP injection des plugins
  router,
  store,
  vuetify: vuetifyInstance,
  render: createApplication => createApplication(Application2),
});

