<?php
	require_once 'XmlEdit.php';
	
	$xml = new Xml();
	$autorzy = $xml->zwrocAutorzy();
	$rodzaj = $xml->zwrocRodzaje();
	
	if(isset($_POST['zapisz'])) {
		$xml->zapiszKsiazke($_GET['id'], $_POST);
		header("Location: index.php");
	} else {
		$ksiazka = $xml->pobierzKsiazke($_GET['id']);
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edytuj książkę</title>
    </head>
    <body>
		<h1>Edytuj książkę</h1>
		
		<form method="post" action="">
			<fieldset>
				<legend>Edytuj książkę</legend>
				<table>
					<tr>
						<td>Autor</td>
						<td>
							<select name="id_autora">
							<?php foreach($autorzy as $id => $autor): ?>
								<option value="<?=$id ?>" <?=($id == $ksiazka['id_autora']) ? 'selected="selected"' : '' ?>><?=$autor ?></option>
							<?php endforeach; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Tytuł</td>
						<td><input type="text" name="tytul" value="<?=$ksiazka['tytul'] ?>" /></td>
					</tr>
					<tr>
						<td>Stron</td>
						<td><input type="text" name="strony" value="<?=$ksiazka['strony'] ?>" /></td>
					</tr>
					<tr>
						<td>Rodzaj</td>
						<td>
							<select name="id_rodzaju">
							<?php foreach($rodzaj as $id => $r): ?>
								<option value="<?=$id ?>" <?=($id == $ksiazka['id_rodzaju']) ? 'selected="selected"' : '' ?>><?=$r ?></option>
							<?php endforeach; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="zapisz" value="Zapisz" />
							<a href="index.php">powrót</a>
						</td>
					</tr>
				</table>
			</fieldset>
		</form>
    </body>
</html>
