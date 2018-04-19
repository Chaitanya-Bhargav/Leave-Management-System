<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
	<link rel="stylesheet" href="leaveformstyle.css">
    <link rel="stylesheet" href="adminStyle.css">
	<script src="adminLoginValid.js"></script>
</head>
<body>
	<header>
		<img style="height:40px;width:220px ;padding:20px" src="images/heading.png">
	</header>
    <center>
        <div class="container">
			<form  class="AdminForm" name="AdminForm" action="#" method="post" onsubmit="return adminLoginvalid();">
				<h1 class="AdminTitle">Login</h1>
				<hr>
				<div class="formFields">
					<div class="nameLabel">
						<label>Username:</label>
					</div>
					<div class="inputControls">
						<span><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" placeholder="Enter Username" name="uname" id="name"/>
					</div>
					<div>
						<span id="errName"></span>
					</div>
				</div>
				<div class="formFields">
					<div class="nameLabel">
						<label>Password:</label>
					</div>
					<div class="inputControls">
						<input type="password" placeholder="Enter Password" name="pwd"
					 	onfocus="return passwordOnfocus();" id="pwd"/>
					</div>
					<div>
						<span id="errPwd"></span>
					</div>
				</div>
				<div class="formFields boxButton">
					<input class="adminSubmit" type="submit"
				 	name="submitForm" value="Login"/>
				</div>
			</form>
            
        </div>
    </center>


<?php
	include 'configdb.php';
	if(isset($_POST['submitForm']))
	{
		$username=$_POST['uname'];
		$password=$_POST['pwd'];
		$count=0;
		$query="select Access,UserName,Password from user_details ";
		$result=$conn->query($query);
		$result->setfetchmode(PDO::FETCH_ASSOC);
		$flag=0;
		while($row=$result->fetch())
		{
			if($row['UserName']==$username && $row['Password']==$password)
			{
				if($row['Access']=="admin")
				{
					header("Location:adminDashboard.php");
				}
				else
				{
				    header("Location:leaveform.php");	
				}
			}
			else
			{
				$flag=1;	
			}
		}
		if($flag==1)
		{
			echo "<center><span id='invalidMsg'><b>Username/Password not matched</b></span></center>";
		}	
		
		$conn=null;
	}
?>
<footer>
	<div class="footerTag">
		<span class="privacyPolicy">Privacy Policy|Terms Of Use</span>
		 <span class="footerLogo">&copy;jdsportsfashion plc</span>
	</div>
</footer>
</body>
</html>