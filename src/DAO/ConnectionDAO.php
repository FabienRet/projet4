<?php

namespace App\src\DAO;

Class ConnectionDAO extends Database{
    public function connection($name, $pass, $mail){
        $sql = 'INSERT INTO user(name, password, email, created_at, id_group) VALUES (?, ?, ?, NOW(), 1)';
        $result = $this->sql($sql, [$name, $pass, $mail]);
        return $result;
    }
    public function testName($name){
        $varname = 0;
        $tableauTest = 'SELECT name FROM user';
        $donnees = $this->sql($tableauTest);
        while ($test = $donnees->fetch()){
            if($name == $test['name']){
                $varname = 1;
            }
        }
        return $varname;
    }
    public function testPass($pass, $testPass){
        if($pass == $testPass){
            return 0;
        }else{
            return 1;
        }
    }

    public function testEmail($email){
        $varEmail = 0;
        $tableauTest = 'SELECT email FROM user';
        $donnees = $this->sql($tableauTest);
        while($test = $donnees->fetch()){
            if ($email == $test['email']){
                $varEmail = 1;
            }
        }
        return $varEmail;
    }

    public function checkPass($name, $pass){
        $varPass = 0;
        $tableauTest = 'SELECT password FROM user WHERE name = ?';
        $donnees = $this->sql($tableauTest, [$name]);
        while($testPass = $donnees->fetch()){
            if($pass == $testPass['password']){
                $varPass = 1;
            }
        }
        return $varPass;
    }
    public function createSession($name){
        $_SESSION['name'] = $name;
        $tableauTest = 'SELECT id_group FROM user WHERE name = ?';
        $donnees = $this->sql($tableauTest, [$name]);
        $idSession = $donnees->fetch();
        $_SESSION['id']= $idSession['id_group'];
        var_dump($_SESSION);
    }

    public function infoTab($name){
        $tableauTest = 'SELECT email, created_at FROM user WHERE name = ?';
        $donnees = $this->sql($tableauTest, [$name]);
        $idSession = $donnees->fetch();
        return $idSession;
    }

    public function updateMember($post){

    }
}