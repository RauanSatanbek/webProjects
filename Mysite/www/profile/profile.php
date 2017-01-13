<? 
	isLogin();
	session_start();
	// echo $_SESSION["user_is_logged"];
	echo head("Профиль");
	echo allInfo();
	// connect db
		
	$mysqli = new mysqli("localhost", "root", "", "project");
	$mysqli->query("SET NAMES 'utf8'");
	// for me
		$user_id = $_SESSION["user_id"];
	// for other users
		if(isset($_SESSION["userId"])){
			$user_id = $_SESSION["userId"];
			$_SESSION["labelClass"] = "writeMassageToUser " . $user_id;
			$_SESSION["labelText"] = "Написать сообщение";
			$_SESSION["userToId"] = $user_id;
			// echo $_SESSION["userId"];
			unset($_SESSION["I"]);
			unset($_SESSION["labelFor"]);
			unset($_SESSION["button"]);
			// unset($_SESSION["labelText"]);
		} 
		//  From index.php take var which remove user from AllUsers
			if($_POST["removeAtherProfile"]){
				 $_SESSION["I"] = true;
			}
			if(isset($_SESSION["I"])){
				$_SESSION["labelFor"] = "inputFile";
				$_SESSION["labelText"] = "Загрузить другой аватар";
				$_SESSION["button"] = '<input type="submit" name = "sendAvatar" value = "  Изменить  "  class = "button">';
				unset($_SESSION["userId"]);
				unset($_SESSION["labelClass"]);
			}
			// All information about user
				$infoAboutUser = $mysqli->query("SELECT * FROM `users` WHERE id = '".$user_id."'")->fetch_assoc();
?>
<div id = "searchUsers">
<div class = "nameUser"><?=($infoAboutUser["surname"] . " " . $infoAboutUser["name"])?></div>
<div id = "profile">
	<div id = "avatarProfile">
		<?
			$_SESSION["error"] = "";
			if(isset($_POST["sendAvatar"])){
				$avatar = $_FILES["avatar"];
				// print_r($avatar);
				$tmp_name = $avatar["tmp_name"];
				$type = substr($avatar["type"],6);
				$size = $avatar["size"];
				if($type != "jpeg" && $type != "jpg" && $type != "png"){
					$_SESSION["error"] = "Неверный формат изображения";
				} else if ($size > 1 * 1024 * 1024){
					$_SESSION["error"] = "Размер изображения слишком большой";
				} else{
					// Удаление старого автара
						$oldAvatar = $mysqli->query("SELECT `avatar` FROM `users`WHERE id = '".$user_id."'");
						$oldAvatar = $oldAvatar->fetch_assoc();
						if($oldAvatar["avatar"]) unlink("img/avatars/" . $oldAvatar["avatar"]);
					// Обнавление в базе  и дабавление автвра
						$row = $mysqli->query("UPDATE `users` SET `avatar` = '".$user_id. "." . $type ."' WHERE id = '".$user_id."'");
						move_uploaded_file($tmp_name, "img/avatars/".$user_id. "." . $type);
				}
			}
			//avatar from database
				$row = $mysqli->query("SELECT `avatar` FROM `users` WHERE id = '".$user_id."'");
				$row = $row->fetch_assoc();
				$avatar = $row["avatar"];
				if($avatar == 0) $avatar = 0 . ".png";
				echo '<img src="../img/avatars/'.$avatar.'" height="250" width="192" alt="" class = "showImg" id = "userAvatar">';
			
			// print_r($infoAboutUser);
			// unset( $_SESSION["userId"]);
			$mysqli->close();
			
		?>
		<form action="" method = "post" enctype = "multipart/form-data">
			<label for="<?=$_SESSION['labelFor']?>" id = "labelFile" class = "<?=$_SESSION['labelClass']?>"><?=$_SESSION["labelText"]?></label>
			<input type="file" name = "avatar" id = "inputFile"><br><span id = "ErrorAvatar"><?=$_SESSION["error"]?></span><br><br>
			<?=$_SESSION["button"]?>
		</form>
	</div>
	</div>
	<!-- info about user -->
	<style>
		table tr td{
			width: 100px;
			border:none;
		}
		table tr td p{
			float: left;
		}
	</style>
	<div id = "infoProfile">
	<table>
		<tr>
			<td><p>Имя:</p></td>
			<td><p><?=$infoAboutUser["name"]?></p></td>
		</tr>
		<tr>
			<td><p>Фомилия:</p></td>
			<td><p><?=$infoAboutUser["surname"]?></p></td>
		</tr>
		<tr>
			<td><p>Телефон:</p></td>
			<td><p><?=$infoAboutUser["tel"]?></p></td>
		</tr>
		<!-- <tr>
			<td><p>Логин:</p></td>
			<td><p><?=$infoAboutUser["login"]?></p></td>
		</tr> -->
	</table>
	</div>
</div>



<?echo foot();?>