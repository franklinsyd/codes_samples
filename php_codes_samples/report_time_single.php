<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<title>Charting</title>
	<link href="css/basic.css" type="text/css" rel="stylesheet" />
	<script type='text/javascript' src='js/jquery.js'></script>
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
	<script type="text/javascript">
	
  /*$(document).ready(function(){	     
		 $('.times').css("visibility", 'hidden');	
	 
	   $('.sbt').click(function(){
	   
          $('.times').css("visibility", 'visible');	
       		
         })	
	
	}) */
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
			
        $test = "SELECT * from `foreman_db`.`uc_users` WHERE `uc_users`.`user_name`='$user_n'";
		$query = mysqli_query($mysqli,$test);
		 //Per User Form
		echo'<div class="user_details" style="width:560px; margin:auto;">';
		
		echo'<form method="post" action="" id="myform" style="padding-left: 155px;margin-bottom: 2px;">';
		echo"<p class='tm no-print'>SELECT USER (TIME BASED PERFORMANCE)</p>";
		echo "<select class='no-print' name='user_dname' style='width:150px; margin:auto;'>"; //Always remember this
		while($data = mysqli_fetch_array($query)) {
		  $dname= $data ['display_name'];
		 
		  echo "<option  value='$dname'>".$data['display_name']."</option>";
	
		}
		  echo "</select >";
		  echo '<input class="no-print sbt" type="submit" value="Retrieve Report " />';
		  print '<button class="no-print bt" type="button"> <a href="/umk/umk_foreman/view_previous_scores.php">Return</a></button>';

		  echo'</form>';
		 
		 //End Per User Form
	if (isset($_POST)) {

		 $l1_avg=0;
		 $l2_avg=0;
		 $l3_avg=0;
		 $l4_avg=0;
		 $l5_avg=0;
		 $d_name ="";
		   
		 if (isset($_POST["user_dname"])) {$d_name = $_POST["user_dname"];
		 
		 //GETTING THE AVERAGE PER LEARNING UNIT
		 $qr ="SELECT * from `foreman_db`.`uc_users`";
		 $query = mysqli_query($mysqli,$qr);
		 $count1=0;
		 $count2=0;
		 $count3=0;
		 $count4=0;
		 $count5=0;
		 $l1_sum =0;
		 $l2_sum =0;
		 $l3_sum =0;
		 $l4_sum =0;
		 $l5_sum =0;
		 
   while($row = mysqli_fetch_array($query)) {
    
		//Learning unit 1
		$l1_duration1 = $row['l1ch1_duration'];
		$l1_duration2 = $row['l1ch2_duration'];
		$l1_duration3 = $row['l1ch3_duration'];
		$l1_duration4 = $row['l1ch4_duration'];
		$l1_duration5 = $row['l1ch5_duration'];
		$l1_track=$l1_duration1+$l1_duration2+$l1_duration3+$l1_duration4+$l1_duration5;
		$l1_sum += $l1_duration1+$l1_duration2+$l1_duration3+$l1_duration4+$l1_duration5;
	
		if ($l1_track> 0)
		{
		  $count1++;
		}  
		//Learning unit 2
		$l2_duration1 = $row['l2ch1_duration'];
		$l2_duration2 = $row['l2ch2_duration'];
		$l2_duration3 = $row['l2ch3_duration'];
		$l2_duration4 = $row['l2ch4_duration'];
		$l2_duration5 = $row['l2ch5_duration'];
		$l2_duration6 = $row['l2ch6_duration'];
		$l2_duration7 = $row['l2ch7_duration'];
		$l2_duration8 = $row['l2ch8_duration'];
		$l2_duration9 = $row['l2ch9_duration'];
		$l2_duration10 = $row['l2ch10_duration'];
		$l2_duration11 = $row['l2ch11_duration'];
		$l2_duration12 = $row['l2ch12_duration'];
		$l2_duration13 = $row['l2ch13_duration'];
		$l2_duration14 = $row['l2ch14_duration'];
		
		$l2_track = $l2_duration1+ $l2_duration2 + $l2_duration3 + $l2_duration4 + $l2_duration5 + $l2_duration6 + $l2_duration7 + $l2_duration8 + $l2_duration9 + $l2_duration10 + $l2_duration11 + $l2_duration12 + $l2_duration13 + $l2_duration14 ;
		$l2_sum += $l2_duration1+ $l2_duration2 + $l2_duration3 + $l2_duration4 + $l2_duration5 + $l2_duration6 + $l2_duration7 + $l2_duration8 + $l2_duration9 + $l2_duration10 + $l2_duration11 + $l2_duration12 + $l2_duration13 + $l2_duration14 ;
	    if ($l2_track> 0)
		{
		  $count2++;
		}  
		//Learning unit 3
	   $l3_duration1 =  $row['l3ch1_duration'];
	   $l3_duration2 = $row['l3ch2_duration'];
	   $l3_duration3 = $row['l3ch3_duration'];
	   $l3_duration4 = $row['l3ch4_duration'];
	   $l3_duration5 = $row['l3ch5_duration'];
	   $l3_track = $l3_duration1 + $l3_duration2 + $l3_duration3+ $l3_duration4 + $l3_duration5  ;  
	   $l3_sum += $l3_duration1 + $l3_duration2 + $l3_duration3+ $l3_duration4 + $l3_duration5  ;  
	
    	if ($l3_track> 0)
		{
		  $count3++;
		} 
	 //Learning unit 4
	   $l4_duration1 = $row['l4ch1_duration'];
	   $l4_duration2 = $row['l4ch2_duration'];
	   $l4_duration3 = $row['l4ch3_duration'];
	   $l4_duration4 = $row['l4ch4_duration'];
	   $l4_duration5 = $row['l4ch5_duration'];
	   $l4_duration6 = $row['l4ch6_duration'];
	   $l4_duration7 = $row['l4ch7_duration'];
	   $l4_duration8 = $row['l4ch8_duration'];
	   $l4_duration9 = $row['l4ch9_duration'];
	   $l4_duration10 = $row['l4ch10_duration'];
	   $l4_duration11 = $row['l4ch11_duration'];
	   $l4_duration12 = $row['l4ch12_duration'];
	   $l4_duration13 = $row['l4ch13_duration'];
	   $l4_duration14 = $row['l4ch14_duration'];
	   $l4_duration15 = $row['l4ch15_duration'];
	   $l4_duration16 = $row['l4ch16_duration'];
	   $l4_duration17 = $row['l4ch17_duration'];
	   $l4_duration18 = $row['l4ch18_duration'];
	   $l4_duration19 = $row['l4ch19_duration'];
	   $l4_duration20 = $row['l4ch20_duration'];
	   $l4_duration21 = $row['l4ch21_duration'];
	   $l4_duration22 = $row['l4ch22_duration'];
	   $l4_track= $l4_duration1 + $l4_duration2 + $l4_duration3 + $l4_duration4 + $l4_duration5 + $l4_duration6 + $l4_duration7 + $l4_duration8 + $l4_duration9 + $l4_duration10 + $l4_duration11 + $l4_duration12 + $l4_duration13 + $l4_duration14 + $l4_duration15 + $l4_duration16 + $l4_duration17 + $l4_duration18 + $l4_duration19 + $l4_duration20 + $l4_duration21 + $l4_duration22;
	   $l4_sum += $l4_duration1 + $l4_duration2 + $l4_duration3 + $l4_duration4 + $l4_duration5 + $l4_duration6 + $l4_duration7 + $l4_duration8 + $l4_duration9 + $l4_duration10 + $l4_duration11 + $l4_duration12 + $l4_duration13 + $l4_duration14 + $l4_duration15 + $l4_duration16 + $l4_duration17 + $l4_duration18 + $l4_duration19 + $l4_duration20 + $l4_duration21 + $l4_duration22;
	   
	   if ($l4_track> 0){
		  $count4++;
	   } 
	   
	   //Learning unit 5
	    $l5_duration1 = $row['l5ch1_duration'];
		$l5_track =  $l5_duration1;
	    $l5_sum +=  $l5_duration1 ;
		
		if ($l5_track> 0){
		  $count5++;
		} 
    }
	//end getting average numbers
		$l1_avg = $l1_sum/$count1;
		$l2_avg = $l2_sum/$count2;
		$l3_avg = $l3_sum/$count3;
		$l4_avg = $l4_sum/$count4;	
		 }
	}  

	   $lu1_average=0;
	   $lu1_average=0;
	   $lu3_average=0;
	   $lu2_average=0;
	   $lu3_average=0;
	   $lu1_sum=0;
	   $lu2_sum=0;
	   $lu3_sum=0;
	   $lu4_sum=0;
	   $lu5_sum=0;
	   $login_time="";
	   $logout_time="";
	   $user_name ="";
	   $display_name="";
	   $display_surname="";
	   $qr ="SELECT * from `foreman_db`.`uc_users` WHERE `uc_users` .`display_name`= '$d_name'";
	   $query = mysqli_query($mysqli,$qr);
  
   while($row = mysqli_fetch_array($query)) {
    
	      
		$user_name=  $row['user_name'];
		$display_name=  $row['display_name'];
		$display_surname=  $row['display_surname'];
		$time_of_request=  $row['supervisor_request_time'];
		$login_time = $row['login_time'];
		$logout_time = $row['logout_time'];
		//TIMES--------------
		
		//Learning unit 1
		$lu1_duration1 = $row['l1ch1_duration'];
		$lu1_duration2 = $row['l1ch2_duration'];
		$lu1_duration3 = $row['l1ch3_duration'];
		$lu1_duration4 = $row['l1ch4_duration'];
		$lu1_duration5 = $row['l1ch5_duration'];
		$lu1_sum = $lu1_duration1+$lu1_duration2+$lu1_duration3+$lu1_duration4+$lu1_duration5;
		
		//Learning unit 2
		$lu2_duration1 = $row['l2ch1_duration'];
		$lu2_duration2 = $row['l2ch2_duration'];
		$lu2_duration3 = $row['l2ch3_duration'];
		$lu2_duration4 = $row['l2ch4_duration'];
		$lu2_duration5 = $row['l2ch5_duration'];
		$lu2_duration6 = $row['l2ch6_duration'];
		$lu2_duration7 = $row['l2ch7_duration'];
		$lu2_duration8 = $row['l2ch8_duration'];
		$lu2_duration9 = $row['l2ch9_duration'];
		$lu2_duration10 = $row['l2ch10_duration'];
		$lu2_duration11 = $row['l2ch11_duration'];
		$lu2_duration12 = $row['l2ch12_duration'];
		$lu2_duration13 = $row['l2ch13_duration'];
		$lu2_duration14 = $row['l2ch14_duration'];
		$lu2_sum = $lu2_duration1 + $lu2_duration2 + $lu2_duration3 + $lu2_duration4 + $lu2_duration5+ $lu2_duration6 + $lu2_duration7 + $lu2_duration8 + $lu2_duration9 + $lu2_duration10 + $lu2_duration11+$lu2_duration12+$lu2_duration13+$lu2_duration14 ;
	    
		//Learning unit 3
	   $lu3_duration1 = $row['l2ch1_duration'];
	   $lu3_duration2 = $row['l2ch2_duration'];
	   $lu3_duration3 = $row['l2ch3_duration'];
	   $lu3_duration4 = $row['l2ch4_duration'];
	   $lu3_duration5 = $row['l2ch5_duration'];
	   $lu3_sum = $lu3_duration1 + $lu3_duration2 + $lu3_duration3 + $lu3_duration4 + $lu3_duration5 ;  
	 
	 //Learning unit 4
	   $lu4_duration1 = $row['l4ch1_duration'];
	   $lu4_duration2 = $row['l4ch2_duration'];
	   $lu4_duration3 = $row['l4ch3_duration'];	
	   $lu4_duration4 = $row['l4ch4_duration'];
       $lu4_duration5 = $row['l4ch5_duration'];
       $lu4_duration6 = $row['l4ch6_duration'];
       $lu4_duration7 = $row['l4ch7_duration'];
	   $lu4_duration8 = $row['l4ch8_duration'];
	   $lu4_duration9 = $row['l4ch9_duration'];
       $lu4_duration10 = $row['l4ch10_duration'];
       $lu4_duration11 = $row['l4ch11_duration'];
	   $lu4_duration12 = $row['l4ch12_duration'];
	   $lu4_duration13 = $row['l4ch13_duration'];
	   $lu4_duration14 = $row['l4ch14_duration'];
	   $lu4_duration15 = $row['l4ch15_duration'];
	   $lu4_duration16 = $row['l4ch16_duration'];
	   $lu4_duration17 = $row['l4ch17_duration'];
	   $lu4_duration18 = $row['l4ch18_duration'];
	   $lu4_duration19 = $row['l4ch19_duration'];
	   $lu4_duration20 = $row['l4ch20_duration'];
	   $lu4_duration21 = $row['l4ch11_duration'];
	   $lu4_sum = $lu4_duration1 + $lu4_duration2 + $lu4_duration3 + $lu4_duration4 + $lu4_duration5 + $lu4_duration6 + $lu4_duration7 + $lu4_duration8 + $lu4_duration9 + $lu4_duration10 + $lu4_duration11 + $lu4_duration12 + $lu4_duration13 + $lu4_duration14 + $lu4_duration15 + $lu4_duration16 + $lu4_duration17 + $lu4_duration18 + $lu4_duration19 + $lu4_duration20 + $lu4_duration21 ;
	   
	   //Learning unit 5
	    $lu5_duration1 = $row['l5ch1_duration'];
	    $lu5_sum =  $lu5_duration1;

	   
		//---END-------------
		
	    $lu1_average= ($row['learning_unit_1_ch1'] + $row['learning_unit_1_ch2']+ $row['learning_unit_1_ch3']+ $row['learning_unit_1_ch4']+ $row['learning_unit_1_ch5'])/5 ;
	    $lu2_average=  ($row['learning_unit_2_ch1'] + $row['learning_unit_2_ch2']+ $row['learning_unit_2_ch3']+ $row['learning_unit_2_ch4']+ $row['learning_unit_2_ch5']+ $row['learning_unit_2_ch6']+ $row['learning_unit_2_ch7']+ $row['learning_unit_2_ch8']+ $row['learning_unit_2_ch9']+ $row['learning_unit_2_ch10']+ $row['learning_unit_2_ch11']+ $row['learning_unit_2_ch12']+ $row['learning_unit_2_ch13']+ $row['learning_unit_2_ch14'])/14 ;
		$lu3_average=  ($row['learning_unit_3_ch1'] + $row['learning_unit_3_ch2']+ $row['learning_unit_3_ch3']+ $row['learning_unit_3_ch4']+ $row['learning_unit_3_ch5'])/5 ;
        $lu4_average= ($row['learning_unit_4_ch1']+$row['learning_unit_4_ch2']+$row['learning_unit_4_ch3']+$row['learning_unit_4_ch4']+$row['learning_unit_4_ch5']+$row['learning_unit_4_ch6']+$row['learning_unit_4_ch7']+$row['learning_unit_4_ch8']+$row['learning_unit_4_ch9']+$row['learning_unit_4_ch10']+$row['learning_unit_4_ch11']+$row['learning_unit_4_ch12']+$row['learning_unit_4_ch13']+$row['learning_unit_4_ch14']+$row['learning_unit_4_ch15']+$row['learning_unit_4_ch16']+$row['learning_unit_4_ch17']+$row['learning_unit_4_ch18']+$row['learning_unit_4_ch19']+$row['learning_unit_4_ch20']+$row['learning_unit_4_ch21'])/ 21 ;
		$lu5_average= ($row['learning_unit_5_ch1']) ;
		$lu1_average =  number_format($lu1_average, 0, ',', ' ');
		$lu2_average =  number_format($lu2_average, 0, ',', ' ');
		$lu3_average =  number_format($lu3_average, 0, ',', ' ');
		$lu4_average =  number_format($lu4_average, 0, ',', ' ');
		$lu5_average =  number_format($lu5_average, 0, ',', ' '); 
	   }
	   echo"<div class='times'>
				<p class='tm'>LOGIN TIME : ".$login_time." </p>
				<p class='tm'>LOGOUT TIME : ".$logout_time."</p>
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
				<caption>Time Based Progress in Minutes</caption>
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
					<td>'.$lu1_sum.'</td>
					<td>'.$lu2_sum.'</td>
					<td>'.$lu3_sum.'</td>
					<td>'.$lu4_sum.'</td>
					<td>'.$lu5_sum.'</td>
		    </tr>
			<tr>
			<th scope="row">Averages</th>
			<td>'.round($l1_avg,1).'</td>
			<td>'.round($l2_avg,1).'</td>
			<td>'.round($l3_avg,1).'</td>
			<td>'.round($l4_avg,1).'</td>
			<td>'.round($l5_avg,1).'</td>
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