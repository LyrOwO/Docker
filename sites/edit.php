<?php
// On démarre une session
session_start();

// Vérifier si des données ont été soumises via POST
if($_POST){
    // Vérifier si toutes les données nécessaires sont présentes et non vides
    if(isset($_POST['id']) && !empty($_POST['id'])
    && isset($_POST['titre']) && !empty($_POST['titre'])
    && isset($_POST['auteur']) && !empty($_POST['auteur'])
    && isset($_POST['description']) && !empty($_POST['description'])) {
        
        // On inclut la connexion à la base de données
        require_once('includes/db.php');
        $conn = connect();

        // Nettoyer les données envoyées
        $id = strip_tags($_POST['id']);
        $titre = strip_tags($_POST['titre']);
        $auteur = strip_tags($_POST['auteur']);
        $description = strip_tags($_POST['description']);

        // Préparer la requête SQL pour mettre à jour les données
        $sql = 'UPDATE `manwha` SET `titre`=:titre, `auteur`=:auteur, `description`=:description WHERE `Id_Manwha`=:id;';

        $query = $conn->prepare($sql);

        // Binder les valeurs
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':auteur', $auteur, PDO::PARAM_STR);
        $query->bindValue(':description', $description, PDO::PARAM_STR);

        // Exécuter la requête
        $query->execute();

        // Gestion de l'image
        if (isset($_FILES['file'])) {
            $tmpName = $_FILES['file']['tmp_name'];
            $name = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $error = $_FILES['file']['error'];

            // Vérifier s'il n'y a pas d'erreur lors du téléchargement
            if ($error === UPLOAD_ERR_OK) {
                // Déplacer le fichier téléchargé vers le répertoire souhaité
                $newFileName = 'img_' . $id . '.png'; // Nom de fichier basé sur l'ID
                move_uploaded_file($tmpName, 'assets/images/' . $newFileName);
            }
        }

        // Rediriger avec un message de succès
        $_SESSION['message'] = "Manwha modifié avec succès";
        require_once('includes/close.php');
        header('Location: crud.php');
        exit();
    } else {
        // Si des champs sont manquants, définir un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

// Vérifier si un ID valide est présent dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('includes/db.php');
    $conn = connect();

    // Nettoyer l'ID envoyé
    $id = strip_tags($_GET['id']);

    // Préparer la requête SQL pour récupérer le manwha
    $sql = 'SELECT * FROM `manwha` WHERE `Id_Manwha` = :id;';

    // Préparer et exécuter la requête
    $query = $conn->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

    // Récupérer les données du manwha
    $manwha = $query->fetch();

    // Vérifier si le manwha existe
    if(!$manwha){
        // Si le manwha n'existe pas, rediriger avec un message d'erreur
        $_SESSION['erreur'] = "Ce manwha n'existe pas";
        header('Location: crud.php');
        exit();
    }
} else {
    // Si aucun ID n'est présent dans l'URL, rediriger avec un message d'erreur
    $_SESSION['erreur'] = "URL invalide";
    header('Location: crud.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un manwha</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                // Afficher les messages d'erreur s'il y en a
                if(!empty($_SESSION['erreur'])){
                    echo '<div class="alert alert-danger" role="alert">
                            '. $_SESSION['erreur'].'
                        </div>';
                    $_SESSION['erreur'] = "";
                }
                ?>
                <h1>Modifier un manwha</h1>
                <!-- Formulaire de modification -->
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" id="titre" name="titre" class="form-control" value="<?= htmlspecialchars($manwha['titre']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="auteur">Auteur</label>
                        <input type="text" id="auteur" name="auteur" class="form-control" value="<?= htmlspecialchars($manwha['auteur']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control"><?= htmlspecialchars($manwha['description']) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="file">Image: </label>
                        <input type="file" name="file">
                    </div>
                    <input type="hidden" value="<?= $manwha['Id_Manwha'] ?>" name="id">
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>