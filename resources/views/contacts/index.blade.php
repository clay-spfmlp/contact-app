@extends('layouts.app')

@section('content')

  <div id="app-contacts" class="page">

    <div id="wrapper">

      <div id="sidebar-wrapper">
        <div class="sidebar-inner">
          <div class="sidebar-section">

            <div class="list-group list-group-full">
              <a class="list-group-item" v-on:click.stop.prevent="searchQuery = ''">
                <i class="fa fa-inbox" aria-hidden="true"></i>All Contacts
                <span class="badge pull-right" v-cloak >@{{ contacts | count }}</span>
              </a>
            </div>
            
            <div class="list-group list-group-full editable">
              <div v-for="label in labels" v-bind:class="'list-group-item item-' + $index" >
                <div class="list-content">
                  <span v-show="!label.editing" class="pull-right badge" v-cloak >@{{ label.contacts | count }}</span>
                  <span v-show="!label.editing" class="list-text" v-cloak >@{{ label.name }}</span>
                  <div v-show="!label.editing" class="item-actions pull-right" >
                    <a v-on:click.stop.prevent="editLabel($index)" class="btn-icon"><i class="fa fa-edit" aria-hidden="true"></i></a>
                    <a v-on:click.stop.prevent="removeConfirm($index)" class="btn-icon trash"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  </div>
                </div>
                <span v-show="label.remove" >
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
              <div v-show="newLabel" class="list-group-item" >
                <input v-focus-model="newLabel" v-model="label" class="form-control" name="name" v-on:keyup.enter="createLabel(label)">
              </div>
              <a v-show="!newLabel" class="list-group-item" v-on:click.stop.prevent="newLabel = true" >
                <span >
                  <i class="fa fa-plus" aria-hidden="true"></i> Add New Label
                </span>
              </a>
            </div>

          </div>
        </div>
      </div>

      <!-- Contacts Content -->
      <div id="page-content-wrapper">
        
        <!-- Contacts Content Header -->
        <section>
          <div class="page-header">
            <h1 class="pull-left">
              Contact List
            </h1>
            <div class="pull-right">
              <div class="input-search">
                <i class="fa fa-search" aria-hidden="true" v-on:click="search = true"></i>
                <input v-model="searchQuery" v-focus-model="search" type="text" class="form-control" name="" placeholder="Search..." >
                <i v-show="searchQuery" class="fa fa-times-circle" aria-hidden="true" v-on:click="searchQuery = ''"></i>
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
                <a type="button" class="btn btn-default">
                  <i class="fa fa-chevron-circle-down"></i>
                  <span class="icon wb-chevron-down-mini" aria-hidden="true"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="javascript:void(0)">Empty All</a></li>
                  <li><a href="javascript:void(0)">Export</a></li>
                </ul>
              </div>
            </div>
            <div class="btn-group">
              <div class="dropdown pull-left">
                <a class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                aria-expanded="false" type="button"><i class="fa fa-folder" aria-hidden="true"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li v-for="label in labels"><a href="javascript:void(0)">@{{ label.name }}</a></li>
                  <li class="divider"></li>
                  <li><a href="javascript:void(0)">Trash</a></li>
                  <li><a href="javascript:void(0)">Spam</a></li>
                </ul>
              </div>
              <div class="dropdown pull-left">
                <a class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                aria-expanded="false" type="button"><i class="fa fa-tag" aria-hidden="true"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li v-for="label in labels"><a href="javascript:void(0)">@{{ label.name }}</a></li>
                </ul>
              </div>
            </div>
          </div>


          <!-- Contacts -->
          <table class="table">
            <thead>
              <tr class="sortable">
                <th scope="col">
                  <span class="checkbox-custom checkbox-primary checkbox-lg contacts-select-all">
                    <input type="checkbox" class="contacts-checkbox selectable-all" id="select_all"
                    />
                    <label for="select_all"></label>
                  </span>
                </th>
                <th v-for="column in columns" v-on:click="sortBy(column)" :class="{active: sortKey == column}" >
                  @{{ column | capitalize}}
                  <span class="arrow"
                    :class="sortOrders[column] > 0 ? 'asc' : 'dsc'">
                  </span>
                </th>
              </tr>
            </thead>
          </table>

          <div class="table-body">
            <table class="table" transition="fade">
              <tbody>
                <tr v-for="contact in contacts | filterBy searchQuery | orderBy sortKey sortOrders[sortKey]" class="contact-row" >
                  <td class="responsive-hide">
                    <span class="checkbox-custom checkbox-primary checkbox-lg">
                      <input type="checkbox" class="contacts-checkbox selectable-item" id="contacts_@{{ contact.id }}" >
                      <label for="contacts_@{{ contact.id }}"></label>
                    </span>
                  </td>
                  <td>
                    <a class="avatar pull-left" href="javascript:void(0)">
                      <img class="img-responsive" :src="'http://www.gravatar.com/avatar/' + contact.gravatar"
                      alt="...">
                    </a>
                    <div class="name pull-left">@{{ contact.name }}</div>
                  </td>
                  <td>@{{ contact.phone }}</td>
                  <td>@{{ contact.email }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <ul data-plugin="paginator" data-total="50" data-skin="pagination-gap"></ul>
        </div>
      </div>
    </div>

    <!-- Site Action -->
    <div class="site-action">
      <button v-on:click.stop.prevent="newContact = true" v-show="!newContact" transition="fade" type="button" class="site-action-btn btn btn-success btn-floating">
        <i class="fa fa-user-plus" aria-hidden="true"></i>
      </button>
      <!-- <div class="site-action-buttons">
        <button type="button" data-action="trash" class="btn-raised btn btn-success btn-floating animation-slide-bottom">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </button>
        <button type="button" data-action="folder" class="btn-raised btn btn-success btn-floating animation-slide-bottom">
          <i class="fa fa-folder" aria-hidden="true"></i>
        </button>
      </div> -->
    </div>
    <!-- End Site Action -->

    <!-- Add Contoct Form -->
    <div v-show="newContact" v-cloak transition="slideInLeft" class="new-contact-form" id="addContactForm" aria-hidden="true" aria-labelledby="addUserForm" role="dialog" tabindex="-1">
      <form>
        <div class="dialog">
          <div class="content">
            <div class="header">
              <button v-on:click.stop.prevent="closeNewContact()" type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
              <h4 class="title">Create New Contact</h4>
            </div>
            <div class="body">
                <div class="form-group">
                  <input v-model="Contact.name" type="text" class="form-control" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                  <input v-model="Contact.phone" type="text" class="form-control" name="phone" placeholder="Phone" >
                </div>
                <div class="form-group">
                  <input v-model="Contact.email" type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <input v-model="Contact.birthday" type="date" class="form-control" name="birthday" placeholder="Birthday">
                </div>
            </div>
            <div class="footer">
              <div class="pull-right">
                <button v-on:click.stop.prevent="createContact()" class="btn btn-primary" type="submit">Send</button>
                <a class="btn btn-sm btn-white" v-on:click.stop.prevent="closeNewContact()">Cancel</a>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- End Add Contact Form -->

  </div>




@endsection

@section('script')
  <script src="js/contact.js"></script>
    {{-- <script src="{{ elixir('js/contact.js') }}"></script> --}}
@endsection

@section('css')

@endsection