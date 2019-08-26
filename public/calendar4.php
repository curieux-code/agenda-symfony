
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Bootstrap 4 Advanced Components : Clockpicker plugin for Bootstrap 4 Daemonite</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">


      <link rel="stylesheet" type="text/css" href="https://daemonite.github.io/material/css/material.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/djibe/clockpicker@1d03466e3b5eebc9e7e1dc4afa47ff0d265e2f16/dist/bootstrap4-clockpicker.min.css">
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="https://daemonite.github.io/material/js/material.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/djibe/clockpicker@6d385d49ed6cc7f58a0b23db3477f236e4c1cd3e/dist/bootstrap4-clockpicker.min.js"></script>

  <style id="compiled-css" type="text/css">
      :root {
  /* Just set your primary color in decimal RGB */
  --primary-color: 156, 39, 176;
}

  </style>



  <script type="text/javascript">


    var VanillaRunOnDomReady = function() {
      
$(function() {
  $('.clockpicker2').clockpicker({
    'default': 'now',
    vibrate: true,
    placement: "bottom",
    align: "left",
    autoclose: true,
    twelvehour: false
  });
});


    }

var alreadyrunflag = 0;

if (document.addEventListener)
    document.addEventListener("DOMContentLoaded", function(){
        alreadyrunflag=1; 
        VanillaRunOnDomReady();
    }, false);
else if (document.all && !window.opera) {
    document.write('<script type="text/javascript" id="contentloadtag" defer="defer" src="javascript:void(0)"><\/script>');
    var contentloadtag = document.getElementById("contentloadtag")
    contentloadtag.onreadystatechange=function(){
        if (this.readyState=="complete"){
            alreadyrunflag=1;
            VanillaRunOnDomReady();
        }
    }
}

window.onload = function(){
  setTimeout("if (!alreadyrunflag){VanillaRunOnDomReady}", 0);
}

</script>

</head>
<body>

    <div class="input-group clockpicker">
        <div class="input-group-prepend">
            <div class="form-group clockpicker2">
            <input class="form-control" type="text" placeholder="HH:MM">
            </div>
        </div>
    </div>

</body>
</html>