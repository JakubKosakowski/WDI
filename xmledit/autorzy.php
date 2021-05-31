<?php
	require_once 'XmlEdit.php';
	
	$xml = new Xml();
	$autorzy = $xml->zwrocAutorzyInaczej();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Lista autorów</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php if (isset($_GET['komunikat'])) : ?>
            <p style='color:red; font-weight:bold;'>
                <?php if ($_GET['komunikat'] == 1) : ?>
                    Nie można usunąć autora, ponieważ istnieje w bazie co najmniej jedna z jego książek.
                <?php endif; ?>
            </p>
        <?php endif; ?>
        <a href="index.php">Książki</a>
        <a href="autorzy.php">Autorzy</a>
        <a href="rodzaj.php">Rodzaje</a>
		<h1>Lista autorów</h1>

        <p>
			<a href="dodaj_autora.php">Dodaj autora</a>
		</p>

        <table>
            <tr>
                <th>ID</th>
                <th>Imię</th>
                <th>Nazwisko</th>
            </tr>
            <?php foreach($autorzy as $id => $dane): ?>
                <tr>
                    <td><?=$id ?></td>
                    <td><?=$dane['imie'] ?></td>
                    <td><?=$dane['nazwisko'] ?></td>
                    <td>
					    <a href="edytuj_autora.php?id=<?=$id ?>">edytuj</a> |
					    <a href="usun_autora.php?id=<?=$id ?>">usuń</a>
				    </td>
			    </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>