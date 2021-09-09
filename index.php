<?php
// index.php = routeur
// Appeler le contrôleur correspondant à l'action
require('controllers/controller.php');


try { // On essaie de faire des choses
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts($start, $limit);
            
        }
        elseif ($_GET['action'] == 'post') {
            
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc on saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }

        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], valid_data($_POST['author']), valid_data($_POST['comment']));
                }
                else {
                    // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }

        elseif ($_GET['action'] == 'addPost') {
            $filesize = $_FILES['image'];
            imageContent($filesize);
            $no_image= imageContent($filesize);

            if (!empty($_POST['redactor']) && !empty($_POST['title']) && !empty($_POST['content']) && $no_image) {

                $res = checkFile($_FILES['image']); // Vérifier si fichier ok (function définie dans controller.php)
                if ($res == true) {
                    addPost(valid_data($_POST['redactor']), valid_data($_POST['title']), valid_data($_POST['content']), $_FILES['image']['name']);  
                } else {
                    echo $imageError;
                    // echo "erreur dans le téléchargement";
                } 
            } 
            elseif ((!empty($_POST['redactor']) && !empty($_POST['title']) && !empty($_POST['content']) && !$no_image)) {
                addPost(valid_data($_POST['redactor']), valid_data($_POST['title']), valid_data($_POST['content']), NULL); 
            }        
        }

        elseif ($_GET['action'] == 'deletePost') {
            if (isset($_GET['image'])) {
                deleteImage($_GET['image']); // A mettre avant la suppression dans la base de données
                deletePost($_GET['id']);      
            } else {
            // Autre exception
            throw new Exception("Erreur dans la suppression");
            }    
        } 

        elseif ($_GET['action'] == 'postById') {
            if (isset($_GET['id'])) {
                postById();
            } else {
                echo "error";
            }    
        }

        elseif ($_GET['action'] == 'modifyPost') {
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                $filesize = $_FILES['image'];
                $no_image = imageContent($filesize); // return false -> il y a une image dans le input image; return true -> il n'y a pas d'image

                if (!empty($_POST['redactor']) && !empty($_POST['title']) && !empty($_POST['content']) && $no_image) {

                $oldimage = valid_data($_POST['old_image']);
                    $res = checkFile($_FILES['image']); // Vérifier si fichier ok (function définie dans controller.php)
                    if ($res == true) {
                        deleteImage($oldimage);
                        modifyPost(valid_data($_POST['redactor']), valid_data($_POST['title']), valid_data($_POST['content']), $_FILES['image']['name'], $_GET['id']);     
                    } else {
                        echo 'error';
                    }
                }

                elseif ((!empty($_POST['redactor']) && !empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['old_image']) &&!$no_image)) {
                    modifyPostWhithOutImage(valid_data($_POST['redactor']), valid_data($_POST['title']), valid_data($_POST['content']), $_GET['id']); 
                }

                elseif (empty($_POST['old_image']) && !$no_image) {
                    modifyPostWhithOutImage(valid_data($_POST['redactor']), valid_data($_POST['title']), valid_data($_POST['content']), $_GET['id']); 
                }

                else {
                    // echo $imageError;
                    echo "erreur dans le téléchargement";
                }   
            } else {
                echo 'pas de formulaire soumis';
            }     
        }  
        
        elseif ($_GET['action'] == 'login') {
            if (!empty($_POST['username']) && !empty($_POST['userPassword'])) {
                $username = valid_data($_POST['username']);
                $userPassword = valid_data($_POST['userPassword']);
                
                $login = login($username); 

                if ($login == true) {
                    $id = $login['id'];
                    $name = $login['name'];
                    $password = $login['password']; 
                    $role = $login['idRole'];
                    $isPasswordCorrect = password_verify($userPassword, $login['password']);

                    // connecté en tant que admin
                    if ($isPasswordCorrect && $role == '1') {
                        session_start();
                        $_SESSION['id'] = $id;
                        $_SESSION['name'] = $name;
                        $_SESSION['role'] = $role;
                        header('Location: views/admin/adminView.php');

                    } elseif ($isPasswordCorrect && $role == '0') {
                        // connecté en tant que simple user
                        header('Location: views/listPostsView.php');
                        session_start();
                        $_SESSION['id'] = $id;
                        $_SESSION['name'] = $name;
                        $_SESSION['role'] = $role;
                    }
                    else {
                        echo 'Mauvais identifiant ou mot de passe !';
                    }
                } else {
                    echo 'Mauvais identifiant ou mot de passe !';
                }
            } else {
                echo "veuillez remplir les champs";
            }
        }

        elseif ($_GET['action'] == 'disconnect'){
            disconnect();
        }

        elseif ($_GET['action'] == 'sign_up') {    
            if (!empty($_POST['new_user']) && !empty($_POST['new_user_password'] && !empty($_POST['new_user_mail']) && !empty($_POST['new_role']))) {

                $name = valid_data($_POST['new_user']);
                $email = valid_data($_POST['new_user_mail']);
                $pass = valid_data($_POST['new_user_password']);
                $password = password_hash($pass, PASSWORD_DEFAULT);
                $role = valid_data($_POST['new_role']);

                // vérifier format du mail et du nom
                $resMail = valid_mail($email);
                $resName = valid_name($name);

                // Vérifie si l'utilisateur existe déjà
                $res = doesUserExist($name, $email);

                if ($res['count'] == '0') {
                    if ($resMail == false && $resName == true) {
                        echo "erreur dans le mail";
                    } else if ($resName == false && $resMail == true) {
                        echo "erreur dans le nom";
                    } else {
                        sign_up($name, $email, $password, $role);  
                    }                                          
                } else {
                    echo "Ce nom ou email existe déjà!!";
                }
            } else {
                echo "veuillez remplir les champs";
            }


        } else if ($_GET['action'] == 'contactMail') {

            $myMail = "mymail@mail.com";

            if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

                //on vérifie que le champ mail est correctement rempli
                if(empty(valid_data($_POST['userMail']))) {
                    echo "Le champ mail est vide";
                } else {
                    //on vérifie que l'adresse est correcte
                    /* format d'une adresse mail :
                    - pseudonyme pouvant contenir
                        - minimum une lettre
                        - que des minuscules
                        - des chiffres
                        - des points
                        - des tirets
                        - des underscores
                    - @
                    - nom de domaine pouvant contenir
                        - minimum une lettre
                        - que des minuscules
                        - des chiffres
                        - des points
                        - des tirets
                        - PAS d'underscores
                    - extension
                        - de 2 à 4 lettres minuscules              
                    */
                    if (!filter_var($_POST['userMail'], FILTER_VALIDATE_EMAIL)){
                        
                        echo "L'adresse mail entrée est incorrecte";
                    } else {
                        //on vérifie que le champ sujet est correctement rempli
                        if (empty(valid_data($_POST['subject']))) {
                            echo "Le champ sujet est vide";
                        } else {
                            //on vérifie que le champ message n'est pas vide
                            if (empty(valid_data($_POST['messageContactContent']))) {
                                echo "Le champ message est vide";
                            } else {
                                //tout est correctement renseigné, on envoi le mail
                                //on renseigne les entêtes de la fonction mail de PHP
                                $entetes = "MIME-Version: 1.0\r\n";
                                $entetes .= "Content-type: text/html; charset=UTF-8\r\n";
                                $entetes .= "From: Mon blog <" . valid_data($_POST['userMail']) . ">\r\n";//de préférence une adresse avec le même domaine de là où, vous utilisez ce code, cela permet un envoie quasi certain jusqu'au destinataire
                                $entetes .= "Reply-To: Mon blog <" . valid_data($_POST['userMail']) . ">\r\n";
                                //on prépare les champs:
                                $mail = valid_data($_POST['userMail']); 
                                $subject = '=?UTF-8?B?' . base64_encode(valid_data($_POST['subject'])) . '?=';//Cet encodage (base64_encode) est fait pour permettre aux informations binaires d'être manipulées par les systèmes qui ne gèrent pas correctement les 8 bits (=?UTF-8?B? est une norme afin de transmettre correctement les caractères de la chaine)
                                $message = valid_data($_POST['messageContactContent'], ENT_QUOTES, "UTF-8");//htmlentities() converti tous les accents en entités HTML, ENT_QUOTES Convertit en + les guillemets doubles et les guillemets simples, en entités HTML
                                //en fin, on envoi le mail
                                if (mail($myMail, $subject, nl2br($message),$entetes)){//la fonction nl2br permet de conserver les sauts de ligne et la fonction base64_encode de conserver les accents dans le titre
                                    echo "Le mail à été envoyé avec succès!";
                                } else {
                                    echo "Une erreur est survenue, le mail n'a pas été envoyé";
                                }
                            }
                        }
                    }
                }
            }



        }
    } 

    else {          
        function returnNbTotalPosts() {
            $nbTotal = getCountPosts();
            $nbTotalPosts = $nbTotal['nbOfPosts'];
            return $nbTotalPosts;
        }


        function returnNbPages($nbElementsPerPage) {
            $nbTotalPosts = returnNbTotalPosts();
            $nbOfPages = ceil($nbTotalPosts / $nbElementsPerPage);

            return $nbOfPages;
        }

        listPosts();
        

        
                
        
    }
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}

