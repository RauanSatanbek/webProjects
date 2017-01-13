<?
	session_start();
	// таңдалған user дің id ін алып message.php жібереміз //
	if($_POST["userToId"]){
		$_SESSION["userToId"] = $_POST["userToId"];
		exit ();
	}
	// Session for other users
	if($_POST["userId"]){
		$_SESSION["userId"] = $_POST["userId"];
		exit();
	}
////////////////////////////////////////////////////////////
	echo head("Все пользователи");
	echo allInfo();
?>
<?


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
	// to message 
		$(document).ready(function(){
		$("#search").on("keyup", function(){
			var text = $(this).val();
			$.ajax({
				url:"../page/search.php",
				type:'post',
				data:({text:text}),
				dataType:"json",
				success:function(data){

					$("#searchUsers").html("");
					for(var i in data){
						// console.log(data[i]);
						var name  = data[i]["name"];
						var surname  = data[i]["surname"];
						var id  = data[i]["id"];
						var avatar = data[i]["avatar"];
						if(avatar == "0") avatar = avatar + ".png";
						$("#searchUsers").prepend('<div id = "allusers"><div id = "imgAndName"><div id = "imgAllusers"><img src="../img/avatars/'+avatar+'" height="auto" width="110" alt="" id = "img" class = "showImg"></div><div id = "nameAllusers"><p><a id = "'+id+'" class = "showUser">'+name + " " +surname+'</a></p></div></div><div id = "actions"><a id = "'+id+'" class = "writeMassageToUser '+id+'">Написать сообщение</a></div></div> <hr>');
						
					}
				}

			});
		});

		
	});
</script>

<style>
	img{
		margin-left: -15px;
		margin-top: -12px;
	}
</style>
<input type="search" id = "search" placeholder = "искать">
<div id = "searchUsers">
<?
	
	$mysqli = new mysqli("localhost", "root", "", "project");
	$mysqli->query("SET NAMES 'utf8'");
	$row = $mysqli->query("SELECT * FROM `users` ORDER BY `name` ASC");
	$row = getAllFromDb($row);
	$mysqli->close();
	for($i = 0; $i < count($row); $i++){
			$avatar = $row[$i]["avatar"];
			if($avatar == 0) $avatar = 0 . ".png";
		echo'<div id = "allusers">
				<div id = "imgAndName">
					<div id = "imgAllusers">
						<img src="../img/avatars/'.$avatar.'" height="auto" width="110" alt="" id = "img" class = "showImg">
					</div>
					<div id = "nameAllusers">
						<p><a id = "'.$row[$i]["id"].'" class = "showUser">'.$row[$i]["name"] . " " .$row[$i]["surname"] .'</a></p>
					</div>
				</div>
				<div id = "actions">
					<a id = "'.$row[$i]["id"].'" class = "writeMassageToUser '.$row[$i]["id"].'">Написать сообщение</a>
				</div>
			</div> <hr>';
	}
?>
</div>
 <?echo foot();?>

