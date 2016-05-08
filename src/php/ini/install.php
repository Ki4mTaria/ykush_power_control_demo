<?php
/**
 * @file   install.php
 * @brief  enable web service
 * @author taria
 */
namespace ini;

/*** require ***/
require_once(__DIR__ . '/../com/loader/class.php');

try {
    $scan = scandir( __DIR__ . '/../rot' );
    if (2 < count($scan)) {
        throw new \Exception('should be ' . __DIR__ . '/../rot' . ' is empty');
    }
    
    // getcwd
    $rot = yaml_parse_file( __DIR__ . '/../../../cnf/route.yml'  );
    if (false === $rot) {
        throw new \Exception('could not read ' . __DIR__ . '/../../../cnf/route.yml' );
    }
    
    foreach ($rot as $key => $val) {
        $rot[$key] = __DIR__ . '/../../..' .  $val;
    }
    
    echo 'successful install'.PHP_EOL;
} catch (\Exception $e) {
    echo $e->getMessage();
}

/* end of file */
