<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="leaveform_style.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="leaveFormValid.js"></script>
</head>
<body>
	<header>
		<img style="height:40px;width:220px ;padding:20px" src="images/heading.png">
		<input class="logout_button" type="submit" value="Logout" name="logout"/>
	</header>
        <div class="container">
			<h1 class="heading">Admin Dashboard</h1>
			<hr></hr>
			<form name="Form" method="POST" action="">
				<div class="total_div">
					<select name="Month" class="select_options" id="select" onchange="showdate()">
						<option value="selectMonth">
							select-month
						</option>
						<option value="January">
							jan
						</option>
						<option value="February">
							feb
						</option>
						<option value="March">
							mar
						</option>
						<option value="April">
							apr
						</option>
						<option value="May">
							may
						</option>
						<option value="June">
							jun
						</option>
						<option value="July">
							jul
						</option>
						<option value="August">
							aug
						</option>
						<option value="September">
							sep
						</option>
						<option value="October">
							oct
						</option>
						<option value="November">
							nov
						</option>
						<option value="December">
							dec
						</option>
					</select>
					<select name="Select_date" class="select_options" id="selectDay" style="width:100px">
						<option value="selectDay">
							Select day
						</option>
					</select>
					<input type="submit" value="Submit" name="submitForm" class="button1" onclick="return validation()">
				</div>
				<div class="search_div">	
					<input type="text" name="searchName" placeholder="Search.." class="search_type" name="search">
					<button type="submit" name="searchSubmit" class="search_icon"><i class="fa fa-search"></i></button>
				</div>
				<div class="buttons_approve">
					<input type="submit" value="Approved" name="ApproveButton" class="button3"><br>
					<input type="submit" value="Rejected" name="RejectButton" class="button3"><br>
					<input type="submit" value="Pending" name="PendingButton" class="button3">
				</div>
			
		</div>
		<script>
			function validation()
            {
				x=document.getElementById("select").value;
				y=document.getElementById("selectDay").value;
				if(x=="select")
				{
					alert("please select month");
					return false;
				}
				
				else
				{
					return true;
				}
			}
			function showdate()
            {
				var x=document.getElementById('select').value;
				var month={January:31,February:28,March:31,April:30,May:31,June:30,
				July:31,August:31,September:30,October:31,November:30,December:31};
				var y = document.getElementById("selectDay");
				y.length=1;
				lenght=month[x];
				for(i=1;i<=lenght;i++)
				{
					var option = document.createElement("option");
					option.text = i;
					option.value=i;
					y.add(option);
				}	
            }
		</script>
		<?php
			include 'configdb.php';			
		if((isset($_POST['searchSubmit']))||(isset($_POST['pagesearch'])))
		{
			extract($_POST);
			$limit=10;
			if (isset($_POST["pagesearch"]))
				{ 
					$page  = $_POST["pagesearch"]; 
					
				} 
			else 
				{
					$page=1; 
				}  
            $start_from = ($page-1) * $limit;  
			//query for count the no rows
			$quer="select count(Empid) from employee_details";
			$res1=$conn->query($quer);
			$res1->setfetchmode(PDO::FETCH_NUM);
			$row=$res1->fetch();
			$count=$row[0];
			$query="select * from employee_details ORDER BY Empid ASC LIMIT $start_from, $limit";
			$total_pages = ceil($count / $limit);
			$res=$conn->query($query);
			$res->setfetchmode(PDO::FETCH_ASSOC);
		?>
			<div class="tableclass">
			<table id="tableAlign" border='1' style="border-collapse:collapse;">
				<tr>
					<th>
						Employee ID
					</th>
					<th>
						Employee Name
					</th>
					<th>
						From Date
					</th>
					<th>
						To date
					</th>
					<th>
						Status
					</th>
				</tr>
				<?php
				while($row=$res->fetch())
				{
					if($row['EmpName']==$searchName)
					{
						echo "<tr>";
						echo "<td id='RowData'>".$row['Empid']."</td>";
						echo "<td id='RowData'>".$row['EmpName']."</td>";
						echo "<td id='RowData'>".$row['Fromdate']."</td>";
						echo "<td id='RowData'>".$row['Todate']."</td>";
						echo "<td id='RowData'>".$row['Status']."</td>";
						echo "</tr>";
					}
				}
			echo "</table>";
			for ($i=1; $i<=$total_pages; $i++)
				{  
					echo "<input type='submit' value=".$i." name='pagesearch'>";  
				}
		}
		else if(isset($_POST['ApproveButton'])||isset($_POST['pageapprove']))
		{
			extract($_POST);
			$limit=10;
			if (isset($_POST["pageapprove"]))
				{ 
					$page  = $_POST["pageapprove"]; 
					echo $page;
					
				} 
			else 
				{
					$page=1; 
				}
			$start_from = ($page-1) * $limit;  
			//query for count the no rows
			$quer="select count(Empid) from employee_details where Status='Approved'";
			$res1=$conn->query($quer);
			$res1->setfetchmode(PDO::FETCH_NUM);
			$row=$res1->fetch();
			$count=$row[0];
			$query="select * from employee_details where Status='Approved' ORDER BY Empid ASC LIMIT $start_from, $limit";
			$total_pages = ceil($count / $limit);
			$res=$conn->query($query);
			$res->setfetchmode(PDO::FETCH_ASSOC);			
			?>
			
			<center>
			<table id="tableAlign" class="approved_button" border='1' style="border-collapse:collapse;margin-left:0px;">
				<tr>
					<th>
						Employee ID
					</th>
					<th>
						Employee Name
					</th>
					<th>
						From Date
					</th>
					<th>
						To date
					</th>
					<th>
						Status
					</th>
				</tr>
			
				<?php
				while($row=$res->fetch())
				{
					
						echo "<tr>";
						echo "<td id='RowData'>".$row['Empid']."</td>";
						echo "<td id='RowData'>".$row['EmpName']."</td>";
						echo "<td id='RowData'>".$row['Fromdate']."</td>";
						echo "<td id='RowData'>".$row['Todate']."</td>";
						echo "<td id='RowData'>".$row['Status']."</td>";
						echo "</tr>";
					
				}
			echo "</table>";
			for ($i=1; $i<=$total_pages; $i++)
				{  
					echo "<input type='submit' value=".$i." name='pageapprove'>";  
				}
		}
		else if(isset($_POST['RejectButton'])||isset($_POST['pagereject']))
		{
			extract($_POST);
			$limit=10;
			if (isset($_POST["pagereject"]))
				{ 
					$page  = $_POST["pagereject"]; 
					
				} 
			else 
				{
					$page=1; 
				}  
           	$start_from = ($page-1) * $limit;  
			//query for count the no rows
			$quer="select count(Empid) from employee_details where Status='Rejected'";
			$res1=$conn->query($quer);
			$res1->setfetchmode(PDO::FETCH_NUM);
			$row=$res1->fetch();
			$count=$row[0];
			$query="select * from employee_details where Status='Rejected' ORDER BY Empid ASC LIMIT $start_from, $limit";
			$total_pages = ceil($count / $limit);
			$res=$conn->query($query);
			$res->setfetchmode(PDO::FETCH_ASSOC);
			?>
			</center>
			<table id="tableAlign" border='1' style="border-collapse:collapse;">
				<tr>
					<th>
						Employee ID
					</th>
					<th>
						Employee Name
					</th>
					<th>
						From Date
					</th>
					<th>
						To date
					</th>
					<th>
						Status
					</th>
				</tr>
				<?php
				while($row=$res->fetch())
				{
					
						echo "<tr>";
						echo "<td id='RowData'>".$row['Empid']."</td>";
						echo "<td id='RowData'>".$row['EmpName']."</td>";
						echo "<td id='RowData'>".$row['Fromdate']."</td>";
						echo "<td id='RowData'>".$row['Todate']."</td>";
						echo "<td id='RowData'>".$row['Status']."</td>";
						echo "</tr>";
					
				}
				echo "</table>";
				for ($i=1; $i<=$total_pages; $i++)
				{  
					echo "<input type='submit' value=".$i." name='pagereject'>";  
				}
		}
		else if(isset($_POST['PendingButton'])||(isset($_POST['pagepending'])))
		{
			extract($_POST);
			$limit=10;
			if (isset($_POST["pagepending"]))
				{ 
					$page  = $_POST["pagepending"]; 
					
				} 
			else 
				{
					$page=1;
				}  
           	$start_from = ($page-1) * $limit;  
			//query for count the no rows
			$quer="select count(Empid) from employee_details where Status='Pending'";
			$res1=$conn->query($quer);
			$res1->setfetchmode(PDO::FETCH_NUM);
			$row=$res1->fetch();
			$count=$row[0];
			$query="select * from employee_details where Status='Pending' ORDER BY Empid ASC LIMIT $start_from, $limit";
			$total_pages = ceil($count / $limit);
			$res=$conn->query($query);
			$res->setfetchmode(PDO::FETCH_ASSOC);
			?>
			<form name="formname" method="POST" action="">
			<table id="tableAlign" border='1' style="border-collapse:collapse;">
				<tr>
					<th>
						Employee ID
					</th>
					<th>
						Employee Name
					</th>
					<th>
						From Date
					</th>
					<th>
						To date
					</th>
					<th>
						Status
					</th>
					<th>
						<input type="checkbox" id="chck" onchange="selectAllFunction()"> Select All
					</th>
				</tr>
				<?php
				while($row=$res->fetch())
				{
					
						echo "<tr>";
						echo "<td id='RowData'>".$row['Empid']."</td>";
						echo "<td id='RowData'>".$row['EmpName']."</td>";
						echo "<td id='RowData'>".$row['Fromdate']."</td>";
						echo "<td id='RowData'>".$row['Todate']."</td>";
						echo "<td id='RowData'>".$row['Status']."</td>";
						echo "<td id='RowData'><input type='checkbox' name='ids[]' class='checkBox' value='$row[Empid]'/>Approve</td>";
						echo "</tr>";
					
					
				}
				for ($i=1; $i<=$total_pages; $i++)
				{  
					echo "<input type='submit' value=".$i." name='pagepending'>";  
				}
				?>
				</table><br>
			<center>
			<input class="confirmButton" type="submit" name="submitConformForm"   value="Approve"/>
			<input class="confirmButton" type="submit" name="submitRejectForm"   value="Reject"/>
		</center></form>
		<?php	
		}
		else if(isset($_POST['submitForm']))
		{
			extract($_POST);
			$query="select Empid,EmpName,Fromdate,Todate,Status,MONTHNAME(applied_time) as month,DATE_FORMAT(applied_time,'%d') as date from employee_details";
			$res=$conn->query($query);
			$res->setfetchmode(PDO::FETCH_ASSOC);
			?>
			<table id="tableAlign" border='1' style="border-collapse:collapse;">
				<tr>
					<th>
						Employee ID
					</th>
					<th>
						Employee Name
					</th>
					<th>
						From Date
					</th>
					<th>
						To date
					</th>
					<th>
						Status
					</th>
				</tr>
				<?php
			if($Month!="selectMonth" && $Select_date!="selectDay")
			{  
		
				while($row=$res->fetch())
				{	 
					if($row['month']==$Month && $row['date']==$Select_date)
					{	
						echo "<tr>";
						echo "<td id='RowData'>".$row['Empid']."</td>";
						echo "<td id='RowData'>".$row['EmpName']."</td>";
						echo "<td id='RowData'>".$row['Fromdate']."</td>";
						echo "<td id='RowData'>".$row['Todate']."</td>";
						echo "<td id='RowData'>".$row['Status']."</td>";
						echo "</tr>";
					}
				}
			}
			else
			{
				while($row=$res->fetch())
				{
					if($row['month']==$Month)
					{
						echo "<tr>";
						echo "<td id='RowData'>".$row['Empid']."</td>";
						echo "<td id='RowData'>".$row['EmpName']."</td>";
						echo "<td id='RowData'>".$row['Fromdate']."</td>";
						echo "<td id='RowData'>".$row['Todate']."</td>";
						echo "<td id='RowData'>".$row['Status']."</td>";
						echo "</tr>";
					}
				}
			}
			?>
			</table>
			
		<?php	
		}
		else if(((!isset($_POST['ApproveButton'])) && (!isset($_POST['PendingButton'])) && (!isset($_POST['RejectButton'])) && (!isset($_POST['submitForm']))) || (isset($_POST['pagenorm'])))
		{
			$limit=10;
			extract($_POST);
			if (isset($_POST["pagenorm"]))
				{ 
					$page  = $_POST["pagenorm"]; 
					
				} 
			else 
				{
					$page=1; 
				} 
					
            $start_from = ($page-1) * $limit;  
			//query for count the no rows
			$quer="select count(Empid) from employee_details where Status='Pending'";
			$res1=$conn->query($quer);
			$res1->setfetchmode(PDO::FETCH_NUM);
			$row=$res1->fetch();
			$count=$row[0];
			$todaysdate=date("Y-m-d");
			$query="select Empid,EmpName,Fromdate,Todate,Status,date(applied_time) as appliedDate from employee_details where Status='Pending'";
			$total_pages = ceil($count / $limit);
			$res=$conn->query($query);
			$res->setfetchmode(PDO::FETCH_ASSOC);
			?>
			
			<form name="formsubmit" action="" method="POST">
			
			<table id="tableAlign" border='1' style="border-collapse:collapse;">
			
				<tr>
					<th>
						Employee ID
					</th>
					<th>
						Employee Name
					</th>
					<th>
						From Date
					</th>
					<th>
						To date
					</th>
					<th>
						Status
					</th>
					<th>
						<input type="checkbox" id="chck" onchange="selectAllFunction()"> Select All
					</th>
				</tr>
				<?php
			while($row=$res->fetch())
			{
				if($todaysdate==$row['appliedDate'])
				{
					echo "<tr>";
						echo "<td id='RowData'>".$row['Empid']."</td>";
						echo "<td id='RowData'>".$row['EmpName']."</td>";
						echo "<td id='RowData'>".$row['Fromdate']."</td>";
						echo "<td id='RowData'>".$row['Todate']."</td>";
						echo "<td id='RowData'>".$row['Status']."</td>";
						echo "<td id='RowData'><input type='checkbox' name='ids[]' class='checkBox' value='$row[Empid]'/>Approve</td>";
						echo "</tr>";
				}
				for ($i=1; $i<=$total_pages; $i++)
				{  
					echo "<input type='submit' value=".$i." name='pagenorm'>";  
				}
			}
	?>
			</table>
			<center>
			<input class="confirmButton" type="submit" name="submitConformForm" class="button3"value="Approve"/>
			<input class="confirmButton" type="submit" name="submitRejectForm" class="button3" value="Reject"/>
			</center>
			</form>
			<?php
				} 
			?>
		
		<?php
		if(isset($_POST['submitConformForm']))
		{
			
			extract($_POST);
			$query="select * from employee_details";
			$res=$conn->query($query);
			$res->setfetchmode(PDO::FETCH_ASSOC);
			$count11=0;
			while($row=$res->fetch())
			{
				foreach($_POST['ids'] as $EachId)
				{
					if($EachId==$row['Empid'])
					{
						$query2="update employee_details set Status='Approved' where Empid=$EachId";
						$conn->query($query2);
						$count11++;
					}		
				}
			}
			if($count11==1)
			{
				echo "<center><div class='SuccessMsg'>you have approved the ".$count11." person leave</div></center>";
			}
			else
			{
				echo "<center><div class='SuccessMsg'>you have approved the ".$count11." persons leave</div></center>";
			}
		
		}	
		
		
		if(isset($_POST['submitRejectForm']))
		{
			extract($_POST);
			$query="select * from employee_details";
			$res=$conn->query($query);
			$res->setfetchmode(PDO::FETCH_ASSOC);
			$count11=0;
			while($row=$res->fetch())
			{
				foreach($_POST['ids'] as $EachId)
				{
					if($EachId==$row['Empid'])
					{
						$query2="update employee_details set Status='Rejected' where Empid=$EachId";
						$conn->query($query2);
						$count11++;
					}		
				}
			}
			if($count11==1)
			{
				echo "<center><div class='SuccessMsg'>you have rejected the ".$count11." person leave</div></center>";
			}
			else
			{
				echo "<center><div class='SuccessMsg'>you have rejected the ".$count11." persons leave</div></center>";
			}
		
		}
		
		
		?>
		<script>
			function selectAllFunction()
			{
				var checkBoxSet=document.getElementsByClassName("checkBox");
				var len=checkBoxSet.length;
				var chek=document.getElementById("chck");
				if(chek.checked)
				{
					for(var i=0;i<len;i++)
					{
						checkBoxSet[i].checked=true;
					}
				}
				else
				{
					for(var i=0;i<len;i++)
					{
						checkBoxSet[i].checked=false;
					}
				}
			}
		</script>
		</form>
		</center>
	</body>
</html>