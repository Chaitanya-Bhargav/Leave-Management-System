<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leave Application</title>
    <link rel="stylesheet" type="text/css" href="leaveformstyle.css"/>
    <script type="text/javascript" src="leaveFormValid.js"></script>
</head>
<body>
<header>
<img style="height:40px;width:220px ;padding:20px" src="images/heading.png">
</header>
    <center>
        <div class="container">
            <h1>Leave Application</h1>
			<hr>
            <form name="indexForm" action="" method="POST">
				<center>
                <div class="formFields">
                    <div class="namelabel">
                        <label>Employee Id :</label>
                    </div>
                    <div class="inputControls">
                        <input type="number" name="empid" id="eid" placeholder="Enter employee id"/>
                    </div>
                    <span id="textMessageEid"></span>
                </div>

                <div class="formFields">
                    <div class="namelabel">
                        <label>Employee Name :</label>
                    </div>
                    <div class="inputControls">
                        <input type="text" name="empname" id="ename" placeholder="Enter employee name" onfocus="return nameValidation()"/>
                    </div>
                    <span id="textMessageEname"></span>
                </div>

                <div class="formFields">
                    <div class="namelabel">
                        <label>Team Lead :</label>
                    </div>
                    <div class="inputControls">
                        <select name="tlead" id="teamLead" onfocus="return teamleadValidation()">
                            <option value="">Select Lead</option>
                            <option value="Subbu Chelluri">Subbu Chelluri</option>
                            <option value="Ganesh Sivangula">Ganesh Sivangula</option>
                            <option value="Anjali Nalumasu">Anjali Nalumasu</option>
                            <option value="Sangram Mohanty">Sangram Mohanty</option>
                        </select>
                    </div>
                    <span id="textMessageLead"></span>
                </div>

                <div class="formFields">
                    <div class="namelabel">
                        <label>Team Name :</label>
                    </div>
                    <div class="inputControls">
                        <select name="tname" id="teamName" onfocus="return teamnameValidation()">
                            <option value="">Select Team</option>
                            <option value="Mesh Team">Mesh Team</option>
                            <option value="PHP Team">PHP Team</option>
                            <option value="Frameworks Team">Frameworks Team</option>
                            <option value="Platform Team">Platform Team</option>
                        </select>
                    </div>
                    <span id="textMessageTeam"></span>
                </div>
				<div class="formFields">
                    <div class="namelabel">
                        <label>Leave Type :</label>
                    </div>
                    <div class="inputControls">
                        <select name="ltype" id="ltype" onfocus="return leavetypeValidation()">
                            <option value="">Select Leave Type</option>
                            <option value="Sick Leave">Sick Leave</option>
                            <option value="Casual Leave">Casual Leave</option>
                            <option value="Earned Leave">Earned Leave</option>
                            <option value="Loss of Pay">Loss of Pay</option>
                        </select>
                    </div>
                    <span id="textMessageLeaveType"></span>
                </div>
                <div class="formFields">
                    <div class="namelabel">
                        <label>Description :</label>
                    </div>
                    <div class="inputControls">
                        <textarea name="description" id="description" onfocus="return descriptionValidation()"></textarea>
                    </div>
                    <span id="textMessageReason"></span>
                </div>

                <div class="formFields">
                    <div class="namelabel">
                        <label>Leave Date :</label>
                    </div>
                    <div class="inputControls">
						<div>From:<input type="date" name="fromDate" id="fdate" onfocus="return fdateValidation()"/></div>
                        <div class="toDiv">To:<input type="date" name="toDate" id="tdate" onfocus="return tdateValidation()"/></div>
                    </div>
					<div>
                    <div id="textMessagefDate"></div><br/>
					<div id="textMessagetDate"></div>
					</div>
                </div>
				<center>
                <div class="formFields btnfield">
						<input class="submitButton" type="button" value="Submit" name="submitBtn" onclick="return submitValidation()"/>
						<input class="submitButton" type="button" value="Reset" name="resetBtn" onclick="location.reload();"/>
					
</div>
</center>
	<div class="popUp" style="background-color:#D5DBDB;z-index:1;position:absolute;margin-bottom:500px;margin-top:-350px;margin-left:150px;width:auto;border-radius:10px;" id="confirmMessage">
<pre>
	Hi teamlead,
			
	I am <span id="displayName"></span>. I need to have leave <span id="singledate">from <span id="displayFrom"></span> to</span> <span id="displayTo"></span> due to <span id="displayReason"></span> .
	So, kindly grant me leave.
                   
	Thanks & regards,
	<span id="nameBelowRegards"></span>.
	<input class="submitButton" type="submit" name="submitForm" value="OK">       <input type="button" class="submitButton" value="Cancel" onclick="clickcancle()">
</pre>
	</div>
	</center>
            </form>
        </div>
    </center>
<?php
	include 'configdb.php';
	if(isset($_POST['submitForm']))
	{
		$Eid=$_POST['empid'];
		$Ename=$_POST['empname'];
		$Tlead=$_POST['tlead'];
		$Tname=$_POST['tname'];
		$ltype=$_POST['ltype'];
		$Reason=$_POST['description'];
		$Fdate=$_POST['fromDate'];
		$Tdate=$_POST['toDate'];
		$status="Pending";
		$query="INSERT INTO employee_details(Empid,EmpName,TeamName,TeamLead,Leave_type,Fromdate,Todate,Description,applied_time,Status)VALUES ('$Eid','$Ename','$Tlead','$Tname','$ltype','$Fdate','$Tdate','$Reason',now(),'$status')";
		$result=$conn->query($query);
		?>
		<center>
			<div class="SuccessMsg">Applied successfully<br>
				<input type='submit' class="submitButton" value='Ok' 
				onclick="window.location.href='index.php'"/>
			</div>
		</center>
		<?php
			$conn=null;
	}
?>
	<footer>
		<div class="footerTag"><br/>
			<span class="privacyPolicy">Privacy Policy|Terms Of Use</span>
			<span class="footerLogo">&copy;jdsportsfashion plc</span>
		</div>
	</footer>
</body>
</html>