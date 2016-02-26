@extends('layouts.master')

@section('content')
    <div id="breadcrumbs" class="breadcrumbs breadcrumbs-fixed">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-tachometer"></i>
                <a href="{!! url('dashboard') !!}">Dashboard</a>
            </li>
            <li>
                <a href="{!! url('user') !!}">User Management</a>
            </li>
            <li class="active">Create User</li>
        </ul>
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>Create Account<small><i class="ace-icon fa fa-angle-double-right"></i> add a new admin account</small></h1>
        </div>
        <div class="row">
            <div class="col-xs-12 margin-top-10">
                {!! Form::open(array('route'=>'admin.store.account', 'class'=>'form-horizontal', 'id'=>'create-user-form', 'role'=>'form')) !!}
                    {!! Form::hidden('user_type', 1) !!}
                    <div class="form-group">
                        {!! Form::label('first_name', 'First Name', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('first_name', null, ['class'=>'col-xs-10 col-sm-5 field-required']) !!}
                        </div>
                        {!! '<span class="text-danger col-sm-10 col-sm-offset-3">'.$errors->first('first_name').'</span>' !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('last_name', 'Last Name', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('last_name', null, ['class'=>'col-xs-10 col-sm-5 field-required']) !!}
                        </div>
                        {!! '<span class="text-danger col-sm-10 col-sm-offset-3">'.$errors->first('last_name').'</span>' !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('city', 'City', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('city', null, ['class'=>'col-xs-10 col-sm-5']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('state', 'State', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('state', null, ['class'=>'col-xs-10 col-sm-5']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('zipcode', 'Zip Code', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('zipcode', null, ['class'=>'col-xs-10 col-sm-5']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'Email', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
                        <div class="col-sm-9">
                            {!! Form::email('email', null, ['class'=>'col-xs-10 col-sm-5 field-required']) !!}
                        </div>
                        {!! '<span class="text-danger col-sm-10 col-sm-offset-3">'.$errors->first('email').'</span>' !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('phone_number', 'Phone Number', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('phone_number', null, ['class'=>'col-xs-10 col-sm-5 input-mask-phone']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('username', 'Username', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('username', null, ['class'=>'col-xs-10 col-sm-5 field-required']) !!}
                            <span class="help-inline col-xs-12 col-sm-7 blue">
                            <span class="username-validate hide ace-icon fa fa-circle-o-notch fa-spin bigger-110"></span>
                            <span class="username-validate hide bigger-110">Validating...</span>
                            <span class="username-error hide red bigger-110">Username is already taken.</span>
                        </span>
                        </div>
                        {!! '<span class="text-danger col-sm-10 col-sm-offset-3">'.$errors->first('username').'</span>' !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', 'Password', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
                        <div class="col-sm-9">
                            {!! Form::password('password', ['class'=>'col-xs-10 col-sm-5 field-required']) !!}
                        </div>
                        {!! '<span class="text-danger col-sm-10 col-sm-offset-3">'.$errors->first('password').'</span>' !!}
                    </div>
                    <div class="clearfix form-actions">
                        <div class="col-md-offset-3 col-md-9">
                            {!! link_to_route('admin.users', 'cancel', null, ['class' => 'btn btn-sm btn-link']) !!}
                            {!! Form::submit('Save', ['class' => 'btn btn-sm btn-primary', 'id' => 'save-user', 'data-loading-text' => '<i class="ace-icon fa fa-circle-o-notch fa-spin"></i> Saving...']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop()