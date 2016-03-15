<template>
	<div class="list-group list-group-full editable">
		<div v-for="label in labels" v-bind:class="'list-group-item item-' + $index" v-cloak--hidden>
			<div class="list-content">
				<span v-show="!label.editing" class="pull-right badge" v-cloak--hidden>@{{ label.contacts | count }}</span>
				<span v-show="!label.editing" class="list-text" v-cloak--hidden>@{{ label.name }}</span>
				<div v-show="!label.editing" class="item-actions pull-right" v-cloak--hidden>
					<a v-on:click.stop.prevent="editLabel($index)" class="btn-icon"><i class="fa fa-edit" aria-hidden="true"></i></a>
					<a v-on:click.stop.prevent="removeConfirm($index)" class="btn-icon trash"><i class="fa fa-trash" aria-hidden="true"></i></a>
				</div>
			</div>
			<span v-show="label.remove" v-cloak--hidden>
				<div class="confirm">
					<div class="col-md-11 col-xs-10">
						<p>Are you sure?</p>
					</div>
					<div class="removeOptions">
						<div class="pull-right">
							<button v-on:click="removeLabel($index)" class="btn btn-sm btn-primary">YES</button>
							<button v-on:click="label.remove = false" class="btn btn-sm btn-danger">NO</button>
						</div>
					</div>
				</div>
			</span>
			<div v-show="label.editing" class="list-editable">
				<div class="form-group material-input">
					<input onFocus="this.select()" v-focus-model="label.editing" v-model="labels[$index].name" type="text" class="form-control" name="name" v-on:keyup.enter="updateLabel($index)">
					<div class="edit-options pull-right">
						<!-- <span v-on:click="updateLabel($index)" v-show="!label.updating" class="btn-icon"><i class="fa fa-check-circle" aria-hidden="true"></i></span> -->
						<span v-on:click="closeLabel($index)" v-show="!label.updating" class="btn-icon"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
						<span v-show="label.updating" class="btn-icon"><i class="fa fa-spinner fa-pulse" aria-hidden="true"></i></span>
					</div>
				</div>
			</div>
		</div>
		<div v-show="newLabel" class="list-group-item" v-cloak--hidden>
			<input v-focus-model="newLabel" v-model="label" class="form-control" name="name" v-on:keyup.enter="createLabel(label)">
		</div>
		<a v-show="!newLabel" class="list-group-item" v-on:click.stop.prevent="newLabel = true" v-cloak--hidden>
			<span>
				<i class="fa fa-plus" aria-hidden="true"></i> Add New Label
			</span>
		</a>
	</div>
</template>

<script>
    export default {
    	name: 'SubHeader',
    	props: {
    		number: ''
    	},
        data: function(){
            return {
                step: this.number            }
        }
    }
</script>