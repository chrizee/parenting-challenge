@extends('admin.layouts.app')

@section('content')
    <div class="row" style="margin-left: 15px; margin-bottom: 1em;">
        <a href="{{route("parentingquiz.index")}}"><button class="btn btn-sm btn-default"><i class="fa fa-arrow-circle-left"></i> Back</button></a>
    </div>
    <section class="col-lg-7 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-comments-o"></i>

                <h3 class="box-title">Parenting Quiz</h3>

                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @if(count($parentingQuiz) > 0)
                        <div class="well">
                            Question: {!! $parentingQuiz->question !!}
                            <ol type="A">
                                <li>{{ $parentingQuiz->optionA }}</li>
                                <li>{{ $parentingQuiz->optionB }}</li>
                                <li>{{ $parentingQuiz->optionC }}</li>
                            </ol>
                            <p class="text">Answer: {{ $parentingQuiz->answer }}</p>
                            <P class="text text-info">Tip: {{ $parentingQuiz->tip }}</P>
                            <h4 class="text text-bold">Description: </h4>
                            <blockquote class="blockquote-yellow">{!! $parentingQuiz->description !!}</blockquote>
                            <a href="/admin/parentingquiz/{{ $parentingQuiz->id }}/edit"><button  class="btn btn-primary btn-sm">Edit</button></a>
                            {{ Form::open(['action' => ['Admin\ParentingQuizzesController@destroy', $parentingQuiz->id], 'method' => "POST", 'class' => 'pull-right']) }}
                                {{ method_field('DELETE') }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) }}
                            {{ Form::close() }}
                        </div>
                @else
                    <p>select a valid quiz.</p>
                @endif
            </div>
            <!-- /.chat -->
            <div class="box-footer">

            </div>
        </div>

    </section>

    <section class="col-lg-5 connectedSortable">

        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-info"></i>

                <h3 class="box-title">Question's Info</h3>

                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="center-block">
                    <img class="center-block thumbnail img-responsive" src="/storage/quiz/parent/{{ $parentingQuiz->image }}" alt="question image" />
                </div>
                @if(count($parentingQuiz) > 0)
                    <div class="well-sm">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <tr>
                                    <th>Number of times answered correctly</th>
                                    <td>{{ $parentingQuiz->right }}</td>
                                </tr>
                                <tr>
                                    <th>Number of times answered wrongly</th>
                                    <td>{{ $parentingQuiz->wrong }}</td>
                                </tr>
                                <tr>
                                    <th>Last modified </th>
                                    <td>{{ $parentingQuiz->updated_at }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @else
                    <p>select a valid quiz.</p>
                @endif
            </div>
            <!-- /.chat -->
            <div class="box-footer">

            </div>
        </div>

    </section>

@endsection