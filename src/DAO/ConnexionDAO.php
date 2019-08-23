<?php

namespace App\src\DAO;

Class ConnexionDAO extends Database{
    public function connexion($pseudo, $pass, $mail){
        $sql = 'INSERT INTO membres(pseudo, password, email, date_inscription, id_groupe) VALUES (?, ?, ?, NOW(), 1)';
        $result = $this->sql($sql, [$pseudo, $pass, $mail]);
        return $result;
    }
    public function testPseudo($pseudo){
        $varPseudo = 0;
        $tableauTest = 'SELECT pseudo FROM membres';
        $donnees = $this->sql($tableauTest);
        while ($test = $donnees->fetch()){
            if($pseudo == $test['pseudo']){
                $varPseudo = 1;
            }
        }
        return $varPseudo;
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
        $tableauTest = 'SELECT email FROM membres';
        $donnees = $this->sql($tableauTest);
        while($test = $donnees->fetch()){
            if ($email == $test['email']){
                $varEmail = 1;
            }
        }
        return $varEmail;
    }

    public function checkPass($pseudo, $pass){
        $varPass = 0;
        $tableauTest = 'SELECT password FROM membres WHERE pseudo = ?';
        $donnees = $this->sql($tableauTest, [$pseudo]);
        while($testPass = $donnees->fetch()){
            if($pass == $testPass['password']){
                $varPass = 1;
            }
        }
        return $varPass;
    }

}