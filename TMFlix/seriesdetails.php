<?php
session_start();
if(isset($_GET['identity'])){
include "connection.php";
$seriesid = $_GET['identity'];
?>

 <!DOCTYPE html>
<html>
	<head>
	<title>Series Details</title>

	</head>
	
	
	<style>

body {
    font-family: sans-serif;
    background-color:darkgrey;
    background-repeat: no-repeat;
    background-attachment: fixed; 
    background-size: 100% 100%;
    height: 350vh;
}

footer{
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: #f62a00;
  color: white;
  text-align: center;
  padding-top: 5px;
}

#fot{
	color: #F8F7F1;
}

table tr td: {
  width: 100%;
}
  <!--empty-->
table tr td {
  padding-top: 8px;
  padding-bottom: 10px;
}
		#a6{
	text-decoration: none;
	float: right;
	background: #408EB9;
	padding: 10px 30px 10px 30px;
	color: #fff;
	border-radius: 5px;
	border: none;
	margin-top: -50px;
	right: 100px;
}
#a6:hover{
	opacity: .7;
}

	</style>
	
	
	<body>
<?php	
include "connection.php";
$sql = "SELECT series.Series_ID,series.Series_Name,series.Series_Country,series.Series_Release_Year,series.Series_Description,series.Series_Maturity_Rating,series.Series_Quality,series.Series_Total_Seasons,series.Series_Poster,series.Series_Rating
FROM series
WHERE Series_ID='$seriesid'";
$result = $conn->query($sql);
 for($i=0; $row = $result->fetch_assoc(); $i++){

?>					

<div header style = "background-color:darkgrey;">
<br><caption><h1><strong><?php echo $row['Series_Name']; ?></strong></strong></h1></caption></br>

<center><?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['Series_Poster'] ).'" width=225 height=275/>'; ?></center>
<table style="margin-left: 5px;" cellpadding="10px" cellspacing="10px">

	<tr>   
<tr>
<td colspan="5">Series Description: <?php echo $row['Series_Description']; ?></td>

</tr>	
<td>Maturity Ratings: <?php echo $row['Series_Maturity_Rating']; ?></td>
<td>Series Quality: <?php echo $row['Series_Quality']; ?></td>
<td>Series Rating: <?php echo $row['Series_Rating']; ?></td>
<td>Series Country: <?php echo $row['Series_Country']; ?></td>
<td>Seasons: <?php echo $row['Series_Total_Seasons']; ?></td>
 <?php }?>
 
 <td>Genres:&nbsp 
 <?php $sql5 = "SELECT genres.Genres_Type FROM genres
			JOIN series_genres ON series_genres.Genres_ID= genres.Genres_ID
			WHERE series_genres.Series_ID='$seriesid';";
					$result2 = $conn->query($sql5);
					 for($i=0; $row2 = $result2->fetch_assoc(); $i++){ ?>		
				<?php echo "$row2[Genres_Type],&nbsp ";  }?> </td>
 </tr>
 
 <tr>
<td colspan="2">Cast:  <?php $sql1 = "SELECT cast.Cast_Name FROM cast
JOIN series_cast ON series_cast.Cast_id= cast.Cast_ID
WHERE series_cast.Series_ID='$seriesid';";
					$result1 = $conn->query($sql1);
					 for($i=0; $row1 = $result1->fetch_assoc(); $i++){ ?>		
				<?php echo " &nbsp $row1[Cast_Name],&nbsp ";  }?> </td>

<td colspan="3">Director: <?php $sql1 = "SELECT director.Director_Name FROM director
JOIN series_director ON series_director.Director_id= director.Director_ID
WHERE series_director.Director_ID='$seriesid';";
					$result1 = $conn->query($sql1);
					 for($i=0; $row1 = $result1->fetch_assoc(); $i++){ ?>		
				<?php echo " &nbsp $row1[Director_Name],&nbsp ";  }?>  </td>

	</tr>
	<tr>
	<td colspan="4">Award: <?php $sql7 = "SELECT award.Award_Name,award.Award_Category,award.Award_Year
FROM award JOIN series ON series.Series_ID= award.Series_ID
WHERE series.Series_ID='$seriesid';";
					$result7 = $conn->query($sql7);
					 for($i=0; $row7 = $result7->fetch_assoc(); $i++){ ?>		
				<?php echo " &nbsp $row7[Award_Name] &nbsp-&nbsp $row7[Award_Category] ($row7[Award_Year]),&nbsp ";  }?>  </td>
	</tr>
</br>
</table>
<hr style="height:2px;border-width:0;color:gray;background-color:gray">		
		
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

		<h3>Season <?php echo $row['Season_Number']; ?></h3>
		<div id="episode_display">	
				<table id="epi">
					
					<?php	

					$sql5 = "SELECT * FROM episode WHERE Season_ID='$row[Season_ID]';";
					$result2 = $conn->query($sql5);
					 for($i=0; $row2 = $result2->fetch_assoc(); $i++){

					?>					


						<tr>
							
							<td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row2['Episode_Poster'] ).'" width=205 height=165 />'; ?></td>
							<td><label><b>&nbsp &nbsp <?php echo $row2['Episode_Number']; ?>&nbsp - &nbsp<?php echo $row2['Episode_Name']; ?> </b> <br><br>
									  &nbsp &nbsp <?php echo $row2['Episode_Description']; ?> <br>
									  &nbsp &nbsp Available since: <?php echo $row2['Episode_Availability']; ?><br>
									  &nbsp &nbsp Duration: <?php echo $row2['Episode_Duration']; ?>
							</label></td>
							
						</tr>

								<?php } ?>
				</table>	
<hr style="height:2px;border-width:0;color:gray;background-color:gray">					
			</div>	
		
				

					<?php
}
						?>
		



	<p><td><br><button id="a6" onclick="window.location.href='usermain2.php'">RETURN</button><br></td></p>
</div>
		
		
		
<footer>
	<center><p id="fot">Project Purpose Copyright@2021</p></center>
</footer>
 <?php }?>
 		
	</body>
		</html>
		
		
		