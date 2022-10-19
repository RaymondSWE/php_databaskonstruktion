<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>databaskonstruktion - PHP </title>
</head>

<body>
    <h1>Kid Insert Data</h1>
    <?php
// function debug($o)
// {
//     echo '<pre>';
//     print_r($o);
//     echo '</pre>';
// }

// debug($_POST);

$pdo = new PDO('mysql:dbname=a21rammo;host=localhost', 'raman', 'user_password');
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
?>



<h3>Add new kid</h3>
<form action="kidInsert.php" method="post">
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


<h3>Kid Option Box</h3>
<form action="kid.php" method="post">
	<select size='1' name='PNR'>
<?php		
		foreach($pdo->query( 'SELECT * FROM kid ORDER BY NAME;' ) as $row){
			echo '<option value="'.$row['PNR'].'">';
			echo $row['name'];			
			echo '</option>';
		}		
?>
   </select>
   <input type="submit" value="Send">
   <input type="reset">
</form>
</table>

<table>
 
<h3>Query Generator</h3>
<?php  
    foreach($pdo->query( 'SELECT * FROM kid;' ) as $row){
      echo "<tr><td>";
      echo "<a href='kid.php?PNR=".urlencode($row['PNR'])."'>Kid: ".$row['name']."</a>";
      echo "</td></tr>";  
    }
?>
 
</table>
</body>
</html>