<?
	session_start();
	if(isset($_POST['send'])){
		$from = htmlspecialchars($_POST['from']);
		$to = htmlspecialchars($_POST['to']);
		$subject = htmlspecialchars($_POST['subject']);
		$message = htmlspecialchars($_POST['message']);
		$_SESSION['from'] = $from;
		$_SESSION['to'] = $to;
		$_SESSION['subject'] = $subject;
		$_SESSION['message'] = $message;

		$error_from = "";
		$error_to = "";
		$error_subject = "";
		$error_message = "";
		$error = false;

		if($from == "" || !preg_match("/@/", $from)){
			$error_from = "Введите коректный email";
			$error = true;
		}

		if($to == "" || !preg_match("/@/", $to)){
			$error_to = "Введите коректный email";
			$error = true;
		}

		if($subject == ""){
			$error_subject = "Введите тему сообщения";
			$error = true;
		}

		if($message == ""){
			$error_message = "Введите сообщения";
			$error = true;
		}

		if(!$error){
			$subject = "=?utf-8?B?".base64_encode($subject)."?=";
			$headers = "From: $from\r\nReply-to: $form\r\nContent-type: text/plain; charset = utf-8\r\n";
			mail($to, $subject, $message, $headers);
			header("Location: success.php?send=1");		
		}
		exit();

	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<form action = '' method = 'post' >
		<label>От кого</label><br>
		<input type="text" name = 'from' value = "<?=$_SESSION['from']?>">
		<span ><?=$error_from?></span><br>

		<label>Кому</label><br>
		<input type="text" name = 'to' value = "<?=$_SESSION['to']?>">
		<span ><?=$error_to?></span><br>

		<label>Тема</label><br>
		<input type="text" name = 'subject' value = "<?=$_SESSION['subject']?>">
		<span ><?=$error_subject?></span><br>

		<label>Сообшение</label><br>
		<textarea cols = 30 rows = 10 name = 'message'><?=$_SESSION['message']?></textarea>
		<span ><?=$error_message?></span><br>
		<input type = 'submit' name = 'send'>
	</form>
</body>
</html>