<?php
    session_start();
    
    include('model.php');

    use \PHPMailer\PHPMailer\PHPMailer;
    use \PHPMailer\PHPMailer\Exception;

    require 'assets/lib/src/Exception.php';
    require 'assets/lib/src/PHPMailer.php';
    require 'assets/lib/src/SMTP.php';

    $sql = new SQL;

    if (!isset($_SESSION['shop-cage'])) {
        $_SESSION['shop-cage'] = array();
    }

    $marks = $sql->getMarks();

    foreach($marks as $mark) {
        $data_marks .= '<li class="nav-item">
                            <a class="nav-link" href="store.php?m='. $mark['id'] .'">'. $mark['mark'] .'</a>
                        </li>';
    }

    if (isset($_POST['submit-signin']) || isset($_POST['submit-login'])) {
        $first_name = htmlspecialchars($_POST['first-name']);
        $second_name = htmlspecialchars($_POST['second-name']);
        $u_mail = htmlspecialchars($_POST['mail']);
        $password = htmlspecialchars($_POST['password']);
        $password = hash('sha512', $password);
        $password = strtoupper($password);
        $confirm_password = htmlspecialchars($_POST['confirm-password']);
        $confirm_password = hash('sha512', $confirm_password);
        $confirm_password = strtoupper($confirm_password);

        if (!empty($first_name) && !empty($second_name) && !empty($u_mail) && !empty($password) && !empty($confirm_password)) {
            if ($password == $confirm_password) {
                $check_mail = $sql->checkMail($u_mail);

                if (count($check_mail) == 0) {
                    if ($u_mail == 'contact@sacha-cohen.fr') {
                        $admin = 1;
                    } else {
                        $admin = 0;
                    }

                    $sql->addUser($first_name, $second_name, $u_mail, $password, $admin);

                    $subject = '✅ Votre compte a bien été créé !';
                    $body = '<html>
                                <head>
                                    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,400&display=swap" rel="stylesheet">
                                </head>
                                <body style="text-align: center; font-family: "Montserrat"; font-size: 13px; font-weight: 200;">
                                    <h1 style="font-weight: 400; font-size: 20px;">Merci d\'avoir procédé à votre inscription '. $second_name .' !</h1>
                                    <p>Connectez-vous dès maintenant à votre compte en cliquant ici 👇</p>
                                    <a href="http://localhost:8888/ProjetWeb/login">
                                        <button style="width: 150px; height: 50px; border-radius: 30px; color: white; background-color: #0069d9; border: none;">Se connecter</button>
                                    </a>
                                </body>
                            </html>';

                    sendMail($u_mail, $subject, $body);
                    $users = $sql->checkMail($u_mail);
                    foreach ($users as $user) {
                        connectUser($user['id'], $first_name, $second_name, $u_mail, $admin);
                    }
                    header('Location: dashboard.php?action=dashboard');
                } else {
                    echo 'Un compte existe déjà avec l\'adresse mail ' . $u_mail;
                }
            } else {
                echo 'Les deux mots de passe ne correspondent pas';
            }
        } else if (!empty($u_mail) && !empty($password)) {
            $users = $sql->checkMail($u_mail);

            if (count($users) > 0) {
                foreach ($users as $user) {
                    if ($password == $user['password']) {
                        connectUser($user['id'], $user['first_name'], $user['second_name'], $user['mail'], $user['admin']);
                        header('Location: dashboard.php?action=dashboard');
                    } else {
                        echo 'L\'adresse mail ou le mot de passe ne correspond pas';
                    }
                }
            } else {
                echo 'L\'adresse mail ou le mot de passe ne correspond pas';
            }
        } else {
            echo 'Tous les champs doivent être remplis';
        }
    }

    if (isset($_POST['submit-mark'])) {
        $mark = htmlspecialchars($_POST['mark']);

        if (!empty($mark)) {
            $sql->addMark($mark);
            header('Location: dashboard.php?action=dashboard');
        }
    }

    if (isset($_POST['submit-vehicle'])) {
        $mark = htmlspecialchars($_POST['mark-select']);
        $model = htmlspecialchars($_POST['model']);
        $description = htmlspecialchars($_POST['description']);
        $price = htmlspecialchars($_POST['price']);
        $year = htmlspecialchars($_POST['year']);
        $picture_name = htmlspecialchars($_FILES['picture']['name']);

        if ($mark != 0 && !empty($model) && !empty($price) && !empty($year) && !empty($picture_name)) {
            if ($_FILES['picture']['error'] == 0) {
                $picture_extension = pathinfo($picture_name);
                $extensions = array('jpg', 'jpeg', 'JPEG', 'JPG', 'PNG', 'png', 'gif');
                $move = __DIR__.'/assets/img/vehicles/' . basename($picture_name);
                
                if (in_array($picture_extension['extension'], $extensions)) {
                    if (file_exists($move)) {
                        echo 'Cette image existe déjà';
                    } else {
                        if (move_uploaded_file($_FILES['picture']['tmp_name'], $move)) {
                            $sql->addVehicle($mark, $model, $description, $price, $year, $picture_name);
                            header('Location: dashboard.php?action=dashboard');
                        } else {
                            echo 'Une erreur est survenue lors de l\'envoi de l\'image dans '. $move;
                        }
                    }
                } else {
                    echo 'L\'extension n\'est pas autorisée';
                }
            } else {
                echo 'Un problème est survenu au chargement de l\'image';
            }
        }
    }

    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'disconnect') {
            session_destroy();
            header('Location: http://localhost/ProjetWeb');
        } else if ($_GET['action'] == 'delete' && $_SESSION['connected'] && !empty($_SESSION['mail'])) {
            $sql->deleteAccount($_SESSION['mail']);
            session_destroy();
            header('Location: ./?action=home');
        } else if ($_GET['action'] == 'dashboard') {
            $marks = $sql->getMarks();

            foreach($marks as $mark) {
                $v_marks .= '<option value="'. $mark['id'] .'">'. $mark['mark'] .'</option>';
            }

            $activities = $sql->getHistoric($_SESSION['id']);
            foreach($activities as $activity) {
                if ($activity['table_db'] == 'vehicle') {
                    $vehicles = $sql->getVehiclesById($activity['element_id']);

                    foreach($vehicles as $vehicle) {
                        $date = date('d/m/Y à H:i', $vehicle['date_action']);
                        $historic .= '<div class="historic-container">Achat: '. $vehicle['model'] .' - '. $vehicle['v_year'] .' - '. $vehicle['price'] .'€, le '. $date .'</div>';
                    }
                }
            }

        } else if ($_GET['action'] == 'shop-cage') {
            for ($i = 0; $i < count($_SESSION['shop-cage']); $i++) {
                foreach ($_SESSION['shop-cage'][$i] as $id) {
                    $vehicles = $sql->getVehiclesById($id);
                    
                    foreach($vehicles as $vehicle) {
                        $shop_cage_vehicles .= '<div class="card" style="width: 18rem;">
                                                <img src="assets/img/vehicles/'. $vehicle['picture'] .'" class="card-img-top" alt="'. $vehicle['model'] .'">
                                                <div class="card-body">
                                                    <h5 class="card-title">'. $vehicle['model'] .'</h5>
                                                    <p class="card-text">'. $vehicle['description'] .'</p>
                                                    <div class="card-number">
                                                        <span>'. $vehicle['v_year'] .'</span>
                                                        <span>'. number_format($vehicle['price']) .'€</span>
                                                    </div>
                                                    <a href="controler.php?action=remove-shop-cage&i='. $vehicle['id'] .'" class="btn btn-danger">Retirer du panier</a>
                                                </div>
                                            </div>';
                    }
                }
            }
        } else if ($_GET['action'] == 'remove-shop-cage' && isset($_GET['i']) && is_numeric($_GET['i']) && $_GET['i'] > 0 && $_GET['i'] < 999) {
            for($i = 0; $i < count($_SESSION['shop-cage']); $i++) {
                foreach($_SESSION['shop-cage'][$i] as $key => $value) {
                    if ($_GET['i'] == $key) {
                        unset($_SESSION['shop-cage'][$i][$key]);
                        var_dump($_SESSION['shop-cage'] . '<br/>');
                        //unset($_SESSION['shop-cage'][$i]);
                        header('Location: shop-cage.php?action=shop-cage');
                    }
                }
            }
        } else if ($_GET['action'] == 'validate-shop-cage') {
            $product_body;
            if ($_SESSION['connected'] && isset($_SESSION['id']) && is_numeric($_SESSION['id'])) {
                for ($i = 0; $i < count($_SESSION['shop-cage']); $i++) {
                    foreach($_SESSION['shop-cage'][$i] as $key => $value) {
                        $sql->addHistoric('vehicle', $_SESSION['id'], $key);
                        $vehicles = $sql->getVehiclesById($key);

                        foreach($vehicles as $vehicle) {
                            $product_body .= '<span>'. $vehicle['model'] .' - '. $vehicle['v_year'] .' - </span>
                                            <span>'. $vehicle['price'] .'€</span><br/>';
                        }
                    }
                }

                $body = '<html>
                                <head>
                                    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,400&display=swap" rel="stylesheet">
                                </head>
                                <body style="text-align: center; font-family: "Montserrat"; font-size: 13px; font-weight: 200;">
                                    <h1 style="font-weight: 400; font-size: 20px;">Merci d\'avoir passé commande '. $_SESSION['second_name'] .' !</h1>
                                    <p>Votre commande 👇</p>
                                    '. $product_body .'
                                </body>
                            </html>';

                sendMail($_SESSION['mail'], 'Commande validée !', $body);
                unset($_SESSION['shop-cage']);
                header('Location: dashboard.php?action=dashboard');
            } else {
                echo 'Vous devez êtes connecté pour passer une commande';
            }
            
        } else if ($_GET['action'] == 'forum') {
            $topics = $sql->getLastTopics();

            foreach ($topics as $topic) {
                $users = $sql->getUserById($topic['user_id']);
                $date = date($topic['date_posted']);

                foreach($users as $user) {
                    $render_topic .= '<div class="card topic-container">
                                        <div class="card-header">
                                            Par '. $user['second_name'] .' '. $user['first_name'] .'
                                        </div>
                                        <div class="card-body">
                                            <div class="card-title">'. $topic['title'] .'</div>
                                            <p class="card-text">Le '. $date .'</p>
                                            <a href="topic.php?action=get-topic&i='. $topic['id'] .'" class="btn btn-primary">Voir ce topic</a>
                                        </div>
                                    </div>';
                }
            }
        } else if ($_GET['action'] == 'topic' && isset($_GET['i']) && is_numeric($_GET['i']) && $_GET['i'] > 0) {
            $topics = $sql->getTopicById($_GET['i']);

            foreach($topics as $topic) {
                //$render_topic_id .= 
            }
        }
        /*else if ($_GET['action'] == 'home') {
            $vehicles = $sql->getHomeVehicles();
            //Boucle sur chaque véhicule puis dans chaque mark
            foreach ($vehicles as $vehicle) {
                $marks = $sql->getMarksById($vehicle['mark_id']);

                foreach ($marks as $mark) {
                    $data_vehicles .= '<h2>'. $mark['mark'] .'</h2>
                                        <div class="card-container">
                                            <div class="card" style="width: 18rem;">
                                                <img src="assets/img/vehicles/'. $vehicle['picture'] .'" class="card-img-top" alt="'. $vehicle['model'] .'">
                                                <div class="card-body">
                                                    <h5 class="card-title">'. $vehicle['model'] .'</h5>
                                                    <p class="card-text">'. $vehicle['description'] .'</p>
                                                    <div class="card-number">
                                                        <span>'. $vehicle['v_year'] .'</span>
                                                        <span>'. number_format($vehicle['price']) .'€</span>
                                                    </div>
                                                    <a href="#" class="btn btn-success">Ajouter au panier</a>
                                                </div>
                                            </div>
                                        </div>';
                }
            }
        }*/
    }

    if (isset($_POST['submit-add-shop'])) {
        $id = htmlspecialchars($_POST['id-vehicle']);
        $price = htmlspecialchars($_POST['price']);

        if (!empty($id) && is_numeric($id) && $id > 0 && !empty($price) && is_numeric($price) && $price > 0) {
            array_push($_SESSION['shop-cage'], array($id => $id));
            header('Location: shop-cage.php?action=shop-cage');
        }
    }

    if (isset($_GET['m'])) {
        if (is_numeric($_GET['m']) && $_GET['m'] > 0 && $_GET['m'] < 999) {
            $vehicles = $sql->getVehicles($_GET['m']);

            foreach($vehicles as $vehicle) {
                $data_vehicles .= '<div class="card" style="width: 18rem;">
                                        <img src="assets/img/vehicles/'. $vehicle['picture'] .'" class="card-img-top" alt="'. $vehicle['model'] .'">
                                        <div class="card-body">
                                            <h5 class="card-title">'. $vehicle['model'] .'</h5>
                                            <p class="card-text">'. $vehicle['description'] .'</p>
                                            <div class="card-number">
                                                <span>'. $vehicle['v_year'] .'</span>
                                                <span>'. number_format($vehicle['price']) .'€</span>
                                            </div>
                                            <form action="controler.php" method="POST">
                                                <input type="hidden" name="id-vehicle" value="'. $vehicle['id'] .'">
                                                <input type="hidden" name="price" value="'. $vehicle['price'] .'">
                                                <input type="submit" name="submit-add-shop" class="btn btn-success" value="Ajouter au panier">
                                            </form>
                                            <!--<a href="controler.php?action=add-shop-cage&i='. $vehicle['id'] .'" class="btn btn-success">Ajouter au panier</a>-->
                                        </div>
                                    </div>';
                
                $img .= '<div class="carousel-item">
                            <img src="assets/img/vehicles/'. $vehicle['picture'] .'" class="d-block w-100" alt="'. $vehicle['model'] .'">
                        </div>';
            }

            for ($i = 0; $i < count($vehicles); $i++) {
                if (count($vehicles) == 1) {
                    $i += 1;
                    $indicator .= '<li data-target="#carouselExampleIndicators" data-slide-to="'. $i .'"></li>';
                } else {
                    $indicator .= '<li data-target="#carouselExampleIndicators" data-slide-to="'. $i .'"></li>';
                }
            }
        }
    }

    // ADD TOPIC
    if (isset($_POST['submit-add-topic'])) {
        if ($_SESSION['connected'] && isset($_SESSION['id']) && is_numeric($_SESSION['id'])) {
            $title = htmlspecialchars($_POST['topic-title']);
            $topic = htmlspecialchars($_POST['topic']);

            if (!empty($title) && !empty($topic)) {
                $sql->addTopic($_SESSION['id'], $title, $topic);
                header('Location: forum.php?action=forum');
            } else {
                echo 'Tous les champs doivent êtres remplis';
            }
        } else {
            echo 'Vous devez vous connecter';
        }
    }
    //

    function sendMail($receiver, $subject, $body) {
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bdecesinanterre92@gmail.com';
        $mail->Password = 'cZ@b77*QF7Fc'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('bdecesinanterre92@gmail.com', 'BDE CESI NANTERRE');
        $mail->AddAddress($receiver);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->CharSet = 'UTF-8';
        if ($mail->send()) {
            echo 'Mail envoyé à '. $receiver;
            echo $body;
        } else {
            echo 'Erreur denvoi du mail à '. $receiver . $mail->ErrorInfo;
        }
    }

    function connectUser($id, $first_name, $second_name, $mail, $admin) {
        if ($admin == 0) {
            $admin = false;
        } else {
            $admin = true;
        }

        $_SESSION['id'] = $id;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['second_name'] = $second_name;
        $_SESSION['mail'] = $mail;
        $_SESSION['admin'] = $admin;
        $_SESSION['connected'] = true;
    }