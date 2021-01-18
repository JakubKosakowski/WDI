<?php
session_start();
$_SESSION['zalogowany'] = false;
if (!empty($_POST)) {
    if ($_POST['uzytkownik'] == 'admin' && $_POST['haslo'] == 'tajne') {
        $_SESSION['zalogowany'] = 'nieblad';
        header("Location: tajne.php");
        exit();
    }
    else{
        $_SESSION['zalogowany'] = 'blad';
        header("Location: tajne.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WIT</title>
</head>

<body>
    <?php if (isset($_GET['komunikat']) && $_GET['komunikat'] == 1) : ?>
        <p style='color: red;'>Najpierw musisz sie zalogowac!</p>
    <?php endif; ?>
    <?php if (isset($_GET['komunikat']) && $_GET['komunikat'] == 2) : ?>
        <p style='color: red;'>Bledne haslo lub login!</p>
    <?php endif; ?>
    <form method="post" action="przyklad3.php">
        Nazwa użytkownika:
        <input type="text" name="uzytkownik" />
        <br />

        Hasło:
        <input type="password" name="haslo" />
        <br />
        <br />

        <button type="submit">Zaloguj</button>
    </form>
</body>

</html>