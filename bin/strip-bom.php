<?php

require __DIR__ . '/../vendor/autoload.php';

$paths = array_slice($argv, 1);

foreach ($paths as $p) {
    try {
        if (Oraoto\StripBOM\StripBOM::hasBOM($p)) {
            Oraoto\StripBOM\StripBOM::stripBOM($p);
        }
    } catch (\Exception $ex) {
        echo $ex->getMessage();
    }
}
