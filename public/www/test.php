<?php 
	if(isset($_POST["send"])){
		echo ($_FILES["img"]["tmp_name"]);
	}
?>
<form action="" method = "post" enctype = "multipart/form-data">
	<input type="file" name = "img">
	<input type="submit" name = "send" value = "send">
</form>