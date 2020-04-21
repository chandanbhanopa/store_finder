  <!doctype html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Store Locator chandan bhanopa">
  <meta name="generator" content="Jekyll v3.8.6">
  <title>Store Locator</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <!-- Add icon library -->
  <!-- Custom styles for this template -->
  <link href="css/cover.css" rel="stylesheet">
  
</head>
<body class="text-center">
  <div class="cover-container  container d-flex p-3 flex-column">
    <div role="" class="container">
      <div class="row">
        <div class="col-sm-3 col-md-6 col-lg-4" id="left">
          <p>Simply Check-in when you visit Check-out when you leave</p>
          <p>Based on your responses and many others like</p> 
          <p>you UnQue tells you how many people are currently at the store</p>
        </div>
        <div class="col-sm-9 col-md-6 col-lg-8">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12" id="center-logo-image">
          <img class="centerlogo" src="images/MediumSquareLogo.png" />
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12" id="center-text">
          <span>Plan your visit and update your status to help others</span>

        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 justify-content-center" id="search-form">
          <form class="form-inline justify-content-center" action="list.php" method="POST">
            <div class="form-group mb-2 place" >
              <input 
                type="text" 
                class="form-control form-control-lg" 
                id="autocomplete" 
                value="" 
                placeholder="Your Neighbourhood"
                onFocus="geolocate()"
                name="address_string"
                 />
            </div>
            <div class="form-group mx-sm-3 mb-2 store">
              <input type="text" class="form-control form-control-lg" id="store_name" name="store_name" placeholder="Search for your daily store">
            </div>
            <button type="submit" class="btn btn-primary mb-2 btn-lg main-search">Search</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript" src="js/myscript.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbVkhkwqO4-6blDJh8i_EpyrFD7_IdA28&libraries=places&callback=initAutocomplete"
async defer></script>
</body>
</html>