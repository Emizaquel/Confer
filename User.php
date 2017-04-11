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
    ?>
    <form method="POST" action="">
      <input type = "submit" name = "sub" value = "New Password" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br><br>
      <?php
      if( isset($_POST["sub"]) ){
        $sendpass = '';
        $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i = 0; $i < 12; ++$i) {
            $sendpass .= $keyspace[random_int(0, 62)];
        }
        $message = "Hello {$username},\r\n\r\n You have requested a new password from an administrator for this event. If you have not asked for a password, please contact the staff for this effect and report it. \r\n\r\nYour new password is : {$sendpass} \r\n\r\nWe hope this does not inconvenience you.";
        $message = wordwrap($message, 70, "\r\n");
        if(mail("Chiragh2355@gmail.com","New Password",$message)){
          echo("Success!");
        }else{
          echo("$sendpass");
        }
        /*
        * This example is used for sendgrid-php V2.1.1 (https://github.com/sendgrid/sendgrid-php/tree/v2.1.1)
        */
       include "vendor/autoload.php";

       $email = new SendGrid\Email();
       // The list of addresses this message will be sent to
       // [This list is used for sending multiple emails using just ONE request to SendGrid]
       $toList = array('Chiragh2355@gmail.com', 'Chiragh2355@gmail.com');

       // Specify the names of the recipients
       $nameList = array('Name 1', 'Name 2');

       // Used as an example of variable substitution
       $timeList = array('4 PM', '5 PM');

       // Set all of the above variables
       $email->setTos($toList);
       $email->addSubstitution('-name-', $nameList);
       $email->addSubstitution('-time-', $timeList);

       // Specify that this is an initial contact message
       $email->addCategory("initial");

       // You can optionally setup individual filters here, in this example, we have
       // enabled the footer filter
       $email->addFilter('footer', 'enable', 1);
       $email->addFilter('footer', "text/plain", "Thank you for your business");
       $email->addFilter('footer', "text/html", "Thank you for your business");

       // The subject of your email
       $subject = 'Example SendGrid Email';

       // Where is this message coming from. For example, this message can be from
       // support@yourcompany.com, info@yourcompany.com
       $from = 'someone@example.com';

       // If you do not specify a sender list above, you can specifiy the user here. If
       // a sender list IS specified above, this email address becomes irrelevant.
       $to = 'Chiragh2355@gmail.com';

       # Create the body of the message (a plain-text and an HTML version).
       # text is your plain-text email
       # html is your html version of the email
       # if the receiver is able to view html emails then only the html
       # email will be displayed

       /*
        * Note the variable substitution here =)
        */
       $text = "
       Hello -name-,
       Thank you for your interest in our products. We have set up an appointment to call you at -time- EST to discuss your needs in more detail.
       Regards,
       Fred";

       $html = "
       <html>
       <head></head>
       <body>
       <p>Hello -name-,<br>
       Thank you for your interest in our products. We have set up an appointment
       to call you at -time- EST to discuss your needs in more detail.

       Regards,

       Fred<br>
       </p>
       </body>
       </html>";

       // set subject
       $email->setSubject($subject);

       // attach the body of the email
       $email->setFrom($from);
       $email->setHtml($html);
       $email->addTo($to);
       $email->setText($text);

       // Your SendGrid account credentials
       $username = 'azure_caf314d7239d3e6933a43d5514d85347@azure.com';
       $password = 'Chirag25';

       // Create SendGrid object
       $sendgrid = new SendGrid($username, $password);

       // send message
       $response = $sendgrid->send($email);

       print_r($response);

      }
      ?>
    </form>
    <br><!-- This is for readability on a computer, don't get rid of it. -->
    <script>autoSizeText();</script>
  </div>
</div>
