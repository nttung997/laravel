@extends('admin.layout.index')
@section('title', 'Article')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Articles
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
                        <th>Description</th>
                        {{-- <th>Author</th> --}}
                        <th>Status</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                    {{-- @dd($article) --}}
                    <tr class="odd gradeX" align="center">
                        <td>{{$article->id}}</td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->description}}</td>
                        {{-- <td>{{$article->user->name}}</td> --}}
                        <td>
                            @if($article->status==0)
                            INACTIVE
                            @endif
                            @if($article->status==1)
                            ACTIVE
                            @endif
                        </td>
                        <td class="center">
                            <form action="{{url('admin/articles/'.$article->id)}}" method="POST"
                                onSubmit="return confirm('Are you sure you wish to delete?');">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o  fa-fw"></i>
                                    Delete</button>
                            </form>
                        </td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                                href="{{url('admin/articles/'.$article->id.'/edit')}}">Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{ $articles->links() }} --}}
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
