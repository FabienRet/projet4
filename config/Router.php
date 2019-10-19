<?php

namespace App\config;

use App\src\controller\FrontController;

class Router{

    private $frontController;

    public function __construct()
    {
        $this->frontController = new FrontController();
    }

    public function run(){
		try {
                if (isset($_GET['route'])) {
                    if ($_GET['route'] == 'add_article') {
                        $this->frontController->addArticle($_POST);
                    } else if ($_GET['route'] == 'single') {
                        $this->frontController->article($_GET['articleId']);
                    } else if ($_GET['route'] == 'delete_article') {
                        $this->frontController->deleteArticle($_GET['article']);
                    } else if ($_GET['route'] == 'comment') {
                        $this->frontController->getComment($_GET['article']);
                    } else if ($_GET['route'] == 'add_comment') {
                        $this->frontController->addComment($_GET['articleId'], $_POST);
                    } else if ($_GET['route'] == 'delete_comment') {
                        $this->frontController->deleteComment($_GET['ID_comment']);
                    } else if ($_GET['route'] == 'get_article') {
                        $this->frontController->getArticle($_GET['articleId']);
                    }else if($_GET['route'] == 'get_comment'){
                        $this->frontController->comment($_GET['ID_comment']);
                    } else if ($_GET['route'] == 'update_article') {
                        $this->frontController->updateArticle($_GET['article'], $_POST);
                    } else if ($_GET['route'] == 'update_comment') {
                        $this->frontController->updatecomment($_GET['ID_comment'], $_POST);
                    } else if ($_GET['route'] == 'register') {
                        $this->frontController->register($_POST);
                    } else if ($_GET['route'] == 'login') {
                        $this->frontController->login($_POST);
                    } else if ($_GET['route'] == 'logout') {
                        $this->frontController->logout();
                    } else if ($_GET['route'] == 'admin') {
                        $this->frontController->admin();
                    } else if ($_GET['route'] == 'member') {
                        $this->frontController->member($_SESSION['name']);
                    } else if ($_GET['route'] == 'update_member') {
                        $this->frontController->update_member();
                    } else if ($_GET['route'] == 'update') {
                        $this->frontController->update($_POST);
                    } else if ($_GET['route'] == 'report') {
                        $this->frontController->report($_GET['ID_comment'], $_GET['articleId']);
                    } else if ($_GET['route'] == 'reportComment') {
                        $this->frontController->reportComment();
                    } else if ($_GET['route'] == 'listUser') {
                        $this->frontController->listUser();
                    } else if ($_GET['route'] == 'newName') {
                        $this->frontController->newName($_POST);
                    } else if ($_GET['route'] == 'newMail') {
                        $this->frontController->newMail($_POST);
                    } else if ($_GET['route'] == 'newPass') {
                        $this->frontController->newPass($_POST);
                    } else if ($_GET['route'] == 'delete_member') {
                        $this->frontController->deleteMember();
                    } else if ($_GET['route'] == 'comment_member') {
                        $this->frontController->commentMember();
                    } else if ($_GET['route'] == 'validate_comment') {
                        $this->frontController->validateComment($_GET['ID_comment']);
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