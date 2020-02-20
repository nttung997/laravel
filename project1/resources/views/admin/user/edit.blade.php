@extends('admin.layout.index')
@section('title', 'Edit User')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>Edit</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @include('admin.layout.formErrorList')
                <form action="{{url('admin/users/'.$user->id.'')}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label>User Name</label>
                        <input class="form-control" name="name" value="{{$user->name}}"
                            placeholder="Please Enter User Name" />
                    </div>
                    <div class="form-group">
                        <label>User Email</label>
                        <input readonly class="form-control" name="email" value="{{$user->email}}"
                            placeholder="Please Enter User Email" />
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role_id" id="role">
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}" @if($user->role && $role->id==$user->role->id) {{"selected"}} @endif>
                                {{$role->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>User Status</label>
                        <select class="form-control" name="status">
                            <option value="0" @if($user->status==0) {{"selected"}} @endif>
                                INACTIVE
                            </option>
                            <option value="1" @if($user->status==1) {{"selected"}} @endif>
                                ACTIVE
                            </option>
                            <option value="2" @if($user->status==2) {{"selected"}} @endif>
                                DISABLE
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="changePassword" id="changePassword">
                        <label>Change User Password</label>
                        <input disabled class="form-control password" name="password"
                            placeholder="Please Enter User Password" type="password" />
                    </div>
                    <div class="form-group">
                        <label>User Password Confirmation</label>
                        <input disabled class="form-control password" name="passwordAgain"
                            placeholder="Please Enter User Password Confirmation" type="password" />
                    </div>

                    <button type="submit" class="btn btn-default">User Edit</button>
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

@section('script')
<script>
    $(document).ready(function(){
        $("#changePassword").change(function(){
            if($(this).is(":checked")){
                $(".password").removeAttr('disabled');
            }else{
                $(".password").attr('disabled','');
            }
        });
    });
</script>
@endsection