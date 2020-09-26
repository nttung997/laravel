@extends('user.layout.index')
@section('title', 'Change Information')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Information
                    <small>Edit</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @include('user.layout.formErrorList')
                <form action="{{url('user/edit')}}" method="POST">
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
                    <button type="submit" class="btn btn-default">Edit</button>
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