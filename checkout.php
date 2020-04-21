<?php
include_once('connection.php');
$storeCollection = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   if(
    !empty($_POST['user_id'])
 ) {
      //$storeId    = $connection->real_escape_string($_POST['store_id']);
      $userId     = $connection->real_escape_string($_POST['user_id']);

      /* Check user id in store_visitor table 
         if found show you have already checked in.
         else  make entry in store_visitor table
      */

      //$updateQuery = "UPDATE store_visitor SET is_checkin = 0 WHERE user_id = ".$userId." AND store_id = ".$storeId;

      $updateQuery = "UPDATE store_visitor SET is_checkin = 0 WHERE user_id = ".$userId;         
      if($connection->query($updateQuery) === TRUE){
           echo json_encode(
              array(
                  "error"=>0,
                  "message_title"=>"You are sucessfully checkout!!",
                  "message_body"=>"You can check in again.")
                );
      }
   } else {
        
   }
}
?>