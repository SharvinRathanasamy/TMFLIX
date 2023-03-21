<?php
 session_start();
 error_reporting(0);
   // connect to the database
include "connection.php";
 
 
 if(isset($_GET['identity'])){
	 
	  $paymentid = $_GET['identity'];

 
$sql = "SELECT payment.Payment_Date,payment.Payment_Amount, user_account.User_Name,
payment_method.Payment_Method_Type,subscription.Subscription_Date,package.Package_Type
FROM payment
	INNER JOIN payment_method ON payment.Payment_Method_ID = payment_method.Payment_Method_ID
   INNER JOIN user_account ON payment.User_ID= user_account.User_ID
   INNER JOIN subscription ON user_account.User_ID = subscription.User_ID
   INNER JOIN package ON subscription.Package_ID = package.Package_ID
   WHERE payment.Payment_ID='$paymentid' AND package.Package_Price !='0.00'";
   $results = $conn->query($sql);
   for($i=0; $row = $results->fetch_assoc(); $i++) {
	   
	?>
<!DOCTYPE html>
<html>
	<head>
	<title>Receipt</title>

	</head>
	
	
	<style>
	
body{
	background-color: aliceblue;
	background-size: cover;
	background-position: center;
}

#a2{
	text-decoration: none;
	float: right;
	background: #408EB9;
	padding: 10px 15px 10px;
	color: #fff;
	border-radius: 5px;
	margin-right: 975px;
	border: none;
	margin-top: -247px;
}
#a2:hover{
	opacity: .7;
}

#a3{
	text-decoration: none;
	float: right;
	background: #408EB9;
	padding: 10px 30px 10px 30px;
	color: #fff;
	border-radius: 5px;
	margin-right: 820px;
	border: none;
	margin-top: -230px;
}
#a3:hover{
	opacity: .7;
}
	

fieldset{
	margin-top: 100px;
	box-shadow: 2px 2px 4px #000000;
	background-color:white;
	border: 0;
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
		

	</style>
	
	
	<body>
<div>
<fieldset style="width: 350px; height: 590px; align-content: center; margin-left: 180px;margin-bottom:240px;margin-top:50px; display: block;">
<form id="userdet" name="userdet">
<table border="0" style="font-family:verdana;">

<h1 style="font-family: verdana; font-weight: bolder;font-size:30px;color:red;" align="left">TMFlix</h1>
<caption style="font-family: verdana; font-weight: bolder;font-size:20px;" align="center">Receipt </br></br> <p>____________________________</p></caption>

<tr>
<p><td><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name:&nbsp;&nbsp; <?php echo $row['User_Name'];?></td><td><br></td></p></tr>

<tr>
<p><td><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Payment Date:&nbsp;&nbsp;<?php echo $row['Payment_Date'];?></td><td><td></td></td></p></tr>

<tr>
	<p><td><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Package Type:&nbsp;&nbsp;<?php echo $row['Package_Type'];?></td><td><td></td></td></p></tr>
	
<tr>
	<p><td><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Payment Method:&nbsp;&nbsp;<?php echo $row['Payment_Method_Type'];?></td><td><td></td></td></p></tr>	
<tr>	
	<td><p style="font-size:20px;font-weight:bolder;">&nbsp;&nbsp;____________________________</p></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td></p></tr>	
<tr>
<p><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Sum:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?php echo $row['Payment_Amount'];?></b></td><td></br></td></p></tr>
<tr>
<p><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Grand Total:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?php echo $row['Payment_Amount'];?></b></td><td></td></p></tr>

<tr>
<p><td><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Amount Paid:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;<?php echo $row['Payment_Amount'];?></b></td><td></br></br></td></p></tr>
	  <?php
	  
	 }
 }
  
  ?>

  		
</table>

</form>
</fieldset>
	
	<p><td><br><button id="a3" onclick="window.location.href='Payment history.php'">RETURN</button></td><td><br><button id="a2" onclick="window.print()">PRINT RECEIPT</button></td></p>
		</div>	
		
		
		
<footer>
	<center><p id="fot">Project Purpose Copyright@2021</p></center>
</footer>
		
	</body>
		</html>