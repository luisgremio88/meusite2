<?php
function my_autoload($class_name) 
{
    $dir_util = './cls/util/';
    if (is_file($dir_util.'class.'.$class_name.'.php')) {
        require_once $dir_util.'class.'.$class_name.'.php';
    }
    $dir_util = '../cls/util/';
    if (is_file($dir_util.'class.'.$class_name.'.php')) {
        require_once $dir_util.'class.'.$class_name.'.php';
    }
    $dir_util = '../../cls/util/';
    if (is_file($dir_util.'class.'.$class_name.'.php')) {
        require_once $dir_util.'class.'.$class_name.'.php';
    }
    // ---------------------------------------------------
    $dir_dao = './cls/dao/';
    if (is_file($dir_dao.'class.'.$class_name.'.php')) {
        require_once $dir_dao.'class.'.$class_name.'.php';
    }
    $dir_dao = '../cls/dao/';
    if (is_file($dir_dao.'class.'.$class_name.'.php')) {
        require_once $dir_dao.'class.'.$class_name.'.php';
    }
    $dir_dao = '../../cls/dao/';
    if (is_file($dir_dao.'class.'.$class_name.'.php')) {
        require_once $dir_dao.'class.'.$class_name.'.php';
    }
    // ---------------------------------------------------
    $dir_entity = './cls/entity/'; 
    if (is_file($dir_entity.'class.'.$class_name.'.php')) {
        require_once $dir_entity.'class.'.$class_name.'.php';
    }
    $dir_entity = '../cls/entity/'; 
    if (is_file($dir_entity.'class.'.$class_name.'.php')) {
        require_once $dir_entity.'class.'.$class_name.'.php';
    }
    $dir_entity = '../../cls/entity/'; 
    if (is_file($dir_entity.'class.'.$class_name.'.php')) {
        require_once $dir_entity.'class.'.$class_name.'.php';
    }
    // ---------------------------------------------------
    $dir_repository = './cls/repository/';
    if (is_file($dir_repository.'class.'.$class_name.'.php')) {
        require_once $dir_repository.'class.'.$class_name.'.php';
    }
    $dir_repository = '../cls/repository/';
    if (is_file($dir_repository.'class.'.$class_name.'.php')) {
        require_once $dir_repository.'class.'.$class_name.'.php';
    }
    $dir_repository = '../../cls/repository/';
    if (is_file($dir_repository.'class.'.$class_name.'.php')) {
        require_once $dir_repository.'class.'.$class_name.'.php';
    }
    // ---------------------------------------------------
    $dir_service = './cls/service/';
    if (is_file($dir_service.'class.'.$class_name.'.php')) {
        require_once $dir_service.'class.'.$class_name.'.php';
    }
    $dir_service = '../cls/service/';
    if (is_file($dir_service.'class.'.$class_name.'.php')) {
        require_once $dir_service.'class.'.$class_name.'.php';
    }
    $dir_service = '../../cls/service/';
    if (is_file($dir_service.'class.'.$class_name.'.php')) {
        require_once $dir_service.'class.'.$class_name.'.php';
    }
    // ---------------------------------------------------
    $dir_controller = './cls/controller/';
    if (is_file($dir_controller.'class.'.$class_name.'.php')) {
        require_once $dir_controller.'class.'.$class_name.'.php';
    }
    $dir_controller = '../cls/controller/';
    if (is_file($dir_controller.'class.'.$class_name.'.php')) {
        require_once $dir_controller.'class.'.$class_name.'.php';
    }
    $dir_controller = '../../cls/controller/';
    if (is_file($dir_controller.'class.'.$class_name.'.php')) {
        require_once $dir_controller.'class.'.$class_name.'.php';
    }
}
spl_autoload_register("my_autoload");
?>