<?php
/**
 * @file   defRot.php
 * @brief  defoult routing
 * @author simpart
 * @note   MIT Lisence
 */

/*** require ***/
require_once( __DIR__ . '/direct.php' );
require_once( __DIR__ . '/../com/define.php' );

try {
    directRot($_SERVER['REQUEST_URI']);
} catch (Exception $e) {
    throw new \Exception(
        PHP_EOL.'ERR(File:'.basename(__FILE__).',Line:' . __line__ .
        'Func:' . __FUNCTION__ . ':' . $e->getMessage()
    ); 
}
/* end of file */
