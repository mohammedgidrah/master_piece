<?php

if (!function_exists('wrapText')) {
    function wrapText($text, $length = 50) {
        return nl2br(wordwrap($text, $length, "\n", true));
    }
}
