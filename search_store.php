<?php
include_once('connection.php');
$storeCollection = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   if(
    !empty($_POST['storeName'])
 ) {
      $storeName = $connection->real_escape_string($_POST['storeName']);
      $searchSring = $storeName;
      $sql =   "SELECT * FROM stores WHERE MATCH(store_name) AGAINST ('$searchSring' IN NATURAL LANGUAGE MODE);" ;
      $result = $connection->query($sql);
      if($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
            $storeCollection[] = $row;
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
}
?>
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
                                 <a href="javascript:void(0)"  id = "<?= $value['id'];?>" class="mobile-checkout-btn">Check-in</a>    
                              </span>

                              <!--Text-->
                              <p class="card-text" style="word-wrap: break-word;white-space: initial;">
                                 <span><strong>Located in:</strong><?= $addressLineArray[1];?></span>
                                 <span style="white-space: initial;"><strong>Address:</strong>
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
                        <button type="button" class="btn btn-light-blue btn-lg btn-primary check-in"  id="<?= $value['id']; ?>">Check in</button>
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