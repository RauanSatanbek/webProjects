<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Image upload</title>
	<script src="jquery.js"></script>
	<script src="imageupload.js"></script>
	<script>
		$(document).ready(function () {				
			$("#upload_image").imageUpload("upload.php", {
				uploadButtonText: "Button",
				previewImageSize: 1000,
				onSuccess: function (response) {
					alert(response);
				}
			});
		});
	</script>
</head>
<body>
	<div id="upload_image">
	</div>
</body>
</html>