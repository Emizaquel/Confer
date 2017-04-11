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
      <div id="image-border"><a href="admin.php"><img src="admin.png" height="100%"></a></div>
      <div id="image-border"><a href="help.php"><img src="help.png" height="100%"></a></div>
      <div id="image-border"><a href="settings.php"><img src="setting.png" height="100%"></a></div>
    </div>
  </div>
  <div id="page-body">
    <span id="EditEventButton">
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

    $sql = ("SELECT eventtime,location,description,speaker FROM eventdata WHERE eventnumber = " . $EventID . ";");
    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
    $retval = mysqli_query( $conn ,  $sql);
    $query = mysqli_fetch_array($retval);

    $EventDateTime = $query['eventtime'];
    $LocationSpaces = $query['location'];
    $Description = $query['description'];
    $SID = $query['speaker'];

    $date = date('Y-m-d', strtotime($EventDateTime));
    $time = date('H:i:s', strtotime($EventDateTime));

    $LocationArray = split(" ", $LocationSpaces);
    $Location = join("+", $LocationArray);

    $sql = ("SELECT name FROM userdata WHERE usernumber = " . $SID . ";");
    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
    $retval = mysqli_query( $conn ,  $sql);
    $query = mysqli_fetch_array($retval);

    $Presenter = $query[0];

    echo $date;
    echo "<br>";
    echo $time;
    echo "<br>";
    echo "<br>";
    echo $Presenter;
    echo "<br>";
    echo "<br>";
    echo nl2br($Description);
    echo "<br>";
    echo "<br>";
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
        $dbserver = "127.0.0.1:51097";
        $dbuser = "azure";
        $dbpass = "6#vWHD_$";
        $dbname = "localdb";

        $conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect($dbserver,  $dbuser,  $dbpass));

        if(! $conn ) {
          die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
        }

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
        <input type = "submit" name = "sub" value = "Submit" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;" onclick="document.getElementById('login_text'.style.display=''">
        <a onclick="document.getElementById('EditEventButton').style.display='block'; document.getElementById('EditEvent').style.display='none';" class="link"><button type="button" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;border-radius: 0;">Cancel</button></a>

        <?php
        $dbserver = "127.0.0.1:51097";
        $dbuser = "azure";
        $dbpass = "6#vWHD_$";
        $dbname = "localdb";

        $conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect($dbserver,  $dbuser,  $dbpass));

        if(! $conn ) {
          die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
        }

        if( isset($_POST["sub"]) ){
          $EditName = addslashes($_POST['name']);
          $EditDesc = addslashes($_POST['description']);
          $EditTime = addslashes($_POST['datetime']);
          $EditSpeaker = addslashes($_POST['speaker']);
          $EditLocation = addslashes($_POST['location']);

          $sql = "UPDATE `eventdata` SET `eventname`=\"{$EditName}\",`description`=\"{$EditDesc}\",`eventtime`=\"{$EditTime}\",`speaker`=$EditSpeaker,`location`=\"$EditLocation\" WHERE `eventdata`.`eventnumber` = {$EventID};";
          ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
          mysqli_query( $conn ,  $sql);
        }
        ?>
      </form>
    </span>
    <br><!-- This is for readability on a computer, don't get rid of it. -->
    <script>autoSizeText();</script>
  </div>
</div>
