<template>
	<div class="list-group list-group-full editable">
		<div v-for="item in content" :class="'list-group-item item-' + $index">
			<div v-show="!item.editing" class="list-content">
				<span class="list-text">{{ item.name }}</span>
				<span class="pull-right badge">{{ item.contacts | count }}</span>
				<div class="item-actions pull-right">
					<a @click.stop.prevent="edit($index)" class="btn-icon">
						<i class="fa fa-edit" aria-hidden="true"></i>
					</a>
					<a @click.stop.prevent="removeConfirm($index)" class="btn-icon trash">
						<i class="fa fa-trash" aria-hidden="true"></i>
					</a>
				</div>
			</div>
			
			<div v-show="item.remove" class="confirm">
				<div class="col-md-6">
					<p>Are you sure?</p>
				</div>
				<div class="col-md-6 removeOptions">
					<div class="pull-right">
						<button @click="remove($index)" class="btn btn-sm btn-primary">YES</button>
						<button @click="item.remove = false" class="btn btn-sm btn-danger">NO</button>
					</div>
				</div>
			</div>
			
			<div v-show="item.editing" class="list-editable">
				<div class="form-group material-input">
					<input onfocus="this.select()" 
						   v-focus-model="item.editing" 
						   v-model="content[$index].name" type="text" 
						   class="form-control" name="name" 
						   @keyup.enter="update($index)">
					<div class="edit-options pull-right">
						<span @click="cancel($index)" v-show="!item.updating" class="btn-icon">
							<i class="fa fa-times-circle" aria-hidden="true"></i>
						</span>
						<span v-show="item.updating" class="btn-icon">
							<i class="fa fa-spinner fa-pulse" aria-hidden="true"></i>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div v-show="newItem" class="list-group-item">
			<input v-focus-model="newItem" v-model="item" 
				   class="form-control" name="name" @keyup.enter="create(item)">
		</div>
		<a class="list-group-item" @click.stop.prevent="newItem = true">
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
            	item: '',
                newItem: false,
                oldInput: '',
            }
        },

        methods: {

		    create: function (item) {
		      this.$http.post(this.model, {name:item, user_id: this.$parent.user.id, _method:'POST'})
		      .then(function(response){
		        this.content.push(response.data)
		        this.newItem = false
		        this.item = ''
		      }.bind(this))
		    },

		    edit: function (i) {
		      var labels = this.content
		      this.setOldInput(labels[i].name)
		      labels.forEach(function(label){
		        labels.editing = false
		        labels[i].editing = true
		      })

		      labels.forEach(function(label){
		        label.remove = false
		      })
		    },

		    cancel: function (i) {
		      this.content[i].name = this.oldInput
		      this.oldInput = ''
		      this.content[i].editing = false
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