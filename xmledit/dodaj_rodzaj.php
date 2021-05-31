<?php
	require_once 'XmlEdit.php';
	
	$xml = new Xml();
	
	if(isset($_POST['dodaj'])) {
		$xml->dodajRodzaj($_POST);
		header("Location: rodzaj.php");
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dodaj rodzaj</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <a href="index.php">Książki</a>
        <a href="autorzy.php">Autorzy</a>
        <a href="rodzaj.php">Rodzaje</a>
		<h1>Dodaj rodzaj</h1>
            <form method="post" action="">
                <fieldset>
                    <legend>Dodaj rodzaj</legend>
                    <table>
                        <tr>
                            <td>Nazwa</td>
                            <td><input type="text" name="nazwa" /></td>
                        </tr>
                        <tr>
						    <td colspan="2">
							    <input type="submit" name="dodaj" value="Dodaj" />
							    <a href="rodzaj.php">powrót</a>
						    </td>
					    </tr>
                    <table>
                </fieldset>
            </form>
    </body>
</html>