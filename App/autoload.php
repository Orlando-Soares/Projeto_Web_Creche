<?php
    spl_autoload_register(
        function($class) {
            $file = __DIR__ . "/" . $class . ".php";
            $file = str_replace("\\", "/", $file);
            
            if(file_exists($file) && !is_dir($file)) {
                include $file;                
            } else {
                
                $file = __DIR__ . "/Views/" . $class . ".php";
                $file = str_replace("\\", "/", $file);
                
                if(file_exists($file) && !is_dir($file)) {
                    include $file;                
                }
                
            }
            
        }
    );
?>