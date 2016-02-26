@extends('layouts.master')

@section('content')
    <div class="page-header">
        <h1  class="page-title">{!! $user->full_name !!}</h1>
    </div>

    <div class="page-content container-fluid">

        <div class="row" data-plugin="matchHeight">
            <div class="col-xlg-6 col-md-6">
                <div class="panel">
                    <header class="panel-heading">
                        <h3 class="panel-title">Contact Info</h3>
                    </header>
                    <div class="panel-body container-fluid">
                        <div>Email: {!! $user->email !!}</div>
                        <div>Phone: {!! $user->phone_number !!}</div>
                    </div>
                </div>
            </div>

            <div class="col-xlg-6 col-md-6">
                <div class="panel">
                    <header class="panel-heading">
                        <h3 class="panel-title">Permissions</h3>
                    </header>
                    <div class="panel-body container-fluid">
                        <ul class="list-group list-group-bordered bg-blue-grey-100 bg-inherit">
                            @foreach($user->roles as $role)
                                @foreach($role->permissions as $permission)
                                    <li class="list-group-item">{{ $permission->display_name }}</li>
                                @endforeach
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel">
            <header class="panel-heading">
                <h3 class="panel-title">Admin History</h3>
            </header>
            <div class="panel-body container-fluid">
                <table class="table table-condensed table-hover table-striped dataTable width-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <td>Name of Contact</td>
                            <td>Email of Contact</td>
                            <td>Phone of Contact</td>
                            <td>Description</td>
                            <td>Admin</td>
                            <td>Date & Time</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($user->adminHistory as $history)
                        <tr>
                            <td>{!! $history->name !!}</td>
                            <td>{!! $history->email !!}</td>
                            <td>{!! $history->phone !!}</td>
                            <td>{!! nl2br($history->description) !!}</td>
                            <td>{!! $history->admin->first_name !!} {!! $history->admin->last_name !!}</td>
                            <td>{!! $history->created_at->format('m/d/Y') !!} at {!! $history->created_at->format('g:m a') !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@stop()

@section('scripts')
    {!! HTML::script('js/dataTables.min.js') !!}
@stop()