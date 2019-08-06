<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<title class="no-print" >UMK Report</title>
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
			margin-right: 28px;
			margin-top: 0px;
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
            //Check if the user is of level 0 (Operator or Foreman) or level 1 (Manager or Supervisor)

	        $qr = "SELECT `user_level` FROM `foreman_db`.`uc_users` WHERE `uc_users`.`user_name`='$user_n' ";
			 //Execute query
			 $query = mysqli_query($mysqli,$qr);
			 
			 while($row = mysqli_fetch_array($query)) {
			     $user_level = $row ['user_level'];
			 }
             if ($user_level==1 || $user_level==0){
        $test = "SELECT display_name from `foreman_db`.`uc_users` WHERE `uc_users`.`user_name`='$user_n'";
		$query = mysqli_query($mysqli,$test);
		 //Per User Form
		echo'<div class="user_details" style="width:560px; margin:auto;">';
		
		echo'<form method="post" action="" id="myform" style="padding-left: 155px; margin-bottom: 2px;">';
		echo"<p class='tm no-print'>SELECT USER (SCORE BASED PERFORMANCE ) </p>";
		echo "<select class='no-print' name='user_dname' style='width:150px; margin:auto;'>"; //Always remember this
		while($data = mysqli_fetch_array($query)) {
		  $dname= $data ['display_name'];
		 
		  echo "<option  value='$dname'>".$data['display_name']."</option>";
	
		}
		  echo "</select >";
		  echo '<input class="no-print" type="submit" value="Retrieve Report " />';
		  print '<button class="no-print bt" type="button"> <a href="/umk/umk_foreman/view_previous_scores.php">Return</a></button>';
		  
		  echo'</form>';
		 
		 //End Per User Form
		if (isset($_POST)) {
			 $d_name ="";
			 
			 if (isset($_POST["user_dname"])) {$d_name = $_POST["user_dname"];}
			 
			// echo ' NAME : '. $d_name.'';  
		}  

		 $qr ="SELECT * from `foreman_db`.`uc_users` WHERE `uc_users` .`display_name`= '$d_name'";
		 $query = mysqli_query($mysqli,$qr);
		 
		   $lu1_average = 0;
		   $lu2_average = 0;
		   $lu3_average = 0;
		   $lu4_average = 0;
		   $lu5_average = 0;
		   $login_time="";
		   $logout_time="";
		   $display_name="";
		   $display_surname="";
		   
   while($row = mysqli_fetch_array($query)) {
    
		$user_name=  $row['user_name'];
		$display_name=  $row['display_name'];
		$display_surname=  $row['display_surname'];
		$time_of_request=  $row['supervisor_request_time'];
		$login_time = $row['login_time'];
		$logout_time = $row['logout_time'];
		
		$lu1_average= ($row['learning_unit_1_ch1'] + $row['learning_unit_1_ch2']+ $row['learning_unit_1_ch3']+ $row['learning_unit_1_ch4']+ $row['learning_unit_1_ch5'])/5 ;
	    $lu2_average=  ($row['learning_unit_2_ch1'] + $row['learning_unit_2_ch2']+ $row['learning_unit_2_ch3']+ $row['learning_unit_2_ch4']+ $row['learning_unit_2_ch5']+ $row['learning_unit_2_ch6']+ $row['learning_unit_2_ch7']+ $row['learning_unit_2_ch8']+ $row['learning_unit_2_ch9']+ $row['learning_unit_2_ch10']+ $row['learning_unit_2_ch11']+ $row['learning_unit_2_ch12']+ $row['learning_unit_2_ch13']+ $row['learning_unit_2_ch14'])/14 ;
		$lu3_average=  ($row['learning_unit_3_ch1'] + $row['learning_unit_3_ch2']+ $row['learning_unit_3_ch3']+ $row['learning_unit_3_ch4']+ $row['learning_unit_3_ch5'])/5 ;
        $lu4_average= ($row['learning_unit_4_ch1']+$row['learning_unit_4_ch2']+$row['learning_unit_4_ch3']+$row['learning_unit_4_ch4']+$row['learning_unit_4_ch5']+$row['learning_unit_4_ch6']+$row['learning_unit_4_ch7']+$row['learning_unit_4_ch8']+$row['learning_unit_4_ch9']+$row['learning_unit_4_ch10']+$row['learning_unit_4_ch11']+$row['learning_unit_4_ch12']+$row['learning_unit_4_ch13']+$row['learning_unit_4_ch14']+$row['learning_unit_4_ch15']+$row['learning_unit_4_ch16']+$row['learning_unit_4_ch17']+$row['learning_unit_4_ch18']+$row['learning_unit_4_ch19']+$row['learning_unit_4_ch20']+$row['learning_unit_4_ch21']+$row['learning_unit_4_ch22'])/ 22 ;
		$lu5_average= ( +$row['learning_unit_5_ch1']) ;
		
		$lu1_average =  number_format($lu1_average, 0, ',', ' ');
		$lu2_average =  number_format($lu2_average, 0, ',', ' ');
		$lu3_average =  number_format($lu3_average, 0, ',', ' ');
		$lu4_average =  number_format($lu4_average, 0, ',', ' ');
		$lu5_average =  number_format($lu5_average, 0, ',', ' ');   
    } 
	
		     	echo"<div class='times'>
				<p class='tm'>LOGIN TIME : $login_time </p>
				<p class='tm'>LOGOUT TIME : $logout_time</p>
				</div>"; 
		if ($lu1_average==100 && $lu2_average==100 && $lu3_average==100 && $lu4_average==100 && $lu5_average==100 )
		 {
		      echo"<div class='times'>
				<p class='tm'>This user has successfully completed the training.</p>
				</div>";
		}
		else {
		          echo"<div class='times'>
			           <p class='tm'>This user has not successfully completed the training.</p>
				       </div>";
		}
		
		echo '<table >
			 <caption>Bar Graph of Progress in % </caption>
				<thead>
					<tr class="row_height">
						<td></td>
						<th scope="col">LU 1</th>
						<th scope="col">LU 2</th>
						<th scope="col">LU 3</th>
						<th scope="col">LU 4</th>
						<th scope="col">LU 5</th>
					
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">'.$display_name.' '.$display_surname.' </th>
						<td>'.$lu1_average.'</td>
						<td>'.$lu2_average.'</td>
						<td>'.$lu3_average.'</td>
						<td>'.$lu4_average.'</td>
						<td>'.$lu5_average.'</td>
					
					</tr>
					
				</tbody>
			</table>';	
	    echo'</div>';
		}	//End checking user level
	 else{
	      header ("Location: /umk/umk_foreman/not_allowed.php");
	   }
	
} //End checking if user is logged in
      
?>
</body>
</html>