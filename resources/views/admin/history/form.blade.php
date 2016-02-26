
{!! Form::hidden('user_id', null) !!}
{!! Form::hidden('admin_id', Auth::id()) !!}
<div class="form-group margin-bottom-5">
    {!! Form::label('name', 'Name of Contact', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
    <div class="col-sm-9">
        {!! Form::text('name', null, ['class' => 'col-sm-10 form-control required-field', 'id' => 'godModeName', 'required']) !!}
    </div>
</div>

<div class="form-group margin-bottom-5">
    {!! Form::label('email', 'Email of Contact', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
    <div class="col-sm-9">
        {!! Form::text('email', null, ['class' => 'col-sm-10 form-control', 'id' => 'godModeEmail']) !!}
    </div>
</div>

<div class="form-group margin-bottom-5">
    {!! Form::label('phone', 'Phone of Contact', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
    <div class="col-sm-9">
        {!! Form::text('phone', null, ['class' => 'col-sm-10 form-control', 'id' => 'godModePhone']) !!}
    </div>
</div>

<div class="form-group margin-bottom-5">
    {!! Form::label('description', 'Description', ['class' => 'col-sm-3 control-label no-padding-right']) !!}
    <div class="col-sm-9">
        {!! Form::textarea('description', null, ['class' => 'col-sm-10 form-control', 'id' => 'godModeDescription', 'required']) !!}
    </div>
</div>
