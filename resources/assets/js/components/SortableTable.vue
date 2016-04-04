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
			    	<tr v-for="contact in data | filterBy filterKey | orderBy sortKey sortOrders[sortKey]" v-bind:class="ifInArray(contact.id, checkedContacts) ? 'checked' : ''" class="contact-row" >
			      		<td class="responsive-hide checkbox-col">
			        		<section>
							    <div class="squaredOne">
							      <input v-model="checkedContacts" type="checkbox" value="{{ contact.id }}" id="contacts_{{ contact.id }}" >
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
		      checkedContacts: [],
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
		    	this.checkedContacts = []
		    	for(index in this.data){
		    		if(this.all === false){
		    			this.checkedContacts.push(this.data[index].id.toString())
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
    			this.checkedContacts = []
    			this.checkedContacts.push(contact.id.toString())
		    },
        },
        events: {
        	'reset-checked-contacts': function () {
        		this.checkedContacts = []
        	},

        	'check-contact': function (id) {
        		this.checkedContacts.push(id.toString())
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

/* .squaredOne */
.squaredOne {
  width: 28px;
  height: 28px;
  position: relative;
  margin: 20px auto;
  background: #fcfff4;
  background: -webkit-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
  background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
  box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0, 0, 0, 0.5);
}
.squaredOne label {
  width: 20px;
  height: 20px;
  position: absolute;
  top: 4px;
  left: 4px;
  cursor: pointer;
  background: -webkit-linear-gradient(top, #222 0%, #45484d 100%);
  background: linear-gradient(top, #222 0%, #45484d 100%);
  box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.5), 0px 1px 0px white;
}
.squaredOne label:after {
  content: '';
  width: 16px;
  height: 16px;
  position: absolute;
  top: 2px;
  left: 2px;
  background: #3366ff;
  background: -webkit-linear-gradient(top, #3366ff 0%, #0033cc 100%);
  background: linear-gradient(top, #3366ff 0%, #0033cc 100%);
  box-shadow: inset 0px 1px 1px white, 0px 1px 3px rgba(0, 0, 0, 0.5);
  opacity: 0;
}
.squaredOne label:hover::after {
  opacity: 0.3;
}
.squaredOne input[type=checkbox] {
  visibility: hidden;
}
.squaredOne input[type=checkbox]:checked + label:after {
  opacity: 1;
}

/* end .squaredOne */



</style>