<!DOCTYPE HTML>
<html>
<head>
		<title>Cast</title>
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
		<a href="user.php">User</a>
		<div class="w3-dropdown-hover w3-mobile">
		<button class="w3-button" class="active" >Sereis <i class="fa fa-caret-down"></i></button>
			<div class="w3-dropdown-content w3-bar-block w3-dark-grey">
			<a href="series.php" class="w3-bar-item w3-button w3-mobile">Series Info</a>
			<a href="genre_series.php" class="w3-bar-item w3-button w3-mobile">Genre</a>
			<a href="cast_series.php" class="active" class="w3-bar-item w3-button w3-mobile">Cast</a>
			<a href="director.php" class="w3-bar-item w3-button w3-mobile">Director</a>
			 <a href="award.php" class="w3-bar-item w3-button w3-mobile">Award</a>
			</div>
		</div>
		<a href="Subscription.php">Subscription </a>
		<a href="package.php">Package</a>
		<a href="payment_history.php">Payment</a>
		<a href="watch_history.php">Watch History</a>
		
		<div class="w3-dropdown-hover w3-mobile">
		<button class="w3-button" >Report <i class="fa fa-caret-down"></i></button>
			<div class="w3-dropdown-content w3-bar-block w3-dark-grey">
			<a  href="top5.php" class="w3-bar-item w3-button w3-mobile">Top 5 Sereis</a>
			<a href="genre.php" class="w3-bar-item w3-button w3-mobile">Gener Series</a>
			<a href="cast.php" class="w3-bar-item w3-button w3-mobile">Actor Sereis</a> 
			</div>
		</div>	
		<a href="adminlogin.php">Logout</a>

	</div>
	
	
	<div id="body">
	
	<h3>Cast</h3>
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
				<th>Cast ID</th>
				<th>Cast Name</th>
				<th>Cast Gender</th>
				<th>Cast Age</th>
				<th>&nbsp &nbsp Operation</th>
				<th>&nbsp &nbsp Go To</th>
			</tr>
		</thead>
<?php	
include "connection.php";
$sql = "SELECT Cast_ID,Cast_Name,Cast_Gender,Cast_Age FROM cast;";
$result = $conn->query($sql);
 for($i=0; $row = $result->fetch_assoc(); $i++){

?>					


			<tr>
				<td><label><?php echo $row['Cast_ID']; ?></label></td>
				<td><label><?php echo $row['Cast_Name']; ?></label></td>
				<td><label><?php echo $row['Cast_Gender']; ?></label></td>
				<td><label><?php echo $row['Cast_Age']; ?></label></td>
				<td>
				<form method="post">
						<input type='hidden' name='e_castid' value='<?php echo $row['Cast_ID']; ?>'>
						<input type='hidden' name='e_castname' value='<?php echo $row['Cast_Name']; ?>'>
						<input type='hidden' name='e_castgen' value='<?php echo $row['Cast_Gender']; ?>'>
						<input type='hidden' name='e_castage' value='<?php echo $row['Cast_Age']; ?>'>
						<input type="submit" name="Edit"
						class="button" value="EDIT" />&nbsp &nbsp &nbsp 
				</form><br>
				
				<form method="post">
				<input type='hidden' name='deleteid' value='<?php echo $row['Cast_ID']; ?>'>
						<input type="submit" name="Delete"
						class="button" value="DELETE" />&nbsp &nbsp &nbsp 
				</form>
				<td><a href ="view_cast-series.php? identity=<?php echo $row['Cast_ID']?> "><button class="button button2">Series</button></td>
				</td>
			</tr>

					<?php
}
						?>
	</table>
	
	
	<h3>Insert Records</h3>
		<form name="add_record" action="#" method="post" enctype="multipart/form-data"  >
		
			<input type="text" name="castname" placeholder="Cast Name" required>
			
			<select name="gen" id="gen" name="gen" required>
				<option value="-1" selected>Cast Gender</option>
				<option value="Male">Male</option>
				<option value="Female">Female</option>
			</select>
			
			<input type="text" name="castage" placeholder="Cast Age" required>		
			<input type="submit" name="add_cast" value="ADD">
		</form>
	

	</div>
	
	
	
	<?php
	
	if(isset($_POST["add_cast"]))
						{
						$c_name=$_POST["castname"];
						$c_gender=$_POST["gen"];
						$C_age=$_POST["castage"];
						
 
if($c_gender==-1)
 
{
 
    echo '<p>Gender is empty</p>';
 
}
else{
			
            $sql = "INSERT into cast (Cast_Name, Cast_Gender, Cast_Age) 
			VALUES ('$c_name','$c_gender','$C_age')"; 
             if(mysqli_query($conn, $sql)){
					echo "Records added successfully.";
					echo "<meta http-equiv='refresh' content='0'>";
			} 
			else{
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
				}
				
}
}
	
	
	?>
	
	
	
	<?php
if(isset($_POST["Edit"])){
	$eid=$_POST["e_castid"];
	$name=$_POST["e_castname"];
	$egender=$_POST["e_castgen"];
	$age=$_POST["e_castage"];


	?>
	
<div id="edit">
<h3>Edit Records</h3>
		<form name="edit_record" action="#" method="post" enctype="multipart/form-data"  >
			<input type='hidden' name='edit_id' value="<?php echo $eid; ?>">
			<input type="text" name="edit_castname" value="<?php echo $name; ?>" required>
			
			<select name="egen" id="egen"  required>
				<option value="<?php echo $egender; ?>" selected>&#91; Selected &#93; <?php echo $egender; ?></option>
				<option value="Male">Male</option>
				<option value="Female">Female</option>
			</select>
			
			<input type="text" name="edit_castage" value="<?php echo $age; ?>" required>
			
			<input type='hidden' name='edit_sid' value="<?php echo $seriesid; ?>">		
			<input type="submit" name="edit_submit" value="EDIT">
		</form>
		
			
</div>
	
	
<?php }
if(isset($_POST["edit_submit"]))
{
$e_cast_id=$_POST['edit_id']; 
$e_name=$_POST["edit_castname"];
$e_gender=$_POST["egen"];
$e_age=$_POST["edit_castage"];



            $sql4 = "UPDATE cast SET Cast_Name='$e_name',Cast_Gender= '$e_gender' ,Cast_Age= '$e_age' 
			WHERE Cast_ID = '$e_cast_id';"; 
             if(mysqli_query($conn, $sql4)){
					echo "Records added successfullyA.";
					echo "<meta http-equiv='refresh' content='0'>";
			} 
			else{
				echo "ERROR: Could not able to execute $sql4. " . mysqli_error($conn);
				}
						
}

?>

<?php
if(isset($_POST["Delete"])){
$did=$_POST["deleteid"];
echo $did;
$sql5="DELETE FROM cast WHERE Cast_ID=$did";
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
