
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
if ( isset($_POST['item']) and !empty($_POST['item']) ){
    $item = $_POST['item'];

  if  ($item_array = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM items WHERE id='$item'"))){
        $item_amount = $item_array['amount'];
        $item_stock = $item_array['stock'];
        $item_name= $item_array['item_name'];
            //check balance
    if($user['balance'] >=$item_amount){
        //update stock amount
        $query_1 = "UPDATE items SET stock=stock-1 WHERE id = '$item'";
        mysqli_query($conn, $query_1);
        //remove from user balance
        $query_2 = "UPDATE registered_users SET balance=balance-$item_amount WHERE id='$user_id'";
        mysqli_query($conn, $query_2);
        //add transaction row to db
        $query_3 = "INSERT INTO transactions(user_id, item_name, amount) VALUES ('$user_id', '$item_name', '$item_amount')";
        mysqli_query($conn, $query_3);
        header("Location:index.php");
        exit();

        }else{
            $error = "Insufficient Funds!";
        }
  }else{
      $error= "id not found";
  }
}
require_once "nav.php"; 
     ?>

      <br>
      <br>
      <div class="container">
          <div class="row">
              <div class="col-lg-3"></div>
              <div class="col-lg-6" style="border: 1px solid #cfcfcf;">
                <br>
                <?php if (isset($error)): ?>
                <div class="p-2 alert-danger"><?php echo $error; ?></div>
                <br>
                <?php endif?>
               <center>
                <small>Current Balance:</small>
                <h2><?php echo $user['balance'];?></h2>
            </center>
            <br>
            <form  method="post">
                <select name="item" class="form-select" aria-label="Floating label select example">
                  <option selected>Select item</option>
                  <?php 
                  $sql = "SELECT * FROM items WHERE stock>0";
                  $query = mysqli_query($conn, $sql);
                  $items =array();
                  while($x= mysqli_fetch_assoc($query)){
                      $items[]=$x;
                  }
                  foreach ($items as $i){ 
                      ?>
                    <option value="<?php echo $i['id']; ?>"><?php echo $i['item_name']; ?> - NGN <?php echo $i['amount']; ?> (<?php echo $i['stock'];?> left)</option>
                      <?php
                  }
                  ?>
                </select>
                <br>
        <center> <div class="d-grid gap-2"><button class="btn btn-primary" type="submit">BUY</button></div></center>
                <br>
                </form>

            </div>
              <div class="col-lg-3"></div>
              
          </div>
      </div>

      <script src="assets\bootstrap\js\bootstrap.min.js"></script>
      </body>
      </html>   