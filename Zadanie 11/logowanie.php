<?php

session_start();


if (isset($_POST['zaloguj'])) {
	$pdo = new PDO('mysql:host=localhost;dbname=test', 'root', '');

	$stmt = $pdo->prepare("SELECT * FROM uzytkownicy WHERE login = :login AND haslo = :haslo");
	$stmt->execute(['login' => $_POST['login'], 'haslo' => $_POST['haslo']]);
    $wynik = $stmt->fetch();
    $dane=[];
    foreach($pdo->query('SELECT * FROM uzytkownicy') as $row){
        $dane[] = $row;
    }
	if (password_verify($_POST['haslo'], $dane[0][2]) && $_POST['login'] == $dane[0][1] && $dane[0][3] == 'N') {
        $as = $pdo->prepare("UPDATE uzytkownicy SET proby = 0 WHERE id = 1");
        $as->execute();
		$_SESSION['zalogowany'] = 'tak';
		$_SESSION['id'] = $wynik['id'];
		header("Location: index.php");
    }
    else {
        if($dane[0][3] == 'N'){
            if($dane[0][4] < 3){
                $s = $dane[0][4];
                ++$s;
                $ab = $pdo->prepare("UPDATE uzytkownicy SET proby = $s WHERE id = 1");
                $ab->execute();
                $komunikat = "Wprowadzono zły login lub hasło";
            }
            else{
                $ag = $pdo->prepare("UPDATE uzytkownicy SET ban = 'T' WHERE id = 1");
                $ag->execute();
                $komunikat = "Twoje konto zostało zablokowane z powodu przekroczenia ilości możliwych błędów w logowaniu";    
            }
        }
        else{
            $komunikat = "Konto zablokowane";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logowanie</title>
</head>
<body>
    <?php if (!empty($komunikat)): ?>
        <p style="font-weight: bold; color: red;"><?=$komunikat ?></p>
    <?php endif; ?>
    
    <form method="post" action="">
        <table>
            <tr>
                <td>Login</td>
                <td><input type="text" name="login" /></td>
            </tr>
            <tr>
                <td>Hasło</td>
                <td><input type="password" name="haslo" /></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="zaloguj" value="Zaloguj" /></td>
            </tr>
        </table>
    </form>
</body>
</html>