<!DOCTYPE HTML>
<html>
<head>
		<title>User Watch History</title>
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
		<a href="Subscription.php" >Subscription </a>
		<a href="package.php" >Package</a>
		<a href="payment_history.php" >Payment</a>
		<a href="watch_history.php" class="active">Watch History</a>
		
		<div class="w3-dropdown-hover w3-mobile">
		<button class="w3-button"  >Report <i class="fa fa-caret-down"></i></button>
			<div class="w3-dropdown-content w3-bar-block w3-dark-grey">
			<a  href="top5.php"  class="w3-bar-item w3-button w3-mobile">Top 5 Sereis</a>
			<a href="genre.php"  class="w3-bar-item w3-button w3-mobile">Gener Series</a>
			<a href="cast.php"  class="w3-bar-item w3-button w3-mobile">Actor Sereis</a> 
			</div>
		</div>	
		<a href="adminlogin.php">Logout</a>

	</div>
		

		<div class="Recent watch History">
		<h3>Recent watch History</h3>
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
				<th>&nbsp &nbsp User ID</th>
				<th>User Name</th>
				<th>Episode Number</th>
				<th>Episode Name</th>
			    <th>Season Number</th>
				<th>Series Name</th>
				<th>Watched StopTime</th>
			</tr>
		</thead>
<?php	
include "connection.php";
$sql = "SELECT user_account.User_ID,user_account.User_Name,episode.Episode_Number,episode.Episode_Name,season.Season_Number,series.Series_Name,recent_watched_history.Watched_StopTime
FROM recent_watched_history
INNER JOIN user_account ON recent_watched_history.User_ID= user_account.User_ID
INNER JOIN (SELECT recent_watched_history.User_ID, MAX(recent_watched_history.id_w) AS sub
	FROM recent_watched_history
	GROUP BY recent_watched_history.User_ID)
	AS NewSUB
	ON recent_watched_history.User_ID=NewSUB.User_ID
	AND recent_watched_history.id_w = NewSUB.sub
	INNER JOIN episode ON recent_watched_history.Episode_ID= episode.Episode_ID
	INNER JOIN season ON season.Season_ID= episode.Season_ID
	INNER JOIN series ON series.Series_ID= season.Series_ID
	ORDER BY recent_watched_history.User_ID;";
$result = $conn->query($sql);
 for($i=0; $row = $result->fetch_assoc(); $i++){

?>					


			<tr>
				<td><label>&nbsp &nbsp <?php echo $row['User_ID']; ?></label></td>
				<td><label><?php echo $row['User_Name']; ?></label></td>
				<td><label><?php echo $row['Episode_Number']; ?></label></td>
				<td><label><?php echo $row['Episode_Name']; ?></label></td>
				<td><label><?php echo $row['Season_Number']; ?></label></td>
			    <td><label><?php echo $row['Series_Name']; ?></label></td>
			    <td><label><?php echo $row['Watched_StopTime']; ?></label></td>
				<td>
			</tr>

					<?php
}
						?>
		</table>
		</div>
	
	<div class="Series Watch History">
		<h3>Series History</h3>
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
				<th>&nbsp &nbsp User ID</th>
				<th>User Name</th>
				<th>Series ID</th>
				<th>Series Name</th>
			    <th>Watched Date</th>
			</tr>
		</thead>
				<?php	
				include "connection.php";
				$sql = "SELECT user_watch_series.User_ID, user_account.User_Name, user_watch_series.Series_ID, series.Series_Name, user_watch_series.Watch_Date
				FROM user_watch_series
				INNER JOIN user_account
				ON user_watch_series.User_ID = user_account.User_ID
				INNER JOIN series
				ON user_watch_series.Series_ID= series.Series_ID
				ORDER BY user_watch_series.User_ID";
				$result = $conn->query($sql);
				 for($i=0; $row = $result->fetch_assoc(); $i++){

				?>					


			<tr>
				<td><label>&nbsp &nbsp <?php echo $row['User_ID']; ?></label></td>
				<td><label><?php echo $row['User_Name']; ?></label></td>
				<td><label><?php echo $row['Series_ID']; ?></label></td>
				<td><label><?php echo $row['Series_Name']; ?></label></td>
				<td><label><?php echo $row['Watch_Date']; ?></label></td>
				<td>
			</tr>

					<?php
}
						?>
		</table>
		</div>
<body>
<div class="footer">
	  <p>&nbsp Database Project Copyright &copy; 2021.</p>
	</div>
</body>

</html>	