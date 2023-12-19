<?php

class Hash {
    public static function make($string) {
        return password_hash($string, PASSWORD_DEFAULT, ["cost" => 10]);
    }

    public static function salt($lenght) {
        return mcrypt_create_iv($lenght);
    }

    public static function unique() {
        return self::make(uniqid());
    }
}