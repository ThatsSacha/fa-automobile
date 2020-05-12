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

    public function getUserById($id) {
        $bdd = $this->connect();

        $select = $bdd->query('SELECT * FROM user WHERE id = "'. $id .'"');
        $fetch = $select->fetchAll();

        return $fetch;
    }

    public function deleteAccount($mail) {
        $bdd = $this->connect();

        $delete = $bdd->query('DELETE FROM user WHERE mail = "'. $mail .'"');
        $delete->execute();
    }

    public function addMark($mark) {
        $bdd = $this->connect();

        $insert = $bdd->prepare('INSERT INTO mark (mark) VALUES(:mark)');
        $insert->execute(array(
            ':mark' => $mark
        ));
    }

    public function getMarks() {
        $bdd = $this->connect();

        $select = $bdd->query('SELECT * FROM mark');
        $fetch = $select->fetchAll();

        return $fetch;
    }

    public function getMarksById($id) {
        $bdd = $this->connect();

        $select = $bdd->query('SELECT * FROM mark WHERE id = "'. $id .'"');
        $fetch = $select->fetchAll();

        return $fetch;
    }

    public function addVehicle($mark_id, $model, $description, $price, $year, $picture) {
        $bdd = $this->connect();
        
        $insert = $bdd->prepare('INSERT INTO vehicle (mark_id, model, description, price, v_year, picture) VALUES(:mark_id, :model, :description, :price, :v_year, :picture)');
        $insert->execute(array(
            ':mark_id' => $mark_id,
            ':model' => $model,
            ':description' => $description,
            ':price' => $price,
            ':v_year' => $year,
            ':picture' => $picture
        ));
    }

    public function getVehicles($mark_id) {
        $bdd = $this->connect();

        $select = $bdd->query('SELECT * FROM vehicle WHERE mark_id = "'. $mark_id .'"');
        $fetch = $select->fetchAll();

        return $fetch;
    }

    public function getVehiclesById($id) {
        $bdd = $this->connect();

        $select = $bdd->query('SELECT * FROM vehicle WHERE id = "'. $id .'"');
        $fetch = $select->fetchAll();

        return $fetch;
    }

    public function getHomeVehicles() {
        $bdd = $this->connect();

        $select = $bdd->query('SELECT * FROM vehicle');
        $fetch = $select->fetchAll();

        return $fetch;
    }

    public function addHistoric($table, $user_id, $element_id) {
        $bdd = $this->connect();
        
        $insert = $bdd->prepare('INSERT INTO historic (table_db, user_id, element_id) VALUES(:table_db, :user_id, :element_id)');
        $insert->execute(array(
            ':table_db' => $table,
            ':user_id' => $user_id,
            ':element_id' => $element_id
        ));
    }

    public function getHistoric($user_id) {
        $bdd = $this->connect();

        $select = $bdd->query('SELECT * FROM historic WHERE user_id = "'. $user_id .'" ORDER BY date_action DESC');
        $fetch = $select->fetchAll();

        return $fetch;
    }

    public function addTopic($user_id, $title, $topic) {
        $bdd = $this->connect();
        
        $insert = $bdd->prepare('INSERT INTO topic (user_id, title, topic) VALUES(:user_id, :title, :topic)');
        $insert->execute(array(
            ':user_id' => $user_id,
            ':title' => $title,
            ':topic' => $topic
        ));
    }

    public function getLastTopics() {
        $bdd = $this->connect();

        $select = $bdd->query('SELECT * FROM topic ORDER BY date_posted DESC LIMIT 50');
        $fetch = $select->fetchAll();

        return $fetch;
    }

    public function getTopicByTitleAndUser($title, $user_id) {
        $bdd = $this->connect();

        $select = $bdd->query('SELECT * FROM topic WHERE title = "'. $title .'" AND user_id = "'. $user_id .'"');
        $fetch = $select->fetchAll();

        return $fetch;
    }

    public function getTopicById($id) {
        $bdd = $this->connect();

        $select = $bdd->query('SELECT * FROM topic WHERE id = "'. $id .'"');
        $fetch = $select->fetchAll();

        return $fetch;
    }

    public function addComment($user_id, $topic_id, $comment) {
        $bdd = $this->connect();
        
        $insert = $bdd->prepare('INSERT INTO comment (user_id, topic_id, comment) VALUES(:user_id, :topic_id, :comment)');
        $insert->execute(array(
            ':user_id' => $user_id,
            ':topic_id' => $topic_id,
            ':comment' => $comment
        ));
    }

    public function getComments($topic_id) {
        $bdd = $this->connect();

        $select = $bdd->query('SELECT * FROM comment WHERE topic_id = "'. $topic_id .'"');
        $fetch = $select->fetchAll();

        return $fetch;
    }

    public function getCommentById($element_id) {
        $bdd = $this->connect();

        $select = $bdd->query('SELECT * FROM comment WHERE id = "'. $element_id .'"');
        $fetch = $select->fetchAll();

        return $fetch;
    }

    public function updateAccount($id, $first_name, $second_name, $mail) {
        $bdd = $this->connect();

        $update = $bdd->prepare('UPDATE user SET first_name = :first_name, second_name = :second_name, mail = :mail WHERE id = "'. $id .'"');
        $update->execute(array(
            'first_name' => $first_name,
            'second_name' => $second_name,
            'mail' => $mail
        ));
    }

    public function updateAccountWithPassword($id, $first_name, $second_name, $mail, $password) {
        $bdd = $this->connect();

        $update = $bdd->prepare('UPDATE user SET first_name = :first_name, second_name = :second_name, mail = :mail, password = :password WHERE id = "'. $id .'"');
        $update->execute(array(
            'first_name' => $first_name,
            'second_name' => $second_name,
            'mail' => $mail,
            'password' => $password
        ));
    }
}