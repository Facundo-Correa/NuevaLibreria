/**
 * jQuery
 */
import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

// console.log("TEst");

/**
 * Bootstrap
 */
/**
import Dropdown from 'bootstrap/js/dist/dropdown';
import Collapse from 'bootstrap/js/dist/collapse';
import Alert from 'bootstrap/js/dist/alert';

/**
 * Fancybox
 *
require('@fancyapps/fancybox');

/**
 * Swiper
 *
import Swiper, { Navigation, Pagination } from 'swiper';
Swiper.use([Navigation, Pagination]);
window.Swiper = Swiper;


 * Get files from /resources/js/public

var req = require.context('./public', true, /^(.*\.(js$))[^.]*$/im);
req.keys().forEach(function (key) {
    req(key);
}); */

import Vue from 'vue';
window.Vue = Vue;


import VueI18n from 'vue-i18n';
import fr from '../lang/fr.json';
import en from '../lang/en.json';
import es from '../lang/es.json';
const messages = { fr, en, es };
//const i18n = new VueI18n({ messages });
// VUE WARNS NOS VEMOS EN EL INFIERNO.
const i18n = new VueI18n({
    messages,
    fallbackWarn: false,
    missingWarn: false,
    fallbackLocale: 'en',
    silentTranslationWarn: true
  });
/**
 * Permissions mixin
 */
import Permissions from './mixins/Permissions';
Vue.mixin(Permissions);

/**
 * Date Filter
 */
import date from './filters/Date.js';
Vue.filter('date', date);

/**
 * Datetime Filter
 */
import datetime from './filters/Datetime.js';
Vue.filter('datetime', datetime);

window.EventBus = new Vue({});


import carrito from './components/Carrito.vue';


new Vue({
    i18n,
    components: {
        carrito
    },
}).$mount('#app');

