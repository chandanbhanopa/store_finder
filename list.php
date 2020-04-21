<?php
include_once('connection.php');
$storeCollection = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   if(
    !empty($_POST['address_string']) && 
    !empty($_POST['store_name'])
 ) {
      $address = $connection->real_escape_string($_POST['address_string']);
      $storeName = $connection->real_escape_string($_POST['store_name']);
      $searchSring = $storeName. " ". $address;
      $sql =   "SELECT * FROM stores WHERE MATCH(store_name,address_line) AGAINST ('$searchSring' IN NATURAL LANGUAGE MODE);" ;
      $result = $connection->query($sql);
      if($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
            $storeCollection[] = $row;
         }
      }
   }
} else {
   $sql =   "SELECT * FROM stores" ;
      $result = $connection->query($sql);
      if($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
            $storeCollection[] = $row;
         }
      }
}

?>
<!doctype html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
   
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="Chandan Bhanopa">
   <meta name="generator" content="Jekyll v3.8.6">
   <title>Store Locator : Listing page</title>
   <!-- Bootstrap core CSS -->
   <link href="css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">
   <!-- Add icon library -->

   <!-- Custom styles for this template -->
   <link href="css/cover.css" rel="stylesheet">
   <script src="js/jquery.js"></script>
   <script src="js/popper.js"></script>
   <script src="js/bootstrap.js"></script>
</head>
<body>
      <div class="cover-container  container d-flex p-3 flex-column">
            <header class="masthead mb-auto">
               <!--Navbar-->
               <nav class="navbar navbar-expand-lg navbar-dark indigo mb-4">
                  <!-- Navbar brand -->
                  <a class="navbar-brand" href="/">
                     <img class="centerlogo" src="images/MediumSquareLogo.png" />
                  </a>

                  <span class="mobile-container">
                     <span class="mobile-checkin-message-text">You are check in please</span>
                     <br/>
                     <span><a href="javascript:void(0)" class="mobile-checkout-link">Checkout</a></span>
                  </span>


                  <!-- Collapsible content -->
                  <div class="top-searchbar">
                     <span id="top-message">Plan your visit and update your status to help others</span>
                     <span class="checkin_label">You are checked in</span>
                     <form class="ml-auto" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="md-form">
                           <input class="form-control searchinput" type="text" placeholder="Search for your daily store" aria-label="Search">
                        </div>
                        <div class="searchbox">
                           <button class="btn btn-outline-white btn-md my-0 ml-sm-2 searchbutton" type="submit">Search</button>
                           <button class="btn btn-primary btn-md my-0 ml-sm-2 checkout" type="button">Checkout</button>
                        </div>
                        
                     </form>
                  </div>

                  <!-- Collapsible content -->
               </nav>
            </header>
      </div>
      <div class="container" id="store-collection">
      <?php 
      if(count($storeCollection) > 0 ){ ?>
         <?php foreach($storeCollection as $key => $value ) { 
            $addressLineArray = explode(",", $value['address_line']);
            ?>
            <div class="row">
               <div class="column" >
                  <div class="row storelist">
                     <div class="col-md-6">
                        <div class="card">
                           <!--Card image-->
                           <div class="view overlay">
                              <img class="card-img-top" src="images/16.jpg"
                              alt="Card image cap">
                              <a href="#!">
                                 <div class="mask rgba-white-slight"></div>
                              </a>
                           </div>
                           <!--Card content-->
                           <div class="card-body">
                              <!--Title-->
                              <span>
                                 <span class="card-title"><?= $value['store_name']; ?></span>
                                 <a href=""  id = "<?= $value['id'];?>" class="mobile-checkout-btn">Check-in</a>   
                              </span>

                              <!--Text-->
                              <p class="card-text">
                                 <span><strong>Located in:</strong><?= $addressLineArray[1];?></span>
                                 <span><strong>Address:</strong>
                                    <?= $value['address_line'];?>
                                 </span>
                                 <span><strong>Phone No.: </strong><?= $value['phone'];?></span>

                              </p>
                              <p class="viewcount">Currently, <?= getStoreCount($connection, $value['id']) ;?> people visiting this store</p>
                              <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                           </div>


                        </div>

                        <!-- Card -->
                     </div>
                     <div class="col-md-6 right-side">
                        <h3 class="status"> Add your status here </h3>
                        <button  type="button" class="btn btn-light-blue btn-lg btn-primary check-in" id="<?= $value['id']; ?>" >Check in</button>
                     </div>
                  </div>
                  <!-- Row end-->
               </div>
            </div>
         <?php }
         ?>
      <?php } else { ?>

      <?php }
      ?>

      </div>
      <!-- The Modal -->
      <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                        <h4 class="modal-title">Thanks for Check-in!!</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                       <!-- Modal body -->
                       <div class="modal-body">
                          Please remember to Check-out when you leave
                       </div>

                       <!-- Modal footer -->
                       <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                       </div>

                  </div>
            </div>
      </div>

   <script type="text/javascript">
        //const baseUrl = "http://acrosoftwts.in/chandan/";
        const baseUrl = "http://local.pos.com/storelocator/";
        var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
        if(isMobile){
            $("body").addClass("mobile");
            $(".checkout").hide(); 
            $("#top-message").hide();
        } else {
            $("body").addClass("desktop");
        }
        
         var userId = "<?php echo rand(1,20);?>";
         $(document).ready(function(){
            if(isMobile){
                $(".checkout").hide(); 
            }
            $(".checkin_label").hide();
             if (isMobile) {
                            $(".mobile-container").hide();
                        }
            
            var $searchButton = $(".searchbutton");
            var $searchString = $(".searchinput");
            var $checkIn = $(".check-in");

            /***/
            var storeId = $(".check-in").attr('id');
            
            $.ajax({
                  type:"POST",
                  data:{store_id:storeId, user_id:userId, method:"check"},
                  url:baseUrl+"checkin.php",
                  dataType:"json", 
                  success:function(response){
                      if (isMobile) {
                            $(".mobile-container").show();
                            $(".checkout").hide();
                            $(".checkin_label").hide();
                        } else {
                             $(".mobile-container").hide();
                             $(".checkout").show();
                             $(".checkin_label").show();
                        }
                     
                  }
               });


            $searchButton.on("click",function(event){
               event.preventDefault();
               /* Remove space */
               var storeName =  $.trim($searchString.val());
               //if(storeName != ''){
                  $.ajax({
                     type:"POST",
                     data:{storeName:storeName},
                     url:baseUrl+"search_store.php",
                     dataType:"html", 
                     success:function(response){
                        $("#store-collection").html(response);
                     }
                  });   
               //}
               return false;
            });

            /* Check in functionality */
            $('body').on('click', '.check-in,.mobile-checkout-btn', function(event) {
               event.preventDefault();
               var storeId = $(this).attr('id');
               
               $.ajax({
                     type:"POST",
                     data:{store_id:storeId, user_id:userId},
                     url:baseUrl+"checkin.php",
                     dataType:"json", 
                     success:function(response){
                       
                         if (isMobile) {
                            $(".mobile-container").show();
                            $(".checkout").hide();
                             $(".checkin_label").hide();
                        } else{
                             $(".checkout").show();
                             $(".checkin_label").show();
                        }
                        $(".checkout").attr("data-store_id",storeId);
                        $(".modal-title").empty().html(response.message_title);
                        $(".modal-body").empty().html(response.message_body);
                        $('#myModal').modal();
                     }
                  });   

            });


            /* Check out functionality */
            $('body').on('click', '.checkout,.mobile-checkout-link', function(event) {
               event.preventDefault();
               //let storeId = $(".checkout").attr("data-store_id");
               

               $.ajax({
                     type:"POST",
                     data:{user_id:userId},
                     url:baseUrl+"checkout.php",
                     dataType:"json", 
                     success:function(response){
                        $(".checkout").hide();
                        $(".checkin_label").hide();
                        if (isMobile) {
                            $(".mobile-container").hide();
                        }
                        
                        $(".modal-title").empty().html(response.message_title);
                        $(".modal-body").empty().html(response.message_body);
                        $('#myModal').modal();
                     }
                  });   

            });
            

         });
   </script>   
</body>
</html>