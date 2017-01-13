
<?
	echo head("Форум");
	echo allInfo();
	// Қолданушы смс жібергенде оны базаға саламыз
		$mysqli = connectToDb();
		if(isset($_POST["send"])){
			if(!empty($_POST["message"])){
			// егер сурет бар болса онда оны базага саламыз
				if($_FILES["image"]){
					$image = $_FILES["image"];
					$imgName = time();
					$imgName =  addImg($image,"img/forumImage/",$imgName);
				}
			$name = $_SESSION['user_surname']." ".$_SESSION['user_name'];
			$mess = htmlspecialchars($_POST['message']);
		 	$mysqli->query("INSERT INTO `chat`( `message`, `name`,`image`, `time`) VALUES ('".$mess."', '".$name."', '".$imgName."' ,'".date('Y-m-d   H:i:s')."')");
			// exit (header("Location: forum.php"));
		 }
		}
	
?>



<div id = "mainForum">
	<div id = "headerForum">Форум</div>
		<div id = "bodyForum">
			<?
			// Выводим все сообщение с лайками
				function printSql($r){
					while(($row = $r->fetch_assoc()) != false){
						$id = $row["id"];
						$message = $row["message"];
						$name = $row["name"];
						$time = $row["time"];
						$img = $row["image"];
						$img = setImage($img, "img/forumImage/");
						$like = $row["count"];
						echo '<div class = "messages">
							<p id = "nameWriter" class = "pFromMessage">'.$name.'</p><p id = "time" class = "pFromMessage">'.$time.'</p><br>
							'.$img.'<br>
							<span id = "message">'.$message.'</span>
							<br><span id = "messageLike"><div class = "like" id = "'.("like" .$id) .'">Мне нравится '.$like.'</div></span>
							</div>';

							// <img  alt="" class = "likeImg1" id = "'.("likeImg" .$index) .'">
					}
				}
				$r = $mysqli->query("SELECT * FROM `chat` ORDER BY `id` DESC");
				printSql($r);
				$mysqli->close();
				
			?>
	</div>
	<form  id = "footerForum" method = "post" action="forum.php" enctype="multipart/form-data">
		<textarea name="message" id="textareaForum" cols="30" rows="10" placeholder = "Введите Ваше сообщение..." required></textarea>
		<div id = "buttonAndIcon">
			<input type="submit" value = "Отправить" id = "buttonForum" class = "buttonForum" name = "send">
			<label for="iconNews" class = "labelIconScrepka"><div id = "iconScrepka"></div></label>
			<input type="file" id = "iconNews" name = "image">
		</div>
	</form>
</div>
<?echo foot()?>
