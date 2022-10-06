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
    
</body>
</html>