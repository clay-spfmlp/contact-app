@extends('layouts.master')

@section('content')
    <div class="page-header">
        <h1  class="page-title">Manage Roles</h1>
        <div class="page-header-actions">
            {!! HTML::decode(link_to('#modal', '<i class="icon fa-plus" aria-hidden="true"></i> Create a Role', ['class' => 'btn btn-primary btn-sm', 'data-toggle' => 'modal', 'role' => 'button'])) !!}
            {!! HTML::decode(link_to_route('admin.permission.index', '<i class="icon fa-pied-piper-alt" aria-hidden="true"></i> Manage Permissions', [], ['class' => 'btn btn-primary btn-sm', 'role' => 'button'])) !!}
        </div>
    </div>

    <div class="page-content container-fluid">

        <div class="panel">
            <div class="panel-body container-fluid">
                <table class="table table-condensed table-hover table-striped dataTable width-full" data-plugin="dataTable">
                    <thead>
                    <tr>
                        <th>Display Name</th>
                        <th>Role Name</th>
                        <th>Description</th>
                        <th class="sorting_disabled text-right">Actions</th>
                    </tr>
                    </thead>
                    @foreach($roles as $key => $role)
                        <tr id="role-{{ $role->id }}">
                            <td>{!! $role->display_name !!}</td>
                            <td>{!! $role->name !!}</td>
                            <td>{!! $role->description   !!}</td>
                            <td class="text-right">
                                {!! HTML::decode(link_to('#', '<i class="icon io-eye" aria-hidden="true"></i>', ['class' => 'btn btn-sm btn-primary', 'role' => 'button', 'title' => 'View Role'])) !!}
                                {!! HTML::decode(link_to('#', '<i class="icon glyphicon glyphicon-remove" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-sm', 'data-confirm' => 'remote', 'title' => 'Delete Role','role' => 'button', 'data-hide' => '#role-'.$role->id])) !!}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>

    @include('admin.roles.create', ['modalId' => 'modal'])

@stop()

@section('scripts')
    {!! HTML::script('js/dataTables.min.js') !!}
@stop()