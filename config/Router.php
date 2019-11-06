<?php

namespace App\config;

use App\src\controller\BackController;
use App\src\controller\FrontController;

class Router{

    private $frontController;
    private $backController;

    public function __construct()
    {
        $this->frontController = new FrontController();
        $this->backController = new BackController();
    }

    public function run(){
        try {
            if (isset($_GET['route'])) {
                if ($_GET['route'] == 'add_article') {
                    $this->backController->addArticle($_POST);
                }else if($_GET['route'] == 'add_new_article'){
                    $this->backController->addNewArticle($_POST);
                } else if ($_GET['route'] == 'single') {
                    $this->frontController->article($_GET['articleId']);
                } else if ($_GET['route'] == 'delete_article') {
                    $this->backController->deleteArticle($_GET['articleId']);
                } else if ($_GET['route'] == 'add_comment') {
                    $this->backController->addComment($_GET['articleId'], $_POST);
                } else if ($_GET['route'] == 'delete_comment') {
                    $this->backController->deleteComment($_GET['ID_comment']);
                } else if ($_GET['route'] == 'get_article') {
                    $this->frontController->getArticle($_GET['articleId']);
                }else if($_GET['route'] == 'get_comment'){
                    $this->frontController->comment($_GET['ID_comment']);
                } else if ($_GET['route'] == 'update_article') {
                    $this->backController->updateArticle($_GET['articleId'], $_POST);
                } else if ($_GET['route'] == 'update_comment') {
                    $this->backController->updatecomment($_GET['ID_comment'], $_POST);
                } else if ($_GET['route'] == 'register') {
                    $this->frontController->register($_POST);
                } else if ($_GET['route'] == 'login') {
                    $this->frontController->login($_POST);
                } else if ($_GET['route'] == 'logout') {
                    $this->frontController->logout();
                } else if ($_GET['route'] == 'admin') {
                    $this->backController->admin();
                } else if ($_GET['route'] == 'member') {
                    $this->backController->member($_SESSION['name']);
                } else if ($_GET['route'] == 'update_member') {
                    $this->backController->update_member();
                } else if ($_GET['route'] == 'update') {
                    $this->backController->update($_POST);
                } else if ($_GET['route'] == 'report') {
                    $this->backController->report($_GET['ID_comment'], $_GET['articleId']);
                } else if ($_GET['route'] == 'reportComment') {
                    $this->backController->reportComment();
                } else if ($_GET['route'] == 'listUser') {
                    $this->backController->listUser();
                } else if ($_GET['route'] == 'newName') {
                    $this->backController->newName($_POST);
                } else if ($_GET['route'] == 'newMail') {
                    $this->backController->newMail($_POST);
                } else if ($_GET['route'] == 'newPass') {
                    $this->backController->newPass($_POST);
                } else if ($_GET['route'] == 'delete_member') {
                    $this->backController->deleteMember();
                } else if ($_GET['route'] == 'comment_member') {
                    $this->backController->commentMember();
                } else if ($_GET['route'] == 'validate_comment') {
                    $this->backController->validateComment($_GET['ID_comment']);
                } else {
                    echo 'Autre page !';
                }
            } else {
                $this->frontController->home();
            }
        }
        catch
        (\Exception $e){
            echo 'Erreur';
            //TODO : activate errors
            var_dump($e->getMessage());
        }

    }
}