import Vue from "vue";
import VacanciesPage from "./components/VacanciesPage";
import Modal from "./directives/Modal";

require('./bootstrap');

//Filters
require('./filters/Currency');

//Directives
Vue.directive('modal', Modal);

new Vue({
    el: '#app',
    components: {
        VacanciesPage,
    },
    data() {
        return {
            modals: []
        }
    },
});
