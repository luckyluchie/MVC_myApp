<?php
session_start();
$title = 'modifier-article' . valid_data($post['title']);

ob_start(); // "mémorise" toute la sortie HTML qui suit

if (isset($_SESSION['id']) AND isset($_SESSION['name']) AND $_SESSION['role'] == '1')
{ ?>

<div class="container w-50 mt-4">

    <form action="./index.php?action=modifyPost&id=<?= valid_data($post['id']);?>" method="post" enctype="multipart/form-data">
        <div>
            <label for="redactor" class="form-label">Auteur</label><br>
            <input type="text" id="redactor" name="redactor" value="<?= $post['redactor'] ?>" class="form-control mb-3">
        </div>
        <div>
            <label for="title" class="form-label">Titre</label><br>
            <input id="title" name="title" class="form-control mb-3" value="<?= $post['title'] ?>">
        </div>
        <div>
            <label for="content" class="form-label">article</label><br>
            <textarea id="content" name="content" class="form-control mb-3" rows="5"><?= valid_data($post['content']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Ajouter une image</label>
            <input class="form-control mb-3" name="image" type="file" id="image"> 
        </div>
        <div class="mb-3">
            <label for="old_image">Fichier utilisé actuellement :</label>
            <textarea id="old_image" name="old_image" class="form-control mb-3" readonly rows="1"><?= valid_data($post['image']) ?></textarea>
            <!-- ne pas utiliser le disabled si l'on veut récupérer la valeur du textarea -->
        </div>
            
        <div>
            <input type="submit" name="submit" class="btn btn-warning mb-3" value="Modifier">
        </div>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('./views/template.php'); ?>
<?php } else { 
    echo "vous n'avez pas accès à cette page";
}?>