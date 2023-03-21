<?php
session_start();
	include "connection.php";
	
	function function_alert($message) {
    echo "<script>alert('$message');
	window.location = 'login.html';</script>";
}
	
	if(isset($_POST['reg_submit'])){
		
	$username=$_POST['username'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$password=$_POST['password'];
	$package=$_POST['package'];
	
	
		
		$sql = "INSERT INTO user_account (User_Name, User_Email, User_PhoneNum, password) 
				VALUES ('$username','$email','$phone','$password')"; 
			if(mysqli_query($conn, $sql)){
				echo "New user added successfully.";
			} else{
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
			}
		
		$sql2 = "SELECT max(User_ID) as id from user_account";
			$result2 = $conn->query($sql2);
			for($i=0; $row = $result2->fetch_assoc(); $i++){
			$User_ID = $row['id'];
			echo $User_ID;
			}
			
			
		if($package==1){
				$future_timestamp = strtotime("+1 month");
				$enddate = date('Y-m-d', $future_timestamp);
				
				$sql3 = "INSERT INTO subscription (User_ID,Package_ID,Subscription_End_Date) 
				VALUES ('$User_ID','$package','$enddate')"; 
				if(mysqli_query($conn, $sql3)){
					function_alert("You have successfully registered for 1 month trial.");
				}
				else{
				echo "ERROR: Could not able to execute $sql3. " . mysqli_error($conn);
					}
			}
			
		else{
			$sql4 = "INSERT INTO subscription (User_ID,Package_ID) 
				VALUES ('$User_ID','$package')"; 
			if(mysqli_query($conn, $sql4)){
				echo "Subscription added successfully.";
				$_SESSION['User_ID'] = $User_ID;
				header('location: regi_payment.php');
				}
			
			 else{
				echo "ERROR: Could not able to execute $sql4. " . mysqli_error($conn);
			}
				
		}	
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registration System</title>
	<link rel="stylesheet" href="login.css">
	<script src="myform.js"></script>
</head>
<body >
	<div class="div_header" ><h1>TMFlix</h1></div>
	<div class="form">
	<center><h2>REGISTER</h2></center>
		<form name="myform" onsubmit="return validateform()" method="POST">
		
			<div>
				<input type="text" placeholder="Username" name="username" required>
			</div>
			
			<div>
				<input type="password" placeholder="Password" name="password" id="myInput" required>
			</div>
			
			<div>
				<input type="text" placeholder="Email" name="email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required>
			</div>
			
			<div>
				<input type="phone" placeholder="Mobile number" name="phone" required>
			</div>
			
			<div>
				<select name="package" id="package" name="package" required>
				<option value="-1" selected>Package</option>
		<?php	
		$sql = "SELECT * FROM package;";
		$result = $conn->query($sql);
		for($i=0; $row = $result->fetch_assoc(); $i++){

		?>						
				<option value="<?php echo $row['Package_ID']?>"><?php echo $row['Package_Type']?></option>
					<?php
		}

					?>	
					
			</select>
			</div>
			
			<div>
				<center><input type="submit" value="Submit" name="reg_submit"></center>
			</div>
			
			<center>
				<p>Registered? <a href="login.html">Login Here.</a></p>
			</center>
		</form>
	</div>
</body>
</html>