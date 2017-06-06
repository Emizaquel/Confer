<head>
  <?php
  $dbserver = "127.0.0.1";
  $port = "51097";
  $dbuser = "azure";
  $dbpass = "6#vWHD_$";
  $dbname = "localdb";

  $conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect($dbserver,  $dbuser,  $dbpass, $port));

  mysqli_close($conn);
  ?>

<meta http-equiv="refresh" content="0; url=Login.php" />
<link rel="icon" type="image/png" href="icon.ico">
<link rel="stylesheet" type="text/css" href="general.css">
</head>
