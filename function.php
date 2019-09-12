<?php

function dd ($var) {
    var_dump($var);
    die;
}

function trace ($msg) {
    echo $msg . PHP_EOL;
}
