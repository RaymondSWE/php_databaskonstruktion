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
    <form action=" db.php " method="POST">
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
        // Data will only show if only data is set.
        echo '<div>';
        if(isset($_POST['kid'])) {
            echo '<div>';
            foreach($pdo->query( 'SELECT * FROM KID;' ) as $row){

            }
            
        }else {
            echo '<h3> Pick a kid, to see information about them: </h3>';
        }
        'echo </div>';   
    ?>


</body>
</html>