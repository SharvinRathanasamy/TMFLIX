<?php

if(isset($_GET['identity'])){
include "connection.php";	
	
	if(isset($_POST["add_epi"]))
						{
						$epinum1=$_POST["episodenum"];
						$epiname1=$_POST["episodename"];
						$epises1=$_POST["episodeseason"];
						$epiav1=$_POST['episodeavailability']; 
						$epidu1=$_POST["episodeduration"];
						$epidesc1=$_POST["episodedescription"];
						$imagename=$_FILES["epimg"]["name"]; 

						 
						if(empty($imagename))
						 
						{
						 
							echo '<p>Image is empty</p>';
						 
						}
						else{
									

									//Get the content of the image and then add slashes to it 
									$imagetmp=addslashes (file_get_contents($_FILES['epimg']['tmp_name']));	
									// Insert image content into database 
									
									$sql6 = "INSERT into episode (Episode_Number, Episode_Name, Episode_Description, Season_ID, Episode_Availability, Episode_Duration, Episode_Poster) 
									VALUES ('$epinum1','$epiname1','$epidesc1','$epises1','$epiav1','$epidu1','$imagetmp')"; 
									 if(mysqli_query($conn, $sql6)){
										 echo "<meta http-equiv='refresh' content='0'>";
											echo "Records added successfully.";
									} 
									else{
										echo "ERROR: Could not able to execute $sq6. " . mysqli_error($conn);
										}
										
									
						}
					}
	
	
if(isset($_POST["edit_epi2"]))
{
					$eid3=$_POST["episodeid2"];
					$num3=$_POST["episodenum2"];
					$name3=$_POST["episodename2"];
					$season3=$_POST["episodeseason2"];
					$av3=$_POST["episodeavailability2"];
					$du3=$_POST['episodeduration2']; 
					$desc3=$_POST["episodedescription"];
					$imagename3=$_FILES["epimg5"]["name"]; 

					 echo $eid3;
					if(empty($imagename3))
					{
						
								
								$sql7 = "UPDATE episode SET Episode_Number='$num3',Episode_Name= '$name3' ,Episode_Description= '$desc3' ,Season_ID='$season3',Episode_Availability='$av3',Episode_Duration='$du3'
								WHERE Episode_ID = '$eid3';"; 
								 if(mysqli_query($conn, $sql7)){
										echo "Records added successfullyA.";
										echo "<meta http-equiv='refresh' content='0'>";
								} 
								else{
									echo "ERROR: Could not able to execute $sql7. " . mysqli_error($conn);
									}
					 
						
					 
					}
					else{
								

								//Get the content of the image and then add slashes to it 
								$imagetmp3=addslashes (file_get_contents($_FILES['epimg5']['tmp_name']));	
								
								// Insert image content into database 
								
								$sql7 = "UPDATE episode SET Episode_Number='$num3',Episode_Name= '$name3' ,Episode_Description= '$desc3' ,Season_ID='$season3',Episode_Availability='$av3',Episode_Duration='$du3',Episode_Poster='$imagetmp3'
								WHERE Episode_ID = '$eid3';"; 
								 if(mysqli_query($conn, $sql7)){
										echo "Records added successfullyB.";
										echo "<meta http-equiv='refresh' content='0'>";
								} 
								else{
									echo "ERROR: Could not able to execute $sql7. " . mysqli_error($conn);
									}
					}		
}


if(isset($_POST["epi_Delete"])){
$did2=$_POST["delet_ep_id"];
$sql9="DELETE FROM episode WHERE Episode_ID=$did2";
if(mysqli_query($conn, $sql9)){
					echo "Records Deleteted successfully.";
					echo "<meta http-equiv='refresh' content='0'>";
					
			} 
			else{
				echo "ERROR: Could not able to execute $sql9. " . mysqli_error($conn);
				}
}
	

$seriesid = $_GET['identity'];
$sql = "SELECT Series_Name, Series_Poster FROM series WHERE Series_ID= '$seriesid';";
$result = $conn->query($sql);
 for($i=0; $row = $result->fetch_assoc(); $i++){
	 $seriesname = $row['Series_Name'];
	 $seriesposter = $row['Series_Poster'];
 }
?>

<!DOCTYPE HTML>
<html>
<head>
		<title>Season And Episode</title>
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
		<button class="w3-button" >Sereis <i class="fa fa-caret-down"></i></button>
			<div class="w3-dropdown-content w3-bar-block w3-dark-grey">
			<a href="series.php"  class="active" class="w3-bar-item w3-button w3-mobile">Series Info</a>
			<a href="genre_series.php" class="w3-bar-item w3-button w3-mobile">Genre</a>
			<a href="cast_series.php" class="w3-bar-item w3-button w3-mobile">Cast</a>
			<a href="director.php"   class="w3-bar-item w3-button w3-mobile">Director</a>
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
	
	
	
	
	
	
	<div class="body">
	
		<h1><?php echo $seriesname;?>- Seasons</h1>
			<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($seriesposter).'" width=175 height=225 />'; ?>
		

		
<?php	
			$sql = "SELECT season.Season_ID,season.Season_Number, series.Series_Name, season.Series_ID
			FROM season
			INNER JOIN series ON season.Series_ID= series.Series_ID
			WHERE series.Series_ID= '$seriesid';";
			$result = $conn->query($sql);
			 for($i=0; $row = $result->fetch_assoc(); $i++){
				 $a =$row['Season_ID'];
				 $b =$row['Season_Number'];

?>					

		<h2>Season_ID: <?php echo $row['Season_ID']; ?> - Season <?php echo $row['Season_Number']; ?></h2>
				
				<br>
						<form method="post">
								<input type='hidden' name='editse1' value='<?php echo $row['Season_ID']; ?>'>
								<input type='hidden' name='editse2' value='<?php echo $row['Season_Number']; ?>'>
								<input type='hidden' name='editsi1' value='<?php echo $row['Series_ID']; ?>'>
								<input type='hidden' name='editsi2' value='<?php echo $row['Series_Name']; ?>'>
								<input type="submit" name="Edit"
								class="button" value="EDIT-Season"  />&nbsp &nbsp &nbsp 
						</form><br>
						
						<form method="post">
						<input type='hidden' name='d_seasonid' value='<?php echo $row['Season_ID']; ?>'>
								<input type="submit" name="Delete"
								class="button" value="DELETE-Season" />&nbsp &nbsp &nbsp 
						</form>
				<br>
				<br>
		<div id="episode_display">
				<h5><b>Episodes</b></h5>
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
							<th>Episode ID</th>
							<th>Episode Number</th>
							<th>Episode Name</th>
							<th>Episode Description</th>
							<th>Episode Availability</th>
							<th>Episode Duration</th>  
							<th>Poster</th>
							<th>Operation</th>
						</tr>
					</thead>
					
					<?php	

					$sql5 = "SELECT * FROM episode WHERE Season_ID='$row[Season_ID]';";
					$result2 = $conn->query($sql5);
					 for($i=0; $row2 = $result2->fetch_assoc(); $i++){

					?>					


						<tr>
							<td><label><?php echo $row2['Episode_ID']; ?></label></td>
							<td><label><?php echo $row2['Episode_Number']; ?></label></td>
							<td><label><?php echo $row2['Episode_Name']; ?></label></td>
							<td><label><?php echo $row2['Episode_Description']; ?></label></td>
							<td><label><?php echo $row2['Episode_Availability']; ?></label></td>
							<td><label><?php echo $row2['Episode_Duration']; ?></label></td>
							<td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row2['Episode_Poster'] ).'" width=175 height=125 />'; ?></td>
							<td>
							<form method="post">
									<input type='hidden' name='edit_ep_se' value='<?php echo $row2['Season_ID']; ?>'>
									<input type='hidden' name='edit_ep_id' value='<?php echo $row2['Episode_ID']; ?>'>
									<input type='hidden' name='edit_ep_num' value='<?php echo $row2['Episode_Number']; ?>'>
									<input type='hidden' name='edit_ep_name' value='<?php echo $row2['Episode_Name']; ?>'>
									<input type='hidden' name='edit_ep_desc' value='<?php echo $row2['Episode_Description']; ?>'>
									<input type='hidden' name='edit_ep_av' value='<?php echo $row2['Episode_Availability']; ?>'>
									<input type='hidden' name='edit_ep_du' value='<?php echo $row2['Episode_Duration']; ?>'>
									<input type='hidden' name='sn' value='<?php echo $b; ?>'>
									
									<input type="submit" name="epi_Edit"
									class="button" value="EDIT Episode" />&nbsp &nbsp &nbsp 
							</form><br>
							
							<form method="post">
									<input type='hidden' name='delet_ep_id' value='<?php echo $row2['Episode_ID']; ?>'>
									<input type="submit" name="epi_Delete"
									class="button" value="DELETE Episode" />&nbsp &nbsp &nbsp 
							</form><br>
							
						
							</td>
						</tr>

								<?php } ?>
				</table>
				
							<form method="post">
									<input type='hidden' name='add_epi_id' value='<?php echo $a; ?>'>
									<input type='hidden' name='add_epi_sn' value='<?php echo $b; ?>'>
									<input type="submit" name="epi_add1"
									class="button" value="ADD Episode" />
							</form>
				
			</div>	
		
		<hr style="height:2px;border-width:0;color:gray;background-color:gray">			

					<?php
}
						?>
		

		
		<div class="add_season">
		
					<h3>Add Season</h3>
					<form name="add_record" action="#" method="post" enctype="multipart/form-data"  >
						<input type="text" disabled="disabled"  name="seriesnamea" value="<?php echo $seriesname;?>" required>
						<input type='hidden' name='seriesida' value='<?php echo $seriesid; ?>'>
						<input type="text" name="seasonnum" placeholder="Season Number here" required>
						
						<input type="submit" name="add_season" value="ADD">
					</form>
		</div>
	
	<?php 
$message = "";
if(isset($_POST["add_season"]))
{
$seasonid1=$_POST["seasonnum"];
$seriesid1=$_POST["seriesida"];
echo $seriesid1;
            $sql4 = "INSERT into season (Season_Number,Series_ID) 
			VALUES ('$seasonid1','$seriesid1')"; 
             if(mysqli_query($conn, $sql4)){
					echo "Records added successfully.";
					echo "<meta http-equiv='refresh' content='0'>";
			}
			else{
				echo "ERROR: Could not able to execute $sql4. " . mysqli_error($conn);
				}
}
?>







<?php
if(isset($_POST["Edit"])){
	$eseasonid2=$_POST["editse1"];
	$eseasonnum=$_POST["editse2"];
	$eseriesid2=$_POST["editsi1"];
	$eseriesname2=$_POST["editsi2"];

	?>
	
<div id="edit">
<h3>Edit Season</h3>
		<form name="Edit_form" action="#" method="post" enctype="multipart/form-data"  >
			<input type="text" name="seriesnameae" value="<?php echo $eseriesname2;?>" disabled>
					<input type="hidden" name="seriesnameae2" value="<?php echo $eseriesname2;?>">
					<input type='hidden' name='serieside2' value='<?php echo $eseriesid2; ?>'>
			
			<input type="text" name="seasonnume2" value='<?php echo $eseasonnum; ?>'>
					<input type='hidden' name='seasonide2' value='<?php echo $eseasonid2; ?>'>
			<input type="submit" name="edit_submit" value="EDIT">
		</form>
			
</div>
	
	
<?php }



if(isset($_POST["edit_submit"]))
{
$enamesi=$_POST["seriesnameae2"];
$eidsi=$_POST["serieside2"];
$esenum=$_POST["seasonnume2"];
$eseid=$_POST["seasonide2"];

echo $enamesi;
echo $eidsi;
echo $esenum;
echo $eseid;
	
	
			
		$sql2 = "UPDATE season SET Season_Number='$esenum' 
		WHERE Season_ID = '$eseid' AND Series_ID = '$eidsi';"; 
             if(mysqli_query($conn, $sql2)){
					echo "Records edited successfully.";
					echo "<meta http-equiv='refresh' content='0'>";
			}
			else{
				echo "ERROR: Could not able to execute $sql2. " . mysqli_error($conn);
				}

}
?>

<?php
if(isset($_POST["Delete"])){
$did=$_POST["d_seasonid"];
echo $did;
$sql3="DELETE FROM season WHERE Season_ID=$did";
if(mysqli_query($conn, $sql3)){
					echo "Records Deleteted successfully.";
					echo "<meta http-equiv='refresh' content='0'>";
			} 
			else{
				echo "ERROR: Could not able to execute $sql3. " . mysqli_error($conn);
				}
}


?>








	
	
	
	
	
	</div>
	
	
	
		<!-- ADD episode -->


<?php
if(isset($_POST["epi_add1"])){
	$epseasonid3=$_POST["add_epi_id"];
	$epseasonnum3=$_POST["add_epi_sn"];
	?>


<h3>Add Episode - Season <?php echo $epseasonnum3; ?></h3>
					<form name="addepi" action="#" method="post" enctype="multipart/form-data"  >	
						<input type="text" name="episodenum" placeholder="Episode Number" required>
						<input type="text" name="episodename" placeholder="Episode Title" required>
						<input type="text" name="episodeseason" value="<?php echo $epseasonid3; ?>" required>
						<input type="text" name="episodeavailability" placeholder="YYYY-MM-DD" required>
						<input type="text" name="episodeduration" placeholder="Duration (_min/_hr _min)" required>
						<br>
						<textarea rows = "2" cols = "50" name = "episodedescription" placeholder="Episode Description" required></textarea><br>
						<label>Select Image File:</label><input type="file" name="epimg" />
						<input type="submit" name="add_epi" value="ADD Epi">
					</form>
					
<?php
			
}


?>


	<!-- ADD episode -->


<?php
if(isset($_POST["epi_Edit"])){
	$epseasonid4=$_POST["edit_ep_se"];
	$epid4=$_POST["edit_ep_id"];
	$epnum4=$_POST["edit_ep_num"];
	$epname4=$_POST["edit_ep_name"];
	$epdesc4=$_POST["edit_ep_desc"];
	$epav4=$_POST["edit_ep_av"];
	$epdu4=$_POST["edit_ep_du"];
	$sesnum=$_POST["sn"];
	?>


<h3>Edit Episode - Season <?php echo $sesnum; ?></h3>
					<form name="addepi" action="#" method="post" enctype="multipart/form-data"  >	
						<input type="text" name="episodenum2" value="<?php echo $epnum4; ?>" required>
						<input type="text" name="episodename2" value="<?php echo $epname4; ?>" required>
						<input type="text" name="episodeseason2" value="<?php echo $epseasonid4; ?>" required>
						<input type="text" name="episodeavailability2" value="<?php echo $epav4; ?>" required>
						<input type="text" name="episodeduration2" value="<?php echo $epdu4; ?>" required>
						<br>
						<input type='hidden' name='episodeid2' value='<?php echo $epid4; ?>'>
						
						<textarea rows = "2" cols = "50" name = "episodedescription" required><?php echo $epdesc4; ?></textarea><br>
						<label>Select Image File:</label><input type="file" name="epimg5" />
						<input type="submit" name="edit_epi2" value="EDIT Episode">
					</form>
					
<?php

}

?>

	
<body>

</body>
<?php } ?>
</html>
</div>	
	<div class="footer">
	  <p>&nbsp Database Project Copyright &copy; 2021.</p>
	</div>