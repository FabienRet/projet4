<?php

namespace App\src\DAO;
use PDO;

class Database{

    public function getConnection(){
        try
        {
            $bdd = new PDO(DB_HOST, DB_USER, DB_PASS);
            return $bdd;
        }
        catch(\Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
    public function sql($sql, $parameters = null){
        if($parameters){
            $req = $this->getConnection()->prepare($sql);
            $req->execute($parameters);
        }else{
            $req = $this->getConnection()->query($sql);
        }
        return $req;
    }
}