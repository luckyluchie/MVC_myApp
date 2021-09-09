<?php 
require_once("models/Manager.php"); // appelle de la classe mère

class User extends Manager
{
        public function createUser($name, $email, $password, $role) {
            $db = $this->dbConnect();
            $req = $db->prepare('INSERT INTO users(name, email, password, idRole) VALUES(?, ?, ?, ?)');
            $user = $req->execute(array($name, $email, $password, $role));

            return $user;
        }


        public function userExist($name, $email) {
            $db = $this->dbConnect();
            $req = $db->prepare("SELECT COUNT(*) AS count FROM users WHERE name = :name OR email = :email");
            $req->bindParam(':name', $name);
            $req->bindParam(':email', $email);
            $req->execute(array('name' => $name, 'email' => $email));
            $result = $req->fetch();

            return $result;
        }


        public function connect($name) {
            //  Récupération de l'id, du nom et du password hashé de l'utilisateur dans la bd, sous forme de tableau
            $db = $this->dbConnect();
            $req = $db->prepare("SELECT id, name, password, idRole FROM users WHERE name = :name");
            $req->bindParam(':name', $name);
            $req->execute(array('name' => $name));
            $result = $req->fetch();

            // var_dump($result);

            return $result; // s'il n'y a pas de concordance avec un nom renvoie false

            
            

        }


    // // Insertion nouveau Post
    // public function postPost($redactor, $title, $content, $image)
    // {
    //     $db = $this->dbConnect();
    //     $req = $db->prepare('INSERT INTO posts(redactor, title, content, image) VALUES(?, ?, ?, ?)');
    //     $post = $req->execute(array($redactor, $title, $content, $image));

    //     return $post;
    // }

    // // Supprimer Post
    // public function delete($post_id)
    // {
    //     $db = $this->dbConnect();
    //     $req = $db->prepare("DELETE FROM posts WHERE id = :post_id");
    //     $req->bindParam(':post_id', $post_id);
    //     $req->execute();
    // }

    // // Modifier Post
    // public function modify($redactor, $title, $content, $image, $id)
    // {
    //     $db = $this->dbConnect();
    //     $req = $db->prepare("UPDATE posts SET redactor = :redactor, title = :title, content = :content, image = :image WHERE id = :id");
    //     $req->bindParam(':redactor', $redactor);
    //     $req->bindParam(':title', $title);
    //     $req->bindParam(':content', $content);
    //     $req->bindParam(':image', $image);
    //     $req->bindParam(':id', $id); // sa valeur sera récupérée grâce à un GET
    //     $post = $req->execute();

    //     return $post;
    // }



}

?>