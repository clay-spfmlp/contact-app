 @extends('layouts.modal')

@section('form-open')
    {!! Form::open(['route' => 'admin.default.row.store', 'id' => 'createDefaultValueForm', 'class' => 'form-horizontal', 'role' => 'form', 'name' => 'createDefaultValueForm' ]) !!}
@stop

@section('header')
    Add a New Row
@stop

@section('body')
    @include('admin.default.formRow')
@stop

@section('modal-footer')
    <button type="button" class="btn btn-sm btn-link" data-dismiss="modal" aria-hidden="true">Cancel</button>
    {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
@stop

@section('form-close')
    {!! Form::close() !!}
@stop