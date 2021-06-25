<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RAIN POS</title>
    <link rel="stylesheet" href="assets\bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php require_once "inc/conn.php"; 
if(!isset($_SESSION['user_id']) or empty($_SESSION['user_id'])
){ header("Location:login.php");
   exit();

}
// adding more rows
  $user_id = $_SESSION['user_id'];
  $sql= "SELECT * FROM registered_users WHERE ID ='$user_id'";
  $query = mysqli_query($conn, $sql);
  $user = mysqli_fetch_assoc($query);
  //print_r($user);



     require_once "nav.php"; ?>
    
      <br>
      <br>
      <br>
      <div class="container">
        <div class="row">
            <div class="col-lg-4" style = "border: 1px solid #cfcfcf;margin-bottom: 50px;">
              <br>
              <div class="profile-image"></div>
              <center>
                <h2>NGN <?php echo $user['balance'];?></h2>
               <a href="load-wallet.php"> <button class="btn btn-primary">LOAD WALLET</button></a>

              </center>
              <br>

              <ul class="list-group list-group-flush">
                <li class="list-group-item"> <h2><center><?php echo $user['username'];?></center></h2> </li>
                <li class="list-group-item">Balance: <b>NGN </b><?php echo $user['balance'];?></li>
                <li class="list-group-item">Last Login: <?php echo $user['last_login'];?></li>
              </ul>  

            </div>
            <div class="col-lg-8"> <h3>Transactions <a href="buy.php"><button class="btn btn-primary float-end">BUY NOW </button> </a></h3></h3>
              <br>

          <?php
          $sql ="SELECT * FROM transactions WHERE user_id='$user_id'";
          $query = mysqli_query($conn, $sql);
          $transactions =array();

          while ($x=mysqli_fetch_assoc($query)) {
            $transactions[]=$x;
          }

          foreach($transactions as $t){

          ?>
              <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><?php echo $t['item_name']; ?></h5>
                    <small class="text-muted"><?php echo days_ago( $t['time_paid']); ?></small>
                  </div>
                  <p class="mb-1">-<?php echo $t['amount']; ?> naira</p>
                  <small class="text-muted"><?php echo $t['comment'];?></small>
                </a>
              </div>
              
           <?php } ?>

            </div>
        </div>
      </div>

<script src="assets\bootstrap\js\bootstrap.min.js"></script>
</body>
</html>