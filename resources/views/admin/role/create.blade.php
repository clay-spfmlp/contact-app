@extends('layouts.modal')

@section('form-open')
    {!! Form::open(['route' => 'admin.role.store', 'id' => 'createRowForm', 'class' => 'form-horizontal', 'role' => 'form' ]) !!}
@stop

@section('header')
    Create a New Role
@stop

@section('body')
    @include('admin.roles.form')
@stop

@section('modal-footer')
    <button type="button" class="btn btn-sm btn-link" data-dismiss="modal" aria-hidden="true">Cancel</button>
    {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
@stop

@section('form-close')
    {!! Form::close() !!}
@stop