@extends('admin.layouts.login-master')

@section('content')
<div class="card-body login-card-body">
    <p class="login-box-msg">Sign in to Pixiedust Admin</p>

    
    {!! Form::open(['route'=>'login','class'=>'form-horizontal new-lg-form','data-toggle'=>"validator", 'role'=>"form",'autocomplete'=>'off']) !!}

    <div class="form-group has-feedback" style="position:relative;">         

        {!! Form::email('email', old('email'), ['class'=>'form-control', 'required','placeholder'=>'Email','style'=>'padding-left: 30px;']) !!}
        @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
        <div class="help-block with-errors"></div>
        <span class="fa fa-envelope form-control-feedback login-icone"></span>
    </div>
    <div class="form-group has-feedback" style="position:relative;">
        {!! Form::password('password',  ['class'=>'form-control', 'required','placeholder'=>'Password','style'=>'padding-left: 30px;']) !!}

        @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif 
        <div class="help-block with-errors"></div>
        <span class="fa fa-lock form-control-feedback login-icone"></span>
    </div>
    
    <div class="row">
        <div class="col-8">
<!--            <div class="checkbox icheck">
                <label>
                    <input type="checkbox"> Remember Me
                </label>
            </div>-->
        </div>
        <!-- /.col -->
        <div class="col-4">
             {{ Form::submit('Log In', ['class' => 'btn btn-primary btn-block btn-flat']) }}
            
        </div>
        <!-- /.col -->
    </div>
{{ Form::close() }}

<!-- /.social-auth-links -->

<p class="mb-1">
    <a href="#">I forgot my password</a>
</p>   
</div>
@endsection
