@extends('admin.layouts.master')
@section('title','Manage Category')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Category</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Manage Category</li>
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
                        <a class="btn btn-info float-right" style="color: #eee;" href="{{ route('product-categories.create') }}"><i class="fa fa-plus"></i> Add Category</a>
                        <h3 class="card-title">Manage Category</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL. No </th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Actions</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getCategories as $getCategory)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $getCategory->name }}</td>
                                    <td><img width="100px;" src="{{ asset('public/images/product-category/'.$getCategory->image) }}"></td>
                                    <td>
                                        <!--<a href="" class="btn-sm btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>-->
                                        <a data-toggle="tooltip" title="Edit" href="{{ route('product-categories.edit',$getCategory->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        {!! Form::open(['method' => 'DELETE','route' => ['product-categories.destroy', $getCategory->id],'style'=>'display:inline','onClick'=>"return confirm('Are you sure you want to delete this category ?')"]) !!}
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
