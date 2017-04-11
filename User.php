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

          $conn = mysql_connect($dbserver, $dbuser, $dbpass, $dbname);

          if(! $conn ) {
            die('Could not connect: ' . mysql_error());
          }

          if(!isset($_COOKIE["UserID"])) {
            header("Location:login.php");
          } else {
              $VID = $_COOKIE["UserID"];
              $sql = ("SELECT type FROM userdata WHERE usernumber = '" . $VID . "';");
              mysql_select_db("conferdata");
              $retval = mysql_query( $sql, $conn );

              if($retval ) {
                $query = mysql_fetch_row($retval);
                $userID = $query[0];

                if($userID == 1){
                  header("Location:Home-U.php");
                }else if ($userID == 2){
                  header("Location:Home-S.php");
                }else if ($userID == 3){
                  header("Location:Admin-St.php");
                }else if ($userID == 4){
                }else{
                  header("Location:login.php");
                }
              }
          }


          if(!isset($_GET["UserID"])){
            header("Location:Admin-A.php");
          }else{
            $UID = $_GET["UserID"];

            $sql = ("SELECT name,email FROM userdata WHERE usernumber = '" . $UID . "';");
            mysql_select_db("conferdata");
            $retval = mysql_query( $sql, $conn );
            $query = mysql_fetch_array($retval);

            $username = $query['name'];
            $usermail = $query['email'];

            echo $username;
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
    ?>
    <form method="POST" action="">
      <input type = "submit" name = "sub" value = "New Password" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br><br>
      <?php
      if( isset($_POST["sub"]) ){
        $sendpass = '';
        $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i = 0; $i < 12; ++$i) {
            $sendpass .= $keyspace[rand(0, 62)];
        }
        echo 'Current PHP version: ' . phpversion();
        echo "<br>"
        echo $sendpass;
        echo "\n";
      }
      ?>
    </form>
    <br><!-- This is for readability on a computer, don't get rid of it. -->
    <script>autoSizeText();</script>
  </div>
</div>
