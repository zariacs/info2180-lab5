<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';
$country = $_GET['country'];
$lookup = $_GET['lookup'];

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Choose to display country or city info based on value of $lookup variable

// Display coutnry info
if ($lookup == 'country') { 
  // Retrieve data from database using SQL query
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%';");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>

  <!-- Format results into HTML table -->

  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Continent</th>
        <th>Independence</th>
        <th>Head of State</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($results as $row): ?>
      <tr>
        <td><?= $row['name'] ?></td>
        <td><?= $row['continent'] ?></td>
        <td><?= $row['independence_year'] ?></td>
        <td><?= $row['head_of_state'] ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
 
<!-- Display city info for given country -->
<?php } else if ($lookup == 'cities') { 
  // Retrieve data from database using SQL query with join
  $stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON countries.code=cities.country_code WHERE countries.code=(SELECT code FROM countries WHERE name='$country');");

  $results = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>

  <!-- Format results into HTML table -->

  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>District</th>
        <th>Population</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($results as $row): ?>
      <tr>
        <td><?= $row['name'] ?></td>
        <td><?= $row['district'] ?></td>
        <td><?= $row['population'] ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

<?php } ?>