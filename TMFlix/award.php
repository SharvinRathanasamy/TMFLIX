<!DOCTYPE HTML>
<html>
<head>
		<title>Award</title>
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
		<button class="w3-button" class="active">Sereis <i class="fa fa-caret-down"></i></button>
			<div class="w3-dropdown-content w3-bar-block w3-dark-grey">
			<a href="series.php" class="w3-bar-item w3-button w3-mobile">Series Info</a>
			<a href="genre_series.php" class="w3-bar-item w3-button w3-mobile">Genre</a>
			<a href="cast_series.php" class="w3-bar-item w3-button w3-mobile">Cast</a>
			<a href="director.php" class="w3-bar-item w3-button w3-mobile">Director</a>
			 <a href="award.php" class="active"  class="w3-bar-item w3-button w3-mobile">Award</a>
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
	
	
	<div id="body">
		<h3>Awards</h3>
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
				<th>Award ID</th>
				<th>Award Name</th>
				<th>Award Category</th>
				<th>Award Year</th>
			    <th>Series Name</th>
				<th>Series ID</th>
				<th>&nbsp &nbsp Operation</th>
			</tr>
		</thead>
<?php	
include "connection.php";
$sql = "SELECT award.Award_ID, award.Award_Name, award.Award_Category, award.Award_Year, series.Series_Name, series.Series_ID
FROM award
inner JOIN series 
ON series.Series_ID = award.Series_ID;";
$result = $conn->query($sql);
 for($i=0; $row = $result->fetch_assoc(); $i++){

?>					


			<tr>
				<td><label><?php echo $row['Award_ID']; ?></label></td>
				<td><label><?php echo $row['Award_Name']; ?></label></td>
				<td><label><?php echo $row['Award_Category']; ?></label></td>
				<td><label><?php echo $row['Award_Year']; ?></label></td>
			    <td><label><?php echo $row['Series_Name']; ?></label></td>
				<td><label><?php echo $row['Series_ID']; ?></label></td>
				<td>
				<form method="post">
						<input type='hidden' name='e_awardid' value='<?php echo $row['Award_ID']; ?>'>
						<input type='hidden' name='e_awardname' value='<?php echo $row['Award_Name']; ?>'>
						<input type='hidden' name='e_awardcat' value='<?php echo $row['Award_Category']; ?>'>
						<input type='hidden' name='e_awardyear' value='<?php echo $row['Award_Year']; ?>'>
						<input type='hidden' name='e_seriesname' value='<?php echo $row['Series_Name']; ?>'>
						<input type='hidden' name='e_seriesid' value='<?php echo $row['Series_ID']; ?>'>
						<input type="submit" name="Edit"
						class="button" value="EDIT" />&nbsp &nbsp &nbsp 
				</form><br>
				
				<form method="post">
				<input type='hidden' name='deleteid' value='<?php echo $row['Award_ID']; ?>'>
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
		
			<input type="text" name="awardname" placeholder="Award Name" required>
			<input type="text" name="awardcat" placeholder="Award Category" required>
			<input type="text" name="awardyear" placeholder="Award Year" required>
			
			<select name="series" id="series"  required>
				<option value="-1" selected>Series</option>
<?php	
			$sql = "SELECT Series_ID, Series_Name FROM series;";
			$result = $conn->query($sql);
			 for($i=0; $row = $result->fetch_assoc(); $i++){

			?>						
							<option value="<?php echo $row['Series_ID']?>"><?php echo $row['Series_Name']?></option>
								<?php
			}	
?>		
			</select>			
			<input type="submit" name="add_award" value="ADD">
		</form>
	
	
	</div>
	
	<?php
	
	if(isset($_POST["add_award"]))
						{
						$aw_name=$_POST["awardname"];
						$aw_cat=$_POST["awardcat"];
						$aw_yr=$_POST["awardyear"];
						$aw_series_id=$_POST['series']; 
						
 
if($aw_series_id==-1)
 
{
    echo '<p>Series is empty</p>';
}
else{
           $sql = "INSERT into award (Award_Name, Award_Category, Award_Year,Series_ID ) 
			VALUES ('$aw_name','$aw_cat','$aw_yr','$aw_series_id')"; 
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
	$eid=$_POST["e_awardid"];
	$name=$_POST["e_awardname"];
	$ecat=$_POST["e_awardcat"];
	$eyear=$_POST["e_awardyear"];
	$seriesid=$_POST['e_seriesid'];
	$seriesname=$_POST['e_seriesname'];


	?>
	
	
<div id="edit">
<h3>Edit Records</h3>
		<form name="edit_record" action="#" method="post" enctype="multipart/form-data"  >
			<input type='hidden' name='edit_id' value="<?php echo $eid; ?>">
			<input type="text" name="edit_awdname" value="<?php echo $name; ?>" required>
			<input type="text" name="edit_awcat" value="<?php echo $ecat; ?>" required>
			<input type="text" name="edit_awyear" value="<?php echo $eyear; ?>" required>
			
			
			<select name="edit_series" id="edit_series"  required>
				<option value="<?php echo $seriesid; ?>" selected>&#91; Selected &#93; <?php echo $seriesname; ?></option>
<?php	
					$sql = "SELECT Series_ID, Series_Name FROM series;";
					$result = $conn->query($sql);
					 for($i=0; $row = $result->fetch_assoc(); $i++){

					?>						
					<option value="<?php echo $row['Series_ID']?>"><?php echo $row['Series_Name']?></option>
					<?php
					}	
?>		
			</select>			
			<input type="submit" name="edit_submit" value="EDIT">
		</form>
		
			
</div>
	
	
<?php }
if(isset($_POST["edit_submit"]))
{
$e_awd_id=$_POST['edit_id']; 
$e_name=$_POST["edit_awdname"];
$e_awdcat=$_POST["edit_awcat"];
$e_awdyr=$_POST["edit_awyear"];
$e_seriesid=$_POST['edit_series'];

            $sql4 = "UPDATE award SET Award_Name='$e_name',Award_Category= '$e_awdcat ' ,Award_Year= '$e_awdyr',Series_ID = '$e_seriesid'
			WHERE Award_ID = '$e_awd_id';"; 
             if(mysqli_query($conn, $sql4)){
					echo "<meta http-equiv='refresh' content='0'>";
					echo "Records added successfullyA.";
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
$sql5="DELETE FROM award WHERE Award_ID=$did";
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