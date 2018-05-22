@extends('admin.layouts.app')

@section('content')
    <div class="row" style="margin-left: 15px; margin-bottom: 1em;">
        <a href="{{ route('babyquiz.create') }}"><button class="btn btn-sm btn-success">Add Questions <i class="fa fa-plus"></i></button></a>
    </div>
    <section class="col-lg-12 connectedSortable">

        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-comments-o"></i>

                <h3 class="box-title">Baby Quiz <small class="text text-sm text-info">{{ count($babyQuiz) }} {{  (count($babyQuiz) == 1) ? 'question' : 'questions' }}</small></h3>

                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @if(count($babyQuiz) > 0)
                    @foreach($babyQuiz as $key => $value)
                        <div class="well">
                            {!! ($key+ 1).". ".$value->question !!}
                            <ol type="A">
                                <li>{{ $value->optionA }}</li>
                                <li>{{ $value->optionB }}</li>
                                <li>{{ $value->optionC }}</li>
                            </ol>
                            <p class="text">Answer: {{ $value->answer }}</p>
                            <P class="text text-info">Tip: {{ $value->tip }}</P>
                            <div class="row">
                                <div class="col-md-3 col-md-offset-9">
                                    <a href="babyquiz/{{ $value->id }}"><button  class="btn btn-info btn-sm">View</button></a>
                                    <a href="babyquiz/{{ $value->id }}/edit"><button  class="btn btn-warning btn-sm">Edit</button></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No quiz yet.</p>
                @endif
            </div>
            <!-- /.chat -->
            <div class="box-footer">

            </div>
        </div>

    </section>

@endsection