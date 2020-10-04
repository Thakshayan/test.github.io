<?php
    spl_autoload_register('autoLoader');

    function autoLoader($className)
    {
        $fullPath = "../classes/".$className.".classes.php";
        if(!file_exists($fullPath)){
            return false;
        }
        include_once $fullPath;
    }
?> 