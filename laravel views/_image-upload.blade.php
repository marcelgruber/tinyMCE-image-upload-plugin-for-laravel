<html>
<head>
	<meta charset="UTF-8">
	<title>Image Upload</title>
	<script type="text/javascript" src="/js/tinymce/plugins/imageupload/upload.js"></script>
	<script type="text/javascript">
	window.parent.window.ImageUpload.uploadSuccess({
		code : '<?php echo $file_path; ?>'
	});
	</script>
	<style type="text/css">
		img {
			max-height: 240px;
			max-width: 320px;
		}
	</style>
</head>
<body>
	<img src="<?php echo $file_path ?>">
</body>
</html>