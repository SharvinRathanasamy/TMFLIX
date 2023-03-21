<!DOCTYPE HTML>
<html>
<head>
		<title>User</title>
		<script src='https://kit.fontawesome.com/a076d05399.js'></script>
		<link rel="stylesheet" href="adminpage.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><body>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>



</head>
	<div class="header">
		<h1>&nbsp TMFlix Admin </h1>
	</div>
	
	<div class="navbar">
		<a href="user.php" class="active">User</a>
		<div class="w3-dropdown-hover w3-mobile">
		<button class="w3-button">Sereis <i class="fa fa-caret-down"></i></button>
			<div class="w3-dropdown-content w3-bar-block w3-dark-grey">
			<a href="series.php" class="w3-bar-item w3-button w3-mobile">Series Info</a>
			<a href="genre_series.php" class="w3-bar-item w3-button w3-mobile">Genre</a>
			<a href="cast_series.php" class="w3-bar-item w3-button w3-mobile">Cast</a>
			<a href="director.php" class="w3-bar-item w3-button w3-mobile">Director</a>
			 <a href="award.php" class="w3-bar-item w3-button w3-mobile">Award</a>
			</div>
		</div>
		<a href="Subscription.php">Subscription </a>
		<a href="package.php">Package</a>
		<a href="payment_history.php">Payment</a>
		<a href="watch_history.php">Watch History</a>
		
		<div class="w3-dropdown-hover w3-mobile">
		<button class="w3-button">Report <i class="fa fa-caret-down"></i></button>
			<div class="w3-dropdown-content w3-bar-block w3-dark-grey">
			<a  href="top5.php" class="w3-bar-item w3-button w3-mobile">Top 5 Sereis</a>
			<a href="genre.php" class="w3-bar-item w3-button w3-mobile">Gener Series</a>
			<a href="cast.php" class="w3-bar-item w3-button w3-mobile">Actor Sereis</a> 
			</div>
		</div>	
		<a href="adminlogin.php">Logout</a>

	</div>
		


<div class="body">
		<h3>User</h3>
		<style>
		table {
		  
		   table-layout: auto;
			width: 100%; 
		  
		}

		th, td {
		  padding: 1px;
		  text-align: left;
		  border-bottom: 1px solid #ddd;
		}

		tr:hover {background-color:#f5f5f5;}
		</style>
	<table>
		<thead>
			<tr>
				<th>User ID</th>
				<th>User Name</th>
				<th>User Email</th>
				<th>User PhoneNum</th>
			    <th>Password</th>
				<th>Package Type</th>
				<th>Package Price </th>
				<th>&nbsp &nbsp Operation</th>
			</tr>
		</thead>
<?php	
include "connection.php";
$sql = "SELECT user_account.User_ID, user_account.User_Name, user_account.User_Email,user_account.User_PhoneNum,user_account.password, subscription.Subscription_ID,subscription.Package_ID,package.Package_Type,package.Package_Price
FROM user_account
INNER JOIN subscription
ON subscription.User_ID=user_account.User_ID
	INNER JOIN (SELECT subscription.User_ID, MAX(subscription.Subscription_ID) AS sub
	FROM subscription 
	GROUP BY subscription.User_ID)
	AS NewSUB
	ON subscription.User_ID=NewSUB.User_ID
	AND subscription.Subscription_ID = NewSUB.sub
INNER JOIN 	package
ON subscription.Package_ID= package.Package_ID
ORDER BY user_account.User_ID;";
$result = $conn->query($sql);
 for($i=0; $row = $result->fetch_assoc(); $i++){

?>					


			<tr>
				<td><label><?php echo $row['User_ID']; ?></label></td>
				<td><label><?php echo $row['User_Name']; ?></label></td>
				<td><label><?php echo $row['User_Email']; ?></label></td>
				<td><label><?php echo $row['User_PhoneNum']; ?></label></td>
			    <td><label><?php echo $row['password']; ?></label></td>
				<td><label><?php echo $row['Package_Type']; ?></label></td>
				<td><label><?php echo $row['Package_Price']; ?></label></td>
				<td>
				<form method="post">
						<input type='hidden' name='editid' value='<?php echo $row['User_ID']; ?>'>
						<input type='hidden' name='editname' value='<?php echo $row['User_Name']; ?>'>
						<input type='hidden' name='editemail' value='<?php echo $row['User_Email']; ?>'>
						<input type='hidden' name='editphone' value='<?php echo $row['User_PhoneNum']; ?>'>
						<input type='hidden' name='editpass' value='<?php echo $row['password']; ?>'>
						<input type='hidden' name='editpackid' value='<?php echo $row['Package_ID']; ?>'>
						<input type='hidden' name='editpacktype' value='<?php echo $row['Package_Type']; ?>'>
						<input type="submit" name="Edit"
						class="button" value="EDIT" />&nbsp &nbsp &nbsp 
				</form><br>
				
				<form method="post">
				<input type='hidden' name='deleteid' value='<?php echo $row['User_ID']; ?>'>
						<input type="submit" name="Delete"
						class="button" value="DELETE" />&nbsp &nbsp &nbsp 
				</form>
				</td>
			</tr>

					<?php
}
						?>
		</table>
	<h3>Insert Records</h3>
		<form name="add_record" action="#" method="post" enctype="multipart/form-data"  >
			<input type="text" name="username" placeholder="User Name" required>
			<input type="text" name="useremail" placeholder="User Email" required>
			<input type="text" name="userphone" placeholder="User Phone Number" required>
			<input type="text" name="userpasword" placeholder="Password" required>
			<select name="pack" id="pack"  required>
				<option value="-1" selected>Package</option>
		<?php	
$sql = "SELECT * FROM package;";
$result = $conn->query($sql);
 for($i=0; $row = $result->fetch_assoc(); $i++){

?>						
				<option value="<?php echo $row['Package_ID']?>"><?php echo $row['Package_Type']?></option>
					<?php
}?>	
					
			</select>			
			<input type="submit" name="reg_submit" value="ADD">
		</form>
<?php			
	if(isset($_POST["reg_submit"]))
{
$name=$_POST["username"];
$email=$_POST["useremail"];
$phn=$_POST["userphone"];
$pass=$_POST['userpasword']; 
$pack=$_POST["pack"];

if($pack==-1)
 
{
 
    echo '<p>Package is empty</p>';
 
}
else{
			
			$sql = "INSERT INTO user_account (User_Name, User_Email, User_PhoneNum, password) 
				VALUES ('$name','$email','$phn','$pass')"; 
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
			
			
		if($pack==1){
				$future_timestamp = strtotime("+1 month");
				$enddate = date('Y-m-d', $future_timestamp);
				
				$sql3 = "INSERT INTO subscription (User_ID,Package_ID,Subscription_End_Date) 
				VALUES ('$User_ID','$pack','$enddate')"; 
				if(mysqli_query($conn, $sql3)){
					echo "New subscription added successfully.";
					echo "<meta http-equiv='refresh' content='0'>";
				}
				else{
				echo "ERROR: Could not able to execute $sql3. " . mysqli_error($conn);
					}
			}
			
		else{
			$sql4 = "INSERT INTO subscription (User_ID,Package_ID) 
				VALUES ('$User_ID','$pack')"; 
			if(mysqli_query($conn, $sql4)){
				echo "Subscription added successfully.";
				echo "<meta http-equiv='refresh' content='0'>";
				}
			
			 else{
				echo "ERROR: Could not able to execute $sql4. " . mysqli_error($conn);
			}
				
		}
}
}
?>
	
	<?php
if(isset($_POST["Edit"])){
	$eid=$_POST["editid"];
	$ename=$_POST["editname"];
	$eemail=$_POST["editemail"];
	$ephone=$_POST["editphone"];
	$epass=$_POST['editpass'];
	$epackid=$_POST['editpackid'];
	$epackty=$_POST['editpacktype'];


	?>
	
<div id="edit">
<h3>Edit Records</h3>
	<form name="add_record" action="#" method="post" enctype="multipart/form-data"  >
			<input type='hidden' name='eid' value='<?php echo $eid; ?>'>
			
			<input type="text" name="eusername" value="<?php echo $ename;?>" required>
			<input type="text" name="euseremail" value="<?php echo $eemail;?>" required>
			<input type="text" name="euserphone" value="<?php echo $ephone;?>" required>
			<input type="text" name="euserpasword" value="<?php echo $epass;?>" required>
			
			<input type='hidden' name='epack2' value='<?php echo $epackid; ?>'>
			<select name="epack" id="epack"  required>
				<option value="<?php echo $epackid;?>" selected>&#91; Selected &#93; <?php echo $epackty;?></option>
		<?php	
$sql = "SELECT * FROM package;";
$result = $conn->query($sql);
 for($i=0; $row = $result->fetch_assoc(); $i++){

?>						
				<option value="<?php echo $row['Package_ID']?>"><?php echo $row['Package_Type']?></option>
					<?php
}?>	
					
			</select>			
			<input type="submit" name="edit_submit" value="Edit">
		</form>
</div>
	
	
<?php }
if(isset($_POST["edit_submit"]))
{
$eid1=$_POST['eid']; 
$ename1=$_POST["eusername"];
$eemail1=$_POST["euseremail"];
$ephn1=$_POST["euserphone"];
$epass1=$_POST['euserpasword'];
$epack1=$_POST['epack'];
$epack2=$_POST['epack2'];


            $sql4 = "UPDATE user_account SET User_Name='$ename1',User_Email= '$eemail1' ,User_PhoneNum= '$ephn1' ,password	='$epass1'
			WHERE User_ID = '$eid1';"; 
             if(mysqli_query($conn, $sql4)){
					echo "Records added successfullyA.";
			} 
			else{
				echo "ERROR: Could not able to execute $sql4. " . mysqli_error($conn);
				}
				
if($epack1==$epack2){
	echo "No changes in package";
	echo "<meta http-equiv='refresh' content='0'>";
}

else{
	if($epack1==1){
				$future_timestamp = strtotime("+1 month");
				$enddate = date('Y-m-d', $future_timestamp);
				
				$sql5 = "INSERT INTO subscription (User_ID,Package_ID,Subscription_End_Date) 
				VALUES ('$eid1','$epack1','$enddate')"; 
				if(mysqli_query($conn, $sql5)){
					echo "New subscription added successfully.";
					echo "<meta http-equiv='refresh' content='0'>";
				}
				else{
				echo "ERROR: Could not able to execute $sql5. " . mysqli_error($conn);
					}
			}
			
		else{
			$sql6 = "INSERT INTO subscription (User_ID,Package_ID) 
				VALUES ('$eid1','$epack1')"; 
			if(mysqli_query($conn, $sql6)){
				echo "Subscription added successfully.";
				echo "<meta http-equiv='refresh' content='0'>";
				}
			
			 else{
				echo "ERROR: Could not able to execute $sql6. " . mysqli_error($conn);
			}
				
		}
	
}

}

?>


<?php
if(isset($_POST["Delete"])){
$did=$_POST["deleteid"];
echo $did;
$sql5="DELETE FROM user_account WHERE User_ID=$did";
if(mysqli_query($conn, $sql5)){
					echo "Records Deleteted successfully.";
					echo "<meta http-equiv='refresh' content='0'>";
			} 
			else{
				echo "ERROR: Could not able to execute $sql5. " . mysqli_error($conn);
				}
}


?>
	
	
	
<body>
<div class="footer">
	  <p>&nbsp Database Project Copyright &copy; 2021.</p>
	</div>
</body>

</html>	