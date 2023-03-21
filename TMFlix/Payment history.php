<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="style.css">
        <title>Payment History</title>
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
	<style>
.button {
  background-color: #A8A9AD;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius:8px;
}

</style>	

		<footer><center>
		<p id="fot"> Project Purpose Copyright@2021</p></center>
		</footer>	
		
		<div>
		<h1 id="logo" style="color:white; font-weight:bolder;">
			</h1>
		</div>
		
		<div >
		 <h1 id="Title"><strong>Payment History</strong></h1>
          </div>

	<table id="rate">
	
  <tr>
    <th>Payment Date</th>
    <th>Print Receipt</th>
	
	
	</tr>
<?php
 session_start();
 error_reporting(0);
 
 
 // connect to the database
include "connection.php";
 
 if (isset($_SESSION['User_ID'])) {
    $userid = $_SESSION['User_ID'];
	
$sql = "SELECT * FROM payment WHERE User_ID= '$userid'";
$results = $conn->query($sql);
if ($results->num_rows > 0){
   while ($row = $results-> fetch_assoc()){
	?>
  <tr>
    <td><?php echo $row['Payment_Date']; ?></td>
	<td><a href ="Receipt.php? identity=<?php echo $row['Payment_ID']?> ">Click Here <?php echo $row['Payment_ID']?></td>
  </tr>	
<?php 
	
   }
}
  else {
	  echo "No Results";
  }
  $conn->close();
  }
  
  ?>
</table>				
	<style>
.button {
  background-color: #A8A9AD;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius:8px;
}

</style>	

		<footer><center>
		<p id="fot"> Project Purpose Copyright@2021</p></center>
		</footer>	
</body>
</html>