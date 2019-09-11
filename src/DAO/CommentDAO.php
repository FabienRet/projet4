<?php

namespace App\src\DAO;

Class CommentDAO extends Database
{
    public function getComment($idArticle){
        $sql = 'SELECT id, name, content, DATE_FORMAT(created_at, \'%d/%m/%Y à %Hh%imin%ss\') AS created_at FROM comment WHERE id_article = ? ORDER BY created_at';
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
}