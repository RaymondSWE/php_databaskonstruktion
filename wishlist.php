<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

$pdo = new PDO('mysql:dbname=a21rammo;host=localhost', 'raman', 'user_password');
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
?>

<h2>Wishlist Table</h2>
<table border='1'>
<?php
		foreach($pdo->query("SELECT * FROM wishlist") as $row){
			echo "<tr>";
			echo "<td>".$row['year']."</td>";			
			echo "<td>".$row['PNR']."</td>";			
			echo "<td>".$row['toyId']."</td>";
            echo "<td>".$row['description']."</td>";
            echo "<td>".$row['conceded']."</td>";
            echo "<td>".$row['delivered']."</td>";
			echo "</tr>";
		}		
?>



</table>
</body>
</html>