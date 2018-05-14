@extends('admin.layouts.app')

@section('content')
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="/storage/user_images/{{ Auth::user()->pic }}" alt="User profile picture">

                <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                <p class="text-center" style="margin:-10px 0px 0px"><small>{{ Auth::user()->email }}</small></p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Date Joined</b> <span class="pull-right text-primary">{{ Auth::user()->created_at->toFormattedDateString() }}</span>
                    </li>
                </ul>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="settings">
                    {!! Form::model(Auth::user(), ['action' => ['PagesController@updateProfile', Auth::user()->id], 'class' => 'form-horizontal', 'method' => "POST", 'enctype' => 'multipart/form-data']) !!}
                        {{ Form::hidden('_method', 'PUT') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            {{ Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) }}
                            <div class="col-sm-10">
                                {{ Form::text('name', Auth::user()->name, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) }}
                            <div class="col-sm-10">
                                {{ Form::text('email', Auth::user()->email, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('password', 'Change Password', ['class' => 'col-sm-2 control-label']) }}
                            <div class="col-sm-10">
                                {{ Form::password('password', ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('password_confirmation', 'Confirm Password', ['class' => 'col-sm-2 control-label']) }}
                            <div class="col-sm-10">
                                {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('pic', 'Photo', ['class' => 'col-sm-2 control-label']) }}
                            <div class="col-sm-10">
                                {{ Form::file('pic', ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                {{ Form::submit('Update', ['class' => 'pull-right btn btn-success']) }}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->

@endsection