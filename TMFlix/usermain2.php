<?php 
session_start();
	$_SESSION['User_ID'];
	require("connection.php");
	$sql="SELECT  series.Series_ID, series.Series_Poster,COUNT(user_watch_series.Series_ID) as nums
	FROM user_watch_series
	JOIN series 
	ON series.Series_ID=user_watch_series.Series_ID 
	WHERE `Watch_Date` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) 
	GROUP BY series.Series_Name
	ORDER BY COUNT(user_watch_series.Series_ID) DESC
	LIMIT 5;";
	$result = $conn->query($sql);
			 for($i=0; $row = $result->fetch_assoc(); $i++){
			 $poster[]=$row['Series_Poster'];
			 $series_id[]=$row['Series_ID'];}
			
			
 ?>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="javascript.js"></script>
        <title>Home</title>
    </head>
	
    <body>
        <header style="background-color:#ffffff00;">
           <img src="tv icon.png" alt="icon">
	   <p id="v">TMFlix</p>
            <nav class="nav--top" >
                <ul>
                    <li><a href="usermain2.php">Home</a></li>
		    <li><a href="pre_payment_history.php"> View Payment History</a></li>
                    <li><a href="pre_payment.php">Payment</a></li>
                    <li><a href="login.html">Logout</a></li>
								
                </ul>
				
            </nav>
        </header>
		
		<div>
		<h1 id="logo" style="color:white; font-weight:bolder;">
			<marquee>Welcome to TMFlix </marquee>
			</h1>
		</div>
		

		<div >
		 <h1 id="Title"><strong>TOP 5 Series</strong></h1>
          </div>

	<!-- Slideshow container -->
			<div class="slideshow-container">
<?php
				$alt=1;
				 foreach(array_combine($series_id, $poster) as $series_id => $poster) {
				  
?>			
					<a href ="seriesdetails.php? identity=<?php echo $series_id?> ">
							<!-- Full-width images with number and caption text -->
							<div class="mySlides face" style="display: block;"><center>
							
							
							<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $poster).'" width=50% height=50% />';?>
							
							 </center></div>
					 </a>
<?php }  ?>
 			 <!-- Next and previous buttons -->
  			<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
			  <a class="next" onclick="plusSlides(1)">&#10095;</a>
		</div>
		 </br>

				<!-- The dots/circles -->
				<div style="text-align:center">
 				 <span class="dot" onclick="currentSlide(1)"></span>
 				 <span class="dot" onclick="currentSlide(2)"></span>
 				 <span class="dot" onclick="currentSlide(3)"></span>
				 <span class="dot" onclick="currentSlide(4)"></span>
				 <span class="dot" onclick="currentSlide(5)"></span>
		 </div>
		
		
		<footer><center>
		<p id="fot"> Project Purpose Copyright@2021</p></center>
		</footer>

<style>

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;

  margin-top: 10px;
  margin-left: auto;
  margin-right: auto;
  margin-bottom:auto;
}


/* Hide the images by default*/
.mySlides {
  display: none;
}

img {
  vertical-align: middle;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  margin-top: -22px;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}


/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

@media only screen and (max-width: 300px) {
  .prev,
  .next,
  .text {
    font-size: 11px
  }
}
	</style>

</body>
</html>