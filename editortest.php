<script src="ckeditor/ckeditor.js"></script>
<form>
    <textarea name="editor1" id="editor1" rows="10" cols="80">
        This is my textarea to be replaced with CKEditor.
    </textarea>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'editor1' );
    </script>
    <input type = "submit" name = "sub" value = "Submit" style="height: 45px;width: 98%;font-size: 35px;margin: 5px;"><br><br>
    <?php
        $editor_data = $_POST[ 'editor1' ];
        echo $editor_data;
    ?>
</form>
