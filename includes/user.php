<?php

class user
{

    protected static $_ready = false;

    protected static $_data = [];

    public static function _init()
    {
        if (user::$_ready) {
            return;
        }
        if (isset($_COOKIE['user_id'])) {
            $data = database::query("SELECT * FROM users WHERE id='{$_COOKIE['user_id']}'", true);
            if ($data) {
                user::$_data = $data;
            }
        }
        user::$_ready = true;
    }

    public static function __callStatic($name, $arguments)
    {
        user::_init();
        if (array_key_exists($name, user::$_data)) {
            return user::$_data[$name];
        }
        return false;
    }

    public static function is_guest () {
        return empty(user::$_data);
    }

}
