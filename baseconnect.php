<?php

$dbserver = "127.0.0.1";
$port = "51097";
$dbuser = "azure";
$dbpass = "6#vWHD_$";
$dbname = "localdb";

$conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect($dbserver,  $dbuser,  $dbpass, $port));

if(! $conn ) {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
}
?>
