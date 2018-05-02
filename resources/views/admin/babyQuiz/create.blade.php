@extends('admin.layouts.app')

@section('content')
    <div class="row" style="margin-left: 15px; margin-bottom: 1em;">
        <a href="/admin/babyquiz"><button class="btn btn-sm btn-default"><i class="fa fa-arrow-circle-left"></i> Back</button></a>
    </div>
    <section class="col-lg-7 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-comments-o"></i>

                <h3 class="box-title">Baby Quiz</h3>

                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                {!! Form::open(['action' => 'BabyQuizzesController@store', 'method' => "POST"]) !!}

                <div class="form-group">
                    <label>Question</label>
                    {{Form::textarea('question', '', ['id' => 'article-ckeditor', 'class' => 'form-control'])}}
                </div>

                <div class="options">
                    <div class="form-group">
                        {{Form::label('optionA', 'Option A')}}
                        <div class="input-group">
                            {{Form::text('optionA', '', ['class' => 'form-control'])}}
                        </div>
                    </div>
                </div>

                <div class="options">
                    <div class="form-group">
                        {{ Form::label('optionB', 'Option B')}}
                        <div class="input-group">
                            {{Form::text('optionB', '', ['class' => 'form-control'])}}
                        </div>
                    </div>
                </div>

                <div class="options">
                    <div class="form-group">
                        {{ Form::label('optionC', 'Option C')}}
                        <div class="input-group">
                            {{Form::text('optionC', '', ['class' => 'form-control'])}}
                        </div>
                    </div>
                </div>

                <div class="options">
                    <div class="form-group">
                        {{ Form::label('optionD', 'Option D')}}
                        <div class="input-group">
                            {{Form::text('optionD', '', ['class' => 'form-control'])}}
                        </div>
                    </div>
                </div>

                <div class="options">
                    <div class="form-group">
                        {{ Form::label('optionE', 'Option E')}}
                        <div class="input-group">
                            {{Form::text('optionE', '', ['class' => 'form-control'])}}
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
                        <label>
                            {{ Form::radio('answer', 'D') }} D
                        </label>
                        <label>
                            {{ Form::radio('answer', 'E') }} E
                        </label>
                    </div>
                </div>
                <div class="box-footer">
                    {{ Form::submit('Send', ['class' => 'btn btn-success btn-sm']) }}
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
        //});
    </script>
@endsection