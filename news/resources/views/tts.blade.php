<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </head>
<body>

  <div class="container" >
    <form action="{{route('ttsPost')}}" method="POST">
      @csrf
      <div class="form-group">
        <label for="idText">Text</label><br>
        <input type="text" class="form-control" id="idText" name="text">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

@if(isset($audio))
<audio controls autoplay hidden>
  <source src="{{asset('storage/'.$audio)}}" type="audio/wav">
</audio>
@endif
</body>
</html>