// import de vuejs
import Vue from 'vue';
// si soucis aec vuejs utiliser cette directive (version "packagé" de vuejs)
// import Vue from 'vue/dist/vue.js';

// import de vuetify ; framework de composants d'affichage vuejs
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.css'
import '@mdi/font/css/materialdesignicons.min.css'

// STEP configuration de vutify avec vuejs ; pas besoin de modifier ce code
Vue.use(Vuetify)
const opts = {}
const vuetifyInstance = new Vuetify(opts);

export default vuetifyInstance;