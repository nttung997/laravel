@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">News
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @include('admin.layout.formErrorList')
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Title</th>
                        <th>News Type Parent</th>
                        <th>Category Parent</th>
                        <th>Summary</th>
                        <th>Hot</th>
                        <th>View</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($news as $news)
                    <tr class="odd gradeX" align="center">
                        <td>{{$news->id}}</td>
                        <td>
                            <p>{{$news->title}}</p>
                            {{-- <img width="100px" src="{{url('upload/images/tin-tuc').'/'.$news->image}}"> --}}
                        </td>
                        <td>{{$news->newstype->name}}</td>
                        <td>{{$news->newstype->category->name}}</td>
                        <td>{{$news->summary}}</td>
                        <td>
                            @if ($news->hot)
                            {{'Yes'}}
                            @else
                            {{'No'}}
                            @endif
                        </td>
                        <td>{{$news->view}}</td>
                        <td class=" center">
                            <form action="{{url('admin/news/'.$news->id)}}" method="POST" onSubmit="return confirm('Are you sure you wish to delete?');">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o  fa-fw"></i>
                                    Delete</button>
                            </form>
                        </td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="news/{{$news->id}}/edit">Edit</a>
                        </td>
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
