<?php
include('model.php');
session_start();

// MAIL FILES
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
//

// Par défaut l'utilisateur n'est pas connecté
if (!$_SESSION['connected']) {
    $_SESSION['connected'] = false;
}

// On instancie notre class SQL se trouvant dans model.php dans $sql
$sql = new SQL();

// SCRIPT INSCRIPTION
    // HTML special chars to escape html in case of code insertion in input
    $first_name = htmlspecialchars($_POST['prenom']);
    $second_name = htmlspecialchars($_POST['nom']);
    $city = htmlspecialchars($_POST['lieu']);
    $mail = htmlspecialchars($_POST['mail']);
    $confirm_mail = htmlspecialchars($_POST['mail2']);
    $mdp = htmlspecialchars($_POST['mdp']);
    $confirm_mdp = htmlspecialchars($_POST['mdp2']);
    $cgu = htmlspecialchars($_POST['cgu']);

    // On hahse les 2 mots de passe
    // On ajoute un sel qu'on hahse lui même puis on l'ajoute au mot de passe pour plus de sécurité
    $salt = 'E#ghjkè!çà!@LOPkk';
    $salt = hash('sha512', $salt);

    $hashed_mdp = hash('sha512', $mdp . $salt);
    $hashed_confirm_mdp = hash('sha512', $confirm_mdp . $salt);

    // Si le bouton 'Je m'inscis' à été cliqué et que tous les champs sont remplis, on passe dans le if
    if (isset($_POST['forminscription'])) {
        // Je mets le isset du bouton inscription tout seul au dessus car dans le cas où un autre formulaire est soumit sur cette page (comme le formulaire de connexion) aucun message d'erreur ne sera relevé comme le clic du bouton n'existe pas.
        if (!empty($first_name) && !empty($second_name) && !empty($city) && !empty($mail) && !empty($confirm_mail) && !empty($mdp) && !empty($confirm_mail) && !empty($cgu)) {
            // Si les deux adressses mails correspondent
            if ($mail == $confirm_mail) {
                // Si le mail appartient au BDE (voir regex)
                if (preg_match('/@viacesi.fr$|@cesi.fr$/', $mail)) {
                    // Si les deux mots de passe correspondent
                    if ($hashed_mdp == $hashed_confirm_mdp) {
                        if ((preg_match('/@viacesi.fr$/', $mail))) {
                            $admin = 0;
                        } else if ((preg_match('/@cesi.fr$/', $mail))) {
                            $admin = 1;
                            $_SESSION['admin'] = true;
                        }
                        // On fait référence à notre class SQL grâce à la variable $sql déclarée plus haut, puis on appelle notre en fonction en passant en paramètre les informations que l'utilisateur a renseigné
                        $sql->addUser($admin, $first_name, $second_name, $mail, $hashed_mdp, $city);
                        $_SESSION['connected'] = true;
                        $_SESSION['first_name'] = $first_name;
                        header('Location: accueil.php');
                    } else {
                        echo 'Les deux mots de passe ne correspondent pas';
                    }
                } else {
                    echo 'Cette adresse mail n\'appartient pas au BDE';
                }
                
            } else {
                echo 'Les adresses mail ne correspondent pas';
            }
        } else {
            echo 'Vous devez remplir tous les champs !';
        }
    }
//
// SCRIPT CONNEXION
    $mail_connect = htmlspecialchars($_POST['mail']);
    $password_connect = htmlspecialchars($_POST['mdp']);
    $hashed_password_connect = hash('sha512', $password_connect . $salt);

    if (isset($_POST['formconnexion'])) {
        if (!empty($mail_connect) && !empty($password_connect)) {
            // On va chercher dans la bdd l'utilisateur qui possède l'adresse mail qui vient d'être renseignée
            $get = $sql->getUserByMail($mail_connect);

            // Si on obtient un résultat
            if (count($get) > 0) {
                // On boucle sur les résultats
                foreach ($get as $user) {
                    $user_first_name = $user['first_name'];
                    $user_mail = $user['mail'];
                    $user_password = $user['password'];
                    $user_admin = $user['admin'];

                    // Si un adresse mail et son mot de passe correspondent au mail et mot de passe renseigné, alors on connecte l'utilisateur et on stocke son prénom dans la variable de session first_name
                    if ($mail_connect == $user_mail && $hashed_password_connect == $user_password) {
                        $_SESSION['connected'] = true;
                        $_SESSION['first_name'] = $user_first_name;
                        $_SESSION['mail'] = $user_mail;
                        if ($user_admin == 1) {
                            $_SESSION['admin'] = true;
                        }
                        
                        header('Location: accueil.php');
                    } else {
                        echo 'L\'adresse mail et/ou le mot de passe ne correspond pas';
                    }
                }
            } else {
                echo 'L\'adresse mail et/ou le mot de passe ne correspond pas';
            }
        } else {
            echo 'Tous les champs doivent êtres remplis !';
        }
    }
//
// CLIQUE BOUTON SE DÉCONNECTER
    if (isset($_POST['btn-deconnect'])) {
        // On détruit la session
        session_destroy();
        $_SESSION = array();
        // On redirige l'utilisateur vers la home
        header('Location: accueil.php');
    }
//
// AJOUT AU PANIER
    if (isset($_POST['btn-submit-add'])) {
        
        $_SESSION['name-article'] = $_POST['name-article'];
        $_SESSION['picture-article'] = $_POST['picture-article'];
        $_SESSION['price-article'] = $_POST['price-article'];

        // On ajoute chaque produit dans une variable de session pour ensuite l'afficher dans panier.php
        $_SESSION['shop_cage'] .= '<div class="col-lg-4 col-md-6 mb-4 panier-container">
                                        <div class="card h-100">
                                            <a href="#">
                                                <img class="card-img-top" src="'. $_SESSION['picture-article'] . '" alt="'. $_SESSION['name-article'] .'">
                                                <input type="hidden" name="picture_article_panier" value="'. $_SESSION['picture-article'] .'">
                                            </a>
                                                <div class="card-body">
                                                <h4 class="card-title">
                                                    <a href="#">'. $_SESSION['name-article'] .'</a>
                                                    <input type="hidden" name="name_article_panier" value="'. $_SESSION['name-article'] .'">
                                                </h4>
                                                <h5>'. $_SESSION['price-article'] .'</h5>
                                                <!--<p class="card-text"><?/*php echo $prod[Description]; */?></p>-->
                                                <h6>Quantité</h6>
                                                <select name="quantity_article_panier" class="quantity-article-panier">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                                </div>
                                                <div class="card-footer">
                                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';

        header('Location: panier.php');
    }
//
// VALIDATION PANIER
    // Si le bouton valider le panier a été cliqué
    if (isset($_POST['validate_shop_cage'])) {
        // Si les champs sont rensignés
        if (isset($_POST['name_article_panier']) && isset($_POST['quantity_article_panier'])) {
            // Message pour l'utilisateur non utile dans ce cas car on est passé par une requête AJAX donc l'utilisateur ne verra pas cette page
            echo 'Merci d\'avoir passé commande '. $_SESSION['first_name'] .' !<br/>Nous allons vous envoyer un mail de confirmation.<br/><br/>Veuillez patienter, vous allez être redirigé vers la page d\'accueil dans quelques secondes...';

            // On boucle sur tous les noms d'articles reçus
            for ($i = 0; $i < count($_POST['name_article_panier']); $i++) {
                // On stocke le nom de l'article dans $article_name sur lequel on est en train de boucler
                // On stocke la quantité de l'article dans $article_quantity
                $article_name = $_POST['name_article_panier'][$i];
                $article_quantity = $_POST['quantity_article_panier'][$i];
                // On pourrait ajouter aussi l'image mais étant donné qu'elle n'est pas stockée sur un serveur en ligne, lors de l'envoi du mail, elle ne pourra pas être recupérée dans l'un des dossiers qui lui est en local

                // On stocke dans $article chaque article. ---> .= <--- signifie qu'on n'écrase pas la variable $article (sinon la dernière valeur de la boucle serait prise en compte) mais on rajoute à chaque fois un nouvel article dans la variable
                $article .= '<span>'. $article_name .', '. $article_quantity .' exemplaire(s)</span>';
            }

            // On prépare le contenu de notre mail au format HTML
            $client_message = "<html>
                                    <head>
                                        <style>
                                            body
                                            {
                                                font-family: 'Montserrat',
                                                font-size: 13px;
                                                font-weight: 100;
                                            }
                                            h1 {
                                                font-weight: 500;
                                                font-size: 20px;
                                            }
                                            .card { display: flex; flex-direction: column; }
                                        </style>
                                    </head>
                                    <body>
                                        <h1>Merci d'avoir passé commande ". $_SESSION['first_name'] ." !</h1><br/>
                                        <div id='content'>
                                            <span>Vos achat(s):</span>
                                            <div class='card'>
                                                ". $article ."
                                            </div>
                                        </div>
                                    </body>
                                </html>";

            // Script mail tiré de la libraire PHP MAILER avec connexion SMTP sécurisée en SSL
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'bdecesinanterre92@gmail.com';
            $mail->Password = 'cZ@b77*QF7Fc'; 
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('bdecesinanterre92@gmail.com', 'BDE CESI NANTERRE');
            $mail->AddAddress($_SESSION['mail']);

            $mail->isHTML(true);
            $mail->Subject = '✅ Confirmation de votre panier';
            $mail->Body = $client_message;
            $mail->CharSet = 'UTF-8';

            // Si le mail a été envoyée
            // L'utilisateur ne verra pas les messages dessous et le header ne sera pas executé car nous sommes passés par une requête AJAX
            if ($mail->send()) {
                $_SESSION['shop_cage'] = '';
                header('Refresh: 7; accueil.php');
            } else {
                echo '<br/><br/>Une erreur s\'est produite lors de l\'envoi du mail';
            }
            
        } else {
            echo 'Une erreur s\'est produite. Veuillez réessayer.';
        }
    }
//
// SUPPRESSION PANIER
    if (isset($_POST['delete_shop_cage'])) {
        $_SESSION['shop_cage'] = '';
        header('Location: panier.php');
    }
//
// AJOUT ARTICLE
    $article_name = htmlspecialchars($_POST['article_name']);
    $article_description = htmlspecialchars($_POST['article_description']);
    $article_price = htmlspecialchars($_POST['article_price']);
    $article_note = htmlspecialchars($_POST['article_note']);

    if (isset($_POST['submit_article'])) {
        if (!empty($article_name) && !empty($article_description) && $_FILES['article_picture'] && !empty($article_price) && !empty($article_note) && $article_price >= 0 && $article_price <= 99999) {
            if ($_FILES['article_picture']['error'] == 0) {
                $file_extension = pathinfo($_FILES['article_picture']['name']);
                $extensions = array('jpg', 'jpeg', 'JPEG', 'JPG', 'PNG', 'png', 'gif');

                $move = __DIR__.'/public/images/' . basename($_FILES['article_picture']['name']);
                $img_name = htmlspecialchars($_FILES['article_picture']['name']);

                if (in_array($file_extension['extension'], $extensions)) {
                    if (move_uploaded_file($_FILES['article_picture']['tmp_name'], $move)) {
                        echo "L'envoi a bien été effectué dans " . $move;
                        $move = 'public/images/'. basename($_FILES['article_picture']['name']);
                        $sql->addArticle($article_name, $article_description, $move, $article_price, $article_note);
                        header('Location: boutique.php');
                    } else {
                        echo 'Une erreur s\'est produite lors de l\'envoi du fichier';
                    }
                } else {
                    echo 'L\'extension du fichier n\'est pas autorisée.';
                }
            } else {
                echo 'Une erreur est survenue au chargement de l\'image';
            }
        } else {
            echo 'Tous les champs doivent être complétés !';
        }
    }
//
// RÉCUPÉRER TOUS LES ARTICLES
    $data = $sql->getArticles();

    foreach($data as $article) {
        $name = $article['name'];
        $description = $article['description'];
        $image = $article['src'];
        $price = $article['price'];
        $note = $article['note'];

        if ($note == 0) {
            $note = '☆ ☆ ☆ ☆ ☆';
        } else if ($note == 1) {
            $note = '★ ☆ ☆ ☆ ☆';
        } else if ($note == 2) {
            $note = '★ ★ ☆ ☆ ☆';
        } else if ($note == 3) {
            $note = '★ ★ ★ ☆ ☆';
        } else if ($note == 4) {
            $note = '★ ★ ★ ★ ☆';
        } else if ($note == 5) {
            $note = '★ ★ ★ ★ ★';
        }

        $articles .= '  
                            <div class="col-lg-4 col-md-6 mb-4">
                            <form action="controler.php" method="post">
                                <div class="card h-100">
                                    <a href="#">
                                        <img class="card-img-top"  src="'. $image .'">
                                        <input type="hidden" name="picture-article" value="'. $image .'">
                                    </a>
                            
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="#">'. $name .'</a>
                                        </h4>
                                        <h5>'. $price .'€</h5>
                                        <input type="hidden" name="price-article" value="'. $price .'">
                                        <p class="card-text">'. $description .'</p>
                                        <input type="hidden" name="name-article" value="'. $description .'">
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">'. $note .'</small>
                                        
                                        <button type="submit" name="btn-submit-add" class="btn btn-primary">Ajouter au panier</button>
                                        
                                    </div>
                                </div>
                                </form>
                            </div>
                        

                        
                ';
    }
//
// AJOUT ÉVÈNEMENT
$event_name = htmlspecialchars($_POST['event_name']);
$event_text = htmlspecialchars($_POST['event_text']);

if (isset($_POST['submit_event'])) {
    if (!empty($event_name) && !empty($event_text) && $_FILES['event_picture']) {
        if ($_FILES['event_picture']['error'] == 0) {
            $file_extension = pathinfo($_FILES['event_picture']['name']);
            $extensions = array('jpg', 'jpeg', 'JPEG', 'JPG', 'PNG', 'png', 'gif');

            $move = __DIR__.'/public/images/' . basename($_FILES['event_picture']['name']);
            $img_name = htmlspecialchars($_FILES['event_picture']['name']);

            if (in_array($file_extension['extension'], $extensions)) {
                if (move_uploaded_file($_FILES['event_picture']['tmp_name'], $move)) {
                    echo "L'envoi a bien été effectué dans " . $move;
                    $move = 'public/images/'. basename($_FILES['event_picture']['name']);
                    $sql->addEvent($event_name, $event_text, $move);
                    header('Location: events.php');
                } else {
                    echo 'Une erreur s\'est produite lors de l\'envoi du fichier';
                }
            } else {
                echo 'L\'extension du fichier n\'est pas autorisée.';
            }
        } else {
            echo 'Une erreur est survenue au chargement de l\'image';
        }
    } else {
        echo 'Tous les champs doivent être complétés !';
    }
}
//
// RÉCUPÉRER TOUS LES ÉVÈNEMENTS
$data = $sql->getEvents();

foreach($data as $event) {
    $name = $event['name'];
    $text = $event['description'];
    $image = $event['src'];

    $events .= '<div class="card">
                    <img class="card-img-top" src="'. $image .'">
                    <div class="card-body">
                        <h5 class="card-title">'. $name .'</h5>
                        <p class="card-text">'. $description .'</p>
                    </div>
                </div>';
}
//