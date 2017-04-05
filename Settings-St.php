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

          $sql = ("SELECT name,email FROM userdata WHERE usernumber = '" . $UID . "';");
          mysql_select_db("conferdata");
          $retval = mysql_query( $sql, $conn );
          $query = mysql_fetch_array($retval);

          $username = $query['name'];
          $usermail = $query['email'];

          echo $username;
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
    <span id="UserDetails">

      <?php
      if (file_exists("/userimages/usrimg{$UID}.png")) {
          echo "<img src=\"/userimages/usrimg{$UID}.png\">";
      } else {
          echo "<img src=\"/userimages/usrdefault.png\">";
      }
      echo "<br><br>";
      echo $username;
      echo "<br><br>";
      echo $usermail;
      echo "<br><br>";
      ?>
      <br><a onclick="document.getElementById('EditDetails').style.display=''; document.getElementById('UserDetails').style.display='none';" class="link"><button type="button" id="customButton1">Edit Details</button></a><br>
      <br><a href="logout.php"><button type="button" id="customButton1">logout</button></a>

      <script>autoSizeText();</script>
    </span>
    <span id="EditDetails" style="display: none">
      <form method="POST" action="">
        Name :<br>
        <input type="text" value="<?php echo $username ?>" name="name" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br>
        Email :<br>
        <input type="text"  value="<?php echo $usermail ?>" name="email" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br>
        Current Password :<br>
        <input type="password" name="password" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br>
        New Password (not required) :<br>
        <input type="password" name="password2" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br>
        Re-enter Password :<br>
        <input type="password" name="password3" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br><br>
        <input type = "submit" name = "sub" value = "Submit" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;" onclick="document.getElementById('login_text'.style.display=''"><br><br>
        <a onclick="document.getElementById('UserDetails').style.display=''; document.getElementById('EditDetails').style.display='none';" class="link"><button type="button" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;border-radius: 0;">Cancel</button></a>

        <?php
        $dbserver = "127.0.0.1:51097";
        $dbuser = "azure";
        $dbpass = "6#vWHD_$";
        $dbname = "localdb";

        $conn = mysql_connect($dbserver, $dbuser, $dbpass, $dbname);

        if(! $conn ) {
          die('Could not connect: ' . mysql_error());
        }

        if( isset($_POST["sub"]) ){
          $email = addslashes($_POST['email']);
          $password = addslashes($_POST['password']);
          $EditPass = addslashes($_POST['password2']);
          $EditPass2 = addslashes($_POST['password3']);
          $EditName = addslashes($_POST['name']);

          if( isset($_POST["sub"]) ){
            $conn = mysql_connect($dbserver, $dbuser, $dbpass, $dbname);

            $sql = ("SELECT usernumber FROM userdata WHERE email = '" . $email . "' AND password = '" . $password . "';");
            mysql_select_db("conferdata");
            $retval = mysql_query( $sql, $conn );

            if($retval) {
              $query = mysql_fetch_row($retval);

              $userID = $query[0];

              if($userID){
                if($EditPass == $EditPass2){
                  if($EditPass == NULL){
                    $sql = ("UPDATE `userdata` SET `email`=\"{$email}\",`name`=\"{$EditName}\" WHERE usernumber = {$UID};");
                    mysql_select_db("conferdata");
                    mysql_query( $sql, $conn );
                  }else{
                    $sql = ("UPDATE `userdata` SET `email`=\"{$email}\",`password`=\"{$EditPass}\",`name`=\"{$EditName}\" WHERE usernumber = {$UID};");
                    mysql_select_db("conferdata");
                    mysql_query( $sql, $conn );
                  }
                }
              }else{
                 echo 'User details not valid';
              }
            }else{
            }
          }

          $sql = "UPDATE `userdata` SET `email`=\"{$EditEmail}\",`password`=\"{$EditPass}\",`name`=\"{$EditName}\" WHERE `eventdata`.`usernumber` = {$UID};";
          mysql_select_db("conferdata");
          mysql_query( $sql, $conn );
        }
        ?>
      </form>
    </span>
    <br><br><br><br><br><br><br><!-- This is for readability on a computer, don't get rid of it. -->
  </div>
</div>
