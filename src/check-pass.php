<?php   
/*
Copyright (C) 2015 Sebastian Plaza
This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License
as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied arranty
of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with this program. 
If not, see http://www.gnu.org/licenses/. 
*/

session_start(); 
define('__ROOT__', dirname(__FILE__).'/..');
require_once(__ROOT__.'/config/config.php');
require_once(__ROOT__.'/src/check-session.php');  
  

if (isset($_REQUEST['usr'])) $username = $_REQUEST['usr']; else $username = null;
if (isset($_REQUEST['pwd'])) $password = hash ("sha256", $_REQUEST['pwd']); else $password = null;

$qry = "SELECT AES_DECRYPT(password, SHA2('".$_REQUEST['pwd']."',512)) as password FROM ".$_SESSION['db_userTable']." WHERE username='$username'";

	$res 		= $mysqli->query($qry);
	$num_row 	= $res->num_rows;



if( $num_row == 0 ) {
	$output = array('status' => true, 'message' => 'user not found');
} else {
	$row = $res->fetch_assoc();
	if ($row['password']==$password) $output = array('status' => true, 'message' => 'ok');
	else $output = array('status' => false, 'message' => 'wrong pass');
}

if (!$res) $output = array('status' => false, 'message' => 'num_row:'.$num_row);
   
   echo json_encode($output);
 

?>
