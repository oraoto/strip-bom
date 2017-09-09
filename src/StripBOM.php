<?php

namespace Oraoto\StripBOM;

class StripBOM
{
    const UTF8 = "\xEF\xBB\xBF";

    public static function hasBOM($path)
    {
        $file = @fopen($path, 'r');
        if (!$file) {
            throw new \Exception('file not exist: ' . $path);
        }
        $head = fread($file, 3);
        fclose($file);
        return (substr($head, 0, 3) == static::UTF8);
    }

    public static function stripBOM($path, $blockSize = 4096, $inplace = false)
    {
        $file = fopen($path, 'r+');

        $start = 0;
        $len = 0;
        do {
            $ok = fseek($file, $start + 3);
            $str = fread($file, $blockSize);
            if ($str === false || $str === "") {
                break;
            }
            $len += strlen($str);
            if ($inplace) {
                fseek($file, $start);
                fwrite($file, $str);
            } else {
                echo $str;
            }
            $start += $blockSize;
        } while (true);
        if ($inplace) {
            ftruncate($file, $len);
        }
        fclose($file);
    }
}
