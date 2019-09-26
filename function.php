<?php

function dd($var)
{
    $bTrace = debug_backtrace();
    if (count($bTrace) > 0) {
        $file = $bTrace[0]['file'];
        $line = $bTrace[0]['line'];
        echo $file . ':' . $line . ':' . PHP_EOL;
    }
    ob_start();
    var_dump($var);
    $vd = ob_get_clean();
    $vd = preg_split("/[\r\n]+/", trim($vd));
    unset($vd[0]);
    echo implode (PHP_EOL, $vd) . PHP_EOL;
    die;
}

function trace ($msg) {
    echo $msg . PHP_EOL;
}
