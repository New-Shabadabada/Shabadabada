// import de vuejs
import Vue from 'vue';


import Vuex from 'vuex';

Vue.use(Vuex);

console.log('%c' + 'STORE LOADED', 'color: #0aa; font-size: 1rem; background-color:#fff');

// STEP instanciation d'un object Vuex qui va nous permettre de stocker des variables qui pourront être entres différents composants Vue
const store = new Vuex.Store({

  // WARNING ne fonctionne pas pour le moment
  created: function() {
    console.log('%c' + 'STORE CREATED', 'color: #0aa; font-size: 1rem; background-color:#fff');
  },

  // stocke les données partageable avec entres les composants
  state: {

  },

  // "setters" pour modifier le state du store
  mutations: {
    saveUser(state, user) {
      console.log('%c' + 'Stockage du user', 'color: #0bf; font-size: 1rem; background-color:#fff');
    },

    initialize(state, services) {
      console.log('%c' + 'Initialisation du store', 'color: #0bf; font-size: 1rem; background-color:#fff');
    }
  }
});

export default store;
