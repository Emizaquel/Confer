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
          Title
        </div>
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
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $dbserver = "127.0.0.1:51097";
    $dbuser = "azure";
    $dbpass = "6#vWHD_$";
    $dbname = "localdb";

    $conn = mysql_connect($dbserver, $dbuser, $dbpass, $dbname);

    if(! $conn ) {
      die('Could not connect: ' . mysql_error());
    }

    if(!isset($_COOKIE["UserID"])) {
      header("Location:login.php");
    } else {
        $UID = $_COOKIE["UserID"];

        $sql = ("SELECT eventnumber,eventname,eventtime FROM `eventdata` ORDER BY `eventdata`.`eventtime` ASC");
        mysql_select_db("conferdata");
        $retval = mysql_query( $sql, $conn );

        $OldDate = date('Y-m-d', strtotime(mktime(00,00,00,01,01,1000)));
        $StartDate = $OldDate;
        echo $OldDate;
        echo "<br>";

        while($row = mysql_fetch_array($retval))
        {
           $EventID = $row['eventnumber'];
           $EventName = $row['eventname'];
           $EventDateTime = $row['eventtime'];
           $date = date('Y-m-d', strtotime($EventDateTime));
           $time = date('H:i:s', strtotime($EventDateTime));

           if($OldDate === $StartDate){
             $OldDate  = $date;
             echo $date;
             echo "<br>";
           }else if(!($OldDate === $date)){
             $OldDate  = $date;
             echo $date;
             echo "<br>";
           }
           echo $time;
           echo " - ";
           echo $EventName;
           echo "<br>";
        }

    }
    ?>
    <br><!-- This is for readability on a computer, don't get rid of it. -->
  </div>
</div>
