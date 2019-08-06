<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/
require_once("models/config.php");
require_once("models/db-settings.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
//$_SESSION['page'] = 'index.php';
require_once("models/header.php");
		if(isUserLoggedIn()) { 
					  $user_n = $loggedInUser->username; 
					  $qr = "SELECT `user_level` FROM `foreman_db`.`uc_users` WHERE `uc_users`.`user_name`='$user_n' ";
					 //Execute query
					 $query = mysqli_query($mysqli,$qr);
					 
					 while($row = mysqli_fetch_array($query)) {
						 $user_level = $row ['user_level'];
						}
				 
					 if ($user_level==1){
				
							header("Location: /umk/umk_foreman/manager_portal.php"); 
						   
						 }
						 
					 else    {   
					 header("Location: /umk/umk_foreman/not_allowed.php"); 
				
					 $qr ="UPDATE `foreman_db`.`uc_users` SET `login_time` = CURRENT_TIMESTAMP WHERE `uc_users`.`user_name` = '$user_n'";
					 $query = mysqli_query($mysqli,$qr);			
					 die();  }	 
		}

		else 
		{
		   
			   header("Location: /umk/umk_foreman/login.php"); 
		}


?>
