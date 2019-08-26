
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Leaflet Marker - Bootstrap Modal interaction</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">



<link rel="stylesheet" type="text/css" href="http://cdn.leafletjs.com/leaflet-0.6.2/leaflet.css">
<link rel="stylesheet" type="text/css" href="http://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.css">
<link rel="stylesheet" type="text/css" href="http://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.Default.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  
<style type="text/css">


/* Map */

#map {
  height: 100vh;
}

.hcoMarkerIcon,
.hcpMarkerIcon {
  font-family: FontAwesome;
  border-radius: 50%;
  background: #f18c16;
  border: 2px solid #f18c16;
  box-shadow: inset 0 0 0 2px white;
  line-height: .7em;
  padding: 10px;
  font-size: 1.4em;
  color: white;
}


/* Cluster styles from MarkerCluster.Default.css */

.marker-cluster-small {
  background-color: rgba(43, 49, 54, 0.6);
}

.marker-cluster-small div {
  background-color: rgba(43, 49, 54, 0.6);
  color: white;
}

.marker-cluster-medium {
  background-color: rgba(43, 49, 54, 0.6);
}

.marker-cluster-medium div {
  background-color: rgba(43, 49, 54, 0.6);
  color: white;
}

.marker-cluster-large {
  background-color: rgba(43, 49, 54, 0.6);
}

.marker-cluster-large div {
  background-color: rgba(43, 49, 54, 0.6);
  color: white;
}

// numbered div icons
.leaflet-numbered-div-icon {
	background: transparent !important;
	border: none !important;
}
.leaflet-marker-icon .number{
	position: relative;
	top: -42px;
	font-size: 12px;
	width: 25px;
	text-align: center;
}
.leaflet-svg-icon .pin {
  color: yellow !important;
}
</style>

</head>
<body>
  <div id="map"></div>

  

<script type="text/javascript" src="http://cdn.leafletjs.com/leaflet-0.6.2/leaflet.js"></script>
<script type="text/javascript" src="http://leaflet.github.io/Leaflet.markercluster/dist/leaflet.markercluster-src.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Faker/3.1.0/faker.min.js"></script>

<script type="text/javascript">

L.VectorMarkers = {};
  L.VectorMarkers.version = "1.0.0";
  L.VectorMarkers.MAP_PIN = "M25,0.4c-9.9,0-18,8.1-18,18c0,4.6,1.7,8.8,4.6,12c0,0,11.7,11.7,13.5,19.2c1.6-7.8,13.3-19.2,13.3-19.2\
		c2.9-3.2,4.6-7.4,4.6-12C43,8.4,34.9,0.4,25,0.4z M25,29.7c-6.4,0-11.6-5.2-11.6-11.6S18.6,6.6,25,6.6s11.6,5.2,11.6,11.6\
		S31.4,29.7,25,29.7z";
  L.VectorMarkers.Icon = L.Icon.extend({
    options: {
      iconSize: [50, 50],
      iconAnchor: [25, 50],
      popupAnchor: [0, -33],
      shadowAnchor: [25, 50],
      shadowSize: [41, 41],
      className: "vector-marker",
      prefix: "fa",
      spinClass: "fa-spin",
      extraClasses: "",
      icon: "home",
      markerColor: "red",
      iconColor: "white"
    },
    initialize: function(options) {
      return options = L.Util.setOptions(this, options);
    },
    createIcon: function(oldIcon) {
      var div, icon, options, pin_path;
      div = (oldIcon && oldIcon.tagName === "DIV" ? oldIcon : document.createElement("div"));
      options = this.options;
      if (options.icon) {
        icon = this._createInner();
      }
      pin_path = L.VectorMarkers.MAP_PIN;
      div.innerHTML = '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50" style="enable-background:new 0 0 100 100;" xml:space="preserve">' + '<g><path class="pin" d="' + pin_path + '" fill="' + options.markerColor + '"></path><circle cx="25" cy="18" r="11.5" fill="white" /></g>' + icon + '</svg>';
      this._setIconStyles(div, "icon");
      this._setIconStyles(div, "icon-" + options.markerColor);
      return div;
    },
    _createInner: function() {
      var iconClass, iconColorClass, iconColorStyle, iconSpinClass, options;
      iconClass = void 0;
      iconSpinClass = "";
      iconColorClass = "";
      iconColorStyle = "";
      options = this.options;
      if (options.prefix === '' || options.icon.slice(0, options.prefix.length + 1) === options.prefix + "-") {
        iconClass = options.icon;
      } else {
        iconClass = options.prefix + "-" + options.icon;
      }
      if (options.spin && typeof options.spinClass === "string") {
        iconSpinClass = options.spinClass;
      }
      if (options.iconColor) {
        if (options.iconColor === "white" || options.iconColor === "black") {
          iconColorClass = "icon-" + options.iconColor;
        } else {
          iconColorStyle = "style='color: " + options.iconColor + "' ";
        }
      }
      return "<i " + iconColorStyle + "class='" + options.extraClasses + " " + options.prefix + " " + iconClass + " " + iconSpinClass + " " + iconColorClass + "'></i>";
    },
    _setIconStyles: function(img, name) {
      var anchor, options, size;
      options = this.options;
      size = L.point(options[(name === "shadow" ? "shadowSize" : "iconSize")]);
      anchor = void 0;
      if (name === "shadow") {
        anchor = L.point(options.shadowAnchor || options.iconAnchor);
      } else {
        anchor = L.point(options.iconAnchor);
      }
      if (!anchor && size) {
        anchor = size.divideBy(2, true);
      }
      img.className = "vector-marker-" + name + " " + options.className;
      if (anchor) {
        img.style.marginLeft = (-anchor.x) + "px";
        img.style.marginTop = (-anchor.y) + "px";
      }
      if (size) {
        img.style.width = size.x + "px";
        return img.style.height = size.y + "px";
      }
    },
    createShadow: function() {
      var div;
      div = document.createElement("div");
      this._setIconStyles(div, "shadow");
      return div;
    }
  });
  L.VectorMarkers.icon = function(options) {
    return new L.VectorMarkers.Icon(options);
  };


// Create the map
map = L.map('map', {
  center: [7.2, 40.9],
  zoom: 2
});

// Create map tiles
L.tileLayer('https://api.tiles.mapbox.com/v4/pvanb.pnkhglg4/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoicHZhbmIiLCJhIjoiY2lsNW15ZDBnMDAwcnVrbHo2cTRvN2cxNSJ9.pQTG0MDcOEc14WR1sgA4dw', {
  //attribution: "Map: Tiles Courtesy of MapQuest (OpenStreetMap, CC-BY-SA)",
  maxZoom: 20,
  minZoom: 2
}).addTo(map);

// Define custom HCO/HCP icons using FontAwesome; styled via CSS
var hcoIcon = L.divIcon({
  iconAnchor: [18, 18],
  className: 'hcoMarkerIcon',
  html: '&#xf0f8;' // fa-hospital-o
});
var hcpIcon = L.divIcon({
  iconAnchor: [18, 18],
  className: 'hcpMarkerIcon',
  html: '&#xf0f0;' // fa-user-md
});

// Create a marker cluster group
var markers = new L.MarkerClusterGroup({
  showCoverageOnHover: false,
  zoomToBoundsOnClick: false,
  animateAddingMarkers: true,
  singleMarkerMode: false
});

// When a marker is clicked: already handled via marker.bindPopup()
markers.on('click', function(a) {});

// When cluster is clicked: generate a popup with the list of titles
markers.on('clusterclick', function(a) {
  // a.layer is actually a cluster
  var markers = a.layer.getAllChildMarkers();
  var content = $("<div/>");
  for (var m = 0; m < markers.length; m++) {
    content.prepend("<div>" + markers[m].options.title + "</div>");
  }
  var pop = new L.popup().
  setLatLng(a.latlng).
  setContent(content.html());
  pop.openOn(map);
});
/*
// Generate some random markers
for (var i = 0; i < 100; i++) {
  var isHco = !!Math.floor((Math.random() * 100) % 2)
  var title = isHco ? faker.company.companyName() : faker.name.findName();
  var marker = L.marker(new L.LatLng(faker.address.latitude(), faker.address.longitude()), {
    icon: isHco ? hcoIcon : hcpIcon,
    title: title
  });
  marker.bindPopup(title);
  markers.addLayer(marker);
}
*/
var pinMarker = new L.Marker(L.latLng(0, 0));
//markers.addLayer(pinMarker);
//pinMarker.addTo(map);

var numberMarker = new L.Marker(new L.LatLng(0, 0), {
    icon:	new L.VectorMarkers.icon()
});
numberMarker.addTo(map);
//markers.addLayer(numberMarker);


// Add markers to the map
//markers.addTo(map);



</script>

</body>
</html>