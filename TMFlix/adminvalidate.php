<?php
 
include_once('connection.php');
  
function test_input($data) {
     
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
  
if ($_SERVER["REQUEST_METHOD"]== "POST") {
     
    $adminname = test_input($_POST["adminname"]);
    $password = test_input($_POST["password"]);
	$sql="SELECT * FROM admin;";
	
		$result = $conn->query($sql);
			 for($i=0; $row = $result->fetch_assoc(); $i++){
				if(($row['adminname'] == $adminname) &&
					($row['password'] == $password)) {
							header("Location: user.php");
				}
				else {
					echo "<script language='javascript'>";
					echo "alert('WRONG INFORMATION');window.location = 'adminlogin.php';";
					echo "</script>";
					die();
				}
			 }
}
 
?>