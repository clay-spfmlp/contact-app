var Vue = require('vue');
window.$ = window.jQuery = require('jquery');
var bootstrap = require('bootstrap/dist/js/bootstrap');
var VueResource = require('vue-resource');
//var VueValidator = require('vue-validator');

Vue.use(VueResource);
//Vue.use(VueValidator);

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

import { focusModel } from 'vue-focus';

new Vue({
	name: 'Equilibrium',

  	el: '#equilibrium',

  	data: {
  		equilibriumInput: '',
  		equilibriumFocus: true,
    	equilibriums: [
    		{number: -7}, 
    		{number: 1}, 
    		{number: 5}, 
    		{number: 2}, 
    		{number: -4}, 
    		{number: 3}, 
    		{number: 0},
    	],
    	equilibriumArray: [],
    	equilibriumResult: [],
  	},

  	directives: { focusModel: focusModel },

  	created: function () {
  		this.equilibriumParse();
  	},

  	methods: {
  		addToArray: function (num) {
  			if(this.equilibriumInput) this.equilibriums.push({number: num});
  			this.equilibriumInput = '';
  			this.equilibriumParse();
  			this.equilibriumFocus = true;
  		},

  		remove: function (index) {
  			this.equilibriums.splice(index, 1);
  			this.equilibriumParse();
  			this.equilibriumFocus = true;
  		},

  		getEquilibriumIndex: function () {
  			this.equilibriumParse();
  			this.$http.post('equilibrium-indexs', {equilibrium: this.equilibriumArray})
  			.then(function(response){
				this.equilibriumResult = response.data;
			}.bind(this));
			this.equilibriumFocus = true;
  		},

  		equilibriumParse: function () {
  			this.equilibriumArray = [];
  			for (var i in this.equilibriums) {
  				this.equilibriumArray.push(parseInt(this.equilibriums[i].number));
  			}
  		}
  	}
})