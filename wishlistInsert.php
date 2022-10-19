<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert to wishlist</title>
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

<h3>Add new Wishlist</h3>
<form action="wishlistInsert.php" method="post">
year: <input type="text" name="year" /><br>
Social Security Number: <input type="text" name="PNR" /><br>
toy ID: <input type="text" name="toyId" /><br>
description: <input type="text" name="description" /><br>
conceded: <input type="text" name="conceded" /><br>
delivered: <input type="text" name="delivered" /><br>
<input type="submit" />
</form> 
<table>

<?php
		// Only make insert if there is a form post to process
		if(isset($_POST['year'])){
				$querystring='INSERT INTO wishlist (year,PNR,toyId,description,conceded,delivered) VALUES(:year,:PNR,:toyId,:description,:conceded, :delivered);';
				$stmt = $pdo->prepare($querystring);
				$stmt->bindParam(':year', $_POST['year']);
				$stmt->bindParam(':PNR', $_POST['PNR']);
				$stmt->bindParam(':toyId', $_POST['toyId']);
                $stmt->bindParam(':description', $_POST['description']);
                $stmt->bindParam(':conceded', $_POST['conceded']);
                $stmt->bindParam(':delivered', $_POST['delivered']);
				$stmt->execute();
		}
?>
</table>
    
</body>
</html>