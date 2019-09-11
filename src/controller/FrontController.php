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
        echo $this->twig->render('admin.html.twig', ['articles' => $articles]);
        }

    public function member($name){
        $info = $this->connection->infoTab($name);
        echo $this->twig->render('member.html.twig', ['info' => $info]);
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
        echo $this->twig->render('article_add.html.twig');
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
        echo $this->twig->render('article_update.html.twig', ['result' => $result]);
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
            $this->comment->updateComment($idComment, $post['name'], $post['content']);
            header('Location: ../public/index.php?route=comment&article='.$_GET["ID_article"].'');
        }
    }
    public function login($post){
        if(isset($post) && !empty($post)){
            if(!empty($post['pseudo']) && !empty($post['pass'])){
                if($this->connection->testName($post['pseudo']) == 1){
                    if($this->connection->checkPass($post['pseudo'], $post['pass']) == 1){
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
                            $this->connection->connection($post['pseudo'], $post['pass'], $post['email']);
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

    public function update_member(){
        $infosMember = $this->connection->infoTab($_SESSION['name']);
        echo $this->twig->render('member_update.html.twig', ['infoMember' => $infosMember]);
    }
     public function update($post){
         if($this->connection->testPass($post['pass'], $post['checkpass']) == 0) {
     }
    }

    public function report($comment){
        $this->comment->reportComment($comment);
        header('Location: ../public/index.php?route=comment&article='.$_GET["ID_article"].'');
    }

    public function logout(){
        session_destroy();
        header('Location: ../public/index.php');
    }
}