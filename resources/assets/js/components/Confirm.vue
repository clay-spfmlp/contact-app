<template>
	<div class="confirm">
        <div class="col-md-11 col-xs-10">
            <p><slot>Go back and enter a title</slot></p>
        </div>
        <div>
            <button @click="" class="btn btn-sm btn-primary">YES</button>
            <button @click="$parent.label.remove = false" class="btn btn-sm btn-danger">NO</button>
        </div>
    </div>
</template>

<script>
    export default {
    	name: 'confirm',
    	props: {
    		i: ''
    	},
        data: function(){
            return {
                i: this.i   
            }
        }
    }
</script>