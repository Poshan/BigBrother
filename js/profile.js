
function show_list(a, div_name){
    // console.log(size);
    // debugger;
    // for (i=0; i<size; i++){
    for (any in a){
      $('<div/>', {
            id: 'foo',
            html: '<div class="container1"><div class="name" id ="names">' + a[any] + '</div><a id="showHideButton" title='+ any +'>HIDE</a><a class="delete">Delete</a></div>'
        }).appendTo('#'+div_name); 
    }
}
       

// console.log('this is the end');

//for the viewing tab
person_obj1 = {};
$.ajax({
            url : 'person_list.php',
            type : 'post',
            data: {
                index:1
            },
            datatype:'json',
            success: function(output){
                a = JSON.parse(output); 
                    for (any in a){ 
                	    b = a[any];
                    	for (anyth in b){
                        	person_obj1[anyth] = b[anyth]
                    	}
                    }
                    show_list(person_obj1,'viewing-pane');
              }        
}); 

$.ajax({
            url : 'viewes.php',
            type : 'post',
            data: {
                index:1
            },
            datatype:'json',
            success: function(output){
                a = JSON.parse(output); 
                    for (any in a){ 
                        b = a[any];
                        for (anyth in b){
                            person_obj1[anyth] = b[anyth]
                        }
                    }
                    // show_list(person_obj1,'viewes-pane');
              }        
}); 

