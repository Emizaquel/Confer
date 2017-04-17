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
      <div id="image-border"><a href="admin.php"><img src="admin.png" height="100%"></a></div>
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
          }else if ($userID == 4){
            header("Location:Help-A.php");
          }else{
            header("Location:login.php");
          }
        }
    }

    $sql = ("SELECT jobnumber FROM jobdata WHERE usernumber = {$UID} AND jobnumber == 3;");
    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
    $retval = mysqli_query( $conn ,  $sql);
    if($retval){
      $query = mysqli_fetch_row($retval);
      $JobID = $query[0];

      $JobValue = FALSE;
      if($JobID == 3){
        echo "<span id=\"EditPage\" style=\"display: block;background-color: white;border-radius: 15px;border-style: solid;border-color: grey;border-width: 10px;color: black;overflow-x: hidden;min-height: 72px;padding: 10px;padding-top: 45px;display: none;\">
          <form method=\"post\">
              <textarea id=\"editor1\" name=\"editor1\">";
              $file = $_SERVER['DOCUMENT_ROOT'] . "/helptext.txt";
              if(isset($_POST[ 'editor1' ])){
                $editor_data = $_POST[ 'editor1' ];
                file_put_contents($file, $editor_data);
              }
              $current = file_get_contents ($file);
              echo $current;
              echo "</textarea>
              <script type=\"text/javascript\">
               CKEDITOR.replace( 'editor1' );
              </script>
              <p>
              <input type=\"submit\" style=\"height: 45px;width: 98%;font-size: 35px;margin: 5px;\" /><br>
              <a onclick=\"document.getElementById('EditPageButton').style.display='block'; document.getElementById('EditPage').style.display='none';\" class=\"link\"><button type=\"button\" style=\"height: 45px;width: 98%;font-size: 35px;margin: 5px;border-radius: 0;\">Cancel</button></a>
              </p>
              </form>
              </span>
              <a onclick=\"document.getElementById('EditPage').style.display='block'; document.getElementById('EditPageButton').style.display='none';\" class=\"link\">
              <span id=\"EditPageButton\" style=\"display: block;background-color: white;border-radius: 15px;border-style: solid;border-color: grey;border-width: 10px;color: black;overflow-x: hidden;min-height: 36px;padding: 10px;text-align:center;\">
              Edit Help Page
              </span>
              </a><br><br>";
      }
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
    ?>
    <br><!-- This is for readability on a computer, don't get rid of it. -->
    <script>autoSizeText();</script>
  </div>
</div>
