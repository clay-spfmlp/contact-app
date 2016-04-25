@extends('layouts.main')

@section('css')
<link href="css/permission.css" rel="stylesheet">
@endsection

@section('content')
<div id="permission" class="content">
    <div class="page-header">
        <h1>Manage Permissions</h1>
    </div>
    <div class="page-content container-fluid">
        <div class="panel">
            <div class="panel-heading">
                <div class="panel-actions">
                     <button v-on:click="newRole()" class="btn btn-primary">
                     	<i class="fa fa-plus" aria-hidden="true"></i> Create a Role
                     </button>
                     <button v-on:click="newPermission()" class="btn btn-primary">
                     	<i class="fa fa-plus" aria-hidden="true"></i> Create a Permission
                     </button>
                </div>
            </div>
            <div class="panel-body container-fluid">
                <table class="table table-condensed table-hover table-striped">
                    <thead>
	                    <tr>
	                        <th data-halign="left">
	                        	<div v-show="!createRole.show">Permissions</div>
	                        	<div class="InputAddOn" v-show="createRole.show">
	                        		<input class="InputAddOn-field" name="role" placeholder="New Role"
	                        			   v-model="createRole.role" v-focus-model="createRole.focus">
	                        		<button v-on:click="addRole()" class="InputAddOn-item">Go</button>
	                        	</div>
	                        </th>
	                        <th v-for="role in roles" data-halign="center">@{{ role.name }}</th>
	                    </tr>
                    </thead>
                    <tbody>
                    	<tr v-show="createPermission.show">
                        	<td>
    	                    	<div class="InputAddOn">
	                        		<input v-on:keyUp.enter="addPermission()" class="InputAddOn-field" 
	                        			   type="text" v-model="createPermission.permission" 
	                        			   placeholder="New Permission" name="permission" 
	                        			   v-focus-model="createPermission.focus">
	                        		<select name="model" class="InputAddOn-field" v-model="createPermission.model">
	                        			<option value="" selected>-- Select a Model --</option>
	                        			<option v-for="model in models" value="@{{ model.namespace }}">
	                        				@{{ model.name }}
	                        			</option>
	                        		</select>

	                        		<button v-on:click="addPermission()" class="InputAddOn-item">Go</button>
								</div>
                        	</td>
                        	<td v-for="role in roles">
								<input type="checkbox"  disabled>	
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-for="group in permissionsGroup">
                        <tr><td :colspan="colspan"><h4>@{{ modelArray[$index] }}</h4></td></tr>

                        <tr v-for="permission in group" id="">
                            <td>
                            	<div v-show="!permission.editing">
                            		<a href="#" id="permission-@{{ permission.id }}" v-on:click.prevent="permission.editing = true">
                            			@{{ permission.name }}
                            		</a>
                            	</div>
                            	<div v-show="permission.editing" class="InputAddOn">
                            		<input v-model="permission.name" class="InputAddOn-field" 
                            				value="@{{ permission.name }}"
                            				placeholder="Edit Permission" 
                            				id="edit-permission-name-@{{ permission.id }}">
                            		<select id="edit-permission-model-@{{ permission.id }}" 
                            				class="InputAddOn-field" v-model="permission.model">
	                        			<option value="">-- Select a Model --</option>
	                        			<option v-for="model in models" value="@{{ model.namespace }}">
	                        				@{{ model.name }}
	                        			</option>
	                        		</select>
                            		<button v-on:click.prevent="editPermission(permission)" 
                            			class="InputAddOn-item" 
                            			id="edit-permission-go-@{{ permission.id }}">Go</button>
                            		<button v-on:click.prevent="permission.editing = false" 
		                            		id="edit-permission-cancel-@{{ permission.id }}"
                            				class="InputAddOn-item">Cancel</button>
                            	</div>
                            </td>
                            <td v-for="role in roles">
								<input 
								v-model="checkedIds" 
								id="permission_@{{ permission.id + '.' + role.id }}" 
								v-on:click="toggleCheck(permission.id, role.id)"
								:checked="checked(permission.roles, role.id)" 
								type="checkbox" :value="permission.id + '.' + role.id">
								<label for="permission_@{{ permission.id + '.' + role.id }}"></label>
                            </td>
                        </tr>
                       

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="js/permission.js"></script>
@endsection