<head>
<link rel="stylesheet" type="text/css" href="general.css">
<link rel="icon" type="image/png" href="icon.ico">
<script src="scripts.js"></script>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
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
      <div id="image-border"><a href="admin.php"><img src="admin.png" height="100%"></a></div>
      <div id="image-border"><a href="help.php"><img src="help.png" height="100%"></a></div>
      <div id="image-border"><a href="settings.php"><img src="setting.png" height="100%"></a></div>
    </div>
  </div>
  <div id="page-body">
    <span id="EditPage" style="display: block;background-color: white;border-radius: 15px;border-style: solid;border-color: grey;border-width: 10px;color: black;overflow-x: hidden;min-height: 72px;padding: 10px;padding-top: 45px;display: none;">
      <form method="post">
          <textarea id="editor1" name="editor1"><?php
          include("baseconnect.php");

          $file = $_SERVER['DOCUMENT_ROOT'] . "/helptext.txt";
          if(isset($_POST[ 'editor1' ])){
            $editor_data = $_POST[ 'editor1' ];
            file_put_contents($file, $editor_data);
          }
          $current = file_get_contents ($file);
          echo $current;
           ?></textarea>
          <script type="text/javascript">
            CKEDITOR.replace( 'editor1' );
          </script>
        <p>
          <input type="submit" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;" /><br>
          <a onclick="document.getElementById('EditPageButton').style.display='block'; document.getElementById('EditPage').style.display='none';" class="link"><button type="button" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;border-radius: 0;">Cancel</button></a>
        </p>
      </form>
    </span>
    <a onclick="document.getElementById('EditPage').style.display='block'; document.getElementById('EditPageButton').style.display='none';" class="link">
      <span id="EditPageButton" style="display: block;background-color: white;border-radius: 15px;border-style: solid;border-color: grey;border-width: 10px;color: black;overflow-x: hidden;min-height: 36px;padding: 10px;text-align:center;">
        Edit Help Page
      </span>
    </a>
    <?php
      $linesplit = explode(PHP_EOL,$current);
      foreach ($linesplit as &$workline) {
        if (strpos($workline, 'style') == false) {
          $order = "img";
          $replace = "img width = \"100%\"";
          $workline = str_replace($order, $replace, $workline);
        }
      }
      $withp = implode(PHP_EOL,$linesplit);
      echo $withp;

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
              header("Location:Help-S.php");
            }else if ($userID == 3){
              header("Location:Help-St.php");
            }else if ($userID == 4){
            }else{
              header("Location:login.php");
            }
          }
      }
    ?>
    <br><br>
    <form method="POST" action="">
      <textarea name="helptext" style="height: 135px;width: 98%;font-size: 35px;margin: 5px;">Enter help request here, you will be randomly assigned to one of the staff. Please wait for a response.</textarea><br>
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

        $sql = ("SELECT email FROM userdata WHERE type = '4';");
        ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
        $retval = mysqli_query( $conn ,  $sql);

        $validuser = array();
        while($row = mysqli_fetch_array($retval)){
          $validuser[] = $row[0];
        }

        $sql = ("SELECT usernumber FROM jobdata WHERE jobnumber = '3';");
        ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
        $retval = mysqli_query( $conn ,  $sql);

        while($row = mysqli_fetch_array($retval)){
          $sql2 = ("SELECT email FROM userdata WHERE usernumber = '{$row[0]}';");
          ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
          $retval2 = mysqli_query( $conn ,  $sql2);
          $query2 = mysqli_fetch_row($retval2);
          $validuser[] = $query2[0];
        }

        $size = count($validuser);
        $randomuser = rand(0,$size);

        $mail->addAddress($validuser[$randomuser]);
        $mail->Subject = "Help Request";
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
