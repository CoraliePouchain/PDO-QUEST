<?php
require_once './connec.php';

$pdo = new \PDO(DSN, USER, PASS);

$query = 'SELECT * FROM friend';
$statement = $pdo->query($query);
$friends = $statement->fetchAll();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);
$query = "INSERT INTO friend(firstname, lastname) VALUES (:firstname, :lastname)"; 

$statement = $pdo->prepare($query);

$statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
$statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);

$statement->execute();
header('Location: index.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
        <?php foreach($friends as $friend): ?>
        <li><?php echo $friend['firstname'] . ' ' . $friend['lastname']?></li>
        <?php endforeach?>
    </ul>
    
    <form action='' method='post'>
        <label for = 'firstname'>Firstname:</label>
        <input type = 'text' name = 'firstname' placeholder = 'firstname' id = 'firstname'>

        <label for = 'lastname'>Lastname:</label>
        <input type = 'text' name = 'lastname' placeholder = 'lastname' id = 'lastname'>

        <button type = 'submit'>Send</button>
    </form>

</body>
</html>













