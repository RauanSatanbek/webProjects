

<form action="news.php" method = "post" enctype = "multipart/form-data">
	<div id = "writeNews">
		<div id = "writeNewsHeader"></div>
			<textarea name="news" id="textareaNews" cols="30" rows="10"></textarea>
			<div id = "divNews"></div>
		<div id = "writeNewsFooter">
			<input type="submit" value = "Отправить" class = "buttonForum" id = "writeNewsButton" name = "send">
			
			<label for="iconNews" id = "iconLabel"><div id = "iconScrepka"></div></label>
			<input type="file" id = "iconNews" name = "image">
		</div>
	</div>
</form>

