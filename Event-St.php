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
                  header("Location:Event-U.php?EventID={$EventID}");
                }else if ($userID == 2){
                  header("Location:Event-S.php?EventID={$EventID}");
                }else if ($userID == 3){
                }else if ($userID == 4){
                  header("Location:Event-A.php?EventID={$EventID}");
                }else{
                  header("Location:login.php");
                }
              }

              $sql = ("SELECT jobnumber FROM jobdata WHERE usernumber = {$UID} AND jobnumber == 3;");
              ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
              $retval = mysqli_query( $conn ,  $sql);
              if($retval){
                $JobValue = TRUE;
              }
          }
          ?></div></div>
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

    if($JobValue){
      echo "<span id=\"EditEventButton\">"
    }
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
    $displaydate = date('l jS \of F Y h:i:s A', strtotime($EventDateTime));

    $LocationArray = explode(" ", $LocationSpaces);
    $Location = implode("+", $LocationArray);

    echo $displaydate;
    echo "<br>";
    echo "<br>";
    echo $Description;
    echo "<br>";
    echo "<br>";
    echo "<a href ='https://www.google.co.uk/maps/place/";
    echo $Location;
    echo "'>";
    echo $LocationSpaces;
    echo "</a>";

    $sql = ("SELECT * FROM reminderdata WHERE eventnumber = {$EventID} AND usernumber = {$UID};");
    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
    $retval = mysqli_query( $conn ,  $sql);
    $query = mysqli_fetch_array($retval);

    if(isset($_POST["forgetme"])){
      $sql = ("DELETE FROM `reminderdata` WHERE usernumber = $UID} AND eventnumber = {$EventID}");
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

        if( isset($_POST["del"]) ){
          $sql3 = ("DELETE FROM `eventdata` WHERE eventnumber = {$EventID};");
          ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
          mysqli_query( $conn ,  $sql3);
        }

        if( isset($_POST["sub"]) ){
          $EditName = addslashes($_POST['name']);
          $EditDesc = addslashes($_POST['description']);
          $EditTime = addslashes($_POST['datetime']);
          $EditSpeaker = addslashes($_POST['speaker']);
          $EditLocation = addslashes($_POST['location']);

          $sql3 = ("SELECT name FROM userdata WHERE usernumber = {$EditSpeaker};");
          ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
          $retval3 = mysqli_query( $conn ,  $sql3);
          $editspeakername = mysqli_fetch_array($retval3);

          $editdisplaydate = date('l jS \of F Y h:i:s A', strtotime($EditTime));

          $sql = "UPDATE `eventdata` SET `eventname`=\"{$EditName}\",`description`=\"{$EditDesc}\",`eventtime`=\"{$EditTime}\",`speaker`=$EditSpeaker,`location`=\"$EditLocation\" WHERE `eventdata`.`eventnumber` = {$EventID};";
          ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
          if(mysqli_query( $conn ,  $sql)){
            $sql2 = ("SELECT usernumber FROM reminderdata WHERE eventnumber = {$EventID};");
            ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
            $retval2 = mysqli_query( $conn ,  $sql2);

            $message = "Dear User,

You have opted to be reminded for {$EventName}.

The event has been modified by an administrator. It now is represented by the following information.

Name : {$EditName}

Date : {$editdisplaydate}

Presenter : {$editspeakername}

Description :
{$EditDesc}

Location : {$EditLocation}

We hope this does not cause any incovenience.";

            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = "donotreplyconfer@gmail.com";
            $mail->Password = "Chirag25";

            // Email Sending Details
            while($row2 = mysqli_fetch_array($retval2)){
              $UID = $row2['usernumber'];

              $sql3 = ("SELECT email FROM userdata WHERE usernumber = {$UID};");
              ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
              $retval3 = mysqli_query( $conn ,  $sql3);
              $query3 = mysqli_fetch_array($retval3);
              $mail->AddBCC($query3);
            }
            $mail->Subject = "Changes to {$EventName}";
            $mail->isHTML(false);
            $mail->Body = $message;

            $mail->send();
          }
        }
    }
    ?>
    <br><br><br><br><br><br><!-- This is for readability on a computer, don't get rid of it. -->
    <script>autoSizeText();</script>
  </div>
</div>
