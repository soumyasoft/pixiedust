@extends('admin.layouts.master')
@section('title','Edit Product')
@section('content')

<script type="text/javascript" src="{{ asset('public/admin/ckeditor/ckeditor.js') }}"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Product</li>
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
                            <h3 class="card-title">Edit Product</h3>
                        </div>
                        {!! Form::model($product, ['method' => 'PATCH','route' => ['products.update', $product->id],'data-toggle'=>"validator", 'role' => 'form','files'=>true, 'autocomplete' => 'off']) !!}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="category_id">Category Name</label> 
                                {!! Form::select('category_id',getCategories(),old('category_id',$product->category_id), ['onChange'=>"getSubCategory(this.value)",'id' => 'category_id','required', 'class'=>'form-control','placeholder'=>'Select Category']) !!} 
                                @if ($errors->has('category_id')) 
                                <span class="help-block">                                    
                                    <strong>{{ $errors->first('category_id') }}</strong>                                
                                </span> @endif
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="sub_category_id">Sub Category Name</label> 
                                {!! Form::select('sub_category_id',getSubCategories($product->category_id),old('sub_category_id',$product->sub_category_id), ['id' => 'sub_category_id','required', 'class'=>'form-control']) !!} 
                                @if ($errors->has('sub_category_id')) 
                                <span class="help-block">                                    
                                    <strong>{{ $errors->first('sub_category_id') }}</strong>                                
                                </span> @endif
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">                                    
                                <label for="name">Name</label>                                    
                                {!! Form::text('name',old('name',$product->name), ['id' => 'name','required', 'class'=>'form-control']) !!}
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">                                    
                                <label for="price">Price</label>                                    
                                {!! Form::text('price',old('price',$product->price), ['id' => 'price','required', 'class'=>'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
                                @if ($errors->has('price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">                                    
                                <label for="name">Discount (In %)</label>                                    
                                {!! Form::text('discount',old('discount',$product->discount), ['id' => 'discount', 'class'=>'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}                               
                            </div>
                            <div class="form-group">                                    
                                <label for="discount_price">Discount Price</label>                                    
                                {!! Form::text('discount_price',old('discount_price',$product->discount_price), ['id' => 'discount_price', 'class'=>'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}                               
                            </div>
                            <div class="form-group">                                    
                                <label for="shipping_price">Shipping Price (Per Quantity)</label>                                    
                                {!! Form::text('shipping_price',old('shipping_price',$product->shipping_price), ['id' => 'shipping_price','required', 'class'=>'form-control','onkeypress'=>"return isNumberKey(event)"]) !!}
                                @if ($errors->has('shipping_price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('shipping_price') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>                            
                             <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="form-check">                                        
                                       {!! Form::checkbox('best_seller', 1, ($product->best_seller ==1 ? true: null),['id'=>'best_seller','class'=>'form-check-input']) !!}
                                        <label class="form-check-label" for="exampleCheck2">Best Seller</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">                                    
                                <label for="title">Description</label>                                    
                                {!! Form::textarea('description',old('description',$product->description),['id' => 'description','required', 'class'=>'form-control ckeditor']) !!}
                                <script type="text/javascript">
CKEDITOR.replace('description', {
    filebrowserUploadUrl: '{{ url("public/ckeditor/filemanager/connectors/php/upload.php")}}'
});
                                </script>
                                @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div> 

                            <div class="form-group">                                    
                                <label for="image">Image</label>                                    
                                {!! Form::file('image', ['id' => 'image','onchange'=>"return imageExtValidation('image')", 'class'=>'form-control','accept'=>"jpg,png"]) !!}
                                @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>  
                            <span style="color: red;">Note:Please upload 500*500 image for better quality.Image extension should be .jpeg.jpg.png.gif only</span>
                            <div class="clearfix"></div>
                            <div><img width="100px" src="{{ asset('public/images/products/'.$product->image) }}" /></div>

                            <div class="form-group">                                    
                                <label for="image">Multiple Product Image</label>                                    
                                {!! Form::file('prod_image[]', ['multiple','id' => 'prod_image','onchange'=>"return imageExtValidation('prod_image')", 'class'=>'form-control','accept'=>"jpeg,jpg,png"]) !!}
                                <div class="help-block with-errors"></div>
                            </div>
                            
                            <div class="mul_image">
                                @foreach($product->productImages as $productImage)
                                <a href="javascript:void(0);" id="prod_mul_image_{{ $productImage->id }}"><img src="{{ asset('public/images/products/multiple_images/'.$productImage->image) }}"><i class="fa fa-trash" onclick="return delMulImage({{ $productImage->id }});"></i></a>
                                @endforeach
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">                                    
                                <label for="meta_title">Meta Title</label>                                    
                                {!! Form::text('meta_title',old('meta_title',$product->meta_title),['id' => 'meta_title','required', 'class'=>'form-control']) !!}
                                @if ($errors->has('meta_title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('meta_title') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">                                    
                                <label for="meta_keywords">Meta Keywords</label>                                    
                                {!! Form::text('meta_keywords',old('meta_keywords',$product->meta_keywords),['id' => 'meta_keywords','required', 'class'=>'form-control']) !!}
                                @if ($errors->has('meta_keywords'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('meta_keywords') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">                                    
                                <label for="meta_description">Meta Description</label>                                    
                                {!! Form::textarea('meta_description',old('meta_description',$product->meta_description),['rows'=>3,'id' => 'meta_description','required', 'class'=>'form-control']) !!}
                                @if ($errors->has('meta_description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('meta_description') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>


                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            {{ Form::submit('Update', ['class' => 'btn btn-success']) }}
                            <a href="{{ url('admin/products') }}" class="btn btn-warning">Back</a> 
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
@stop
@push('script')
<script>
    function getSubCategory(cat_id) {
        if (cat_id) {
            var hostname = $(location).attr('origin') + "/pixiedust/";
            $.ajax({
                type: "POST",
                url: hostname + "get-sub-category",
                data: {'cat_id': cat_id},
                success: function (response) {
                    if (response) {
                        $("#sub_category_id").empty();
                        $("#sub_category_id").append('<option value="">Select Subcategory</option>');
                        $.each(response, function (key, value) {
                            $("#sub_category_id").append('<option value="' + key + '">' + value + '</option>');
                        });
                    } else {
                        $("#sub_category_id").empty();
                        $("#sub_category_id").append('<option value="">Select Subcategory</option>');

                    }
                }
            })
        }
    }

    $(function () {
        var $price = $("input[name='price']"),
                $percentage = $("input[name='discount']").on("input", calculatePrice);

        function calculatePrice() {
            var percentage = $(this).val();
            if (percentage) {
                var price = $price.val();
                var calcPrice = (price - (price * percentage / 100)).toFixed(2);
                if (calcPrice) {
                    $("#discount_price").val(calcPrice);
                } else {
                    $("#discount_price").val();
                }
            } else {
                $("#discount_price").val("");
            }
        }

    });

    /////// Multiple Image Upload Jquery ///////////////

    $(document).ready(function () {
        if (window.File && window.FileList && window.FileReader) {
            $("#prod_image").on("change", function (e) {
                var files = e.target.files,
                        filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function (e) {
                        var file = e.target;
                        $("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                                "<br/><span class=\"remove\"><i class='fa fa-trash'></i></span>" +
                                "</span>").insertAfter("#prod_image");
                        $(".remove").click(function () {
                            $(this).parent(".pip").remove();
                        });
                    });
                    fileReader.readAsDataURL(f);
                }
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
    });
    
    // Delete Image
    function delMulImage(img_id){    
        var hostname = $(location).attr('origin') + "/pixiedust/";
         var del=confirm("Are you sure you want to delete this image?");
            if (del==true){
                $.ajax({
                    type:'POST',
                    url: hostname + "mul-img-delete",
                    data: {'id': img_id},
                    dataType:'JSON',
                    success:function(response){                        
                      if(response.status == 'success'){
                          $("#prod_mul_image_"+img_id).remove();
                      }
                    }
                    
                    });
            }
                return del;
            }

       

</script>


@endpush