<?php
    session_start();
    
    include('model.php');

    use \PHPMailer\PHPMailer\PHPMailer;
    use \PHPMailer\PHPMailer\Exception;

    require 'assets/lib/src/Exception.php';
    require 'assets/lib/src/PHPMailer.php';
    require 'assets/lib/src/SMTP.php';

    $sql = new SQL;

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
                    connectUser($first_name, $second_name, $u_mail, $admin);
                    header('Location: dashboard.php');
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
                        connectUser($user['first_name'], $user['second_name'], $user['mail'], $user['admin']);
                        header('Location: dashboard.php');
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

    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'disconnect') {
            session_destroy();
            header('Location: http://localhost:8888/ProjetWeb');
        } else if ($_GET['action'] == 'delete' && $_SESSION['connected'] && !empty($_SESSION['mail'])) {
            $sql->deleteAccount($_SESSION['mail']);
            session_destroy();
            header('Location: ./');
        }
    }

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

    function connectUser($first_name, $second_name, $mail, $admin) {
        if ($admin == 0) {
            $admin = false;
        } else {
            $admin = true;
        }

        $_SESSION['first_name'] = $first_name;
        $_SESSION['second_name'] = $second_name;
        $_SESSION['mail'] = $mail;
        $_SESSION['admin'] = $admin;
        $_SESSION['connected'] = true;
    }