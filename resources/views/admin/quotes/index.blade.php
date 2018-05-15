@extends('admin.layouts.app')

@section('content')
    <div class="row" style="margin-left: 15px; margin-bottom: 1em;">
        <button class="btn btn-sm btn-success addQuote">Add quote <i class="fa fa-plus"></i></button>
    </div>
    <section class="col-lg-6 connectedSortable">

        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-comments-o"></i>

                <h3 class="box-title">Quotes <small class="text text-sm text-info">{{ count($quotes) }} {{  (count($quotes) == 1) ? 'quote' : 'quotes' }} </small></h3>

                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @if(count($quotes) > 0)
                    @foreach($quotes as $key => $value)
                        <div class="well">
                            <blockquote class="center-block blockquote-yellow">{!! $value->quote !!}
                                @if($value->person != '')
                                    <p class="text text-right person"> {!! $value->person !!}</p>
                                @else
                                    <p class="text text-right person"> anonymous</p>
                                @endif
                            </blockquote>
                            <div class="row">
                                <div class="col-md-3 col-md-offset-9">
                                    <a href="quotes/{{ $value->id }}"><button class="btn btn-warning btn-sm">View</button></a>
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

    <section class="col-lg-6 connectedSortable hidden addForm">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-comments-o"></i>

                <h3 class="box-title">Add Quote</h3>

                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                {!! Form::open(['action' => 'Admin\QuotesController@store', 'method' => "POST", 'enctype' => 'multipart/form-data']) !!}

                <div class="form-group">
                    {{ Form::label('quote', 'Quote') }}
                    {{Form::textarea('quote', '', ['id' => 'article-ckeditor', 'class' => 'form-control'])}}
                </div>

                <div class="form-group">
                    {{ Form::label('person', 'Person') }}
                    {{ Form::text('person', '', ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('image', 'Image') }}
                    {{ Form::file('image', ['class' => 'form-control']) }}
                </div>

                <div class="box-footer">
                    {{ Form::submit('Add', ['class' => 'pull-right btn btn-success btn-sm']) }}
                </div>
                {!! Form::close() !!}
            </div>

        </div>

    </section>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', 'button.addQuote', function(e) {
            if($('section.addForm').hasClass('hidden')) {
                $('a.sidebar-toggle').click();
                $('section.addForm').removeClass('hidden');
            }else {
                $('a.sidebar-toggle').click();
                $('section.addForm').addClass('hidden');
            }
        })
    })
</script>
@endsection()