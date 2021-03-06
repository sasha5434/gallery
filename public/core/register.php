<?php

if (!defined('DONTHACKME')) {
    die('Dont hack me!');
}
$errors = ' ';
$config['title'] .= " - {$lang['Register-1']}";
// Страница регистрации нового пользователя
if ($user_login == 'NOT LOGIN') {
    if (isset($_POST['submit'])) {
        $err = [];
        // проверям логин
        if (!preg_match('/^([a-zA-Z0-9])+([a-z0-9])$/is', $_POST['login'])) {
            $err[] = $lang['Register-2'];
        }
        if (strlen($_POST['login']) < 3 or strlen($_POST['login']) > 10) {
            $err[] = $lang['Register-3'];
        }
        if (!preg_match('/^([a-z0-9])(\w|[.]|-|_)+([a-z0-9])@([a-z0-9])([a-z0-9.-]*)([a-z0-9])([.]{1})([a-z]{2,4})$/is', $_POST['email'])) {
            $err[] = $lang['Register-4'];
        }
        if (strlen($_POST['email']) < 5 or strlen($_POST['email']) > 35) {
            $err[] = $lang['Register-5'];
        }
        if (strlen($_POST['password']) < 5 or strlen($_POST['password']) > 30) {
            $err[] = $lang['Register-6'];
        }
        if ($_POST['password'] != $_POST['password2']) {
            $err[] = $lang['Register-7'];
        }
        if (!preg_match('/^([a-zA-Z0-9])(\w|-|_)+([a-z0-9])$/is', $_POST['password'])) {
            $err[] = $lang['Register-8'];
        }
        /* СОЗДАЕМ ФУНКЦИЮ КОТОРАЯ ДЕЛАЕТ ЗАПРОС НА GOOGLE СЕРВИС */

        function getCaptcha($SecretKey, $reSecretKey) {
            $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$reSecretKey}&response={$SecretKey}");
            $Return = json_decode($Response);
            return $Return;
        }

        /* ПРОИЗВОДИМ ЗАПРОС НА GOOGLE СЕРВИС И ЗАПИСЫВАЕМ ОТВЕТ */
        $Return = getCaptcha($_POST['g-recaptcha-response'], $config['reSecretKey']);
        /* ЕСЛИ ЗАПРОС УДАЧНО ОТПРАВЛЕН И ЗНАЧЕНИЕ score БОЛЬШЕ 0,5 ВЫПОЛНЯЕМ КОД */
        if ($Return->success == true && $Return->score > 0.5) {
            
        } else {
            $err[] = $lang['Register-9'];
        }
        // проверяем, не сущестует ли пользователя с таким именем
        $user_login = mysqli_real_escape_string($link, $_POST['login']);
        $query = mysqli_query($link, "SELECT user_id FROM users WHERE user_login='$user_login'");
        if (mysqli_num_rows($query) > 0) {
            $err[] = $lang['Register-10'];
        }
        // проверяем, не сущестует ли пользователя с таким Email
        $user_email = mysqli_real_escape_string($link, $_POST['email']);
        $query = mysqli_query($link, "SELECT user_id FROM users WHERE user_email='$user_email'");
        if (mysqli_num_rows($query) > 0) {
            $err[] = $lang['Register-11'];
        }
        // Если нет ошибок, то добавляем в БД нового пользователя
        if (count($err) == 0) {
            $errors = ' ';
            // Убераем лишние пробелы и делаем двойное хеширование
            $password = md5(md5(trim($_POST['password'])));
            if (mysqli_query($link, "INSERT INTO users SET user_login='$user_login', user_password='$password', user_reg_email='$user_email', user_email='$user_email'")) {
                header("Location: /?do=login");
                exit();
            } else {
                $errors = $lang['Register-12'];
            }
        } else {
            $errors = "<b>{$lang['Register-13']}:</b><br />";
            foreach ($err AS $error) {
                $errors .= "$error <br />";
            }
        }
    }
    $parse->get_tpl(DESIGN_DIR . '/reg.tpl');
    $parse->set_tpl('{errors}', $errors);
    $parse->set_tpl('{reSiteKey}', $config['reSiteKey']);
    $parse->tpl_parse();
    $content = $parse->template;
} else {
    header('Location: /');
}