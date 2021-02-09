<?php
    date_default_timezone_set("Europe/Moscow");

    function requestapp_all(){
        global $wpdb;
        $table_name = $wpdb->prefix . 'requestapp';
        $query = "SELECT id_request, date, name, email, list, status FROM $table_name ORDER BY id_request DESC";
        return $wpdb->get_results($query, ARRAY_A);
    }

    function requestapp_get($id_requestapp){
        global $wpdb;
        $table_name = $wpdb->prefix . 'requestapp';
        $t = "SELECT * FROM $table_name WHERE id_request='%d'";
        $query = $wpdb->prepare($t, $id_requestapp);
        return $wpdb->get_row($query, ARRAY_A);
    }

    function requestapp_add($name, $email, $list, $status, $text){
        global $wpdb;

        $name = trim($name);
        $email = trim($email);
        $list = trim($list);
        $status = trim($status);
        $text = trim($text);

        if ($name == '' || $email == '' || $list == '' || $status == '' || $text == '')
            return false;

        $table_name = $wpdb->prefix . 'requestapp';
        $t = "INSERT INTO $table_name (date, name, email, list, status, text) VALUES(now(), '%s', '%s', '%s', '%s', '%s')";
        $query = $wpdb->prepare($t, $name, $email, $list, $status, $text);
        $result = $wpdb->query($query);

        if($result === false)
            die('Ошибка БД');

        return true;
    }

    function requestapp_edit($id_requestapp, $name, $email, $list, $status, $text){
        global $wpdb;

        $name = trim($name);
        $email = trim($email);
        $list = trim($list);
        $status = trim($status);
        $text = trim($text);

        if ($name == '' || $email == '' || $list == '' || $status == '' || $text == '')
            return false;

        $table_name = $wpdb->prefix . 'requestapp';
        $t = "UPDATE $table_name SET name='%s', email='%s', list='%s', status='%s', text='%s' WHERE id_request='%d'";
        $query = $wpdb->prepare($t, $name, $email, $list, $status, $text, $id_requestapp);
        $result = $wpdb->query($query);

        if($result === false)
            die('Ошибка БД');

        return true;
    }

    function requestapp_delete($id_requestapp){
        global $wpdb;
        $table_name = $wpdb->prefix . 'requestapp';
        $t = "DELETE FROM $table_name WHERE id_request='%d'";
        $query = $wpdb->prepare($t, $id_requestapp);
        return $wpdb->query($query);
    }

    function requestapp_mail($name, $email, $list, $status, $text){
        $dt = date("d.m.Y H:i");
        $headers = 'From: Pabgi <admin@pabgi.ru>' . "\r\n";

        switch ($list){
            case 'Гербарий':
                $director = 'darktanya@mail.ru';
                break;
            case 'Инсектарий':
                $director = 'rakntlj@rambler.ru';
                break;
            case 'Коллекция растений':
                $director = 'goncharovaoa@mail.ru';
                break;
            default:
                $director = 'goncharovaoa@mail.ru';
                break;
        }

        $multiple_to_recipients = array(
            $director,
            $email
        );

        $mailBody = "Дата подачи: $dt\nИмя: $name\nEmail: $email\nУНУ: $list\nСтатус: $status\nТекст Заявки: $text";
        if(wp_mail($multiple_to_recipients, 'УНУ', $mailBody, $headers)){
            return true;
        };
    }
