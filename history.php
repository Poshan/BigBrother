<html>
<head>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js"></script>
<script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
 

<script src="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js"></script>
<script src="lib\leaflet.polylineDecorator.min.js"></script>
<title>View the history</title>
  <style>
    #map{
	    height:100%;
	    width:100%;
	    
	    outline: 5px inset #ADB0FF;
	    outline-offset: 10px;
	    top: 10px;
	    z-index:1000
    }
    #leftside{
					right:50px;
					top:25px;
					width:120px;
					z-index:1001;
					position: absolute;
			}
    #top-bar1{
    	position: absolute;
    	top: 10px;
    	left:150px;
    	color: #ADB0FF;
    	height:50px;
    	z-index:1001
    }
    
    #go-back{
    	position:absolute;
    	top: 600
    }
    #top-bar {
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
	
	#notification-bar{
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
<div id = "top-bar">
	currently u cannot view anyone
</div>
<div id = 'notification-bar'>
	To see time based history enter the <strong> time </strong>(in hours)here
	<input type="text" id="time" name="myText" style="color:green;"> 
	<button onclick="timedclick()">ShoW</button>
</div>

<script type="text/javascript">
//createEditableSelect(document.forms[0].myText);

$('#notification-bar').hide();

/*var map = new L.Map('map', {
    center: new L.LatLng(28.425,84.435),
    zoom: 7,
    layers: new L.TileLayer('https://a.tiles.mapbox.com/v3/poshan.i65ff4hn/{z}/{x}/{y}.png')
});*/
var map = L.map('map').setView([28.425,84.435], 7);
L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
	attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);
var person_obj1 = {};


//check if person_obj1 is empty
var hasOwnProperty = Object.prototype.hasOwnProperty;
//to do:: also check if the object has got some other information


function checkEmpty(obj) {

    // null and undefined are "empty"
    if (obj == null) return true;

    // Assume if it has a length property with a non-zero value
    // that that property is correct.
    if (obj.length > 0)    return false;
    if (obj.length === 0)  return true;

    // Otherwise, does it have any properties of its own?
    // Note that this doesn't handle
    // toString and valueOf enumeration bugs in IE < 9
    for (var key in obj) {
        if (hasOwnProperty.call(obj, key)) return false;
    }

    return true;
}
var tyme;           // this is the time to be sent to the abcd.php


//directly get the value of time with out the click
//tyme = $('#time').val();


//oncklick submit 
function timedclick(){
	//find out the time entered if nothing entered then the default time is all the life hehheh
	tyme = $('#time').val();
	//('#notification-bar').hide();
	//console.log(tyme);
}



//call the person_list.php to receive the list of persons	
$.ajax({
	url : 'person_list.php',
	datatype:'json',
	type:'post',
	data:{
		index:2 //calling person_list from history_page
	},
	success: function(output){
		//console.log(output);
		
		a = JSON.parse(output); //JSON parsed the return from the person_list.php
		for (any in a){         //creation of the object person_obj1 which contains id and name of persons
			b = a[any];
			for (anyth in b){
				person_obj1[anyth] = b[anyth]
			}
		}
		
		//if there is no result output of the success than call a function which creats a tab on the top which says "sorry no result for the user"
		if (checkEmpty(person_obj1)==false){
			$('#top-bar').hide();
			//$('#notification-bar').show();
			addthepersons(person_obj1);
		}
		
		
		//addthepersons(person_obj1); //call the function which adds the button of each user
		
	}
});


var marker = L.marker();
var marker_layergr = L.layerGroup();
//var polyline = L.polyline();

//function that creates a polyline on the user's time related data and polyline is added on marker_layergr
function createpolyline(l4pll){
	leng = l4pll.length - 1;
	latest_point = l4pll[leng]
	if(poly){console.log('polyline already exists');}
	
	var poly = new L.Polyline(l4pll, {
            color: 'green',
            weight: 7
        });
        //add marker for the point
        latest_point_marker = L.marker(latest_point);
        latest_point_marker.bindPopup("latest position");
	//zoom map to the latest data
	map.setView(latest_point,19);
<<<<<<< HEAD

=======
	
	
	
	  
	 
	 //addMarkers(poly);
	  // var arrowHead = new L.polylineDecorator(poly, {
	  // 	patterns: [{
	  // 		offset: 25,
	  // 		repeat: 50,
	  // 		symbol: L.Symbol.arrowHead({
	  // 			pixelSize: 15,
	  // 			pathOptions: {
	  // 				 fillOpacity: 1,
	  // 				  weight: 0
	  // 			}
	  // 		})
	  // 	}]

	  // });

	//var polyline = L.polyline(l4pll, {color: 'red'}).addTo(map);
>>>>>>> 895882fb75d6cc507e1cfa94d979f03f14dafa08
	marker_layergr.addLayer(poly);
	marker_layergr.addLayer(latest_point_marker);
	
	//polyline.setLatLngs(l4pll);
	//polyline.addTo(map);
	
}

//!@#$%^&*@@#$%^&*(^%$#@#$%^&*()_)(*&#@#$%^&*
//add a function which in particular add markers when data json is sent
function addMarkers(latlng, ath){
	var circle = L.circle(latlng, 2, {
			    color: 'red',
			    fillColor: '#f03',
			    fillOpacity: 0.5
			}).addTo(map);
						  					
		//marker = L.marker(latlng).addTo(map);
		circle.bindPopup(ath);
		//marker_layergr.addLayer(marker);
		marker_layergr.addLayer(circle);
	
}


//leaflet decorationsss
function makeDecor(l4pll){
	 // var decorator = L.polylineDecorator(l4pll, {
  //       patterns: [
  //           // define a pattern of 10px-wide dashes, repeated every 20px on the line 
  //           {offset: 0, repeat: '20px', symbol: new L.Symbol.Dash({pixelSize: 10})}
  //       ]
  //   });

	var pathPattern = L.polylineDecorator(
        [l4pll],
        {
            patterns: [
                { offset: 12, repeat: 25, symbol: L.Symbol.dash({pixelSize: 10, pathOptions: {color: '#f00', weight: 2}}) },
                { offset: 0, repeat: 25, symbol: L.Symbol.dash({pixelSize: 0}) }
            ]
        }
    );

	marker_layergr.addLayer(pathPattern);


}
	


<<<<<<< HEAD
var latlng_length;
=======

>>>>>>> 895882fb75d6cc507e1cfa94d979f03f14dafa08
//var global_id;

// function which receives the time related data of each user on click of the person on the button... id is the person id
function clickfunction(id){
	//alert('clicked');
	//console.log(id);
	//clear the values in the present extend1 layer
	//global_id = id;
	var extend1 = new L.LatLngBounds();
	if ((marker.getLatLng()) || (marker_layergr)){
<<<<<<< HEAD
		//marker_layergr.clearLayers();
=======
		marker_layergr.clearLayers();
>>>>>>> 895882fb75d6cc507e1cfa94d979f03f14dafa08
		
		// if already markers and polylines are present than clear it
	}
// ajax call to abcd.php where the id from the button i.e. user id is sent and the person's time data is received
	
	var interval;
	var tyyme;
	var timed_value;
	if (tyme == undefined){ 
			//no time value entered
			timed_value = 0;
			//tyyme = 0;
	}
	else {
		timed_value = 1;
		tyyme = tyme;
	}
	
	$.ajax({                            
  		url: 'abcd.php',
  		type: 'post',
  		data: {
  			pid : id,
  			timed: timed_value,
  			tiime: tyyme
  		},
  		
  		datatype: 'json',
  		
  		success: function(output){
  			var latlngforpll = [];
  			a = JSON.parse(output);
  			console.log(a);
  			for (anythg in a){
  				b = (a[anythg]);
  				for (ath in b){
  					x = parseFloat(b[ath][0]);
  					y = parseFloat(b[ath][1]);
  					var latlng = L.latLng(x,y);
  					latlngforpll.push(latlng);
  					//extend1.extend(latlng);
  					//function that creates circle markers and bindPopup to them 
  					addMarkers(latlng,ath);
  					
  				}
  				
  				//createpolyline(latlngforpll);	//call the function which would create the polyline over the persons time data
  				 
  			}
  			
  			//for (var i = 0; i < latlngforpll.length; i++) {
			//	debugger;
			//	extend1.extend(latlngforpll[i]);
  			//}
  			
  			//map.fitBounds(extend1);
  			
			createpolyline(latlngforpll);
  		}
  		//alert (dis);
		//call the function which would create the polyline over the persons time data
	//makeDecor(latlngforpll);
	
	});

}
function history_repeater(id){
	global_id = id;
	interval = window.setInterval(clickfunction,10000,global_id);
}
marker_layergr.addTo(map);




//function which creates the buttons on the basis of the persons viewable by a user
function addthepersons(person1){	
	//console.log(person1);
	var panel = document.getElementById("names"); //to put the buttons in the element named "names"
	var rdiv = document.createElement('div');
    	rdiv.setAttribute("class", "btn-group-vertical");
    	rdiv.setAttribute("data-toggle", "modal");
    	panel.appendChild(rdiv);
    	for (a in person1){
    		var button = document.createElement('input');
    		button.setAttribute("class","btn btn-primary")
	        button.type = 'button';
	        button.name = 'options';
	        button.id = a; 
	        button.setAttribute("onclick","history_repeater(this.id)");//on click send the id of the person 
	        button.value = person1[a];//display the person name
	        //var label = document.createElement('label');
        	//label.setAttribute("class", "btn btn-default");
        	//label.innerHTML = person_obj[a];
        	//button.appendChild(label);
        	rdiv.appendChild(button);     
	 }
	 	
}
<<<<<<< HEAD

function krn(cooross){
	//called from the success of the ajax call to abcd.post
	//store the aaaa == coordinate lists' length in a variable
	//make the ajax call again in repetation
	//check for the aaaa and then if the length is 0 for the initial case and
	//if the length is not changed
	//make markers in the latlngs and polylines along them 
	//else if the length is changed then 
	//add a new point to the polyline not reload all
}

=======
>>>>>>> 895882fb75d6cc507e1cfa94d979f03f14dafa08
	
</script>
<div id ="go-back">
  <button type="button" id="loading-example-btn" data-loading-text="Loading..." class="btn btn-primary" onclick= "button_click()">Go back to previous page           
  </button>
</div>
<script type="text/javascript">
	function button_click(){
		window.location.href = "http://kathmandulivinglabs.org/tracker/query_mod.php";
	}

</script>
</body>

</html>