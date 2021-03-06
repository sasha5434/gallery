<?php

if (!defined('DONTHACKME')) {
    die('Dont hack me!');
}
$config['title'] .= " - {$lang['View-1']}";
// Получаем количество записей таблицы
$get_count = mysqli_query($link, "SELECT * FROM files");
if ($get_count) {
    $count_records = mysqli_num_rows($get_count);
    // Текущий id из GET-параметра id
    $view_id = isset($_GET['id']) ? (int) $_GET['id'] : 1;
    $result = mysqli_query($link, "SELECT * FROM files WHERE id=$view_id");
    if ($result) {
        // Если количество записей больше нуля
        if ($count_records > 0) {
            $myrow = mysqli_fetch_assoc($result);
            $query = mysqli_query($link, "SELECT user_login FROM users WHERE user_id='" . $myrow['user_id'] . "' LIMIT 1");
            $data = mysqli_fetch_assoc($query);
            if ($user_login == $data['user_login'] or $user_login == $config['adminLogin']) {
                if ($myrow['type'] == 'video') {
                    $editLinks = "{$lang['View-2']}: <a href=\"?do=action&step=preview&id={$view_id}&seconds=5\">5</a>, <a href=\"?do=action&step=preview&id={$view_id}&seconds=10\">10</a>, <a href=\"?do=action&step=preview&id={$view_id}&seconds=15\">15</a> {$lang['View-6']} | <a href=\"/?do=action&step=remove&id={$view_id}\">{$lang['View-3']}</a> |";
                } else {
                    $editLinks = "<a href=\"/?do=action&step=remove&id={$view_id}\">{$lang['View-3']}</a> |";
                }
            } else {
                $editLinks = '';
            }

            if ($myrow['type'] == 'video') {
                $parse->get_tpl(DESIGN_DIR . '/video.tpl');
                $parse->set_tpl('{link}', $config['uploadVideoDir'] . $myrow['filename'] . '.mp4');
                $parse->set_tpl('{prev}', $config['uploadVideoPrevDir'] . $myrow['filename'] . '.jpg');
                $parse->set_tpl('{thumb}', $config['uploadVideoPrevThumbDir'] . $myrow['filename'] . '.jpg');
                $parse->set_tpl('{date}', $myrow['date']);
                $parse->set_tpl('{user}', $data['user_login']);
                $parse->set_tpl('{userlink}', '/?do=user&id=' . $myrow['user_id']);
                $parse->set_tpl('{Links}', $editLinks);
                $parse->tpl_parse();
                $content = $parse->template;
            } else if ($myrow['type'] == 'image') {
                $parse->get_tpl(DESIGN_DIR . '/view.tpl');
                $parse->set_tpl('{link}', $config['uploadDir'] . $myrow['filename'] . '.jpg');
                $parse->set_tpl('{img}', $config['uploadDir'] . $myrow['filename'] . '.jpg');
                $parse->set_tpl('{date}', $myrow['date']);
                $parse->set_tpl('{user}', $data['user_login']);
                $parse->set_tpl('{userlink}', '/?do=user&id=' . $myrow['user_id']);
                $parse->set_tpl('{Links}', $editLinks);
                $parse->tpl_parse();
                $content = $parse->template;
            }
        } else {
            // Собщение о пустой таблице
            $content = "<div style=\"font-size: 24px;\">{$lang['View-4']}.</div>";
        }
    } else {
        $content = $lang['View-5'];
    }
} else {
    $content = $lang['View-5'];
}