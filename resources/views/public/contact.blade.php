@extends('public.layouts.app')

@section('content')
    <div class="fh5co-page-title" style="background-image: url({{ asset('/storage/images/slide_6.jpg') }});">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 animate-box">
                    <h1><span class="colored">Contact</span> Us</h1>
                </div>
            </div>
        </div>
    </div>


    <div class="fh5co-contact animate-box">
        <div class="container">
            <div class="row">
                @include('public.layouts.message')
            </div>
            <div class="row">
                <div class="col-md-3">
                    <h3>Contact Info.</h3>
                    @empty(!$pages)
                        <ul class="contact-info">
                            @empty(!$pages->address)
                                <li><i class="icon-map"></i>{{ $pages->address }}</li>
                            @endempty
                            @empty(!$pages->phone)
                                <li><i class="icon-phone"></i>{{ $pages->phone }}</li>
                            @endempty
                            @empty(!$pages->email)
                                <li><i class="icon-envelope"></i><a href="mailto:{{ $pages->email }}">{{ $pages->email }}</a></li>
                            @endempty
                            <li><i class="icon-globe"></i><a href="{{ route('index') }}">{{ config('url', 'www.improveparenting.com') }}</a></li>
                        </ul>
                    @endempty
                </div>
                <div class="col-md-8 col-md-push-1 col-sm-12 col-sm-push-0 col-xs-12 col-xs-push-0">
                    <div class="row">
                        {{ Form::open(['action' => 'Visitors\PublicController@mail', 'method' => "POST"]) }}
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name', 'required' => 'required']) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email', 'required' => 'required']) }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::textarea('message', '', ['class' => 'form-control', 'placeholder' => "Message", 'cols' => '30', 'rows' => '7', 'required' => 'required']) }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::submit('Send Message', ['class' => 'btn btn-primary']) }}
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="map" class="animate-box" data-animate-effect="fadeIn"></div>
@endsection