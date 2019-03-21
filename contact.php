<?php
if (!isset($_POST['name']) or empty($_POST['name'])) {
	$error1 = "Имя?<br />";
} else $error1 = NULL;

if (!isset($_POST['email']) or empty($_POST['email'])) {
	$error2 = "Email?<br />";
} else $error2 = NULL;

if (!isset($_POST['message']) or empty($_POST['message'])) {
	$error4 = "Сообщение?<br />";
} else $error4 = NULL;

if (empty($error1) and empty($error2) and empty($error3) and empty($error4)) {
	$subject = 'Письмо с моего сайта';
	$name    = $_POST['name'];
	$email   = $_POST['email'];
	$to  = 'hamjara@yandex.ru'
	$message = 'Пользователь' . $_POST['name'] . ' отправил вам письмо:<br />' . $_POST['message'] . 'с сайта niklen.ru' . '<br />
                Связяться с ним можно по email <a href="mailto:' . $_POST['email'] . '">' . $_POST['email'] . '</a>'
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
    $headers .= 'To: Иван <Ivan@example.com>' . "\r\n"; // Свое имя и email
    $headers .= 'From: '  . $_POST['name'] . '<' . $_POST['email'] . '>' . "\r\n";
	
	if (mail($to, $subject, $message, $headers)) {
		echo "Отправлено!";
	} else echo "Ошибка!";
} else {
	echo $error1.$error2.$error3.$error4;
}
?>