@extends('layouts.master')
@section('title'){{ $getProductDetails->meta_title }}@stop
@section('keywords'){{ $getProductDetails->meta_keywords }}@stop
@section('description'){!! $getProductDetails->meta_description !!}@stop
@section('content')
<div class="container  mtb50">

    {!! Form::open(['url'=>'add-to-cart','METHOD'=>'POST']) !!}
    {{ Form::hidden('product_id', '',['id'=>'product_id'])}}                
    {{ Form::hidden('quantity', "1",['id'=>'quantity']) }}
    {!! Form::close() !!}
    <!-- Breadcrumb
        ============================================= -->
    <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i></a></li>
        <li><a href="#">{{ $getProductDetails->category->name }}</a></li>
        <li><a href="#">Products Details</a></li>
    </ul><!-- Breadcrumb End-->


    <div class="row">
        <div id="content" class="col-sm-12">

            <div class="row product-info">
                <div class="col-sm-5">
                    <div style="border: 1px solid #f1f1f1; min-height:479px; background-color:#e2e2e2; padding:5px;">
                        <div class="bzoom_wrap">
                            <ul id="bzoom">

                                <li>
                                    <img class="bzoom_thumb_image" src="{{ asset('public/images/products/'.$getProductDetails->image) }}" title="{{ $getProductDetails->name }}" />
                                    <img class="bzoom_big_image" src="{{ asset('public/images/products/'.$getProductDetails->image) }}" title="{{ $getProductDetails->name }}"/>
                                </li>

                                @if($getProductDetails->productImages->count() > 0)
                                @foreach($getProductDetails->productImages as $productImage)
                                <li>
                                    <img class="bzoom_thumb_image" src="{{ asset('public/images/products/multiple_images/'.$productImage->image) }}" title="first img" />
                                    <img class="bzoom_big_image" src="{{ asset('public/images/products/multiple_images/'.$productImage->image) }}" title=""/>
                                </li>                                 
                                @endforeach
                                @endif

                            </ul>
                        </div>
                    </div>    
                    @if($getProductDetails->discount)
                    <span class="saving">-{{ $getProductDetails->discount }}%</span>
                    @endif
                </div>

                <div class="col-sm-7">
                    <h3 class="title">{{ $getProductDetails->name }}</h3>
                    <ul class="price-box">
                        <li class="price">
                            <span class="price-new">${{ ($getProductDetails->discount_price) ? $getProductDetails->discount_price :$getProductDetails->price }}</span>
                            <span class="price-old">{{ ($getProductDetails->price && $getProductDetails->discount_price) ? '$'.$getProductDetails->price : ""  }}</span>
                        </li>
                    </ul>
                    <div id="tab-description">
                        {!! $getProductDetails->description !!}   
                    </div>
                    <div id="product">
                        <hr>
                        <div class="cart">
                            <div>
                                <div class="qty">
                                    <label class="control-label" for="input-quantity">Qty</label>
                                    <a class="qtyBtn mines" href="javascript:void(0);"><i class="fa fa-minus"></i></a>
                                    <input readonly="" type="text" name="quantity" value="1" maxlength="2" id="input-quantity" class="form-control cartqty" />
                                    <a class="qtyBtn plus" href="javascript:void(0);"><i class="fa fa-plus"></i></a><br />

                                    <div class="clear"></div>
                                </div>
                                <button type="button" id="button-cart" class="btn btn-cart btn-lg" onclick="addToCart({{ $getProductDetails->id }})">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')

<script type="text/javascript">
    $("#bzoom").zoom({
    zoom_area_width: 500,
            autoplay_interval: 3000,
            small_thumbs: 1 + {{ $getProductDetails->productImages->count() }},
            autoplay: false
    });
</script>

@endpush('script')
