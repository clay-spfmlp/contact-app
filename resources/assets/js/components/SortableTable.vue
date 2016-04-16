<template>
	<div class="table">
		<div class="table-no-margin">
		    
		      	<div class="Table--Row sortable">
		        	<div class="Table--Row__item checkbox-col">
					    <div class="squaredOne">
					      <input type="checkbox" v-model="all" id="all" name="check" v-on:click="selectAll()">
					      <label for="all"></label>
					    </div>
		        	</div>
		        	<div class="Table--Row__item avatar no__avatar"></div>
		        	<div class="Table--Column Table--Row__item">
			        	<div v-for="column in columns" @click="sortBy(column)" class="Table--Row__item" :class="{active: sortKey == column}">
			          		{{ column | capitalize}}
			          		<span class="arrow" :class="sortOrders[column] > 0 ? 'asc' : 'dsc'"></span>
			        	</div>
		        	</div>
		      	</div>
		    
		</div>
		<div class="table-body">
		  	
	    	<div v-for="contact in data | filterBy filterKey | orderBy sortKey sortOrders[sortKey]" v-bind:class="ifInArray(contact.id, checked) ? 'checked' : ''" class="Table--Row" >
	      		<div class="Table--Row__item responsive-hide checkbox-col">
				    <div class="squaredOne">
				      <input v-model="checked" type="checkbox" value="{{ contact.id }}" id="contacts_{{ contact.id }}" >
				      <label for="contacts_{{ contact.id }}"></label>
				    </div>
	      		</div>
	      		<div class="Table--Row__item avatar">
	        		<a v-on:click.stop.prevent="editContact(contact, $index)">
	          			<img class="img-responsive" :src="'http://www.gravatar.com/avatar/' + contact.gravatar" alt="...">
	        		</a>
	        	</div>
	        	<div class="Table--Column Table--Row__item">
	      			<div class="Table--Row__item name">
	        			<a v-on:click.stop.prevent="editContact(contact, $index)" >{{ contact.name }}</a>
	      			</div>
	      			<div class="Table--Row__item email">{{ contact.email }}</div>
	      			<div class="Table--Row__item phone">{{ contact.phone }}</div>
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
		    columns: [],
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
        		this.checked = [];
        	},

        	'check-contact': function (id) {
        		this.checked.push(id.toString());
        	}
        }
    }
</script>

<style type="text/css">

.table-no-margin {
	margin: 0;
}

.active .arrow {
  	opacity: 1;
}

.Table--Column{
	display: flex;
}

.Table--Row {
	display: flex;
	border-bottom: 1px solid #2A3132;
    padding: 5px 0;
}

.Table--Row__item {
	flex: 1;
}

.Table--Row__item.checkbox-col {
	width: 60px;
	padding: 0 15px;
	flex: 0;
}

.Table--Row__item.avatar {
	flex: 0;
	padding: 0 15px;
}

.Table--Row__item.avatar.no__avatar{
	padding: 0 35px;
}

@media(max-width:768px) {

    .contact-form {
    	width: 80%;
    }

    .table-body .Table--Column {

    	flex-direction: column;
    }

    .Table--Row__item.avatar {
    	padding: 0 15px 0 0;
    }

    .Table--Row__item.avatar.no__avatar{
		padding: 0;
	}

}

@media(max-width:412px) {
	.contact-form {
    	width: 100%;
    	border-radius: 0;
    }
}


</style>