<?php
 namespace App\src\DAO;

class ArticleDAO extends Database
{
    public function getArticles()
    {
        $sql = 'SELECT b.id, b.title, b.content, b.created_at, (SELECT count(*) FROM comment c WHERE c.id_article=b.id) as nbComment 
                FROM article b 
                left join comment c on c.id_article = b.id 
                group by b.id ORDER BY b.id DESC LIMIT 0, 5 ';
        $result = $this->sql($sql);
        return $result;
    }

    public function getArticle($idArt)
    {
        $sql = 'SELECT id, title, content, created_at FROM article WHERE id = ?';
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
    public function getTitle(){
        $sql = 'SELECT id, title FROM article ORDER BY id';
        $result = $this->sql($sql);
        return $result;
    }
}