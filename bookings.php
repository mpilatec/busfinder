<?php 
session_start();
echo $_SESSION['studentNo'];
include ("connection/connection.php");

?>
<html>
<head><title>portal</title></head>
<link rel='stylesheet' type='text/css' href='css/mycss.css' >
<ul>
<li><a  href='portal.php'>portal<a/></li>
<li><a href='logout.php'>logout<a/></li>
<li><a class='active' href='bookings.php'>bookings<a/></li>

</ul>




<body onload="startTime()">
<h1>welcome to bus finder<h1>
<div id="txt">


</div>
<script>
function startTime(){
const today=new Date();
let h=today.getHours();
let m=today.getMinutes();
let s=today.getSeconds();

m=checkTime(m);
s=checkTime(s);

document.getElementById('txt').innerHTML= h+":"+m+":"+s;
setTimeout(startTime,1000);

}
function checkTime(i){
	
	if(i<10){i="0"+i};
	return i;
}

</script>
<form   method="POST">



<div>
<input type="submit" name="view" value="View bookings">
</div>
</form>

<?php 

if(isset($_POST['view'])){



	$time=time();
	date_default_timezone_set("Africa/Johannesburg");

$sql="select * from tblbooking where studentNo=".$_SESSION['studentNo'];
$results=$conn->query($sql);
if($results->num_rows>0)
{
	
	
	 ?> 
	 <table class="table table-bordered" id="dataTable" width="60%" cellspacing="10"style="color:black;">
<thead>
<tr> 
<th>No.</th>
<th>studentNo</th>
<th>name</th>
<th>date</th>
<th>time</th>
<th>campus from</th>
<th>campus to</th>

</tr>
</thead>

<tbody>
	 
	 <?php
	
	 $number=1;
	while($row = $results->fetch_assoc()){
		
	?>
<tr>
<td><?php echo $number ?></td>
<td><?php    echo  $row["studentNo"]; ?></td>
<td><?php    echo  $row["name"]; ?></td>
<td><?php    echo $row["date"]; ?></td>
<td><?php    echo $row["bustime"]; ?></td>
<td><?php    echo $row["campfrom"]; ?></td>
<td><?php    echo $row["campto"]; ?></td>

</tr>

<?php	
		
	$number=$number+1;	
	}	
	
	
}else
{
	echo "No bus reservations found! ";
}
}
?>




</html>