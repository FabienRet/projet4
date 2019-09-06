<?php
 namespace App\src\DAO;

class ArticleDAO extends Database
{
    public function getArticles()
    {
        $sql = 'SELECT id, title, content, DATE_FORMAT(created_at, \'%d/%m/%Y à %Hh%imin%ss\') AS created_at_fr FROM article ORDER BY created_at DESC LIMIT 0, 5';
        $result = $this->sql($sql);
        return $result;
    }

    public function getArticle($idArt)
    {
        $sql = 'SELECT id, title, content, DATE_FORMAT(created_at, \'%d/%m/%Y à %Hh%imin%ss\') AS created_at_fr FROM article WHERE id = ?';
        $result = $this->sql($sql, [$idArt]);
        return $result;
    }

    public function deleteArticle($idArt)
    {
        $sql = 'DELETE FROM article WHERE id=?';
        $result = $this->sql($sql, [$idArt]);
        return $result;
    }

    public function addArticle($titleArt, $articleArt)
    {
        $sql = 'INSERT INTO article(title, content, created_at) VALUES (?, ?, NOW())';
        $result = $this->sql($sql, [$titleArt, $articleArt]);
        return $result;
    }

    public function updateArticle($titleArt, $articleArt, $idArt){
        $sql = "UPDATE article SET title = ?, content = ? WHERE id = ?";
        $result = $this->sql($sql, [$titleArt, $articleArt, $idArt]);
        return $result;
    }
}