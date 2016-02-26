@extends('layouts.modal')

@section('form-open')
    {!! Form::open(['route' => 'admin.default.store', 'id' => 'createDefaultForm', 'class' => 'form-horizontal', 'role' => 'form' ]) !!}
@stop

@section('header')
    Create a New Application Data Table
@stop

@section('body')
    @include('admin.default.form')
@stop

@section('modal-footer')
    <button type="button" class="btn btn-sm btn-link" data-dismiss="modal" aria-hidden="true">Cancel</button>
    {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
@stop

@section('form-close')
    {!! Form::close() !!}
@stop