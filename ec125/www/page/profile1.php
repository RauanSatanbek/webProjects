<?
	session_start();
	include("db.php");
	include("functions.php");
	isLogin();
	profile1();
	$user_id = $_SESSION["user_id"];
	$nameAvatar = $mysqli->query("SELECT * FROM `users` WHERE `id` = '".$user_id."'")->fetch_assoc();
	$name = $nameAvatar["name"];
	$avatar = $nameAvatar["avatar"];
	$_SESSION["error"] = "";
	if(isset($_POST["sendAvatar"])) {
		$avatar = $_FILES['avatar'];
		$tmp = $avatar['tmp_name'];
		$type = substr($avatar['type'],6);
		$size = $avatar['size'];
		$files = glob("../img/avatars/*", GLOB_ONLYDIR);
		$Num = 0;
		if($type != "jpeg" && $type != "jpg" && $type != "png"){
			$_SESSION["error"] = "Неверный формат изображения.";
		} else if ($size > 2 * 1024 * 1024){
			$_SESSION["error"] = "Размер изображения слишком большой.";
		} 
		else{
			foreach($files as $num => $dir){
				$count = sizeof(glob($dir.'/*.*'));
				if($count < 250) $download = $dir;
				$img = "/".$_SESSION["id"].".".$type;
				$result = $mysqli->query("SELECT `avatar` FROM `users`  WHERE `id` = '".$_SESSION['id']."'")->fetch_assoc();
				if($result['avatar'] != "0.png") unlink("../img/avatars/".$result['avatar'] );
				move_uploaded_file($tmp, $download.$img);
				$Num++;
				break;
			}
			$mysqli->query("UPDATE `users` SET `avatar` = '".$Num . $img."' WHERE `id` = '".$_SESSION['id']."'");
			$avatar = $Num . $img;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Жеке кабинет</title>
	<script type="text/javascript" src="../js/loader.js"></script>
	<link rel="shortcut icon" href="../img/125.jpg" type="image/jpg">
	<script src = "../js/jquery-1.12.1.min.js"></script>
	<script src="../Bootstrap3/js/bootstrap.js"></script>
	<link href="../Bootstrap3/css/bootstrap.css" rel="stylesheet">
	<script src = "../js/profile.js"></script>
    <link href="../css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/register.css">
	<link rel="stylesheet" href="../css/dialog.css">
	<script src = "../js/groupChat.js"></script>
    <link rel="stylesheet" href="../font-awesome-4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/profile.css">
</head>
<?
?>
<body>
	<script>
		$(document).ready(function(){
			var height = (310 - $(".minLeft img").get(0).height)/2;
			$(".minLeft img").css("marginTop", height + "px");
		});
	</script>
<div class = "errors">
	<div class = "right1">
		<p id = "exit">&#215;</p>
	</div>
	<div class = "left1">
		<span class = "span1"></span>
	</div>
</div>
<div class="containerMainNav">
	<div class="container">
		<div class="rows">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-mine-nav">
				<img src="../img/125.jpg" height="auto" width="100" alt="" id = "logo">
				<p class="user-name"><?=$_SESSION["name"]?></p>
				<div class = "register1">
			<a href = "index.php" class = "a" id = "login">Бастысы</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="contaner">
	<div class = "middle">
		<div class = "blockRight">
			<p class = "p workWithCurator ProFileP" id = "<?=$user_id?>"><i class="fa fa-user" aria-hidden="true"></i> Профайл</p>
			<?
				$group = $mysqli->query("SELECT `group` FROM `users` WHERE `id` = '".$user_id."'")->fetch_assoc();
				echo '<p class = "p workWithCurator toPageP getAll" id = "'.$group["group"].'"><i class="fa fa-book" aria-hidden="true"></i> Куратормен жұмыс</p>';
				$group = $mysqli->query("SELECT `who`, `group` FROM `users` WHERE `id` = '".$user_id."'")->fetch_assoc();
				if($group["who"] == 1 || $group["who"] == 2) {
					echo '<p class = "p Open2 workWithCurator"><i class="fa fa-braille" aria-hidden="true"></i> Тест нәтежиелері <span class = "open" id = "1">&#9658</span></p>
					<div class="Hide Hide2">
						<table class="t2">
						<tr class="tr2">
							<th class="th2 th2f nB">№</th>
							<th class="th2 subjectB">100</th>
							<th class="th2 subjectB">125</th>
							<th class="th2 tTopic">Тақырыбы</th>
							<th class="th2 tDate">Күні</th>
						</tr>';
						$result = $mysqli->query("SELECT `results` FROM `users` WHERE `id` = '".$user_id."'");
						while(($row = $result->fetch_assoc()) != false){	
							$td = "";
							$n = split(":",$row["results"]);
							for($i = 0; $i < count($n); $i++){
							 	$m = split(";", $n[$i]);
							 	if($i+1 == count($n)) $td = "td2l";
									$date = $m[0];
									$topic = $m[1];
									$bal = split(" ", $m[2]);
									echo '<tr class="tr2">
											<td class="td2 td2f '.$td.'">
												'.($i + 1).'
											</td>
											<td class="td2 '.$td.'">
												<p class = "pB" >'.$bal[0].'</p>
											</td>
											<td class="td2 '.$td.'">
												<p class = "pB" >'.$bal[1].'</p>
											</td>
											<td class="td2 '.$td.' tdSubject">
												<p class = "pB" >'.$topic .'</p>
											</td>
											<td class="td2 '.$td.' tdSubject">
												<p class = "pB" >'.$date.'</p>
											</td>
										</tr>';
							}
						}
						echo '</table></div>';
					}
				?>
			<p class = "p workWithCurator ProFilePayP" id = "<?=$user_id?>"><i class="fa fa-money" aria-hidden="true"></i> Оплата</p>
			<p class = "p workWithCurator loadTestsP"><i class="fa fa-download" aria-hidden="true"></i> Тесттер</p>
			<p class = "p workWithCurator changePasswordP"><i class="fa fa-exchange" aria-hidden="true"></i> Пороль өзгерту</p>
		</div>
		<div class = "blockLeft blockLeft2 proFileDiv">


				

		<div class = "minLeft profileBlocks">
			<img src="../img/avatars/<?=$avatar?>" height="320" width="250" alt="" >
		</div>
		<div class = "minRight profileBlocks">
			<p class = "p NAME USERNAME"><?=$name?></p>
			<table class="t2 t22 MainInfoAboutUser">
				<?
					$m = array("ID -i","Номері:", "Мектебі:","Таңдау пәні:", "Группасы:","Кураторы:");
					$result = $mysqli->query("SELECT * FROM `users` WHERE `id` = '".$user_id."'")->fetch_assoc();
					$userId = $result["userId"];
					$tel = $result["tel"];
					$schoolId = $result["school"];
					$subject = $result["subject"];
					$group = $result["group"];
					$s = $mysqli->query("SELECT * FROM `subjects` WHERE `id` = '".$subject."'")->fetch_assoc();
					$g = $mysqli->query("SELECT * FROM `groups` WHERE `id` = '".$group."'")->fetch_assoc();
					$c = $mysqli->query("SELECT * FROM `curator` WHERE `id` = '".$g["curatorId"]."'")->fetch_assoc();
					$school  = $mysqli->query("SELECT * FROM `schools` WHERE `id` = '".$schoolId."'")->fetch_assoc();
					$n = array($userId,$tel,$school["name"],$s["name"], $g["name"], $c["name"]);

					for($i = 0; $i < count($m); $i++){ 
						echo '<tr class="tr2">
								<td class="td2 td22 td2l td2r  tt2">
									<p class = "p2">'.$m[$i].'</p>
								</td>
								<td class="td2 td22 td2l tt2">
									<p class = "p2">'.$n[$i].'</p>
								</td>
							</tr>';
					}
				?>
			</table>
			<div class = "moreInfo">
				<table class="t2 t22 ExtraInfoAboutUser">
					<?
						$m = array("Әкесінің аты:","Әкесінің номері:","Анасының аты:","Анасының номері:", "Мекен-жайы:","Тіркелген күні:");
						$nameF = $result["nameF"];
						$tel2 = $result["tel2"];
						$nameM = $result["nameM"];
						$tel3 = $result["tel3"];
						$address = $result["address"];
						$date = $result["date"];
						$r = $mysqli->query("SELECT * FROM `subjects` WHERE `id` = '".$subject."'")->fetch_assoc();
						$n = array($nameF, $tel2, $nameM, $tel3, $address, $date);

						for($i = 0; $i < count($m); $i++){ 
							echo '<tr class="tr2">
								<td class="td2 td22 td2l td2r  tt2">
									<p class = "p2">'.$m[$i].'</p>
								</td>
								<td class="td2 td22 td2l tt2">
									<p class = "p2">'.$n[$i].'</p>
								</td>
							</tr>';
						}
					?>
				</table>
			</div>
			<p class = "More OpenEditAndMore">Толық мәлімет<span class = "open s1" id = "1">&#9658</span></p>
			<div class = "chart_div" id = "chart_div_profile1"></div>
		</div>
		</div>
		<div class = "blockLeft">
		<div class="Hide Close changePasswordDiv">
			<form class="form-inline">
				<input type="password" class = "form-control form-changePass" placeholder = "Старый пароль" id = "oldPass">  <span class="text-danger info info1">Lorem ipsum dolor sit.</span> <br><br>
				<input type="password" class = "form-control form-changePass" placeholder = "Новый пароль" id = "newPass"><br><br>
				<input type="password" class = "form-control form-changePass" placeholder = "Повторите пароль" id = "repeatPass">  <span class="text-danger info info2"></span><br><br>
				<button type="button" class = "btn btn-primary form-changePass" id = "changePassword">Изменить</button>
			</form>
		</div>
		<!-- тесттер тізімі -->
		<div class="Hide Close loadTestsDiv">
			<table class="t2">
			<?php
				$result = $mysqli->query("SELECT * FROM `tests` WHERE `active` = '1'" );
				$v = $result->num_rows;
				$td = "";
				if($v != faslse){
					echo '<tr class="tr2">
					<th class="th2 td2f">№</th>
					<th class="th2">тесттер тізімі</th>
					<th class="th2"></th>
				</tr>';
					while(($row = $result->fetch_assoc()) != false){
						$files = glob("files/tests/".$row["id"]."/*", GLOB_ONLYDIR);
						$s = '';
						$len = count($files);
						$c = "";
						$i = 0;
						foreach($files as $num => $dir){
							if($i + 1 == $len) $td = " td2l";
							$m = explode("/", $dir);
							$file = $m[1] . "/" . $m[2] . "/" .$m[3] . ".zip" ;
							// echo $file . "<br>";
							echo '<tr class="tr2">
								<td class="td2 td2f'.$td.'">'.($i + 1).'</td>
								<td class="td2'.$td.'"><p class = "testsP">'.$m[3].'</p></td>
								<td class="td2'.$td.'"><a href="files/download.php?file='.$file.'" class = "loadTest">Скачать</a></td>
							</tr>';
							$i++;
						}
					}
				} else {
					echo '<p class = "noTestsP">Тесты недоступны</p>';
				}
			?>
			</table>
		</div>
		<div class = "Why hide1 ProFilePayDiv">
			<table class="t2 tOb tWhy"></table>
		</div>
			<div class = "Hide workWithCuratorDiv BagaClose">
				<p class = "p NameGroup"></p>
				<div class = "fromCurator">
					<p class = "p CURATOR" id = "topicW"></p>
					<div class = "messageFromCurator">
						<article id = "messageW"></article>
					</div>
					<table class="t2 Table"></table>
				</div>
				<div class = "dialog">
					<div class = "headD"></div>
					<div class = "bodyD"></div>
					<div id = "bodyDTest"></div>
					<div class = "footD">
						<textarea name="" id="message" class = "textarea1 message"></textarea>
						<input type = "button" id="0" class = "sendMessage" value = "Отправить">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>