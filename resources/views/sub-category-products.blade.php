@extends('layouts.master')
@section('title') {{ "Products" }} @stop
@section('keywords'){{ "Products" }} @stop
@section('description'){{ "Products" }} @stop
@section('content')

<div class="container  mtb50 product-page">

    <!-- Breadcrumb
    ============================================= -->
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
        <li><a href="{{ url('/products') }}">Products</a></li>
    </ul><!-- Breadcrumb End-->
    <h3>{{ $getSubCatProducts->category->name }} Category / {{ $getSubCatProducts->name }} Sub Category</h3>
    
    <div id="demo" class="box jplist">
        <div class="jplist-panel box panel-top">

            <div class="row">      


                <!-- Middle Part
                ============================================= -->
                <div id="content" class="col-sm-12">

                    <!-- Heading
                    ============================================= -->

                    <!-- Refine Search
                   ============================================= -->
                    <h3 class="subtitle"></h3>
                    <div class="product-filter">
                        <div class="row">


                            <div class="col-md-12">
                                <!-- demo -->
                                <!-- ios button: show/hide panel -->
                                <div class="jplist-ios-button">
                                    <i class="fa fa-sort"></i>
                                    jPList Actions
                                </div>

                                <!-- panel -->
                                <!-- reset button -->
                                <button
                                    type="button"
                                    class="jplist-reset-btn"
                                    data-control-type="reset"
                                    data-control-name="reset"
                                    data-control-action="reset">
                                    Reset &nbsp;<i class="fa fa-share"></i>
                                </button>

                                <!-- items per page dropdown -->
                                <div
                                    class="jplist-drop-down"
                                    data-control-type="items-per-page-drop-down"
                                    data-control-name="paging"
                                    data-control-action="paging">

                                    <ul>
                                        <li><span data-number="3"> 3 per page </span></li>
                                        <li><span data-number="5"> 5 per page </span></li>
                                        <li><span data-number="10" data-default="true"> 10 per page </span></li>
                                        <li><span data-number="all"> View All </span></li>
                                    </ul>
                                </div>

                                <!-- sort dropdown -->
                                <div
                                    class="jplist-drop-down"
                                    data-control-type="sort-drop-down"
                                    data-control-name="sort"
                                    data-control-action="sort"
                                    data-datetime-format="{month}/{day}/{year}"> <!-- {year}, {month}, {day}, {hour}, {min}, {sec} -->

                                    <ul>
                                        <li><span data-path="default">Sort by</span></li>

                                        <li><span data-path=".newest" data-order="desc" data-type="text">Newest</span></li>

                                        <li><span data-path=".price" data-order="asc" data-type="number" data-default="true">price--Low to High</span></li>
                                        <li><span data-path=".price" data-order="desc" data-type="number">price--High to Low</span></li>

                                    </ul>
                                </div>

                                <!-- filter by title -->
                                <div class="text-filter-box">

                                    <i class="fa fa-search  jplist-icon"></i>

                                    <!--[if lt IE 10]>
                                    <div class="jplist-label">Filter by Title:</div>
                                    <![endif]-->

                                    <input
                                        data-path=".title"
                                        type="text"
                                        value=""
                                        placeholder="Filter by Title"
                                        data-control-type="textbox"
                                        data-control-name="title-filter"
                                        data-control-action="filter"
                                        />
                                </div>


                                <!-- prices range slider -->
                                <div 
                                    class="jplist-range-slider"
                                    data-control-type="range-slider" 
                                    data-control-name="range-slider-prices" 
                                    data-control-action="filter"
                                    data-path=".price"
                                    data-slider-func="pricesSlider" 
                                    data-setvalues-func="priesValues">

                                    <div class="value" data-type="prev-value"></div>
                                    <div class="ui-slider" data-type="ui-slider"></div>
                                    <div class="value" data-type="next-value"></div>
                                </div>


                                <div><br><br></div>       
                                <!-- data -->
                                <!-- end of demo -->

                            </div>

                        </div>
                    </div>  

                    <div class="row products-category">
                        <div class="list box text-shadow">

                            {!! Form::open(['url'=>'add-to-cart','METHOD'=>'POST']) !!}
                            {{ Form::hidden('product_id', '',['id'=>'product_id'])}}                
                            {{ Form::hidden('quantity', "1",['id'=>'quantity']) }}
                            {!! Form::close() !!}

                            @foreach($getSubCatProducts->products as $getSubCatProduct)

                            <div class="list-item box">
                                <div class="product-layout product-grid col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                    <div class="product-thumb clearfix">
                                        <div class="image"><a href="{{ url('products/'.$getSubCatProduct->slug) }}"><img src="{{ asset('public/images/products/'.$getSubCatProduct->image) }}" alt="" title="" class="img-responsive"></a></div>
                                        <div class="caption">
                                            <h4 class="title"><a href="{{ url('products/'.$getSubCatProduct->slug) }}">{{ $getSubCatProduct->name }}</a></h4>
                                            <p class="price" style="display:none;">{{ ($getSubCatProduct->discount_price) ? $getSubCatProduct->discount_price :$getSubCatProduct->price }}</p>
                                            <p class="price2">
                                                <span class="price-new"><i class="fa fa-dollar"></i>{{ ($getSubCatProduct->discount_price) ? $getSubCatProduct->discount_price :$getSubCatProduct->price }}</span> 
                                                <span class="price-old"></i>{{ ($getSubCatProduct->price && $getSubCatProduct->discount_price) ? '$'.$getSubCatProduct->price : ""  }}</span>
                                                @if($getSubCatProduct->discount)
                                                <span class="saving">-{{ $getSubCatProduct->discount }}%</span>
                                                @endif
                                            </p>

                                        </div>
                                        <p class="newest" style="display:none">1</p>
                                        <div class="button-group">
                                            <button class="btn-primary f-none" type="button" onclick="addToCart({{ $getSubCatProduct->id }})"><span>Add to Cart</span></button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="row">
                        <div class="box jplist-no-results text-shadow text-center">
                            <p style="color:#FFF">No results found</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <!-- pagination results -->
                            <div
                                class="jplist-label"
                                data-type="Page {current} of {pages}"
                                data-control-type="pagination-info"
                                data-control-name="paging"
                                data-control-action="paging">
                            </div>
                        </div>
                        <div class="col-sm-6 text-right"><!-- pagination control -->
                            <div
                                class="jplist-pagination"
                                data-control-type="pagination"
                                data-control-name="paging"
                                data-control-action="paging">
                            </div>
                        </div>
                    </div>
                </div><!--Middle Part End-->

            </div>
            <!-- row End-->


        </div>
    </div>

</div>

@endsection

@push('script')

<script>
    $('document').ready(function () {
    jQuery.fn.jplist.settings = {
    /* PRICES: jquery ui range slider*/
    pricesSlider: function ($slider, $prev, $next) {
    $slider.slider({
    min: {{ round(allProductDetails()->min_price) }}
    , max: {{ round(allProductDetails()->max_price) }}
    , range: true
            , values: [{{ allProductDetails()->min_price }}, {{ allProductDetails()->max_price }}]
            , slide: function (event, ui) {
            $prev.text('$' + ui.values[0]);
            $next.text('$' + ui.values[1]);
            }
    });
    }
    /*PRICES: jquery ui set values*/
    , priesValues: function ($slider, $prev, $next) {
    $prev.text('$' + $slider.slider('values', 0));
    $next.text('$' + $slider.slider('values', 1));
    }
    };
    $('#demo').jplist({
    itemsBox: '.list'
            , itemPath: '.list-item'
            , panelPath: '.jplist-panel'

            , redrawCallback: function (collection, $dataview, statuses) {

            $.each(statuses, function (index, status) {

            console.log(status);
            });
            }
    });
    });
</script>

@endpush