@extends('admin.layouts.app')

@section('content')
    <div class="row" style="margin-left: 15px; margin-bottom: 1em;">
        <a href="/admin/parentingtips"><button class="btn btn-sm btn-default"><i class="fa fa-arrow-circle-left"></i> Back</button></a>
    </div>
    <section class="col-lg-7 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-comments-o"></i>

                <h3 class="box-title">Parenting Tip</h3>

                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @if(count($parentingTips) > 0)
                    <div class="well">
                        <p class="text">Tip: {!! $parentingTips->tip !!}</p>
                    </div>
                @else
                    <p>select a valid quote.</p>
                @endif
            </div>
            <div class="box-footer">
                <div class="col-md-3 col-md-offset-9">
                    <a href="/admin/parentingtips/{{ $parentingTips->id }}/edit"><button  class="btn btn-primary btn-sm">Edit</button></a>
                    {{ Form::open(['action' => ['ParentingTipsController@destroy', $parentingTips->id], 'method' => "POST", 'class' => 'pull-right']) }}
                    {{ Form::hidden('_method', "DELETE") }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>

    </section>

    <section class="col-lg-5 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-photo"></i>

                <h3 class="box-title">Image</h3>

                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @if(count($parentingTips) > 0)
                    <div class="center-block">
                        <img src="/storage/tips/parent/{{ $parentingTips->image }}" class="center-block thumbnail img-responsive" />
                    </div>
                @else
                    <p>No image.</p>
                @endif
            </div>
            <!-- /.chat -->
            <div class="box-footer">

            </div>
        </div>

    </section>

@endsection