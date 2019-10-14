<?php
require('conn.php');
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
</head>

<body>

  <nav>

    <ul class="nav justify-content-center">
      <li class="nav-item">
        <a class="nav-link active" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Wildlife</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Community</a>
      </li>
    </ul>
  </nav>

  <main class="popularSection">
    <section class="row justify-content-center" style="padding: 5% 0% 5% 0%">
      <?php
      $sql = "SELECT * FROM communityanimals";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
          echo " <article class='col-4'>
      <a style='text-decoration:none; color:inherit' href='communitydetail.php?animal_id=1' >
    <div class='card' style='width: 24rem;'>
      <img src='" . $row["img_dir"] . "' class='card-img-top' alt='...'>
      <div class='card-body'>
        <h3>" . $row["animal_name"] . "</h3>
        <p class='card-text'>" . $row["description"] . "</p>
      </div>
    </div>
  </a>
  </article>";
        }
      } else {
        echo "0 results";
      }

      ?>


      <!-- <article class="col-4">
            <a style="text-decoration:none; color:inherit" href="detail.php" >
          <div class="card" style="width: 24rem;">
            <img src="imgs/banner.jpeg" class="card-img-top" alt="...">
            <div class="card-body">
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>
            </div>
          </div>
        </a>
        </article>


    
      <article class="col-4">
          <a  style="text-decoration:none; color:inherit" href="#" >
        <div class="card" style="width: 24rem;">
          <img src="imgs/banner.jpeg" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
              content.</p>
          </div>
        </div>
      </a>
      </article> -->


    </section>
    <button onclick="window.location.href='upload.php'">Upload</button>
  </main>

  <footer></footer>


</body>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>