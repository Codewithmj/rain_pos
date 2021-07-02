

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
require "nav.php";

if (isset($_POST['update'])){

    $id = $_POST['update'];
    $item_name = $_POST['item_name'];
    $stock = $_POST['stock'];
    $amount = $_POST['amount'];

    $sql = "UPDATE items SET item_name ='$item_name', stock ='$stock',amount ='$amount' WHERE id = '$id' ";

    if(mysqli_query($conn, $sql)){
        echo "UPDATE SUCCESSFUL";
    }else{
        echo "COULD NOT UPDATE";
    }
    header("Location:inventory.php");
    exit();
}

if (isset($_POST['add'])){
    $item_name = $_POST['item_name'];
    $stock = $_POST['stock'];
    $amount = $_POST['amount'];

    $sql = "INSERT INTO items(item_name, stock, amount) VALUES ('$item_name', '$stock', '$amount')";

    if(mysqli_query($conn, $sql)){
        echo "ADD SUCCESSFUL";
    }else{
        echo "COULD NOT ADD";
    }
}



?>

<div class="inventory-div">

<center><h4>INVENTORY</h4></center>
<table class="table table-responsive">
    <thead>
        <tr>
            <th>Item</th>
            <th>Stock</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <tr>
            <form method="post">
                <input type="hidden" name="add" value="1">
            <td><input class="form-control" name="item_name" style="max-width: 100px;"></td>
        

            <td><input class="form-control" name="stock" style="max-width: 100px;" type="number" min="0"></td>


            <td><input class="form-control" name="amount" style="max-width: 100px;" type="number" step="10" min="0"></td>
           
            <td>
              <button type="submit" class="btn btn-sm ">ADD</button>
            </td>
            </form>
      </tr>
        <?php
        $sql = "SELECT * FROM items";
        $query= mysqli_query($conn, $sql);
        $items = array();

        while ($x=mysqli_fetch_assoc($query)){
            $items[]=$x;
        }

        //print_r($items);

            foreach ($items as $i){
        ?>



        <tr>
            <form method="post">
                <input type="hidden" name="update" value="<?php echo $i['id'];?>">
            <td><input value="<?php echo $i['item_name'];?>" class="form-control" name="item_name" style="max-width: 100px;"></td>
        

            <td><input value="<?php echo $i['stock'];?>" class="form-control" name="stock" style="max-width: 100px;" type="number" min="0"></td>


            <td><input value="<?php echo $i['amount'];?>" class="form-control" name="amount" style="max-width: 100px;" type="number" step="10" min="0"></td>
           
            <td>
              <button type="submit" class="btn btn-sm btn-primary">UPDATE</button>
                <!--a href="?delete =<!?php echo $i['id'];?>"><button type="submit" class="btn btn-danger">
                DELETE</button> </a -->
            </td>
            </form>
      </tr>
        <?php 
            }
            ?>
    
    </tbody>
</table>

</div>