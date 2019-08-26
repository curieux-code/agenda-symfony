<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Bootstrap and datepicker</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <script type="text/javascript" src="//code.jquery.com/jquery-1.8.3.js" ></script>

      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.1.0/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.1.0/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css">
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">

    !function(a){
        a.fn.datepicker.dates.fr={
            days:["dimanche","lundi","mardi","mercredi","jeudi","vendredi","samedi"],
            daysShort:["dim.","lun.","mar.","mer.","jeu.","ven.","sam."],
            daysMin:["D","L","M","M","J","V","S"],
            months:["janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre"],
            monthsShort:["janv.","févr.","mars","avril","mai","juin","juil.","août","sept.","oct.","nov.","déc."],
            today:"Aujourd'hui",
            monthsTitle:"Mois",
            clear:"Effacer",
            weekStart:1,
            format:"dd/mm/yyyy"
        }
    }(jQuery);

    $(function () {
        
        $input = $("#select_date");
        $input.datepicker({
            weekStart: 1,
            format: "dd/mm/yyyy",
            language: 'fr',
            //todayBtn: true,
            todayHighlight: true
        });
        //$input.datepicker('setDate', new Date());
        //$input.data('datepicker').hide = function () {};
        $input.datepicker('show');

        $("#select_date .day").click(function () {
            var selDate = $(this).datepicker('getDate');
            $("#placeholder").text(selDate);
            var link = '/calendrier/' + selDate;
            //window.open(link, "_top");
        });

    });

</script>

</head>
<body>
    <div type="text" id="select_date" class="selecteShipDate" ></div>
    <div id="placeholder"></div>

</body>
</html>
