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
        <div id="title-content"><div id="content">
          Permissions
        </div></div>
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
            header("Location:Home-U.php");
          }else if ($userID == 2){
            header("Location:Home-S.php");
          }else if ($userID == 3){
          }else if ($userID == 4){
            header("Location:Admin-A.php");
          }else{
            header("Location:login.php");
          }
        }

        $usrimgpath = $_SERVER['DOCUMENT_ROOT'] . "/userimages/usrimg{$UID}.jpg";
        if (file_exists($usrimgpath)) {
          echo "<img src=\"/userimages/usrimg{$UID}.jpg\" width=\"80%\">";
        } else {
          echo "<img src=\"/userimages/usrdefault.jpg\" width=\"80%\">";
        }
        echo "<br><br>";
        echo $username;
        echo "<br><br>";
        echo $usermail;
        echo "<br><br>";

        if ($userID == 3){
          $sql = ("SELECT jobnumber FROM jobdata WHERE usernumber = {$UID};");
          ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
          $retval = mysqli_query( $conn ,  $sql);
          while($row = mysqli_fetch_array($retval))
          {
             $JobNumber = $row['jobnumber'];

             $Job1 = FALSE;
             $Job2 = FALSE;
             $Job3 = FALSE;
             $Job4 = FALSE;

             if($JobNumber == 1){
               $Job1 = TRUE;
             }else if($JobNumber == 2){
               $Job2 = TRUE;
             }else if($JobNumber == 3){
               $Job3 = TRUE;
             }else if($JobNumber == 4){
               $Job4 = TRUE;
             }
          }
          echo "Permissions<br><br>";
          if($Job1){
            echo "Add, Remove or Edit Events<br><br>";
          }
          if($Job2){
            echo "Add and Remove Users<br><br>";
          }
          if($Job3){
            echo "Edit Help Page<br><br>";
          }
          if($Job4){
            echo "Edit Home Page<br><br>";
          }
        }

        $sql = ("SELECT jobnumber FROM jobdata WHERE usernumber = {$UID} AND jobnumber = 2;");
        ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
        $retval = mysqli_query( $conn ,  $sql);
        if($retval){
          $query = mysqli_fetch_row($retval);
          $JobID = $query[0];

          $JobValue = FALSE;
          if($JobID == 2){
            echo "<a href = \"UserList.php\"><button type=\"button\" style=\"height: 45px;width: 98%;font-size: 35px;margin: 5px;border-radius: 0;\">View Other Users</button></a>";
          }
        }
    }
     ?>
    <br><!-- This is for readability on a computer, don't get rid of it. -->
    <script>autoSizeText();</script>
  </div>
</div>
