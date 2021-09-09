<?php 
session_start();

$title = 'login';
ob_start(); // "mémorise" toute la sortie HTML qui suit
?>

<div class="col-8 offset-2 bg-grey mt-5 p-5 shadow-lg mb-5 rounded">

    <h1 class="text-uppercase text-primary text-center" style="font-family: 'Tourney', cursive; font-size: 3rem; font-weight: bold;">Se connecter</h1>
    
    <form class="mt-2 col-6 offset-3 p-4" action="../index.php?action=login" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="username" name="username">
        </div>
    
        <div class="mb-3">
            <label for="password_admin" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="userPassword" name="userPassword">
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    
        <span class="float-end mt-2"><a href="signUpView.php">Je n'ai pas encore de compte</a></span>
    </form>
</div>


<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>