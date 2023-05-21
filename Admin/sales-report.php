// Add a new column to the `orders` table called `order_date`.
$sql = "ALTER TABLE orders ADD COLUMN order_date DATETIME";
mysqli_query($conn, $sql);

// Update the `orders` table to populate the `order_date` column with the current date.
$sql = "UPDATE orders SET order_date = NOW()";
mysqli_query($conn, $sql);

// Add a new query to the code that will select the total sales for each day of the month.
$sql = "SELECT DATE(order_date) AS day, SUM(total) AS total_sales
FROM orders
GROUP BY DATE(order_date)";
$result = mysqli_query($conn, $sql);

// Add a new query to the code that will select the total sales for each month of the year.
$sql = "SELECT MONTH(order_date) AS month, SUM(total) AS total_sales
FROM orders
GROUP BY MONTH(order_date)";
$result = mysqli_query($conn, $sql);

// Update the code to display the daily sales and monthly sales charts.
echo "<h2>Daily Sales</h2>";
echo "<canvas id=\"chartjs_pie\"></canvas>";

$chart_data = array();
while ($row = mysqli_fetch_array($result)) {
  $chart_data[] = array($row['day'], $row['total_sales']);
}

$options = array(
  'title' => 'Daily Sales',
  'labels' => array_keys($chart_data),
  'datasets' => array(
    array(
      'data' => array_values($chart_data),
      'backgroundColor' => array('#5969ff', '#ff407b', '#25d5f2', '#ffc750', '#2ec551', '#7040fa', '#ff004e')
    )
  )
);

$myChart = new Chart(document.getElementById('chartjs_pie'), $options);

echo "<h2>Monthly Sales</h2>";
echo "<canvas id=\"chartjs_bar\"></canvas>";

$chart_data = array();
while ($row = mysqli_fetch_array($result)) {
  $chart_data[] = array($row['month'], $row['total_sales']);
}

$options = array(
  'title' => 'Monthly Sales',
  'labels' => array_keys($chart_data),
  'datasets' => array(
    array(
      'data' => array_values($chart_data),
      'backgroundColor' => array('#5969ff', '#ff407b', '#25d5f2', '#ffc750', '#2ec551', '#7040fa', '#ff004e')
    )
  )
);

$myChart = new Chart(document.getElementById('chartjs_bar'), $options);
// Add a new column to the `orders` table called `order_date`.
$sql = "ALTER TABLE orders ADD COLUMN order_date DATETIME";
mysqli_query($conn, $sql);

// Update the `orders` table to populate the `order_date` column with the current date.
$sql = "UPDATE orders SET order_date = NOW()";
mysqli_query($conn, $sql);

// Add a new query to the code that will select the total sales for each day of the month.
$sql = "SELECT DATE(order_date) AS day, SUM(total) AS total_sales
FROM orders
GROUP BY DATE(order_date)";
$result = mysqli_query($conn, $sql);

// Add a new query to the code that will select the total sales for each month of the year.
$sql = "SELECT MONTH(order_date) AS month, SUM(total) AS total_sales
FROM orders
GROUP BY MONTH(order_date)";
$result = mysqli_query($conn, $sql);

// Update the code to display the daily sales and monthly sales charts.
echo "<h2>Daily Sales</h2>";
echo "<canvas id=\"chartjs_pie\"></canvas>";

$chart_data = array();
while ($row = mysqli_fetch_array($result)) {
  $chart_data[] = array($row['day'], $row['total_sales']);
}

$options = array(
  'title' => 'Daily Sales',
  'labels' => array_keys($chart_data),
  'datasets' => array(
    array(
      'data' => array_values($chart_data),
      'backgroundColor' => array('#5969ff', '#ff407b', '#25d5f2', '#ffc750', '#2ec551', '#7040fa', '#ff004e')
    )
  )
);

$myChart = new Chart(document.getElementById('chartjs_pie'), $options);

echo "<h2>Monthly Sales</h2>";
echo "<canvas id=\"chartjs_bar\"></canvas>";

$chart_data = array();
while ($row = mysqli_fetch_array($result)) {
  $chart_data[] = array($row['month'], $row['total_sales']);
}

$options = array(
  'title' => 'Monthly Sales',
  'labels' => array_keys($chart_data),
  'datasets' => array(
    array(
      'data' => array_values($chart_data),
      'backgroundColor' => array('#5969ff', '#ff407b', '#25d5f2', '#ffc750', '#2ec551', '#7040fa', '#ff004e')
    )
  )
);

$myChart = new Chart(document.getElementById('chartjs_bar'), $options);
