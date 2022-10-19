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

<h3>Table With Hidden Input Detail Form</h3>

<?php
		if(isset($_POST['ModPNR'])){
				$querystring='UPDATE kid SET PNR=:PNR, NAME=:NAME, BIRTHDAY=:BIRTHDAY, DISOBEDIENCE=:DISOBEDIENCE, DELIVERYNR=:DELIVERYNR, TYPE=:TYPE WHERE PNR=:MODPNR;';
				$stmt = $pdo->prepare($querystring);
				$stmt->bindParam(':PNR', $_POST['PNR']);
				$stmt->bindParam(':NAME', $_POST['name']);
				$stmt->bindParam(':BIRTHDAY', $_POST['birthday']);
				$stmt->bindParam(':DISOBEDIENCE', $_POST['disobedience']);
				$stmt->bindParam(':DELIVERYNR', $_POST['deliveryNr']);		
                $stmt->bindParam(':TYPE', $_POST['type']);		
                $stmt->bindParam(':MODPNR', $_POST['ModPNR']);	
				$stmt->execute();				
		}else if(isset($_POST['EdPNR'])){
				echo "<div style='border:1px solid outset #888;border-radius:4px;background-color:#eee;'>";
				echo "<form action='kid.php' method='post' >";
                echo "<input type='hidden' name='ModPNR' value='".$_POST['EdPNR']."'>";
                echo "PNR:<input type='text' name='PNR' value='".$_POST['EdPNR']."'><br>";
                echo "name:<input type='text' name='name' value='".$_POST['name']."'><br>";
                echo "birthday:<input type='text' name='birthday' value='".$_POST['birthday']."'><br>";
                echo "disobedience:<input type='text' name='disobedience' value='".$_POST['disobedience']."'><br>";
                echo "deliveryNr:<input type='text' name='deliveryNr' value='".$_POST['deliveryNr']."'><br>";
                echo "type:<input type='text' name='type' value='".$_POST['type']."'><br>";
                echo "<input type='submit' value='Save' >";			
				echo "</form>";
				echo "</div>";
		}
	
		echo "<table style='border-collapse:collapse;'>";
		foreach($pdo->query("SELECT * FROM kid") as $row){
			if(isset($_POST['EdCustno'])){
					if($_POST['EdCustno']==$row['CUSTNO']){
								echo "<tr style='border:4px solid lightgreen;background-color:#448;color:#fff;box-shadow:2px 2px 2px #000;'>";
					}else{
								echo "<tr>";
					}
			}
			
			echo "<td>".$row['PNR']."</td>";					
			echo "<td>".$row['name']."</td>";
			echo "<td>".$row['birthday']."</td>";			
			echo "<td>".$row['disobedience']."</td>";
            echo "<td>".$row['deliveryNr']."</td>";
            echo "<td>".$row['type']."</td>";
			echo "<td>";
				echo "<form action='kid.php' method='post' >";
					echo "<input type='hidden' name='EdPNR' value='".$row['PNR']."'>";
					echo "<input type='hidden' name='name' value='".$row['name']."'>";			
					echo "<input type='hidden' name='birthday' value='".$row['birthday']."'>";			
					echo "<input type='hidden' name='disobedience' value='".$row['disobedience']."'>";			
                    echo "<input type='hidden' name='deliveryNr' value='".$row['deliveryNr']."'>";		
                    echo "<input type='hidden' name='type' value='".$row['type']."'>";		
					echo "<input type='submit' value='Edit' >";			
				echo "</form>";
			echo "</td>";
			echo "</tr>";
		}
		echo "</table>"; 
		
?>


</body>
</html>