<?php 
session_start();
echo $_SESSION['staffNo'];
include ("connection/connection.php");

?>
<html>
<head><title>portal</title></head>
<link rel='stylesheet' type='text/css' href='css/mycss.css' >
<ul>
<li><a class='active' href='adminportal.php'>portal<a/></li>
<li><a href='logout.php'>logout<a/></li>

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
<label for="campusesFrom">from:</label>
<select name="campusesFrom" id="campus">
<option value="Pretoria Main Campus">Pretoria Main Campus</option>
<option value="Acardia Campus">Acardia Campus</option>
<option value="Soshanguve south Campus">Soshanguve south Campus</option>
<option value="Soshanguve North Campus">Soshanguve North Campus</option>
<option value="Garankuwa Campus">Garankuwa Campus</option>
<option value="Pretoria arts Campus">Pretoria arts Campus</option>
</select>


<label for="campusesTo">to:</label>
<select name="campusesTo" id="campus">
<option value="Pretoria Main Campus">Pretoria Main Campus</option>
<option value="Acardia Campus">Acardia Campus</option>
<option value="Soshanguve south Campus">Soshanguve south Campus</option>
<option value="Soshanguve North Campus">Soshanguve North Campus</option>
<option value="Garankuwa Campus">Garankuwa Campus</option>
<option value="Pretoria arts Campus">Pretoria arts Campus</option>
</select>



<label for="time">time:</label>
<select name="time" id="time" >
<option value="07:00:00">7am</option>
<option value="08:00:00">8am</option>
<option value="09:00:00">9am</option>
<option value="10:00:00">10am</option>
<option value="11:00:00">11am</option>
<option value="12:00:00">12pm</option>
<option value="13:00:00">1pm</option>
<option value="14:00:00">2pm</option>
<option value="15:00:00">3pm</option>
<option value="16:00:00">4pm</option>
<option value="17:00:00">5pm</option>
<option value="18:00:00">6pm</option>
<option value="19:00:00">7pm</option>
<option value="20:00:00">8pm</option>
<option value="21:00:00">9pm</option>
<option value="00:00:00">10pm</option>

</select>

</div>
<div>
<input type="submit" name="view" value="View No. students">
</div>
</form>

<?php 

if(isset($_POST['view'])){

$campfrom=$_POST['campusesFrom'];
$campto=$_POST['campusesTo'];
$busttime=$_POST['time'];

	$time=time();
	date_default_timezone_set("Africa/Johannesburg");

$sql="select * from tblbooking where campfrom='".$campfrom."' AND campto='".$campto."' AND bustime='".$busttime."' AND date='".date("y-m-d",$time)."' ";
$results=$conn->query($sql);
if($results->num_rows>0)
{
	echo "There are ".$results->num_rows ." seats booked form ".$campfrom." to ".$campto." at ".$busttime;
	
	 ?> 
	 <table class="table table-bordered" id="dataTable" width="60%" cellspacing="10"style="color:black;">
<thead>
<tr> 
<th>No.</th>
<th>studentNo</th>
<th>name</th>
<th>date</th>
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