@extends('user.layout.index')
@section('title', 'Create Article')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Article
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @include('user.layout.formErrorList')
                <form action="{{url('articles')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Article Title</label>
                        <input class="form-control" name="title" placeholder="Please Enter Article Tile" />
                    </div>
                    <div class="form-group">
                        <label>Article Description</label>
                        <input class="form-control" name="description" placeholder="Please Enter Article Description" />
                    </div>
                    <div class="form-group">
                        <label>Article Status</label>
                        <select class="form-control" name="status">
                            <option value="0">Inactive</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">Add</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection