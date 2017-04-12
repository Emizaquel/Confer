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
        <div id="title-content"><div id="content"><?php
          $dbserver = "127.0.0.1:51097";
          $dbuser = "azure";
          $dbpass = "6#vWHD_$";
          $dbname = "localdb";

          $conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect($dbserver,  $dbuser,  $dbpass));

          if(! $conn ) {
            die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
          }

          if(isset($_GET["EventID"])){
            $EventID = $_GET["EventID"];
            $sql = ("SELECT eventname FROM eventdata WHERE eventnumber = " . $EventID . ";");
            ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
            $retval = mysqli_query( $conn ,  $sql);

            if($retval) {
              $query = mysqli_fetch_row($retval);

              $EName = $query[0];

              if($EName){
                echo $EName;
              }else{
                echo "User Details Not Valid";
              }
            }else{
            }
          }
          ?></div></div>
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
    $dbserver = "127.0.0.1:51097";
    $dbuser = "azure";
    $dbpass = "6#vWHD_$";
    $dbname = "localdb";

    $conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect($dbserver,  $dbuser,  $dbpass));

    if(! $conn ) {
      die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
    }

    if(isset($_GET["EventID"]))
    {
        $EventID = $_GET["EventID"];
    }
    else{
      header("Location:Timetable.php");
    }

    $sql = ("SELECT eventtime,location,description FROM eventdata WHERE eventnumber = " . $EventID . ";");
    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
    $retval = mysqli_query( $conn ,  $sql);
    $query = mysqli_fetch_array($retval);

    $EventDateTime = $query['eventtime'];
    $LocationSpaces = $query['location'];
    $Description = $query['description'];

    $date = date('Y-m-d', strtotime($EventDateTime));
    $time = date('H:i:s', strtotime($EventDateTime));

    $LocationArray = explode(" ", $LocationSpaces);
    $Location = implode("+", $LocationArray);

    echo $date;
    echo "\n<br>\n";
    echo $time;
    echo "\n<br>";
    echo "<br>\n";
    echo $Description;
    echo "\n<br>";
    echo "<br>\n";
    echo "<a href ='https://www.google.co.uk/maps/place/";
    echo $Location;
    echo "'>";
    echo $LocationSpaces;
    echo "</a><br><br>\n";
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
            header("Location:Event-S.php?EventID={$EventID}");
          }else if ($userID == 3){
            header("Location:Event-St.php?EventID={$EventID}");
          }else if ($userID == 4){
            header("Location:Event-A.php?EventID={$EventID}");
          }else{
            header("Location:login.php");
          }
        }
    }

    $sql = ("SELECT * FROM reminderdata WHERE eventnumber = {$EventID} AND usernumber = {$userID};");
    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
    $retval = mysqli_query( $conn ,  $sql);
    $query = mysqli_fetch_array($retval);

    if(isset($_POST["forgetme"])){
      $sql = ("DELETE FROM `reminderdata` WHERE usernumber = {$userID} AND eventnumber = {$EventID}");
      ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
      if(mysqli_query( $conn ,  $sql)){
        echo "<form method=\"POST\" action=\"\">
          <input type = \"submit\" name = \"remindme\" value = \"Remind Me\" style=\"height: 45px;width: 98%;font-size: 35px;margin: 5px;\">
        </form>
        <br>Success!";
      }
    }else if(isset($_POST["remindme"])){
      $sql = ("INSERT INTO `reminderdata` (`usernumber`, `eventnumber`) VALUES ('{$userID}', '{$EventID}');");
      ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
      if(mysqli_query( $conn ,  $sql)){
        echo "<form method=\"POST\" action=\"\">
          <input type = \"submit\" name = \"forgetme\" value = \"Don't Remind Me\" style=\"height: 45px;width: 98%;font-size: 35px;margin: 5px;\">
        </form>
        <br>Success!";
      }
    }else if($query){
      echo"<form method=\"POST\" action=\"\">
        <input type = \"submit\" name = \"forgetme\" value = \"Don't Remind Me\" style=\"height: 45px;width: 98%;font-size: 35px;margin: 5px;\">
      </form>";
    }else{
      echo"<form method=\"POST\" action=\"\">
        <input type = \"submit\" name = \"remindme\" value = \"Remind Me\" style=\"height: 45px;width: 98%;font-size: 35px;margin: 5px;\">
      </form>";
    }
    ?>
    <br><!-- This is for readability on a computer, don't get rid of it. -->
    <script>autoSizeText();</script>
  </div>
</div>
