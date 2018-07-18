@extends('admin.layouts.app')

@section('content')
    <div class="row" style="margin-left: 15px; margin-bottom: 1em;">
        <a href="{{route("quotes.index")}}"><button class="btn btn-sm btn-success"><i class="fa fa-arrow-circle-left"></i> Back</button></a>
    </div>
    <section class="col-lg-6 connectedSortable">

        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-comments-o"></i>

                <h3 class="box-title">Quote </h3>

                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @if(count($quote) > 0)
                    <div class="well">
                        <blockquote class="blockquote-yellow">{!! $quote->quote !!}
                            @if($quote->person != '')
                                <p class="text text-right person"> {!! $quote->person !!}</p>
                            @else
                                <p class="text text-right person"> anonymous</p>
                            @endif
                        </blockquote>
                        <button  class="btn btn-warning btn-sm editQuote">Edit</button>
                    </div>
                @else
                    <p>Select a valid quote.</p>
                @endif
            </div>
            <!-- /.chat -->
            <div class="box-footer">
                {{ Form::open(['action' => ['Admin\QuotesController@destroy', $quote->id], 'method' => "POST", 'class' => 'pull-right']) }}
                    {{ method_field('DELETE') }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) }}
                {{ Form::close() }}
            </div>
        </div>

    </section>

    <section class="col-lg-6 connectedSortable">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-image header-icon"></i>

                <h3 class="box-title header-title">Image</h3>

                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="center-block image">
                    @if($quote->image != '')
                            <img alt="Quote image" class="center-block img-responsive img-thumbnail" src="/storage/quotes/{{ $quote->image }}" />
                    @else
                        <p class="text text-center text-info">No image</p>
                    @endif
                </div>
                {!! Form::model($quote, ['action' => ['Admin\QuotesController@update', $quote->id], 'class' => 'hidden editForm', 'method' => "POST", 'enctype' => 'multipart/form-data' ]) !!}
                    <div class="form-group">
                        {{ Form::label('quote', 'Quote') }}
                        {{ Form::textarea('quote', $quote->quote, ['id' => 'article-ckeditor', 'class' => 'form-control'])}}
                    </div>

                    <div class="form-group">
                        {{ Form::label('person', 'Person') }}
                        {{ Form::text('person', $quote->person, ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('image', 'Image') }}
                        {{ Form::file('image', ['class' => 'form-control']) }}
                    </div>

                    <div class="box-footer">
                        {{ method_field('PUT') }}
                        {{ Form::submit('Update', ['class' => 'pull-right btn btn-success btn-sm']) }}
                    </div>

                {!! Form::close() !!}
            </div>

        </div>

    </section>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', 'button.editQuote', function(e) {
                if($('form.editForm').hasClass('hidden')) {
                    $('a.sidebar-toggle').click();
                    $('i.header-icon').removeClass('fa-image').addClass('fa-edit');
                    $('h3.header-title').text('Edit Quote');
                    $('div.image').addClass('hidden');
                    $('form.editForm').removeClass('hidden');
                }else {
                    $('a.sidebar-toggle').click();
                    $('div.image').removeClass('hidden')
                    $('form.editForm').addClass('hidden');
                    $('i.header-icon').removeClass('fa-edit').addClass('fa-image');
                    $('h3.header-title').text('Image');
                }
            })
        })
    </script>
@endsection()