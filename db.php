<?php

require 'aws.php';

function makeConnection() {
  $data = file_get_contents("auth.json");
  $json = json_decode($data, true);

  $servername = $json['dbServer'];
  $username = $json['dbUser'];
  $password = $json['dbPass'];
  $db = $json['db'];

  // Create connection
  $conn = new mysqli($servername, $username, $password, $db);

  // Check connection
  if ($conn->connect_error) {
    return NULL;
    die("Connection failed: " . $conn->connect_error);
  }

  return $conn;
}



function insertIntoDatabase($name, $key, $access) {

  $conn = makeConnection();
  $query = <<<QUERY
    INSERT INTO `media`(`name`, `key`, `access-level`) VALUES ("{$name}", "{$key}", {$access});
  QUERY;
  $conn->prepare($query);
  $result = $conn->query($query);
  $conn->close();
}


function getAll() {
  $conn = makeConnection();
  $query = "SELECT * FROM `media`";
  $result = $conn->query($query);
  if($conn!= NULL) echo "huh";
  $conn->close();
  return $result;
}

?>
