<?php
require 'conn.php';
session_start();
?>


<!DOCTYPE html5>
<html>

<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="login.css"> -->
</head>



<body>
  <div class="container">
    <nav>

      <ul class="nav justify-content-center">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Wildlife</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="community.php">Community</a>
        </li>

      </ul>
    </nav>
    <h1>Login</h1>

    <form action="login.php" method="POST">
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
      </div>
      <div class="form-group form-check">
        <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Remember me</label>
      </div>
      <p><button type="submit" name="login" class="btn btn-primary">Submit</button>&nbsp or <a href="signup.php">Sign Up</a></p>

    </form>

  </div>






  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>

</html>

<?php
if (isset($_POST['login'])) {
  // $mysqli = mysqli_connect("localhost", "root", "123", "wbw");

  $email = $_POST['email'];
  $result = $conn->query("SELECT * FROM users WHERE email='$email'");


  if ($result->num_rows == 0) {
    $_SESSION['message'] = "User doesn't exist!";
    header("location: error.php");
  } else { // User exists
    $user = $result->fetch_assoc();

    // if ($_POST['password']==$user['password']) {
    if (password_verify($_POST['password'], $user['password'])) {
      echo "right";
      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['user_name'] = $user['user_name'];
      // $_SESSION['first_name'] = $user['first_name'];
      // $_SESSION['last_name'] = $user['last_name'];
     


      $_SESSION['logged_in'] = true;
      if (isset($_POST['remember'])) {
        $cookie_name = "email";
        $cookie_password = "password";
        setcookie($cookie_name, $email, time() + 3600 * 48);
        setcookie($cookie_password, $_POST['password'], time() + 3600 * 48);
        // if(isset($_COOKIE[$cookie_name])){
        //   echo $_COOKIE[$cookie_name];
        //   }
        // if (isset($cookie_password)){
        //   echo $_COOKIE[$cookie_password];
        // }


      }
      header("location:index.php");
    } else {
      $_SESSION['message'] = "Wrong password, try again!";
      // header("location: error.php");
      echo $_SESSION['message'];
    }
  }
}

?>