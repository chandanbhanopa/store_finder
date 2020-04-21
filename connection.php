<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
define('HOSTNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'store_locator');
define('STORE', 'stores');
define('VISITOR', 'store_visitor');

$connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

if ($connection->connect_errno) {
  //echo "Failed to connect to MySQL: " . $connection->connect_error;
  exit('API error! Please try again.....');
}

function getStoreCount($connection,$storeId){

	 $sql =   "SELECT COUNT( user_id) as total_user FROM store_visitor WHERE store_id = ". $storeId." AND is_checkin = 1";
      $result = $connection->query($sql);
      $data = $result->fetch_assoc();
      return $data['total_user'] ? $data['total_user'] : 0;
      

}