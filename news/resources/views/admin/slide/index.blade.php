@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
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
                        <th>Content</th>
                        <th>Image</th>
                        <th>Link</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($slides as $slide)
                    <tr class="odd gradeX" align="center">
                        <td>{{$slide->id}}</td>
                        <td>{{$slide->name}}</td>
                        <td>{{$slide->content}}</td>
                        <td>
                            <img width="500px" src="{{url('upload/images/slides').'/'.$slide->image}}">
                        </td>
                        <td>{{$slide->link}}</td>
                        <td class="center">
                            <form action="{{url('admin/slides/'.$slide->id)}}" method="POST"
                                onSubmit="return confirm('Are you sure you wish to delete?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i
                                        class="fa fa-trash-o  fa-fw"></i>Delete</button>
                            </form>
                        </td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                                href="{{url('admin/slides/'.$slide->id.'/edit')}}">Edit</a></td>
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
