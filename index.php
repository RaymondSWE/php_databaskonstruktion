<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>databaskonstruktion - PHP </title>
</head>

<body>
    <h3>DB</h3>
    <?php
function debug($o)
{
    echo '<pre>';
    print_r($o);
    echo '</pre>';
}

debug($_POST);

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



<h3>Add new kid</h3>
<form action="index.php" method="post">
PNR: <input type="text" name="PNR" /><br>
Name: <input type="text" name="name" /><br>
Birthday: <input type="text" name="birthday" /><br>
Disobedience: <input type="text" name="disobedience" /><br>
Delivery number: <input type="text" name="deliveryNr" /><br>
Type: <input type="text" name="type" /><br>
<input type="submit" />
</form> 
<table>

<?php
		// Only make insert if there is a form post to process
		if(isset($_POST['PNR'])){
				$querystring='INSERT INTO kid (PNR,name,birthday,disobedience,deliveryNr,type) VALUES(:PNR,:name,:birthday,:disobedience,:deliveryNr,:type);';
				$stmt = $pdo->prepare($querystring);
				$stmt->bindParam(':PNR', $_POST['PNR']);
				$stmt->bindParam(':name', $_POST['name']);
				$stmt->bindParam(':birthday', $_POST['birthday']);
                $stmt->bindParam(':disobedience', $_POST['disobedience']);
                $stmt->bindParam(':deliveryNr', $_POST['deliveryNr']);
                $stmt->bindParam(':type', $_POST['type']);
				$stmt->execute();
		}
?>
</table>
</body>

</html>