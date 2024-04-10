<?php

// On inclut la connexion à la base
require_once('includes/db.php');
$conn = connect();

// Nombre d'éléments à afficher par page
$elementsParPage = 9;

// Numéro de page actuel
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$currentPage = max(1, $currentPage); // Assure que le numéro de page ne soit pas inférieur à 1

// Requête pour compter le nombre total de mangas
$sqlCount = "SELECT COUNT(*) AS total FROM manwha";
$queryCount = $conn->query($sqlCount);
$totalMangas = $queryCount->fetch(PDO::FETCH_ASSOC)['total'];

// Calcul du nombre total de pages
$pages = ceil($totalMangas / $elementsParPage);

// Calcul du décalage
$offset = ($currentPage - 1) * $elementsParPage;

// Requête pour récupérer les mangas avec pagination
$sql = "SELECT Id_Manwha, titre, auteur FROM manwha ORDER BY Id_Manwha ASC LIMIT $elementsParPage OFFSET $offset";
$query = $conn->query($sql);
$mangas = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Répertoire de mangas</title>
    <link rel="stylesheet" href="assets/site.css">
</head>
<body>
    <h1>Répertoire de Manwha</h1>
    <div class="log-in-link"> 
        <a href="log_in.php">Connexion admin</a>
    </div>

    <div class="manga-container">
        <?php foreach ($mangas as $manga) : ?>
            <div class="manga">
                <h2><?php echo $manga['titre']; ?></h2>
                <?php
                echo "<img class='img' src='assets/images/img_{$manga['Id_Manwha']}.png'>";
                ?>
                <p><strong>Auteur :</strong> <?php echo $manga['auteur']; ?></p>
                <a href="fiche-manga.php?id=<?php echo $manga['Id_Manwha']; ?>">Voir la fiche</a>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Pagination -->
    <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">

                <!-- Page précédente -->
                <?php if ($currentPage > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>">&lsaquo;</a>
                </li>
                <?php endif; ?>

                <!-- Première page -->
                <?php if ($currentPage > 2): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=1">1</a>
                </li>
                <?php elseif ($currentPage == 2): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=1">1</a>
                </li>
                <?php endif; ?>

                <!-- Page précédente -->
                <?php if ($currentPage > 2): ?>
                <li class="page-item disabled">
                    <a class="page-link" href="#">...</a>
                </li>
                <?php endif; ?>

                <!-- Page actuelle -->
                <li class="page-item active">
                    <a class="page-link" href="#"><?php echo $currentPage; ?></a>
                </li>

                <!-- Page suivante -->
                <?php if ($currentPage < $pages - 1): ?>
                <li class="page-item disabled">
                    <a class="page-link" href="#">...</a>
                </li>
                <?php endif; ?>

                <!-- Dernière page -->
                <?php if ($currentPage < $pages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $pages; ?>"><?php echo $pages; ?></a>
                </li>
                <?php endif; ?>
                <!-- Page suivante -->
                <?php if ($currentPage < $pages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>">&rsaquo;</a>
                </li>
                <?php endif; ?>

            </ul>
        </nav> 

</body>
</html>
