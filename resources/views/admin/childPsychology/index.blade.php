@extends('admin.layouts.app')

@section('content')
    <div class="row" style="margin-left: 15px; margin-bottom: 1em;">
        <a href="/admin/childpsychology/create"><button class="btn btn-sm btn-success">Add quote <i class="fa fa-plus"></i></button></a>
    </div>
    <section class="col-lg-7 connectedSortable">

        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-comments-o"></i>

                <h3 class="box-title">Child Psychology <small class="text text-sm text-info">{{ count($childPsychology) }} {{  (count($childPsychology) == 1) ? 'quote' : 'quotes' }} </small></h3>

                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @if(count($childPsychology) > 0)
                    @foreach($childPsychology as $key => $value)
                        <div class="well">
                            {!! ($key+ 1).". ".$value->quote !!}</p>
                            <div class="row">
                                <div class="col-md-3 col-md-offset-9">
                                    <a href="childpsychology/{{ $value->id }}"><button  class="pull-right btn btn-info btn-sm">view</button></a>
                                    <!--<a href="childpsychology/{{ $value->id }}/edit"><button  class="btn btn-warning btn-sm">Edit</button></a>-->
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No quote yet.</p>
                @endif
            </div>
            <!-- /.chat -->
            <div class="box-footer">

            </div>
        </div>

    </section>

@endsection()