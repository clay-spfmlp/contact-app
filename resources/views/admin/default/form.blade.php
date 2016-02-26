{!! Form::hidden('id', 'id') !!}
<div class="form-group margin-bottom-5">
    {!! Form::label('tableName', 'Name of Table', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
    <div class="col-sm-9">
        {!! Form::text('tableName', null, ['class' => 'col-sm-10 form-control required-field', 'required']) !!}
    </div>
</div>
<div class="form-group margin-bottom-5">
    {!! Form::label('idValue', 'ID', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
    <div class="col-sm-9">
        {!! Form::text('idValue', 1, ['class' => 'col-sm-10 form-control required-field', 'required']) !!}
    </div>
</div>

<div class="form-group margin-bottom-5">
    {!! Form::label('nameColumn', 'Column Name', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
    <div class="col-sm-9">
        {!! Form::text('nameColumn', 'name', ['class' => 'col-sm-10 form-control required-field', 'required']) !!}
    </div>
</div>
<div class="form-group margin-bottom-5">
    {!! Form::label('nameValue', 'Value', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
    <div class="col-sm-9">
        {!! Form::text('nameValue', null, ['class' => 'col-sm-10 form-control required-field', 'required']) !!}
    </div>
</div>