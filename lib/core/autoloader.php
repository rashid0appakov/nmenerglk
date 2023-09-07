<?php
spl_autoload_register('core_lib_autoloader');
function core_lib_autoloader($class)
{
    if(strpos($class, 'lib\core\\') !== false) {
        $parts = str_replace("\\",'/', $class);

        require __DIR__ . '/../../'.$parts . '.php';
    }
}
include __DIR__ . '/conf.php';