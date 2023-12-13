<?php

namespace App\Helpers;

use OpenAI\Laravel\Facades\OpenAI;

class StringHelper
{
    public static function sanitizeNameForURL(string $name): string
    {
        $string = str_replace(array('[\', \']'), '', $name);
        $string = preg_replace('/\[.*\]/U', '', $string);
        $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string);
        $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), '-', $string);
        return strtolower(trim($string, '-'));
    }

    public static function getProperName(string $name): string
    {
        $formattedName = ucwords(strtolower($name));

        // ucwords will work for most strings, but if you wanted to break out each word so you can deal with exceptions, you could do something like this:
        $separator = array(" ", "-", "+", "'");
        foreach ($separator as $s) {
            if (strpos($formattedName, $s) !== false) {
                $word = explode($s, $formattedName);
                $array = array_map("ucfirst", array_map("strtolower", $word));
                $formattedName = implode($s, $array);
            }
        }

        return $formattedName;
    }
}
