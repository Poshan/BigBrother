<?php 
    session_start();
        include "connection.php";
        $_SESSION['name'] = "";
      $password = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
      $_SESSION['name'] = test_input($_POST["name"]);
      $password = test_input($_POST["password"]);
      // $password = password_encrypter($_POST["password"]);
    }
    function test_input($data)
    {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
    // funtion password_encrypter ($data){
    //  //encrypt the password with some algos andord: N then return to store in database
    // }
        //echo $name;

    include "connection.php";
    $sql1 = "SELECT * FROM `user` WHERE `name`='" . $_SESSION['name'] . "'";
    $result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
    $pw = ""; 
    while ($roow = mysqli_fetch_array($result1)){
      $pw = $roow[2];
    }
    //echo $pw;
    if ($password = $pw) {
      $sql = "SELECT * FROM `user` WHERE `name`='" . $_SESSION['name'] . "'";
      $W = array();
        //$_SESSION['W']=array();
        //$W = "";
      $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        
      if (!$result){
          echo "no result";
      }
      else {
          while ($row = mysqli_fetch_array($result)){
                        //$row = mysqli_fetch_array($result);
                        //$_SESSION['W'] = $row[3];
                    
                $sql = "SELECT * FROM `person`WHERE `person_id` = '" . $row[3] . "'";
                  $person_result = mysqli_query($con,$sql);
                  while($row1 = mysqli_fetch_array($person_result)){
                          $X = $row1[2]; 
                          $Y = $row1[3];
                          //$arrayName[] = array($X,$Y);  
                          echo $row1[1];
                          $W[] = array($row1[1] => array($X,$Y));
                      
                        //echo json_encode($arrayName);     //sent to daaam.php
                  }       
          }
      }
       //var_dump ($W);
       //echo '<br>';
      //echo json_encode($W);
    
//print_r($arrayName);
}
else{
  echo 'password doesnot match';
}
?>
<html>
<head>
  <title>
   this is the start
  </title>
  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />
  <link rel="stylesheet" href="http://leaflet.github.io/Leaflet.label/leaflet.label.css" />
  <script src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script>
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="http://leaflet.github.io/Leaflet.label/leaflet.label.js"></script>

  <style>
    #map{height:100%;width:100%}
  </style>
</head>     
<body>
view the hstory that
<a href="history.php">click</a>
<div id ="map"></div>
<script type="text/javascript">
        //var x = "<?php echo $X; ?>";
        //var y = "<?php echo $Y;?>";
        var jso = <?php echo json_encode($W);?>;
        
        //var jso = <?php echo $W; ?>;
        //var jso_obj = JSON.parse(jso);
        var coords = {};
        var latlng = [];
        for(sth in jso){
            sth_in = jso[sth]; ;
            for(any in sth_in){
                name = any;
                ins = sth_in[any];
                // coords.push(ins);
                coords[name] = ins;
            }
         }
        //debugger;

        // for (var i = 0; i < coords.length; i++) {
        //     var x = coords[i][0];
        //     var y = coords[i][1];
        //     var ll = L.latLng(x,y);
        //     latlng.push(ll);

        // };
        
        //var latlng = L.latLng(x,y);
        var extend1 = new L.LatLngBounds();
        //var markers = new L.MarkerClusterGroup({ spiderfyOnMaxZoom: false, showCoverageOnHover: true, zoomToBoundsOnClick: false });
        var map = new L.Map('map', {
            center: new L.LatLng(28.425,84.435),
            zoom: 7,
            layers: new L.TileLayer('https://a.tiles.mapbox.com/v3/poshan.hc1eo89i/{z}/{x}/{y}.png')
        });
        
        for (any in coords){
            x = coords[any];
            //var latlng = L.latlng[x];
            //the number 50 represents the radius of the circle this will be the radius of the accuracy data from gps
            var circle = L.circle(x, 50, {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5
      }).addTo(map);
            
            var marker = L.marker(x);
            marker.bindLabel(any,{
              noHide:true,
              direction:'auto'
            }).showLabel();
            //marker.addTo(map);
            //marker.bindPopup(any);
            marker.addTo(map);
            //markers.addLayer(marker);
            var x1,y1;
            for (p in x){
                 x1 = x[0];
                 y1 = x[1];
                 var ll = L.latLng(x1,y1);
   
                 latlng.push(ll);
            }
        } 
        //map.addLayer(markers);
        
        for (var i = 0; i < latlng.length; i++) {
            //L.marker(latlng[i]).addTo(map);
            extend1.extend(latlng[i]);
        };
        //var marker = L.marker(latlng).addTo(map);
        //http://leaflet.github.io/Leaflet.label/leaflet.js and             http://leaflet.github.io/Leaflet.label/leaflet.label.css
        map.fitBounds(extend1);        

</script>
</body>
</html>