<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mon blog - <?= $title ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- icons https://fontawesome.com/v5.15/icons -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Tourney:ital,wght@0,300;0,400;0,800;0,900;1,300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/MVC_MyApp/public/css/style.css">

</head>
<body class="container-fluid g-0">

  <nav class="navbar navbar-expand-lg bg-primary sticky-top position-relative">
    
    <div class="container-fluid">
      <a class="navbar-brand ms-3" href="/MVC_myApp/index.php">
        <img src="/MVC_myApp/public/img/TITUZINE_LOGO2.png" class="logo" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon text-white"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-light text-uppercase" aria-current="page" href="/MVC_myApp/index.php" style="font-family: 'Tourney', cursive; font-size: 1.35rem; font-weight: bold;">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light text-uppercase" aria-current="page" href="/MVC_myApp/views/contactView.php" style="font-family: 'Tourney', cursive; font-size: 1.35rem; font-weight: bold;">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light text-uppercase" aria-current="page" href="/MVC_myApp/views/contactView.php" style="font-family: 'Tourney', cursive; font-size: 1.35rem; font-weight: bold;">A propos</a>
          </li>
          
        </ul>
        <div class="text-center text-uppercase text-alert me-auto pe-4 position-absolute top-50 start-50 translate-middle" style="font-family: 'Tourney', cursive; font-size: 3rem;">le blog de Tituzine
        </div>
  
        <span class="me-4">
          <?php if (isset($_SESSION['id']) AND isset($_SESSION['name'])) { ?>
            <form action="/MVC_myApp/index.php?action=disconnect" method="post">
              <button type="submit" class="btn btn-secondary">Se déconnecter</button>
            </form>
          <?php } else { ?>
            <a href="/MVC_myApp/views/loginView.php"><button type="button" class="btn btn-warning">Se connecter</button></a>
          <?php } ?>
        </span>
    </div>
  </nav>

  <header class="mb-4">
    <div class="container-fluid border-top mb-4">
      <img class="img-fluid" src="/MVC_myApp/public/img/header.jpg" alt="bandeau">
    </div>
  </header>


  <div class="container mt-4">
    <div class="row">
      <div class="col-12">
        <?= $content ?> <!-- Le contenu de chaque view sera inséré ici-->
      </div>
    </div>  
  </div>

  <footer class="d-flex flex-wrap justify-content-between align-items-center  mt-4 bg-secondary">
    <div class="col-md-4 d-flex align-items-center ms-5 text-white">
      <span class="">Copyright</span><i class="fas fa-copyright mx-2"></i><span> 2021 - Tous droits réservés</span>
    </div>

    <div class="col-md-4 d-flex align-items-center justify-content-end me-5">
      <a href="#" class="p-4 text-decoration-none text-white">Contact</a>
      <a href="#" class="p-4 text-decoration-none text-white">Mentions légales</a>
    </div>
  
  </footer>
  
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>