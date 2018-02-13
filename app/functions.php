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
