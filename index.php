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

    // foreach($pdo -> query( 'SELECT * FROM KID;') as $row) {
    //     debug($row);
    // }
    if (isset($_POST['toy'])) {
        $query = 'SELECT * FROM toy WHERE toyId=:toyId;';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':toyId', $_POST['name']);
        $stmt->execute();
        foreach ($stmt as $key->$row) {
            echo '<div>' . $row['toyId'] . '</div>';
            echo '<div>' . $row['toyName'] . '</div>';
            echo '<div>' . $row['toySizeCM'] . '</div>';
            echo '<div>' . $row['magicPercentage'] . '</div>';
            echo '<div>' . $row['toyPriceSEK'] . '</div>';
        }
    }

    if (isset($_POST['PNR'])) {
        $querystring = 'INSERT INTO kid (PNR, name, birthday, disobedience, deliveryNr, type) VALUES(:PNR,:name,:birthday,:disobedience,:deliveryNr,:type);';
        $stmt = $pdo->prepare($querystring);
        $stmt->bindParam(':PNR', $_POST['PNR']);
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':disobedience', $_POST['disobedience']);
        $stmt->bindParam(':deliveryNr', $_POST['deliveryNr']);
        $stmt->bindParam(':type', $_POST['type']);
    }

    // If U_PNR is true, update
    if (isset($_POST['PNR'])) {
        $querystring = 'UPDATE kid SET disobedience=:disobedience WHERE PNR=:PNR;';
        $stmt = $pdo->prepare($querystring);
        $stmt->bindParam(':PNR', $_POST['u_PNR']);
        $stmt->bindParam(':name', $_POST['u_disobedience']);

    }


    echo '<ul>';
    foreach ($pdo->query('SELECT * FROM KID;') as $row) {
        echo '<li>' . $row['name'] . ', ' . $row['type'] . '</li>';
    }
    echo '</ul>';

    echo '<ul>';
    foreach ($pdo->query('SELECT * FROM toy;') as $row) {
        echo '<li>' . $row['toyId'] . ', ' . $row['toyName'] . '</li>';
    }
    echo '</ul>';

    ?>
    <form action="index.php" method="POST">
        <select size='1' name='kid'>
            <?php
            foreach ($pdo->query('SELECT * FROM kid;') as $row) {
                echo '<option value="' . $row['PNR'] . '">' . $row['name'] . '</option>';
            }
            ?>
        </select>
        <input type="submit" value="Show SSN">
    </form>


    <?php
    // Data query to our database
    echo '<div>';
    if (isset($_POST['kid'])) {
        $query = ' SELECT * FROM kid WHERE pnr=:pnr;';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':pnr', $_POST['pnr']);
        $stmt->execute();
        foreach ($stmt as $key->$row) {
            echo '<div>' . $row['pnr'] . '</div>';
            echo '<div>' . $row['birthday'] . '</div>';
            echo '<div>' . $row['type'] . '</div>';
            echo '<div>' . $row['birthday'] . '</div>';
        }
    } else {
        echo '<span>Choose a kid</span>';
    }
    echo '</div>';
    ?>

    <?php
    if (isset($_POST['PNR'])) {
        $querystring = 'INSERT INTO kid (PNR, name, birthday, disobedience, deliveryNr, type) VALUES(:PNR,:name,:birthday,:disobedience,:deliveryNr,:type);';
        $stmt = $pdo->prepare($querystring);
        $stmt->bindParam(':PNR', $_POST['PNR']);
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':disobedience', $_POST['disobedience']);
        $stmt->bindParam(':deliveryNr', $_POST['deliveryNr']);
        $stmt->bindParam(':type', $_POST['type']);
    }


    ?>

    <form action="index.php" method="post">
        <input type="text" name"PNR" placeholder="PNR"><br>
        <input type="text" name"name" placeholder="name"><br>
        <input type="text" name"birthday" placeholder="birthday"><br>
        <input type="text" name"disobedience" placeholder="disobedience"><br>
        <input type="text" name"deliveryNr" placeholder="deliveryNr"><br>
        <input type="text" name"type" placeholder="type"><br>
        <input type="submit" value="add kid">
    </form>

    <?php
    // Data query to our database
    if (isset($_POST['toy'])) {
        $query = ' SELECT * FROM toy WHERE toyId=:toyId;';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':toyId', $_POST['toys']);
        $stmt->execute();
        foreach ($stmt as $key->$row) {
            echo '<div>' . $row['toyId'] . '</div>';
            echo '<div>' . $row['toyName'] . '</div>';
        }
    }
    ?>

    <form action="index.php" method="POST">
        <select size='1' name='toy'>
            <?php
            foreach ($pdo->query('SELECT * FROM toy;') as $row) {
                echo '<option value="' . $row['toyId'] . '">' . $row['toyName'] . '</option>';
            }
            ?>
        </select>
        <input type="submit" value="Show toy information">
    </form>

    <?php 
    // Uppdate kids disobedience
            $query = 'SELECT * FROM kid WHERE PNR=:PNR;';
            $stmt = $pdo -> prepare($query);
            $stmt -> bindParam(':PNR', $_POST['PNR']);
            $stmt ->execute();
            foreach($stmt as $key -> $row) {
                echo '<div>'.$row['name'].'</div>';
                echo '<form action="index.php" method="post">';
                echo '<input type="hidden" name="u_PNR" value="'.$row['PNR'].'"><br>';
                echo '<input type="text" name="u_disobedience" value="'.$row['disobedience'].'"><br>';
                echo '<input type="submit" value="Uppdate disobedience of kid">';
                echo '</form>';
            }
    
    ?>

</body>

</html>