<?php
function shorten_text($text, $max_words)
{
    $words = explode(' ', $text);
    if (count($words) > $max_words) {
        $words = array_slice($words, 0, $max_words);
        $text = implode(' ', $words) . '...';
    }
    return $text;
}
