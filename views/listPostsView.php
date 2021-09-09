<?php 
$title = 'Mon blog'; // $title sera inséré dans la balise <title> du <head>
ob_start(); // "mémorise" toute la sortie HTML qui suit

$page;
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}


// PAGINATION A FAIRE


$nbElementsPerPage = 4;
$start = ($page - 1) * $nbElementsPerPage;

$limit = 3;

$nbOfPages = returnNbPages($nbElementsPerPage);


for ($i = 1; $i <= $nbOfPages; $i++) {
    echo "<strong><a href='?page=$i'>$i</a> </strong>";
}

?>

<h1 class="text-uppercase text-center mt-4 text-secondary" style="font-family: 'Tourney', cursive; font-size: 3rem; font-weight: bold;">Les derniers articles</h1>

<div class="row mt-4 bg-success p-4 rounded">
    <div class="col-9">
      <?php
      while ($post = $posts->fetch())
      {
          $content = valid_data($post['content']);
          $extractContent = limite_mot($content, $max = 40);

      ?>
        <a href="index.php?action=post&amp;id=<?= $post['id'] ?>" class="text-decoration-none text-dark">
            <div class="card mt-4">  
                <h5 class="card-header text-muted text-uppercase"><?= valid_data($post['title']) ?><small class="float-end"> le <?= $post['creation_date_fr'] ?></small>
                </h5>
                <div class="card-body">
                    <?php 
                    // Si il existe une image appliquer la mise en forme suivante
                    if ($post['image'] != NULL) {
                    ?>
                    <div class="col-4 text-center">
                        <img src="./public/img/<?= valid_data($post['image']) ?>" alt="<?= $post['image']?>" class="rounded float-start w-100 pe-4"><br>
                    </div>
                    <div class="col-8">
                        <p class="card-text"><?= $extractContent ?></p>
                    </div>
                    <?php
                    } else { ?>
                        <p class="card-text"><?= $extractContent ?></p>
                    <?php
                    } 
                    ?>      
                </div>
                <div class="text-end me-3 mb-2">
                    <a href="index.php?action=post&amp;id=<?= $post['id'] ?>" class="btn btn-primary">Lire la suite >></a>
                </div>     
            </div>
            <?php
            } ?>
        </a>
    </div>  
            
    <div class="col-3 mt-4 text-center border-start border border-4 px-4">
        
        <div class="row rows-col-12 mb-4">

            <h2>Archives</h2>
    
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Accordion Item #1
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Accordion Item #2
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        Accordion Item #3
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="row rows-col-12 mt-4">
            <h2 class="text-uppercase mt-4">Actus</h2>
        fghdxf
        </div>
    </div>  
</div>





<?php $content = ob_get_clean(); // On met le tout dans content du template?>
<?php require('views/template.php'); ?>
