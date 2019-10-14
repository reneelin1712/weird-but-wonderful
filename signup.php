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
        <h1>Sign Up</h1>

        <form action="signup.php" method="POST">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1" require pattern="(?=.*\d)(?=.*[a-z]).{3,}">
                  <p>at least one number,one letter and 3 characters</p>
                </div>
                <div class="form-group">
                        <label for="exampleInputPassword1">Username</label>
                        <input type="text" name="user_name" class="form-control" id="username">
                        <span id="availability"></span>
                </div>

                <button type="submit" name="signup" class="btn btn-primary">Submit</button>
                
              </form>

    </div>



        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

</body>
<script>  
 $(document).ready(function(){  
   $('#username').blur(function(){

     var username = $(this).val();

     $.ajax({
      url:'check.php',
      method:"POST",
      data:{user_name:username},
      success:function(html)
      {
         $('#availability').html(html);
      }
     });

  });
 });  
</script>
</html>


<?php
  if(isset($_POST['signup'])){

        $_SESSION['email']=$_POST['email'];
        // $_SESSION['password']=$_POST['password'];
        $_SESSION['user_name']=$_POST['user_name'];
      
        $email = $_POST['email'];
        // $password = $_POST['password'];
        $password= password_hash($_POST['password'], PASSWORD_DEFAULT);
        // $_SESSION['password']=$_POST['password'];
        $_SESSION['password']=$password;
        $user_name = $_POST['user_name'];
     
        
        //$mysqli = mysqli_connect("localhost","root","","users");
        
        $resultEmail = $conn->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());
        $resultUsername = $conn->query("SELECT * FROM users WHERE user_name='$user_name'") or die($mysqli->error());

        if ($resultEmail->num_rows > 0){
            $_SESSION['message'] = 'Email already exists!';
            echo $_SESSION['message'];
            // header("location: error.php");
        }else if($resultUsername->num_rows > 0){
            $_SESSION['message'] = 'user already exists!';
            header("location: error.php");    
        }
        else {
            
            $sql = "INSERT INTO users (email,password,user_name)"
                    ."VALUES ('$email','$password', '$user_name')";
            $conn->query($sql);
                    // if ( $conn->query($sql) ){
                        
                    //     $_SESSION['active'] = 0; //0 until user activates their account with verify.php
                    //     $_SESSION['logged_in'] = true;
                    //     $_SESSION['message'] =
                        
                    //      "Confirmation link has been sent to $email, please verify
                    //      your account by clicking on the link in the message!";
        
                    //     // Send registration confirmation link (verify.php)
                    //     $to      = $email;
                    //     $subject = 'Account Verification';
                    //     $message_body = 'Hello '.$first_name.',
        
                    //     Thank you for signing up!
        
                    //     Please click this link to activate your account:
        
                    //     http://ec2-13-239-54-101.ap-southeast-2.compute.amazonaws.com/verify.php?email='.$email;  
        
                    //     mail( $to, $subject, $message_body );
                
                    //         // header("location: profile.php"); 
                
                    //     } else {
                    //     $_SESSION['message'] = 'Registration failed!';
                    //     header("location: error.php");
                    // }
                
                }
        
  }

?>