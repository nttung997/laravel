<html>

<body>
    <form action="" method="post" id="theForm">
        @csrf
        <input type="text" name="content">
        <button type="submit">Submit</button>
    </form>

    <div id="data">
        @foreach ($chats as $chat)
        <p>{{$chat->author.' : '}}{{$chat->content}}</p>
        @endforeach
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
        integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.1/socket.io.js"
        integrity="sha512-AcZyhRP/tbAEsXCCGlziPun5iFvcSUpEz2jKkx0blkYKbxU81F+iq8FURwPn1sYFeksJ+sDDrI5XujsqSobWdQ=="
        crossorigin="anonymous"></script>
    <script>
        $("#theForm").ajaxForm()
        var socket = io('http://localhost:6001')
        socket.on('laravel_database_chat', function(data){
        $('#data').prepend('<p><strong>'+data.author+'</strong>: '+data.content+'</p>')
    })
    </script>
</body>

</html>