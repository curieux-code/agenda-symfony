<html>
<head>
<style type="text/css">
/*
    @charset "UTF-8";
    [ng\:cloak],
    [ng-cloak],
    [data-ng-cloak],
    [x-ng-cloak],
    .ng-cloak,
    .x-ng-cloak,
    .ng-hide{display:none !important;}
    ng\:form{display:block;}
    .ng-animate-start{clip:rect(0,auto,auto,0);-ms-zoom:1.0001;}
    .ng-animate-active{clip:rect(-1px,auto,auto,0);-ms-zoom:1;}
*/
</style>
<title>Simple Datepicker</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1">


<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.1/angular.js"></script>

<link rel="stylesheet" type="text/css" href="/css/result-light.css">


<style id="compiled-css" type="text/css">
    body{
        font-size: 7pt;
        font-family: verdana;
    }

    td{
        text-align: center;
    }

    .calendar-passedday{
        cursor: not-allowed;
    }

    .calendar-today, .calendar-day{
        cursor: pointer;    
        transition: .5s;
    }

    .prevmonth{
        float:left;
        padding-left:3px;
    }

    .clickable{
        cursor: pointer;
    }

    .nextmonth{
        float:right;
        padding-right:3px;
    }

    .calendar-today{
        color: red;
    }

    .calendar-passedday{
        color: #ccc;
    }

    .selectedDay{
        background: green;
        color: white;
        transition: .5s;
    }
</style>


<!-- TODO: Missing CoffeeScript 2 -->

<script type="text/javascript">

    
var app = angular.module("cal",[]);
app.controller('datepicker', function($scope){
    $scope.SelectedDate;
    $scope.SetDateToToday = function()
    {
        $scope.SelectedDate = new Date();
    }
});
app.directive('twineDatepicker', function($compile){  
    var cal_days_labels = ['L','M','M','J','V','S','D'];    
    var cal_months_labels = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];        
    var cal_days_in_month = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    var currentDate = new Date();
    var today = currentDate.getDate();
    var thisMonth = currentDate.getMonth();
    var thisYear = currentDate.getFullYear();
    var currentDisplayMonth;
    
    var getCalHMTL = function(displayMonth, displayYear)
    {   
        var displayDate = new Date(displayYear + '/' + displayMonth + '/' + today);
        currentDisplayMonth = displayDate;
        var firstDay = new Date(displayYear, displayMonth, 0);
        var startingDay = firstDay.getDay();
        var prevMonth = (displayMonth == 0) ? 12 : displayMonth - 1;
        var prevYear = (displayMonth == 0) ? displayYear - 1 : displayYear;
        var nextMonth = (displayMonth == 11) ? 0 : displayMonth + 1;
        var nextYear = (displayMonth == 11) ? displayYear + 1 : displayYear;
                
        var monthLength = cal_days_in_month[displayMonth];
                
        if (displayMonth == 1) {
            if((displayYear % 4 == 0 && displayYear % 100 != 0) || displayYear % 400 == 0){
                monthLength = 29;
            }
        }
        
        var monthName = cal_months_labels[displayMonth]
        var html = '<table class="calendar-table">';
        html += '<tr><th colspan="7">';
        html += '<span class="prevmonth clickable" ng-click="ChangeMonth(' + prevMonth + ',' + prevYear + ')"><</span>&nbsp;';
        html += monthName + '&nbsp;' + displayYear;
        html += '<span class="nextmonth clickable" ng-click="ChangeMonth(' + nextMonth + ',' + nextYear + ')">&nbsp;></span>';
        html += '</th></tr>';
        html += '<tr class="calendar-header">';
        for(var i = 0; i <= 6; i++ ){
            html += '<td class="calendar-header-day">';
            html += cal_days_labels[i];
            html += '</td>';
        }
        html += '</tr><tr>';
               
        var dayRendering = 1;        
        for (var i = 0; i < 9; i++) {            
            for (var j = 0; j <= 6; j++) { 
                var dayclass = (dayRendering == today && 
                                thisMonth == displayMonth && 
                                thisYear == displayYear) ? 'calendar-today' : 'calendar-day';
                dayclass = (dayRendering < today && 
                            thisMonth == displayMonth && 
                            thisYear == displayYear) ? 'calendar-passedday' : dayclass;
                html += '<td ';                
                html += 'class="' + dayclass + '" ';
                html += 'ng-click="SetSelectedDate(' + (displayMonth+1) + ',' + dayRendering + ',' + displayYear + ');"';
                if (dayRendering <= monthLength && (i > 0 || j >= startingDay)) {
                    html += 'ng-class="{selectedDay:ngModel.getDate() == ' + dayRendering + ' && ngModel.getMonth() == ' + displayMonth + '}" >';
                    html += dayRendering;
                    dayRendering++;
                }
                else html+= '>';
                html += '</td>';
            }
            
            if (dayRendering > monthLength) break;
            else html += '</tr><tr>';
        }        
        html += '</tr></table>';
        return html;
    }
    
    return{
        restrict: 'E',
        scope: {
            ngModel: '='
        },
        template: getCalHMTL(new Date().getMonth(), new Date().getFullYear()),
        link: function(scope, element, attrs){            
            scope.$watch('ngModel', function(newValue, oldValue) {
                if (newValue)
                {                    
                    if (newValue.getMonth() - 1 != currentDisplayMonth.getMonth() || newValue.getFullYear() != currentDisplayMonth.getFullYear())
                    {
                        scope.ChangeMonth(newValue.getMonth(), newValue.getFullYear());
                    }
                }
            });
            scope.SetSelectedDate = function(month, day, year)
            {   
                if ((day >= today || month > (thisMonth + 1)) || year > thisYear)
                {                    
                    scope.ngModel = new Date(month + "/" + day + "/" + year);                    
                }
            };
            scope.ChangeMonth = function(month, year){
                if (month >= thisMonth || year > thisYear)
                {
                    var compiled = $compile(getCalHMTL(month, year))(scope);
                    element.replaceWith(compiled);
                    element = compiled;
                }
            }
        }
    };
});
 
</script>

</head>
<body>

    <div ng-app="cal" ng-controller="datepicker">
        <twine-datepicker ng-model="SelectedDate"></twine-datepicker><br />
        <div style="height: 20px;">{{SelectedDate | date}}</div><br />
        <input type="button" ng-click="SetDateToToday()" value="Set to Today" />
    </div>

</body>
</html>