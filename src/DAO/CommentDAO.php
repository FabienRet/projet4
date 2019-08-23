<?php

namespace App\src\DAO;

Class CommentDAO extends Database
{
    public function getComment($idArticle){
        $sql = 'SELECT ID, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire';
        $result = $this->sql($sql, [$idArticle]);
        return $result;
    }

    public function addComment($idArticle, $titre, $mess){
        $sql ='INSERT INTO commentaires(id_billet, auteur, commentaire, date_commentaire) VALUES (?, ?, ?, NOW())';
        $result = $this->sql($sql, [$idArticle, $titre, $mess]);
        return $result;
    }

    public function deleteComment($idComment){
        $sql = 'DELETE FROM commentaires WHERE ID=?';
        $result = $this->sql($sql, [$idComment]);
        return $result;
    }
    public function comment ($idComment){
        $sql = 'SELECT auteur, commentaire FROM commentaires WHERE ID = ?';
        $result = $this->sql($sql, [$idComment]);
        return $result;
    }
    public function updateComment ($idComment, $auteurComment, $textComment){
        $sql = "UPDATE commentaires SET auteur = ?, commentaire = ? WHERE ID = ?";
        $result = $this->sql($sql, [$auteurComment, $textComment, $idComment]);
        return $result;
    }
}