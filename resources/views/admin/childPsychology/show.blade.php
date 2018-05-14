@extends('admin.layouts.app')

@section('content')
    <div class="row" style="margin-left: 15px; margin-bottom: 1em;">
        <a href="/admin/childpsychology"><button class="btn btn-sm btn-default"><i class="fa fa-arrow-circle-left"></i> Back</button></a>
    </div>
    <section class="col-lg-7 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-comments-o"></i>

                <h3 class="box-title">Child Psychology</h3>

                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @if(count($childPsychology) > 0)
                    <div class="well">
                        <p class="text">Quote: {!! $childPsychology->quote !!} </p>
                        <!--<a href="/admin/childpsychology/{{ $childPsychology->id }}/edit"><button  class="btn btn-primary btn-sm">Edit</button></a>-->
                    </div>
                @else
                    <p>select a valid quote.</p>
                @endif
            </div>
            <div class="box-footer">
                <div class="col-md-3 col-md-offset-9">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editquote">Edit</button>
                    {{ Form::open(['action' => ['ChildPsychologiesController@destroy', $childPsychology->id], 'method' => "POST", 'class' => 'pull-right']) }}
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
                @if(count($childPsychology) > 0)
                    <div class="center-block">
                        <img src="/storage/psychology/child/{{ $childPsychology->image }}" class="center-block thumbnail img-responsive" />
                    </div>
                @else
                    <p>No image.</p>
                @endif
            </div>
            <!-- /.chat -->
            <div class="box-footer">

            </div>
        </div>

        <div class="example-modal">
            <div id="editquote" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Edit quote</h4>
                            <p class="passengererror text-danger"></p>
                        </div>
                        <div class="modal-body">
                            {!! Form::model($childPsychology, ['action' => ['ChildPsychologiesController@update', $childPsychology->id], 'method' => "POST", 'enctype' => 'multipart/form-data']) !!}

                            <div class="form-group">
                                <label>Quote</label>
                                {{Form::textarea('quote', $childPsychology->quote, ['id' => 'article-ckeditor', 'class' => 'form-control'])}}
                            </div>

                            <div class="form-group">
                                <label>Change image</label>
                                {{Form::file('image', ['class' => 'form-control'])}}
                            </div>

                            <div class="box-footer">
                                {{Form::hidden('_method', 'PUT')}}
                                {{ Form::submit('Update', ['class' => ' pull-right btn btn-success btn-sm']) }}
                                {!! Form::close() !!}


                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </div>
    </section>

@endsection