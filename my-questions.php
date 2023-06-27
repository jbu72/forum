<?php
require('actions/questions/myQuestionsAction.php');
require('actions/users/securityAction.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
include 'includes/head.php';
?>
<body>
    <?php include 'includes/navbar.php'; ?>
    <br><br>
    <div class="container">
    <?php
    while($question = $getAllMyQuestions->fetch()){
        ?>
        <div class="card">
  <div class="card-header">
    <?= $question['titre']; ?>
  </div>
  <div class="card-body">

    <p class="card-text">
        <?= $question['description']; ?>
    </p>
    <a href="#" class="btn btn-primary">Accéder à la question</a>
    <a href="#" class="btn btn-warning">Modifier la question</a>
  </div>
</div>
<br>
        <?php
    }
    ?>
    </div>
</body>
</html>