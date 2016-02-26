@extends('layouts.master')

@section('content')
    <div class="page-header">
        <h1  class="page-title">Manage Permissions</h1>
        <div class="page-header-actions">
            {!! HTML::decode(link_to('#modal', '<i class="icon fa-plus" aria-hidden="true"></i> Create a Permission', ['class' => 'btn btn-primary btn-sm', 'data-toggle' => 'modal', 'role' => 'button'])) !!}
            {!! HTML::decode(link_to_route('admin.role.index', '<i class="icon md-roller" aria-hidden="true"></i> Manage Roles', [], ['class' => 'btn btn-primary btn-sm', 'role' => 'button'])) !!}
        </div>
    </div>

    <div class="page-content container-fluid">

        <div class="panel">

            {{--<div class="panel-heading">--}}
                {{--<h3 class="panel-title">Heading With Dropdown</h3>--}}
                {{--<div class="panel-actions">--}}
                    {{--{!! HTML::decode(link_to('#modal', '<i class="icon fa-plus" aria-hidden="true"></i> Create a Permission', ['class' => 'btn btn-primary btn-sm', 'data-toggle' => 'modal', 'role' => 'button'])) !!}--}}
                    {{--{!! HTML::decode(link_to_route('admin.role.index', '<i class="icon md-roller" aria-hidden="true"></i> Manage Roles', [], ['class' => 'btn btn-primary btn-sm', 'role' => 'button'])) !!}--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="panel-body container-fluid">
                {!! Form::open(['route' => 'admin.permission.role.update']) !!}
                <table class="table table-condensed table-hover table-striped dataTable width-full" data-plugin="dataTable">
                    <thead>
                    <tr>
                        <th data-halign="left">Permissions</th>
                        @foreach($roles as $key => $role)
                            <th data-halign="center">{{ $role->display_name }}</th>
                        @endforeach
                    </tr>
                    </thead>
                        <tbody>
                        @foreach($permissions as $cateroy_id => $permission)
                            <tr><td colspan="0"><h4 class="table-cell-heading">{!! $accessor->array['permissionCategory'][$cateroy_id]['name'] !!}</h4></td></tr>
                            @foreach($permission as $key => $permission)
                            <tr id="permission-{{ $permission->id }}">
                                <td>{!! $permission->display_name !!}</td>
                                @foreach($roles as $k => $role)

                                    <td>{!! Form::checkbox('roles['.$role->id.'][]', $permission->id, checkPivot($permission->id, $role->permissions)) !!}</td>

                                @endforeach
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                </table>
            </div>
            <div class="panel-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-sm btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    @include('admin.permissions.create', ['modalId' => 'modal'])

@stop()

@section('scripts')
    {{--{!! HTML::script('js/dataTables.min.js') !!}--}}
    @if ($errors->any())
        <script type="text/javascript">
            $('#modal').modal();
        </script>
    @endif
@stop()