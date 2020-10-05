<html>

<body>
    @foreach ($chats as $chat)
    {{$chat->author}}
    {{$chat->content}}
    @endforeach
    <form action="" method="post">
        @csrf
        <input type="text" name="author">
        <input type="text" name="content">
        <button type="submit">Submit</button>
    </form>
</body>

</html>