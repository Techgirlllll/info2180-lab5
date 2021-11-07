<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: X-Requested-With");


$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = strval($_GET["country"]);
$country = filter_var($country, FILTER_SANITIZE_STRING);
$context = strval($_GET["context"]);
$context = filter_var($context, FILTER_SANITIZE_STRING);

if ($context == "cities") {
  $data= $conn->query("SELECT c.name, c.district, c.population FROM cities c join countries cs on c.country_code = cs.code WHERE cs.name LIKE '%$country%'");
  $results = $data->fetchAll(PDO::FETCH_ASSOC);

} else {
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>
<!-- <?php foreach ($results as $row): ?>
  <li><?= $row['name'] . 'is ruled by' .  $row['head_of_state']; ?></li>
  <?php endforeach;?> -->

<?php if ($context == "cities"):?>
  <table style = "width:70%">
  <thead>
    <tr>
        <th>City Name</th>
        <th>District</th>
        <th>Population</th>
      </tr>
  </thead>
  <tbody>
  <?php foreach ($results as $row): ?>
    <tr>
      <td><?php echo $row["name"]; ?></td>
      <td><?php echo $row["district"]; ?></td>
      <td><?php echo $row["population"]; ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
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
    </tbody>
  </table>
<?php endif; ?>

