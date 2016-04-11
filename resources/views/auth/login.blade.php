@extends('layouts.main')

@section('css')
<link href="css/login.css" rel="stylesheet">
@endsection

@section('content')
<div id='login'>

    <div v-show="login" transition="flip" class="panel panel-default panel--no-border flip-enter">
        <div class="panel-heading"><i class="fa fa-btn fa-sign-in"></i>Login</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Password</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Remember Me
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-sign-in"></i>Login
                        </button>
                        <br>
                        <a class="btn btn-link btn-link-first" v-on:click.prevent="flip('reset')">Forgot Your Password?</a>
                        <a class="btn btn-link" v-on:click.prevent="flip('register')" >Need an Account?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

	<div v-show="register" transition="flip" v-cloak class="panel panel-default panel--no-border flip-enter">
        <div class="panel-heading"><i class="fa fa-btn fa-user"></i>Register</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Name:</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Password</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Confirm Password</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password_confirmation">

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-user"></i>Register
                        </button>
                        <br>
                        <a class="btn btn-link btn-link-first" v-on:click.prevent="flip('login')" >Login</a>
                        <a class="btn btn-link" v-on:click.prevent="flip('reset')">Forgot Your Password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

	<div v-show="reset" transition="flip" v-cloak  class="panel panel-default panel--no-border flip-enter">
	    <div class="panel-heading"><i class="fa fa-btn fa-refresh"></i>Reset Password</div>

	    <div class="panel-body">
	        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
	            {!! csrf_field() !!}

	            

	            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	                <label class="col-md-4 control-label">E-Mail Address</label>

	                <div class="col-md-6">
	                    <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}">

	                    @if ($errors->has('email'))
	                        <span class="help-block">
	                            <strong>{{ $errors->first('email') }}</strong>
	                        </span>
	                    @endif
	                </div>
	            </div>

	            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	                <label class="col-md-4 control-label">Password</label>

	                <div class="col-md-6">
	                    <input type="password" class="form-control" name="password">

	                    @if ($errors->has('password'))
	                        <span class="help-block">
	                            <strong>{{ $errors->first('password') }}</strong>
	                        </span>
	                    @endif
	                </div>
	            </div>

	            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
	                <label class="col-md-4 control-label">Confirm Password</label>
	                <div class="col-md-6">
	                    <input type="password" class="form-control" name="password_confirmation">

	                    @if ($errors->has('password_confirmation'))
	                        <span class="help-block">
	                            <strong>{{ $errors->first('password_confirmation') }}</strong>
	                        </span>
	                    @endif
	                </div>
	            </div>

	            <div class="form-group">
	                <div class="col-md-6 col-md-offset-4">
	                    <button type="submit" class="btn btn-primary">
	                        <i class="fa fa-btn fa-refresh"></i>Reset Password
	                    </button>
	                    <br>
	                    <a class="btn btn-link btn-link-first" v-on:click.prevent="flip('login')">Login</a>
                        <a class="btn btn-link" v-on:click.prevent="flip('register')" >Need an Account?</a>
	                </div>
	            </div>
	        </form>
	    </div>
	</div>

</div>

@endsection

@section('script')
  <script src="js/login.js"></script>
@endsection
