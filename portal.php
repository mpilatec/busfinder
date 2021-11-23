<?php 
session_start();
echo $_SESSION['studentNo'];
include ("connection/connection.php");

?>
<html>
<head><title>portal</title></head>
<link rel='stylesheet' type='text/css' href='css/mycss.css' >
<ul>
<li><a class='active' href='portal.php'>portal<a/></li>
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
<option value="22:00:00">10pm</option>

</select>

</div>
<div>
<input type="submit" name="book" value="book">
</div>
</form>

<?php  

if (isset($_POST['book'])){
$campusfrom=$_POST['campusesFrom'];
$campusTo=$_POST['campusesTo'];

if($campusfrom==$campusTo){
echo "can't travel to the same campus,please choose another campus";	
}else{
	
	$time=time();
	date_default_timezone_set("Africa/Johannesburg");
	
	$date=(date("y-m-d",$time))."<br>" ;
	
	$busTime=$_POST['time'];
	
	
	
	$convertBusTime=strtotime($busTime);
	
	if(date("H:i:s")>=date("H:i:s",$convertBusTime)){
		echo " you're late for the ".$busTime." bus, it has already left!";
	}else{
		
		$studentNo=$_SESSION['studentNo'];
		$name=$_SESSION['cred'];
		
		$sql1="select * from tblbooking where studentNo='".$studentNo."' AND bustime='".date("H:i:s",$convertBusTime)."' limit 1";
		
		//check if the student hadnt booked a bus in the same time slot.
		$result=$conn->query($sql1);
		
		
		if($result->num_rows>0)
		{
			$row=$result->fetch_assoc();
			
			echo " you've already reserved a seat for ".date("H:i:s",$convertBusTime)." bus heading to "
			.$row['campto']." from ".$row['campfrom'].". ";
			
		}else{
			
			
			$sql="insert into tblbooking(studentNo,name,timestamp,date,campfrom,campto,bustime) values('".$studentNo."','".$name."','".date("H:i:s")."','".date("y-m-d",$time)."','".$campusfrom."','".$campusTo."','".date("H:i:s",$convertBusTime)."')";
			if($conn->query($sql)===TRUE)
	{
		echo " successful,a seat is reserved for you!";
	}else
	{
		echo "Error ".$conn->error;
	}
			
			
			
		}
		
		
		
	}	
	
}
}


?>


</body>
</html>