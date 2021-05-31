<?php
	require_once 'XmlEdit.php';
	
	$xml = new Xml();
	
	if(isset($_POST['dodaj'])) {
		$xml->dodajAutora($_POST);
		header("Location: autorzy.php");
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dodaj autora</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <a href="index.php">Książki</a>
        <a href="autorzy.php">Autorzy</a>
		<h1>Dodaj autora</h1>
            <form method="post" action="">
                <fieldset>
                    <legend>Dodaj autora</legend>
                    <table>
                        <tr>
                            <td>Imię</td>
                            <td><input type="text" name="imie" /></td>
                        </tr>
                        <tr>
                            <td>Nazwisko</td>
                            <td><input type="text" name="nazwisko" /></td>
                        </tr>
                        <tr>
						    <td colspan="2">
							    <input type="submit" name="dodaj" value="Dodaj" />
							    <a href="autorzy.php">powrót</a>
						    </td>
					    </tr>
                    <table>
                </fieldset>
            </form>
    </body>
</html>