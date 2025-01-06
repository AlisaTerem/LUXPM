<?php

// класс для работы с базой данных
class database
{

    // признак готовности класса к работе
    protected static $_ready = false;

    // объект класса mysqli
    protected static $_link;

    // инициализация
    public static function _init()
    {
        // если класс уже готов к работе, прекращаем выполнение функции
        if (database::$_ready) {
            return;
        }
        // подключаемся к БД
        database::$_link = new mysqli(
            'localhost',
            'root',
            '',
            'login_db'
        );
        // если подключиться не удалось прекращаем работу скрипта и сообщаем об ошибке
        if (database::$_link->connect_error) {
            die('Подключение к серверу MySQL невозможно. Ошибка: ' . database::$_link->connect_error);
        }
        database::$_link->set_charset('utf8');
        // класс готов к работе
        database::$_ready = true;
    }

    // возвращает рузультат выполнения запроса
    // $query - запрос
    public static function basic_query($query)
    {
        database::_init();
        return database::$_link->query($query);
    }

    // возвращает результат выполнения запроса (используя ассоциативные массивы)
    // $query - запрос
    // $single - признак, возвращать одну (первую) запись или все найденые
    public static function query($query, $single = false)
    {
        // выполняем запрос
        $result = database::basic_query($query);
        // если результат true или false возвращаем его
        if (is_bool($result)) {
            return $result;
        }
        if ($single) {
            // если необходимо вернуть одну (первую) запись, возвращаем её
            return $result->fetch_array(MYSQLI_ASSOC);
        } else {
            // если нет, то возвращаем всё
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    // возвращает идентификатор последней вставленной записи
    public static function last_id()
    {
        database::_init();
        return database::$_link->insert_id;
    }

    // возвращает номер последней ошибки
    public static function errno()
    {
        database::_init();
        return database::$_link->errno;
    }

    // возвращает текст последней ошибки
    public static function error()
    {
        database::_init();
        return database::$_link->error;
    }

    public static function escape_string($value)
    {
        database::_init();
        return database::$_link->real_escape_string($value);
    }
}
