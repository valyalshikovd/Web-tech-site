<?php
namespace app\controllers;
use app\lib\Pagination;
use app\models\Main;
use Exception;

class
AdminController extends \app\core\Controller
{
    public function __construct($route) {
        parent::__construct($route);
        $this->view->layout = 'admin';
    }
    public function logoutAction()
    {
        unset($_SESSION['admin']);
        $this->view->redirect('../../');
    }
    public function addPostAction()
    {
        if (!empty($_POST)) {
            if (!$this->model->postValidate($_POST, 'add')) {
                $this->view->message('error', $this->model->error);
            }
            $id = null;
            try{
                $id = $this->model->postAdd($_POST);
            }catch(Exception $e){
                $this->view->message('success', "cho za huinya");
            }
            if(!$id){
                $this->view-message('success', 'что-то пошло не так' );
            }
            try{
//                $this->model->postUploadImage($_FILES['img']['tmp_name'], $id);
            }catch (Exception $e){
                $this->view->message('success', $e->getMessage());
            }
            $this->view->message('success', "пост добавлен");
        }

        $this->view->render("Добавить пост");

    }
    public function deletePostAction()
    {
        if (!$this->model->isPostExists($this->route['id'])){
            $this->view->errorCode(404);
        }
        $this->model->postDelete($this->route['id']);
        $this->view->redirect('/admin/posts');
    }
    public function editPostAction()
    {
        if (!$this->model->isPostExists($this->route['id'])){
            $this->view->errorCode(404);
        }

        if (!empty($_POST)) {
            if (!$this->model->postValidate($_POST, 'edit')) {
                $this->view->errorCode(404);
            }
            try {
                $this->model->postEdit($_POST, $this->route['id']);
            }catch (Exception $e){
                $this->view->errorCode(404);
                $this->view->message('error', $e->getMessage());
            }
            //$this->view->message('success', 'сохранено');
        }
        $vars = [
            'data' => $this->model->postData($this->route['id'])
        ];
       // $this->view->layout = "admin2";
        $this->view->render("Редактировать пост", $vars);
    }
    public function deleteCommentAction()
    {
        $id = ($this->model->getPostId($this->route['id']));
        $this->model->commentDelete($this->route['id']);
        $this->view->redirect('/admin/comments/'.$id);
    }
    public function postsAction()
    {
        $mainModel = new Main();
        $pagination = new Pagination($this->route, 4);
        $vars = ['pagination' => $pagination->get(),
            'list' => $mainModel->postsList($this->route),
        ];
        $this->view->render("Посты", $vars);
    }
    public function commentsAction(){
        $mainModel = new Main();
        $vars = [
            'list' => $mainModel->commentsList($this->route, $this->route['id']),
        ];
        $this->view->layout = "admin2";
        $this->view->render('Комментарии', $vars);
    }
}