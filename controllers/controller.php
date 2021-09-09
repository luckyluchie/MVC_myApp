<?php
// Chaque classe est insérée dans une fonction
require_once('models/PostManager.php');
require_once('models/CommentManager.php');
require_once('models/User.php');


function getCountPosts()  {
    $postManager = new PostManager(); 
    $countPosts = $postManager->getTotalPostsCount();
    $countPosts = $countPosts->fetch();
    
    return $countPosts;
    
    require('views/listPostsView.php');
}

function listPosts()
{
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('views/listPostsView.php');
}




function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('views/postView.php');
}


function postById()
{
    $postManager = new PostManager();
    $post = $postManager->getPost($_GET['id']);
    
    require('views/admin/updatePostView.php');
}


function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        // Erreur gérée. Elle sera remontée jusqu'au bloc try du routeur !
        new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}


function addPost($redactor, $title, $content, $image)
{
    $postManager = new PostManager();
    $post = $postManager->postPost($redactor, $title, $content, $image);

    if ($post === false) {
        new Exception('Impossible d\'ajouter le post !');
    }
    else {
        header('Location: views/admin/adminView.php');
    }
    
    require('views/admin/addPostView.php');
}


function deleteImage($imageName) {
    $imageNamePath = 'public/img/' . $imageName;
    unlink($imageNamePath);
}


function deletePost($post_id) {
    // Récupération du post selon son id
    $postManager = new PostManager();
    $postManager->delete($post_id);

    header('Location: views/admin/adminView.php');   

    require('views/admin/adminView.php');
}


function modifyPost($redactor, $title, $content, $image, $id) {
    $postManager = new PostManager();
    $post = $postManager->modify($redactor, $title, $content, $image, $id);

    if ($post === true) {
        header('Location: views/admin/adminView.php');  
    } else {
        echo 'error';
    }
    require('views/admin/updatePostView.php');    
}


function modifyPostWhithOutImage($redactor, $title, $content, $id) {
    $postManager = new PostManager();
    $post = $postManager->modifyWhithOutImage($redactor, $title, $content, $id);

    if ($post === true) {
        header('Location: views/admin/adminView.php');  
    } else {
        echo 'error';
    }
    require('views/admin/updatePostView.php');    
}


function checkFile($data) {
    global $imageError;
    $imageError = "";
    $allowed = array("jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
    $filename = $data["name"];
    $filetype = $data["type"];
    $filesize = $data["size"];
    $filenamePath = "./public/img/" . $data  ["name"];

    if (!file_exists($filenamePath)) {
        // Vérifie l'extension du fichier
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) {
            $imageError .= 'Veuillez sélectionner un format de fichier valide.';
        }
        // Vérifie la taille du fichier - 5Mo maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) {
            $imageError .= ' La taille du fichier est supérieure à la limite   autorisée.';
        }
        // Vérifie le type MIME du fichier
        if (in_array($filetype, $allowed)){
                move_uploaded_file($data["tmp_name"], "./public/img/" . $data  ["name"]);   
        }
        return true;
    }

    elseif (file_exists($filenamePath)) {
        echo "Le fichier existe déjà";
    }    
    else {
        $imageError .= " Veuillez réessayer."; 
        return false;
    }     
}


function imageContent($filesize) {
    // bool pour vérifier si le champs image du formulaire est vide ou plein
    $filesize = $_FILES['image']['error'];
    $res = $filesize == 0 ? true : false;
    return $res;
}


function login($name) {
    $user_login = new User();
    $login = $user_login->connect($name);

    return $login;
    
    require('./views/loginView.php');    
}


function disconnect() {
    session_start();

    if (isset($_SESSION['id']) AND isset($_SESSION['name']))
    {
        // Suppression des variables de session et de la session
        $_SESSION = array();
        session_destroy();
        echo "vous êtes déconnecté";
        // header("Location: ./views/loginView.php");
    } else {
        echo 'pas connecté';
        header("Location: ./views/loginView.php");
    }
}


function doesUserExist($name, $email) {
    $newUser = new User();
    $user = $newUser->userExist($name, $email);

    return $user;

    require('./views/signUp.php');
}


function sign_up($name, $email, $password, $role) {
    $newUser = new User();
    $user = $newUser->createUser($name, $email, $password, $role);
    // faire afficher message d'erreur
    $message = "";
    if ($user === true) {
        $message .= 'Le nouvel utilisateur a été ajouté';
        header('Location: /MVC_myApp/index.php');

    } else {
        $message .= 'erreur dans la saisie';
    }
    return $message;
    require('./views/signUp.php'); 
}

// Function security inputs
function valid_data($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// fonction pour n'afficher qu'un extrait des articles dans la page d'accueil
function limite_mot($chaine, $max=40){
    // on enlève les balises html
    $chaine = strip_tags($chaine);

    // on casse la chaine par les espaces et retourne un array avec chaque mot
    $expl = explode(" ",$chaine);

    // si l'array est plus grand que la valeur max
    if(count($expl) >= $max){
        $i = 0;
        $chaine = "";

        // on boucle pour n'afficher que le nombre souhaité
        while($i < $max){
            // on ajoute le mot suivi d'un espace à la variable
            $chaine .= $expl[$i] . " ";
            $i++;
        }    
    }
    $chaine = $chaine . ' ...';
    return $chaine;
}


function valid_mail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // check if e-mail address is well-formed
        $emailStatus = false;
    } else {
        $emailStatus = true;
    }
    return $emailStatus;
}


function valid_name($name) {
    // alphanumérique
    if(ctype_alnum($name)){
        $nameStatus = true;
    }
    else{
        $nameStatus = false;
    }
    return $nameStatus;
}



