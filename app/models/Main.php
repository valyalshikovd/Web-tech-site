<?php

namespace app\models;

use app\core\Model;

class Main extends Model
{

    public $error;
    public function contactValidate($post)
    {
        $namelen = iconv_strlen($post['name']);
        $textlen = iconv_strlen($post['text']);
        if ($namelen < 3 or $namelen > 20) {
            $this->error = "Имя должно содержать от 3-х до 20-ти символов.";
            return false;
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error = "E-mail указан не верно";
            return false;
        } elseif ($textlen < 16 or $textlen > 500) {
            $this->error = "Сообщение должно содержать от 10 до 500 символов";
            return false;
        }
        return true;
    }
    public function postsCount(){
        return $this->db->column('SELECT COUNT(id) FROM posts');
    }

    public function postsList($route)
    {
        return $this->db->row('SELECT * FROM posts ORDER BY id ');
    }

    public function commentValidate($post){
        $namelen = iconv_strlen($post['nickname']);
        $textlen = iconv_strlen($post['text']);
        if ($namelen < 3 or $namelen > 20) {
            $this->error = "Название должно содержать от 3-х до 20-ти символов.";
            return false;
        } elseif ($textlen < 5 or $textlen > 2000) {
            $this->error = "Текст должен содержать от 16 до 2000 символов";
            return false;
        }
        return true;
    }

    public function commentAdd($post, $id)
    {
        $params = [
            'nickname' => $post['nickname'],
            'text' => $post['text'],
            'post' => $id,
        ];

        $this->db->query("INSERT INTO comments (nickname, text, post) VALUES ( :nickname,  :text, :post)", $params);
    }
    public function commentsList($route, $id){
        $max = 10;
        $params = [
            'id' => $id,
            'max' => $max,
            'start' => (((isset($route['page']) ? $route['page'] : 1) - 1) * $max),
        ];
        return $this->db->row('SELECT * FROM comments WHERE post = :id ORDER BY id DESC LIMIT :start, :max', $params);
    }
    public function loginValidate($post)
    {
        $config = require 'app/configuration/adminPass.php';

        if (($post['login'] != $config['login']) or ($post['password'] != $config['password'])) {
            $this->error = 'неверный логин иди пароль';
            return false;
        }
        return true;
    }


}