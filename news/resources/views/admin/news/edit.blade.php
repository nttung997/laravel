@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">News
                    <small>{{$news->title}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @include('admin.layout.formErrorList')
                <form action="{{url('admin/news/'.$news->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Category Parent</label>
                        <select class="form-control" name="category_id" id="category">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" @if($category->id==$news->newsType->category->id)
                                {{"selected"}}
                                @endif>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>News Type Parent</label>
                        <select class="form-control" name="news_type_id" id="news_type">
                            @foreach ($news->newsType->category->newsTypes as $newsType)
                            <option value="{{$newsType->id}}" @if($newsType->id==$news->newsType->id)
                                {{"selected"}}
                                @endif>{{$newsType->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>News Title</label>
                        <input class="form-control" name="title" placeholder="Please Enter News Title"
                            value="{{$news->title}}" />
                    </div>
                    <div class="form-group">
                        <label>Summary</label>
                        <textarea class="form-control ckeditor" name="summary">{{$news->summary}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea class="form-control ckeditor" name="content">{{$news->content}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        @if ($news->image=="")
                        <p>No Image</p>
                        @else
                        <p><img width="500px" src="{{asset('storage/'.$news->image)}}"></p>
                        <br><label>Delete Image</label>
                        <input type="checkbox" name="deleteImage" value="1">
                        @endif
                        <br><label>Change Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="form-group">
                        <label>Hot</label>
                        <label class="radio-inline">
                            <input name="hot" value="0" type="radio" @if(!$news->hot)
                            {{"checked"}}
                            @endif>No
                        </label>
                        <label class="radio-inline">
                            <input name="hot" value="1" type="radio" @if($news->hot)
                            {{"checked"}}
                            @endif>Yes
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">News Edit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <form>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Comments
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>User</th>
                        <th>Content</th>
                        <th>Created At</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($news->comments as $comment)
                    <tr class="odd gradeX" align="center">
                        <td>{{$comment->id}}</td>
                        <td>
                            {{$comment->user->name}}
                        </td>
                        <td>{{$comment->content}}</td>
                        <td>{{$comment->created_at}}</td>
                        <td class=" center">
                            <form action="{{url('admin/comments/'.$comment->id)}}" method="POST"
                                onSubmit="return confirm('Are you sure you wish to delete?');">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o  fa-fw"></i>
                                    Delete</button>
                            </form>
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
@endsection()
@section('script')
<script>
    $(document).ready(function(){
        $("#category").change(function(){
            var category_id = $(this).val();
            $.get("{{url('admin/ajax/newstypes')}}/"+category_id,function(data){
                $("#news_type").html(data);
            });
        });
    });
</script>
@endsection
