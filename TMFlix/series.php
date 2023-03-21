<!DOCTYPE HTML>
<html>
<head>
		<title>Series</title>
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
		<button class="w3-button"  >Sereis <i class="fa fa-caret-down"></i></button>
			<div class="w3-dropdown-content w3-bar-block w3-dark-grey">
			<a href="series.php " class="active" class="w3-bar-item w3-button w3-mobile">Series Info</a>
			<a href="genre_series.php" class="w3-bar-item w3-button w3-mobile">Genre</a>
			<a href="cast_series.php" class="w3-bar-item w3-button w3-mobile">Cast</a>
			<a href="director.php" class="w3-bar-item w3-button w3-mobile">Director</a>
			 <a href="award.php" class="w3-bar-item w3-button w3-mobile">Award</a>
			</div>
		</div>
		<a href="Subscription.php">Subscription </a>
		<a href="package.php" >Package</a>
		<a href="payment_history.php" >Payment</a>
		<a href="watch_history.php">Watch History</a>
		
		<div class="w3-dropdown-hover w3-mobile">
		<button class="w3-button"  >Report <i class="fa fa-caret-down"></i></button>
			<div class="w3-dropdown-content w3-bar-block w3-dark-grey">
			<a  href="top5.php" class="w3-bar-item w3-button w3-mobile">Top 5 Sereis</a>
			<a href="genre.php"  class="w3-bar-item w3-button w3-mobile">Gener Series</a>
			<a href="cast.php"  class="w3-bar-item w3-button w3-mobile">Actor Sereis</a> 
			</div>
		</div>	
		<a href="adminlogin.php">Logout</a>

	</div>


<div class="body">
		<h3>Series</h3>
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
				<th>Series_ID</th>
				<th>Series Name</th>
				<th>Country</th>
			    <th>Released Year</th>
				<th>Description</th>
				<th>Maturity Rating</th>
				<th>Quality&nbsp </th>
				<th>Seasons </th>  
				<th>&nbsp &nbsp Poster</th>
				<th>Rating</th>
				<th>&nbsp &nbsp Operation</th>
				<th>&nbsp &nbsp Go To</th>
			</tr>
		</thead>
<?php	
include "connection.php";
$sql = "SELECT series.Series_ID,series.Series_Name,series.Series_Country,series.Series_Release_Year,series.Series_Description,series.Series_Maturity_Rating,series.Series_Quality,series.Series_Total_Seasons,series.Series_Poster,series.Series_Rating
FROM series;";
$result = $conn->query($sql);
 for($i=0; $row = $result->fetch_assoc(); $i++){

?>					


			<tr>
				<td><label><?php echo $row['Series_ID']; ?></label></td>
				<td><label><?php echo $row['Series_Name']; ?></label></td>
				<td><label><?php echo $row['Series_Country']; ?></label></td>
			    <td><label><?php echo $row['Series_Release_Year']; ?></label></td>
				<td><label><?php echo $row['Series_Description']; ?></label></td>
				<td><label><?php echo $row['Series_Maturity_Rating']; ?></label></td>
				<td><label><?php echo $row['Series_Quality']; ?></label></td>
				<td><label><?php echo $row['Series_Total_Seasons']; ?></label></td>
				<td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['Series_Poster'] ).'" width=125 height=175 />'; ?></td>
				<td><label>&nbsp <?php echo $row['Series_Rating']; ?></label></td>
				<td>
				<form method="post">
						<input type='hidden' name='editid' value='<?php echo $row['Series_ID']; ?>'>
						<input type="submit" name="Edit"
						class="button" value="EDIT" />&nbsp &nbsp &nbsp 
				</form><br>
				
				<form method="post">
				<input type='hidden' name='deleteid' value='<?php echo $row['Series_ID']; ?>'>
						<input type="submit" name="Delete"
						class="button" value="DELETE" />&nbsp &nbsp &nbsp 
				</form>
				</td>
				<td>
				<a href ="seasons_episode.php? identity=<?php echo $row['Series_ID']?> "><button class="button button2">Seasons</button><br><br>
				<a href ="each_genre.php? identity=<?php echo $row['Series_ID']?> "><button class="button button2">Gener</button><br><br>
				<a href ="each_cast.php? identity=<?php echo $row['Series_ID']?> "><button class="button button2">Cast</button><br><br>
				<a href ="each_director.php? identity=<?php echo $row['Series_ID']?> "><button class="button button2">Director</button>
				</td>
			</tr>

					<?php
}
						?>
							
					
	</table>
		<h3>Insert Records</h3>
		<form name="add_record" action="#" method="post" enctype="multipart/form-data"  >
			<input type="text" name="seriesname" placeholder="Sereis Name" required>
			<input type="text" name="seriescountry" placeholder="Origin Country" required>			
			<input type="text" name="seriesreleaseyear" placeholder="Release Year" required>
			<input type="text" name="seriesmaturityrating" placeholder="Maturity Rating" required>
			<input type="text" name="seriesquality" placeholder="Quality" required>
			<input type="text" name="seriestotalseason" placeholder="Total Season" required>
			<input type="text" name="seriesrating" placeholder="Rating" required>
			<br>
			<textarea rows = "2" cols = "50" name = "seriesdescription" placeholder="Description" required></textarea><br>
			<label>Select Image File:</label><input type="file" name="myimage" />
			<input type="submit" name="reg_submit" value="ADD">
		</form>
			
</div>

<?php 
$message = "";
if(isset($_POST["reg_submit"]))
{
$name=$_POST["seriesname"];
$ctry=$_POST["seriescountry"];
$relyer=$_POST['seriesreleaseyear']; 
$des=$_POST["seriesdescription"];
$mr=$_POST["seriesmaturityrating"];
$qual=$_POST["seriesquality"];
$ts=$_POST["seriestotalseason"];
$rat=$_POST["seriesrating"];
$statusMsg=$status="";
$imagename=$_FILES["myimage"]["name"]; 

 
if(empty($imagename))
 
{
 
    echo '<p>Image is empty</p>';
 
}
else{
			

			//Get the content of the image and then add slashes to it 
			$imagetmp=addslashes (file_get_contents($_FILES['myimage']['tmp_name']));	
			// Insert image content into database 
			
            $sql = "INSERT into series (Series_Name, Series_Country, Series_Release_Year,Series_Description, Series_Maturity_Rating,Series_Quality,Series_Total_Seasons,Series_Rating,Series_Poster) 
			VALUES ('$name','$ctry','$relyer','$des','$mr','$qual','$ts','$rat','$imagetmp')"; 
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
	$eid=$_POST["editid"];

$sql = "SELECT series.Series_ID,series.Series_Name,series.Series_Country,series.Series_Release_Year,series.Series_Description,series.Series_Maturity_Rating,series.Series_Quality,series.Series_Total_Seasons,series.Series_Poster,series.Series_Rating
FROM series
WHERE Series_ID ='$eid';";
$result = $conn->query($sql);
 for($i=0; $row = $result->fetch_assoc(); $i++){
	 $eid2=$row['Series_ID'];
$name2=$row['Series_Name'];
$ctry2=$row['Series_Country'];
$relyer2=$row['Series_Release_Year']; 
$des2=$row['Series_Description'];
$mr2=$row['Series_Maturity_Rating'];
$qual2=$row['Series_Quality'];
$ts2=$row['Series_Total_Seasons'];
$rat2=$row['Series_Rating']; 
	?>
	
<div id="edit">
<h3>Edit Records</h3>
		<form name="Edit_form" action="#" method="post" enctype="multipart/form-data"  >
			<input type='hidden' name='editid2' value="<?php echo $eid2; ?>">
			<input type="text" name="seriesname" placeholder="Sereis Name" value="<?php echo $name2?>" required>
			<input type="text" name="seriescountry" placeholder="Origin Country" value="<?php echo $ctry2?>" required>
			<input type='hidden' name='gene' value="<?php echo $genid2; ?>">		
			<input type="textarea" name="seriesreleaseyear" placeholder="Release Year" value="<?php echo $relyer2?>" required>
			<input type="text" name="seriesmaturityrating" placeholder="Maturity Rating" value="<?php echo $mr2?>" required>
			<input type="text" name="seriesquality" placeholder="Quality" value="<?php echo $qual2?>" required>
			<input type="text" name="seriestotalseason" placeholder="Total Season" value="<?php echo $ts2?>" required>
			<input type="text" name="seriesrating" placeholder="Rating" value="<?php echo $rat2?>" required><br>
			<textarea rows = "2" cols = "50" name = "seriesdescription"><?php echo $des2?></textarea><br>
			<label>Select Image File:</label><input type="file" name="myimage2" />
			<input type="submit" name="edit_submit" value="EDIT">
		</form>
			
</div>
	
	
<?php }
}


if(isset($_POST["edit_submit"]))
{
$eid3=$_POST["editid2"];
$name3=$_POST["seriesname"];
$ctry3=$_POST["seriescountry"];
$relyer3=$_POST['seriesreleaseyear']; 
$des3=$_POST["seriesdescription"];
$mr3=$_POST["seriesmaturityrating"];
$qual3=$_POST["seriesquality"];
$ts3=$_POST["seriestotalseason"];
$rat3=$_POST["seriesrating"];
$imagename3=$_FILES["myimage2"]["name"]; 

 echo $eid3;
if(empty($imagename3))
{
	
			
            $sql4 = "UPDATE series SET Series_Name='$name3',Series_Country= '$ctry3' ,Series_Release_Year= '$relyer3' ,Series_Description='$des3',Series_Maturity_Rating='$mr3',Series_Quality='$qual3',Series_Total_Seasons='$ts3',Series_Rating='$rat3'
			WHERE Series_ID = '$eid3';"; 
             if(mysqli_query($conn, $sql4)){
					echo "Records added successfullyA.";
					echo "<meta http-equiv='refresh' content='0'>";
			} 
			else{
				echo "ERROR: Could not able to execute $sql4. " . mysqli_error($conn);
				}
 
    
 
}
else{
			

			//Get the content of the image and then add slashes to it 
			$imagetmp3=addslashes (file_get_contents($_FILES['myimage2']['tmp_name']));	
			
			// Insert image content into database 
			
            $sql4 = "UPDATE series SET Series_Name='$name3',Series_Country= '$ctry3' ,Series_Release_Year= '$relyer3' ,Series_Description='$des3',Series_Maturity_Rating='$mr3',Series_Quality='$qual3',Series_Total_Seasons='$ts3',Series_Rating='$rat3',Series_Poster='$imagetmp3' 
			WHERE Series_ID = '$eid3';"; 
             if(mysqli_query($conn, $sql4)){
					echo "Records added successfullyB.";
					echo "<meta http-equiv='refresh' content='0'>";
			} 
			else{
				echo "ERROR: Could not able to execute $sql4. " . mysqli_error($conn);
				}
}
}
?>

<?php
if(isset($_POST["Delete"])){
$did=$_POST["deleteid"];
echo $did;
$sql5="DELETE FROM series WHERE Series_ID=$did";
if(mysqli_query($conn, $sql5)){
					echo "Records Deleteted successfully.";
					echo "<meta http-equiv='refresh' content='0'>";
			} 
			else{
				echo "ERROR: Could not able to execute $sql5. " . mysqli_error($conn);
				}
}


?>

<div class="footer">
	  <p>&nbsp Database Project Copyright &copy; 2021.</p>
	</div>
	
<body>

<script>
function myFunction() {
  var x = document.getElementById("edit");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>

</body>
</html>