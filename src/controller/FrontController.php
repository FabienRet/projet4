<?php

namespace App\src\controller;



class FrontController extends Controller
{



    public function home(){
        $articles = $this->article->getArticles();
        echo $this->twig->render('home.html.twig', ['articles' => $articles]);
    }
    public function admin(){
        $articles = $this->article->getArticles();
        return $this->view->render('admin', ['articles' => $articles]);
        }

    public function member($name){
        $session = $this->connexion->infoTab($name);
        var_dump($session);
        return $this->view->render('member', ['session' => $session]);
    }

    public function article($articleId){
        $article = $this->article->getArticle($articleId);
        $comments = $this->comment->getComment($articleId);
        echo $this->twig->render('single.html.twig', ['article' => $article, 'comment' => $comments]);
    }

    public function getComment($idArticle){
        $article = $this->article->getArticle($idArticle);
        $comment = $this->comment->getComment($idArticle);
        echo $this->twig->render('comment.html.twig', ['article' => $article, 'comment' => $comment]);
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
            $this->comment->addComment($idArticle, $post['message']);
            header('Location: ../public/index.php?route=comment&article='.$_GET["article"].'');
        }
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
        $comment = $this->comment->comment($idComment);
        echo $this->twig->render('comment_update.html.twig', ['comment' => $comment]);
    }
    public function updateComment($idComment, $post){
        if(isset($post) && !empty($post)) {
            $this->comment->updateComment($idComment, $post['content']);
            header('Location: ../public/index.php?route=comment&article='.$_GET["ID_article"].'');
        }
    }
    public function login($post){
        if(isset($post) && !empty($post)){
            if(!empty($post['pseudo']) && !empty($post['pass'])){
                if($this->connexion->testName($post['pseudo']) == 1){
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
    public function register($post){
        if(isset($post) && !empty($post)){
            if(!empty($post['pseudo']) && !empty($post['pass']) && !empty($post['checkpass']) && !empty($post['email'])){
                if($this->connexion->testPseudo($post['pseudo']) == 0) {
                    if($this->connexion->testPass($post['pass'], $post['checkpass']) == 0) {
                        if($this->connexion->testEmail($post['email']) == 0){
                            $this->connexion->connection($post['pseudo'], $post['pass'], $post['email']);
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
        require '../templates/register.php';
    }

    public function logout(){
        session_destroy();
        header('Location: ../public/index.php');
    }
}