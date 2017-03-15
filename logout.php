<?php
  setcookie("UserID", $userID, time() + (86400 * 30), "/");
  header("Location:Login.php");
?>
