<html>
<head>
<title>Simple Datepicker</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
  
<script type="text/javascript" src="https://unpkg.com/vue/dist/vue.js"></script>
<script type="text/javascript" src="https://unpkg.com/v-calendar"></script>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/v-calendar/lib/v-calendar.min.css">


<!-- TODO: Missing CoffeeScript 2 -->

<script type="text/javascript">

window.onload=function(){



    var att = [
        {
          highlight: {
            backgroundColor: '#ddd',     // Red background
            //borderColor: '#ff6666',
            //borderWidth: '2px',
            //borderStyle: 'solid',
            //borderRadius: '5px',
          },
          //contentStyle: {
            //color: 'white',                 // White text
          //},
          //bar: {
            //backgroundColor: '#28bea3', // Red dot
          //},
          dates: [
           {
              start: new Date(2018, 2, 4),  // Jan 1st
           	  end: new Date(2018, 2, 20),    // - Jan 4th
            }
          ],
        }
      ];


new Vue({
  el: '#app',
  data: {
    // Data used by the date picker
    mode: 'single',
    selectedDate: null,
		att,
  },
  methods:{
    	day(){
      	console.log(arguments);
      }
    }
})


}
 
</script>


    <div id='app'>
        <v-date-picker :attributes="att" :mode='mode' v-model='selectedDate' is-inline :min-date="new Date(2019,2,20)" :max-date="new Date(2020,2,20)"></v-date-picker>
        {{selectedDate}}
    </div>

</body>
</html>