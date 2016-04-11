var Vue = require('vue');
window.$ = window.jQuery = require('jquery');
var bootstrap = require('bootstrap/dist/js/bootstrap');
//var VueResource = require('vue-resource');

//Vue.use(VueResource);



new Vue({
	name: 'Login',
  	el: '#login',

  	data: {
    	login: true,
    	register: false,
    	reset: false,
  	},

  	created: function () {
  		var type = window.location.hash.substr(1);
  		if(type) {
  			if(type == 'register'){
  				this.login = false;
    			this.register = true;
  			}
  			if(type == 'reset'){
  				this.login = false;
    			this.reset = true;
  			}
  		}
  		
  	},

  	methods: {

  		flip: function (open) {
  			//console.log(open);
  			this.login = false;
  			this.register = false;
  			this.reset = false;
  			setTimeout(function(){
  				if(open === 'login'){
  					this.login = true;
  				}
  				if(open === 'register'){
  					this.register = true;
  				}
  				if(open === 'reset'){
  					this.reset = true;
  				}
  			}.bind(this), 500);
  		}
  	}
})