<?php

function sanitize(string $str): string 
{
    $str = trim($str);
    $str = strip_tags($str);
    $str = htmlspecialchars($str, ENT_NOQUOTES);
    return $str;
}

function sanitize_array(array &$data): void
{
    foreach ($data as $key => $value) {
        $data[$key] = sanitize($value);  
    }
}