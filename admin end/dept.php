<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Departments</title>
<style>
.head{ background-color:#FFFFFF;
}
.below{  border: 1px solid gray;
   
   text-align: left;
    width: 50%;
    background-color:#E8E8E8; 
    padding: 18px;
}

</style>

<link rel="stylesheet" type="text/css" href="admin_tabs.css">
<link rel="stylesheet" type="text/css" href="table.css">


</head>

<body>


<?php include('leaveheader.php'); ?>


<?php 
$conn = mysqli_connect("localhost","root","","leavedb") or die("error");
?>

<div class="head">
<br />
<div class="list">
<ul><center>
<li><a class="list" href="admin1.php">Manage leave types</a></li>
<li><a class="list" href="calendar3.php">Approve/Deny leaves</a></li>
<li><a class="list" href="newleavedate.php">Manage holidays</a></li>
<li><a class="list" href="logout.php">Leave Status</a></li>
<li><a class="list" href="logout.php">Logout</a></li></center></ul>
</div>
<p style="clear:both"></p>
<br />

<?php
$query= "select * from department";
$result=mysqli_query($conn,$query)
or die("could not connect");
echo"<center><table id=\"leaves\"><tr><th>Department Name</th><th>Department ID</th></tr>";

while($row= mysqli_fetch_array($result))
{$n= $row['dept_name'];
$id=  $row['dept_id'];

echo "<tr><td>";
echo $n;
echo"</td><td>";

echo $id;
echo "</td></tr>";
}
echo"</table></center>";
echo"<br><br>";
?>
<?php
//------------1. This piece adds form data to database--------
if(isset($_POST['submit']))
{ 

	$str=$_POST['dept_name'];
	$dname=ucwords($str);
	$str1 = $_POST['dept_id'];
	$did = strtoupper($str1);;

		$query = "insert into department values ('$did','$dname')";
		$result=mysqli_query($conn,$query);
			
			if(!$result)
			echo"<center><font size=\"+2\">this department already exists.</font></center>";
			
			if($result)
			echo"<center><font size=\"+2\">department successfully added.</font></center>";
			header("refresh:0");
			
	}
	


//--------------1.end of this peace----------------
?>


<?php
//-------------2. This form checks which new leave you wanna enter-------------

if(!isset($_POST['submit']))
{
?>

<center>
<div class="below">
<font style="font-size:21px"><b>Add new department</b></font> <hr />

	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
	<table>
	<tr><td>Department Name:</td><td><input type="text" name= "dept_name" /></td></tr>
	
    <tr><td> Department ID (should be 2 characters long):</td><td><input type="text" name= "dept_id" /></td></tr>

		



</table>
<center>		
        <input type="submit" name="submit" value="Submit" />
	</form></div><br /><br /></center></div>
	

<?php
//-------------------2. End of form---------------------
}
?>


</div></center>
<?php include('leavefooer.php'); ?>	
</div>

</body>
</html>
