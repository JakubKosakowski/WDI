<?php
	require_once 'XmlEdit.php';
	
	$xml = new Xml();
	$rodzaje = $xml->zwrocRodzajeInaczej();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Rodzaje książek</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php if (isset($_GET['komunikat'])) : ?>
            <p style='color:red; font-weight:bold;'>
                <?php if ($_GET['komunikat'] == 1) : ?>
                    Nie można usunąć rodzaju, ponieważ istnieje w bazie co najmniej jedna książka tego rodzaju.
                <?php endif; ?>
            </p>
        <?php endif; ?>
        <a href="index.php">Książki</a>
        <a href="autorzy.php">Autorzy</a>
        <a href="rodzaj.php">Rodzaje</a>
		<h1>Rodzaje książek</h1>

        <p>
			<a href="dodaj_rodzaj.php">Dodaj rodzaj</a>
		</p>

        <table>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
            </tr>
            <?php foreach($rodzaje as $id => $dane): ?>
                <tr>
                    <td><?=$id ?></td>
                    <td><?=$dane['nazwa'] ?></td>
                    <td>
					    <a href="edytuj_rodzaj.php?id=<?=$id ?>">edytuj</a> |
					    <a href="usun_rodzaj.php?id=<?=$id ?>">usuń</a>
				    </td>
			    </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>