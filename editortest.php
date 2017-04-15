<script src="ckeditor/ckeditor.js"></script>
<form>
  <textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="10">
  <script>
    CKEDITOR.replace( 'editor1' );
  </script><br>
  <input type = "submit" name = "sub" value = "Submit" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;">

  <?php
  if( isset($_POST["sub"]) ){
    $text = addslashes($_POST['editor1']);
    echo $text;
  }
  ?>
