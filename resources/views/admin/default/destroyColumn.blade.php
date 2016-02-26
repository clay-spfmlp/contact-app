<div class="modal fade" id="modalDestroyColumn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'admin.default.column.destroy', 'id' => 'destroyColumnForm', 'class' => 'form-horizontal', 'role' => 'form' ]) !!}
    			{!! Form::hidden('tableName', $name) !!}
                <div class="modal-header">
                    <button type="button" class="close close-contact-info" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Remove a Colum</h4>
                </div>
                <div class="modal-body padding-side-10">
                    <div class="space-6"></div>

                    @foreach($table->columns as $column)

                        <div style="padding-left: 10px">
                            <label>{!! Form::checkbox($column, $column, false) !!} {!! $column !!}</label>
                        </div>

                    @endforeach

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-link" data-dismiss="modal" aria-hidden="true">Cancel</button>
    				{!! Form::submit('Remove', ['class' => 'btn btn-sm btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>