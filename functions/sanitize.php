<?php
function escape(string $string) {
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}