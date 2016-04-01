var Vue = require('vue')
window.$ = window.jQuery = require('jquery')
var bootstrap = require('bootstrap/dist/js/bootstrap')
var VueResource = require('vue-resource')

Vue.use(VueResource)

Vue.filter('count', function (list) {
    return list.length
})

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value')

Vue.config.debug = true

new Vue({

  name: 'Contact',

  components: {
    ContactForm: require('./components/ContactForm.vue'),
    EditableList: require('./components/EditableList.vue'),
    SortableTable: require('./components/SortableTable.vue')
  },

  el: '#app-contacts',

  data: {
    user: Auth.user,
    contacts: {},
    labels: {},
    searchQuery: '',
    search: false,
    columns: ['name', 'phone', 'email'],
    sortOrders: {'name':1, 'phone':1, 'email':1},
    sideBar: true,
    newContact: false,
    editContact: false,
    Contact: {
      name: '',
      phone: '',
      email: '',
      birthday: '', 
    },
    Edit: {
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

    openNewContact: function () {
      this.closeEditContact()
      this.newContact = true
    },

    setContact: function (contact) {
      this.closeNewContact()
      this.editContact = true
      this.Edit.name = contact.name
      this.Edit.phone = contact.phone
      this.Edit.email = contact.email
      this.Edit.birthday = contact.birthday
    },

    sortBy: function (key) {
      this.sortKey = key
      this.sortOrders[key] = this.sortOrders[key] * -1
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

    updateContact: function () {
      this.closeNewContact()
      console.log('update contact')
    },

    closeNewContact: function () {
      this.newContact = false
      this.Contact.name =  ''
      this.Contact.phone = ''
      this.Contact.email = ''
      this.Contact.birthday = ''
    },

    closeEditContact: function () {
      this.editContact = false
      this.Edit.name =  ''
      this.Edit.phone = ''
      this.Edit.email = ''
      this.Edit.birthday = ''
    },

    deleteContacts: function () {
      alert(this.checkedContacts)
    }
  }

})