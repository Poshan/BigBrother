
<html>
<head>
        
    <script src="http://cdn.leafletjs.com/leaflet-0.4.4/leaflet-src.js"></script>
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />


    <script type="text/javascript">
    function load(){
            var x = 0;
            var y = 0; 
            var allDatesData = (function () {
                var allDatesData = null;
                $.ajax({
                    'async': false,
                    'global': false,
                    'url': "query.php",
                    'dataType': "json",
                    'success': function (data) {
                        allDatesData = data;
                     }
                });
                debugger;
               return allDatesData;
            })();
            var x = allDatesData.x;
            var y = allDatesData.y;
            var latlng = L.latLng(x,y);
            var map = new L.Map('map', {
            center: new L.LatLng(28.425,84.435),
            zoom: 7,
            layers: new L.TileLayer('https://a.tiles.mapbox.com/v3/poshan.hc1eo89i/{z}/{x}/{y}.png')
        });
        var marker = L.marker(latlng).addTo(map);
            var extend1 = new L.LatLngBounds();
            extend1.extend(latlng);
            map.fitBounds(extend1);
    }

    </script>
    <style>
        #map{height: 1000px; width: 1000px;}
    </style>
</head>

<body onload = "load()">
<div id="map"></div>


</body>
</html>