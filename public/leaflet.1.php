
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Leaflet Marker - Bootstrap Modal interaction</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
  <script type="text/javascript" src="https://rawgit.com/CliffCloud/Leaflet.EasyButton/master/src/easy-button.js"></script>
  <script type="text/javascript" src="https://rawgit.com/maydemirx/leaflet-tag-filter-button/master/src/leaflet-tag-filter-button.js"></script>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://rawgit.com/maydemirx/leaflet-tag-filter-button/master/src/leaflet-tag-filter-button.css">
  <link rel="stylesheet" type="text/css" href="https://rawgit.com/CliffCloud/Leaflet.EasyButton/master/src/easy-button.css">
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css">


  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <style type="text/css">


  .easy-button-button {
    display: block !important;
  }

  .tag-filter-tags-container {
    left: 30px;
  }


/*
html,
body,
#container {
  height: 100%;
  width: 100%;
  overflow: hidden;
}


.navbar {
  top: 0;
  position: absolute;
}

body {
  padding-top: 50px;
}
*/
#map {
  width: 500px;
  height: 500px;
}


/*******************************
* MODAL AS LEFT/RIGHT SIDEBAR
* Add "left" or "right" in modal parent div, after class="modal".
* Get free snippets on bootpen.com
*******************************/

.modal.left .modal-dialog,
.modal.right .modal-dialog {
  /*position: fixed;*/
  margin: auto;
  width: 30%;
  height: 100%;
  -webkit-transform: translate3d(0%, 0, 0);
  -ms-transform: translate3d(0%, 0, 0);
  -o-transform: translate3d(0%, 0, 0);
  transform: translate3d(0%, 0, 0);
}

.modal.left .modal-content,
.modal.right .modal-content {
  height: 100%;
  overflow-y: auto;
}

.modal.left .modal-body,
.modal.right .modal-body {
  padding: 15px 15px 80px;
}


/*Left*/

.modal.left.fade .modal-dialog {
  left: -320px;
  -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
  -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
  -o-transition: opacity 0.3s linear, left 0.3s ease-out;
  transition: opacity 0.3s linear, left 0.3s ease-out;
}

.modal.left.fade.in .modal-dialog {
  left: 0;
}


/*Right*/

.modal.right.fade .modal-dialog {
  right: -320px;
  -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
  -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
  -o-transition: opacity 0.3s linear, right 0.3s ease-out;
  transition: opacity 0.3s linear, right 0.3s ease-out;
}

.modal.right.fade.in .modal-dialog {
  right: 0;
}


/* ----- MODAL STYLE ----- */

.modal-content {
  border-radius: 0;
  border: none;
}

.modal-header {
  border-bottom-color: #EEEEEE;
  background-color: #FAFAFA;
}

.modal-backdrop {
  background-color: transparent;
  display: none;
}

.modal {
  pointer-events: none;
  z-index: 10000000000000;
}

.modal-content {
  pointer-events: auto;
}

</style>


<!-- TODO: Missing CoffeeScript 2 -->

<script type="text/javascript">

  window.onload=function(){
          
    /*Custom marker */
    PlaceMarker = L.CircleMarker.extend({
      options: {
        id: '',
        radius: 5,
        weight: 1,
        opacity: 1,
        fillOpacity: 0.8
      }
    });

    var greenIcon = L.icon({
      iconUrl: 'leaf-green.png',
      shadowUrl: 'leaf-shadow.png',

      iconSize:     [12, 20], // size of the icon
      shadowSize:   [50, 64], // size of the shadow
      //iconAnchor:   [0, 0], // point of the icon which will correspond to marker's location
      shadowAnchor: [4, 62],  // the same for the shadow
      popupAnchor:  [0, -10] // point from which the popup should open relative to the iconAnchor
    });

    /*Include the marker data and create the layers */
    var data = [
      ["layer1", "text 1", 51.7577, -1.26012, "aaaaa"],
      ["layer1", "2 text", 51.7498, -1.24043, "bbbbb"],
      ["layer2", "textrrr 3", 51.7603, -1.26918, "cccccc"],
      ["layer3", "gfdgfd 4", 51.7538, -1.25609, "ddddd"],
      ["layer3", "hfddhdh 5", 51.752, -1.2577, "eeeeee"]
    ];

    var layer1 = new L.LayerGroup();
    for (var i = 0; i < data.length; i++) {
      if (data[i][0] == "layer1") {
        marker = L.marker([data[i][2], data[i][3]], {
          color: "#000000",
          id: data[i][1],
          tags: ['strawberry', 'ended'],
          icon: greenIcon
        }).bindTooltip(data[i][4],{direction: 'top', offset:[0,-20]}).addTo(layer1).bindPopup("I am a green leaf.").on('click', markerOnClick);
      }
    }

    var layer2 = new L.LayerGroup();
    for (var i = 0; i < data.length; i++) {
      if (data[i][0] == "layer2") {
        marker = L.marker([data[i][2], data[i][3]], {
          color: "#00FFFF",
          id: data[i][1],
          tags: ['tomato', 'active'],
          icon: greenIcon
        }).bindTooltip(data[i][4],{direction: 'top', offset:[0,-20]}).addTo(layer2).bindPopup("I am a green leaf.").on('click', markerOnClick);
      }
    }

    var layer3 = new L.LayerGroup();
    for (var i = 0; i < data.length; i++) {
      if (data[i][0] == "layer3") {
        
        marker = new PlaceMarker([data[i][2], data[i][3]], {
          color: "#008000",
          id: data[i][1],
          tags: ['cherry', 'ended']
        }).bindTooltip(data[i][4],{direction: 'bottom'}).addTo(layer3).bindPopup("I am a green leaf.").on('click', markerOnClick);
      }
    }

    /* Some handy variables*/
    var booklayers = [layer1, layer2, layer3]

      /*Initialise map; change zoom control position*/
    var map = L.map('map', {
      layers: booklayers
    }).setView([51.7520, -1.2577], 13);
    //map.zoomControl.setPosition('bottomright');

    /*Add tileLayers*/
    mapLink = '<a href="http://openstreetmap.org">OpenStreetMap<\/a>';
    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; ' + mapLink + ' Contributors',
      maxZoom: 18,
    }).addTo(map);

    /* Open modal & center map on marker click 	*/
    function markerOnClick(e) {
      var id = this.options.id;
      $(".modal-content").html('This is marker ' + id);
      $('#emptymodal').modal('show');
      map.setView(e.target.getLatLng());
      e.preventDefault();
    }

    /*Close modal on map click */
    map.on('click', function(e) {
      $('.modal').modal('hide');
    });


    L.control.tagFilterButton({
        data: ['active', 'ended'],
        filterOnEveryClick: true,
        icon: '<i class="fa fa-suitcase"></i>',
    }).addTo(map);

    L.control.tagFilterButton({
        data: ['tomato', 'cherry', 'strawberry'],
        filterOnEveryClick: true,
        icon: '<i class="fa fa-pagelines"></i>',
    }).addTo(map);

    jQuery('.easy-button-button').click(function() {
      target = jQuery('.easy-button-button').not(this);
      target.parent().find('.tag-filter-tags-container').css({
          'display' : 'none',
      });
    });

  }

</script>

</head>
<body>

  <div style="width:500px; position:relative; margin:0 auto; border:#000 3px solid; overflow: hidden;">
    
    <!-- Modal EMPTY-->
    <div aria-labelledby="myModalLabel" class="fade" id="emptymodal" role="dialog" tabindex="-1">
      <div role="document">
        <div class="modal-content"></div>
        <!-- modal-content -->
      </div>
      <!-- modal-dialog -->
    </div>
    <!-- modal -->

    <div id="map"></div>

  </div>

  Lorem ipsum dolor sit, amet consectetur adipisicing elit. Libero ut debitis nobis rerum, quidem ratione eos tenetur iste deserunt consequatur? Sapiente, natus voluptatibus quia ut facilis sequi excepturi ratione numquam!
</body>

</html>