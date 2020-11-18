@extends('admin.layouts.master')
@section('title', 'My Account')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>My Account</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        @include('admin.includes.msg')
                        <div class="card-header">
                            <h3 class="card-title">My Account</h3>
                        </div>               

                        {!! Form::open(['url' => 'my-account','data-toggle'=>"validator",'role' => 'form', 'class' =>'validate', 'name' => 'my-account', 'id' => 'my-account','files'=>true, 'autocomplete' => 'off']) !!}
                        <div class="card-body">
                            <div class="form-group">                                    
                                <label for="name">Name</label>                                    
                                {!! Form::text('name', $getAccountDetails->name, ['id' => 'name','required', 'class'=>'form-control', 'placeholder'=>'Name']) !!}
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">                                    
                                <label for="email">Login Email</label>                                    
                                {!! Form::email('email', $getAccountDetails->email, ['id' => 'email','required', 'class'=>'form-control', 'placeholder'=>'Login Email']) !!}
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">                                    
                                <label for="alt_email">Contact Email</label>                                    
                                {!! Form::email('alt_email', $getAccountDetails->alt_email, ['id' => 'alt_email','required', 'class'=>'form-control', 'placeholder'=>'Contact Email']) !!}
                                @if ($errors->has('alt_email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('alt_email') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div> 
                            </div>
                            <div class="form-group">                                    
                                <label for="contact_no">Contact Number</label>                                  
                                {!! Form::text('contact_no',$getAccountDetails->contact_no, ['onkeypress'=>"return isNumberKey(event)",'id' => 'contact_no','required', 'class'=>'form-control', 'placeholder'=>'Contact Number']) !!}
                                @if ($errors->has('contact_no'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('contact_no') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div> 
                            </div>

                            <div class="form-group">                                    
                                <label for="address">Address</label>                                    
                                {!! Form::textarea('address', $getAccountDetails->address, ['id' => 'address','required','rows'=>3, 'class'=>'form-control', 'placeholder'=>'Address']) !!}
                                @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div> 
                            </div>
                            <div class="form-group">                                    
                                <label for="opening_hours">Opening Hours</label>                                    
                                {!! Form::textarea('opening_hours', $getAccountDetails->opening_hours, ['id' => 'opening_hours','required','rows'=>3, 'class'=>'form-control', 'placeholder'=>'Opeing Hours']) !!}
                                @if ($errors->has('opening_hours'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('opening_hours') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div> 
                            </div>
                            <div class="form-group">                                    
                                <label for="address">Facebook URL</label>                                    
                                {!! Form::url('facebook_url', $getAccountDetails->facebook_url, ['id' => 'facebook_url','required','class'=>'form-control', 'placeholder'=>'Facebook URL']) !!}
                                @if ($errors->has('facebook_url'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('facebook_url') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div> 
                            </div>
                            <div class="form-group">                                    
                                <label for="address">Twitter URL</label>                                    
                                {!! Form::url('twitter_url', $getAccountDetails->twitter_url, ['id' => 'twitter_url','required','class'=>'form-control', 'placeholder'=>'Twitter URL']) !!}
                                @if ($errors->has('twitter_url'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('twitter_url') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div> 
                            </div>
                            <div class="form-group">                                    
                                <label for="address">Instagram URL</label>                                    
                                {!! Form::url('instagram_url', $getAccountDetails->instagram_url, ['id' => 'instagram_url','required','class'=>'form-control', 'placeholder'=>'Instagram URL']) !!}
                                @if ($errors->has('instagram_url'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('instagram_url') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div> 
                            </div>


                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">

                            {{ Form::submit('Update', ['class' => 'btn btn-success']) }}
                            <a href="{{ url('admin/home') }}" class="btn btn-warning">Back</a> 
                        </div>
                        {!! Form::close() !!}


                    </div>


                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
