<head>
<link rel="stylesheet" type="text/css" href="general.css">
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
            header("Location:Timetable-A.php");
          }else{
            header("Location:login.php");

          }
        }
    }
    ?>
    <br><!-- This is for readability on a computer, don't get rid of it. -->
  </div>
</div>
