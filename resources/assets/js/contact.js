var Vue = require('vue')
window.$ = window.jQuery = require('jquery')
var bootstrap = require('bootstrap/dist/js/bootstrap')
var VueResource = require('vue-resource')

Vue.use(VueResource)

Vue.filter('count', function (list) {
    return list.length
})

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value')

import { focusModel } from 'vue-focus'

new Vue({

  name: 'Contact',

  directives: { focusModel: focusModel },

  components: {
    ContactForm: require('./components/ContactForm.vue') 
  },

  el: '#app-contacts',

  data: {
    user: Auth.user,
    contacts: {},
    labels: {},
    label: '',
    newLabel: false,
    searchQuery: '',
    search: false,
    sortKey: '',
    columns: ['name', 'phone', 'email'],
    sortOrders: {'name':1, 'phone':1, 'email':1},
    oldInput: '',
    sideBar: true,
    newContact: false,
    Contact: {
      name: '',
      phone: '',
      email: '',
      birthday: '', 
    }

  },

  created: function () {
    this.getContacts()
    this.getLabels()
  },

  methods: {

    sortBy: function (key) {
      this.sortKey = key
      this.sortOrders[key] = this.sortOrders[key] * -1
    },

    createLabel: function (label) {
      this.$http.post('label', {name:label, user_id: this.user.id, _method:'POST'}).then(function(response){
        this.labels.push(response.data)
        this.newLabel = false
        this.label = ''
      }.bind(this))
    },

    editLabel: function (i) {
      var labels = this.labels
      this.setOldInput(labels[i].name)
      labels.forEach(function(label){
        label.editing = false
        labels[i].editing = true
      })

      labels.forEach(function(label){
        label.remove = false
      })
    },

    closeLabel: function (i) {
      console.log(this.labels[i].name)
      this.labels[i].name = this.oldInput
      this.oldInput = ''
      this.labels[i].editing = false;
    },

    removeConfirm: function (i) {
      var labels = this.labels
      labels.forEach(function(label){
        label.remove = false
        labels[i].remove = true
      })
    },

    removeLabel: function (i) {

      var label = this.labels[i]
      label.updating = true
      this.$http.post('label/'+label.id, {name:label.name, _method:'DELETE'}).then(function(response){
        //console.log('test')
        label.updating = false
        this.labels.splice(i, 1)
      }.bind(this))
    },

    updateLabel: function (i) {
      var label = this.labels[i]
      label.updating = true
      //var resource = this.$resource('label/'+label.id)
      this.$http.post('label/'+label.id, {name:label.name, _method:'PATCH'}).then(function(response){
        //console.log('test')
        label.updating = false
        label.editing = false
      }.bind(this))
    },

    setOldInput: function (old) {
      this.oldInput = old
    },

    getContacts: function () {
      var resource = this.$resource('user/'+this.user.id+'/contacts')
      resource.get({}).then(function(response){
        this.contacts = response.data
      }.bind(this))
    },

    getLabels: function () {
      var resource = this.$resource('user/'+this.user.id+'/labels')
      resource.get({}).then(function(response){
        this.labels = response.data
      }.bind(this))
    },

    createContact: function () {
      this.$http.post('contact', { 
        user_id: this.user.id,
        name:this.Contact.name,
        phone:this.Contact.phone,
        email:this.Contact.email,
        birthday:this.Contact.birthday,
        _method:'POST'
      }).then(function(response){
        this.contacts.push(response.data)
        this.closeNewContact()
      }.bind(this))
    },

    closeNewContact: function () {
      this.newContact = false
      this.Contact.name =  ''
      this.Contact.phone = ''
      this.Contact.email = ''
      this.Contact.birthday = ''
    }
  }

})