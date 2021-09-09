<?php 
require_once("models/Manager.php"); // appelle de la classe mère

class PostManager extends Manager
{
  // Récupération de la liste des 10 derniers posts 
    public function getTotalPostsCount() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) AS nbOfPosts FROM posts');
        return $req;
    }

    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, image, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT :start, :limit');
        $req->bindValue(':start', 0, PDO::PARAM_INT);
        $req->bindValue(':limit', 10, PDO::PARAM_INT);
        $req->execute();

        return $req;
    }

    // Récupération du post selon son id
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, redactor, title, content, image, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    // Insertion nouveau Post
    public function postPost($redactor, $title, $content, $image)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts(redactor, title, content, image) VALUES(?, ?, ?, ?)');
        $post = $req->execute(array($redactor, $title, $content, $image));

        return $post;
    }

    // Supprimer Post
    public function delete($post_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("DELETE FROM posts WHERE id = :post_id");
        $req->bindValue(':post_id', $post_id);
        $req->execute();
    }

    // Modifier Post
    public function modify($redactor, $title, $content, $image, $id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("UPDATE posts SET redactor = :redactor, title = :title, content = :content, image = :image WHERE id = :id");
        $req->bindParam(':redactor', $redactor);
        $req->bindParam(':title', $title);
        $req->bindParam(':content', $content);
        $req->bindParam(':image', $image);
        $req->bindParam(':id', $id); // sa valeur sera récupérée grâce à un GET
        $post = $req->execute();

        return $post;
    }

    // Modifier Post sans modifier le champs image
    public function modifyWhithOutImage($redactor, $title, $content, $id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("UPDATE posts SET redactor = :redactor, title = :title, content = :content WHERE id = :id");
        $req->bindParam(':redactor', $redactor);
        $req->bindParam(':title', $title);
        $req->bindParam(':content', $content);
        $req->bindParam(':id', $id); // sa valeur sera récupérée grâce à un GET
        $post = $req->execute();

        return $post;
    }

}

?>


