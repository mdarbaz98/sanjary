<?php
include('db.php');

    if(isset($_POST['userid'])){
    echo $_POST['userid'];
    $stmt = $conn->prepare("SELECT * FROM `cart` WHERE userid=?");
    $stmt->execute([$_POST['userid']]);
    $user_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo $userCount=$stmt->rowCount();
    }

?>