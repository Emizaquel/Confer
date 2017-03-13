<head>
<link rel="stylesheet" type="text/css" href="general.css">
<link rel="icon" type="image/png" href="icon.ico">
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
          <?php
          $dbserver = "127.0.0.1:51097";
          $dbuser = "azure";
          $dbpass = "6#vWHD_$";
          $dbname = "localdb";

          $conn = mysql_connect($dbserver, $dbuser, $dbpass, $dbname);

          if(! $conn ) {
            die('Could not connect: ' . mysql_error());
          }

          if(isset($_GET["EventID"])){
            $EventID = $_GET["EventID"];
            $sql = ("SELECT eventname FROM eventdata WHERE eventnumber = " . $EventID . ";");
            mysql_select_db("conferdata");
            $retval = mysql_query( $sql, $conn );

            if($retval) {
              $query = mysql_fetch_row($retval);

              $EName = $query[0];

              if($EName){
                echo $EName;
              }else{
                echo "User Details Not Valid";
              }
            }else{
            }
          }
          ?>
        </div>
      </div>
    </div>

  <div id="footer">
    <div id="nav-bar">
      <div id="image-border"><a href="timetable.php"><img src="home.png" height="100%"></a></div>
      <div id="image-border"><a href="admin.php"><img src="admin.png" height="100%"></a></div>
      <div id="image-border"><a href="help.php"><img src="help.png" height="100%"></a></div>
      <div id="image-border"><a href="settings.php"><img src="setting.png" height="100%"></a></div>
    </div>
  </div>
  <div id="page-body">
    <?php
    $dbserver = "127.0.0.1:51097";
    $dbuser = "azure";
    $dbpass = "6#vWHD_$";
    $dbname = "localdb";

    $conn = mysql_connect($dbserver, $dbuser, $dbpass, $dbname);

    if(! $conn ) {
      die('Could not connect: ' . mysql_error());
    }

    if(isset($_GET["EventID"]))
    {
        $EventID = $_GET["EventID"];
        echo $EventID;
    }
    else{
      echo "Return to Login";
    }

    if(!isset($_COOKIE["UserID"])) {
      header("Location:login.php");
    } else {
        $UID = $_COOKIE["UserID"];

        $sql = ("SELECT type FROM userdata WHERE usernumber = '" . $UID . "';");
        mysql_select_db("conferdata");
        $retval = mysql_query( $sql, $conn );

        if($retval ) {
          $query = mysql_fetch_row($retval);
          $userID = $query[0];

          if($userID == 1){
            header("Location:Event-U.php?EventID={$EventID}");
          }else if ($userID == 2){
            header("Location:Event-S.php?EventID={$EventID}");
          }else if ($userID == 3){
            header("Location:Event-St.php?EventID={$EventID}");
          }else if ($userID == 4){
          }else{
            header("Location:login.php");
          }
        }
    }
    ?>
    <br><!-- This is for readability on a computer, don't get rid of it. -->
  </div>
</div>
