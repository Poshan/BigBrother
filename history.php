<html>
<head>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js"></script>
<script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<script src="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js"></script>
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
					width:100px;
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
<script type="text/javascript">
var map = new L.Map('map', {
    center: new L.LatLng(28.425,84.435),
    zoom: 7,
    layers: new L.TileLayer('https://a.tiles.mapbox.com/v3/poshan.hc1eo89i/{z}/{x}/{y}.png')
});
var person_obj1 = {};


//check if person_obj1 is empty
var hasOwnProperty = Object.prototype.hasOwnProperty;
//also check if the object has got some other information


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





//call the person_list.php to receive the list of persons	
$.ajax({
	url : 'person_list.php',
	datatype:'json',
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
			addthepersons(person_obj1);
		}
		
		//addthepersons(person_obj1); //call the function which adds the button of each user
		
	}
});

latlngforpll = [];
var marker = L.marker();
var marker_layergr = L.layerGroup();
//var polyline = L.polyline();

//function that creates a polyline on the user's time related data and polyline is added on marker_layergr
function createpolyline(l4pll){
	
	var polyline = L.polyline(l4pll, {color: 'red'}).addTo(map);
	marker_layergr.addLayer(polyline);
	//polyline.setLatLngs(l4pll);
	//polyline.addTo(map);
	
}


// function which receives the time related data of each user on click of the person on the button... id is the person id
function clickfunction(id){
	//alert('clicked');
	//console.log(id);
	//clear the values in the present extend1 layer
	var extend1 = new L.LatLngBounds();
	if (marker.getLatLng()){
		marker_layergr.clearLayers();// if already markers and polylines are present than clear it
	}
// ajax call to abcd.php where the id from the button i.e. user id is sent and the person's time data is received
	$.ajax({                            
  		url: 'abcd.php',
  		type: 'post',
  		data: {pid : id,},
  		datatype: 'json',
  		success: function(output){
  			debugger;
  			
  			a = JSON.parse(output);
  			  		
  			for (anythg in a){
  				b = (a[anythg]);
  				for (ath in b){
  					
  					x = parseInt(b[ath][0]);
  					y = parseInt(b[ath][1]);
  					var latlng = L.latLng(x,y);
  					latlngforpll.push(latlng);
  					extend1.extend(latlng);
  					marker = L.marker(latlng).addTo(map);
  					marker.bindPopup(ath);
  					marker_layergr.addLayer(marker);
  					
  				}
  				createpolyline(latlngforpll);	//call the function which would create the polyline over the persons time data
  			}
  			//for (var i = 0; i < latlngforpll.length; i++) {
			//	debugger;
			//	extend1.extend(latlngforpll[i]);
  			//}
  			map.fitBounds(extend1);
  			
  		}
  		//alert (dis);
	});
}
marker_layergr.addTo(map);

//photos


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
	        button.setAttribute("onclick","clickfunction(this.id)");//on click send the id of the person 
	        button.value = person1[a];//display the person name
	        //var label = document.createElement('label');
        	//label.setAttribute("class", "btn btn-default");
        	//label.innerHTML = person_obj[a];
        	//button.appendChild(label);
        	rdiv.appendChild(button);     
	 }
	 	
}
	



</script>
	
</body>

</html>