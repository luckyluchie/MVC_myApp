<?php 
session_start();
// $title varie en fonction du post sélectionné
$title = valid_data($post['title']);
ob_start(); // "mémorise" toute la sortie HTML qui suit
?>

<!-- Modal pour partie Commentaire -->
<div class="modal fade" id="modalCom" tabindex="-1" aria-labelledby="modalComLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Pour pouvoir écrire un commentaire il faut être connecté !
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <a href="/MVC_myApp/views/loginView.php">
                    <button type="button" class="btn btn-primary">Se connecter</button>
                </a>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid py-4">

    <div class="mb-5">
        <a href="index.php" class="text-decoration-none text-success"><i class="fas fa-arrow-left me-2 text-success d-inline-block align-middle" style="font-size: 2rem;"></i>Retour à la liste des articles</a>  
    </div>
    
        
    <div class="card col-12">
        <div class="card-header">
            <!-- METTRE TITRE EN h2-->
            <span class="text-uppercase" style="font-family: 'Tourney', cursive; font-size: 2.5rem;"><?= valid_data($post['title']) ?></span>
            <span class="float-end mt-2"> le <?= $post['creation_date_fr'] ?></span>
        </div>
        
        <div class="card-body">
            <div class="row mt-4">        
                <?php 
                    // Si il existe une image appliquer la mise en forme suivante
                    if ($post['image'] !== NULL) {
                        ?>
                            <div class="col-4 text-center">
                            <img src="./public/img/<?= valid_data ($post['image']) ?>" alt="<?= $post['image']?>" class="rounded"><br>
                            </div>
                        <?php
                    }
                ?>
                <div class="col">
                    <p class="card-text"><?= nl2br(valid_data($post['content'])) ?></p>
                </div>
            </div> 
            
            <?php 
            
            if (isset($_SESSION['id']) AND isset($_SESSION['name']) AND $_SESSION['role'] == '1')
            { ?>
                <form action="../../index.php?action=post&amp;id=<?= $post['id'] ?>" method="POST" class="d-inline float-end m-2">
                    <button type="submit" class="btn btn-danger px-4">Supprimer</button>
                </form>
                <a href="index.php?action=postById&id=<?= $post['id'] ?>" class="btn btn-warning float-end m-2 px-4"> Modifier</a>

                <a href="views/admin/adminView.php" class="btn btn-link float-end m-2">Retour</a>
            <?php } ?>
        </div>    
    </div>
</div>


<div class="container-fluid ">

    <div class="col-12 bg-grey rounded">
        <h2 class="text-center py-5">Commentaires</h2>
         <?php 
         if (!isset($_SESSION['id']) AND !isset($_SESSION['name']))
         { ?> 
         <div class="row mb-4">
            <div class="col-11 text-end">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success me-5" data-bs-toggle="modal" data-bs-target="#modalCom">
                Ajouter un commentaire
                </button>
            </div>
         </div>
         <?php
         }
         ?>

        <?php
            // A VERIFIER !!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            if (isset($_SESSION['id']) AND isset($_SESSION['name']))
            { ?>    
            
            <div class="row mb-4">
                <div class="col-11 text-end">
                    <button type="button" class="btn btn-success me-5" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Ajouter un commentaire</button>  
                </div>

                <div class="collapse mt-4 col-10 offset-1" id="collapseExample">
                    <div class="card card-body bg-grey">
                        <div class="container w-50 mt-4">
                            <!-- ajoute le commentaire au bon article avec l'id dpost-->
                            <form action="index.php?action=addComment&amp;id=<?=$post['id'] ?>" method="post">
                                <div>
                                    <label for="author" class="form-label">Auteur</label>
                                    <input type="text" id="author" name="author" class="form-control mb-3" value="<?= $_SESSION['name']; ?>" readonly>
                                </div>
                                <div>
                                    <label for="comment" class="        form-label">Commentaire</label><br>
                                    <textarea id="comment" name="comment"       class="form-control mb-3" rows="5"></textarea>
                                </div>
                                <div class="d-flex flex-row-reverse">
                                    <input type="submit" class="btn btn-success mb-3 px-4" value="Envoyer">
                                </div>
                            </form>    
                        </div>  

            </div>
        </div>        
    </div>


                
            <?php } ?>
        


            <?php
            while ($comment = $comments->fetch())
            {
            ?>
                <div class="row me-5 offset-1">
                    <div class="col-1 text-end">
                        <img src="/MVC_myApp/public/img/avatar.png" class="img-responsive w-100">
                    </div>
                    <div class="col-10 bg-light shadow p-3 mb-5 bg-body rounded">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <span><strong class="text-secondary fs-6"><?= valid_data($comment['author']) ?></strong></span> <span class="text-muted float-end me-3"><?= $comment['comment_date_fr'] ?></span>
                            </div>
                            <div class="col-12">
                                <p><?= nl2br(valid_data($comment['comment'])) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

        
            
    </div>
</div>

    

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?> 
