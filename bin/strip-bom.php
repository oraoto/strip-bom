<?php

require __DIR__ . '/../vendor/autoload.php';

$options = getopt("b:hi", [], $optind);
$paths = array_slice($argv, $optind);

if (isset($options['h'])) {
    showHelp();
    die;
}

$blockSize = 4096;
if (isset($options['b']) && (int)$options['b'] > 0) {
    $blockSize = (int)($options['b']);
}
$inplace = isset($options['i']);

foreach ($paths as $p) {
    try {
        if (Oraoto\StripBOM\StripBOM::hasBOM($p)) {
            Oraoto\StripBOM\StripBOM::stripBOM($p, $blockSize, $inplace);
        }
    } catch (\Exception $ex) {
        fwrite(STDERR, $ex->getMessage());
    }
}

function showHelp()
{
    $usage= "Usage: php strip-bom.phar [-i] [-b blocksize] [<files>]" . PHP_EOL;
    echo $usage;
}
