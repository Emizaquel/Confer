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
          include("baseconnect.php");

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

    if(isset($_GET["EventID"]))
    {
        $EventID = $_GET["EventID"];
    }
    else{
      header("Location:Timetable.php");
    }

    $sql = ("SELECT eventtime,location,description,speaker FROM eventdata WHERE eventnumber = " . $EventID . ";");
    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
    $retval = mysqli_query( $conn ,  $sql);
    $query = mysqli_fetch_array($retval);

    $EventDateTime = $query['eventtime'];
    $LocationSpaces = $query['location'];
    $Description = $query['description'];
    $ESN = $query['speaker'];

    $sql = ("SELECT name FROM `userdata` WHERE usernumber = {$ESN};");
    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
    $retval = mysqli_query( $conn ,  $sql);
    $query = mysqli_fetch_row($retval);
    $ESpeaker = $query[0];

    $sql = ("SELECT description FROM `speakerbio` WHERE usernumber = {$ESN};");
    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
    $retval = mysqli_query( $conn ,  $sql);
    $query = mysqli_fetch_row($retval);
    $ESD = $query[0];
    $ESDesc = nl2br($ESD);

    $date = date('Y-m-d', strtotime($EventDateTime));
    $time = date('H:i:s', strtotime($EventDateTime));
    $displaydate = date('l jS \of F Y h:i:s A', strtotime($EventDateTime));

    $LocationArray = explode(" ", $LocationSpaces);
    $Location = implode("+", $LocationArray);

    echo $displaydate;
    echo "\n<br>";
    echo "<br>\n";
    echo $Description;
    echo "\n<br>";
    echo "<br>\n";
    echo "Speaker - {$ESpeaker}<br>{$ESDesc}<br><br>\n";
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

        if($retval) {
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

    $sql = ("SELECT * FROM reminderdata WHERE eventnumber = {$EventID} AND usernumber = {$UID};");
    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
    $retval = mysqli_query( $conn ,  $sql);
    $query = mysqli_fetch_array($retval);

    if(isset($_POST["forgetme"])){
      $sql = ("DELETE FROM `reminderdata` WHERE usernumber = {$UID} AND eventnumber = {$EventID}");
      ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
      if(mysqli_query( $conn ,  $sql)){
        echo "<form method=\"POST\" action=\"\">
          <input type = \"submit\" name = \"remindme\" value = \"Remind Me\" style=\"height: 45px;width: 98%;font-size: 35px;margin: 5px;\">
        </form>";
      }
    }else if(isset($_POST["remindme"])){
      $sql = ("INSERT INTO `reminderdata` (`usernumber`, `eventnumber`) VALUES ('{$UID}', '{$EventID}');");
      ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
      if(mysqli_query( $conn ,  $sql)){
        echo "<form method=\"POST\" action=\"\">
          <input type = \"submit\" name = \"forgetme\" value = \"Don't Remind Me\" style=\"height: 45px;width: 98%;font-size: 35px;margin: 5px;\">
        </form>";
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
    mysqli_close($conn);
    ?>
    <br><br><br><br><br><br><!-- This is for readability on a computer, don't get rid of it. -->
    <script>autoSizeText();</script>
  </div>
</div>
