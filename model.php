<?php

class SQL {
    private function connect() {
        try {
            return new PDO('mysql:host=localhost;port=8889;dbname=fa-automobile;charset=utf8', 'Sacha', '');
        } catch (Exception $e) {
            echo 'Caugth execpetion ' . $e;
        }
    }

    public function checkMail($mail) {
        $bdd = $this->connect();

        $select = $bdd->query('SELECT * FROM user WHERE mail = "'. $mail .'"');
        $fetch = $select->fetchAll();

        return $fetch;
    }

    public function addUser($first_name, $second_name, $mail, $password, $admin) {
        $bdd = $this->connect();

        $insert = $bdd->prepare('INSERT INTO user (first_name, second_name, mail, password, admin) VALUES(:first_name, :second_name, :mail, :password, :admin)');
        $insert->execute(array(
            ':first_name' => $first_name,
            ':second_name' => $second_name,
            ':mail' => $mail,
            ':password' => $password,
            ':admin' => $admin
        ));
    }

    public function deleteAccount($mail) {
        $bdd = $this->connect();

        $delete = $bdd->query('DELETE FROM user WHERE mail = "'. $mail .'"');
        $delete->execute();
    }
}