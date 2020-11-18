@extends('layouts.master')
@section('title') {{ "Home" }} @stop
@section('keywords'){{ "Home" }} @stop
@section('description'){{ "Home" }} @stop
@section('content')

<div class="slideshow single-slider owl-carousel"> 
    @foreach($getBanners as $getBanner)
    <div class="item"><img class="img-responsive" src="{{ asset('public/images/banner/'.$getBanner->banner) }}" alt="{{ $loop->iteration }}" /></div>
    @endforeach
</div><!-- Slideshow End-->


<div class="container">
    <div class="row">
        <!-- Pixie Dust Banner
          ============================================= -->
<!--        <div id="content" class="col-sm-12">

            <div class="bigshop-banner">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                        <span class="category-name"><a href="#">WORDS TONES</a></span>
                        <a href="#"><img src="{{ asset('public/images/wordstones.jpg') }}" alt="wordstones" title="wordstones" class="category-box"></a>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                        <span class="category-name"><a href="#">Crystals</a></span>
                        <a href="#"><img src="{{ asset('public/images/crystals.jpg') }}" alt="Crystals" title="Crystals" class="category-box"></a>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                        <span class="category-name"><a href="#">Energy</a></span>
                        <a href="#"><img src="{{ asset('public/images/Energy.jpg') }}" alt="Energy" title="Energy" class="category-box"></a></div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 moderns">
                        <span class="category-name"><a href="#">GEMSTONE POINT PENDANTS</a></span>
                        <a href="#">
                            <img src="{{ asset('public/images/gemstone-pendants.jpg') }}" alt="sample banner" title="sample banner" class="category-box"></a>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 moderns">
                        <span class="category-name"><a href="#">MILLENNIAL GAIA, MOTHER EARTH</a></span>
                        <a href="#">
                            <img src="{{ asset('public/images/MILLENNIAl.jpg') }}" alt="MILLENNIAL GAIA, MOTHER EARTH" title="MILLENNIAL GAIA, MOTHER EARTHs" class="category-box"></a>
                    </div>
                </div>
            </div>
        </div>    Pixie Dust Banner End -->

        <!-- NEW IN Middle Part
        ============================================= -->
        <div id="content" class="col-sm-12">
            <!-- Featured Product Start-->
            <h3 class="subtitle"><span>NEW IN</span></h3>
            <div class="row products-category">

                {!! Form::open(['url'=>'add-to-cart','METHOD'=>'POST']) !!}
                {{ Form::hidden('product_id', '',['id'=>'product_id'])}}                
                {{ Form::hidden('quantity', "1",['id'=>'quantity']) }}
                {!! Form::close() !!}

                @foreach($getNewProducts as $getNewProduct)

                <div class="product-layout product-grid col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <div class="product-thumb">
                        <div class="image"><a href="{{ url('products/'.$getNewProduct->slug) }}"><img src="{{ asset('public/images/products/'.$getNewProduct->image) }}" alt="{{ $getNewProduct->name }}" title="" class="img-responsive"></a></div>
                        <div>
                            <div class="caption">
                                <h4><a href="{{ url('products/'.$getNewProduct->slug) }}">{{ $getNewProduct->name }}
                                    </a></h4>

                                <p class="price">                                  
                                    <span class="price-new">${{ ($getNewProduct->discount_price) ? $getNewProduct->discount_price :$getNewProduct->price }}</span>
                                    <span class="price-old">{{ ($getNewProduct->price && $getNewProduct->discount_price) ? '$'.$getNewProduct->price : ""  }}</span>

                                    @if($getNewProduct->discount)
                                    <span class="saving">-{{ $getNewProduct->discount }}%</span>
                                    @endif

                                </p>
                            </div>
                            <div class="button-group">
                                <button class="btn-primary" type="button" onclick="addToCart({{ $getNewProduct->id }})"> <span>Add to Cart</span></button>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
            <!-- Featured Product End-->
        </div><!--NEW INMiddle Part End-->


        <!-- BEST SELLERS Middle Part
============================================= -->
        <div id="content" class="col-sm-12">
            <!-- Featured Product Start-->
            <h3 class="subtitle"><span>BEST SELLERS</span></h3>
            <div class="row products-category">
                
                @foreach($getBestSellerProducts as $getBestSellerProduct)

                <div class="product-layout product-grid col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <div class="product-thumb">
                        <div class="image"><a href="{{ url('products/'.$getBestSellerProduct->slug) }}"><img src="{{ asset('public/images/products/'.$getBestSellerProduct->image) }}" alt="{{ $getBestSellerProduct->name }}" title="" class="img-responsive"></a></div>
                        <div>
                            <div class="caption">
                                <h4><a href="{{ url('products/'.$getBestSellerProduct->slug) }}">{{ $getBestSellerProduct->name }}
                                    </a></h4>

                                <p class="price">                                  
                                    <span class="price-new">${{ ($getBestSellerProduct->discount_price) ? $getBestSellerProduct->discount_price :$getBestSellerProduct->price }}</span>
                                    <span class="price-old">{{ ($getBestSellerProduct->price && $getBestSellerProduct->discount_price) ? '$'.$getBestSellerProduct->price : ""  }}</span>

                                    @if($getBestSellerProduct->discount)
                                    <span class="saving">-{{ $getBestSellerProduct->discount }}%</span>
                                    @endif

                                </p>
                            </div>
                            <div class="button-group">
                                <button class="btn-primary" type="button" onclick="addToCart({{ $getBestSellerProduct->id }})"> <span>Add to Cart</span></button>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
      
            </div>
            <!-- Featured Product End-->
        </div><!--BEST SELLERS Part End-->

    </div>
</div>

@endsection
