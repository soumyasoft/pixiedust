@extends('layouts.master')
@section('title') {{ $getAboutUs->meta_title }} @stop
@section('keywords'){{ $getAboutUs->meta_keywords }} @stop
@section('description'){!! $getAboutUs->meta_description !!} @stop
@section('content')

<div class="container mtb50">

    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
            <h1 class="title"><span>{{ $getAboutUs->title }}</span></h1>
            <div class="row">
                <div class="col-sm-12">
                    {!! $getAboutUs->description !!} 
                </div>
            </div>
        </div>
        <!--Middle Part End -->
    </div>
</div>

@endsection
