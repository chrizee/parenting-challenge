@extends('admin.layouts.app')

@section('content')
    @if(count($adverts) < $noOfAds)
        <div class="row" style="margin-left: 15px; margin-bottom: 1em;">
            <button class="btn btn-sm btn-success addQuote">Add advert <i class="fa fa-plus"></i></button>
        </div>
    @endif
    <section class="col-lg-6 connectedSortable">

        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-comments-o"></i>

                <h3 class="box-title">Ads <small class="text text-sm text-info">{{ count($adverts) }} {{  (count($adverts) == 1) ? 'ad' : 'ads' }} </small></h3>

                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @if(count($adverts) > 0)
                    @foreach($adverts as $key => $value)
                        <div class="well">
                            <div class="row center-block">
                                <div @empty(!$value->image) class="col-md-7" @endempty>
                                    <h3>{{ $value->heading }}</h3>
                                    {!! $value->ad !!}
                                    <p class="text person">Link: <a href="{{ $value->link }}" target="_blank">{!! $value->link !!}</a></p>
                                </div>
                                @empty(!$value->image)
                                    <div class="col-md-5">
                                        <img class="img-responsive img-thumbnail center-block" src="/storage/adverts/{{ $value->image }}" alt="advert image" />
                                    </div>
                                @endempty
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-md-offset-9">
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#advert{{ $key }}">Edit</button>
                                </div>
                            </div>
                            <div class="example-modal">
                                <div id="advert{{ $key }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Edit advert</h4>
                                                <p class="passengererror text-danger"></p>
                                            </div>
                                            <div class="modal-body">
                                                {!! Form::model($value, ['action' => ['Admin\PagesController@updateAdverts', $value->id], 'method' => "POST", 'enctype' => 'multipart/form-data']) !!}

                                                <div class="form-group">
                                                    {{ Form::label('heading', 'Heading') }}
                                                    {{ Form::text('heading', $value->heading, ['class' => 'form-control']) }}
                                                </div>

                                                <div class="form-group">
                                                    {{ Form::label('ad', 'Ad Text') }}
                                                    {{Form::textarea('ad', $value->ad, ['id' => "article-ckeditor$key", 'class' => 'form-control'])}}
                                                </div>

                                                <script>
                                                    CKEDITOR.replace( "article-ckeditor{{ $key }}" );
                                                </script>

                                                <div class="form-group">
                                                    {{ Form::label('link', 'Link') }}
                                                    {{ Form::text('link', $value->link, ['class' => 'form-control']) }}
                                                </div>

                                                <div class="form-group">
                                                    @empty(!$value->image)
                                                        {{ Form::label('image', 'Change image') }}
                                                    @else
                                                        {{ Form::label('image', 'Add image') }}
                                                    @endempty

                                                    {{ Form::file('image', ['class' => 'form-control']) }}
                                                </div>
                                                @empty(!$value->image)
                                                    <div class="form-group">
                                                        <label>
                                                            <input type="checkbox" name="deletePic" value="1"> Delete Image
                                                        </label>
                                                    </div>
                                                @endempty

                                                <div class="box-footer">
                                                    {{ method_field('PUT') }}
                                                    {{ Form::submit('Update', ['class' => ' pull-right btn btn-success btn-sm']) }}
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No ad yet.</p>
                @endif
            </div>
            <!-- /.chat -->
            <div class="box-footer">

            </div>
        </div>

    </section>

    @if(count($adverts) < $noOfAds)
        <section class="col-lg-6 connectedSortable hidden addForm">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-comments-o"></i>

                <h3 class="box-title">Add Advert</h3>

                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                {!! Form::open(['action' => "Admin\PagesController@storeAdverts", 'method' => "POST", 'enctype' => 'multipart/form-data']) !!}

                <div class="form-group">
                    {{ Form::label('heading', 'Heading') }}
                    {{ Form::text('heading', '', ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('ad', 'Ad Text') }}
                    {{Form::textarea('ad', '', ['id' => 'article-ckeditor', 'class' => 'form-control'])}}
                </div>

                <div class="form-group">
                    {{ Form::label('link', 'Link') }}
                    {{ Form::text('link', '', ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('image', 'Ad image (optional)') }}
                    {{ Form::file('image', ['class' => 'form-control']) }}
                </div>

                <div class="box-footer">
                    {{ Form::submit('Add', ['class' => 'pull-right btn btn-success btn-sm']) }}
                </div>
                {!! Form::close() !!}
            </div>

        </div>

    </section>
        @push('scripts')
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
        @endpush
    @endif
@endsection