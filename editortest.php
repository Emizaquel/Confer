<html>
<head>
	<title>Sample CKEditor Site</title>
	<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
</head>
<body>
	<form method="post">
		<p>
			My Editor:<br />
			<textarea id="editor1" name="editor1">&lt;p&gt;Initial value.&lt;/p&gt;</textarea>
			<script type="text/javascript">
				CKEDITOR.replace( 'editor1' );
			</script>
		</p>
		<p>
			<input type="submit" />
		</p>
	</form>
  <?php
  	$editor_data = $_POST[ 'editor1' ];
    $usrimgpath = $_SERVER['DOCUMENT_ROOT'] . "/hometext.txt";
    echo $editor_data;
    file_put_contents($file, $editor_data);
  ?>
</body>
</html>
