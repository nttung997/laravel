@extends('admin.layout.index')
@section('title', 'Create User')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @include('admin.layout.formErrorList')
                <form action="{{url('admin/users')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>User Name</label>
                        <input class="form-control" name="name" placeholder="Please Enter User Name" />
                    </div>
                    <div class="form-group">
                        <label>User Email</label>
                        <input class="form-control" name="email" placeholder="Please Enter User Email" />
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role_id">
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>User Status</label>
                        <select class="form-control" name="status">
                            <option value="0">INACTIVE</option>
                            <option value="1" selected>ACTIVE</option>
                            <option value="2">DISABLE</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>User Password</label>
                        <input class="form-control" type="password" name="password"
                            placeholder="Please Enter User Password" />
                    </div>
                    <div class="form-group">
                        <label>User Password Confirmation</label>
                        <input class="form-control" type="password" name="passwordAgain"
                            placeholder="Please Comfirm User Password" />
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