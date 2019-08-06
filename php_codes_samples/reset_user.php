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
		
		 font-size :14px;
		 color : red;
		 font-weight: bold;
		}
		.bt {
		    width: 137px;
			float: right;
			margin-right: 117px;
			margin-top: 6px;
		}
		.rst {
		
		    font-size: 14px;
			width: 300px;
			margin-left: 155px;
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
      
			if ($user_level==1){
			$test = "SELECT * from `foreman_db`.`uc_users`";
			$query = mysqli_query($mysqli,$test);
			 //Per User Form
			echo'<div class="user_details" style="width:560px; margin:auto;">';
			
			echo'<form method="post" action="" id="myform" style="padding-left: 155px; margin-bottom: 55px;">';
			echo"<p class='tm no-print'>MAKE SURE YOU SELECT THE CORRECT USER</p>";
			echo "<select class='no-print' name='user_dname' style='width:150px; margin:auto;'>"; //Always remember this
			while($data = mysqli_fetch_array($query)) {
			  $dname= $data ['display_name'];
			 
			  echo "<option  value='$dname'>".$data['display_name']."</option>";
		
			}
			  echo "</select >";
			  echo '<input class="no-print" type="submit" value="Reset Selected User" />';
			  print '<button class="no-print bt" type="button"> <a href="/umk/umk_foreman/manager_portal.php">Home</a></button>';

			  echo'</form>';
		 
		 //End Per User Form
			if (isset($_POST)) {
				 $d_name ="";
				 
				 if (isset($_POST["user_dname"])) {$d_name = $_POST["user_dname"];
				 print "<p class='rst'>".$d_name." HAS BEEN RESET SUCCESSFULLY.</p>";}
			}  
		//RESET CHALLENGES
		
		$qr_reset ="UPDATE `foreman_db`.`uc_users`
		SET `learning_unit_1_ch1` = '0',
			`learning_unit_1_ch2` = '0',
			`learning_unit_1_ch3` = '0',
			`learning_unit_1_ch4` = '0',
			`learning_unit_1_ch5` = '0',
			`learning_unit_2_ch1` = '0',
			`learning_unit_2_ch2` = '0',
			`learning_unit_2_ch3` = '0',
			`learning_unit_2_ch4` = '0',
			`learning_unit_2_ch5` = '0',
			`learning_unit_2_ch6` = '0',
			`learning_unit_2_ch7` = '0',
			`learning_unit_2_ch8` = '0',
			`learning_unit_2_ch9` = '0',
			`learning_unit_2_ch10` = '0',
			`learning_unit_2_ch11` = '0',
			`learning_unit_2_ch12` = '0',
			`learning_unit_2_ch13` = '0',
			`learning_unit_2_ch14` = '0',
			`learning_unit_3_ch1` = '0',
			`learning_unit_3_ch2` = '0',
			`learning_unit_3_ch3` = '0',
			`learning_unit_3_ch4` = '0',
			`learning_unit_3_ch5` = '0',
			`learning_unit_4_ch1` = '0',
			`learning_unit_4_ch2` = '0',
			`learning_unit_4_ch3` = '0',
			`learning_unit_4_ch4` = '0',
			`learning_unit_4_ch5` = '0',
			`learning_unit_4_ch6` = '0',
			`learning_unit_4_ch7` = '0',
			`learning_unit_4_ch8` = '0',
			`learning_unit_4_ch9` = '0',
			`learning_unit_4_ch10` = '0',
			`learning_unit_4_ch11` = '0',
			`learning_unit_4_ch12` = '0',
			`learning_unit_4_ch13` = '0',
			`learning_unit_4_ch14` = '0',
			`learning_unit_4_ch15` = '0',
			`learning_unit_4_ch16` = '0',
			`learning_unit_4_ch17` = '0',
			`learning_unit_4_ch18` = '0',
			`learning_unit_4_ch19` = '0',
			`learning_unit_4_ch20` = '0',
			`learning_unit_4_ch21` = '0',
			`learning_unit_4_ch22` = '0',
			`learning_unit_5_ch1` = '0'
			WHERE `uc_users`.`display_name`  = '$d_name'";
		$query = mysqli_query($mysqli, $qr_reset);
		
	
  }	//End checking user level
	
	
	 else{
	      header ("Location: /umk/umk_foreman/not_allowed.php");
	   }
}//End checking if user is logged in
      
?>
</body>
</html>