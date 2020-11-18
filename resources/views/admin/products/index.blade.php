@extends('admin.layouts.master')
@section('title','Manage Products')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Products</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Manage Products</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">        
                @include('admin.includes.msg')
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-info float-right" style="color: #eee;" href="{{ route('products.create') }}"><i class="fa fa-plus"></i> Add Product</a>
                        <h3 class="card-title">Manage Products</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL. No </th>
                                    <th>Category Name</th>
                                    <th>Sub Category Name</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Discount Price</th>
                                    <th>Image</th>
                                    <th>Actions</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getProducts as $getProduct)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $getProduct->category->name }}</td>
                                    <td>{{ $getProduct->subcategories->name }}</td>
                                    <td>{{ $getProduct->name }}</td>
                                    <td>${{ number_format($getProduct->price,2) }}</td>
                                    <td>${{ number_format($getProduct->discount_price,2) }}</td>
                                    <td><img width="100px;" src="{{ asset('public/images/products/'.$getProduct->image) }}"></td>
                                    <td>

                                        <a data-toggle="tooltip" title="Edit" href="{{ route('products.edit',$getProduct->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        {!! Form::open(['method' => 'DELETE','route' => ['products.destroy', $getProduct->id],'style'=>'display:inline','onClick'=>"return confirm('Are you sure you want to delete this category ?')"]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-sm btn-small','type'=>'submit']) !!}
                                        {!! Form::close() !!}

                                    </td>                                    
                                </tr>
                                @endforeach
                                </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@stop
