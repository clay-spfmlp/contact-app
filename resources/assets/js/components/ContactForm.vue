<template>
	<div v-cloak transition="slideInLeft" class="contact-form" aria-hidden="true" aria-labelledby="addContactForm" role="dialog" tabindex="-1">
		<form>
			<div class="dialog">
				<div class="content" :class="sending ? 'light' : ''">
					<div class="header">
						<button @click="close" class="close">×</button>
						<h4 class="title">{{ state == 'new' ? 'Create New Contact' : 'Edit Contact' }}</h4>
					</div>
					<div class="body">
						<div class="form-group">
							<input v-model="Contact.name" type="text" class="form-control" placeholder="Name" required>
						</div>
						<div class="form-group">
							<input v-model="Contact.email" type="email" class="form-control" placeholder="Email" required>
						</div>
						<div class="form-group">
							<input v-model="Contact.phone" type="text" class="form-control" placeholder="Phone" >
						</div>
						<div class="form-group">
							<input v-model="Contact.birthday" type="date" class="form-control" placeholder="Birthday">
						</div>
						<div class="labels">
							<label v-for="label in labels"><input id="label_{{label.id}}" v-model="Contact.labels" value="{{label.id}}" type="checkbox">{{label.name}}</label>
						</div>
					</div>
					<div class="footer">
						<div class="pull-right">
							<button v-on:click.stop.prevent="state == 'new' ? create() : edit() " class="btn btn-primary" type="submit">Send</button>
							<a class="btn btn-sm btn-white" @click="close()">Cancel</a>
						</div>
					</div>
				</div>
				<div v-show="sending" class="busy-spinner">
					<span><i class="fa fa-spinner fa-pulse"></i></span>
				</div>
			</div>
		</form>
	</div>
</template>

<script>

    export default {

    	name: 'ContactForm',

    	props: {
    		state: {
    			type: String,
    			required: true,
    		},
    		contacts: {
    			type: Array,
    			required: false,
    			twoWay: true,
    		},
    		show: {
		        type: Boolean,
		      	required: true,
		      	twoWay: true    
		    },
		    labels: {
		    	type: Array,
		    	required: false,
		    	twoWay:true,
		    }
    	},

        data: function(){
        	return {
        		sending: false,
        		
			    Contact: {
			    	index: '',
			    	id: '',
			        name: '',
			        phone: '',
			        email: '',
			        birthday: '',
			        labels: [], 
			    },
        	}
        },

        methods: {
		    create: function () {
		    	this.sending = true
		      	this.$http.post('contact', { 
		        	user_id: this.$parent.user.id,
		        	name: this.Contact.name,
		        	phone: this.Contact.phone,
		        	email: this.Contact.email,
		        	birthday: this.Contact.birthday,
		        	_method: 'POST'
		      	}).then(function(response){
		        	this.$parent.contacts.push(response.data)
		        	this.close()
		      	}.bind(this))
		    },

		    close: function () {
		    	this.$dispatch('clear-checked-contacts')
		    	this.show = false
		      	this.clear()
		    },

		    edit: function () {
		    	this.sending = true
		    	this.$http.post('contact/' + this.Contact.id, { 
		        	name: this.Contact.name,
		        	phone: this.Contact.phone,
		        	email: this.Contact.email,
		        	birthday: this.Contact.birthday,
		        	_method: 'PATCH'
		      	}).then(function(response){
		        	this.$parent.contacts[this.Contact.index].name = response.data.name
		        	this.$parent.contacts[this.Contact.index].phone = response.data.phone
		        	this.$parent.contacts[this.Contact.index].email = response.data.email
		        	this.$parent.contacts[this.Contact.index].birthday = response.data.birthday
		        	this.close()
		        	this.$dispatch('check-contact', this.Contact.id)
		      	}.bind(this))
		    },

		    clear: function () {
		    	this.Contact.index = ''
		    	this.Contact.id =  ''
		      	this.Contact.name =  ''
		      	this.Contact.phone = ''
		      	this.Contact.email = ''
		      	this.Contact.birthday = ''
		      	this.Contact.labels = []
		      	this.sending = false
		    }
        },

        events: {

		    'set-edit-contact': function (contact, index) {
		    	if(this.state == 'edit'){
		    		this.Contact.index = index
			        this.Contact.id = contact.id
			        this.Contact.name = contact.name
			        this.Contact.phone = contact.phone
			        this.Contact.email = contact.email
			        this.Contact.birthday = contact.birthday
			        this.Contact.labels = []
			        var i;
			        for(i in contact.labels){
			        	this.Contact.labels.push(contact.labels[i].id.toString())
			        }
		    	}
		    },

		    'clear-contact': function () {
		    	this.clear()
		    }
		  }
    }
</script>

<style>

.busy-spinner {
	position: absolute;
    top: 5px;
    width: 100%;
    text-align: center;
}

.dialog {
	position: relative;
}

.light {
	opacity: 0.5;
}

.contact-form .fa-spinner {
	font-size: 18em;
	color: #3366ff;
}

.labels {
	max-height: 88px;
	display: flex;
	flex-direction: column;
	flex-wrap: wrap;
}

.labels label {
	flex: 1;
	flex-basis: 20px;
}

@media screen and (max-width: 480) {
	.labels label {
		flex-basis: 100%;
	}
}

</style>