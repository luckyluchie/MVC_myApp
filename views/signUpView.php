<?php 

// session ne fonctionne

session_start();
$title = 'sign-up';
ob_start(); // "mémorise" toute la sortie HTML qui suit
if (!isset($_SESSION['id']) && !isset($_SESSION['name'])) 
{ 
?>

<div class="col-8 offset-2 bg-grey mt-5 p-5 shadow-lg mb-5 rounded">

    <h1 class="text-uppercase text-primary text-center" style="font-family: 'Tourney', cursive; font-size: 3rem; font-weight: bold;">S'inscrire</h1>
    
    <form class="mt-4 col-6 offset-3 p-4" action="../index.php?action=sign_up" method="POST">
        <div class="mb-3">
            <label for="new_user" class="form-label mb-1">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="new_user" name="new_user">
        </div>
        <div class="mb-3">
            <label for="new_user_mail" class="form-label  mb-1">Mail</label>
            <input type="email" class="form-control" id="new_user_mail" name="new_user_mail" placeholder="name@example.com">
        </div>
    
        <div class="mb-3">
            <label for="new_user_password" class="form-label  mb-1">Mot de passe</label>
            <input type="password" class="form-control" id="new_user_password" name="new_user_password">
        </div>
    
        <div class="mb-3">
            <label for="new_role" class="form-label"></label>
            <input type="text" class="form-control" id="new_role" name="new_role" value="user" readonly hidden>
        </div>
    
        <button type="submit" class="btn btn-primary px-4">S'inscrire</button>
    
        <span class="float-end mt-2"><a href="loginView.php">Je suis déjà inscrit</a></span>
    
    </form>

</div>
    
    <?php $content = ob_get_clean(); ?>
    <?php require('template.php'); ?>
    <?php
    } else {
        echo 'hello';
    }
    ?>





