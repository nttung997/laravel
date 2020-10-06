<html>

<body>
    <form action="" method="post">
        @csrf
        <input type="text" name="content">
        <button type="submit">Submit</button>
    </form>

    {{-- <table>
        <thead>
            <tr>
                <th>Author</th>
                <th>Content</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($chats as $chat)
            <tr>
                <td>{{$chat->author}}</td>
    <td>{{$chat->content}}</td>
    </tr>
    @endforeach
    </tbody>
    </table> --}}

    <div id="data">
        @foreach ($chats as $chat)
        <p>{{$chat->author.' : '}}{{$chat->content}}</p>
        @endforeach
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.1/socket.io.js"
        integrity="sha512-AcZyhRP/tbAEsXCCGlziPun5iFvcSUpEz2jKkx0blkYKbxU81F+iq8FURwPn1sYFeksJ+sDDrI5XujsqSobWdQ=="
        crossorigin="anonymous"></script>
    <script>
        var socket = io('http://localhost:6001')
    socket.on('laravel_database_chat', function(data){
        console.log(data)
        if($('#'+data.id).length == 0){
            $('#data').prepend('<p><strong>'+data.author+'</strong>: '+data.content+'</p>')
        }else{
            console.log('Da co tin nhan')
        }
    })
    </script>
</body>

</html>