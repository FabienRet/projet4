<?php

namespace App\src\controller;


use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\DAO\ConnexionDAO;
use App\src\model\View;

class FrontController
{

    private $article;
    private $comment;
    private $connexion;
    private $view;

    public function __construct()
    {
        $this->article = new ArticleDAO();
        $this->comment = new CommentDAO();
        $this->connexion = new ConnexionDAO();
        $this->view = new View();
    }

    public function home(){
        $articles = $this->article->getArticles();
        return $this->view->render('home', ['articles' => $articles]);
    }
    public function admin(){
        $articles = $this->article->getArticles();
        return $this->view->render('admin', ['articles' => $articles]);
        }

    public function article($articleId){
        $article = $this->article->getArticle($articleId);
        $comments = $this->comment->getComment($articleId);
        return $this->view->render('single', ['article' => $article, 'comments' => $comments]);
    }

    public function getComment($idArticle){
        $art = $this->article->getArticle($idArticle);
        $result = $this->comment->getComment($idArticle);
        require '../templates/comment.php';
    }

    public function addArticle($post) {
        if(isset($post) && !empty($post)){
            $this->article->addArticle($post['titre'], $post['article']);
            header ('Location: ../public/index.php');
        }
        require '../templates/articles_add.php';
    }

    public function deleteArticle($idArticle){
        $this->article->deleteArticle($idArticle);
        header('Location: ../public/index.php');
    }

    public function deleteComment($idComment){
        $this->comment->deleteComment($idComment);
        header('Location: ../public/index.php?route=comment&article='.$_GET["ID_article"].'');
    }

    public function addComment($idArticle, $post){
        if(isset($post) && !empty($post)){
            $this->comment->addComment($idArticle, $post['pseudo'], $post['message']);
            header('Location: ../public/index.php?route=comment&article='.$_GET["article"].'');
        }
        require '../templates/comment_add.php?article=';
    }

    public function getArticle($idArticle){
        $result = $this->article->getArticle($idArticle);
        require '../templates/articles_update.php';
    }
    public function updateArticle($idArticle, $post){
        if(isset($post) && !empty($post)) {
            $this->article->updateArticle($post['titre'], $post['article'], $idArticle);
            header('Location: ../public/index.php');
        }
    }
    public function comment($idComment){
        $result = $this->comment->comment($idComment);
        require '../templates/comment_update.php';
    }
    public function updateComment($idComment, $post){
        if(isset($post) && !empty($post)) {
            $this->comment->updateComment($idComment, $post['auteur'], $post['commentaire']);
            header('Location: ../public/index.php?route=comment&article='.$_GET["ID_article"].'');
        }
    }
    public function login($post){
        if(isset($post) && !empty($post)){
            if(!empty($post['pseudo']) && !empty($post['pass'])){
                if($this->connexion->testPseudo($post['pseudo']) == 1){
                    if($this->connexion->checkPass($post['pseudo'], $post['pass']) == 1){
                        $this->connexion->createSession($post['pseudo']);
                        header('Location: ../public/index.php');
                    }else{
                        $alert = 'Mot de passe inconnu';
                    }
                }else{
                    $alert = 'Pseudo inconnu';
                }
            }else{
                $alert = 'Merci de remplir tous les champs';
            }
        }
        if (!empty($alert)){
            echo "<script>alert('$alert')</script>";
        }
        require'../templates/login.php';
    }
    public function inscription($post){
        if(isset($post) && !empty($post)){
            if(!empty($post['pseudo']) && !empty($post['pass']) && !empty($post['checkpass']) && !empty($post['email'])){
                if($this->connexion->testPseudo($post['pseudo']) == 0) {
                    if($this->connexion->testPass($post['pass'], $post['checkpass']) == 0) {
                        if($this->connexion->testEmail($post['email']) == 0){
                            $this->connexion->connexion($post['pseudo'], $post['pass'], $post['email']);
                            header('Location: ../public/index.php');
                        }else{
                            $alert = 'Cet email est déjà utilisé';
                        }
                    }else{
                        $alert= "Les mots de passe ne correspondent pas !";
                    }
                }else{
                    $alert = "Ce pseudo est déjà utilisé !";
                }
            }else{
                $alert = 'Merci de remplir tous les champs !';
            }
        }
        if (!empty($alert)){
            echo "<script>alert('$alert') </script>";

        }
        require '../templates/inscription.php';
    }
    public function logout(){
        session_destroy();
        header('Location: ../public/index.php');
    }
}