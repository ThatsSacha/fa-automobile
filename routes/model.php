<?php
// On déclare une nouvelle class
class SQL {
    private function bdd() {
        try {
            return new PDO('mysql:host=localhost;dbname=bde;port=3306;charset=utf8', 'root', 'root');
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage();
        }
    }

    public function addUser($admin, $first_name, $second_name, $mail, $password, $city) {
        // On stocke la connexion à notre bdd dans $bdd
            // $this fait réference à la class à partir de laquelle on l'appelle
            // $this->bdd(); on appelle notre fonction bdd() dans la class SQL
        $bdd = $this->bdd();

        // On prépare la requête avant de l'éxecuter pour éviter les failles XSS
        $insert = $bdd->prepare('INSERT INTO user (admin, first_name, second_name, mail, password, city) VALUES (:admin, :first_name, :second_name, :mail, :password, :city)');
        $insert->execute(array(
            ':admin' => $admin,
            ':first_name' => $first_name,
            ':second_name' => $second_name,
            ':mail' => $mail,
            ':password' => $password,
            ':city' => $city
        ));
    }

    public function getUserByMail($mail) {
        $bdd = $this->bdd();

        $get = $bdd->query('SELECT * FROM user WHERE mail = "'. $mail . '"');
        // On stocke dans $result tous les résultats correspondant
        $result = $get->fetchAll();
        // Puis on retourne $result
        return $result;
    }

    public function addArticle($name, $description, $src, $price, $note) {
        $bdd = $this->bdd();
        
        $insert = $bdd->prepare('INSERT INTO articles (name, description, src, price, note) VALUES (:name, :description, :src, :price, :note)');
        $insert->execute(array(
            ':name' => $name,
            ':description' => $description,
            ':src' => $src,
            ':price' => $price,
            ':note' => $note
        ));
    }

    public function getArticles() {
        $bdd = $this->bdd();

        $get = $bdd->query('SELECT * FROM articles ORDER BY date_added DESC');
        $result = $get->fetchAll();
        return $result;
    }

    public function addEvent($name, $text, $src) {
        $bdd = $this->bdd();
        
        $insert = $bdd->prepare('INSERT INTO events (name, description, src) VALUES (:name, :description, :src)');
        $insert->execute(array(
            ':name' => $name,
            ':description' => $text,
            ':src' => $src
        ));
    }

    public function getEvents() {
        $bdd = $this->bdd();

        $get = $bdd->query('SELECT * FROM events ORDER BY date_added DESC');
        $result = $get->fetchAll();
        return $result;
    }
}