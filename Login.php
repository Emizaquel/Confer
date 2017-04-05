<head>
  <link rel="stylesheet" type="text/css" href="general.css">
  <link rel="icon" type="image/png" href="icon.ico">
  <script src="scripts.js"></script>
</head>
<div id="wrapper">
  <div id="header">
    <div id="logo-pane">
      <div id="logo-content">
        <div id="image-border"><img src="Logo.jpg" width="100%"></div>
      </div>
    </div>
    <div id="title-pane">
      <div id="title-content"><div id="content">Login</div></div>
    </div>
  </div>

  <div id="footer">
    <div id="nav-bar">
    </div>
  </div>
  <div id="page-body">
    <div style = "display:block;vertical-align:middle; margin:10%;padding-top:30%;">
      <form method="POST" action="">
        <input type="text" placeholder="Enter Email" name="email" style="height: 45px;width: 100%;font-size: 35px;margin: 5px;"><br>
        <input type="password" placeholder="Enter Password" name="pass" style="height: 45px;width: 100%;font-size: 35px;margin: 5px;"><br>
        <input type = "submit" name = "sub" value = "Login" style="height: 45px;width: 100%;font-size: 35px;margin: 5px;" onclick="document.getElementById('login_text'.style.display=''">
        <br>
        <br>

        <?php
        $email = addslashes($_POST['email']);
        $password = addslashes($_POST['pass']);
        $dbserver = "127.0.0.1:51097";
        $dbuser = "azure";
        $dbpass = "6#vWHD_$";
        $dbname = "localdb";

        $conn = mysql_connect($dbserver, $dbuser, $dbpass, $dbname);

        if(! $conn ) {
          die('Could not connect: ' . mysql_error());
        }

        if(!isset($_COOKIE["UserID"])) {
        }else{
            $UID = $_COOKIE["UserID"];

            $sql = ("SELECT type FROM userdata WHERE usernumber = '" . $UID . "';");
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
                header("Location:Home-St.php");
              }else if ($userID == 4){
                header("Location:Home-A.php");
              }else{

              }
            }
        }

        if( isset($_POST["sub"]) ){
          $conn = mysql_connect($dbserver, $dbuser, $dbpass, $dbname);

          $sql = ("SELECT usernumber FROM userdata WHERE email = '" . $email . "' AND password = '" . $password . "';");
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
    </div>
    <br><!-- This is for readability on a computer, don't get rid of it. -->
  </div>
</div>
