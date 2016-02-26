import focusModel from 'vue-focus'

export default {
  name: 'Contact',
  directives: { focusModel: focusModel },
  //el: '#app-contacts',

  data: {
    user: Auth.user,
    contacts: {},
    labels: {},
    label: '',
    newLabel: false,
  },

  created: function () {
    this.getContacts()
    this.getLabels()
  },

  methods: {

    createLabel: function (label) {
      this.$http.post('label', {name:label, user_id: this.user.id, _method:'POST'}).then(function(response){
        this.labels.push(response.data)
        console.log(response.data)
        this.newLabel = false
        this.label = ''
      }.bind(this))
    },

    editLabel: function (i) {
      var labels = this.labels
      labels.forEach(function(label){
        label.editing = false
        labels[i].editing = true
      })

      labels.forEach(function(label){
        label.remove = false
      })
    },

    closeLabel: function (i) {

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
        label.editing = 0
      }.bind(this))
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
    }
  }
}