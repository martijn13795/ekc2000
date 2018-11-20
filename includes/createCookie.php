<?php
if(!isset($_COOKIE["darkTheme"]) || $_COOKIE["darkTheme"] === "false") {
    setcookie('darkTheme', true);
} else {
    setcookie('darkTheme', false);
}