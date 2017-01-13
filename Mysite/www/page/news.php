<?
echo head("Новости");
echo allInfo();
?>

<?
	$mysqli = connectToDb();
	if(isset($_POST["send"])){
		// егер сурет бар болса оны базага жібереміз
			if($_FILES["image"]){
				$image = $_FILES["image"];
				$imgName = time();
				$imgName =  addImg($image,"img/newsImage/",$imgName);
				// $type = substr($image["type"],6);
				// $size = $image["size"];
				// $tmp_name =  $image["tmp_name"];
				// // print_r($image);
				// $_SESSION["error"] = "";
				// if($type == "jpeg" || $type == "jpg" || $type == "png"){
					// $imgName = time();
					// move_uploaded_file($tmp_name, "img/newsImage/" . $imgName . "." . $type);
					// $imgName = $imgName . "." . $type;
	 			// }
	 			// else{
	 			// 	$imgName = "";
	 			// }
	 		}
			if(!empty($_POST["news"])){
				$name = $_SESSION['user_surname']." ".$_SESSION['user_name'];
				$new = htmlspecialchars($_POST['news']);
			 	$mysqli->query("INSERT INTO `news`( `new`, `name`,`image`, `time`) VALUES ('".$new."', '".$name."','".$imgName."', '".date('Y-m-d   H:i:s')."')");
				// echo (header("Location: ../page/news.php"));

			 }	
	}
?>
<div id = "mainNews" >
	<div id = "headerNews"><a href="writeNews.php">Новая запись</a></div>
		<div id = "bodyNews">
			<?
			$mysqli = new mysqli("localhost", "root", "", "users");
			$mysqli->query("SET NAMES 'utf8'");
				function printSql($r){
					while(($row = $r->fetch_assoc()) != false){
						$index = $row["id"];
						$message = $row["new"];
						$name = $row["name"];
						$time = $row["time"];
						$img = $row["image"];
						// Базада сурет бар болса шыгарамыз жок болса шыгармаймыз
							// if(!empty($img)) $img = "<img src = '../img/newsImage/".$img."'  id = 'imgNews' width = '260' height = 'auto'></img>";
							// else $img = "";
							$img = setImage($img,"img/newsImage/");
							$like = "0";//$row["like"];
							echo '<div class = "messages">
								<p id = "nameWriter" class = "pFromMessage">'.$name.'</p><p id = "time" class = "pFromMessage">'.$time.'</p><br>
								'.$img.'<br>
								<span id = "message">'.$message.'</span>

								</div>';
					}
				}
				$r = $mysqli->query("SELECT * FROM `news` ORDER BY `id` DESC");
				printSql($r);
				$mysqli->close();
				
			?>
		</div>
	<!-- <div  id = "footerNews"> -->
	</div>
</div>
<?
echo foot()
?>

