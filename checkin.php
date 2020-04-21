<?php
include_once('connection.php');
$storeCollection = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   if(
    !empty($_POST['store_id'])&&
    !empty($_POST['user_id'])
 ) {
      $storeId    = $connection->real_escape_string($_POST['store_id']);
      $userId     = $connection->real_escape_string($_POST['user_id']);
      if(!empty($_POST['method'])) {
          $method     = $connection->real_escape_string($_POST['method']);

          if($method == "check") {
            $selectQuery = "SELECT COUNT(*) as total FROM store_visitor WHERE user_id = ".$userId. " AND  is_checkin=1";
            $result = $connection->query($selectQuery);
            $row = $result->fetch_assoc();
            if($row['total'] > 0) {
              echo json_encode(
                    array(
                        "error"=>0,
                        "message_title"=>"You are already Checked-in!!",
                        "message_body"=>"Please Check-out when you leave")
                      );
            }
            exit; 
          } 
      }
      

      /* Check user id in store_visitor table 
         if found show you have already checked in.
         else  make entry in store_visitor table
      */
      $selectQuery = "SELECT COUNT(*) as total FROM store_visitor WHERE user_id = ".$userId. " AND  is_checkin=1";
      $result = $connection->query($selectQuery);
      $row = $result->fetch_assoc();
      if($row['total'] > 0) {
        echo json_encode(
              array(
                  "error"=>0,
                  "message_title"=>"You are already Checked-in!!",
                  "message_body"=>"Please Check-out when you leave")
                );
      } else {
          $insertQuery = "INSERT INTO store_visitor(store_id, user_id, is_checkin) VALUES(".$storeId.", ".$userId.", 1)";
          if( $connection->query($insertQuery) === TRUE ){
            echo json_encode(
              array(
                  "error"=>0,
                  "message_title"=>"Thanks for Check-in!!",
                  "message_body"=>"Please remember to Check-out when you leave")
                );
          }
      
      }
      
      
      
   } else {
        
   }
}
?>