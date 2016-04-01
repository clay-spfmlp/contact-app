<template>
	<div class="list-group list-group-full editable">
		<div v-for="label in content" v-bind:class="'list-group-item item-' + $index" v-cloak>
			<div v-show="!label.editing" class="list-content">
				<span class="list-text" v-cloak>{{ label.name }}</span>
				<span class="pull-right badge" v-cloak>{{ label.contacts | count }}</span>
				<div class="item-actions pull-right" v-cloak>
					<a @click.stop.prevent="edit($index)" class="btn-icon">
						<i class="fa fa-edit" aria-hidden="true"></i>
					</a>
					<a @click.stop.prevent="removeConfirm($index)" class="btn-icon trash">
						<i class="fa fa-trash" aria-hidden="true"></i>
					</a>
				</div>
			</div>
			
			<div v-show="label.remove" v-cloak class="confirm">
				<div class="col-md-6">
					<p>Are you sure?</p>
				</div>
				<div class="col-md-6 removeOptions">
					<div class="pull-right">
						<button @click="remove($index)" class="btn btn-sm btn-primary">YES</button>
						<button @click="label.remove = false" class="btn btn-sm btn-danger">NO</button>
					</div>
				</div>
			</div>
			
			<div v-show="label.editing" class="list-editable">
				<div class="form-group material-input">
					<input onFocus="this.select()" 
						   v-focus-model="label.editing" 
						   v-model="content[$index].name" type="text" 
						   class="form-control" name="name" 
						   @keyup.enter="update($index)">
					<div class="edit-options pull-right">
						<span @click="cancel($index)" v-show="!label.updating" class="btn-icon">
							<i class="fa fa-times-circle" aria-hidden="true"></i>
						</span>
						<span v-show="label.updating" class="btn-icon">
							<i class="fa fa-spinner fa-pulse" aria-hidden="true"></i>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div v-show="newLabel" class="list-group-item" v-cloak>
			<input v-focus-model="newLabel" v-model="label" 
				   class="form-control" name="name" @keyup.enter="create(label)">
		</div>
		<a v-show="!newLabel" class="list-group-item" @click.stop.prevent="newLabel = true" v-cloak>
			<span>
				<i class="fa fa-plus" aria-hidden="true"></i> Add New Label
			</span>
		</a>
	</div>
</template>

<script>

	import { focusModel } from 'vue-focus'

    export default {

    	name: 'EditableList',

    	directives: { focusModel: focusModel },

    	props: {
    		content: {},
    		model: ''
    	},

        data: function(){
            return {
            	label: '',
                newLabel: false,
                oldInput: '',
            }
        },

        methods: {

		    create: function (label) {
		      this.$http.post(this.model, {name:label, user_id: this.$parent.user.id, _method:'POST'})
		      .then(function(response){
		        this.content.push(response.data)
		        this.newLabel = false
		        this.label = ''
		      }.bind(this))
		    },

		    edit: function (i) {
		      var labels = this.content
		      this.setOldInput(labels[i].name)
		      console.log(labels[i].name)
		      labels.forEach(function(label){
		        label.editing = false
		        labels[i].editing = true
		      })

		      labels.forEach(function(label){
		        label.remove = false
		      })
		    },

		    cancel: function (i) {
		      console.log('test')
		      this.content[i].name = this.oldInput
		      this.oldInput = ''
		      this.content[i].editing = false;
		    },

		    removeConfirm: function (i) {
		      var labels = this.content
		      labels.forEach(function(label){
		        label.remove = false
		        labels[i].remove = true
		      })
		    },

		    remove: function (i) {
		      var label = this.content[i]
		      label.updating = true
		      this.$http.post(this.model+'/'+label.id, {name:label.name, _method:'DELETE'})
		      .then(function(response){
		        label.updating = false
		        this.content.splice(i, 1)
		      }.bind(this))
		    },

		    update: function (i) {
		      var label = this.content[i]
		      label.updating = true
		      this.$http.post(this.model+'/'+label.id, {name:label.name, _method:'PATCH'})
		      .then(function(response){
		        label.updating = false
		        label.editing = false
		      }.bind(this))
		    },

		    setOldInput: function (old) {
		      this.oldInput = old
		    },
        }
    }
</script>