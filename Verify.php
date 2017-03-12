<!--
<head>
<link rel="stylesheet" type="text/css" href="general.css">
</head>
<div id="wrapper">
  <div id="header">
    <div id="logo-pane">
        <div id="logo-content">
          <div id="image-border"><a href="home.php"><img src="Logo.jpg" width="100%"></a></div>
        </div>
      </div>
      <div id="title-pane">
        <div id="title-content">
          Login
        </div>
      </div>
    </div>

  <div id="footer">
    <div id="nav-bar">
    </div>
  </div>
  <div id="page-body">


    <br>
  </div>
</div>
-->

<!--
$servername = "confer.scm.azurewebsites.net";
$username = "azure";
$password = "6#vWHD_$";
$dbname = "localdb";
-->

<!-- This is for readability on a computer, don't get rid of it. -->

<html>
<body>

  <?php
  if(!isset($_COOKIE["usernumber"])) {
      echo "Cookie named usernumber is not set!";
  } else {
      echo "Cookie usernumber is set!<br>";
      echo "Value is: " . $_COOKIE["usernumber"];
  }
  ?>

</body>
</html>
