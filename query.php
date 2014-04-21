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
    
    $pw = ""; //password
    
    $img_link = "";//image link work on this
    
    while ($roow = mysqli_fetch_array($result1)){
      $pw = $roow[2];
      $img_link = $roow[3];
    }
    //echo $img_link;
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
                  //$row now have got 0->id 1->name 2->password 3->image 
                  // initialize array persons[]
                  //step1: get the uid and search in the reltn for the person_id where uid = $row[0] store it in the array persons[]
                  //step 2 : loop through the persons array and search for the person_id in the person table and acquire the coordinates
                  //$persons  = array();
                  $sql2 = "SELECT * FROM `relatn` WHERE `uid`='" . $row[0] . "' AND `viewable` = 1";
                  $result2 = mysqli_query($con, $sql2) or die(mysqli_error($con)); 
                  if (!result2){
                    echo "noone to view";
                  }
                  else{
                    while ($rows = mysqli_fetch_array($result2)){
                      $sql = "SELECT * FROM `person`WHERE `person_id` = '" . $rows[1] . "'";
                      $person_result = mysqli_query($con,$sql);
                      while($row1 = mysqli_fetch_array($person_result)){
                              $X = $row1[2]; 
                              $Y = $row1[3];
                              $acc = $row1[4];
                              $imag_link = $row1[5]; 
                              //$arrayName[] = array($X,$Y);  
                              //echo $row1[1];
                              $W[] = array($row1[1] => array($X,$Y,$acc,$imag_link));
                          
                            //echo json_encode($arrayName);     
                      }       
                      
                    }
                  }
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                
                /*$sql = "SELECT * FROM `person`WHERE `person_id` = '" . $row[3] . "'";
                  $person_result = mysqli_query($con,$sql);
                  while($row1 = mysqli_fetch_array($person_result)){
                          $X = $row1[2]; 
                          $Y = $row1[3];
                          $acc = $row1[4];
                          //$arrayName[] = array($X,$Y);  
                          //echo $row1[1];
                          $W[] = array($row1[1] => array($X,$Y,$acc));
                      
                        //echo json_encode($arrayName);     //sent to daaam.php
                  }*/     
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
     #top-bar1 {
      position: absolute;
      top: 05px;
      left: 150px;
      z-index: 1001;
  font-size: 1.0em;
  margin-top: 0.6em;
  margin-bottom: 1em;
  font-weight: bold;
  padding: 4px 12px 3px;
  margin-left: 0;
  margin-right: 0;
  background: #edeeef;
  border-right: 1px solid #ccc;
  border-bottom: 1px solid #ccc;

  color: white;

  background-color: #b0de5d;
  background-image: -moz-linear-gradient(top, #b0de5c, #82cb00); /* FF3.6 */
  background-image: -o-linear-gradient(top, #b0de5c, #82cb00); /* Opera 11.10+ */
  background-image: -webkit-gradient(linear, left top, left bottom, from(#c0de5d), to(#82cb00)); /* Saf4+, Chrome */
  background-image: -webkit-linear-gradient(top, #b0de5c, #82cb00); /* Chrome 10+, Saf5.1+ */
  background-image: linear-gradient(top, #b0de5c, #82cb00);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#b0de5c', EndColorStr='#82cb00'); /* IE6�IE9 */

  border-radius: 5px;

  text-shadow: 0 -1px 1px rgba(0,0,0,0.35);
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
<div id = "top-bar1">
  u are currently offline 
  go back to <a href = 'index.php'>login page</a>
</div>
<script type="text/javascript">
        $('#top-bar1').hide();
        function button_click(){
          window.location.href = "http://kathmandulivinglabs.org/tracker/history.php";
        }
        
        var jso = <?php echo json_encode($W);?>;
        //console.log(jso);
        if (jso == null){
          $('#top-bar').hide();
          $('#top-bar1').show();
     
          
        }
        var image_link  = '<?php echo ($img_link);?>';
        if (!image_link){
          console.log('default image function called');
          var panel = document.getElementById("container");
          var img = document.createElement("img");
          img.src = "/uploads/banner/B5Bssd130803010803.jpg";
          img.width = "80";
          img.height = "50";
          img.position = "fixed";
          panel.appendChild(img);
        }
        else{
          
          console.log('custom image called');
          
          var panel = document.getElementById("container");
          var img = document.createElement("img");
          img.src = image_link;
          img.alt = 'poshan';
          img.width = "80";
          img.height = "50";
          img.positon = "fixed";
          panel.appendChild(img);
        }
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
            img_lnk = x[3];
            //create icon of the image of the users
            if (!img_lnk){
              var myIcon = L.icon({
                iconUrl: '/uplaods/team/130803010816uLs11b.jpg',
                iconSize: [25,25],
                iconAnchor:[5,5],
              });
            }
            else {
              var myIcon = L.icon({
                iconUrl: img_lnk,
                iconSize: [25,25],
                iconAnchor:[5,5],
              });
            }
            //debugger;
            //this(acc) is accuracy value scale it and then use as the radius of the circle
            
            var circle = L.circle(x, acc*100, {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5
      }).addTo(map);
             
            var marker = L.marker(x); //automatically takes the first two elements in this case it is lat and lon
            //var marker = L.marker((x), {icon:myIcon});
            /*marker.bindLabel(any,{
              noHide:true,
              direction:'auto'
            }).showLabel();
            //marker.addTo(map);
            //marker.bindPopup(any);
            */
            
            //instead of making the image markers trying the image in popup
            popupContent = '<img src = ' + img_lnk + ' height = ' + 42 + ' width = ' + 42 + '>';
            marker.bindPopup(popupContent).openPopup().addTo(map);
            
            
            
            
            
            //marker.addTo(map);
            
            
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