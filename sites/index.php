<?php

// On inclut la connexion à la base
require_once('includes/db.php');
$conn = connect();

// Nombre d'éléments à afficher par page
$elementsParPage = 3;

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
    <div class="top-right"> 
    <a href="log_in.php">Connexion admin</a>
    </div>

    <h1>Répertoire de Manwha</h1>
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
            <!-- Première page -->
            <li class="page-item">
                <a class="page-link" href="?page=1">&laquo;</a>
            </li>
            <!-- Page précédente -->
            <?php if ($currentPage > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo max($currentPage - 1, 1); ?>"><?php echo max($currentPage - 1, 1); ?></a>
            </li>
            <?php endif; ?>
            <!-- Page actuelle -->
            <li class="page-item active">
                <a class="page-link" href="#"><?php echo $currentPage; ?></a>
            </li>
            <!-- Page suivante -->
            <?php if ($currentPage < $pages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo min($currentPage + 1, $pages); ?>"><?php echo min($currentPage + 1, $pages); ?></a>
            </li>
            <?php endif; ?>
            <!-- Dernière page -->
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $pages; ?>">&raquo;</a>
            </li>
        </ul>
    </nav> 
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
