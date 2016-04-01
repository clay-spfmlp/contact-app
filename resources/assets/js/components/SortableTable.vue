<template>
	<table class="table">
	    <thead>
	      	<tr v-cloak class="sortable">
	        	<th scope="col">
	          		<span class="checkbox-custom checkbox-primary checkbox-lg contacts-select-all">
	            		<input type="checkbox" class="contacts-checkbox selectable-all" id="select_all">
	            		<label for="select_all"></label>
	          		</span>
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
		    	<tr v-cloak v-for="contact in data | filterBy filterKey | orderBy sortKey sortOrders[sortKey]" v-bind:class="ifInArray(contact.id, checkedContacts) ? 'checked' : ''" class="contact-row" >
		      		<td class="responsive-hide">
		        		<span class="checkbox-custom checkbox-primary checkbox-lg">
		          			<input type="checkbox" v-model="checkedContacts" class="contacts-checkbox selectable-item" id="contacts_{{ contact.id }}" value="{{ contact.id }}">
		          			<label for="contacts_@{{ contact.id }}"></label>
		        		</span>
		      		</td>
		      		<td>
		        		<a class="avatar pull-left" href="javascript:void(0)">
		          			<img class="img-responsive" :src="'http://www.gravatar.com/avatar/' + contact.gravatar" alt="...">
		        		</a>
		        		<div class="name pull-left"><a v-on:click.stop.prevent="setContact(contact)" >{{ contact.name }}</a></div>
		      		</td>
		      		<td>{{ contact.phone }}</td>
		      		<td>{{ contact.email }}</td>
		    	</tr>
		  	</tbody>
		</table>
	</div>
          
</template>

<script>

    export default {

    	name: 'SortableTable',

    	props: {
		    data: {},
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
		      checkedContacts: [],
		    }
        },

        methods: {
		    sortBy: function (key) {
		      this.sortKey = key
		      this.sortOrders[key] = this.sortOrders[key] * -1
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
        }
    }
</script>