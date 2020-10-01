<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form action="{{route('ttsPost')}}" method="POST">
    @csrf
  <label for="idText">Text</label><br>
  <input type="text" id="idText" name="text"><br><br>
  <input type="submit" value="Submit">
</form> 

</body>
</html>