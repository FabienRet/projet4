<?php

namespace App\config;

use App\src\controller\FrontController;

class Router{

    private $frontController;

    public function __construct()
    {
        $this->frontController = new FrontController();
    }

    public function run(){
		try{
			if(isset($_GET['route'])){
				if($_GET['route'] == 'add_article'){
					$this->frontController->addArticle($_POST);
				}
				else if($_GET['route'] == 'delete_article'){
				    $this->frontController->deleteArticle($_GET['article']);
                }
                else if($_GET['route'] == 'comment'){
                    $this->frontController->getComment($_GET['article']);
                }
                else if($_GET['route'] == 'add_comment'){
				    $this->frontController->addComment($_GET['article'], $_POST);
                }
                else if($_GET['route'] == 'delete_comment'){
                    $this->frontController->deleteComment($_GET['ID_comment']);
                }
                else if($_GET['route'] == 'get_article') {
				    $this->frontController->getArticle($_GET['article']);
                }
                else if($_GET['route'] == 'update_article'){
                    $this->frontController->updateArticle($_GET['article'], $_POST);
                }
                else if ($_GET['route'] == 'get_comment'){
                    $this->frontController->comment($_GET['ID_comment']);
                }
                else if($_GET['route'] == 'update_comment'){
                    $this->frontController->updatecomment($_GET['ID_comment'], $_POST);
                }
              	else if($_GET['route'] == 'inscription'){
                  $this->frontController->inscription($_POST);
                }
                else if ($_GET['route'] == 'login'){
                  $this->frontController->login($_POST);
                }
                else{
				echo 'Autre page !';
			}
			}else{
				$this->frontController->home();
			}
		}catch (\Exception $e){
			echo 'Erreur';
		}
	}
}