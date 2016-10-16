
@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Change Password</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="current_password" class="col-md-4 control-label">Current Password</label>

                           <div class="col-md-6">
                                    <input id="current_password" type="password" class="form-control" name="current_password">
                                @if ($errors->has('current_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>

                        <div class="form-group">
                            <label for="newpassword" class="col-md-4 control-label">New Password</label>
                                <div class="col-md-6">
                                    <input id="newpassword" type="password" class="form-control" name="newpassword">
                                     @if ($errors->has('newpassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('newpassword') }}</strong>
                                    </span>
                                @endif

                                </div>
                        </div>

                        
                        <div class="form-group">
                            <label for="newpassword_confirmation" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="newpassword_confirmation" type="password" class="form-control" name="newpassword_confirmation">
                                @if ($errors->has('newpassword_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('newpassword_confirmation') }}</strong>
                                    </span>
                                @endif

                                </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i></i> Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
