@extends('layouts.modal')

@section('form-open')
    {!! Form::model($history, ['route' => ['admin.admin_history.update', $history->id], 'id' => 'godModeForm', 'class' => 'form-horizontal', 'role' => 'form']) !!}
    {!! Form::hidden('_method', 'PATCH') !!}
@stop

@section('header')
    Update Ticket
@stop

@section('body')
    @include('admin.history.form')
@stop

@section('modal-footer')
    <button type="button" class="btn btn-sm btn-link close-contact-info" data-dismiss="modal" aria-hidden="true">Cancel</button>
    {!! Form::submit('Update', ['class' => 'btn btn-sm btn-success']) !!}
@stop

@section('form-close')
    {!! Form::close() !!}
@stop