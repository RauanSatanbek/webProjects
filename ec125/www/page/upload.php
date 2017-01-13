<?php
	session_start();
	if(isset($_POST["bool"]) && $_POST["bool"] == 1){
		$_SESSION["key"] = 1;
	}
	$s = "";
	$c = "|";
	if(isset($_FILES['file']['name']) && count($_FILES['file']['name'])  != 0){
		foreach($_FILES['file']['name'] as $k=>$f) {
			if (!$_FILES['file']['error'][$k]) {
				if (is_uploaded_file($_FILES['file']['tmp_name'][$k])) {
					if(!move_uploaded_file($_FILES['file']['tmp_name'][$k], "../news/images/" . $_FILES['file']['name'][$k])) $s = $s . "";
					else {
						if(count($_FILES['file']['name']) - 1 == $k) $c = "";
						$s = $s . $_FILES['file']['name'][$k] . $c ;
					}
				}
			}	
		}
	}
	if(isset($_SESSION["key"]) && $_SESSION["key"] == 1){
		echo $s ;
		unset($_SESSION["key"]);
	}
?>