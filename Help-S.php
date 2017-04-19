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
        <div id="title-content"><div id="content">Help</div></div>
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
    $dbserver = "127.0.0.1:51097";
    $dbuser = "azure";
    $dbpass = "6#vWHD_$";
    $dbname = "localdb";

    $conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect($dbserver,  $dbuser,  $dbpass));

    if(! $conn ) {
      die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
    }

    $file = $_SERVER['DOCUMENT_ROOT'] . "/helptext.txt";
    $current = file_get_contents ($file);
      $linesplit = explode(PHP_EOL,$current);
      foreach ($linesplit as &$workline) {
        if (strpos($workline, 'style') == false) {
          $order = "img";
          $replace = "img width = \"100%\"";
          $workline = str_replace($order, $replace, $workline);
        }
      }
      $withp = implode(PHP_EOL,$linesplit);
      $order = array("</p>");
      $replace = "<br><br>";
      $withbr = str_replace($order, $replace, $withp);
      $order = array("<p>");
      $replace = "";
      $strout = str_replace($order, $replace, $withbr);
      echo $strout;

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
              header("Location:Help-U.php");
            }else if ($userID == 2){
            }else if ($userID == 3){
              header("Location:Help-St.php");
            }else if ($userID == 4){
              header("Location:Help-A.php");
            }else{
              header("Location:login.php");
            }
          }
      }
    ?>
    <br><br>
    <form method="POST" action="">
      <textarea name="helptext" style="height: 135px;width: 98%;font-size: 35px;margin: 5px;">Enter help request here</textarea><br>
      <input type = "submit" name = "sub" value = "Submit" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;">
      <?php
      require 'PHPMailer/PHPMailerAutoload.php';

      if( isset($_POST["sub"]) ){
        $message = $_POST['helptext'];
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "donotreplyconfer@gmail.com";
        $mail->Password = "ConferEmailPassword";

        // Email Sending Details
        $mail->addAddress("ChiragH2355@gmail.com");
        $mail->Subject = "Password Request";
        $mail->isHTML(false);
        $mail->Body = $message

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
    <br><br><br><br><br><br><br><!-- This is for readability on a computer, don't get rid of it. -->
    <script>autoSizeText();</script>
  </div>
</div>
