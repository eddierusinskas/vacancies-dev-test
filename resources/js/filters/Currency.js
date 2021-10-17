import Vue from "vue";

Vue.filter('currency', function (value, symbol) {
    symbol = symbol || "$";

    return symbol + parseFloat(value).toFixed(2)
                                     .replace(/\d(?=(\d{3})+\.)/g, '$&,');
});
