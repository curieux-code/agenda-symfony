<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Multi-date Datepicker Example</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <!--<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css">
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>

    <!-- TODO: Missing CoffeeScript 2 -->

  <script type="text/javascript">

    !function(a){
        a.fn.datepicker.dates.fr={
            days:["dimanche","lundi","mardi","mercredi","jeudi","vendredi","samedi"],
            daysShort:["dim.","lun.","mar.","mer.","jeu.","ven.","sam."],
            daysMin:["d","l","m","m","j","v","s"],
            months:["janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre"],
            monthsShort:["janv.","févr.","mars","avril","mai","juin","juil.","août","sept.","oct.","nov.","déc."],
            today:"Aujourd'hui",
            monthsTitle:"Mois",
            clear:"Effacer",
            weekStart:1,
            format:"dd/mm/yyyy"
        }
    }(jQuery);


//<![CDATA[

    window.onload=function(){
      
$(document).ready(function() {
    $('#datepicker').datepicker({
        startDate: new Date(),
        multidate: 23, // true for no limit
        weekStart: 1,
        format: "dd/mm/yyyy",
        //daysOfWeekHighlighted: "5,6",
        //datesDisabled: ['31/08/2017'],
        startDate : new Date('2019-01-01'),
        endDate : new Date('2019-08-08'),
        language: 'fr'
    }).on('changeDate', function(e) {
        // `e` here contains the extra attributes
        $(this).find('.count').text('Sur ' + e.dates.length + ' jours');
    });
});


    }

//]]></script>

</head>
<body>
    <div class="input-group date form-group" id="datepicker">
<span class="count"></span> <br><br><br>


    <input type="text" class="form-control" id="Dates" name="Dates" placeholder="Sélectionner les jours" required />
    <br>
    <span class="input-group-addon"></span>
    
    

</div>

</body>
</html>
