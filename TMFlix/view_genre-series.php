<?php if(isset($_GET['identity'])){
include "connection.php";
$ID = $_GET['identity'];
$sql = "SELECT Genres_Type, Genres_ID FROM genres WHERE Genres_ID='$ID';";
$result = $conn->query($sql);
 for($i=0; $row = $result->fetch_assoc(); $i++){
	 $name = $row['Genres_Type'];
	 $id = $row['Genres_ID'];
 }

?>
<!DOCTYPE HTML>
<html>
<head>
		<title><?php echo $name;?>- Gener-Series</title>
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
			<a href="series.php"  class="w3-bar-item w3-button w3-mobile">Series Info</a>
			<a href="genre_series.php" class="active"  class="w3-bar-item w3-button w3-mobile">Genre</a>
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
<h3><?php echo $name;?></h3>
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
				<th>Poster</th>
			</tr>
		</thead>
<?php	
include "connection.php";
$sql = "SELECT series_genres.Series_ID,series.Series_Name,series.Series_Poster
FROM series_genres 
INNER JOIN series
ON series.Series_ID = series_genres.Series_ID
INNER JOIN genres
ON genres.Genres_ID= series_genres.Genres_ID
WHERE series_genres.Genres_ID='$ID'";
$result = $conn->query($sql);
 for($i=0; $row = $result->fetch_assoc(); $i++){

?>					


			<tr>
				<td><label><?php echo $row['Series_ID']; ?></label></td>
				<td><label><?php echo $row['Series_Name']; ?></label></td>
				<td><label><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['Series_Poster'] ).'" width=175 height=225 />'; ?></label></td>
				</td>
			</tr>

					<?php
}
						?>
	</table>
	
	
	<div class="footer">
	  <p>&nbsp Database Project Copyright &copy; 2021.</p>
	</div>
	
<body>

</body>
</html>	


<?php
}
?>