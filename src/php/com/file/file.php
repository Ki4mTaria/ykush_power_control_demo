<?php
/**
 * @file   class.php
 * @brief  class loader
 * @author simpart
 * @note   MIT license
 */

/*** function ***/
/**
 * delete directory
 */
function delDir( $dir ) {
    try {
        $odir = scandir( $dir );
        if (2 < count($odir)) {
            foreach( $odir as $elm ) {
                if ((0 === strcmp($elm,'.')) ||
                    (0 === strcmp($elm,'..')) ) {
                    continue;
                }
                $ftype = filetype( $dir . DIRECTORY_SEPARATOR . $elm );
                if (0 === strcmp($ftype, 'dir')) {
                    delDir($dir . DIRECTORY_SEPARATOR . $elm);
                } else {
                    $ret = unlink($dir . DIRECTORY_SEPARATOR . $elm);
                    if (false === $ret) {
                        throw new Exception();
                    }
                }
            }
            $ret = rmdir($dir); 
            if (false === $ret) {
                throw new Exception();
            }
        } else if (2 === count($odir) ) {
            $ret = rmdir($dir);
            if (false === $ret) {
                throw new Exception();
            }
        }
    } catch (Exception $e) {
        throw $e;
    }
}

/**
 * delete directory contents
 */
function delDirConts( $dir ) {
    try {
        if( strlen($dir)-1 === strrpos($dir, DIRECTORY_SEPARATOR) ) {
            $dir = substr($dir, 0, strlen($dir)-1);
        }
        $odir = scandir( $dir );
        foreach( $odir as $elm ) {
            if ((0 === strcmp($elm,'.')) ||
                (0 === strcmp($elm,'..')) ) {
                continue;
            }
            $ftype = filetype( $dir . DIRECTORY_SEPARATOR . $elm );
            if (0 === strcmp($ftype, 'dir')) {
                delDir($dir . DIRECTORY_SEPARATOR . $elm);
            } else {
                $ret = unlink($dir . DIRECTORY_SEPARATOR . $elm);
                if (false === $ret) {
                    throw new Exception();
                }
            }
        } 
    } catch (Exception $e) {
        throw $e;
    }
}


function isDirExists($path) {
    try {
        if (true !== file_exists($path)) {
            return false;
        }
        $ftype = filetype($path);
        if (0 !== strcmp($ftype, 'dir')) {
            return false;
        }
        return true;
    } catch (\Exception $e) {
        throw $e;
    }
}

function isFileExists($path) {
    try {
        if (true !== file_exists($path)) {
            return false;
        }
        $ftype = filetype($path);
        if (0 !== strcmp($ftype, 'file')) {
            return false;
        }
        return true;
    } catch (\Exception $e) {
        throw $e;
    }
}

function copyDir($src, $dst) {
    try {
        /* check source directory */
        if (false === isDirExists($src)) {
            throw new \Exception('could not find source directory');
        }
        /* check destination directory */
        if (false === isDirExists($dst)) {
            if( false === mkdir($dst) ) {
                throw new \Exception('could not create destination directory');
            }
        }
        
        $scan = scandir( $src );
        foreach ($scan as $elm) {
            if ((0 === strcmp($elm,'.')) || 
                (0 === strcmp($elm,'..')) ) {
                continue;
            }
            $ftype = filetype($src . '/' . $elm);
            if (0 === strcmp($ftype, 'dir')) {
                copyDir($src.'/'.$elm, $dst.'/'.$elm );
            } else {
                if (false === copy($src.'/'.$elm, $dst . '/' . $elm)) {
                    throw new \Exception(
                        'could not copy \'' . $src.'/'.$elm . '\'' .
                        ' to \'' . $dst . '\''
                    );
                }
            }
        }
    } catch (\Exception $e) {
        throw $e;
    }
}
/* end of file */
