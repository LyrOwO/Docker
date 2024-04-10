<?php
// Vérifier si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: log_in.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// On inclut la connexion à la base
require_once('includes/db.php');

if($_POST){
    if(isset($_POST['titre']) && !empty($_POST['titre'])
    && isset($_POST['auteur']) && !empty($_POST['auteur'])
    && isset($_POST['description']) && !empty($_POST['description'])) {
        $conn = connect();

        // On nettoie les données envoyées
        $titre = strip_tags($_POST['titre']);
        $auteur = strip_tags($_POST['auteur']);
        $description = strip_tags($_POST['description']);

        $sql = 'INSERT INTO `manwha` (`titre`, `auteur`, `description`) VALUES (:titre, :auteur, :description);';

        $query = $conn->prepare($sql);

        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':auteur', $auteur, PDO::PARAM_STR);
        $query->bindValue(':description', $description, PDO::PARAM_STR);

        $result = $query->execute();

        if ($result) {
            // Get the ID of the newly inserted record
            $lastInsertId = $conn->lastInsertId();
    
            // Upload the file with the ID as its name
            if (isset($_FILES['file'])) {
                $tmpName = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
                $size = $_FILES['file']['size'];
                $error = $_FILES['file']['error'];
    
                // Construct the new filename using the ID
                $newFileName = 'img_' . $lastInsertId . '.png';
    
                // Move the uploaded file to the desired location with the new filename
                move_uploaded_file($tmpName, 'assets/images/' . $newFileName);
            }
    
            header("Location: crud.php");
            exit(); // Assurez-vous de sortir du script après la redirection
        } else {
            echo "Erreur lors de la création du block";
        }

        $_SESSION['message'] = "Manwha ajouté";
        require_once('includes/close.php');

        header('Location: crud.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Manwha</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger" role="alert">
                                '. $_SESSION['erreur'].'
                            </div>';
                        $_SESSION['erreur'] = "";
                    }
                ?>
                <h1>Ajouter un compte</h1>
                <form method="post" enctype="multipart/form-data"> <!-- Ajout de l'attribut enctype -->
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" id="titre" name="titre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="auteur">Auteur</label>
                        <input type="text" id="auteur" name="auteur" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="file">Image: </label>
                        <input type="file" name="file">
                    </div>
                    <button class="btn btn-primary">Envoyer</button><br><br>
                    <a href="crud.php" class="btn btn-primary">Retour au CRUD</a>
                </form>
            </section>
        </div>
    </main>
</body>
</html>
