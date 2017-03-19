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
          Timetable
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

      $sql = ("SELECT eventnumber,eventname,eventtime FROM `eventdata` ORDER BY `eventdata`.`eventtime` ASC");
      mysql_select_db("conferdata");
      $retval = mysql_query( $sql, $conn );

      $OldDate = date('Y-m-d', strtotime(mktime(00,00,00,01,01,1000)));
      $StartDate = $OldDate;

      while($row = mysql_fetch_array($retval))
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
          mysql_select_db("conferdata");
          $retval = mysql_query( $sql, $conn );

          if($retval ) {
            $query = mysql_fetch_row($retval);
            $userID = $query[0];

            if($userID == 1){
              header("Location:Timetable-U.php");
            }else if ($userID == 2){
              header("Location:Timetable-S.php");
            }else if ($userID == 3){
              header("Location:Timetable-St.php");
            }else if ($userID == 4){
            }else{
              header("Location:login.php");

            }
          }
      }
    ?>
    <span id="NewEvent" style="display: block;background-color: white;border-radius: 15px;border-style: solid;border-color: grey;border-width: 10px;color: black;overflow-x: hidden;min-height: 72px;padding: 10px;display: none;">
        <form method="POST" action="">
          <input type="text" placeholder="Enter Name" name="name" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br>
          <textarea name="description" style="height: 135px;width: 98%;font-size: 35px;margin: 5px;">Enter Description here</textarea><br>
          <input type="text" placeholder="location" name="location" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br>
          <input type="datetime-local" name="datetime" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br>
          <br>Speaker<br>
          <?php
          $dbserver = "127.0.0.1:51097";
          $dbuser = "azure";
          $dbpass = "6#vWHD_$";
          $dbname = "localdb";

          $conn = mysql_connect($dbserver, $dbuser, $dbpass, $dbname);

          if(! $conn ) {
            die('Could not connect: ' . mysql_error());
          }

            $sql = ("SELECT usernumber,name FROM `userdata` WHERE type = 2;");
            mysql_select_db("conferdata");
            $retval = mysql_query( $sql, $conn );

            while($row = mysql_fetch_array($retval))
            {
               $UserID = $row['usernumber'];
               $Name = $row['name'];

               echo " <input type=\"radio\" name=\"speaker\" value=\"";
               echo $UserID;
               echo "\">";
               echo $Name;
               echo "<br>";
            }
          ?>
          <br>
          <input type = "submit" name = "sub" value = "Submit" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;" onclick="document.getElementById('login_text'.style.display=''">

          <?php
          $dbserver = "127.0.0.1:51097";
          $dbuser = "azure";
          $dbpass = "6#vWHD_$";
          $dbname = "localdb";
          $eventname = addslashes($_POST['name']);
          $description = addslashes($_POST['description']);
          $eventtime = addslashes($_POST['datetime']);
          $speaker = $_POST['speaker'];
          $location = addslashes($_POST['location']);

          $conn = mysql_connect($dbserver, $dbuser, $dbpass, $dbname);

          if(! $conn ) {
            die('Could not connect: ' . mysql_error());
          }

          if( isset($_POST["sub"]) ){
            $conn = mysql_connect($dbserver, $dbuser, $dbpass, $dbname);

            $sql = ("INSERT INTO `eventdata` (`eventnumber`, `eventname`, `description`, `eventtime`, `speaker`, `location`) VALUES (NULL, \"{$eventname}\", \"{$description}\", \"{$eventtime}\", \"{$speaker}\", \"{$location}\");");
            mysql_select_db("conferdata");
            $retval = mysql_query( $sql, $conn );

            if($retval) {
              $query = mysql_fetch_row($retval);

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
          ?>
        </form>
      <br><a onclick="document.getElementById('NewEventButton').style.display='block'; document.getElementById('NewEvent').style.display='none';" class="link"><button type="button" id="customButton2">Cancel</button></a>
      </span>
      <span id="NewEventButton" style="display: block;background-color: white;border-radius: 15px;border-style: solid;border-color: grey;border-width: 10px;color: black;overflow-x: hidden;min-height: 36px;padding: 10px;text-align:center;">
        <a onclick="document.getElementById('NewEvent').style.display='block'; document.getElementById('NewEventButton').style.display='none';" class="link">New Event</a>
      </span>
    <br><br><!-- This is for readability on a computer, don't get rid of it. -->
  </div>
</div>
