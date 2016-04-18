<template>
	<div class="table">
		<div class="table__header">
	      	<div class="table__row sortable">
	        	<div class="table__cell checkbox-col">
				    <div class="squaredOne">
				      	<input type="checkbox" v-model="all" id="all" name="check" @click="selectAll()">
				      	<label for="all"></label>
				    </div>
	        	</div>
	        	<div class="table__cell avatar no__avatar"></div>
	        	<div class="table__cell table__column">
		        	<div v-for="column in columns" @click="sortBy(column)" class="table__cell" 
		        		 :class="{active: sortKey == column}">
		          		{{ column | capitalize}}
		          		<span class="arrow" :class="sortOrders[column] > 0 ? 'asc' : 'dsc'"></span>
		        	</div>
	        	</div>
	      	</div>
		</div>
		<div class="table__body">
	    	<div v-for="contact in data | filterBy filterKey | orderBy sortKey sortOrders[sortKey]" 
	    		 :class="ifInArray(contact.id, checked) ? 'checked' : ''" class="table__row" >
	      		<div class="table__cell checkbox-col">
				    <div class="squaredOne">
				      	<input v-model="checked" @click="$dispatch('send-checked')" type="checkbox" 
				      		   value="{{ contact.id }}" id="contacts_{{ contact.id }}" >
				      	<label for="contacts_{{ contact.id }}"></label>
				    </div>
	      		</div>
	      		<div class="table__cell avatar">
	        		<a @click.stop.prevent="editContact(contact, $index)">
	          			<img :src="'http://www.gravatar.com/avatar/' + contact.gravatar" 
	          				  class="img-responsive" alt="...">
	        		</a>
	        	</div>
	        	<div class="table__cell table__column">
	      			<div class="table__cell name">
	        			<a @click.stop.prevent="editContact(contact, $index)" >{{ contact.name }}</a>
	      			</div>
	      			<div class="table__cell email">{{ contact.email }}</div>
	      			<div class="table__cell phone">{{ contact.phone }}</div>
	      		</div>
	    	</div>
		</div>
	</div>
</template>

<script>

    export default {

    	name: 'SortableTable',

    	props: {
		    data: {
		    	type: Array,
		    	required: true,
    			twoWay: true,
		    },
		    columns:{
		    	type: Array,
		    	required: true,
		    },
		    filterKey: ''
    	},

        data: function(){
		    var sortOrders = {};
		    this.columns.forEach(function (key) {
		    	sortOrders[key] = 1;
		    })
		    return {
		      	sortKey: '',
		      	sortOrders: sortOrders,
		      	checked: [],
		      	all: false,
		    }
        },

        methods: {
		    sortBy: function (key) {
		    	this.sortKey = key;
		      	this.sortOrders[key] = this.sortOrders[key] * -1;
		    },

		    selectAll: function () {
		    	var index = '';
		    	this.checked = [];

		    	for(index in this.data){
		    		if(this.all === false){
		    			this.checked.push(this.data[index].id.toString());
		    		}
		    		
		    	}
		    	this.$dispatch('send-checked');
		    },

		    ifInArray: function (id, array) {
      			var key;
      			for (key in array) {
        			if (array[key] == id) {
            			return true;
        			}
      			}

      			return false;
    		},
    		editContact: function (contact, index) {
    			this.$dispatch('edit-contact', contact, index);
    			this.checked = [];
    			this.checked.push(contact.id.toString());
		    },
        },
        events: {
        	'reset-checked-contacts': function () {
        		console.log('reset-checked-contacts');
        		this.checked = [];
        		this.all = false;
        	},

        	'check-contact': function (id) {
        		console.log('check-contact');
        		this.checked.push(id.toString());
        	},
        	'send-checked': function () {
        		console.log('send-checked');
        		this.$dispatch('set-check-id', this.checked);
        	}
        }
    }
</script>

<style lang="sass">

.avatar img {
	border-radius:50%;
	max-width: 42px;
	transition: all 0.3s ease;
}

.contact-row .name {
    margin-top: 12px;
    margin-left: 8px;
}

.table {

	.table__body {
		max-height: 420px;
		overflow-y: auto;
	}

	.table__header {
		margin: 0;
	}

	.table__column{
		display: flex;
	}

	.table__row {
		display: flex;
		border-bottom: 1px solid #2A3132;
	    padding: 5px 0;
	    align-items: center;
	}

	.table__cell {
		flex: 1;
		align-items: center;
		&.checkbox-col {
			width: 60px;
			padding: 0 15px;
			flex: 0;
		}
		&.avatar {
			flex: 0;
			padding: 0 15px;
			&.no__avatar{
				padding: 0 35px;
			}
		}
	}

}

.arrow {
  	display: inline-block;
  	vertical-align: middle;
  	width: 0;
  	height: 0;
  	margin-left: 5px;
  	opacity: 0.66;

  	.asc {
	  	border-left: 6px solid transparent;
	  	border-right: 6px solid transparent;
	  	border-bottom: 6px solid #2A3132;
	}
	.dsc {
	  	border-left: 6px solid transparent;
	  	border-right: 6px solid transparent;
	  	border-top: 6px solid #2A3132;
	}
}

.active .arrow {
  	opacity: 1;
}



@media(max-width:768px) {

    .contact-form {
    	width: 80%;
    }

    .table {
	    
	    .table__cell {
			align-items: flex-start;
			
			&.avatar {
		    	padding: 0 15px 0 0;
		    	
		    	&.no__avatar{
					padding: 0;
				}
		    }
		}

	    .table__body .table__column {

	    	flex-direction: column;
	    }  	
    }

	.input-search .form-control:focus {
		width: 300px;
	}

}

@media(max-width:412px) {
	.contact-form {
    	width: 100%;
    	border-radius: 0;
    }

    .site-action-btn {
    	top: 55px;
    }

}

</style>