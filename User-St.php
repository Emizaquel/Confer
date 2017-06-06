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
          include("baseconnect.php");

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
                }else if ($userID == 4){
                  header("Location:Admin-A.php");
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
            ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
            $retval = mysqli_query( $conn ,  $sql);
            $query = mysqli_fetch_array($retval);

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
    mysqli_close($conn);
    ?>
    <form method="POST" action="">
      <input type = "submit" name = "sub" value = "New Password" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br><br>
      <br><br>
      <span id="deletebutton">
        <a onclick="document.getElementById('deleteconfirm').style.display='block'; document.getElementById('deletebutton').style.display='none';" class="link"><button type="button" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;border-radius: 0;">Delete</button></a>
      </span>
      <span id="deleteconfirm">
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
      mysqli_close($conn);
      ?>
    </form>
    <br><!-- This is for readability on a computer, don't get rid of it. -->
    <script>autoSizeText();</script>
  </div>
</div>
