@extends('admin.layouts.app')

@section('content')
    <div class="row" style="margin-left: 15px; margin-bottom: 1em;">
        <a href="/admin/babyfact/create"><button class="btn btn-sm btn-success">Add baby fact <i class="fa fa-plus"></i></button></a>
    </div>
    <section class="col-lg-7 connectedSortable">

        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-comments-o"></i>

                <h3 class="box-title">Baby Fact <small class="text text-sm text-info">{{ count($babyFact) }} {{  (count($babyFact) == 1) ? 'fact' : 'facts' }} </small></h3>

                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @if(count($babyFact) > 0)
                    @foreach($babyFact as $key => $value)
                        <div class="well">
                            <p class="text">{{ ($key+ 1).". ".$value->fact}}</p>
                            <a href="babyfact/{{ $value->id }}/edit"><button  class="btn btn-warning btn-sm">Edit</button></a>
                        </div>
                    @endforeach
                @else
                    <p>No fact yet.</p>
                @endif
            </div>
            <!-- /.chat -->
            <div class="box-footer">

            </div>
        </div>

    </section>

@endsection()