<?php
namespace app\models;
use app\core\Model;
use Imagick;
class Admin extends Model
{
    public $error;
    public function loginValidate($post)
    {
        $config = require 'app/configuration/adminPass.php';

        if (($post['login'] != $config['login']) or ($post['password'] != $config['password'])) {
            $this->error = 'неверный логин иди пароль';
            return false;
        }
        return true;
    }
    public function postValidate($post, $type)
    {
        $namelen = iconv_strlen($post['name']);
        $descriptionLen = iconv_strlen($post['description']);
        $textlen = iconv_strlen($post['text']);
        if ($namelen < 3 or $namelen > 20) {
            $this->error = "Название должно содержать от 3-х до 20-ти символов.";
            return false;
        } elseif ($descriptionLen < 3 or $descriptionLen > 40) {
            $this->error = "Описание должно содержать от 3-х до 40-ка символов.";
            return false;
        } elseif ($textlen < 16 or $textlen > 2000) {
            $this->error = "Текст должен содержать от 16 до 2000 символов";
            return false;
        }
        return true;
    }
    public function postAdd($post)
    {
        $params = [
            'name' => $post['name'],
            'description' => $post['description'],
            'text' => $post['text'],
        ];
        $this->db->query("INSERT INTO posts (name, description, text) VALUES ( :name, :description, :text)", $params);
        return $this->db->lastInsertId();
    }

    public function isPostExists($id)
    {
        $params = ['id' => $id];
        return $this->db->column('SELECT id FROM posts WHERE id = :id', $params);
    }
    public function postDelete($id)
    {
        $params = ['id' => $id];
        $this->db->query('DELETE FROM posts WHERE id = :id', $params);
        $this->db->query('DELETE FROM comments WHERE post = :id', $params);
    }
    public function commentDelete($id)
    {
        $params = ['id' => $id];
        $this->db->query('DELETE FROM comments WHERE id = :id', $params);
    }
    public function getPostId($id)
    {
        $params = ['id' => $id];
        return  $this->db->column('SELECT post FROM comments WHERE id = :id', $params);
    }
    public function postData($id)
    {
        $params = [
            'id' => $id
        ];
        return $this->db->row('SELECT * FROM posts WHERE id = :id', $params);
    }
    public function postEdit($post, $id)
    {
        $params = [
            'id' => $id,
            'name' => $post['name'],
            'description' => $post['description'],
            'text' => $post['text'],
        ];
        $this->db->query('UPDATE posts SET name = :name, description = :description, text = :text WHERE id = :id', $params);
    }
    public function postsList($route)
    {
        $max = 1;
        $params = [
            'max' => $max,
            'start' => ((isset($route['page']) ? $route['page'] : 1) - 1) * $max
        ];
        return $this->db->row('SELECT * FROM posts ORDER BY id DESC LIMIT :start, :max', $params);
    }
}
