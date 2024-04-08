<?php
// On démarre une session
session_start();
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['login'])) {
    header("Location: log_in.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('includes/db.php');
    $conn = connect();

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `manwha` WHERE `Id_Manwha` = :id;';

    // On prépare la requête
    $query = $conn->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On vérifie si le manwha existe
    if(!$query->fetch()){
        $_SESSION['erreur'] = "Ce manwha n'existe pas";
        header('Location: crud.php');
        exit();
    }

    $sql = 'DELETE FROM `manwha` WHERE `Id_Manwha` = :id;';

    // On prépare la requête
    $query = $conn->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();
    $_SESSION['message'] = "Manwha supprimé";
    header('Location: crud.php');
    exit();
}
else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: crud.php');
    exit();
}
?>
