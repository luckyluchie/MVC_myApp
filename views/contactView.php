<?php 
$title = 'Me contacter'; // $title sera inséré dans la balise <title> du <head>
ob_start(); // "mémorise" toute la sortie HTML qui suit
?>

<div class="row bg-grey mt-5 p-4 gx-5 shadow-lg p-3 mb-5 rounded">
    
    <div class="col-6">
        <h2 class="text-uppercase text-primary text-center mb-5" style="font-family: 'Tourney', cursive; font-size: 3rem; font-weight: bold;">A propos</h2>
        <div class="row rows-col-12 justify-content-center">
            <img src="/MVC_myApp/public/img/TITUZINE_LOGO.png" class="img-responsive face" alt="logo-face">
        </div>
        <div class="row rows-col-12">
            <p>Aliquam sagittis, nibh quis suscipit varius, mauris velit pharetra mauris, nec rhoncus velit nisi suscipit sapien. Maecenas faucibus lectus diam, at bibendum sapien ultrices et. Donec velit dui, dignissim ut porta vitae, bibendum a turpis. Donec luctus, ex id gravida lacinia, nunc elit convallis velit, eget laoreet est orci nec ex.</p>
        </div>
        <div class="row rows-col-12">
            <p>Aliquam sagittis, nibh quis suscipit varius, mauris velit pharetra mauris, nec rhoncus velit nisi suscipit sapien. Maecenas faucibus lectus diam, at bibendum sapien ultrices et. Donec velit dui, dignissim ut porta vitae, bibendum a turpis. Donec luctus, ex id gravida lacinia, nunc elit convallis velit, eget laoreet est orci nec ex. Cras imperdiet aliquet arcu, ut convallis urna congue a. Nullam sagittis pulvinar dignissim. Quisque eros eros, lobortis nec malesuada vitae, pulvinar dignissim odio. Maecenas suscipit efficitur orci a fermentum. Nam et congue augue. Phasellus porttitor facilisis massa. Quisque sit amet faucibus felis. Nulla vehicula quis tortor nec pulvinar. Sed et purus et est ultrices mollis ac sit amet risus.</p>
        </div>
        <div class="row justify-content-between">
            <div class="col-3 text-center">
                <i class="fas fa-phone-square-alt text-secondary" style="font-size: 3rem;"></i>
                <br>
                <a href="tel:+33601020304">06-01-02-03-04</a>
            </div>
            <div class="col-3 text-center" >
                <i class="fas fa-envelope text-secondary" style="font-size: 3rem;"></i>
                <a href="mailto:monnom@mail.com">monnom@mail.com</a>
                <br>
            </div>
            <div class="col-3 text-center">
                <i class="fab fa-linkedin text-secondary" style="font-size: 3rem;"></i>
                <br>
                <a href="#">linkedin</a>
            </div>
        </div>
    </div>
    
    <div class="col-6">
        <h2 class="text-uppercase text-primary text-center mb-5" style="font-family: 'Tourney', cursive; font-size: 3rem; font-weight: bold;">CONTACT</h1>
        <div class="container mt-4">
            <form action="../index.php?action=contactMail" method="POST" >

                <div class="mb-3">
                    <label for="userMail" class="form-label">Adresse mail</label>
                    <input type="email" class="form-control" id="userMail"  name="userMail" placeholder="monnom@mail.com">
                </div>

                <div class="mb-3">
                    <label for="subject" class="form-label">Sujet</label>
                    <input type="text" class="form-control" id="subject" name="subject">
                </div>

                <div class="mb-3">
                    <label for="messageContactContent" class="form-label">Message</label>
                    <textarea class="form-control" id="messageContactContent" rows="9" name="messageContactContent"></textarea>
                </div>

                <button class="btn btn-primary mb-4 px-5 float-end" type="submit">Envoyer</button>    
                    
            </form>
        </div>
    </div>

</div>



<?php $content = ob_get_clean(); // On met le tout dans content du template?>
<?php require('template.php'); ?>