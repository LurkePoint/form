<?php
    session_start();
    require_once 'connect.php';
    $fio = $_POST['fio'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $msg = $_POST['msg'];

    $to = 'ncpremote@mail.ru'; //почта, на которую приходит форма

    $checkEmail = $connect->prepare('SELECT * FROM applications WHERE email = ?');
    $checkEmail->execute([
        $to
    ]);

    $emailError = $checkEmail->fetch();

    if($checkEmail->rowCount() > 0) {
        $_SESSION['emailError'] = 'Ошибка';
        header('Location: /');
        exit;
    }

    $connect->prepare('INSERT INTO applications (fio, phone, email, message) VALUES (?, ?, ?, ?)')->execute([
        $fio,
        $phone,
        $email,
        $msg
    ]);

    
    
    $subject = 'Отправка';
    $message = 'Отправитель: ' . $fio . '
    Телефон отправителя: ' . $phone . '
    Почта отправителя: ' . $email . '
    Сообщение отправителя: ' . $msg . '
    ';
    
    
    if(mail($to, $subject, $message)) {
        $_SESSION['msgGood'] = 'Сообщение успешно отправлено';
    } else {
        $_SESSION['msgError'] = 'Сообщение не отправлено';
    }

    header('Location: /');