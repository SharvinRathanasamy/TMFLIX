<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="adminlogin.css">
    <title>Login Page</title>
</head>
 
<body>
    <form action="adminvalidate.php" method="post">
        <div class="login-box">
		
            <h1>Admin Login</h1>
 
            <div class="textbox">
                <input type="text" placeholder="Admin Name" name="adminname" value="">
            </div>
 
            <div class="textbox">
                <input type="password" placeholder="Password" name="password" value="">
            </div>
 
            <input class="button" type="submit" name="login" value="Sign In">
			
			<p>Are you a customer? <a href="login.html">Login here</a></p>
			<p>MAIN PAGE <a href="index.html">Login here</a></p>
			
        </div>
    </form>
</body>
 
</html>