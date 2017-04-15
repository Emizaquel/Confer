<?php
require 'PHPMailer/PHPMailerAutoload.php';

$dbserver = "127.0.0.1:51097";
$dbuser = "azure";
$dbpass = "6#vWHD_$";
$dbname = "localdb";

$conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect($dbserver,  $dbuser,  $dbpass));

if(! $conn ) {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
}

$sql1 = ("SELECT eventnumber,eventname,eventtime FROM `eventdata` ORDER BY `eventdata`.`eventtime` ASC");
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
$retval1 = mysqli_query( $conn ,  $sql1);

$Earliest = strtotime($today)+67200;
$Latest = strtotime($today)+76800;

while($row1 = mysqli_fetch_array($retval1)){
  $EventID = $row1['eventnumber'];
  $EventName = $row1['eventname'];
  $EventTime = strtotime($row1['eventtime']);
  $DateTime = date('l jS \of F Y h:i:s A', $EventTime);

  if(1){

    $message = "Dear User,

You have opted to be reminded for {$EventName}.

The event takes place on {$DateTime}, approximately two hours from when this message was sent.

We hope this e-mail has been useful.";

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = "donotreplyconfer@gmail.com";
    $mail->Password = "Chirag25";

    // Email Sending Details
    $sql2 = ("SELECT usernumber FROM reminderdata WHERE eventnumber = {$EventID};");
    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
    $retval2 = mysqli_query( $conn ,  $sql2);

    while($row2 = mysqli_fetch_array($retval2)){
      $UID = $row2['usernumber'];

      $sql3 = ("SELECT email FROM userdata WHERE usernumber = {$UID};");
      ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
      $retval3 = mysqli_query( $conn ,  $sql3);
      $query3 = mysqli_fetch_array($retval3);
      $mail->AddBCC($query3);
    }
    $mail->Subject = "Reminder for {$EventName}";
    $mail->isHTML(false);
    $mail->Body = $message;

    $mail->send();
  }
}
?>
