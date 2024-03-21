<?php
  include("session.php");
  $exp_category_dc = mysqli_query($con, "SELECT expensecategory FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");
  $exp_amt_dc = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");

  $exp_date_line = mysqli_query($con, "SELECT expensedate FROM expenses WHERE user_id = '$userid' GROUP BY expensedate");
  $exp_amt_line = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid' GROUP BY expensedate");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExpenseGuard Pro</title>
    <link rel="icon" href="favicon.png" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/feather.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css_new/indexcss.css">
    <style>
    body {
        margin: 0;
    }

    .dashboard {
        margin-top: 0;
    }

    .dashboard-app .navbar {
        background-color: #23d2ae;
    }


    .dashboard-nav-list a {
        color: #0F1035;
    }

    .dashboard-content {
        margin-top: 0;
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;

    }
    </style>

</head>

<body>
    <div class='dashboard'>
        <div class="dashboard-nav">
            <div class="user">
                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="120">
                <h5>
                    <?php 
                echo $username 
                ?>


                </h5>
                <p>
                    <?php 
                echo $useremail 
                 ?>

                </p>

            </div>

            <nav class="dashboard-nav-list"><a href="index.php" class="dashboard-nav-item"><i class="fas fa-home"></i>
                    Dashboard </a><a href="add_expense.php" class="dashboard-nav-item"><i
                        class="fas fa-tachometer-alt"></i>
                    Add Expenses
                </a><a href="manage_expense.php" class="dashboard-nav-item"><i class="fas fa-file-upload"></i> Manage
                    Expenses </a>
                <a href="profile.php" class="dashboard-nav-item"><i class="fas fa-user"></i> Profile </a>
                <a href="getReport.php" class="dashboard-nav-item"><i class="fas fa-user"></i> Export </a>
                <div class="nav-item-divider"></div>
                <a href="change_password.php" class="dashboard-nav-item"><i class="fas fa-user"></i> Change Password
                </a>
                <a href="logout.php" class="dashboard-nav-item"><i class="fas fa-sign-out-alt"></i> Logout </a>
            </nav>
        </div>
        <div class='dashboard-app'>
            <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #23d2ae;">


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-0 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="25">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="profile.php">Your Profile</a>
                                <a class=" dropdown-item" href="profile.php">Edit Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class='dashboard-content'>
                <div class='container'>
                    <div class="container-fluid">
                        <h3 class="mt-4">Dashboard</h3>
                        <div class="row">
                            <div class="col-md">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col text-center">
                                                <a href="add_expense.php"><img src="icon/addex.png" width="57px" />
                                                    <p>Add Expenses</p>
                                                </a>
                                            </div>
                                            <div class="col text-center">
                                                <a href="manage_expense.php"><img src="icon/maex.png" width="57px" />
                                                    <p>Manage Expenses</p>
                                                </a>
                                            </div>
                                            <div class="col text-center">
                                                <a href="profile.php"><img src="icon/prof.png" width="57px" />
                                                    <p>User Profile</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3 class="mt-4">Full-Expense Report</h3>
                        <div class="row">
                            <div class="col-md">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title text-center">Yearly Expenses</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="expense_line" height="150"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title text-center">Expense Category</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="expense_category_pie" height="150"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
    <script>
    feather.replace()
    </script>
    <script>
    var ctx = document.getElementById('expense_category_pie').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php while ($a = mysqli_fetch_array($exp_category_dc)) {
                    echo '"' . $a['expensecategory'] . '",';
                  } ?>],
            datasets: [{
                label: 'Expense by Category',
                data: [<?php while ($b = mysqli_fetch_array($exp_amt_dc)) {
                    echo '"' . $b['SUM(expense)'] . '",';
                  } ?>],
                backgroundColor: [
                    '#6f42c1',
                    '#dc3545',
                    '#28a745',
                    '#007bff',
                    '#ffc107',
                    '#20c997',
                    '#17a2b8',
                    '#fd7e14',
                    '#e83e8c',
                    '#6610f2'
                ],
                borderWidth: 1
            }]
        }
    });

    var line = document.getElementById('expense_line').getContext('2d');
    var myChart = new Chart(line, {
        type: 'line',
        data: {
            labels: [<?php while ($c = mysqli_fetch_array($exp_date_line)) {
                    echo '"' . $c['expensedate'] . '",';
                  } ?>],
            datasets: [{
                label: 'Expense by Month (Whole Year)',
                data: [<?php while ($d = mysqli_fetch_array($exp_amt_line)) {
                    echo '"' . $d['SUM(expense)'] . '",';
                  } ?>],
                borderColor: [
                    '#adb5bd'
                ],
                backgroundColor: [
                    '#6f42c1',
                    '#dc3545',
                    '#28a745',
                    '#007bff',
                    '#ffc107',
                    '#20c997',
                    '#17a2b8',
                    '#fd7e14',
                    '#e83e8c',
                    '#6610f2'
                ],
                fill: false,
                borderWidth: 2
            }]
        }
    });
    </script>
</body>

</html>