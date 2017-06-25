<?php

$dbserver = "127.0.0.1";
$port = "52090";
$dbuser = "azure";
$dbpass = "6#vWHD_$";
$dbname = "localdb";

$conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect('p:127.0.0.1', 'azure', '6#vWHD_$', 'localdb', 52090));

if(! $conn ) {
  echo ('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
}
?>
