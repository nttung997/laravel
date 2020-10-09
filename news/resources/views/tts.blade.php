<!DOCTYPE html>
<html>
<body>
  <form id="myForm">
    @csrf
    <input type="text" id="idText" name="text">
    <button type="submit">submit</button>
  </form>
  <div id="audio"></div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
  <script>
    $(function () {
      $('#myForm').ajaxForm({
        url: "{{route('ttsPost')}}",
        type: 'post',
        success: function (data) {
          console.log(data)
          $("#audio").html("<audio controls autoplay hidden><source src='{{asset('storage')}}/" + data + "' type='audio/wav'></audio>");
        },
      });
    });
  </script>
</body>
</html>