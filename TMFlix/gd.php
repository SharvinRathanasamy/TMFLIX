<?php
    require("connection.php");
	$sql = "SELECT  series.Series_Name, COUNT(user_watch_series.Series_ID) as nums
	FROM user_watch_series
	JOIN series 
	ON series.Series_ID=user_watch_series.Series_ID 
	WHERE `Watch_Date` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) 
	GROUP BY series.Series_Name
	ORDER BY COUNT(user_watch_series.Series_ID) DESC
	LIMIT 5;";
			$result = $conn->query($sql);
			 for($i=0; $row = $result->fetch_assoc(); $i++){
				 $Series_Name = $row['Series_Name'];
				$nums = $row['nums']; 
				$result_array[] = ['Series_Name'=>$Series_Name, 'nums'=>$nums];
			 }
			 echo json_encode($result_array);
?>