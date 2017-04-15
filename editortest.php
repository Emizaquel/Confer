<html>
<head>
	<title>Sample CKEditor Site</title>
	<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
</head>
<body>
	<form method="post">
			<textarea id="editor1" name="editor1"><?php
      $file = $_SERVER['DOCUMENT_ROOT'] . "/hometext.txt";
      $current = file_get_contents ($file);
      echo $current;
       ?></textarea>
			<script type="text/javascript">
				CKEDITOR.replace( 'editor1' );
			</script>
		<p>
			<input type="submit" />
		</p>
	</form>
  <?php
  	$editor_data = $_POST[ 'editor1' ];
    echo $editor_data;
    file_put_contents($file, $editor_data);
  ?>
</body>
</html>
