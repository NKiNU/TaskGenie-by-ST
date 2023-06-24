<?php
// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taskgenie";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the database
$sql = "SELECT
    date_list.date AS dateline,
    COALESCE(task_count.total, 0) AS total
FROM
    (
        SELECT CURDATE() - INTERVAL 1 DAY AS date
        UNION ALL
        SELECT CURDATE()
        UNION ALL
        SELECT CURDATE() + INTERVAL 1 DAY
        UNION ALL
        SELECT CURDATE() + INTERVAL 2 DAY
        UNION ALL
        SELECT CURDATE() + INTERVAL 3 DAY
        UNION ALL
        SELECT CURDATE() + INTERVAL 4 DAY
    ) AS date_list
LEFT JOIN
    (
        SELECT
            DATE(dateline) AS date,
            COUNT(taskname) AS total
        FROM
            task
        WHERE
            email = 'harun123@gmail.com'
            AND DATE(dateline) BETWEEN CURDATE() - INTERVAL 1 DAY AND CURDATE() + INTERVAL 4 DAY
        GROUP BY
            DATE(dateline)
    ) AS task_count ON date_list.date = task_count.date;";
$result = $conn->query($sql);

$dateLabels = array();
$totalTasksData = array();
//$completedTasksData = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Assuming your table has date, total_tasks, and completed_tasks columns
        $dateLabels[] = $row["date"];
        $totalTasksData[] = $row["total_tasks"];
       // $completedTasksData[] = $row["completed_tasks"];
    }
}

// Close the database connection
$conn->close();

// Prepare the response as a JSON object
$response = array(
    "dateLabels" => $dateLabels,
    "totalTasksData" => $totalTasksData,
    "completedTasksData" => $completedTasksData
);

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
