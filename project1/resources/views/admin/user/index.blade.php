@extends('admin.layout.index')
@section('title', 'User')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @include('admin.layout.formErrorList')
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="odd gradeX" align="center">
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if($user->role)
                            {{$user->role->name}}
                            @endif
                        </td>
                        <td>
                            @if($user->status==0)
                            INACTIVE
                            @endif
                            @if($user->status==1)
                            ACTIVE
                            @endif
                            @if($user->status==2)
                            DISABLE
                            @endif
                        </td>
                        <td class="center">
                            <form action="{{url('admin/users/'.$user->id)}}" method="POST" onSubmit="return confirm('Are you sure you wish to delete?');">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o  fa-fw"></i>
                                    Delete</button>
                            </form>
                        </td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                                href="{{url('admin/users/'.$user->id.'/edit')}}">Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
