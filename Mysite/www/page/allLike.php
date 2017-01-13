<?
	session_start();
	function printSql($r){
		$ids = array();
		$c = 0;
		while(($row = $r->fetch_assoc()) != false){
			$ids[] = $row["id_message"];
		}
		return $ids;
	}
	$mysqli = connectToDb();
	$ids = $mysqli->query("SELECT `id_message` FROM `likes`");
	$ids = printSql($ids);
	echo json_encode($ids);
	$mysqli->close();
?>