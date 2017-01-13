<?
	function printSql($r){
		$ids = array();
		$c = 0;
		while(($row = $r->fetch_assoc()) != false){
			$ids[] = $row["id_message"];
		}
		return $ids;
	}
	session_start();
	$mysqli = connectToDb();

 	$id_user = $_SESSION["user_id"];
	$id_message = $_POST["messageId"];
	// Проверка исть ли такой user
		$r = $mysqli->query("SELECT * FROM `likes` WHERE `id_user` = '$id_user' AND `id_message` = '$id_message'");
		$r = $r->fetch_assoc();
	if($r["id"] == 0 or $r == false){
		$mysqli->query("INSERT INTO `likes` (`id_user`, `id_message`) VALUES ('".$id_user."', '".$id_message."')");
		$count = $mysqli->query("SELECT `count` FROM `chat` WHERE `id` = '".$id_message."'");
		$count = $count->fetch_assoc();
		$like = number_format($count["count"]);
		$like++;
		echo $like;
		$mysqli->query("UPDATE `chat` SET `count` = '".$like."' WHERE `id` = '".$id_message."'");
	} else if($r["id"] == 1 or $r == true){
		$mysqli->query("DELETE FROM `likes` WHERE (`id_user` = '".$id_user."') AND (`id_message` = '".$id_message."') ");
		$count = $mysqli->query("SELECT `count` FROM `chat` WHERE `id` = '".$id_message."'");
		$count = $count->fetch_assoc();
		$like = number_format($count["count"]);
		$like--;
		echo $like;
		$mysqli->query("UPDATE `chat` SET `count` = '".$like."' WHERE `id` = '".$id_message."'");
	}
	$mysqli->close(); 
?>