@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">News
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @include('admin.layout.formErrorList')
                <form action="{{url('admin/news')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Category Parent</label>
                        <select class="form-control" name="category_id" id="category">
                            <option value="">Please Choose Category</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>News Type Parent</label>
                        <select class="form-control" name="news_type_id" id="news_type">
                        </select>
                    </div>
                    <div class="form-group">
                        <label>News Title</label>
                        <input class="form-control" name="title" placeholder="Please Enter News Title" />
                    </div>
                    <div class="form-group">
                        <label>Summary</label>
                        <textarea class="form-control ckeditor" name="summary"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea class="form-control ckeditor" name="content" ></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="form-group">
                        <label>Hot</label>
                        <label class="radio-inline">
                            <input name="hot" value="0" checked="" type="radio">No
                        </label>
                        <label class="radio-inline">
                            <input name="hot" value="1" type="radio">Yes
                        </label>
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
