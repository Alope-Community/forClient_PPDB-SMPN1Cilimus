<?php

namespace App\Services;

class LzwService
{
    public function compress($data)
    {
        $dictionary = [];
        $dictSize = 256;

        for ($i = 0; $i < 256; $i++) {
            $dictionary[chr($i)] = $i;
        }

        $w = "";
        $result = [];

        foreach (str_split($data) as $c) {
            $wc = $w . $c;
            if (isset($dictionary[$wc])) {
                $w = $wc;
            } else {
                $result[] = $dictionary[$w];
                $dictionary[$wc] = $dictSize++;
                $w = $c;
            }
        }

        if ($w !== "") {
            $result[] = $dictionary[$w];
        }

        return json_encode($result);
    }

    public function decompress($compressed)
    {
        $compressed = json_decode($compressed, true);

        $dictionary = [];
        $dictSize = 256;

        for ($i = 0; $i < 256; $i++) {
            $dictionary[$i] = chr($i);
        }

        $w = chr($compressed[0]);
        $result = $w;

        for ($i = 1; $i < count($compressed); $i++) {
            $k = $compressed[$i];

            if (isset($dictionary[$k])) {
                $entry = $dictionary[$k];
            } elseif ($k == $dictSize) {
                $entry = $w . $w[0];
            } else {
                throw new \Exception("Bad compressed k: $k");
            }

            $result .= $entry;
            $dictionary[$dictSize++] = $w . $entry[0];
            $w = $entry;
        }

        return $result;
    }
}