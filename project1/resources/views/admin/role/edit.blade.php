@extends('admin.layout.index')
@section('title', 'Edit Role')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Role
                    <small>Edit</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @include('admin.layout.formErrorList')
                <form action="{{url('admin/roles/'.$role->id.'')}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label>Role Name</label>
                        <input class="form-control" name="name" value="{{$role->name}}" placeholder="Please Enter Role Name" />
                    </div>
                    <button type="submit" class="btn btn-default">Role Edit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection()
