/**
 * jQuery
 */
import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;


/**
 * Bootstrap
 */
import Dropdown from 'bootstrap/js/dist/dropdown';
import Tab from 'bootstrap/js/dist/tab';
import Collapse from 'bootstrap/js/dist/collapse';
import Alert from 'bootstrap/js/dist/alert';

/**
 * Axios HTTP library
 */
import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * API Token
 */
let apiToken = document.head.querySelector('meta[name="api-token"]');

if (apiToken) {
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${apiToken.content}`;
} else {
    console.error('API token not found.');
}

/**
 * Vue
 */
import Vue from 'vue';
window.Vue = Vue;

/**
 * i18n
 */
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

/**
 * Lists
 */
import ItemListColumnHeader from './components/ItemListColumnHeader.vue';
import ItemList from './components/ItemList.vue';
import ItemListTree from './components/ItemListTree.vue';
import ItemListStatusButton from './components/ItemListStatusButton.vue';
import ItemListCheckbox from './components/ItemListCheckbox.vue';
import ItemListPositionInput from './components/ItemListPositionInput.vue';
import datapedidos from './components/BackOffice/dataPedidos.vue';


/**
 * History
 */
import History from './components/History.vue';

/**
 * Files
 */


import FileManager from './components/FileManager.vue';
import FileField from './components/FileField.vue';
import FilesField from './components/FilesField.vue';

import DataTable from 'laravel-vue-datatable';

Vue.use(DataTable);
window.EventBus = new Vue({});
import añadir_libro from './components/BackOffice/addLibro.vue';

import datapublicacionesmeli from './components/BackOffice/dataPublicacionesMELI.vue';
import datapreguntasmeli from './components/BackOffice/dataPreguntasMELI.vue';
import datapedidosmeli from './components/BackOffice/dataPedidosMELI.vue';

import modalpreguntasmeli from './components/BackOffice/modalpreguntasmeli.vue';
import dataPreguntasInternas from './components/BackOffice/dataPreguntasInternas.vue';
import preguntasResponder from './components/BackOffice/preguntasResponder.vue';

import datapromos from './components/BackOffice/dataPromos.vue';
import datapromoeditar from './components/BackOffice/dataPromoEditar.vue';


Vue.component("modalpreguntasmeli", modalpreguntasmeli);
Vue.component("datapreguntasinternas", dataPreguntasInternas);
Vue.component("preguntasResponder", preguntasResponder);
Vue.component("datapromos", datapromos);
Vue.component("datapromoeditar", datapromoeditar);



new Vue({
    i18n,
    components: {
        añadir_libro,
        ItemListColumnHeader,
        ItemList,
        ItemListTree,
        ItemListStatusButton,
        ItemListCheckbox,
        ItemListPositionInput,
        FileManager,
        FilesField,
        FileField,
        History,
        datapedidos,
        DataTable,
        datapublicacionesmeli,
        datapreguntasmeli,
        datapedidosmeli,
        datapromos,
        datapromoeditar,

    },
}).$mount('#app');




/**
 * Alertify
 */
window.alertify = require('alertify.js');

/**
 * Selectize
 */
require('selectize');

/**
 * All files in /reources/js/admin
 */
var req = require.context('./admin', true, /^(.*\.(js$))[^.]*$/im);
req.keys().forEach(function (key) {
    req(key);
});
