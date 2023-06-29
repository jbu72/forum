<?php
// require('actions/database.php');

// //Récupérer les questions par défaut sans recherche
// $getAllQuestions = $bdd->query('SELECT id, id_auteur, titre, description, pseudo_auteur, date_publication FROM questions ORDER BY id DESC LIMIT 0,5');

// //Vérifier si une recherche a été rentrée par l'utilisateur
// if(isset($_GET['search']) AND !empty($_GET['search'])){

//     //La recherche
//     $usersSearch = $_GET['search'];

//     //Récupérer toutes les questions qui correspondent à la recherche (en fonction du titre)
//     $getAllQuestions = $bdd->query('SELECT id, id_auteur, titre, description, pseudo_auteur, date_publication FROM questions WHERE titre LIKE"%'.$usersSearch.'%" ORDER BY id DESC');
// }
?>

<?php
require('actions/database.php');

// Récupérer les questions avec les informations de l'auteur
$getAllQuestions = $bdd->query('SELECT q.id, q.id_auteur, q.titre, q.description, u.pseudo AS pseudo_auteur, q.date_publication FROM questions q
                                JOIN users u ON q.id_auteur = u.id
                                ORDER BY q.id DESC LIMIT 0,5');

// Vérifier si une recherche a été effectuée
if(isset($_GET['search']) && !empty($_GET['search'])){
    $usersSearch = $_GET['search'];

    // Récupérer les questions correspondant à la recherche
    $getAllQuestions = $bdd->query('SELECT q.id, q.id_auteur, q.titre, q.description, u.pseudo AS pseudo_auteur, q.date_publication FROM questions q
                                    JOIN users u ON q.id_auteur = u.id
                                    WHERE q.titre LIKE "%'.$usersSearch.'%"
                                    ORDER BY q.id DESC');
}
?>

<!--  nous utilisons la clause JOIN pour joindre la table "questions" avec la table "users" en fonction de l'id de l'auteur. Nous sélectionnons également le pseudo de l'auteur à partir de la table "users" en utilisant un alias (u.pseudo AS pseudo_auteur). -->

<!-- q.id fait référence à la colonne "id" de la table "questions". Cette colonne est généralement utilisée pour stocker l'identifiant unique de chaque question.
q.id_auteur fait référence à la colonne "id_auteur" de la table "questions". Cette colonne est utilisée pour stocker l'identifiant de l'auteur qui a posé la question.
q.titre fait référence à la colonne "titre" de la table "questions". Cette colonne est utilisée pour stocker le titre de chaque question.
q.description fait référence à la colonne "description" de la table "questions". Cette colonne est utilisée pour stocker une brève description de chaque question.
q.date_publication fait référence à la colonne "date_publication" de la table "questions". Cette colonne est utilisée pour stocker la date de publication de chaque question.
Ces expressions sont utilisées dans la requête SQL pour sélectionner spécifiquement ces colonnes de la table "questions" et les récupérer dans le résultat de la requête. Ensuite, ces données sont utilisées pour afficher les informations de chaque question sur votre page d'index. -->