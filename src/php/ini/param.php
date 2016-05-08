<?php
/**
 * @file   param.php
 * @brief  check install.sh parameter
 * @author simpart
 */
namespace ini;
/*** function ***/
/**
 * get install.sh parameter
 * 
 * @param $prm 
 */
function getParam($prm) {
    try {
        $ret = null;
        if (1 === count($prm)) {
            /* directory is not required */
            /* default directory is /usr/local/bin */
            $ret = '/usr/local/bin';
        } else if (2 === count($prm)) {
            /* get install directory from install.sh argument */
            $ret = $prm[1];
        } else {
            /* two or more of the parameters */
            throw new \err\ComErr(
                /* summary : "invalid parameter count" */
                'invalid parameter count',
                /* support : "please check \"install -h\" responce" */
                'please check "install.sh -h" responce'
            );
        }
        return $ret;
    } catch (Exception $e) {
        throw $e;
    }
}

function chkDir($dir) {
    try {
        /* permit only absolute path */
        if (0 === strpos($dir, '.')) {
            throw new \err\ComErr(
                'destination is relative path',
                'please specify absolute path'
            );
        }
        /* check of install destination is exist */
        if (true === file_exists ($dir)) {
            $ftype = filetype($dir);
            if (0 !== strcmp($ftype, 'dir')) {
                throw new \err\ComErr(
                    /* summary -> "(specified directory) is not exists" */
                    $dir.' is not exists',
                    /* support -> "please check \"install -h\" responce" */
                    'please check "install.sh -h" responce'
                );
            }
        } else {
            throw new \err\ComErr(
                /* summary -> "(specified directory) is not exists" */
                $dir.' is not exists',
                /* support -> "please check \"install -h\" responce" */
                'please check "install.sh -h" responce'
            );
        }
    } catch (Exception $e) {
        throw $e;
    }
}
/* end of file */
