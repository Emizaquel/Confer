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

          $conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect($dbserver,  $dbuser,  $dbpass));

          if(! $conn ) {
            die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
          }

          if(!isset($_COOKIE["UserID"])) {
            header("Location:login.php");
          } else {
              $VID = $_COOKIE["UserID"];
              $sql = ("SELECT type FROM userdata WHERE usernumber = '" . $VID . "';");
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

            $sql = ("SELECT usernumber,name,email,type FROM userdata WHERE usernumber = '" . $UID . "';");
            ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
            $retval = mysqli_query( $conn ,  $sql);
            $query = mysqli_fetch_array($retval);

            $SubUID = $query['usernumber'];
            $SUID = $query['type'];
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
      <?php
      if($SUID == 3){
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
          echo "<input type=\"checkbox\" name=\"Job[]\" value=\"1\" checked> Add, Remove or Edit Events<br>";
        }else{
          echo "<input type=\"checkbox\" name=\"Job[]\" value=\"1\"> Add, Remove or Edit Events<br>";
        }
        if($Job2){
          echo "<input type=\"checkbox\" name=\"Job[]\" value=\"2\" checked> Add and Remove Users<br>";
        }else{
          echo "<input type=\"checkbox\" name=\"Job[]\" value=\"2\"> Add and Remove Users<br>";
        }
        if($Job3){
          echo "<input type=\"checkbox\" name=\"Job[]\" value=\"3\" checked> Edit Help Page<br>";
        }else{
          echo "<input type=\"checkbox\" name=\"Job[]\" value=\"3\"> Edit Help Page<br>";
        }
        if($Job4){
          echo "<input type=\"checkbox\" name=\"Job[]\" value=\"4\" checked> Edit Home Page<br>";
        }else{
          echo "<input type=\"checkbox\" name=\"Job[]\" value=\"4\"> Edit Home Page<br>";
        }
      }
      ?>
      <input type = "submit" name = "per" value = "Set Permissions" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br><br>
      <input type = "submit" name = "sub" value = "New Password" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br><br>
      <span id="deletebutton">
        <a onclick="document.getElementById('deleteconfirm').style.display='block'; document.getElementById('deletebutton').style.display='none';" class="link"><button type="button" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;border-radius: 0;">Delete</button></a>
      </span>
      <span id="deleteconfirm" style="background-color: white;border-radius: 15px;border-style: solid;border-color: grey;border-width: 10px;color: black;overflow-x: hidden;min-height: 72px;padding: 10px;padding-top: 45px;display: none;">
        <br><br>Are you sure?<br><br>
        <input type = "submit" name = "del" value = "Yes" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;">
        <br><br>
        <a onclick="document.getElementById('deletebutton').style.display='block'; document.getElementById('deleteconfirm').style.display='none';" class="link"><button type="button" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;border-radius: 0;">No</button></a><br><br>
      </span>
      <?php
      require 'PHPMailer/PHPMailerAutoload.php';

      if( isset($_POST["del"]) ){
        $sql3 = ("DELETE FROM `eventdata` WHERE eventnumber = {$EventID};");
        ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
        mysqli_query( $conn ,  $sql3);

        $message = "Hello {$username},

Your account has been deleted by an admin. Please contact the event staff if there are any further issues.

We hope this does not inconvenience you.";

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "donotreplyconfer@gmail.com";
        $mail->Password = "Chirag25";

        // Email Sending Details
        $mail->addAddress($usermail);
        $mail->Subject = "Password Request";
        $mail->isHTML(false);
        $mail->Body = $message;

        // Success or Failure
        if (!$mail->send()) {
        $error = "Mailer Error: " . $mail->ErrorInfo;
        echo '<p id="para">'.$error.'</p>';
        }
        else {
        echo '<p id="para">Message sent!</p>';
        }
      }

      if( isset($_POST["per"]) ){
        $EditJobs = $_POST["Job"];

        echo $SubUID;

        if(empty($EditJobs)){
          $sql3 = ("DELETE FROM `jobdata` WHERE usernumber = {$SubUID};");
          ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
          mysqli_query( $conn ,  $sql3);
          echo "<br>Empty";
        }else{
          if (in_array("1", $EditJobs)){
            $sql3 = ("INSERT INTO `jobdata`(`usernumber`, `jobnnumber`) VALUES ({$SubUID},1);");
            ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
            mysqli_query( $conn ,  $sql3);
            echo "<br>1";
          }else{
            $sql3 = ("DELETE FROM `jobdata` WHERE usernumber = {$SubUID} AND jobnumber = 1;");
            ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
            mysqli_query( $conn ,  $sql3);
            echo "<br>1";
          }
          if(in_array('2', $EditJobs)){
            $sql3 = ("INSERT INTO `jobdata`(`usernumber`, `jobnnumber`) VALUES ({$SubUID},2);");
            ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
            mysqli_query( $conn ,  $sql3);
            echo "<br>2";
          }else{
            $sql3 = ("DELETE FROM `jobdata` WHERE usernumber = {$SubUID} AND jobnumber = 2;");
            ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
            mysqli_query( $conn ,  $sql3);
            echo "<br>2";
          }
          if(in_array("3", $EditJobs)){
            $sql3 = ("INSERT INTO `jobdata`(`usernumber`, `jobnnumber`) VALUES ({$SubUID},3);");
            ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
            mysqli_query( $conn ,  $sql3);
            echo "<br>3";
          }else{
            $sql3 = ("DELETE FROM `jobdata` WHERE usernumber = {$SubUID} AND jobnumber = 3;");
            ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
            mysqli_query( $conn ,  $sql3);
            echo "<br>3";
          }
          if(in_array("4", $EditJobs)){
            $sql3 = ("INSERT INTO `jobdata`(`usernumber`, `jobnnumber`) VALUES ({$SubUID},4);");
            ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
            mysqli_query( $conn ,  $sql3);
            echo "<br>4";
          }else{
            $sql3 = ("DELETE FROM `jobdata` WHERE usernumber = {$SubUID} AND jobnumber = 4;");
            ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
            mysqli_query( $conn ,  $sql3);
            echo "<br>4";
          }
        }
      }

      if( isset($_POST["sub"]) ){
        $sendpass = '';
        $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i = 0; $i < 12; ++$i) {
            $sendpass .= $keyspace[random_int(0, 62)];
        }
        $message = "Hello {$username},

You have requested a new password from an administrator for this event. If you have not asked for a password, please contact the staff for this effect and report it.

Your new password is : {$sendpass}

We hope this does not inconvenience you.";

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "donotreplyconfer@gmail.com";
        $mail->Password = "Chirag25";

        // Email Sending Details
        $mail->addAddress($usermail);
        $mail->Subject = "Password Request";
        $mail->isHTML(false);
        $mail->Body = $message;

        // Success or Failure
        if (!$mail->send()) {
        $error = "Mailer Error: " . $mail->ErrorInfo;
        echo '<p id="para">'.$error.'</p>';
        }
        else {
        echo '<p id="para">Message sent!</p>';
        }
      }
      ?>
    </form>
    <br><!-- This is for readability on a computer, don't get rid of it. -->
    <script>autoSizeText();</script>
  </div>
</div>
