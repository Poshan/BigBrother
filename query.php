<?php 
    //if (empty ($_SESSION['namm'])){
    	session_start();
    //}
    echo 'i love ';
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    	echo 'checkpost';
    	if (!isset($_SEESION['namm'])){
	      $_SESSION['namm'] = test_input($_POST["name"]);
	      $password = $_POST["pwd"];
      	}
    }
    
    $phir = $_SESSION['namm'];
    function test_input($data)
    {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
   
   
if(isset($_SESSION['namm'])){
	echo 'session namm check';
    include "connection.php";
    $sql1 = "SELECT * FROM `user` WHERE `name`='" . $_SESSION['namm'] . "'";
    $result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
   
    
    
    $pw = ""; //password
    
    $img_link = "";//image link work on this
    
    while ($roow = mysqli_fetch_array($result1)){
    	$pw = $roow[2];
    	$_SESSION['idd'] = $roow[0];
    	$img_link = $roow[3];
    }
    //echo $img_link;
   
   echo $password;
   echo $pw;
    if (crypt($password, $pw) == $pw) { //make ==
    	echo 'passwordcheck';
    	$sql = "SELECT * FROM `user` WHERE `name`='" . $_SESSION['namm'] . "'";
    	$W = array();

    	$result = mysqli_query($con, $sql) or die(mysqli_error($con));
        
    	if (!$result){
        	echo "no result";
        	exit();
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
	    top: 105px;
    }
    #map-prof{
    	    width:100%;
	    bottom: 0;
	    position: absolute;
	    left:10px;
	    top: 105px;
    
    }
    #for-nav-tabs{
    	top : 0px;
    	left:500px;
    	height:45px;
    	width:200px;
    	position: absolute;
    	background-color:darkkhaki;
    }
    
  </style>
</head>     
<body>
 
<!-- <a href="history.php">click</a> -->
<div id = "top-bar">
	<h1>Track-or wherever you ll go</h1>
	
		<div id="container">
	<button type="button" id="loading-example-btn" data-loading-text="Loading..." class="btn btn-primary" onclick= "button_click()">View Tracks		         
	</button>
            <button data-toggle="dropdown" class="btn btn-info dropdown-toggle">Settings <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">LOgOuT</a></li>        
            </ul>
        </div>       
</div>
	
		<ul class="nav nav-tabs">
			<li class="active"><a href="#home" data-toggle="tab">Home</a></li>
			<li><a href="#profile" data-toggle="tab">Profile</a></li>
		</ul>

			<!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane active" id="home">
				<div id ="map"></div>
				
			</div>
			
			
			//the profile page
			<div class="tab-pane" id="profile">...
				//design the profile page
				<h1>profile page</h1>
				<div id="prof">these are your viewable persons </div>
				<script>
				   var person_obj1 = {};
 				   function create_table_from(obj){
				    //function create_table_from(obj,dddiv){ // to create the buttons when the objects and the div in which the buttons are 
				    	//var prof1 = dddiv;
				    	var panel = document.getElementById('prof');
				    	//var panel = document.getElementById(prof1);
				    	var rdiv = document.createElement('div');
				    	rdiv.setAttribute("class", "btn-group-vertical");
				    	rdiv.setAttribute("data-toggle", "modal");
				    	panel.appendChild(rdiv);
				    	
				    	for (a in obj){
				    		var button = document.createElement('input');
				    		button.setAttribute("class","btn btn-primary")
					        button.type = 'button';
					        button.name = 'options';
					        button.id = a; 
				    		button.value = obj[a];
				    		rdiv.appendChild(button);
				    		
						
				    	}
				    
				    };
				    
				    $.ajax({
					url : 'person_list.php',
					datatype:'json',
					success: function(output){
						
						//console.log(output);
						a = JSON.parse(output); 
						    for (any in a){ 
							b = a[any];
							for (anyth in b){
								person_obj1[anyth] = b[anyth]
							}
						    }
						//create_table_from(person_obj1,'prof');
						create_table_from(person_obj1);
					}
					
				    });
				    
				   
					
				
				</script>
				
				<div id = 'requests'>THese are the requests  incomming</div>
				<script>
					
					var incom_request ={};
					
					
					requests();
					function on_top_bar(what){
						//debugger;
						if (what == 'yes'){
							var content = 'You added a new person'
						}
						
						else if (what == 'no'){
							var content = 'you rejected the request'
						}
						var ddiv = document.getElementById('top-bar1');
						ddiv.innerHTML = content;
						
						$('#top-bar1').show();
						$('#top-bar1').delay(1000).fadeOut();
						//$('#accept_reject').hide();
						
						//name of the id required
					}
					function clickfunction(id, acn){
						//id is the id of request "pathaune manchhey"
						//if this is the acceptance buttons' click function make actn=0 and send to the same php
						actn = acn;
						console.log('sent to'),actn;
						$.ajax({
							url : "requests_responses.php",
							type:'post',
							data: {
								action: actn,
								req_id : id					
							},
							success: function(output){
								//debugger;
								//console.log(output);
								if (output == 'yes'){
									
									on_top_bar('yes');
									//requests();
									
								}
								
								else if (output == 'no'){
									on_top_bar('no');
									
								}
								
								
								
								//now hide this request
							}
							
						
						});
						
						
					}
					
					function create_table_fromm(obj){
					    	
					    	//var prof1 = dddiv;
					    	var panel = document.getElementById('requests');
					    	//var panel = document.getElementById(prof1);
					    	
					    	
					    	
					    	
					    	
					    	for (a in obj){
					    		//display the name
					    		var named = document.createElement('div');
					    		named.innerHTML = obj[a];
					    		panel.appendChild(named);
					    		var rdiv = document.createElement('div');
					    		rdiv.setAttribute("class", "btn-group-vertical");
					    		rdiv.setAttribute("data-toggle", "modal");
					    		panel.appendChild(rdiv);
					    		//accept button
					    		var button = document.createElement('input');
					    		button.setAttribute("class","btn btn-primary");
						        button.type = 'button';
						        button.name = 'options';
						        button.id = a; 
					    		//button.value = obj[a];
					    		button.value = 'approve';
					    		button.setAttribute("onclick","clickfunction(this.id,1)");
					    		rdiv.appendChild(button);
					    		
					    		//reject button
					    		var button_rej = document.createElement('input');
					    		button_rej.setAttribute("class", "btn btn-primary");
					    		button_rej.type = 'button';
					    		button_rej.name = 'options';
					    		button_rej.id = a;
					    		button_rej.value = 'Decline';
					    		button_rej.setAttribute("onclick","clickfunction(this.id,2)");						   
							rdiv.appendChild(button_rej);
					       }
				    
				   	};
					
					function requests(){
						$.ajax({
							url:'requests.php//',
							datatype:'json',
							type: 'post',
							data:{request_type:1},//1 means incoming requests
							success:function(output){
								//debugger;
								a = JSON.parse(output); 
							    	for (any in a){ 
									b = a[any];
									for (anyth in b){
										incom_request[anyth] = b[anyth]
									}
							   	 }
							//create_table_from(incom_request,'requests');
								create_table_fromm(incom_request);
							}
						
					    	});
				    	}
							
						
				</script>
				<div id = 'suggestions1'> 
					You may want to connect to followings
				</div>
				<script type="text/javascript">
					var suggestionObj = {};
					suggestions();
					function sendreqTo(req_id){
						var id_req = req_id;
						console.log(req_id);
						$.ajax({
							url: 'sendreq.php',
							type: 'post',
							data: {
									uuuid : id_req
							},
							success: function(output){
								debugger;
								if (output == 'yes'){
									on_top_bar('yes');
								}
								else if (output != 'yes'){
									on_top_bar('no');
								}
							}
						});
					}
					function create_table_frommm(obj){
						console.log(obj);
						var panell = document.getElementById('suggestions1');
						for (a in obj){
							
							var nammm = document.createElement('div'); 
							nammm.innerHTML = obj[a];
							panell.appendChild(nammm);
							
							var rdivv = document.createElement('div');
							rdivv.setAttribute("class", "btn-group-vertical");
					    		rdivv.setAttribute("data-toggle", "modal");
					    		panell.appendChild(rdivv);
							var button1 = document.createElement('input');
					    		button1.setAttribute("class","btn btn-primary");
						        button1.type = 'button';
						        button1.name = 'options';
						        button1.id = a; 
					    		//button.value = obj[a];
					    		button1.value = 'send REq';
					    		button1.setAttribute("onclick","sendreqTo(this.id,1)");
					    		rdivv.appendChild(button1);
							
						}
						
					
					}
					
					function suggestions(){
						//call suggestions.php to get the suggestions
						$.ajax({
							url:'suggestions.php',
							type:'post',
							datatype: 'json',
							success: function(output){
								//function called
								a = JSON.parse(output);
								for (sth in a){
									b = a[sth];
									for (sthh in b){
										suggestionObj [sthh] = b[sthh];
									}
								}
								create_table_frommm(suggestionObj);
							} 
						});
					}
					
				</script>
				
				
				
				
				
				
				
			
			</div>
			</br>
			
			
			
			
		</div>
		<div id = "top-bar1">
					u are currently offline 
					go back to <a href = 'index.php'>login page</a>
		</div>
	<script type="text/javascript">
        $('#top-bar1').hide();
        function button_click(){
        	window.location.href = "http://kathmandulivinglabs.org/tracker/history.php";
        }
        
        //making ajax call instead of direct using jso
        
        $.ajax({
        	url:'persons.php',
        	success: function(output){
        		//debugger;
        	}
        
        });
        
        
                	

        var sess_name = '<?php echo ($phir);?>';
        
        var jso = <?php echo json_encode($W);?>;
        //console.log(jso);
        if (jso == null){
        	$('#top-bar').hide();
        	$('#top-bar1').show();
        	$('.tab-content').hide();
     
        	
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