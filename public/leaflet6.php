<html><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Basic demo Leaflet Routing Machine</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <script type="text/javascript" src="/js/lib/dummy.js"></script>

    <link rel="stylesheet" type="text/css" href="/css/result-light.css">

      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.2.0/leaflet.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.2.0/leaflet.css">
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.5/leaflet-routing-machine.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.5/leaflet-routing-machine.css">
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/perliedman-leaflet-control-geocoder/1.5.5/Control.Geocoder.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/perliedman-leaflet-control-geocoder/1.5.5/Control.Geocoder.min.css">

  <style id="compiled-css" type="text/css">
      
  </style>


  <!-- TODO: Missing CoffeeScript 2 -->

  <script type="text/javascript">
//<![CDATA[

    window.onload=function(){
      
var mymap = L.map('mapid').setView([50.27264, 7.26469], 13);
console.log(mymap);
L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(mymap);
var control = L.Routing.control({
  waypoints: [
    L.latLng(38.7436056, -9.2304153),
    L.latLng(38.5334477, -0.1312811)
  ],
  router: new L.Routing.osrmv1({
    language: 'fr',
    profile: 'car'
  }),
  geocoder: L.Control.Geocoder.nominatim({})
}).addTo(mymap);


    }

</script>



</head>
<body>

    <div style="height: 400px;" id="mapid">
    </div>

    
</body>
</html>