<?
	session_start();
	isLogin();
	// echo $_SESSION["userToId"];
	if($_SESSION["userToId"]){
		$fromName = $_SESSION["user_name"] ;
		$fromSurname = $_SESSION["user_surname"] ;
		$fromId = $_SESSION["user_id"] ;
		$toId =$_SESSION["userToId"];
		// echo $fromId . " , " . $toId;
	}
?>


<?
	echo head("Форум");
	echo allInfo();
	// Қолданушы смс жібергенде оны базаға саламыз
		
	$mysqli = new mysqli("localhost", "root", "", "project");
	$mysqli->query("SET NAMES 'utf8'");
		if(isset($_POST["send"])){
			if(!empty($_POST["message"])){
			$name = $_SESSION['user_surname']." ".$_SESSION['user_name'];
			$mess = htmlspecialchars($_POST['message']);
		 	$mysqli->query("INSERT INTO `messages`( `from`, `to`, `message`, `time`, `class`) VALUES ('".$fromId."', '".$toId."','".$mess."', '".date('Y-m-d   H:i:s')."', 'messageFrom')");
			// exit (header("Location: forum.php"));
		 }
		}
	
?>
<div id = "mainForum">
	<div id = "headerForum"><p>Сообщение</p></div>
		<div id = "bodyForum">
			<?
			// Выводим все сообщение но в начале у всех смс лайки ровно 0
				function printSql($r, $mysqli){
					if($r){
						while(($row = $r->fetch_assoc()) != false){
							$message = $row["message"];
							$from = $row["from"];
							$time = $row["time"];
							$class = $row["class"];
							// Для смс которую написали мы даем другой id чтобы как ни буть отличать
							// echo $from ." ". $_SESSION["user_id"] ;
								if($from != $_SESSION["user_id"]) {$class = "messages" ;$id = "otherMessage";}
								else {$class = "MyMessages"; $id = "";}
							// Из базы берем имя того кто нам написал с toId
								$n = $mysqli->query("SELECT `name`, `surname` FROM `users` WHERE `id` = $from");
								$n = $n->fetch_assoc();
								$name = $n["name"] . " " . $n["surname"];
							echo '<div id = "'.$id.'"  class = "'.$class.'" >
								<p id = "nameWriter" class = "pFromMessage">'.$name.'</p><p id = "time" class = "pFromMessage">'.$time.'</p><br>
								<span id = "message">'.$message.'</span>
								</div>';

								// <img  alt="" class = "likeImg1" id = "'.("likeImg" .$index) .'">
						}
					}
				}
				// Вводим все смс которые нам отправлены и те смс которую мы отправели 
					$r = $mysqli->query("SELECT * FROM `messages` WHERE `to` = '".$fromId."' AND `from` = '".$toId."' OR `to` = '".$toId."' AND `from` = '".$fromId."' ORDER BY `id` DESC");
					printSql($r, $mysqli);
					$mysqli->close();
				
			?>
	</div>
	<form  id = "footerForum" method = "post" action="message.php">
		<textarea name="message" id="textareaForum" cols="30" rows="10" placeholder = "Введите Ваше сообщение..." required></textarea>
		<div id = "buttonAndIcon">
			<input type="submit" value = "Отправить" id = "buttonForum" class = "buttonForum" name = "send">
		</div>
	</form>
</div>
<?echo foot()?>
