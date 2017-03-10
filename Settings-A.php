<head>
<link rel="stylesheet" type="text/css" href="general.css">
</head>
<div id="wrapper">
  <div id="header">
    <div id="logo-pane">
        <div id="logo-content">
          <div id="image-border"><a href="home.php"><img src="Logo.jpg" width="100%"></a></div>
        </div>
      </div>
      <div id="title-pane">
        <div id="title-content">
          Title
        </div>
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
      Insert Image here
      <br>
      <br>Name : (First/Last)
      <br>Email : (Insert here)
      <br>
      <br>Insert Edit Details Button.
      <br>
      <br><a onclick="document.getElementById('EditDetails').style.display=''; document.getElementById('UserDetails').style.display='none';" class="link">[EDIT USER DATA]</a>
    </span>
    <span id="EditDetails" style="display: none">
    Insert Image upload link here
    <br>
    <br>Edit Name : (First/Last)
    <br>Edit Email : (Insert here)
    <br>
    <br><a onclick="document.getElementById('UserDetails').style.display=''; document.getElementById('EditDetails').style.display='none';" class="link">[SAVE DETAILS]</a>
    </span>
    <br><!-- This is for readability on a computer, don't get rid of it. -->
  </div>
</div>
