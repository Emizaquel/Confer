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
        <div id="title-content"><div id="content">Timetable</div></div>
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

    $conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect($dbserver,  $dbuser,  $dbpass));

    if(! $conn ) {
      die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
    }

    $sql = ("SELECT jobnumber FROM jobdata WHERE usernumber = {$UID} AND jobnumber == 1;");
    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
    $retval = mysqli_query( $conn ,  $sql);
    if($retval){
      $query = mysqli_fetch_row($retval);
      $JobID = $query[0];

      $JobValue = FALSE;
      if($JobID == 1){
        echo "<span id=\"NewEvent\" style=\"display: block;background-color: white;border-radius: 15px;border-style: solid;border-color: grey;border-width: 10px;color: black;overflow-x: hidden;min-height: 72px;padding: 10px;padding-top: 45px;display: none;\">
          <form method=\"POST\" action=\"\">
            <input type=\"text\" placeholder=\"Enter Name\" name=\"name\" style=\"height: 45px;width: 98%;font-size: 35px;margin: 5px;\"><br>
            <textarea name=\"description\" style=\"height: 135px;width: 98%;font-size: 35px;margin: 5px;\">Enter Description here</textarea><br>
            <input type=\"text\" placeholder=\"location\" name=\"location\" style=\"height: 45px;width: 98%;font-size: 35px;margin: 5px;\"><br>
            <input type=\"datetime-local\" name=\"datetime\" style=\"height: 45px;width: 98%;font-size: 35px;margin: 5px;\"><br>
            <br>Speaker<br>";

            $sql = ("SELECT usernumber,name FROM `userdata` WHERE type = 1;");
            ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
            $retval = mysqli_query( $conn ,  $sql);

            while($row = mysqli_fetch_array($retval))
            {
               $UserID = $row['usernumber'];
               $Name = $row['name'];

               echo " <input type=\"radio\" name=\"speaker\" style=\"width:2em;height:2em;\" value=\"";
               echo $UserID;
               echo "\">  ";
               echo $Name;
               echo "<br>";
            }

            echo "<br>
            <input type = \"submit\" name = \"sub\" value = \"Submit\" style=\"height: 45px;width: 98%;font-size: 35px;margin: 5px;\" onclick=\"document.getElementById('login_text'.style.display=''\">";

            $dbserver = "127.0.0.1:51097";
            $dbuser = "azure";
            $dbpass = "6#vWHD_$";
            $dbname = "localdb";
            $eventname = addslashes($_POST['name']);
            $description = addslashes($_POST['description']);
            $eventtime = addslashes($_POST['datetime']);
            $speaker = $_POST['speaker'];
            $location = addslashes($_POST['location']);

            $conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect($dbserver,  $dbuser,  $dbpass));

            if(! $conn ) {
              die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
            }

            if( isset($_POST["sub"]) ){
              $conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect($dbserver,  $dbuser,  $dbpass));

              $sql = ("INSERT INTO `eventdata` (`eventnumber`, `eventname`, `description`, `eventtime`, `speaker`, `location`) VALUES (NULL, \"{$eventname}\", \"{$description}\", \"{$eventtime}\", \"{$speaker}\", \"{$location}\");");
              ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
              $retval = mysqli_query( $conn ,  $sql);

              if($retval) {
                $query = mysqli_fetch_row($retval);

                $userID = $query[0];

                if($userID){
                  setcookie("UserID", $userID, time() + (86400 * 30), "/");
                  header("Location:Home.php");
                }else{
                   echo 'User details not valid';
                }
              }else{
              }
            }

            echo "<a onclick=\"document.getElementById('NewEventButton').style.display='block'; document.getElementById('NewEvent').style.display='none';\" class=\"link\"><button type=\"button\" style=\"height: 45px;width: 98%;font-size: 35px;margin: 5px;border-radius: 0;\">Cancel</button></a>
            </form>
            </span>
            <a onclick=\"document.getElementById('NewEvent').style.display='block'; document.getElementById('NewEventButton').style.display='none';\" class=\"link\">
            <span id=\"NewEventButton\" style=\"display: block;background-color: white;border-radius: 15px;border-style: solid;border-color: grey;border-width: 10px;color: black;overflow-x: hidden;min-height: 36px;padding: 10px;text-align:center;\">
            New Event
            </span>
            </a>
            <br>";

      }
    }

      $sql = ("SELECT eventnumber,eventname,eventtime FROM `eventdata` ORDER BY `eventdata`.`eventtime` ASC");
      ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
      $retval = mysqli_query( $conn ,  $sql);

      $OldDate = date('Y-m-d', strtotime(mktime(00,00,00,01,01,1000)));
      $StartDate = $OldDate;

      while($row = mysqli_fetch_array($retval))
      {
         $EventID = $row['eventnumber'];
         $EventName = $row['eventname'];
         $EventDateTime = $row['eventtime'];
         $date = date('Y-m-d', strtotime($EventDateTime));
         $time = date('H:i:s', strtotime($EventDateTime));

         if($OldDate === $StartDate){
           $OldDate  = $date;
           echo "<div id='DateSplitter'>";
           echo "<div id='DateHeader'>";
           echo $date;
           echo "</div>";
           echo "<div id='EventHolder'>";
         }else if(!($OldDate === $date)){
           $OldDate  = $date;
           echo "<div id='EventBottom'></div>";
           echo "</div></div><br>";
           echo "<div id='DateSplitter'>";
           echo "<div id='DateHeader'>";
           echo $date;
           echo "</div><div id='EventHolder'>";


         }

         echo "<a id='EventListing' href = 'Event.php?EventID=";
         echo $EventID;
         echo "'>";
         echo $time;
         echo " - ";
         echo $EventName;
         echo "<br>";
         echo "</a>";
      }
      echo "<div id='EventBottom'></div>";
      echo "</div></div><br>";

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
              header("Location:Timetable-U.php");
            }else if ($userID == 2){
              header("Location:Timetable-S.php");
            }else if ($userID == 3){
            }else if ($userID == 4){
              header("Location:Timetable-A.php");
            }else{
              header("Location:login.php");

            }
          }
      }
    ?>
    <br><!-- This is for readability on a computer, don't get rid of it. -->
    <script>autoSizeText();</script>
  </div>
</div>
