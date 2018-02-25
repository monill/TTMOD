<?php

//I can not remember what this does.
if (preg_match("/(?:\< *(?:java|script)|script\:|\+document\.)/i", serialize($_SERVER))) {
    die("Scripting is Forbidden");
}
if (preg_match("/(?:\< *(?:java|script)|script\:|\+document\.)/i", serialize($_GET))) {
    die("Scripting is Forbidden");
}
if (preg_match("/(?:\< *(?:java|script)|script\:|\+document\.)/i", serialize($_POST))) {
    die("Scripting is Forbidden");
}
if (preg_match("/(?:\< *(?:java|script)|script\:|\+document\.)/i", serialize($_COOKIE))) {
    die("Scripting is Forbidden");
}

function url($url) {
    return URL . $url;
}

function ratingpic($num) {
    $r = round($num * 2) / 2;

    if ($r != $num) {
        $n = $num - $r;
        if ($n < 0.25) {
            $n = 0;
        } elseif ($n >= 0.25 && $n < 0.75) {
            $n = 0.5;
        }
        $r += $n;
    }
    if ($r < 0 || $r > 5) {
        return $r;
    }
    return '<img src="' . URL . "/imgs/rating/{$r}.png\" border=\"0\" alt=\"rating: {$num}/5\" title=\"rating: {$num}/5\" width=\"140\" />";
}

