<?php

    function today() {
        $date = date("d/m/Y");
        return $date;
    }

    function now() {
        $time = date("H:i:s");
        return $time;
    }

    function startsWith ($string, $startString) { 
        $len = strlen($startString); 
        return (substr($string, 0, $len) === $startString); 
    } 