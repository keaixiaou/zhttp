<?php

define("ROOTPATH", dirname(__DIR__));

require ROOTPATH.'/vendor/autoload.php';
use ZPHP\ZPHP;

ZPHP::run(ROOTPATH);