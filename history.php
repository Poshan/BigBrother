<?php
	session_start();
	if(isset($_SESSION['name'])){
		echo 'can view following persons';
		echo '<br>';
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
<script src="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js"></script>
<script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js"></script>
<title>View the history not the one where we can see hitler</title>
  <style>
    #map{
	    height:100%;
	    width:100%;
	    position:absolute;
	    left:100px;
	    top:150px;
    }
  </style>
</head>

<body>
<div id="button" style="width:80%; height: 100%">
	<div class="accordion" id="accordion2" position="absolute" style="width:20%; height: 75%" >
		<div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" 	href="#collapseTwo">
                        Viewable persons
                    </a>
                </div>
                <div id="collapseTwo" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <div id="names">
                        </div>
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

function clickfunction(id){
	$.ajax({
  		url: 'abcd.php',
  		type: 'post',
  		data: {pid : id},
  		datatype: 'json',
  		success: function(output){
  			a = JSON.parse(output);
  			for (anythg in a){
  				b = (a[anythg]);
  				for (ath in b){
  					//dis += 'at'+ath+'user was at'+b[ath][0]+','+b[ath][1]; 
  					//working
  					L.marker(b[ath][0],b[ath][1]).addTo(map);
  				}	
  			}
  		}
  		//alert (dis);
	});

}



function addthepersons(person1){
	var panel = document.getElementById("names");
	var rdiv = document.createElement('div');
    	rdiv.setAttribute("class", "btn-group");
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
$('#collapseTwo').show();


</script>
</body>

</html>