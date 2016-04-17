var Vue = require('vue');
window.$ = window.jQuery = require('jquery');
var bootstrap = require('bootstrap/dist/js/bootstrap');
var VueResource = require('vue-resource');

Vue.use(VueResource);



Vue.filter('count', function (list) {
    "use strict";
    return list.length;
})

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

Vue.config.debug = true;

import { focusModel } from 'vue-focus';

import MessageBox from 'vue-msgbox';

new Vue({

  	name: 'Contact',

  	components: {
    	ContactForm: require('./components/ContactForm.vue'),
    	EditableList: require('./components/EditableList.vue'),
    	SortableTable: require('./components/SortableTable.vue')
  	},

  	directives: { focusModel: focusModel },

  	el: '#app-contacts',

  	data: {
    	user: Auth.user,
    	contacts: [],
    	labels: [],
    	searchQuery: '',
    	search: false,
    	columns: ['name', 'email', 'phone'],
    	sortOrders: {'name':1, 'phone':1, 'email':1},
    	sideBar: true,
    	checkIds: [],

    	newContact: false,
    	editContact: false,
  	},

	created: function () {
    	this.getContacts();
    	this.getLabels();
  	},

  	methods: {

	    openNewContact: function () {
	      	this.editContact = false;
	      	this.newContact = true;
	      	this.$broadcast('clear-contact');
	    },

	    getContacts: function () {
	      	var resource = this.$resource('user/'+this.user.id+'/contacts');
	      	resource.get({}).then(function(response){
	        	this.contacts = response.data;
	      	}.bind(this));
	    },

	    getLabels: function () {
	      	var resource = this.$resource('user/'+this.user.id+'/labels');
	      	resource.get({}).then(function(response){
	        	this.labels = response.data;
	      	}.bind(this));
	    },

	    deleteContacts: function () {
	    	//this.$dispatch('request-checked');

	    	MessageBox.confirm('Are you sure?', 'Delete Contacts',{
	    		confirmButtonText: 'Confirm',
	    		cancelButtonText: 'Cancel'
	    	}).then(function(action) {
	    		
	    		for(var i in this.checkIds){
		    		//var resource = this.$resource('contact/'+ this.checkIds[i]);
			      	this.$http.post('contact/'+ this.checkIds[i], {_method: 'DELETE'}).then(function(response){
			        	//this.contacts = response.data;
			        	console.log(response.data);
			      	}.bind(this));
	    		}

	    		this.getContacts();
	    		this.getLabels();
	    		this.checkIds = [];

				console.log(this.checkIds);
			}.bind(this));
	    	
	    },

	    addLabelToChecked: function (id) {
	      	console.log(id);
	      	console.log(this.$children);
	    }
  	},

  	events: {

    	'edit-contact': function (contact, index) {
        	this.newContact = false;
        	this.editContact = true;
        	this.$broadcast('set-edit-contact', contact, index);
    	},

	    'clear-checked-contacts': function () {
	      	this.$broadcast('reset-checked-contacts');
	    },

	    'set-check-contact': function (id) {
	      	this.$broadcast('check-contact', id);
	    },
	    'request-checked': function () {
	    	console.log('request-checked');
	    	this.$broadcast('send-checked');
	    },
	    'set-check-id': function (ids) {
	    	console.log('set-check-id');
	    	this.checkIds = ids;
	    }
  	}

})