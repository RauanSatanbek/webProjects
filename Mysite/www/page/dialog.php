<?
	isLogin();
	echo head("");
	echo allInfo();
?>
<?
	// сайттағы қолданушының ID 
		$user_id = $_SESSION["user_id"];


?>
<?// таңдалған user дің id ін алып message.php жібереміз //
	session_start();
	if($_POST["userToId"]){
		$_SESSION["userToId"] = $_POST["userToId"];

	}
////////////////////////////////////////////////////////////

?>
<style>
	#tableAllUsers tr td a{
	color:#2f4f4f;
	cursor:pointer;
}

#tableAllUsers th {
	color:white;}
</style>
<!-- Таңдалған қолданушының Id ін алып оны  SESSION ға сақтаймыз-->
<script>
	$(document).ready(function(){
		$("#bodyForum").delegate(".a","click", function(){
			var userToId = $(this).get(0).id;
			$.ajax({
				url:"allUsers.php",
				type:"POST",
				data:({userToId:userToId}),
				dataType:"html",
				success:function(data){
					document.location.replace('message.php')
				}
			});;
		});
	});
</script>
<?
$mysqli = connectToDb();
// $row = $mysqli->query("SELECT * FROM `users` WHERE ");
// Ишем того кто написал нам смс
	$row = $mysqli->query("SELECT * FROM `messages` WHERE `to` = $user_id");
	$row = getAllFromDb($row);
	$allFromId = array();
	for($i = 0; $i < count($row); $i++){
		$allFromId[] = $row[$i]["from"];
		
	}
?>

<style>
	img{
		margin-left: -15px;
		margin-top: -12px;
	}
</style>
<div id = "mainForum">
	<div id = "headerForum"><p>Диалоги</p></div>
		<div id = "bodyForum">
		<div id = "searchUsers">
					<?
					// Мы взяли все Id тех кто нам написал и удаляем дубликаты
						$allFromId = array_unique($allFromId);
						// print_r($allFromId);
						$i = 0;
						foreach($allFromId as $fromId){
							$row = $mysqli->query("SELECT `id`,`name`, `surname`, `avatar` FROM `users` WHERE `id` = '".$fromId."'");
							$row = $row->fetch_assoc();
							// echo "<br>" .$row["name"]  . "<br>";
						
							// print_r($row);
							$avatar = $row["avatar"];
							if($avatar == 0) $avatar = 0 . ".png";
							echo'<div id = "allusers">
							<div id = "imgAndName">
								<div id = "imgAllusers">
									<img src="../img/avatars/'.$avatar.'" height="auto" width="110" alt="" id = "img" class = "showImg">
								</div>
								<div id = "nameAllusers">
									<p><a id = "'.$row["id"].'" class = "showUser">'.$row["name"] . " " .$row["surname"] .'</a></p>
								</div>
							</div>
							<div id = "actions">
								<a id = "'.$row["id"].'" class = "writeMassageToUser '.$row["id"].'">Написать сообщение</a>
							</div>
						</div> <hr>';
							$i++;
						}
						$mysqli->close();
					?> 
	</div></div>
</div>
 <?echo foot();?>

