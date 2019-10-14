<?php
require('conn.php');
session_start();
echo $_GET['animal_id'];

$sql = "SELECT * FROM animals";
$result = $conn->query($sql);

$animal_id = $_GET['animal_id'];
$sqlComments = "SELECT * FROM comments WHERE animal_id = $animal_id";
$resultComments = $conn->query($sqlComments);

$sqlanimaldetail = "SELECT * FROM communityanimals WHERE animal_id=$animal_id";
$resultAnimal =  $conn->query($sqlanimaldetail);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Weird but Wonderful</title>
  <link rel="stylesheet" type="text/css" href="css/index.css" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <style>
    /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
    #map {
      height: 100%;
    }

    /* Optional: Makes the sample page fill the window. */
    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
  </style>
</head>

<body>
  <nav>

    <ul class="nav justify-content-center">
      <li class="nav-item">
        <a class="nav-link active" href="index.html">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Wildlife</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Community</a>
      </li>

      <?php
      if (isset($_SESSION['user_name'])) {
        echo "<li> <button >" . $_SESSION['user_name'] . "</button></li>";
        $logoutUrl = "window.location.href='logout.php'";
        echo "<li> <button onclick=" . $logoutUrl . ">" . "Logout </button></li>";
      } else {
        $loginUrl = "window.location.href='login.php'";

        echo "<li> <button onclick=" . $loginUrl . ">" . "Login </button></li>";
      }
      // <li>
      //   <button onclick="window.location.href='login.php'">Login</button>
      // </li>

      ?>
    </ul>
  </nav>
  <div class="container">
    <h1> Detail Information</h1>
    <div class="row">
      <div class="col-8">INFO
        <div class="wikipedia"></div>

        <div> <?php

              if ($resultAnimal->num_rows > 0) {
                // output data of each row
                while ($row = $resultAnimal->fetch_assoc()) {
                  // echo "id: " . $row["id"]. " - Name: " . $row["user_name"]. " " . $row["text"]. "<br>";
                  echo "<li class='media'>
    <img class='mr-3'>
    <div class='media-body'>
      <h5 class='mt-0 mb-1'>" . $row["animal_name"] . "</h5>" . $row["description"] . " </div>
      </li>";
                }
              } else {
                echo "0 results";
              }
              mysqli_close($conn);
              ?>
        </div>


        <div class="container">
          <div class="row">
            <div class="col">
              <img src="imgs/banner.jpeg" class="card-img-top" alt="...">
            </div>
            <div class="col">
              <img src="imgs/banner.jpeg" class="card-img-top" alt="...">
            </div>
          </div>
        </div>

        <p style="margin-top: 2%">dfasdfasdfdsafdsfdsfds</p>
        <div class="wikipedia"></div>
        <div class="container">
          <div class="row">
            <div class="col-12">
              <iframe width="560" height="315" src="https://www.youtube.com/embed/JoduGti4G_k" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

            <div class="col-12" style="height: 300px; width:560px">
              <div id="map"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-4">
        <ul class="list-group">
          <h3>Comments</h3>
          <ul class="list-unstyled">
            <?php

            if ($resultComments->num_rows > 0) {
              // output data of each row
              while ($row = $resultComments->fetch_assoc()) {
                // echo "id: " . $row["id"]. " - Name: " . $row["user_name"]. " " . $row["text"]. "<br>";
                echo "<li class='media'>
                <img class='mr-3'>
                <div class='media-body'>
                  <h5 class='mt-0 mb-1'>" . $row["user_name"] . "</h5>" . $row["text"] . " </div>
                  </li>";
              }
            } else {
              echo "0 results";
            }
            // mysqli_close($conn);
            ?>
            <li class="media my-4">
              <img src="..." class="mr-3" alt="...">
              <div class="media-body">
                <h5 class="mt-0 mb-1">List-based media object</h5>
                Cras sit amet nibh libero,
            </li>
            <li class="media">
              <img src="..." class="mr-3" alt="...">
              <div class="media-body">
                <h5 class="mt-0 mb-1">List-based media object</h5>
                Cras sit amet nibh libero,
            </li>
          </ul>

          <form action="insert.php" method="post" style="margin-top: 5%">
            <div class="form-group">
              <label for="exampleFormControlTextarea1">
                <h3>Add Comment</h3>
              </label>
              <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-outline-secondary">Submit</button>
          </form>

      </div>
    </div>
  </div>

  <footer style="height:500px">
    <?php

    # header('Content-Type: application/json');

    #$data = file_get_contents("https://apps.des.qld.gov.au/species/?op=getsurveysbyspecies&taxonid=552");

    #echo $data;

    ?>
  </footer>


</body>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="js/qsl.js"></script>

<script>
  function initMap() {
    var myLatLng = {
      lat: -25.363,
      lng: 131.044
    };

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 4,
      center: myLatLng
    });

    var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      title: 'Hello World!'
    });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7ic3tQGVvG2hwAXByzCqk4LsNarI1eUE&language=en&callback=initMap" async defer></script>



</html>