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
              }else{}
            }else{}
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
    <span id="EditEventButton">
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

    $sql = ("SELECT name FROM userdata WHERE usernumber = " . $SID . ";");
    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
    $retval = mysqli_query( $conn ,  $sql);
    $query = mysqli_fetch_array($retval);

    $Presenter = $query[0];

    echo $displaydate;
    echo "<br>";
    echo "<br>";
    echo $Presenter;
    echo "<br>";
    echo "<br>";
    echo nl2br($Description);
    echo "<br>";
    echo "<br>";
    echo "Speaker - {$ESpeaker}<br>{$ESDesc}<br><br>";
    echo "<a href ='https://www.google.co.uk/maps/place/";
    echo $Location;
    echo "'>";
    echo $LocationSpaces;
    echo "</a>";
    echo "<br>";
    echo "<br>";



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
            header("Location:Event-St.php?EventID={$EventID}");
          }else if ($userID == 4){
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
    ?>
    <a onclick="document.getElementById('EditEvent').style.display='block'; document.getElementById('EditEventButton').style.display='none';" class="link"><button type="button" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;border-radius: 0;">Edit Event</button></a>
    </span>
    <span id="EditEvent" style="display: none;">
      <form method="POST" action="">
        <input type="text" value="<?php echo $EName ?>" name="name" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br>
        <textarea name="description" style="height: 135px;width: 98%;font-size: 35px;margin: 5px;"><?php echo $Description ?></textarea><br>
        <input type="text"  value="<?php echo $LocationSpaces ?>" name="location" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br>
        <input type="datetime-local" value="<?php echo $date; echo "T"; echo $time ?>" step="1" name="datetime" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br>
        <br>Speaker<br>
        <?php

          $sql = ("SELECT usernumber,name FROM `userdata` WHERE type = 2;");
          ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
          $retval = mysqli_query( $conn ,  $sql);

          while($row = mysqli_fetch_array($retval))
          {
             $UserID = $row['usernumber'];
             $Name = $row['name'];
             if($SID == $UserID){
               echo " <input type=\"radio\" name=\"speaker\" style=\"width:2em;height:2em;\" value=\"";
               echo $UserID;
               echo "\" checked=\"checked\">  ";
               echo $Name;
               echo "<br>";}
            else {
               echo " <input type=\"radio\" name=\"speaker\" style=\"width:2em;height:2em;\" value=\"";
               echo $UserID;
               echo "\">  ";
               echo $Name;
               echo "<br>";
            }
          }
        ?>
        <br>
        <input type = "submit" name = "sub" value = "Submit" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;">
        <a onclick="document.getElementById('EditEventButton').style.display='block'; document.getElementById('EditEvent').style.display='none';" class="link"><button type="button" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;border-radius: 0;">Cancel</button></a>
        <br><br>
        <span id="deletebutton">
          <a onclick="document.getElementById('deleteconfirm').style.display='block'; document.getElementById('deletebutton').style.display='none';" class="link"><button type="button" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;border-radius: 0;">Delete</button></a>
        </span>
        <span id="deleteconfirm" style="display: none;">
          <br><br>Are you sure?<br><br>
          <input type = "submit" name = "del" value = "Yes" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;">
          <br><br>
          <a onclick="document.getElementById('deletebutton').style.display='block'; document.getElementById('deleteconfirm').style.display='none';" class="link"><button type="button" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;border-radius: 0;">No</button></a><br><br>
        </span>

        <?php

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
            $mail->Password = "ConferEmailPassword";

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
        mysqli_close($conn);
        ?>
      </form>
    </span>
    <br><br><br><br><br><br><!-- This is for readability on a computer, don't get rid of it. -->
    <script>autoSizeText();</script>
  </div>
</div>
