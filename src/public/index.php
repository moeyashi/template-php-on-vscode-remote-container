<?php
  $db_connection = $_ENV['DB_CONNECTION'];
  $db_host = $_ENV['DB_HOST'];
  $db_port = $_ENV['DB_PORT'];
  $db_username = $_ENV['DB_USERNAME'];
  $db_password = $_ENV['DB_PASSWORD'];
  try {
    $con = new PDO("${db_connection}:dbname=test_database;host=${db_host};", $db_username, $db_password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->exec("CREATE TABLE IF NOT EXISTS test (
      `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
      `name` VARCHAR(32)
    ) engine=innodb default charset=utf8");
  
    $stmt_list = $con->prepare("SELECT * FROM test;");
    $stmt_list->execute();
    $list = $stmt_list->fetchAll();
    if (count($list) < 10) {
      $con->exec("INSERT INTO test (name) VALUES ('test');");
    } 
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
  foreach ($list as $item) {
    echo("<p>".$item['id']."</p>");
  }
  $con = null;
?>
<p>hello world!!</p>