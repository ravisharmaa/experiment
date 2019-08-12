<?php
/**
 * BY : Javra
 */

/**
 * @param String $string
 * @return mixed
 */
function slugger(String $string): string
{
    $sluggedString = preg_replace('/[^a-z0-9-]/', '-', strtolower(trim($string, '/')));

    return $sluggedString = preg_replace('/-+/', "-", $sluggedString);

}