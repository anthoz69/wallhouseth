<?php

if (! function_exists('bahtSymbol')) {
    function bahtSymbol(): string
    {
        return '฿';
    }
}

function replaceNum($word) {
    return trim(preg_replace('/[0-9]+/', '', $word));
}
