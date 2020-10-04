<?php
    spl_autoload_register('autoLoaderForINC');

    function autoLoaderForINC($className)
    {
        $fullPath = "includes/".$className.".inc.php";
        if(!file_exists($fullPath)){
            return false;
        }
        include_once $fullPath;
    }
?> 