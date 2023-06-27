<?php
require('actions/database.php');
if(isset($_GET['id']) AND !empty($_GET['id'])){

$idOfQuestion = $_GET['id'];

$checkIfQuestionExists = $bdd->prepare('SELECT * FROM questions WHERE id = ?');
$checkIfQuestionExists->execute(array($idOfQuestion));

if($checkIfQuestionExists->rowCount() > 0){

$questionInfos = $checkIfQuestionExists->fetch();
if($questionInfos['id_auteur'] == $_SESSION['id']){

    $question_title = $questionInfos['titre'];
    $question_description = $questionInfos['description'];
    $question_content = $questionInfos['contenu'];
    $question_date = $questionInfos['date_publication'];
}else{
    $errorMsg = "Vous n'êtes pas l'auteur de cette question";
}

}else{
    $errorMsg = "Aucune question n'a été trouvée";
}

}else{
    $errorMsg = "Aucune question n'a été trouvée";
}
?>