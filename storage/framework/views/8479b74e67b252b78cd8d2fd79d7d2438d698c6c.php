<div class="container" id="contact" style="margin-top: 50px">
<div id="Map" style="height:250px"></div>
<script src="<?php echo e(asset('OpenLayers.js')); ?>"></script>
<script>

    var lat            = 27.6795422;
    var lon            = 85.3194047;
    var zoom           = 18;

    var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
    var toProjection   = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
    var position       = new OpenLayers.LonLat(lon, lat).transform( fromProjection, toProjection);

    map = new OpenLayers.Map("Map");
    var mapnik         = new OpenLayers.Layer.OSM();
    map.addLayer(mapnik);

    var markers = new OpenLayers.Layer.Markers( "Markers" );
    map.addLayer(markers);
    markers.addMarker(new OpenLayers.Marker(position));

    map.setCenter(position, zoom);

    var i, l, c = map.getControlsBy( "zoomWheelEnabled", true );
    for ( i = 0, l = c.length; i < l; i++ ) {
        c[i].disableZoomWheel();
    }
</script>
</div>
