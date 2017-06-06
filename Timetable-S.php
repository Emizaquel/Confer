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
      <div id="image-border"><a href="help.php"><img src="help.png" height="100%"></a></div>
      <div id="image-border"><a href="settings.php"><img src="setting.png" height="100%"></a></div>
    </div>
  </div>
  <div id="page-body">
    <?php
    include("baseconnect.php");

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
            header("Location:Timetable-A.php");
          }else if ($userID == 2){
          }else if ($userID == 3){
            header("Location:Timetable-St.php");
          }else if ($userID == 4){
            header("Location:Timetable-A.php");
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
