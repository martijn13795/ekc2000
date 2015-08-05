<?php

function activeClass($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    $current_file_name = str_replace("%20", " ", $current_file_name);

    if ($current_file_name == $requestUri)
        echo 'class="active"';
}