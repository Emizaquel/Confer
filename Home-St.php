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
        <div id="title-content"><div id="content">Home</div></div>
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
    $email = addslashes($_POST['email']);
    $password = addslashes($_POST['pass']);

    include("baseconnect.php");

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
            header("Location:Home-U.php");
          }else if ($userID == 2){
            header("Location:Home-S.php");
          }else if ($userID == 3){
          }else if ($userID == 4){
            header("Location:Home-A.php");
          }else{
            header("Location:login.php");
          }
        }
    }

    $sql = ("SELECT jobnumber FROM jobdata WHERE usernumber = {$UID} AND jobnumber = 4;");
    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
    $retval = mysqli_query( $conn ,  $sql);
    if($retval){
      $query = mysqli_fetch_row($retval);
      $JobID = $query[0];

      if($JobID == 4){
        echo "<span id=\"EditPage\" style=\"display: block;background-color: white;border-radius: 15px;border-style: solid;border-color: grey;border-width: 10px;color: black;overflow-x: hidden;min-height: 72px;padding: 10px;padding-top: 45px;display: none;\">
          <form method=\"post\">
              <textarea id=\"editor1\" name=\"editor1\">";
        $file = $_SERVER['DOCUMENT_ROOT'] . "/hometext.txt";
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
        Edit Homepage
        </span>
        </a>";
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
      echo $withp;
      mysqli_close($conn);
      ?>
    <br><br><br><br><br><br><!-- This is for readability on a computer, don't get rid of it. -->
    <script>autoSizeText();</script>
  </div>
</div>
