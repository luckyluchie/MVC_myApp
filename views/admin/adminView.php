<?php
session_start();

$title = 'gestionnaire de blog';

ob_start();

if (isset($_SESSION['id']) AND isset($_SESSION['name']) AND $_SESSION['role'] == '1')
{ ?>

    <h1 class="text-center mt-5 mb-5">Tableau de bord</h1>

<!-- <div><?= $message ?></div> -->

<h2>Gestionnaire des articles</h2>

<!-- Fonctionne-->
<a href="addPostView.php" class="btn btn-success my-3">Créer un nouvel article</a> 

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Auteur</th>
            <th scope="col">Titre</th>
            <th scope="col">Publié le</th>
            <th scope="col">Image</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    
    <?php
    $db = new PDO('mysql:host=localhost;dbname=db_blog_one;charset=utf8', 'root', '');
    
    $req = $db->query('SELECT id, redactor, title, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\'), image FROM posts ORDER BY creation_date DESC LIMIT 0, 10');
    
    while ($data = $req->fetch())
    {
    ?>    
    
        <tr>
                <th scope="row"><?= $data['id'] ?></th>
                <td><?= $data['redactor'] ?></td>
                <td><?= $data['title'] ?></td>
                <td><?= $data['DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\')']?></td>
                <td><?= $data['image']?></td>
                <td>
                    <span class="icon-eye" style="font-size: 1.7em;">
                        <a href="../../index.php?action=post&amp;id=<?= $data['id'] ?>"><i class="far fa-eye" style="color: grey"></i></a>
                    </span>

                    <a href="../../index.php?action=postById&id=<?= $data['id'] ?>" class="btn btn-warning">Modifier</a>

                    <form action="../../index.php?action=deletePost&id=<?= $data['id'] ?>&image=<?= $data['image'] ?>" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>

                </td>
            </tr>
    <?php }
    ?>
    </tbody>
</table>
<hr class="m-5">

<div class="container">
    <h2>Créer un nouvel admin</h2>
<form class="mt-4 col-6 offset-3 border border-primary p-4" action="../../index.php?action=sign_up" method="POST">
    <div class="mb-3">
        <label for="new_user" class="form-label">Nom d'utilisateur</label>
        <input type="text" class="form-control" id="new_admin" name="new_user">
    </div>
    <div class="mb-3">
        <label for="new_user_mail" class="form-label">Mail</label>
        <input type="email" class="form-control" id="new_user_mail" name="new_user_mail" placeholder="name@example.com">
    </div>

    <div class="mb-3">
        <label for="new_user_password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="new_user_password" name="new_user_password">
    </div>

    <div class="mb-3">
        <label for="new_role" class="form-label"></label>
        <input type="text" class="form-control" id="new_role" name="new_role" value="admin" readonly>
    </div>

    <button type="submit" class="btn btn-primary">Créer</button>
</form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require ('../template.php'); ?>
<?php } else { 
    echo "vous n'avez pas accès à cette page";
}?>




