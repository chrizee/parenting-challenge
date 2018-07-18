@extends('admin.layouts.app')

@section('content')
    <div class="row" style="margin-left: 15px; margin-bottom: 1em;">
        <a href="{{route("babyfact.index")}}"><button class="btn btn-sm btn-default"><i class="fa fa-arrow-circle-left"></i> Back</button></a>
    </div>
    <section class="col-lg-7 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-comments-o"></i>

                <h3 class="box-title">Baby Fact</h3>

                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @if(count($babyFact) > 0)
                    <div class="well">
                        <p class="text">Fact: {!! $babyFact->fact !!}</p>
                    </div>
                @else
                    <p>select a valid fact.</p>
                @endif
            </div>
            <div class="box-footer">
                <div class="col-md-3 col-md-offset-9">
                    <a href="{{ route('babyfact.edit', $babyFact->id) }}"><button  class="btn btn-warning btn-sm">Edit</button></a>
                    {{ Form::open(['action' => ['Admin\BabyFactsController@destroy', $babyFact->id], 'method' => "POST", 'class' => 'pull-right']) }}
                    {{ method_field('DELETE') }}
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
                @if(count($babyFact) > 0)
                    <div class="center-block">
                        <img src="/storage/baby_facts/{{ $babyFact->image }}" class="center-block thumbnail img-responsive" />
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