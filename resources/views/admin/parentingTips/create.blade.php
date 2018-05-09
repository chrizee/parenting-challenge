@extends('admin.layouts.app')

@section('content')
    <div class="row" style="margin-left: 15px; margin-bottom: 1em;">
        <a href="/admin/parentingtips"><button class="btn btn-sm btn-default"><i class="fa fa-arrow-circle-left"></i> Back</button></a>
    </div>
    <section class="col-lg-7 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-comments-o"></i>

                <h3 class="box-title">Parenting tip</h3>

                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                {!! Form::open(['action' => 'ParentingTipsController@store', 'method' => "POST"]) !!}

                <div class="form-group">
                    <label>Tip</label>
                    {{Form::textarea('tip', '', ['id' => 'article-ckeditor', 'class' => 'form-control'])}}
                </div>
                
                <div class="box-footer">
                    {{ Form::submit('Send', ['class' => 'btn btn-success btn-sm']) }}
                </div>
                {!! Form::close() !!}
            </div>

        </div>

    </section>
@endsection