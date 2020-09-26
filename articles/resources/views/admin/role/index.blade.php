@extends('admin.layout.index')
@section('title', 'Role')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Role
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
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr class="odd gradeX" align="center">
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td class="center">
                            <form action="{{url('admin/roles/'.$role->id)}}" method="POST"
                                onSubmit="return confirm('Are you sure you wish to delete?');">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o  fa-fw"></i>
                                    Delete</button>
                            </form>
                        </td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                                href="{{url('admin/roles/'.$role->id.'/edit')}}">Edit</a></td>
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
