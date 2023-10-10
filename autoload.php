<?php
    spl_autoload_register(function ($class_name) {
        $url = str_replace("\\", "/", 'sources/' . $class_name . '.php');
        require_once($url);
    });
?>