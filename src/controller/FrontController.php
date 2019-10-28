<?php

namespace App\src\controller;



class FrontController extends Controller
{

    public function home(){
        $articles = $this->article->getArticles();
        $article = $this->article->getTitle();
        echo $this->twig->render('home.html.twig', ['articles' => $articles, 'article' => $article]);
    }
    public function article($articleId){
        $article = $this->article->getArticle($articleId);
        $comments = $this->comment->getComment($articleId);
        echo $this->twig->render('single.html.twig', ['article' => $article, 'comment' => $comments]);
    }
    public function getArticle($idArticle){
        $result = $this->article->getArticle($idArticle);
        echo $this->twig->render('article_update.html.twig', ['result' => $result]);
    }
    public function comment($idComment){
        $comment = $this->comment->comment($idComment);
        echo $this->twig->render('comment_update.html.twig', ['comment' => $comment]);
    }
    public function login($post){
        if(isset($post) && !empty($post)){
            $pass = $this->connection->hashPass($post['pass']);
            if(!empty($post['pseudo']) && !empty($post['pass'])){
                if($this->connection->testName($post['pseudo']) == 1){
                    if($this->connection->checkPass($post['pseudo'], $pass) == 1){
                        $this->connection->createSession($post['pseudo']);
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
        echo $this->twig->render('login.html.twig');
    }
    public function register($post){
        if(isset($post) && !empty($post)){
            if(!empty($post['pseudo']) && !empty($post['pass']) && !empty($post['checkpass']) && !empty($post['email'])){
                if($this->connection->testName($post['pseudo']) == 0) {
                    if($this->connection->testPass($post['pass'], $post['checkpass']) == 0) {
                        if($this->connection->testEmail($post['email']) == 0){
                            $pass = $this->connection->hashPass($post['pass']);
                            $this->connection->connection($post['pseudo'], $pass, $post['email']);
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
        echo $this->twig->render('register.html.twig');
    }
    public function logout(){
        session_destroy();
        header('Location: ../public/index.php');
    }

}