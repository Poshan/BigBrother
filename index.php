<html>
<head>
	<title>Tracking</title>
	
	<link rel="stylesheet" href="/trial/css/formcss.css">
</head>
<body background = "/trial/img/image.jpg">
<form action ="user.php">
	<input type="submit" id="Alreadyauser" name="Already a user">
</form>
<h1>
	Register
</h1>
<div id ="formContent">
	<div id ="form">
		<form action="insertion.php" method="post">
			<div class="row">
			<div class="label">Name</div><!--end .label-->	
			<div class="input">
			<input type="text" id="fname" class="detail" name="fname" value=""/>
			</div><!--end of .input-->
			<div class="context">e.g. poshan Niraula	</div><!--end of .context-->
			</div><!--end of .row-->		

			<div class="row">
			<div class="label">Phone number</div><!--end .label-->	
			<div class="input">
			<input type="text" id="phone" class="detail" name="phone" value=""/>
			</div><!--end of .input-->
			<div class="context">e.g. 9841707706	</div><!--end of .context-->
			</div><!--end of .row-->	


			<div class="row">
			<div class="label">password</div><!--end .label-->	
			<div class="input">
			<input type="password" id="password" class="detail" name="password" value=""/>
			</div><!--end of .input-->
			<div class="context">could be combination of numbers and letters</div><!--end of .context-->
			</div><!--end of .row-->	

			<div class="submit">
				<input type="submit" id="submit" name="submit" value="submit"/>
			</div><!--end of .submit-->
		</form><!--end of the form-->


	</div><!--end #form-->
</div><!--end of formContent-->

</body>
</html>

