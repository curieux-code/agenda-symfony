<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css">

    <style>
        html {
        height: 88%
        }

        body {
        height: 100%;
        margin: 0;
        padding: 0;
        }

        .map {
        height: 100%
        }
    </style>

</head>
<body>
    
<div id="map" class="map"></div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-providers/1.1.7/leaflet-providers.js"></script>
<script>
// center of the map
//var center = [-33.8650, 151.2094];
// add a marker in the given location
//L.marker(center).addTo(map);

var map = L.map('map', {
  center: [48.58, 7.75],
  zoom: 14,
  zoomControl: true
});
var defaultLayer = L.tileLayer.provider('OpenStreetMap.Mapnik').addTo(map);
var baseLayers = {
  'OpenStreetMap Default': defaultLayer,
  'OpenStreetMap German Style': L.tileLayer.provider('OpenStreetMap.DE'),
  'OpenStreetMap Black and White': L.tileLayer.provider('OpenStreetMap.BlackAndWhite'),
  'OpenStreetMap H.O.T.': L.tileLayer.provider('OpenStreetMap.HOT'),
  'Hydda Full': L.tileLayer.provider('Hydda.Full'),
  'Stamen Toner': L.tileLayer.provider('Stamen.Toner'),
  'Stamen Watercolor': L.tileLayer.provider('Stamen.Watercolor'),
  'Esri WorldStreetMap': L.tileLayer.provider('Esri.WorldStreetMap'),
  'Esri WorldTopoMap': L.tileLayer.provider('Esri.WorldTopoMap'),
  'Esri WorldImagery': L.tileLayer.provider('Esri.WorldImagery'),
  'Esri WorldGrayCanvas': L.tileLayer.provider('Esri.WorldGrayCanvas'),
  // this gives an error
  //'Acetate': L.tileLayer.provider('Acetate')  
};
var overlayLayers = {
  'OpenSeaMap': L.tileLayer.provider('OpenSeaMap'),
  'OpenWeatherMap Clouds': L.tileLayer.provider('OpenWeatherMap.Clouds'),
  'OpenWeatherMap Snow': L.tileLayer.provider('OpenWeatherMap.Snow')
};
var layerControl = L.control.layers(baseLayers, overlayLayers, {
  collapsed: false
}).addTo(map);
// resize layers control to fit into view.
function resizeLayerControl() {
  var layerControlHeight = document.body.clientHeight - (10 + 50);
  var layerControl = document.getElementsByClassName('leaflet-control-layers-expanded')[0];
  layerControl.style.overflowY = 'auto';
  layerControl.style.maxHeight = layerControlHeight + 'px';
}
map.on('resize', resizeLayerControl);
resizeLayerControl();
</script>

</body>
</html>