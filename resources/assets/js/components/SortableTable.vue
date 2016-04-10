<template>
	<div>
		<table class="table table-no-margin">
		    <thead>
		      	<tr class="sortable">
		        	<th class="checkbox-col">
		          		<section>
						    <div class="squaredOne">
						      <input type="checkbox" v-model="all" id="all" name="check" v-on:click="selectAll()">
						      <label for="all"></label>
						    </div>
						</section>
		        	</th>
		        	<th v-for="column in columns" v-on:click="sortBy(column)" :class="{active: sortKey == column}">
		          		{{ column | capitalize}}
		          		<span class="arrow" :class="sortOrders[column] > 0 ? 'asc' : 'dsc'"></span>
		        	</th>
		      	</tr>
		    </thead>
		</table>
		<div class="table-body">
			<table class="table" >
			  	<tbody>
			    	<tr v-for="contact in data | filterBy filterKey | orderBy sortKey sortOrders[sortKey]" v-bind:class="ifInArray(contact.id, checked) ? 'checked' : ''" class="contact-row" >
			      		<td class="responsive-hide checkbox-col">
			        		<section>
							    <div class="squaredOne">
							      <input v-model="checked" type="checkbox" value="{{ contact.id }}" id="contacts_{{ contact.id }}" >
							      <label for="contacts_{{ contact.id }}"></label>
							    </div>
							</section>

			      		</td>
			      		<td>
			        		<a class="avatar pull-left" href="javascript:void(0)">
			          			<img class="img-responsive" :src="'http://www.gravatar.com/avatar/' + contact.gravatar" alt="...">
			        		</a>
			        		<div class="name pull-left"><a v-on:click.stop.prevent="editContact(contact, $index)" >{{ contact.name }}</a></div>
			      		</td>
			      		<td>{{ contact.email }}</td>
			      		<td>{{ contact.phone }}</td>
			    	</tr>
			  	</tbody>
			</table>
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
		    var sortOrders = {}
		    this.columns.forEach(function (key) {
		      sortOrders[key] = 1
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
		      this.sortKey = key
		      this.sortOrders[key] = this.sortOrders[key] * -1
		    },

		    selectAll: function () {
		    	var index = ''
		    	this.checked = []
		    	for(index in this.data){
		    		if(this.all === false){
		    			this.checked.push(this.data[index].id.toString())
		    		}
		    		
		    	}
		    },

		    ifInArray: function (id, array) {
      			var key
      			for (key in array) {
        			if (array[key] == id) {
            			return true
        			}
      			}

      			return false
    		},
    		editContact: function (contact, index) {
    			this.$dispatch('edit-contact', contact, index)
    			this.checked = []
    			this.checked.push(contact.id.toString())
		    },
        },
        events: {
        	'reset-checked-contacts': function () {
        		this.checked = []
        	},

        	'check-contact': function (id) {
        		this.checked.push(id.toString())
        	}
        }
    }
</script>
<style type="text/css">
.table-no-margin {
	margin: 0;
}

.table .checkbox-col {
	width: 60px;
	padding: 0;
}





</style>