<?php

namespace App\src\DAO;

Class CommentDAO extends Database
{
    public function getComment($idArticle){
        $sql = 'SELECT id, name, content, report, created_at FROM comment WHERE id_article = ? ORDER BY created_at DESC';
        $result = $this->sql($sql, [$idArticle]);
        return $result;
    }

    public function addComment($idArticle, $mess){
        $sql ='INSERT INTO comment(id_article, name, content, created_at) VALUES (?, ?, ?, NOW())';
        $result = $this->sql($sql, [$idArticle, $_SESSION['name'], $mess]);
        return $result;
    }
    public function deleteComment($idComment){
        $sql = 'DELETE FROM comment WHERE id=?';
        $result = $this->sql($sql, [$idComment]);
        return $result;
    }
    public function comment ($idComment){
        $sql = 'SELECT name, content FROM comment WHERE id = ?';
        $result = $this->sql($sql, [$idComment]);
        return $result;
    }
    public function updateComment ($idComment, $nameComment, $textComment){
        $sql = "UPDATE comment SET name = ?, content = ? WHERE id = ?";
        $result = $this->sql($sql, [$nameComment, $textComment, $idComment]);
        return $result;
    }
    public function reportComment($idComment){
        $sql = "UPDATE comment SET report = ? WHERE id = ?";
        $result = $this->sql($sql, [1, $idComment]);
        return $result;
    }
    public function getReportComment(){
        $sql = 'SELECT id, name, content, DATE_FORMAT(created_at, \'%d/%m/%Y\') AS created_at FROM comment WHERE report = 1';
        $comment = $this->sql($sql);
        return $comment;
    }
    public function commentMember(){
        $sql = 'SELECT content, DATE_FORMAT(created_at, \'%d/%m/%Y\') AS created_at FROM comment WHERE name = ?';
        $result = $this->sql($sql, [$_SESSION['name']]);
        return $result;
    }
    public function validateComment($idComment){
        $sql = "UPDATE comment SET report = ? WHERE id = ?";
        $result = $this->sql($sql, [0, $idComment]);
        return $result;
    }
}