<?php

namespace App\src\controller;


class BackController extends Controller
{
    public function getConnect(){
        if(!isset($_SESSION['name'])){
            header('Location: ../public/index.php');
        }
    }
    public function getAdmin(){
        $this->getConnect();
        if($_SESSION['id'] != 2){
            header('Location: ../public/index.php');
        }
    }
    public function admin(){
        $this->getAdmin();
        $articles = $this->article->getArticles();
        $users = $this->connection->userList();
        $comment = $this->comment->getReportComment();
        echo $this->twig->render('admin.html.twig', ['articles' => $articles, 'users' => $users, 'comment'=> $comment]);
    }
    public function member($name){
        $this->getConnect();
        $info = $this->connection->infoTab($name);
        $comment = $this->comment->commentMember();
        $infos = $this->connection->infoTab($_SESSION['name']);
        echo $this->twig->render('member.html.twig', ['info' => $info, 'comment'=> $comment, 'infos'=>$infos ]);
    }
    public function addArticle($post) {
        $this->getAdmin();
        if(isset($post) && !empty($post)){
            $this->article->addArticle($post['titre'], $post['article']);
            header ('Location: ../public/index.php');
        }
        echo $this->twig->render('article_add.html.twig');
    }
    public function deleteArticle($idArticle){
        $this->getConnect();
        $this->article->deleteArticle($idArticle);
        $this->admin();
    }
    public function deleteComment($idComment){
        $this->getConnect();
        $this->comment->deleteComment($idComment);
        header('Location: ../public/index.php?route=single&articleId='.$_GET["articleId"].'');
    }
    public function addComment($idArticle, $post){
        $this->getConnect();
        if(isset($post) && !empty($post)){
            $this->comment->addComment($idArticle, $post['message']);
            header('Location: ../public/index.php?route=single&articleId='.$_GET["articleId"].'');
        }
    }
    public function updateArticle($idArticle, $post){
        $this->getConnect();
        if(isset($post) && !empty($post)) {
            $this->article->updateArticle($post['titre'], $post['article'], $idArticle);
            $this->admin();
        }
    }
    public function comment($idComment){
        $this->getConnect();
        $comment = $this->comment->comment($idComment);
        echo $this->twig->render('comment_update.html.twig', ['comment' => $comment]);
    }
    public function updateComment($idComment, $post){
        $this->getConnect();
        if(isset($post) && !empty($post)) {
            $this->comment->updateComment($idComment, $post['name'], $post['content']);
            header('Location: ../public/index.php?route=single&articleId='.$_GET["articleId"].'');
        }
    }
    public function update_member(){
        $this->getConnect();
        $info = $this->connection->infoTab($_SESSION['name']);
        echo $this->twig->render('member_update.html.twig', ['info' => $info]);
    }
    public function report($comment, $articleId){
        $this->getConnect();
        $this->comment->reportComment($comment);
        header('Location: ../public/index.php?route=single&articleId='.$articleId);
    }
    public function validateComment($comment){
        $this->getAdmin();
        $this->comment->validateComment($comment);
        header('Location: ../public/index.php?route=reportComment');
    }

    public function reportComment(){
        $this->getConnect();
        $comment = $this->comment->getReportComment();
        echo $this->twig->render('report_comment.html.twig', ['comment' => $comment]);
    }
    public function listUser(){
        $this->getAdmin();
        $users = $this->connection->userList();
        return $users;
    }
    public function newName($post){
        $this->getConnect();
        if($this->connection->testName($post['name']) == 0) {
            $this->connection->newname($post['name']);
            $this->connection->createSession($post['name']);
            header('Location: ../public/index.php?route=member');
        }else{
            $alert = "Ce pseudo est déjà utilisé !";
        }
        if (!empty($alert)){
            echo "<script>alert('$alert') </script>";
        }
        header('Location: ../public/index.php?route=update_member');
    }
    public function newMail($post){
        $this->getConnect();
        if($this->connection->testEmail($post['email']) == 0) {
            $this->connection->NewMail($post['email']);
            header('Location: ../public/index.php?route=member');
        }else{
            $alert = 'Cet email est déjà utilisé';
        }
        if (!empty($alert)){
            echo "<script>alert('$alert') </script>";
        }
        header('Location: ../public/index.php?route=update_member');
    }
    public function newPass($post){
        $this->getConnect();
        if($this->connection->testPass($post['pass'], $post['checkpass']) == 0) {
            $pass=$this->connection->hashPass($post['pass']);
            $this->connection->newPass($pass);
            header('Location: ../public/index.php?route=member');
        }else{
            $alert= "Les mots de passe ne correspondent pas !";
        }
        if (!empty($alert)){
            echo "<script>alert('$alert') </script>";
        }
        header('Location: ../public/index.php?route=update_member');
    }
    public function deleteMember(){
        $this->getConnect();
        $this->connection->deleteMember();
        $this->logout();
        header('Location: ../public/index.php');
    }
    public function commentMember(){
        $this->getConnect();
        $comment = $this->comment->commentMember();
        echo $this->twig->render('my_comment.html.twig', ['comment' => $comment]);
    }
}