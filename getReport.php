<?php
include("session.php"); 
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
        background-color: #DCF2F1;
    }

    .dashboard-content {
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
                    Dashboard </a><a href="add_expense.php" class="dashboard-nav-item "><i
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
            <nav class="navbar navbar-expand-lg navbar-light  ">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
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
                                <a class="dropdown-item" href="profile.php">Edit Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class='dashboard-content'>
                <div class='container'>
                    <div class='card'>
                        <div class='card-header'>
                            <h3 class="mt-4 text-center">Expense Report</h3>
                            <hr>
                        </div>
                        <div class='container '>
                            <div class="row">
                                <div style="padding:15px 15px">
                                    <img src="exenseManagerPhoto.gif" width="400px" alt="" style="padding:15px 15px">
                                </div>

                                <div class="col-md" style="margin:0 auto;">
                                    <form action="export.php" method="POST">
                                        <div class="form-group row">

                                            <label>
                                                <input type="radio" name="date_range" value="all" checked> All
                                            </label>

                                        </div>
                                        <div class="form-group row">
                                            <label>
                                                <input type="radio" name="date_range" value="today"> This Day
                                            </label>
                                        </div>
                                        <div class="form-group row">
                                            <label>
                                                <input type="radio" name="date_range" value="this_month"> This Month
                                            </label>
                                        </div>
                                        <div class="form-group row">
                                            <label>
                                                <input type="radio" name="date_range" value="this_year"> This Year
                                            </label>
                                        </div>
                                        <div class="form-group row">
                                            <label>
                                                <input id="CustomeId" type="radio" name="date_range" value="custom">
                                                Custom Date Range
                                            </label>
                                        </div>
                                        <div id="custom_dates" style="display: none;">
                                            <label for="start_date">Start Date:</label>
                                            <input type="date" id="start_date" name="start_date"><br>
                                            <label for="end_date">End Date:</label>
                                            <input type="date" id="end_date" name="end_date"><br><br>
                                        </div>
                                        <button type="submit" class="btn btn-lg btn-block btn-primary"
                                            style="border-radius: 0%;">
                                            Get the Report
                                        </button>



                                    </form>

                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("CustomeId").addEventListener("click", function(event) {
            var customDates = document.getElementById("custom_dates");
            console.log(customDates);
            customDates.style.display = "block";
        });
    })
    </script>
</body>

</html>