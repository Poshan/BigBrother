<?php
  session_start();
  if (isset($_SESSION['namm']) && isset($_SESSION['idd'])){
    
    $user_name = $_SESSION['namm'];//name is stored in session not to loose in reload
    include "connection.php";
        $sql1 = "SELECT * FROM `user` WHERE `name`='" . $_SESSION['namm'] . "'";
        $result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
        if (!$result1){
          echo 'no result';
        }
        else{
          while ($roow = mysqli_fetch_array($result1)){
            $img_link = $roow[3];//find the image of the user to show on the first view()

            /*
              sql2 is the persons list who are on the viewable 
            */

           
            $sql2 = "SELECT * FROM `relatn` WHERE `uid`='" . $_SESSION['idd'] . "' AND `viewable` = 1"; 
                  $result2 = mysqli_query($con, $sql2) or die(mysqli_error($con)); 
                  if (!$result2){
                      echo 'noone to view yet';
                    }
                    else{
                      while ($rows = mysqli_fetch_array($result2)){
                        /*
                          the ids of persons who are visible is in rows[1]
                        */

                        $sql = "SELECT * FROM `person`WHERE `person_id` = '" . $rows[1] . "'";
                          $person_result = mysqli_query($con,$sql);
                          while($row1 = mysqli_fetch_array($person_result)){
                              //the current location,accuracy of the gps and the image link
                              $X = $row1[2]; 
                              $Y = $row1[3];
                              $acc = $row1[4];
                              $imag_link = $row1[5]; 
                              $timee = $row1[6];
                             
                             
                             
                              if ($row1[1] == $user_name){
                                $W[] = array('user' => array($rows[1],$X,$Y,$acc,$imag_link,$timee));
                                
                              }
                              else{
                                $W[] = array($row1[1] => array($rows[1],$X,$Y,$acc,$imag_link,$timee));
                                
                              }       
                          }       
                      }
                     
                    }
          }
          echo (json_encode($W));
        //}
       }
  }
else{
  echo 'not logged in';
}
?>