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
        <div id="title-content"><div id="content">Home</div></div>
      </div>
    </div>

  <div id="footer">
    <div id="nav-bar">
      <div id="image-border"><a href="timetable.php"><img src="home.png" height="100%"></a></div>
      <div id="image-border"><a href="help.php"><img src="help.png" height="100%"></a></div>
      <div id="image-border"><a href="settings.php"><img src="setting.png" height="100%"></a></div>
    </div>
  </div>
  <div id="page-body">
    <?php
    $email = addslashes($_POST['email']);
    $password = addslashes($_POST['pass']);

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
          }else if ($userID == 2){
            header("Location:Home-S.php");
          }else if ($userID == 3){
            header("Location:Home-St.php");
          }else if ($userID == 4){
            header("Location:Home-A.php");
          }else{
            header("Location:login.php");
          }
        }
    }

    $file = $_SERVER['DOCUMENT_ROOT'] . "/helptext.txt";
    $current = file_get_contents ($file);
      $linesplit = explode(PHP_EOL,$current);
      foreach ($linesplit as &$workline) {
        if (strpos($workline, 'style') == false) {
          $order = "img";
          $replace = "img width = \"100%\"";
          $workline = str_replace($order, $replace, $workline);
        }
      }
      $withp = implode(PHP_EOL,$linesplit);
      echo $withp;
      mysqli_close($conn);
      ?>
    <br><br><br><br><br><br><!-- This is for readability on a computer, don't get rid of it. -->
    <script>autoSizeText();</script>
  </div>
</div>
