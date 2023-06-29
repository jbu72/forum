<?php

// require('actions/database.php');

// if(isset($_POST['validate'])){

//     if(!empty($_POST['answer'])){

//         $user_answer = nl2br(htmlspecialchars($_POST['answer']));

//         $insertAnswer = $bdd->prepare('INSERT INTO answers(id_auteur, pseudo_auteur, id_question, contenu)VALUES(?, ?, ?, ?)');
//         $insertAnswer->execute(array($_SESSION['id'], $_SESSION['pseudo'], $idOfTheQuestion, $user_answer));
        
//     }
// }
?>

<?php

require('actions/database.php');

if(isset($_POST['validate'])){

    if(!empty($_POST['answer'])){

        $user_answer = nl2br(htmlspecialchars($_POST['answer']));

        // Obtenir le pseudo de l'auteur à partir de la base de données
        $getPseudo = $bdd->prepare('SELECT pseudo FROM users WHERE id = ?');
        $getPseudo->execute(array($_SESSION['id']));
        $pseudo_auteur = $getPseudo->fetchColumn();

        // Insérer la réponse avec le pseudo correct de l'auteur
        $insertAnswer = $bdd->prepare('INSERT INTO answers(id_auteur, pseudo_auteur, id_question, contenu)VALUES(?, ?, ?, ?)');
        $insertAnswer->execute(array($_SESSION['id'], $pseudo_auteur, $idOfTheQuestion, $user_answer));
        
    }
}
?>
