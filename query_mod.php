<html>
<head>
  <title>
   Welcome to the Tracker Web Interface
  </title>
  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://leaflet.github.io/Leaflet.label/leaflet.label.css" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
  <script src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script>
 <script src="http://leaflet.github.io/Leaflet.label/leaflet.label.js"></script>
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
  background-image: -moz-linear-gradient(top, #b0de5c, #82cb00); 
  background-image: -o-linear-gradient(top, #b0de5c, #82cb00); 
  background-image: -webkit-gradient(linear, left top, left bottom, from(#c0de5d), to(#82cb00)); 
  background-image: -webkit-linear-gradient(top, #b0de5c, #82cb00); 
  background-image: linear-gradient(top, #b0de5c, #82cb00);
  border-radius: 5px;

  text-shadow: 0 -1px 1px rgba(0,0,0,0.35);
  }
     #top-bar2 {
      position: absolute;
      top: 100px;
      left: 50px;
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
  background-image: -moz-linear-gradient(top, #b0de5c, #82cb00); 
  background-image: -o-linear-gradient(top, #b0de5c, #82cb00); 
  background-image: -webkit-gradient(linear, left top, left bottom, from(#c0de5d), to(#82cb00)); 
  background-image: -webkit-linear-gradient(top, #b0de5c, #82cb00); 
  background-image: linear-gradient(top, #b0de5c, #82cb00);
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
    #prof{
      border: solid 0.25em rosybrown;
      background-color: tan
      
      
    }
    #name{
      border: solid 0.1em rosybrown;
      background-color: tan
      
    }
    

  </style>
  <script type = 'text/javascript' src = 'name_image.js'></script>
  
</head>     
<body>
<div id = "top-bar">
  <h1>Tracker</h1>
  
    <div id="container">
  <button type="button" id="loading-example-btn" data-loading-text="Loading..." class="btn btn-primary" onclick= "button_click()">View Tracks            
  </button>
            <button data-toggle="dropdown" class="btn btn-info dropdown-toggle">Settings <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="http://kathmandulivinglabs.org/tracker/logout.php">Logout</a></li>        
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
        <div id ="map">
        </div>
        <script type = "text/javascript" src = "maps.js"></script>
      </div>
      
     
      
      <div class="tab-pane" id="profile">
      <div id= "name" align="center">
      
      <!--instead make another ajax call to find out name-->
      <h1 id = 'user_name'></h1>
  </div>
        <div id ="prof">These are your viewable persons </br> </div>
        <script>

           var person_obj1 = {};
           function create_table_from(obj){
           
              //var prof1 = dddiv;
                var panel = document.getElementById('prof');
                
                
                //var input1 = document.createElement("input");
    //input1.name = "post";
                //panel.appendChild(input1);
              
              //var panel = document.getElementById(prof1);
              var rdiv = document.createElement('div');
              rdiv.setAttribute("class", "btn-group");
              rdiv.setAttribute("data-toggle", "modal");
              
              panel.appendChild(rdiv);
              //input1.appendChild(rdiv);
              
              for (a in obj){
                  var button = document.createElement('input');
                  button.setAttribute("class","btn btn-primary")
                  button.type = 'button';
                  button.name = 'options';
                  button.id = a; 
                  button.value = obj[a];
                  rdiv.appendChild(button);
              }
            }
         
            
            $.ajax({
            url : 'person_list.php',
            type : 'post',
            data: {
                index:1
            },
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
        
        <div id = 'requests'>These are the requests incomming</div>
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
            
            else if (what == 'al'){
              var content = 'Already a connection';
            }
            else if (what == 're'){
              var content = 'Request already sent';
            }
            var ddiv = document.getElementById('top-bar1');
            ddiv.innerHTML = content;
            
            $('#top-bar1').show();
            $('#top-bar1').delay(1000).fadeOut();
            //$('#accept_reject').hide();
            
            //name of the id required
          }
          function clickfunction(id, acn, div_name){
            //id is the id of request "pathaune manchhey"
            //if this is the acceptance buttons' click function make actn=0 and send to the same php
            actn = acn;
            node = document.getElementById(div_name);
            


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
              while (node.firstChild){
                  node.removeChild(node.firstChild);
                }
                if (actn == 1){
                node.innerHTML = 'Accepted';
                
                
                }
                else if (actn == 2){
                  node.innerHTML = 'Rejected';
              
                }
             
             if (output == 'yes'){
                    
                  on_top_bar('yes');
               
                    
             }
                  
              else if (output == 'no'){
                on_top_bar('no');
                    
               }
   
                  //requests();
         }
                
            
            });
            
            
          }
          
          function create_table_fromm(obj){
                
                //var prof1 = dddiv;
                var panel = document.getElementById('requests');
                //var panel = document.getElementById(prof1);
                            
                for (a in obj){
                  
                    var named = document.createElement('div');
                    named.innerHTML = obj[a];
                    panel.appendChild(named);
                    var rdiv = document.createElement('div');
                    rdiv.setAttribute("class", "btn-group");
                    rdiv.setAttribute("data-toggle", "modal");
                    rdiv.setAttribute("id", obj[a]);
                    panel.appendChild(rdiv);
  
                    var button = document.createElement('input');
                    button.setAttribute("class","btn btn-primary");
                    button.type = 'button';
                    button.name = 'options';
                    button.id = a; 
                    div_name = obj[a];
                    button.value = 'approve';
                    button.setAttribute("onclick","clickfunction(this.id,1,div_name)");
                    
                    rdiv.appendChild(button);
                    
                    //reject button
                    var button_rej = document.createElement('input');
                    button_rej.setAttribute("class", "btn btn-primary");
                    button_rej.type = 'button';
                    button_rej.name = 'options';
                    button_rej.id = a;
                    button_rej.value = 'Decline';
                    button_rej.setAttribute("onclick","clickfunction(this.id,2,div_name)");
                                   
                    rdiv.appendChild(button_rej);
                 }
            
            };
          
          function requests(){
              $.ajax({
                url:'requests.php',
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
                if (output == 'yes'){
                  on_top_bar('yes');
                }
                else if (output == 're'){
                  on_top_bar('re');
                }
                else if (output == 'al'){
                  on_top_bar('al');
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
          selected = {};
          $(function(){
          $("#search").autocomplete({
            source:"search.php",
            minLength:2,
            select:function(event,ui){
              console.log(ui);
              document.getElementById("search-button").disabled = false;
              selected = ui;
            }
            
              });
      });
      function connect(){
        //debugger;
        //console.log(selecte)
        idz = selected.item['person_id'];
        //selected
        sendreqTo(idz);
        //notify the user at the request sent
        
      }
        </script>  
        </br>
  <div>
        <label for="search">Search:</label>
        <input id="search" />
        <button id = "search-button" disabled onclick = 'connect()'>Connect</button>
  </div>
      </div>
      </br>  
    </div>
    <div id = "top-bar1">
          u are currently offline 
          go back to <a href = 'index.php'>login page</a>
    </div>
  <script type="text/javascript">
        var coords = {};
        var latlng = [];
        var image_link = '';
        $('#top-bar1').hide();
        
        /*
         call the history page when clicked on the view tracks button
        */
        
        function button_click(){
          window.location.href = "http://kathmandulivinglabs.org/tracker/new_history.php";
        }
        function check(data){
          for(sth in data){
                debugger;
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
        
        function display(coords){
          /*
          console.log('display function');
          console.log(data);
          debugger;
          for(sth in data){
                //debugger;
                
                check if the incomming result is only of one user
                
                sth_in = data[sth];
                for(any in sth_in){
                    name = any;
                    ins = sth_in[any];
                    // coords.push(ins);
                    if (sth_in[any][0] == 0 && sth_in[any][1] == 0){
                      first_map();
                    }
                    coords[name] = ins; 
                                  
                }
          }
          console.log(coords);
          */
          //actual_display(coords);
          //send coords to actual display function
          //check if coords is empty and length is one
          //maynot have his/her location still can view other person
          
          if(!(jQuery.isEmptyObject(coords))){
          
                var extend1 = new L.LatLngBounds(); //extend of the map
              for (any in coords){
                  x = coords[any]; 
                  acc = x[2]; //accuracy
                  img_lnk = x[3]; //link of image of the person
              
              
              /*
                pratik bro's help required for designing the icons as persons
                currently not in use though
                make icons for the persons
                if no image is available then make use of a default image
                else use the image of the person
              */
              
              
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
            
            
            /*
    this portion was used for the display of the user's own location currently the user's location
    in the data.php is removed so this code is not used the user's own location is also shown
    normally as others             
            */
            /*
              var customIcon = L.icon({
          iconUrl: 'images/download.jpg', 
          iconSize:     [25, 25]
              });
            
              if (any == "YOU"){
                var marker = L.marker(x,{
                  icon: customIcon
                }); 
              }
              else{
                //automatically takes the first two elements in this case it is lat and lon
                var marker = L.marker(x); 
              }
    */
              var marker = L.marker(x);                  
              
              /*
                 instead of making the image markers the image in popup
                 check here to show the user's own location differently
              */
              if (any == 'user'){
                popupContent = user_name;
                popupContent += '</br> <img src = ' + img_lnk + ' height = ' + 42 + ' width = ' + 42 + '>';
              }
              else{
                popupContent = any;  //name of the person          
                popupContent += '</br> <img src = ' + img_lnk + ' height = ' + 42 + ' width = ' + 42 + '>';                       //image url of the person
              }
              marker.bindPopup(popupContent).openPopup().addTo(map);


       /*
        for defining the extend of the map
       */             
              var x1,y1;
              for (p in x){
                 x1 = x[0];
                 y1 = x[1];
                 var ll = L.latLng(x1,y1);
                 latlng.push(ll);
              }
            } 
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
        
        $.ajax({
          url:'data.php',
          type: 'post',
          datatype: 'json',
          success:function (output){
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
              check(jso);
            //}
          }

        });
        
        
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