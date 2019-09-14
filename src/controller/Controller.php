<?php
namespace App\src\controller;

use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\DAO\ConnectionDAO;
use Twig\Loader\FilesystemLoader;

class Controller{

    protected $article;
    protected $comment;
    protected $connection;
    protected $twig;

    public function __construct()
    {
        $this->article = new ArticleDAO();
        $this->comment = new CommentDAO();
        $this->connection = new ConnectionDAO();
        $loader = new FilesystemLoader('../templates');
        $this->twig = new \Twig\Environment($loader, [
            //TODO : activate'cache' => '../var/cache',
            'debug' => true //TODO : unactivate
        ]);
        $app = [
            'get' => $_GET,
            'session' => $_SESSION,
            'post' => $_POST,
            'cookie' => $_COOKIE
        ];
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
        $this->twig->addGlobal( 'app', $app);
    }
}