<?php

/*** require ***/
require_once( __DIR__ . '/../rot/common.php' );

function directRot($uri) {
    try {
        $uri = \route\getNoprmUri( $uri );
        $exp = explode( '/', $uri );
        if (false === $exp) {
            throw Exception('error ' . __FILE__ . ':' . __LINE__ );
        }
        
        $path = '..' . DIRECTORY_SEPARATOR .
                '..' . DIRECTORY_SEPARATOR .
                '..' . DIRECTORY_SEPARATOR;
        
        foreach($exp as $elm) {
            if (0 === strcmp($elm , '..')) {
                return false;
            }
            $path .= $elm;
        }
        
        $ret = preg_match ( "/\w*.php/" , $exp[count($exp)-1]);
        if (0 === $ret) {
            $ret = file_get_contents($path);
            if (false !== $ret) {
                $ftype = explode( '.', $exp[count($exp)-1] );
                setContsType( $ftype[count($ftype)-1] );
                echo $ret;
                return true;
            }
        }
        return false;
    } catch (Exception $e) {
        throw new \Exception(
            PHP_EOL.'ERR(File:'.basename(__FILE__).',Line:' . __line__ .
            'Func:' . __FUNCTION__ . ':' . $e->getMessage()
        );
    }
}

function setContsType( $type ) {
    try {
        if ( 0 === strcmp( $type, 'html' ) ) {
            header("Content-Type: text/html; charset=utf-8");
        } else if ( 0 === strcmp( $type, 'css' ) ) {
            header("Content-Type: text/css; charset=utf-8");
        } else if( 0 === strcmp( $type, 'js' ) ) {
            header("Content-Type: text/javascript; charset=utf-8");
        } else if ( 0 === strcmp( $type, 'gif' ) ) {
            header("Content-Type: image/gif; charset=utf-8");
        } else if ( 0 === strcmp( $type, 'png' ) ) {
            header("Content-Type: image/png; charset=utf-8");
        } else if ( (0 === strcmp( $type, 'jpg' ))  ||
                    (0 === strcmp( $type, 'jpeg' )) ||
                    (0 === strcmp( $type, 'jpe' ))  ||
                    (0 === strcmp( $type, 'jfif' )) ||
                    (0 === strcmp( $type, 'jfi' )) ) {
            header("Content-Type: image/jpeg; charset=utf-8");
        }
    } catch ( \Exception $e )  {
        throw new \Exception(
            PHP_EOL.'ERR(File:'.basename(__FILE__).',Line:' . __line__ .
            'Func:' . __FUNCTION__ . ':' . $e->getMessage()
        );
    }
}
/* end of file */
