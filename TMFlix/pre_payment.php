<?php 
session_start();
include "connection.php";
	$_SESSION['User_ID'];
	$userid=$_SESSION['User_ID'];

$sql="SELECT user_account.User_ID, user_account.User_Name,package.Package_ID,subscription.Subscription_End_Date
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
	 
 if($row['Package_ID']==1){
	 $message="Hi ".$row['User_Name'].". Currently you have subscribed to trial package. Your trial will end on ".$row['Subscription_End_Date'].".";
	echo "<script>alert('$message');
	window.location = 'usermain2.php';</script>";
 }
else{
	header('location: payment.php');
}
 }
 ?>
