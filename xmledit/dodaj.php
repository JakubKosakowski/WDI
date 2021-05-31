<?php
	require_once 'XmlEdit.php';
	
	$xml = new Xml();
	$autorzy = $xml->zwrocAutorzy();
	$rodzaj = $xml->zwrocRodzaje();
	
	if(isset($_POST['dodaj'])) {
		$xml->dodajKsiazke($_POST);
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dodaj książkę</title>
    </head>
    <body>
		<h1>Dodaj książkę</h1>
		
		<form method="post" action="">
			<fieldset>
				<legend>Dodaj książkę</legend>
				<table>
					<tr>
						<td>Autor</td>
						<td>
							<select name="id_autora">
							<?php foreach($autorzy as $id => $autor): ?>
								<option value="<?=$id ?>"><?=$autor ?></option>
							<?php endforeach; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Tytuł</td>
						<td><input type="text" name="tytul" /></td>
					</tr>
					<tr>
						<td>Stron</td>
						<td><input type="text" name="strony" /></td>
					</tr>
					<tr>
						<td>Rodzaj</td>
						<td>
							<select name="id_rodzaju">
							<?php foreach($rodzaj as $id => $r): ?>
								<option value="<?=$id ?>"><?=$r ?></option>
							<?php endforeach; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="dodaj" value="Dodaj" />
							<a href="index.php">powrót</a>
						</td>
					</tr>
				</table>
			</fieldset>
		</form>
    </body>
</html>
