<?php

require_once 'funkcje.php';

sprawdzLogowanie();

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $pdo = polacz();

    if (isset($_POST['zapisz'])) {
        // obsługa edycji rekordu
        $klasy = ['marka' => '', 'model' => '', 'rok' => '', 'typ_silnika' => '', 'pojemnosc' => '', 'liczba_poduszek' => '', 'abs' => '', 'esp' => ''];
        $blad = false;

        if (empty(trim($_POST['marka']))) {
            $klasy['marka'] = 'puste';
            $blad = true;
        }
        
        if (empty(trim($_POST['model']))) {
            $klasy['model'] = 'puste';
            $blad = true;
        }
        
        $options = [
            'options' => [
                'min_range' => 1900,
                'max_range' => 2999,
            ]
        ];

        if (empty($_POST['rok'])) {
            $klasy['rok'] = 'puste';
            $blad = true;
        } elseif (filter_var($_POST['rok'], FILTER_VALIDATE_INT, $options) == false) {
            $klasy['rok'] = 'format';
            $blad = true;
        }

        if (empty($_POST['pojemnosc'])) {
            $klasy['pojemnosc'] = 'puste';
            $blad = true;
        }
        
        if (empty($_POST['abs'])) {
            $klasy['abs'] = 'puste';
            $blad = true;
        }
        
        if (empty($_POST['esp'])) {
            $klasy['esp'] = 'puste';
            $blad = true;
        }


        if(isset($blad) && !$blad){
        $stmt = $pdo->prepare("UPDATE samochody SET marka = :marka, model = :model, rok = :rok, typ_silnika = :typ_silnika, pojemnosc = :pojemnosc, liczba_poduszek = :liczba_poduszek, abs = :abs, esp = :esp WHERE id = :id");
        $wynik = $stmt->execute([
            'marka' => $_POST['marka'],
            'model' => $_POST['model'],
            'rok' => $_POST['rok'],
            'typ_silnika' => $_POST['typ_silnika'],
            'pojemnosc' => $_POST['pojemnosc'],
            'liczba_poduszek' => $_POST['liczba_poduszek'],
            'abs' => $_POST['abs'],
            'esp' => $_POST['esp'],
            'id' => $id,
        ]);

        if ($wynik == true) {
            header("Location: edytuj.php?id=$id&komunikat=1");
            exit();
        } else {
            die("Operacja się nie powiodła: " . $pdo->errorInfo());
        }

    }
    } else {
        // wczytanie danych samochodu z bazy
        $stmt = $pdo->prepare("SELECT * FROM samochody WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $wiersz = $stmt->fetch();

        if (!$wiersz) {
            die("Nie znaleziono podanego samochodu!");
        }
    }
} else {
    die("Nie podano ID");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edycja</title>
    <meta charset="utf-8">
    <style type="text/css">
    .puste {
    	background-color: red;
    }
    
    .format {
    	background-color: blue;
    }
    </style>
</head>

<body>
    <?php if (($_GET['komunikat'] ?? null) == 1) : ?>
        <p style='color:red; font-weight:bold;'>Dane zostaly zapisane.</p>
    <?php endif; ?>

    <form method="post" action="">
        <table>
            <tr>
                <td>Marka</td>
                <td><input type="text" name="marka" class="<?=$klasy['marka'] ?>" value="<?= $wiersz['marka'] ?? $_POST["marka"] ?>" /></td>
            </tr>
            <tr>
                <td>Model</td>
                <td><input type="text" name="model" class="<?=$klasy['model'] ?>" value="<?= $wiersz['model'] ?? $_POST["model"] ?>" /></td>
            </tr>
            <tr>
                <td>Rok</td>
                <td><input type="text" name="rok" class="<?=$klasy['rok'] ?>" value="<?= $wiersz['rok'] ?? $_POST['rok'] ?>" /></td>
            </tr>
            <tr>
                <td>Typ silnika</td>
                <td>
                    <select name="typ_silnika" class="<?=$klasy['typ_silnika'] ?>">
                        <option value="benzyna" <?= ($wiersz['typ_silnika'] ?? '') == 'benzyna' ? 'selected' : '' ?>>benzyna</option>
                        <option value="diesel" <?= ($wiersz['typ_silnika'] ?? '') == 'diesel' ? 'selected' : '' ?>>diesel</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Pojemność</td>
                <td><input type="number" step =0.1 name="pojemnosc" class="<?=$klasy['pojemnosc'] ?>" value="<?= $wiersz['pojemnosc'] ?? $_POST['pojemnosc'] ?>" /></td>
            </tr>
            <tr>
                <td>Liczba poduszek</td>
                <td>
                    <select name="liczba_poduszek" class="<?=$klasy['liczba_poduszek'] ?>">
                        <option value="1" <?= ($_POST['liczba_poduszek'] ?? '') == '1' ? 'selected' : '' ?>>1</option>
                        <option value="2" <?= ($_POST['liczba_poduszek'] ?? '') == '2' ? 'selected' : '' ?>>2</option>
                        <option value="4" <?= ($_POST['liczba_poduszek'] ?? '') == '4' ? 'selected' : '' ?>>4</option>
                        <option value="6" <?= ($_POST['liczba_poduszek'] ?? '') == '6' ? 'selected' : '' ?>>6</option>
                        <option value="8" <?= ($_POST['liczba_poduszek'] ?? '') == '8' ? 'selected' : '' ?>>8</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>ABS</td>
                <td><input type="radio" name='abs' value = 'tak' <?= ($_POST['abs'] ?? '') == 'tak' ? 'checked' : '' ?>>TAK</td>
                <td><input type="radio" name='abs' value = 'nie' <?= ($_POST['abs'] ?? '') == 'nie' ? 'checked' : '' ?>>NIE</td>
            </tr>
            <tr>
                <td>ESP</td>
                <td><input type="radio" name='esp' value = 'tak' <?= ($_POST['esp'] ?? '') == 'tak' ? 'checked' : '' ?>>TAK</td>
                <td><input type="radio" name='esp' value = 'nie' <?= ($_POST['esp'] ?? '') == 'nie' ? 'checked' : '' ?>>NIE</td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="zapisz" value="Zapisz" /></td>
            </tr>
        </table>
    </form>

    <p>
        <a href="index.php">[ Powrót do listy ]</a>
    </p>
</body>

</html>