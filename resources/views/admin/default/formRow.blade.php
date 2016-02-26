
{!! Form::hidden('tableName', $table->name) !!}

@foreach($table->columns as $column)

    <div class="form-group margin-bottom-5">
        {!! Form::label('column['.$column.']', $column, ['class' => 'col-sm-3 control-label no-padding-right']) !!}
        <div class="col-sm-9">
            {!! Form::text('column['.$column.']', null, ['class' => 'col-sm-10 form-control required-field', 'required']) !!}
        </div>
    </div>

@endforeach