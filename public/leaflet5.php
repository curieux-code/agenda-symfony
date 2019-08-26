<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Keeping Leaflet Draw layers on top using .bringToFront</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">



      <script type="text/javascript" src="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.js"></script>
      <link rel="stylesheet" type="text/css" href="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.css">
    <!--
      <script type="text/javascript" src="https://api.mapbox.com/mapbox.js/plugins/leaflet-draw/v0.2.2/leaflet.draw.js"></script>
      <link rel="stylesheet" type="text/css" href="https://api.mapbox.com/mapbox.js/plugins/leaflet-draw/v0.2.2/leaflet.draw.css">
    -->
  <style id="compiled-css" type="text/css">
      html, body, #map {
    height: 100%;
    width:100%;
    padding:0px;
    margin:0px;
}
.dotLegend {
    border-radius: 50%;
    width: 10px;
    height: 10px;
    display:inline-block;
}
.bdotColor {
    background: #20a0ff;
}
.gdotColor {
    background: #40b060;
}
.rdotColor {
    background: #b04040;
}
  </style>


  <!-- TODO: Missing CoffeeScript 2 -->

  <script type="text/javascript">
//<![CDATA[

    window.onload=function(){
      
////////////////////////////////////////////////////////////////////////////////////////////
//setting up the map//
////////////////////////////////////////////////////////////////////////////////////////////

// set center coordinates
var centerlat = 34.05;
var centerlon = -118.25;

// set default zoom level
var zoomLevel = 10;

// initialize map
var map = L.map('map').setView([centerlat, centerlon], zoomLevel);

// set source for map tiles
ATTR = '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a> | ' +
'&copy; <a href="http://cartodb.com/attributions">CartoDB</a>';

CDB_URL = 'http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png';

// add tiles to map
L.tileLayer(CDB_URL, {attribution: ATTR}).addTo(map);

////////////////////////////////////////////////////////////////////////////////////////////
//creating some synthetic GeoJSON data//
////////////////////////////////////////////////////////////////////////////////////////////

//initialize
var bdotlayer;
var bdots;
var bdotcount = 200;

var gdotlayer;
var gdots;
var gdotcount = 75;

var rdotlayer;
var rdots;
var rdotcount = 100;

//cheapo normrand function
function normish(mean, range) {
    var num_out = ((Math.random() + Math.random() + Math.random() + Math.random() - 2) / 2) * range + mean;
    return num_out;
}

//create geojson data with random ~normal distribution
function make_bdots() {

    bdots = {
        type: "FeatureCollection",
        features: []
    };

    for (var i = 0; i < bdotcount; ++i) {

        //set up random variables
        x = normish(0, 3);
        y = normish(0, 3);

        //create points randomly distributed about center coordinates
        var g = {
            "type": "Point",
                "coordinates": [((x * 0.1) + centerlon), ((y * 0.1) + centerlat)]
        };

        //create feature properties, with year roughly proportional to distance from center coordinates
        var p = {
            "id": i,
                "popup": "blue_dot_" + i,
                "year": parseInt(Math.min(Math.sqrt(x * x + y * y) * 80 * (1 - Math.random() / 1.5) + 1900, 2020))
        };

        //create features with proper geojson structure        
        bdots.features.push({
            "geometry": g,
                "type": "Feature",
                "properties": p
        });
    }
}


//create a third set of geojson data slightly displaced from the first
function make_rdots() {

    rdots = {
        type: "FeatureCollection",
        features: []
    };

    for (var i = 0; i < rdotcount; ++i) {

        x = normish(0, 1.5);
        y = normish(0, 1.5);

        //medium-clustered points, displaced slightly to the south
        var g = {
            "type": "Point",
                "coordinates": [((x * 0.07) + centerlon), ((y * 0.07) + centerlat - 0.05)]
        };

        var p = {
            "id": i,
                "popup": "red_dot_" + i,
                "year": parseInt((Math.sqrt(x * x + y * y)) * 100 * (1 - Math.random() / 2) + 1900)
        };

        rdots.features.push({
            "geometry": g,
                "type": "Feature",
                "properties": p
        });
    }
}

make_bdots();
make_rdots();


gdots = {
        type: "FeatureCollection",
        features: [
            "geometry": {
                "type": "Point",
                "coordinates": [
                    -74.90890502929688,
                    40.273239279173055
                ]
            },
            "type": "Feature",
            "properties": {
                "id": '11111',
                "popup": "green_dot_11111",
                "year": "2000"
            }
        ]
    };

/////////////////////////////////////////////////////////////////////////////////////////////
//setting up the aesthetic stuff//
/////////////////////////////////////////////////////////////////////////////////////////////

var bdotStyleDefault = {
    radius: 5,
    fillColor: "#20a0ff",
    color: "#000",
    weight: 0,
    opacity: 1,
    fillOpacity: 0.9
};

var bdotStyleHighlight = {
    radius: 6,
    fillColor: "#20a0ff",
    color: "#22c",
    weight: 1,
    opacity: 1,
    fillOpacity: 0.9
};

var gdotStyleDefault = {
    radius: 5,
    fillColor: "#40b060",
    color: "#000",
    weight: 0,
    opacity: 1,
    fillOpacity: 0.9
};

var gdotStyleHighlight = {
    radius: 6,
    fillColor: "#40b060",
    color: "#22c",
    weight: 1,
    opacity: 1,
    fillOpacity: 0.9
};

var rdotStyleDefault = {
    radius: 5,
    fillColor: "#b04040",
    color: "#000",
    weight: 0,
    opacity: 1,
    fillOpacity: 0.9
};

var rdotStyleHighlight = {
    radius: 6,
    fillColor: "#b04040",
    color: "#22c",
    weight: 1,
    opacity: 1,
    fillOpacity: 0.9
};

//functions to attach styles and popups to the marker layer
function highlightBdot(e) {
    var layer = e.target;
    layer.setStyle(bdotStyleHighlight);
}

function resetBdotHighlight(e) {
    var layer = e.target;
    layer.setStyle(bdotStyleDefault);
}

function onEachBdot(feature, layer) {
    layer.on({
        mouseover: highlightBdot,
        mouseout: resetBdotHighlight
    });
    layer.bindPopup('<table style="width:150px"><tbody><tr><td><div><b>name:</b></div></td><td><div>' + feature.properties.popup + '</div></td></tr><tr class><td><div><b>year:</b></div></td><td><div>' + feature.properties.year + '</div></td></tr></tbody></table>');
}

function highlightGdot(e) {
    var layer = e.target;
    layer.setStyle(gdotStyleHighlight);
}

function resetGdotHighlight(e) {
    var layer = e.target;
    layer.setStyle(gdotStyleDefault);
}

function onEachGdot(feature, layer) {
    layer.on({
        mouseover: highlightGdot,
        mouseout: resetGdotHighlight
    });
    layer.bindPopup('<table style="width:150px"><tbody><tr><td><div><b>name:</b></div></td><td><div>' + feature.properties.popup + '</div></td></tr><tr class><td><div><b>year:</b></div></td><td><div>' + feature.properties.year + '</div></td></tr></tbody></table>');
}

function highlightRdot(e) {
    var layer = e.target;
    layer.setStyle(rdotStyleHighlight);
}

function resetRdotHighlight(e) {
    var layer = e.target;
    layer.setStyle(rdotStyleDefault);
}

function onEachRdot(feature, layer) {
    layer.on({
        mouseover: highlightRdot,
        mouseout: resetRdotHighlight
    });
    layer.bindPopup('<table style="width:150px"><tbody><tr><td><div><b>name:</b></div></td><td><div>' + feature.properties.popup + '</div></td></tr><tr class><td><div><b>year:</b></div></td><td><div>' + feature.properties.year + '</div></td></tr></tbody></table>');
}

/////////////////////////////////////////////////////////////////////////////////////////////
//displaying the data on the map//
/////////////////////////////////////////////////////////////////////////////////////////////

rdotlayer = L.geoJson(rdots, {
    pointToLayer: function (feature, latlng) {
        return L.circleMarker(latlng, rdotStyleDefault);
    },
    onEachFeature: onEachRdot
}).addTo(map);

gdotlayer = L.geoJson(gdots, {
    pointToLayer: function (feature, latlng) {
        return L.circleMarker(latlng, gdotStyleDefault);
    },
    onEachFeature: onEachGdot
}).addTo(map);

bdotlayer = L.geoJson(bdots, {
    pointToLayer: function (feature, latlng) {
        return L.circleMarker(latlng, bdotStyleDefault);
    },
    onEachFeature: onEachBdot
}).addTo(map);

//add layer controls/legend
var overlayMaps = {
    '<div class="dotLegend bdotColor"></div> The Blue Dots': bdotlayer,
        '<div class="dotLegend gdotColor"></div> The Green Dots': gdotlayer,
        '<div class="dotLegend rdotColor"></div> The Red Dots': rdotlayer
};

layerbox = L.control.layers(null, overlayMaps, {
    collapsed: false
}).addTo(map);

var featureGroup = L.geoJson().addTo(map);

var drawControl = new L.Control.Draw({
    edit: {
        featureGroup: featureGroup
    }
}).addTo(map);

map.on('draw:created', function (e) {
    featureGroup.addLayer(e.layer);
});
map.on('overlayadd', function () {
    featureGroup.bringToFront();
});

    }

//]]></script>

</head>
<body>
    <div id="map"></div>
</body>
</html>