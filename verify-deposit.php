
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


if (isset($_GET['approve'])){
    $id = $_GET['approve'];
    $query_o = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM deposit_requests WHERE id='$id'"));
    $user_id_approve = $query_o['user_id'];
    $approve_amount = $query_o['amount'];

    $sql = "UPDATE deposit_requests SET approved=1 WHERE id='$id'";
    mysqli_query($conn, $sql);


    //remove from user balance
    $query_2 = "UPDATE registered_users SET balance=balance+$approve_amount WHERE id='$user_id_approve'";
    mysqli_query($conn, $query_2);
}

else if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql = "DELETE FROM deposit_requests WHERE id='$id'";
    mysqli_query($conn, $sql);
}

require_once "nav.php"; 
?>
<div class="container">
<div class="row">
<table class="table">
<thead>

<tr>
<th scope="col">#</th>
<th scope="col">Username</th>
<th scope="col">Amount</th>
<th scope="col">Action</th>
</tr>
</thead>
<tbody>
<?php 
 $sql ="SELECT * FROM deposit_requests WHERE approved=0 ";
 $query = mysqli_query($conn, $sql);
 $requests=array();

 while ($x=mysqli_fetch_assoc($query)){
     $requests[]=$x;
 }

 //print_r($requests);

foreach($requests as $r){
    $id = $r['user_id'];
    $username = mysqli_fetch_assoc(mysqli_query($conn, "SELECT username FROM registered_users WHERE id = '$id'"))['username'];
    ?>
<tr>
<th scope="row">1</th>
<td><?php echo $username; ?></td>
<td><?php echo $r['amount']; ?></td>
<td> <a href="?approve=<?php echo $r['id'];?>"><button class="btn btn-primary btn-sm">APPROVE</button></a>
    <a href="?delete=<?php echo $r['id'];?>"><button class="btn btn-primary btn-sm btn-danger">DELETE</button></a>
</td>

</tr>

<?php } ?>



</tbody>
</table>

</div>
</div>

<script src="assets\bootstrap\js\bootstrap.min.js"></script>
