<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Databas test</title>
</head>
<body>
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


<h2>Kid Table</h2>
<table border='1'>
<?php
		foreach($pdo->query("SELECT * FROM kid") as $row){
			echo "<tr>";
			echo "<td>".$row['PNR']."</td>";			
			echo "<td>".$row['name']."</td>";			
			echo "<td>".$row['birthday']."</td>";
            echo "<td>".$row['disobedience']."</td>";
            echo "<td>".$row['deliveryNr']."</td>";
            echo "<td>".$row['type']."</td>";
			echo "</tr>";
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



    
</body>
</html>