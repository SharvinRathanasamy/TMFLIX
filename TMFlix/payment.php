<?php 
session_start();
include "connection.php";
	$_SESSION['User_ID'];
	$userid=$_SESSION['User_ID'];
	$date= date("Y-m-d");  
	
	
	$sql = "SELECT user_account.User_ID, user_account.User_Name, package.Package_Type,package.Package_Price, subscription.	Subscription_Date
FROM user_account
INNER JOIN subscription
ON subscription.User_ID=user_account.User_ID
	INNER JOIN (SELECT subscription.User_ID, MAX(subscription.Subscription_ID) AS sub
	FROM subscription 
	GROUP BY subscription.User_ID)
	AS NewSUB
	ON subscription.User_ID=NewSUB.User_ID
	AND subscription.Subscription_ID = NewSUB.sub
INNER JOIN 	package
ON subscription.Package_ID= package.Package_ID
WHERE user_account.User_ID='$userid'
ORDER BY user_account.User_ID;";
$result = $conn->query($sql);
 for($i=0; $row = $result->fetch_assoc(); $i++){
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Payment</title>
	<link rel="stylesheet" href="login.css">
	<script src="myform.js"></script>
</head>
<body >
	<div class="div_header" ><h1>TMFlix</h1></div>
	<div class="form">
	<table border="0" style="font-family:verdana;">
<p>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?php echo $date;?></p>
<h1 style="font-family: verdana; font-weight: bolder;font-size:30px;color:red;" align="left">TMFlix</h1>

<caption style="font-family: verdana; font-weight: bolder;font-size:20px;" align="center">Payment<p>____________________________</p></caption>

<tr>
<p><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name:&nbsp;&nbsp; <?php echo $row['User_Name'];?></td><td><br></td></p></tr>

<tr>
<p><td><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Subscription Date:&nbsp;&nbsp;<?php echo $row['Subscription_Date'];?></td><td><td></td></td></p></tr>

<tr>
	<p><td><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Package Type:&nbsp;&nbsp;<?php echo $row['Package_Type'];?></td><td><td></td></td></p></tr>
		
	<td><p style="font-size:20px;font-weight:bolder;">&nbsp;&nbsp;____________________________</p></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td></p></tr>	
<tr>
<p><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Sum:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?php echo $row['Package_Price'];?></b></td><td></br></td></p></tr>
<tr>
<p><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Grand Total:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?php echo $row['Package_Price'];?></b></td><td></td></p></tr>

<tr>  		
</table>
<br>
<form form name="payment" action="#" method="post" enctype="multipart/form-data" >

					<input type='hidden' name='userid' value='<?php echo $row['User_ID']; ?>'>
					<input type='hidden' name='paydate' value='<?php echo $date; ?>'>
					<input type='hidden' name='payprice' value='<?php echo $row['Package_Price']; ?>'>
					
				<center><select name="paymethod" id="paymethod" name="paymethod" required>
				<option value="-1" selected>&#91;Payment Method&#93;</option>
					<?php	
					$sql = "SELECT * FROM payment_method;";
					$result = $conn->query($sql);
					for($i=0; $row = $result->fetch_assoc(); $i++){

					?>						
							<option value="<?php echo $row['Payment_Method_ID']?>"><?php echo $row['Payment_Method_Type']?></option>
								<?php
					}

								?>	
					
			</select></center>
<br>
						
						<center><input type="submit" value="Pay" name="pay"></center>
			
	</form>
 <?php }?>
 
 <?php
 	if(isset($_POST["pay"]))
						{
						$p_uid=$_POST["userid"];
						$p_method=$_POST["paymethod"];
						$p_date=$_POST["paydate"];
						$p_amt=$_POST['payprice']; 
						
 
if($p_method==-1)
 
{
 
    echo '<p>Payment Method is empty</p>';
 
}
else{
			
            $sql = "INSERT into payment (User_ID, Payment_Method_ID, Payment_Date,Payment_Amount) 
			VALUES ('$p_uid','$p_method','$p_date','$p_amt')"; 
             if(mysqli_query($conn, $sql)){
					echo "Payment successful.";
					
					$sql2 = "SELECT max(Payment_ID) as id from payment where User_ID='$p_uid';";
					$result2 = $conn->query($sql2);
					for($i=0; $row = $result2->fetch_assoc(); $i++){
					$pay_id = $row['id'];
					echo $pay_id;	
					
					$_SESSION['Payment_ID'] = $pay_id;
					header('location: printreceipt.php');
					}
			} 
			else{
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
				}
				
			 
					
					
}
}
 
 ?>

		
	</div>
</body>
</html>