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
          Event Name
        </div>
      </div>
    </div>

  <div id="footer">
    <div id="nav-bar">
    </div>
  </div>
  <div id="page-body">
    <?php

    if(!isset($_COOKIE["UserID"])) {
      echo "Cookie named UserID is not set!";
    } else {
        echo "Cookie UserID is set!<br>";
        echo "Value is: " . $_COOKIE["UserID"];
    }

    ?>
    <br><!-- This is for readability on a computer, don't get rid of it. -->
  </div>
</div>
