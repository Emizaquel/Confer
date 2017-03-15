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
      <div id="image-border"><a href="admin.php"><img src="admin.png" height="100%"></a></div>
      <div id="image-border"><a href="help.php"><img src="help.png" height="100%"></a></div>
      <div id="image-border"><a href="settings.php"><img src="setting.png" height="100%"></a></div>
    </div>
  </div>
  <div id="page-body">
    <span id="UserDetails">
      <?php
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

        $sql = ("SELECT type FROM userdata WHERE usernumber = '" . $UID . "';");
        mysql_select_db("conferdata");
        $retval = mysql_query( $sql, $conn );

        if($retval ) {
          $query = mysql_fetch_row($retval);
          $userID = $query[0];

          if($userID == 1){
            header("Location:Settings-U.php");
          }else if ($userID == 2){
            header("Location:Settings-S.php");
          }else if ($userID == 3){
            header("Location:Settings-St.php");
          }else if ($userID == 4){
          }else{
            header("Location:login.php");

          }
        }
    }
    ?>
      Insert Image here
      <br>
      <br>Name : (First/Last)
      <br>Email : (Insert here)
      <br>
      <br>Insert Edit Details Button.
      <br>
      <br><a onclick="document.getElementById('EditDetails').style.display=''; document.getElementById('UserDetails').style.display='none';" class="link">[EDIT USER DATA]</a>
      <br><a href="logout.php">logout</a>
    </span>
    <span id="EditDetails" style="display: none">
    Insert Image upload link here
    <br>
    <br>Edit Name : (First/Last)
    <br>Edit Email : (Insert here)
    <br>
    <br><a onclick="document.getElementById('UserDetails').style.display=''; document.getElementById('EditDetails').style.display='none';" class="link">[SAVE DETAILS]</a>
    </span>
    <br><!-- This is for readability on a computer, don't get rid of it. -->
  </div>
</div>
