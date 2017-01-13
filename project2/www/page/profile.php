<?php
	include("functions.php");
	include("../resource/imports.php");
	include("db.php");
	head("Профиль");
	sidebar_left();
	include("menu.php");
	container();
	
	// for me
		if ($_SESSION["profile"] == 1){
			$name = $_SESSION["user_name"];
			$surname = $_SESSION["user_surname"];
			$avatar = $_SESSION["user_avatar"];
			$_SESSION["class"] = "";
			$_SESSION["labelFor"] = "inputFile";
			$_SESSION["labelText"] = "Загрузить другой аватар";
		} 
	// for other users
		else {
			$r = $mysqli->query("SELECT * FROM `users` WHERE `id` = '".$_SESSION['userId']."'")->fetch_assoc();
			$name = $r["name"];
			$surname = $r["surname"];
			$avatar = $r["avatar"];
			$_SESSION["class"] = "pageOtherUsers";
			$_SESSION["labelFor"] = "";
			$_SESSION["labelText"] = "Написать сообщение";
			$_SESSION["userId"] = 'id = "'.$_SESSION["userId"].'"';
		}
	// load new Avatar
		$_SESSION["error"] = "";
		if(isset($_POST["send"])){			
			$avatarFile = $_FILES['avatar'];
			$type = substr($avatarFile["type"],6);
			$nameAvatar = $_SESSION["user_id"] . "." . $type;
			$tmp_name = $avatarFile["tmp_name"];
			$size = $avatarFile["size"];

			if($type != "jpeg" && $type != "jpg" && $type != "png")$_SESSION["error"] = "Неверный формат изображения";
			else if ($size > .5 * 1024 * 1024)$_SESSION["error"] = "Размер изображения слишком большой";
			else {
				// $mysqli->query("UPDATE `users` SET `avatar` = '$name' WHERE `id` = '$_SESSION['user_id']'");
				$mysqli->query("UPDATE `users` SET `avatar` = '".$nameAvatar."' WHERE `id` = '".$_SESSION["user_id"]."'");
				move_uploaded_file($tmp_name, "../img/avatars/" . $nameAvatar);
				$avatar = $nameAvatar;
			}
			$mysqli->close();
			
		}
?>
<style>
.ap{
		background: #445;
	}
.form{
	padding: 0 0;
	margin-bottom: 20px;

}
.form input{
	border:1px solid #556;
}

.pageOtherUsers{
	display: none;
}
</style>
<body>
	<div class = "wrapperP">
		<div class = "headP"></div>
		<div class = "middleP">
			<aside class="leftsidebarP">
				<center>
					<img src="../img/avatars/<?=$avatar?>" alt=""  id = "avatar">
					<form action="" method = "post" enctype = "multipart/form-data">
						<label for="<?=$_SESSION["labelFor"]?>" class = "labelFile" <?=$_SESSION["userId"]?>><?=$_SESSION["labelText"]?></label>
						<input type="submit" name = "send" value = "Сахранить" id = "sendAvatar" class = "button" >
						<span id = "error"><?=$_SESSION["error"];?></span>
						<input type="file" name = "avatar" id = "inputFile">
					</form>
				<div class = "<?=$_SESSION["class"]?>">
					<hr>
					<p id = "edit" class = "showMore">Редактировать</p>
				</div>
				<div class = "editForm">
						<form  class = "form">
							<input type="text" id = 'editName' class = "input" placeholder = "Имя*">
							<input type="text" id = 'editSurname'  class = "input" placeholder = "Фамилия*"> 
							<input type="button" value = 'Сахранить' class = 'button' id = 'save' >
						</form>
					<hr>
				</div>
				</center>
			</aside>
			<aside class="rightsidebarP">
				<table>
					<tr>
						<td>Имя :</td>
						<td><?=$name;?></td>
					</tr>
					<tr>
						<td>Фамилия :</td>
						<td><?=$surname;?></td>
					</tr>
					<tr>
						<td>Школа :</td>
						<td>3</td>
					</tr>
					<tr>
						<td>Класс :</td>
						<td>4</td>
					</tr>
					<tr>
						<td>Телефон :</td>
						<td>5</td>
					</tr>
				</table>
			</aside>
		</div>
		<div class = "headP"></div>
		<div class = "footP"></div>
	</div>
</body>
</html>

<?
	sidebar_right();
	include("allUsers.php");
	footer();
?>