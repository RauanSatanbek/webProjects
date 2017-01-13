<?
	session_start();
	include("db.php");
	$result = $mysqli->query("SELECT `who`,`curator` FROM `users` WHERE `id` = '".$_SESSION['user_id']."'")->fetch_assoc();
	$_SESSION['id'] = $result["curator"];

	// for profile set photo

		$user_id = $_SESSION["id"];
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
					$img = "/".$_SESSION["name_avatar"].".".$type;
					$result = $mysqli->query("SELECT `avatar` FROM `users`  WHERE `id` = '".$_SESSION["name_avatar"]."'")->fetch_assoc();
					if($result['avatar'] != "0.png") unlink("../img/avatars/".$result['avatar'] );
					move_uploaded_file($tmp, $download.$img);
					$Num++;
					break;
				}
				$mysqli->query("UPDATE `users` SET `avatar` = '".$Num . $img."' WHERE `id` = '".$_SESSION["name_avatar"]."'");
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
	<script src = "../js/profile.js"></script>
    <link href="../css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="../css/profile.css">
	<link rel="stylesheet" href="../css/dialog.css">
	<script src = "../js/groupChat.js"></script>
    <link rel="stylesheet" href="../font-awesome-4.6.3/css/font-awesome.min.css">
	<script src="../Bootstrap3/js/bootstrap.js"></script>
	<link href="../Bootstrap3/css/bootstrap.css" rel="stylesheet">
    <?
		include("functions.php");
		isLogin();
		profile2();
	?>
</head>

<body>
<div class = "errors">
	<div class = "right1">
		<p id = "exit">&#215;</p>
	</div>
	<div class = "left1">
		<span class = "span1"></span>
	</div>
</div>
<!--  -->
<div class="containerMainNav">
	<div class="container">
		<div class="rows">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-mine-nav">
				<img src="../img/125.jpg" height="auto" width="100" alt="" id = "logo">
				<p class="user-name"><?=$_SESSION["name"]?></p>
				<div class = "register1">
				<a href = "main1.php" class = "a" id = "login">Бастысы</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="contaner">
	<div class = "middle">
		<div class = "blockRight">
			<p class = "p Open2 workWithCurator"><i class="fa fa-users" aria-hidden="true"></i> Топтар <span class = "open" id = "1">&#9658</span></p>
			<div class = "Hide">
			<?
				$result =  $mysqli->query("SELECT * FROM `groups` WHERE `curatorId` = '".$_SESSION['id']."'");
				while(($row = $result->fetch_assoc()) != false){
					$r = $mysqli->query("SELECT `id`, `name`, `userId` FROM `users` WHERE `group` = '".$row['id']."' AND `status` = '0' AND `who` = '1'  ORDER BY `name` ASC");
					$num = $r->num_rows;
					echo '<p class = "p p1 groupsG" id = "'.$row['id'].'">'.$row['name'] . " тобы  - ".$num.' оқушы <span class = "open" id = "1">&#9658</span></p>';
					// if($num != 0){
						echo '<div class = "pupils">
								<table>
									<tr>
										<th class = "Number td">№</th>
										<th class = "Name td">Аты-жөні</th>
										<th class = "Id td">ID</th>
									</tr>';
						$i = 1;
						while(($row2 = $r->fetch_assoc()) != false){
							echo '<tr>
									<td class = "Number">'.$i.'</td>
									<td class = "Name"><a class = "userName" id = "id'.$row2['id'].'">'.$row2['name'].'</a></td>
									<td class = "Id">'.$row2['userId'].'</td>
								</tr>';
							$i++;
						}
						echo '</table>
							</div>';
					// }
				}
			?>
			</div>
			<p class = "p Open2 workWithCurator"><i class="fa fa-pencil" aria-hidden="true"></i> Оқушыларға баға қою <span class = "open" id = "1">&#9658</span></p>
			<div class = "Hide">
				<?
					$result =  $mysqli->query("SELECT * FROM `groups` WHERE `curatorId` = '".$_SESSION['id']."'");
					while(($row = $result->fetch_assoc()) != false){
						$r = $mysqli->query("SELECT `id`, `name`, `userId` FROM `users` WHERE `group` = '".$row['id']."' AND `status` = '0' AND `who` = '1'");
						$num = $r->num_rows;
						echo '<p class = "p NAME groupBaga" id = "'.$row['id'].'">'.$row['name'] .' тобы</p>';
						
					}
				?>
			</div>
			<p class = "p workWithCurator Open2"><i class="fa fa-eye" aria-hidden="true"></i> Жалпы бағалар <span class = "open" id = "1">&#9658</span></p>
			<div class = "Hide">
				<?
					$result =  $mysqli->query("SELECT * FROM `groups` WHERE `curatorId` = '".$_SESSION['id']."'");
					while(($row = $result->fetch_assoc()) != false){
						$r = $mysqli->query("SELECT `id`, `name`, `userId` FROM `users` WHERE `group` = '".$row['id']."' AND `status` = '0' AND `who` = '1'");
						$num = $r->num_rows;
						echo '<p class = "p NAME groupZhalpyBaga" id = "'.$row['id'].'">'.$row['name'] . ' тобы</p>';
						
					}
				?>
			</div>
			<p class = "p workWithCurator Open2"><i class="fa fa-book" aria-hidden="true"></i> Оқушылармен жұмыс <span class = "open" id = "1">&#9658</span></p>
				<div class = "Hide">
					<?
						$groups = $mysqli->query("SELECT * FROM `groups` WHERE `curatorId` = '".$_SESSION['id']."'");
						while(($group = $groups->fetch_assoc()) != false){
							echo '<p class = "p toPageP getAll NAME" id = "'.$group["id"].'">'.$group["name"].' тобы</p>';
						}
					?>
				</div>
			<p class = "p Open2 workWithCurator"><i class="fa fa-wrench" aria-hidden="true"></i> Настройки <span class = "open" id = "1">&#9658</span></p>
			<div class = "Hide">
				<p class = "p Open CURATOR">Топқа мұғалім тағайындау <span class = "open" id = "1">&#9658</span></p>
				<p class = "p CURATOR edit-user-info-p">Редактировать</p>
				<div class="Hide">
				<?
					$result =  $mysqli->query("SELECT * FROM `groups` WHERE `curatorId` = '".$_SESSION['user_id']."'");
					while(($row = $result->fetch_assoc()) != false){
						$r = $mysqli->query("SELECT `id`, `name`, `userId` FROM `users` WHERE `group` = '".$row['id']."' AND `status` = '0' AND `who` = '1'  ORDER BY `name` ASC");
						$num = $r->num_rows;
						echo '<p class = "p setTeacher" id = "'.$row['id'].'">'.$row['name'] . " тобы".'</p>';
					}
				?>
				</div>
			</div>
			<p class = "p workWithCurator changePasswordP"><i class="fa fa-exchange" aria-hidden="true"></i> Пороль өзгерту</p>
		</div>
		<div class = "blockLeft blockLeft2">
			<div class = "minLeft">
				<img src="" height="320" width="250" alt="" id = "UserAvatar">
			</div>
			<div class = "minRight">
				<p class = "p USERNAME"></p>
				<table class="t2 t22 MainInfoAboutUser">
				</table>
				<div class = "moreInfo">
					<table class="t2 t22 ExtraInfoAboutUser">
					</table>
				</div>
				<p class = "More OpenEditAndMore">Толық мәлімет<span class = "open s1" id = "1">&#9658</span></p>

				<!-- <div class = "moreInfo men"> -->
					<!-- <table class="t2 t22 EditInfoUser">
					</table> -->
					<form action = "" method = "post" enctype =  'multipart/form-data'>
						<label for="loadAvatar" id = "labelLoad">Сурет қою.</label>
						<input type="file" id = "loadAvatar" name = "avatar">
						<input type="submit" name = "sendAvatar" class = "button buttonLoadAvatar" value = "Сақтау.">
						<span class = "error"><?=$_SESSION["error"]?></span>
					</form>
				<!-- </div> -->
					<!-- <p class = "EDIT OpenEditAndMore">Редактировать<span class = "open s1" id = "1">&#9658</span></p> -->
	   			<div class = "chart_div chart_div2" id="chart_div"></div>
			</div>
			
		</div>
	    <style>
			.Close{
				overflow: hidden;
			}
			#saveSubjectsTeacher{
				margin-bottom: 5px;
			}
	    </style>
		<div class = "blockLeft blockLeft3">
		<div class="Hide Close edit-user-info-div">
			<p class="p">Оқушының мәліметтерін өзгерту</p>
			<p id="edit-user-get-id" style = "display:none;"></p>
			<form class="form-horizontal">
				<div class="form-group">
					<div class="col-sm-12">
						<input type="search" id = "edit-search" class = "form-control" placeholder = "Поиск*">
					</div>
				</div>
				<div class="form-group">
					<label for="edit-name" class="col-sm-3 control-label">Аты-жөні:</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="edit-name" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label for="edit-tel" class="col-sm-3 control-label">Номері:</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="edit-tel" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label for="edit-school" class="col-sm-3 control-label">Мектебі:</label>
					<div class="col-sm-5">
						<select name="" class = "form-control"  id="edit-option-schools">
							<!-- <option id = "edit-option-school">Мектебі</option> -->
							<?
								$result = $mysqli->query("SELECT * FROM `audan`");
								while(($row = $result->fetch_assoc()) != false){
									$audanId = $row["id"];
									echo '<optgroup label="'.trim($row["name"]).'">';
									$result2 = $mysqli->query("SELECT * FROM `schools` WHERE `audan` = '".$audanId."'");
									while(($row2 = $result2->fetch_assoc()) != false){
										echo '<option value="'.$row2["id"].'" class = "edit-school" id = "edit-school-'.$row2["id"].'">'.trim($row2["name"]).'</option>';
									}
									echo '</optgroup>';
								}
							?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="edit-school" class="col-sm-3 control-label">Таңдау пәні:</label>
					<div class="col-sm-5">
						<select name="" class = "form-control" id="edit-subjects">
							<?
								$result = $mysqli->query("SELECT * FROM `subjects`");
								while(($row = $result->fetch_assoc()) != false){
									echo '<option value="'.$row["id"].'" class = "edit-subject" id = "edit-subject-'.$row["id"].'">'.$row["name"].'</option>';
								}
							?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="edit-school" class="col-sm-3 control-label">Группасы:</label>
					<div class="col-sm-5">
						<select name="" class = "form-control" id="edit-groups">
							<?
								$result = $mysqli->query("SELECT * FROM `groups`");
								while(($row = $result->fetch_assoc()) != false){
									echo '<option value="'.$row["id"].'" id = "edit-group-'.$row["id"].'">'.$row["name"].'</option>';
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="edit-nameF" class="col-sm-3 control-label">Әкесінің аты:</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="edit-nameF" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label for="edit-tel2" class="col-sm-3 control-label">Әкесінің номері:</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="edit-tel2" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label for="edit-nameM" class="col-sm-3 control-label">Анасының аты:</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="edit-nameM" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label for="edit-tel3" class="col-sm-3 control-label">Анасының номері:</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="edit-tel3" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label for="edit-address" class="col-sm-3 control-label">Мекен-жайы:</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="edit-address" placeholder="">
					</div>
				</div> 
				<div class="form-group">
					<label for="edit-address" class="col-sm-3 control-label">Договор:</label>
					<div class="col-sm-5 edit-radio">
						<div class="radio">
							<label>
					    		<input type="radio" name="edit-contract" value="1" class = "edit-contract" id = "edit-contract-1"> Ия
							</label>
						</div>
						<div class="radio">
							<label>
					   			 <input type="radio" name="edit-contract" value="0" class = "edit-contract" id = "edit-contract-0"> Жоқ
							</label>
						</div>
					</div>
				</div> 
				<div class="form-group">
					<label for="edit-address" class="col-sm-3 control-label"></label>
					<div class="col-sm-5">
						<input type="button" class="form-control btn btn-success" id="edit-save" value="Сохранить">
					</div>
				</div> 
			</form>
			</div>
		<div class="Hide Close changePasswordDiv">
			<form class="form-inline">
				<input type="password" class = "form-control form-changePass" placeholder = "Старый пароль" id = "oldPass">  <span class="text-danger info info1">Lorem ipsum dolor sit.</span> <br><br>
				<input type="password" class = "form-control form-changePass" placeholder = "Новый пароль" id = "newPass"><br><br>
				<input type="password" class = "form-control form-changePass" placeholder = "Повторите пароль" id = "repeatPass">  <span class="text-danger info info2"></span><br><br>
				<button type="button" class = "btn btn-primary form-changePass" id = "changePassword">Изменить</button>
			</form>
		</div>
			<div class = "Hide Close" id = "groupsG">
				<p class = "p" id = "groupsGText"></p>
				<div class = "groupMinDivLeft">
					<div class = "chart_div" id="chart_div2"></div>
				</div>
				<?
					
				?>
				<div class = "groupMinDivRight">
						<table class="t2 t22 groupsGTable">
							
						</table>
				</div>
			</div>
			<div class = "Hide setTeacherDiv">
				<p class="p NameUpdate"></p>
				<form class = "Form">
					<select name="" id="SubjectGroupTeacher" class = "select">
						<option value="1">Қазақ тілі</option>
						<option value="2">Математика</option>
						<option value="3">Қазақстан т.</option>
						<option value="4">Орыс тілі</option>
					</select>
					<select name="" id="groupTeacher" class = "select">
						<?
							$result = $mysqli->query("SELECT * FROM `teacher` WHERE `type` = '1' ORDER BY `subject` ASC");
							$num = $result->num_rows;
							while(($row = $result->fetch_assoc()) != false){
								echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
							}
						?>
					</select>
					<input type="button" value = "Сохранить" class ="button buttonSave Click"  id = "saveSubjectsTeacher">
				</form>
			</div>
			<?
				// Оқушыларға баға қою
				$groups = $mysqli->query("SELECT * FROM `groups` WHERE `curatorId` = '".$_SESSION['id']."'");
				while(($group = $groups->fetch_assoc()) != false){
					$result = $mysqli->query("SELECT * FROM `users` WHERE `type` = '1' AND `group` = '".$group["id"]."' AND `status` = '0' ORDER BY `name` ASC");
					$num = $result->num_rows;
					$td = "";
					$i = 1;
					$id = $group["id"];
					echo '<div class = "Hide Close" id = "groupBaga'.$id.'"><p class = "p">Оқушыларға баға қою <i class="fa fa-long-arrow-right" aria-hidden="true"></i> '.$group["name"].' тобы</p>
					<input type="text" class = "topic clear" placeholder = "Тақырыбы" id = "topic'.$id.'">
					<textarea name="" class="messageToPupil clear" placeholder = "Сообщение" id = "messageToPupil'.$id.'"></textarea>
						<table class="t2 tBK" id = "tId'.$id.'">
						<tr class="tr2">
							<th class="th2 th2f nB">№</th>
							<th class="th2 nameB nameB2" >Аты-жөні</th>
							<th class="th2 subject5">Таңдау пәні</th>
							<th class="th2 subjectB">қ.т</th>
							<th class="th2 subjectB">м</th>
							<th class="th2 subjectB">т</th>
							<th class="th2 subjectB">о.т</th>
							<th class="th2 subjectB">5</th>
							<th class="th2 subjectB">100</th>
							<th class="th2 subjectB">125</th>
						</tr>';
					while(($row = $result->fetch_assoc()) != false){
						if($i == $num) $td = "td2l";
						$subjectName = $mysqli->query("SELECT `name` FROM `subjects` WHERE `id` = '".$row['subject']."'")->fetch_assoc();
						echo '<tr class="tr2 " id = "'.$row['id'].'">
								<td class="td2 td2f '.$td.'">'.$i.'</td>
								<td class="td2 '.$td.' tdName namePupil">
									<p class = "NameTeacher"  id = "'.$row['id'].'">'.$row['name'].'</p>
								</td>
								<td class="td2 '.$td.'">
									<p id = "'.$row['id'].'">'.$subjectName["name"].'</p>
								</td>

								<td class="td2 '.$td.' tB">
									<p class = "pB '.$row["id"].'" id = "'.'klP'.$row["id"].'"></p>
									<input type="text" class="writeB write clear" id = "klI'.$row['id'].'">
								</td>
								<td class="td2 '.$td.' tB">
									<p class = "pB '.$row["id"].'" id = "'.'mP'.$row["id"].'"></p>
									<input type="text" class="writeB write clear" id = "mI'.$row['id'].'">
								</td>
								<td class="td2 '.$td.' tB">
									<p class = "pB '.$row["id"].'" id = "'.'hP'.$row["id"].'"></p>
									<input type="text" class="writeB write clear" id = "hI'.$row['id'].'">
								</td>
								<td class="td2 '.$td.' tB">
									<p class = "pB '.$row["id"].'" id = "'.'rlP'.$row["id"].'"></p>
									<input type="text" class="writeB write clear" id = "rlI'.$row['id'].'">
								</td>
								<td class="td2 '.$td.' tB">
									<p class = "pB '.$row["id"].'" id = "'.'s5P'.$row["id"].'"></p>
									<input type="text" class="writeB write clear" id = "s5I'.$row['id'].'">
								</td>
								<td class="td2 '.$td.'">
									<p class = "pB clearP" id = "'.'total100'.$row["id"].'">0</p>
								</td>
								<td class="td2 '.$td.'">
									<p class = "pB clearP" id = "'.'total125'.$row["id"].'">0</p>
								</td>
							</tr>';
						$i++;
					}
					echo '</table><form class = "form-inline"><input type="button" class = "btn btn-primary buttonSave2" value = "Сохранить" id = "'.$id.'"></form></div>';
					$id++;
				}
			?>

			<?
				// Жалпы бағалар
				$groups = $mysqli->query("SELECT * FROM `groups` WHERE `curatorId` = '".$_SESSION['id']."'");
				$tableId = 1;
				while(($group = $groups->fetch_assoc()) != false){
					$result1 = $mysqli->query("SELECT `results`, `name` FROM `users` WHERE `type` = '1' AND `group` = '".$group["id"]."'  AND `status` = '0'  AND `results` != '' ORDER BY `name` ASC");
					$result2 = $mysqli->query("SELECT `results`, `name` FROM `users` WHERE `type` = '1' AND `group` = '".$group["id"]."'  AND `status` = '0' ORDER BY `name` ASC");
					$result3 = $mysqli->query("SELECT `results`, `name` FROM `users` WHERE `type` = '1' AND `group` = '".$group["id"]."'  AND `status` = '0' ORDER BY `name` ASC")->fetch_assoc();
					if($result3["results"] != 12){
						$num = $result2->num_rows;
						$td = "";
						$i = 1;
						$id = $group["id"];
						$row1 =  $result1->fetch_assoc();
						$bals = split(":", $row1["results"]);
						// echo '<div class="Hide close" id = "groupZhalpyBaga'.$id.'">';
						while(($row2 = $result1->fetch_assoc()) != false){
							$bals2 = split(":", $row2["results"]);
							if(count($bals2) > count($bals)) $bals = $bals2;

						}
						$number = count($bals);
						// print_r($bals);
						// echo $number;
						// echo '</div>';
						echo '<div class="Hide Close" id = "groupZhalpyBaga'.$id.'"><p class = "p">Жалпы бағалар <i class="fa fa-long-arrow-right" aria-hidden="true"></i> '.$group["name"].' тобы</p>
							<div class = "hide1">
							<table class="t2 tOb '.count($bals).'" id = "table'.$tableId.'">
							<tr class="tr2">
								<th class="th2 th2f nB">№</th>
								<th class="th2 nameB2" >Аты-жөні</th>';

								for($j = 0; $j < count($bals); $j++){
									$bal = split(";", $bals[$j]);
									$date = $bal[0];
									echo '<th class="th2 thBal">'.$date.'</th>';
								}
							echo '</tr>';
						while(($row = $result2->fetch_assoc()) != false){
							if($i == $num) $td = "td2l";
							$bals = split(":", $row["results"]);
							$number2 = count($bals);
							echo '<tr class="tr2 " id = "'.$row['id'].'">
									<td class="td2 td2f '.$td.'">'.$i.'</td>
									<td class="td2 '.$td.' tdName">
										<p class = "NameTeacher"  id = "'.$row['id'].'">'.$row['name'].'</p>
									</td>';
									$totals = array("","");
									$allNum = $number - $number2;
									for($j = 0; $j < $number; $j++){
										if($j >= $allNum){
											$bal = split(";", $bals[$j -$allNum	 ]);
											$date = $bal[0];
											$totals = split(" ", $bal[2]);
										}
										echo '<td class="td2 '.$td.' tdBal">
												<p class = "pB totalsP">'.$totals[0].' / '.$totals[1].'</p>
											</td>';
									}
								echo '</tr>';
							$i++;
						}
						echo '</table></div></div>';
						$id++;
					}
					$tableId++;
				}
		?>
			<!-- Оқушылармен жұмыс -->
			<div class = "Hide workWithCuratorDiv BagaClose">
				<p class = "p NameGroup"></p>
				<div class = "fromCurator">
					<p class = "p CURATOR" id = "topicW"></p>
					<div class = "messageFromCurator">
						<article id = "messageW"></article>
					</div>
					<table class="t2 Table">
					
					</table>
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