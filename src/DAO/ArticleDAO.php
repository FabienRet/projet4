<?php
 namespace App\src\DAO;

class ArticleDAO extends Database
{
    public function getArticles()
    {
        $sql = 'SELECT ID, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5';
        $result = $this->sql($sql);
        return $result;
    }

    public function getArticle($idArt)
    {
        $sql = 'SELECT ID, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE ID = ?';
        $result = $this->sql($sql, [$idArt]);
        return $result;
    }

    public function deleteArticle($idArt)
    {
        $sql = 'DELETE FROM billets WHERE ID=?';
        $result = $this->sql($sql, [$idArt]);
        return $result;
    }

    public function addArticle($titreArt, $articleArt)
    {
        $sql = 'INSERT INTO billets(titre, contenu, date_creation) VALUES (?, ?, NOW())';
        $result = $this->sql($sql, [$titreArt, $articleArt]);
        return $result;
    }

    public function updateArticle($titreArt, $articleArt, $idArt){
        $sql = "UPDATE billets SET titre = ?, contenu = ? WHERE ID = ?";
        $result = $this->sql($sql, [$titreArt, $articleArt, $idArt]);
        return $result;
    }
}