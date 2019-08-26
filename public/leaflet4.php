<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
    #map {
    height: 500px;
    }
    </style>

    <head>
  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.css" />
  <!--[if lte IE 8]>
      <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.ie.css" />
  <![endif]-->
  <script src="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.js"></script>
</head>
<body>
<h1></h1>
<div id="map"></div>

<script>
    var treeIcon = L.icon({
    iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/images/marker-icon.png',
    iconSize: [32, 37],
    iconAnchor: [16, 37],
    popupAnchor: [0, -37]
    });

    var trainIcon = L.icon({
    iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/images/marker-icon-2x.png',
    iconSize: [37, 30],
    iconAnchor: [16, 37],
    popupAnchor: [0, -37]
    });

    var treeLayer = L.marker([33.9,-84.4], {icon: treeIcon});

    var trainLayer = L.marker([33.8,-84.5], {icon: trainIcon});

    var map = L.map('map', {
    center: [33.8, -84.4],
    zoom: 11,
        layers: [trainLayer, treeLayer]
    });

    var overlayMaps = {
    "<img src='https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/images/marker-icon-2x.png' height=24>Train": trainLayer,
    "<img src='https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/images/marker-icon-2x.png' height=24>Tree": treeLayer
    };

    L.control.layers(null, overlayMaps, {
    collapsed: false
    }).addTo(map);

    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
    }).addTo(map);
</script>


</body>
</html>