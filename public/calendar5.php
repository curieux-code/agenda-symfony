<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Iron Man Day 26 - ClockPicker</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <script type="text/javascript" src="//code.jquery.com/jquery-git.js"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js"></script>

<script type="text/javascript">

    $(window).on('load', function() {
      
        var clockInput = $('.clockpicker').clockpicker({
            placement: 'bottom',
        autoclose: true
        });

        $('#showClock').click(function(e){
            e.stopPropagation();
            $('.clockpicker').clockpicker('show');
        });

    });

</script>

</head>
<body>
    <div class="col-xs-6">
<div class="input-group clockpicker">
    <input type="text" class="form-control" placeholder="HH:MM">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
    </span>
</div>
<button id="showClock" class="btn btn-default">Afficher l'horloge</button>
</div>


  
</body>
</html>