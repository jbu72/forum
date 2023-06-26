<?php
//validation du formulaire
require('actions/database.php');
if(isset($_POST['validate'])){
    //vérifier si le user a bien complété tous les champs
    if(!empty($_POST['pseudo']) AND !empty($_POST['lastname']) AND !empty($_POST['firstname']) AND !empty($_POST['password'])){
        //les données de l'user
        $user_pseudo = htmlspecialchars($_POST['pseudo']);
        $user_lastname = htmlspecialchars($_POST['lastname']);
        $user_firstname = htmlspecialchars($_POST['firstname']);
        $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        //vérifier si l'utilisateur existe déjà sur le site

        $checkIfUserAlreadyExists = $bdd->prepare('SELECT pseudo FROM users WHERE pseudo = ?');
        $checkIfUserAlreadyExists->execute(array($user_pseudo));

        if($checkIfUserAlreadyExists->rowCount() == 0){
            //insérer l'utilisateur dans la bdd
            $insertUserOnWebsite = $bdd->prepare('INSERT INTO users(pseudo, nom, prenom, mdp)VALUES(?, ?, ?, ?)');
            $insertUserOnWebsite->execute(array($user_pseudo, $user_lastname, $user_firstname, $user_password));

            //Récuperer les informations de l'utilisateur

            $getInfosOfThisUserReq = $bdd->prepare('SELECT id, pseudo, nom, prenom FROM users WHERE nom = ? AND prenom = ? AND pseudo = ?');
            $getInfosOfThisUserReq->execute(array($user_lastname, $user_firstname, $user_pseudo,));

            $usersInfos = $getInfosOfThisUserReq->fetch();

            //authentifier l'utilisateur sur le site et récupérer ses données dans des variables globales sessions

            $_SESSION['auth'] = true;
            $_SESSION['id'] = $usersInfos['id'];
            $_SESSION['lastname'] = $usersInfos['nom'];
            $_SESSION['firstname'] = $usersInfos['prenom'];
            $_SESSION['pseudo'] = $usersInfos['mdp'];

            //Rédiriger l'utilisateur vers la page d'accueil
            header('Location: index.php');

        }else{
            $errorMsg = "L'utilisateur existe déjà sur le site...";
        }

    }else{
        $errorMsg = "Veuillez compléter tous les champs...";
    }
   
}
?>