<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Leaflet Tag Filter Button</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

      <script type="text/javascript" src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
      <script type="text/javascript" src="https://rawgit.com/CliffCloud/Leaflet.EasyButton/master/src/easy-button.js"></script>
      <script type="text/javascript" src="https://rawgit.com/maydemirx/leaflet-tag-filter-button/master/src/leaflet-tag-filter-button.js"></script>
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="https://rawgit.com/maydemirx/leaflet-tag-filter-button/master/src/leaflet-tag-filter-button.css">
      <link rel="stylesheet" type="text/css" href="https://rawgit.com/CliffCloud/Leaflet.EasyButton/master/src/easy-button.css">
      <link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css">

  <style type="text/css">
      .leaflet-map {
  height: 500px;
  width: 500px;
}

.easy-button-button {
  display: block !important;
}

.tag-filter-tags-container {
  left: 30px;
}
  </style>


  <script type="text/javascript">

    window.onload=function(){
      
        var osmUrl = 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
            osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            osm = L.tileLayer(osmUrl, {
                maxZoom: 18,
                attribution: osmAttrib
            });

        // initialize the map on the "map" div with a given center and zoom
        var map = L.map('map').setView([50.5, 30.5], 12).addLayer(osm);

        var fastMarker = L.marker([50.521, 30.52], { tags: ['tomato', 'active'] }).bindTooltip('tomato, active').addTo(map); 
        var slowMarker = L.marker([50.487, 30.54], { tags: ['tomato', 'ended'] }).bindTooltip('tomato, ended').addTo(map);
        var bothMarker = L.marker([50.533, 30.5], { tags: ['tomato', 'ended'] }).bindTooltip('tomato, ended').addTo(map);
        var bothMarker = L.marker([50.54, 30.48], { tags: ['strawberry', 'active'] }).bindTooltip('strawberry, active').addTo(map);
        var bothMarker = L.marker([50.505, 30.46], { tags: ['strawberry', 'ended'] }).bindTooltip('strawberry, ended').addTo(map);
        var bothMarker = L.marker([50.5, 30.43], { tags: ['cherry', 'active'] }).bindTooltip('cherry, active').addTo(map);
        var bothMarker = L.marker([50.48, 30.5], { tags: ['cherry', 'ended'] }).bindTooltip('<div>cherry</div>, ended').addTo(map);

        L.control.tagFilterButton({
            data: ['active', 'ended'],
            filterOnEveryClick: true,
            icon: '<i class="fa fa-suitcase"></i>',
        }).addTo( map );

        L.control.tagFilterButton({
            data: ['tomato', 'cherry', 'strawberry'],
            filterOnEveryClick: true,
            icon: '<i class="fa fa-pagelines"></i>',
        }).addTo( map );

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
    <div class="leaflet-map" id="map"></div>
</body>
</html>