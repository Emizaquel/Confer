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
              $UID = $_COOKIE["UserID"];

              $sql = ("SELECT type FROM userdata WHERE usernumber = '" . $UID . "';");
              ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
              $retval = mysqli_query( $conn ,  $sql);

              if($retval ) {
                $query = mysqli_fetch_row($retval);
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
          ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
          $retval = mysqli_query( $conn ,  $sql);
          $query = mysqli_fetch_array($retval);

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
      <br><a onclick="document.getElementById('EditDetails').style.display=''; document.getElementById('UserDetails').style.display='none';" class="link"><button type="button" id="customButton1">Edit Details</button></a><br>
      <br><a href="logout.php"><button type="button" id="customButton1">logout</button></a>
      <script>autoSizeText();</script>
    </span>
    <span id="EditDetails" style="display: none">
      <form method="POST" action="" enctype="multipart/form-data">
        Image (Not required) :
        <input name="usrimgup" type="file" accept="image/*"><br>
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
        <br><br>
        <span id="deletebutton">
          <a onclick="document.getElementById('deleteconfirm').style.display='block'; document.getElementById('deletebutton').style.display='none';" class="link"><button type="button" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;border-radius: 0;">Delete</button></a>
        </span>
        <span id="deleteconfirm" style="display: none;">
          <br><br>Are you sure?<br><br>
          <input type = "submit" name = "del" value = "Yes" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;">
          <br><br>
          <a onclick="document.getElementById('deletebutton').style.display='block'; document.getElementById('deleteconfirm').style.display='none';" class="link"><button type="button" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;border-radius: 0;">No</button></a><br><br>
        </span>

        <?php
        $dbserver = "127.0.0.1:51097";
        $dbuser = "azure";
        $dbpass = "6#vWHD_$";
        $dbname = "localdb";

        $conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect($dbserver,  $dbuser,  $dbpass));

        if(! $conn ) {
          die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
        }

        if( isset($_POST["del"]) ){
          $sql3 = ("DELETE FROM `eventdata` WHERE eventnumber = {$EventID};");
          ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
          mysqli_query( $conn ,  $sql3);
        }

        if( isset($_POST["sub"]) ){
          $email = addslashes($_POST['email']);
          $password = addslashes($_POST['password']);
          $EditPass = addslashes($_POST['password2']);
          $EditPass2 = addslashes($_POST['password3']);
          $EditName = addslashes($_POST['name']);

          $target_dir = "userimages/";
          $target_file = $target_dir . "usrimg" . $UID . ".jpg";
          $uploadOk = 1;
          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

          $conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect($dbserver,  $dbuser,  $dbpass));

          $sql = ("SELECT usernumber FROM userdata WHERE email = '" . $email . "' AND password = '" . $password . "';");
          ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
          $retval = mysqli_query( $conn ,  $sql);

          if($retval) {
            $query = mysqli_fetch_row($retval);

            $userID = $query[0];

            if($userID){
              if($EditPass == $EditPass2){
                if($EditPass == NULL){
                  $sql = ("UPDATE `userdata` SET `email`=\"{$email}\",`name`=\"{$EditName}\" WHERE usernumber = {$UID};");
                  ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
                  mysqli_query( $conn ,  $sql);
                }else{
                  $sql = ("UPDATE `userdata` SET `email`=\"{$email}\",`password`=\"{$EditPass}\",`name`=\"{$EditName}\" WHERE usernumber = {$UID};");
                  ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
                  mysqli_query( $conn ,  $sql);
                }
              }

              list($srcwidth, $srcheight) = getimagesize($_FILES["usrimgup"]["tmp_name"]);
              if($srcwidth !== false) {
                if ($_FILES["fileToUpload"]["size"] < 500001) {

                  if($imageFileType == "jpg"){
                    $im = imagecreatefromjpeg($_FILES["usrimgup"]["tmp_name"]);
                  }else if ($imageFileType == "jpeg"){
                    $im = imagecreatefromjpeg($_FILES["usrimgup"]["tmp_name"]);
                  }else if ($imageFileType == "gif"){
                    $im = imagecreatefromgif($_FILES["usrimgup"]["tmp_name"]);
                  }else if($imageFileType == "png"){
                    $im = imagecreatefrompng($_FILES["usrimgup"]["tmp_name"]);
                  }else{
                    echo ("Unsupported filetype, please use jpg, jpeg, png or gif");
                  }

                  $exif = exif_read_data($_FILES['usrimgup']['tmp_name']);
                  if(!empty($exif['Orientation'])) {
                    switch($exif['Orientation']) {
                      case 8:
                        $im = imagerotate($im,90,0);
                        break;
                      case 3:
                        $im = imagerotate($im,180,0);
                        break;
                      case 6:
                        $im = imagerotate($im,-90,0);
                        break;
                    }
                  }

                  if ($srcwidth > $srcheight) {
                    $xstart = ($srcwidth - $srcheight)/2;
                    $xend = $xstart + $srcheight;
                    $im2 = imagecreatetruecolor(500, 500);
                    if(imagecopyresampled ( $im2 , $im , 0 , 0 , $xstart , 0 , 500 , 500 , $srcheight , $srcheight )){
                    }
                  } else {
                    $ystart = ($srcheight - $srcwidth)/2;
                    $yend = $ystart + $srcwidth;
                    $im2 = imagecreatetruecolor(500, 500);
                    if(imagecopyresampled ( $im2 , $im , 0 , 0 , 0 , $ystart , 500 , 500 , $srcwidth , $srcwidth )){
                    }
                  }
                  imagepng($im2, $target_file);
                } else{
                  echo "File is too large";
                }
              } else {
                  echo "File is not an image.";
              }

            }else{
               echo 'User details not valid';
            }
          }else{
          }

          $sql = "UPDATE `userdata` SET `email`=\"{$EditEmail}\",`password`=\"{$EditPass}\",`name`=\"{$EditName}\" WHERE `eventdata`.`usernumber` = {$UID};";
          ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . conferdata));
          mysqli_query( $conn ,  $sql);
        }
        ?>
      </form>
    </span>
    <br><br><br><br><br><br><br><!-- This is for readability on a computer, don't get rid of it. -->
    <script>autoSizeText();</script>
  </div>
</div>
