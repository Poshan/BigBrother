<html>
<head>
  <title>
   Welcome to the Tracker Web Interface
  </title>
  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://leaflet.github.io/Leaflet.label/leaflet.label.css" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css"/>
  <link rel="stylesheet" href="css/query.css"/>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
  <script src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script>
  <script src="http://leaflet.github.io/Leaflet.label/leaflet.label.js"></script>
  <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  <script src = "js/profile-tab.js"></script>
  <script>
    function hidemarkers(id){
      if (markermap){
        //check if markerlayergr exists
        if (markerlayergr){
          for (any in markermap){
            //checking for the match of the id
            if (id == any){
              //if the marker exists than 
              markerlayergr.removeLayer(markermap[any]);
            }
          }
        }          
      }
    }
    function showmarkers(id){
      if (markermap){
        //check if markerlayergr exists
        if (markerlayergr){
          for (any in markermap){
            //checking for the match of the id
            if (id == any){
              //if the marker exists than 
              markerlayergr.addLayer(markermap[any]);
            }
          }
        }          
      }
    }
    //similarly make a showmarker function which adds the marker to the markerlayergr
    function onload1() {
      //also make the profile button visible
      // debugger;
      console.log('onload1');
      $("a#showHideButton").click(function (event) {
        //find out the id of person being clicked
          id = event.target.title;
        //changing the css
        $(this).toggleClass("down");

        //changing the display
          var html = $(this).html();
          if (html == "HIDE"){
              $(this).html('SHOW');
              hidemarkers(id);
          }
          else if (html == "SHOW"){
              $(this).html("HIDE");
              showmarkers(id);
          }
      });
}

  </script>

</head>     
<body onload = "onload1()"> 
  <div id= "container">
  <div id="top-one">
    <div id = "title">
      <h1>Tracker</h1>
    </div>
    <div id = "settings-image-tracks">
      <div id = "user-name">
        <h1 id = "user-name-h1"></h1>
      </div>
      <div id = "view-tracks-button">
        <button type="button" id="view-tracks" class="btn btn-primary" onclick= "button_click()">
          View Tracks            
          </button>
        </div>
        
        <div id = "settings-button-logout">
          <div id = "settings-logout-button">
            <button data-toggle="dropdown" class="btn btn-info dropdown-toggle">Settings <span class="caret"></span></button>
            <ul class="dropdown-menu">
                    <li><a href="http://kathmandulivinglabs.org/tracker/logout.php">Logout</a></li>        
                </ul>
          </div>
      </div>  
    </div>
  </div>
  <div id = "open-profile-container">
    <a href="#" onclick = "openTheContainer()">Profile</a>
  </div>
  
  <div id="profile-container">
    <div id = "profile-content">
      <div id="personal-info">
        <!--<div id ="username">
          <h1>
            username
          </h1>
        </div>-->
        <div id= "image">
          <img src = "http://kathmandulivinglabs.org/tracker/uploaded_files/1407303881-WIN_20140520_074608.JPG"/>
        </div>
        <div id = "search">
              <label for="search">Search:</label>
              <input id="search" />
              <button id = "search-button" disabled onclick = 'connect()'>Connect</button>
        </div>
      </div>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#viewing-pane" data-toggle="tab"><span class="glyphicon glyphicon-user"></span>Viewing</a></li>
            <li><a href="#viewes-pane" data-toggle="tab"><span class="glyphicon glyphicon-user"></span>Viewes</a></li>
            <li><a href="#lists-pane" data-toggle="tab"><span class="glyphicon glyphicon-list"></span> Lists</a></li>
        </ul>
        <div class = "tab-content">
          <div class="tab-pane active" id="viewing-pane">

          </div>
          <div class="tab-pane" id="viewes-pane">
          </div>
          <div class="tab-pane" id="lists-pane">
          </div>
        </div>
    </div>
    <div id = "close-icon">
      <a href="#" onclick = "hideProfileTab()">close</a>
    </div>
  </div>
  <div id= "map"></div>    
</div>
  <script type = 'text/javascript' src = 'js/name_image.js'></script>
  <script src = "js/maps.js"></script>
  <script src = "js/gui-interactivity.js"></script>
  <script src = "js/profile.js"></script>
  <script type="text/javascript">
        var coords = {};
        var image_link = '';
        var markerlayergr = L.layerGroup();
        //$('#top-bar1').hide();
        //$('#top-bar3').hide();
        // console.log(user_name);
       




        /*
         call the history page when clicked on the view tracks button
        */
        
        function button_click(){
          window.location.href = "http://kathmandulivinglabs.org/tracker/new_history.php";
        }
        function check(data){
          for(sth in data){
                //debugger;
                /*
                check if the incomming result is only of one user
                */
                sth_in = data[sth];
                for(any in sth_in){
                    name = any;
                    ins = sth_in[any];
                    // coords.push(ins);
                    
                    
                    //if (sth_in[any][0] == 0 && sth_in[any][1] == 0 && data.length == 1){
                    
                    
                    if (data.length == 1 && sth_in[any][0] == 0 && sth_in[any][1] == 0){
                      //console.log('breathe breathe in the air');
                      first_map();
                    }
                    else{
                      coords[name] = ins; 
                    }               
                }
              }
          display(coords);
        }
        function locationnotavailable(b){
          var contents = '';
          for (var i = b.length - 1; i >= 0; i--) {
            if (b[i] == 'user'){
              contents += 'You dont have coordinates yet';
              contents += 'Please use <a>client app</a>';
            contents += 'to locate yourself';
            }
            else{
              contents += b[i];
              contents += ', ';
              contents += 'also havenot been located yet'
            }
            
          };
          
          /*
          var ddivv = document.getElementById('top-bar3');
          ddivv.innerHTML = contents;
          $('#top-bar3').show();
          $('#top-bar3').delay(10000).fadeOut();
          */
        }
        function nullchecker(a){
          //create an array of the persons whose locations are not known and display likewise
          
          console.log('checking if the x is null');

          if (a[0] == 0 && a[1] == 0 && a[2] == 0){
            return 1;           
          }
          else{
            return 0;
          }
        }

        function rounded(a){
          //if a is in decimal round it to nearest hour
          return (Math.round(a));
        }
        
        function display(coords){
          // console.log('at test one');
          markermap = {};
          /*if (circle || marker){
            // circle nd marker 
            console.log('circle and markers already there need now clear');
          }
          if (map.hasLayer(circle) || map.hasLayer(marker)){
            map.removeLayer(circle);
            map.removeLayer(marker);
          }
          */
          if(!(jQuery.isEmptyObject(coords))){
            var no_location = [];
            var latlng = [];
            var extend1 = new L.LatLngBounds(); //extend of the map
            for (any in coords){
                      // debugger;
                      x = coords[any];
                      var id = x[0];
                      var x_co = x[1];
                      var y_co = x[2];
                      acc = x[3]; //accuracy
                      img_lnk = x[4]; //link of image of the person
                      time_string = x[5]; //the time 
                      var reggie = /(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/;
                      var date_array = reggie.exec(time_string);
                      date_object = new Date(
                        (+date_array[1]),
                        (+date_array[2])-1, 
                        (+date_array[3]),
                        (+date_array[4]),
                        (+date_array[5]),
                        (+date_array[6]) 
                      );
                     
                      var utc_date = date_object.getTime()/1000;
                      // console.log(date_object);
                      // console.log(utc_date);
                      //current timestamp
                      var date_now = new Date();
                      var utc_now = date_now.getTime()/1000;

                      //for the difference 
                      var diff_in_seconds = 0;
                      var diff_in_minutes = 0;
                      var diff_in_hrs = 0;
                      var time_diff = [];

                      if (utc_date){
                        if (utc_date > 0){
                          diff_in_seconds = utc_now - utc_date;
                          diff_in_minutes = diff_in_seconds/60;
                          diff_in_hrs = diff_in_minutes/60;
                          if (diff_in_hrs < 1){
                            time_diff['min'] = diff_in_minutes;
                          }
                          else if (diff_in_hrs > 1){
                            time_diff['hrs'] = rounded(diff_in_hrs); //rounded off to nearest hours
                          }
                        }
                      }
                    
                /*
                  pratik bro's help required for designing the icons as persons
                  currently not in use though
                  make icons for the persons
                  if 
                   is available then make use of a default image
                  else use the image of the person
                */
                    
                    if (nullchecker(x) == 0){
                      if (!img_lnk){ 
                          var myIcon = L.icon({
                              iconUrl: 'images/image.jpg',
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
                      
                      //divicon
                    var my_divicon = L.divIcon({
                        className: 'arrow_box'
                    });
                      
                      var coord = L.latLng(x_co,y_co);
                      circle = L.circle(coord, acc, {
                          color: 'red',
                    	  fillColor: '#f03',
                          fillOpacity: 0.5
                      });


                      // markerlayergr.addLayer(circle);
                      var marker = L.marker(coord,{title:any});
                      //adding to the marker map
                      markermap[id] = marker;

                      // marker = L.marker(x,{icon:my_divicon});  
                      var link = '<img src = ' + img_lnk + ' height = ' + 42 + ' width = ' + 42 + '>';
                      $('.arrow_box').html(link);                
                /*
                   instead of making the image markers the image in popup
                   check here to show the user's own location differently
                */

                      if (any == 'user'){
                        popupContent = user_name;
                        popupContent += '</br> <img src = ' + img_lnk + ' height = ' + 42 + ' width = ' + 42 + '>';
                        if (time_diff['min']){
                          popupContent += '</br>' + time_diff['min'] + ' mins ago';
                        }
                        else if (time_diff['hrs']){
                          popupContent += '</br>' + time_diff['hrs'] + ' hours ago';
                        }
                      }
                      else{
                        popupContent = any;  //name of the person          
                        popupContent += '</br> <img src = ' + img_lnk + ' height = ' + 42 + ' width = ' + 42 + '>'; 
                        popupContent += '</br>' + time_diff + 'ago';                       
                      }
                      
                      marker.bindPopup(popupContent).openPopup();
                      markerlayergr.addLayer(marker);
                      markerlayergr.addTo(map);
         /*         
          for defining the extend of the map
         */             
                      var x1,y1;
                      for (p in x){
                        x1 = x[1];
                        y1 = x[2];
                        var ll = L.latLng(x1,y1);
                        latlng.push(ll);
                      }
                  }
                  else{
                    // console.log( any + 'dont have coords');
                    no_location.push(any);
                  } 

            }
            locationnotavailable(no_location);
            for (var i = 0; i < latlng.length; i++) {
                  //L.marker(latlng[i]).addTo(map);
                  extend1.extend(latlng[i]);
             };
                map.fitBounds(extend1);
          }
        }
        function notify(){
              var ddiv = document.getElementById('top-bar2');
              var content = 'You have not yet submitted any location, please submit the ';
              content += 'location using our mobile app from ';
              content+= '<a> Google Play Store. </a> ';
              content+= 'In the meantime you can try searching and adding people you know, who are on tracker.';
              ddiv.innerHTML = content;
              $('#top-bar2').show();
          
        }
        function first_map(){
          //console.log('mapfirst');
          //var marker1 = L.marker([27.6972,85.3380]);
          //marker1.addTo(map);
          map.setView([27.6972,85.3380],16);
          notify();
        }
        
        /*
          call the data.php for the coordinates, accuracy, image_link of the persons visible by user
        */



        var check_object = {};
        function  check_for_change_in_coordinates(a){
          //need to write better algorithm than this for checking the change in the coordinates
          if ( JSON.stringify(a) === JSON.stringify(check_object) ){
            //no change in objects
            return false;
          }
          else {
            check_object = a;
            return true;
          }
        }
	      
        function checker(){
          // console.log('inside the checker');
          $.ajax({
            url:'data.php',
            type: 'post',
            datatype: 'json',
            success:function (output){
              // debugger;
              /*
              if (output == 'first'){
                //you dont have any location 
                //this is default location for everyone
                //downlod client app to locate yourself
                //search others and connect to see their location
                first_map();
              }
              
              else{*/
                //console.log('inside success function');
                jso = JSON.parse(output);
                //check for the change in the length of the jso
                //bad idea bcoz there wont be change in the length of the jso file.....
                //so check the coordinates' change 
                //debugger;
                
                // check_for_change_in_coordinates(jso);
                /*for (var i = jso.length - 1; i >= 0; i--) {
                  var checker_array = [];
                  checker_array.push(check_for_change_in_coordinates(jso[i]));
                };
                


                if (jso.length > length_check){             	
                	check(jso);
                	// length_check = jso.length;	
                }*/
                if (check_for_change_in_coordinates(jso) == true){
                  if (markerlayergr){
                    markerlayergr.clearLayers();
                  }
                  check(jso);
                }
                
              //}
            }

          });
        }
        var logged = [];
        function logged1(){
          if (logged.length == 0){
            logged.push('firstload');
            checker();
            // console.log('at the point of test');
            logged1();
          }
          else if (logged.length > 0){
            // console.log('at the test point 2');

            interval = window.setInterval(checker,10000);
            logged.push('nonfirstload');
          }
        }
        logged1();

        
                
        //var user_name = '<?php echo $user_name;?>';
        

        //get  image location of the persons
        //var image_link  = '<?php echo ($img_link);?>';
       
        
        
        
         
         /*
         
         for (sth in user_location){
            sth_in = user_location[sth]; ;
            for(any in sth_in){
                name = 'YOU';
                ins = sth_in[any];
                // coords.push(ins);
                coords[name] = ins;
               
            }
          
         }
         
         */


      
</script>
</body>
</html>