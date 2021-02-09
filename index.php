<?php
/*
Plugin Name: Заявки
Version: 0.1
Author: Xaaser2006
Author URI: http://xaaser2006.ru/
*/

register_activation_hook(__FILE__, 'requestapp_install');
register_deactivation_hook(__FILE__, 'requestapp_uninstall');
register_uninstall_hook(__FILE__, 'requestapp_ondelete');

function requestapp_install(){
    global $wpdb;

    $table_name = $wpdb->prefix . 'requestapp';
    if($wpdb->get_var("SHOW TABLES LIKE $table_name") != $table_name) {
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
                    `id_request` int(11) NOT NULL AUTO_INCREMENT,
                    `date` datetime NOT NULL,
                    `name` varchar(40) NOT NULL,
                    `email` varchar(40) NOT NULL,
                    `list` varchar(40) NOT NULL,
                    `status` varchar(40) NOT NULL,
                    `text` text NOT NULL,
                    PRIMARY KEY (`id_request`) 
                    ) ENGINE=innoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
        $wpdb->query($sql);
    }
//    add_option('requestsapp_on_page', 5);
}

function requestapp_uninstall(){
//    delete_option('requestsapp_on_page');
}

function requestapp_ondelete(){
    global $wpdb;

    $table_name = $wpdb->prefix . 'requestapp';
    $sql = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query($sql);
}

function requestapp_admin_menu(){
    add_menu_page('Заявки', 'Заявки', 0, 'requestapp', 'requestapp_editor', 'dashicons-welcome-write-blog', 3);
//    add_posts_page('Заявки', 'Заявки', 8, 'requestapp', 'requestapp_editor');
//    add_submenu_page('index.php','Заявки', 'Заявки', 8, 'requestapp', 'requestapp_editor');
}

add_action('admin_menu', 'requestapp_admin_menu');

function requestapp_editor(){
    switch ($_GET['c']){
        case 'add':
            $action = 'add';
            break;
        case 'edit':
            $action = 'edit';
            break;
        default:
            $action = 'all';
            break;
    }
    include_once("includes/$action.php");
}

function requestapp_shortcode_form(){
    ob_start();
    include_once("includes/form.php");
    return ob_get_clean();
}

function requestapp_shortcode_list(){
    ob_start();
    include_once("includes/table.php");
    return ob_get_clean();
}

add_shortcode('requestapp_form', 'requestapp_shortcode_form');
add_shortcode('requestapp_list', 'requestapp_shortcode_list');

add_action('wp_head', 'requestapp_js_vars');

function requestapp_js_vars(){
    $vars = [
        'ajax_url' => admin_url('admin-ajax.php')
    ];
    echo "<script>window.wp = " . json_encode($vars) . "</script>";
}

add_action('wp_enqueue_scripts', 'requestapp_form_handler');

function requestapp_form_handler(){
    wp_enqueue_script('requestappFormHandler', plugins_url() . '/requestapp/includes/formHandler.js', ['jquery'], null, true);
}

add_action('wp_ajax_requestapp', 'requestapp_ajax_handler');
add_action('wp_ajax_nopriv_requestapp', 'requestapp_ajax_handler');

function requestapp_ajax_handler(){
    include_once("includes/m/requestapp.php");

    $res = [
        'success' => false,
        'err' => 'Произошла ошибка'
    ];

    $requestapp_name = $_POST['name'];
    $requestapp_email = $_POST['email'];
    $requestapp_list = $_POST['list'];
    $requestapp_status = $_POST['status'];
    $requestapp_text = $_POST['text'];


    if(requestapp_add($requestapp_name, $requestapp_email, $requestapp_list, $requestapp_status, $requestapp_text)){
        $res['success'] = true;
    }

    echo json_encode($res);

    wp_die();
}