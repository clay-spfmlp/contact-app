var Vue = require('vue');
window.$ = window.jQuery = require('jquery');
var bootstrap = require('bootstrap/dist/js/bootstrap');
var VueResource = require('vue-resource');

Vue.use(VueResource);

import { focusModel } from 'vue-focus';

Vue.config.debug = true;

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

new Vue({

	name: 'Permission',

  	el: '#permission',

  	directives: { focusModel: focusModel },

  	data: {
    	permissions: [],
    	permissionsGroup: [],
    	roles: [],
    	checkedIds: [],
    	createPermission: {
    		permission: '',
    		models: '',	
    		show: false,
    		focus: false,
    	},
    	createRole: {
    		role: '',	
    		show: false,
    		focus: false,
    	},
    	models: {},
    	modelArray: [],
       	colspan: '',
  	},

	created: function () {
    	this.getPermissions();
    	this.getRoles();
    	this.getModels();
  	},

  	methods: {

  		getPermissions: function () {
	      	var resource = this.$resource('permissions');
	      	resource.get({}).then(function(response){
	        	this.permissionsGroup = response.data;
	        	var key;
	        	for(key in response.data){
	        		this.modelArray.push(key);
	        	}
	      	}.bind(this));
  		},

  		getRoles: function () {
	      	var resource = this.$resource('roles');
	      	resource.get({}).then(function(response){
	        	this.roles = response.data;
	        	this.colspan = response.data.length + 1;
	      	}.bind(this));
  		},

  		getModels: function () {
  			var resource = this.$resource('model-details');
	      	resource.get({}).then(function(response){
	        	this.models = response.data;
	      	}.bind(this));
  		},

  		checked: function (roles, id) {
  			var i;
  			for(i in roles){
  				if(roles[i].id === id) return true;
  			}
  		},

  		toggleCheck: function (pid, rid) {

  			setTimeout(function(){
	  			this.$http.post('update-role', {ids: this.checkedIds}).then(function(response){
	  				if(response.data === 'true'){
	  					//alert('true');
	  				}
	  			});
	  		}.bind(this), 200);
  		},

  		addPermission: function () {

  			this.$http.post('permission', {
  					name: this.createPermission.permission, 
  					model: this.createPermission.model
  				}).then(function(response){
					this.modelArray = [];
					this.createPermission.show = false;
					this.createPermission.permission = '';
					this.createPermission.model = '';
					this.permissionsGroup = this.getPermissions();
	  		}.bind(this));
  		},

  		newPermission: function () {
  			this.createRole.show = false;
  			this.createPermission.show = !this.createPermission.show;
  			this.createPermission.focus = true;
  		},

  		newRole: function () {
  			this.createPermission.show = false;
  			this.createRole.show = !this.createRole.show;
  			this.createRole.focus = true;
  		},

  		addRole: function () {
  			this.$http.post('role', {
  					name: this.createRole.role, 
  				}).then(function(response){
					this.createRole.show = false;
					this.createRole.role = '';
					this.roles = this.getRoles();
	  		}.bind(this));
  		},

  		editPermission: function (permission) {
  			this.$http.post('permission/' + permission.id, {
  					name: permission.name, 
  					model: permission.model,
  					_method: 'PUT'
  				}).then(function(response){
					this.modelArray = [];
					this.permissionsGroup = this.getPermissions();
	  		}.bind(this));
  		}
  	}
})















