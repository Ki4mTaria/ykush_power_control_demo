<?php

namespace com\arr;

function delete($ary, $idx) {
    try {
        if ($idx >= count($ary)) {
            throw new \Exception('invalid index ' . $idx);
        }
        $ret_val = array();
        for ($loop=0;$loop < count($ary);$loop++ ) {
            if ($loop === $idx) {
                continue;
            }
            $ret_val[] = $ary[$loop];
        }
        return $ret_val;
    } catch (\Exception $e) {
        throw $e;
    }
}
