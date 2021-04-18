console.log('%c' + "Main.js loaded", 'color: #0bf; font-size: 1rem; background-color:#fff');

import 'reset-css';
import '@fortawesome/fontawesome-free/css/all.css'
import "./scss/main";
import "./javascript/carrousel";

// IMPORTANT for async function ! if not imported impossible to use a async function/method
import 'regenerator-runtime/runtime'


// ==============  vuejs import ============== 
import Vue from 'vue';
import Application from "./Application.vue";

// ==============  vuetify import ============== 
// Vuetify import (framemework vuetify)
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.css'
import '@mdi/font/css/materialdesignicons.min.css'






// Vuetify configuration with vuejs 
Vue.use(Vuetify)
const opts = {}
const vuetifyInstance = new Vuetify(opts)


// ============== routerjs application ============== 
import router from './router';


// ============== vuejs application ============== 

let shabadabada = new Vue({
    // DOM element (selector) to display the application
    el: '#app', 
    
    // inject Vuetify  ...
    vuetify: vuetifyInstance,

    // inject a Application object in the #app container
    render: createApplication => createApplication(Application),

    // inject router
    router,
})

