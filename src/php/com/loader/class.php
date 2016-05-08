<?php
/**
 * @file   class.php
 * @brief  class loader
 * @author simpart
 * @note   MIT license
 */

/*** function ***/
/**
 * search and require class
 * 
 * @param $cname : (string) class name
 */
function loadClass($cname) {
    try {
        $lnpos = strripos($cname, '\\'); // last namespace position
        if (false === $lnpos) {
            throw new Exception('invalid class name');
        }
        $nspace = substr($cname, 0, $lnpos);
        $cname  = substr($cname, $lnpos+1);
        $fname  = __DIR__.'/../../' . str_replace('\\', DIRECTORY_SEPARATOR, $nspace) . DIRECTORY_SEPARATOR;
        $fname  .= str_replace('_', DIRECTORY_SEPARATOR, $cname) . '.php';
        if (file_exists($fname)) {
            require $fname;
        } else {
            throw new Exception(PHP_EOL.'could not find '.$fname.PHP_EOL);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

spl_autoload_register('loadClass');
/* end of file */
