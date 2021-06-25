<!--?php
//unset($_SESSION_DESTROY["id"]);
//unset($_SESSION_DESTROY["name"]);
//header("Location:login.php");
?-->

<?php
require "inc/conn.php";

session_destroy();

header("Location:login.php");

exit();



?>