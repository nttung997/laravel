@extends('admin.layout.index')
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
                @include('admin.layout.formErrorList')
                <form action="{{url('admin/articles')}}" method="POST">
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
                            <option value="0">INACTIVE</option>
                            <option value="1">ACTIVE</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Article Author</label>
                        <select class="form-control" name="user_id" id="user">
                            @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
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