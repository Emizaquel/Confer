<form>
  <textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="10"></textarea><br><br>
  <input type = "submit" name = "sub" value = "Submit" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br><br>
</form>

<?php
if( isset($_POST["sub"]) ){
  $text = $_POST['editor1'];
  echo $text;
}
?>
