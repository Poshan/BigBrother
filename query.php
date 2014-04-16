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
                          $acc = $row1[4];
                          //$arrayName[] = array($X,$Y);  
                          //echo $row1[1];
                          $W[] = array($row1[1] => array($X,$Y,$acc));
                      
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
  //echo 'password doesnot match';
  //take back to the login page
  //echo '<a href = '/user.php'>' . 'goto the login page' . '</a>';
}
?>
<html>
<head>
  <title>
   this is the start
  </title>
  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://leaflet.github.io/Leaflet.label/leaflet.label.css" />

  
  <script src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script>
 <script src="http://leaflet.github.io/Leaflet.label/leaflet.label.js"></script>
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


  <style>
   #top-bar{
      height: 45px;
      width : 500px;
      position: relative;
      z-index: 1001;
      background-image:url('/public_html/uploads/team/kll-logo.png');
      background-color:#EDE8A6;
      
    }
    #container{
      top : 0px;
      left:500px;
      height:45px;
      width:500px;
      position: absolute;
      background-color:darkkhaki;
      
    }
    #map{
      
      width:100%;
      bottom: 0;
      position: absolute;
      left:10px;
      top: 55px;
    }
    
  </style>
</head>     
<body>
 
<!-- <a href="history.php">click</a> -->
<div id = "top-bar">
  <h1>Track-or whereever you ll go</h1>
  <div id="container">
  <button type="button" id="loading-example-btn" data-loading-text="Loading..." class="btn btn-primary" onclick= "button_click()">View Tracks            
  </button>
            <button data-toggle="dropdown" class="btn btn-info dropdown-toggle">Settings <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">LOgOuT</a></li>        
            </ul>
        </div>
</div>
<div id ="map"></div>
<script type="text/javascript">
        function button_click(){
          window.location.href = "http://kathmandulivinglabs.org/tracker/history.php";
        }
        var jso = <?php echo json_encode($W);?>;
      
        
        
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
        var extend1 = new L.LatLngBounds();
        //var markers = new L.MarkerClusterGroup({ spiderfyOnMaxZoom: false, showCoverageOnHover: true, zoomToBoundsOnClick: false });
        var map = new L.Map('map', {
            center: new L.LatLng(28.425,84.435),
            zoom: 7,
            layers: new L.TileLayer('https://a.tiles.mapbox.com/v3/poshan.hc1eo89i/{z}/{x}/{y}.png')
        });
        
        for (any in coords){
            x = coords[any];
            acc = x[2];
            //this is accuracy value scale it and then use as the radius of the circle
            //console.log(acc);
            var circle = L.circle(x, acc*100, {
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
        L.control.scale().addTo(map);       

</script>
</body>
</html>