<?php

/**
 * generate shell
 * 
 */
function genShell() {
    try {
        if (false === is_writable(__DIR__.'/../../../')) {
            throw new \err\ComErr(
                'could not create ' . __DIR__ . '/../../../trut file',
                'please check permition at ' . __DIR__ . '/../../../'
            );
        }
        if (true === file_exists (__DIR__.'/../../../trut')) {
            throw new \err\ComErr(
                'already exists trut shell',
                'please delete ' . __DIR__ . '/../../../trut'
            );
        }
        
        $conts  = '#!/bin/sh'.PHP_EOL;
        /* call 'cmd' function with parameter */
        $conts .= 'php '.__DIR__.'/../../../src/php/cmd/ctrl.php $*';
        /* create trut shell at trut directory */
        /* write trut shell contents */
        $ret = file_put_contents( __DIR__.'/../../../trut', $conts );
        if(false === $ret) {
            throw new \Exception();
        } else {
            /* permition of trut shell is 755 */
            if (false === chmod(__DIR__.'/../../../trut', 755)) {
                throw new \Exception();
            }
        }
    } catch(Exception $e) {
        throw $e;
    }
}

/**
 * set symbolic link
 * 
 * @param $dir : install directory
 */
function setSymLink($dir) {
    try {
        /* cannot create trut by permition */
        if (false === is_writable($dir)) {
            throw new \err\ComErr(
                'failed install trut command',
                'please check permition at ' . $dir
            );
        }
        /* symbolic link is already exists */
        if (true === file_exists ($dir.'/trut')) {
            throw new \err\ComErr(
                'failed install trut command',
                'please delete ' . $dir .'/trut'
            );
        }
        /* create symbolic link trut shell to installation directory */
        $lncmd = 'ln -s '.__DIR__.'/../../../trut '.$dir.'/trut';
        if (false === system($lncmd)) {
            throw new \Exception();
        }
    } catch (Exception $e) {
        throw $e;
    }
}
/* end of file */
