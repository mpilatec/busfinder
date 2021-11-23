<?php 


include("connection/connection.php");

if (isset($_POST['register'])){
	
	$studentNo=$_POST['studentNo'];
	$name=$_POST['name'];
	$surname=$_POST['surname'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	
	
	$sql="insert into tblstudent(studentNo,name,surname,email,password) values('".$studentNo."','".$name."','".$surname."','".$email."','".$password."');";
	
	if($conn->query($sql)===TRUE)
	{
		echo "you have successfully registered an account";
		echo "<script> location.href='index.php';</script>";
	}else{
		echo"something went wrong";
		echo "error".$sql."<br>".$conn->error;
		exit();
	}
	$conn->close();
}
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/mycss.css"> 

<title>Register</title>
</head>


<body>
<header>

<ul>

<li><a class="active" href="register.php">register</a></li>
<li><a   href="index.php">home</a></li>
</ul>


</header>
<h1>registration</h1>

<form method="POST">
<div>
<label>Student No:</label>
<input type="number" size="9" maxlength="9" placeholder="Enter your student number" name="studentNo" required>
</div>
<div>
<label>Name:</label>
<input type="text" placeholder="Enter your name" name="name" required>
</div>
<div>
<label>Surname:</label>
<input type="text" placeholder="Enter your surname" name="surname" required>
</div>
<div>
<label>email:</label>
<input type="email" placeholder="Enter email" name="email" required>
</div>
<div>
<label>Password:</label>
<input type="password" placeholder="Enter password" name="password" required>
</div>
<br>
<div>
<input type="submit" name="register" value="register">
</div>
<div>
<H3><p>Already registered?<a href="index.php"> login</a></p></H3>
</div>
</form>



</form>
</body>

 </html>