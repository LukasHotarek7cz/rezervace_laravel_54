<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!--
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

		<link rel="stylesheet" type="text/css" href="css/LHviews1.css" />
		<script src="js/LHviews1.js" ></script>

		<title>Rezervace</title>
	</head>
	<body>

	<table class="tab1" >
		<thead>
		<caption></caption>
		<tr><td colspan= 5><h1>Rezervace</h1></td></tr>
		<tr><td colspan= 5>@include("LHvarovani1")</td></tr>
		<tr>
			<form method=POST id=FoGetIDFormular1 >
			<?= csrf_field() ?>
			<th>
				<input
					 type="datetime-local"
					 name="Datum"
					 value="<?= $odchoziFormular1['datum1'] ?>"
					 min="<?= date('Y-m-d').'T'.(date('H')+1).':00:00' ?>"
					 required>
				</input>
			</td>
			<th>
				<input type=text
				 name="Název"
				 max=20
				 placeholder="nazev"
				 value="<?= $odchoziFormular1['nazev1'] ?>"
				 required >
				</input>
			</td>
			<th>
				<input type=text
				 name="Poznámka"
				 max=20
				 placeholder="poznamka"
				 value="<?= $odchoziFormular1['poznamka1'] ?>" >
				</input>
			</td>
			<th>
				<input type=number
				 name="Telefon"
				 min=0
				 placeholder="telefon"
				 value="<?= $odchoziFormular1['telefon1'] ?>"
				 required ></input>
			</td>
			<input type=hidden name="Mod" value="<?= $odchoziFormular1['mod1'] ?>" ></input>
			<input type=hidden name="PuvodníDatum" value="<?= $odchoziFormular1['datum2'] ?>" ></input>
			<th><input type=submit value="REZERVOVAT"></input></td>
			</form>
		</tr>
		<tr>
			<td>Datum</td>
			<td>Název Rezervace</td>
			<td>Poznámka</td>
			<td>Telefon</td>
			<td> </td>
		</tr>
		</head>
	</table>
	<table class="tab2">
		<tbody>
		<?php foreach($tasks1 as $e1): ?>
		<tr id="trIDRadek1_<?= $e1->datum ?>" class="TrCLRadek1" >
			<td><?= $e1->datum ?></td>
			<td><?= $e1->nazev ?></td>
			<td><?= $e1->poznamka ?></td>
			<td><?= $e1->telefon ?></td>
			<td>
				<a href="#" onClick="fAOnClUpravit1('<?= $e1->datum ?>',2);" >Upravit</a>
				<a href="#" onClick="fAOnClUpravit1('<?= $e1->datum ?>',3);" >Smazat</a>
			</td>
		</tr>
		<?php endforeach; ?>
		<script>
			//testovaci script pro zaplneni tabulky 
			t1 = "";
			t1 += '<tr class="TrCLRadek1"><td>datum</td><td>nazev</td><td>poznamka</td><td>telefon</td><td>';
			t1 += '<a href="#" >Upravit</a>';
			t1 += '<a href="#" >Smazat</a>';
			t1 += "</td></tr>";
			for(var i1=0; i1<0; i1++){ document.write(t1); }
			
		</script>
		</tbody>
	</table>

	</body>
</html>


