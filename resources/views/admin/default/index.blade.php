@extends('layouts.master')

@section('content')
    <div class="page-header">
        <h1  class="page-title">Application Data</h1>
        <div class="page-header-actions">
            {!! HTML::decode(link_to('#modal', '<i class="icon fa-table" aria-hidden="true"></i> Create a New Application Data Table', ['class' => 'btn btn-primary btn-sm', 'data-toggle' => 'modal', 'role' => 'button'])) !!}
        </div>
    </div>

    <div class="page-content container-fluid">

        <div class="panel">
            <div class="panel-body container-fluid">
                <table class="table table-condensed table-hover table-striped dataTable width-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td style="text-align: right">Actions</td>
                        </tr>
                    </thead>
                @foreach($accessor->tables as $table)
                    <tr id="{{ $table }}">
                        <td>{!! link_to_route('admin.default.show', $table, $table)   !!}</td>
                        <td style="text-align: right">
                            {{--{!! link_to_route('admin.default.show', 'View', $table,--}}
                                {{--['class' => 'btn btn-sm btn-primary', 'role' => 'button']) !!}--}}

                            {!! HTML::decode(link_to_route('admin.default.destroy', '<i class="icon glyphicon glyphicon-remove" aria-hidden="true"></i>', $table,
                                ['class' => 'red-600',
                                 'data-confirm' => 'remote',
                                 'role' => 'button',
                                 'data-hide' => '#'.$table])) !!}
                        </td>
                    </tr>
                @endforeach
                </table>
            </div>
        </div>
    </div>

    @include('admin.default.create', ['modalId' => 'modal'])

@stop()

@section('scripts')
    {!! HTML::script('js/dataTables.min.js') !!}
@stop()