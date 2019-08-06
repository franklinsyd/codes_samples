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

        $test = "SELECT * from `uc_users` WHERE `uc_users`.`user_name`='$user_n' ";
		$query = mysqli_query($mysqli,$test);
		 //Per User Form
		echo'<div class="user_details" style="width:560px; margin:auto;">';
		
		echo'<form method="post" action="" id="myform" style="padding-left: 155px;margin-bottom: 55px;">';
		echo"<p class='tm no-print'>SELECT USER (TIME BASED PERFORMANCE)</p>";
		echo "<select class='no-print' name='user_dname' style='width:150px; margin:auto;'>"; //Always remember this
		while($data = mysqli_fetch_array($query)) {
		  $dname= $data ['display_name'];
		 
		  echo "<option  value='$dname'>".$data['display_name']."</option>";
	
		}
		  echo "</select >";
		  echo '<input class="no-print" type="submit" value="Retrieve Report " />';
		  print '</br>';
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
		//TIMES--------------
		
		//Learning unit 2
		
		$lu2_duration1 = $row['ch1_duration'];
		$lu2_duration2 = $row['ch2_duration'];
		$lu2_duration3 = $row['ch3_duration'];
		$lu2_sum = $lu2_duration1+$lu2_duration2+$lu2_duration3;
		
		//Learning unit 4
		$lu4_duration4 = $row['ch4_duration'];
		$lu4_duration5 = $row['ch5_duration'];
		$lu4_duration6 = $row['ch6_duration'];
		$lu4_duration7 = $row['ch7_duration'];
		$lu4_duration8 = $row['ch8_duration'];
		$lu4_duration9 = $row['ch9_duration'];
		$lu4_duration10 = $row['ch10_duration'];
		$lu4_duration11 = $row['ch11_duration'];
		$lu4_duration12 = $row['ch12_duration'];
		$lu4_duration13 = $row['ch13_duration'];
		$lu4_duration14 = $row['ch14_duration'];
		$lu4_sum = $lu4_duration4 + $lu4_duration5 + $lu4_duration6 + $lu4_duration7 + $lu4_duration8 + $lu4_duration9 + $lu4_duration10 + $lu4_duration11 + $lu4_duration12 + $lu4_duration13 + $lu4_duration14 ;
	    
		//Learning unit 5
		
	   $lu5_duration15 = $row['ch15_duration'];
	   $lu5_duration16 = $row['ch16_duration'];
	   $lu5_duration17 = $row['ch17_duration'];
	   $lu5_duration18 = $row['ch18_duration'];
	   $lu5_duration19 = $row['ch19_duration'];
	   $lu5_duration20 = $row['ch20_duration'];
	   $lu5_sum = $lu5_duration15 + $lu5_duration16 + $lu5_duration17 + $lu5_duration18 + $lu5_duration19 + $lu5_duration20 ;  
	 
	 //Learning unit 6
	   
	   $lu6_duration21 = $row['ch21_duration'];
	   $lu6_duration22 = $row['ch22_duration'];
	   $lu6_duration23 = $row['ch23_duration'];	
	   $lu6_duration24 = $row['ch24_duration'];
       $lu6_duration25 = $row['ch25_duration'];
       $lu6_duration26 = $row['ch26_duration'];
       $lu6_duration27 = $row['ch27_duration'];
	   $lu6_duration28 = $row['ch28_duration'];
	   $lu6_duration29 = $row['ch29_duration'];
       $lu6_duration30 = $row['ch30_duration'];
       $lu6_duration31 = $row['ch31_duration'];
	   $lu6_duration32 = $row['ch32_duration'];
	   $lu6_duration33 = $row['ch33_duration'];
	   $lu6_duration34 = $row['ch34_duration'];
	   $lu6_duration35 = $row['ch35_duration'];
	   $lu6_duration36 = $row['ch36_duration'];
	   $lu6_duration37 = $row['ch37_duration'];
	   $lu6_duration38 = $row['ch38_duration'];
	   $lu6_duration39 = $row['ch39_duration'];
	   $lu6_duration40 = $row['ch40_duration'];
	   $lu6_duration41 = $row['ch41_duration'];
	   $lu6_duration42 = $row['ch42_duration'];
	   $lu6_duration43 = $row['ch43_duration'];
	   $lu6_duration44 = $row['ch44_duration'];
	   $lu6_duration45 = $row['ch45_duration'];
	   $lu6_duration46 = $row['ch46_duration'];
	   $lu6_duration47 = $row['ch47_duration'];
	   $lu6_sum = $lu6_duration21 + $lu6_duration22 + $lu6_duration23 + $lu6_duration24 + $lu6_duration25 + $lu6_duration26 + $lu6_duration27 + $lu6_duration28 + $lu6_duration29 + $lu6_duration30 + $lu6_duration31 + $lu6_duration32 + $lu6_duration33 + $lu6_duration34 + $lu6_duration35 + $lu6_duration36 + $lu6_duration37 + $lu6_duration38 + $lu6_duration39 + $lu6_duration40 + $lu6_duration41 + $lu6_duration42 + $lu6_duration43 + $lu6_duration44 + $lu6_duration45 + $lu6_duration46 + $lu6_duration47;
	   
	   //Learning unit 8
	    $lu8_duration48 = $row['ch48_duration'];
		$lu8_duration49 = $row['ch49_duration'];
	    $lu8_sum =  $lu8_duration48 + $lu8_duration49;
	   //Learning unit 9
	    $lu9_sum = $row['ch50_duration'];
	   
		//---END-------------
		
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
		if ($lu2_average==100 && $lu4_average==100 && $lu5_average==100 && $lu6_average==100 && $lu8_average==100&& $lu9_average==100 )
		 {
		      echo"<div class='times'>
				<p class='tm'>You have successfully completed the training.</p>
				</div>";
		}
		else {
		          echo"<div class='times'>
			 <p class='tm'>You have not successfully completed the training.</p>
				</div>";
		}
		
			echo '<table >
				 <caption>Time Based Progress in Minutes</caption>
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
						<td>'.$lu2_sum.'</td>
						<td>'.$lu4_sum.'</td>
						<td>'.$lu5_sum.'</td>
						<td>'.$lu6_sum.'</td>
						<td>'.$lu8_sum.'</td>
						<td>'.$lu9_sum.'</td>
						
					</tr>
					
				</tbody>
			</table>';
	    echo'</div>';
}
      
?>
</body>
</html>