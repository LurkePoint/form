<?php
    session_start();
    require_once 'connect.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
    <link rel="stylesheet" href="css\style.css">
</head>
<body>
    <?php 
        
    ?>
    <div class="blockForm">
        <form method="post" action="functions.php">
            <input type="text" name="fio" pattern="^[А-Я\sа-яЁё\s]+$" placeholder="ФИО" required><br>
            <input type="tel" name="phone" pattern="[0-9]{11}" placeholder="Телефон: 89992223344" required><br>
            <input type="email" name="email" placeholder="Email" id="email" required><br>
            <textarea name="msg" required>Ваше сообщение...</textarea>
            <?php 
                $to = 'ncpremote@mail.ru';

                $checkEmail = $connect->prepare('SELECT * FROM applications WHERE email = ?');
                $checkEmail->execute([
                    $to
                ]);

                $emailError = $checkEmail->fetch();

                if(!$checkEmail->rowCount() > 0) {
                    echo '<button type="submit">Отправить</button>';
                } 
             
                if (isset($_SESSION['msgError'])) {
                    echo '<h4 style="border: 2px solid red; padding: 5px;">'. $_SESSION['msgError'] . '</h4>';
                    unset($_SESSION['msgError']);
                }
            
                if (isset($_SESSION['msgGood'])) {
                    echo '<h4 style="border: 2px solid lightgreen; padding: 5px;">'. $_SESSION['msgGood'] . '</h4>';
                    unset($_SESSION['msgGood']);
                }

                if (isset($_SESSION['emailError'])) {
                    echo '<h4 style="border: 2px solid red; padding: 5px;">'. $_SESSION['emailError'] . '</h4>';
                    unset($_SESSION['emailError']);
                }
            ?>
        </form>
    <div>
</body>
</html>