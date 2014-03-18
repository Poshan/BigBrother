<?php 
	session_start();
        include "connection.php";
        $name = "";
	$password = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
	  $name = test_input($_POST["name"]);
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
	// 	//encrypt the password with some algos andord: N then return to store in database
	// }
        //echo $name;
        include "connection.php";
        $sql = "SELECT * FROM `user` WHERE `name`='" . $name . "'";
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
		        $W[$row[3]] = array('id' => $row[3]);
                }
	}
        var_dump($W);
	$sql = "SELECT * 
			FROM `person`
			WHERE `person_id` = '" . $_SESSION['W'] . "'";
	;

        $result = mysqli_query($con,$sql);
	$arrayName = array();
        if (! $result){
		echo "no results";
	}
	else{
             while($row = mysqli_fetch_array($result)){
                $X = $row[2]; 
		$Y = $row[3];
                $arrayName[] = array($X,$Y);	
                
                        
		//echo json_encode($arrayName);		//sent to daaam.php
	     }
	}       
print_r($arrayName);
?>
<html>
<head>
  <title>
   this is the end
  </title>
  <script src="http://cdn.leafletjs.com/leaflet-0.4.4/leaflet-src.js"></script>
  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />
  <style>
    #map{height:1000px;width:1000px}
  </style>
</head>		
<body>
<div id ="map"></div>
<script type="text/javascript">
        var x = "<?php echo $X; ?>";
        var y = "<?php echo $Y;?>";
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

</script>
</body>
</html>