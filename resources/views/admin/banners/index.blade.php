@extends('admin.layouts.master')
@section('title','Manage Banners')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Banner</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Manage Banner</li>
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
                        <a class="btn btn-info float-right" style="color: #eee;" href="{{ route('banners.create') }}"><i class="fa fa-plus"></i> Add Banner</a>
                        <h3 class="card-title">Manage Banner</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL. No </th>
                                    <th>Banner</th>
                                    <th>Actions</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getBanners as $getBanner)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img width="100px;" src="{{ asset('public/images/banner/'.$getBanner->banner) }}"></td>
                                    <td>
                                        <!--<a href="" class="btn-sm btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>-->
                                        <a data-toggle="tooltip" title="Edit" href="{{ route('banners.edit',$getBanner->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        {!! Form::open(['method' => 'DELETE','route' => ['banners.destroy', $getBanner->id],'style'=>'display:inline','onClick'=>"return confirm('Are you sure you want to delete this banner ?')"]) !!}
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
