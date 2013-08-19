<?php

require 'vendor/autoload.php';

use Eassy\App;

$readOnly = true;
if (!empty($argv[1]) && strtolower($argv[1]) == 'write') {
    $readOnly = false;
}

$eassy = new App();
$eassy->run($readOnly);
