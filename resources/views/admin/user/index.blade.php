@extends('layouts.master')

@section('content')
    <div class="page-header">
        <h1  class="page-title">All Accounts</h1>
        <div class="page-header-actions">
            @can('create_account', $loggedInUser)
            {!! link_to('#accountModal', 'Create a New Account', ['class' => 'btn btn-primary btn-sm', 'data-toggle' => 'modal']) !!}
            @endcan
        </div>
    </div>
    <div class="page-content container-fluid">
        <div class="panel">
            <div class="panel-body container-fluid">
                <table class="table display table-condensed table-hover dataTable table-striped width-full" id="exampleFixedHeader">
                    <thead>
                        <tr>
                            <th>Account #</th>
                            <th>Account Type</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Account Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach( $accounts as $account )
                        <tr>
                            <td>{!! $account->id !!}</td>
                            <td>{!! $accessor->array['accountType'][$account->account_type]['value'] !!}</td>
                            <td>{!! $account->owner->full_name !!}</td>
                            <td>{!! $account->owner->username !!}</td>
                            <td>{!! $account->owner->email !!}</td>
                            <td>{!! $account->owner->phone_number !!}</td>
                            <td>
                                @ifIsAdmin()

                                    {!! link_to_route(
                                        'admin.active.update',
                                        'Active',
                                        [$account->owner->id, 0],
                                        [
                                            'id' => 'active-user-' . $account->owner->id,
                                            'class' => 'btn btn-success btn-sm active-status ' . ( $account->owner->active == '0' ? 'hide' : ''),
                                            'data-confirm' => 'remote',
                                            'data-hide' => '#active-user-' . $account->owner->id,
                                            'data-unhide' => '#deactive-user-' . $account->owner->id
                                        ]
                                    ) !!}

                                    {!! link_to_route(
                                        'admin.active.update',
                                        'Inactive',
                                        [$account->owner->id, 1],
                                        [
                                            'id' => 'deactive-user-' . $account->owner->id,
                                            'class' => 'btn btn-success btn-sm inactive-status ' . ( $account->owner->active == '1' ? 'hide' : ''),
                                            'data-confirm' => 'remote',
                                            'data-hide' => '#deactive-user-'.$account->owner->id,
                                            'data-unhide' => '#active-user-'.$account->owner->id
                                        ]
                                    ) !!}

                                @endif
                            </td>
                            <td>
                                {!! link_to_route('admin.user.view', 'View', $account->owner->id, ['class' => 'btn btn-primary btn-sm'])  !!}
                                {!! link_to('#modal', 'God Mode', [
                                    'class' => 'btn btn-danger btn-sm god-mode',
                                    'data-toggle' => 'modal',
                                    'data-pop' => 'true',
                                    'data-form' => '#godModeForm',
                                    'data-value' => '{ "user_id":"' . $account->owner->id . '", "name":"' . $account->owner->fullName . '", "email":"' . $account->owner->email . '", "phone":"' . $account->owner->phone_number . '", "description":""}',
                                    'role' => 'button'
                                ]) !!}

                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('admin.history.create', ['modalId' => 'modal'])
    @include('account.create', ['modalId' => 'accountModal'])



@stop()

@section('scripts')
    @if ($errors->any())
        <script type="text/javascript">
            $('#accountModal').modal();
        </script>
    @endif
@stop()