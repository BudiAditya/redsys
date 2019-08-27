@extends('layouts.login')

@section('content')

<div class="container">
            <div class="row">
                <div class="account-col text-center">
                    <h1>Register</h1>
                    <h3>Create New account</h3>
                    <form class="m-t" method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
					@csrf
                        
						<input id="status_aktif" type="hidden" class="form-control" name="status_aktif" value="0" >
						<input id="level_id" type="hidden" class="form-control" name="level_id" value="1" >

						
						<div class="form-group row">
                            <input id="name" placeholder="Name .." type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                        
						@if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
						
						</div>
                        <div class="form-group row">
                            <input id="email" placeholder="Email .." type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                        
						@if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
						
						</div>
                        
						
						<div class="form-group row">
                            <input id="password" placeholder="Password .." type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        
						 @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                         @endif
						
						</div>
						<div class="form-group row">
                                <input id="password-confirm" placeholder="Confirm Password .." type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block ">Signup</button>
                        <a href="#"><small></small></a>
                        <p class=" text-center"><small>Already have an account?</small></p>
                        <a class="btn  btn-secondary btn-block" href="{{ url ('login') }}">Log into account</a>
                        <p>Absolute-Admin Admin &copy; 2016</p>
                    </form>
                </div>
            </div>

@endsection
