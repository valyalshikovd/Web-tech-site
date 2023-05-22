<?php

namespace app\lib;

use app\core\View;
use PDO;
use PDOException;

class Db
{

    public $db;

    public function __construct()
    {
        $config = require 'app/configuration/db.php';

        try {
            ini_set('display_errors','Off');
            $this->db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['name'], $config['user'], $config['password']);
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            //debug($e->getMessage());
            View::errorCode(500);      //подключение к БД
        }

    }


    public function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                if (is_int($val)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }
                $stmt->bindValue(':'.$key, $val, $type);
            }
        }
        $stmt->execute();
        return $stmt;
    }


    public function row($sql, $params = []){
        $res = $this->query($sql, $params);
        return $res->fetchAll(PDO::FETCH_ASSOC);  //ну вывод либо строчки

    }

    public function column($sql, $params = [] ){
        $res = $this->query($sql, $params);
        return $res->fetchColumn();         //либо колонки
    }

    public function lastInsertId() {
        return $this->db->lastInsertId();
    }

}