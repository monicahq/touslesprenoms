<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class StringHelper
{
    public static function sanitizeNameForURL(string $name): string
    {
        $string = str_replace(['[\', \']'], '', $name);
        $string = preg_replace('/\[.*\]/U', '', $string);
        $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string);
        $string = preg_replace(['/[^a-z0-9]/i', '/[-]+/'], '-', $string);

        return strtolower(trim($string, '-'));
    }

    public static function getProperName(string $name): string
    {
        $formattedName = Str::ucfirst(Str::lower($name));

        $separator = [' ', '-', '+', "'"];
        foreach ($separator as $s) {
            if (strpos($formattedName, $s) !== false) {
                $word = explode($s, $formattedName);
                $array = array_map('ucfirst', array_map('strtolower', $word));
                $formattedName = implode($s, $array);
            }
        }

        return $formattedName;
    }
}
