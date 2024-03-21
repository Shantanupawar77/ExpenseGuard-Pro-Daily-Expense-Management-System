<?php
require 'config.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Fetch user_id associated with the logged-in email
$query = "SELECT user_id FROM users WHERE email = '$email'";
$result = mysqli_query($con, $query);
if (!$result || mysqli_num_rows($result) == 0) {
    // Redirect to login page if user not found
    header("Location: login.php");
    exit();
}

$row = mysqli_fetch_assoc($result);
$user_id = $row['user_id'];

// Define default date range
$date_range = "all";
$where_clause = "user_id = $user_id";

// Check for selected date range
if (isset($_POST['date_range'])) {
    $date_range = $_POST['date_range'];
    switch ($date_range) {
        case "today":
            $where_clause .= " AND DATE(expensedate) = CURDATE()";
            break;
        case "this_month":
            $where_clause .= " AND MONTH(expensedate) = MONTH(CURDATE()) AND YEAR(expensedate) = YEAR(CURDATE())";
            break;
        case "this_year":
            $where_clause .= " AND YEAR(expensedate) = YEAR(CURDATE())";
            break;
        case "custom":
            if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
                // Add validation to ensure selected dates are within user's data
                $where_clause .= " AND expensedate BETWEEN '$start_date' AND '$end_date'";
            }
            break;
        default:
            // For "all", no additional condition needed
            break;
    }
}

// Fetch expenses for the logged-in user based on the date range
$rows = mysqli_query($con, "SELECT * FROM expenses WHERE $where_clause");

// Create CSV content
$csvContent = "Expense,Expense_Date,Expense_Category\n";
foreach ($rows as $row) {
    $csvContent .= "{$row['expense']},{$row['expensedate']},{$row['expensecategory']}\n";
}

// Return CSV content
return $csvContent;
?>