<?php if(isset($_GET['identity'])){
include "connection.php";
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
		<title><?php echo $seriesname;?>- Gener</title>
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
			<a href="genre_series.php"  class="w3-bar-item w3-button w3-mobile">Genre</a>
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
	
	
	
	



<div id="body">
<h3><?php echo $seriesname;?>- Geners</h3>
<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($seriesposter).'" width=175 height=225 />'; ?>
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
	<br><br><table>
		<thead>
			<tr>
				<th>Series ID</th>
				<th>Series Name</th>
				<th>Genres</th>
				<th>Gener ID</th>
				<th>&nbsp &nbsp Operation</th>
			</tr>
		</thead>
<?php	
include "connection.php";
$sql = "SELECT series_genres.Series_ID,genres.Genres_Type,series_genres.Genres_ID,series.Series_Name
FROM series_genres 
INNER JOIN series
ON series.Series_ID = series_genres.Series_ID
INNER JOIN genres
ON genres.Genres_ID = series_genres.Genres_ID
WHERE series_genres.Series_ID='$seriesid'";
$result = $conn->query($sql);
 for($i=0; $row = $result->fetch_assoc(); $i++){

?>					


			<tr>
				<td><label><?php echo $row['Series_ID']; ?></label></td>
				<td><label><?php echo $row['Series_Name']; ?></label></td>
				<td><label><?php echo $row['Genres_ID']; ?></label></td>
			    <td><label><?php echo $row['Genres_Type']; ?></label></td>
				<td><br>
				<form method="post">
				<input type='hidden' name='deletegenid' value='<?php echo $row['Genres_ID']; ?>'>
				<input type='hidden' name='deletesiid' value='<?php echo $row['Series_ID']; ?>'>
						<input type="submit" name="Delete"
						class="button" value="DELETE" />&nbsp &nbsp &nbsp 
				</form><br>
				</td>
			</tr>

					<?php
}
						?>
	</table>
	
	<h3>Add Gener</h3>
		<form name="add_record" action="#" method="post" enctype="multipart/form-data"  >


<input type="text" disabled="disabled"  name="seriesnamea" value="<?php echo $seriesname;?>" required>
						<input type='hidden' name='series' value='<?php echo $seriesid; ?>'>			
			
			
			<select name="gen" id="gen" name="gen" required>
				<option value="-1" selected>Genres</option>
<?php	
				$sql = "SELECT * FROM genres;";
				$result = $conn->query($sql);
				 for($i=0; $row = $result->fetch_assoc(); $i++){

?>						
				<option value="<?php echo $row['Genres_ID']?>"><?php echo $row['Genres_Type']?></option>
					<?php
}
					?>	
					
			</select>	
			
			<input type="submit" name="add_gen" value="ADD">
		</form>


<?php
	
	if(isset($_POST["add_gen"]))
						{
						$g_seriesid=$_POST["series"];
						$g_genreid=$_POST["gen"];
						
 
if($g_genreid==-1)
{
 
    echo '<p>Genre is empty</p>';
 
}
else{
		
			$sql2 = "SELECT * FROM series_genres WHERE Series_ID='$g_seriesid' AND Genres_ID='$g_genreid' ";
			$results = mysqli_query($conn, $sql2);
			$rows = mysqli_num_rows($results);

			if ($rows !=0) {
			    echo '<p>This combination present </p>';
			}
			else{
				
			$sql3 = "INSERT into series_genres (Series_ID,Genres_ID) 
						VALUES ('$g_seriesid','$g_genreid')"; 
						 if(mysqli_query($conn, $sql3)){
				echo "Records added successfully.";
				echo "<meta http-equiv='refresh' content='0'>";
			} else{
				echo "ERROR: Could not able to execute $sql3. " . mysqli_error($conn);
			}
				
				
			}		
}
}	
	?>
	
	
		
<?php
if(isset($_POST["Delete"])){
$dsiid=$_POST["deletesiid"];
$dgenid=$_POST["deletegenid"];
$sql5="DELETE FROM series_genres WHERE Series_ID='$dsiid' AND Genres_ID='$dgenid' ";
if(mysqli_query($conn, $sql5)){
					echo "Records Deleteted successfully.";
					echo "<meta http-equiv='refresh' content='0'>";
			} 
			else{
				echo "ERROR: Could not able to execute $sql5. " . mysqli_error($conn);
				}
}


?>

</div>
<div class="footer">
	  <p>&nbsp Database Project Copyright &copy; 2021.</p>
	</div>
	
<body>

</body>
</html>	


<?php
}
?>