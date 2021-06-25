<?php 
require_once "inc/conn.php";

if (
isset($_POST['email']) and  !empty($_POST['email']) and
isset($_POST['password']) and !empty($_POST['password']) and
isset($_POST['username']) and !empty($_POST['username'])
) {
    $email =  $_POST['email'];
    $password =  md5($_POST['password']);
    $username =  $_POST['username'];

    $check_email = mysqli_query($conn, "SELECT id FROM registered_users WHERE email='$email' ");
    if ($check_email->num_rows == 0){

    $register_sql = "INSERT INTO 
    registered_users(username, email, password) 
    VALUES ('$username', '$email', '$password')";
        if($register_query = mysqli_query($conn,$register_sql)){
            //echo "Successfully Registered";
            header("Location:login.php");
            exit();
        }else{
            $error = "An sql error occurred";
        }

    }else{
      $error = "Email has already been registered";
    }
}
else{
  $error = "All fields are required";
}




?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>SIGN IN RAIN</title>
    <link rel="stylesheet" href="assets\bootstrap\css\bootstrap.min.css">
  </head>

    <style>

html,
body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

.form-floating{
  margin-bottom: 10px;
}
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form method="post">
    <img class="mb-4" src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Register</h1>
      <?php if(isset($error)){ ?>
    <div  style="color: red; margin-bottom: 10px;"><?php echo $error; ?></div>
        <?php } ?>
 
    <div class="form-floating">
      <input name="username" type="text" class="form-control" id="floatingInput2" placeholder="Type your username">
      <label for="floatingInput2">Username</label>
    </div>
    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
  </form>
</main>


    
  </body>
</html>
