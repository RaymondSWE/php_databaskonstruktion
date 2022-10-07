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
        function debug($o){
            echo '<pre>';
            print_r($o);
            echo '</pre>';
        }
        
        debug($_POST);

        $pdo = new PDO('mysql:dbname=a21rammo;host=localhost', 'raman', 'user_password');
        
        // foreach($pdo -> query( 'SELECT * FROM KID;') as $row) {
        //     debug($row);
        // }
        echo '<ul>';
        foreach($pdo->query( 'SELECT * FROM KID;' ) as $row){
            echo '<li>'.$row['name'].', '.$row['type'].'</li>';
        }
        echo '</ul>';

    ?>
    <form action="index.php" method="POST">
        <select size='1' name='kid'>
            <?php
                foreach($pdo->query( 'SELECT * FROM KID;' ) as $row){
                    echo '<option value="'.$row['PNR'].'">'.$row['name'].'</option>';
                }
            ?>
        </select>
        <input type="submit" value="Show SSN">
    </form>


    <?php
        // Data query to our database
        if(isset($_POST['kid'])) {
            $query = ' SELECT * FROM kid WHERE name=:name;';
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':name', $_POST['kid']);
            $stmt->execute();
            foreach($stmt as $key -> $row){
                echo '<div>'.$row['pnr'].'</div>';
                echo '<div>'.$row['birthday'].'</div>';
            }
        }
    ?>

    <form action="index.php" method="post">
        <input type="text" name"pnr" placeholder="pnr"><br>
        <input type="text" name"name" placeholder="name"><br>
        <input type="text" name"birthday" placeholder="birthday"><br>
        <input type="text" name"disobedience" placeholder="disobedience"><br>
        <input type="text" name"deliveryNr" placeholder="deliveryNr"><br>
        <input type="text" name"type" placeholder="type"><br>
        <input type="submit" value="add kid">
    </form>
        

    <?php
        // insert new data to our kid table
        if(isset($_POST['pnr'])) {
            $querystring='INSERT INTO kid (pnr,name,birthday,disobedience,deliveryNr,type) VALUES(:pnr,:name,:birthday,:disobedience,:deliveryNr,:type);';
            $stmt = $pdo->prepare($querystring);
            $stmt->bindParam(':pnr', $_POST['pnr']);
            $stmt->bindParam(':name', $_POST['name']);
            $stmt->bindParam(':birthday', $_POST['birthday']);
            $stmt->bindParam(':disobedience', $_POST['disobedience']);
            $stmt->bindParam(':deliveryNr', $_POST['deliveryNr']);
            $stmt->bindParam(':type', $_POST['type']);
            $stmt->execute();
        }
    ?>

</body>
</html>