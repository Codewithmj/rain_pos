
<?php 
//print_r($_POST);
require_once "inc/conn.php"; 
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
if ( isset($_POST['deposit']) and !empty($_POST['deposit']) ){
    $deposit = $_POST['deposit'];
// check if between 100 - 5000
  if  ($deposit>=100 and $deposit<=5000 ){
     
        $sql = "INSERT INTO deposit_requests (user_id, amount) VALUES ($user_id, $deposit)";
        mysqli_query($conn, $sql);
        $deposit_status = true;
        }
  else{
      $error= "You can only deposit between 100 and 5000 naira";
  }
}
require_once "nav.php"; 
     ?>

      <br>
      <br>
      <div class="container">
          <div class="row">
              <div class="col-lg-3"></div>


              <?php if(isset($deposit_status)) { ?>
                <div class="col-lg-6" style="border: 1px solid #cfcfcf;">
                <br>
                <h5> Your deposit was recorded successfully and is now awaiting approval.</h5>
                <br>
                </div>

           <?php } else{ ?>
              <div class="col-lg-6" style="border: 1px solid #cfcfcf;">
                <br>
                <?php if (isset($error)): ?>
                <div class="p-2 alert-danger"><?php echo $error; ?></div>
                <br>
                <?php endif?>
               <center>
              <h5>Enter the amount you would like to deposit with the admin </h5>
            </center>
            <br>
            <form method="post">
               <input type="number" min="100" step="50" class="form-control" name="deposit" value="500">
                <br>
        <center> <div class="d-grid gap-2"><button class="btn btn-primary" type="submit">DEPOSIT</button></div></center>
                <br>
                </form>

            </div>
            <?php } ?>



              <div class="col-lg-3"></div>
              
          </div>
      </div>

      <script src="assets\bootstrap\js\bootstrap.min.js"></script>
      </body>
      </html>   