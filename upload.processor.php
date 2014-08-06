<?php  
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']); 
//$uploadsDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . 'uploaded_files/'; 
$uploadsDirectory = 'uploaded_files/'; 
$uploadForm = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'index.php'; 
$uploadSuccess = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.success.php'; 
$fieldname = 'file'; 


// possible PHP upload errors 
$errors = array(1 => 'php.ini max file size exceeded', 
                2 => 'html form max file size exceeded', 
                3 => 'file upload was only partial', 
                4 => 'no file was attached'); 

// check the upload form was actually submitted else print the form 
isset($_POST['submit']) 
    or error('the upload form is neaded', $uploadForm); 

// check for PHP's built-in uploading errors 
($_FILES[$fieldname]['error'] == 0) 
    or error($errors[$_FILES[$fieldname]['error']], $uploadForm); 
     
// check that the file we are working on really was the subject of an HTTP upload 
@is_uploaded_file($_FILES[$fieldname]['tmp_name']) 
    or error('not an HTTP upload', $uploadForm); 
     
// validation... since this is an image upload script we should run a check   
// to make sure the uploaded file is in fact an image. Here is a simple check: 
// getimagesize() returns false if the file tested is not an image. 
@getimagesize($_FILES[$fieldname]['tmp_name']) 
    or error('only image uploads are allowed', $uploadForm); 
     
// make a unique filename for the uploaded file and check it is not already 
// taken... if it is already taken keep trying until we find a vacant one 
// sample filename: 1140732936-filename.jpg 
$now = time(); 
while(file_exists($uploadFilename = $uploadsDirectory.$now.'-'.$_FILES[$fieldname]['name'])) 
{ 
    $now++; 
} 


// now let's move the file to its final location and allocate the new filename to it 
@move_uploaded_file($_FILES[$fieldname]['tmp_name'], $uploadFilename) 
    or error('receiving directory insuffiecient permission', $uploadForm); 



// The following function is an error handler which is used 
// to output an HTML error page if the file upload fails 
function error($error, $location, $seconds = 5) 
{ 
    echo $error;
    // header("Refresh: $seconds; URL="$location""); 
    /*echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"'."n". 
    '"http://www.w3.org/TR/html4/strict.dtd">'."nn". 
    '<html lang="en">'."n". 
    '    <head>'."n". 
    '        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">'."nn". 
    '        <link rel="stylesheet" type="text/css" href="stylesheet.css">'."nn". 
    '    <title>Upload error</title>'."nn". 
    '    </head>'."nn". 
    '    <body>'."nn". 
    '    <div id="Upload">'."nn". 
    '        <h1>Upload failure</h1>'."nn". 
    '        <p>An error has occurred: '."nn". 
    '        <span class="red">' . $error . '...</span>'."nn". 
    '         The upload form is reloading</p>'."nn". 
    '     </div>'."nn". 
    '</html>'; */
    exit; 
} // end error handler 

//$uploadFilename

include "connection.php";

    if ((!empty($_POST['fname']))&&(!empty($_POST['password']))){
        if ($_FILES[$fieldname]['error'] == 0)
        $name = $_POST["fname"];
        $phone = $_POST["phone"];
        $pass = $_POST["password"];

        
        function cryptPass ($input,$rounds=9){
            $salt = "";
            $saltChars = array_merge(range('A','Z'),range('a','z'),range(0,9));
            for ($i = 0; $i < 22; $i++){
                $salt .=$saltchars[array_rand($saltChars)];
            }
            return crypt ($input, sprintf('$2y$%02d$', $rounds) . $salt);
        }
        $hashedPassword = cryptPass($pass);
        $md5pass = md5($pass);
        //location from ip
        $location = file_get_contents('http://freegeoip.net/json/'.$_SERVER['REMOTE_ADDR']);
        $locatnDecoded = json_decode($location);
        $latitude = ($locatnDecoded->{'latitude'});
        $longitude = ($locatnDecoded->{'longitude'});
    
        $latitude1 = 27.6972;
        $longitude1 = 85.3380;
        
        
        $sql5 = "SELECT * FROM `user` WHERE name ='" . $name . "'";
        $result5 = mysqli_query($con,$sql5) or die (mysqli_error($con));
        $answer = mysqli_fetch_array($result5);
        if ($answer){
            echo 'username already exists ';
            echo '</br>';
            echo 'go back to <a href = "http://kathmandulivinglabs.org/tracker/"> login page </a> ';
            
        }
        else{
            //find out the highest value in the user table 
            $sql1 = "SELECT MAX( id ) AS max FROM `user`";
            $result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
            $roow = mysqli_fetch_array($result1);
            $max_id = (int)$roow['max'];
            $id = $max_id + 1;
            
            //find out the highest value in the person table
            $sql2 = "SELECT MAX( person_id ) AS max FROM `person`";
            $result2 = mysqli_query($con,$sql2) or die(mysqli_error($con));
            $rooow = mysqli_fetch_array($result2);
            $max_iid = (int)$rooow['max'];
            $pid = $max_iid + 1;
            
            
        
            //work on photo upload
                //echo $id;
                
                /*
                $sql = 
                    "INSERT INTO `user` ".
                        "(id,name,password) ".
                        "VALUES ".
                        "('$id','$name','$hashedPassword')";
                    */
                    
                    $sql = 
                    "INSERT INTO `user` ".
                        "(id,name,password,image) ".
                        "VALUES ".
                        "('$id','$name','$md5pass','$uploadFilename')";
                mysqli_query($con,$sql) or die(mysqli_error($con));
                
                
            //TODOS make same ID of person and user
                
            //also inserting to the person table with the default X,Y, accuracy value and same image link
            //in this case the default location are choosen (26,84) and accuracy value = 5,, but can be taken input 
            //from the user
            
                /*
                
                $sql3 = "INSERT INTO `person` ".
                        "(person_id,name,X_coord,Y_coord,accuracy) ".
                        "VALUES ".
                        "('$pid','$name','$latitude1','$longitude1',5)";
                        
                        
                    */
                $sql3 = "INSERT INTO `person` ".
                        "(person_id,name,image_link) ".
                        "VALUES ".
                        "('$pid','$name','$uploadFilename')";
                mysqli_query($con,$sql3) or die(mysqli_error($con));
            
            
            //if want to make visible to himself then insert the person id to the relatn table
                $sql4 = "INSERT INTO `relatn` ".
                        "(uid,person_id,viewable,trackable,date) ".
                        "VALUES ".
                        "('$id','$id',1,1,NOW())";
                mysqli_query($con,$sql4) or die(mysqli_error($con));
        
            
            //setting session variables
            session_start();
            $_SESSION['namm'] = $name;
            $_SESSION['idd'] = $id;
            
            /*
            for indicating first load
            
            
            $_SESSION['first'] = 1;
            
            */
            
            header('Location: query_mod.php');
        }   
    }
    else{
        header('Location: index.php');
    
    }
?>