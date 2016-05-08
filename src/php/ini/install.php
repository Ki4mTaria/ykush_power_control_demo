<?php
/**
 * @file   install.php
 * @brief  enable web service
 * @author taria
 */
namespace ini;

/*** require ***/
require_once(__DIR__ . '/../com/loader/class.php');
require_once(__DIR__ . '/../com/file/file.php');

try {
    $scan = scandir( __DIR__ . '/../rot' );
    if (2 < count($scan)) {
        throw new \Exception('should be ' . __DIR__ . '/../rot' . ' is empty');
    }
    
    $rot = yaml_parse_file( __DIR__ . '/../../../conf/route.yml' );
    if (false === $rot) {
        throw new \Exception('could not read ' . __DIR__ . '/../../../conf/route.yml' );
    }
    
    foreach ($rot as $key => $val) {
        $rot[$key] = getPurePath(__DIR__ . '/../../..' .  $val);
    }

    $new_rot = yaml_emit($rot);
    if (false === file_put_contents(
                      __DIR__ . '/../../../conf/route.yml',
                      $new_rot
                  )) {
        throw new \Exception('could not write ' . __DIR__ . '/../../../conf/route.yml' );
    }
    
    if ( false === system ('trut mod sel SimpLineRot') ) {
        throw new \Exception('failed trut command');
    }
    
    if ( false === system ('trut gen ' . __DIR__ . '/../../../conf/route.yml ' .
                           '-o ' .  __DIR__ . '/../rot' ) ) {
        throw new \Exception('failed trut command');
    }
    
    $hta = file_get_contents(__DIR__ . '/../../../.htaccess');
    if (false === $hta) {
        throw new \Exception('could not read ' . __DIR__ . '/../../../.htaccess');
    }
    $hta = str_replace( '{@rep1}', getPurePath(__DIR__ . '/../../..') , $hta );
    file_put_contents(__DIR__ . '/../../../.htaccess', $hta);
    
    echo 'successful install'.PHP_EOL;
} catch (\Exception $e) {
    echo 'failed install' . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
}

/* end of file */
