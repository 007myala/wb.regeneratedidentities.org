<?php
require 'database_login.php';

$records = $conn_login->prepare('SELECT * FROM users WHERE id = :id');
  $records->bindParam(':id', $_SESSION['user_id']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

require 'database_SS.php';



  ?>
