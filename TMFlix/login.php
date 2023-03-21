<?php
session_start();

// initializing variables

$errors = array();

// connect to the database
include "connection.php";


// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  if (empty($username)) {
  	echo "Username is required";
  }
  if (empty($password)) {
  	echo "Password is required";
  }

  if (count($errors) == 0) {
  	$password = $password;
  	$query = "SELECT * FROM user_account WHERE User_Name='$username' AND password='$password'";
  	$results = mysqli_query($conn, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $row = $results->fetch_assoc();
  	  $_SESSION['success'] = "You are now logged in";
	  $_SESSION['User_ID'] = $row['User_ID'];
  	 header('location: usermain2.php');
  	}
	
	else {
  		echo "Wrong username/password combination";
  	}
  }
}

?>