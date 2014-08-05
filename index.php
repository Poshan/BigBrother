<?php
	session_start();
	if (isset($_SESSION['namm']) || isset($_SESSION['idd'])){
		header('Location:query_mod.php');
	}
	$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']); 

	// make a note of the location of the upload handler script 
	$uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.processor.php'; 

	// set a max file size for the html upload form 	
$max_file_size = 100000; // size in bytes 
?>

<html>
<head>
	<title>Tracking</title>
	<link rel="stylesheet" href="/tracker/css/formcss.css">
</head>
<body background = "/tracker/images/image.jpg">
<?php 
	session_start(); 
	echo $_SESSION['error'];
?>

<h1>Login </h1>
<form action="loginto.php" method="post">
	User Name: <input type="text" name="name" pattern="[a-zA-Z0-9]+" required="required" />
	Password: <input type="password" name="pwd" required="required" />
	<input type="submit" name = "Login">
</form>

<h1>
	Register
</h1>
<div id ="formContent">
	<div id ="form">
		<form action="insertion.php" method="post">
			<div class="row">
			<div class="label"> User Name*</div><!--end .label-->	
			<div class="input">
			<input type="text" id="fname" class="detail" name="fname" value="" pattern="[a-zA-Z0-9]+" required = "required" />
			</div><!--end of .input-->
			<div class="context">e.g. Ram, letters and numbers only allowed </div><!--end of .context-->
			</div><!--end of .row-->		

			<div class="row">
			<div class="label">Phone number</div><!--end .label-->	
			<div class="input">
			<input type="tel" id="phone" pattern="[0-9]*" class="detail" name="phone" value=""/>
			</div><!--end of .input-->
			<div class="context">e.g. 9841123456	</div><!--end of .context-->
			</div><!--end of .row-->	


			<div class="row">
			<div class="label">Password*</div><!--end .label-->	
			<div class="input">
			<input type="password" id="password" class="detail" name="password" value="" required = "required"/>
			</div><!--end of .input-->
			<div class="context">could be combination of numbers and letters</div><!--end of .context-->
			</div><!--end of .row-->	

			<div class="submit">
				<input type="submit" id="submit" name="submit" value="submit"/>
			</div><!--end of .submit-->
		</form><!--end of the form-->
		* are compulsary fields</br>
		<?php echo $error_messege;?>

		<form id="Upload" action="<?php echo $uploadHandler ?>" enctype="multipart/form-data" method="post"> 
     
        <h1> 
            Upload form 
        </h1> 
         
        <p> 
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size ?>"> 
        </p> 
         
        <p> 
            <label for="file">File to upload:</label> 
            <input id="file" type="file" name="file"> 
        </p> 
                 
        <p> 
            <label for="submit">Press to...</label> 
            <input id="submit" type="submit" name="submit" value="Upload me!"> 
        </p> 
     
    </form> 
	</div><!--end #form-->
</div><!--end of formContent-->

</body>
</html>