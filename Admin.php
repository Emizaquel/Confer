<head>
<link rel="stylesheet" type="text/css" href="general.css">
<link rel="icon" type="image/png" href="icon.ico">
<script src="scripts.js"></script>
</head>
<div id="wrapper">
  <div id="header">
    <div id="logo-pane">
        <div id="logo-content">
          <div id="image-border"><a href="home.php"><img src="Logo.jpg" width="100%"></a></div>
        </div>
      </div>
      <div id="title-pane">
        <div id="title-content"><div id="content">Admin</div></div>
      </div>
    </div>

  <div id="footer">
    <div id="nav-bar">
    </div>
  </div>
  <div id="page-body">
    <?php
    include("baseconnect.php");

    if(!isset($_COOKIE["UserID"])) {
      header("Location:login.php");
    } else {
        $UID = $_COOKIE["UserID"];

        $sql = ("SELECT type FROM userdata WHERE usernumber = '" . $UID . "';");
        ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
        $retval = mysqli_query( $conn ,  $sql);

        if($retval ) {
          $query = mysqli_fetch_row($retval);
          $userID = $query[0];

          if($userID == 1){
            header("Location:Home-U.php");
          }else if ($userID == 2){
            header("Location:Home-S.php");
          }else if ($userID == 3){
            header("Location:Admin-St.php");
          }else if ($userID == 4){
            header("Location:Admin-A.php");
          }else{
            header("Location:login.php");
          }
        }
    }
    mysqli_close($conn);
    ?>
    <br><!-- This is for readability on a computer, don't get rid of it. -->
    <script>autoSizeText();</script>
  </div>
</div>
