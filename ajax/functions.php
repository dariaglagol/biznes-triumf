<?php

function mail_smtp($mail_to, $subject, $message)
{


    $config['smtp_reply'] = 'triumf@fondtomsk.ru';  //Смените на имя своего почтового ящика.
    $config['smtp_username'] = 'triumf@fondtomsk.ru';  //Смените на имя своего почтового ящика.
    $config['smtp_port'] = 465; // Порт работы. Не меняйте, если не уверены.
    $config['smtp_host'] = 'ssl://smtp.yandex.ru';  //сервер для отправки почты
    $config['smtp_password'] = 'Dhgdsf576tv';  //Измените пароль
    $config['smtp_debug'] = true;  //Если Вы хотите видеть сообщения ошибок, укажите true вместо false
    $config['smtp_charset'] = 'utf-8'; //кодировка сообщений. (или UTF-8, и т. д.)
    $config['smtp_from'] = 'triumf@fondtomsk.ru'; //Ваше имя - или имя Вашего сайта. Будет показывать при прочтении в поле "От кого"


    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset="utf-8"' . "\r\n";
    $headers .= 'From: ' . $config['smtp_username'] . "\r\n";
    $headers .= 'Reply-To: ' . $config['smtp_reply'] . "\r\n";;


    $SEND = "Date: " . date("D, d M Y H:i:s") . " UT\r\n";
    $SEND .= 'Subject: =?' . $config['smtp_charset'] . '?B?' . base64_encode($subject) . "=?=\r\n";
    if ($headers)
        $SEND .= $headers . "\r\n\r\n";
    else {
        $SEND .= "Reply-To: " . $config['smtp_reply'] . "\r\n";
        $SEND .= "MIME-Version: 1.0\r\n";
        $SEND .= "Content-Type: text/plain; charset=\"" . $config['smtp_charset'] . "\"\r\n";
        $SEND .= "Content-Transfer-Encoding: 8bit\r\n";
        $SEND .= "From: \"" . $config['smtp_from'] . "\" <" . $config['smtp_username'] . ">\r\n";
        $SEND .= "To: $mail_to <$mail_to>\r\n";
        $SEND .= "X-Priority: 3\r\n\r\n";
    }
    $SEND .= $message . "\r\n";
    if (!$socket = fsockopen($config['smtp_host'], $config['smtp_port'], $errno, $errstr, 30)) {
        if ($config['smtp_debug'])
            echo $errno . "<br>" . $errstr;
        return false;
    }

    if (!server_parse($socket, "220", __LINE__))
        return false;

    fputs($socket, "HELO " . $config['smtp_host'] . "\r\n");
    if (!server_parse($socket, "250", __LINE__)) {
        if ($config['smtp_debug'])
            echo '<p>Не могу отправить HELO!</p>';
        fclose($socket);
        return false;
    }
    fputs($socket, "AUTH LOGIN\r\n");
    if (!server_parse($socket, "334", __LINE__)) {
        if ($config['smtp_debug'])
            echo '<p>Не могу найти ответ на запрос авторизации.</p>';
        fclose($socket);
        return false;
    }
    fputs($socket, base64_encode($config['smtp_username']) . "\r\n");
    if (!server_parse($socket, "334", __LINE__)) {
        if ($config['smtp_debug'])
            echo '<p>Логин авторизации не был принят сервером!</p>';
        fclose($socket);
        return false;
    }
    fputs($socket, base64_encode($config['smtp_password']) . "\r\n");
    if (!server_parse($socket, "235", __LINE__)) {
        if ($config['smtp_debug'])
            echo '<p>Пароль не был принят сервером как верный! Ошибка авторизации!</p>';
        fclose($socket);
        return false;
    }
    fputs($socket, "MAIL FROM: <" . $config['smtp_username'] . ">\r\n");
    if (!server_parse($socket, "250", __LINE__)) {
        if ($config['smtp_debug'])
            echo '<p>Не могу отправить команду MAIL FROM: </p>';
        fclose($socket);
        return false;
    }
    fputs($socket, "RCPT TO: <" . $mail_to . ">\r\n");

    if (!server_parse($socket, "250", __LINE__)) {
        if ($config['smtp_debug'])
            echo '<p>Не могу отправить команду RCPT TO: </p>';
        fclose($socket);
        return false;
    }
    fputs($socket, "DATA\r\n");

    if (!server_parse($socket, "354", __LINE__)) {
        if ($config['smtp_debug'])
            echo '<p>Не могу отправить команду DATA</p>';
        fclose($socket);
        return false;
    }
    fputs($socket, $SEND . "\r\n.\r\n");

    if (!server_parse($socket, "250", __LINE__)) {
        if ($config['smtp_debug'])
            echo '<p>Не смог отправить тело письма. Письмо не было отправлено!</p>';
        fclose($socket);
        return false;
    }
    fputs($socket, "QUIT\r\n");
    fclose($socket);
    return TRUE;
}


function server_parse($socket, $response, $line = __LINE__) {
    global $config;
    while (@substr($server_response, 3, 1) != ' ') {
        if (!($server_response = fgets($socket, 256))) {
            if ($config['smtp_debug'])
                echo "<p>Проблемы с отправкой почты!</p>$response<br>$line<br>";
            return false;
        }
    }
    if (!(substr($server_response, 0, 3) == $response)) {
        if ($config['smtp_debug'])
            echo "<p>Проблемы с отправкой почты!</p>$response<br>$line<br>";
        return false;
    }
    return true;
}


function forms($n, $form1, $form2, $form5) {
    $n = abs($n) % 100;
    $n1 = $n % 10;
    if ($n > 10 && $n < 20) {
        return $form5;
    } else if ($n1 > 1 && $n1 < 5) {
        return $form2;
    } elseif ($n1 == 1) {
        return $form1;
    }
    return $form5;
}

function get_description(){
	return '<hr>
			<p>С уважением организаторы Премии Бизнес-триумф <br>тел.: +7 (3822) 902-984<br><a href="http://бизнестриумф70.рф">бизнестриумф70.рф</a></p>';
}

function mail_first_step($mail){

	$title = 'Премия Бизнес-триумф. Регистрация.';
	$body = 'Поздравляем!<br><br>Вы зарегистрированы на Премии Бизнес-триумф!<br>'.get_description();
	mail_smtp($mail,$title,$body);
	to_org('molpredtomsk@gmail.com'); //отправка организатору, если нужно несколько скопировать функцию и изменть мыло
	to_org('klava@maybah.com'); //отправка организатору, если нужно несколько скопировать функцию и изменть мыло
}

function mail_second_step($mail){
	
    $title = 'Поздравляем! Вы участник Премии Бизнес-триумф!';
    $body = 'Спасибо за регистрацию!<br> Информацию о месте и времени проведения Премии мы сообщим дополнительно.<br>'.get_description();
	
	mail_smtp($mail,$title,$body);

}

function mail_soon($mail,$url){
	
	$title = 'Предварительная регистрация на Премии Бизнес-триумф. ';
	$body = 'Спасибо за регистрацию на Премии Бизнес-триумф!<br>
			Вы прошли предварительную регистрацию, но вы ещё не включены в список участников, так как заполнили не все данные: <br>
			<a href="' . $url . '">Заполнить</a><br>'.get_description();;
	
	mail_smtp($mail,$title,$body);
}

function to_org($mail){
	$title = 'Зарегистрирован новый участник на Премии Бизнес-триумф';
	$body = 'На премии Бизнес триумф зарегистрирован новый участник.';
	mail_smtp($mail,$title,$body);
}

function mail_partner($mail,$name,$phone,$email){
	$title = 'Новая заявка на партнеров';
	$body = '<b>ФИО</b>: '.$name.'<br>'.
	'<b>E-mail</b>: '.$email.'<br>'.
	'<b>Телефон</b>: '.$phone;
	mail_smtp($mail,$title,$body);
}