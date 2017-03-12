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
    $usernumber = "123";
    echo $usernumber;
    ?>
    <br><!-- This is for readability on a computer, don't get rid of it. SELECT usernumber FROM userdata WHERE email = $_POST['email'] AND password = $_POST['email']-->
  </div>
</div>
