@extends('admin.layouts.app')

@section('content')
    <div class="row" style="margin-left: 15px; margin-bottom: 1em;">
        <a href="{{url()->previous()}}"><button class="btn btn-sm btn-default">Go back <i class="fa fa-link"></i></button></a>
    </div>
    <section class="col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-edit"></i>

                <h3 class="box-title">Parenting Quiz</h3>

                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                {!! Form::model($parentingQuiz, ['action' => ['Admin\ParentingQuizzesController@update', $parentingQuiz->id], 'method' => "POST", 'enctype' => 'multipart/form-data']) !!}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Question</label>
                            {{Form::textarea('question', $parentingQuiz->question, ['id' => 'article-ckeditor', 'class' => 'form-control'])}}
                        </div>

                        <div class="form-group">
                            <label></label>
                            {{Form::label('description', 'Description')}}
                            {{Form::textarea('description', $parentingQuiz->description, ['id' => 'article-ckeditor1', 'class' => 'form-control'])}}
                        </div>

                        <div class="options">
                            <div class="form-group">
                                {{Form::label('tip', 'Tip')}}
                                <div class="input-group">
                                    {{Form::text('tip', $parentingQuiz->tip, ['class' => 'form-control'])}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="options">
                            <div class="form-group">
                                {{Form::label('optionA', 'Option A')}}
                                <div class="input-group">
                                    {{Form::text('optionA', $parentingQuiz->optionA, ['class' => 'form-control'])}}
                                </div>
                            </div>
                        </div>

                        <div class="options">
                            <div class="form-group">
                                {{ Form::label('optionB', 'Option B')}}
                                <div class="input-group">
                                    {{Form::text('optionB', $parentingQuiz->optionB, ['class' => 'form-control'])}}
                                </div>
                            </div>
                        </div>

                        <div class="options">
                            <div class="form-group">
                                {{ Form::label('optionC', 'Option C')}}
                                <div class="input-group">
                                    {{Form::text('optionC', $parentingQuiz->optionC, ['class' => 'form-control'])}}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="radio">
                                <label>Select the answer &nbsp;</label>
                                <label>
                                    {{ Form::radio('answer', 'A') }} A
                                </label>
                                <label>
                                    {{ Form::radio('answer', 'B') }} B
                                </label>
                                <label>
                                    {{ Form::radio('answer', 'C') }} C
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('image', 'Change image (optional)')}}
                            <div class="input-group">
                                {{Form::file('image', ['class' => 'form-control'])}}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        {{ method_field('PUT') }}
                        {{ Form::submit('Update', ['class' => 'pull-right btn btn-success btn-sm']) }}
                    </div>
                {!! Form::close() !!}
            </div>

        </div>

    </section>

    <!-- iCheck -->
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
    <script type="text/javascript">
        //$(document).ready(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
        CKEDITOR.replace( 'article-ckeditor1' );
        //});
    </script>
@endsection