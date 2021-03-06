@extends('layouts.main')

@section('css')
<link href="css/contact.css" rel="stylesheet">
@endsection

@section('content')

<div id="app-contacts" class="page">
	<div id="wrapper">
		<div id="sidebar-wrapper">
			<div class="sidebar-inner">
				<div class="sidebar-section">
					<div class="list-group list-group-full">
						<a v-cloak class="list-group-item" v-on:click.stop.prevent="searchQuery = ''">
							<i class="fa fa-inbox" aria-hidden="true"></i>All Contacts
							<span class="badge pull-right" v-cloak >@{{ contacts | count }}</span>
						</a>
					</div>

					<editable-list :content="labels" model="label"></editable-list>

				</div>
			</div>
		</div>

		<!-- Contacts Content -->
		<div id="page-content-wrapper">

			<!-- Contacts Content Header -->
			<section>
				<div class="page-header">
					<h1 class="pull-left">Contact List</h1>
					<div class="pull-right">
						<div class="input-search">
							<i class="fa fa-search" aria-hidden="true" v-on:click="search = true"></i>
							<input v-model="searchQuery" v-focus-model="search" type="text" 
								   class="form-control" placeholder="Search..." >
							<i v-show="searchQuery" class="fa fa-times-circle" aria-hidden="true" 
							   v-on:click="searchQuery = ''"></i>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</section>

			<!-- Contacts Content -->
			<div class="page-content page-content-table panel">

				<!-- Actions -->
				<div class="page-content-actions">
					<div class="pull-right">
						<div class="dropdown pull-right">
							<a type="button" class="btn btn-default dropdown-toggle" 
							   data-toggle="dropdown">
								<i class="fa fa-chevron-circle-down"></i>
								<span class="icon wb-chevron-down-mini" aria-hidden="true"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="javascript:void(0)">Empty All</a></li>
								<li><a href="javascript:void(0)">Export</a></li>
								<li><a v-on:click.prevent="deleteContacts()">
									<i class="fa fa-trash"></i>Trash
								</a></li>
							</ul>
						</div>
					</div>
					<div class="btn-group">
						<div class="dropdown pull-left">
							<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" 
								aria-expanded="false" type="button">
								<i class="fa fa-folder" aria-hidden="true"></i>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li v-for="label in labels">
									<a v-on:click.prevent="searchQuery = label.name">@{{ label.name }}</a>
								</li>
								<li class="divider"></li>
								<li><a href="javascript:void(0)">Trash</a></li>
								<li><a href="javascript:void(0)">Spam</a></li>
							</ul>
						</div>
						<div class="dropdown pull-left">
							<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" 
							   aria-expanded="false" type="button">
								<i class="fa fa-tag" aria-hidden="true"></i>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li v-for="label in labels">
									<a v-on:click="addLabelToChecked(label.id)">@{{ label.name }}</a>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<!-- Contacts -->
				<sortable-table
					:data.sync="contacts"
					:columns="columns"
					:filter-key="searchQuery">
				</sortable-table>

				<ul data-plugin="paginator" data-total="50" data-skin="pagination-gap"></ul>
			</div>
		</div>
	</div>

	<!-- Site Action -->
	<div class="site-action">
		<button v-on:click="openNewContact()" v-show="!newContact" transition="fade" type="button" 
			    class="site-action-btn btn btn-success btn-floating">
			<i class="fa fa-user-plus" aria-hidden="true"></i>
		</button>
	</div>
	<!-- End Site Action -->

	<contact-form 
		state="new" 
		:show.sync="newContact" 
		:labels.sync="labels" 
		v-show="newContact">
	</contact-form>

	<contact-form 
		state="edit" 
		:show.sync="editContact" 
		:labels.sync="labels" 
		:contacts.sync="contacts" 
		v-show="editContact">
	</contact-form>

</div>

@endsection

@section('script')
<script src="js/contact.js"></script>
@endsection