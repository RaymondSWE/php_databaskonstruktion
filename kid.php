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

  
<h3>Update kids name</h3>
	
<?php


		if(isset($_POST['CustPNR'])){
				$querystring='UPDATE kid SET name=:name WHERE PNR=:CUSTPNR;';
				$stmt = $pdo->prepare($querystring);
				$stmt->bindParam(':name', $_POST['Custname']);
				$stmt->bindParam(':CUSTPNR', $_POST['CustPNR']);			
				$stmt->execute();				
		}
	
		foreach($pdo->query("SELECT * FROM kid") as $row){
			echo "<form style='margin:0;display: flex;' action='kid.php' method='post' >";
			echo "<span style='flex: 4;border: 1px solid red;'>".$row['PNR']."</span>";			
			echo "<span style='flex: 4;border: 1px solid red;'>";
				echo "<input type='text' name='Custname' value='".$row['name']."'>";
				echo "<input type='hidden' name='CustPNR' value='".$row['PNR']."'>";
			echo "</span>";			
			echo "<span style='flex: 4;border: 1px solid red;'>".$row['birthday']."</span>";
			echo "<span style='flex: 4;border: 1px solid red;'><input type='submit' value='Save!' /></span>";			
			echo "</form>";
		}
		
?>
</body>
</html>