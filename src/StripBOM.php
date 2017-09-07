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

    public static function stripBOM($path)
    {
        $file = fopen($path, 'r+');

        $start = 0;
        $len = 0;
        do {
            $ok = fseek($file, $start + 3);
            $str = fread($file, 4096);
            if ($str === false || $str === "") {
                break;
            }
            $len += strlen($str);
            fseek($file, $start);
            fwrite($file, $str);
            $start += 4096;
        } while (true);
        ftruncate($file, $len);
        fclose($file);
    }
}
