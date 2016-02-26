<div class="modal fade" id="modalCreateColumn" tabindex="-1" role="dialog" aria-labelledby="modalCreateColumn" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">
            {!! Form::open(['route' => 'admin.default.column.store', 'id' => 'createColumnForm', 'class' => 'form-horizontal', 'role' => 'form' ]) !!}
    			{!! Form::hidden('name', $name) !!}
                <div class="modal-header">
                    <button type="button" class="close close-contact-info" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add a New Column</h4>
                </div>

                <div class="modal-body padding-side-10">
                    <div class="space-6"></div>
                    @include('admin.default.formColumn')
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-link" data-dismiss="modal" aria-hidden="true">Cancel</button>
    				{!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>