@extends('layouts.master')

@section('content')

    <div class="page-header">
        <h1 class="page-title">{{ $table->name }}</h1>
        <div class="page-header-actions">
            {!! HTML::decode(link_to('#modalCreateRow', 'Add a New Row', ['class' => 'btn btn-primary btn-sm', 'data-toggle' => 'modal', 'role' => 'button',])) !!}
            {!! HTML::decode(link_to('#modalCreateColumn', 'Add a New Column', ['class' => 'btn btn-primary btn-sm', 'data-toggle' => 'modal', 'role' => 'button'])) !!}
            {!! HTML::decode(link_to('#modalDestroyColumn', 'Remove a Column', ['class' => 'btn btn-primary btn-sm', 'data-toggle' => 'modal', 'role' => 'button'])) !!}
        </div>
    </div>

    <div class="page-content container-fluid">
        <div class="panel">
            <div class="panel-body container-fluid">
                <table class="table table-condensed table-hover table-striped dataTable width-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                        @foreach( $table->columns as $column )
                            <th>{{ $column }}</th>
                        @endforeach
                            <th class="sorting_disabled text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach( $table->rows as $row)

                        <tr id="{{ $table->name }}-{{ $table->index() }}" class="">
                        @foreach($row as $text)
                            <td>{{ $text }}</td>
                        @endforeach
                            <td class="text-right">
                                {!! link_to('#', 'Edit', ['class' => 'btn btn-primary btn-sm', 'role' => 'button', 'data-action',
                                'data-unhide' => '#'.$table->name.'-'.$table->index().'-form',
                                'data-hide' => '#'.$table->name.'-'.$table->index()]) !!}

                            {!! link_to_route('admin.default.option.destroy', 'Delete', [$table->name, $table->index()],
                                ['class' => 'btn btn-danger btn-sm', 'data-confirm' => 'remote', 'role' => 'button',
                                  'data-hide' => '#'.$table->name.'-'.$table->index()]) !!}
                            </td>
                        </tr>
                        {{--<tr id="{{ $table->name }}-{{ $table->index() }}-form" class="hide">--}}
                            {{--{!! Form::open(['route' => ['admin.default.row.update', $table->name, $table->name]]) !!}--}}

                            {{--@foreach($row as $column => $text)--}}
                            {{--<td>{!! Form::text('column['.$column.']', $text, ['class' => 'form-control']) !!}</td>--}}
                            {{--@endforeach--}}

                            {{--<td>--}}
                                {{--{!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}--}}

                                {{--{!! link_to('#', 'Cancel', ['class' => 'btn btn-danger btn-sm', 'role' => 'button',--}}
                                    {{--'data-action', 'data-hide' => '#'.$table->name.'-'.$table->index().'-form',--}}
                                    {{--'data-unhide' => '#'.$table->name.'-'.$table->index()])--}}
                                {{--!!}--}}
                            {{--</td>--}}
                            {{--{!! Form::close() !!}--}}
                        {{--</tr>--}}


                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    @include('admin.default.createColumn', ['name' => $table->name])
    @include('admin.default.createRow', ['name' => $table->name, 'modalId' => 'modalCreateRow'])
    @include('admin.default.destroyColumn', ['name' => $table->name])
@stop()

@section('scripts')
    {!! HTML::script('js/dataTables.min.js') !!}
@stop()