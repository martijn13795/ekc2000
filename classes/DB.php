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
            mysqli_query(mysqli_connect(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password')), "CREATE DATABASE " . Config::get('mysql/db'));
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
                . "username VARCHAR(50), "
                . "password VARCHAR(64), "
                . "mail VARCHAR(50), "
                . "salt VARCHAR(32), "
                . "name VARCHAR(50), "
                . "surname_prefix VARCHAR(50),"
                . "surname VARCHAR(50),"
                . "joined DATETIME, "
                . "IconPath VARCHAR(60), "
                . "gender VARCHAR(1), "
                . "birthdate DATE, "
                . "group_id INT)");
            //Create user on first setup
            $salt = Hash::salt(32);
            $this->insert('users', array(
                'username' => 'cassshh',
                'password' => Hash::make('admin'),
                'mail' => 'casvd@hotmail.com',
                'salt' => $salt,
                'name' => 'Cas',
                'surname_prefix' => 'van',
                'surname' => 'Dinter',
                'joined' => date('Y-m-d H:i:s'),
                'IconPath' => '../images/icons/cassshh.png',
                'gender' => 'M',
                'birthdate' => date("Y-m-d", strtotime("1997-05-31")),
                'group_id' => 1
            ));
            $salt = Hash::salt(32);
            $this->insert('users', array(
                'username' => 'martijn13795',
                'password' => Hash::make('admin'),
                'mail' => 'martijn13795@hotmail.com',
                'salt' => $salt,
                'name' => 'Martijn',
                'surname' => 'Posthuma',
                'joined' => date('Y-m-d H:i:s'),
                'IconPath' => '../images/icons/martijn13795.png',
                'gender' => 'M',
                'birthdate' => date("Y-m-d", strtotime("1996-04-22")),
                'group_id' => 1
            ));
            $salt = Hash::salt(32);
            $this->insert('users', array(
                'username' => 'gast',
                'password' => Hash::make('gast'),
                'mail' => 'gast@hotmail.com',
                'salt' => $salt,
                'name' => 'Gast',
                'surname_prefix' => 'van',
                'surname' => 'Kerol',
                'joined' => date('Y-m-d H:i:s'),
                'IconPath' => '../images/icons/default.jpg',
                'gender' => 'F',
                'birthdate' => date('Y-m-d'),
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
                . "date DATETIME, "
                . "approved BOOLEAN DEFAULT FALSE)");
        }
        if ($this->query("DESCRIBE groups")->error()) {
            $this->query("CREATE TABLE groups ("
                . "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                . "name VARCHAR(20))");
            $this->insert('groups', array(
                'id' => '1',
                'name' => 'Dev'
            ));
        }
        if ($this->query("DESCRIBE permissions")->error()) {
            $this->query("CREATE TABLE permissions ("
                . "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                . "user_id INT, "
                . "permissions TEXT)");
            $this->insert('permissions', array(
                'user_id' => '1',
                'permissions' => '{"dev": 1, "admin": 1}'
            ));
            $this->insert('permissions', array(
                'user_id' => '2',
                'permissions' => '{"dev": 1, "admin": 1}'
            ));
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
                . "user_id INT, "
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
                . "user_id INT, "
                . "album_id INT, "
                . "name VARCHAR(255), "
                . "date DATETIME, "
                . "path LONGTEXT, "
                . "pathMobile LONGTEXT)");
        }
        if ($this->query("DESCRIBE news")->error()) {
            $this->query("CREATE TABLE news ("
                . "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                . "user_id INT, "
                . "name VARCHAR(256), "
                . "text LONGTEXT, "
                . "date DATETIME)");
        }
        if ($this->query("DESCRIBE activities")->error()) {
            $this->query("CREATE TABLE activities ("
                . "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                . "user_id INT, "
                . "name VARCHAR(256), "
                . "text LONGTEXT, "
                . "date DATETIME, "
                . "date_activity DATE)");
        }
        if ($this->query("DESCRIBE documents")->error()) {
            $this->query("CREATE TABLE documents ("
                . "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                . "user_id INT, "
                . "name VARCHAR(256), "
                . "description VARCHAR(256), "
                . "path LONGTEXT, "
                . "date DATETIME)");
        }
        if ($this->query("DESCRIBE reports")->error()) {
            $this->query("CREATE TABLE reports ("
                . "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                . "user_id INT, "
                . "team_id INT, "
                . "name VARCHAR(256), "
                . "text LONGTEXT, "
                . "date DATETIME, "
                . "date_match DATE)");
        }
        if ($this->query("DESCRIBE ideas")->error()) {
            $this->query("CREATE TABLE ideas ("
                . "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                . "user_id INT, "
                . "name VARCHAR(256), "
                . "text VARCHAR(512), "
                . "date DATETIME)");
        }
        if ($this->query("DESCRIBE teams")->error()) {
            $this->query("CREATE TABLE teams ("
                . "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                . "name VARCHAR(32), "
                . "path LONGTEXT)");
        }
        if ($this->query("DESCRIBE players")->error()) {
            $this->query("CREATE TABLE players ("
                . "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                . "team_id INT, "
                . "user_id INT)");
        }
        if ($this->query("DESCRIBE trainers")->error()) {
            $this->query("CREATE TABLE trainers ("
                . "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                . "team_id INT, "
                . "user_id INT)");
        }
        if ($this->query("DESCRIBE schedules")->error()) {
            $this->query("CREATE TABLE schedules ("
                . "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                . "team_id INT, "
                . "day_id int, "
                . "start TIME, "
                . "end TIME)");
        }
        if ($this->query("DESCRIBE days")->error()) {
            $this->query("CREATE TABLE days ("
                . "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, "
                . "name VARCHAR(32))");
            $this->insert('days', array(
                'id' => '1',
                'name' => 'Maandag'
            ));
            $this->insert('days', array(
                'id' => '2',
                'name' => 'Dinsdag'
            ));
            $this->insert('days', array(
                'id' => '3',
                'name' => 'Woensdag'
            ));
            $this->insert('days', array(
                'id' => '4',
                'name' => 'Donderdag'
            ));
            $this->insert('days', array(
                'id' => '5',
                'name' => 'Vrijdag'
            ));
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
