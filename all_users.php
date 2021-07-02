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
<center><h4>ALL USERS</h4></center> 

<?php
          $sql ="SELECT * FROM registered_users";
          $query = mysqli_query($conn, $sql);
          $users =array();

          while ($x=mysqli_fetch_assoc($query)) {
            $users[]=$x;
          }
         
?>

                            
<table class="table table-responsive">
    <thead>
      <tr>
            <th>Username</th>
            <th>Balance</th>
            <th>Amount Spent</th>
      </tr>
    </thead>
    <tbody>

    <?php
          foreach($users as $t){
            $y= $t['id'];
            $sql2= "SELECT SUM(amount) AS Total FROM transactions WHERE user_id ='$y'";
            $query2 = mysqli_query($conn, $sql2);
            $total = mysqli_fetch_assoc($query2)['Total'];
          ?>
    <tr>
            <td><?php echo $t['username']; ?></td>  
               
            <td>
            <b>NGN </b><?php echo $t['balance'];?>
            </td>

           <td>  
           <b>NGN </b><?php echo $total;?>
         </td> 

      </tr>

      <?php } ?>

    </tbody>
</table>


</div>





<script src="assets\bootstrap\js\bootstrap.min.js"></script>