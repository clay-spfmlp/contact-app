var Vue = require('vue');
window.$ = window.jQuery = require('jquery');
var bootstrap = require('bootstrap/dist/js/bootstrap');
var VueResource = require('vue-resource');

Vue.use(VueResource);

new Vue({

	name: 'Home',

	el: '#home',

	data: {
		name: [
			{letter: 'C', show: false},
			{letter: 'l', show: false},
			{letter: 'a', show: false},
			{letter: 'y', show: false},
			{letter: ' ', show: false},
			{letter: 'M', show: false},
			{letter: 'a', show: false},
			{letter: 'l', show: false},
			{letter: 'v', show: false},
			{letter: 'e', show: false},
			{letter: 'n', show: false},
		]

	},

  	created: function () {
  		setTimeout(function(){ this.setName(); }.bind(this), 3000);
  		
  	},

	methods: {
		setName: function () {
			
		for (var i = 0; i <= this.name.length; i++) {
		    setTimeout(function(x) {
		     return function() {
		     	this.name[x].show = true;
		      	console.log(x); 
		  	}; 
		  }(i).bind(this), 600*i);
		    // 1 2 3 4 5
		}

			// var i;
			// for(i in this.name) {


			// 	(function(i) {
			// 	        setTimeout(function(){
			// 	            console.log(i);
			// 	            this.name[i].show = true;
			// 	        }, 1000);
			// 	    }(i));
			// }

		},

	}

});