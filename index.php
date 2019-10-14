<?php
require('conn.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Weird but Wonderful</title>
  <link rel="stylesheet" type="text/css" href="css/index.css" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
<?php 
echo "hello world";
if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];}


$sql = "SELECT * FROM animals";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["info"]. "<br>";
  }
} else {
  echo "0 results";
}

?>
  <nav>

    <ul class="nav justify-content-center">
      <li class="nav-item">
        <a class="nav-link active" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Wildlife</a>
      </li>
      <li class="nav-item">
        <a  class="nav-link" href="community.php">Community</a>
      </li>

      <?php
      if(isset($_SESSION['user_name'])){
        echo"<li> <button >". $_SESSION['user_name']."</button></li>";
        $logoutUrl = "window.location.href='logout.php'";
        echo"<li> <button onclick=".$logoutUrl.">". "Logout </button></li>";
      } else{
        $loginUrl = "window.location.href='login.php'";
       
        echo"<li> <button onclick=".$loginUrl.">". "Login </button></li>";
        
      }
      // <li>
      //   <button onclick="window.location.href='login.php'">Login</button>
      // </li>

      ?>
    </ul>
  </nav>

  <div class="header">
    <div class="banner">
      <h1>Weird but Wonderful</h1>
      <p>Welcome</p>
      <div class="bannerBtn"><a style="text-decoration:none; color:inherit" href="#">Start Explore</a></div>

    </div>
  </div>

  <main class="popularSection">
    <section class="row justify-content-center" style="padding: 5% 0% 5% 0%">

        <article class="col-4">
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
      </article>

     
    </section>

  </main>

  <footer></footer>


</body>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
  integrity="#" crossorigin="anonymous"></script>

</html>
