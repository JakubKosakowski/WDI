<?php
	require_once 'XmlEdit.php';

	$xml = new Xml();
	$ksiazki = $xml->zwrocKsiazki();
	$autorzy = $xml->zwrocAutorzy();
	$rodzaj = $xml->zwrocRodzaje();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lista książek</title>
    </head>
    <body>
		<a href="index.php">Książki</a>
		<a href="autorzy.php">Autorzy</a>
		<a href="rodzaj.php">Rodzaje</a>
		<h1>Lista książek</h1>
		
		<p>
			<a href="dodaj.php">Dodaj</a>
		</p>
		
		<table>
			<tr>
				<th>ID</th>
				<th>Autor</th>
				<th>Tytuł</th>
				<th>Strony</th>
				<th>Rodzaj</th>
			</tr>
			
			<?php foreach($ksiazki as $id => $dane): ?>
			<tr>
				<td><?=$id ?></td>
				<td><?=$autorzy[$dane['id_autora']] ?></td>
				<td><?=$dane['tytul'] ?></td>
				<td><?=$dane['strony'] ?></td>
				<td><?=$rodzaj[$dane['id_rodzaju']] ?></td>
				<td>
					<a href="edytuj.php?id=<?=$id ?>">edytuj</a> |
					<a href="usun.php?id=<?=$id ?>">usuń</a>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
    </body>
</html>
