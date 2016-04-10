var Vue = require('vue');
window.$ = window.jQuery = require('jquery');
var bootstrap = require('bootstrap/dist/js/bootstrap');
var VueResource = require('vue-resource');

Vue.use(VueResource);



new Vue({
  el: '#app-layout',

  data: {
    zipCode: '',
    loadingTheathers: false,
    theaters: {},
    showID: ''
  },

  methods: {
    getTheaters: function() {
      this.loadingTheathers = true
      var resource = this.$resource('/theater/'+this.zipCode)
      resource.get({}).then(function(response){
        this.theaters = response.data
        this.loadingTheathers = false
        console.log(response)
      }.bind(this))
    },

    show: function(id) {
      console.log(id)
      this.showID = id
    }
  }
})