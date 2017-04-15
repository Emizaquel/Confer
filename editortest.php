<html>
<head>
	<title>Sample CKEditor Site</title>
	<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
</head>
<body>
	<form method="post">
			<textarea id="editor1" name="editor1">&lt;p&gt;Initial value.&lt;/p&gt;</textarea>
			<script type="text/javascript">
				CKEDITOR.replace( 'editor1' );
			</script>
		<p>
			<input type="submit" />
		</p>
	</form>
  <?php
  	$editor_data = $_POST[ 'editor1' ];
    $file = $_SERVER['DOCUMENT_ROOT'] . "/hometext.txt";
    echo $editor_data;
    $linesplit = explode("\n\n",$editor_data);
    foreach ($linesplit as &$workline) {
      if (strpos($workline, 'img') !== false) {
        if (strpos($workline, 'style') == false) {
          $search = "/[^img](.*)[^alt]/";
          $replace = " style="width:100%" ";
          echo preg_replace($search,$replace,$workline);
        }
      }
    }
    $withp = implode($linesplit);
    $replace = array("<p>", "</p>");
    $order = "<br />";
    $strout = str_replace($order, $replace, $linesplit);
    echo(file_put_contents($file, $editor_data));
  ?>
</body>
</html>
