<?php

require_once 'funkcje.php';

sprawdzLogowanie();

if (isset($_GET['id'])){
    $pdo = polacz();

    $stmt = $pdo->prepare('SELECT * FROM samochody WHERE id = :id');
    $stmt->execute(['id' => $_GET['id']]);
    $wiersz = $stmt->fetch();
}
else{
    die("Nie podano ID");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wybór</title>
</head>
<body>
    <p>Czy jesteś pewny, że chcesz usunąć pojazd <?=$wiersz['marka']?> <?=$wiersz['model']?> z bazy danych?</p> 
    <a href="usun.php?id=<?=$_GET['id']?>">[ TAK ]</a>
    <a href="index.php">[ NIE ]</a>   
</body>
</html>