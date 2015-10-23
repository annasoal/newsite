<?php

namespace Core;


class SqlDb
{

    private static $instance;
    private $db;


    public static function app()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        //$config = include __DIR__ . '/../configs.php';
        //$this->db = new \PDO('mysql:host=' .$config['host'] . ';dbname=' . $config['dname'], $config['user'], $config['password']);
        $this->db = new \PDO('mysql:host=' . HOST . ';dbname=' . DNAME, USER, PASSWORD);
        $this->db->exec('SET NAMES UTF8');
        $this->db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    }

    public function select($query, $params = [])
    {
        $q = $this->db->prepare($query);
        $q->execute($params);

        if ($q->errorCode() != \PDO::ERR_NONE) {
            $info = $q->errorInfo();
            die($info[2]); // времменная мера
        }

        return $q->fetchAll();
    }



    public function insert($table, $object)
    {
        $columns = [];

        foreach ($object as $key => $value) {

            $columns[] = $key;
            $masks[] = ":$key";

            if ($value === null) {
                $object[$key] = 'NULL';
            }
        }

        $columns_s = implode(',', $columns);
        $masks_s = implode(',', $masks);

        $query = "INSERT INTO $table ($columns_s) VALUES ($masks_s)";

        $q = $this->db->prepare($query);
        $q->execute($object);

        if ($q->errorCode() != \PDO::ERR_NONE) {
            $info = $q->errorInfo();
            die($info[2]);
        }

        return $this->db->lastInsertId();
    }

    public function update($table, $object, $where, $params = [])
    {
        $sets = [];

        //var_dump($object);

        foreach ($object as $key => $value) {

            $sets[] = "$key=:$key";

            if ($value === NULL) {
                $object[$key] = 'NULL';
            }
        }

        $sets_s = implode(',', $sets);
        $query = "UPDATE $table SET $sets_s WHERE $where";

        //var_dump($query);

        $q = $this->db->prepare($query);
        $q->execute(array_merge($object, $params));


        if ($q->errorCode() != \PDO::ERR_NONE) {
            $info = $q->errorInfo();
            die($info[2]);
        }

        return $q->rowCount();
    }


    public function delete($table, $where, $params = [])
    {
        $query = "DELETE FROM $table WHERE $where";
        $q = $this->db->prepare($query);
        $q->execute($params);

        if ($q->errorCode() != \PDO::ERR_NONE) {
            $info = $q->errorInfo();
            die($info[2]);
        }

        return $q->rowCount();
    }

}