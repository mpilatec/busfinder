<?php 
include ("connection/connection.php");

if(isset($_POST['password'])){
	
	$studentNo=$_POST['studentNo'];
	$password=$_POST['password'];
	
	$sql="select * from tblstudent where studentNo='".$studentNo."' AND password='".$password."' limit 1";
	
	$results=$conn->query($sql);
	if($results->num_rows>0)
	{
		session_start();
		$_SESSION['studentNo']=$studentNo;
		 
		  $row = $results->fetch_assoc();
	    $_SESSION["cred"]  = $row["name"]." ".$row["surname"];
		 
		 
		 
		echo "You have successfully logged in";
		
		
		echo "<script>location.href='portal.php'</script>";
	}else{
		echo "You have  entered wrong credentials";
	}
	
	$conn->close();
}


?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/mycss.css"> 

<title>Welcome to bus finder</title>
</head>


<body>
<header>

<ul>
<li><a href="admin.php">admin</a></li>
<li><a href="register.php">register</a></li>
<li><a class="active"  href="index.php">home</a></li>

</ul>


</header>
<h1>welcome to bus finder</h1>

<form method="POST">
<div>
<label>Student No:</label>
<input type="number" size="9" maxlength="9" placeholder="Enter your student number" name="studentNo" required>
</div>
<div>
<label>Password:</label>
<input type="password" placeholder="Enter password" name="password" required>
</div>
<br>
<div>
<input type="submit" name="login" value="login">
</div>
<div>
<H3><p>Not registered?<a href="register.php"> Register now</a></p></H3>
</div>
</form>



</form>
</body>

 </html>