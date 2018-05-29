@extends('admin.layouts.app')

@section('content')
    <div class="row" style="margin-left: 15px; margin-bottom: 1em;">
        <button class="btn btn-sm btn-success addQuote">New Broadcast <i class="fa fa-plus"></i></button>
    </div>
    <section class="col-lg-6 connectedSortable">

        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-comments-o"></i>

                <h3 class="box-title">Sent Broadcasts <small class="text text-sm text-info">{{ count($broadcasts) }} {{  (count($broadcasts) == 1) ? 'broadcast' : 'broadcasts' }} </small></h3>

                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @if(count($broadcasts) > 0)
                    @foreach($broadcasts as $key => $value)
                        <div class="well">
                            <blockquote class="center-block blockquote-yellow">{!! $value->message !!}
                                <p class="text text-right person">Date sent: {{ $value->created_at->toFormattedDateString() }}</p>
                            </blockquote>
                        </div>
                    @endforeach
                @else
                    <p>No broadcast sent.</p>
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

                <h3 class="box-title">Compose Message/Tip/Fact</h3>

                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                {!! Form::open(['action' => 'Admin\BroadcastsController@store', 'method' => "POST", 'enctype' => 'multipart/form-data']) !!}

                <div class="form-group">
                    {{ Form::label('message', 'Message/Tip/Fact') }}
                    {{Form::textarea('message', '', ['id' => 'article-ckeditor', 'class' => 'form-control'])}}
                </div>

                <div class="box-footer">
                    {{ Form::submit('Send', ['class' => 'pull-right btn btn-success btn-sm']) }}
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