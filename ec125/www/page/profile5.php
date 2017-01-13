<?
	session_start();
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
    <link rel="stylesheet" href="../font-awesome-4.6.3/css/font-awesome.min.css">
	<script src="../Bootstrap3/js/bootstrap.js"></script>
	<link href="../Bootstrap3/css/bootstrap.css" rel="stylesheet">
</head>
<?
	include("db.php");
	include("functions.php");
	isLogin();
	profile5();
?>
<style>
	.s1{
		color: #fff;
	}
</style>
<body>
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
			<p class = "p workWithCurator getInfoAboutUserP"><i class="fa fa-search" aria-hidden="true"></i>  Оқушылар жайлы мәлімет алу</p>
			<p class = "p workWithCurator getInfoAboutUserP2"><i class="fa fa-clock-o" aria-hidden="true"></i> Кешіккен оқушылар</p>
			<p class = "p workWithCurator OpenListOfPupilsP"><i class="fa fa-user" aria-hidden="true"></i> Оқушылар</p>
			<p class = "p workWithCurator OpenListOfPupilsP2"><i class="fa fa-user" aria-hidden="true"></i> Кеткен оқушылар</p>
			<p class = "p workWithCurator todays_groups_p">Бүгін келетін топтар</p>
			<p class = "p workWithCurator changePasswordP"><i class="fa fa-exchange" aria-hidden="true"></i> Пороль өзгерту</p>
		</div>
		<script>
			$(document).ready(function(){
				
			});
		</script>
		<div class = "blockLeft">
			<div class = "Hide Close todays_groups_div">
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
									$s = $s . $row2["name"] . " - " . $number_p .  $coma;
								}
							}
							if($b){
								if($len == $n) $td = " td2l";
								echo '<tr class="tr2"><td class="td2 NumberTd td2f'.$td.'">'.$n.'</td>
								<td class="td2 nameCuratorTd'.$td.'"><p class = "curatorName'.$row["id"].'">'.$row["name"].'</p></td>
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
			<div class="Hide Close changePasswordDiv">
				<form class="form-inline">
					<input type="password" class = "form-control form-changePass" placeholder = "Старый пароль" id = "oldPass">  <span class="text-danger info info1">Lorem ipsum dolor sit.</span> <br><br>
					<input type="password" class = "form-control form-changePass" placeholder = "Новый пароль" id = "newPass"><br><br>
					<input type="password" class = "form-control form-changePass" placeholder = "Повторите пароль" id = "repeatPass">  <span class="text-danger info info2"></span><br><br>
					<button type="button" class = "btn btn-primary form-changePass" id = "changePassword">Изменить</button>
				</form>
			</div>
			<!-- Оқушылар тізімі -->
				<?
					$result = $mysqli->query("SELECT * FROM `users` WHERE `who` = '1' AND `status` = '0' ORDER BY `name` ASC");
					$num = $result->num_rows;
				?>
				<style>
					
				</style>
				
					<div class = "Hide getInfoAboutUserDiv Close">
						<p class = "p">Оқушылар жайлы мәлімет алу</p>
						<form class="inline">
							<input type="text" id = "search2" class = "form-control form-search" placeholder = "Поиск*">
						</form>
						<div class = "found2">
							<span class = "error error3"></span>
							<table class="t2" id = "found2">
								
							</table>
						</div>
						<div class = "Why">
							<table class="t2 tWhy">
							
							</table>
						</div>
					</div>
					<div class = "Hide getInfoAboutUserDiv2 Close">
						<p class = "p"> Оқушының кешіккен күндері жайлы ақпарат алу</p>
						<form class="inline">
							<input type="text" id = "search3" class = "form-control form-search" placeholder = "Поиск*">
							<i class="fa fa-search fa-search2" aria-hidden="true" title = "Найти"></i>
						</form>
						<div class = "found3">
							<span class = "error error4"></span>
							<table class="t2" id = "found3"></table>
							<!-- <form class="inline">
								<input type="button" id = "send" class = "btn btn-primary" value = "Есеп бөліміне жіберу">
							</form> -->
						</div>
							
									
							<?
								$text = $_POST['text'];
								$day = (int)date("d");
								$month = (int)date("m");
								$year = (int)date("Y");
								$result = $mysqli->query("SELECT `id`, `name`,`causeText` FROM `users` WHERE `waslate` = '".$day."' AND `status` = '0' AND `who` = '1'");
								$result2 = $mysqli->query("SELECT `id`, `name`,`causeText` FROM `users` WHERE `waslate` = '".$day."' AND `status` = '0' AND `who` = '1'")->fetch_assoc();
								$c = 1;
								$num = $result->num_rows;
								if($result2){
									echo ('<p class = "p">Бүгін кешіккен оқушылар</p>
										<table class="t2"><tr class="tr2"><th class="th2 th2f">№</th>
											<th class="th2 nameB">Аты-жөні</th>
											<th class="th2">Келмеу себебі</th>
											<th class="th2">Күні</th></tr>');
									while(($row1 = $result->fetch_assoc()) != false){
										$id = $row1['id'];
										$name = $row1['name'];
										$causeText = $row1['causeText'];
										$m = array($id ,$name ,$causeText);
										$id = $m[0];
										$name = $m[1];
										$text = explode(":", $m[2]);
										
										$td = "";
										$num2 = count($text);
										for($i = 0; $i < $num2; $i++){
											$row = explode(";", $text[$i]);
											$date =  explode("-", $row[0]);
											$day2 = (int)$date[0];
											$month2 = (int)$date[1];
											$year2 = (int)$date[2];
											if($day2 == $day && $month2 == $month && $year2 == $year){
												if($c == $num) $td = "td2l";
												echo ('<tr class="tr2"><td class="td2 td2f '.$td.'">'.$c.'</td>
													<td class="td2 tdName '.$td.'"><p class = "NameTeacher" id = "'.$id.'">'.$name.'</p></td>
													<td class="td2 '.$td.'"><p>'.$row[1].'</p></td><td class="td2 '.$td.'"><p>'.$row[0].'</p></td>
													</tr>');
											}
										}
										$c++;
									}
									echo '</table>';
								}
							?>
					</div>
				<!-- Оқушылар тізімі -->
				<?
					$result = $mysqli->query("SELECT * FROM `users` WHERE `who` = '1' AND `status` = '0' ORDER BY `name` ASC");
					$num = $result->num_rows;
				?>
					<div class = "Hide Close OpenListOfPupilsDiv">
					<p class = "p">Оқушылар тізімі - <?=$num?></p>
					<form  class="form-inline">
						<input type="search" id = "search" class = "form-control form-search" placeholder = "Поиск*">
					</form>
					<div class = "found">
						<span class = "error error2"></span>
						<table class="t2" id = "found">
							
						</table>
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
									echo '<tr class="tr2">
											<td class="td2 td2f '.$td.'">
												'.$i.'
											</td>
											<td class="td2 '.$td.' tdName">
												<p class = "userName3" id = "'.$row['id'].'">'.$row['name'].'</p>
											</td>
											<td class="td2 '.$td.'">
												'.$subjectName["name"].'
											</td>
											<td class="td2 '.$td.'">
												'.$row['tel'].'
											</td>
											<td class="td2 '.$td.'">
												'.$row['userId'].'
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
				
					<div class = "Hide Close OpenListOfPupilsDiv2">
						<p class = "p">Кеткен оқушылар тізімі - <?=$num?></p>
						<table class="t2">
							<tr class="tr2">
								<th class="th2 th2f">№</th>
								<th class="th2 nameB">Аты-жөні</th>
								<th class="th2">Таңдау-пәні</th>
								<th class="th2">Телефон</th>
								<th class="th2">Кеткен күні</th>
							</tr>
							<?
								$td = "";
								$i = 1;
								while(($row = $result->fetch_assoc()) != false){
									if($i == $num) $td = "td2l";
									$subjectName = $mysqli->query("SELECT `name` FROM `subjects` WHERE `id` = '".$row['subject']."'")->fetch_assoc();
									echo '<tr class="tr2">
											<td class="td2 td2f '.$td.'">
												'.$i.'
											</td>
											<td class="td2 '.$td.'">
												<p class = "userName3" id = "'.$row['id'].'">'.$row['name'].'</p>
											</td>
											<td class="td2 '.$td.'">
												'.$subjectName["name"].'
											</td>
											<td class="td2 '.$td.'">
												'.$row['tel'].'
											</td>
											<td class="td2 '.$td.'">
												'.$row['dateout'].'
											</td>
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
	   

