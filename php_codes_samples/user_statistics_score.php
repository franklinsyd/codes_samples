<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<title>Charting</title>
	<link href="css/basic.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="-shared/EnhanceJS/enhance.js"></script>	
	<script type="text/javascript">
		// Run capabilities test
		enhance({
			loadScripts: [
				{src: 'js/excanvas.js', iecondition: 'all'},
				'-shared/jquery.min.js',
				'js/visualize.jQuery.js',
				'js/umk_bar.js'
			],
			loadStyles: [
				'css/visualize.css',
				'css/visualize-dark.css'
			]	
		});   
    </script>
	<style>
			@media print
		{    
			.no-print, .no-print *
			{
				display: none !important;
			}
		}
		
		.times {
		    width: 400px;
			
			margin-left : 28px
		}
		.tm  {
		
		 font-size :12px;
		}
		.bt {
		    width: 112px;
			float: right;
			margin-right: 143px;
			margin-top: 6px;
		}
	</style>
</head>
 <div id="umk"><div style="margin:auto;width:180px"><img  src="images/logo.png"/></div></div>
<body>
<?php 
require_once("models/config.php");
require_once("models/db-settings.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

  if(isUserLoggedIn()){	
  
  
        //***SAVING DATA IN HISTORICAL TABLE
        $user_n = $loggedInUser->username;

        $test = "SELECT display_name from `uc_users` WHERE `uc_users`.`user_name`='$user_n'";
		$query = mysqli_query($mysqli,$test);
		 //Per User Form
		echo'<div class="user_details" style="width:560px; margin:auto;">';
		
		echo'<form method="post" action="" id="myform" style="padding-left: 155px;margin-bottom: 55px;">';
		echo"<p class='tm no-print'>SELECT USER (SCORE BASED PERFORMANCE ) </p>";
		echo "<select class='no-print' name='user_dname' style='width:150px; margin:auto;'>"; //Always remember this
		while($data = mysqli_fetch_array($query)) {
		  $dname= $data ['display_name'];
		 
		  echo "<option  value='$dname'>".$data['display_name']."</option>";
	
		}
		  echo "</select >";
		  echo '<input class="no-print" type="submit" value="Retrieve Report " />';
		  print '<button class="no-print bt" type="button"> <a href="/umk/umk_foreman/view_previous_scores.php">Home</a></button>';

		  
		  echo'</form>';
		 
		 //End Per User Form
		if (isset($_POST)) {
			 $d_name ="";
			 
			 if (isset($_POST["user_dname"])) {$d_name = $_POST["user_dname"];}
			 
			// echo ' NAME : '. $d_name.'';  
		}  

	   $qr ="SELECT * from `uc_users` WHERE `uc_users` .`display_name`= '$d_name'";
	   $query = mysqli_query($mysqli,$qr);
   
        while($row = mysqli_fetch_array($query)) {
		$user_name=  $row['user_name'];
		$display_name=  $row['display_name'];
		$display_surname=  $row['display_surname'];
		$time_of_request=  $row['supervisor_request_time'];
		$login_time = $row['login_time'];
		$logout_time = $row['logout_time'];
		
		$lu2_average= ($row['ch1'] + $row['ch2']+ $row['ch3'])/3 ;
	    $lu4_average= ($row['ch4'] + $row['ch5']+ $row['ch6'] + $row['ch7']+$row['ch8']+ $row['ch9'] + $row['ch10'] + $row['ch11'] + $row['ch12'] +$row['ch13'] +$row['ch14'])/11 ;
		$lu5_average= ( $row['ch15']+ $row['ch16'] + $row['ch17']+ $row['ch18']+ $row['ch19'] + $row['ch20'])/6 ;
        $lu6_average= ( $row['ch21']+ $row['ch22'] + $row['ch23']+ $row['ch24']+ $row['ch25'] + $row['ch26'] + $row['ch27'] + $row['ch28'] + $row['ch29']+$row['ch30'] +$row['ch31']+$row['ch32']+$row['ch33']+ $row['ch34']+$row['ch35']+ $row['ch36']+ $row['ch37']+ $row['ch38']+ $row['ch39']+ $row['ch40']+ $row['ch41']+$row['ch42']+ $row['ch43']+ $row['ch44']+$row['ch45']+ $row['ch46']+$row['ch47'])/ 27 ;
		$lu8_average= ( $row['ch48']+ $row['ch49'])/2 ;
		$lu9_average= $row['ch50'] ;
		
		$lu5_average =  number_format($lu5_average, 0, ',', ' ');
		$lu4_average =  number_format($lu4_average, 0, ',', ' ');
		$lu2_average =  number_format($lu2_average, 0, ',', ' ');
		$lu6_average =  number_format($lu6_average, 0, ',', ' ');
		$lu8_average =  number_format($lu8_average, 0, ',', ' ');
		$lu9_average =  number_format($lu9_average, 0, ',', ' ');
   
       } 
	    echo"<div class='times'>
				<p class='tm'>LOGIN TIME : $login_time </p>
				<p class='tm'>LOGOUT TIME : $logout_time</p>
				</div>"; 
		if ($lu2_average==100 && $lu4_average==100 && $lu5_average==100 && $lu6_average==100 && $lu8_average==100&& $lu9_average==100 ){
		      echo"<div class='times'>
				<p class='tm'>This user has successfully completed the training.</p>
				</div>";
		}
		else{
		          echo"<div class='times'>
			 <p class='tm'>This user has not successfully completed the training.</p>
				</div>";
		}
		
		echo '<table >
	         <caption>Bar Graph of Progress in % </caption>
	          <thead>
				<tr class="row_height">
					<td></td>
					<th scope="col">LU 2</th>
					<th scope="col">LU 4</th>
					<th scope="col">LU 5</th>
					<th scope="col">LU 6</th>
					<th scope="col">LU 8</th>
					<th scope="col">LU 9</th>
				</tr>
	         </thead>
	        <tbody>
				<tr>
					<th scope="row">'.$display_name.' '.$display_surname.' </th>
					<td>'.$lu2_average.'</td>
					<td>'.$lu4_average.'</td>
					<td>'.$lu5_average.'</td>
					<td>'.$lu6_average.'</td>
					<td>'.$lu8_average.'</td>
					<td>'.$lu9_average.'</td>
				</tr>
			</tbody>
		</table>';		 
	    echo'</div>';
}
      
?>
</body>
</html>