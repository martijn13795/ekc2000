<!--
Cas van Dinter
384755
-->
<?php

class DB
{

    private static $_instance = null;
    private $_pdo,
        $_query,
        $_error = false,
        $_results,
        $_count = 0;

    private function __construct()
    {
        try {
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
            $this->checkTables();
        } catch (PDOException $ex) {
            mysql_query("CREATE DATABASE " . Config::get('mysql/db'), mysql_connect(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password')));
            echo "<h1>Refresh the page</h1>";
            die($ex->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    private function checkTables()
    {
        if ($this->query("DESCRIBE users")->error()) {
            $this->query("CREATE TABLE users ("
                . "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                . "username VARCHAR(20), "
                . "password VARCHAR(64), "
                . "mail VARCHAR(50), "
                . "salt VARCHAR(32), "
                . "name VARCHAR(50), "
                . "joined DATETIME, "
                . "IconPath VARCHAR(60), "
                . "group_id INT)");
            //Create user on first setup
            $salt = Hash::salt(32);
            $this->insert('users', array(
                'username' => 'cassshh',
                'password' => Hash::make('admin', $salt),
                'mail' => 'casvd@hotmail.com',
                'salt' => $salt,
                'name' => 'Cas van Dinter',
                'joined' => date('Y-m-d H:i:s'),
                'IconPath' => 'images/icons/cassshh.png',
                'group_id' => 1
            ));
            $salt = Hash::salt(32);
            $this->insert('users', array(
                'username' => 'martijn13795',
                'password' => Hash::make('admin', $salt),
                'mail' => 'martijn13795@hotmail.com',
                'salt' => $salt,
                'name' => 'Martijn Posthuma',
                'joined' => date('Y-m-d H:i:s'),
                'IconPath' => 'images/icons/martijn13795.png',
                'group_id' => 1
            ));
            $salt = Hash::salt(32);
            $this->insert('users', array(
                'username' => 'gast',
                'password' => Hash::make('gast', $salt),
                'mail' => 'gast@hotmail.com',
                'salt' => $salt,
                'name' => 'Gast',
                'joined' => date('Y-m-d H:i:s'),
                'IconPath' => 'images/icons/default.jpg',
                'group_id' => 2
            ));
        }
        if ($this->query("DESCRIBE users_session")->error()) {
            $this->query("CREATE TABLE users_session ("
                . "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                . "user_id INT, "
                . "hash VARCHAR(64))");
        }
        if ($this->query("DESCRIBE messages")->error()) {
            $this->query("CREATE TABLE messages ("
                . "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                . "user_id INT, "
                . "message VARCHAR(250), "
                . "date DATETIME)");
        }
        if ($this->query("DESCRIBE groups")->error()) {
            $this->query("CREATE TABLE groups ("
                . "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                . "name VARCHAR(20), "
                . "permissions TEXT)");
            $this->insert('groups', array(
                'id' => '1',
                'name' => 'Dev',
                'permissions' => '{"dev": 1, "admin": 1}'
            ));
        }
        if ($this->query("DESCRIBE galleries")->error()) {
            $this->query("CREATE TABLE galleries ("
                . "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                . "name VARCHAR(255), "
                . "date DATETIME, "
                . "path LONGTEXT, "
                . "pathMobile LONGTEXT)");
        }
        if ($this->query("DESCRIBE visitors")->error()) {
            $this->query("CREATE TABLE visitors ("
                . "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                . "ip VARCHAR(512), "
                . "name VARCHAR(250), "
                . "city VARCHAR(512), "
                . "region VARCHAR(512), "
                . "country VARCHAR(512), "
                . "date DATETIME, "
                . "info VARCHAR(512))");
        }
        if ($this->query("DESCRIBE albums")->error()) {
            $this->query("CREATE TABLE albums ("
                . "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                . "name VARCHAR(255), "
                . "date DATETIME)");
            $this->insert('albums', array(
                'id' => '1',
                'name' => 'Sponsoren',
                'date' => date('Y-m-d H:i:s')
            ));
        }
        if ($this->query("DESCRIBE pictures")->error()) {
            $this->query("CREATE TABLE pictures ("
                . "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                . "album_id int, "
                . "name VARCHAR(255), "
                . "date DATETIME, "
                . "path LONGTEXT, "
                . "pathMobile LONGTEXT)");
        }
    }

    public function query($sql, $params = array())
    {
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)) {
            if (count($params)) {
                $x = 1;
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }
        return $this;
    }

    public function insert($table, $fields = array())
    {
        $keys = array_keys($fields);
        $values = '';
        $x = 1;

        foreach ($fields as $field) {
            $values .= '?';
            if ($x < count($fields)) {
                $values .= ', ';
            }
            $x++;
        }

        $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

        if (!$this->query($sql, $fields)->error()) {
            return true;
        }
        return false;
    }

    public function update($table, $id, $fields)
    {
        $set = '';
        $x = 1;

        foreach ($fields as $name => $value) {
            $set .= "{$name} = ?";
            if ($x < count($fields)) {
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

        if (!$this->query($sql, $fields)->error()) {
            return true;
        }
        return false;
    }

    public function results()
    {
        return $this->_results;
    }

    public function first()
    {
        return $this->results()[0];
    }

    public function error()
    {
        return $this->_error;
    }

    public function count()
    {
        return $this->_count;
    }

}
