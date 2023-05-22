<?php

namespace app\controllers;

use app\lib\Pagination;
use app\models\Admin;

class MainController extends \app\core\Controller

{
    public function indexAction()
    {
        $pagination = new Pagination($this->route, 2);
        $vars = ['pagination' => $pagination->get(),
            'list' => $this->model->postsList($this->route),
        ];
        $this->view->render("Главная страница", $vars);
    }
    public function aboutAction()
    {
        $this->view->render("Обо мне");
    }
    public function contactsAction()
    {
        $this->view->render("Контакты");
    }
    public function commentAction()
    {
        if (!empty($_POST)) {
            if (!$this->model->commentValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }

            try{
                $this->model->commentAdd($_POST, $this->route['id']);
            }catch(Exception $e){
                $this->view->message('success', "error database");
            }
            $this->view->location('/post/'.$this->route['id']);
        }
        $this->view->render("Добавить коммент", $this->route);
    }

    public function postAction() {

        if (isset($_COOKIE["counter"])) {
            $counter = $_COOKIE["counter"] + 1;
        } else {
            $counter = 1;
        }

        setcookie("counter", $counter);

        $adminModel = new Admin;
        if (!$adminModel->isPostExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        $vars = [
            'data' => $adminModel->postData($this->route['id'])[0],
            'list' => $this->model->commentsList($this->route, $this->route['id']),
        ];
        $this->view->render('Пост', $vars);
    }
    public function loginAction()
    {
        if(isset($_SESSION['admin'])){
            $this->view->redirect('admin/addPost');
        }
        if (!empty($_POST)) {
            if ($this->model->loginValidate($_POST)) {
                $_SESSION['admin'] = true;
                $this->view->location('admin/addPost');
            }
        }
        $this->view->render("Вход");
    }
}