<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "Dashboard";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch data for gauge chart based on average salary from employee table
function getGaugeChartData() {
    global $conn;
    $query = "SELECT AVG(salary) as average_salary FROM employee";
    $result = $conn->query($query);
    
    $data = [];

    if ($row = $result->fetch_assoc()) {
        $data['value'] = $row['average_salary'];
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
