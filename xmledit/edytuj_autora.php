<?php
	require_once 'XmlEdit.php';
	
	$xml = new Xml();
	
	if(isset($_POST['zapisz'])) {
		$xml->zapiszAutora($_GET['id'], $_POST);
		header("Location: autorzy.php");
	} else {
		$autor = $xml->pobierzAutora($_GET['id']);
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edytuj autora</title>
    </head>
    <body>
		<h1>Edytuj autora</h1>
		
		<form method="post" action="">
			<fieldset>
				<legend>Edytuj autora</legend>
				<table>
					<tr>
                        <td>Imię</td>
                        <td><input type="text" name="imie" value="<?=$autor['imie'] ?>" /></td>
                    </tr>
                    <tr>
						<td>Nazwisko</td>
						<td><input type="text" name="nazwisko" value="<?=$autor['nazwisko'] ?>" /></td>
					</tr>
                    <tr>
						<td colspan="2">
							<input type="submit" name="zapisz" value="Zapisz" />
							<a href="autorzy.php">powrót</a>
						</td>
					</tr>
				</table>
			</fieldset>
		</form>
    </body>
</html>
