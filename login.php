<?php 
require_once "inc/conn.php";
//print_r($_SESSION);
//echo md5('q');
if (isset($_POST['email']) and !empty($_POST['email']) and
isset($_POST['password']) and !empty($_POST['email'])

){
    $email =  $_POST['email'];
    $password= md5($_POST['password']);

    $check = mysqli_query($conn, "SELECT id FROM registered_users WHERE email='$email' AND password = '$password' ");
    if ($check->num_rows == 1){
       // echo "Successful";
       $user_id= mysqli_fetch_assoc($check)['id'];
       $_SESSION['user_id']=$user_id;
       mysqli_query($conn, "UPDATE registered_users SET last_login=CURRENT_TIME WHERE email='$email'");

       header("Location:index.php");
       exit();
    }else{
        $error = "Invalid Email/Password";
    }
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
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    <?php if(isset($error)){ ?>
    <div  style="color: red; margin-bottom: 10px;"><?php echo $error; ?></div>
        <?php } ?>

    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
  </form>
</main>


    
  </body>
</html>