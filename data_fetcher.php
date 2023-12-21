<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "Dashboard";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch data for gauge chart based on number of cities from customer table
function getGaugeChartData() {
    global $conn;

    // Count the total number of rows in the customer table
    $totalRowsQuery = "SELECT COUNT(*) as total_rows FROM customer";
    $totalRowsResult = $conn->query($totalRowsQuery);

    $totalRows = 0;
    if ($totalRowsRow = $totalRowsResult->fetch_assoc()) {
        $totalRows = $totalRowsRow['total_rows'];
    }

    // Query to get the count of entries for each city
    $cityCountQuery = "SELECT city, COUNT(*) as city_count FROM customer GROUP BY city";
    $cityCountResult = $conn->query($cityCountQuery);

    $data = [];

    while ($row = $cityCountResult->fetch_assoc()) {
        // Calculate the percentage of entries for each city
        $percentage = ($row['city_count'] / $totalRows) * 100;

        // Store the data for each city
        $data[$row['city']] = $percentage;
    }

    return $data;
}


// Function to fetch data for line chart based on category and quantity from logistic table
function getLineChartData() {
    global $conn;
    $query = "SELECT category, SUM(quantity) as total_quantity FROM logistic GROUP BY category";
    $result = $conn->query($query);

    $labels = [];
    $values = [];

    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['category'];
        $values[] = $row['total_quantity'];
    }

    return ['labels' => $labels, 'values' => $values];
}

// Function to fetch data for bar chart based on type and salary from employee table
function getBarChartData() {
    global $conn;
    $query = "SELECT type, AVG(salary) as average_salary FROM employee GROUP BY type";
    $result = $conn->query($query);

    $labels = [];
    $values = [];

    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['type'];
        $values[] = $row['average_salary'];
    }

    return ['labels' => $labels, 'values' => $values];
}

// Get the graph type from the URL parameter
$graphType = isset($_GET['graphType']) ? $_GET['graphType'] : '';

// Fetch data based on the specified graph type
if ($graphType === 'gauge_chart') {
    $data = getGaugeChartData();
} elseif ($graphType === 'line_chart') {
    $data = getLineChartData();
} elseif ($graphType === 'bar_chart') {
    $data = getBarChartData();
} else {
    // Handle unknown graph types
    $data = [];
}

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>
