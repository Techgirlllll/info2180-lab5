<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: X-Requested-With");


$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = strval($_GET['country']);
$country = filter_var($country, FILTER_SANITIZE_STRING);

$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<body>
  <table style = "width:70%">
  <thead>
    <tr>
        <th>Country Name</th>
        <th>Continent</th>
        <th>Independence</th>
        <th>Head of State</th>
      </tr>
  </thead>
  <tbody>
  <?php foreach ($results as $row): ?>
    <tr>
      <td><?php echo $row["name"]; ?></td>
      <td><?php echo $row["continent"]; ?></td>
      <td><?php echo $row["independence_year"]; ?></td>
      <td><?php echo $row["head_of_state"]; ?></td>
      </tr>
      <?php endforeach; ?>
    <tbody>
</table>
</body>

