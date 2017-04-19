<head>
<link rel="stylesheet" type="text/css" href="general.css">
<link rel="icon" type="image/png" href="icon.ico">
<script src="scripts.js"></script>
</head>
<body>
<div id="wrapper">
  <div id="header">
    <div id="logo-pane">
        <div id="logo-content">
          <div id="image-border"><a href="home.php"><img src="Logo.jpg" width="100%"></a></div>
        </div>
      </div>
      <div id="title-pane">
        <div id="title-content"><div id="content">
          User List
        </div></div>
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
    <span id="NewEvent" style="display: block;background-color: white;border-radius: 15px;border-style: solid;border-color: grey;border-width: 10px;color: black;overflow-x: hidden;min-height: 72px;padding: 10px;padding-top: 45px;display: none;">
      <form method="POST" action="">
        <input type="text" placeholder="Enter Name" name="name" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br>
        <input type="text" placeholder="Enter E-Mail" name="email" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br>
        <input type="password" placeholder="password" name="password" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br>
        <br>type<br>
        <input type="radio" name="type" style="width:2em;height:2em;" value="1">User<br>
        <input type="radio" name="type" style="width:2em;height:2em;" value="2">Speaker<br>
        <input type="radio" name="type" style="width:2em;height:2em;" value="3">Staff<br>
        <input type="radio" name="type" style="width:2em;height:2em;" value="4">Admin<br>
        <input type = "submit" name = "sub" value = "Submit" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;" onclick="document.getElementById('login_text'.style.display=''">

        <?php
        $dbserver = "127.0.0.1:51097";
        $dbuser = "azure";
        $dbpass = "6#vWHD_$";
        $dbname = "localdb";
        $name = addslashes($_POST['name']);
        $email = addslashes($_POST['email']);
        $password = addslashes($_POST['password']);
        $type = $_POST['type'];

        $conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect($dbserver,  $dbuser,  $dbpass));

        if(! $conn ) {
          die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
        }

        if( isset($_POST["sub"]) ){
          $conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect($dbserver,  $dbuser,  $dbpass));

          $sql = ("INSERT INTO `userdata`(`usernumber`, `email`, `password`, `name`, `type`) VALUES (NULL,'{$email}','{$password}','{$name}','{$type}');");
          ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
          $retval = mysqli_query( $conn ,  $sql);

          if($retval) {
            $query = mysqli_fetch_row($retval);

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
        <a onclick="document.getElementById('NewEventButton').style.display='block'; document.getElementById('NewEvent').style.display='none';" class="link"><button type="button" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;border-radius: 0;">Cancel</button></a>
      </form>
    </span>
    <a onclick="document.getElementById('NewEvent').style.display='block'; document.getElementById('NewEventButton').style.display='none';" class="link">
      <span id="NewEventButton" style="display: block;background-color: white;border-radius: 15px;border-style: solid;border-color: grey;border-width: 10px;color: black;overflow-x: hidden;min-height: 36px;padding: 10px;text-align:center;">
        New User
      </span>
    </a>
    <br>
    <span style="display: block;background-color: white;border-radius: 15px;border-style: solid;border-color: grey;border-width: 10px;color: black;overflow-x: hidden;min-height: 36px;padding: 10px;text-align:center;">
      <form method="POST" action="">
        <input type="text" placeholder="Search Here" name="searchtext" style="height: 45px;width: 65%;font-size: 35px;">
        <input type = "submit" name = "search" value = "Go" style="height: 45px;width: 15%;font-size: 35px;">
      </form>
    </span>
    <br><br>
    <?php
    $dbserver = "127.0.0.1:51097";
    $dbuser = "azure";
    $dbpass = "6#vWHD_$";
    $dbname = "localdb";

    $conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect($dbserver,  $dbuser,  $dbpass));

    if(! $conn ) {
      die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
    }

      $sql = ("SELECT usernumber,name FROM `userdata`");
      ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
      $retval = mysqli_query( $conn ,  $sql);

      echo "<div id='EventTop'></div>";

      while($row = mysqli_fetch_array($retval))
      {
         $UserID = $row['usernumber'];
         $UserName = $row['name'];
         if(isset($_POST['search'])){
           $SearchTerm = $_POST['searchtext'];
           if(strstr($UserName,$SearchTerm)){
             echo "<a id='EventListing' href = 'User-A.php?UserID={$UserID}'>{$UserName}<br></a>";
           }
         }else{
           echo "<a id='EventListing' href = 'User-A.php?UserID={$UserID}'>{$UserName}<br></a>";
         }
      }
      echo "<div id='UserBottom'></div>";

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
              header("Location:Home-St.php");
            }else if ($userID == 4){
            }else{
              header("Location:login.php");

            }
          }
      }
    ?>
    <br><!-- This is for readability on a computer, don't get rid of it. -->
    <script>autoSizeText();</script>
  </div>
</div>
</body>
