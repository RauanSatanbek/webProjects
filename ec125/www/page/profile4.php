<?
	session_start();
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Жеке кабинет</title>
	<script src = "../js/jquery-1.12.1.min.js"></script>
	<script src="../Bootstrap3/js/bootstrap.js"></script>
	<link href="../Bootstrap3/css/bootstrap.css" rel="stylesheet">
	<script type="text/javascript" src="../js/loader.js"></script>
	<link rel="shortcut icon" href="../img/125.jpg" type="image/jpg">
	<script src = "../js/profile.js"></script>
    <link href="../css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="../font-awesome-4.6.3/css/font-awesome.min.css">
    <script src="../js/log.js"></script>
    <link rel="stylesheet" href="../css/profile.css">
</head>
<?
	include("functions.php");
	include("db.php");
	isLogin();
	profile4();
?>
<body>
<div class = "errors">
	<div class = "right1">
		<span id = "exit">&#215;</span>
	</div>
	<div class = "left1">
		<span class = "span1"></span>
	</div>
</div>
<style>
	.tShowAlluserOfGroup{
		width: 250px;
		margin-right: 0;
	}
	.tShowAlluserOfGroup tr td{
		border:1px solid #000;
	}
	.divShowAlluserOfGroup{
		/*display: block;*/
		margin-left:550px;
		overflow: hidden;
		min-height: 200px;
		width: 275px;
		background: #333;
		/*box-shadow: 0 0 20px rgba(0,0,0,.9);*/
	}
	#closeShowAlluserOfGroup{float: right;color:#f0f0f0;z-index: -456;margin-top: 2px;margin-right: 5px;position: absolute;right: 0px;z-index: 1245;}
	#closeShowAlluserOfGroup:hover{cursor: pointer;color:#999;}
	.MoreInfoShowAlluserOfGroup{background: none;float: left;width: 260px;}
	.td2Color{background: #fff;}
	.showUserName{color:#000;float: left;margin-left: 5px;}
</style>
<div class = "MoreInfoMain Opens divShowAlluserOfGroup">
	<div class = "MoreInfo MoreInfoShowAlluserOfGroup">
		<table class="t2 tShowAlluserOfGroup">
		</table>
	</div>
	<p id = "closeShowAlluserOfGroup"><i class="fa fa-times" aria-hidden="true"></i></p>
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
	<div class = "middle middle2">
		<div class = "blockRight getInfoAllGroupR">
				<p class = "p Open2 workWithCurator closeBack"><i class="fa fa-users" aria-hidden="true"></i> Топтар <span class = "open" id = "1">&#9658</span></p>
					<div class = "Hide">
					<p class = "p todays_groups_p">Бүгін келетін топтар</p>
					<!-- Тобы жоқ оқушылар &#9658  <span class = "open">&#9660</span> -->
					<?
						$result = $mysqli->query("SELECT `id`, `name`, `userId` FROM `users` WHERE `group` = '0' AND `status` = '0' AND `who` = '1'");
						$result2 = $mysqli->query("SELECT `id`, `name`, `userId` FROM `users` WHERE `status` = '3' AND `who` = '1'");
						if($result2->num_rows != 0){
							echo '<p class = "p p1">Оқудан шығатын - '.$result2->num_rows.' оқушы <span class = "open" id = "1">&#9658</span></p>';
							$i = 1;
							echo '<div class = "pupils">
										<table>
											<tr>
												<th class = "Number td">№</th>
												<th class = "Name td">Аты-жөні</th>
												<!--<th class = "Id td">ID</th>-->
												<th class = "Id td Checkbox"></th>
											</tr>';
							while(($row2 = $result2->fetch_assoc()) != false){
									$class = "";
									if($i % 2 == 1) $class = "second";
									echo '<tr>
											<td class = "Number '. $class.'">'.$i.'</td>
											<td class = "Name '. $class.'"><a class = "userName" id = "id'.$row2['id'].'">'.$row2['name'].'</a></td>
											<!--<td class = "Id '. $class.'">'.$row2['userId'].'</td>-->
											<td class = "Id Checkbox '. $class.'"><input type="checkbox" id = "'.$row2['id'].'" class = "checkbox"></td>
										</tr>';
								$i++;
							}
								echo '</table>
									</div>';
						}
						$num = $result->num_rows;
						if($num != 0){
							echo '<p class = "p p1">Топсыз - '.$num.' оқушы <span class = "open" id = "1">&#9658</span></p>';
							$i = 1;
							echo '<div class = "pupils">
										<table>
											<tr>
												<th class = "Number td">№</th>
												<th class = "Name td">Аты-жөні</th>
												<!--<th class = "Id td">ID</th>-->
												<th class = "Id td Checkbox"></th>
											</tr>';
							while(($row2 = $result->fetch_assoc()) != false){
								echo '<tr>
										<td class = "Number">'.$i.'</td>
										<td class = "Name"><a class = "userName" id = "id'.$row2['id'].'">'.$row2['name'].'</a></td>
										<!--<td class = "Id">'.$row2['userId'].'</td>-->
										<td class = "Id Checkbox"><input type="checkbox" id = "'.$row2['id'].'" class = "checkbox"></td>
									</tr>';
								$i++;
							}
							echo '</table>
								</div>';
						}
					?>

					<!-- Тобы бар оқушылар -->
					<?
						$result = $mysqli->query("SELECT * FROM `curator` WHERE `status` = '1'");
						while(($row = $result->fetch_assoc()) != false){
							$group = $mysqli->query("SELECT * FROM `groups` WHERE `curatorId` = '".$row["id"]."' ORDER BY `name` ASC");
							$group2 = $mysqli->query("SELECT * FROM `groups` WHERE `curatorId` = '".$row["id"]."' ORDER BY `name` ASC")->fetch_assoc();
							if($group2 != false){
								echo '<p class = "p Open CURATOR">'.$row["name"].'<span class = "open" id = "1">&#9658</span></p><div class = "Hide">';
								while(($g = $group->fetch_assoc()) != false){
									$r = $mysqli->query("SELECT `id`, `name`, `userId` FROM `users` WHERE `group` = '".$g['id']."' AND `status` = '0' AND `who` = '1' ORDER BY `name` ASC");
									$num = $r->num_rows;
									echo '<p class = "p p1 groupsG" id = "'.$g['id'].'">'.$g['name'] . " тобы - ".$num.' оқушы <span class = "open" id = "1">&#9658</span></p>';
									// if($num != 0){
										echo '<div class = "pupils">
												<table>
													<tr>
														<th class = "Number td">№</th>
														<th class = "Name td">Аты-жөні</th>
														<!--<th class = "Id td">ID</th>-->
														<th class = "Id td Checkbox"></th>
													</tr>';
										$i = 1;
										while(($row2 = $r->fetch_assoc()) != false){
											echo '<tr>
													<td class = "Number '. $class.'">'.$i.'</td>
													<td class = "Name '. $class.'"><a class = "userName" id = "id'.$row2['id'].'">'.$row2['name'].'</a></td>
													<!--<td class = "Id '. $class.'">'.$row2['userId'].'</td>-->
													<td class = "Id Checkbox '. $class.'"><input type="checkbox" id = "'.$row2['id'].'" class = "checkbox"></td>
												</tr>';
											$i++;
										}
										echo '</table>
									</div>';
								}
								echo "</div>";
							}
						}
					?>
				</div>

			<style>
				.fa-cog{
					color: #fff;
				}
				.fa-cog:hover{
					cursor: pointer;
					transition:1s;
				}
				.t2 .tr2 .tdBals{
					min-width: 30px;
				}
			</style>
			<p class = "p Open2 workWithCurator closeBack"><i class="fa fa-wrench" aria-hidden="true"></i> Настройки <span class = "open" id = "1">&#9658</span></p>
			<div class = "Hide">
				<p class = "p TurnOfIdP">Оқушыны тіркеу</p>
				<p class = "p edit-user-info-p">Редактировать</p>
				<p class = "p CreatNewGroupP">Жаңа топ ашу</p>
				<p class = "p CloseGroupP">Топты жабу</p>
				<p class = "p ChangeCuratorP">Топтың кураторын ауыстыру</p>
				<p class = "p" id = "setDayOfWeekP">Топтың келетін күнін белгілеу</p>
				<p class = "p AddUserToGroupP Click2">Оқушыны топқа қосу / ауыстыру</p>
				<p class = "p ChangeSubjectP Click2">Оқушының таңдау пәнін өзгерту</p>
				<p class = "p DeleteUserP Click2">Оқушыны оқудан шығару</p>
				<p class = "p AciveMonthP">Келесі айды іске қосу</p>
				<p class = "p testsPN">Tесттер тізімі</p>
			</div>
			<p class = "p Open2 workWithCurator closeBack"><i class="fa fa-eye" aria-hidden="true"></i> Жунал тексеру <span class = "open" id = "1">&#9658</span></p>
			<div class = "Hide">
				<style>
					.setBalForCurator{margin-right: 5px;width: 97%;}
					.setBalForCurator tr .nameCuratorTd{width: 250px;}
	
					.setBalForCuratorP:hover{cursor: pointer;}
					.setBalForCuratorP i{color: #009B76;}
				</style>
				<table class="t2 setBalForCurator">
					<?
						$result = $mysqli->query("SELECT * FROM `curator` WHERE `status` = '1' ORDER BY `name` ASC");
						$n = 1;
						$len = 0;
						$td = '';
						$date_day = (int)date("N");
						while(($row = $result->fetch_assoc()) != false){
							//  AND `dayOfWeek` = '".date("N")."'
							$groups = $mysqli->query("SELECT * FROM `groups` WHERE `curatorId` = '".$row["id"]."'");
							$b = false;
							if($groups->num_rows != 0){
								$groudDays = $groups->fetch_assoc();
								$daysOfweek = explode(":", $groudDays["dayOfWeek"]);
								for($i = 0; $i < count($daysOfweek); $i++){
									if((int)$daysOfweek[$i] == $date_day) {$b = true; break;}
								}
								if($b) $len++;
							}
						}
						$result = $mysqli->query("SELECT * FROM `curator` WHERE `status` = '1' ORDER BY `name` ASC");
						while(($row = $result->fetch_assoc()) != false){
						$groups = $mysqli->query("SELECT * FROM `groups` WHERE `curatorId` = '".$row["id"]."'");
						if($groups->num_rows != 0){
							$b = false;
							while(($groudDays = $groups->fetch_assoc()) != false){
								$daysOfweek = explode(":", $groudDays["dayOfWeek"]);
								for($i = 0; $i < count($daysOfweek); $i++){
									if((int)$daysOfweek[$i] == $date_day) {$b = true; break;}
								}
							}
							$curatorId = $row["id"];
							$results = array();
							$s = "";
							$coma = ", ";
							$result2 = $mysqli->query("SELECT `id`, `name`, `bal`, `curatorId`, `dayOfWeek` FROM `groups` WHERE `curatorId` = '".$curatorId."'  ORDER BY `name` ASC");
							while(($row2 = $result2->fetch_assoc()) != false){
								$thereIs = false;
								$daysOfweek2 = explode(":", $row2["dayOfWeek"]);
								for($i = 0; $i < count($daysOfweek2); $i++){
									if((int)$daysOfweek2[$i] == $date_day) {$thereIs = true; break;}
								}
								if($thereIs) $s = $s . $row2["name"] . $coma;
							}
							if($b){
								if($len == $n) $td = " td2l";
								echo '<tr class="tr2"><td class="td2 NumberTd td2f'.$td.'">'.$n.'</td>
								<td class="td2 nameCuratorTd'.$td.'"><p class = "curatorName'.$row["id"].'">'.$row["name"].'</p></td>
								<td class="td2 CheckboxTd'.$td.'"><p class = "setBalForCuratorP" id = "'.$row["id"].'"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></p></td></tr>';
								$n++;
							}
						}
					}
					?>
				</table>
			</div>
			<p class = "p workWithCurator OpenListOfCuratorsP closeBack"><i class="fa fa-street-view" aria-hidden="true"></i> Кураторлар</p>
			<p class = "p workWithCurator OpenListOfAssistantsP closeBack"><i class="fa fa-street-view" aria-hidden="true"></i> Ассистенттер</p>
			<p class = "p workWithCurator OpenListOfTeachersP closeBack"><i class="fa fa-street-view" aria-hidden="true"></i> Мұғалімдер</p>
			<p class = "p workWithCurator OpenListOfPupilsP closeBack"><i class="fa fa-user" aria-hidden="true"></i> Оқушылар</p>
			<p class = "p workWithCurator OpenListOfPupilsP2 closeBack"><i class="fa fa-user" aria-hidden="true"></i> Кеткен оқушылар</p>
			<p class = "p workWithCurator" id = "getAllGroup"><i class="fa fa-eye" aria-hidden="true"></i> Барлық топтар</p>
			<p class = "p Open2 workWithCurator" id = "listMonth"><i class="fa fa-eye" aria-hidden="true"></i> Айлар тізімі<span class = "open" id = "1">&#9658</span></p>
			<div class = "Hide">
				<?
					$months = $mysqli->query("SELECT * FROM `months` WHERE `status2` = '1'");
					while(($row = $months->fetch_assoc()) != false){
						echo '<p class = "p monthP getAllGroup" id = "'.$row["id"].'">'.$row["name"].'</p>';
					}
				?>
			</div>
			<p class = "p workWithCurator changePasswordP"><i class="fa fa-exchange" aria-hidden="true"></i> Пороль өзгерту</p>
		</div>
		<!-- ___________________________________________________________________________________________ -->
			<div class = "blockLeft getInfoAllGroupL">
				<div class = "Hide Close todays_groups_div">
				<style>
					.tdShowAlluserOfGroup-today{
						color:#286090;
						text-decoration: underline;
					}
					.tdShowAlluserOfGroup-today:hover{text-decoration: none;}
				</style>
					<p class = "p">Бүгін келетін топтар</p>
					<table class="t2 setBalForCurator">
					<?
						$result = $mysqli->query("SELECT * FROM `curator` WHERE `status` = '1' ORDER BY `name` ASC");
						$n = 1;
						$len = 0;
						$td = '';
						$date_day = (int)date("N") + 0;
						// $date_day = 6;
						while(($row = $result->fetch_assoc()) != false){
							//  AND `dayOfWeek` = '".date("N")."'
							$groups = $mysqli->query("SELECT * FROM `groups` WHERE `curatorId` = '".$row["id"]."'");
							$b = false;
							if($groups->num_rows != 0){
								$groudDays = $groups->fetch_assoc();
								$daysOfweek = explode(":", $groudDays["dayOfWeek"]);
								for($i = 0; $i < count($daysOfweek); $i++){
									if((int)$daysOfweek[$i] == $date_day) {$b = true; break;}
								}
								if($b) $len++;
							}
						}
						$result = $mysqli->query("SELECT * FROM `curator` WHERE `status` = '1' ORDER BY `name` ASC");
						while(($row = $result->fetch_assoc()) != false){
						$groups = $mysqli->query("SELECT * FROM `groups` WHERE `curatorId` = '".$row["id"]."'");
						if($groups->num_rows != 0){
							$b = false;
							while(($groudDays = $groups->fetch_assoc()) != false){
								$daysOfweek = explode(":", $groudDays["dayOfWeek"]);
								for($i = 0; $i < count($daysOfweek); $i++){
									if((int)$daysOfweek[$i] == $date_day) {$b = true; break;}
								}
							}
							$curatorId = $row["id"];
							$results = array();
							$s = "";
							$coma = ", ";
							$result2 = $mysqli->query("SELECT `id`, `name`, `bal`, `curatorId`, `dayOfWeek` FROM `groups` WHERE `curatorId` = '".$curatorId."'  ORDER BY `name` ASC");
							while(($row2 = $result2->fetch_assoc()) != false){
								$thereIs = false;
								$daysOfweek2 = explode(":", $row2["dayOfWeek"]);
								for($i = 0; $i < count($daysOfweek2); $i++){
									if((int)$daysOfweek2[$i] == $date_day) {$thereIs = true; break;}
								}
								if($thereIs) {
									$number_p = $mysqli->query("SELECT `id` FROM `users` WHERE `group` = '".$row2["id"]."'")->num_rows;
									$s = $s .'<span class="tdShowAlluserOfGroup tdShowAlluserOfGroup-today" id = "'.$row2["id"].'">'. $row2["name"] . " - " . $number_p .'</span>'.  $coma;

								}
							}
							if($b){
								if($len == $n) $td = " td2l";
								echo '<tr class="tr2"><td class="td2 NumberTd td2f'.$td.'">'.$n.'</td>
								<td class="td2 nameCuratorTd'.$td.'"><p >'.$row["name"].'</p></td>
								<td class="td2 CheckboxTd'.$td.'"><p class = "setBalForCuratorP" id = "'.$row["id"].'">
									'.$s.'
								</p></td></tr>';
								$n++;
							}
						}
					}
					?>
				</table>
				</div>
				<div class=" Hide Close testsDiv">
					<table class="t2">
						<tr class="tr2">
							<th class="th2 td2f">№</th>
							<th class="th2">тесттер тізімі</th>
							<th class="th2"></th>
						</tr>
						<?
							$result = $mysqli->query("SELECT * FROM `tests`" );
							$v = $result->num_rows;
							$j = 1;
							$td = "";
							while(($row = $result->fetch_assoc()) != false){
								$files = glob("files/tests/".$row["id"]."/*", GLOB_ONLYDIR);
								$s = '';
								$len = count($files);
								$c = "";
								$i = 0;
								if($j == 8) $td = " td2l";
								foreach($files as $num => $dir){
									if($i != 0) $c = ', ';
									if($i == $len) $c = '';
									if($i % 7 == 0 && $i != 0) $c = $c . "<br>";
									$m = explode("/", $dir);
									$s = $s . $c . $m[3];
									$i++;
								}
								echo '<tr class="tr2 activeTest'.$row["active"].'">
								<td class="td2 td2f'.$td.'"><p class = "testsNameP">'.$row["id"].'</p></td>
										<td class="td2'.$td.' noSimvolTd"><p class = "testsP testsNameP">'.$s.'</p></td>
										<td class="td2 simvols'.$td.'">
											<p class = "do1 activeTest" id = "'.$j.'" title = "тестті ашу">&#10004;</p>
											<p class = "do2 desactiveTest" id = "'.$j.'" title = "тестті жабу">&#10006;</p>
										</td>
									</tr>';
								$j++;
							}
						?>
					</table>
				</div>
				<div class="Hide allGroupsOrginal">
					<table class="t2 tGetAllGroup">
					<?
						$groups = $mysqli->query("SELECT * FROM `groups` WHERE `thereIs` = '1'");
						$groups2 = $mysqli->query("SELECT * FROM `groups` WHERE `thereIs` = '1' ORDER BY `name` ASC");
						$count =ceil($groups->num_rows / 4);
						for($j = 0; $j < $count; $j++){
							// $users = $mysqli->query("SELECT * FROM `users` WHERE `group` = '".$row["id"]."' AND `status` = '0' AND `who` = '1'");
							$group1 = $groups2->fetch_assoc();
							$group2 = $groups2->fetch_assoc();
							$group3 = $groups2->fetch_assoc();
							$group4 = $groups2->fetch_assoc();
							$name11 = $mysqli->query("SELECT * FROM `users` WHERE `group` = '".$group1["id"]."' AND `status` = '0' AND `who` = '1' AND `group` != '0'  ORDER BY `name` ASC");
							$name22 = $mysqli->query("SELECT * FROM `users` WHERE `group` = '".$group2["id"]."' AND `status` = '0' AND `who` = '1' AND `group` != '0'  ORDER BY `name` ASC");
							$name33 = $mysqli->query("SELECT * FROM `users` WHERE `group` = '".$group3["id"]."' AND `status` = '0' AND `who` = '1' AND `group` != '0'  ORDER BY `name` ASC");
							$name44 = $mysqli->query("SELECT * FROM `users` WHERE `group` = '".$group4["id"]."' AND `status` = '0' AND `who` = '1' AND `group` != '0'  ORDER BY `name` ASC");

							$curator1 = $mysqli->query("SELECT * FROM `curator` WHERE `id` = '".$group1["curatorId"]."' ")->fetch_assoc();
							$curator2 = $mysqli->query("SELECT * FROM `curator` WHERE `id` = '".$group2["curatorId"]."' ")->fetch_assoc();
							$curator3 = $mysqli->query("SELECT * FROM `curator` WHERE `id` = '".$group3["curatorId"]."' ")->fetch_assoc();
							$curator4 = $mysqli->query("SELECT * FROM `curator` WHERE `id` = '".$group4["curatorId"]."' ")->fetch_assoc();
							$m = array($name11->num_rows, $name22->num_rows, $name33->num_rows, $name44->num_rows);
							$num = 0;
							for($i = 0; $i < 4; $i++){
								if($m[$i] > $num) $num = $m[$i];
							}
							$s1 = "";
							$s2 = "";
							$s3 = "";
							$s4 = "";
							if($group1["name"] != false) $s1 = $group1["name"] . " тобы - " . $curator1["name"] . "<br>" . $group1["date"];
							if($group2["name"] != false) $s2 = $group2["name"] . " тобы - " . $curator2["name"] . "<br>" . $group2["date"];
							if($group3["name"] != false) $s3 = $group3["name"] . " тобы - " . $curator3["name"] . "<br>" . $group3["date"];
							if($group4["name"] != false) $s4 = $group4["name"] . " тобы - " . $curator4["name"] . "<br>" . $group4["date"];
							echo '<tr class="tr2">
							<td class="td2 td2f th2NameCurator tdShowAlluserOfGroup" id = "'.$group1["id"].'"><p class = "groupNameP">'.$s1.'</p></td>
							<td class="td2 th2NameCurator tdShowAlluserOfGroup" id = "'.$group2["id"].'"><p class = "groupNameP">'.$s2.'</p></td>
							<td class="td2 th2NameCurator tdShowAlluserOfGroup" id = "'.$group3["id"].'"><p class = "groupNameP">'.$s3.'</p></td>
							<td class="td2 th2NameCurator tdShowAlluserOfGroup" id = "'.$group4["id"].'"><p class = "groupNameP">'.$s4.'</p></td>
							</tr>';
							$class = " tdBottom";
							$td = "";
							for($i = 0; $i < $num; $i++){
								$name1 = $name11->fetch_assoc();
								$name2 = $name22->fetch_assoc();
								$name3 = $name33->fetch_assoc();
								$name4 = $name44->fetch_assoc();
								if($i != 0) $class = "";
								if($name1["name"] == false) $name1["name"] = "";
								if($name2["name"] == false) $name2["name"] = "";
								if($name3["name"] == false) $name3["name"] = "";
								if($name4["name"] == false) $name4["name"] = "";
								if($i + 1 == $num && $j + 1 == $count) $td = " td2l";
								echo '<tr class="tr2">
								<td class="1 td2 td2f tdGetAllGroup'.$class.$td.' contract'.$name1["contract"].'" id = "contract'.$name1["id"].'"><p class = "showUserName">'.$name1["name"].'</p></td>
								<td class="2 td2 tdGetAllGroup'.$class.$td.' contract'.$name2["contract"].'" id = "contract'.$name2["id"].'"><p class = "showUserName">'.$name2["name"].'</p></td>
								<td class="3 td2 tdGetAllGroup'.$class.$td.' contract'.$name3["contract"].'" id = "contract'.$name3["id"].'"><p class = "showUserName">'.$name3["name"].'</p></td>
								<td class="4 td2 tdGetAllGroup'.$class.$td.' contract'.$name4["contract"].'" id = "contract'.$name4["id"].'"><p class = "showUserName">'.$name4["name"].'</p></td>
									</tr>';
							}
							
						}
					?>
					</table>
				</div>
				<?
				$months = $mysqli->query("SELECT * FROM `months` WHERE `status2` = '1'");
				$i = 1;
				while(($row = $months->fetch_assoc()) != false){
					echo '<div class = "Hide MonthDiv" id = "MonthDiv'.$row["id"].'">
							<p class="p">'.$row["name"].' айы</p>
							<div class = "hide1 MonthDivInner" id = "MonthDivInner">
							<table class="t2">';
					$day = $row["days"];
					$month = (int)$row["id"];
					echo '<tr class="tr2 tOb thAbc">
						<th class="th2 th2f nB">№</th>
						<th class="th2 nameB2" colspan = "2">Аты-жөні</th>
						';
					$tdl = '';
					for($i = 0; $i < $day; $i++){
						echo '<th class="th2 Money">'.($i + 1).'</th>';
					}
					echo '</tr>';
					$g = "group";
					// $g = "style = 'background:red'";
						$result = $mysqli->query("SELECT * FROM `curator` ORDER BY `name` ASC");
						$num = $result->num_rows;
						$j = 0;
						while(($row2 = $result->fetch_assoc()) != false){
							$i = 1;
							$datesP = array();
							$massive = array();
							$paid = $mysqli->query("SELECT `datesIns` FROM `curator` WHERE `id` = '".$row2["id"]."'")->fetch_assoc();
							// print_r($paid);
							// echo "<br>";
							if($paid['datesIns'] != false) {
								$datesP = explode(")", $paid['datesIns']);
								
								for($i = 0; $i < count($datesP); $i++){
									$data = explode("(", $datesP[$i]);
									$pastData = explode("(", $datesP[$i - 1]);
									if($pastData[1] != false){
										$pastData = explode(":",$pastData[1]);
										$pay = (int)$pastData[2];
										$paid = (int)$pastData[3];
										$pastMonth = $pay - $paid;
									}
									$Mday = explode(":", $data[1]);
									if($month == (int)$Mday[0]) {
										$datesPaid = explode("(",$datesP[$i]);
										$massive = $datesPaid[0];
										break;
									}
								}
							}
							else $datesP = array();
							$massive = explode(";",$massive);
							// print_r($massive);
							// echo $massive ."<br>";
							echo '<tr class="tr2 ChangeColor">
								<td class="td2 td2f '.$tdl.'" ><p class = "number'.($j + 1).' number2'.$row2["id"].' number12" id = "'.($j + 1).'">'.($j + 1).'</p></td>
								<td class="td2 '.$tdl.' tdName" colspan = "2">
									<p class = "money NameTeacher">'.$row2["name"].'</p>
								</td>';

							for($i = 0; $i < $day; $i++){
								$money = "";
								$Day = 0;
								$data = '';
								$groups = '';
								if(count($datesP) > 0){
									$m = explode(":", $massive[0]);
									$Month = (int)$m[0];
									$Day = (int)$m[1];
									$money = explode("]", $m[2]);
									// if($Month != $month)$n = array_shift($massive); echo $i + 1 . " " .$totalGain[$i] . "<br>";
									if($i + 1 == $Day) {$data = $money[0];$groups = '<br>' . $money[1]; $n = array_shift($massive); $totalGain[$i] = $totalGain[$i] + $money[0]; }
								}
								echo '<td class="td2 setBalsForCurator"><p>'.$data.$groups.'</p>
									</td>';
							}
							$n = explode(":",$datesPaid[1]);

							// $month = (int)$n[0];
							$MainMoney = (int)$n[1];
							$Pay =(int)$n[2];
							$Paid = (int)$n[3];
							// $MainMoney = $row2["money"];
							// $Pay = $row2["pay"];
							// $Paid = $row2["paid"];
							echo '</tr>';
							$j++;
						}
						$tdl = "";
						echo '<tr class="tr2">
								<td class="td2 td2f '.$tdl.' criteriFirstNum"></td>
								<td class="td2 '.$tdl.' tdName criteri" colspan = "2">
									<p class = "MainNameP">Критери</p>
								</td>';
							for($i = 0; $i < $day; $i++){
								echo '<td class="ver'.($i + 1).' td2 Money '.$tdl.' "><p></p></td>';
							}
						echo '</tr>';
						echo '<tr class="tr2">
								<td class="td2 td2f '.$tdl.'"></td>
								<td class="td2 '.$tdl.' tdName criteriFirst" colspan = "1"><p>Оқушы түгел болса</p></td>
								<td class="td2 tdBals '.$tdl.' criteriFirst"><p>20</p></td>';
							for($i = 0; $i < $day; $i++){
								echo '<td class="ver'.($i + 1).' td2 Money '.$tdl.' "><p></p></td>';
							}
						echo '</tr>';

						echo '<tr class="tr2">
								<td class="td2 td2f"></td>
								<td class="td2 '.$tdl.' tdName criteriFirst	tdRed tdSecond" colspan = "1"><p>Ағайдың қолы</p></td>
								<td class="td2 tdBals '.$tdl.' criteriFirst	tdRed"><p>10</p></td>';
							for($i = 0; $i < $day; $i++){
								echo '<td class="ver'.($i + 1).' td2 Money '.$tdl.' "><p></p></td>';
							}
						echo '</tr>';

						echo '<tr class="tr2">
								<td class="td2 td2f '.$tdl.'"></td>
								<td class="td2 '.$tdl.' tdName criteriFirst tdNextRed" colspan = "1"><p>Печать</p></td>
								<td class="td2 tdBals '.$tdl.' criteriFirst tdNextRed"><p>10</p></td>';
							for($i = 0; $i < $day; $i++){
								echo '<td class="ver'.($i + 1).' td2 Money '.$tdl.' "><p></p></td>';
							}
						echo '</tr>';

						echo '<tr class="tr2">
								<td class="td2 td2f '.$tdl.'"></td>
								<td class="td2 '.$tdl.' tdName criteriFirst tdGreen tdSecond" colspan = "1"><p>Себебі</p></td>
								<td class="td2 tdBals '.$tdl.' criteriFirst tdGreen"><p>10</p></td>';
							for($i = 0; $i < $day; $i++){
								echo '<td class="ver'.($i + 1).' td2 Money '.$tdl.' "><p></p></td>';
							}
						echo '</tr>';

						echo '<tr class="tr2">
								<td class="td2 td2f '.$tdl.'"></td>
								<td class="td2 '.$tdl.' tdName criteriFirst tdNextGreen" colspan = "1"><p>2 сабаққа баға</p></td>
								<td class="td2 tdBals '.$tdl.' criteriFirst tdNextGreen"><p>15</p></td>';
							for($i = 0; $i < $day; $i++){
								echo '<td class="ver'.($i + 1).' td2 Money '.$tdl.' "><p></p></td>';
							}
						echo '</tr>';

						echo '<tr class="tr2">
								<td class="td2 td2f '.$tdl.'"></td>
								<td class="td2 '.$tdl.' tdName criteriFirst tdBlue tdSecond" colspan = "1"><p>3 сабаққа баға</p></td>
								<td class="td2 tdBals '.$tdl.' criteriFirst tdBlue"><p>25</p></td>';
							for($i = 0; $i < $day; $i++){
								echo '<td class="ver'.($i + 1).' td2 Money '.$tdl.' "><p></p></td>';
							}
						echo '</tr>';

						$tdl = "td2l";
						echo '<tr class="tr2">
								<td class="td2 td2f '.$tdl.'"></td>
								<td class="td2 '.$tdl.' tdName criteriFirst tdNextBlue" colspan = "1"><p>Мұғалімнің қолы</p></td>
								<td class="td2 tdBals '.$tdl.' criteriFirst tdNextBlue"><p>10</p></td>';
							for($i = 0; $i < $day; $i++){
								echo '<td class="ver'.($i + 1).' td2 Money '.$tdl.' "><p></p></td>';
							}
						echo '</tr>';
						echo '</table>
							</div>
							</div>';
						// print_r($Plus);
						// print_r($Minus);
						$i++;
						// );
					}
				?>
			</div>
			<div class = "blockLeft blockLeft2">
				

				<div class = "minLeft">
					<img src="" height="320" width="250" alt="" id = "UserAvatar">
				</div>
				<div class = "minRight">
					<p class = "p NAME USERNAME"></p>
					<table class="t2 t22 MainInfoAboutUser">
					</table>
					<div class = "moreInfo">
						<table class="t2 t22 ExtraInfoAboutUser">
						</table>
					</div>
					<p class = "More OpenEditAndMore">Толық мәлімет<span class = "open s1" id = "1">&#9658</span></p>

					<div class = "moreInfo men">
						<table class="t2 t22 EditInfoUser"></table>
						<form action = "" method = "post" enctype =  'multipart/form-data'>
							<label for="loadAvatar" id = "labelLoad">Сурет қою.</label>
							<input type="file" id = "loadAvatar" name = "avatar">
							<input type="submit" name = "sendAvatar" class = "button buttonLoadAvatar" value = "Сақтау.">
							<span class = "error"><?=$_SESSION["error"]?></span>
						</form>
					</div>
						<p class = "EDIT OpenEditAndMore">Редактировать<span class = "open s1" id = "1">&#9658</span></p>
						<div class = "chart_div chart_div2" id="chart_div"></div>
				</div>
			</div>
		<!-- ___________________________________________________________________________________________ -->
		<style>
			.changeDayOfGroup{
				width: 120px;
				margin-top: 0;
			}
			.changeDayOfGroup tr .NumberTd{
				min-width: 20px;
			}
			.changeDayOfGroup tr .nameGroupTd{
				min-width: 80px;
			}
			.changeDayOfGroup tr .CheckboxTd{
				min-width: 20px;
			}
			.changeDayOfGroup tr td{
				height: 50px;
			}
			.noneBorderTable {width: 430px;}
			.noneBorderTable tr .borderNoneTd{
				border:1px solid #fff;vertical-align: top;
			}
			.noneBorderTable tr .borderNoneTd1{
				width: 120px;
			}
			.noneBorderTable tr .borderNoneTd2{
				width: 260px;
			}
			#dayOfWeek{
				width: 150px;
			}
			#setBalToCuratorButton{float: left;}
			.getCuratrorId{display: none;}
		</style>
		<div class = "blockLeft closeBlockLeft blockLeft4">
		<!-- Edit User's Information -->
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
		<div class = "Hide CloseAllDivs setBlaToCuratorDiv">
			<p class = "p InsPZH">Журнал тексеру</p>
			<table class="t2 noneBorderTable">
				<tr class="tr2">
					<td class="td2 borderNoneTd borderNoneTd1">
						<table class="t2 changeDayOfGroup">
							<?
								$td = '';
								echo '<tr class="tr2 tOb thAbc thAbc2">
									<th class="th2 th2f nB">№</th>
									<th class="th2 nameB3" colspan = "2">Топ</th>
									<th class="th2 Money">Баға</th></tr>';
								echo '<tr class="tr2">
										<td class="td2 '.$tdl.' tdName criteri" colspan = "4">
											<p class = "MainNameP">Критери</p>
										</td></tr>';
								echo '<tr class="tr2">
								<td class="td2 td2f '.$tdl.' tdName criteriFirst tdBorderBottomNone" colspan = "3"><p>Оқушы түгел болса</p></td>
								<td class="td2 tdBals '.$tdl.' criteriFirst tdBorderBottomNone"><p>20</p></td></tr>';

								echo '<tr class="tr2">
								<td class="td2 '.$tdl.' tdName criteriFirst	tdRed tdSecond" colspan = "3"><p>Ағайдың қолы</p></td>
								<td class="td2 tdBals '.$tdl.' criteriFirst	tdRed"><p>10</p></td></tr>';

								echo '<tr class="tr2">
								<td class="td2 td2f '.$tdl.' tdName criteriFirst tdNextRed tdBorderBottomNone" colspan = "3"><p>Печать</p></td>
								<td class="td2 tdBals '.$tdl.' criteriFirst tdNextRed tdBorderBottomNone"><p>10</p></td></tr>';

								echo '<tr class="tr2">
								<td class="td2 '.$tdl.' tdName criteriFirst tdGreen tdSecond" colspan = "3"><p>Себебі</p></td>
								<td class="td2 tdBals '.$tdl.' criteriFirst tdGreen"><p>10</p></td></tr>';

								echo '<tr class="tr2">
								<td class="td2 td2f '.$tdl.' tdName criteriFirst tdNextGreen tdBorderBottomNone" colspan = "3"><p>2 сабаққа баға</p></td>
								<td class="td2 tdBals '.$tdl.' criteriFirst tdNextGreen tdBorderBottomNone"><p>15</p></td></tr>';

								echo '<tr class="tr2">
								<td class="td2 '.$tdl.' tdName criteriFirst tdBlue tdSecond" colspan = "3"><p>3 сабаққа баға</p></td>
								<td class="td2 tdBals '.$tdl.' criteriFirst tdBlue"><p>25</p></td></tr>';

								$tdl = "td2l";
								echo '<tr class="tr2">
								<td class="td2 td2f '.$tdl.' tdName criteriFirst tdNextBlue" colspan = "3"><p>Мұғалімнің қолы</p></td>
								<td class="td2 tdBals '.$tdl.' criteriFirst tdNextBlue"><p>10</p></td></tr>';
								
							?>
						</table>
					</td>
					<td class="td2 borderNoneTd borderNoneTd2">
						<form class = "form-inline">
							<p class="getCuratrorId"></p>
							<input type="button" value = "Сохранить" class ="btn btn-primary"  id = "setBalToCuratorButton">
						</form>
					</td>
				</tr>
			</table>
		</div>

		<div class = "Hide CloseAllDivs setDayOfWeekDiv">
			<p class = "p Open">Топтың келетін күнін белгілеу</p>
			<table class="t2 noneBorderTable">
				<tr class="tr2">
					<td class="td2 borderNoneTd borderNoneTd1">
						<table class="t2 changeDayOfGroup">
								<?
									$result = $mysqli->query("SELECT * FROM `groups`  ORDER BY `name` ASC");
									$n = 1;
									$len = $result->num_rows;
									$td = '';
									while(($row = $result->fetch_assoc()) != false){
										if($len == $n) $td = " td2l";
										echo '<tr class="tr2"><td class="td2 NumberTd td2f'.$td.'">'.$n.'</td>
										<td class="td2 nameGroupTd'.$td.'">'.$row["name"].'</td>
										<td class="td2 CheckboxTd'.$td.'"><input type="checkbox" id = "'.$row['id'].'" class = "dayOfWeekCheckbox"></td></tr>';
										$n++;
									}
								?>
						</table>
					</td>
					<td class="td2 borderNoneTd borderNoneTd2">
						<form class = "form-inline">
							<select name="" id="dayOfWeek" class = "form-control">
								<option value="1">понедельник</option>
								<option value="2">вторник</option>
								<option value="3">среда</option>
								<option value="4">четверг</option>
								<option value="5">пятница</option>
								<option value="6">суббота</option>
								<option value="0">воскресенье</option>
							</select>
							<input type="button" value = "Сақтау" class ="btn btn-primary"  id = "dayOfWeekButton">
						</form>
					</td>
				</tr>
			</table>
		</div>

			<!-- Келесі айды іске қосу. -->
				<div class = "Hide AciveMonthDiv CloseAllDivs Close">
					<p class = "p">Келесі айды іске қосу</p>
					<form class = "form-inline">
						<select name="" class = "form-control MonthsBilim" id="Month">
							<?
								$result = $mysqli->query("SELECT * FROM `months` WHERE `status2` = '0'");
								while(($row = $result->fetch_assoc()) != false){
									echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
								}
							?>
						</select>
						<input type="button" value = "Активировать" class ="btn btn-primary"  id = "ActiveMonthBilim">
					</form>
				</div>
			<div class = "Hide TurnOfIdDiv CloseAllDivs">
				<p class = "p Open">Оқушыны тіркеу</p>
					<form class="form-inline">
						<input type="text" id = "name" class = "form-control form-input form-input1" placeholder = "Атыңыз & тегіңіз*">
						<span id = "e_n" class = "span"></span> <br>

						<input type="tel" maxlength="12" id = "tel"  class = "form-control form-input" placeholder = "Телефон*"> 
						<span id = "e_t" class = "span"></span><br>

						<input type="text" id = "nameF"  class = "form-control form-input" placeholder = "Әкеңіздің аты & тегі*"> 
						<span id = "e_nf" class = "span"></span><br>

						<input type="tel" maxlength="12" id = "tel2"  class = "form-control form-input" placeholder = "Әкеңіздің телефоны*"> 
						<!-- <input type="radio" id = "nameF"> <span >No</span> -->
						<span id = "e_t2" class = "span"></span><br>

						<input type="text" id = "nameM"  class = "form-control form-input" placeholder = "Анаңыздың аты & тегі*"> 
						<span id = "e_nm" class = "span"></span><br>

						<input type="tel" maxlength="12" id = "tel3"  class = "form-control form-input" placeholder = "Анаңыздың телефоны*"> 
						<span id = "e_t3" class = "span"></span><br>
						
						<input type="text"  id = "address"  class = "form-control form-input" placeholder = "Мекен жайыңыз*"> 
						<span id = "e_a" class = "span"></span><br>

						<!-- <input type="text"  id = "school"  class = "input" placeholder = "Мектебіңіз*"> -->
						<select name="" class = "form-control form-input" id="schools">
							<option>Мектебі</option>
							<?
								$result = $mysqli->query("SELECT * FROM `audan`");
								while(($row = $result->fetch_assoc()) != false){
									$audanId = $row["id"];
									echo '<optgroup label="'.$row["name"].'">';
									$result2 = $mysqli->query("SELECT * FROM `schools` WHERE `audan` = '".$audanId."'");
									while(($row2 = $result2->fetch_assoc()) != false){
										echo '<option value="'.$row2["id"].'" >'.$row2["name"].'</option>';
									}
									echo '</optgroup>';
								}
							?>
						</select>
						<span id = "e_s" class = "span"></span><br>

						<input type="text"  id = "children"  class = "form-control form-input" placeholder = "Отбасыңызда қанша бала бар*"> 
						<span id = "e_ch" class = "span"></span><br>
						
						<select name="" id="Subject" class = "form-control form-input">
							<option value="1">Физика</option>
							<option value="2">Химия</option>
							<option value="3">Биалогия</option>
							<option value="4">Георафия</option>
							<option value="5">Әдебиет</option>
							<option value="6">Д. тарих</option>
							<option value="7">Ағылшын</option>
						</select><br>
<!-- 
						<input type="text" id = "ID" class = "input"  placeholder = "ID*"> 
						<span id = "e_id" class = "span"></span><br>

						<input type="password" id = "password1"  class = "input" placeholder = "Пароль*"> 
						<span id = "e_p1" class = "span"></span><br>

						<input type="password" id = "password2"  class = "input" placeholder = "Парольді қайтала*"> 
						<span id = "e_p2" class = "span"></span><br> -->

						<p class = "regDogovor">Договор</p>
					    <input type="radio" name="contract" value="1" class = "contract"> <p class = "regDogovor">Ия</p>
					    <input type="radio" name="contract" value="0" class = "contract"> <p class = "regDogovor">Жоқ</p>
						<span id = "e_co" class = "span"></span><br>
						<input type="button" value = "Тіркеу" class ="btn btn-primary form-input" id = "sendReg" >
					</form>
					<center><p id = "infoReg"></p></center>
			</div>
			<style>
				.successReg, .successRegText{
					font-size: 14px;
					color:#009B76;
					margin-top: 5px;
				}
				.successRegText{
					color:#1E5945;
				}
				.tUserDate{
					width: 35%;
				}
				.tdUserIdName, .tdUserPasswordName{
					width: 80px;
				}
				.tdUserP{text-align: left; margin-left: 10px;}
				.t2 .tr2 .tdInfoUser{border:none;border-bottom:1px dotted silver;}
				.regDogovor{font-size: 13px;display: inline-block;}
				.contract{margin-left: 35px;margin-top: 5px;}
				#e_co{margin-left: 7px;}
				.div45{margin-top: 20px;}
			</style>
			<div class = "Hide DeleteUserDiv CloseAllDivs">
					<p class = "p Open">Оқушыны оқудан шығару</p>
					<p id = "infoReg"></p>
					<div class = 'div45'>
					<table class="t2 DeleteTable"></table>
					<form class = "form-inline" class = "inlineBlockForm" >
						<input type="button" value = "Шығару" class ="btn btn-primary"  id = "turnOff">
					</form>
					</div>
			</div>
			<!-- оқушыны тіркеген соң Білім бөліміне ид және пороль ді жіберу -->
			<div class = " Hide CloseAllDivs userIsLogined">
				<center>
					<p class = "successReg"></p>
					<table class="t2 tUserDate">
						<tr class="tr2">
							<td class="td2 tdInfoUser tdUserIdName"><p class = "tdUserP">ID :</p></td>
							<td class="td2 tdInfoUser tdUserIdValue"><p id="userId"></p></td>
						</tr>	
						<tr class="tr2">
							<td class="td2 tdInfoUser tdUserPasswordName"><p class = "tdUserP">Пороль :</p></td>
							<td class="td2 tdInfoUser tdUserPasswordValue"><p id="userPassword"></p></td>
						</tr>			
					</table>
					<p class = "successRegText"></p>
				</center>
			</div>
			<div class = "Hide CreatNewGroupDiv CloseAllDivs">
				<p class = "p Open">Жаңа топ ашу</p>
				<form class = "form-inline" class = "inlineBlockForm">
					<input type="text" id = "nameGroup" class = "form-control" placeholder = "Топтың аты*">
					<select name="" id="curator" class = "form-control">
						<?
							$result = $mysqli->query("SELECT * FROM `curator` WHERE `status` = '1'");
							while(($row = $result->fetch_assoc()) != false){
								echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
							}
						?>
					</select>
					<input type="button" value = "Ашу" class ="btn btn-primary"  id = "creatGroup">
				</form>
			</div>
			<div class = "Hide CloseGroupDiv CloseAllDivs">
				<p class = "p Open">Tопты жабу.</p>
				<form class = "form-inline" class = "inlineBlockForm">
					<select name="" class = "form-control" id="groupsId2">
						<?
							$result = $mysqli->query("SELECT * FROM `groups` ORDER BY `name`");
							while(($row = $result->fetch_assoc()) != false){
								echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
							}
						?>
					</select>
					<input type="button" value = "Жабу" class ="btn btn-primary"  id = "remove">
				</form>
			</div>
		
			<div class = "Hide ChangeCuratorDiv CloseAllDivs">
				<p class = "p Open">Топтың кураторын ауыстыру.</p>
				<form class = "form-inline">
					<select name="" class = "form-control" id="groupsIdChangeGroup">
						<?
							$result = $mysqli->query("SELECT * FROM `groups` ORDER BY `name`");
							while(($row = $result->fetch_assoc()) != false){
								echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
							}
						?>
					</select>
					<select name="" id="curatorChangeGroup" class = "form-control">
						<?
							$result = $mysqli->query("SELECT * FROM `curator`  WHERE `status` = '1'");
							while(($row = $result->fetch_assoc()) != false){
								echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
							}
						?>
					</select>
					<input type="button" value = "Ауыстыру" class ="btn btn-primary"  id = "changeGroup">
				</form>
			</div>
			<div class = "Hide AddUserToGroupDiv CloseAllDivs">
				<p class = "p Open">Оқушыны топқа қосу / ауыстыру.</p>
				<table class="t2 DeleteTable">
				</table>
				<form class = "form-inline">
					<!-- <input type="text" id = "userIdAddChange" class = "input input2" placeholder = "Оқушының ID -і*"> -->
					<select name="" class = "form-control" id="groupsId">
						<?
							$result = $mysqli->query("SELECT * FROM `groups` ORDER BY `name`");
							while(($row = $result->fetch_assoc()) != false){
								echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
							}
						?>
					</select>
					<input type="button" value = "Қосу / ауыстыру" class ="btn btn-primary"  id = "addChange">
				</form>
			</div>

			
			<div class = "Hide ChangeSubjectDiv CloseAllDivs">
				<p class = "p Open">Оқушының таңдау пәнін өзгерту.</p>
				<table class="t2 DeleteTable">
				</table>
				<form class = "form-inline">
					<select name="" class = "form-control" id="Subject2" >
						<option value="1">Физика</option>
						<option value="2">Химия</option>
						<option value="3">Биалогия</option>
						<option value="4">Георафия</option>
						<option value="5">Әдебиет</option>
						<option value="6">Д. тарих</option>
						<option value="7">Ағылшын</option>
					</select>
					<input type="button" value = "Өзгерту" class ="btn btn-primary"  id = "changeSubject">
				</form>
			</div>
		</div>
		<div class = "blockLeft closeBlockLeft">
			<!-- Кураторлар тізімі -->
				<?
					$result = $mysqli->query("SELECT * FROM `curator` WHERE `status` = '1'");
					$num = $result->num_rows;
				?>
				
					<div class = "Hide Close OpenListOfCuratorsDiv">
						<p class = "p" >Кураторлар тізімі - <?=$num?></p>
						<table class="t2">
						<tr class="tr2">
								<td class="td2 td2f tdn"></td>

								<td class="td2">
									<input type="text" class="addTeather" placeholder = "Аты-жөні" id = "nameCurator">
									
								</td>
								<td class="td2"></td>
								<td class="td2">
									<input type="text" class="addTeather" placeholder = "Ата-ана нөмері" id = "telCurator">
								</td>
								<td class="td2 simvols">
									<p class = "do1 plus" id = "addCurator" title = "Добавить куратора.">&#10006;</p>
								</td>
							</tr>
							<tr class="tr2">
								<th class="th2 th2f">№</th>
								<th class="th2 nameMF">Аты-жөні</th>
								<th class="th2">Топтары</th>
								<th class="th2">Ата-ана нөмері</th>
								<th class="th2"></th>
							</tr>
							
							<?
								$td = "";
								$i = 1;
								while(($row = $result->fetch_assoc()) != false){
									if($i== $num) $td = "td2l";
									$nameG = $mysqli->query("SELECT `name` FROM `groups`  WHERE `curatorId` = '".$row["id"]."'");
									$numG = $nameG->num_rows;
									$s = "";
									$c = ", ";
									$j = 1;
									while(($r = $nameG->fetch_assoc()) != false){
										if($j == $numG) $c = "";
										$s = $s . $r["name"] . $c;
										$j++;
									}
									$class = "";
									if($i % 2 == 1) $class = "second";
									echo '<tr class="tr2">
											<td class="td2 td2f '.$td. " " . $class.'">
												'.$i.'
											</td>
											<td class="td2 '.$td. " " . $class.'">
												<p id = "nameCurator'.$row["id"].'">'.$row['name'].'</p>
											</td>
											<td class="td2 '.$td. " " . $class.'">
												'.$s.'
											</td>
											<td class="td2 tdNum teC '.$td. " " . $class.'" >
												<p class = "telCurator" id = "'.'telWritten'.$row["id"].'">
													'.$row["tel1"]."<br>".$row["tel2"].'
												</p>
												<input type="text" class="write" value = "'.$row["tel1"] . ":" .$row["tel2"].'" id = "'.'telWillWrite'.$row["id"].'" >
											</td>

											<td class="td2 simvols '.$td. " " . $class.'">
												<p class = "do1 edit3" id = "'.$row["id"].'" title = "Сохранить изменения.">&#10004;</p>
												<p class = "do2 delete3" id = "'.$row["id"].'" title = "Удалить учителя.">&#10006;</p>
											</td>
										</tr>';
									$i++;
								}
							?>
						</table>
					</div>	
			<!-- Ассистенттер тізімі -->
				<?
					$result = $mysqli->query("SELECT * FROM `assistants` WHERE `status` = '1'");
					$num = $result->num_rows;
				?>
			
					<div class = "Hide Close OpenListOfAssistantsDiv">
						<p class = "p">Ассистенттер тізімі - <?=$num?></p>
						<table class="t2">
							<tr class="tr2">
								<td class="td2 td2f tdn"></td>
								<td class="td2">
									<input type="text" class="addTeather" placeholder = "Аты-жөні" id = "nameAssistent">
								</td>
								<td class="td2">
									<input type="text" class="addTeather" placeholder = "Кураторы" id = "curatorAssistent">
								</td>
								<td class="td2 simvols">
									<p class = "do1 plus" id = "addAssistent" title = "Добавить учителя.">&#10006;</p>
								</td>
							</tr>
							<tr class="tr2">
								<th class="th2 th2f">№</th>
								<th class="th2">Аты-жөні</th>
								<th class="th2">Кураторы</th>
								<th class="th2"></th>
							</tr>
							
							<?
								$td = "";
								$i = 1;
								while(($row = $result->fetch_assoc()) != false){
									if($i == $num) $td = "td2l";
									$class = "";
									if($i % 2 == 1) $class = "second";
									echo '<tr class="tr2">
											<td class="td2 td2f '.$td. " " . $class.'">
												'.$i.'
											</td>
											<td class="td2 '.$td. " " . $class.'">
												<p id = "nameAssistant'.$row["id"].'">'.$row['name'].'</p>
											</td>
											<td class="td2 teA '.$td. " " . $class.'">
												<p class = "status" id = "assistantWritten'.$row["id"].'">'.$row['curator'].'</p>
												<input type="text" class="write" value = "'.$row['curator'].'" id = "assistantWillWrite'.$row["id"].'" >
											</td>
											<td class="td2 '.$td. " " . $class.'">
												<p class = "do1 edit4" id = "'.$row["id"].'" title = "Сохранить изменения.">&#10004;</p>
												<p class = "do2 delete4" id = "'.$row["id"].'" title = "Удалить учителя.">&#10006;</p>
											</td>
										</tr>';
									$i++;
								}
							?>
						</table>
					</div>
			<!-- Мұғалімдер тізімі -->
				<?
					$result = $mysqli->query("SELECT * FROM `teacher` WHERE `type` = '1' ORDER BY `subject` ASC");
					$num = $result->num_rows;
				?>
					<div class = "Hide Close OpenListOfTeachersDiv">
						<p class = "p">Мұғалімдер тізімі - <?=$num?></p>
						<table class="t2">
							<tr class="tr2">
								<td class="td2 td2f tdn">
								</td>

								<td class="td2">
									<input type="text" class="addTeather" placeholder = "Аты-жөні" id = "nameTeacher">
									
								<td class="td2">
									<input type="text" class="addTeather" placeholder = "Пәні" id = "subjectTeacher">
								</td>
								<td class="td2">
									<input type="text" class="addTeather" placeholder = "Телефон" id = "telTeacher">
									
								</td>
								<td class="td2">
									<input type="text" class="addTeather" placeholder = "Статусы" id = "statusTeacher">
									
								</td>
								</td>
								<td class="td2 simvols '.$td.'">
									<p class = "do1 plus" id = "addTeather" title = "Добавить учителя.">&#10006;</p>
								</td>
							</tr>
							<tr class="tr2">
								<th class="th2 td2f">№</th>
								<th class="th2">Аты-жөні</th>
								<th class="th2">Пәні</th>
								<th class="th2">Телефон</th>
								<th class="th2">Статусы</th>
								<th class="th2"></th>
							</tr>
							<?
								$td = "";
								$i = 1;
								//  
								while(($row = $result->fetch_assoc()) != false){
									if($i == $num) $td = "td2l";
									$class = "";
									if($i % 2 == 1) $class = "second";
									echo '<tr class="tr2">
											<td class="td2 td2f '.$td. " " . $class.'">
												'.$i.'
											</td>
											<td class="td2 tdn '.$td. " " . $class.'" >
												<p class = "NameTeacher tdName" id = "'.'NameTeacher'.$row["id"].'">'.$row['name'].'</p>
											</td>
											<td class="td2 tds '.$td. " " . $class.'">
												<p>'.$row['subject'].'</p>
											</td>
											<td class="td2 tdt te '.$td. " " . $class.'">
												<p class = "status" id = "telWrittenT'.$row["id"].'">'.$row['tel'].'</p>
												<input type="text" class="write" value = "'.$row['tel'].'" id = "telWillWriteT'.$row["id"].'" >
											</td>
											<td class="td2 te '.$td. " " . $class.'">
												<p class = "status" id = "statusWrittenT'.$row["id"].'">'.$row['status'].'</p>
												<input type="text" class="write" value = "'.$row['status'].'" id = "statusWillWriteT'.$row["id"].'" >
											</td>
											<td class="td2 simvols '.$td. " " . $class.'">
												<p class = "do1 edit1" id = "'.$row["id"].'" title = "Сохранить изменения.">&#10004;</p>
												<p class = "do2 delete1" id = "'.$row["id"].'" title = "Удалить учителя.">&#10006;</p>
											</td>
										</tr>';
										$i++;
								}
							?>
						</table>
					</div>
			<!-- Оқушылар тізімі -->
				<?
					$result = $mysqli->query("SELECT * FROM `users` WHERE `who` = '1' AND `status` = '0' ORDER BY `name` ASC");
					$num = $result->num_rows;
				?>
					<style>
						#findUsersWithShcool{margin-left: 5px;}
						#found tr th{text-align: center;}
					</style>
					<div class = "Hide Close OpenListOfPupilsDiv">
					<p class = "p">Оқушылар тізімі - <?=$num?></p>
					<form class="form-inline">
						<input type="search" id = "search" class = "form-control" placeholder = "Поиск*">
						<select name="" id="findUsersWithShcool" class = "form-control">
							<option  >Мектебі</option>
							<?
								$results = $mysqli->query("SELECT * FROM `audan`");
								while(($row = $results->fetch_assoc()) != false){
									$audanId = $row["id"];
									echo '<optgroup label="'.$row["name"].'">';
									$result2 = $mysqli->query("SELECT * FROM `schools` WHERE `audan` = '".$audanId."'");
									while(($row2 = $result2->fetch_assoc()) != false){
										echo '<option value="'.$row2["id"].'" >'.$row2["name"].'</option>';
									}
									echo '</optgroup>';
								}
							?>
						</select>
						<input type="button" value = 'Найти' class ="btn btn-primary" id = "findUsersWithShcoolButton" >
					</form>
					<div class = "found">
						<span class = "error error2"></span>
						<table class="t2" id = "found"></table>
					</div>
						<table class="t2">
							<tr class="tr2">
								<th class="th2 th2f">№</th>
								<th class="th2 nameB">Аты-жөні</th>
								<th class="th2">Таңдау-пәні</th>
								<th class="th2">Телефон</th>
								<th class="th2">ID</th>
							</tr>
							
							<?
								$td = "";
								$i = 1;
								while(($row = $result->fetch_assoc()) != false){
									if($i == $num) $td = "td2l";
									$subjectName = $mysqli->query("SELECT `name` FROM `subjects` WHERE `id` = '".$row['subject']."'")->fetch_assoc();
									$class = "";
									if($i % 2 == 1) $class = "second";
									echo '<tr class="tr2">
											<td class="td2 td2f '.$td. " " . $class.'">
												'.$i.'
											</td>
											<td class="td2 '.$td. " " . $class.' tdName">
												<p class = "userName3" id = "'.$row['id'].'">'.$row['name'].'</p>
											</td>
											<td class="td2 '.$td. " " . $class.'">
												<p>'.$subjectName["name"].'</p>
											</td>
											<td class="td2 '.$td. " " . $class.'">
												<p>'.$row['tel'].'</p>
											</td>
											<td class="td2 '.$td. " " . $class.'">
												<p>'.$row['userId'].'</p>
											</td>
										</tr>';
									$i++;
								}
							?>
						</table>
					</div>
			<!-- Кеткен оқушылар тізімі -->
				<?
					$result = $mysqli->query("SELECT * FROM `users` WHERE `status` = '2' ORDER BY `name` ASC");
					$num = $result->num_rows;
				?>
				
					<style>
						.backUser{cursor: pointer;}
					</style>
					<div class = "Hide Close OpenListOfPupilsDiv2">
						<p class = "p">Кеткен оқушылар тізімі - <?=$num?></p>
						<table class="t2">
							<tr class="tr2">
								<th class="th2 th2f">№</th>
								<th class="th2 nameB">Аты-жөні</th>
								<th class="th2">Таңдау-пәні</th>
								<th class="th2">Телефон</th>
								<th class="th2">Кеткен күні</th>
								<th class="th2"></th>
							</tr>

							<?
								$td = "";
								$i = 1;
								while(($row = $result->fetch_assoc()) != false){
									if($i == $num) $td = "td2l";
									$subjectName = $mysqli->query("SELECT `name` FROM `subjects` WHERE `id` = '".$row['subject']."'")->fetch_assoc();
									$class = "";
									if($i % 2 == 1) $class = "second";
									echo '<tr class="tr2">
											<td class="td2 td2f '.$td. " " . $class.'">
												'.$i.'
											</td>
											<td class="td2 '.$td. " " . $class.'">
												<p class = "userName3" id = "'.$row['id'].'">'.$row['name'].'</p>
											</td>
											<td class="td2 '.$td. " " . $class.'">
												<p>'.$subjectName["name"].'</p>
											</td>
											<td class="td2 '.$td. " " . $class.'">
												<p>'.$row['tel'].'</p>
											</td>
											<td class="td2 '.$td. " " . $class.'">
												<p>'.$row['dateout'].'</p>
											</td>
											<td><i class="fa fa-arrow-left backUser" aria-hidden="true" title="Оқушыны қайта кіргізу"  id = "'.$row['id'].'"></i></td>
										</tr>';
									$i++;
								}
								$mysqli->close();
							?>
						</table>
					</div>
		</div>
	</div>
</div>
</body>
</html>
	   

