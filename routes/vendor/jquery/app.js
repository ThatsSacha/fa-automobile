$(function() {
    // Lorsque le formulaire de validation est envoyé
    $('.validate-shop-cage-form').on('submit', function(e) {
        // On empêche le formulaire de se comporter par défaut, c'est à dire de charger la page controler.php
        e.preventDefault();

        // On déclare nos variables et tableaux
        let panierContainer = $('.validate-shop-cage-form .panier-container');
        let titleArticle = [];
        let quantityArticle = [];
        
        // Pour chaque panierContainer
        for (i = 0; i < panierContainer.length; i++) {
            // On ajoute le titre de l'article dans le tableau
            titleArticle.push($('.validate-shop-cage-form .panier-container').eq(i).find('.card-title a').text());
            // On ajoute la quantité dans le tableau
            quantityArticle.push($('.validate-shop-cage-form .panier-container').eq(i).find('.quantity-article-panier').val());
        }

        // Requête AJAX permettant de faire notre requête sans recharger la page et en faisant passer nos tableaux
        $.ajax({
            type: 'POST',
            url: 'controler.php',
            // On passe en paramètre nos données
            data: {
                'name_article_panier': titleArticle,
                'quantity_article_panier': quantityArticle,
                'validate_shop_cage': 'validate_shop_cage'
            },
            // Lorsque la requête a réussie
            success: function(data) {
                // On supprime le formulaire panier de l'HTML à lécran
                $('.validate-shop-cage-form').remove();
                // Et on affiche un message réussi
                $('.center').append('<div>La validation a été effectuée ! Un mail de confirmation vient de vous être envoyé...</div>');
                // Pour une meilleure expérience utilisateur, il faudrait mettre en place un loader une fois qu'on a appuyé sur le bouton valider
            }
        });
    });

    // Au clique sur le bouton vider le panier
    $('.delete-shop-cage').on('click', function() {
        // Requête AJAX
        $.ajax({
            type: 'POST',
            url: 'controler.php',
            data: {
                'delete_shop_cage': 'delete_shop_cage'
            },
            success: function() {
                // On redirige vers la page accueil.php
                window.location = 'accueil.php';
            }
        });
    });
});