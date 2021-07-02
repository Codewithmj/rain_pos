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


  if (!in_array($user['email'], $admins)){
      die('You are not an admin');
  }

require_once "nav.php"; 
?>




<div class="inventory-div">
<center><h4>ALL TRANSACTIONS</h4></center> 

<?php
          $sql ="SELECT * FROM transactions ORDER BY time_paid DESC";
          $query = mysqli_query($conn, $sql);
          $transactions =array();

          while ($x=mysqli_fetch_assoc($query)) {
            $transactions[]=$x;
          }
?>

                            
<table class="table table-responsive">
    <thead>
      <tr>
            <th>Username</th>
            <th>Item</th>
            <th>Price</th>
            <th>Time</th>
      </tr>
    </thead>
    <tbody>

    <?php
          foreach($transactions as $t){
            $y= $t['user_id'];
            $sql2= "SELECT username FROM registered_users WHERE id ='$y'";
            $query2 = mysqli_query($conn, $sql2);
            $temp_user = mysqli_fetch_assoc($query2);
           // print_r($temp_user);

          ?>
    <tr>
            <td><?php echo $temp_user['username']; ?></td>  
               
            <td>
              <?php echo $t['item_name']; ?>
            </td>

           <td>  
              <?php echo $t['amount']; ?>   
            </td> 

            <td>           
            <?php echo days_ago( $t['time_paid']); ?>       
            </td> 
      </tr>

      <?php } ?>

    </tbody>
</table>


</div>






<script src="assets\bootstrap\js\bootstrap.min.js"></script>