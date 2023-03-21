<!DOCTYPE HTML>
<html>
<head>
		<title>Record</title>
		<script src='https://kit.fontawesome.com/a076d05399.js'></script>
		<link rel="stylesheet" href="adminpage.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><body>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>



</head>
	<div class="header">
		<h1>&nbsp TMFlix Admin </h1>
	</div>
	
	<div class="navbar">
		<a href="user.php">User</a>
		<div class="w3-dropdown-hover w3-mobile">
		<button class="w3-button"  >Sereis <i class="fa fa-caret-down"></i></button>
			<div class="w3-dropdown-content w3-bar-block w3-dark-grey">
			<a href="series.php " class="active" class="w3-bar-item w3-button w3-mobile">Series Info</a>
			<a href="genre_series.php" class="w3-bar-item w3-button w3-mobile">Genre</a>
			<a href="cast_series.php" class="w3-bar-item w3-button w3-mobile">Cast</a>
			<a href="director.php" class="w3-bar-item w3-button w3-mobile">Director</a>
			 <a href="award.php" class="w3-bar-item w3-button w3-mobile">Award</a>
			</div>
		</div>
		<a href="Subscription.php" >Subscription </a>
		<a href="package.php" >Package</a>
		<a href="payment_history.php" >Payment</a>
		<a href="watch_history.php">Watch History</a>
		
		<div class="w3-dropdown-hover w3-mobile">
		<button class="w3-button"  >Report <i class="fa fa-caret-down"></i></button>
			<div class="w3-dropdown-content w3-bar-block w3-dark-grey">
			<a  href="top5.php" class="active" class="w3-bar-item w3-button w3-mobile">Top 5 Sereis</a>
			<a href="genre.php"  class="w3-bar-item w3-button w3-mobile">Gener Series</a>
			<a href="cast.php"  class="w3-bar-item w3-button w3-mobile">Actor Sereis</a> 
			</div>
		</div>	
		<a href="adminlogin.php">Logout</a>

	</div>
	
	
	<div class="body">
	
	<div class="graph">
		<table class="table table-bordered table-striped table-striped">
			<tr>
			<td>
			</td>
			<td>
			<h4><b>Top 5 Series </b></h4>
			<canvas id="bar_canvas"></canvas><br>
			
			</td>
			</tr>

    
    </table>
    <script type="text/javascript">
    $(document).ready(function(){
    $.ajax({
    url: "gd.php",
    method: "GET",
    success: function(data) {
    var data = JSON.parse(data);
    var Series_Name = [];
    var nums = [];

    for(var i in data) {
        Series_Name.push(data[i].Series_Name);
        nums.push(data[i].nums);
    }

    var chartdata = {
        labels: Series_Name,
        datasets : [
        {
        label: 'Series:',
        backgroundColor: 'rgba(0, 115, 255, 0.75)',
        borderColor: 'rgba(0, 0, 0, 0.08)',
        hoverBackgroundColor: 'rgba(108, 0, 255, 1)',
        hoverBorderColor: 'rgba(0, 0, 0, 0)',
        data: nums
        }
        ]
    };

    //var pie_canvas = $("#pie_canvas");
    var bar_canvas = $("#bar_canvas");
    //var line_canvas = $("#line_canvas");

    
    var barGraph = new Chart(bar_canvas, {
        type: 'bar',
        data: chartdata
    });
   /*var lineGraph = new Chart(line_canvas, {
        type: 'line',
        data: chartdata
    });
    var pieGraph = new Chart(pie_canvas, {
        type: 'pie',
        data: chartdata
    });*/
    

    },
    error: function(data) {
    console.log(data);
    }
    });
    });
    </script>
	
	</div>
	</div>

	<div class="footer">
	  <p>&nbsp Database Project Copyright &copy; 2021.</p>
	</div>
	
<body>

</body>
</html>

