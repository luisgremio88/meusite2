<?php
function my_autoload($class_name) 
{
    $dir_config = '../_configs/';

    if (is_file($dir_config.'class.'.$class_name.'.php')) {
        require_once $dir_config.'class.'.$class_name.'.php';
    }

    $dir_entity = '../_model/entity/'; 
    $dir_repository = '../_model/repository/';
    $dir_dao = '../_model/dao/';
    
    if (is_file($dir_dao.'class.'.$class_name.'.php')) {
        require_once $dir_dao.'class.'.$class_name.'.php';
    }
    if (is_file($dir_entity.'class.'.$class_name.'.php')) {
        require_once $dir_entity.'class.'.$class_name.'.php';
    }
    if (is_file($dir_repository.'class.'.$class_name.'.php')) {
        require_once $dir_repository.'class.'.$class_name.'.php';
    }
}
spl_autoload_register("my_autoload");
?>