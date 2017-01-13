<?
	session_start();
	include("db.php");
	date_default_timezone_set('Asia/Almaty'); 
	$bool = $_POST['bool'];
	// Include to profile$c = isset($c)?$c+1:1;
		if($bool == 0){
			$_SESSION["id"] = $_POST["id"];
			echo $_SESSION["id"];
		}
	// Include to worc with curator
		if($bool == -1){
			$_SESSION["groupId"] = $_POST["groupId"];
			echo $_SESSION["groupId"];
		}
	// Оқушы ID -ін іске қосу.
		if($bool == 1){
			$userId = $_POST['userId'];
			$result = $mysqli->query("SELECT `userId`, `status` FROM `users` WHERE `userId` = '".$userId."'")->fetch_assoc();
			if($result["userId"]){
				if($result["status"] == 1) echo 2;
				else echo 3;
			}
			else{
				$mysqli->query("INSERT INTO `users`( `name`, `tel`, `nameF`, `tel2`, `nameM`, `tel3`, `address`, `subject`, `userId`, `password`, `group`, `status`, `type`, `date`) VALUES('','','','','','','','','".$userId."','','','1','1','0000-00-00  00:00:00')");
				echo 1;
			}
			$mysqli->close();
		}
	// Жаңа топ ашу.
		else if($bool == 2){
			$nameGroup = $_POST['nameGroup'];
			$curatorId = $_POST["curatorId"];
			$num = $mysqli->query("SELECT * FROM `groups`")->num_rows + 1;
			$result = $mysqli->query("SELECT * FROM `groups` WHERE `name` = '".$nameGroup."'")->fetch_assoc();
			if($result){
				echo 0;
			} else {
				$mysqli->query("INSERT INTO `groups` (`name`, `curatorId`, `date`) VALUES ('".$nameGroup."', '".$curatorId."', '".date("Y:m:d")."')");
				echo 1;
			}
			$mysqli->close();
		}
	// Оқушыны топқа қосу / Оқушының тобын ауыстыру. 
		else if($bool == 3){
			$userIds = explode(" ", $_POST["userIds"]);
			$num = count($userIds) - 1;
			$groupsId = $_POST["groupsId"];
			$names = "";
			$c = ":";
			for($i = 0; $i < $num; $i++){
				$result = $mysqli->query("SELECT * FROM `users` WHERE `id` = '".$userIds[$i]."' AND `status` = '0' AND `who` = '1'")->fetch_assoc();
				$result2 = $mysqli->query("SELECT * FROM `users` WHERE `id` = '".$userIds[$i]."' AND `who` = '1'")->fetch_assoc();
				if($result){
					$result3 = $mysqli->query("SELECT `group` FROM `users` WHERE `id` = '".$userIds[$i]."'")->fetch_assoc();
					$s = "";
					if($result3["group"] == 0) $s = "`joinToGroup` = '1', ";
					$mysqli->query("UPDATE `users` SET ".$s." `group` = '".$groupsId."' WHERE 	`id` = '".$userIds[$i]."'");
				} else {
					if($i + 1 == $num) $c = "";
					$names = $names . $result2["name"] . $c;
				}
			}
			echo $names;
			$mysqli->close();
		}
	// топты өшіру.
		else if($bool == 4){
			$groupsId = $_POST['groupsId'];
			$mysqli->query("DELETE FROM `groups` WHERE `id` = '".$groupsId."'");
			$mysqli->query("UPDATE `users` SET `group` = '0' WHERE `group` = '".$groupsId."'");
			$mysqli->query("UPDATE `groups` SET `id` = 'id' - 1 WHERE `id` > '".$groupsId."'");
			echo 1;
			$mysqli->close();
		}
	// Оқушы ID -ін өшіру.
		else if($bool == 5){
			$userIds = explode(" ", $_POST["userIds"]);
			$num = count($userIds) - 1;
			$names = "";
			$c = ":";
			for($i = 0; $i < $num; $i++){
				$result = $mysqli->query("SELECT * FROM `users` WHERE `id` = '".$userIds[$i]."' AND `status` = '3' AND `who` = '1'")->fetch_assoc();
				$result2 = $mysqli->query("SELECT * FROM `users` WHERE `id` = '".$userIds[$i]."' AND `who` = '1'")->fetch_assoc();
				if($result){
					$mysqli->query("UPDATE `users` SET `group` = '0', `status` = '2', `dateout` = '".date("Y:m:d")."' WHERE `id` = '".$userIds[$i]."'");
				} else {
					if($i + 1 == $num) $c = "";
					$names = $names . $result2["name"] . $c;
				}
			}
			echo $names;
			$mysqli->close();
		}
	// Оқушының таңдау пәнін өзгерту.
			
		else if($bool == 6){
			$userIds = explode(" ", $_POST["userIds"]);
			$num = count($userIds) - 1;
			$subjectId = $_POST['subjectId'];
			$names = "";
			$c = ":";
			// echo $userId . " " .$subjectId;
			for($i = 0; $i < $num; $i++){
				$result = $mysqli->query("SELECT * FROM `users` WHERE `id` = '".$userIds[$i]."' AND `status` = '0' AND `who` = '1'")->fetch_assoc();
				$result2 = $mysqli->query("SELECT * FROM `users` WHERE `id` = '".$userIds[$i]."' AND `who` = '1'")->fetch_assoc();
				if($result){
					$mysqli->query("UPDATE `users` SET `subject` = '".$subjectId."' WHERE `id` = '".$userIds[$i]."'");
				} else {
					if($i + 1 == $num) $c = "";
					$names = $names . $result2["name"] . $c;
				}
			}
			echo $names;
			$mysqli->close();
		}
	// Топтың кураторын ауыстыру.
		else if($bool == 7){
			$groupId = $_POST['groupId'];
			$curatorId = $_POST['curatorId'];
			$result = $mysqli->query("SELECT * FROM `groups` WHERE `id` = '".$groupId."'")->fetch_assoc();
			if($result["name"]){
				$mysqli->query("UPDATE `groups` SET `curatorId` = '".$curatorId."' WHERE `id` = '".$groupId."'");
				echo 1;
			}
			else{
				echo 0;
			}
			$mysqli->close();
		}
	// edit status of teacher.
		else if($bool == 8){
			$teacherId = $_POST['teacherId'];
			$status = $_POST['status'];
			$tel = $_POST['tel'];
			$mysqli->query("UPDATE `teacher` SET `tel` = '".$tel."', `status` = '".$status."' WHERE `id` = '".$teacherId."'");
			echo 1;
			$mysqli->close();
		}
	// Delete teacher.
		else if($bool == 9){
			$teacherId = $_POST['teacherId'];
			$mysqli->query("UPDATE `teacher` SET `type` = '2', `dateout` = '".date("Y:m:d")."' WHERE `id` = '".$teacherId."'");
			echo 1;
			$mysqli->close();
		}
	// Add teacher.
		else if($bool == 10){
			$name = $_POST['name'];
			$subject = $_POST['subject'];
			$tel = $_POST['tel'];
			$status = $_POST['status'];
			$mysqli->query("INSERT INTO `teacher`(`name`, `subject`, `tel`, `status`, `type`, `date`) VALUES ('".$name."', '".$subject."', '".$tel."', '".$status."', '1', '".date("Y:m:d - H:i:s")."')");
			echo 1;
			$mysqli->close();
		}
	// edit user info.
		else if($bool == 11){
			$userId = $_POST['userId'];
			$info = $_POST['info'];
			$id = $_POST['id'];
			$m = array('name', 'tel', 'school','nameF', 'tel2', 'nameM', 'tel3', 'address');
			$s = $m[$id - 1];
			$mysqli->query("UPDATE `users` SET `".$s."` = '".$info."' WHERE `id` = '".$userId."'");
			echo 1;
			$mysqli->close();
		}
	// Баға қою.
		else if($bool == 12){
			$groupId = $_POST['groupId'];
			$topic = $_POST['topic'];
			$message = $_POST['message'];
			$allResult = date("d-m") . ":" .$message. ":" .$topic . ":" . $_POST['allResults'];
			$mysqli->query("UPDATE `groups` SET `results` = '".$allResult."', `status` = '1' WHERE `id` = '".$groupId."'");
			$wam = $mysqli->query("SELECT * FROM `weekandmonth` WHERE `groupId` = '".$groupId."'")->fetch_assoc();
			if($wam){
				$text = $wam["text"] . "|" . $allResult;
				$mysqli->query("UPDATE `weekandmonth` SET `text` = '".$text."' WHERE `groupId` = '".$groupId."'");
			} else {
				$g = $mysqli->query("SELECT * FROM `groups` WHERE `id` = '".$groupId."'")->fetch_assoc();
				$c = $mysqli->query("SELECT * FROM `curator` WHERE `id` = '".$g["curatorId"]."'")->fetch_assoc();
				$mysqli->query("INSERT INTO `weekandmonth`( `groupId`, `text`, `curator`) VALUES ('".$groupId."','".$allResult."','".$c["name"]."')");
			}
			
			$m = explode(":", $allResult);
			// echo json_encode($m);
			$q = array_shift($m);
			$w = array_shift($m);
			$e = array_shift($m);
			foreach ($m as $key => $value) {
				$n = explode(" ", $value);
				$userId = 0 + $n[0];
				$result = $mysqli->query("SELECT `results` FROM `users` WHERE `id` = '".$userId."' AND `status` = '0'")->fetch_assoc();
				$totalOf100 = $n[6];
				$totalOf125 = $n[7];
				$c = "";
				if($result["results"] != false) $c = ":";
				$bal = $result["results"]. $c.date("d-m") . ";" .$topic . ";" .$totalOf100 . " " . $totalOf125;
				$mysqli->query("UPDATE `users` SET `results` = '".$bal."' WHERE `id` = '".$userId."'");
			}
			echo 1;
			$mysqli->close();
		}
	// Delete post.
		else if($bool == 13){
			$groupId = $_POST['groupId'];
			$mysqli->query("UPDATE `groups` SET `status` = '0' WHERE `id` = '".$groupId."'");
			echo 1;
			$mysqli->close();
		}
	// add Curator
		else if($bool == 14){
			$name = $_POST['name'];
			$tel = explode(":", $_POST['tel']);
			$tel1 = $tel[0];
			$tel2 = $tel[1];
			$mysqli->query("INSERT INTO `curator`(`name`, `tel1`, `tel2`) VALUES ('".$name."', '".$tel1."', '".$tel2."')");
			echo 1;
			$mysqli->close();
		}
	// edit tels curator.
		else if($bool == 15){
			$curatorId = $_POST['curatorId'];
			$tel1 = $_POST['tel1'];
			$tel2 = $_POST['tel2'];
			$mysqli->query("UPDATE `curator` SET `tel1` = '".$tel1."', `tel2` = '".$tel2."' WHERE `id` = '".$curatorId."'");
			echo 1;
			$mysqli->close();
		}
	// Delete curator.
		else if($bool == 16){
			$curatorId = $_POST['id'];
			$mysqli->query("UPDATE `curator` SET `status` = '0' WHERE `id` = '".$curatorId."'");
			echo 1;
			$mysqli->close();
		}
	// add assistant
		else if($bool == 17){
			$name = $_POST['name'];
			$curator = $_POST['curator'];
			$mysqli->query("INSERT INTO `assistants`(`name`, `curator`) VALUES ('".$name."', '".$curator."')");
			echo 1;
			$mysqli->close();
		}
	// Delete assistant.
		else if($bool == 18){
			$assistantId = $_POST['assistantId'];
			$mysqli->query("UPDATE `assistants` SET `status` = '0' WHERE `id` = '".$assistantId."'");
			echo 1;
			$mysqli->close();
		}
	// edit tels curator.
		else if($bool == 19){
			$assistantId = $_POST['assistantId'];
			$curator = $_POST['curator'];
			$mysqli->query("UPDATE `assistants` SET `curator` = '".$curator."' WHERE `id` = '".$assistantId."'");
			echo 1;
			$mysqli->close();
		}
	// Search.
		else if($bool == 20){
			$text = $_POST['text'];
			$result = $mysqli->query("SELECT `id`, `name`,`subject`,`tel`,`userId`,`tel2`,`tel3`,`group`, `money`,`datesPaid`, `pay`, `paid` FROM `users` WHERE `name` LIKE '%".$text."%' AND `who` = '1' AND `joinToGroup` = '0' AND `status` = '0'");
			$m = array();
			$i = 0;
			while(($row = $result->fetch_assoc()) != false){
				$s = $row["subject"];
				$g = $row["group"];
				$subject = $mysqli->query("SELECT `name` FROM `subjects` WHERE `id` ='".$s."'")->fetch_assoc();
				$group = $mysqli->query("SELECT `name` FROM `groups` WHERE `id` ='".$g."'")->fetch_assoc();
				$row["subject"] = $subject["name"];
				$row["group"] = $group["name"];
				$m[$i] = $row;
				$i++;
			}
			echo json_encode($m);
			$mysqli->close();
		}
	
	// dates paid
		else if($bool == 201){
			$userId = $_POST['userId'];
			$result = $mysqli->query("SELECT `id`, `name`,`subject`,`tel`,`userId`,`tel2`,`tel3`,`group`, `money`,`datesPaid`, `pay`, `paid`, `30` FROM `users` WHERE `id`  = '".$userId."'  AND `who` = '1'");
			$m = array();
			$i = 0;
			while(($row = $result->fetch_assoc()) != false){
				$s = $row["subject"];
				$g = $row["group"];
				$subject = $mysqli->query("SELECT `name` FROM `subjects` WHERE `id` ='".$s."'")->fetch_assoc();
				$group = $mysqli->query("SELECT `name` FROM `groups` WHERE `id` ='".$g."'")->fetch_assoc();
				$row["subject"] = $subject["name"];
				$row["group"] = $group["name"];
				$m[$i] = $row;
				$i++;
			}
			echo json_encode($m);
			$mysqli->close();
		}
	// Search with shcool
		else if($bool == 202){
			$school = $_POST['school'];
			$result = $mysqli->query("SELECT `id`, `name`,`subject`,`tel`,`userId`,`tel2`,`tel3`,`group`, `money`,`datesPaid`, `pay`, `paid` FROM `users` WHERE `school` = '".$school."' AND `status` = '0' AND `who` = '1' AND `joinToGroup` = '0'");
			$m = array();
			$i = 0;
			while(($row = $result->fetch_assoc()) != false){
				$s = $row["subject"];
				$g = $row["group"];
				$subject = $mysqli->query("SELECT `name` FROM `subjects` WHERE `id` ='".$s."'")->fetch_assoc();
				$group = $mysqli->query("SELECT `name` FROM `groups` WHERE `id` ='".$g."'")->fetch_assoc();
				$row["subject"] = $subject["name"];
				$row["group"] = $group["name"];
				$m[$i] = $row;
				$i++;
			}
			echo json_encode($m);
			$mysqli->close();
		}
	// add to list delete.
		else if($bool == 21){
			$userId = $_POST['userId'];
			// Клмеу себебі
			if($_POST['bool2'] == 1) {
				$text = $_POST['text'];
				$result = $mysqli->query("SELECT `causeText` FROM `users` WHERE `id` ='".$userId."'")->fetch_assoc();
				$Text = $result["causeText"];
				if(!empty($result["causeText"])) $Text = $Text . ":";
				$Text = $Text . date("d-m-Y") . ";" . $text;
				$mysqli->query("UPDATE `users` SET `waslate` = '".date("d")."',`causeStatus` = '1', `causeText` = '".$Text."' WHERE `id` = '".$userId."'");
			}
			// оқудан шығатындар тізіміне қосу
			else if( $_POST['bool2'] == 2) $mysqli->query("UPDATE `users` SET `status` = '3' WHERE `id` = '".$userId."'");
			echo 1;
			$mysqli->close();
		}
	// get info about cause.
		else if($bool == 22){
			$text = $_POST['text'];
			$result = $mysqli->query("SELECT `id`, `name`,`causeText` FROM `users` WHERE `name` LIKE '%".$text."%' AND `status` = '0' AND `who` = '1' AND `causeStatus` = '1'");
			if($result->num_rows != 0){
				$row = $result->fetch_assoc();
				$id = $row['id'];
				$name = $row['name'];
				$causeText = $row['causeText'];
				$m = array($id ,$name ,$causeText);
				echo json_encode($m);
			} else {
				$m = array();
				echo json_encode($m);
			}
			$mysqli->close();
		}
	// Барлық бағалар және смс тер
        else if($bool == 23){
			$groups = $mysqli->query("SELECT * FROM `groups` WHERE `id` = '".$_SESSION["groupId"]."'")->fetch_assoc();
			$massive = array();
			if($groups["status"] != 0){
				$results = explode(":", $groups["results"]);
				$results[] = $_SESSION["groupId"];
				$massive[0] = $results;
				$i = 1;
				$j = 1;
				$result = $mysqli->query("SELECT * FROM `users` WHERE `type` = '1' AND `group` = '".$_SESSION["groupId"]."' ORDER BY `name` ASC");
				while(($row = $result->fetch_assoc()) != false){
					for($i = 3; $i < count($results); $i++){
						$n = explode(" ", $results[$i]);
						$uId = $n[0] + 0;
						$kl = $n[1];
						$m = $n[2];
						$h = $n[3];
						$rl = $n[4];
						$sub5 = $n[5];
						$total100 = 0 + $kl + $m + $h + $rl;
						$total125 = 0 + $kl + $m + $h + $rl + $sub5;
						$subjectName = $mysqli->query("SELECT `name` FROM `subjects` WHERE `id` = '".$row['subject']."'")->fetch_assoc();
						$subject = $subjectName["name"];
						$id = ($row['id'] + 0) == $uId;
						$name = $row['name'];
						$status = ($row['status'] + 0) == 0;
						$c = array($kl,$m,$h,$rl,$sub5,$total100,$total125,$subject,$row['id'],$name);

						// $c = array($name,$uId,$id,$status);$massive[$i] = $c;$i++;
						if($id && $status){
							$massive[$j] = $c;	
							$j++;
						}
						// $i++;
						}
						
					
				}
			}

				$groups = $mysqli->query("SELECT * FROM `groups` WHERE `id` = '".$_SESSION["groupId"]."'")->fetch_assoc();
				$result = $mysqli->query("SELECT `who` FROM `users` WHERE `id` = '".$_SESSION["user_id"]."' AND `status` = '0'")->fetch_assoc();
				$massive[] = $groups["name"];
				$massive[] = $result["who"];
				echo json_encode($massive);
				$mysqli->close();
		}// get info for profile
        else if($bool == 24){
	        if(isset($_POST["id"])) $_SESSION["id"] = $_POST["id"];
			$m = array("ID -i","Номері:", "Мектебі:","Таңдау пәні:", "Группасы:","Кураторы:","Әкесінің аты:","Әкесінің номері:","Анасының аты:","Анасының номері:", "Мекен-жайы:","Тіркелген күні:");
			$result = $mysqli->query("SELECT * FROM `users` WHERE `id` = '".$_SESSION["id"]."'")->fetch_assoc();

			$userId = $result["userId"];
			$tel = $result["tel"];
			$schoolId = $result["school"];
			$subject = $result["subject"];
			$group = $result["group"];
			$s = $mysqli->query("SELECT * FROM `subjects` WHERE `id` = '".$subject."'")->fetch_assoc();
			$g = $mysqli->query("SELECT * FROM `groups` WHERE `id` = '".$group."'")->fetch_assoc();
			$c = $mysqli->query("SELECT * FROM `curator` WHERE `id` = '".$g["curatorId"]."'")->fetch_assoc();
			$school  = $mysqli->query("SELECT * FROM `schools` WHERE `id` = '".$schoolId."'")->fetch_assoc();
			$audan = $mysqli->query("SELECT * FROM `audan` WHERE `id` = '".$school["audan"]."'")->fetch_assoc();
			$nameF = $result["nameF"];
			$tel2 = $result["tel2"];
			$nameM = $result["nameM"];
			$tel3 = $result["tel3"];
			$address = $result["address"];
			$date = $result["date"];
			$name = $result["name"];
			$avatar = $result["avatar"];
			$n = array($userId,$tel,$audan["name"] . " - " . $school["name"],$s["name"], $g["name"], $c["name"],$nameF, $tel2, $nameM, $tel3, $address, $date);
			//  for edit
				$m2 = array("Аты-жөні:","Номері:", "Мектебі:","Әкесінің аты:","Әкесінің номері:","Анасының аты:","Анасының номері:", "Мекен-жайы:");
				$result = $mysqli->query("SELECT * FROM `users` WHERE `id` = '".$_SESSION["id"]."'")->fetch_assoc();
				$name = $result["name"];
				$tel = $result["tel"];
				$school = $result["school"];
				$nameF = $result["nameF"];
				$tel2 = $result["tel2"];
				$nameM = $result["nameM"];
				$tel3 = $result["tel3"];
				$address = $result["address"];
				$id = $result["id"];
				$results = explode(":",$result["results"]);
				$_SESSION["name_avatar"] = $id;
				$s = $mysqli->query("SELECT * FROM `subjects` WHERE `id` = '".$subject."'")->fetch_assoc();
				$g = $mysqli->query("SELECT * FROM `groups` WHERE `id` = '".$group."'")->fetch_assoc();
				$c = $mysqli->query("SELECT * FROM `curator` WHERE `id` = '".$g["curatorId"]."'")->fetch_assoc();
				$n2 = array($name,$tel,$school,$nameF, $tel2, $nameM, $tel3, $address);

				$bool = 0;
				$result = $mysqli->query("SELECT `who`,`curator` FROM `users` WHERE `id` = '".$_SESSION['user_id']."' AND `status` = '0'")->fetch_assoc();
				if($result["who"] == 2 && $result["curator"] == $c["id"]) $bool = 1;

			$allinfo = array($name,$m,$n,$avatar,$m2,$n2, $bool,$id,$results );
			echo json_encode($allinfo);
		}
		// get user name for check
			else if($bool == 25){
				$ids = explode(" ", $_POST['ids']);
				$num = count($ids) - 1;
				$m = array();
				for($i = 0; $i < $num; $i++){
					$id = 0 + $ids[$i];
					$result = $mysqli->query("SELECT `name` FROM `users` WHERE `id` = '".$id."' AND `who` = '1'")->fetch_assoc();
					$m[$i] = $result['name'];
				}
				echo json_encode($m);
				$mysqli->close();
			}
		// Топ жайлы статистика
	        else if($bool == 26){
	        	if(isset($_POST["groupId"])) $_SESSION["groupId"] = $_POST["groupId"];
				$massive = array();
				$result = $mysqli->query("SELECT * FROM `weekandmonth` WHERE `groupId` = '".$_SESSION["groupId"]."'")->fetch_assoc();
				if($result["text"] != false) $massive[] = $result["text"];
				$groups = $mysqli->query("SELECT * FROM `groups` WHERE `id` = '".$_SESSION["groupId"]."'")->fetch_assoc();
				$c = $mysqli->query("SELECT `name` FROM `curator` WHERE `id` = '".$groups["curatorId"]."'")->fetch_assoc();
				$massive[] = $groups["name"];
				$massive[] = $c["name"];
				$massive[] = $groups["date"];
				echo json_encode($massive);
				$mysqli->close();
			}
		// Куратор жайлы статистика
	        else if($bool == 261){
	        	$curatorId = $_POST["curatorId"];
				$results = array();
				$result = $mysqli->query("SELECT * FROM `groups` WHERE `curatorId` = '".$curatorId."'");
				$result2 = $mysqli->query("SELECT * FROM `weekandmonth` WHERE `groupId` = '".$row["id"]."'")->fetch_assoc();
				$one = explode("|",  $result2["text"]);
				$index = count($one);
				while(($row = $result->fetch_assoc()) != false){
					$massive = array();
					$result2 = $mysqli->query("SELECT * FROM `weekandmonth` WHERE `groupId` = '".$row["id"]."'")->fetch_assoc();
					$one = explode("|",  $result2["text"]);
					if($one[0] != false){ if($index > count($one)) $index = count($one);}
					if($result2["text"] != false) {
						$massive[] = $result2["text"];
						$c = $mysqli->query("SELECT `name` FROM `curator` WHERE `id` = '".$curatorId."'")->fetch_assoc();
						// $massive[] = $c["name"];
						$results[] = $massive;
					}
				}
				if($index != 0){
					$massive = array();
					for($i = 0; $i < count($results); $i++){
						$massive2 = array();
						$test = explode("|", $results[$i][0]);
						for($j = 0; $j < count($test); $j++){
							$massive2[$j] = $test[$j];
						}
						$massive[$i] = $massive2;
					}
				}
				echo json_encode($massive);
				$mysqli->close();
			}
		// Активировать месятц accounter
	        else if($bool == 27){
	        	$monthId = $_POST["monthId"];
	        	$number = (int)cal_days_in_month(CAL_GREGORIAN, $monthId, date("Y"));
	        	$mysqli->query("UPDATE `months` SET `active` = '0'");
	        	$mysqli->query("UPDATE `months` SET `status` = '1', `active` = '1',`days` = '".$number."' WHERE `id` = '".$monthId."'");
				$result = $mysqli->query("SELECT `id`,`money`,`pay`,`paid`,`debt`,`datesPaid` FROM `users` WHERE `who` = '1'");
				while(($row = $result->fetch_assoc()) != false){
					$money = $row["money"];
					$pay = $row["pay"];
					$paid = $row["paid"];
					$debt = $row["debt"];
					$r = "(";
					if ($row["datesPaid"] != false) $r = ")(";
					$datesPaid = $row["datesPaid"]. $r . $monthId . ":" . $money. ":" . $pay . ":" . $paid;
					$mysqli->query("UPDATE `users` SET `datesPaid` = '".$datesPaid."' WHERE `id` = '".$row["id"]."'");
				}
	        	echo 1;
				$mysqli->close();
			}
		
		
		// Активировать месятц Bilim
	        else if($bool == 271){
	        	$monthId = $_POST["monthId"];
	        	$number = (int)cal_days_in_month(CAL_GREGORIAN, $monthId, date("Y"));
	        	$mysqli->query("UPDATE `months` SET `active2` = '0'");
	        	$mysqli->query("UPDATE `months` SET `status2` = '1', `active2` = '1',`days` = '".$number."' WHERE `id` = '".$monthId."'");
				$result = $mysqli->query("SELECT * FROM `curator` WHERE `status` = '1'");
				while(($row = $result->fetch_assoc()) != false){
					$r = "(";
					if ($row["datesIns"] != false) $r = ")(";
					$datesIns = $row["datesIns"]. $r . $monthId ;
					$mysqli->query("UPDATE `curator` SET `datesIns` = '".$datesIns."' WHERE `id` = '".$row["id"]."'");
				}
	        	echo 1;
				$mysqli->close();
			}
		// get all groups one curator
	        else if($bool == 283){
	        	$curatorId = $_POST["curatorId"];
				$results = array();
				$result = $mysqli->query("SELECT `id`, `name`, `bal`, `curatorId`, `dayOfWeek` FROM `groups` WHERE `curatorId` = '".$curatorId."'  ORDER BY `name` ASC");
				while(($row = $result->fetch_assoc()) != false){
					$b = false;
					$daysOfweek = explode(":", $row["dayOfWeek"]);
					for($i = 0; $i < count($daysOfweek); $i++){
						if((int)$daysOfweek[$i] == (int)date("N")) {$b = true; break;}
					}
					if($b) 	$results[] = $row;
				}
				echo json_encode($results);
				$mysqli->close();
			}
		// Журнал балын қою Bilim group
	        else if($bool == 282){
	        	$text = $_POST["text"];
	        	$groupId = $_POST["groupId"];
				$result = $mysqli->query("UPDATE `groups` SET `bal` = '".$text."' WHERE `id` = '".$groupId."'");
				$mysqli->close();
			}
		// Журнал балын қою Bilim curator
	        else if($bool == 281){
	        	$bals = $_POST["bals"];
	        	$curatorId = $_POST["curatorId"];
	        	$day = date("d");
				$result = $mysqli->query("SELECT `id` FROM `months` WHERE `active2` = '1'")->fetch_assoc();
				$activeMonth = (int)$result["id"];
				$month2 = $activeMonth + "";
				$day2 = $day + "";
				if (strlen($month) == 1) $month2 = "0".$month2;
				if (strlen($day2) == 1) $day2 = "0".$day2;
				if(strlen($activeMonth["id"]) == 1) $activeMonth["id"] = "0" . $activeMonth["id"];
				$i = 0;
				$result = $mysqli->query("SELECT `id`, `name` FROM `groups` WHERE `dayOfWeek` = '".date("N")."' AND `curatorId` = '".$curatorId."'");
				$num = $result->num_rows;
				$groups = "";
				while(($row = $result->fetch_assoc()) != false){
					$coma = "";
					if($i != 0) $coma = ", ";
					$groups = $groups . $coma . $row["name"];
					
					$mysqli->query("UPDATE `groups` SET `bal`= '' WHERE `id` = '".$row["id"]."'");
					$i++;
				}
				$pay = $activeMonth . ":" . $day .":". $bals;
				$result = $mysqli->query("SELECT `datesIns` FROM `curator` WHERE `id` = '".$curatorId."'")->fetch_assoc();
				$m = explode(")",$result["datesIns"]);
				for($i = 0; $i < count($m); $i++){
					$n = explode("(", $m[$i]);
					$c = "";
					if($activeMonth == (int)$n[1]){
						if($n[0] != false) $c = ";";
						$n[0] = $n[0] . $c . $month2 . ":" . $day2 . ":" . $bals . "]" . $groups;
						$m[$i] = $n[0] . "(" . $n[1];
						break;
					}
				}
				$c = "";
				$datesIns = "";
				for($i = 0; $i < count($m); $i++){
					if($i != 0) $c = ")";
					$datesIns = $datesIns . $c . $m[$i];
				}
				$result = $mysqli->query("UPDATE `curator` SET `datesIns` = '".$datesIns."' WHERE `id` = '".$curatorId."'");
				echo 1;
				$mysqli->close();
			}
		// Оқушыларға мұғалім тағайындау
	        else if($bool == 29){
	        	$subject = (int)$_POST["subject"] - 1;
	        	$teacher = $_POST["teacher"];
	        	$result = $mysqli->query("SELECT `name` FROM `teacher` WHERE `id` = '".$teacher."'")->fetch_assoc();
	        	$m = array('Қ. тілі', 'Матем', 'Тарих', 'О. тілі');
	        	$text = $m[$subject].":" . $result["name"];
	        	$m = array('kazakhL', 'math', 'history', 'russinL');
	        	$mysqli->query("UPDATE `groups` SET `".$m[$subject]."` = '".$text."' WHERE `id` = '".$_SESSION["groupId"]."'");
	        	echo 1;
				$mysqli->close();
			}			
		// Мұғалімдер
	        else if($bool == 30){
	        	if(isset($_POST["bool2"]) && $_POST["bool2"] == 1){
					$m = array();
		        	$result = $mysqli->query("SELECT `name`, `date` FROM `groups` WHERE `curatorId` = '".$_POST["curatorId"]."'");
		        	while(($row = $result->fetch_assoc())){
		        		$m[] = $row;
		        	}

	        	}else {
		        	$result = $mysqli->query("SELECT * FROM `groups` WHERE `id` = '".$_POST["groupId"]."'")->fetch_assoc();
					$kl = explode(":", $result["kazakhL"]);
					$math = explode(":", $result["math"]);
					$h = explode(":", $result["history"]);
					$rl = explode(":", $result["russinL"]);
					$m = array($kl,$math,$h,$rl);
				}
				echo json_encode($m);
				$mysqli->close();
			}
			// Оплата жасау
	        else if($bool == 31){
	        	$month = $_POST["month"];
	        	$month2 = $month + "";
	        	if (strlen($month) == 1) $month2 = "0".$month2;
	        	$day = date("d");
	        	// $day = 25;
				$money = (int)$_POST["money"];
				$userId = $_POST["userId"];
				$boll2 = $_POST["boll2"];
				if($boll2 == 1){
					$activeMonth = $mysqli->query("SELECT * FROM `months` WHERE `active` = '1'")->fetch_assoc();
					$activeMonth["id"] = $activeMonth["id"] . "";
					if(strlen($activeMonth["id"]) == 1) $activeMonth["id"] = "0" . $activeMonth["id"];
					$pay = $activeMonth["id"] . ":" . $day .":". $money;
					$result = $mysqli->query("SELECT `datesPaid`,`paid` FROM `users` WHERE `id` = '".$userId."'")->fetch_assoc();
					$paid = $result["paid"] + $money;
					$m = explode(")",$result["datesPaid"]);
					$n = explode("(",$m[0]);
					$dayPaid = "";
					$s = "";
					$len = count($m);
					$index = $len;
					for($i = 0; $i < $len; $i++){
						$mDay = explode("(",$m[$i]);
						$mDay = explode(":", $mDay[1]);
						$mDay = (int)$mDay[0];
						if($mDay == $month){
							$index = $i;
							break;
						}
					}
					$n = explode("(",$m[$index]);
					$moneys = explode(":",$n[1]); 
					$paid = (int)$moneys[3];
					$payMoney = explode(":",$pay); 
					$paying = (int)$payMoney[2];
				    $moneys = $moneys[0] . ":" . $moneys[1] . ":" . $moneys[2] . ":" . ($paying + $paid);
				    $lastPaid = explode(";", $n[0]);
				    $lastPaid  = explode(":", $lastPaid[count($lastPaid) - 1]);
				    $co = ";";
				    if($n[0] == false) $co = "";
				    if((int)$lastPaid[0] == (int)$payMoney[0] && (int)$lastPaid[1] == (int)$payMoney[1]){
				        $n[0] = $lastPaid[0] . ":" . $lastPaid[1] . ":" . ((int)$lastPaid[2] + (int)$payMoney[2]);
				        $pay = "";
				        $co = "";
				    }
					if($index != $len) $m[$index] = $n[0] . $co . $pay . "(" . $moneys;
					else $m[$index] = $pay;
					for($i = 0; $i < count($m); $i++){
						if($i != 0) $s = ")";
						$dayPaid = $dayPaid . $s .$m[$i];
					}
					$result = $mysqli->query("UPDATE `users` SET `datesPaid` = '".$dayPaid."' WHERE `id` = '".$userId."'");
				} else {
					$activeMonth = $mysqli->query("SELECT * FROM `months` WHERE `active` = '1'")->fetch_assoc();
					$activeMonth["id"] = $activeMonth["id"] . "";
					if(strlen($activeMonth["id"]) == 1) $activeMonth["id"] = "0" . $activeMonth["id"];
					$result = $mysqli->query("SELECT `30` FROM `users` WHERE `id` = '".$userId."'")->fetch_assoc();
					$s = "";
					if(strlen($result["30"]) > 3) $s = ")";
					$pay = $result["30"] . $s . $month2 . "(" . $activeMonth["id"] . ":" . $day .":". $money;
					
					$result = $mysqli->query("UPDATE `users` SET `30` = '".$pay."' WHERE `id` = '".$userId."'");
				}
				echo 1;
				$mysqli->close();
			}

	// Search Есеп бөлімі.
		else if($bool == 32){
			$text = $_POST['text'];
			$result = $mysqli->query("SELECT `id` FROM `users` WHERE `name` LIKE '%".$text."%' AND `who` = '1'")->fetch_assoc();
			echo $result["id"];
			$mysqli->close();
		}
	// get info of bals for profile1
        else if($bool == 33){
			$user_id = $_POST['user_id'];
			$result = $mysqli->query("SELECT * FROM `users` WHERE `id` = '".$user_id."'")->fetch_assoc();
			$results = explode(":",$result["results"]);
			echo json_encode($results);
			$mysqli->close();
		}
	// Дпо доход и расходы
        else if($bool == 34){
			$money = $_POST['money'];
			$text = $_POST['text'];
			$day = (int)date("d");
			$month = (int)date("m");
			$year = (int)date("Y");
			$result = $mysqli->query("SELECT * FROM `months` WHERE `active` = '1'")->fetch_assoc();
			$result1 = explode(":", $result['extraMoney']);
			if($_POST['bool2'] == 1){
				$extraMoney = $result1[0];
				$massive = explode(")", $extraMoney); 
				$index = -1;
				for($i = 0; $i < count($massive); $i++){
					$date = explode("(", $massive[$i]); 
					$date = explode(".", $date[1]);
					$day2 = (int)$date[0];
					$month2 = (int)$date[1];
					$year2 = (int)$date[2];
					if($day2 == $day && $month2 == $month && $year2 == $year) $index  = $i;
				}
				if($index != -1){
					$s = "";
					$m = explode("(", $massive[$index]); 
					if($m[0] != false) $s = ";";
					$m[0] = $m[0] . $s .  $money . "|". $text;
					$massive[$index] = $m[0] . "(" . $m[1];
					$extraMoney = "";
					$s = "";
					for($i = 0; $i < count($massive); $i++){
						if($i != 0) $s = ")";
						$extraMoney = $extraMoney . $s . $massive[$i];
					}
					$extraMoney = $extraMoney . ":" . $result1[1];
				} else {
					$s = ")";
					if($extraMoney == false) $s = "";
					$extraMoney = $extraMoney . $s . $money . "|" . $text ."(" . date("d.m.Y") . ":" . $result1[1];
				}
			} else {
				$index = -1;
				$extraMoney = $result1[1];
				$massive = explode(")", $extraMoney); 
				for($i = 0; $i < count($massive); $i++){
					$date = explode("(", $massive[$i]); 
					$date = explode(".", $date[1]);
					$day2 = (int)$date[0];
					$month2 = (int)$date[1];
					$year2 = (int)$date[2];
					if($day2 == $day && $month2 == $month && $year2 == $year) $index  = $i;
				}
				// print_r($m);
				// echo $index . "<br>";
				if($index != -1){
					$s = "";
					$m = explode("(", $massive[$index]); 
					if($m[0] != false) $s = ";";
					$m[0] = $m[0] . $s .  $money . "|". $text;
					$massive[$index] = $m[0] . "(" . $m[1];
					$extraMoney = "";
					$s = "";
					for($i = 0; $i < count($massive); $i++){
						if($i != 0) $s = ")";
						$extraMoney = $extraMoney . $s . $massive[$i];
					}
					$extraMoney = $result1[0] .":" . $extraMoney;
				} else {
					$s = ")";
					if($extraMoney == false) $s = "";
					$extraMoney = $result1[0] .":" . $extraMoney . $s .  $money . "|" . $text ."(" . date("d.m.Y");
				}
			}
			echo 1;
			$mysqli->query("UPDATE `months` SET `extraMoney` = '".$extraMoney."' WHERE `active` = '1'");
			$mysqli->close();
		}
	// Скидка
        else if($bool == 35){
        	$userId = $_POST["userId"];
        	$money = $_POST["money"];
        	$pay = $_POST["pay"];
        	$result = $mysqli->query("SELECT `datesPaid` FROM `users` WHERE `id` = '".$userId."'")->fetch_assoc();
        	$months = $mysqli->query("SELECT `id` FROM `months` WHERE `active` = '1'")->fetch_assoc();
        	$month = $months['id'];
        	if($result['datesPaid'] == false){
        		if(strlen($month) == 1) $month = "0" . $month;
        		$m = '('.$month.':'.$money.':'.$money.':0';
   		     	$mysqli->query("UPDATE `users` SET `money` = '".$money."',`pay` = '".$pay."',`datesPaid` = '".$m."', `joinToGroup` = '0' WHERE `id` = '".$userId."'");
        	} else {
				$discount = explode(')', $result['datesPaid']);
				$index = -1;
				for($i = 0; $i < count($discount); $i++){
					$datePaid = explode('(', $discount[$i]);
					$m = explode(':', $datePaid[1]);
					$month = (int)$month;
					$month2 = (int)$m[0];
					if($month == $month2){
						$m[1] = $money;
						$m[2] = $pay;
						$index = $i;
						$results = $datePaid[0] . "(" . $m[0] . ":" . $m[1] . ":" . $m[2] . ":" . $m[3];
						$discount[$i] = $results;
						break;
					}
				}
				$s = '';
				$results = "";
				for($i = 0; $i < count($discount); $i++){
					if ($i != 0) $s =")";
					$results = $results . $s . $discount[$i] ;
				}
   		     	$mysqli->query("UPDATE `users` SET `money` = '".$money."',`pay` = '".$pay."',`datesPaid` = '".$results."', `joinToGroup` = '0' WHERE `id` = '".$userId."'");
			}
        	echo 1;
			$mysqli->close();
		}
	// доход пойск
        else if($bool == 36){
        	$month = (int)$_POST["month"];
        	$day = (int)$_POST["day"];
        	// $index = $_POST["index"];
			$months = $mysqli->query("SELECT * FROM `months` WHERE `id` = '".$month."'");
			$i = 1;
			$sPlus = "";
			$sMinus = "";
			// доход и расход
				while(($row = $months->fetch_assoc()) != false){
					$year = (int)date("Y");
					$extraMoney = explode(":", $row["extraMoney"]);
					$plus = $extraMoney[0];
					$plus = explode(")", $plus);

					$minus = $extraMoney[1];
					$minus = explode(")", $minus);
					$td = "";
					for($i = 0; $i < count($plus); $i++){
						$massive = explode("(", $plus[$i]);
						$date = explode(".", $massive[1]);
						$day2 = (int)$date[0];
						$month2 = (int)$date[1];
						$year2 = (int)$date[2];
						if($day2 == $day && $month2 == $month){
							$sPlus =  $massive[0];
						}
					}

					for($i = 0; $i < count($minus); $i++){
						$massive = explode("(", $minus[$i]);
						$date = explode(".", $massive[1]);
						$day2 = (int)$date[0];
						$month2 = (int)$date[1];
						$year2 = (int)$date[2];
						if($day2 == $day && $month2 == $month){
							$sMinus =  $massive[0];
						}
					}
				}
			// Сумма
				$months = $mysqli->query("SELECT * FROM `months` WHERE `id` = '".$month."'");
				$i = 1;
				while(($row = $months->fetch_assoc()) != false){
					$days = (int)$row["days"];
					$extraMoney = explode(":", $row["extraMoney"]);
					$totalGain = array();
					$Plus = array();
					$Minus = array();
					$money30 = array();
					for($i = 0; $i < 0 + $days; $i++){
						$totalGain[$i] = 0;
					}
					$r = $mysqli->query("SELECT * FROM `users` WHERE `who` = '1' AND `joinToGroup` != '1'");
					$datesP = array();
					$massive = array();
					while(($row2 = $r->fetch_assoc()) != false){
						$paid = $mysqli->query("SELECT `30`, `datesPaid` FROM `users` WHERE `id` = '".$row2["id"]."'")->fetch_assoc();

						if($paid['30'] != false) {
							$datesP = explode(")", $paid['30']);
							for($i = 0; $i < count($datesP); $i++){
								$data = explode("(", $datesP[$i]);
								$Mday = explode(":", $data[1]);
								if($month == (int)$Mday[0]) {
									$datesPaid = explode("(",$datesP[$i]);
									$money30[]  = $datesP[$i];
									break;
								}
							}
						}

						if($paid['datesPaid'] != false) {
							$datesP = explode(")", $paid['datesPaid']);
							for($i = 0; $i < count($datesP); $i++){
								$data = explode("(", $datesP[$i]);
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
						for($i = 0; $i < $days; $i++){
							$money = "";
							$Day = 0;
							$data = "";
							if(count($datesP) > 0){
								$m1 = explode(":", $massive[0]);
								$Month = (int)$m1[0];
								$Day = (int)$m1[1];
								$money = (int)$m1[2];
								if($i + 1 == $Day) {$data = $money;$n = array_shift($massive); $totalGain[$i] = $totalGain[$i] + $money; }
							}
						}
					}
				}
				
				$m = array($sPlus, $sMinus, $totalGain[$day - 1],$money30);
				echo json_encode($m);
				$mysqli->close();
		}
	// get all name of group
		 else if($bool == 37){
	    	$result = $mysqli->query("SELECT `name` FROM `users` WHERE `group` = '".$_POST["groupId"]."' AND `status` = '0' AND `who` = '1' ORDER BY `name` ASC");
	    	$m = array();
	    	while(($row = $result->fetch_assoc())){
	    		$m[] = $row["name"];
	    	}
			echo json_encode($m);
			$mysqli->close();
		}
	// Топтарға келетін күнін қою.
		 else if($bool == 38){
        	$ids = explode(" ", $_POST["ids"]);
        	$day = (int)$_POST["day"];
        	for($i = 0; $i < count($ids) - 1; $i++){
        		$id = $ids[$i];
        		$result = $mysqli->query("SELECT * FROM `groups`  WHERE `id` = '".$id."'")->fetch_assoc();
        		$mysqli->query("UPDATE `groups` SET `dayOfWeek` = '".$result["dayOfWeek"] . ":" . $day."' WHERE `id` = '".$id."'");
        	}
			echo 1;
			$mysqli->close();
		}
	// тесттер тізімі
		 else if($bool == 39){
        	$id = $_POST["id"];
        	$bool2 = $_POST["bool2"];
        	if($bool2 == 1) $mysqli->query("UPDATE `tests` SET `active` = '1' WHERE `id` = '".$id."'");
        	else $mysqli->query("UPDATE `tests` SET `active` = '0' WHERE `id` = '".$id."'");
			echo 1;
			$mysqli->close();
		}
	// change password
		 else if($bool == 40){
        	$oldPass = $_POST["oldPass"];
        	$newPass = $_POST["newPass"];
    		for($i = 0; $i < 10; $i++) {
    			$oldPass = md5($oldPass);
    			$newPass = md5($newPass);
    		}
    		$result = $mysqli->query("SELECT `password` FROM `users` WHERE `id` = '".$_SESSION["user_id"]."'")->fetch_assoc();
    		if($oldPass != $result['password']) echo 1;
    		else {$mysqli->query("UPDATE `users` SET `password` = '".$newPass."' WHERE `id` = '".$_SESSION["user_id"]."'"); echo 2;}
			$mysqli->close();
		}

	
	// edit-search.
		else if($bool == 42){
			$text = $_POST['text'];
			if((int)$_SESSION["type"] == 2){
				$result = $mysqli->query("SELECT `id`, `name`, `tel`, `nameF`, `tel2`, `nameM`, `tel3`, `address`, `school`, `subject`,  `group`, `contract` FROM `users` WHERE `name` LIKE '%".$text."%' AND `who` = '1'")->fetch_assoc();
				$curator = $mysqli->query("SELECT `curator` FROM `users` WHERE `id` = '".$_SESSION["user_id"]."'")->fetch_assoc();
				$group = $mysqli->query("SELECT `curatorId` FROM `groups` WHERE `id` = '".$result["group"]."'")->fetch_assoc();
				if($curator["curator"] == $group["curatorId"]) echo json_encode($result);
				else echo json_encode(array());
			}
			else {
				$result = $mysqli->query("SELECT `id`, `name`, `tel`, `nameF`, `tel2`, `nameM`, `tel3`, `address`, `school`, `subject`,  `group`, `contract` FROM `users` WHERE `name` LIKE '%".$text."%' AND `who` = '1'")->fetch_assoc();
				echo json_encode($result);
			}
			// $s = $result["subject"];
			// $g = $result["group"];
			// $sc = $result["school"];
			$mysqli->close();
		}
	// edit-search.
		else if($bool == 43){
			$edit_ids = explode("]",$_POST['edit_ids']);
			$id = $edit_ids[0];
			$name = $edit_ids[1]; 
			$tel = $edit_ids[2]; 
			$nameF = $edit_ids[3]; 
			$tel2 = $edit_ids[4];
			$nameM = $edit_ids[5];
			$tel3 = $edit_ids[6];
			$address = $edit_ids[7];
			$school = $edit_ids[8];
			$subject = $edit_ids[9];
			$group = $edit_ids[10];
			$contract = $edit_ids[11];
			$mysqli->query("UPDATE `users` SET `name` = '$name', `tel` = '$tel', `nameF` = '$nameF', `tel2` = '$tel2', `nameM` = '$nameM', `tel3` = '$tel3', `address` = '$address', `school` = '$school', `subject` = '$subject',  `group` = '$group', `contract` = '$contract'  WHERE `id` = '$id'");
			echo 1;
			$mysqli->close();
		}

?>
