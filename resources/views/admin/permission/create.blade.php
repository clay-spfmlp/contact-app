@extends('layouts.modal')

@section('form-open')
    {!! Form::open(['route' => 'admin.permission.store', 'id' => 'createPermissionForm', 'class' => 'form-horizontal', 'role' => 'form' ]) !!}
@stop

@section('header')
    Create a New Permission
@stop

@section('body')
    @include('admin.permissions.form')
@stop

@section('modal-footer')
    <button type="button" class="btn btn-sm btn-link" data-dismiss="modal" aria-hidden="true">Cancel</button>
    {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
@stop

@section('form-close')
    {!! Form::close() !!}
@stop