<script src="ckeditor/ckeditor.js"></script>
<form>
    <textarea name="editor1" rows="10" cols="80" class="ckeditor">
        This is my textarea to be replaced with CKEditor.
    </textarea>
    <input type = "submit" name = "sub" value = "Submit" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br><br>
    <?php
        $editor_data = $_POST["editor1"];
        echo $_POST;
        echo $editor_data;
    ?>
</form>
