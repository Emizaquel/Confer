<head>
  <link rel="stylesheet" type="text/css" href="general.css">
</head>
<div id="wrapper">
  <div id="header">
    <div id="logo-pane">
      <div id="logo-content">
        <div id="image-border"><img src="Logo.jpg" width="100%"></div>
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
      $dbserver = "127.0.0.1:51097";
      $dbuser = "azure";
      $dbpass = "6#vWHD_$";
      $dbname = "localdb";

      $conn = mysql_connect($dbserver, $dbuser, $dbpass, $dbname);

      if(! $conn ) {
        die('Could not connect: ' . mysql_error());
      }

      $sql = ("SELECT usernumber FROM userdata WHERE email = '" . $email . "' AND password = '" . $password . "';");
      mysql_select_db("conferdata");
      $retval = mysql_query( $sql, $conn );
      if($retval ) {
        $query = mysql_fetch_row($retval);

        setcookie("UserID", $query, time() + (86400 * 30), "/");
        echo $query[0];
      }else{
        echo "User Details Not Valid";
      }
      ?>
      <br><!-- This is for readability on a computer, don't get rid of it. -->
    </div>
  </div>
