<?php
	session_start();
	if(isset($_SESSION['name'])){
		$nam = $_SESSION['name'];
		include 'connection.php';
		$sql1 = "SELECT * FROM `user` WHERE `name`='" . $nam . "'";
		$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
		$person_list = array();
		if (!$result1){
			echo 'no history for the user';
		}
		else{
			while ($row = mysqli_fetch_array($result1)){
				$sql = "SELECT * FROM `person`WHERE `person_id` = '" . $row[3] . "'";
				$person_result = mysqli_query($con,$sql);
				while($row1 = mysqli_fetch_array($person_result)){
					//$person_list [] = $row1[1];
					$person_list [] = array($row1[0]=>$row1[1]); 
					//echo '<button id = "history">' . $row1[1] . '</button>';
					
				}				
			}
		}
		//var_dump ($person_list);
	
	}
	
	else{
		echo 'please log in';
	}
?>
<html>
<head>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
 <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js"></script>
<script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<script src="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js"></script>
<title>View the history not the one where we can see hitler</title>
  <style>
    #map{
	    height:100%;
	    width:100%;
	    
	    outline: 5px inset #ADB0FF;
	    outline-offset: 10px;
	    top: 10px;
    }
    #leftside{
					left:835px;
					top:25px;
					width:100px;
					z-index:1000;
					position: absolute;
			}
    #names{
    	
    }
  </style>
</head>

<body>
<div id="leftside">		
	<div class="panel-group" id="accordion">
	  <div class="panel panel-default">
	    <div class="panel-heading">
	      <h4 class="panel-title">
	        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
	          View Persons
	        </a>
	      </h4>
	    </div>
	    <div id="collapseOne" class="panel-collapse collapse">
	      <div id="names" class="panel-body">
	      </div>
	    </div>
	  </div>
	</div>
</div>	
<div id ='map'></map>

<script type="text/javascript">
var person = <?php echo json_encode($person_list);?>;
//take each item from person and call the addtheperson(each item from person) function
var person_obj = {};
var map = new L.Map('map', {
    center: new L.LatLng(28.425,84.435),
    zoom: 7,
    layers: new L.TileLayer('https://a.tiles.mapbox.com/v3/poshan.hc1eo89i/{z}/{x}/{y}.png')
});

$(person).each(function(p){
	x = person[p]; 
	for (a in x){
		person_obj[a] = x[a];
		//console.log(x[a]);
	}
})


addthepersons(person_obj);
dis = '';
latlngforpll = [];
var marker = L.marker();
var marker_layergr = L.layerGroup();
//var polyline = L.polyline();
function createpolyline(l4pll){
	//debugger;
	var polyline = L.polyline(l4pll, {color: 'red'}).addTo(map);
	marker_layergr.addLayer(polyline);
	//polyline.setLatLngs(l4pll);
	//polyline.addTo(map);
	
}

function clickfunction(id){
	alert('clicked');
	console.log(id);
	if (marker.getLatLng()){
		marker_layergr.clearLayers();
	}
	$.ajax({
  		url: 'abcd.php',
  		type: 'post',
  		data: {pid : id},
  		datatype: 'json',
  		success: function(output){

  			a = JSON.parse(output);
  			  		console.log(a);
  			for (anythg in a){
  				b = (a[anythg]);
  				for (ath in b){
  					//dis += 'at'+ath+'user was at'+b[ath][0]+','+b[ath][1]; 
  					//working
  					x = parseInt(b[ath][0]);
  					y = parseInt(b[ath][1]);
  					var latlng = L.latLng(x,y);
  					latlngforpll.push(latlng);
  					
  					marker = L.marker(latlng).addTo(map);
  					marker.bindPopup(ath);
  					marker_layergr.addLayer(marker);
  					
  				}
  				createpolyline(latlngforpll);	
  			}
  			
  		}
  		
  		//alert (dis);
	});
}
marker_layergr.addTo(map);

//to dos:: put the extend hint:::::use the polyline 
//photos




function addthepersons(person1){
	console.log(person_obj);
	var panel = document.getElementById("names");
	var rdiv = document.createElement('div');
    	rdiv.setAttribute("class", "btn-group-vertical");
    	rdiv.setAttribute("data-toggle", "buttons");
    	panel.appendChild(rdiv);
    	for (a in person_obj){
    		
    		var button = document.createElement('input');
	        button.type = 'radio';
	        button.name = 'options';
	        button.id = a;
	        button.setAttribute("onclick","clickfunction(this.id)");
	        
	        var label = document.createElement('label');
        	label.setAttribute("class", "btn btn-default");
        	label.innerHTML = person_obj[a];
        	label.appendChild(button);
        	rdiv.appendChild(label);
	      
	 }	
}
</script>
	
</body>

</html>