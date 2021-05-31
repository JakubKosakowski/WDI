<?php

$plik = file_get_contents("samochody.xml");
$xml = new SimpleXMLElement($plik);
$a = 0;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Zadanie1</title>
		<meta charset="utf-8">
	</head>
	<body>
		<table border="1">
			<tr>
				<th>ID pojazdu</th>
				<th>Marka</th>
				<th>Model</th>
				<th>Rok</th>
				<th>Pojemność</th>
				<th>Typ silnika</th>
				<th>Liczba poduszek</th>
				<th>ABS</th>
				<th>ESP</th>
			</tr>
			<?php foreach($xml as $d){
				if($a % 2 == 0){
					echo "<tr>
					<td>".$d->id."</td>
					<td>".$d->marka."</td>
					<td>".$d->model."</td>
					<td>".$d->rok."</td>
					<td>".$d->pojemnosc."</td>
					<td>".$d->typ_silnika."</td>
					<td>".$d->liczba_poduszek."</td>";
					if($d->abs == "tak"){
						echo '<td style="background-color: green;">'.$d->abs.'</td>';
					}
					else{
						echo '<td style="background-color: red;">'.$d->abs.'</td>';	
					}
					if($d->abs == "tak"){
						echo '<td style="background-color: green;">'.$d->esp.'</td>';
					}
					else{
						echo '<td style="background-color: red;">'.$d->esp.'</td>';	
					}
					echo "</tr>";
				}
				else{
					echo '<tr style = "background-color: gray;">
					<td>'.$d->id."</td>
					<td>".$d->marka."</td>
					<td>".$d->model."</td>
					<td>".$d->rok."</td>
					<td>".$d->pojemnosc."</td>
					<td>".$d->typ_silnika."</td>
					<td>".$d->liczba_poduszek."</td>";
					if($d->abs == "tak"){
						echo '<td style="background-color: green;">'.$d->abs.'</td>';
					}
					elseif($d->abs != "tak"){
						echo '<td style="background-color: red;">'.$d->abs.'</td>';	
					}
					if($d->esp == "tak"){
						echo '<td style="background-color: green;">'.$d->esp.'</td>';
					}
					elseif($d->esp != "tak"){
						echo '<td style="background-color: red;">'.$d->esp.'</td>';	
					}
					echo "</tr>";
				}
				$a = $a + 1;
			}
			?>
		</table>
	</body>
</html>
