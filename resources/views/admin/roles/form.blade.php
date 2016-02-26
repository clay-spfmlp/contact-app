
<div class="form-group margin-bottom-5">
    {!! Form::label('name', 'Role Name', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
    <div class="col-sm-9">
        {!! Form::text('name', null, ['class' => 'col-sm-10 form-control required-field', 'required']) !!}
    </div>
</div>
<div class="form-group margin-bottom-5">
    {!! Form::label('display_name', 'Display Name', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
    <div class="col-sm-9">
        {!! Form::text('display_name', null, ['class' => 'col-sm-10 form-control required-field', 'required']) !!}
    </div>
</div>
<div class="form-group margin-bottom-5">
    {!! Form::label('description', 'Description', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
    <div class="col-sm-9">
        {!! Form::textarea('description', null, ['class' => 'col-sm-10 form-control',]) !!}
    </div>
</div>
