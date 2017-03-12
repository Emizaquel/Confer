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
    <form method="POST" action="">
      <input type="text" placeholder="Enter Email" name="email"><br>
      <input type="password" placeholder="Enter Password" name="pass"><br>
      <input type = "submit" name = "sub" value = "submit">
      <br>
      <br>

      <?php
      $email = $_POST['email'];
      $password = $_POST['pass'];
      echo $password;
      ?>
      <br>
      <?php
      $dbserver = "confer.scm.azurewebsites.net";
      $dbuser = "azure";
      $dbpass = "6#vWHD_$";
      $dbname = "localdb";

      $conn = mysql_connect($dbserver, $dbuser, $dbpass, $dbname);

      if(! $conn ) {
        die('Could not connect: ' . mysql_error());
      }

      $sql = "SELECT email FROM userdata WHERE usernumber = 1";
      mysql_select_db("conferdata");
      $retval = mysql_query( $sql, $conn );
      if(! $retval ) {
        die('Could not get data: ' . mysql_error());
      }

      echo $retval
      ?>
      <br><!-- This is for readability on a computer, don't get rid of it. -->
    </div>
  </div>
